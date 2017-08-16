<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 宴会额外服务model
 * 
 * @author louhang
 *
 */
class Model_dinner_extra_service extends MY_Model {

    private $_table = 't_dinner_extra_service';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}