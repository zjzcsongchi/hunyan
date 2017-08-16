<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 电子相册页面元素model
 * 
 * @author songchi
 *
 */

class Model_elements extends MY_Model {

    private $_table = 't_elements';

    public function __construct() {
        parent::__construct($this->_table);
    }
    

}