<?php
/**
 * 客户表
 * @author chaokai@gz-zc.cn
 */
class Model_customer extends MY_Model{
    
    private $_table = 't_customer';
    
    public function __construct(){
        
        parent::__construct($this->_table);
        
        $this->load->model(array(
                        'Model_admins' => 'Madmins',
        ));
    }
    
    /**
     * 客户列表
     */
    public function lists($where = array(), $order_by = array(), $pagesize = 10, $offset = 0){
        $default_where = array('is_del' => 0);
        
        $where = array_merge($default_where, $where);
        
        $field = 'id,name,mobile_phone,is_order_customer,dinner_time,order_time,dinner_type,receive_admin,remark, menus_count, source, venue_id';
        
        $list = $this->get_lists($field, $where, $order_by, $pagesize, $offset);
        
        if(empty($list)){
            return false;
        }
        //接单员信息
        $admin_ids = array_unique(array_column($list, 'receive_admin'));
        $admins = $this->Madmins->get_lists('id,name,fullname', array('in' => array('id' => $admin_ids)));
        //宴会类型
        $dinner_type = C('party');
        foreach($list as $k => $v){
            foreach ($admins as $key => $value){
                if($value['id'] == $v['receive_admin']){
                    if(!empty($value['name'])){
                        $list[$k]['receive_admin_name'] = $value['name'];
                        break;
                    }else{
                        $list[$k]['receive_admin_name'] = $value['fullname'];
                        break;
                    }
                    
                }
            }
            
            foreach ($dinner_type as $key => $value){
                if($value['id'] == $v['dinner_type']){
                    $list[$k]['dinner_type_name'] = $value['name'];
                    break;
                }
            }
            
            if($v['is_order_customer']){
                $list[$k]['is_order_customer_name'] = '是';
            }else{
                $list[$k]['is_order_customer_name'] = '否';
            }
        }
        
        return $list;
    }
    
    /**
     * 客户详情
     * @author chaokai@gz-zc.cn
     */
    public function info($id){
        $where = array('id' => $id);
        
        $field = 'id,name,mobile_phone,dinner_type,menus_count,receive_admin,remark,order_time,dinner_time,address,is_order_customer,receive_admin,venue_id';
        
        $info = $this->get_one($field, $where);
        
        return $info;
    }
    
    /**
     * 客户信息及预约详情
     * @author chaokai@gz-zc.cn
     */
    public function detail_info($id){
        $info = $this->info($id);
        
        if(!$info){
            return false;
        }
        
        //宴会类型
        if($info['dinner_type']){
            $dinner_type = array_column(C('party'), 'name', 'id');
            $info['dinner_type_name'] = $dinner_type[$info['dinner_type']];
        }
        
        //宴会场馆
        if($info['venue_id']){
            $venue = $this->Mvenue->get_one('name', array('id' => $info['venue_id']));
            $info['venue_name'] = $venue['name'];
        }
        //接单员
        if($info['receive_admin']){
            $admins = $this->Madmins->get_one('fullname', array('id' => $info['receive_admin']));
            $admins && $info['receive_admin_name'] = $admins['fullname'];
        }
        
        return $info;
    }
}