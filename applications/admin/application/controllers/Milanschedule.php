<?php 
/**
* 米兰国际人员 档期安排
* @author louhang@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Milanschedule extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->data['userInfo'] = $this->session->userdata('USER');
        $this->load->model([
               'Model_staff_schedule' => 'Mstaff_schedule',
               'Model_admins' => 'Madmins',
               'Model_dinner' => 'Mdinner',
               'Model_menu' => 'Mmenu',
               'Model_venue' => 'Mvenue',
                'Model_milan_execute' => 'Mmilan_execute',
                'Model_admins_group' => 'Madmins_group',
                'Model_customer' => 'Mcustomer',
               'Model_milan_combo' => 'Mmilan_combo',

        ]);
        $this->pageconfig = C('page.config_log');
        $this->data['status'] = C('milan_schedule_status');
        $this->data['examination_status'] = C('examination_status');


        $this->load->library('pagination');
        $this->load->library('form_validation'); 
    }
    
    /**
     * 首页
     * @author louhang@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        if(empty($data['userInfo'])){
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }

        //未读档期信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
        
        //已读档期信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => C('milan_schedule_status.confirm.status'));
        $data['read_message_count'] = $this->Mstaff_schedule->count($where);
        
        //已拒绝档期信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => C('milan_schedule_status.refuse.status'));
        $data['refuse_message_count'] = $this->Mstaff_schedule->count($where);
        
        //未读审核执行单统计
        $where = array(
                        'status' => C('milan_schedule_status.unread.status'),
                        'staff_id' => $data['userInfo']['id'],
                        'is_del' => 0
        );
        $data['unread_receipt_count'] = $this->Mmilan_execute->count($where);
        
        //已读审核执行单统计
        $where = array(
                        'status' => C('milan_schedule_status.confirm.status'),
                        'staff_id' => $data['userInfo']['id'],
                        'is_del' => 0
        );
        $data['confirm_receipt_count'] = $this->Mmilan_execute->count($where);
        
        //已拒绝审核执行单统计
        $where = array(
                        'status' => C('milan_schedule_status.refuse.status'),
                        'staff_id' => $data['userInfo']['id'],
                        'is_del' => 0
        );
        $data['refuse_receipt_count'] = $this->Mmilan_execute->count($where);
        
        //待审核执行单统计
        $where = array(
            'status' => C('milan_schedule_status.confirm.status'),
            'examination_status' => C('examination_status.checking.id'),
            'staff_id' => $data['userInfo']['id'],
            'is_del' => 0
        );
        $data['checking_examination_receipt_count'] = $this->Mmilan_execute->count($where);
        
        //审核成功执行单统计
        $where = array(
            'status' => C('milan_schedule_status.confirm.status'),
            'examination_status' => C('examination_status.confirm.id'),
            'staff_id' => $data['userInfo']['id'],
            'is_del' => 0
        );
        $data['confirm_examination_receipt_count'] = $this->Mmilan_execute->count($where);
        
        //审核失败执行单统计
        $where = array(
            'status' => C('milan_schedule_status.confirm.status'),
            'examination_status' => C('examination_status.refuse.id'),
            'staff_id' => $data['userInfo']['id'],
            'is_del' => 0
        );
        $data['refuse_examination_receipt_count'] = $this->Mmilan_execute->count($where);
        
        $this->load->view('milan_schedule/index', $data);
    }
    
    /**
     * 手机端登录
     * @author louhang@gz-zc.cn
     */
    public function login(){
        if(!empty($this->session->userdata('USER'))){
            header('location:' . C('domain.admin.url') .'/milanschedule/index');
            exit;
        }
    
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $name = $this->input->post("name",true);
            $password = $this->input->post("password",true);
             
    
            if(empty($name) || !isset($name)){
                $this->return_failed("用户名不能为空！");
            }
            if(empty($password) || !isset($password)){
                $this->return_failed("密码不能为空！");
            }
             
    
            if(!empty($name) && !empty($password))
            {
                $where['name']		= $name;
                $where['is_del']	= 1;
                #验证用户信息
                $user_info =$this->Madmins->get_one("*",$where);
    
                if($user_info){
                    if($user_info['disabled'] == 2){
                        $this->return_failed("该用户已被禁用!");
                    }
                    if($user_info['password'] == md5($password)) {
    
                        unset($user_info['password']);
                        $this->session->set_userdata(array("USER"=>$user_info));
    
                        $this->return_success('','登录成功');
                         
                    }else{
                        $this->return_failed("密码错误请重新输入");
                    }
                }else{
                    $this->return_failed("用户名错误");
                }
    
            }
        }
        $this->load->view('milan_schedule/login', $data);
    }
    
    /**
     * 手机端退出
     * @author louhang@gz-zc.cn
     */
    public function logout(){
        $this->session->unset_userdata('USER');
        header('location:' . C('domain.admin.url') .'/milanschedule/login');
        exit;
    }
    
    /**
     * 消息查看
     * @author louhang@gz-zc.cn
     */
    public function all_message(){
        $data = $this->data;
        if(empty($data['userInfo'])){
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
        
        //职位
        $where = array('id' => $data['userInfo']['id']);
        $staff_info = $this->Madmins->get_one('group_id', $where);
        foreach (C('milan_staff_type') as $v){
            if($v['id'] == $staff_info['group_id']){
                $data['staff_type'] = $v['name'];
                break;
            }
        }
        if(!isset($data['staff_type'])){
            $data['staff_type'] = '';
        }

        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
        
        //排档消息
        $order_by = array('schedule_time' => 'desc', 'id' => 'desc');
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0);
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['list'] = $this->Mstaff_schedule->get_lists('*', $where, $order_by, $this->pageconfig['per_page'], ($page-1)*$this->pageconfig['per_page'] );
        $data_count = $this->Mstaff_schedule->count($where);
        
        //获取米兰订单排档信息
        $menu_ids = array_column($data['list'], 'menu_id', 'menu_id');
        $menu_ids = $menu_ids ?: '';
        $where = array('is_del' => '0', 'in' => array('id' => $menu_ids));
        $menus = $this->Mmenu->get_lists('id, venue_id', $where);
        //将 menus中 venue_id替换为相应的场馆名称
        $venues =  $this->Mvenue->get_lists('id, name');
        $venues = array_column($venues, 'name', 'id');
        foreach ($menus as $k => $v){
            $menus[$k]['venue'] = isset($venues[$v['venue_id']]) ? $venues[$v['venue_id']] : '';
        }
        $menus = array_column($menus, 'venue', 'id');
        
        //获取执行单
        $where = array('is_del' => 0, 'in' => array('menu_id' => $menu_ids), 'staff_type_id' => $data['userInfo']['group_id']);
        $receipts = $this->Mmilan_execute->get_lists('*', $where);
        $receipts = array_column($receipts, null, 'menu_id');
        
        //用 $data['list']中的menu_id 查找该订单对应的场馆名称
        foreach ($data['list'] as $k => $v){
            $data['list'][$k]['venue'] = isset($menus[$v['menu_id']]) ? $menus[$v['menu_id']] : '';
            $data['list'][$k]['receipt'] = isset($receipts[$v['menu_id']]) ? $receipts[$v['menu_id']] : '';
        }


        //获取分页
        $data['count'] = $data_count;
        if(! empty($data['list'])){
            $urls = array();
            $this->pageconfig['base_url'] = "/milanschedule/all_message?".http_build_query($urls);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        
        $this->load->view('milan_schedule/message', $data);
    }
    
    /**
     * 未读消息查看
     * @author louhang@gz-zc.cn
     */
    public function unread_message(){
        $data = $this->data;
        if(empty($data['userInfo'])){
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
    
        //职位
        $where = array('id' => $data['userInfo']['id']);
        $staff_info = $this->Madmins->get_one('group_id', $where);
        foreach (C('milan_staff_type') as $v){
            if($v['id'] == $staff_info['group_id']){
                $data['staff_type'] = $v['name'];
                break;
            }
        }
    
        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
    
        //排档消息
        $order_by = array('status' => 'asc', 'schedule_time' => 'desc', 'id' => 'desc');
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['list'] = $this->Mstaff_schedule->get_lists('*', $where, $order_by, $this->pageconfig['per_page'], ($page-1)*$this->pageconfig['per_page'] );
        $data_count = $this->Mstaff_schedule->count($where);
    
        //获取米兰订单排档信息
        $menu_ids = array_column($data['list'], 'menu_id', 'menu_id');
        $menu_ids = $menu_ids ?: '';
        $where = array('is_del' => '0', 'in' => array('id' => $menu_ids));
        $menus = $this->Mmenu->get_lists('id, venue_id', $where);
    
        //将 menus中 venue_id替换为相应的场馆名称
        $venues =  $this->Mvenue->get_lists('id, name');
        $venues = array_column($venues, 'name', 'id');
        foreach ($menus as $k => $v){
            $menus[$k]['venue'] = isset($venues[$v['venue_id']]) ? $venues[$v['venue_id']] : '';
        }
        $menus = array_column($menus, 'venue', 'id');
        
        //获取执行单
        $where = array('is_del' => 0, 'in' => array('menu_id' => $menu_ids), 'staff_type_id' => $data['userInfo']['group_id']);
        $receipts = $this->Mmilan_execute->get_lists('*', $where);
        $receipts = array_column($receipts, null, 'menu_id');
    
        //用 $data['list']中的menu_id 查找该订单对应的场馆名称
        foreach ($data['list'] as $k => $v){
            $data['list'][$k]['venue'] = isset($menus[$v['menu_id']]) ? $menus[$v['menu_id']] : '';
            $data['list'][$k]['receipt'] = isset($receipts[$v['menu_id']]) ? $receipts[$v['menu_id']] : '';
        }
    
        //获取分页
    
        $data['count'] = $data_count;
        if(! empty($data['list'])){
            $urls = array();
            $this->pageconfig['base_url'] = "/milanschedule/unread_message?".http_build_query($urls);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
    
        $this->load->view('milan_schedule/message', $data);
    }
    
    /**
     * 根据不同条件查看消息
     * @author louhang@gz-zc.cn
     */
    public function message_by_kinds_of_if(){
        $data = $this->data;
        if(empty($data['userInfo'])){
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
    
        //职位
        $where = array('id' => $data['userInfo']['id']);
        $staff_info = $this->Madmins->get_one('group_id', $where);
        foreach (C('milan_staff_type') as $v){
            if($v['id'] == $staff_info['group_id']){
                $data['staff_type'] = $v['name'];
                break;
            }
        }
    
        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
    
        //消息列表
        $order_by = array('status' => 'asc', 'schedule_time' => 'desc', 'id' => 'desc');
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0);
        
        //按照不同条件查询数据库
        $condition = $this->input->get('condition');
        $urls = array('condition' => $condition);
        if ($condition == 'schedule_unread') {
            //档期未确认
            $where2 = array('status' => C('milan_schedule_status.unread.status'));
            $where = array_merge($where, $where2);
        } elseif ($condition == 'schedule_confirm') {
            //档期已确认
            $where2 = array('status' => C('milan_schedule_status.confirm.status'));
            $where = array_merge($where, $where2);
        }  elseif ($condition == 'schedule_refuse') {
            //档期已拒绝
            $where2 = array('status' => C('milan_schedule_status.refuse.status'));
            $where = array_merge($where, $where2);
        } elseif ($condition == 'receipt_unread') {
            //未确认执行单
            $menu_ids = $this->Mmilan_execute->get_lists('menu_id', 
                array(
                    'status' => C('milan_schedule_status.unread.status'),
                    'staff_id' => $data['userInfo']['id'], 
                    'is_del' => 0
                )
            );
            $menu_ids = $menu_ids ? array_column($menu_ids, 'menu_id') : '0';
            $where2 = array('in' => array('menu_id' => $menu_ids));
            $where = array_merge($where, $where2);
            
        } elseif ($condition == 'receipt_confirm') {
            //已确认执行单
            $menu_ids = $this->Mmilan_execute->get_lists('menu_id', 
                array(
                    'status' => C('milan_schedule_status.confirm.status'),
                    'staff_id' => $data['userInfo']['id'], 
                    'is_del' => 0
                )
            );
            $menu_ids = $menu_ids ? array_column($menu_ids, 'menu_id') : '0';
            $where2 = array('in' => array('menu_id' => $menu_ids));
            $where = array_merge($where, $where2);
            
        } elseif ($condition == 'receipt_refuse') {
            //已拒绝执行单
            $menu_ids = $this->Mmilan_execute->get_lists('menu_id', 
                array(
                    'status' => C('milan_schedule_status.refuse.status'),
                    'examination_status' => C('examination_status.checking.id'), 
                    'staff_id' => $data['userInfo']['id'], 
                    'is_del' => 0
                )
            );
            $menu_ids = $menu_ids ? array_column($menu_ids, 'menu_id') : '0';
            $where2 = array('in' => array('menu_id' => $menu_ids));
            $where = array_merge($where, $where2);
            
        } elseif ($condition == 'receipt_examination_checking') {
            //执行单审核中
            $menu_ids = $this->Mmilan_execute->get_lists('menu_id', 
                array(
                    'status' => C('milan_schedule_status.confirm.status'),
                    'examination_status' => C('examination_status.checking.id'), 
                    'staff_id' => $data['userInfo']['id'], 
                    'is_del' => 0
                )
            );
            $menu_ids = $menu_ids ? array_column($menu_ids, 'menu_id') : '0';
            $where2 = array('in' => array('menu_id' => $menu_ids));
            $where = array_merge($where, $where2);
            
        } elseif ($condition == 'receipt_examination_confirm') {
            //执行单审核成功
            $menu_ids = $this->Mmilan_execute->get_lists('menu_id', 
                array(
                    'status' => C('milan_schedule_status.confirm.status'),
                    'examination_status' => C('examination_status.confirm.id'), 
                    'staff_id' => $data['userInfo']['id'], 
                    'is_del' => 0
                )
            );
            $menu_ids = $menu_ids ? array_column($menu_ids, 'menu_id') : '0';
            $where2 = array('in' => array('menu_id' => $menu_ids));
            $where = array_merge($where, $where2);
        } elseif ($condition == 'receipt_examination_refuse') {
            //执行单审核失败
            $menu_ids = $this->Mmilan_execute->get_lists('menu_id', 
                array(
                    'status' => C('milan_schedule_status.confirm.status'),
                    'examination_status' => C('examination_status.refuse.id'), 
                    'staff_id' => $data['userInfo']['id'], 
                    'is_del' => 0
                )
            );
            $menu_ids = $menu_ids ? array_column($menu_ids, 'menu_id') : '0';
            $where2 = array('in' => array('menu_id' => $menu_ids));
            $where = array_merge($where, $where2);
        }
        
        
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['list'] = $this->Mstaff_schedule->get_lists('*', $where, $order_by, $this->pageconfig['per_page'], ($page-1)*$this->pageconfig['per_page'] );
        $data_count = $this->Mstaff_schedule->count($where);
    
        //获取米兰订单排档信息
        $menu_ids = array_column($data['list'], 'menu_id', 'menu_id');
        $menu_ids = $menu_ids ?: '';
        $where = array('is_del' => '0', 'in' => array('id' => $menu_ids));
        $menus = $this->Mmenu->get_lists('id, venue_id', $where);
    
        //将 menus中 venue_id替换为相应的场馆名称
        $venues =  $this->Mvenue->get_lists('id, name');
        $venues = array_column($venues, 'name', 'id');
        foreach ($menus as $k => $v){
            $menus[$k]['venue'] = isset($venues[$v['venue_id']]) ? $venues[$v['venue_id']] : '';
        }
        $menus = array_column($menus, 'venue', 'id');
    
        //获取执行单
        $where = array('is_del' => 0, 'in' => array('menu_id' => $menu_ids), 'staff_type_id' => $data['userInfo']['group_id']);
        $receipts = $this->Mmilan_execute->get_lists('*', $where);
        $receipts = array_column($receipts, null, 'menu_id');
    
        //用 $data['list']中的menu_id 查找该订单对应的场馆名称
        foreach ($data['list'] as $k => $v){
            $data['list'][$k]['venue'] = isset($menus[$v['menu_id']]) ? $menus[$v['menu_id']] : '';
            $data['list'][$k]['receipt'] = isset($receipts[$v['menu_id']]) ? $receipts[$v['menu_id']] : '';
        }
    
        //获取分页
    
        $data['count'] = $data_count;
        if(! empty($data['list'])){
            $urls = array();
            $this->pageconfig['base_url'] = "/milanschedule/message_by_kinds_of_if?".http_build_query($urls);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
    
        $this->load->view('milan_schedule/message', $data);
    }
    
    
    
    /**
     * 档期确认
     * @author louhang@gz-zc.cn
     */
    public function confirm_schedule(){
        $data = $this->data;
        
        if (empty($data['userInfo'])) {
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
        
        if ($this->input->is_ajax_request()) {
            $id =  (int)$this->input->post("id");
            $status =  (int)$this->input->post("status");
            $where = array('id' => $id);
            $res = $this->Mstaff_schedule->update_info(array('status' => $status), $where);

            if ($res) {
               $this->return_success();
            } else {
               $this->return_failed();
            }
        }
        
    }
    
    /**
     * 档期日历查看
     * @author louhang@gz-zc.cn
     */
    public function schedule(){
        $data = $this->data;
        if(empty($data['userInfo']))
        {
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
        
        if($this->input->is_ajax_request()){
            $year = $this->input->post("year",true);
            $month = $this->input->post("month",true);
            $list = $this->get_appoint($data['userInfo']['id'], $month, $year);
            
            if($list){
                $this->return_success($list);
            }else{
                $this->return_failed();
            }
            
        }
        
        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
        
        //当月档期概况
        $data['list'] = $this->get_appoint($data['userInfo']['id']);

        $this->load->view('milan_schedule/schedule_calendar', $data);
    
    }
    
    /**
     * 档期详情查看
     * @author louhang@gz-zc.cn
     */
    public function schedule_detail(){
        $data = $this->data;
        if(empty($data['userInfo']))
        {
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
    
        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
    
        //档期详情
        $id = (int)$this->input->get_post('menu_id'); 
        $info = $this->Mmenu->info($id);
        //获取联系人
        $data['customer'] = $this->Mcustomer->get_one('id, name, mobile_phone', array('id'=>$info['customer_id']));
        
        $data['info'] = $info ? $info : array();
        
        $where = array('menu_id' => $id,'staff_id' => $data['userInfo']['id'], 'is_del' => 0);
        $data['schedule_info'] = $this->Mstaff_schedule->get_one('id,status',$where); 
        
        //米兰职员 角色类型
        $staffs = $this->Mstaff_schedule->get_lists('*', array('menu_id' => $id, 'is_del' => 0));
        $staff_ids = $staffs ? array_column($staffs, 'staff_id') : '';
        $staffs = $this->Madmins->get_lists('id, fullname, type, group_id', array('is_del'=>1, 'in' => array('id' => $staff_ids )));
        
        $group = $this->Madmins_group->get_lists('id,name');
        $group = array_column($group, 'name', 'id');
        
        foreach ($staffs as $k => $v){
            $staffs[$k]['group'] =  $group[$v['group_id']];
        }
        $data['staffs'] = $staffs;
        //获取套餐价格
        if($info['menus_id']){
            $price = $this->Mmilan_combo->get_one('price', ['id' => $info['menus_id']]);
            if($price){
                $data['info']['price'] = $price['price'];
            }
        }
        $this->load->view('milan_schedule/schedule_detail', $data);

    }

    /**
     * 查看档期
     * @author chaokai@gz-zc.cn
     */
    public function get_appoint($staff_id = array(), $month = 0, $year = 0){
    
        $year = $year ?  : date('Y');
        $month = $month ?  : date('m');
    
        $this->load->helper('date');
        $days = days_in_month($month, $year);
    
        // 获取预约数据
        $where = array(
                        'is_del' => 0,
                        'schedule_time >=' => $year . '-' . $month . '-01',
                        'schedule_time <=' => $year . '-' . $month . '-' . $days,
                        'staff_id' => $staff_id
        );

        $list = $this->Mstaff_schedule->get_lists('*', $where);
        
        //用于js new Date(y,m,d), 其中参数m：0~11 
        foreach ($list as $k => $v) {
            $list[$k]['y'] = explode('-', $v['schedule_time'])[0]; 
            $list[$k]['m'] = explode('-', $v['schedule_time'])[1] - 1; 
            $list[$k]['d'] = explode('-', $v['schedule_time'])[2]; 
        }
        return $list;
    
    }
    
    /**
     * 回执详情查看
     * @author louhang@gz-zc.cn
     */
    public function receipt_detail(){
        $data = $this->data;
        if(empty($data['userInfo']))
        {
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
    
        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
        
        $get_data = $this->input->get();
        $data['menu_id'] = $menu_id = (int)$get_data['menu_id'];
        $data['staff_type_id'] = $staff_type_id = $data['userInfo']['group_id'];
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

        //获取职员名字
        $staff = $this->Mstaff_schedule->get_one('staff_id', array('is_del' => 0,'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
        $name = $this->Madmins->get_lists('fullname', array('in' => array('id' => explode(',', $staff['staff_id']))));
        $name = array_column($name, 'fullname');
        $data['staff_name'] = implode(',' ,$name);
        
        //执行单信息
        $receipt = $this->Mmilan_execute->get_one('*', array('is_del' => 0, 'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
        if($receipt){
            $receipt['other'] = json_decode($receipt['other'], TRUE);
        }
        $data['receipt'] = $receipt;

        $this->load->view('milan_schedule/receipt/common_receipt', $data);
        
    }
    

    
    /**
     * 执行单确认
     * @author louhang@gz-zc.cn
     */
    public function confirm_receipt(){
        $data = $this->data;
        if(empty($data['userInfo']))
        {
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }

        if($this->input->is_ajax_request())
        {
            $id =  (int)$this->input->post("id");
            $status =  (int)$this->input->post("status");
            $where = array('id' => $id);
            
            $res = $this->Mmilan_execute->update_info(array('status' => $status, 'confirm_time' => date('Y-m-d')), $where);
            
            if($res)
            {
                $this->return_success();
            }
            else
            {
                $this->return_failed();
            }
        }
    
    }
    
    
    /**
     * 自填执行单
     * @author louhang@gz-zc.cn
     */
    public function add_receipt(){
        $data = $this->data;
        if(empty($data['userInfo']))
        {
            header('location:' . C('domain.admin.url') .'/milanschedule/login');
            exit;
        }
        
        //未读信息统计
        $where = array('staff_id' => $data['userInfo']['id'], 'is_del' => 0, 'status' => 0);
        $data['unread_message_count'] = $this->Mstaff_schedule->count($where);
        
        $get_data = $this->input->get();
        $data['menu_id'] = $menu_id = (int)$get_data['menu_id'];
        $data['staff_type_id'] = $staff_type_id = $data['userInfo']['group_id'];
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

        
        //获取职员名字
        $staff = $this->Mstaff_schedule->get_one('staff_id', array('menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
        $name = $this->Madmins->get_lists('fullname', array('in' => array('id' => explode(',', $staff['staff_id']))));
        $name = array_column($name, 'fullname');
        $data['staff_name'] = implode(',' ,$name);
        
        //执行单信息
        $receipt = $this->Mmilan_execute->get_one('*', array('is_del' => 0, 'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
        if($receipt){
            $receipt['other'] = json_decode($receipt['other'], TRUE);
        }
        $data['receipt'] = $receipt;
        
        $this->load->view('milan_schedule/receipt/self_administered/common_receipt', $data);
        
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
            //执行人员确认时间
            $post_data['create_time'] = $post_data['confirm_time'] = date('Y-m-d');
    
            //获取staff_id
            $staff = $this->Mstaff_schedule->get_one('*', array('menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
            $post_data['staff_id'] = $staff['staff_id'];
    
            //other字段转为json字符串
            if(isset($post_data['other']))
                $post_data['other'] = json_encode($post_data['other']);
    
            //自行填写或修改的执行单，重置状态，需要管理人员重新审核
            $post_data['status'] = C('milan_schedule_status.confirm.status');
            $post_data['examination_status'] = C('examination_status.checking.id');
    
            //update database

            $is_exist = $this->Mmilan_execute->get_one('id, create_time', array('is_del' => 0, 'menu_id' => $menu_id, 'staff_type_id' => $staff_type_id));
            if($is_exist){
                if($is_exist['create_time'] != '0000-00-00'){
                    $post_data['create_time'] = $is_exist['create_time'];
                }
                $res = $this->Mmilan_execute->update_info($post_data, array('id' => $is_exist['id']));
            }else {
                
                $res = $this->Mmilan_execute->create($post_data);
            }
    
            if($res){
                $this->return_success('', '保存成功!');
            }else{
                $this->return_failed('保存失败请稍后再试');
            }
    
        }
    }
  
    
}

