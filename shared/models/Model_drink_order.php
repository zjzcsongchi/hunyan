<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 订单
 * 
 * @author yonghua
 *
 */
class Model_drink_order extends MY_Model {

    private $_table = 't_drink_order';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}