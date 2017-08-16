<?php 
/**
 * 消费清单
 * @author chaokai@gz-zc.cn
 */
class Consume extends MY_Controller{

    private $consume_is_pay;
	public function __construct(){
		parent::__construct();

		$this->load->model(array(
			'Model_consume_list' => 'Mconsume_list',
			'Model_consume_extend' => 'Mconsume_extend',
			'Model_dinner' => 'Mdinner',
			'Model_combo' => 'Mcombo',
			'Model_menu' => 'Mmenu',
		    'Model_change_record' => 'Mchange_record',
		    'Model_dinner_venue' => 'Mdinner_venue',
		    'Model_admins' => 'Madmins',
		    'Model_venue' => 'Mvenue'
		));

        $this->consume_is_pay = array_column(C("dinner.consume_is_pay"), "name", "id");
	}

	/**
     * 年月列表
     * @author chaokai@gz-zc.cn
     */
    public function index(){
        
        $data = $this->data;
        $data['title'] = array('首页', '订单管理');
        $start_year = 2016;
        $year = date('Y');
        for($start_year; $start_year < $year+3; $start_year++){
            $data['year'][] = $start_year;
        }
        
        //获取每个月的订单数量
        $data['consume'] = $this->Mconsume_list->get_count();
        $data['venue_list'] = $this->Mvenue->get_lists("name");
        $this->load->view('consume/index', $data);
    }

    /**
     * 某月订单列表
     * @author chaokai@gz-zc.cn
     */
    public function lists(){
        $data = $this->data;
        $data['title'] = array('首页', '订单管理', '订单列表');
        $year = intval($this->input->get('year'));
        $month = intval($this->input->get('month'));
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));
        $venue_name = trim($this->input->get('venue_name'));
        # 订单是否付款搜索搜索 默认显示所有
        $isPay =  $this->input->get('is_pay');
        # is_x 搜索条件!
        $where = $this->get_is_x(['is_pay' => $isPay]);
        # 搜索
        if($name || $mobile){
            $data['list'] = $this->Mconsume_list->search_consume_list($name, $mobile);
        }else if (isset($_GET['solar_time'])){
            if (empty($_GET['solar_time'])) {
                $solar_time = explode("-", date('Y-m-d'));
                $data['year'] = $solar_time[0];
                $data['month'] = $solar_time[1];
                $data['list'] = $this->Mconsume_list->get_consume_list($solar_time[0], $solar_time[1],'', $where);
            } else {
                $solar_time = explode("-",$this->input->get('solar_time'));
                $data['year'] = $solar_time[0];
                $data['month'] = $solar_time[1];
                $data['day'] = $solar_time[2];
                $data['list'] = $this->Mconsume_list->get_consume_list($solar_time[0], $solar_time[1], $solar_time[2], $where);
            }
        } else {
            $data['year'] = $year = intval($year);
            $data['month'] = $month = intval($month);
            !$year && show_404();
            (!$month || $month > 12) && show_404();
            # 获取订单
            $data['list'] = $this->Mconsume_list->get_consume_list($year, $month, '', $where);
        }
