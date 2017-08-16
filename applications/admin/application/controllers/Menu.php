<?php

/**
 * 订单管理
 * @author songchi@gz-zc.cn
 */
class Menu extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model(array(
                'Model_dinner' => 'Mdinner',
                'Model_customer_review' => 'Mcustomer_review',
                'Model_venue' => 'Mvenue',
                'Model_admins' => 'Madmins',
                'Model_admins_group' => 'Madmins_group',
                'Model_staff_schedule' => 'Mstaff_schedule',
                'Model_menu'=>'Mmenu',
                'Model_theme'=>'Mtheme',
                'Model_dinner_venue'=>'Mdinner_venue',
                'Model_venue'=>'Mvenue',
                'Model_customer' => 'Mcustomer',
                        'Model_milan_combo' => 'Mmilan_combo',
                        'Model_milan_execute' => 'Mmilan_execute',
        ));
        
        $this->load->library('pagination');
        $this->load->library('form_validation');
        
        $this->data['status'] = C('milan_schedule_status');
        $this->data['examination_status'] = C('examination_status');
    }
    
    /**
     * 列表页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        $data['title'] = array('首页', '订单管理');
        $year = date('Y');
        $data['year'] = array($year-1, $year, $year+1, $year+2);
        
        //获取每个月的订单数量
        $data['orders'] = $this->Mmenu->get_count();
        $this->load->view('menu/index', $data);
    }

    /**
     * 某月订单列表
     * @author songchi@gz-zc.cn
     */
    public function lists(){
        $data = $this->data;
        $data['title'] = array('首页', '订单管理', '订单列表');
        $year = intval($this->input->get('year'));
        $month = intval($this->input->get('month'));
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));
        $solar_time = trim($this->input->get('solar_time'));
        if($name || $mobile || $solar_time){
            $data['list'] = $this->Mmenu->search_menu_list($name, $mobile, $solar_time);
        }else{
            $data['year'] = $year = intval($year);
            $data['month'] = $month = intval($month);
            !$year && show_404();
            (!$month || $month > 12) && show_404();
    
            //获取订单
            $data['list'] = $this->Mmenu->get_menu_list($year, $month);
		//echo $this->db->last_query();
		//p($data['list']);
        }
        
        $menu_id = '';
        if($data['list']){
           $menu_id = array_column($data['list'], 'id');
        }
        
        //米兰职员
        $new_staff = array();
        if($menu_id){
            $staff_list = $this->Mstaff_schedule->get_lists('id, menu_id, status, staff_id, staff_type_id', array('is_del' => 0, 'in'=>array('menu_id'=>$menu_id)));
            if($staff_list){
                $staff_ids = array_column($staff_list, 'staff_id');
                $staff_name = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $staff_ids)));
                $staff_name = array_column($staff_name, 'fullname', 'id');

                $status = C('milan_schedule_status');
                $status = array_column($status, 'color_name', 'id');
                
                foreach ($staff_list as $k=>$v){
                    $staff_list[$k]['staff_name'] = isset($staff_name[$v['staff_id']]) ? $staff_name[$v['staff_id']] : '未知姓名';
                    $staff_list[$k]['status'] = isset($status[$v['status']]) ? $status[$v['status']] : '未知';
                    $new_staff[$v['menu_id']][$v['staff_type_id']] = $staff_list[$k];
                }
               
            }
        }
        
        $customer = array();
        if($data['list']){
            $customer = array_column($data['list'], 'customer_id');
        }
        
        $customer = array_unique($customer);
        $customer_id = array();
        foreach ($customer as $k=>$v){
            if(isset($v) && $v){
                $customer_id[$k] = $v;
            }
        }
        //获取联系人
        if($customer_id){
            $list = $this->Mcustomer->get_lists('id, name, mobile_phone', array('in'=>array('id'=>$customer_id)));
            if($list){
                $customer_tel = array_column($list, 'mobile_phone', 'id');
                $customer_name = array_column($list, 'name', 'id');
            }
        }
 
        if(isset($data['list']) && $data['list']){
            foreach ($data['list'] as $k=>$v){
                $data['list'][$k]['customer_name'] = isset($customer_name[$v['customer_id']]) ? $customer_name[$v['customer_id']]:'';
                $data['list'][$k]['customer_tel'] = isset($customer_tel[$v['customer_id']]) ? $customer_tel[$v['customer_id']]:'';
                $data['list'][$k]['milan_staffs'] = isset($new_staff[$v['id']]) ? $new_staff[$v['id']] : [];
            }
        }
        //获取宴会类型
        $dinner_ids = array_column($data['list'], 'dinner_id');
        if($dinner_ids){
            $type_list = $this->Mdinner->get_lists('id,venue_type', ['in' => ['id' => $dinner_ids], 'is_del' => 0]);
            if($type_list){
                foreach ($data['list'] as $k => $v){
                    foreach ($type_list as $key => $val){
                        if($v['dinner_id'] == $val['id']){
                            $data['list'][$k]['venue_id'] = $val['venue_type'];
                        }
                    }
                }
            }
        }
        $this->load->view('menu/lists', $data);
    }
    
    /**
     * 添加
     * @author songchi@gz-zc.cn
     */
    public function add($id=0){
        $data = $this->data;
        $data['title'] = array('订单列表', '订单添加');
        $data['dinner_id'] = $dinner_id = intval($id);
        //查询新郎、新娘、联系人
        $data['roles'] = $this->Mdinner->get_one('id, roles_main, roles_wife, solar_time, roles_main_mobile, roles_wife_mobile, user_id, banquet_time, lunar_time,venue_type', array('id'=>$dinner_id));
        if(isset($data['roles']['user_id']) && $data['roles']['user_id']){
            $data['customer'] = $this->Mcustomer->get_one('id, name, mobile_phone', array('id'=>$data['roles']['user_id']));
        }
        //查询大厅
        $venue_id = $this->Mdinner_venue->get_lists('venue_id', array('dinner_id'=>$dinner_id));
        $venue_id = array_column($venue_id, 'venue_id');
        
        if($venue_id){
            $where['in'] = array('id'=>$venue_id);
            $venue_name = $this->Mvenue->get_lists('id, name', $where);
            $data['venue_name'] = array_column($venue_name, 'name', 'id');
        }

        //米兰职员 角色类型
        $group = C('milan_staff_type');
        $group_ids = $group ? array_column($group, 'id') : '';

        $admin = $this->Madmins->get_lists('id, fullname, type, group_id', array('is_del'=>1, 'in' => array('group_id' => $group_ids )));
        $group = array_column($group, null, 'id');
        
        foreach ($admin as $k => $v){
            $group[$v['group_id']]['children'][] = $v;
        }
        $data['admins'] = $group;
        
        //获取套餐
        $data['combo_menu'] = $this->Mmilan_combo->get_lists('id, name, price', array('is_del' => 0));
        
        //获取主题
        $theme = $this->Mtheme->get_lists('id, title', array('is_del'=>0));
        $data['theme'] = array_column($theme, 'title', 'id');
        
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('venue_id', '场馆', 'trim|required', array('required' => '%s不能为空'));
            $tmp = (int) $this->input->post('venue_type');
            if($tmp == C('party.wedding.id')){
                $this->form_validation->set_rules('roles_main', '新郎', 'trim|required', array('required' => '%s不能为空'));
                $this->form_validation->set_rules('roles_wife', '新娘', 'trim|required', array('required' => '%s不能为空'));
            }else{
                $this->form_validation->set_rules('roles_main_other', '宴会主角', 'trim|required', array('required' => '%s不能为空'));
            }
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            $post_data = $this->input->post();
            
            //验证手机号
            if(isset($post_data['phone']) && $post_data['phone']){
                if(!preg_match(C('regular_expression.mobile'), $post_data['phone'])){
                    $this->return_failed('手机号格式不正确');
                }
            }
            
            //查询t_menu表里是否已经有这条订单数据
            if($this->Mmenu->get_one('id', array('is_del' => 0,'dinner_id'=>$post_data['dinner_id']))){
                $this->return_failed('订单已存在,不能重复添加');
            }
            
            
            $add_data['venue_id'] = $post_data['venue_id'];
            $add_data['customer_id'] = $post_data['customer_id'];
            if($tmp == C('party.wedding.id')){
                $add_data['roles_main'] = $post_data['roles_main'];
                $add_data['roles_main_mobile'] = $post_data['roles_main_mobile'];
                $add_data['roles_wife'] = $post_data['roles_wife'];
                $add_data['roles_wife_mobile'] = $post_data['roles_wife_mobile'];
            }
            $add_data['contract_num'] = $post_data['contract_num'];
            $add_data['contract_date'] = $post_data['contract_date'];
            $add_data['menus_id'] = $post_data['company'] == 'milan' ? $post_data['menus'] : '-1';
            $add_data['theme_id'] = $post_data['company'] == 'milan' ? $post_data['theme'] : '-1';
            $add_data['dinner_id'] = $post_data['dinner_id'];
            $add_data['solar_time'] = $post_data['solar_time'];
            $add_data['order_time'] = $post_data['order_time'];
            $add_data['create_time'] = date("Y-m-d H:i:s", time());
            $add_data['update_time'] = date("Y-m-d H:i:s", time());
            $add_data['manager'] = $post_data['manager'];
            $add_data['responsible_person'] = $post_data['responsible_person'];
            $add_data['agent'] = $post_data['agent'];
            $add_data['remark'] = $post_data['remark'];
            if($post_data['venue_type'] != C('party.wedding.id')){
                $add_data['roles_main'] = $post_data['roles_main_other'];
                $add_data['roles_main_mobile'] = $post_data['roles_main_other_mobile'];
                unset($post_data['roles_main_other'], $post_data['roles_main_other_mobile']);
            }
            
            $add_id = $this->Mmenu->create($add_data);
            
            $staff_data = array();
            if(isset($post_data['staff_type']) && $post_data['staff_type']){
                foreach($post_data['staff_type'] as $k=>$v){
                    $staff_data[] = array(
                                    'staff_id' => $v, 
                                    'staff_type_id' => $k, 
                                    'menu_id' => $add_id, 
                                    'schedule_time' => $post_data['solar_time']  
                    );
                }
                
                if($staff_data){
                    $add_batch = $this->Mstaff_schedule->create_batch($staff_data);
                    if($add_id && $add_batch){
                        $this->return_success(['menu_id'=>$add_id], '添加成功');
                    }else{
                        $this->return_failed('添加失败');
                    }
                }else{
                    $this->return_failed('添加失败');
                }
            }else{
                if($add_id){
                    $this->return_success([], '添加成功');
                }else{
                    $this->return_failed('添加失败');
                }
            }
            
            
            
        }
        
        $this->load->view('menu/add', $data);
    }
    
    public function edit($menu_id= 0){
        
        $data = $this->data;
        $data['title'] = array('订单列表', '订单修改');
        
        $admin = $this->Madmins->get_lists('id, fullname, type, group_id', array('is_del'=>1, 'type'=>C('public.type.milan_staff.id')), 0, 0, 0);
        if($admin){
            $admins = array();
            foreach ($admin as $k=>$v){
                if($v['group_id']){
                    $admins[$v['group_id']][] = $v;
                }
        
            }
        }
        
        //米兰档期
        $schedule = $this->Mstaff_schedule->get_lists('*', array('menu_id' => $menu_id, 'is_del' => 0));
        $data['schedule'] = array_column($schedule, 'staff_id');
       
        //米兰职员 角色类型
        $group = C('milan_staff_type');
        $group_ids = $group ? array_column($group, 'id') : '';

        $admin = $this->Madmins->get_lists('id, fullname, type, group_id', array('is_del'=>1, 'in' => array('group_id' => $group_ids )));
        $group = array_column($group, null, 'id');
        
        foreach ($admin as $k => $v){
            $group[$v['group_id']]['children'][] = $v;
        }
        $data['admins'] = $group;
        
        //获取套餐
        $data['combo_menu'] = $this->Mmilan_combo->get_lists('id, name, price', array('is_del' => 0));
        
        //获取主题
        $theme = $this->Mtheme->get_lists('id, title', array('is_del'=>0));
        $data['theme'] = array_column($theme, 'title', 'id');
        
        $data['menue_id'] = $menu_id;
        $where['is_del'] = 0;
        if($menu_id){
            $where['id'] = $menu_id;
            $info = $this->Mmenu->get_one('*', $where);
            //获取联系人
            $data['customer'] = $this->Mcustomer->get_one('id, name, mobile_phone', array('id'=>$info['customer_id']));
            //获取公历时间
            $data['time'] = $this->Mdinner->get_one('id, lunar_time, banquet_time', array('id'=>$info['dinner_id']));
            
            $data['dinner_id'] = $info['dinner_id'];
            
            //获取宴会类型
            $type = $this->Mdinner->get_one('venue_type', ['id' => $info['dinner_id']]);
            $data['venue_type'] = $type['venue_type'];
            //查询大厅
            $venue_id = $this->Mdinner_venue->get_lists('venue_id', array('dinner_id'=>$info['dinner_id']));
            $venue_id = array_column($venue_id, 'venue_id');
            
            if($venue_id){
                $query['in'] = array('id'=>$venue_id);
                $venue_name = $this->Mvenue->get_lists('id, name', $query);
                $data['venue_name'] = array_column($venue_name, 'name', 'id');
            }
            
            $info['presenter_id'] = explode(',', $info['presenter_id']);
            $info['steering_id'] = explode(',', $info['steering_id']);
            $info['dresser_id'] = explode(',', $info['dresser_id']);
            $info['photographer_id'] = explode(',', $info['photographer_id']);
            $info['lighter_id'] = explode(',', $info['lighter_id']);
            $data['info'] = $info;
            $data['menu_id'] = $menu_id;
            $data['solar_time'] = $info['solar_time'];
        }
        
        
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('venue_id', '场馆', 'trim|required', array('required' => '%s不能为空'));
            $tmp = (int) $this->input->post('venue_type');
            if($tmp == C('party.wedding.id')){
                $this->form_validation->set_rules('roles_main', '新郎', 'trim|required', array('required' => '%s不能为空'));
                $this->form_validation->set_rules('roles_wife', '新娘', 'trim|required', array('required' => '%s不能为空'));
            }else{
                $this->form_validation->set_rules('roles_main_other', '宴会主角', 'trim|required', array('required' => '%s不能为空'));
            }
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            
            $post_data = $this->input->post();
            //验证手机号
            if(isset($post_data['phone']) && $post_data['phone']){
                if(!preg_match(C('regular_expression.mobile'), $post_data['phone'])){
                    $this->return_failed('手机号格式不正确');
                }
            }

            $add_data['venue_id'] = $post_data['venue_id'];
            $add_data['contract_num'] = $post_data['contract_num'];
            $add_data['contract_date'] = $post_data['contract_date'];
            $add_data['menus_id'] = $post_data['company'] == 'milan' ? $post_data['menus'] : '-1';
            $add_data['theme_id'] = $post_data['company'] == 'milan' ? $post_data['theme'] : '-1';
            $add_data['update_time'] = date("Y-m-d H:i:s", time());
            $add_data['order_time'] = $post_data['order_time'];
            $add_data['manager'] = $post_data['manager'];
            $add_data['responsible_person'] = $post_data['responsible_person'];
            $add_data['agent'] = $post_data['agent'];
            
            $add_data['remark'] = $post_data['remark'];
            $update = $this->Mmenu->update_info($add_data, array('id'=>$post_data['id']));
            if (! $update) {
                $this->return_failed('修改失败');
            }
            
            //没有给米兰人员安排档期
            if (! isset($post_data['staff_type'])) {
                $post_data['staff_type'] = [];
            }

            //查找修改前的档期数据
            $old_staff = $this->Mstaff_schedule->get_lists('*', array('menu_id'=>$post_data['id'], 'is_del' => 0));
            $old_staff = $old_staff ? array_column($old_staff, 'staff_id', 'staff_type_id') : [];
            //待添加的新档期数据
            $add_data = array();
            //被覆盖的旧数据
            $del_data = array();
            
            foreach ($post_data['staff_type'] as $k => $v) {
                if (! isset($old_staff[$k])) {
                    $add_data[$k] = $v;
                } elseif ($old_staff[$k] != $v) {
                    $add_data[$k] = $v;
                    $del_data[$k] = $old_staff[$k];
                    unset($old_staff[$k]);
                } else {
                    unset($old_staff[$k]);
                }
            }
            //需要删除的旧数据： 被覆盖的旧数据 + 被弃用的旧数据
            $del_data = $del_data + $old_staff;
            //将需要删除的旧数据在数据库标记 is_del = 1
            $del_data = $del_data ? $del_data : '';
            $res = $this->Mstaff_schedule->update_info(
                array('is_del' => 1),
                array(
                    'menu_id' => $post_data['id'],
                    'in' => array('staff_id' => $del_data)
                )
            );
            //短信提醒米兰人员 档期被取消
            
            if ($del_data) {
                $this->Mmilan_execute->update_info(array('is_del' => 1), array('menu_id' => (int)$post_data['id'], 'in' => array('staff_id' => $del_data)));
                $res = $this->send_message_for_cancel((int)$post_data['id'], $del_data);
            }
            
            $staff_data = array();
            if (! empty($add_data)) {
                foreach ($add_data as $k => $v) {
                    $staff_data[] = array(
                        'staff_id' => $v,
                        'staff_type_id' => $k,
                        'menu_id' => $post_data['id'],
                        'schedule_time' => $post_data['solar_time']
                    );
                }
                
                $add_batch = $this->Mstaff_schedule->create_batch($staff_data);
                if ($add_batch) {
                    $this->return_success(array('menu_id' => $post_data['id']), '修改成功');
                } else {
                    $this->return_failed('修改失败');
                }
            } else {
                // 若没有添加新档期数据，则返回成功，不用发短信
                $this->return_success([], '修改成功');
            }
            

        }

        $this->load->view('menu/edit', $data);
        
    }
    
    public function del($menue_id){
        $data = $this->data;
        $id = intval($menue_id);
        !$id && $this->return_failed('参数不合法');
        if($data['pur_code'] == 1){
            $this->return_failed('你没有权限!');
        }
        
        if($this->Mmenu->update_info(array('is_del' => 1), array('id' => $id))){
            $this->Mstaff_schedule->update_info(array('is_del' => 1), array('menu_id' => $id));
            $this->Mmilan_execute->update_info(array('is_del' => 1), array('menu_id' => $id));
            $this->return_success([], '删除成功');
        }else{
            $this->return_failed('操作失败');
        }
        
    }
    
    
    //查询档期
    public function blank(){
        if($this->input->is_ajax_request()){
            $id = intval($this->input->post('id'));
            $schedule_time = $this->input->post('schedule_time');
            
            $admin = $this->Madmins->get_one('fullname', array('id'=>$id));
            $data['admin'] = $admin ? $admin : ''; 
            $type = intval($this->input->post('type'));
            $where['is_del'] = 0;
            $where['staff_id'] = $id;
            
            
            $this->load->helper('date');
            $year = date('Y', time());
            $month = date('m', time());
            if(!empty($schedule_time)){
                $schedule_time = explode('-', $schedule_time);
                $year = $schedule_time[0];
                $month = $schedule_time[1];
            }
            $data['year'] = $year;
            $data['month'] = $month;
            $data['days'] = $days = days_in_month($month, $year);
            $where['schedule_time>='] = $year.'-'.$month.'-01';
            $where['schedule_time<='] = $year.'-'.$month.'-'.$days;
            
            $list = $this->Mstaff_schedule->get_lists('*', $where, 0 , 0 , 0 ,'schedule_time');
	    $list_all = $this->Mstaff_schedule->get_lists('id, staff_id,schedule_time,count(schedule_time) as count ', $where, 0 , 0 , 0 ,'schedule_time');
	    
	    $list_all = array_column($list_all, 'count', 'schedule_time'); 
	    //$list_all = array_column($list_all, 'schedule_time');		
            $data['count'] = $list_all;
	    $time = array_column($list, 'schedule_time');
            $rest_date = array();
            if($list){
                for ($i = 1; $i <= $days; $i++){
                    $m = $month;
                    $d = $i < 10 ? '0'.$i : $i;
                    if(in_array($year.'-'.$m.'-'.$d, $time)){
			//if(){

			//}
                        $rest_date[$i]['time'] = $year.'-'.$m.'-'.$d;
                        $rest_date[$i]['is_full'] = true;
                        
                    }else{
                        $rest_date[$i]['time'] = $year.'-'.$m.'-'.$d;
                        $rest_date[$i]['is_full'] = false;
                    }
            
                }
                
            }else{
                for ($i = 1; $i <= $days; $i++){
                    $m = $month;
                    $d = $i < 10 ? '0'.$i : $i;
                    $rest_date[$i]['time'] = $year.'-'.$m.'-'.$d;
                    $rest_date[$i]['is_full'] = false;
                }
            }
            
            $data['list'] = $rest_date;
            $this->load->view('menu/blank', $data);
        }
        
    }
    
    
    public function add_jump(){
        $data = $this->data;
        $data['title'] = array('订单列表', '订单搜索');
        
        $this->load->view('menu/add_jump', $data);
    }
    
    
    public function search_list(){
        $data= $this->data;
        $data['title'] = array('订单列表', '搜索列表');
        $this->load->helper('date');
        
        $time = $this->input->get('time');
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));
        
        if($name || $mobile || $time){
            $data['list'] = $this->Mmenu->search_dinner_list($time, $name, $mobile);
            
            $data['data_count'] = $data['list'] ? count($data['list']) : 0;
        }
        
        $this->load->view('menu/search_list', $data);
    }
    
    
    
    public function dinner_detail($id = 0){
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
        $this->load->view('menu/dinner_detail', $data);
    }
    
    
    /**
     * 显示订单详情
     * @author songchi@gz-zc.cn
     */
    public function show_detail($id = 0){
        $data = $this->data;
        $id = intval($id);
        !$id && show_404();
        
        $info = $this->Mmenu->info($id);
        
        !$info && show_404();
        
        $dinner = $this->Mdinner->info($info['dinner_id']);
        $dinnertype = array_column(C('party'), 'name', 'id');
        $dinner['venue_type_name'] = $dinnertype[$dinner['venue_type']];
        
        if($dinner){
            $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $dinner['venue_ids'])));
            $venue_name = '';
            foreach ($venue as $v){
                $venue_name .= $v['name'].';';
            }
            $dinner['venue_name'] = $venue_name;
        }
        
        $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $dinner['create_admin']));
        $dinner['create_admin'] = isset($admin_name['fullname']) && $admin_name['fullname'] ? $admin_name['fullname'] : ' ';
        
        //米兰职员 角色类型
        $staffs = $this->Mstaff_schedule->get_lists('*', array('menu_id' => $id, 'is_del' => 0));
        $staff_ids = $staffs ? array_column($staffs, 'staff_id') : '';
        $staffs = $this->Madmins->get_lists('id, fullname, type, group_id', array('is_del'=>1, 'in' => array('id' => $staff_ids )));

        //角色职位名称
        $group = $this->Madmins_group->get_lists('id,name');
        $group = array_column($group, 'name', 'id');
        
        //档期状态
        $schedule = $this->Mstaff_schedule->get_lists('id, staff_id, status', array('menu_id' => $id, 'is_del'=>0, 'in' => array('staff_id' => $staff_ids )));
        $schedule = $schedule ? array_column($schedule, 'status', 'staff_id') : [];
        
        //执行单状态
        $receipt = $this->Mmilan_execute->get_lists('id, staff_id, status', array('is_del' => 0 ,'menu_id' => $id, 'in' => array('staff_id' => $staff_ids )));
        $receipt = $receipt ? array_column($receipt, 'status', 'staff_id') : [];
     
        $status = C('milan_schedule_status');
        $status = array_column($status, 'color_name', 'id');
       
        foreach ($staffs as $k => $v){
            $staffs[$k]['group'] =  $group[$v['group_id']];
            $staffs[$k]['schedule_status'] =  isset($schedule[$v['id']]) ? $status[$schedule[$v['id']]] : '';
            $staffs[$k]['receipt_status'] =  isset($receipt[$v['id']]) ? $status[$receipt[$v['id']]] : '';
        }
        $data['staffs'] = array_chunk($staffs, 2);
        
        $data['dinner'] = $dinner;
        $data['info'] = $info;
        $data['menu_id'] = $id;
        $data['title'] = array(
            ['url' => '/common', 'text' => '首页'],
            ['url' => $_SERVER['HTTP_REFERER'], 'text' => '订单列表'],
            ['url' => '', 'text' => '详情']
        );
        //获取套餐价格
        if($info['menus_id']){
            $price = $this->Mmilan_combo->get_one('price', ['id' => $info['menus_id']]);
            if($price){
                $data['info']['price'] = $price['price'];
            }
        }
        $this->load->view('menu/detail', $data);
    }
    
    /**
     * 针对单个工作人员发送信息
     * @author fengyi@gz-zc.cn
     */
    public function per_send_message(){
        if($this->input->is_ajax_request()){
            $menu_id = intval($this->input->post('menu_id'));
            $staff_id = intval($this->input->post('staff_id'));
            
            $user_id = $this->Madmins->get_lists('id, fullname, tel', array('id' => $staff_id));
            $name = array_column($user_id, 'fullname', 'id');
            $tel = array_column($user_id, 'tel', 'id');
            
            $venues = $this->Mvenue->get_lists('*');
            $venues = array_column($venues, 'name', 'id');
        
            //获取工作人员手机号
            $staff_tel = $this->Mstaff_schedule->get_lists(
                'staff_id, schedule_time',
                array(
                    'menu_id' => $menu_id,
                    'status' => 0,
                    'is_del' => 0
                )
            );
            $schedule_time = reset($staff_tel)['schedule_time'];
            $staff_tel = array_column($staff_tel, 'staff_id');
            $new_tel = array();
            foreach ($staff_tel as $k=>$v){
                if(isset($tel[$v]) && $tel[$v]){
                    $new_tel[$k] = $tel[$v];
                }
            }
        
            //获取婚宴日期，地点
            $venue = $this->Mmenu->get_one('dinner_id, venue_id', array('id' => $menu_id, 'is_del' => 0));
            $venue = $venues[$venue['venue_id']];
        
            //发送短信
            if($new_tel){
                $res = send_msg($new_tel, 'schedule_assign', ['solar_time' => $schedule_time, 'venue' => $venue]);
        
                if($res){
                    $this->return_success(array('send_msg_num' => is_array($new_tel) ? count($new_tel) : 1),'发送成功');
                }else{
                    $this->return_failed('发送失败');
                }
            }
        }
    }
    
    public function send_message(){
        if($this->input->is_ajax_request()){
            $menu_id = $this->input->post('menu_id');
            $user_id = $this->Madmins->get_lists('id, fullname, tel', array('type!='=>0));
            $name = array_column($user_id, 'fullname', 'id');
            $tel = array_column($user_id, 'tel', 'id');
            $venues = $this->Mvenue->get_lists('*');
            $venues = array_column($venues, 'name', 'id');
            
            //获取工作人员手机号
            $staff_tel = $this->Mstaff_schedule->get_lists(
                    'staff_id, schedule_time', 
                    array(
                        'menu_id' => $menu_id,
                        'status' => 0,
                        'is_del' => 0
                    )
            );
            $schedule_time = reset($staff_tel)['schedule_time'];
            $staff_tel = array_column($staff_tel, 'staff_id');
            $new_tel = array();
            foreach ($staff_tel as $k=>$v){
                if(isset($tel[$v]) && $tel[$v]){
                    $new_tel[$k] = $tel[$v];
                }
            }

            //获取婚宴日期，地点
            $venue = $this->Mmenu->get_one('dinner_id, venue_id', array('id' => $menu_id, 'is_del' => 0));
            $venue = $venues[$venue['venue_id']];

            //发送短信
            if($new_tel){
                //$res = send_msg_huaxing($new_tel, "您于 {$schedule_time} ,在 {$venue} 有一场米兰档期预约，请登录后查看详情 http://rrd.me/bgcSS");
                $res = send_msg($new_tel, 'schedule_assign', ['solar_time' => $schedule_time, 'venue' => $venue]);
                
                if($res){
                    $this->return_success(array('send_msg_num' => is_array($new_tel) ? count($new_tel) : 1),'发送成功');
                }else{
                    $this->return_failed('发送失败');
                }
            }
        }
    }
    
    /**
     * 获取执行单模板
     * @author louhang@gz-zc.cn
     */
    public function get_receipt(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->get();
            $data['menu_id'] = $menu_id = (int)$post_data['menu_id'];
            $data['staff_type_id'] = $staff_type_id = (int)$post_data['staff_type_id'];
            $is_onlyread = (int)$post_data['is_onlyread'];
            
            //menu info
            $menu = $this->Mmenu->info($menu_id);
            $time = explode('-', $menu['solar_time']);
            $menu['year'] = $time[0];
            $menu['month'] = $time[1];
            $menu['day'] = $time[2];
            //dinner_type
            $dinner = $this->Mdinner->get_one('venue_type', array('id' => $menu['dinner_id']));
            $data['dinner_type_id'] = $dinner['venue_type'];
            //venue
            $menu['venue'] = $menu['venue_name'];
            $data['menu'] = $menu;

            //经办人姓名
            $data['operator'] = $data['userInfo']['fullname'];
            
            //获取职员名字
            $staff = $this->Mstaff_schedule->get_one('staff_id', array('is_del' => 0,'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
            $name = $this->Madmins->get_lists('fullname', array('in' => array('id' => explode(',', $staff['staff_id']))));
            $name = array_column($name, 'fullname');
            $data['staff_name'] = implode(',' ,$name);
            
            //执行单信息
            $receipt = $this->Mmilan_execute->get_one('*', array('is_del' => 0 ,'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
            if($receipt){
                $receipt['other'] = json_decode($receipt['other'], TRUE);
            }
            $data['receipt'] = $receipt;

            if($is_onlyread){
                $this->load->view('menu/receipt/onlyread/common_receipt', $data);
            }else{
                $this->load->view('menu/receipt/common_receipt', $data);
            }
            
        }
    }
    
    
    /**
     * 保存执行单 
     * @author louhang@gz-zc.cn
     */
    public function save_receipt(){
        if($this->input->is_ajax_request()){
            
            $post_data = $this->input->post();
            $menu_id = $post_data['menu_id'] = (int)$post_data['menu_id'];
            $staff_type_id = $post_data['staff_type_id'] = (int)$post_data['staff_type_id'];
            
            //获取staff_id
            $staff = $this->Mstaff_schedule->get_one('*', array('is_del' => 0,'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
            $post_data['staff_id'] = $staff['staff_id'];
            
            //other字段转为json字符串
            if(isset($post_data['other']))
                $post_data['other'] = json_encode($post_data['other']);
            
            //一旦修改执行单，重置状态，需要执行人重新确认,审核状态也要重置
            $post_data['status'] = 0;
            $post_data['examination_status'] = 0;
            
            //经办人姓名
            $post_data['operator'] = $this->data['userInfo']['fullname'];
            //开单日期
            $post_data['create_time'] = date('Y-m-d');

            //update database
            $is_exist = $this->Mmilan_execute->get_one('id', array('is_del' => 0 ,'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
            if($is_exist){
                $res = $this->Mmilan_execute->update_info($post_data, array('id' => $is_exist['id']));
            }else {
                $res = $this->Mmilan_execute->create($post_data);
            }
            
            if($res){
                //短信通知
                $this->send_message_for_receipt($menu_id, $staff_type_id);
                
                $this->return_success('', '保存成功!');
            }else{
                $this->return_failed('保存失败请稍后再试');
            }
            
        }
    }
    
    /**
     * 执行单短信发送
     * @author louhang@gz-zc.cn
     */
    public function send_message_for_receipt($menu_id, $group_id){

        //获取工作人员id
        $staff = $this->Mstaff_schedule->get_one('staff_id, schedule_time', array('is_del' => 0, 'menu_id'=>$menu_id, 'staff_type_id' => $group_id));
        if($staff){
            $staff = $this->Madmins->get_one('id, fullname, tel', array('id' => $staff['staff_id']));
        }

        
        //获取婚宴日期，地点
        $venues = $this->Mvenue->get_lists('*');
        $venues = array_column($venues, 'name', 'id');
        $venue = $this->Mmenu->get_one('dinner_id, venue_id', array('id' => $menu_id, 'is_del' => 0));
        if($venue){
            $venue = $venues[$venue['venue_id']];
        }else{
            return false;
        }
        
        //发送短信
        if($staff){
            //send_msg_huaxing($staff['tel'], "您在 {$venue} 有新的执行任务，请登录后查看详情 http://rrd.me/bgcSS");
            send_msg($staff['tel'], 'receipt_assign', ['venue' => $venue]);
        }
        
    }
    
    /**
     * 档期取消 短信提醒
     * @author louhang@gz-zc.cn
     */
    public function send_message_for_cancel($menu_id, $staff_ids){
        //获取工作人员id
        if ($staff_ids) {
            $staffs_info = $this->Madmins->get_lists('id, fullname, tel', array('in' => array('id' => $staff_ids)));
        } else {
            return false;
        }
        
        $menu_info = $this->Mmenu->get_one('venue_id, solar_time', array('id' => $menu_id));

        //获取婚宴日期，地点
        $venues = $this->Mvenue->get_lists('*');
        $venues = array_column($venues, 'name', 'id');

        if ($menu_info) {
            $venue = isset($venues[$menu_info['venue_id']]) ? $venues[$menu_info['venue_id']] : '百年婚宴';
        } else {
            return false;
        }
        
        //发送短信
        if (! $staffs_info) {
            return false;
        }
        $tels = array_column($staffs_info, 'tel');

        //send_msg_huaxing($tels, "您于{$menu_info['solar_time']}在{$venue} 的档期预约已取消，请登录后查看详情 http://rrd.me/bgcSS");
        send_msg($tels, 'schedule_cancel', ['solar_time' => $menu_info['solar_time'], 'venue' => $venue]);
    }
    
    /**
     * 在接下来30内 百年婚宴订单
     * @author louhang@gz-zc.cn
     */
    public function dinner_of_next_30days() {
        
        $data = $this->data;
        $data['title'] = array('首页', '订单管理', '订单列表');
        $year = intval($this->input->get('year'));
        $month = intval($this->input->get('month'));
    
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));

        //获取订单
        $data['list'] = $this->Mdinner->get_netx_days_dinner_list(30);

        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname',array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
            
            $dinner_ids = array_column($data['list'] , 'id');
            $milan_menus = $this->Mmenu->get_lists('id, dinner_id', array('in' => array('dinner_id' => $dinner_ids, 'is_del' => 0)));
            $milan_menus = $milan_menus ? array_column($milan_menus, 'id', 'dinner_id') : [];
            
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] =$create_admins[$val['create_admin']];
                    
                    $data['list'][$key]['milan_menu_id'] = isset($milan_menus[$val['id']]) ? $milan_menus[$val['id']] : '';
                }
            }
        }
        

        $this->load->view('dinner_of_next_30days/lists', $data);
    }

}
