<?php
/**
 * 场景表
 * @author chaokai@gz-zc.cn
 */
class Model_vtour_scene extends MY_Model{
    
    private $_table = 't_vtour_scene';
    
    public function __construct(){
        parent::__construct($this->_table);
    }
    
    /**
     * 根据id数组查询场景列表
     * @author chaokai@gz-zc.cn
     */
    public function lists($ids = []){
        if(empty($ids)){
            return false;
        }
        
        $field = 'id,name,thumb_img';
        $where['in'] = array(
                        'id' => $ids
        );
        return $this->get_lists($field, $where);
        
    }

}
