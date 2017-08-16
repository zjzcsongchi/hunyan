<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends MY_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->model([
            'Model_user_extend' => 'Muser_extend',
            'Model_user' => 'Muser',
            'Model_tel_verify' => 'Mverify'
        ]);
    
    }

    /**
     * 获取用户信息接口,包括注册信息，用户详情
     * @param number $id 
     * @ruturn json
     */
    public function info($id = 0){
        $user_id = $this->input->post('user_id');
        $data['user_info'] = array();
        if(! empty(intval($user_id)))
        {
            $data['user_info'] = $this->Muser->get_one('id, nickname, birthday, realname, mobile_phone, head_img, sex, address, is_limit', [
                'id' => $user_id 
            ]);
        }
        $this->return_success($data);
    
    }
    
    /**
     * 登陆接口
     * 
     * @param $mobile 手机号
     * @param $password 密码
     * 
     */
    public function login(){
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');
        $result = $this->Muser->login($mobile, $password);
        if (!$mobile || empty($password))
        {
            $this->return_failed('', array('msg' => '登录参数错误!', 'code' => 2));
        }
        
        $user_info = $this->Muser->get_one('*', array('phone_number' => $mobile));
        if (! $user_info)
        {
            $this->return_failed('', array('msg' => '没有该用户信息!', 'code' => 3));
        }
        
        $encode_pwd = get_encode_pwd($password);
        if ($user_info['password'] != $encode_pwd)
        {
            $this->return_failed('', array('msg' => '密码错误!', 'code' => 4));
        }
        
        if ($user_info['is_limit'] == C('user.disable.code.yes'))
        {
            $this->return_failed('', array('msg' => '该用户已经被禁止登录!', 'code' => 5));
        }
        
        //更新登录时间
        $this->Muser->update_info(array('update_time' => date("Y-m-d H:i:s", time())), array('phone_number' => $mobile));
        
        $this->return_success(array('msg' => '登录成功!', 'code' => 1, 'user_data' => $user_info));
    }
    
    /**
     * 注册接口
     * @param $data
     */
    public function reg(){
        $data = $this->input->post('data');
        if(empty($data['mobile']))
        {
            $this->return_failed('', array('msg' => '手机号不能为空！', 'code' => 2));
        }
        
        if(!preg_match(C('regular_expression.mobile'), $data['mobile']))
        {
            $this->return_failed('', array('msg' => '手机号格式不对！', 'code' => 3));
        }
        
        $check_tel = $this->Muser->get_one(array('id','portrait'), array('phone_number' => $data['mobile']));
        if($check_tel)
        {
            $this->return_failed('', array('msg' => '手机号已被注册！', 'code' => 4));
        }
        
        if(empty($data['tel_verify']))
        {
            $this->return_failed('', array('msg' => '手机验证码不能为空！', 'code' => 5));
        }
        
        $sms_config = C('sms.sms_config_huaxing');
        $check_tel_verify = $this->Mverify->get_one(array('code,add_time'), array('phone_number' => $data['mobile']));
         
        if(isset($check_tel_verify['code']))
        {
            if ((time() - $check_tel_verify['add_time']) > $sms_config['nvalidation_time'])
            {
                $this->return_failed('',array('msg' => '手机验证码过期！', 'code' => 6));
            }
            if ($check_tel_verify['code'] != $data['tel_verify'])
            {
                $this->return_failed('',array('msg' => '手机验证码错误！', 'code' => 6));
            }
           
        }
        else 
        {
            $this->return_failed('',array('msg' => '手机验证码错误！', 'code' => 6));
        }
        
        if(empty($data['password']))
        {
            $this->return_failed('', array('msg' => '密码不能为空！', 'code' => 7));
        }
      
        $this->return_success(array('msg' => '注册信息验证通过！', 'code' => 1));
    }
    
    /**
     * 增加账号
     * @author mochaokai
     */
    public function add(){
        $data = $this->input->post('data');
        $result = $this->Muser->create($data);
        if($result)
        {
            $this->return_success($result);
        }
        else
        {
            $this->return_failed();
        }
    }
    
    /**
     * 更新账号信息
     */
    public function update(){
        try {
            $data = $this->input->post('data');
            $id = $this->input->post('id');
            if(empty($id) || empty($data) || !is_array($data))
            {
                throw new Exception('参数错误');
            }
            $result = $this->Muser->update_info($data, ['id' => $id]);
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
     * 更新用户扩展信息
     */
    public function update_extend(){
        try {
            $data = $this->input->post('data');
            $user_id = $this->input->post('user_id');
            if(empty($user_id) || empty($data) || !is_array($data))
            {
                throw new Exception('参数错误');
            }
            $result = $this->Muser_extend->update_info($data, ['user_id' => $user_id]);
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
     * 获取账号信息
     */
    public function detail(){
        try {
            $id = (int) $this->input->post('id');
            $mobile = $this->input->post('mobile');
            $disable = $this->input->post('disable');
            $field = $this->input->post('field');
            if(empty($field)){
                $field = '*';
            }
            if(empty($id) && empty($mobile) && empty($disable))
            {
                throw new Exception('参数错误');
            }
            $where = array();
            if(!empty($id))
            {
                $where['id'] = $id;
            }
            if(!empty($mobile))
            {
                $where['phone_number'] = $mobile;
            }
            if(!empty($disable))
            {
                $where['is_limit'] = $disable;
            }
            $result = $this->Muser->get_one($field, $where);
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
     * interface:获取用户列表
     * @method:get|post
     * @param number $page     偏移量
     * @param number $size     分页大小
     * @ruturn json
     */
    public function get_lists(){
        try
        {
            $where = $this->input->post('where');
            $order = $this->input->post('order');
            
            $field = $this->input->post('field');
            if(empty($field))
            {
                $field = '*';
            }
            
          
            $default_order = ['A.id'=>'desc'];
            if (! is_null($order))
            {
                $order = array_merge($order, $default_order);
            }
            else
            {
                $order = $default_order;
            }
            
            $page = $this->input->get_post('page')? $this->input->get_post('page'): 0;
            $size = $this->input->get_post('pagesize')? $this->input->get_post('pagesize'): 15;

            //获取列表
            $this->db->select($field);
            $this->db->from('t_user A');
            $this->db->join('t_user_extend B', 'A.id = B.user_id');

            if(isset($where['like'])) {
                foreach($where['like'] as $k => $v) {
                    $this->db->like($k, $v);
                }
                unset($where['like']);
            }

            if ($where) {
                $this->db->where($where);
            }

            foreach($order as $k => $v) {
                $this->db->order_by($k, $v);
            }
            $this->db->limit($size, $page);
            $result = $this->db->get()->result_array();

            $this->return_success($result);
        }
        catch (Exception $e)
        {
            $this->return_failed($e->getMessage());
        }
    }


    /**
     * interface:获取用户记录条数
     * @ruturn json
     */
    public function get_count(){
        try
        {
            $where = $this->input->post('where');
            
            //获取记录条数
            $this->db->from('t_user A');
            $this->db->join('t_user_extend B', 'A.id = B.user_id');

            if(isset($where['like'])) {
                foreach($where['like'] as $k => $v) {
                    $this->db->like($k, $v);
                }
                unset($where['like']);
            }

            if ($where) {
                $this->db->where($where);
            }

            $count = $this->db->count_all_results();

            $this->return_success($count);
        }
        catch (Exception $e)
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    

}
