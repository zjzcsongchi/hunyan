<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_wap_urls extends MY_Model {

    private $_table = 't_wap_urls';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}