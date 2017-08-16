<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 祝福语点赞model
 *
 *
 *
*/
class Model_bless_zan extends MY_Model {

    private $_table = 't_bless_zan';

    public function __construct() {
        parent::__construct($this->_table);
    }
}