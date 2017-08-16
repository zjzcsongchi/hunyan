<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Model_class_item_contract extends MY_Model {

    private $_table = 't_class_item_contract';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}