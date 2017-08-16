<?php
/**
 * 微信支付
 * @author chaokai@gz-zc.cn
 */
require_once 'Weixinhelper.php';
require_once 'Logfile.php';
class Weixinpay {
    
    //appid
    private $app_id;
    //appsecret
    private $app_secret;
    //商户id
    private $mch_id;
    //key
    private $key;
    
    //交易类型
    private $trade_type;
    
    //日志对象
    private $log;
    
    public function __construct($config){
        
        $this->log = new Logfile(array('path' => APPPATH.'/logs/wxpay'));
        
        $this->trade_type = isset($config['trade_type']) ? $config['trade_type'] : 'JSAPI';
        $this->app_id = $config['app_id'];
        $this->app_secret = $config['app_secret'];
        $this->mch_id = $config['mch_id'];
        $this->key = $config['key'];
        
    }
    
    /**
     * 统一下单
     * @param $param array 统一下单其他参数信息
     * body 商品描述  必填
     * detail 商品详情 不必填
     * out_trade_no 商户订单号 必填
     * total_fee 总金额 必填
     * notify_url 订单支付结果通知地址 必填
     * open_id 用户open_id 必填
     * spbill_create_ip 客户端ip 必填
     */
    public function create_order($param){
        
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        
        $data['appid'] = $this->app_id;
        $data['mch_id'] = $this->mch_id;
        $data['trade_type'] = $this->trade_type;
        $data['nonce_str'] = Weixinhelper::get_rand_str(32);
        //合并数组
        $data = array_merge($data, $param);
        $data['sign'] = Weixinhelper::get_sign($data, $this->key);
        //转换为xml
        $data_xml = Weixinhelper::array_to_xml($data);
        
        $response = Weixinhelper::postXmlCurl($data_xml, $url);
        
        //返回数据转换为数组
        $response_data = Weixinhelper::xml_to_array($response);
        
        if(strtoupper($response_data['return_code']) == 'FAIL'){
            //日志记录
            $this->log->error($response_data['return_msg']);
            return array(
                            'error' => 1,
                            'msg' => $response_data['return_msg']
            );
        }
        
        if(strtoupper($response_data['result_code']) == 'FAIL'){
            //日志
            $this->log->error($response_data['err_code_des']);
            return array(
                            'error' => 1,
                            'msg' => $response_data['err_code_des']
            );
        }
        
        return array(
                        'error' => 0,
                        'data' => $response_data
        );
    }
    
    /**
     * 查询订单状态
     * @author chaokai@gz-zc.cn
     */
    public function check_order(){
        
    }
    
    /**
	 * 异步通知信息验证
	 * @return boolean|mixed
	 */
	public function verify_notify()
	{
		$xml = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
		if(!$xml){
		    $this->log->error('post数据为空');
			return array('error' => 1, 'msg' => 'post数据为空');
		}
		$wx_back = Weixinhelper::xml_to_array($xml);
		if(empty($wx_back)){
		    $this->log->error('xml数据解析错误');
			return array('error' => 1, 'msg' => 'xml数据解析错误');
		}
		if($wx_back['return_code'] == 'FAIL'){
		    $this->log->error($wx_back['return_msg']);
		    return array('error' => 2, 'data' => $wx_back);
		}
		
		if($wx_back['result_code'] == 'FAIL'){
		    $this->log->error($wx_back['err_code_des']);
		    return array('error' => 3, 'data' => $wx_back);
		}
		$wx_back_sign = $wx_back['sign'];
		unset($wx_back['sign']);
		$checkSign = Weixinhelper::get_sign($wx_back, $this->key);
        if($checkSign != $wx_back_sign){
            $this->log->error('回调签名验证失败');
            return array('error' => 1, 'msg' => '签名失败');
        }
		
		return array('error' => 0, 'data' => $wx_back);
	}
    
    /**
     * weixinjsbridge调用参数
     * @author chaokai@gz-zc.cn
     */
    public function get_jsbridge_param($prepay_id){
        $data = array(
                        'appId' => $this->app_id,
                        'timeStamp' => ''.time(),
                        'nonceStr' => Weixinhelper::get_rand_str(32),
                        'package' => 'prepay_id='.$prepay_id,
                        'signType' => 'MD5'
        );
        $data['paySign'] = Weixinhelper::get_sign($data, $this->key);
        
        return json_encode($data);
    }
    
    /**
     * 关闭订单
     * @param $out_trade_no string 订单号
     * @author chaokai@gz-zc.cn
     */
    public function close_order($out_trade_no){
        $url = 'https://api.mch.weixin.qq.com/pay/closeorder';
        
        $post_data = array(
                        'appid' => $this->app_id,
                        'mch_id' => $this->mch_id,
                        'out_trade_no' => $out_trade_no,
                        'nonce_str' => Weixinhelper::get_rand_str(32),
                        'sign_type' => 'MD5'
        );
        $post_data['sign'] = Weixinhelper::get_sign($post_data, $this->key);
        
        $data_xml = Weixinhelper::array_to_xml($post_data);
        
        $response = Weixinhelper::postXmlCurl($data_xml, $url);
        
        $response_data = Weixinhelper::xml_to_array($response);
        if($response_data['return_code'] == 'FAIL'){
            //记录日志
            $this->log->error(json_encode(array('out_trade_no' => $out_trade_no, 'title' => '取消订单', 'error_msg' => $response_data['return_msg'])));
            return array(
                            'error' => 1,
                            'msg' => $response_data['return_msg']
            );
        }
        //关闭订单成功返回正确信息
        return array(
                        'error' => 0,
                        'msg' => ''
        );
        
    }
}