<?php 
/**
* 首页控制器
* @author jianming@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Common extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_admins' => 'Madmins',
            'Model_venue' => 'Mvenue',
            'Model_dinner' => 'Mdinner',
            'Model_dinner_extend' => 'Mdinner_extend',
            'Model_change_record' => 'Mchange_record',
         ]);
        $this->load->library('encryption');

    }
    

    /**
     * 右边内容
     */
    public function index() {

        $data = $this->data;
        $list = $this->Mvenue->lists();
        
        //如果是场馆管理员
        if($data['userInfo']['type'] == C('public.type.venue.id')){
            foreach ($list as $k => $v){
                if($v['id'] == $data['userInfo']['venue_id']){
                    $data['list'][] = $v; 
                    break;
                }
            }
        }else{
            $data['list'] = $list;
        }
        
        $this->load->view("common/index", $data);
    }

    /**
     * 顶部内容
     */
    public function top() {
        $data = $this->data;
        $data['user_info'] = $this->data['userInfo'];
        $now_year = date('Y');
        $data['now_month'] = $now_month = date('m');
        $data['now_year'] = $now_year;
        $year = array();
        for ($i = 2016; $i<=$now_year+4; $i++){
            $year[] = $i;
        }
        $data['year'] = $year;
        
        $month = array();
        for($i = 1; $i <= 12; $i++){
            $month[] = $i;
        }
        $data['month'] = $month;
        
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $this->load->helper('date');
            $day = days_in_month($post_data['month'], $post_data['year']);
            if($day){
                $this->return_success($day);
            }else{
                $this->return_failed();
            }

        }
        
        $this->load->view("common/top",$data);
    }

    /*
     *  菜单
     *  nengfu@gz-zc.cn
     */
    public function left() {
        $data = $this->data;
        $data['menu'] = $this->Madmins->getMenus();
        $data['admin_id'] = urlencode($this->encryption->encrypt($data['userInfo']['id']));
        $where = array(
            'in' => array('is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.to_recheck.id'), C('dinner.examine.backend_add.id')]),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $not_audit_number = $this->Mdinner->count($where);
        $data['num'] = $not_audit_number;
        $where = array(
            //'is_examined' => C('dinner.examine.not.id'),
            'in' => array('is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.backend_add.id')]),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $not_audit_number_not = $this->Mdinner->count($where);
        $data['num_not'] = $not_audit_number_not;
        $where = array(
            'is_examined' => C('dinner.examine.to_recheck.id'),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $not_audit_number_recheck = $this->Mdinner->count($where);
        $data['num_recheck'] = $not_audit_number_recheck;
        
        $return_lists = $this->get_num();
        $data['push_num'] = $return_lists; 
        $this->load->view("common/left",$data);

    }

    
    public function get_num(){
        $data = $this->data;
        /*-----------本月订单begin-----------*/
        
        $query['is_del'] = 0;
        $query['not_in'] = array(
            'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
        );
        $query['is_send_menu'] = 1;
        
        //宴会时间搜索
        $create_time = $this->input->get('create_time') ? trim($this->input->get('create_time')) : date('Y-m');
        $time_where = array(
            'solar_time >=' => $create_time.'-1',
            'solar_time <=' => $create_time.'-31',
            'is_print' => 0
        );
        if (! empty($create_time)) {
        
            $dinner = $this->Mdinner->get_lists('id',  array_merge($query, $time_where));
            $dinner_ids = $dinner ? array_column($dinner, 'id') : '' ;
        }
        if(empty($dinner_ids)){
            $data['send_menu_num'] = 0;
        }else{
            $data['send_menu_num'] = count($dinner_ids);
        }
        /*-----------本月订单end-----------*/
        
        
        /*-----------变更订单begin-----------*/
        $change_where['is_del'] = 0;
        $change_where['confirm_change'] = 0;
        $change_where['not_in'] = array(
            'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
        );
        $change_where = array_merge(
            $change_where,
            ['solar_time >=' => date('Y-m-d', strtotime('-3 days'))],
            ['solar_time <=' => date('Y-m-d', strtotime('+3 days'))]
        );
        
        $dinner = $this->Mdinner->get_lists('id', $change_where);
        $dinner_ids = $dinner ? array_column($dinner, 'id') : '' ;
        $change_record = $this->get_change_record_lists($dinner_ids);

        $num = $change_record['num'];
        $change_record = $change_record['change_cord_by_time'];
        $dinner_ids = $change_record ? array_keys($change_record) : '';
        //变更记录扩展信息
        $dinner_extend_conf = C('dinner_extend');
        $dinner_extend_conf_keys = array_keys($dinner_extend_conf);
        $key_to_text = C('key_to_text');
        $dinner_type = array_column(C('party'), 'name', 'id');
        foreach ($change_record as $k1=>$v1){
            foreach ($v1 as $k=>$v){
                $v['key_text'] = $key_to_text[$v['key']];
                if ($v['key'] == 'venue_type') {
                    $change_record[$k1][$k]['old_value'] = $dinner_type[$v['old_value']];
                    $change_record[$k1][$k]['new_value'] = $dinner_type[$v['new_value']];
                }
                else if($v['key'] == 'is_examined'){
                    $change_record[$k1][$k]['old_value'] = $auth_status[$v['old_value']];
                    $change_record[$k1][$k]['new_value'] = $auth_status[$v['new_value']];
                } else if ( in_array($v['key'], $dinner_extend_conf_keys) ) {
                    $old_value = json_decode($v['old_value'], true);
                    $new_value = json_decode($v['new_value'], true);
                    //处理数据为0,'',null情况
                    if (((int)$old_value['num'] == (int)$new_value['num']) && ((bool)$old_value['is_need'] ==  (bool)$new_value['is_need']) && (trim($old_value['remark']) == trim($new_value['remark']))) {
                        unset($change_record[$k1][$k]);
                    }
        
                }
            }
        }
        $tmp = array();
        foreach ($change_record as $k1 => $change_list) {
            $change_key = array_flip(array_column($change_list, 'key'));
            foreach ($change_key as $k2 => $v2) {
                foreach ($change_list as $k3 => $v3) {
                    if ($k2 == $v3['key']) {
                        if ($v3['key'] == 'menus') {
                            $v3['old_value'] = isset($data['combo_menu'][$v3['old_value']]) ? $data['combo_menu'][$v3['old_value']] : "未确定套餐";
                            $v3['new_value'] = isset($data['combo_menu'][$v3['new_value']]) ? $data['combo_menu'][$v3['new_value']] : "未确定套餐";
                        }
                        $tmp[$k1][$k2][] =$v3;
                    }
                }
            }
        }
        $data['change_num'] = count($tmp);
        /*-----------变更订单end-----------*/
        
        /*-----------鸡蛋订单begin-----------*/
        if ($create_time) {
            $egg_where['solar_time like'] = $create_time.'%';
        }
        
        //鸡蛋订单信息
        $field = 'id,dinner_id';
        $lists = $this->Mdinner_extend->get_lists($field, ['type' => C('dinner_extend.egg.id')]);
        $data['egg_num'] = 0;
        if ($lists) {
            $dinner_ids = array_column($lists, 'dinner_id');
            $egg_where['in']['id'] = array_unique($dinner_ids);
            $egg_where['is_del'] = 0;
            $egg_where['is_send_egg'] = 1;
            $egg_where['is_print'] = 0;
            $dinner_infos = [];
            if ($egg_where['in']['id']) {
                $dinner_infos = $this->Mdinner->get_dinner_list_examined($egg_where, array());
            }
        
            if(empty($dinner_infos)){
                $data['egg_num'] = 0;
            }else{
                $data['egg_num'] = count($dinner_infos);
            }
        }
        /*-----------鸡蛋订单end-----------*/
        
        /*-----------米粉订单begin-----------*/
        if ($create_time) {
            $egg_where['solar_time like'] = $create_time.'%';
        }
        
        //鸡蛋订单信息
        $field = 'id,dinner_id';
        $noodles_lists = $this->Mdinner_extend->get_lists($field, ['type' => C('dinner_extend.rice_noodle.id')]);
        $data['noodles_num'] = 0;
        if ($lists) {
            $dinner_ids = array_column($noodles_lists, 'dinner_id');
            $noodles_where['in']['id'] = array_unique($dinner_ids);
            $noodles_where['is_del'] = 0;
            $noodles_where['is_send_noodle'] = 1;
            $noodles_where['is_print'] = 0;
            $dinner_infos = [];
            if ($noodles_where['in']['id']) {
                $dinner_infos = $this->Mdinner->get_dinner_list_examined($noodles_where, array());
            }
            if(empty($dinner_infos)){
                $data['noodles_num'] = 0;
            }else{
                $data['noodles_num'] = count($dinner_infos);
            }
        }
        /*-----------米粉订单end-----------*/
        $data['all_num'] = $data['noodles_num']+$data['egg_num']+$data['send_menu_num'] + $data['change_num'];
        return(['change_num'=>$data['change_num'], 'noodles_num'=>$data['noodles_num'], 'egg_num'=>$data['egg_num'], 'send_menu_num'=>$data['send_menu_num'], 'all_num'=>$data['all_num']]);
    }
    
    public function get_change_record_lists($ids = 0){
        if (! $ids) {
            return false;
        }
        $data = $this->data;
        //获取宴会信息
        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取变更记录
        $where = [
            'is_del' => 0,
            'in' => [
                'key' => C('kitchen.changed_keys'),
                'dinner_id' => $ids
            ]
        ];
        $change_cord = $this->Mchange_record->get_lists('*', $where, 0, 0, ['create_time' => 'desc']);
        $num = count($change_cord);
        $change_cord_by_time = array();
        $key_to_text = C('key_to_text');
        //获取宴会类型
        $dinner_type = array_column(C('party'), 'name', 'id');
        //获取场馆
        $venues = $this->Mvenue->get_lists('*', ['is_del' => 0]);
        $venues = array_column($venues, 'name', 'id');
    
        //管理员姓名获取
        $create_user_ids = $change_cord ? array_column($change_cord, 'create_user') : '';
        $admins = $this->Madmins->get_lists('id, fullname',array('in' => ['id' => $create_user_ids]));
        $admins = $admins ? array_column($admins, 'fullname', 'id') : '';
    
        foreach ($change_cord as $k => $v) {
            $v['key_text'] = $key_to_text[$v['key']];
    
            if ($v['key'] == 'venue_type') {
                $v['old_value'] = $dinner_type[$v['old_value']];
                $v['new_value'] = $dinner_type[$v['new_value']];
            }
    
            //管理员id => 姓名
            $v['create_user'] = $admins[$v['create_user']];
    
            $change_cord_by_time[$v['dinner_id']][] = $v;
        }
        $return_lists = ['num' => $num, 'change_cord_by_time' => $change_cord_by_time];
        return $return_lists;
         
    }

    /**
     * 底部内容
     */
    public function bottom() {
        $this->load->view("common/bottom");
    }
    
}
