<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 酒水model
 * 
 * @author huangjialin
 *
 */
class Model_drink_appoint_order extends MY_Model {

    private $_table = 't_drink_appoint_order';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}