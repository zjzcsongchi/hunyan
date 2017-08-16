<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends MY_Model {

    private $_table = 't_user';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    /**
     * 获取某个用户信息
     * 
     * @param  mixed $where
     */
    public function info_user($where = array()){
        if (empty($where))
        {
            return FALSE;
        }
    	return $this->get_one('*', $where);
    }
    
    
    /**
     * 验证登录用户信息,设置登录状态
     * 
     * @param int $mobile
     * @param string $password
     * 
     * @return boolean
     */
    public function login($mobile, $password){
        
        if (!$mobile || empty($password))
        {
            return array('msg' => '登录参数错误!', 'code' => 2);
        }
        
        $user_info = $this->get_one('*', array('phone_number' => $mobile));
        if (! $user_info)
        {
            return array('msg' => '没有该用户信息!', 'code' => 3);
        }
        
        $encode_pwd = get_encode_pwd($password);
        if ($user_info['password'] != $encode_pwd)
        {
            return array('msg' => '密码错误!', 'code' => 4);
        }
        
        if ($user_info['is_limit'] == C('user.disable.code.yes'))
        {
            return array('msg' => '该用户已经被禁止登录!', 'code' => 5);
        }
        
        //写COOKIE
        unset($user_info['password']);
        
        //更新登录时间
        $this->update_info(array('update_time' => date('Y-m-d H:i:s', time())), array('phone_number' => $mobile));
        
        return array('msg' => '登录成功!', 'code' => 1, 'user_data' => $user_info);
        
    }
    
    
    /**
     * 用户注册验证
     * 
     * @param array $data
     * 
     * @return array
     */
    public function register($data){
        if(empty($data['mobile']))
        {
            return array('msg' => '手机号不能为空！', 'code' => 2);
        }
        
        if(!preg_match(C('regular_expression.mobile'), $data['mobile']))
        {
            return array('msg' => '手机号格式不对！', 'code' => 3);
        }
        
        $check_tel = $this->get_one(array('id','portrait'), array('phone_number' => $data['mobile']));
        if($check_tel)
        {
            return array('msg' => '手机号已被注册！', 'code' => 4);
        }
        
        if(empty($data['tel_verify']))
        {
            return array('msg' => '手机验证码不能为空！', 'code' => 5);
        }
        
        $CI =& get_instance();
        $CI->load->model(array('Model_tel_verify' => 'Mverify'));
        $check_tel_verify =  $CI->Mverify->get_one(array('code'), array('phone_number' => $data['mobile']));
        if($check_tel_verify['code'] != $data['tel_verify'])
        {
            return array('msg' => '手机验证码错误或者过期！', 'code' => 6);
        }
        
        if(empty($data['password']))
        {
            return array('msg' => '密码不能为空！', 'code' => 7);
        }
        
        return array('msg' => '注册信息验证通过！', 'code' => 1);
    }
    
    /**
     * 根据用户id列表，获取用户信息
     * @author chaokai@gz-zc.cn
     */
    public function get_users($ids = array()){
        
        if(empty($ids)){
            return false;
        }
        
        $where = array('in' => array('id' => $ids));
        $list = $this->get_lists('*', $where);
        
        if(!$list){
            return false;
        }
        
        foreach ($list as $k => $v){
            $list[$k]['name'] = $v['realname'] ? : $v['nickname'];
            $list[$k]['name'] = $list[$k]['name'] ? : '匿名';
            
            if($v['head_img']){
                $list[$k]['head_img'] = get_img_url($v['head_img']);
            }else{
                $list[$k]['head_img'] = $this->data['domain']['static']['url'].'/www/images/touxiang.png';
            }
        }
        
        return $list;
    }
    
    /**
     * 根据手机号或手机号数组查询用户信息
     * @param $tel string/array 手机号
     * @author chaokai@gz-zc.cn
     */
    public function get_users_by_tel($tel){
        $where = array('is_del' => 0);
        if(is_array($tel)){
            $where['in'] = array('mobile_phone' => $tel);
        }else{
            $where['mobile_phone'] = $tel;
        }
        
        $field = 'id,nickname,realname,mobile_phone,head_img';
        return $this->get_lists($field, $where);
        
    }
}