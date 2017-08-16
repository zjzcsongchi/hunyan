<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userverify extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array(
		   'Model_tel_verify' => 'Mverify'
		));
	}
	

	/**
	 * 获取某个手机号对应的验证码
	 * 
	 * @param int $mobile
	 */
	public function get_tel_code_info(){
	    $mobile = $this->input->post('mobile', TRUE);
	    $data = array();
	    if ($mobile){
	        $data = $this->Mverify->get_one(array('id', 'tel', 'code', 'add_time'), array('tel'=>$mobile));
	    } 
	    $this->return_success($data);
	}
	
	/**
	 * 更新验证码
	 * @param unknown $code
	 * @param unknown $id
	 * @throws Exception
	 * @author mochaokai@global28.com
	 */
	public function update_tel_code_info($code = 0, $id = 0){
	    try {
    	    $code = $this->input->post('code');
    	    $id = $this->input->post('id');
    	    if(empty($code) || empty($id)){
    	        throw new Exception('必须同时包含id、code两个参数');
    	    }
    	    $result = $this->Mverify->update_info(array( 'code'=>$code,'add_time'=>time()), array('id'=>$id));
	        if($result){
	            $this->return_success();
	        }else{
	            $this->return_failed();
	        }
	    }catch (Exception $e){
	        $this->return_failed($e->getMessage());
	    }
	}
	
	/**
	 * 增加手机号验证码
	 * @param $data array 参数组
	 * @author mochaokai
	 */
	public function add(){
	    try {
    	    $data = $this->input->post('data');
	        if(!is_array($data)){
	            throw new Exception('参数必须为数组');
	        }
	        $result = $this->Mverify->create($data);
	        if($result){
	            $this->return_success($result);
	        }else{
	            $this->return_failed();
	        }
	    }catch (Exception $e){
	        $this->return_failed($e->getMessage());
	    }
	    
	}
 
}
