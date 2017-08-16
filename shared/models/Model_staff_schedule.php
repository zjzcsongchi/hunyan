<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 米兰国际人员档期 Model
 * @author songchi
 *
 */
class Model_staff_schedule extends MY_Model {

    private $_table = 't_staff_schedule';

    public function __construct() {
        parent::__construct($this->_table);
    }

}