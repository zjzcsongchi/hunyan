<?php 
    /**
    * 优惠卷控制器
    * @author yonghua@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class  Coupon extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_coupon' => 'Mcoupon',
            'Model_coupon_type' => 'Mcoupontype',
            'Model_admins' => 'Madmin',
            'Model_user_coupon' => 'Muser_coupon',
            'Model_user' => 'Muser',
            'Model_dinner' => 'Mdinner',
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    /**
    * 优惠卷列表
    * @author yonghua@gz-zc.cn
    */
    public function index(){
        $data = $this->data;
        $coupon_field = 'id,type_id,favorable,create_admin,create_time,update_time,is_del';
        $type_field = 'id,name';
        $type = $this->Mcoupontype->get_lists($type_field, ['is_del'=> 0]);
        $page =  intval(trim($this->input->get("per_page", true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('create_time'=>'desc');
        $list = $this->Mcoupon->get_lists($coupon_field,0,$order_by,$size,($page-1)*$size);
        $count = $this->Mcoupon->count(['is_del' => 0]);
        if(!$list){
            $data['list'] = null;
        }
        $admin = $this->Madmin->get_lists('id,name');
        foreach ($list as $k => $v){
            $data['list'][$k] = $v;
            foreach ($type as $kk => $vv){
                if($v['type_id'] == $vv['id']){
                    $data['list'][$k]['name'] = $vv['name'];
                }
            }
            foreach ($admin as $kk => $vv){
                if($vv['id'] == $v['create_admin']){
                    $data['list'][$k]['admin'] = $vv['name'];
                }
            }
        }
        $data['page'] = $page;
        $data['count'] = $count;
        $this->pageconfig['base_url'] = "/coupon/index";
        $this->pageconfig['total_rows'] = $count;
        $this->pagination->initialize($this->pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        $this->load->view('coupon/index', $data);
    }
    
    /**
     * 用户优惠卷列表
     * @author songchi@gz-zc.cn
     */
    public function user_coupon(){
        $data = $this->data;
        $page =  intval(trim($this->input->get("per_page", true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('create_time'=>'desc');
        
        $name = trim($this->input->get('name'));
        $tel = trim($this->input->get('tel'));
        $status = trim($this->input->get('status'));
        $create_time = trim($this->input->get('create_time'));
        $end_time = trim($this->input->get('end_time'));
        if($create_time){
            $query['create_time'] = $create_time;
            $data['create_time'] = $create_time;
        }
        if($end_time){
            $query['end_time'] = $end_time;
            $data['end_time'] = $end_time;
        }
        if(isset($status)){
            if($status == ''){
                $data['status'] = -1;
            }else{
                $data['status'] = $status;
            }
            
        }
        $list = array();
        $count = 0;
        if($name || $tel){
            $data['name'] = $name;
            $data['tel'] = $tel;
            $query['name'] = $name;
            $query['tel'] = $tel;
            $dinner_lists = $this->Mdinner->search_dinner_list($name, $tel);
            if($dinner_lists){
                $serch_dinenr_id = array_column($dinner_lists, 'id');
                if($serch_dinenr_id){
                    if(isset($status)){
                        if($status !=""){
                            $status_where = array('in' => array('dinner_id' => $serch_dinenr_id), 'status' => $status, 'is_del' => 0);
                        }else{
                            $status_where = array('in' => array('dinner_id' => $serch_dinenr_id), 'is_del' => 0);
                        }
                        
                    }else{
                        $status_where = array('in' => array('dinner_id' => $serch_dinenr_id), 'is_del' => 0);
                    }
                    
                    if(isset($end_time) && $end_time){
                        $begin_time = date("Y-m-d", strtotime($end_time));
                        $begin_time = $begin_time.' 00:00:00';
                        $check_time = date("Y-m-d", strtotime($end_time));
                        $check_time = $check_time.' 23:59:59';
                        $status_where = array_merge($status_where, array('end_time>=' => $begin_time), array('end_time<=' => $check_time));
                    }
                    
                    if(isset($create_time) && $create_time){
                        $begin_create_time = date("Y-m-d", strtotime($create_time));
                        $begin_create_time = $begin_create_time.' 00:00:00';
                        $check_create_time = date("Y-m-d", strtotime($create_time));
                        $check_create_time = $check_create_time.' 23:59:59';
                        $status_where = array_merge($status_where, array('create_time>=' => $begin_create_time), array('create_time<=' => $check_create_time));
                    }
                    
                    $list = $this->Muser_coupon->get_lists('*', $status_where);
                    $count = count($list);
                }
            }
        }else{
            if(isset($status)){
                if($status !=""){
                    $query['status'] = $status;
                    $status_where = array('status' => $status, 'is_del' => 0);
                }else{
                    $status_where = array('is_del' => 0);
                }
                
            }else{
                $status_where = array('is_del' => 0);
            }
            if(isset($end_time) && $end_time){
                $begin_time = date("Y-m-d", strtotime($end_time));
                $begin_time = $begin_time.' 00:00:00';
                $check_time = date("Y-m-d", strtotime($end_time));
                $check_time = $check_time.' 23:59:59';
                $status_where = array_merge($status_where, array('end_time>=' => $begin_time), array('end_time<=' => $check_time));
            }
            
            if(isset($create_time) && $create_time){
                $begin_create_time = date("Y-m-d", strtotime($create_time));
                $begin_create_time = $begin_create_time.' 00:00:00';
                $check_create_time = date("Y-m-d", strtotime($create_time));
                $check_create_time = $check_create_time.' 23:59:59';
                $status_where = array_merge($status_where, array('create_time>=' => $begin_create_time), array('create_time<=' => $check_create_time));
            }
            
            $list = $this->Muser_coupon->get_lists('*', $status_where, $order_by, $size, ($page-1)*$size);
            $count = $this->Muser_coupon->count($status_where);
            
        }
        $data['list'] = $list;
        
        
        //获取添加人
        $admin_id = array_column($list, 'create_admin');
        
        if($admin_id){
            $where['in'] = array('id' => $admin_id);
            $admin = $this->Madmin->get_lists('id,name', $where);
            $admin = array_column($admin, 'name', 'id');
            $data['admin'] = $admin;
        }
        
        //获取宴会主角
        $dinner_id = array_column($list, 'dinner_id');
        if($dinner_id){
            $roles = $this->Mdinner->get_lists('id, roles_main, roles_main_mobile', array('in' => array('id' => $dinner_id)));
            $roles = array_column($roles, NULL, 'id');
            $data['roles'] = $roles;
        }
        
        $data['page'] = $page;
        $data['count'] = $count;
        if(isset($query)){
            $this->pageconfig['base_url'] = '/coupon/user_coupon?'.http_build_query($query);
        }else{
            $this->pageconfig['base_url'] = '/coupon/user_coupon';
        }
        $this->pageconfig['total_rows'] = $count;
        $this->pagination->initialize($this->pageconfig);
        if(!$name && !$tel){
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        //获取代金券类型
        $coupon_type = C('coupon.type');
        $data['coupon_type'] = array_column($coupon_type, 'name', 'id');
        $this->load->view('coupon/index', $data);
    }
    
    /**
     * 优惠卷的删除
     * @author songchi@gz-zc.cn
     */
    
    public function del($id = 0){
        $id = intval($id);
        !intval($id) && show_404();      
        $update = $this->Muser_coupon->update_info(array('is_del' => 1), array('id' => $id));
        if($update){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
        
    }
    
    
    /**
     * 优惠卷的添加
     * @author yonghua@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        if(IS_POST){
            $add_data['type_id'] = (int) $this->input->post('type_id',TRUE);
            if($add_data['type_id'] == 0){
                $this->error('请选择类型！');
                exit;
            }
            $add_data['favorable'] = (int) $this->input->post('favorable',TRUE);
            if($add_data['favorable'] <= 0){
                $this->error('优惠价格必须大于0！');
                exit;
            }
            $add_data['create_admin'] = $data['userInfo']['id'];
            $add_data['create_time'] = date("Y-m-d H:i:s");
            $add_data['update_time'] = date("Y-m-d H:i:s");
            $res = $this->Mcoupon->create($add_data);
            if(!$res){
                $this->error('操作失败！');
            }
            $this->success('添加成功！', '/coupon');
        }
        $type_field = 'id,name';
        $data['type'] = $this->Mcoupontype->get_lists($type_field, ['is_del'=> 0]);
        $this->load->view('coupon/add', $data);
    }
    
    /**
     * 优惠卷的编辑
     * @author yonghua@gz-zc.cn
     */
    public function edit(){
        $data = $this->data;
        if(IS_POST){
            $add_data['id'] = (int) $this->input->post('id',TRUE);
            $add_data['is_del'] = (int) $this->input->post('is_del',TRUE);
            $add_data['type_id'] = (int) $this->input->post('type_id',TRUE);
            if($add_data['type_id'] == 0){
                $this->error('请选择类型！');
                exit;
            }
            $add_data['favorable'] = (int) $this->input->post('favorable',TRUE);
            if($add_data['favorable'] <= 0){
                $this->error('优惠价格必须大于0！');
                exit;
            }
            $add_data['update_time'] = date("Y-m-d H:i:s");
            $res = $this->Mcoupon->update_info($add_data,['id' => $add_data['id']]);
            if(!$res){
                $this->error('操作失败！');
            }
            $this->success('编辑成功！', '/coupon');
        }
        $id = (int) $this->input->get('id',TRUE);
        $data['info'] = $this->Mcoupon->get_one('id,type_id,favorable,is_del',['id' => $id]);
        $type_field = 'id,name';
        $data['type'] = $this->Mcoupontype->get_lists($type_field, ['is_del'=> 0]);
        $this->load->view('coupon/edit', $data);
    }
    
    /**
     * 优惠卷的删除
     * @author yonghua@gz-zc.cn
     */
    public function change(){
        $id = (INT) $this->input->get('id',TRUE);
        $is_del = (INT) $this->input->get('is_del',TRUE);
        $data = $this->data;
        if($data['userInfo']['id']){
            $res = $this->Mcoupon->update_info(['is_del' => $is_del], ['id' => $id]);
            if(!$res){
                $this->return_json(0);
            }
            $this->return_json(1);
        }
    }
    
    /**
     * 优惠卷的删除
     * @author yonghua@gz-zc.cn
     */
    public function typechange(){
        $id = (INT) $this->input->get('id',TRUE);
        $is_del = (INT) $this->input->get('is_del',TRUE);
        $data = $this->data;
        if($data['userInfo']['id']){
            $res = $this->Mcoupontype->update_info(['is_del' => $is_del], ['id' => $id]);
            if(!$res){
                $this->return_json(0);
            }
            $this->return_json(1);
        }
    }
    
    /**
     * 优惠卷类型列表
     * @author yonghua@gz-zc.cn
     */
    public function type(){
        $data = $this->data;
        $page =  intval(trim($this->input->get("per_page", true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $data['list'] = $this->Mcoupontype->get_lists('*', 0, 0, $size, ($page-1)*$size);
        if($data['list']){
            $data['count'] = $this->Mcoupontype->count();
            $data['page'] = $page;
            $this->pageconfig['base_url'] = "/coupon/type";
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        
        $this->load->view('coupon/type',$data);
    }
    
    public function type_add(){
        $data = $this->data;
        if(IS_POST){
            $name = trim($this->input->post('name', TRUE));
            if(empty($name)){
               $this->error('名称必填');
            }
            $add_data['name'] = $name;
            $res = $this->Mcoupontype->create($add_data);
            if(!$res){
                $this->error('操作失败！');
            }
            $this->success('添加成功！', '/coupon/type');
        }
        $this->load->view('coupon/type_add', $data);
    }
    
    public function type_edit(){
        $data = $this->data;
        if(IS_POST){
            $add_data['id'] = (int) $this->input->post('id',TRUE);
            $add_data['is_del'] = (int) $this->input->post('is_del',TRUE);
            $add_data['name'] = trim($this->input->post('name',TRUE));
            if(empty($add_data['name'])){
                $this->error('名称不能为空');
                exit;
            }
            $res = $this->Mcoupontype->update_info($add_data,['id' => $add_data['id']]);
            if(!$res){
                $this->error('操作失败！');
            }
            $this->success('编辑成功！', '/coupon/type');
        }
        $id = (int) $this->input->get('id',TRUE);
        $data['info'] = $this->Mcoupontype->get_one('id,name,is_del',['id' => $id]);
        $this->load->view('coupon/type_edit', $data);
    }
    
    /**
     * 优惠卷发放 
     * @author louhang@gz-zc.cn
     */
    public function send(){
        $data = $this->data;
        if(IS_POST){
            $phone = (int) $this->input->post('phone',TRUE);
            $add_data['user_id'] = $this->Muser->get_one('id', ['mobile_phone' => $phone]);
            if(!$add_data['user_id']){
                $this->error('该手机号未注册！');
            }
            $add_data['user_id'] = $add_data['user_id']['id'];
            $add_data['coupon_id'] = (int) $this->input->post('coupon_id',TRUE);
            $add_data['create_time'] = date("Y-m-d H:i:s");
            $end_day = (int)$this->input->post('end_time',TRUE);
            $add_data['end_time'] = date("Y-m-d",strtotime("+{$end_day} day"));
            $coupon_name = $this->input->post('coupon_name',TRUE);
            $coupon_money = $this->input->post('coupon_money',TRUE);
            $this->load->library('coupons');
            $add_data['number'] = $this->coupons->generate(8, 'BN', '', true, false);
           /*  if(!send_msg($phone, '您的价值 ￥'. $coupon_money .' 元的'. $coupon_name .'已发放至您的账号，兑换密码为:' . $add_data['number'])){
                $this->error('通知短信发送失败！');
            } */
            
            $res = $this->Muser_coupon->create($add_data);
            
            if(!$res){
                $this->error('操作失败！');
            }
            $this->success('发放成功！', '/coupon');
        }
        $id = (int) $this->input->get('id',TRUE);
        $data['info'] = $this->Mcoupon->get_one('id,type_id,favorable,is_del',['id' => $id]);
        $type_field = 'id,name';
        $data['type'] = $this->Mcoupontype->get_one($type_field, ['id' => $data['info']['type_id']]);
        $this->load->view('coupon/send', $data);
    }
    
    /**
     * 优惠卷核销列表
     * @author louhang@gz-zc.cn
     */
    public function check(){
        $where = array();
        if($number = trim($this->input->get("number", true))){
            $where = array('number' => $number);
        }
        //获取优惠券名称，和价格
        $data = $this->data;
        $coupon_type = $this->Mcoupontype->get_lists('id, name', ['is_del'=> 0]);
        $coupon_type = array_column($coupon_type, 'name', 'id');
        $coupons = $this->Mcoupon->get_lists('id, favorable, type_id', ['is_del'=> 0]);
        foreach ($coupons as $key => $val){
            $type_id = $val['type_id'];
            $coupons[$key]['coupon_name'] = isset($coupon_type[$type_id]) ? $coupon_type[$type_id] : '';
        }
        $coupons = array_column($coupons, null, 'id');

        $page =  intval(trim($this->input->get("per_page", true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('create_time'=>'desc');
        $list = $this->Muser_coupon->get_lists('*',$where,$order_by,$size,($page-1)*$size);
        $count = $this->Muser_coupon->count();
        if(!$list){
            $data['list'] = null;
        }
        
        //获取用户phone
        $user_id_lists = array_column($list, 'user_id') ? array_column($list, 'user_id') : '';
        $users_info = $this->Muser->get_lists('id, mobile_phone', array('in' => array('id' => $user_id_lists)));
        $user_phone_lists = array_column($users_info, 'mobile_phone', 'id');
        $external_coupon = C('coupon.external_coupon');
        foreach ($list as $key => $val){
            $id = $val['coupon_id'];
            if(($coupons[$id])){
                $list[$key]['coupon_name'] = $coupons[$id]['coupon_name'];
                
                if ($val['coupon_id'] == $external_coupon['id']) {
                    //来自外部添加的优惠券
                    $list[$key]['favorable'] = $val['money'];
                } else {
                    $list[$key]['favorable'] = $coupons[$id]['favorable'];
                }
                
                $list[$key]['mobile_phone'] = $user_phone_lists[$val['user_id']];
            }
        }
        
        $data['list'] = $list;
        $data['page'] = $page;
        $data['count'] = $count; 
        $this->pageconfig['base_url'] = "/coupon/check";
        $this->pageconfig['total_rows'] = $count;
        $this->pagination->initialize($this->pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        $this->load->view('coupon/check', $data);
    }
    
    /**
     * 优惠卷核销
     * @author louhang@gz-zc.cn
     */
    public function verification(){
        
        $id = intval(trim($this->input->get("id", true))) ? : 0;
        $res = $this->Muser_coupon->get_one('*', array('id' => $id));
        
        if($res['status'] == C("coupon.status.timeout.id") || strtotime($res['end_time']) < time()){
            $this->error('操作失败！，该优惠券已过期');
        }
        if($res['status'] == C("coupon.status.use.id")){
            $this->error('操作失败！，该优惠券已被使用');
        }
        
        $res = $this->Muser_coupon->update_info(array('status' => C("coupon.status.use.id")), array('id' => $id));
        if(!$res){
            $this->error('操作失败！');
        }
        $this->success('操作成功！', '/coupon/check'); 
       
    }
    
    /**
     * 手动添加优惠券
     * @author fengyi@gz-zc.cn
     */
    public function manually_add() {
        $data = $this->data;
        
        if (IS_POST) {
            $contract_num = trim($this->input->post('contract_num'));
            $dinner_info = $this->Mdinner->get_one('id,user_id,contract_num', ['contract_num' => $contract_num]);
            if (!$dinner_info) {
                $this->return_failed('合同编号不正确！');
            }
            $dinner_id = $dinner_info['id'];
            $user_id = $dinner_info['user_id'];
            $number = trim($this->input->post('number'));
            $end_time = trim($this->input->post('end_time'));
            $end_time = date('Y-m-d H:i:s', strtotime($end_time));
            $money = floatval($this->input->post('money'));
            $data = [
                'number' => $number,
                'end_time' => $end_time,
                'user_id' => $user_id,
                'dinner_id' => $dinner_id,
                'money' => $money,
            ];
            $res = $this->Muser_coupon->create($data);
            if ($res) {
                $this->return_success();
            } else {
                $this->return_failed('添加失败！');
            }
        }
        
        $this->load->view('coupon/add_manually', $data);
    }
}









