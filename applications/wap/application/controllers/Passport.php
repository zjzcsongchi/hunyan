<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 登录注册、找回密码
 * @author chaokai@gz-zc.cn
 */
class Passport extends MY_Controller{
    
    private $appid, $appsecret;
    
    public function __construct(){
        parent::__construct();
        
        $this->appid = C('wechat_app.app_id.value');
        $this->appsecret = C('wechat_app.app_secret.value');
        $this->load->model(array(
                        'Model_user' => 'Muser',
                        'Model_tel_verify' => 'Mtel_verify',
                        'Model_wechat_verify' => 'Mwechat_verify',
                        'Model_access_token' => 'Maccess_token'
        ));
        
        $param = array(
            'app_id' => $this->appid,
            'app_secret' => $this->appsecret,
            'cache_dir' => APPPATH.'cache/'
        );
        $this->load->library('weixinjssdk', $param);
        
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
     * 找回密码页面
     * @author louhang@gz-zc.cn
     */
    public function forget_password(){
        $this->set_token();
        $data = $this->data;
        $data['action'] = '';
        $this->load->view('passport/forget_password',$data);
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
     * step 1 获取CODE
     * @author louhang@gz-zc.cn
     */
    public function redirect_wechat_login($state = ''){
        if(empty($state)){
            $state = $this->input->get('state');
            if(empty($state)){
                $state = 'mobile';
            }
        }
        $redirect_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('wechat_app.app_id.value');
        $redirect_url .= '&redirect_uri='.urlencode($this->data['domain']['mobile']['url'].'/passport/wechat_login/');
        $redirect_url .= "&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect";
        header('location:' . $redirect_url);
        exit; 
    }

    
    /**
     * step 1 获取CODE
     * return Array()
     * @author louhang@gz-zc.cn
     */
    public function get_access_token(){
        $code = $this->input->get('code');

        //获取open_id
        $openid_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
        $openid_ch = curl_init();
        curl_setopt($openid_ch, CURLOPT_URL,$openid_url);
        curl_setopt($openid_ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($openid_ch, CURLOPT_SSL_VERIFYPEER,0);
        $openid_data = curl_exec($openid_ch);
        curl_close($openid_ch);
        $openid_arr = json_decode($openid_data, true);
        $openid = $openid_arr['openid'];

        //access_token每天只能获取2000次，在文件中存储，失效后重新获取
        
        $access_token = $this->weixinjssdk->getAccessToken();
        
        return array(
                        'openid' => $openid,
                        'access_token' => $access_token
        );
    }
    
    /**
     * step 2 获取userinfo
     * return Array()
     * @author louhang@gz-zc.cn
     */
    public function get_wechart_user_info(){
        
        $data =  $this->get_access_token();
        $access_token = $data['access_token'];
        $openid = $data['openid'];
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data, true);
    }
    
    /**
     * 微信网页非静默授权获取用户信息
     * @author chaokai@gz-zc.cn
     */
    public function get_weixin_user_info(){
    
        //获取access_token
        $code = $this->input->get('code');
    
        //获取open_id
        $openid_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";
        $openid_ch = curl_init();
        curl_setopt($openid_ch, CURLOPT_URL,$openid_url);
        curl_setopt($openid_ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($openid_ch, CURLOPT_SSL_VERIFYPEER,0);
        $openid_data = curl_exec($openid_ch);
        curl_close($openid_ch);
        $openid_arr = json_decode($openid_data, true);
        if(isset($openid_arr['errcode'])){
            return false;
        }
        $openid = $openid_arr['openid'];
        $access_token = $openid_arr['access_token'];
    
        //获取用户信息
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        $data = curl_exec($ch);
        curl_close($ch);
    
        return json_decode($data, true);
    }
    
    /**
     * PC端微信登录
     * @author louhang@gz-zc.cn
     */
    public function wechat_login(){
        $this->set_token();
        $data = $this->data;
        $state = $this->input->get('state');
        //防止手机端登陆后，PC端扫码无效
        if($state=='mobile' && isset($data['user_info']) && !empty($data['user_info']['mobile_phone'])){
            redirect($data['domain']['mobile']['url'].'/home');
            exit;
        }
        $wechat_user_info = $this->get_wechart_user_info();
        
        //access_token 失效
        if (isset($wechat_user_info['errcode']) && $wechat_user_info['errcode']== '40001' ) {
            $this->weixinjssdk->refresh_token();
            $wechat_user_info = $this->get_wechart_user_info();
        }
        
        //未关注微信
        if (isset($wechat_user_info['subscribe']) && $wechat_user_info['subscribe']==0) {
            $this->tip_for_follow_wechat();
        } else {
            //查找open_id 是否绑定百年婚宴账户，若绑定则使用百年婚宴账户登录
            $user_info = $this->Muser->get_one('*', array('open_id' => $wechat_user_info['openid'], 'is_del' => 0));
            if ($user_info && !empty($user_info['mobile_phone'])) {
                if (!empty($state) && $state != 'mobile') {
                    //如果state不为空，判定为PC端扫码登录，手机端显示登录成功页面
                    $add_data['add_time'] = time();
                    $add_data['open_id'] = $user_info['open_id'];
                    $add_data['state'] = $state;
                    $wechat_login_info = $this->Mwechat_verify->create($add_data);
                    //微信登录成功后，跳转到成功页面
                    $this->load->view('passport/success', $data);
                } else {
                    //如果如果state为空或者值为mobile，跳转到登录前页面
                    $encode_info = encrypt($user_info);
                    $this->session->set_userdata(array('user' => $encode_info));
            
                    //跳转到登录前的页面或个人中心
                    $url = $data['domain']['mobile']['url'].'/usercenter';
                    if (isset($_SESSION['return_url']) && !empty($_SESSION['return_url'])) {
                        $url = $_SESSION['return_url'];
                    }
                    redirect($url);
                }
            } else {
                //$wechat_user_info['openid']
                //带着openid参数跳转，提醒用户尚未注册，让用户输入手机号，并绑定openid和手机号
                if (!isset($wechat_user_info['openid'])) {
                    $state = $_SESSION['state'];
                    $this->redirect_wechat_login($state);
                }
                $data['open_id'] = $wechat_user_info['openid'];
                $data['state'] = $state;
                $_SESSION['state'] = $state;
                $data['action'] = '';
                $data['nickname'] = $wechat_user_info['nickname'];
                $data['sex'] = $wechat_user_info['sex'];
                $data['head_img'] = $wechat_user_info['headimgurl'];
                $data['address'] = $wechat_user_info['country'].$wechat_user_info['province'].$wechat_user_info['city'];
                $this->load->view('passport/bind_account', $data);
            }
        }

    }


    /**
     * 微信账号绑定
     * @author louhang@gz-zc.cn
     */
    public function bind_account(){
        $data = $this->data;
        $this->form_validation->set_rules('code', '验证码', 'trim|required', array('reuqired' => '%s不能为空'));
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
    
        $time = date('Y-m-d H:i:s');
        $insert_data = array(
                        'mobile_phone' => $post_data['mobile'],
                        'open_id' => $post_data['open_id'],
                        'sex' => $post_data['sex'],
                        'head_img' => $post_data['head_img'],
                        'address' => $post_data['address'],
                        'nickname' => $post_data['nickname'],
                        'create_time' => $time,
                        'update_time' => $time
        );
        $bind_success = false;
        $field = 'id, open_id, sex, head_img, nickname, address';
        $exist_data = $this->Muser->get_one($field, array('mobile_phone' => $post_data['mobile'], 'is_del' => 0));
        //存在一种情况的客户，表中存在两条记录一条只有手机号，没有绑定的微信信息；一种只有微信信息，没有手机号
        //这种情况下把只有微信信息那条记录删除，把微信信息保存到只有手机号那条记录中
        $open_id_exist = $this->Muser->get_one($field, array('open_id' => $post_data['open_id'], 'is_del' => 0));
        if($exist_data){
            if($exist_data['open_id']){
                $this->return_failed('绑定失败，您的手机号已与其他微信号绑定！');
            }
            unset($insert_data['create_time']);
            unset($insert_data['mobile_phone']);
    
            if(!empty($exist_data['head_img'])){
                unset($insert_data['head_img']);
            }
            if(!empty($exist_data['nickname'])){
                unset($insert_data['nickname']);
            }
            if(!empty($exist_data['address'])){
                unset($insert_data['address']);
            }
            //如果存在用户的open_id记录，则删除条这条信息
            if($open_id_exist){
                $this->Muser->update_info(array('is_del' => 1), array('open_id' => $post_data['open_id']));
            }
            $this->Muser->update_info($insert_data, array('mobile_phone' => $post_data['mobile']));
            $bind_success = true;
        }else{
            //如果存在用户的open_id记录，则删除条这条信息
            if($open_id_exist){
                $this->Muser->update_info(array('mobile_phone' => $post_data['mobile']), array('open_id' => $post_data['open_id']));
            }else{
                $this->Muser->create($insert_data);
            }
            $bind_success = true;
        }
        if($bind_success){
            $add_data = array();
            $add_data['add_time'] = time();
            $add_data['open_id'] = $post_data['open_id'];
            $add_data['state'] = $post_data['state'];
            if(!empty($post_data['state']) && $post_data['state'] != 'mobile'){
                //PC端
                $wechat_login_info = $this->Mwechat_verify->create($add_data);
                $this->return_success(array('url' => "/passport/wechat_success"), '登录成功');
            }else{
                //手机端
                $user_info = $this->Muser->get_one('id,mobile_phone', array('open_id' => $post_data['open_id'], 'is_del' => 0));
                if($user_info){
                    $encode_info = encrypt($user_info);
                    $this->session->set_userdata(array('user' => $encode_info));
                    $url = $data['domain']['mobile']['url'].'/usercenter';
                    if(isset($_SESSION['return_url']) && !empty($_SESSION['return_url'])){
                        $url = $_SESSION['return_url'];
                    }
                    $this->return_success(array('url' => $url), '登录成功');
                }
            }
        }
    
        $this->return_failed('绑定失败，请重新扫码');
    
    }
    
    /*************************************************************************************************************/
    
    /**
     * 自媒体详情微信登陆
     * @author yonghua
     */
    public function weixin_smarty_login(){
        $this->set_token();
        $data = $this->data;
        $news_id = (int) $this->input->get('id');

        $wechat_user_info = $this->get_weixin_user_info();
        //如果未获取到用户信息跳转到首页
        if(!$wechat_user_info){
            redirect($data['domain']['mobile']['url'].'/home');
            exit;
        }
        //根据openid在数据库里查找记录
        $user_info = $this->Muser->get_one('*', array('open_id' => $wechat_user_info['openid'], 'is_del' => 0, 'is_limit' => 0));
        if($user_info){
            //保存登陆信息
            $encode_info = encrypt($user_info);
            $this->session->set_userdata(array('user' => $encode_info));
            redirect($data['domain']['mobile']['url'].'/news/detail?id='.$news_id);
        }else{
            $add['open_id'] = $wechat_user_info['openid'];
            $add['nickname'] = isset($wechat_user_info['nickname']) ? $wechat_user_info['nickname'] : '';
            $add['sex'] = isset($wechat_user_info['sex']) ? $wechat_user_info['sex'] : '';
            $add['head_img'] = isset($wechat_user_info['headimgurl']) ? $wechat_user_info['headimgurl'] : '';
            $add['address'] = isset($wechat_user_info['country']) ? $wechat_user_info['country'].$wechat_user_info['province'].$wechat_user_info['city'] : '';
            $add['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Muser->create($add);
            if(!$res){
                $this->return_failed('访问失败');
            }
            $user_info = $this->Muser->get_one('*', array('open_id' => $wechat_user_info['openid']));
            $encode_info = encrypt($user_info);
            $this->session->set_userdata(array('user' => $encode_info));
            redirect($data['domain']['mobile']['url'].'/news/detail?id='.$news_id);
        }
    }
    
    
    /**
     * 婚宴详情微信登陆
     * @author yonghua
     */
    public function weixin_zan_login(){
        $this->set_token();
        $data = $this->data;
        $id = (int) $this->input->get('id');
        $wechat_user_info = $this->get_wechart_user_info();
        if(!empty($wechat_user_info)){
            //根据openid在数据库里查找记录
            $user_info = $this->Muser->get_one('*', array('open_id' => $wechat_user_info['openid'], 'is_del' => 0, 'is_limit' => 0));
            if($user_info){
                //保存登陆信息
                $encode_info = encrypt($user_info);
                $this->session->set_userdata(array('user' => $encode_info));
                redirect($data['domain']['mobile']['url'].'/today/detail?id='.$id);
            }else{
                $add['open_id'] = $wechat_user_info['openid'];
                $add['nickname'] = $wechat_user_info['nickname'];
                $add['sex'] = $wechat_user_info['sex'];
                $add['head_img'] = $wechat_user_info['headimgurl'];
                $add['address'] = $wechat_user_info['country'].$wechat_user_info['province'].$wechat_user_info['city'];
                $add['create_time'] = date('Y-m-d H:i:s');
                $res = $this->Muser->create($add);
                if(!$res){
                    $this->return_failed('访问失败');
                }
                $user_info = $this->Muser->get_one('*', array('open_id' => $wechat_user_info['openid']));
                $encode_info = encrypt($user_info);
                $this->session->set_userdata(array('user' => $encode_info));
                redirect($data['domain']['mobile']['url'].'/today/detail?id='.$id);
            }
        }else{
            //没有获取到微信信息 提示重新登陆
            $this->return_failed('没有获取到微信用户信息,或用户已经被限制登陆');
        }
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
     * 微信登录成功后显示成功页面
     * @author louhang@gz-zc.cn
     */
    public function wechat_success(){
        $data = $this->data;
        $data['action'] = '';
        $this->load->view('passport/success', $data);
    }
    
    /**
     * 提醒关注微信号
     * @author louhang@gz-zc.cn
     */
    public function tip_for_follow_wechat(){
        $data = $this->data;
        $this->load->view('passport/tip_for_follow_wechat', $data);
    }

}
