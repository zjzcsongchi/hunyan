<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 音乐库model
 * 
 * @author songchi
 *
 */
class Model_music extends MY_Model {

    private $_table = 't_music';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
}