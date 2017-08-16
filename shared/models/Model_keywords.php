<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 关键字model
 * 
 * @author jianming@gz-zc.cn
 *
 */
class Model_keywords extends MY_Model {

    private $_table = 't_keywords';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
    
}