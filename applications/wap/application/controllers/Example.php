<?php
/**
 * h5
 * @author chaokai@gz-zc.cn
 */
class Example extends MY_Controller{
    
    public function __construct(){
        
        parent::__construct();
        
    }
    
    //丹江口案例
    public function index(){
        
        $this->load->view('example/index', $this->data);
    }
    
    //茶旅贵州案例
    public function index2(){
    
        $this->load->view('example/index2', $this->data);
    }

    //贵阳公安微课程
    public function index3(){

    	$this->load->view('example/index3', $this->data);
    }

    //贵阳市公安局
    public function index4(){
    	
    	$this->load->view('example/index4', $this->data);
    }
}
