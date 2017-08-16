<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 投票候选人类model
 * 
 * @author songchi
 *
 */
class Model_candidate extends MY_Model {

    private $_table = 't_candidate';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
}