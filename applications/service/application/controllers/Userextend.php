<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 用户扩展信息
 * @author huangjialin
 */
class Userextend extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
        	'Model_user_extend' => 'Muser_extend'
        ));
    }
    
    /**
     * 获取用户扩展信息
     */
    public function info(){
        try {
            $user_id = $this->input->post('user_id');
            $mobile = $this->input->post('mobile');
            $field = $this->input->post('field');
            if(empty($mobile) && empty($user_id))
            {
                throw new Exception('参数为空');
            }
            if(empty($field))
            {
                $field = '*';
            }
            if(!empty($mobile) && !empty($user_id))
            {
                $result = $this->Muser_extend->get_one($field,['phone_number'=>$mobile, 'or' => array('user_id' => $user_id)]);
            }
            else if(!empty($user_id) && empty($mobile))
            {
                $result = $this->Muser_extend->get_one($field,['user_id'=>$user_id]);
            }
            elseif (!empty($mobile) && empty($user_id))
            {
                $result = $this->Muser_extend->get_one($field, ['phone_number' => $mobile]);
            }
            
            $result['card_front'] = $result['card_front'];
            $result['card_back'] = $result['card_back'];
            $result['card_number'] = $result['card_number'];
            $result['card_expiration'] = $result['card_expiration'];
            $result['education'] = $result['education'];
            if(!empty($result)){
                $this->return_success($result);
            }else{
                $this->return_failed();
            }
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * 批量获取用户信息
     */
    public function lists(){
        try {
            $user_ids = $this->input->post('user_ids');
            $field = $this->input->post('field');
            
            if(empty($user_ids))
            {
                throw new Exception('参数为空');
            }
            
            if(empty($field))
            {
                $field = '*';
            }
             
            $result = $this->Muser_extend->get_lists($field, ['in' => array('user_id'=>$user_ids)]);
            if ($result)
            {
                foreach ($result as $key => $v){
                    $result['card_front'][$key] = explode(',', $v['card_front']);
                    $result['card_back'][$key] = explode(',', $v['card_back']);
                    $result['edu_certificate'][$key] = explode(',', $v['edu_certificate']);
                }
            }
            
            if(!empty($result))
            {
                $this->return_success($result);
            }
            else
            {
                $this->return_failed();
            }
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * 更新用户扩展信息
     */
    public function update_info(){
        try {
            $data = $this->input->post('data');
            $user_id = $this->input->post('user_id');
            $mobile = $this->input->post('mobile');
            if(empty($user_id) && empty($mobile))
            {
                throw new Exception('必须包含条件参数');
            }
            if(empty($data))
            {
                throw new Exception('参数不能为空');
            }
            if(!empty($mobile) && !empty($user_id))
            {
                $result = $this->Muser_extend->update_info($data,['mobile'=>$mobile, 'or' => array('user_id' => $user_id)]);
            }
            else if(!empty($mobile) && empty($user_id))
            {
                $result = $this->Muser_extend->update_info($data,['mobile'=>$mobile]);
            }
            else if(empty($mobile) && !empty($user_id))
            {
                $result = $this->Muser_extend->update_info($data,['user_id'=>$user_id]);
            }
            if($result)
            {
                $this->return_success();
            }
            else
            {
                $this->return_failed();
            }
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * 增加用户扩展信息
     */
    public function add_user_extend(){
        try {
            $data = $this->input->post('data');
            if(empty($data) || !is_array($data)){
                throw new Exception('参数错误');
            }
            $result = $this->Muser_extend->create($data);
            if($result)
            {
                $this->return_success($result);
            }
            else
            {
                $this->return_failed();
            }
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
    }
}