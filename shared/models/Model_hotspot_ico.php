<?php
/**
 * 热点图标管理表
 * @author fengyi@gz-zc.cn
 */

class Model_hotspot_ico extends MY_Model {
    private $_table = 't_hotspot_ico';

    public function __construct() {
        parent::__construct($this->_table);
        $this->load->model([
        
        ]);
    }

 /*
    public function get_all($where = [], $ordey_by = [], $size = 0, $offset = 0) {
        $field = 'id,url,dynamic_url,is_dynamic,is_default,type,create_admin,create_time,update_admin,update_time';
        $where = ['is_del' => 1];
        $order_by = ['update_time' => 'desc'];
        $lists = $this->get_lists($field, $where, $order_by);
        return $lists;
    }

  */
}
