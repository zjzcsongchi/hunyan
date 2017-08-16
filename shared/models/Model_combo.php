<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_combo extends MY_Model {

    private $_table = 't_combo';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    /**
     * 查询菜品列表
     * @author chaokai@gz-zc.cn
     */
    public function lists($where = array(), $pagesize = 0, $offset = 0, $orderby = array()){
        $default_where = array('is_del' => 0);
        $where = array_merge($default_where, $where);
        $field = 'id,combo_name,relevance_id';
    
        $list = $this->get_lists($field, $where, $orderby, $pagesize, $offset);
    
        return $list;
    }
}