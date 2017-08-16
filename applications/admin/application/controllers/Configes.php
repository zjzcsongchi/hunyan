<?php 
    /**
    * 系统配置控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Configes extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_configes' => 'Mconfiges',
        ]);
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $post = $this->input->post();
        //保存数据
        if($post){
            $update = $this->Mconfiges->set($post);
            $this->success("操作成功！！");
        }
        //获取所有配置信息
        $info = $this->Mconfiges->get_all();
        if($info){
            $data['list'] = $info;
        }
        $this->load->view("configes/index", $data);
    }
    
}
