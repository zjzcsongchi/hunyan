<?php 

/**
 * 宴会订单管理
 * @author chaokai@gz-zc.cn
 */
class Dinner extends MY_Controller{
    
    //就餐时间
    private $dinner_time;
    
    public function __construct(){
        
        parent::__construct();
        $this->load->model(array(
                        'Model_dinner' => 'Mdinner',
                        'Model_dish' => 'Mdish',
                        'Model_combo' => 'Mcombo',
                        'Model_customer' => 'Mcustomer',
                        'Model_user' => 'Muser',
                        'Model_user_dinner' => 'Muser_dinner',
                        'Model_dinner_venue' => 'Mdinner_venue',
                        'Model_dinner_album' => 'Mdinneralbum',
                        'Model_admins' => 'Madmins',
                        'Model_news' => 'Mnews',
                        'Model_dinner_images' => 'Mdinner_images',
                        'Model_dinner_article' => 'Mdinner_article',
                        'Model_menu'=>'Mmenu',
                        'Model_staff_schedule' => 'Mstaff_schedule',

                        'Model_item_of_contract' => 'Mitem_of_contract',
                        'Model_class_item_contract' => 'Mclass_item_contract',
                        'Model_change_record' => 'Mchange_record',
                        'Model_dinner_extend' => 'Mdinner_extend',
                        'Model_dinner_extra_service' => 'Mdinner_extra_service',
                        'Model_pay_status' => 'Mpay_status',
                        'Model_admins_dinner_examined' => 'Madmins_dinner_examined',
                        'Model_user_coupon' => 'Muser_coupon',
                        
                        'Model_invoice_notice' => 'Minvoice_notice',
                        'Model_power_attorney' => 'Mpower_attorney',



        ));
        $this->data['dinner_time'] = $this->dinner_time = array_column(C('dinner.time'), 'name', 'id');
        
        $this->load->library('form_validation');
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
        $data['orders'] = $this->Mdinner->get_count();
        $this->load->view('dinner/index', $data);
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
        
        $dinner_extend = trim($this->input->get('dinner_extend'));
        
        if($name || $mobile){
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile);
        }else{
            $data['year'] = $year = intval($year);
            $data['month'] = $month = intval($month);
            !$year && show_404();
            (!$month || $month > 12) && show_404();
            
            //获取订单
            $data['list'] = $this->Mdinner->get_dinner_list($year, $month);
            //处理订单列表，未预定天显示为空
            #删除空白天处理
            //$data['list'] = $this->deal_list($data['list'], $month, $year);
        }
        $dinner_ids = array_column($data['list'] ?: [], 'id') ?: '';


        if ($dinner_extend) {
            $res = $this->Mdinner_extend->get_lists('*', [
                'is_del' => 0,
                'in' => ['dinner_id' => $dinner_ids],
                'type' => $dinner_extend
            ]);
            
            $dinner_ids = array_column($res ?: [], 'dinner_id') ?: [];
        }
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
            
            foreach ($data['list'] as $key => $val){
                //筛选 鸡蛋订单，米粉订单
                if (! in_array($val['id'], $dinner_ids)) {
                    unset($data['list'][$key]);
                    continue;
                }
                
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
                
                //婚宴处理
                foreach (C('party') as $k => $v){
                    if($val['venue_type'] == $v['id']){
                        $data['list'][$key]['dinner_type_text'] = $v['name'];
                       	if($v['id'] == C('party.wedding.id')){
                           if(isset($val['roles_wife']) && isset($val['roles_wife_mobile']) ) {
                                $data['list'][$key]['customer_name'] = $val['roles_wife'];
                                $data['list'][$key]['customer_mobile'] = $val['roles_wife_mobile'];
                           }
                       }
                    }
                }
            }
            
