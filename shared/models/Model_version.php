<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_version extends MY_Model {

    private $_table = 't_version';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}