//        var_dump( $data['list']);
        $data['venue_list'] = $this->Mvenue->get_lists("name");
        if (!empty($venue_name) && $venue_name != 2 && !empty($data['list'])) {
           foreach ($data['list'] as $k => $v) {
               $pattern = "/$venue_name/";
               preg_match($pattern, $v['dinner_info']['venue_name'],$matches);
               if (!preg_match($pattern, $v['dinner_info']['venue_name'],$matches)) {
                    unset($data['list'][$k]);
               }
           }
        }
        $this->load->view('consume/lists', $data);
    }

    /**
     * 消费清单
     * @author chaokai@gz-zc.cn
     */
    public function edit(){
        $dinner_id = intval($this->input->get('dinner_id'));
        !$dinner_id && show_404();
        $data = $this->data;

        $info = $this->Mdinner->info($dinner_id);
        !$info && show_404();
        $data['info'] = $info;

        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        //宴会类型
        $data['dinner_type'] = array_column(C('party'), 'name', 'id');
        //套餐
        $combo = $this->Mcombo->get_lists('id,price', array('is_del' => 0));
        $data['combo'] = array_column($combo, 'price', 'id');

        //查询是否存在清单记录
        $consume = $this->Mconsume_list->get_one('*', array('dinner_id' => $dinner_id));
        $data['consume_is_pay'] = $this->consume_is_pay;
        if(!empty($consume)){
            $data['consume'] = $consume;
            $data['consume_list'] = $this->Mconsume_extend->get_lists('*', array('consume_id' => $consume['id'], 'is_del' => 0), array('id' => 'asc'));
        }
        $this->load->view('consume/info', $data);
    }

    /**
     * 消费清单
     * @author chaokai@gz-zc.cn
     */
    public function detail(){
        $dinner_id = intval($this->input->get('dinner_id'));
        !$dinner_id && show_404();
        $data = $this->data;
        //移动设备判断
        $data['is_mobile'] = ismobile();
        $info = $this->Mdinner->info($dinner_id);
        !$info && show_404();
        $data['info'] = $info;

        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        //宴会类型
        $data['dinner_type'] = array_column(C('party'), 'name', 'id');
        //套餐
        $combo = $this->Mcombo->get_lists('id,price', array('is_del' => 0));
        $data['combo'] = array_column($combo, 'price', 'id');

        //查询是否存在清单记录
        $consume = $this->Mconsume_list->get_one('*', array('dinner_id' => $dinner_id));
        if(!empty($consume)){
            $data['consume'] = $consume;
            $data['consume_list'] = $this->Mconsume_extend->get_lists('*', array('consume_id' => $consume['id'], 'is_del' => 0), array('id' => 'asc'));
            //获取保证桌数promise_count
            $dinner_id = $consume['dinner_id'];
            $data['promise_count'] = $this->Mdinner->get_one('id, promise_count', ['id' => $dinner_id]);
        }
        if($this->input->is_ajax_request()){
            $id = $this->input->post('id');
            $is_print = $this->input->post('is_print');
            $status = $this->Mconsume_list->get_one('is_print',['dinner_id' => $id]);
            if($status['is_print'] == 0){
                $this->Mconsume_list->update_info(array('is_print'=>$is_print), ['dinner_id' => $id]);
            }
        }
        $data['consume_is_pay'] = $this->consume_is_pay;
        
        $this->load->view('consume/detail', $data);
    }

    /**
     * 订单详情
     * @author chaokai@gz-zc.cn
     */
    public function dinner_detail($id){
    	$data = $this->data;
        !$id && show_404();
    
        $info = $this->Mdinner->info($id);
        !$info && show_404();
        //场馆
        $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $info['venue_ids'])));
        $venue_name = '';
        foreach ($venue as $v){
            $venue_name .= $v['name'].';';
        }
        $info['venue_name'] = $venue_name;
        //宴会类型
        $dinnertype = array_column(C('party'), 'name', 'id');
        $info['venue_type_name'] = $dinnertype[$info['venue_type']];
    
        $data = $this->data;
        $data['info'] = $info;
        $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $data['info']['create_admin']));
        $data['info']['create_admin'] = isset($admin_name['fullname']) && $admin_name['fullname'] ? $admin_name['fullname'] : ' ';
    
        $data['title'] = array(
            ['url' => '/common', 'text' => '首页'],
            ['url' => $_SERVER['HTTP_REFERER'], 'text' => '订单列表'],
            ['url' => '', 'text' => '预约详情']
        );
        
        
        $data['list'] = $this->change_record($id);
        
        //获取 dinner_extend 信息
        $dinner_extend_config = C('dinner_extend');
        $dinner_extend_config_text = array_column($dinner_extend_config, 'name', 'id');
        $invination_config = array_column($dinner_extend_config['invitation']['type'], 'name', 'id');
        
        $dinner_extend = $this->Mdinner_extend->get_lists('*', ['is_del' => 0, 'dinner_id' => $id]);
        foreach ($dinner_extend as $k => $v){
            $outstr = '';
            if ($v['num']) {
                if ($v['type'] == $dinner_extend_config['invitation']['id']) {
                    $outstr .= $invination_config[$v['num']];
                } else {
                    $outstr .= '  数量:'. $v['num'];
                }
            }
        
            if ($v['remark']) {
                $outstr .= '  备注:'. $v['remark'];
            }
        
            $dinner_extend[$k]['key_text'] = $dinner_extend_config_text[$v['type']];
            $dinner_extend[$k]['outstr'] = $outstr;
        
        }
        
        $data['dinner_extend'] = array_chunk($dinner_extend, 2);
        
        $this->load->view('consume/dinner_detail', $data);
    }

    
    
    public function change_record($id = 0){
        $data = $this->data;
    
        //获取宴会信息
        $dinner_info = $this->Mdinner->info($id);
        $data['dinner'] = $dinner_info;
    
        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取套餐信息
        $combo_menu = $this->Mcombo->lists();
        $data['combo_menu'] = array_column($combo_menu, 'combo_name', 'id');
        $data['combo_menu'][0] = '套餐未确定';
        //获取变更记录
        $change_cord = $this->Mchange_record->get_lists('*', ['dinner_id' => $id, 'is_del' => 0], 0, 0, ['create_time' => 'desc']);
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
        //审核状态
        $auth_status = array_column(C('dinner.examine'), 'name', 'id');
        foreach ($change_cord as $k => $v) {
        
            //$v['key_text'] = isset($key_to_text[$v['key']]) ? $key_to_text[$v['key']] : '';
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
        //$this->load->view('dinner/change_record', $data);
        }
    
                    
                    
    /**
     * 将宴会场馆id 转换为 场馆名称
     *
     * @author louhang@gz-zc.cn
     */
    public function get_venue_name($venue_ids, $venues = []){
    
        $venue_ids = explode(',', $venue_ids);
    
        foreach ($venue_ids as $k => $v) {
            $venue_ids[$k] = isset($venues[$v]) ? $venues[$v] : '';
        }
    
        $venue_ids = implode(',', $venue_ids);
    
        return $venue_ids;
    
    }
    
    /**
     * 添加消费清单
     * @author chaokai@gz-zc.cn
     */
    public function add_jump(){
    	$data = $this->data;
        $data['title'] = array('订单列表', '订单搜索');
        
        $this->load->helper('date');
        
        $time = $this->input->get('time');
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));
        
        $data['search'] = 0;
        if($name || $mobile || $time){
            $data['search'] = 1;
            
            $data['name'] = $name;
            $data['mobile'] = $mobile;
            $data['time'] = $time;
            
            $data['venue'] = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
            $data['venue'] = array_column($data['venue'], 'name', 'id');
            
            $admins = $this->Madmins->get_lists('id, fullname, tel', array());
            $data['admins'] = array_column($admins, 'fullname', 'id');
            $data['admins_tel'] = array_column($admins, 'tel', 'id');
            
            
            $data['list'] = $this->Mmenu->search_consume_list($time, $name, $mobile);
            $data['list'] = $this->Mdinner->deal_dinner($data['list']);
            $dinner_ids = array_column($data['list'] ?: [], 'id') ?: '';
            if($dinner_ids){
                $venue_ids = $this->Mdinner_venue->get_lists('*', array('in' => array('dinner_id' => $dinner_ids)));
                $new_venue_id = array();
                foreach ($venue_ids as $k=>$v){
                    $new_venue_id[$v['dinner_id']][] = $v['venue_id'];
                }
                foreach ($new_venue_id as $k=>$v){
                    foreach ($v as $key => $val){
                        $new_venue_id[$k][$key] = $data['venue'][$val];
                    }
                }
                foreach ($new_venue_id as $k=>$v){
                    $new_venue_id[$k] = implode(',', $v);
                }
                $data['venue_name'] = $new_venue_id;
            }
            //获取联系人、电话
            $user_id = array_column($data['list'], 'user_id');
            if($user_id){
                $user_lists = $this->Mcustomer->lists(array('in' => array('id' => $user_id)));
                $data['user_lists'] = array_column($user_lists, NULL, 'id');
            }
            $data['data_count'] = $data['list'] ? count($data['list']) : 0;
        }
        
        $this->load->view('consume/add_jump', $data);
        
        
    }

    /**
     * 搜索列表
     */
    public function search_list(){
        $data= $this->data;
        $data['title'] = array('订单列表', '搜索列表');
        $this->load->helper('date');
        
        $time = $this->input->get('time');
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));
        
        //获取所有场馆
        $data['venue'] = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = array_column($data['venue'], 'name', 'id');
        if($name || $mobile || $time){
            $data['list'] = $this->Mmenu->search_consume_list($time, $name, $mobile);
            $data['list'] = $this->Mdinner->deal_dinner($data['list']);
            $dinner_ids = array_column($data['list'] ?: [], 'id') ?: '';
            if($dinner_ids){
                $venue_ids = $this->Mdinner_venue->get_lists('*', array('in' => array('dinner_id' => $dinner_ids)));
                $new_venue_id = array();
                foreach ($venue_ids as $k=>$v){
                    $new_venue_id[$v['dinner_id']][] = $v['venue_id'];
                }
                foreach ($new_venue_id as $k=>$v){
                    foreach ($v as $key => $val){
                        $new_venue_id[$k][$key] = $data['venue'][$val];
                     }
                }
                foreach ($new_venue_id as $k=>$v){
                    $new_venue_id[$k] = implode(',', $v);
                }
                $data['venue_name'] = $new_venue_id;
            }
            //获取联系人、电话
            $user_id = array_column($data['list'], 'user_id');
            if($user_id){
                $user_lists = $this->Mcustomer->lists(array('in' => array('id' => $user_id)));
                $data['user_lists'] = array_column($user_lists, NULL, 'id');
            }
            $data['data_count'] = $data['list'] ? count($data['list']) : 0;
        }
        $admins = $this->Madmins->get_lists('id, fullname, tel', array());
        $data['admins'] = array_column($admins, 'fullname', 'id');
        $data['admins_tel'] = array_column($admins, 'tel', 'id');
        $this->load->view('consume/search_list', $data);
    }

    /**
     * 清单添加
     * @author chaokai@gz-zc.cn
     */
    public function consume_add(){
        $data = $this->data;
        if(IS_POST){
            $post_data = $this->input->post();
            if(empty($post_data['dinner_id'])){
                $this->return_failed('参数错误');
            }
            if($post_data['is_addeat'] != 0 && $post_data['addeat_date'] == ''){
                $this->return_failed('补吃时间为空');
            }

            $consume_list = $post_data['list'];
            unset($post_data['list']);
            //价格计算
            $post_data['menus_count'] = $consume_list[0]['count'];
            $post_data['menus_fee'] = $consume_list[0]['count'] * $consume_list[0]['price'];

            //判断是否存在，如果存在即更新
            $is_exist = $this->Mconsume_list->get_one('id', array('dinner_id' => $post_data['dinner_id']));
            if($is_exist){
                $post_data['update_time'] = date('Y-m-d H:i:s');
                $post_data['update_admin'] = $data['userInfo']['id'];
                $this->Mconsume_list->update_info($post_data, array('dinner_id' => $post_data['dinner_id']));
                $consume_id = $is_exist['id'];
            }else{
                $post_data['create_time'] = date('Y-m-d H:i:s');
                $post_data['create_admin'] = $data['userInfo']['id'];
                $consume_id = $this->Mconsume_list->create($post_data);
            }

            //删除原来记录
            $this->Mconsume_extend->update_info(array('is_del' => 1), array('consume_id' => $consume_id));
            foreach($consume_list as $k => $v){
                $consume_list[$k]['create_time'] = date('Y-m-d H:i:s');
                $consume_list[$k]['create_admin'] = $data['userInfo']['id'];
                $consume_list[$k]['consume_id'] = $consume_id;
            }
            $this->Mconsume_extend->create_batch($consume_list);


            $this->return_success();
        }else{
            $this->return_failed('方法错误');
        }
    }

    /**
     * 删除预约
     * @author chaokai@gz-zc.cn
     */
    public function del($id){
        $data = $this->data;
        $id = intval($id);
        !$id && $this->return_failed('参数不合法');
        if($data['pur_code'] == 1){
            $this->return_failed('你没有权限');
        }
        
        if($this->Mconsume_list->update_info(array('is_del' => 1), array('id' => $id))){
            $this->return_success([], '删除成功');
        }else{
            $this->return_failed('操作失败');
        }
    }

    /**
     * 保存签名
     * @author chaokai@gz-zc.cn
     */
    public function sign_save(){
        $data = $this->data;
        if(IS_POST){
            $post_data = $this->input->post();
            if(empty($post_data['dinner_id'])){
                $this->return_failed('参数错误');
            }

            $post_data['update_time'] =$post_data['sign_time'] = date('Y-m-d H:i:s');
            $post_data['update_admin'] = $data['userInfo']['id'];
            $this->Mconsume_list->update_info($post_data, array('dinner_id' => $post_data['dinner_id']));

            $this->return_success();
        }else{
            $this->return_failed('方法错误');
        }
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
                $where["{$key} <>"] = 2;
            }
        }
        return $where;
    }
}