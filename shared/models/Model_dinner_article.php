<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Model_dinner_article extends MY_Model {

    private $_table = 't_dinner_article';

    public function __construct() {
        parent::__construct($this->_table);

    }
}