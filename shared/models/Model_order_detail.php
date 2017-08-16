<?php
/**
 * 商品
 */
class Model_order_detail extends MY_Model {
    
    private $_table;
    public function __construct(){
        $this->_table = 't_order_detail';
        
        parent::__construct($this->_table);
    }
}