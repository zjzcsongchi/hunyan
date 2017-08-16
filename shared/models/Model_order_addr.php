<?php
/**
 * 订单收货地址
 */
class Model_order_addr extends MY_Model {
    
    private $_table;
    public function __construct(){
        $this->_table = 't_order_addr';
        
        parent::__construct($this->_table);
    }
}