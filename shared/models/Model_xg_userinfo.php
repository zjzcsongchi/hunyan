<?php
/**
 * 星光大道报名人员信息
 * @author chaokai@gz-zc.cn
 */
class Model_xg_userinfo extends MY_Model{
    
    private $_table = 't_xg_userinfo';
    
    private $sex,$political_status,$marry_status,$auth_status;
    
    public function __construct(){
        
        parent::__construct($this->_table);
        
        $this->sex = array(0 => '女', 1 => '男');
        $this->political_status = array_column(C('political_status'), 'name', 'id');
        $this->marry_status = array_column(C('marry_status'), 'name', 'id');
        $this->auth_status = array(0 => '未审核', 1 => '审核通过', 2 => '审核失败');
        
        $this->load->model(array(
                        'Model_xg_family' => 'Mxg_family',
                        'Model_xg_otherinfo' => 'Mxg_otherinfo',
                        'Model_xg_program' => 'Mxg_program',
        ));
    }
    
    /**
     * 人员列表、
     * @param $where array 查询条件
     * @param $pagesize int 分页大小
     * @param $offset int 分页起始页
     * @author chaokai@gz-zc.cn
     */
    public function lists($where = array(), $pagesize = 0, $offset = 0){
        
        $default_where = array('is_del' => 0);
        $where = array_merge($where, $default_where);
        $field = 'id,realname,sex,nation,birthday,political_status,marry_status,native_place,mobile_phone,auth_status,create_time';
        $order_by = array('auth_status' => 'asc', 'create_time' => 'asc');
        
        $list = $this->get_lists($field, $where, $order_by, $pagesize, $offset);
        
        foreach ($list as $k => $v){
            $list[$k]['sex_text'] = $this->sex[$v['sex']];
            $list[$k]['political_status_text'] = $this->political_status[$v['political_status']];
            $list[$k]['marry_status_text'] = $this->marry_status[$v['marry_status']];
            $list[$k]['auth_status_text'] = $this->auth_status[$v['auth_status']];
        }
        
        return $list;
    }
    
    /**
     * 查询所有详情信息
     * @param $id int 报名人员信息表id
     * @author chaokai@gz-zc.cn
     */
    public function info($id){
        
        $where = array('id' => $id);
        $info = $this->get_one('*', $where);
        if(!$info){
            return false;
        }
        
        $info['sex_text'] = $this->sex[$info['sex']];
        $info['political_status_text'] = $this->political_status[$info['political_status']];
        $info['marry_status_text'] = $this->marry_status[$info['marry_status']];
        $info['auth_status_text'] = $this->auth_status[$info['auth_status']];
        $info['profile_url'] = get_img_url($info['profile']);
        //家庭成员信息
        $home_info = $this->Mxg_family->lists($info['id']);
        $info['family'] = $home_info;
        
        //参加节目信息
        $program_info = $this->Mxg_program->lists($info['id']);
        $info['program'] = $program_info;
        
        //其他信息
        $other_info = $this->Mxg_otherinfo->get_one('*', array('xg_user_id' => $info['id']));
        $info['otherinfo'] = $other_info;
        
        return $info;
    }
}