<?php
/**
 * h5
 * @author chaokai@gz-zc.cn
 */
class H5 extends MY_Controller{
    
    public function __construct(){
        
        parent::__construct();
        
    }
    
    public function index(){
        
        $this->load->view('h5/index', $this->data);
    }
}
