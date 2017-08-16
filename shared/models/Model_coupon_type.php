<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_coupon_type extends MY_Model {

    private $_table = 't_coupon_type';

    public function __construct() {
        parent::__construct($this->_table);
    }    
}