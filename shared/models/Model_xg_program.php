<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_xg_program extends MY_Model {

    private $_table = 't_xg_program';
    private $program;

    public function __construct() {
        parent::__construct($this->_table);
        
        $this->program = array_column(C('program_name'), 'name', 'id');
    }
    
    /**
     * 获取某个报名人员报名节目信息
     * @param $user_id int 报名人员id
     * @author chaokai@gz-zc.cn
     */
    public function lists($user_id){
        
        $list = $this->get_lists('*', array('xg_user_id' => $user_id));
        
        if(!$list){
            return false;
        }
        foreach($list as $k => $v){
            $list[$k]['program_type_text'] = $this->program[$v['program_type']];
        }
        return $list;
    }
   
}