<?php 
/**
 * 菜品详情
 * @author chaokai@gz-zc.cn
 */
class Model_dinner_detail extends MY_Model{
    
    private $_table = 't_dinner_detail';
    
    public function __construct(){
        parent::__construct($this->_table);
    }
}