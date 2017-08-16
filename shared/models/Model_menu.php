<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 米兰订单model
 * 
 * @author songchi
 *
 */
class Model_menu extends MY_Model {

    private $_table = 't_menu';

    public function __construct() {
        parent::__construct($this->_table);
        $this->load->model(array(
            'Model_user' => 'Muser',
            'Model_dinner_detail' => 'Mdinner_detail',
            'Model_venue' => 'Mvenue',
            'Model_customer' => 'Mcustomer',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_admins' => 'Madmins',
            'Model_theme' => 'Mtheme',
            'Model_milan_combo' => 'Mmilan_combo',
            'Model_staff_schedule' => 'Mstaff_schedule',
        ));
    }
    
    
    /**
     * 获取近三年每个月的订单数量
     * @author songchi@gz-zc.cn
     */
    public function get_count(){
    
        $field = 'solar_time';
        $year = date('Y');
        $where = array(
            'is_del' => 0,
            'solar_time >=' => ($year - 1) . '-01-01',
            'solar_time <=' => ($year + 1) . '12-31'
        );
        $list = $this->get_lists($field, $where);
    
        $result = array();
        foreach($list as $k => $v)
        {
            $date = date('Ym', strtotime($v['solar_time']));
    
            if(isset($result[$date]))
            {
                $result[$date] ++;
            }
            else
            {
                $result[$date] = 1;
            }
        }
    
        return $result;
    
    }
    
    /**
     * 获取订单列表
     * @author songchi@gz-zc.cn
     */
    public function get_menu_list($year, $month){
    
        $this->load->helper('date');
        $days = days_in_month($month, $year);
        // 获取预约数据
        $where = array(
            'is_del' => 0,
            'solar_time >=' => $year . '-' . $month . '-01',
            'solar_time <=' => $year . '-' . $month . '-' . $days
        );
        $list = $this->Mmenu->get_lists("*", $where,['solar_time' => 'asc']);
        
        if(! $list)
        {
            return false;
        }
        
        $list = $this->deal_dinner($list);
        return $list;
    
    }
    
    public function deal_dinner($list){
        
        //获取场馆
        $venue_id = array_column($list, 'venue_id');
        if($venue_id){
            $venue_name = $this->Mvenue->get_lists('id, name', array('in'=>array('id'=>$venue_id)));
            $venue_name = array_column($venue_name, 'name', 'id');
        }
        
        //获取主题
        $theme = array_column($list, 'theme_id');
        if($theme){
            $theme_name = $this->Mtheme->get_lists('id, title', array('in'=>array('id'=>$theme)));
            $theme_name = array_column($theme_name, 'title', 'id');
        }
        
        //获取套餐
        $menus = array_column($list, 'menus_id');
        if($menus){
            $menus_arr = $this->Mmilan_combo->get_lists('id, name, price', array('in'=>array('id'=>$menus)));
            $menus_name = array_column($menus_arr, 'name', 'id');
            $menus_price = array_column($menus_arr, 'price', 'id');
        }
        
        foreach ($list as $k=>$v){
            $list[$k]['venue_name'] = isset($venue_name[$v['venue_id']]) && $venue_name[$v['venue_id']] ? $venue_name[$v['venue_id']]:'';
            $list[$k]['theme'] = isset($theme_name[$v['theme_id']]) ? $theme_name[$v['theme_id']]:'无';
            $list[$k]['menus'] = isset($menus_name[$v['menus_id']]) ? $menus_name[$v['menus_id']]:'无';
            $list[$k]['price'] = isset($menus_price[$v['menus_id']]) ? $menus_price[$v['menus_id']] : '';

        }

        return $list;
    }
    
    
    /**
     * 获取预约详情
     * @author songchi@gz-zc.cn
     */
    public function info($id, $where = array()){
    
        $where = array_merge($where, array('id' => $id));
        $info = $this->get_one('*', $where);

        if(! $info)
        {
            return false;
        }
        
        $list[0] = $info;
        $info_temp = $this->deal_dinner($list);
        $info_temp = $info_temp[0];

        return $info_temp;
    
    }
    
    
    
