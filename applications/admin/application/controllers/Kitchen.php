<?php 
/**
* 后厨管理
* @author louhang@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Kitchen extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->Model([
                        'Model_dinner' => 'Mdinner',
                        'Model_venue' => 'Mvenue',
                      
                        'Model_combo' => 'Mcombo',
                        'Model_dish' => 'Mdish',


                        'Model_dinner_venue' => 'Mdinner_venue',
                        'Model_change_record' => 'Mchange_record',
                        'Model_dinner_extend' => 'Mdinner_extend',
                       

        ]);
        $this->pageconfig = C('page.config_bootstrap');
        
        $this->load->library('pagination');
        
        $this->data['dinner_time'] = array_column(C('dinner.time'), 'name', 'id');

    }

     /**
     * 今日订单
     * @author louhang@gz-zc.cn
     *
     */
    public function today() {
        $data = $this->data;
        $data['title'] = ['首页','后厨管理'];
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $this->pageconfig['per_page'] = 20;
        $size = $this->pageconfig['per_page'];
        $order_by = array('solar_time' => 'asc', 'create_time' => 'asc');
        $where = [];
        $query_data = [];
        $dinner_ids = [];
        # 订单未打印搜索
        $isPrint =  $this->input->get('is_print');
        $where = $this->get_is_x(['is_print' => $isPrint]);
        $query_data['is_print'] = $isPrint;
        $where['is_del'] = 0;
        $where['not_in'] = array(
            'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
        );
        $where['is_send_menu'] = 1;
        
        //宴会时间搜索
        $create_time = $this->input->get('create_time') ? trim($this->input->get('create_time')) : date('Y-m');
        $time_where = array(
            'solar_time >=' => $create_time.'-1',
            'solar_time <=' => $create_time.'-31'
        );
        if (! empty($create_time)) {

            $dinner = $this->Mdinner->get_lists('id',  array_merge($where, $time_where));
            $dinner_ids = $dinner ? array_column($dinner, 'id') : '' ;
            
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        //宴会类型
        $data['party_type'] = C('party');
        foreach ($data['party_type'] as $key=>$val) {
            $data['party_type'][$val['id']] = $val['name'];
            unset( $data['party_type'][$key]);
        }
        //宴会场馆搜索
        $venue_id = trim($this->input->get('venue_id')); 
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', 
                array(
                    'venue_id' => $venue_id,
                    'in' => array('dinner_id' => $dinner_ids),       
                )
            );
            $dinner_ids = $ids ? array_column($ids, 'dinner_id') : '';
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }
        
        $dinner_ids = $dinner_ids ? array_unique($dinner_ids) : '';
        
        //获取分页后的数据
        $where = array_merge($where, ['in' => ['id' => $dinner_ids]]);
        $list = $this->Mdinner->get_lists('id', $where, $order_by, $size, ($page-1)*$size);
        $ids = $list ? array_column($list, 'id') : '';
        if ($ids) {
            $list = $this->Mdinner->get_dinner_by_ids($ids, $order_by);
        } else {
            $list = [];
        }
        $data['list'] = $list;

        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';

        if($list){
            $data['list'] = $list;
            $data_count = count($dinner_ids);
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/kitchen/today?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        
        $data['query_data'] = http_build_query($query_data);
        $data['order_type'] = 'all';
        
        $this->load->view("kitchen/index", $data);
    }
    
    /**
     * 今日订单
     * @author louhang@gz-zc.cn
     *
     */
    public function changed() {
        $data = $this->data;
        $data['title'] = ['首页','后厨管理'];
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $this->pageconfig['per_page'] = 20;
        $size = $this->pageconfig['per_page'];
        $order_by = array('solar_time' => 'asc');
        $where = [];
        $query_data = [];
        $dinner_ids = '';
        $where['is_del'] = 0;
        $where['confirm_change'] = 0;
        $where['not_in'] = array(
            'is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.failure.id')]
        );
        //拓展订单
        $dinner_extend_conf = C('dinner_extend');
        $dinner_extend_conf_keys = array_keys($dinner_extend_conf);
        $data['dinner_extend_conf_keys'] = $dinner_extend_conf_keys;
        $data['dinner_extend_conf'] = $dinner_extend_conf;
        //宴会时间搜索
        $create_time = $this->input->get('create_time') ? trim($this->input->get('create_time')) : '';
        if (! empty($create_time)) {
            $where = array_merge($where, ['solar_time' => $create_time]);
            $query_data['create_time'] = $data['create_time'] = $create_time;
        } else {
            //默认查看最近三天的 变更情况
            $where = array_merge(
                $where,
                ['solar_time >=' => date('Y-m-d', strtotime('-3 days'))],
                ['solar_time <=' => date('Y-m-d', strtotime('+3 days'))]
            );
        }

        $dinner = $this->Mdinner->get_lists('id', $where);
        $dinner_ids = $dinner ? array_column($dinner, 'id') : '' ;
        //宴会场馆搜索
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id',
                array(
                    'venue_id' => $venue_id,
                    'in' => array('dinner_id' => $dinner_ids),
                )
            );
            $dinner_ids = $ids ? array_column($ids, 'dinner_id') : '';
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }
        //获取变更过的记录
        $venues = $this->Mvenue->get_lists('*', ['is_del' => 0]);
        $venues = array_column($venues, 'name', 'id');
        $dinner_type = array_column(C('party'), 'name', 'id');
        $key_to_text = C('key_to_text');
        $change_record = $this->get_change_record_lists($dinner_ids);
        $dinner_ids = $change_record ? array_keys($change_record) : '';
        //变更记录扩展信息
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
                        $old_is_need_str = $old_value['is_need'] ? '是' : '否';
                        $new_value = json_decode($v['new_value'], true);
                        $new_is_need_str = $new_value['is_need'] ? '是' : '否';

                        //请帖
                        if ($v['key'] == $dinner_extend_conf['invitation']['key']) {
                            $change_record[$k1][$k]['old_value'] = "需要：{$old_is_need_str} {$data['invitation'][$old_value['num']]} 备注：{$old_value['remark']}";
                            $change_record[$k1][$k]['new_value'] = "需要：{$new_is_need_str} {$data['invitation'][$new_value['num']]} 备注：{$new_value['remark']}";
                        } else if ($v['key'] == $dinner_extend_conf['mc']['key']) {
                            $change_record[$k1][$k]['old_value'] = "需要：{$old_is_need_str} 备注：{$old_value['remark']}";
                            $change_record[$k1][$k]['new_value'] = "需要：{$new_is_need_str} 备注：{$new_value['remark']}";
                        } else {
                            $change_record[$k1][$k]['old_value'] = "需要：{$old_is_need_str} 数量：{$old_value['num']} 备注：{$old_value['remark']}";
                            $change_record[$k1][$k]['new_value'] = "需要：{$new_is_need_str} 数量：{$new_value['num']} 备注：{$new_value['remark']}";
                        }
                        //处理数据为0,'',null情况
                        if (((int)$old_value['num'] == (int)$new_value['num']) && ((bool)$old_value['is_need'] ==  (bool)$new_value['is_need']) && (trim($old_value['remark']) == trim($new_value['remark']))) {
                            unset($change_record[$k1][$k]);
                        }
                    }
            }
        }
        # 计算变更总条数
        $count_num = 0;
        foreach ($change_record as $k1=>$v1){
            foreach ($v1 as $k=>$v){
                $change_record[$k1] = array_merge($change_record[$k1]);
		        $count_num++;
            }
        }
        //获取分页后的数据
        $where = array_merge($where, ['in' => ['id' => $dinner_ids]]);
        $list = $this->Mdinner->get_lists('id', $where, $order_by, $size, ($page-1)*$size);

        $ids = $list ? array_column($list, 'id') : '';
        $lists = [];
        if ($ids) {
            # 获取订单列表，将变更记录添加到订单
            $list = $this->Mdinner->get_dinner_by_ids($ids, $order_by);
            foreach ($list as $k => $v) {
                $v['change_record'] = isset($change_record[$v['id']]) ? $change_record[$v['id']] : null;
                //$lists[$v['solar_time']][] = $v;
                $lists[$v['id']][] = $v;
            }
        }
        # 计算总的变更条数
        foreach ($lists as $k => $v) {
            $sum = 0;
            foreach ($v as $k2 => $v2) {
                if ($v2['change_record']) {
                    $sum += count($v2['change_record']);
                }
            }
            $lists[$k]['sum_count'] = $sum;
        }
        # 获取套餐信息
        $combo_menu = $this->Mcombo->lists();
        $data['combo_menu'] = array_column($combo_menu, 'combo_name', 'id');
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
        $data['change_record_list'] = $tmp;
        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        $data['list'] = $lists;
        $data['count'] = count($tmp);
        $data['query_data'] = http_build_query($query_data);
        $data['key_to_text'] = $key_to_text;
        $this->load->view("kitchen/changed", $data);
    }

    /**
     * 订单详情
     * @author louhang@gz-zc.cn
     *
     */
    public function detail($id = 0) {
        $data = $this->data;
        $data['title'] = ['首页','订单详情'];

        $id = intval($id);
        !$id && show_404();

        $info = $this->Mdinner->info($id);
        !$info && show_404();
        //场馆
        if(isset($info['venue_ids']) && $info['venue_ids'][0]){
            $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $info['venue_ids'])));
            $venue_name = '';
            foreach ($venue as $v){
                $venue_name .= $v['name'].';';
            }
        }else{
            $venue_name = '其他';
        }

        $info['venue_name'] = $venue_name;
        //宴会类型
        $dinnertype = array_column(C('party'), 'name', 'id');
        $info['venue_type_name'] = $dinnertype[$info['venue_type']];

        $data = $this->data;
        $data['info'] = $info;

        $admin_name = $this->Madmins->get_one('id, fullname, tel',array('id' => $data['info']['create_admin']));
        $data['info']['create_admin'] = $admin_name['fullname'];
        $data['info']['create_admin_tel'] = $admin_name['tel'];

        $data['title'] = array(
                        ['url' => '/common', 'text' => '首页'],
                        ['url' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '', 'text' => '订单列表'],
                        ['url' => '', 'text' => '订单详情']
        );

    	$data['list'] = $this->change_record($id);

    	$data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取套餐信息
        $combo_menu = $this->Mcombo->lists();
        $data['combo_menu'] = array_column($combo_menu, 'combo_name', 'id');
        $data['combo_menu'][0] = '套餐未确定';

        //获取米粉、鸡蛋……
        $dinner_extend = $this->Mdinner_extend->get_lists('*', ['dinner_id' => $id, 'is_del' =>0]);
        $dinner_extend = $dinner_extend ? array_column($dinner_extend, null, 'type') : [];
        $data['egg'] = isset($dinner_extend[C('dinner_extend.egg.id')]) ? $dinner_extend[C('dinner_extend.egg.id')] : '';
        $data['rice_noodle'] = isset($dinner_extend[C('dinner_extend.rice_noodle.id')]) ? $dinner_extend[C('dinner_extend.rice_noodle.id')] : '';
        $data['pianjiu'] = isset($dinner_extend[C('dinner_extend.pianjiu.id')]) ? $dinner_extend[C('dinner_extend.pianjiu.id')] : '';

        //获取餐标详情
        $combo = $this->get_combo($info['detail']['menus_id'], true);
        $data['combo'] = $combo;

        $data['dinner_id'] = $id;

        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            $is_print = $this->input->post('is_print');
            $status = $this->Mdinner->get_one('id, is_print',['id' => $id]);
            if($status['is_print'] == 0){
                $this->Mdinner->update_info(array('is_print'=>$is_print), ['id' => $id]);
            }
        }

        //订单类型
        //egg 鸡蛋订单
        //rice_noodle 米粉订单
        $data['order_type'] = $this->input->get("order_type");
        $this->load->view('kitchen/detail', $data);

    }

    /**
     * 查看变更记录
     * @author louhang@gz-zc.cn
     */
    public function change_record($ids = 0){
        $data = $this->data;

        //获取宴会信息

        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取套餐信息
        $combo_menu = $this->Mcombo->lists();
        $data['combo_menu'] = array_column($combo_menu, 'combo_name', 'id');
        $data['combo_menu'][0] = '套餐未确定';
        //获取变更记录
        $where = [
            'is_del' => 0,
            'in' => [
                'key' => C('kitchen.changed_keys'),
                'dinner_id' => $ids
            ]
        ];
        $change_cord = $this->Mchange_record->get_lists('*', $where, 0, 0, ['create_time' => 'desc']);
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

        //拓展订单
        $dinner_extend_conf = C('dinner_extend');
        $dinner_extend_conf_keys = array_keys($dinner_extend_conf);
        foreach ($change_cord as $k => $v) {

            $v['key_text'] = $key_to_text[$v['key']];

             if ($v['key'] == 'venue_type') {
                 $v['old_value'] = $dinner_type[$v['old_value']];
                 $v['new_value'] = $dinner_type[$v['new_value']];
             } else if ($v['key'] == 'venue_id') {
                 $v['old_value'] = $this->get_venue_name($v['old_value'], $venues);
                 $v['new_value'] = $this->get_venue_name($v['new_value'], $venues);
             } else if($v['key'] == 'is_examined'){
                 $v['old_value'] = $auth_status[$v['old_value']];
                 $v['new_value'] = $auth_status[$v['new_value']];
             } else if ( in_array($v['key'], $dinner_extend_conf_keys) ) {
                 $old_value = json_decode($v['old_value'], true);
                 $old_is_need_str = $old_value['is_need'] ? '是' : '否';
                 $new_value = json_decode($v['new_value'], true);
                 $new_is_need_str = $new_value['is_need'] ? '是' : '否';

                 //请帖
                 if ($v['key'] == $dinner_extend_conf['invitation']['key']) {
                     $v['old_value'] = "需要：{$old_is_need_str} {$data['invitation'][$old_value['num']]} 备注：{$old_value['remark']}";
                     $v['new_value'] = "需要：{$new_is_need_str} {$data['invitation'][$new_value['num']]} 备注：{$new_value['remark']}";
                 } else if ($v['key'] == $dinner_extend_conf['mc']['key']) {
                     $v['old_value'] = "需要：{$old_is_need_str} 备注：{$old_value['remark']}";
                     $v['new_value'] = "需要：{$new_is_need_str} 备注：{$new_value['remark']}";
                 } else {
                     $v['old_value'] = "需要：{$old_is_need_str} 数量：{$old_value['num']} 备注：{$old_value['remark']}";
                     $v['new_value'] = "需要：{$new_is_need_str} 数量：{$new_value['num']} 备注：{$new_value['remark']}";
                 }

                 //处理数据为0,'',null情况
                 if (((int)$old_value['num'] == (int)$new_value['num']) && ((bool)$old_value['is_need'] ==  (bool)$new_value['is_need']) && (trim($old_value['remark']) == trim($new_value['remark']))) {
                     continue;
                 }

             }

            //管理员id => 姓名
            $v['create_user'] = $admins[$v['create_user']];

            $change_cord_by_time[$v['create_time']][] = $v;

        }

        $data['list'] = $change_cord_by_time;
        return $data['list'];

    }
    
    /**
     * 变更记录列表展示
     * @author louhang@gz-zc.cn
     */
    public function get_change_record_lists($ids = 0){
        if (! $ids) {
            return false;
        }
        
        $data = $this->data;
        //获取宴会信息
        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取套餐信息
        $combo_menu = $this->Mcombo->lists();
        $data['combo_menu'] = array_column($combo_menu, 'combo_name', 'id');
        $data['combo_menu'][0] = '套餐未确定';
        //获取变更记录
        $where = [
            'is_del' => 0,
            'in' => [
                'key' => C('kitchen.changed_keys'),
                'dinner_id' => $ids
            ]
        ];
        $change_cord = $this->Mchange_record->get_lists('*', $where, 0, 0, ['create_time' => 'desc']);
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
    
            if ($v['key'] == 'venue_id') {
                $v['old_value'] = $this->get_venue_name($v['old_value'], $venues);
                $v['new_value'] = $this->get_venue_name($v['new_value'], $venues);
            }
    
            //管理员id => 姓名
            $v['create_user'] = $admins[$v['create_user']];
    
            $change_cord_by_time[$v['dinner_id']][] = $v;
        }

        return $change_cord_by_time;
       
    }
    
    /**
     * 将宴会场馆id 转换为 场馆名称
     *
     * @author louhang@gz-zc.cn
     */
    public function get_venue_name($venue_ids, $venues = []){
        $venue_ids = explode(',', $venue_ids);
        foreach ($venue_ids as $k => $v) {
            $venue_ids[$k] = $venues[$v];
        }
        $venue_ids = implode(',', $venue_ids);
        return $venue_ids;
    
    }
    
    /**
     * 获取菜品信息
     * @author louhang@gz-zc.cn
     */
    public function get_combo($id = 0, $inner_call = false){
        $combo_id = (int)$this->input->get('id');
    
        //控制器调用
        if ($id) {
            $combo_id = (int)$id;
        }
    
        $combo = $this->Mcombo->get_one('*', array('id' => $combo_id, 'is_del' => 0));
        $data['price'] = $combo ? $combo['price'] : 0;
        $data['name'] = $combo ? $combo['combo_name'] : '';
    
        $dish_ids = $combo ? explode(',', $combo['relevance_id']) : '';
        $dishes = $this->Mdish->get_lists('id,name, price', array('in' => array('id' => $dish_ids), 'is_del' => 0));
        //重新排序
        $new_dishes = array();
        foreach($dish_ids as $k => $v){
            foreach($dishes as $key => $value){
                if($v == $value['id']){
                    $new_dishes[] = $value;
                }
            }
        }
        $data['dishes'] = $new_dishes ;
    
        $sum = 0;
        foreach ($dishes as $k => $v) {
            $sum += $v['price'];
        }
    
        $data['old_price'] = $sum;
    
        //内部控制器调用
        if ($inner_call) {
            return $data;
        }
    
        $this->return_success($data, 'success');
    }
    
    
    /**
     * 删除执行单
     * @author chaokai@g-zc.cn
     */
    public function del(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');
        
        $this->Mmilan_execute->update_info(array('is_del' => 1), array('id' => $id));
        
        $this->return_success();
    }

    /**
     * 鸡蛋订单
     * @author fengyi@gz-zc.cn
     */
    public function egg() {
        $data = $this->data;
        $data['title'] = ['首页', '后厨管理', '鸡蛋订单'];

        $page = intval( trim($this->input->get('per_page', true)) ) ?: 1;
        $this->pageconfig['per_page'] = 20;
        $size = $this->pageconfig['per_page'];

        $order_by = ['solar_time' => 'asc'];
        $query_data = [];
        # 订单未打印搜索 默认显示全部
        $isPrint =  $this->input->get('is_print');
        $where = $this->get_is_x(['is_print' => $isPrint]);
        $query_data['is_print'] = $isPrint;

        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if ($venue_id) {
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in']['id'] = $ids;
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }
        $create_time = $create_time = $this->input->get('create_time') ? trim($this->input->get('create_time')) : date('Y-m');;
        if ($create_time) {
            $where['solar_time like'] = $create_time.'%';
            $query_data['group_id'] = $data['create_time'] = $create_time;
        }

        //场馆信息
        $venue = $this->Mvenue->get_lists('id, name', ['is_del' => 0]);
        $data['venue'] = $venue ? array_column($venue, 'name', 'id') : '';

        //鸡蛋订单信息
        $field = 'id,dinner_id,type,num,remark';
        $lists = $this->Mdinner_extend->get_lists($field, ['type' => C('dinner_extend.egg.id')]);

        if ($lists) {
            $dinner_ids = array_column($lists, 'dinner_id');
            if (isset($where['in']['id']) && $where['in']['id']) {
                $in_ids = [];
                foreach ($dinner_ids as $v) {
                    if (in_array($v, $where['in']['id'])) {
                        $in_ids[] = $v;
                    }
                }

                if ($in_ids) {
                    $where['in']['id'] = $in_ids;
                } else {
                    //没有满足条件的订单
                    $where['in']['id'] = []; 
                }

            } else {
                $where['in']['id'] = $dinner_ids;
            }
            $where['is_del'] = 0;
            $where['is_send_egg'] = 1;
            $dinner_infos = [];
            if ($where['in']['id']) {
                $dinner_infos = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
            }
            if ($dinner_infos) {
                foreach ($dinner_infos as $k => $v) {
                    foreach ($lists as $k2 => $v2) {
                        if ($v['id'] == $v2['dinner_id']) {
                            $dinner_infos[$k]['egg_num'] = $v2['num'];
                        }
                    }
                }
            }
            $data['list'] = $dinner_infos;

            //分页
            $data_count = $dinner_infos ? count($dinner_infos) : 0;
            $this->pageconfig['base_url'] = '/kitchen/egg'.http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
            $data['count'] = $data_count;
        }

        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            $is_print = $this->input->post('is_print');
            $status = $this->Mdinner->get_one('id, is_egg_print',['id' => $id]);
            if($status['is_egg_print'] == 0){
                $this->Mdinner->update_info(array('is_egg_print'=>$is_print), ['id' => $id]);
            }
        }
        $data['query_data'] = http_build_query($query_data);
        $data['order_type'] = 'egg';
      
        $this->load->view('kitchen/lists', $data);
       
    }

    /**
     * 米粉订单
     * @author fengyi@gz-zc.cn
     */
    public function rice_noodles()
    {
        //echo 'Rice Noodles';
        $data = $this->data;
        $data['title'] = ['首页', '后厨管理', '米粉订单'];

        $page = intval( trim($this->input->get('per_page', true)) ) ?: 1;
        $this->pageconfig['per_page'] = 20;
        $size = $this->pageconfig['per_page'];

        $order_by = ['solar_time' => 'asc'];
        $query_data = [];
        # 订单未打印搜索  默认显示全部
        $isPrint =  $this->input->get('is_print');
        $where = $this->get_is_x(['is_print' => $isPrint]);
        $query_data['is_print'] = $isPrint;

        # 筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if ($venue_id) {
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in']['id'] = $ids;
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }
        $create_time = $create_time = $this->input->get('create_time') ? trim($this->input->get('create_time')) : date('Y-m');;
        if ($create_time) {
            $where['solar_time like'] = $create_time.'%';
            $query_data['group_id'] = $data['create_time'] = $create_time;
        }

        //场馆信息
        $venue = $this->Mvenue->get_lists('id, name', ['is_del' => 0]);
        $data['venue'] = $venue ? array_column($venue, 'name', 'id') : '';

        //米粉订单信息
        $field = 'id,dinner_id,type,num,remark';
        $lists = $this->Mdinner_extend->get_lists($field, ['type' => C('dinner_extend.rice_noodle.id')]);

        if ($lists) {
            $dinner_ids = array_column($lists, 'dinner_id');
            if (isset($where['in']['id']) && $where['in']['id']) {
                $in_ids = [];
                foreach ($dinner_ids as $v) {
                    if (in_array($v, $where['in']['id'])) {
                        $in_ids[] = $v;
                    }
                }

                if ($in_ids) {
                    $where['in']['id'] = $in_ids;
                } else {
                    //没有满足条件的订单
                    $where['in']['id'] = []; 
                }

            } else {
                $where['in']['id'] = $dinner_ids;
            }
            $where['is_del'] = 0;
            $where['is_send_noodle'] = 1;
            $dinner_infos = [];
            if ($where['in']['id']) {
                $dinner_infos = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
            }
            if ($dinner_infos) {
                foreach ($dinner_infos as $k => $v) {
                    foreach ($lists as $k2 => $v2) {
                        if ($v['id'] == $v2['dinner_id']) {
                            $dinner_infos[$k]['egg_num'] = $v2['num'];
                        }
                    }
                }
            }
            $data['list'] = $dinner_infos;

            //分页
            $data_count = $dinner_infos ? count($dinner_infos) : 0;
            $this->pageconfig['base_url'] = '/kitchen/egg'.http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
            $data['count'] = $data_count;
        }
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            $is_print = $this->input->post('is_print');
            $status = $this->Mdinner->get_one('id, is_rice_print',['id' => $id]);
            if($status['is_rice_print'] == 0){
                $this->Mdinner->update_info(array('is_rice_print'=>$is_print), ['id' => $id]);
            }
        }
        $data['query_data'] = http_build_query($query_data);
        $data['order_type'] = 'rice_noodle';
      
        $this->load->view('kitchen/lists', $data);
       
    }
    public function get_is_x(array $isX)
    {
        foreach ($isX as $key => $is) {
            if (!is_null($is)) {
                $where[$key] = $is;
                if($is == 2){
                    unset($where[$key]);
                }
                $query_data[$key] = $is;
            } else {
                # 默认显示所有
                $where["{$key} <>"] = 2;
            }
        }
        return $where;
    }
    public function confirm_change()
    {
        $dinner_id = $this->input->post("dinner_id");
        $where = ['is_del' => 0, 'id' => $dinner_id];
        $data['confirm_change'] = 1;
        if($this->Mdinner->update_info($data, $where)){
            $back_data = ['code' => 1, 'msg' => '变更成功'];
            exit(json_encode($back_data));
        } else {
            $back_data = ['code' => 1, 'msg' => '变更失败'];
            exit(json_encode($back_data));
        }
    }
}
