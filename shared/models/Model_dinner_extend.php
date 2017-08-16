<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 宴会拓展信息model
 * 
 * @author louhang
 *
 */
class Model_dinner_extend extends MY_Model {

    private $_table = 't_dinner_extend';

    public function __construct() {
        parent::__construct($this->_table);
    }

    /**
     * 获取司仪信息
     * @author fengyi@gz-zc.cn
     */
    public function get_mc_info_by_dinner_ids($ids) {
        if (!$ids) { 
            return false;
        }
        $field = 'dinner_id,is_need,remark';
        $where = array(
            'in' => array('dinner_id' => $ids),
            'type' => C('dinner_extend.mc.id'),
        );
        $lists = $this->get_lists($field,$where);
        return $lists;
    }
    
}