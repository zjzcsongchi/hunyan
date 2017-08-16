<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_products extends MY_Model {

    private $_table = 't_products';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}