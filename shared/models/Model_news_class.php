<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_news_class extends MY_Model {

    private $_table = 't_news_class';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    /**
     * 根据id列表获取分类名称
     * @param $ids array id数组
     * @author chaokai@gz-zc.cn
     */
    public function classes($ids){
        $where = array('in' => array('id' => $ids));
        
        $list = $this->get_lists('id,name', $where);
        
        return $list;
    }
}