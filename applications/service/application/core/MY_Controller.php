<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
   
	public $data = array();
    public function __construct() {
        parent::__construct();
        
        $_GET = xss_clean($_GET);
        $_POST = xss_clean($_POST);
        
        $this->data['domain'] = C('domain');
        $this->data['site_config'] =  C('site_config');
        
        
    }
   
    /**
     * 转化为json字符串
     * @author yuanxiaolin@global28.com
     * @param unknown $arr
     * @ruturn return_type
     */
    public function return_json($arr) {
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: X-Requested-With');
        header('Content-Type: application/json');
        header('Cache-Control: no-cache');
        echo json_encode($arr);exit;
    }

 	/**
 	 * 请求成功返回
 	 * @author yuanxiaolin@global28.com
 	 * @param unknown $data
 	 * @param string $msg
 	 * @ruturn return_type
 	 */
    public function return_success($data = array(),$count =0,$msg = 'request is ok') {
       
		$this->return_json(
                array(
                    'status'=> C('status.success.value'),
                	'data'	=> $data,
                	'data_count' => $count,
                    'msg'   => $msg,
                )
        );
        
    }
    
	/**
	 * 请求失败返回
	 * @author yuanxiaolin@global28.com
	 * @param string $result
	 * @param string $success_msg
	 * @param string $failure_msg
	 * @ruturn return_type
	 */
    public function return_failed ( $msg = 'request failed',$data = '',$status = -1) {
       
        $this->return_json(
            array(
                'status'    => isset($status) ? $status : C('status.failed.value'),
                'msg'       => $msg,
            	'data'		=> $data
            )
        );
    }
    /**
     * 通用的HTTP请求工具
     * @author yuanxiaolin@global28.com
     * @param string $path 接口请求path
     * @param unknown $data get|post请求数据
     * @param string $debug 接口的debug模式， 为true将会把数据原包返回
     * @param string $method 请求方式，默认POST
     * @param unknown $cookie 接口请求的cookie信息，用于需要登陆验证的接口
     * @param unknown $multi 文件信息
     * @param unknown $headers 附加的头文件信息
     * @ruturn return_type 返回string 或者 array
     */
    public function http_request($path = '',$data = array(),$debug=false, $method ='POST',$cookie = array(),$multi = array(),$headers = array()){
    	 
    	$api_url = $this->create_url($path);
    	$response = Http::Request($api_url,$data,$method,$cookie,$multi,$headers);
    	
    	if ($debug === true) {
    		return $response;
    	}else{
    		$response = json_decode($response,true);
    	}
    	return $response;
    }
    
    /**
     * 创建接口请求URL
     * @author yuanxiaolin@global28.com
     * @param string $path
     * @return string
     */
    public function create_url($path = ''){
    	return sprintf('%s/%s',$this->data['domain']['service']['url'],$path);
    }
    

}













