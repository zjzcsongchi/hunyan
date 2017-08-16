<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 米兰执行单Model
 */
class Model_milan_execute extends MY_Model {

    private $_table = 't_milan_execute';

    public function __construct() {
        parent::__construct($this->_table);
    }

    
}