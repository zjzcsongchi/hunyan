<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 手工分类model
 * 
 * @author huangjialin
 *
 */
class Model_pay_status extends MY_Model {

    private $_table = 't_pay_status';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}