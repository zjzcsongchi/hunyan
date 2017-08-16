<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 鲜花赠送 model

 */
class Model_flower extends MY_Model {

    private $_table = 't_flower';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
   
}