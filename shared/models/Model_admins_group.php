<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_admins_group extends MY_Model {

    private $_table = 't_admins_group';

    public function __construct() {
        parent::__construct($this->_table);
    }

    #判断用户是否存在
    public function isExist($name, $id=''){


    }


    #获得分组
    public function getList($role_type = 0){

        return $this->get_lists("id,name",array("is_del"=>1, 'role_type' => $role_type));
    }

    #获得所有管理员
    public function getAll(){
        return $this->get_list("*",array("is_del"=>1));
    }


    //获取某分组信息
    public function get_group_info($id = 0){

        if (! $id){
            return  false;
        }

        $where  = array('is_del'=>1, 'id' =>$id);
        return $this->get_one("*",$where);
    }
    
}