<?php
/**
 * 客户表
 * @author chaokai@gz-zc.cn
 */
class Model_callback extends MY_Model{
    
    private $_table = 't_callback';
    
    public function __construct(){
        
        parent::__construct($this->_table);
    }
}