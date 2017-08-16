<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 祝福model
 * 
 * @author songchi
 *
 */
class Model_following_shot extends MY_Model {

    private $_table = 't_following_shot';

    public function __construct() {
        parent::__construct($this->_table);
    }

}