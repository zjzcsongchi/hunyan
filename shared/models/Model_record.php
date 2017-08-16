<?php
/**
 * 婚礼档案
 */
class Model_record extends MY_Model{
    private $_table = 't_record';

    public function __construct(){

        parent::__construct($this->_table);
    }
}