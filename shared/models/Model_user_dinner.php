<?php 
/**

 * 用户账号与宴会关联表
 */
class Model_user_dinner extends MY_Model{
    
    private $_table = 't_user_dinner';
    
    public function __construct(){
        
        parent::__construct($this->_table);
    }
}