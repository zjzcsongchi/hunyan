<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_album_image extends MY_Model {

    private $_table = 't_album_image';

    public function __construct() {
        parent::__construct($this->_table);
    }    

}