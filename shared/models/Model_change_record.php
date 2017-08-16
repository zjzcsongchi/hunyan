<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * 宴会变更记录model
 * 
 * @author louhang
 *
 */

class Model_change_record extends MY_Model {

    private $_table = 't_change_record';

    public function __construct() {
        parent::__construct($this->_table);
    }
}