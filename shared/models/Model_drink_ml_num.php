<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 酒水规格model
 * 
 * @author huangjialin
 *
 */
class Model_drink_ml_num extends MY_Model {

    private $_table = 't_drink_ml_num';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}