            sort($data['list']);
        }

        $this->load->view('dinner/lists', $data);
    }
    
    /**
     * 订单审核
     * @author fenyi@gz-zc.cn
     */
    public function order_review() {
        //必须使用post方法访问
        if (!IS_POST) {
            $this->return_failed('操作失败');
        }
        
        //获取管理者ID
        $user = $this->session->userdata('USER');
        $uid = $user['id'];
        
        //获取审核信息
        $request = $this->input->post(null, true);
        $id = (int) $request['id'];
        //判读是否审核不通过（不通过为2）
        $is_examined = $request['examination_status'] == 2 ? C('dinner.examine.failure.id') : C('dinner.examine.to_archive.id');
        $examined_reason = $request['examination_reason'];

        //判断订单是否存在
        $dinner_info = $this->Mdinner->get_one('id,is_examined', array('id' => $id, 'is_del' => 0));
        if(empty($dinner_info)){
            $this->return_failed('订单不存在');
        }

        /*
        //获取当前订单信息
        $field = 'is_examined';
        $where = array('id' => $id);
        $dinner_info = $this->Mdinner->get_one($field, $where);

        //待归档订单处理
        if ($dinner_info['is_examined'] == C('dinner.examine.archived.id')) {
            $payment = C('order.payment.remaining.id');
            $final_payment = (float) $request['final_payment'];
            $method_payment = (int) $request['method_payment'];
            switch ($method_payment) {
                case 1: 
                    $pay_type = C('order.pay_type.cash.id');
                    break;
                case 2:
                    $pay_type = C('order.pay_type.credit_card.id');
                    break;
                case 3:
                    $pay_type = C('order.pay_type.credit_card.id');
                    break;
                default:
                    //todo
                    break;
            }
            $count = $this->Mpay_status->count(array('create_admin' => $uid, 'dinner_id' => $id));
            if ($count === 0) {
                $res = $this->Mpay_status->create(array(
                    'dinner_id' => $dinner_info['id'],
                    'customer_id' => $dinner_info['user_id'],
                    'money' => $final_payment,
                    'pay_type' => $pay_type,
                    'payment' => $payment,
                    'create_admin' => $uid,
                ));
            } else {
                $res = $this->Mpay_status->update_info(['money' => $final_payment, 'pay_type' => $pay_type, 'payment' => $payment], ['create_admin' => $uid, 'dinner_id' => $id]);
            }
            if (!$res) {
                $this->return_failed('审核失败');
            }
        }
        */

        //更新宴会表（dinner）
        $where = array(
            'id' => $id,
        ); 
        $data = array(
            'is_examined' => $is_examined,
            'examined_reason' => $examined_reason,
            'examine_time' => date('Y-m-d H:i:s')
        );
        $res = $this->Mdinner->update_info($data, $where);
        if (!$res) {
            $this->return_failed('审核失败');
        }
        
        //更新审核表（admins_dinner_examined)
        $count = $this->Madmins_dinner_examined->count(array('admin_id' => $uid, 'dinner_id' => $id));
        $res_admins_dinner = false;
        if ($count === 0) {
            $res_admins_dinner = $this->Madmins_dinner_examined->create(array(
                'admin_id' => $uid, 
                'dinner_id' => $id, 
                'is_examined' => $is_examined,
                'examined_reason' => $examined_reason,
            ));
        } else {
            $data_admin_dinner = $data;
            unset($data_admin_dinner['examine_time']);
            $where_admin_dinner = array('admin_id' => $uid, 'dinner_id' => $id);
            $res_admins_dinner = $this->Madmins_dinner_examined->update_info($data_admin_dinner, $where_admin_dinner);
        }
        //记录审核日志
        $review_log = array(
            'dinner_id' => $id,
            'key' => 'is_examined',
            'old_value' => $dinner_info['is_examined'],
            'new_value' => $is_examined,
            'create_user' => $this->data['userInfo']['id'],
            'create_time' => date('Y-m-d H:i:s')
        );
        $this->Mchange_record->create($review_log);
        
        if (!$res_admins_dinner) {
            $this->return_failed('审核失败');
        }

        $this->return_success('','审核成功');
    }

    /**
     * 订单归档
     * @author fengyi@gz-zc.cn
     */
    public function order_review_archive() {

        //获取管理者ID
        $user = $this->session->userdata('USER');
        $uid = $user['id'];

        //获取归档信息
        $request = $this->input->post(null, true);
        $id = (int) $request['id'];
        $final_payment = (float) $request['final_payment'];
        $method_payment = (int) $request['method_payment'];
        $coupon_num = floatval(trim($request['coupon_num']));
        $remark = trim($request['remark']);
        $user_coupon_ids = trim($request['coupon']);

        //尾款和支付方式
        $payment = C('order.payment.remaining.id');
        $pay_type = $method_payment;
        
        //获取当前订单信息
        $field = 'id,create_time,contract_date,contract_type,chess_card,venue_type,solar_time,user_id,lunar_time,roles_main,roles_main_mobile,roles_wife,roles_wife_mobile,menus_count,create_admin,remark,contract_num,deposit,receiver,is_examined,examined_reason';
        $where = array('id' => $id);
        $dinner_info = $this->Mdinner->get_one($field, $where);
        if (!$dinner_info) {
            $this->return_failed('归档失败');
        }

        //获取代金券的金额
        $coupon = 0;
        if ($user_coupon_ids) {
            $user_coupon_ids = explode(',', $user_coupon_ids);
            $lists = $this->Muser_coupon->get_lists('id,number,money', ['in' => ['id' => $user_coupon_ids]]);
            foreach ($lists as $k => $v) {
                //$coupon += $v['money'];
                //更新支付状态表
                /*$count = $this->Mpay_status->count(array('dinner_id' => $id, 'number' => $v['number']));
                if ($count === 0) {
                    $data = [
                        'dinner_id' => $dinner_info['id'],
                        'customer_id' => $dinner_info['user_id'],
                        //'money' => $final_payment,
                        'pay_type' => $pay_type,
                        'payment' => $payment,
                        'coupon' => $v['money'],
                        'remark' => $v['number'],
                        'create_admin' => $uid,
                        'pay_time' => date('Y-m-d'),
                        'create_time' => date('Y-m-d H:i:s'),
                    ];
                    $res = $this->Mpay_status->create($data);
                } else {
                    $data = [
                        'money' => $final_payment,
                        'pay_type' => $pay_type,
                        'payment' => $payment,
                        //'coupon' => $coupon,
                        'pay_time' => date('Y-m-d'),
                        'update_time' => date('Y-m-d H:i:s'),
                    ];
                    $res = $this->Mpay_status->update_info($data, ['dinner_id' => $id]);
                }*/ 
                $data = [
                    'dinner_id' => $dinner_info['id'],
                    'customer_id' => $dinner_info['user_id'],
                    'money' => $v['money'],
                    'pay_type' => C('order.pay_type_archive.coupon.id'),
                    'payment' => $payment,
                    //'coupon' => $v['money'],
                    'remark' => $v['number'],
                    'create_admin' => $uid,
                    'pay_time' => date('Y-m-d'),
                    'create_time' => date('Y-m-d H:i:s'),
                ];
                $res = $this->Mpay_status->create($data);
                if (!$res) {
                    $this->return_failed('归档失败');
                }
            }

            //更新代金券状态为已使用
            $res = $this->Muser_coupon->update_info(['status' => C('coupon.status.use.id'), 'end_time' => date("Y-m-d H:i:s", time())], ['in' => ['id' => $user_coupon_ids]]);
            if (!$res) {
                $this->return_failed('归档失败');
            }
        }

        //更新支付状态表
        /*$count = $this->Mpay_status->count(array('dinner_id' => $id));
        if ($count === 0) {
            $res = $this->Mpay_status->create(array(
                'dinner_id' => $dinner_info['id'],
                'customer_id' => $dinner_info['user_id'],
                'money' => $final_payment,
                'pay_type' => $pay_type,
                'payment' => $payment,
                //'coupon' => $coupon,
                'create_admin' => $uid,
                'pay_time' => date('Y-m-d'),
                'create_time' => date('Y-m-d H:i:s'),
            ));
        } else {
            $data = [
                'money' => $final_payment,
                'pay_type' => $pay_type,
                'payment' => $payment,
                //'coupon' => $coupon,
                'pay_time' => date('Y-m-d'),
                'update_time' => date('Y-m-d H:i:s'),
            ];
            $res = $this->Mpay_status->update_info($data, ['dinner_id' => $id]);
        }*/
        if ($final_payment) {
            $data = [
                'dinner_id' => $dinner_info['id'],
                'customer_id' => $dinner_info['user_id'],
                'money' => $final_payment,
                'pay_type' => $pay_type,
                'payment' => $payment,
                //'coupon' => $v['money'],
                //'remark' => $v['number'],
                'create_admin' => $uid,
                'pay_time' => date('Y-m-d'),
                'create_time' => date('Y-m-d H:i:s'),
                'coupon' => $coupon_num,
                'remark' => $remark,
            ];
            $res = $this->Mpay_status->create($data);
            if (!$res) {
                $this->return_failed('归档失败');
            }
        }

        $is_examined = C('dinner.examine.archived.id');
        
        //更新宴会表（dinner）
        $where = array(
            'id' => $id,
        ); 
        $data = array(
            'is_examined' => $is_examined,
            //'examined_reason' => $examined_reason,
        );
        $res = $this->Mdinner->update_info($data, $where);
        if (!$res) {
            $this->return_failed('归档失败');
        }

        //更新审核表（admins_dinner_examined)
        $count = $this->Madmins_dinner_examined->count(array('admin_id' => $uid, 'dinner_id' => $id));
        $res_admins_dinner = false;
        if ($count === 0) {
            $res_admins_dinner = $this->Madmins_dinner_examined->create(array(
                'admin_id' => $uid, 
                'dinner_id' => $id, 
                'is_examined' => $is_examined,
                //'examined_reason' => $examined_reason,
            ));
        } else {
            $data_admin_dinner = $data;
            $where_admin_dinner = array('admin_id' => $uid, 'dinner_id' => $id);
            $res_admins_dinner = $this->Madmins_dinner_examined->update_info($data_admin_dinner, $where_admin_dinner);
        }
        if (!$res_admins_dinner) {
            $this->return_failed('归档失败');
        }
        

        $this->return_success('', '归档成功');
    }
    
    /**
     * 添加预约
     * @author chaokai@gz-zc.cn
     */
    public function add() {
        $data = $this->data;
        //获取所有场馆名字
        $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
        $venue_name = array_column($venue_list, 'name', 'id');
        if(IS_POST){
            $post_data = $this->input->post();
            /*
	        foreach ($post_data['coupon'] as $k=>$v){
                if($v['number'] && !$v['money']){
                        $this->return_failed('代金券金额不能为空');
                }
                if(!$v['number'] && $v['money']){
                        $this->return_failed('代金券编号不能为空');
                }
                if($v['number'] && $v['money']){
                        if(!is_numeric($v['money'])){
                                $this->return_failed('代金券金额请填写有效数字');
                        }
                }
            }
             */
            #数据验证
            $this->form_validation->set_rules('name', '姓名', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_id[]', '场馆', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_type', '宴会类型', 'trim|required|integer', array('required' => '%s不能为空', 'integer' => '数值类型不合法'));
            $this->form_validation->set_rules('solar_time', '公历时间', 'trim|required', array('required' => '%s不能为空'));
    
            //dinner_extend 数据验证
            $is_check = $post_data['is_check'];
            $extend = $post_data['extend'];
            
            if($is_check[4]){
                $this->form_validation->set_rules('extend[4][]', '偏酒备注', 'trim|required', array('required' => '%s不能为空'));
            }
            if($is_check[5]){
                $this->form_validation->set_rules('extend[5][]', '打屏备注', 'trim|required', array('required' => '%s不能为空'));
            }
            if($is_check[7]){
                $this->form_validation->set_rules('extend[7][]', '司仪备注', 'trim|required', array('required' => '%s不能为空'));
            }
            if($is_check[3]){
                if(intval($post_data['extend'][3][0]) == 0){
                    $this->form_validation->set_rules('extend[3][]', '请', 'trim|required', array('required' => '%s输入正确的麻将数量'));
                }
            }
            if($is_check[2]){
                if(intval($post_data['extend'][2][0]) == 0){
                    $this->form_validation->set_rules('extend[1][]', '请', 'trim|required', array('required' => '%s输入正确的鸡蛋数量'));
                }
            }
            if($is_check[1]){
                if(intval($post_data['extend'][1][0]) == 0){
                    $this->form_validation->set_rules('extend[1][]', '请', 'trim|required', array('required' => '%s输入正确的米粉数量'));
                }
            }
            
            if($is_check[6]){
                if(intval($post_data['extend'][6][0]) == 0){
                    $this->form_validation->set_rules('extend[1][]', '请', 'trim|required', array('required' => '%s选择微请帖'));
                }
            }
	        $coupon = $post_data['coupon'];
            unset($post_data['is_check'], $post_data['extend'], $post_data['coupon']);
            
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            
            
            //查询当天有哪些厅已经预定
            if($post_data['solar_time']){
                $venue_list = $this->Mdinner->get_lists('id,solar_time', array('solar_time'=>$post_data['solar_time'], 'is_del' => 0, 'dinner_time' => $post_data['dinner_time']));
                //获取订单id
                $data['dinner_id'] = array_column($venue_list, 'id');
                if($data['dinner_id']){
                    $query['in'] = array('dinner_id'=>$data['dinner_id']);
                    $venue_list = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
                    $venue_id = array_column($venue_list, 'venue_id');
                    if(isset($post_data['venue_id']) && $post_data['venue_id']){
                        foreach ($post_data['venue_id'] as $k=>$v){
                            if(in_array($v, $venue_id)){
                                $this->return_failed($venue_name[$v].'已经被预约过了!');
                            }
                        }
                    }
                }
            }
            
            //验证手机号
            if(!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone'])){
                $this->return_failed('手机号格式不正确');
            }
            //判断该天是否被预约过
            if(isset($post_data['venue_id']) && $post_data['venue_id']){
                $appoint_list = $this->appoint_exist($post_data['venue_id'], $post_data['solar_time'], $post_data['dinner_time']);
                if($appoint_list['id'] == 1){
                    $this->return_failed('以下场馆已被预约<br>'.$appoint_list['name']);
                }
       
            }
            //判断客户是否存在
            $user_exist = $this->Mcustomer->get_one('id', array('mobile_phone' => $post_data['mobile_phone'], 'name' => $post_data['name']));
            $user_data = array(
                            'name' => $post_data['name'],
            );
            if($user_exist){
                $customer_id = $user_exist['id'];
                $this->Mcustomer->update_info(array('is_order_customer' => 1), array('id' => $user_exist['id']));
            }else{
                $user_data['mobile_phone'] = $post_data['mobile_phone'];
                $user_data['is_order_customer'] = 1;
                $user_data['create_admin'] = $this->data['userInfo']['id'];
                $user_data['create_time'] = $user_data['update_time'] = date('Y-m-d H:i:s');
                $customer_id = $this->Mcustomer->create($user_data);
            }
            $post_data['user_id'] = $customer_id;
    
            if($post_data['venue_type'] != C('party.wedding.id')){
                $post_data['roles_main'] = $post_data['roles_main_other'];
                $post_data['roles_main_mobile'] = $post_data['roles_main_other_mobile'];
                unset($post_data['roles_wife'], $post_data['roles_wife_mobile']);
            }
            unset($post_data['roles_main_other'], $post_data['roles_main_other_mobile']);
            
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['create_admin'] = $post_data['update_admin'] = $data['userInfo']['id'];
            
            //订金支付方式
            $deposit_pay_type = $post_data['deposit_pay_type'];
            unset($post_data['deposit_pay_type']);
            
            #开启事务
            $this->db->trans_start();
    
            $user = $post_data;
            unset($post_data['mobile_phone'], $post_data['name'], $post_data['id_number']);
    
            //宴会菜单详情
            $menus = $post_data['menus'];
            unset($post_data['menus']);
            
            if(isset($post_data['venue_id']) && $post_data['venue_id']){
                $venue_ids = $post_data['venue_id'];
            }else{
                $venue_ids = array(0);
            }
            
            unset($post_data['venue_id']);
            //获取阴历日期
            $lunar_time = solar_to_lunar($post_data['solar_time']);
            $post_data['lunar_time'] = $lunar_time['lunar_time'];
            //保存订单
            //处理pc端封面图片
            if(isset($post_data['cover_img'])){
                $post_data['cover_img'] = implode(';', $post_data['cover_img']);
            }
            //处理手机端封面图片
            if(isset($post_data['m_cover_img'])){
                $post_data['m_cover_img'] = implode(';', $post_data['m_cover_img']);
            }
            //处理相册图片
            if(isset($post_data['album'])){
                $post_data['album'] = implode(';', $post_data['album']);
            }
            //处理身份证
            if(isset($post_data['id_card_photo'])){
                $post_data['id_card_photo'] = $post_data['id_card_photo'][0];
            }
            if(isset($post_data['id_card_back_photo'])){
                $post_data['id_card_back_photo'] = $post_data['id_card_back_photo'][0];
            }
            //后台添加的订单默认已审核
            $post_data['is_examined'] = C('dinner.examine.backend_add.id');
            
            $dinner_id = $this->Mdinner->create($post_data);
            
            !$dinner_id && $this->return_failed('操作失败');
            
            //保存客户信息；生成手机号前台登录账号
            $user_id = $this->create_user($user, $customer_id, $dinner_id);
	    
	        //优惠券数据添加
            if($coupon){
                foreach($coupon as $k=> $v){
                    if($v['number'] && $v['money']){
                        $new_coupon[$k]['number'] = $v['number'];
                        $new_coupon[$k]['money'] = $v['money'];
                        $new_coupon[$k]['create_admin'] = $this->data['userInfo']['id'];
                        $new_coupon[$k]['create_time'] = date('Y-m-d H:i:s', time());
                        $new_coupon[$k]['status'] = 0;
                        $new_coupon[$k]['dinner_id'] = $dinner_id;
                        $new_coupon[$k]['user_id'] = $user_id;
                    }
                }

            }
	        if(isset($new_coupon) && !empty($new_coupon)){
                    //添加新优惠券数据
                    $insert_id = $this->Muser_coupon->create_batch($new_coupon);
            }

            //保存信息到客户场馆对应表
            $dinner_venues = array();
            
            foreach ($venue_ids as $k => $v){
                $dinner_venues[] = array(
                    'dinner_id' => $dinner_id,
                    'venue_id' => $v
                );
            }
            $this->Mdinner_venue->create_batch($dinner_venues);
            //保存菜单信息
            if($menus){
                $this->add_appoint_detail($dinner_id, $menus);
            }
            
            //保存 dinner_extend 数据
            $extend_insert = array();
            $extend_count = 0;
            foreach($extend as $k=>$v){
                $extend_insert[$extend_count]['is_need'] = $is_check[$k] ? 1 : 0;
                $extend_insert[$extend_count]['type'] = $k;
                $extend_insert[$extend_count]['dinner_id'] = $dinner_id;
                $extend_insert[$extend_count]['num'] = $v[0];
                $extend_insert[$extend_count]['remark'] = $v[1];
                $extend_count++;
            }
            if ($extend_insert) {
                $add_extend_insert = $this->Mdinner_extend->create_batch($extend_insert);
            }
            
            //账单流水记录 ， 以合同签订日期为准
            $pay_log = array(
                    'dinner_id' => $dinner_id,
                    'customer_id' => $customer_id,
                    'pay_time' => $post_data['contract_date'],
                    'pay_type' => $deposit_pay_type,
                    'payment' => C('order.payment.deposit.id'),
                    'money' => $post_data['deposit'],
                    'create_admin' => $post_data['create_admin'],
                  
                    'create_time' => $post_data['create_time'],
                    'update_time' => $post_data['update_time']        
            );
            $this->Mpay_status->create($pay_log);

            $this->db->trans_complete();
            
            if($this->db->trans_status() === false){
                $this->return_failed('保存失败');
            }else{
                $this->return_success([], '保存成功');
            }
        }
        
        $data['year'] = $this->input->get('year');
        $data['month'] = $this->input->get('month');
        $data['day'] = $this->input->get('day');
        $data['venue_id'] = $this->input->get('venue_id');
        
        if($data['year'] && $data['month']){
            $month = $data['month'] < 10 ? '0'.$data['month'] : $data['month'];
            $this->load->helper('date');
            $days = days_in_month($data['month'], $data['year']);
            $data['min_date'] = $data['year'].'-'.$month.'-01';
            $data['max_date'] = $data['year'].'-'.$month.'-'.$days;
        }
    
        $data['title'] = array('订单列表', '添加预约');
        //宴会类型
        $data['party_type'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        //套餐菜品
        $data['combo_menu'] = $this->Mcombo->lists();
        
        //微请帖
        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        
        
        $this->load->view('dinner/add', $data);
    }
    
    /**
     * 宴会相册
     * @author yonghua
     */
    public function album(){
        $data = $this->data;
        $dinner_id = (int) $this->input->get('dinner_id');
        if($dinner_id <= 0){
            $this->error('非法访问参数');
        }
        $data['dinner_id'] = $dinner_id;
        $data['list'] = $this->Mdinneralbum->get_lists('*', ['dinner_id' => $dinner_id, 'is_del' => 0]);
        $this->load->view('dinner/album', $data);
    }
    
    /**
     * 宴会相册详情
     * @author yonghua
     */
    public function album_detail(){
        $data = $this->data;
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['page'] = $page;
        $id = (int) $this->input->get('album_id');
        $data['dinner_id'] = (int) $this->input->get('dinner_id');
        $size = 10;
        if($id == 0){
            $this->error('非法访问参数');
        }
        $where = ['is_del' => 0, 'album_id' => $id];
        $list = $this->Mdinner_images->get_lists('id,img,thumb,sy_img',$where, ['create_time'], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        if($list){
            $data['list'] = $list;
            // 分页信息
            $data['count'] = $this->Mdinner_images->count($where);
            $where['dinner_id'] = $data['dinner_id'];
            $pageconfig['base_url'] = "/dinner/album_detail?".http_build_query($where);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        $this->load->view('dinner/album_detail', $data);
    }
    
    /**
     * 添加宴会相册
     * @author yonghua
     */
    public function album_add(){
        $data = $this->data;
        $dinner_id = (int) $this->input->get('dinner_id', TRUE);
        if($dinner_id <= 0){
            $this->error('非法访问参数');
        }
        $data['dinner_id'] = $dinner_id;
        if(IS_POST){
            if(!isset($data['userInfo'])){
                $this->error('拒绝操作');
            }
            $add = $this->input->post();
            if(!isset($add['dinner_id'])){
                $this->error('非法访问参数');
            }
            if(empty(trim($add['name']))){
                $this->error('相册名称不能为空');
            }
            if((trim($add['price']) < 0)){
                $this->error('价格不能小于0');
            }
            $add['create_time'] = date('Y-m-d H:i:s');
            $add['create_admin'] = $data['userInfo']['id'];
            $res = $this->Mdinneralbum->create($add);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('添加成功', '/dinner/album?dinner_id='.$add['dinner_id']);
        }
        $this->load->view('dinner/album_add', $data);
    }
    
    /**
     * 编辑宴会相册
     * @author yonghua
     */
    public function edit_album(){
        $data = $this->data;
        if(IS_POST){
            if(!isset($data['userInfo'])){
                $this->error('拒绝操作');
            }
            $up = $this->input->post();
            $id = $up['id'];
            unset($up['id']);
            if(!isset($up['dinner_id'])){
                $this->error('非法访问参数');
            }
            if(empty(trim($up['name']))){
                $this->error('相册名称不能为空');
            }
            if(empty(trim($up['cover_img']))){
                $this->error('请上传封面图');
            }
            if((trim($up['price']) < 0)){
                $this->error('价格不能小于0');
            }
            $res = $this->Mdinneralbum->update_info($up, ['id' => $id]);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('修改成功', '/dinner/album?dinner_id='.$up['dinner_id']);
        }
        $id = (int) $this->input->get('id');
        $data['dinner_id'] = (int) $this->input->get('dinner_id');
        if($id == 0){
            $this->error('非法访问参数');
        }
        $info = $this->Mdinneralbum->get_one('*', ['id' => $id]);
        if($info['article_id']){
            $article_info = $this->Mnews->get_one('id,title', array('id' => $info['article_id']));
            $info['article_name'] = $article_info['title'];
        }
        if(!$info){
            $this->error('相册不存在');
        }
        $data['info'] = $info;
        $this->load->view('dinner/edit_album', $data);
    }
    
    /**
     * 删除宴会相册
     * @author yonghua
     */
    public function del_album(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('系统拒绝操作');
        }
        $id = (int) $this->input->get('id');
        $dinner_id = (int) $this->input->get('dinner_id');
        if( ($id == 0) && ($dinner_id == 0)){
            $this->error('非法访问参数');
        }
        $count = $this->Mdinner_images->count(['album_id' => $id, 'is_del' =>0]);
        if($count > 0){
            $this->error('该相册还有相片，删除前请先清空相册内的相片');
        }
        $res = $this->Mdinneralbum->update_info(['is_del' => 1], ['id' => $id]);
        if(!$res){
            $this->error('删除失败');
        }
        $this->success('操作成功', '/dinner/album?dinner_id='.$dinner_id);
    }
    
    
    /**
     * 保存宴会菜单详情
     * @param unknown $appoint_id
     * @param unknown $menus
     */
    private function add_appoint_detail($dinner_id, $menu){
        //查询菜品名称及图片
        $menu_detail = $this->Mcombo->get_one('id,combo_name,cover_img,description,relevance_id', array('id' => $menu));
        
        if($menu_detail){
            $menus_list['dinner_id'] = $dinner_id;
            $menus_list['menus_id'] = $menu;
            $menus_list['name'] = $menu_detail['combo_name'];
            $menus_list['cover_img'] = $menu_detail['cover_img'];
            $menus_list['dishs_id'] = $menu_detail['relevance_id'];
            $menus_list['description'] = $menu_detail['description'];
            $menus_list['create_time'] = date('Y-m-d H:i:s');
            
            if($this->Mdinner_detail->create($menus_list)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    
    }
    
    /**
     * 修改预约信息
     * @author chaokai@gz-zc.cn
     */
    public function edit($id = 0){
        $data = $this->data;
        //获取所有场馆名字
        $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
        $venue_name = array_column($venue_list, 'name', 'id');

        $data['info'] = $this->Mdinner->info($id);
        $week = array('日', '一', '二', '三', '四', '五', '六');
        $data['info']['week'] =  '星期'. $week[date('w', strtotime($data['info']['solar_time']))];
        $data['title'] = array('订单管理', '修改订单信息');
        //宴会类型
        $data['party_type'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        //套餐菜品
        $data['combo_menu'] = $this->Mcombo->lists();

        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取dinner_extend表数据
        $extend_lists = $this->Mdinner_extend->get_lists('*', array('dinner_id' => $id, 'is_del'=>0));
        $data['extend'] = array();
        foreach ($extend_lists as $k=>$v){
            $data['extend'][$v['type']] = $v;
        }
        //订金 付款方式
        $deposit_pay = $this->Mpay_status->get_one('*', ['dinner_id' => (int)$id]);
        $data['deposit_pay_type'] = $deposit_pay ? $deposit_pay['pay_type'] : 0;

        //获取优惠券信息
        $old_coupon_lists = $this->Muser_coupon->get_lists('*', array('dinner_id' => $id, 'is_del' => 0, 'status' => 0));
        $data['old_coupon_lists'] = $old_coupon_lists;
        if(IS_POST){
            //需要复审
            $need_recheck = false;

            $post_data = $this->input->post();
            $customer_id = $this->Mdinner->get_one('user_id', array('id' => $post_data['id']));
            $search_user_id = $this->Mcustomer->get_one('user_id', array('id' => $customer_id['user_id']))['user_id'];
            //未使用代金券旧数据
            $coupon_lists = $this->Muser_coupon->get_lists('*', array('dinner_id' => $post_data['id'], 'is_del' => 0, 'status' => 0));
            if($post_data['coupon']){
                foreach($post_data['coupon'] as $k=> $v){
                    if($v['number'] && $v['money']){
                        $new_coupon[$k]['number'] = $v['number'];
                        $new_coupon[$k]['money'] = $v['money'];
                        $new_coupon[$k]['create_admin'] = $this->data['userInfo']['id'];
                        $new_coupon[$k]['create_time'] = date('y-m-d h:i:s', time());
                        $new_coupon[$k]['status'] = 0;
                        $new_coupon[$k]['dinner_id'] = $post_data['id']; 
                        $new_coupon[$k]['user_id'] = $search_user_id;
                    }
                }

            }

            //删除未使用优惠券 使is_del置1
            $this->Muser_coupon->update_info(array('is_del' => 1), array('dinner_id' => $post_data['id']));
            if(isset($new_coupon) && !empty($new_coupon)){
                //添加新优惠券数据
                $insert_id = $this->Muser_coupon->create_batch($new_coupon);
            }
            unset($post_data['coupon']);		
            $is_check = $post_data['is_check'];
            if($post_data['venue_type'] == C('party.wedding.id')){
                $this->form_validation->set_rules('roles_main', '新郎', 'trim|required', array('required' => '%s不能为空'));
                $this->form_validation->set_rules('roles_wife', '新娘', 'trim|required', array('required' => '%s不能为空'));
            }else{
                $this->form_validation->set_rules('roles_main_other', '宴会主角', 'trim|required', array('required' => '%s不能为空'));
            }
            $this->form_validation->set_rules('venue_id[]', '场馆', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('name', '姓名', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_type', '宴会类型', 'trim|required|integer', array('required' => '%s不能为空', 'integer' => '数值类型不合法'));
            $this->form_validation->set_rules('solar_time', '公历时间', 'trim|required', array('required' => '%s不能为空'));

            //查询当天有哪些厅已经预定
            if($post_data['solar_time']){
                $venue_list = $this->Mdinner->get_lists('id,solar_time', array('solar_time'=>$post_data['solar_time'], 'id!='=>$post_data['id'], 'is_del' => 0, 'dinner_time' => $post_data['dinner_time']));

                //获取订单id 
                $data['dinner_id'] = array_column($venue_list, 'id');

                if($data['dinner_id']){
                    $query['in'] = array('dinner_id'=>$data['dinner_id']);
                    $venue_list = $this->Mdinner_venue->get_lists('venue_id, dinner_id', array_merge($query, array('venue_id!='=>0)));
                    $venue_id = array_column($venue_list, 'venue_id');
                    if(isset($post_data['venue_id']) && $post_data['venue_id']){
                        foreach ($post_data['venue_id'] as $k=>$v){
                            if(in_array($v, $venue_id)){
                                $this->return_failed($venue_name[$v].'已经被预约过了!');
                            }
                        }
                    }

                }
            }

            //验证手机号
            if(!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone'])){
                $this->return_failed('手机号格式不正确');
            }

            if($is_check[4]){
                $this->form_validation->set_rules('extend[4][]', '偏酒备注', 'trim|required', array('required' => '%s不能为空'));
            }

            if($is_check[5]){
                $this->form_validation->set_rules('extend[5][]', '打屏备注', 'trim|required', array('required' => '%s不能为空'));
            }
            if($is_check[3]){
                if(intval($post_data['extend'][3][0]) == 0){
                    $this->form_validation->set_rules('extend[3][]', '请', 'trim|required', array('required' => '%s输入正确的麻将数量'));
                }
            }
            if($is_check[2]){
                if(intval($post_data['extend'][2][0]) == 0){
                    $this->form_validation->set_rules('extend[1][]', '请', 'trim|required', array('required' => '%s输入正确的鸡蛋数量'));
                }
            }
            if($is_check[1]){
                if(intval($post_data['extend'][1][0]) == 0){
                    $this->form_validation->set_rules('extend[1][]', '请', 'trim|required', array('required' => '%s输入正确的米粉数量'));
                }
            }

            if($is_check[6]){
                if(intval($post_data['extend'][6][0]) == 0){
                    $this->form_validation->set_rules('extend[1][]', '请', 'trim|required', array('required' => '%s选择微请帖'));
                }
            }
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            //获取dinner表旧数据
            $old_arr = $this->Mdinner->info($post_data['id']);
            $id = (int)$post_data['id'];

            //更新dinner_extend数据
            //$this->update_dinner_extend_info($id, $post_data, $is_check);
            //拼接需要重新加入到t_extend表数据
            $extend_insert = array();
            //用拓展类型作为每一条记录的KEY
            foreach($post_data['extend'] as $k=>$v){
                $k = intval($k);
                $extend_insert[$k]['is_need'] = $is_check[$k];
                $extend_insert[$k]['type'] = $k;
                $extend_insert[$k]['dinner_id'] = $id;
                $extend_insert[$k]['num'] = intval( $v[0] );
                $extend_insert[$k]['remark'] = trim( $v[1] );
            }
            //米皮扩展表数据修改记录对比
            $old_extend = array();//定义临时变量
            //旧数据
            //获取dinner_extend表数据
            $extend = $this->Mdinner_extend->get_lists('*', array('dinner_id' => $id, 'is_del'=>0));
            $old_extend = array();
            foreach ($extend as $v) {
                $old_extend[$v['type']] = $v;
            }

            //删除post提交的扩展信息
            unset($post_data['extend']);
            unset($post_data['is_check']);

            $extend_config = C('dinner_extend');
            $extend_config_name = array_column($extend_config, 'name', 'id');
            
            $add_extend = array();
            $count = 0;

            foreach ($extend_config as $k => $v) {
                $type = $v['id'];
                $change_extend = array();

                //如果有修改则生产一条修改记录
                if ( isset($old_extend[$type]) && ($extend_insert[$type]['is_need'] != $old_extend[$type]['is_need'])  
                    || $extend_insert[$type]['num'] != $old_extend[$type]['num']
                    || $extend_insert[$type]['remark'] != $old_extend[$type]['remark']
                ) {
                    $old_value = array(
                        'is_need' => $old_extend[$type]['is_need'], 
                        'num'     => $old_extend[$type]['num'], 
                        'remark'  => $old_extend[$type]['remark']
                    );
                    $change_extend['old_value'] = json_encode($old_value);
                    $new_value = array(
                        'is_need' => $extend_insert[$type]['is_need'], 
                        'num'     => $extend_insert[$type]['num'], 
                        'remark'  => $extend_insert[$type]['remark']
                    );
                    $change_extend['new_value'] = json_encode($new_value);

                    $change_extend['key'] = $v['key'];
                    $change_extend['dinner_id'] = $id;
                    $change_extend['create_user'] = $data['userInfo']['id'];
                    $change_extend['update_user'] = $data['userInfo']['id'];
                    $change_extend['create_time'] = date('Y-m-d H:i:s', time());
                    $change_extend['update_time'] = date('Y-m-d H:i:s', time());

                    //添加一条变更记录
                    $add_extend[$type] = $change_extend;
                }
            }

            //如果有不同数据,更新旧数据，添加修改记录
            if($add_extend){
                foreach ($add_extend as $k => $v) {
                    $dinner_id = $v['dinner_id'];
                    $type = $k;
                    $where = array(
                        'dinner_id' => $dinner_id,
                        'type'      => $type,
                        'is_del'    => 0, 
                    );
                    //更新或创建
                    if ($this->Mdinner_extend->count($where)) {
                        $this->Mdinner_extend->update_info($extend_insert[$type], $where);
                    } else {
                        $this->Mdinner_extend->create($extend_insert[$type]);
                    }                  
                    $this->Mchange_record->create($v);
                }

                //需要复审
                $need_recheck = true;
            }

            if($old_arr['venue_type'] != 1){
                $old_arr['roles_main_other'] = $old_arr['roles_main'];
                $old_arr['roles_main_other_mobile'] = $old_arr['roles_main_mobile'];
            }
            $old_arr['name'] = $old_arr['user']['name'];
            $old_arr['menus'] = isset($old_arr['detail']['menus_id']) && $old_arr['detail']['menus_id'] ? $old_arr['detail']['menus_id']:'0';
            $old_arr['mobile_phone'] = $old_arr['user']['mobile_phone'];


            $alone_venue_id = $old_arr['venue_ids'];
            $alone_m_cover_img = isset($old_arr['m_cover_img']) && $old_arr['m_cover_img'] ? $old_arr['m_cover_img'] : array();
            $alone_cover_img = isset($old_arr['cover_img']) && $old_arr['cover_img']? $old_arr['cover_img'] : array();
            $alone_album = isset($old_arr['album']) && $old_arr['album']? $old_arr['album'] : array();

            unset($old_arr['id']);
            unset($old_arr['venue_ids']);
            unset($old_arr['detail']);

            unset($old_arr['m_cover_img']);
            unset($old_arr['album']);
            unset($old_arr['cover_img']);

            $diff_arr = array();
            //对比新旧数据
            $i = 0;
            //删除不需要在记录表里记录的数据 如is_show等
            //unset($old_arr['is_show']);
            foreach ($old_arr as $k=>$v){
                //跳过不需要处理的项
                if (in_array($k, ['id_card_photo', 'id_card_back_photo', 'venue_id'])) {
                    continue;
                }
                if(isset($post_data[$k]) && $post_data[$k] != $v){
                    $diff_arr[$i]['dinner_id'] = $id;
                    $diff_arr[$i]['create_user'] = $data['userInfo']['id'];
                    $diff_arr[$i]['create_time'] = date("Y-m-d H:i:s", time());
                    $diff_arr[$i]['update_time'] = date("Y-m-d H:i:s", time());
                    $diff_arr[$i]['key'] = $k;
                    $diff_arr[$i]['old_value'] = $v;
                    //$diff_arr[$i]['new_value'] = is_array($post_data[$k]) ? implode(',', $post_data[$k]) : $post_data[$k];
                    $diff_arr[$i]['new_value'] = $post_data[$k];

                }
                $i++;
            }     

            //处理宴会场馆变更
            foreach ($old_arr as $k=>$v){
                if($post_data['venue_id'] && $alone_venue_id){
                    if(array_diff($post_data['venue_id'], $alone_venue_id) || array_diff($alone_venue_id, $post_data['venue_id'])){
                        $diff_arr[$i]['dinner_id'] = $id;
                        $diff_arr[$i]['create_user'] = $data['userInfo']['id'];
                        $diff_arr[$i]['create_time'] = date("Y-m-d H:i:s", time());
                        $diff_arr[$i]['update_time'] = date("Y-m-d H:i:s", time());
                        $diff_arr[$i]['key'] = 'venue_id';
                        $diff_arr[$i]['old_value'] = implode(',', $alone_venue_id);
                        $diff_arr[$i]['new_value'] = implode(',', $post_data['venue_id']);
                        continue;
                    }
                }
                $i++;
            }   

            if($diff_arr){
                $insert_id = $this->Mchange_record->create_batch($diff_arr);
                
                //需要复审
                $need_recheck = true;
            }


            //处理封面图片
            if(isset($post_data['cover_img'])){
                $post_data['cover_img'] = implode(';', $post_data['cover_img']);
            }else{
                $post_data['cover_img'] = '';
            }
            //处理封面图片
            if(isset($post_data['m_cover_img'])){
                $post_data['m_cover_img'] = implode(';', $post_data['m_cover_img']);
            }else{
                $post_data['m_cover_img'] = '';
            }
            //处理封面图片
            if(isset($post_data['album'])){
                $post_data['album'] = implode(';', $post_data['album']);
            }else{
                $post_data['album'] = '';
            }
            //身份证
            $post_data['id_card_photo'] = isset($post_data['id_card_photo'][0]) ? $post_data['id_card_photo'][0] : '';
            $post_data['id_card_back_photo'] = isset($post_data['id_card_back_photo'][0]) ? $post_data['id_card_back_photo'][0] : '';

            //账单流水记录 ， 以合同签订日期为准
            $deposit_pay_type = $post_data['deposit_pay_type'];
            unset($post_data['deposit_pay_type']);
            $pay_log = array(
                'pay_time' => $post_data['contract_date'],
                'pay_type' => $deposit_pay_type,
                'money' => $post_data['deposit'],
                'update_time' => date('Y-m-d H:i:s')
            );
            $this->Mpay_status->update_info($pay_log, ['dinner_id' => $id]);


            //获取修改前的信息，若宴会时间或场馆变动，则短信通知米兰人员
            $id  = (int)$post_data['id'];
            $old_dinner_info = $this->Mdinner->get_one('*', array('id' => $id, 'is_del' => 0));

            //若数据发生变更， 更新米兰订单表
            //$this->update_menu_info($id, $old_dinner_info, $post_data);
            //若数据发生变更， 更新米兰订单表
            if ($menu_info = $this->Mmenu->get_one('*', array('dinner_id' => $id, 'is_del' => 0))) {
                $menu_update_data = array();
                $is_need_send_msg = false;
                $change_info['venue_id'] = $menu_info['venue_id'];
                $change_info['old_solar_time'] = $old_dinner_info['solar_time'];

                //宴会时间变更
                if ($old_dinner_info['solar_time'] != $post_data['solar_time']) {
                    $is_need_send_msg = true;
                    $menu_update_data['solar_time'] = $post_data['solar_time'];
                    $change_info['new_solar_time'] = $post_data['solar_time'];

                    //宴会时间变动，更新t_staff_schedule 表中的宴会时间
                    $schedule_update_data['schedule_time'] = $post_data['solar_time'];
                    $this->Mstaff_schedule->update_info($schedule_update_data, array('menu_id' => $menu_info['id'], 'is_del' => 0));
                }
                //宴会地点变更
                if (! in_array($menu_info['venue_id'], $post_data['venue_id'])) {
                    $is_need_send_msg = true;
                    // $menu_update_data['venue_id'] = '';
                }

                //场馆变更更新到t_menu米兰订单表
                if($post_data['venue_id']){
                    $menu_update_data['venue_id'] = intval($post_data['venue_id'][0]);
                }

                //新郎信息变更
                if ($old_dinner_info['roles_main'] != $post_data['roles_main'] || $old_dinner_info['roles_main_mobile'] != $post_data['roles_main_mobile']) {
                    $menu_update_data['roles_main'] = $post_data['roles_main'];
                    $menu_update_data['roles_main_mobile'] = $post_data['roles_main_mobile'];
                }

                //新娘信息变更
                if ($old_dinner_info['roles_wife'] != $post_data['roles_wife'] || $old_dinner_info['roles_wife_mobile'] != $post_data['roles_wife_mobile']) {
                    $menu_update_data['roles_wife'] = $post_data['roles_wife'];
                    $menu_update_data['roles_wife_mobile'] = $post_data['roles_wife_mobile'];
                }
                //宴会时间变更
                if ($menu_update_data) {
                    $this->Mmenu->update_info($menu_update_data, array('dinner_id' => $id, 'is_del' => 0));

                    if ($is_need_send_msg) {
                        $this->send_message_for_dinner_change($menu_info['id'], $change_info);
                    }
                }
            }

            //修改保存用户及预约信息
            if (! $this->change_info($post_data, $need_recheck)) {
                $this->return_failed('修改失败');
            }

            $this->return_success(['id' => $id], '修改成功');
        }

        $this->load->view('dinner/edit', $data);
    }

    /*
     *更新dinner_extend数据
     */
    public function update_dinner_extend_info($id, &$post_data, $is_check) {
        $data = $this->data;
        //获取dinner_extend表数据
        $extend = $this->Mdinner_extend->get_lists('*', array('dinner_id' => $id, 'is_del'=>0));
        //拼接需要重新加入到t_extend表数据
        $extend_insert = array();
        $extend_count = 0;
        foreach($post_data['extend'] as $k=>$v){
            $extend_insert[$extend_count]['is_need'] = $is_check[$k];
            $extend_insert[$extend_count]['type'] = $k;
            $extend_insert[$extend_count]['dinner_id'] = $id;
            $extend_insert[$extend_count]['num'] = $v[0];
            $extend_insert[$extend_count]['remark'] = $v[1];
            $extend_count++;	
        }
        //米皮扩展表数据修改记录对比
        $old_extend = array();//定义临时变量
        //旧数据
        foreach ($extend as $k=>$v){
            $old_extend[$v['type']]['num'] = $v['num'];
            $old_extend[$v['type']]['remark'] = $v['remark'];
        }
        $new_extend = $post_data['extend'];
        unset($old_extend['is_show']);
        unset($new_extend['is_show']);
        //删除post提交的扩展信息
        unset($post_data['extend']);
        unset($post_data['is_check']);
        
        $extend_config = C('dinner_extend');
        $extend_config_name = array_column($extend_config, 'name', 'id');
        $add_extend = array();
        $count = 0;
        foreach ($new_extend as $k=>$v){
            //旧数据不存在并且新数据需要
            if(!isset($old_extend[$k])){
                if($k == 1){
                    $key_name = 'rice_noodle';
                    $add_extend[$k]['old_value'] = 0;
                    $add_extend[$k]['new_value'] = $v[0];
                }elseif ($k == 2){
                    $key_name = 'egg';
                    $add_extend[$k]['old_value'] = 0;
                    $add_extend[$k]['new_value'] = $v[0];
                }elseif ($k == 3){
                    $key_name = 'mahjong';
                    $add_extend[$k]['old_value'] = 0;
                    $add_extend[$k]['new_value'] = $v[0];
                }elseif ($k == 4){
                    $key_name = 'pianjiu';
                    $add_extend[$k]['old_value'] = '';
                    $add_extend[$k]['new_value'] = $v[1];
                }elseif ($k == 5){
                    $key_name = 'daping';
                    $add_extend[$k]['old_value'] = '';
                    $add_extend[$k]['new_value'] = $v[1];
                }elseif ($k == 6){
                    $key_name = 'invition';
                    $add_extend[$k]['old_value'] = 0;
                    $add_extend[$k]['new_value'] = $v[0];
                }

                if($add_extend){
                    $add_extend[$k]['key'] = $key_name;
                    $add_extend[$k]['dinner_id'] = $id;
                    $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                    $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                    $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                }
    
            }
            
            //旧数据存在  新数据不需要
            elseif(isset($old_extend[$k])){
                if($k == 1){
                    $key_name = 'rice_noodle';
                    $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                    $add_extend[$k]['new_value'] = 0;
                }elseif ($k == 2){
                    $key_name = 'egg';
                    $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                    $add_extend[$k]['new_value'] = 0;
                }elseif ($k == 3){
                    $key_name = 'mahjong';
                    $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                    $add_extend[$k]['new_value'] = 0;
                }elseif ($k == 4){
                    $key_name = 'pianjiu';
                    $add_extend[$k]['old_value'] = $old_extend[$k]['remark'];
                    $add_extend[$k]['new_value'] = '';
                }elseif ($k == 5){
                    $key_name = 'daping';
                    $add_extend[$k]['old_value'] = $old_extend[$k]['remark'];
                    $add_extend[$k]['new_value'] = '';
                }elseif ($k == 6){
                    $key_name = 'invition';
                    $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                    $add_extend[$k]['new_value'] = 0;
                }

                if($add_extend){
                    $add_extend[$k]['key'] = $key_name;
                    $add_extend[$k]['dinner_id'] = $id;
                    $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                    $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                    $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                }
                continue;
            }

            //新旧数据都有 对比修改
            elseif(isset($old_extend[$k]) && $is_check[$k] == 1){
                if($k == 1){
                    if($old_extend[$k]['num'] != $v[0]){
                        $key_name = 'rice_noodle';
                        $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                        $add_extend[$k]['new_value'] = $v[0];
                        $add_extend[$k]['key'] = $key_name;
                        $add_extend[$k]['dinner_id'] = $id;
                        $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                        $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                        $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                    }
                }elseif ($k == 2){
                    if($old_extend[$k]['num'] != $v[0]){
                        $key_name = 'egg';
                        $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                        $add_extend[$k]['new_value'] = $v[0];
                        $add_extend[$k]['key'] = $key_name;
                        $add_extend[$k]['dinner_id'] = $id;
                        $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                        $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                        $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                    }
                }elseif ($k == 3){
                    if($old_extend[$k]['num'] != $v[0]){
                        $key_name = 'mahjong';
                        $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                        $add_extend[$k]['new_value'] = $v[0];
                        $add_extend[$k]['key'] = $key_name;
                        $add_extend[$k]['dinner_id'] = $id;
                        $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                        $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                        $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                    }
                }elseif ($k == 4){
                    if($old_extend[$k]['remark'] != $v[1]){
                        $key_name = 'pianjiu';
                        $add_extend[$k]['old_value'] = $old_extend[$k]['remark'];
                        $add_extend[$k]['new_value'] = $v[1];
                        $add_extend[$k]['key'] = $key_name;
                        $add_extend[$k]['dinner_id'] = $id;
                        $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                        $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                        $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                    }
                }elseif ($k == 5){
                    if($old_extend[$k]['remark'] != $v[1]){
                        $key_name = 'daping';
                        $add_extend[$k]['old_value'] = $old_extend[$k]['remark'];
                        $add_extend[$k]['new_value'] = $v[1];
                        $add_extend[$k]['key'] = $key_name;
                        $add_extend[$k]['dinner_id'] = $id;
                        $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                        $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                        $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                    }
                }elseif ($k == 6){
                    if($old_extend[$k]['num'] != $v[0]){
                        $key_name = 'invition';
                        $add_extend[$k]['old_value'] = $old_extend[$k]['num'];
                        $add_extend[$k]['new_value'] = $v[0];
                        $add_extend[$k]['key'] = $key_name;
                        $add_extend[$k]['dinner_id'] = $id;
                        $add_extend[$k]['create_user'] = $data['userInfo']['id'];
                        $add_extend[$k]['create_time'] = date("Y-m-d H:i:s", time());
                        $add_extend[$k]['update_time'] = date("Y-m-d H:i:s", time());
                    }
                }

            }
            $count++;
        }

        //过滤数据没有变化的项
        foreach ($add_extend as $k => $v) {
            if ($v['new_value'] == $v['old_value']) {
                unset($add_extend[$k]);
            }
        }

        if($add_extend){
            $del = $this->Mdinner_extend->update_info(array('is_del'=>1), array('dinner_id'=>$id));
            if($del && $extend_insert){
                 $add_extend_insert = $this->Mdinner_extend->create_batch($extend_insert);
            }
            $insert_extend = $this->Mchange_record->create_batch($add_extend);
        }
    }

    /*
     *更新米兰订单
     */
    public function update_menu_info($id, $old_dinner_info, &$post_data) {
        //若数据发生变更， 更新米兰订单表
        if ($menu_info = $this->Mmenu->get_one('*', array('dinner_id' => $id, 'is_del' => 0))) {
            $menu_update_data = array();
            $is_need_send_msg = false;
            $change_info['venue_id'] = $menu_info['venue_id'];
            $change_info['old_solar_time'] = $old_dinner_info['solar_time'];
            
            //宴会时间变更
            if ($old_dinner_info['solar_time'] != $post_data['solar_time']) {
                $is_need_send_msg = true;
                $menu_update_data['solar_time'] = $post_data['solar_time'];
                $change_info['new_solar_time'] = $post_data['solar_time'];
                
                //宴会时间变动，更新t_staff_schedule 表中的宴会时间
                $schedule_update_data['schedule_time'] = $post_data['solar_time'];
                $this->Mstaff_schedule->update_info($schedule_update_data, array('menu_id' => $menu_info['id'], 'is_del' => 0));
            }
            //宴会地点变更
            if (! in_array($menu_info['venue_id'], $post_data['venue_id'])) {
                $is_need_send_msg = true;
               // $menu_update_data['venue_id'] = '';
            }
    
            //场馆变更更新到t_menu米兰订单表
            if($post_data['venue_id']){
                $menu_update_data['venue_id'] = intval($post_data['venue_id'][0]);
            }
            
            //新郎信息变更
            if ($old_dinner_info['roles_main'] != $post_data['roles_main'] || $old_dinner_info['roles_main_mobile'] != $post_data['roles_main_mobile']) {
                $menu_update_data['roles_main'] = $post_data['roles_main'];
                $menu_update_data['roles_main_mobile'] = $post_data['roles_main_mobile'];
            }
            
            //新娘信息变更
            if ($old_dinner_info['roles_wife'] != $post_data['roles_wife'] || $old_dinner_info['roles_wife_mobile'] != $post_data['roles_wife_mobile']) {
                $menu_update_data['roles_wife'] = $post_data['roles_wife'];
                $menu_update_data['roles_wife_mobile'] = $post_data['roles_wife_mobile'];
            }
            
            //宴会时间变更
            if ($menu_update_data) {
                $this->Mmenu->update_info($menu_update_data, array('dinner_id' => $id, 'is_del' => 0));
                
                if ($is_need_send_msg) {
                    $this->send_message_for_dinner_change($menu_info['id'], $change_info);
                }
            }
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
        $unusual = (int) $this->input->post('unusual');
        $remark = trim($this->input->post('remark'));
        if (!$remark) {
            $this->return_failed('备注信息不能为空');
        }
        $data = array(
            'is_del' => $unusual,
            'unusual_remark' => $remark,
            'unusual_time' => date('Y-m-d H:i:s')
        );
        if($this->Mdinner->update_info($data, array('id' => $id))){
            $this->return_success([], '操作成功');
        }else{
            $this->return_failed('操作失败');
        }
    }
    
    /**
     * 显示订单详情
     * @author chaokai@gz-zc.cn
     */
    public function show_detail($id = 0){

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
        $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $data['info']['create_admin']));
        $data['info']['create_admin'] = $admin_name['fullname'];

        $data['title'] = array(
            ['url' => '/common', 'text' => '首页'],
            ['url' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '', 'text' => '订单列表'],
            ['url' => '', 'text' => '预约详情']
        );

        $data['list'] = $this->change_record($id);

        $data['invitation'] = C('dinner_extend.invitation.type');
        $data['invitation'] = array_column($data['invitation'], 'name', 'id');
        //获取套餐信息
        $combo_menu = $this->Mcombo->lists();
        $data['combo_menu'] = array_column($combo_menu, 'combo_name', 'id');
        $data['combo_menu'][0] = '套餐未确定';

        $data['dinner_id'] = $id;

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

        $this->load->view('dinner/detail', $data);
    }
    
    /**
     * 上传附件
     * @author chaokai@gz-zc.cn
     */
    public function add_file($id = 0, $album_id=0){
        $data = $this->data;
        if(IS_POST){
            $post_data = $this->input->post();
            $add = [];
            if(isset($post_data['images'])){
                foreach ($post_data['images'] as $k => $v){
                     $add[$k]['album_id'] = $this->input->post('album_id');
                     $add[$k]['create_admin'] = $data['userInfo']['id'];
                     $add[$k]['create_time'] = date('Y-m-d H:i:s');
                     $add[$k]['img'] = $v;
                     $add[$k]['sy_img'] = $post_data['sy_images'][$k];
                     $add[$k]['thumb'] = $post_data['ys_images'][$k];
                }
            }
            //把相册中原有照片删除
            $this->Mdinner_images->update_info(array('is_del' => 1), array('album_id' => $this->input->post('album_id')));
            if($add){
                if($this->Mdinner_images->create_batch($add)){
                    $this->return_success([], '保存成功');
                }else{
                    $this->return_failed('保存失败');
                }
            }else{
                $this->return_success([], '保存成功');
            }
        }
        
        $id = intval($id);
        !$id && show_404();
        
        $data['title'] = array(
            ['url' => '/common', 'text' => '首页'],
            ['url' => $_SERVER['HTTP_REFERER'], 'text' => '相册列表'],
            ['url' => '', 'text' => '管理相片']
        );
        //查询存在的信息
        $info = $this->Mdinneralbum->get_lists('id,name', ['dinner_id' => $id, 'is_del' => 0]);
        if(!$info){
            $this->success('当前没有相册，请先新建一个相册', '/dinner/album?dinner_id='.$id);
        }
        //查询相册中的图片
        $image_info = $this->Mdinner_images->get_lists('*', array('album_id' => $album_id,'is_del' => 0));
        $data['images'] = $image_info;
        
        if(!empty($album_id)){
            $data['album_id'] = $album_id;
        }
        $data['list'] = $info;
        $this->load->view('dinner/add_file', $data);
    }
    
    /**
     * 添加视频
     * @author chaokai@gz-zc.cn
     */
    public function add_video($id = 0){
        
        if(IS_POST){
            $post_data = $this->input->post();
        
            $where = array('id' => $post_data['id']);
            unset($post_data['id']);
            if($this->Mdinner->update_info($post_data, $where)){
                $this->return_success([], '保存成功');
        
            }else{
                $this->return_failed('保存失败');
            }
        }
        
        $id = intval($id);
        !$id && show_404();
        
        $data = $this->data;
        $data['title'] = array(
                        ['url' => '/common', 'text' => '首页'],
                        ['url' => $_SERVER['HTTP_REFERER'], 'text' => '订单列表'],
                        ['url' => '', 'text' => '添加附件']
        );
        //查询存在的信息
        $field = 'id,video,video_title,video_intro';
        $where = array('id' => $id);
        $info = $this->Mdinner->get_one($field, $where);
        $data['info'] = $info;
        
        $this->load->view('dinner/add_video', $data);
    }
    
    /**
     * 置顶显示
     * @author chaokai@gz-zc.cn
     */
    public function up_show(){
        $id = intval($this->input->post('id'));
        !$id && $this->return_failed();
        
        $max_id = $this->Mdinner->get_one('max(`order`) as order_max', array());
        $max_id = $max_id['order_max'] + 1;
        if($this->Mdinner->update_info(array('order' => $max_id), array('id' => $id))){
            $this->return_success();
        }else{
            $this->return_failed();
        }
    }
    
    /**
     * 修改预约信息及用户信息
     * @param $post_data 输入数据
     * @author chaokai@gz-zc.cn
     */
    private function change_info($post_data, $need_recheck = false){
    
        $user_id = $post_data['user_id'];
        $id = $post_data['id'];
    
        $user_data = array(
                        'name' => $post_data['name'],
                        'mobile_phone' => $post_data['mobile_phone'],
        );
        //开启事务
        $this->db->trans_start();
        
        //判断手机号是否修改，修改手机号则新添加客户信息
        $customer_info = $this->Mcustomer->get_one('mobile_phone', array('id' => $user_id));
        if($customer_info['mobile_phone'] == $user_data['mobile_phone']){
            $this->Mcustomer->update_info($user_data, array('id' => $user_id));
        }else{
            //如果存在修改后的手机号，获取该id并将用户设置为订单客户
            if($user_info = $this->Mcustomer->get_one('id', array('mobile_phone' => $user_data['mobile_phone']))){
                $post_data['user_id'] = $user_info['id'];
                $this->Mcustomer->update_info(array('is_order_customer' => 1, 'name' => $post_data['name']), array('id' => $user_info['id']));
            }else{
                $user_data['is_order_customer'] = 1;
                $user_data['create_admin'] = $this->data['userInfo']['id'];
                $user_data['create_time'] = $user_data['update_time'] = date('Y-m-d H:i:s');
                $post_data['user_id'] = $this->Mcustomer->create($user_data);
            }
        }
        //修改账号信息
        $this->create_user($post_data, $post_data['user_id'], $id);
        unset($post_data['id'], $post_data['name'], $post_data['mobile_phone'], $post_data['id_number']);
    
        $menus_detail = $post_data['menus'];
        unset($post_data['menus']);
        //删除原来的菜品详情数据
        $this->Mdinner_detail->update_info(array('is_del' => 1), array('dinner_id' => $id));
        //添加新菜品
        $this->add_appoint_detail($id, $menus_detail);
    
        if($post_data['venue_type'] != C('party.wedding.id')){
            $post_data['roles_main'] = $post_data['roles_main_other'];
            $post_data['roles_main_mobile'] = $post_data['roles_main_other_mobile'];
            unset($post_data['roles_wife'], $post_data['roles_wife_mobile']);
        }

        unset($post_data['roles_main_other'], $post_data['roles_main_other_mobile']);

        //删除原来宴会场馆对应表中的记录
        $this->Mdinner_venue->delete(array('dinner_id' => $id ));
        //修改场馆信息到宴会场馆对应表
        if(isset($post_data['venue_id']) && $post_data['venue_id']){
            $venue_ids = $post_data['venue_id'];
        }else{
            $venue_ids = array(0);
        }
        
        unset($post_data['venue_id']);
        $dinner_venues = array();
        foreach ($venue_ids as $k => $v){
            $dinner_venues[] = array(
                            'dinner_id' => $id,
                            'venue_id' => $v
            );
        }
        $this->Mdinner_venue->create_batch($dinner_venues);
        //计算阴历日期
        $lunar_time = solar_to_lunar($post_data['solar_time']);
        $post_data['lunar_time'] = $lunar_time['lunar_time'];
        //将订单置为待复审
        if ($need_recheck) {
            $post_data['is_examined'] = C('dinner.examine.to_recheck.id');
        }

        //更新宴会表
        $this->Mdinner->update_info($post_data, array('id' => $id));
        //查询是否存在对应的米兰订单，如果存在修改米兰订单中的信息
        $milan_exist = $this->Mmenu->get_one('id', array('dinner_id' => $id));
        if(!empty($milan_exist)){
            $milan_data = array(
                'roles_main' => $post_data['roles_main'],
                'roles_wife' => $post_data['roles_wife'],
                'roles_main_mobile' => $post_data['roles_main_mobile'],
                'roles_wife_mobile' => $post_data['roles_wife_mobile'],
                'customer_id' => $post_data['user_id']
            );
            $this->Mmenu->update_info($milan_data, array('id' => $milan_exist['id']));
        }
        $this->db->trans_complete();
        
        if($this->db->trans_status() === false){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * 创建预订人、新郎、新娘前台登录账号
     * 判断用户账号表是否存在手机号，不存在创建账号
     * @author chaokai@gz-zc.cn
     */
    private function create_user($post_data, $customer_id, $dinner_id){
        
        $user_data = array();
        $customer_data = array(
                        'mobile_phone' => $post_data['mobile_phone'],
                        'realname' => $post_data['name'],
                        'password' => get_encode_pwd(substr($post_data['mobile_phone'], -6, 6))//取手机号后6位为登录密码
        );
        //判断是否存在预订人的手机号账户
        $customer_exist = $this->Muser->get_one('id', array('mobile_phone' => $post_data['mobile_phone'], 'is_del' => 0));
        if($customer_exist){
            $customer_user_id = $customer_exist['id'];
        }else{
            $customer_user_id = $this->Muser->create($customer_data);
        }
        //将预订人账号id保存到客户表
        $this->Mcustomer->update_info(array('user_id' => $customer_user_id), array('id' => $customer_id));
        $customer_data['user_id'] = $customer_user_id;
        $user_data[] = array(
                        'mobile_phone' => $post_data['roles_main_mobile'],
                        'realname' => $post_data['roles_main'],
                        'password' => get_encode_pwd(substr($post_data['roles_main_mobile'], -6, 6))//取手机号后6位为登录密码
        );
        //如果是婚宴，获取新娘信息
        if($post_data['venue_type'] == C('party.wedding.id')){
            $user_data[] = array(
                            'mobile_phone' => $post_data['roles_wife_mobile'],
                            'realname' => $post_data['roles_wife'],
                            'password' => get_encode_pwd(substr($post_data['roles_wife_mobile'], -6, 6))
            );
        }
        
        #创建新郎、新娘登录账号
        //判断账号表是否存在手机号
        foreach ($user_data as $k => $v){
            $user_exist = $this->Muser->get_one('id', array('mobile_phone' => $v['mobile_phone'], 'is_del' => 0));
            if($user_exist){
                $user_data[$k]['user_id'] = $user_exist['id'];
            }else{
                $user_data[$k]['user_id'] = $this->Muser->create($v);
            }
        }
        //关联用户账号id和宴会id
        $user_data[] = $customer_data;
        foreach ($user_data as $k => $v){
            $user_dinner[] = array(
                            'user_id' => $v['user_id'],
                            'dinner_id' => $dinner_id
            );
        }
        //删除原有用户id和宴会id关联关系
        $this->Muser_dinner->delete(array('dinner_id' => $dinner_id));
        $this->Muser_dinner->create_batch($user_dinner);
        //to do 发送短信
        
        return $customer_user_id;
    }
    
    /**
     * 判断该天是否已被预约
     * 如果有，返回当天被预约的场馆
     * @author chaokai@gz-zc.cn
     */
    private function appoint_exist($venue_ids = array(), $date = '', $dinner_time){
        //返回变量，（id：0表示未有预约，1表示某个场馆该天有预约）
        //如果场馆被预约返回哪个场馆被预约，提示修改
        $return_arr = array(
                        'id' => 0,
                        'name' => ''
        );
        $dinner_list = $this->Mdinner_venue->get_lists('dinner_id,venue_id', array('in' => array('venue_id' => $venue_ids)));
        if(!$dinner_list){
            return $return_arr;
        }
        $dinner_ids = array_column($dinner_list, 'dinner_id');
        //查询场馆预约情况
        $appoint_list = $this->Mdinner->get_lists('id', array('in' => array('id' => $dinner_ids), 'solar_time' => $date, 'is_del' => 0, 'dinner_time' => $dinner_time));
        
        if(!$appoint_list){
            return $return_arr;
        }
        
        //获取被预约场馆的名称，提示更换场馆
        $venue_ids = array();
        foreach ($dinner_list as $k => $v){
            foreach ($appoint_list as $key => $value){
                if($value['id'] == $v['dinner_id']){
                    $venue_ids[] = $v['venue_id'];
                }
            }
        }
        
        $venue_list = $this->Mvenue->get_lists('id,name', array('in' => array('id' => $venue_ids)));
        $return_arr['id'] = 1;
        foreach ($venue_list as $k => $v){
            $return_arr['name'] .= $v['name'].';';
        }
        
        return $return_arr;
    }
    
    /**
     * 处理列表数据，如果该天没有预定，列表中显示为空
     * @author chaokai@gz-zc.cn
     */
    private function deal_list($list, $month, $year){
        $this->load->helper('date');
        
        $days = days_in_month($month, $year);
        if($month < 10){
            $month = '0'.$month;
        }
        
        for ($i = 1; $i <= $days; $i++){
            $temp = false;
            $day_text = $i >= 10 ? $i : '0'.$i;
            foreach ($list as $k => $v){
                if($v['solar_time'] == $year.'-'.$month.'-'.$day_text){
                    $temp = true;
                }
            }
            if($temp == false){
                $list[]['solar_time'] = $year.'-'.$month.'-'.$day_text;
            }
        }
        
        //重新按时间排序数组
        usort($list, function($a, $b){
            $a_time = strtotime($a['solar_time']);
            $b_time = strtotime($b['solar_time']);
            
            if($a_time == $b_time){
                return 0;
            }
            return $a_time > $b_time ? 1 : -1;
        });
        return $list;
    }
    
    /**
     * 添加跟拍效果
     * @author louhang@gz-zc.cn
     */
    public function following_effect($id = 0){
        if(IS_POST){
            $following_effect = $this->input->post('yt_following_effects');
            $post_data['following_effect'] = implode(';', $following_effect);
            $where = array('id' => $this->input->post('id'));
            if($this->Mdinner->update_info($post_data, $where)){
                $this->return_success('', '保存成功');
            }else{
                $this->return_failed('保存失败');
            }
        }
        
        $id = intval($id);
        !$id && show_404();
        
        $data = $this->data;
        $data['title'] = array(
                        ['url' => '/common', 'text' => '首页'],
                        ['url' => '/dinner', 'text' => '订单列表'],
                        ['url' => $_SERVER['HTTP_REFERER'], 'text' => '相册'],
                        ['url' => '', 'text' => '跟拍效果']
        );
        //查询存在的信息
        $field = 'id, following_effect';
        $where = array('id' => $id);
        $info = $this->Mdinner->get_one($field, $where);
        if($info['following_effect']){
            $info['following_effect'] = explode(';', $info['following_effect']);
        }
        $data['info'] = $info;
        
        $this->load->view('dinner/add_following_effect', $data);
    }
    
    /**
     * 宴会文章关联
     * @author chaokai@gz-zc.cn
     */
    public function dinner_article(){
        $dinner_id = $this->input->get('dinner_id');
        
        if(!$dinner_id){
            show_404();
        }
        
        if(IS_POST){
            $post_data = $this->input->post();
            //判断是否存在
            $exist = $this->Mdinner_article->get_one('*', array('dinner_id' => $post_data['dinner_id']));
            if($exist){
                $this->Mdinner_article->update_info(array('article_id' => $post_data['article_id']), array('dinner_id' => $post_data['dinner_id']));
            }else{
                $this->Mdinner_article->create($post_data);
            }
            $this->success('', '/dinner/album?dinner_id='.$dinner_id);
        }
        $data = $this->data;
        $dinner_article = $this->Mdinner_article->get_one('*', array('dinner_id' => $dinner_id));
        if($dinner_article){
            $news = $this->Mnews->get_one('*', array('id' => $dinner_article['article_id']));
            if($news){
                $data['article_id'] = $news['id'];
                $data['article_name'] = $news['title'];
            }
        }
        $data['dinner_id'] = $dinner_id;
        $this->load->view('dinner/dinner_article', $data);
    }
    
    
    /**
     * 宴会发送变动时 短信提醒米兰人员
     * @author louhang@gz-zc.cn
     */
    public function send_message_for_dinner_change($menu_id, $change_info = array()){
        //获取工作人员id
        $staffs = $this->Mstaff_schedule->get_lists('staff_id, schedule_time', array('menu_id' => $menu_id, 'is_del' => 0));
        if (! $staffs) {
            return true;
        }
        
        //获取工作人员tel
        $staff_tel = array_column($staffs, 'staff_id');
        $users_info = $this->Madmins->get_lists('id, fullname, tel', array('in' => array('id' => $staff_tel)));
        $tels = array_column($users_info, 'tel', 'id');
        if (! $tels) {
            return true;
        }

        //获取婚宴日期，地点
        $venues = $this->Mvenue->get_lists('*');
        $venues = array_column($venues, 'name', 'id');
        $venue_id = $change_info['venue_id'];
        $venue = $venue_id == 0 ? '百年婚宴' : $venues[$venue_id];

        //发送短信
        $msg = '';
        if (isset($change_info['new_solar_time'])) {
            //$msg = "您于{$change_info['old_solar_time']}, 在{$venue} 的米兰档期预约, 时间更改为{$change_info['new_solar_time']}, 请登录后查看详情 http://rrd.me/bgcSS";
            $res = send_msg($tels, 'schedule_time_change', ['old_solar_time' => $change_info['old_solar_time'], 'venue' => $venue, 'new_solar_time' => $change_info['new_solar_time']]);
        } else {
            //$msg = "您于{$change_info['old_solar_time']}, 在{$venue} 的米兰档期预约宴会场馆发生变更, 请登录后查看详情 http://rrd.me/bgcSS";
            $res = send_msg($tels, 'schedule_venue_change', ['solar_time' => $change_info['old_solar_time'], 'venue' => $venue]);
        }

       
        if ($res) {
            $this->return_success(array('send_msg_num' => is_array($tels) ? count($tels) : 1),'发送成功');
        } else {
            $this->return_failed('发送失败');
        }
        
    }
    
    /**
     * 签字
     * @author louhang@gz-zc.cn
     */
    public function signature(){
        $data = $this->data;
        $this->load->view('bainian_contract/signature', $data);
    }
    
    /**
     * 合同添加
     * @author louhang@gz-zc.cn
     */
    public function contract(){
        $data = $this->data;
        //获取所有场馆名字
        $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
        $venue_name = array_column($venue_list, 'name', 'id');
        
        
        $data['year'] = $this->input->get('year');
        $data['month'] = $this->input->get('month');
        $data['day'] = $this->input->get('day');
        $data['venue_id'] = $this->input->get('venue_id');
        
        if($data['year'] && $data['month']){
            $month = $data['month'] < 10 ? '0'.$data['month'] : $data['month'];
            $this->load->helper('date');
            $days = days_in_month($data['month'], $data['year']);
            $data['min_date'] = $data['year'].'-'.$month.'-01';
            $data['max_date'] = $data['year'].'-'.$month.'-'.$days;
        }
    
        $data['title'] = array('订单列表', '添加预约');
        //宴会类型
        $data['party_type'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        //套餐菜品
        $data['combo_menu'] = $this->Mcombo->lists();
        
        //附加项目列表
        $lists = $this->Mclass_item_contract->get_lists('id,name,desc', ['is_del' => 0]);
        $lists = $lists ? array_column($lists, null, 'id') : [];
        
        $item_lists = $this->Mitem_of_contract->get_lists('id,name,pid,price', ['is_del' => 0]);
        foreach ($item_lists as $k => $v){
            if(isset($lists[$v['pid']]))
                $lists[$v['pid']]['child'][] = $v;
        }
        
        $data['lists'] = $lists;
        
        //合同签订人
        $admin_id = $data['userInfo']['id'];
        $admin = $this->Madmins->get_one('id, fullname', array('id' => $admin_id));
        $data['admin_name'] = $admin['fullname'];
    
        $this->load->view('contract/add', $data);
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
        foreach ($new_dishes as $k => $v) {
            $sum += $v['price'];
        }
        
        $data['old_price'] = sprintf('%.2f', $sum);
        $data['favorable'] = sprintf('%.2f', $sum-$data['price']);
        
        //内部控制器调用
        if ($inner_call) {
            return $data;
        }

        $this->return_success($data, 'success'); 
    }
    
    /**
     * PDF打印
     * @author louhang@gz-zc.cn
     */
    public function PDF_print($id = 0){
        
        $data = $this->data;
        
        //获取所有场馆名字
        $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
        $venue_name = array_column($venue_list, 'name', 'id');
        
        $data['title'] = array('订单列表', '添加预约');
        //宴会类型
        $data['party_type'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        //套餐菜品
        $data['combo_menu'] = $this->Mcombo->lists();
        
        //附加项目列表
        $lists = $this->Mclass_item_contract->get_lists('id,name,desc', ['is_del' => 0]);
        $lists = $lists ? array_column($lists, null, 'id') : [];
        
        $item_lists = $this->Mitem_of_contract->get_lists('id,name,pid,price', ['is_del' => 0]);
        foreach ($item_lists as $k => $v){
            if(isset($lists[$v['pid']]))
                $lists[$v['pid']]['child'][] = $v;
        }
        $data['lists'] = $lists;
        
        $this->load->file(BASEPATH.'../shared/libraries/mpdf/mpdf.php'); 
        $mpdf = new Mpdf('zh-CN');
        
        $stylesheet = file_get_contents(BASEPATH.'../static/admin/css/word_print.css');
        $mpdf->WriteHTML($stylesheet, 1);
        
        ob_start();
        
        // This is where your script would normally output the HTML using echo or print
        
        // Now collect the output buffer into a variable
        $this->contract_display($id, true);
        
        $html = ob_get_contents();
        
        ob_end_clean();
        
        // send the captured HTML from the output buffer to the mPDF class for processing
        
        $mpdf->WriteHTML($html, 2);
        
        
        //水印
        //$mpdf->watermark('百年婚宴', 45, 50);
        
        $file_dir = 'files';
        $file_ext = '.pdf';
        $date = date('Ymd');
        $dir = C('upload.upload_dir').$file_dir.'/'.$date;

        //如果目录不存在，则创建目录
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                exit('创建文件夹失败');
            }
        }
       
        //新的文件名
        $file_name = md5(date("YmdHis").rand(10000, 99999)).$file_ext;

        //文件路径
        $full_path = $dir.'/'.$file_name;

        //写入本地
        $res = $mpdf->Output($full_path, 'F');
        
        //上传至OSS
        $relative_path = $date.'/'.$file_name;
        save_to_oss(['url' => $relative_path], $file_dir);
        
        return $relative_path;
        
    }
    
    /**
     * 查看变更记录
     * @author louhang@gz-zc.cn
     */
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
     * 上传更改凭证
     *
     * @author louhang@gz-zc.cn
     */
    public function upload_attachment(){
        $data = $this->data;
        $data['record_id'] = (int)$this->input->get('id');
        $data['dinner_id'] = (int)$this->input->get('dinner_id');
        
        if (IS_POST) {
            
            $record_id = (int)$this->input->post('record_id');
            $attachment = $this->input->post('attachment');
            
            $record = $this->Mchange_record->get_one('*', ['id' => $record_id]);
            $dinner_id = $record['dinner_id'];
            $res = $this->Mchange_record->update_info(['attachment' => $attachment], ['dinner_id' => $dinner_id, 'create_time' => $record['create_time']]);

            if ($res) {
                $this->return_success(['dinner_id' => $dinner_id],'保存成功!');
            }
            
            $this->return_failed('保存失败!');

        }
        
        
        
        $this->load->view('dinner/uplode_attachment', $data);
    }
    
    /*
     * 添加合同
     * @author louhang@gz-zc.cn
     */
    public function contract_add() {
        if(IS_POST){
            //数据验证
            $this->form_validation->set_rules('name', '姓名', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('deposit', '定金', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_id[]', '场馆', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_type', '宴会类型', 'trim|required|integer', array('required' => '%s不能为空', 'integer' => '数值类型不合法'));
            $this->form_validation->set_rules('solar_time', '公历时间', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('menus', '套餐标准', 'trim|required', array('required' => '%s不能为空'));
            //$this->form_validation->set_rules('id_card_photo', '身份证照片', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('customer_signature', '手写签字', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('invitation', '宴会请柬', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('mobile_phone', '联系电话', 'trim|required', array('required' => '%s不能为空'));

            if($this->form_validation->run() == false){
                $msg = validation_errors();
                $msg = strip_tags(strstr($msg, "\n", true));
                
                $this->return_failed($msg);
            }
            
            $post_data = $this->input->post();
            //获取所有场馆名字
            $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
            $venue_name = array_column($venue_list, 'name', 'id');
            
            //查询当天有哪些厅已经预定
            if($post_data['solar_time']){
                $venue_list = $this->Mdinner->get_lists('id,solar_time', array('solar_time'=>$post_data['solar_time'], 'is_del' => 0, 'dinner_time' => $post_data['dinner_time']));
                //获取订单id
                $data['dinner_id'] = array_column($venue_list, 'id');
                if($data['dinner_id']){
                    $query['in'] = array('dinner_id'=>$data['dinner_id']);
                    $venue_list = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
                    $venue_id = array_column($venue_list, 'venue_id');
                    if(isset($post_data['venue_id']) && $post_data['venue_id']){
                        foreach ($post_data['venue_id'] as $k=>$v){
                            if(in_array($v, $venue_id)){
                                $this->return_failed($venue_name[$v].'已经被预约过了!');
                            }
                        }
                    }
                }
            }
            
            //验证手机号
            if(!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone'])){
                $this->return_failed('手机号格式不正确');
            }
            
            //判断该天是否被预约过
            if(isset($post_data['venue_id']) && $post_data['venue_id']){
                $appoint_list = $this->appoint_exist($post_data['venue_id'], $post_data['solar_time'], $post_data['dinner_time']);
                if($appoint_list['id'] == 1){
                    $this->return_failed('以下场馆已被预约<br>'.$appoint_list['name']);
                }
                
            }
            
            //判断客户是否存在
            $user_exist = $this->Mcustomer->get_one('id', array('mobile_phone' => $post_data['mobile_phone'], 'name' => $post_data['name']));
            $user_data = array(
                            'name' => $post_data['name'],
            );

            //电子合同添加的签订合同人就是乙方 电话就是乙方电话
            $post_data['sign_contract'] = $post_data['name'];
            $post_data['sign_contract_mobile'] = $post_data['mobile_phone'];

            if($user_exist){
                $customer_id = $user_exist['id'];
                $this->Mcustomer->update_info(array('is_order_customer' => 1), array('id' => $user_exist['id']));
		
            }else{
                $user_data['mobile_phone'] = $post_data['mobile_phone'];
                $user_data['is_order_customer'] = 1;
                $user_data['create_admin'] = $this->data['userInfo']['id'];
                $user_data['create_time'] = $user_data['update_time'] = date('Y-m-d H:i:s');
                $customer_id = $this->Mcustomer->create($user_data);
            }
            $post_data['user_id'] = $customer_id;
    
            if($post_data['venue_type'] != C('party.wedding.id')){
                $post_data['roles_main'] = $post_data['roles_main_other'];
                $post_data['roles_main_mobile'] = $post_data['roles_main_other_mobile'];
                unset($post_data['roles_wife'], $post_data['roles_wife_mobile']);
            }
            unset($post_data['roles_main_other'], $post_data['roles_main_other_mobile']);
            
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['create_admin'] = $post_data['update_admin'] = $this->data['userInfo']['id'];
            
            //记录扩展信息
            $dinner_extend = array();
            $dinner_extend_config = C('dinner_extend');
            
            //是否需要偏酒
            $dinner_extend[] = array(
                'is_need' => $post_data['wine'],
                'type' => $dinner_extend_config['pianjiu']['id'],
                'num' => (int) $post_data['wine'],
                'remark' => $post_data['wine_remark']
            );
            unset($post_data['wine'], $post_data['wine_remark']);
            
            //是否需要打屏
            $dinner_extend[] = array(
                'is_need' => $post_data['screen'],
                'type' => $dinner_extend_config['daping']['id'],
                'num' => (int) $post_data['screen'],
                'remark' => $post_data['screen_remark']
            );
            unset($post_data['screen'], $post_data['screen_remark']);
            
            //麻将
            $dinner_extend[] = array(
                'is_need' => $post_data['mahjong'],
                'type' => $dinner_extend_config['mahjong']['id'],
                'num' => (int) $post_data['mahjong_num'],
                'remark' => $post_data['mahjong_remark']
            );
            unset($post_data['mahjong'], $post_data['mahjong_num'], $post_data['mahjong_remark']);
            
            //主桌
            $dinner_extend[] = array(
                'is_need' => $post_data['zuzhuo'],
                'type' => $dinner_extend_config['zuzhuo']['id'],
                'num' => (int) $post_data['zuzhuo_num'],
                'remark' => $post_data['zuzhuo_remark']
            );
            unset($post_data['zuzhuo'], $post_data['zuzhuo_num'], $post_data['zuzhuo_remark']);
            
            //是否需要中餐米粉
            $dinner_extend[] = array(
                'is_need' => $post_data['rice_noodle'],
                'type' => $dinner_extend_config['rice_noodle']['id'],
                'num' => (int)$post_data['rice_noodle_num'],
                'remark' => $post_data['rice_noodle_remark']
            );
            unset($post_data['rice_noodle'], $post_data['rice_noodle_num'], $post_data['rice_noodle_remark']);
            
            //是否需要鸡蛋
            $dinner_extend[] = array(
                'is_need' => $post_data['egg'],
                'type' => $dinner_extend_config['egg']['id'],
                'num' => (int)$post_data['egg_num'],
                'remark' => $post_data['egg_remark']
            );
            unset($post_data['egg'], $post_data['egg_num'], $post_data['egg_remark']);
            
            //是否需要司仪
            $dinner_extend[] = array(
                'is_need' => $post_data['mc'],
                'type' => $dinner_extend_config['mc']['id'],
                'num' => (int)$post_data['mc_num'],
                'remark' => $post_data['mc_remark']
            );
            unset($post_data['mc'], $post_data['mc_num'], $post_data['mc_remark']);
            
            //是否需要个性请帖
            $dinner_extend[] = array(
                'is_need' => $post_data['invitation'] == C('dinner_extend.invitation.type.not_need.id') ? 0 : 1,
                'type' => $dinner_extend_config['invitation']['id'],
                'num' => (int)$post_data['invitation'],
                'remark' => $post_data['invitation_remark'],
            );
            unset($post_data['invitation'], $post_data['invitation_remark']);
            
            
            //宴会额外服务，灯光、婚车……
            $service = array();
            if (isset($post_data['service'])) {
                foreach ($post_data['service'] as $key => $value) {
                    $service[] = ['service_id' => $value];
                }
                unset($post_data['service']);
            }
            
            //优惠券信息
            $coupon = array();
            if (isset($post_data['coupon'])) {
                foreach ($post_data['coupon'] as $k => $v) {
                    if ($v['number'] && $v['money']) {
                        $coupon[] = $v;
                    }
                } 
                unset($post_data['coupon']);
            }
            //生成合同编号
            $post_data['contract_num'] = date('YmdHis');

            //开启事务
            $this->db->trans_start();
            
            $user = $post_data;
            unset($post_data['mobile_phone'], $post_data['name'], $post_data['id_number']);
    
            //宴会菜单详情
            $menus = $post_data['menus'];
            unset($post_data['menus']);
            
            if(isset($post_data['venue_id']) && $post_data['venue_id']){
                $venue_ids = $post_data['venue_id'];
            }else{
                $venue_ids = array(0);
            }
            
            unset($post_data['venue_id']);
            //获取阴历日期
            $lunar_time = solar_to_lunar($post_data['solar_time']);
            $post_data['lunar_time'] = $lunar_time['lunar_time'];
            //保存订单
            //处理pc端封面图片
            if(isset($post_data['cover_img'])){
                $post_data['cover_img'] = implode(';', $post_data['cover_img']);
            }
            //处理手机端封面图片
            if(isset($post_data['m_cover_img'])){
                $post_data['m_cover_img'] = implode(';', $post_data['m_cover_img']);
            }
            //处理相册图片
            if(isset($post_data['album'])){
                $post_data['album'] = implode(';', $post_data['album']);
            }
            
            //支付方式
            $deposit_pay_type = $post_data['pay_type'];
            $dinner_id = $this->Mdinner->create($post_data);
            !$dinner_id && $this->return_failed('操作失败');
            
            //保存客户信息；生成手机号前台登录账号
            $user_id = $this->create_user($user, $customer_id, $dinner_id);

            //保存信息到客户场馆对应表
            $dinner_venues = array();
            
            foreach ($venue_ids as $k => $v){
                $dinner_venues[] = array(
                    'dinner_id' => $dinner_id,
                    'venue_id' => $v
                );
            }
            $this->Mdinner_venue->create_batch($dinner_venues);

            //保存菜单信息
            if($menus){
                $this->add_appoint_detail($dinner_id, $menus);
            }

            //宴会拓展信息 麻将 米粉……
            if ($dinner_extend) {
                foreach ($dinner_extend as $k => $v) {
                    $dinner_extend[$k]['dinner_id'] = $dinner_id;
                }
                $this->Mdinner_extend->create_batch($dinner_extend);
            }
            
            //宴会额外服务 灯光、婚车……
            if ($service) {
                foreach ($service as $k => $v) {
     
                    $service[$k]['dinner_id'] = $dinner_id;
                }
                $this->Mdinner_extra_service->create_batch($service);
            }
            
            //优惠券信息
            $coupon_config = C('coupon');
            
            if ($coupon) {
                foreach ($coupon as $k => $v) {
                    $coupon[$k]['dinner_id'] = $dinner_id;
                    $coupon[$k]['create_time'] = $post_data['create_time'];
                    $coupon[$k]['status'] = $coupon_config['status']['no_use']['id'];
                    $coupon[$k]['user_id'] = $user_id;
                    $coupon[$k]['coupon_type'] = $coupon_config['type']['bainian']['id'];
                    $coupon[$k]['create_admin'] = $this->data['userInfo']['id'];
                }
                $this->Muser_coupon->create_batch($coupon);
            }
            
            //账单流水记录 ， 以合同签订日期为准
            $pay_log = array(
                            'dinner_id' => $dinner_id,
                            'customer_id' => $customer_id,
                            'pay_time' => $post_data['contract_date'],
                            'pay_type' => $deposit_pay_type,
                            'payment' => C('order.payment.deposit.id'),
                            'money' => $post_data['deposit'],
                            'create_admin' => $post_data['create_admin'],
            
                            'create_time' => $post_data['create_time'],
                            'update_time' => $post_data['update_time']
            );
            $this->Mpay_status->create($pay_log);
            //PDF合同
            $PDF_path = $this->PDF_print($dinner_id);

            $this->Mdinner->update_info(['PDF_contract' => $PDF_path], ['id' => $dinner_id]);
            
            //完成事务
            $this->db->trans_complete();
            
            if($this->db->trans_status() === false){
                $this->return_failed('保存失败');
            }else{
                $pdf_url = get_file_url($PDF_path);
                
                //短信通知客户
                send_msg_huaxing($user['mobile_phone'], "尊敬的百年客户您好，您于{$post_data['contract_date']}在百年婚宴签订宴会合同， 查看合同详情请点击 {$pdf_url} ");
                
                //不能使用阿里大于短信通道，阿里大于有限制变量不能超过了15个字符， $PDF_path光文件名就30多个字符
                //send_msg($user['mobile_phone'], 'contract_sign_remind', ['contract_date' => $post_data['contract_date'], 'pdf_url' =>$PDF_path]);
                
                $this->return_success(['pdf_url' => $pdf_url], '保存成功');
            }
    
        }
    }
   
	public function resend_msg(){
		if($this->input->is_ajax_request()){
			$dinner_id = $this->input->post('dinner_id');
			$dinner_id = intval($dinner_id);
			//获取联系人电话
			$user_id = $this->Mdinner->get_one('user_id, contract_date, PDF_contract', ['id' => $dinner_id]);
			$user_phone = $this->Mcustomer->get_one('mobile_phone', ['id'=>$user_id['user_id']]);
			//PDF合同
            		//$PDF_path = $this->PDF_print($dinner_id);
			if(isset($user_id['PDF_contract']) && $user_id['PDF_contract']){
				 $pdf_url = get_file_url($user_id['PDF_contract']);
                	//短信通知客户
                send_msg_huaxing($user_phone['mobile_phone'], "尊敬的百年客户您好，您于{$user_id['contract_date']}在百年婚宴签订宴会合同， 查看合同详情请点击 {$pdf_url} ");
				$this->return_success([], '短信发送成功!');
			}
			
			$this->return_failed('短信发送失败');
		}

	}

 
    /**
     * 合同预览
     * @author louhang@gz-zc.cn
     */
    public function contract_display($id = 0, $is_print = false){
        
        $data = $this->data;

        $dinner_id = (int)$this->input->get('id');
        if ($id) {
            $dinner_id = (int)$id;
        }
        
        //宴会类型
        $data['party_type'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        //套餐菜品
        $data['combo_menus'] = $this->Mcombo->lists();
    
        //附加项目列表
        $lists = $this->Mclass_item_contract->get_lists('id,name,desc', ['is_del' => 0]);
        $lists = $lists ? array_column($lists, null, 'id') : [];
        $item_lists = $this->Mitem_of_contract->get_lists('id,name,pid,price', ['is_del' => 0]);
        foreach ($item_lists as $k => $v){
            if(isset($lists[$v['pid']]))
                $lists[$v['pid']]['child'][] = $v;
        }
        $data['lists'] = $lists;
        
        $dinner = $this->Mdinner->get_one('*', ['id' => $dinner_id]);
        $dinner_detail = $this->Mdinner->info($dinner_id);
        $dinner['name'] = $dinner_detail['user']['name'];
        $dinner['venue_ids'] = $dinner_detail['venue_ids'];
       
        $dinner['menus_id'] = isset($dinner_detail['detail']['menus_id']) ? $dinner_detail['detail']['menus_id'] : '0';
        $dinner['mobile_phone'] = $dinner_detail['user']['mobile_phone'];
        $dinner['deposit_daxie'] = convert_money($dinner['deposit']);
        $dinner['lunar_time'] = solar_to_lunar($dinner['solar_time']);
        
        $lunar_time = solar_to_lunar($dinner['solar_time']);
        $dinner['lunar_time'] = $lunar_time['lunar_time'];
        
        $week = array('日', '一', '二', '三', '四', '五', '六');
        $dinner['week'] =  '星期'. $week[date('w', strtotime($dinner['solar_time']))];
        $data['dinner'] = $dinner;
        
        $dinner_extend = $this->Mdinner_extend->get_lists('*', ['dinner_id' => $dinner_id, 'is_del' => 0]);
        $dinner_extend = $dinner_extend ? array_column($dinner_extend, null, 'type') : [];
        $data['dinner_extend'] = $dinner_extend;
        
        $dinner_extra_service = $this->Mdinner_extra_service->get_lists('*', ['dinner_id' => $dinner_id, 'is_del' => 0]);
        $dinner_extra_service = $dinner_extra_service ? array_column($dinner_extra_service, 'service_id') : [];
        $data['dinner_extra_service'] = $dinner_extra_service;
        
        $combo = $this->get_combo($dinner['menus_id'], true);
        $data['combo'] = $combo;
        
        //优惠券
        $data['coupon'] = $this->Muser_coupon->get_lists('*', ['dinner_id' => $dinner_id]);
        
        if ($is_print) {
            $this->load->view('contract/display_print', $data);
        } else {
            $this->load->view('contract/front_display', $data);
        }
    }
    
    
    /**
     * 获取上传凭证页面
     * @author louhang@gz-zc.cn
     */
    public function get_upload_attachment(){
        $data = $this->data;
        $data['record_id'] = (int)$this->input->get('id');
        $this->load->view('dinner/upload_attachment', $data);
    }
    
    /**
     * 查看合同PDF
     * @author louhang@gz-zc.cn
     */
    public function view_contract_PDF($id = 0){
        $data = $this->data;
        $dinner_id = (int)$this->input->get('id');
        if ($id) {
            $dinner_id = $id;
        }
        $res = $this->Mdinner->get_one('PDF_contract', ['id' => $dinner_id]);
        if (! $res) {
            show_404();
        }

        header('location:' . get_file_url($res['PDF_contract']));
        
    }

    /**
     * ajax请求推送数据
     * @author chaokai@gz-zc.cn
     */
    public function push_ajax(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');

        $data['id'] = $id;

        $info = $this->Mdinner->info($id);
        !$info && $this->return_failed('记录不存在');
        
        //获取 dinner_extend 信息
        $dinner_extend_config = C('dinner_extend');
        $dinner_extend_config_text = array_column($dinner_extend_config, 'name', 'id');
        $invination_config = array_column($dinner_extend_config['invitation']['type'], 'name', 'id');
        $where = array(
            'is_del' => 0, 
            'dinner_id' => $id,
            'in' => array('type' => [C('dinner_extend.rice_noodle.id'), C('dinner_extend.egg.id')])
        );
        $dinner_extend = $this->Mdinner_extend->get_lists('*', $where);
        foreach ($dinner_extend as $k => $v){
            
            $outstr = '';
            if ($v['num']) {
                if ($v['type'] == $dinner_extend_config['invitation']['id']) {
                    $outstr .= $invination_config[$v['num']];
                } else {
                    $outstr .= '  数量:'. $v['num'].'  备注:'. $v['remark'];
                }
            }
            
            $dinner_extend[$k]['key_text'] = $dinner_extend_config_text[$v['type']];
            $dinner_extend[$k]['out_str'] = $outstr;

        }

        if(empty($info['detail'])){
            $this->return_failed('未选择套餐');
        }

        $return_arr[] = array(
            'key_name' => 'is_send_menu',
            'key_text' => '菜单',
            'out_str' => '套餐：'.$info['detail']['name'].'；数量：'.$info['menus_count'],
            'is_send' => $info['is_send_menu']
        );
        foreach ($dinner_extend as $key => $value) {
            if($value['type'] == C('dinner_extend.rice_noodle.id')){
                $value['key_name'] = 'is_send_noodle';
                $value['is_send'] = $info['is_send_noodle'];
            }
            if($value['type'] == C('dinner_extend.egg.id')){
                $value['key_name'] = 'is_send_egg';
                $value['is_send'] = $info['is_send_egg'];
            }
            $return_arr[] = $value;
        }
        $data['return_arr'] = $return_arr;

        $return_str = $this->load->view('dinner/push_ajax', $data, true);

        $this->return_success($return_str);


    }

    /**
     * 推送订单到厨房
     * @author chaokai@gz-zc.cn
     */
    public function push(){

        $data = $this->data;
        if(IS_POST){
            $post_data = $this->input->post();

            $where = array(
                'id' => $post_data['id']
            );
            unset($post_data['id']);
            if(empty($post_data)){
                $this->return_failed();
            }
            $post_data['push_time'] = date('Y-m-d', time());
            $this->Mdinner->update_info($post_data, $where);
            $this->return_success();
        }else{
            $this->return_failed('方法错误');
        }
    }

    /**
     * 恢复删除
     * @author chaokai@gz-zc.cn
     */
    public function restore(){
        $id = intval($this->input->post('id'));
        !$id && $this->return_failed('参数错误');

        //查询订单是否为删除状态
        $is_del = $this->Mdinner->get_one('is_del', array('id' => $id));
        if(!empty($is_del) && $is_del['is_del'] != 1){
            $this->return_failed('订单不存在或订单不可恢复');
        }

        $this->Mdinner->update_info(array('is_del' => 0), array('id' => $id));

        $this->return_success();
    }

    /**
     * 已推送订单
     * @author fengyi@gz-zc.cn
     */
    public function is_pushed(){
        $data = $this->data;
        $push_time = $this->input->get('push_time');
        if (!$push_time) {
            $push_time = date('Y-m', time());
        }
        $dinners = $this->Mdinner->get_pushed_solar($push_time);   
        $data['list'] = $dinners;

        $data['push_time'] = $push_time;

        $this->load->view('dinner/pushed', $data);
    }
    
    /**
     * 发票须知签字
     */
    public function invoice_notice($id = 0){
        !$id && show_404();
        
        $data = $this->data;
        $data['id'] = $id;
        $info = $this->Mdinner->get_one('solar_time', ['id' => $id]);
        $dinner_solar_time = $info['solar_time'];
        $data['dinner_solar_time'] = $dinner_solar_time;
        $lists = $this->Mdinner_venue->get_lists('venue_id', ['dinner_id' => $id]);
        $venue_names_str = '';
        if ($lists) {
            $venue_ids = array_column($lists, 'venue_id');
            $venue_lists = $this->Mvenue->get_lists('name', ['in' => ['id' => $venue_ids] ]);
            $venue_names_arr = array_column($venue_lists, 'name');
            $venue_names_str = implode(',', $venue_names_arr);
        }
        if (!$venue_names_str) {
            $venue_names_str = '未确定';
        }
        $data['venue_names_str'] = $venue_names_str;
        $signature_info = $this->Minvoice_notice->get_one('signature, signature_time', ['dinner_id' => $id]);
        if ($signature_info) {
            $data['signature'] = $signature_info['signature'];
            $data['signature_time'] = date('Y-m-d', strtotime($signature_info['signature_time']));
        }
        $this->load->view('signature/index1', $data);
    }

    /**
     * 添加签字
     */
    public function save_invoice_notice() {
        
        !IS_POST && $this->return_failed('保存失败');

        $post_data = $this->input->post();
        $dinner_id = (int) $post_data['id'];
        $signature = trim($post_data['signature']);
        $time = date('Y-m-d', time());
        $data = [
            'dinner_id' => $dinner_id,
            'signature' => $signature,
            'signature_time' => $time,
        ];
        $where = ['dinner_id' => $dinner_id];
        $count = $this->Minvoice_notice->count($where);
        if ($count) {
            $res = $this->Minvoice_notice->update_info($data, $where);
        } else {
            $res = $this->Minvoice_notice->create($data);
        }
        
        if ($res) {
            $this->return_success('', '保存成功');
        } else {
            $this->return_failed('保存失败');
        }

    }
    
    /**
     * 个人授权委托书
     */
    public function power_attorney($id = 0){
        $data = $this->data;
        
        $this->load->view('signature/index2', $data);
    }
}
