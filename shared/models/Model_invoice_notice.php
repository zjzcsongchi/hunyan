<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 发票须知签字表
 * @author Administrator
 *
 */
class Model_invoice_notice extends MY_Model {

    private $_table = 't_invoice_notice';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}