<?php
/**
 * 员工履历记录表
 * @author chaokai@gz-zc.cn
 */
class Model_admin_resume extends MY_Model{
    
    private $_table = 't_admin_resume';
    private $resume_type;
    
    public function __construct(){
        parent::__construct($this->_table);
        
        $this->resume_type = array_column(C('resume.type'), 'name', 'id');
    }
    
    /**
     * 根据员工id获取员工履历记录
     * @author chaokai@gz-zc.cn
     */
    public function get_resume($admin_id){
        
        $where = array(
                        'admin_id' => $admin_id,
                        'is_del' => 0
        );
        $field = <<<'EOD'
                id,admin_id,resume_type,title,
                content,remark,occur_time
EOD;
                
        $order_by = array(
                        'occur_time' => 'desc'
        );
        $list = $this->get_lists($field, $where, $order_by);
        
        foreach ($list as $k => $v){
            $list[$k]['resume_type_text'] = $this->resume_type[$v['resume_type']];
        }
        
        return $list;
    }
}