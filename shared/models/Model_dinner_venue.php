<?php

/**
 * 客户场馆对应表
 * @author chaokai@gz-zc.cn
 */
class Model_dinner_venue extends MY_Model{
    
    private $_table = 't_dinner_venue';
    
    public function __construct(){
        
        parent::__construct($this->_table);
    }
}