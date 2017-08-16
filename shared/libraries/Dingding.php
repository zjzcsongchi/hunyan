<?php 

/**
 * 钉钉先关接口
 * 
 * @author huangjialin(jialin@gz-zc.cn) 
 *
 */
class Dingding{
    
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
     * 获取配置信息json对象
     * 
     * @return string
     */
    public  function get_config(){
        $nonce = 'zhongchouqianxing';
        $time_stamp = time();
        $url = $this->cur_page_url();
        $corp_access_token = $this->get_access_token();
        if (!$corp_access_token)
        {
            die("[getConfig] ERR: no corp access token");
        }
        $ticket = $this->get_ticket($corp_access_token);
        $signature = $this->sign($ticket, $nonce, $time_stamp, $url);
        $config = array(
                        'url' => $url,
                        'nonce' => $nonce,
                        'agent_id' => $this->config['dingding_config']['agent_id'],
                        'time_stamp' => $time_stamp,
                        'corp_id' => $this->config['dingding_config']['corp_id'],
                        'signature' => $signature
        );
        return json_encode($config, JSON_UNESCAPED_SLASHES);
    }
    
    /**
     * 获取 access_token
     * 
     * @return unknown
     */
    public  function  get_access_token(){
         //accessToken有效期为两小时，建议缓存accessToken。需要在失效前请求新的accessToken 
        $url = $this->oapi_url('/gettoken');
        $access_token = '';
        $response = Http::Request($url, array('corpid' => $this->config['dingding_config']['corp_id'], 'corpsecret' => $this->config['dingding_config']['corp_secret']));
        $response = json_decode($response);
        
        if($this->check($response)){
            $access_token = $response->access_token;
        }
        return $access_token;
    }
    
    /**
     * 获取jsticket
     * 
     * @param string $access_token
     * @return string $jsticket
     */
    public  function get_ticket($access_token){
        $jsticket = '';
        $url = $this->oapi_url('/get_jsapi_ticket');
        $response =  Http::Request($url, array('type' => 'jsapi', 'access_token' => $access_token));
        $response = json_decode($response);
        if($this->check($response)){
            $jsticket = $response->ticket;
        }
        return $jsticket;
    }
    
    /**
     * 获取用户信息
     * 
     * @param string $access_token
     * @param string $code
     * @return string
     */
    public   function get_user_info($access_token, $code){
        $url = $this->oapi_url('/user/getuserinfo');
        $user_info = '';
        $response = Http::Request($url, array("access_token" => $access_token, "code" => $code));
        if($this->check(json_decode($response))){
           $user_info = json_decode($response, TRUE);
           $user_info['url'] = $url;
           $user_info = json_encode($user_info, JSON_UNESCAPED_SLASHES);
        }
        return $user_info;
    }
    
    /**
     * 获取用户企业内更详细信息
     * 
     * @param string $access_token
     * @param string $code
     * @return string
     */
    public   function get_user_details($access_token, $userid){
        $url = $this->oapi_url('/user/get');
        $user_details = '';
        $response = Http::Request($url, array("access_token" => $access_token, "userid" => $userid));
        if($this->check(json_decode($response))){
           $user_details = json_decode($response, TRUE);
           $user_details['url'] = $url;
           $user_details = json_encode($user_details, JSON_UNESCAPED_SLASHES);
        }
        return $user_details;
    }
    
    /**
     * 获取sns token
     * 
     * @param unknown $access_token
     * @return Ambigous <string, unknown>
     */
    public function get_sns_token($access_token){
        $url = $this->oapi_url('/sns/get_sns_token');
        $response = Http::Request($url, array("access_token" => $access_token));
        $sns_token = '';
        $response = Http::Request($url, array("access_token" => $access_token, "code" => $code));
        if($this->check(json_decode($response))){
            $sns_token = $response;
            
        }
        return $sns_token;
    }
    
    
    /**
     * 获取当前页面链接
     * 
     * @return string
     */
    public   function cur_page_url(){
        $page_url = 'http';
        if (array_key_exists('HTTPS',$_SERVER)&&$_SERVER["HTTPS"] == "on")
        {
            $page_url .= "s";
        }
        $page_url .= "://";
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else
        {
            $page_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $page_url;
    }
    
    /**
     * 获取签名数据
     * 
     * @param string $ticket
     * @param string $nonceStr
     * @param string $timeStamp
     * @param string $url
     * @return string
     */
    public  function sign($ticket, $nonceStr, $timeStamp, $url){
        $plain = 'jsapi_ticket=' . $ticket .
        '&noncestr=' . $nonceStr .
        '&timestamp=' . $timeStamp .
        '&url=' . $url;
        
        return sha1($plain);
    }
    
    /**
     * 验证返回结果
     * 
     * @param mixed $res
     */
    public  function check($res){
        if ($res->errcode != 0)
        {
             return  FASLE;
        }
        else
        {
            return TRUE;
        }
    }
    
    /**
     * 组装钉钉open api 地址
     * 
     * @param string $uri
     * @return string
     */
    private function oapi_url($uri = ''){
        
        return  $this->config['dingding_config']['oapi_host'].$uri;
    }
    
    
} 
