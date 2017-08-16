<?php 

/**
 * 短信发送接口
 * 
 * @author james(huangjialin@global28.com) 
 *
 */
class Sms{
    
    private $config = array();
    
    /**
     * 
     * @param array $config
     * 
     */
    public function __construct($config){
        $this->config = $config[0];
      
    }
    
    
    /**
     * 发送短信
     * 
     * @param unknown $tel 手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号               
     * @param unknown $msg 消息内容               
     * @param unknown $start_time 定时发送时间 (置空表示立即发送)格式为2011-6-29 11:09:21              
     * @return boolean
     */
    public function send_sms($tel, $msg, $start_time=''){
        $params='';
        //构造请求参数
        $request_data = array(
                'sn'    =>  $this->config['sms_config']['sn'],  
                'pwd'   =>  strtoupper(md5($this->config['sms_config']['sn'] . $this->config['sms_config']['pwd'])),  
                'mobile'    =>  $tel,    
                'content'   =>  $this->config['sms_config']['company_symbol'] . $msg ,
                'ext'   =>  '',
                'stime' =>  $start_time,
                'msgfmt'=>  '',
                'rrid'  =>  ''
        );
        $params = http_build_query($request_data);
        
        //创建socket连接
        $fp = fsockopen($this->config['sms_config']['request_url'], $this->config['sms_config']['request_port'], $errno, $errstr, $this->config['sms_config']['time_out']);
        if (! $fp){
            throw new Exception( "fsockopen错误，错误信息：" . $errstr . "错误号：" . $errno);
        }
        
        //构造post请求参数
        $length = strlen($params);
        $request_body = "POST /webservice.asmx/mdsmssend HTTP/1.1\r\n";
        $request_body .= "Host:sdk.entinfo.cn\r\n";
        $request_body .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $request_body .= "Content-Length: ".$length."\r\n";
        $request_body .= "Connection: Close\r\n\r\n";
        $request_body .= $params."\r\n";
        
        //发送post的数据
        fputs($fp, $request_body);
        $inheader = 1;
        while (!feof($fp)) {
            $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据
            if ($inheader && ($line == "\n" || $line == "\r\n")) {
                $inheader = 0;
            }
            if ($inheader == 0) {
                //TODO
            }
        }
        
        //处理返回值 判断是否成功
        $line=str_replace("<string xmlns=\"http://tempuri.org/\">", "", $line);
        $line=str_replace("</string>", "", $line);
        $result=explode("-", $line);
        if(count($result)>1){
            return FALSE;
        }else{
            return TRUE;
        }
        
    }
    
    /**
     * 发送短信
     *
     * @param string $tel 手机号码（最多1000个），多个用英文逗号(,)隔开，不可为空
     * @param string $msg 消息内容
     * @param string $start_time 定时发送时间 (置空表示立即发送)格式为2011-6-29 11:09:21
     * @return boolean
     */
    public function send_sms_huaxing($tel, $msg, $start_time=''){
        $param = array(
        	   'reg' => $this->config['sms_config_huaxing']['sn'],
        	   'pwd' => $this->config['sms_config_huaxing']['pwd'],
               'sourceadd' => '',
        	   'phone' => $tel,
        	   'content' =>  $msg . $this->config['sms_config_huaxing']['company_symbol'] ,
        );
       
        $request_url = $this->config['sms_config_huaxing']['request_url'];
        if (! empty($start_time)){
            $param = array_merge($param, array('tim' => $start_time));
            $request_url = $this->config['sms_config_huaxing']['request_timing_url'];
        }
        $str_param = http_build_query($param);
        
        $ci = & get_instance();
        $ci->benchmark->mark('start');
        $return_info = $this->post_send($request_url, $str_param);
        $ci->benchmark->mark('end');
        $time = $ci->benchmark->elapsed_time('start', 'end');
        log_message('ERROR', $tel. 'send interface time is '.$time.'s');
        parse_str($return_info);
        if (isset($result) && $result === '0'){
            return TRUE;
        }else{
            return FALSE;
        }
    
    }
    
    /**
     * 发送短信
     *
     * @param string $tel 
     * @param string $msg 消息内容
     * @param string $start_time 定时发送时间 (置空表示立即发送)格式为2011-6-29 11:09:21
     * @return boolean
     */
    public function send_sms_alidayu($tel, $smsTemplateName, $sms_param){
        
        $ci = & get_instance();
        $ci->load->file(BASEPATH.'../shared/libraries/alidayu/TopSdk.php');
        $c = new TopClient;
        $c ->appkey = $this->config['sms_config_alidayu']['appKey'] ;
        $c ->secretKey = $this->config['sms_config_alidayu']['secret'] ;
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req ->setExtend( "" );
        $req ->setSmsType( $this->config['sms_config_alidayu']['SmsType'] );
        $req ->setSmsFreeSignName( $this->config['sms_config_alidayu']['SmsFreeSignName'] );
        $req ->setSmsParam( $sms_param );
        $req ->setRecNum("{$tel}");
        $req ->setSmsTemplateCode( $this->config['sms_config_alidayu']['SmsTemplate'][$smsTemplateName]['id'] );
        $resp = $c ->execute( $req );
        $resp = json_decode(json_encode($resp),TRUE);
        if (isset($resp['result']['err_code']) && $resp['result']['err_code'] === '0'){
            return true;
        }else{
            return false;
        }
    }
    
    function post_send($url,$param){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    
            
} 
