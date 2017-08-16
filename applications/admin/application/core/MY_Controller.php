<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = array();
    public $pageconfig = array();
    public $isPost = false;
    public $isGet = false;

    public function __construct() {
        parent::__construct();
        //session_start();
        $this->load->library('session');
        $this->data['domain'] = C('domain');
        //解决swfupload上传不传session问题
        $url = strtolower($this->uri->segment(1)); //控制器
        if($url == 'file'){
            return;
        }

        $_GET = xss_clean($_GET);
        $_POST = xss_clean($_POST);

        $this->data['action'] = $this->uri->segment(1);
       
        //不需要登录的页面，不用进行权限判断
        if(!$this->is_no_login()){
        
            if(@$this->session->userdata('USER')){
                 
                $this->data['userInfo'] = $this->session->userdata('USER');
            }else{
                $controller = strtolower($this->uri->segment(1)); //控制器
                $method =  $this->uri->segment(2) ? strtolower($this->uri->segment(2)) : ''; //方法
                
                $url =  $controller.'/'.$method;
                
                if (in_array($url, C('login_back_list'))) {
                    $_SESSION['return_url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                }

                header('location:' . C('domain.admin.url') .'/login');
                exit;
            }
        
            /*
             * 权限判断pur_code -1没有权限 -0 有权限
             */
            $pur_view_info =  $this->check_purview();
            if($this->input->is_ajax_request()){
                $this->data['pur_code'] = $pur_view_info['pur_code'];
            }
            else{
                if($pur_view_info['pur_code'] == 1){
                    $this->error("你没有权限");
                }
            }
        }


    }



    /*
     * 权限检验
     * nengfu@gz-zc.cn
     */
    public function check_purview(){

        #获得路径
        $action =  $this->uri->segment(2) ? strtolower($this->uri->segment(2)) : ''; //方法
        $url = strtolower($this->uri->segment(1)); //控制器

        //登录状态下控制器为空处理
        if($url === ''){
            $url = $this->router->default_controller;
        }
        
        if($action=='return_url')
            $action = '';

        if($action!=='index')
        {
            $url .= '/'.$action;
        }
        $url = trim(trim($url,'/'));

        #登陆前 不需要权限的页面
        if(in_array($url,C('public_page.public_page_no_login')))
        {
            return array("msg"=>'','pur_code'=>0);

        }

        #超级管理员有所有权限
        if($_SESSION['USER']['id']==1)
        {
            return array("msg"=>'','pur_code'=>0);
        }

         #登陆后 不需要权限的页面
        if(in_array($url,C('public_page.public_page')))
        {
             return array("msg"=>'','pur_code'=>0);
        }

        #判断权限
        if(!in_array($url,$_SESSION['USER']['purview_url']))
        {
            return array("msg"=>'抱歉，您没有此操作权限','pur_code'=>1);
        }
    }
    
    /*
     * 登录检验
     * nengfu@gz-zc.cn
     */
    public function is_no_login(){
    
        #获得路径
        $action =  $this->uri->segment(2) ? strtolower($this->uri->segment(2)) : ''; //方法
        $url = strtolower($this->uri->segment(1)); //控制器
    
        //登录状态下控制器为空处理
        if($url === ''){
            $url = $this->router->default_controller;
        }
    
        if($action=='return_url')
            $action = '';
    
        if($action!=='index')
        {
            $url .= '/'.$action;
        }
        $url = trim(trim($url,'/'));
    
        if(in_array($url,C('public_page.public_page_no_login')))
        {
            return true;
        }
    
        return false;
    
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
        if(isset($this->data['userInfo']))
        {
            redirect($this->data['domain']['base']['url'] .  C('user_center.url.user_center'));
            exit;
        }
    }


    /**
     * 创建并设置访问token
     * @author yuanxiaolin@global28.com
     * @ruturn return_type
     */
    public  function set_token(){
        session_start();
        $this->data['token'] = md5(time());
        $_SESSION['user_token'] = $this->data['token'];
    }

    /**
     * 检查是否是有效token
     * @author yuanxiaolin@global28.com
     * @param string $token
     * @throws Exception
     * @ruturn return_type
     */
    public function check_token($token = ''){
        session_start();
        if($token != $_SESSION['user_token']){
            return false;
        }
        return true;
    }

    /**
     * 销毁访问token
     * @author yuanxiaolin@global28.com
     * @ruturn return_type
     */
    public function unset_token(){
        session_start();
        if(!empty($_SESSION['user_token'])){
            unset($_SESSION['user_token']);
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

        
        $this->data['domain'] = C('domain');

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
     * nengfu@gz-zc.cn
     * 操作错误跳转
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     */
    public function error($message='',$jumpUrl='') {
        if(is_array($message))
        {
            $message = implode('<br>',$message);
        }
        $this->dispatchJump($message,0,$jumpUrl);
    }


    /**
     * nengfu@gz-zc.cn
     * 操作成功跳转
     * @param string $message 错误信息
     * @param string $jumpUrl 页面跳转地址
     */
    public function success($message='',$jumpUrl='') {
        $this->dispatchJump($message,1,$jumpUrl);
    }

    /**
     * nengfu@gz-zc.cn
     * 默认跳转操作 支持错误导向和正确跳转
    * @param string $message 提示信息
     * @param Boolean $status 状态
     * @param string $jumpUrl 页面跳转地址
     * @access private
     * @return void
     */
    private function dispatchJump($message,$status=1,$jumpUrl='') {
        // 提示标题
       if($status) { //发送成功信息
            $data['message'] = $message ? $message : "操作成功";
            // 成功操作后默认停留1秒
             $data['waitSecond'] = 2 ;
            // 默认操作成功自动返回操作前页面
               if($jumpUrl){
                   $data['jumpUrl'] = $jumpUrl;
               }else{
                   $data['jumpUrl'] = $_SERVER["HTTP_REFERER"];
               }

             $this->load->view("common/msg",$data);
             $this->output->_display();
             die();
        }else{
             $data['message'] = $message ? $message : "操作失败";
            //发生错误时候默认停留3秒
             $data['waitSecond'] = 3;
            // 默认发生错误的话自动返回上页

             $data['jumpUrl'] = "javascript:history.back(-1);";
             $this->load->view("common/msg",$data);
             $this->output->_display();
             die();
        }
    }
}













