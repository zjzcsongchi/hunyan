<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 祝福model
 * 
 * @author songchi
 *
 */
class Model_bless_comment extends MY_Model {

    private $_table = 't_bless_comment';

    public function __construct() {
        parent::__construct($this->_table);
    }
}