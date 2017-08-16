<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_specifications extends MY_Model {

    private $_table = 't_specifications';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}