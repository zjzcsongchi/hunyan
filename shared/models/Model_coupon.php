<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_coupon extends MY_Model {

    private $_table = 't_coupon';

    public function __construct() {
        parent::__construct($this->_table);
    }    
}