<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 婚宴点赞model
 * 
 * 
 *
 */
class Model_dinner_zan extends MY_Model {

    private $_table = 't_dinner_zan';

    public function __construct() {
        parent::__construct($this->_table);
    }
}