<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 电子相册model
 * 
 * @author songchi
 *
 */

class Model_template extends MY_Model {

    private $_table = 't_template';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}