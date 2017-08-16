<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 登录注册、找回密码
 * @author chaokai@gz-zc.cn
 */
class Passport extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->model(array(
                        'Model_user' => 'Muser',
                        'Model_tel_verify' => 'Mtel_verify',
                        'Model_wechat_verify' => 'Mwechat_verify'
        ));
        
        $this->load->library('form_validation');
    }
    
    /**
     * 判断是否登录
     * @author chaokai@gz-zc.cn
     */
    public function islogin(){
        
        $sess_data = $this->session->userdata('user');
        $cookie_data = $this->input->cookie('user');
        
        if(!$sess_data && !$cookie_data){
            $this->return_failed();
        }else{
            $this->return_success();
        }
    }
    
    /**
     * 登录
     * @author chaokai@gz-zc.cn
     */
    public function login(){
        //暂时关闭PC端账号密码登录
        $this->return_failed('请使用微信登录注册');
        
        $this->form_validation->set_rules('password', '密码', 'trim|required', array('required' => '%s不能为空'));
        if($this->form_validation->run() == false){
            $this->return_failed(strip_tags(validation_errors()));
        }
        
        $post_data = $this->input->post();
        //验证手机号
        if(!preg_match(C('regular_expression.mobile'), $post_data['mobile'])){
            $this->return_failed('手机号格式不正确');
        }
        $where = array('mobile_phone' => $post_data['mobile'], 'password' => get_encode_pwd($post_data['password']));
        $info = $this->Muser->get_one('id,mobile_phone,is_limit', $where);
        
        if(!$info){
            $this->return_failed('用户名或密码错误');
        }
        
        if($info['is_limit']){
            $this->return_failed('账号被禁止登录');
        }
        
        unset($info['is_limit']);
        
        $encode_info = encrypt($info);
        if($post_data['is_auto'] == 1){
            $this->input->set_cookie('user', $encode_info, time() + C('site_config.cookie_expire'), C('site_config.root_domain'), '/', '', FALSE, TRUE);
        }
        $this->session->set_userdata(array('user' => $encode_info));
        
        $this->return_success();
    }
    
    /**
     * 注册
     * @author chaokai@gz-zc.cn
     */
    public function reg(){
        //暂时关闭PC端账号密码登录
        $this->return_failed('请使用微信登录注册');
        
        $this->form_validation->set_rules('code', '验证码', 'trim|required', array('reuqired' => '%s不能为空'));
        $this->form_validation->set_rules('password', '密码', 'trim|required', array('required' => '%s不能为空'));
        $this->form_validation->set_rules('mobile', '手机号', 'trim|required|is_unique[t_user.mobile_phone]', array('required' => '%s不能为空', 'is_unique' => '%s已存在,请登录！'));
        if($this->form_validation->run() == false){
            $this->return_failed(strip_tags(validation_errors()));
        }
        $post_data = $this->input->post();
        //验证手机号
        if(!preg_match(C('regular_expression.mobile'), $post_data['mobile'])){
            $this->return_failed('手机号格式不正确');
        }
        
        //验证短信验证码
        $code = $this->Mtel_verify->get_one('code', array('phone_number' => $post_data['mobile']));
        if(!$code || $code['code'] != $post_data['code']){
            $this->return_failed('验证码不正确');
        }
        
        $insert_data = array(
                        'mobile_phone' => $post_data['mobile'],
                        'password' => get_encode_pwd($post_data['password']),
                        'create_time' => date('Y-m-d H:i:s'),
                        'update_time' => date('Y-m-d H:i:s')
        );
        if($this->Muser->create($insert_data)){
            $this->return_success();
        }else{
            $this->return_failed('注册失败');
        }
        
    }
    
    /**
     * 找回密码
     * @author chaokai@gz-zc.cn
     */
    public function repass(){
        $this->form_validation->set_rules('code', '验证码', 'trim|required', array('reuqired' => '%s不能为空'));
        $this->form_validation->set_rules('password', '密码', 'trim|required', array('required' => '%s不能为空'));
        $this->form_validation->set_rules('mobile', '手机号', 'trim|required', array('required' => '%s不能为空'));
        if($this->form_validation->run() == false){
            $this->return_failed(strip_tags(validation_errors()));
        }
        $post_data = $this->input->post();
        //验证手机号
        if(!preg_match(C('regular_expression.mobile'), $post_data['mobile'])){
            $this->return_failed('手机号格式不正确');
        }
        
        //验证短信验证码
        $code = $this->Mtel_verify->get_one('code', array('phone_number' => $post_data['mobile']));
        if(!$code || $code['code'] != $post_data['code']){
            $this->return_failed('验证码不正确');
        }
        
        $where = array(
                        'mobile_phone' => $post_data['mobile'],
        );
        $info = $this->Muser->get_one('id', $where);
        
        if(!$info){
            $this->return_failed('手机号码不存在');
        }
        
        $insert_data = array(
                        'password' => get_encode_pwd($post_data['password']),
                        'update_time' => date('Y-m-d H:i:s')
        );
        if($this->Muser->update_info($insert_data, $where)){
            $this->return_success();
        }else{
            $this->return_failed('注册失败');
        }
    }
    
    /**
     * 获取token
     * @author chaokai@gz-zc.cn
     */
    public function get_token(){
        $this->set_token();
        $this->return_success($this->data['token']);
    }
    
    
    /**
     * 是否登录
     * @author chaokai@gz-zc.cn
     */
    public function is_login(){
        $data = $this->data;
        if(isset($data['user_info']['id']) && $data['user_info']['id']){
            $data['user_info']['status'] = 0;
            $this->return_json($data['user_info']);
        }else{
            $return_data['status'] = -1;
            $this->return_json($return_data);
        }
    
    }
    
    /**
     * 退出登录
     * @author chaokai@gz-zc.cn
     */
    public function logout(){
        $this->session->unset_userdata('user');
        $this->input->set_cookie('user', null, time() + C('site_config.cookie_expire'), C('site_config.root_domain'), '/', '', FALSE, TRUE);
        $url = '/';
        if ($_SERVER['HTTP_REFERER']) {
            $url = $_SERVER['HTTP_REFERER'];
        }
        redirect($url);
    }
    
    /**
     * 微信登录二维码生成 PC端
     * @author louhang@gz-zc.cn
     */
    public function wechat_login_QR(){
        $state = $this->input->get('state');
        $this->load->file(BASEPATH.'../shared/libraries/phpqrcode/phpqrcode.php');
        $app_id = C('wechat_app.app_id.value');
        $data = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$app_id}&redirect_uri=".urlencode(C('domain.mobile.url').'/passport/wechat_login')."&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect";
        // 纠错级别：L、M、Q、H
        $level = 'M';
        // 点的大小：1到10,用于手机端4就可以了
        $size = 4;
        var_dump(QRcode::png($data, false, $level, $size));
    }
    
    /**
     * 获取微信登录token
     * @author louhang@gz-zc.cn
     */
    public function get_wechat_token(){
        $token = md5(time());
        $this->return_success($token);
    }
    
    /**
     * 判断是否微信登录
     * @author louhang@gz-zc.cn
     */
    public function is_wechat_login(){
        
        $state = $this->input->get('state');
        //从Mwechat_verify表中轮询判断 微信是否已授权
        $wechat_login_info = $this->Mwechat_verify->get_one('open_id, add_time', array('state' => $state));
        
        if($wechat_login_info){
            $info = $this->Muser->get_one('id,mobile_phone', array('open_id' => $wechat_login_info['open_id'], 'is_del' => 0));
            
            if(!$info){
                $this->return_failed('用户名或密码错误');
            }
            $encode_info = encrypt($info);
            $this->session->set_userdata(array('user' => $encode_info));
            $this->return_success();
        }
        
        $this->return_failed();
    }
    

}