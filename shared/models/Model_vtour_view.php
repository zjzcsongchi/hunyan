<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_vtour_view extends MY_Model {

    private $_table = 't_vtour_view';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}