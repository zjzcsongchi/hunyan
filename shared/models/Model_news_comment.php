<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 祝福model
 * 
 * @author songchi
 *
 */
class Model_news_comment extends MY_Model {

    private $_table = 't_news_comment';

    public function __construct() {
        parent::__construct($this->_table);
    }
}