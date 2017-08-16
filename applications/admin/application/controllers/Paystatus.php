<?php 
    /**
    * 支付订单控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Paystatus extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_pay_status' => 'Mpay_status',
               'Model_admins' => 'Madmins',
               'Model_dinner' => 'Mdinner',
               'Model_dinner_venue' => 'Mdinner_venue',
               'Model_venue' => 'Mvenue',
               'Model_customer' => 'Mcustomer',
        ]);
        $this->load->library('form_validation');
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $data['title'] = ['订单管理','支付订单'];
        $data['payment'] = C('order.payment');
        //获取分页页码
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $offset = ($page-1)*$size;
        
        //条件查询
        $pay_time = $this->input->post_get('pay_time');
        $payment = $this->input->post_get('payment');
        $pay_type = $this->input->post_get('pay_type');
        
        //默认显示当日流水，一旦有搜索条件，取消默认日期限制
        if (! $pay_time && ! $payment && ! $pay_type) {
            $pay_time = date('Y-m-d');
        }

        if($pay_time){
            $where['pay_time'] = $pay_time;
            $data['pay_time'] = $pay_time;
        }
        
        if($payment){
            $where['payment'] = $payment;
            $data['payment_id'] = $payment;
        }
        
        if($pay_type){
            $where['pay_type'] = $pay_type;
            $data['pay_type_id'] = $pay_type;
        }
        
        $where['is_del'] = 0;
        $where['money >'] = 0;
        
        $order_by['create_time'] = 'desc';
        $lists = $this->Mpay_status->get_lists('*', $where, $order_by, $size, $offset);
        //过滤未审核和审核失败的订单
        if ($lists) {
            $dinner_ids = array_column($lists, 'dinner_id');
            $in = array(
                'id' => $dinner_ids,
                'is_examined' => array( C('dinner.examine.not.id'), C('dinner.examine.failure.id') ),
            );
            $dinner_lists = $this->Mdinner->get_lists('id',  array('in' => $in, 'is_del' => 0) );
            $dinner_lists_ids = $dinner_lists ? array_column($dinner_lists, 'id') : array();
            foreach ($lists as $k => $v) {
                if ( in_array($v['dinner_id'], $dinner_lists_ids) ) {
                    unset($lists[$k]);
                }
            }
        }

        if($lists){ 
            //获取用户名
            $user_id = array_column($lists, 'customer_id');
            $user_field = 'id, name';
            $user_where['in'] = array('id'=>$user_id);
            $user_lists = $this->Mcustomer->get_lists($user_field, $user_where);
            $data['user'] = array_column($user_lists, 'name', 'id');
            //获取添加人
            $admins = array_column($lists, 'create_admin');
            if($admins){
                $admins = array_unique($admins);
                $admin_name = $this->Madmins->get_lists('id, fullname', array('in'=>array('id'=>$admins)));
                $admin_name = array_column($admin_name, 'fullname', 'id');
                $data['admin'] = $admin_name;
            }
            //获取所有场馆
            $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
            $data['venue_name'] = array_column($venue_name, 'name', 'id');
            
            $dinner_id = array_column($lists, 'dinner_id');
            
            //获取就餐时间
            $data['dinner_time'] = C('dinner.time');
            $data['dinner_time'] = array_column($data['dinner_time'], 'name', 'id');
            
            $dinner_all = $this->Mdinner->get_dinner_by_ids($dinner_id);
           
            $dinner_time = array_column($dinner_all, 'dinner_time', 'id');
            
            foreach ($dinner_time as $k=>$v){
                $dinner_time[$k] = $data['dinner_time'][$v];
            }
            $data['dinner_time'] = $dinner_time;
            
            //获取合同编号
            $contract_num = array_column($dinner_all, 'contract_num', 'id');
            //获取宴会日期
            $solar_time = array_column($dinner_all, 'solar_time', 'id');
            //获取餐标
            $menus_name = array_column($dinner_all, 'menus_name', 'id');
            //获取宴会类型
            $venue_type = array_column(C('party'), 'name', 'id');
            $dinner_to_venue_type = array_column($dinner_all, 'venue_type', 'id');
            foreach ($dinner_to_venue_type as $k => $v) {
                $dinner_to_venue_type[$k] = $venue_type[$v];
            }
            foreach ($lists as $k=>$v){
                $lists[$k]['contract_num'] = isset($contract_num[$v['dinner_id']]) ? $contract_num[$v['dinner_id']] : '';
                $lists[$k]['solar_time'] = isset($solar_time[$v['dinner_id']]) ? $solar_time[$v['dinner_id']] : '';
                $lists[$k]['menus_name'] = isset($menus_name[$v['dinner_id']]) ? $menus_name[$v['dinner_id']] : '';
                $lists[$k]['venue_type'] = isset($dinner_to_venue_type[$v['dinner_id']]) ? $dinner_to_venue_type[$v['dinner_id']] : '';
                
            }
            
            $roles = array();
            foreach ($dinner_all as $k=>$v){
                if(isset($v['roles_wife']) && $v['roles_wife']){
                    $roles[$v['id']]['roles'] = $v['roles_main'].','.$v['roles_wife'];
                }else{
                    $roles[$v['id']]['roles'] = isset($v['rolse_main']) && $v['rolse_main']? $v['rolse_main']:'';
                }
                
                $data['roles'] = $roles;
            }
            //获取场馆名称
            $venue_id = $this->Mdinner_venue->get_lists('dinner_id, venue_id', array('in'=>array('dinner_id' => $dinner_id)));
            $tmp_venue_id = array();
            foreach ($venue_id as $k=>$v){
                $tmp_venue_id[$v['dinner_id']][] = $v['venue_id'];
            }
            
            foreach ($tmp_venue_id as $k=>$v){
                foreach ($v as $key=>$val){
                    $tmp_venue_id[$k][$key] = $data['venue_name'][$val];
                }
            }
            
            $dinner_venue = array();
            foreach ($tmp_venue_id as $k=>$v){
                $dinner_venue[$k] = implode(',', $v);
            }
            
            $data['dinner_venue'] = $dinner_venue;

            $data['count'] = $this->Mpay_status->count($where);
            //分页信息
            $this->pageconfig['base_url'] = "/paystatus/index?".http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); 
        }
        
        //合并收银流水（同一家人合并在一起）
        $new_list = array();
        foreach ($lists as $k => $v) {
            if(isset($new_list[$v['dinner_id']])){
                $new_list[$v['dinner_id']][] = $v;
            }else{
                $new_list[$v['dinner_id']] = [$v];
            }
        }

        $data['lists'] = $new_list;

        $data['payment'] = array_column(C('order.payment'), 'name', 'id');
        $data['pay_type_archive'] = array_column(C('order.pay_type_archive'), 'name', 'id');
        $data['pay_type'] = array_column(C('order.pay_type'), 'name', 'id');
        
        $this->load->view("paystatus/index", $data);
    }
    
    
    /**
     * 增加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $dinner_id = $this->input->post_get('dinner_id');
        !intval($dinner_id) && show_404();
        
        $data = $this->data;
        $data['payment'] = array_column(C('order.payment'), 'name', 'id');
        $data['pay_type'] = array_column(C('order.pay_type'), 'name', 'id');
        $data['dinner_id'] = $dinner_id;
        
        $where = array(
            'id' => $dinner_id,
            'is_del' => 0
        );
        $info = $this->Mdinner->get_one('id, user_id', $where);
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $this->form_validation->set_rules('payment', '支付款项', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('pay_type', '支付方式', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('money', '支付金额', 'trim|required|numeric', array('required' => '%s不能为空', 'numeric' => '%s必须是数字'));
            $this->form_validation->set_rules('pay_time', '支付日期', 'trim|required', array('required' => '%s不能为空'));
            
            if(isset($post_data['coupon']) && $post_data['coupon']){
                $this->form_validation->set_rules('coupon', '支付金额', 'trim|required|numeric', array('required' => '%s不能为空', 'numeric' => '%s必须是数字'));
            }
            
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            
            $post_data['dinner_id'] = $dinner_id;
            $post_data['user_id'] = $info['user_id'];
            $post_data['create_time'] = date("Y-m-d H:i:s", time());
            $post_data['update_time'] = date("Y-m-d H:i:s", time());
            $post_data['create_admin'] = $data['userInfo']['id'];
            $insert_id = $this->Mpay_status->create($post_data);
            if($insert_id){
                $this->return_success([], '保存成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
        
        $this->load->view("paystatus/add", $data);
    }
    
    
    public function edit($id){
        $id = intval($id);
        !$id && show_404();
        
        $data = $this->data;
        $data['id'] = $id;
        $where['id'] = $id;
        $data['info'] = $this->Mpay_status->get_one('*', $where);    
        $data['payment'] = array_column(C('order.payment'), 'name', 'id');
        $data['pay_type'] = array_column(C('order.pay_type'), 'name', 'id');
        
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('payment', '支付款项', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('pay_type', '支付方式', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('money', '支付金额', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('pay_time', '支付日期', 'trim|required', array('required' => '%s不能为空'));
            
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            $post_data = $this->input->post();
            $post_data['update_time'] = date("Y-m-d H:i:s", time());
            
            $insert_id = $this->Mpay_status->update_info($post_data, $where);
            if($insert_id){
                $this->return_success([], '修改成功');
            }else{
                $this->return_failed('修改失败');
            }
        }
        
        $this->load->view('paystatus/edit', $data);
    }
    
    /**
     * 删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $info['is_del'] = 1;
        $where['id'] = $id;
        $del = $this->Mpay_status->update_info($info, $where);
        if($del){
           $this->return_success([], '删除成功');
        }else{
            $this->return_failed('删除失败');
        }
    }
    
    
}
