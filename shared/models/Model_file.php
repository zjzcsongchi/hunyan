<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_file extends MY_Model {

    private $_table = 't_file';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}