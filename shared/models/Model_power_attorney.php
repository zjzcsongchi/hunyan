<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 个人委托书签字表
 * @author Administrator
 *
 */
class Model_power_attorney extends MY_Model {

    private $_table = 't_power_attorney';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}