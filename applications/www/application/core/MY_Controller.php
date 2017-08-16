<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = array();
    public function __construct() {
        parent::__construct();
        $this->load->model([
                    'Model_about_us' => 'Mabout_us',
                     'Model_dinner' => 'Mdinner',
        ]);

       $_GET = xss_clean($_GET);
       $_POST = xss_clean($_POST);

        $this->data['domain'] = C('domain');
        $this->data['c_modle'] = $this->uri->segment(1);

        //SEO信息
        $this->get_seo_info();
        
        //网站全局配置 (包括400电话等)
        $this->data['site_config'] =  C('site_config');
 
        $this->load->library('session');
        $this->load->library('encrypt');

        //登录验证
         if($this->session->has_userdata('user')) //常规登录
        {
            $this->data['user_info'] = array();
            $user_base_info = decrypt($this->session->userdata('user'));
            $this->get_user_info($user_base_info);
        }
        elseif($this->input->cookie('user', TRUE)) //自动登录
        {
            $this->data['user_info'] = array();
            $user_base_info = decrypt($this->encrypt->decode($this->input->cookie('user', TRUE)));
            $this->get_user_info($user_base_info);
            
        }
        else
        {
            $login_page_arr = C('www_login'); //需要强制登录的页面
            $is_ajax = $this->input->is_ajax_request();
            $ctrl = strtolower($this->uri->segment(1));
            
            $act = $this->uri->segment(2) ? strtolower($this->uri->segment(2)) : 'index';
            if (array_key_exists($ctrl,$login_page_arr) && in_array($act, $login_page_arr[$ctrl]))
            {
                header('location:' . C('domain.base.url') . C('user_center.url.login'));
                exit;
            }
        }
        
        $this->data['about'] = $this->Mabout_us->get_one('*', array());
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
    public function return_success($data = array(),$msg = 'request is ok') {

        $this->return_json(
                array(
                    'status'=> C('status.success.value'),
                    'data'    => $data,
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
                'data'        => $data
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
        $this->benchmark->mark('start');//start clock....
        
        $api_url = $this->create_url($path);

        $response = $this->get_response($api_url,$data,$method,$cookie,$multi,$headers);
        
        if ($debug === true) {
            return $response;
        }else{
            $response = json_decode($response,true);
        }
        
        $this->benchmark->mark('end');//end clock....
        
        $this->log_message($api_url,$response);
        
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


    /**
     * 登录状态某些页面跳转到个人中心
     */
    public function login_redirect(){
         if(isset($this->data['user_info']))
        {
            redirect($this->data['domain']['base']['url'] .  C('user_center.url.user_center'));
            exit;
        }
    }

    /*
     * 没有登录跳转到登录页面
     */
    public function no_login_redirect(){
        if(empty($this->data['user_info']) || !isset($this->data['user_info'])){
            redirect($this->data['domain']['base']['url'] .  C('user_center.url.login'));
            exit;
        }
     }

    protected function get_seo_info(){
        //SEO信息
        $this->load->model(array(
                'Model_configes'   => 'Mconfiges'
        ));
        $web_info = $this->Mconfiges->get_lists('*');
        $seo_info = array();
        if ($web_info){
            foreach ($web_info as $key => $v){
                if ($v['key'] == 'seo_title'){
                    $seo_info['seo_title']   = $v['val'];
                }

                if ($v['key'] == 'web_name'){
                    $seo_info['web_name']   = $v['val'];
                }

                if ($v['key'] == 'web_sign'){
                    $seo_info['web_sign']   = $v['val'];
                }
                if ($v['key'] == 'seo_keywords'){
                    $seo_info['seo_keywords']   = $v['val'];
                }
                if ($v['key'] == 'seo_description'){
                    $seo_info['seo_description']   = $v['val'];
                }
            }
        }
        $this->data['seo'] = array(
                'title' => $seo_info['seo_title'],
                'keywords' => $seo_info['seo_keywords'],
                'description' => $seo_info['seo_description']
        );
    }


    protected function get_user_info($user_base_info){
        
        if(empty($user_base_info))
        {
            return FALSE;
        }
        
        $user_info['user_id'] = $user_base_info['id'];
        $user_info['phone_number'] = $user_base_info['mobile_phone'];
        $this->data['user_info'] = $user_info;
        
        $user_detail= $this->http_request('/user/info',['user_id'=>$user_base_info['id']]);
        if ($user_detail['status'] == C('status.success.value')) {
            if(!empty($user_detail['data']['user_info'])){
                $this->data['user_info'] = $user_detail['data']['user_info'];
            }
        }
    }

    /**
     * 创建并设置访问token
     * @ruturn return_type
     */
    public  function set_token(){
        if(!isset($_SESSION))
        {
            session_start();
        }
        $this->data['token'] = md5(time());
        $this->session->set_userdata(array('user_token'  => $this->data['token']));
    }

    /**
     * 检查是否是有效token
     * @param string $token
     * @throws Exception
     * @ruturn return_type
     */
    public function check_token($token = ''){
        if(!isset($_SESSION))
        {
            session_start();
        }
        if($token != $this->session->userdata('user_token')){
            return false;
        }
        return true;
    }

    /**
     * 销毁访问token
     * @ruturn return_type
     */
    public function unset_token(){
        if(!isset($_SESSION))
        {
            session_start();
        }
        if($this->session->has_userdata('user_token')){
            $this->session->unset_userdata('user_token');
        }
    }

    /**
     * 限制用户在一定时间不能重复点赞
     * @params id 评论ID
     */
    public  function set_token_dz($id = 0){
        $this->session->set_userdata(array('token_dz_'.$id  => md5($id)));
    }
    
    /**
     * 限制用户在一定时间不能重复对评论点赞
     * @params id 评论ID
     */
    public  function set_token_pdz($id = 0){
        $this->session->set_userdata(array('token_pdz_'.$id  => md5($id)));
    }

    /**
     * 检查是否是有效token
     * @param ID $token
     * @ruturn boolean
     */
    public function check_dz_token($id){
        $token_name = "token_dz_".$id;
        if($this->session->userdata($token_name)){
            return true;
        }
        return false;
    }
    
    /**
     * 检查是否是有效token
     * @param ID $token
     * @ruturn boolean
     */
    public function check_pdz_token($id){
        $token_name = "token_pdz_".$id;
        if($this->session->userdata($token_name)){
            return true;
        }
        return false;
    }

    
    /**
     * 限制用户在一定时间不能重复阅读
     * @params id 文章ID
     */
    public  function set_token_read($id = 0){
        $this->session->set_userdata(array('token_read_'.$id  => md5($id)));
    }
    
    /**
     * 检查是否是有效token
     * @param ID $token
     * @ruturn boolean
     */
    public function check_read_token($id){
        $token_name = "token_read_".$id;
        if($this->session->userdata($token_name)){
            return true;
        }
        return false;
    }
    
    /**
     * 限制用户在一定时间不能重复预约
     * @params 
     */
    public  function set_token_appoint(){
        $this->data['token_appoint'] = md5(time());
        $this->session->set_userdata(array('token_appoint'  => md5(time())));
    }
    
    
    
    /**
     * 从底层服务请求数据
     *
     * @param string $url
     * @param string $data
     * @param string $debug
     * @return boolean|Ambigous <>
     */
    public function get_from_api($url = '', $data = '', $debug = false){
        if(empty($url) && empty($data)){
            return false;
        }
        $result = $this->http_request($url, $data, $debug );
        if($debug)
        {
            echo $result;exit;
        }
        if($result['status'] == C('status.success.value')){
            return $result;
        }
        else{
            return false;
        }
    
    }
    
    /**
     * 接口日志记录（此方法只限于接口监控使用）
     * @author yuanxiaolin@global28.com
     * @param unknown $data
     * @ruturn return_type
     */
    private function log_message($url = '', $data = array()){

        //日志初始化参数
        $params = array(
            'path'=>C('log.api.path'),
            'level'=>C('log.api.level')
        );

        //日志开关
        if(C('log.api.enable') === false){
            return ;
        }

        //加载日志工具
        $this->load->library('Logfile',$params);

        //接口时差，单位为毫秒
        $cost_time = $this->benchmark->elapsed_time('start','end') * 1000;

        if(isset($data['status']))
        {
            if($data['status'] == C('status.success.value'))
            {
                //返回成功，记录info日志
                $return_data = 'success';
                $message = sprintf('%s | %s | %s | %s',$data['status'],$cost_time,$url,$return_data);
                $this->logfile->info($message);
            }
            else
            {
                //返回错误，记录error日志
                $return_data = json_encode($data);
                $message = sprintf('%s | %s | %s | %s',$data['status'],$cost_time,$url,$return_data);
                $this->logfile->error($message);
            }
        }
        else
        {
            //格式错误，或者http请求未到达，记录error日志
            $return_data = 'http request error';
            $message = sprintf('%s | %s | %s | %s',$data['status'],$cost_time,$url,$return_data);
            $this->logfile->error($message);
        }
    }
    
    /**
     * 从接口获取数据，根据情况判断从数据库获取还是从memcache获取
     * @param string $path 接口请求path
     * @param unknown $data get|post请求数据
     * @param string $debug 接口的debug模式， 为true将会把数据原包返回
     * @param string $method 请求方式，默认POST
     * @param unknown $cookie 接口请求的cookie信息，用于需要登陆验证的接口
     * @param unknown $multi 文件信息
     * @param unknown $headers 附加的头文件信息
     * @author mochaokai@global28.com
     */
    private function get_response($api_url,$data,$method,$cookie,$multi,$headers){
        $url = $this->get_url($api_url).json_encode($data);
        //判断客户端是否支持memcached和memcached开关是否打开，memcached开关在memcached配置文件中
        if(class_exists('memcached') && C('mymemcached.switch')){
            $this->load->library('Mymemcache');
            $response = Mymemcache::get($url);
            if(!$response){
                $response = Http::Request($api_url,$data,$method,$cookie,$multi,$headers);
                Mymemcache::set($url, $response, C('mymemcached.time'));
                $all_key_arr = Mymemcache::get(C('mymemcached.all_keys'));
                if(!$all_key_arr){
                    $all_key_arr = [];
                }
                if(!in_array($url, $all_key_arr)){
                    $all_key_arr[] = $url;
                    Mymemcache::set(C('mymemcached.all_keys'), $all_key_arr, C('mymemcached.time'));
                }
                return $response;
            }else{
                return $response;
            }
        }else{
            return Http::Request($api_url,$data,$method,$cookie,$multi,$headers);
        }
    }
    
    /**
     * 对memcache的键进行规范化处理
     * @author mochaokai@global28.com
     * @param string $url
     * @return string $str
     */
    private function get_url($url){
        $str = 'http://';
        foreach (explode('/', $url) as $k => $v){
            if(!empty($v) && $k > 0){
                $str .= $v.'/';
            }
        }
        return $str;
    }
    
    
    /**
     * 判断是否登录
     * @author songchi@gz-zc.cn
     */
    public function islogin(){
    
        $sess_data = $this->session->userdata('user');
        $cookie_data = $this->input->cookie('user');
        if(!$sess_data && !$cookie_data){
            return false;
        }else{
            return $sess_data;
        }
    }
    
    /**
     * 统计宾客数量、视频数量
     * @author chaokai@gz-zc.cn
     */
    protected function count(){
        //加载缓存驱动器
        $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
        if(!$count = $this->cache->get('count')){
            //1.统计已接待宾客数量：  guest_num
            $where = array('is_del' => 0, 'solar_time <' => date('Y-m-d'));
            //1.1.先计算桌数，然后按照每桌10人计算宾客数量
            $menus_counts = $this->Mdinner->get_one('sum(menus_count) as menus_counts', $where);
            $data['guest_num'] = $menus_counts['menus_counts'] *10;
            //2.已策划婚礼： wedding_num
            $data['wedding_num'] = $this->Mdinner->count(array_merge($where, array('venue_type' => C('party.wedding.id'))));
            //3.已拍摄微视频： guest_num
            $data['vedio_num'] = $this->Mdinner->count(array_merge($where, array('video !=' => '')));
    
            $this->cache->save('count', $data, 60*60*24);
        }else{
            $data = $count;
        }
        $this->data['guest_num'] = $data['guest_num'];
        $this->data['wedding_num'] = $data['wedding_num'];
        $this->data['vedio_num'] = $data['vedio_num'];
    }
    
    /**
     * 限制短信限制token
     *
     */
    public  function set_token_msg($tel = 0){
        $this->session->set_userdata(array('token_tel_'.$tel  => md5($tel)));
    }
    
    /**
     * 限制短信限制token
     *
     */
    public  function check_token_msg($tel = 0){
        $token_name = "token_tel_".$tel;
        if($this->session->userdata($token_name)){
            return true;
        }
        return false;
    }
    
}













