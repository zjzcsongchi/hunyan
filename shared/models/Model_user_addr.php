<?php
/**
 * 用户地址表
 * 
 */
class Model_user_addr extends MY_Model{
    
    private $_table;
    
    public function __construct(){
        $this->_table = 't_user_addr';
        
        parent::__construct($this->_table);
    }
}