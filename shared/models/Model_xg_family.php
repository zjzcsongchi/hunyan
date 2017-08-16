<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_xg_family extends MY_Model {

    private $_table = 't_xg_family';

    public function __construct() {
        parent::__construct($this->_table);
    }
    
    
    /**
     * 获取报名人员家庭成员信息
     * @param $user_id int 用户id
     * @author chaokai@gz-zc.cn
     */
    public function lists($user_id){
        
        $list = $this->get_lists('*', array('xg_user_id' => $user_id));
        
        return $list;
    }
  
}