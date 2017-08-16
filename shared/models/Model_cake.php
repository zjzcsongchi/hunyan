<?php
/**
 * 蛋糕表
 * @author chaokai@gz-zc.cn
 */
class Model_cake extends MY_Model{
    
    private $_table = 't_cake';
    
    public function __construct(){
        parent::__construct($this->_table);
    }
    
    /**
     * 获取员工收到的蛋糕统计
     * @param $admin_ids string/array 员工id
     * @author chaokai@gz-zc.cn
     */
    public function count_cake($admin_ids, $order_by = array()){
        
        $where = array(
                        'is_del' => 0
        );
        if(is_array($admin_ids)){
            $where['in'] = array('admin_id' => $admin_ids);
        }else{
            $where['admin_id'] = $admin_ids;
        }
        
        $field = 'admin_id,sum(num) as all_num';
        
        
        $list = $this->get_lists($field, $where, $order_by, 0, 0, 'admin_id');
        
        return $list;
    }
}