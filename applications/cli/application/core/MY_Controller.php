<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
   
	public $data = array();
    public function __construct() {
        parent::__construct();
        
        if(!is_cli()){
            show_404();
        }
        
    }
   
    

}













