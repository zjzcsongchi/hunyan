<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_user_extend extends MY_Model {

    private $_table = 't_user_extend';

    public function __construct() {
        parent::__construct($this->_table);
    }

    /*
     * 用户的用户名
     */
    
}