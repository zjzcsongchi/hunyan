<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 手工内容model
 * 
 * @author huangjialin
 *
 */
class Model_manual extends MY_Model {

    private $_table = 't_manual';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
    
}