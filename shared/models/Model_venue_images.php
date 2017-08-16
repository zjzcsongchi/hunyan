<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_venue_images extends MY_Model {

    private $_table = 't_venue_images';

    public function __construct() {
        parent::__construct($this->_table);
    }    
}