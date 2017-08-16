<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_admins_dinner_examined extends MY_Model {
    
    private $_table = 't_admins_dinner_examined';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}