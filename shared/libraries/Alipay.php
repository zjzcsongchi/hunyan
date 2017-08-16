<?php 

/**
 * 支付宝接口
 * 
 * @author james(huangjialin@global28.com) 
 *
 */
class Alipay{
    
    private $config = array();
    private $service = '';
    private $is_mobile = FALSE;
    private $is_trade_query = FALSE;
    /**
     * 
     * @param array $config
     * 
     * @param string $is_mobile
     */
    public function __construct($config){
        $this->config = $config[0];
        $this->is_mobile = $config[1];
        if (isset($config[2])){
            $this->is_trade_query = $config[2];
        }
        if ($this->is_mobile) {
            $this->service = $this->config['alipay_service']['wap_service'];
        }elseif($this->is_trade_query){
            $this->service = $this->config['alipay_service']['single_trade_query_service'];
        }else{
            $this->service = $this->config['alipay_service']['pc_service'];
        }
        
    }
    
   
    /**
     * 生成签名后的请求参数
     *
     * @param  array $params  
     *        $params['out_trade_no']     唯一订单编号
     *        $params['subject']
     *        $params['total_fee']
     *        $params['body']
     *        $params['show_url']
     *        $params['anti_phishing_key']
     *        $params['exter_invoke_ip']
     *        $params['it_b_pay']
     *        $params['_input_charset']
     *
     * @return array
     *
     */
    public function build_signed_parameters($params) {
        $default = array(
                'service' => $this->service,
                'partner' => $this->config['alipay_config']['partner'],
                'payment_type' => $this->config['alipay_config']['payment_type'],
                'seller_id'    => $this->config['alipay_config']['partner'],
                'notify_url'   => $this->config['alipay_config']['notify_url'],
                'return_url'   => $this->config['alipay_config']['return_url']
        );
        
        if ($this->is_trade_query){
            unset($default['payment_type']);
            unset($default['seller_id']);
            unset($default['notify_url']);
            unset($default['return_url']);
        }

        $params = $this->filter_sign_parameter(array_merge($default, $params));
        ksort($params);
        reset($params);
        $params['sign'] = $this->sign_parameters($params);
        $params['sign_type'] = strtoupper(trim($this->config['alipay_config']['sign_type']));
        
        //记录日志
        log_message('USER_INFO', json_encode($params));
        
        return $params;
    }
    
    
    /**
     * 生成请求参数的发送表单HTML
     *
     * 其实这个函数没有必要，更应该使用签名后的参数自己组装，只不过有时候方便就从官方 SDK 里留下了。
     *
     * @param array  $params  请求参数（未签名的）
     * @param string $method 请求方法，默认：post，可选 get
     * @param string $target 提交目标，默认：_self
     *
     * @return string
     *
     */
    public function build_request_form_html($params, $method = 'post', $target = '_self') {
        $params = $this->build_signed_parameters($params);
        $html = "<!DOCTYPE HTML><html><head></head><body>";
        $html .= "<form id='alipaysubmit' name='alipaysubmit' action='".$this->config['alipay_gateway']."_input_charset=".trim(strtolower($this->config['alipay_config']['input_charset']))."' method='$method' target='$target'>";
        foreach ($params as $key => $value) {
            $html .= "<input type='hidden' name='$key' value='$value'/>";
        }
        $html .= "</form>";
        $html .= "<script>document.forms['alipaysubmit'].submit();</script>";
        $html .= "</body></html>";
        return $html;
    }
    
    /**
     * 获取单笔订单信息
     * 
     * @param array $params
     *        $params['trade_no']           支付宝交易单号
     *        $params['out_trade_no']       唯一订单编号
     *        $params['_input_charset']
     * @return boolean | array 
     */
    public function get_trade_info($params){
        $url = $this->config['alipay_gateway']."_input_charset=".trim(strtolower($this->config['alipay_config']['input_charset']));
        $params = $this->build_signed_parameters($params);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);//SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
        curl_setopt($curl, CURLOPT_CAINFO, $this->config['alipay_config']['cacert']);//证书地址
        curl_setopt($curl, CURLOPT_HEADER, 0 );         // 过滤HTTP头
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 显示输出结果
        curl_setopt($curl, CURLOPT_POST, TRUE);          
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $html_text = curl_exec($curl);
        curl_close($curl);

        $trade_info = $this->xml_to_array($html_text);
        
