<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_admins_purview extends MY_Model {

    private $_table = 't_admins_purview';

    public function __construct() {
        parent::__construct($this->_table);
    }

    /*
    * 获得子权限
    * nengfu@gz-zc.cn
    */
    public function get_child($parent_id = 0){
       return $this->get_one("id,name",array("parent_id"=>$parent_id));
    }

    #获得子权限
    public function get_urls($purview_ids = ""){

        if(!$purview_ids){
            return '';
        }else{
            $where['in'] = array("id"=>$purview_ids);
          return  $this->get_lists("id,url",$where);

        }

    }

    /*
     * 获得所有
     * nengfu@gz-zc.cn
     */
    public function get_all(){
       return $this->get_lists("*","",array("sort"=>"asc","id"=>'asc'));
    }

    /*
     * 根据组获得的权限获取对应菜单
     * nengfu@gz-zc.cn
     */
    public function get_group_purview($purview_ids = array()){
        if($purview_ids){
            $where['in'] = array("id"=>$purview_ids);
        }else{
            $where = "";
        }
        return $this->get_lists("*",$where,array("sort"=>"asc","id"=>'asc'));
    }


}