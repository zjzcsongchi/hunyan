<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 活动类类model
 * 
 * @author songchi
 *
 */
class Model_activity extends MY_Model {

    private $_table = 't_activity';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}