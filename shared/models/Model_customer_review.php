<?php 
/**
 * 客户回访
 */
class Model_customer_review extends MY_Model{
    
    private $_table = 't_customer_review';
    
    public function __construct(){
        parent::__construct($this->_table);
        
        $this->load->model(array(
                        'Model_admins' => 'Madmins',
                        'Model_customer' => 'Mcustomer'
        ));
    }
    
    /**
     * 回访列表
     * @author chaokai@gz-zc.cn
     */
    public function lists($user_id){
        $where = array('is_del' => 0, 'customer_id' => $user_id);
        
        $list = $this->get_lists('*', $where);
        if(!$list){
            return false;
        }
        
        //查询客户信息
        $customer_ids = array_column($list, 'customer_id');
        $customer_field = 'id,name';
        $customer_where = array('in' => array('id' => $customer_ids));
        $customer_list = $this->Mcustomer->get_lists($customer_field, $customer_where);
        
        foreach ($list as $k => $v){
            foreach ($customer_list as $key => $value){
                if($v['customer_id'] == $value['id']){
                    $list[$k]['customer_name'] = $value['name'];
                    break;
                }
            }
        }
        
        //查询管理员信息
        $create_ids = array_column($list, 'create_admin');
        $update_ids = array_column($list, 'update_admin');
        
        $admin_ids = array_unique(array_merge($create_ids, $update_ids));
        $admin_where = array('in' => array('id' => $admin_ids));
        $admin_field = 'id,fullname';
        $admin_list = $this->Madmins->get_lists($admin_field, $admin_where);
        
        foreach ($list as $k => $v){
            foreach ($admin_list as $key => $value){
                if($v['create_admin'] == $value['id']){
                    $list[$k]['create_admin_name'] = $value['fullname'];
                }
                if($v['update_admin'] == $value['id']){
                    $list[$k]['update_admin_name'] = $value['fullname'];
                }
            }
        }
        
        return $list;
    }
}