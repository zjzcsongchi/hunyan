<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 星光大道报名
 * @author louhang@gz-zc.cn
 */
class Avenueofstar extends MY_Controller{
    private $pagesize;
    private $appid, $appsecret;
    public function __construct(){
        parent::__construct();
        
        $this->appid = C('wechat_app.app_id.value');
        $this->appsecret = C('wechat_app.app_secret.value');
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_xg_family' => 'Mxg_family',
                'Model_xg_userinfo' => 'Mxg_userinfo',
                'Model_xg_otherinfo' => 'Mxg_otherinfo',
                'Model_xg_program' => 'Mxg_program',
                        
                'Model_user' => 'Muser',
                'Model_wechat_verify' => 'Mwechat_verify',
                'Model_access_token' => 'Maccess_token'
        ]);
        $this->pagesize = 3;
    }
    
    /**
     * 首页
     * @author louhang@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        if(!isset($this->data['user_info']['id']) || empty($this->data['user_info']['id'])){
            header('location:' . C('domain.mobile.url') . '/avenueofstar/is_login');
            exit;
        }
        
        $user_id = $data['user_info']['id'];
        $where = array('user_id' => $user_id, 'is_del' => 0);
        $res = $this->Mxg_userinfo->get_one('id,auth_status,auth_suggestion', $where);
        if($res)
        {
            $data['is_applied'] = true;
            
            $auth_status_res = array('待审核 ', '审核通过', '未通过审核');
            $auth_status_img = array('wait', 'success', 'fail');
            
            $data['auth_status'] = $res['auth_status'];
            $data['auth_suggestion'] = $res['auth_suggestion'];
            
            $data['auth_status_res'] = $auth_status_res[$res['auth_status']];
            $data['auth_status_img'] = $auth_status_img[$res['auth_status']];
            
            $this->load->view('avenueofstar/index1', $data);
        }
        else
        {
            $data['is_applied'] = false;
            $this->desc();
        }

    }
    
    /**
     * 星光大道报名介绍
     * @author louhang@gz-zc.cn
     */
    public function desc(){
        $data = $this->data;
        $this->load->view('avenueofstar/desc', $data);
    }
    
    /**
     * 提醒关注微信号
     * @author louhang@gz-zc.cn
     */
    public function tip_for_follow_wechat(){
        $data = $this->data;
        $this->load->view('avenueofstar/tip_for_follow_wechat', $data);
    }
    
    /**
     * 参赛报名
     * @author louhang@gz-zc.cn
     */
    public function apply1(){
        $data = $this->data;
        if(!isset($this->data['user_info']['id']) || empty($this->data['user_info']['id'])){
            header('location:' . C('domain.mobile.url') . '/avenueofstar/is_login');
            exit;
        }
        
        $data['political_status'] = C('political_status');
        $data['marry_status'] = C('marry_status');
        $data['program_name'] = C('program_name');
        if(IS_POST){
            $post_data = $this->input->post();

            $program = $post_data['program'];
            
            unset($post_data['program']);
            
            $family = $post_data['family'];
            unset($post_data['family']);
            
            if (!isset($post_data['profile']) || empty($post_data['profile'])){
                $this->return_failed('请上传您的照片');
            }
            
            $user_id = $data['user_info']['id'];
            $where = array('user_id' => $user_id, 'is_del' => 0);
            $is_exist = $this->Mxg_userinfo->get_one('id', $where);
            
            $post_data['user_id'] = $user_id;
            $post_data['create_time'] = date('Y-m-d H:i:s');
            
            if($is_exist)
            {
                //修改记录
                $post_data['auth_status'] = 0; //重新修改的数据 重新审核
                
                $xg_user_id = $is_exist['id'];
                $where = array_merge($where, array('id' => $xg_user_id));
                
                if ($this->Mxg_userinfo->update_info($post_data, $where))
                {
                    $where = array('xg_user_id' => $xg_user_id);
                    if(!empty($program))
                    {
                        $add_data = array();
                        foreach ($program as $k => $v){
                            $add_data[] = array('xg_user_id' => $xg_user_id, 'program_type' => $k, 'name' => $v);
                        }
                        $this->Mxg_program->delete($where);
                        $is_success = $this->Mxg_program->create_batch($add_data);
                        if (!$is_success)
                        {
                            $this->return_failed('申请失败');
                        }
                    }
                    if(!empty($family))
                    {
                        $add_data = array();
                        foreach ($family as $k => $v){
                            $add_data[] = array('xg_user_id' => $xg_user_id, 'name' => $v[0], 'relation' => $v[1], 'mobile_phone' => $v[2]);
                        }
                        $this->Mxg_family->delete($where);
                        $is_success = $this->Mxg_family->create_batch($add_data);
                        if (!$is_success)
                        {
                            $this->return_failed('申请失败');
                        }
                    }
                    
                    $this->return_success('', '修改成功');
                }
                else 
                {
                    $this->return_failed('修改失败');
                }
            }
            else
            {
                //新申请 插入记录
                $res = $this->Mxg_userinfo->create($post_data);
                if (!$res){
                    $this->return_failed('申请失败');
                }
                if(!empty($program))
                {
                    $add_data = array();
                    foreach ($program as $k => $v){
                        $add_data[] = array('xg_user_id' => $res, 'program_type' => $k, 'name' => $v);
                    }
                    $is_success = $this->Mxg_program->create_batch($add_data);
                    if (!$is_success)
                    {
                        $this->return_failed('申请失败');
                    }
                }
                if(!empty($family))
                {
                    $add_data = array();
                    foreach ($family as $k => $v){
                        $add_data[] = array('xg_user_id' => $res, 'name' => $v[0], 'relation' => $v[1], 'mobile_phone' => $v[2]);
                    }
                    $is_success = $this->Mxg_family->create_batch($add_data);
                    if (!$is_success)
                    {
                        $this->return_failed('申请失败');
                    }
                }
                $this->return_success('', '申请成功');
            }
            
            //把手机号更新到 t_user 表
            if(!empty($post_data['mobile_phone']) && preg_match(C('regular_expression.mobile'), $post_data['mobile_phone']) )
            {
                $where = array('id' => $data['user_info']['id']);
                $this->Muser->update_info(array('mobile_phone' => $post_data['mobile_phone']), $where);
            }

        }
        
        $user_id = $data['user_info']['id'];
        $where = array('user_id' => $user_id, 'is_del' => 0);
        $data['xg_userinfo'] = $this->Mxg_userinfo->get_one('*', $where);
        
        if($data['xg_userinfo']){
            $where = array('xg_user_id' => $data['xg_userinfo']['id']);
            $data['family'] = $this->Mxg_family->get_lists('*', $where);
            $program = $this->Mxg_program->get_lists('*', $where);
            $data['program'] = array();
            foreach ($program as $k => $v){
                $data['program'][$v['program_type']] = $v['name'];
            }
            
        }else{
            unset($data['xg_userinfo']);
        }
        

        
        $this->load->view('avenueofstar/apply1', $data);
    }
    
   
    
    
    /**
     * 参赛报名 step-2
     * @author louhang@gz-zc.cn
     */
    public function apply2(){
        $data = $this->data;
        if(!isset($this->data['user_info']['id']) || empty($this->data['user_info']['id'])){
            header('location:' . C('domain.mobile.url') . '/avenueofstar/is_login');
            exit;
        }
        
        $user_id = $data['user_info']['id'];
        $where = array('user_id' => $user_id, 'is_del' => 0);
        $data['xg_user_id'] = $this->Mxg_userinfo->get_one('id', $where);
        if(empty($data['xg_user_id'])){
            $url = $data['domain']['mobile']['url'].'/avenueofstar';
            redirect($url);
            exit;
        }
       
        $data['xg_user_id'] = $data['xg_user_id']['id'];
       
        
        if(IS_POST){
            $post_data = $this->input->post();
            $post_data['xg_user_id'] = $data['xg_user_id'];

            $where = array('xg_user_id' => $post_data['xg_user_id']);
            $is_exist = $this->Mxg_otherinfo->get_one('id', $where);
            if($is_exist){
                //修改记录
                if ($this->Mxg_otherinfo->update_info($post_data, $where)){
                    $this->return_success('', '修改成功');
                }else {
                    $this->return_failed('修改失败');
                }
            }else{
                //插入记录
                if ($this->Mxg_otherinfo->create($post_data)){
                    $this->return_success('', '申请成功');
                }else {
                    $this->return_failed('申请失败');
                }
            }
        }

        $where = array('xg_user_id' => $data['xg_user_id']);
        $data['xg_otherinfo'] = $this->Mxg_otherinfo->get_one('*', $where);
        
        $this->load->view('avenueofstar/apply2', $data);
    }
    
    /**
     * 审核状态
     * @author louhang@gz-zc.cn
     */
    public function feedback(){
        $data = $this->data;
        if(!isset($this->data['user_info']['id']) || empty($this->data['user_info']['id'])){
            header('location:' . C('domain.mobile.url') . '/avenueofstar/is_login');
            exit;
        }
        
        $user_id = $data['user_info']['id'];
        $where = array('user_id' => $user_id, 'is_del' => 0);
        $data['res'] = $this->Mxg_userinfo->get_one('auth_status, auth_suggestion', $where); //'审核状态 0-待审核 1-审核通过 2-审核失败'
        $auth_status_res = array('待审核 ', '审核通过', '未通过审核');
        $data['res']['auth_status_res'] = $auth_status_res[$data['res']['auth_status']];
        
        $this->load->view('avenueofstar/feedback', $data);
    }
    
    /**
     * 判断是否登录
     * @author louhang@gz-zc.cn
     */
    public function is_login(){
        $data = $this->data;
        if(isset($this->data['user_info']['id']) && !empty($this->data['user_info']['id'])){
            $this->index();
        }else{
            $this->redirect_wechat_login();
        }
    }
    
    /**
     * 判断是否关注
     * @author louhang@gz-zc.cn
     */
    public function is_follow(){
        $data = $this->data;
        $wechat_user_info = $this->get_wechart_user_info();
        //如果用户已关注，则返回数据中可获取到openid

        if(!isset($wechat_user_info['openid']) || isset($wechat_user_info['errcode']) || (isset($wechat_user_info['subscribe']) && $wechat_user_info['subscribe']==0))
        {
            $this->tip_for_follow_wechat();
        }
        else
        {
            $user_info = $this->Muser->get_one('id,mobile_phone', array('open_id' => $wechat_user_info['openid']));
            if($user_info)
            {
                $encode_info = encrypt($user_info);
                $this->session->set_userdata(array('user' => $encode_info));
        
                //跳转到报名主页
                $url = $data['domain']['mobile']['url'].'/avenueofstar';
                redirect($url);
            }
            else
            {
                $time = date('Y-m-d H:i:s');
                $insert_data = array(
                                'open_id' => $wechat_user_info['openid'],
                                'sex' => $wechat_user_info['sex'],
                                'head_img' => $wechat_user_info['head_img'],
                                'address' => $wechat_user_info['address'],
                                'nickname' => $wechat_user_info['nickname'],
                                'create_time' => $time,
                                'update_time' => $time
                );
                $this->Muser->create($insert_data);
        
                $user_info = $this->Muser->get_one('id,mobile_phone', array('open_id' => $wechat_user_info['openid']));
                if(empty($user_info)){
                    $encode_info = encrypt($user_info);
                    $this->session->set_userdata(array('user' => $encode_info));
        
                    //跳转到报名主页
                    $url = $data['domain']['mobile']['url'].'/avenueofstar';
                    redirect($url);
                }else{
                    //如果用户未关注，则跳转到提示关注
                    $this->tip_for_follow_wechat();
                }
            }
        }
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
        $redirect_url .= '&redirect_uri='.urlencode($this->data['domain']['mobile']['url'].'/avenueofstar/is_follow/');
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
        $param = array(
                        'app_id' => $this->appid,
                        'app_secret' => $this->appsecret,
                        'cache_dir' => APPPATH.'cache/'
        );
        $this->load->library('weixinjssdk', $param);
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

    
}
    
    
    

