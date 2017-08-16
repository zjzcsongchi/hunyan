<?php 
/**
* 首页控制器
* @author jianming@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends MY_Controller{

    public function __construct(){
        parent::__construct();
    }

    #主页面
    public function index(){

        $this->load->view("home/home");
    }



}

