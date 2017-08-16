<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 手工分类model
 * 
 * @author huangjialin
 *
 */
class Model_customer_case extends MY_Model {

    private $_table = 't_customer_case';

    public function __construct() {
        parent::__construct($this->_table);
    }

    
}