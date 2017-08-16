<?php

/**
 * access_token存储表
 * @author chaokai@gz-zc.cn
 */
class Model_access_token extends MY_Model{
    
    private $_table = 't_access_token';
    
    public function __construct(){
        
        parent::__construct($this->_table);
    }
}