        if (isset($trade_info['response']['trade'])){
            return $trade_info['response']['trade'];
        }else{
            return FALSE;
        }
    }
    
    
    /**
     * 支付完成验证返回参数（包含同步和异步）
     *
     * @param boolean $async 是否异步通知模式
     *
     * @return boolean
     */
    public function verify_callback() {
        $async = empty($_GET);
        $data = $async ? $_POST : $_GET;
        if (empty($data)) {
            return FALSE;
        }
    
        $sign_valid = $this->verify_parameters($data, $data["sign"]);
        $notify_id = $data['notify_id'];
        if ($async && $this->is_mobile){
            if ($this->config['sign_type'] == '0001') {
                $data['notify_data'] = $this->rsa_decrypt($data['notify_data'], $this->config['private_key']);
            }
            $doc = new DOMDocument();
            $doc->loadXML($data['notify_data']);
            $notify_id = $doc->getElementsByTagName( 'notify_id' )->item(0)->nodeValue;
        }
        $response_txt = 'TRUE';
        if (! empty($notify_id)) {
            $response_txt = $this->verify_from_server($notify_id);
        }
        return $sign_valid && preg_match("/TRUE$/i", $response_txt);
    }
    
    
    /**
     * 用于防钓鱼，调用接口query_timestamp来获取时间戳的处理函数
     * 
     * 注意：该功能PHP5环境及以上支持，因此必须服务器、本地电脑中装有支持DOMDocument、SSL的PHP配置环境。建议本地调试时使用PHP开发软件
     * 
     * return 时间戳字符串
     */
    public function query_timestamp(){
        $url = $this->config['alipay_gateway'] . "service=query_timestamp&partner=".trim(strtolower($this->config['alipay_config']['partner']))."&_input_charset=".trim(strtolower($this->config['alipay_config']['input_charset']));
        $encrypt_key = "";
    
        $doc = new DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
    
        return $encrypt_key;
    }
    
    
    private function verify_parameters($params, $sign){
        $params = $this->filter_sign_parameter($params);
    
        ksort($params);
        reset($params);
        
        $content = urldecode(http_build_query($params));
        switch ($this->config['alipay_config']['sign_type']) {
        	case "MD5" :
        	    return md5($content . $this->config['alipay_config']['security_key']) == $sign;
                break;
        	case "RSA" :
        	case "0001" :
        	    return $this->rsa_verify($content, $this->config['alipay_config']['private_key'], $sign);
        	    break;
        	default :
        	    return FALSE;
        }
    }
    
    private function filter_sign_parameter($params){
        $result = array();
        foreach ($params as $key => $value) {
            if ($key != "sign" && $key != "sign_type" && $value){
                $result[$key] = $value;
            }
        }
        return $result;
    }
    
    private function verify_from_server($notify_id){
        $transport =  $this->config['alipay_config']['transport'];
        $partner = trim($this->config['alipay_config']['partner']);
        $veryfy_url = ($transport == 'https' ? $this->config['verify_url']['https'] : $this->config['verify_url']['http']) . "partner=$partner&notify_id=$notify_id";
        $curl = curl_init($veryfy_url);
        curl_setopt($curl, CURLOPT_HEADER, 0 );             // 过滤HTTP头
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);   //SSL证书认证
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);      //严格认证
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);      // 显示输出结果
        curl_setopt($curl, CURLOPT_CAINFO, $this->config['alipay_config']['cacert']);//证书地址
        $response_text = curl_exec($curl);
        curl_close($curl);
        return $response_text;
    }
    
    
    /**
     * RSA验签
     * @param $data 待签名数据
     * @param $ali_public_key 支付宝的公钥文件路径
     * @param $sign 要校对的的签名结果
     * 
     * return 验证结果
     */
    private function rsa_verify($data, $ali_public_key, $sign){
        $pubKey = file_get_contents($ali_public_key);
        $res = openssl_get_publickey($pubKey);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }
    
    /**
     * RSA解密
     * @param $content 需要解密的内容，密文
     * @param $private_key 商户私钥文件路径
     * 
     * return 解密后内容
     */
    private function rsa_decrypt($content, $private_key){
        $priKey = file_get_contents($private_key);
        $res = openssl_get_privatekey($priKey);
        //用base64将内容还原成二进制
        $content = base64_decode($content);
        //把需要解密的内容，按128位拆开解密
        $result  = '';
        for($i = 0; $i < strlen($content) / 128; $i++){
            $data = substr($content, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }
    
    
    /**
     * 生成请求参数的签名
     *
     * @param array $params
     * @return string
     *
     * TODO: 未考虑参数中空格被编码成加号'+'等情况
     */
    private function sign_parameters($params){
        // 支付宝的签名串必须是未经过 urlencode 的字符串
        $param_str = urldecode(http_build_query($params));
        $result = "";
        switch ($this->config['alipay_config']['sign_type']){
        	case "MD5" :
        	    $result = md5($param_str . $this->config['alipay_config']['security_key']);
        	    break;
        	case "RSA" :
        	case "0001" :
        	    $priKey = file_get_contents($this->config['alipay_config']['private_key']);
        	    $res = openssl_get_privatekey($priKey);
        	    openssl_sign($param_str, $sign, $res);
        	    openssl_free_key($res);
        	    $result = base64_encode($sign);
        	    break;
        	default :
        	    $result = "";
        }
        return $result;
    }
    
   /**xml转为数组**/
    private function xml_to_array($xml){
        $array = (array)(simplexml_load_string($xml));
        foreach ($array as $key=>$item){
            $array[$key]  =  $this->struct_to_array((array)$item);
        }
        return $array;
    }
    
    private function struct_to_array($item) {
        if(!is_string($item)) {
            $item = (array)$item;
            foreach ($item as $key=>$val){
                $item[$key]  =  $this->struct_to_array($val);
            }
        }
        return $item;
    }
} 
