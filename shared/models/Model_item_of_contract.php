<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 百年婚宴条款model
 * 
 * @author louhang
 *
 */
class Model_item_of_contract extends MY_Model {

    private $_table = 't_item_of_contract';

    public function __construct() {
        parent::__construct($this->_table);
    }

}