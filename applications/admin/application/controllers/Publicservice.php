<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publicservice extends MY_Controller{
    
    public function index(){
        show_404();
    }
    
    /**
     * 图片验证码
     */
    public function captcha(){
        session_start();
        $this->load->library('valicode');
        $this->valicode->outImg();
    }
    
    
	/**
	 * 获取手机验证码
	 */
	public function mobile_code(){
	    $this->load->model(array('Model_tel_verify' => 'Mverify'));
		try {
		    
			if(! $this->check_token($this->input->get_post('token')))
			{
			    $this->return_failed('参数错误 ！');
			}
 
		    $mobile = (int)$this->input->post('mobile');
		   
		    $sms_config = C('sms.sms_config_huaxing');
		    
		    $status_arr = array(
		                    'yes' => 1, 
		                    'no' => 0
		    );
		    //随机生成4位验证码
		    $code = get_code();
		    $status_msg_arr = array(
		            '验证码已经成功发往您填的手机号, 请等待一会！'.$code,
		            '发送失败, 请一分钟后再试！',
		            '发送间隔不能小于 '.$sms_config['repeat_send_time'].'秒！',
		            '电话号码错误！'
		    );
		    
		    //正则验证电话号码是否正确
		    if(! $mobile || ! preg_match(C('regular_expression.mobile'), $mobile))
		    {
		    	throw new Exception($status_msg_arr[3]);
		    }

		    
		    //是否获取过验证码
		    $info =  $this->Mverify->get_verify_by_tel($mobile);
		    if($info)
		    {
		        if((time() - $info['add_time']) < $sms_config['repeat_send_time'])
		        {
		        	throw new Exception($status_msg_arr[2]);
		        } 
		        $result = $this->Mverify->update_info(array( 'code'=>$code,'add_time'=>time()), array('id'=>$info['id']));
		    }
		    else
		    {
		        $result = $this->Mverify->create(array('phone_number'=>$mobile,'code'=>$code,'add_time'	=>time()));
		    }
		    
		    //给手机发送验证码
		    if ($result)
		    {
		        $send_return = send_msg($mobile, 'verification_code', ['number' => $code] );
		        if($send_return)
		        {
		            $this->return_success($status_msg_arr[0]);
		        }
		        else
		        {
		            throw new Exception($status_msg_arr[1]);
		        }
		    }
		    else
		    {
		        throw new Exception($status_msg_arr[1]);
		    }
		    
	    } catch (Exception $e) {
	    	$this->return_failed($e->getMessage());
	    }
	}
	
	/**
	 * 公历转农历
	 * @author chaokai@gz-zc.cn
	 */
    public function solartolunar(){
        $year = intval($this->input->get('year'));
        $month = intval($this->input->get('month'));
        $day = intval($this->input->get('day'));
        
        $date = $year.'-'.$month.'-'.$day;
        $result['lunar_time'] = solar_to_lunar($date);
        
        $this->return_json($result);
    }
    
    /**
     * 根据链接生成二维码
     * @author chaokai@gz-zc.cn
     */
    public function qr_code(){
        $link = $this->input->get('link');
         
        $this->load->file(BASEPATH.'../shared/libraries/phpqrcode/phpqrcode.php');
         
        echo QRcode::png($link);
         
    }
    
    
}