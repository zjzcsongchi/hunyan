<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_tel_verify extends MY_Model {

    private $_table = 't_tel_verify';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
   /**
    * 获取手机对应的验证码
    * 
    * @return array
    */
   public function get_verify_by_tel($mobile){
        $verify_info = array();
        if (! $mobile){
            return $verify_info;
        }
        
        $field = array('id', 'phone_number', 'code', 'add_time');
        $verify_info = $this->get_one($field, array('phone_number'=>$mobile));
        
        return $verify_info;
       
   }
   
   
   
}