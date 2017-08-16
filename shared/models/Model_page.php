<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 电子相册页面model
 * 
 * @author songchi
 *
 */

class Model_page extends MY_Model {

    private $_table = 't_page';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}