    /**
     * 搜索订单信息
     * @author songchi@gz-zc.cn
     */
    public function search_menu_list($name, $mobile, $solar_time){
        $dinner_where['is_del'] = 0;
        if($name || $mobile){
            $dinner_where['like'] = array();
            $where['like'] = array();
        }
        $dinner_where['solar_time'] = $solar_time;
        $where['is_del'] = 0;
        
        if(!empty($mobile)){
            
            $where['like'] = array_merge($where['like'], array(
                'mobile_phone' => $mobile
            ));
           
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main_mobile' => $mobile,
                'roles_wife_mobile' => $mobile,
            ));
        }
        
        if(!empty($name)){
            $where['like'] = array_merge($where['like'], array(
                'name' => $name
            ));
            
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main' => $name,
                'roles_wife' => $name,
            ));
            
            
        }
        
        if(!empty($solar_time)){
            $dinner_where['solar_time'] = $solar_time;
        }
        
        if($name == '' && $mobile == '' && $solar_time == '')
        {
            return false;
        }
        $customer = $this->Mcustomer->get_lists('id', $where);
        $this->db->from($this->_table);
        $this->db->group_start();
        if($customer){
            $customer_ids = array_column($customer, 'id');
            $this->db->or_where_in('customer_id', $customer_ids);
        }
        if(isset($dinner_where['or_like']) && $dinner_where['or_like']){
            foreach ($dinner_where['or_like'] as $k => $v){
                $this->db->or_like($k, $v);
            }
        }
        
        $this->db->group_end();
        if($solar_time){
            $this->db->where(array('is_del' => 0, 'solar_time'=>$solar_time));
        }else{
            $this->db->where(array('is_del' => 0));
        }
        
        $field = '*';
        $this->db->select($field);
        $result = $this->db->get();
        $list = $result->result_array();
        $list = $this->deal_dinner($list);
        return $list;
        
    }
    
    
    
    /**
     * 搜索订单信息
     * @author songchi@gz-zc.cn
     */
    public function search_dinner_list($time, $name, $mobile){
        
        $dinner_where['is_del'] = 0;
        $dinner_where['like'] = array();
        
        $where['is_del'] = 0;
        $where['like'] = array();
        
        if($time){
            $data['year'] = $year = date('Y', strtotime($time));
            $data['month'] = $month = date('m', strtotime($time));
            // 获取天数
            $days = days_in_month($month, $year);
//             $dinner_where['solar_time>'] = $year.'-'.$month.'-01';
//             $dinner_where['solar_time<'] = $year.'-'.$month.'-'.$days;
            $dinner_where['solar_time'] = $time;
        }
        
        if($name != '')
        {
            $where['like'] = array_merge($where['like'], array(
                'name' => $name
            ));
            
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main' => $name,
                'roles_wife' => $name
            ));
        }
        if(!empty($mobile)){
            $where['like'] = array_merge($where['like'], array(
                'mobile_phone' => $mobile
            ));
            
            $dinner_where['or_like'] = array(
                'roles_main_mobile' => $mobile,
                'roles_wife_mobile' => $mobile

            );
        }
    
        if($name == '' && $mobile == '' && $time == '')
        {
            return false;
        }
        
        $customer = $this->Mcustomer->get_lists('id', $where);
        
        if(!$customer){
            return false;
        }
        
        
        if(isset($dinner_where['or_like']) && $dinner_where['or_like']){

            $this->db->from('t_dinner');
            $this->db->group_start();
            
            if($customer){
                $customer_ids = array_column($customer, 'id');
                $this->db->or_where_in('user_id', $customer_ids);
            }
            
            foreach ($dinner_where['or_like'] as $k => $v){
                $this->db->or_like($k, $v);
            }
            $this->db->group_end();
            $this->db->where(array('is_del' => 0));
            if($time){
                $this->db->where(array('solar_time>' => $time));
//                 $this->db->where(array('solar_time>' => $year.'-'.$month.'-01'));
//                 $this->db->where(array('solar_time<' => $year.'-'.$month.'-'.$days));
            }
            $field = '*';
            $this->db->select($field);
            $result = $this->db->get();
            $list = $result->result_array();
            
        }else{
            $list = $this->Mdinner->get_lists('id, roles_main, roles_wife, solar_time, roles_main_mobile, roles_wife_mobile', $dinner_where, array('solar_time'=>'asc'));
        }
        
        if(! $list)
        {
            return false;
        }else{
            return $list;
        }
    
    
    }
    
    
    /**
     * 搜索订单信息
     * @author songchi@gz-zc.cn
     */
    public function search_consume_list($time, $name, $mobile){
    
        $dinner_where['is_del'] = 0;
        $dinner_where['like'] = array();
    
        $where['is_del'] = 0;
        $where['like'] = array();
    
        if($time){
            $data['year'] = $year = date('Y', strtotime($time));
            $data['month'] = $month = date('m', strtotime($time));
            // 获取天数
            $days = days_in_month($month, $year);
            //             $dinner_where['solar_time>'] = $year.'-'.$month.'-01';
            //             $dinner_where['solar_time<'] = $year.'-'.$month.'-'.$days;
            $dinner_where['solar_time'] = $time;
        }
    
        if($name != '')
        {
            $where['like'] = array_merge($where['like'], array(
                'name' => $name
            ));
    
            $dinner_where['or_like'] = array_merge($dinner_where['like'], array(
                'roles_main' => $name,
                'roles_wife' => $name
            ));
        }
        if(!empty($mobile)){
            $where['like'] = array_merge($where['like'], array(
                'mobile_phone' => $mobile
            ));
    
            $dinner_where['or_like'] = array(
                'roles_main_mobile' => $mobile,
                'roles_wife_mobile' => $mobile
    
            );
        }
    
        if($name == '' && $mobile == '' && $time == '')
        {
            return false;
        }
    
        $customer = $this->Mcustomer->get_lists('id', $where);
    
        if(!$customer){
            return false;
        }
    
    
        if(isset($dinner_where['or_like']) && $dinner_where['or_like']){
    
            $this->db->from('t_dinner');
            $this->db->group_start();
    
            if($customer){
                $customer_ids = array_column($customer, 'id');
                $this->db->or_where_in('user_id', $customer_ids);
            }
    
            foreach ($dinner_where['or_like'] as $k => $v){
                $this->db->or_like($k, $v);
            }
            $this->db->group_end();
            $this->db->where(array('is_del' => 0));
            if($time){
                $this->db->where(array('solar_time' => $time));
                //                 $this->db->where(array('solar_time>' => $year.'-'.$month.'-01'));
                //                 $this->db->where(array('solar_time<' => $year.'-'.$month.'-'.$days));
            }
            $field = '*';
            $this->db->select($field);
            $result = $this->db->get();
            $list = $result->result_array();
    
        }else{
            $list = $this->Mdinner->get_lists('*', $dinner_where, array('solar_time'=>'asc'));
        }
        if(! $list)
        {
            return false;
        }else{
            return $list;
        }
    
    
    }
    
    
    public function search_menu($mobile = array()){
        $this->db->from($this->_table);
        $this->db->group_start();
        $this->db->where_in('phone', $mobile);
        $this->db->or_where_in('roles_main_mobile', $mobile);
        $this->db->or_where_in('roles_wife_mobile', $mobile);
        $this->db->group_end();
        $this->db->where(array('is_del' => 0));
        $field = 'phone, roles_main_mobile ,roles_wife_mobile';
        $this->db->select($field);
    
        $result = $this->db->get();
        $list = $result->result_array();
    
        return $list;
    
    }
    
}