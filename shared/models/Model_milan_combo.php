<?php
/**
 * 客户表
 * @author yonghua@gz-zc.cn
 */
class Model_milan_combo extends MY_Model{
    
    private $_table = 't_milan_combo';
    
    public function __construct(){
        
        parent::__construct($this->_table);
    }
}