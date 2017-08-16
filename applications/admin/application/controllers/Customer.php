<?php

/**
 * 客户管理
 * @author chaokai@gz-zc.cn
 */
class Customer extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model(array(
                        'Model_customer' => 'Mcustomer',
                        'Model_customer_review' => 'Mcustomer_review',
                        'Model_venue' => 'Mvenue'
        ));
        
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    
    /**
     * 列表页
     * @author chaokai@gz-zc.cn
     */
    public function index(){

        $data = $this->data;
        $data['title'] = array('首页', '客户列表');
        
        $where = array();
        if($this->input->post('name')){
            $where['like'] = array('name' => $this->input->post('name'));
        }
        $data['name'] = $this->input->post('name');
        if($this->input->post('mobile_phone')){
            $where['like'] = array('mobile_phone' => $this->input->post('mobile_phone'));
        }
        $data['mobile_phone'] = $this->input->post('mobile_phone');
        
        $order_by = array('create_time' => 'desc');
        
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        $where['is_order_customer'] = 0;
        
        $data['list'] = $this->Mcustomer->lists($where, $order_by, $this->pageconfig['per_page'], $offset);
        
        foreach ($data['list'] as $k=>$v){
            if($v['venue_id']){
                $data['list'][$k]['venue_id'] = explode(',', $v['venue_id']);
            }
        }
        
        //获取所有场馆
        $venue_name = $this->Mvenue->get_lists('id, name');
        $data['venue_name'] = array_column($venue_name, 'name', 'id');
        
        $data['count'] = $this->Mcustomer->count(array('is_del' => 0, 'is_order_customer' => 0));
        //分页
        if($data['list']){
            $this->pageconfig['base_url'] = '/customer/index?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        $this->load->view('customer/index', $data);
    }
    
    /**
     * 添加
     * @author chaokai@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        $data['title'] = array('首页', '客户列表', '添加客户');
        
        if(IS_POST){
            $tmp = $this->input->post('venue_id');
            if(isset($tmp)){
                $_POST['venue_id'] = implode(',', $tmp);
            }
            $this->form_validation->set_rules('name', '姓名', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('mobile_phone', '手机号码', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('dinner_type', '宴会类型', 'numeric', array('numeric' => '%s数据类型不正确'));
            $this->form_validation->set_rules('menus_count', '桌数', 'numeric', array('numeric' => '%s数据类型不正确'));
            $this->form_validation->set_rules('order_time', '预留时间', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('dinner_time', '宴会时间', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_id', '场馆', 'required', array('required' => '%s不能为空'));
            
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
            
            $post_data = $this->input->post();
            //验证手机号
            if(!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone'])){
                $this->return_failed('手机号码格式不正确');
            }
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['create_admin'] = $post_data['update_admin'] = $data['userInfo']['id'];
            //来源
            $post_data['source'] = 1;
            //接收场馆id
            if($this->Mcustomer->create($post_data)){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('保存失败');
            }
        }
        
        //宴会类型
        $data['dinner_type'] = C('party');
        //宴会场馆
        $data['venue_list'] = $this->Mvenue->lists();
        
        $this->load->view('customer/add', $data);
    }
    
    /**
     * 修改
     * @author chaokai@gz-zc.cn
     */
    public function modify($id = 0){
        
        $data = $this->data;
        $data['title'] = array('首页', '客户列表', '修改客户信息');
        
        if(IS_POST){
            $tmp = $this->input->post('venue_id');
            if(isset($tmp)){
                $_POST['venue_id'] = implode(',', $tmp);
            }
            $this->form_validation->set_rules('name', '姓名', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('mobile_phone', '手机号码', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('dinner_type', '宴会类型', 'numeric', array('numeric' => '%s数据类型不正确'));
            $this->form_validation->set_rules('menus_count', '桌数', 'numeric', array('numeric' => '%s数据类型不正确'));
            $this->form_validation->set_rules('order_time', '预留时间', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('dinner_time', '宴会时间', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('venue_id', '场馆', 'required', array('required' => '%s不能为空'));
        
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
        
            $post_data = $this->input->post();
            //验证手机号
            if(!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone'])){
                $this->return_failed('手机号码格式不正确');
            }
        
            $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['update_admin'] = $data['userInfo']['id'];
            
            $where = array('id' => $post_data['id']);
        
            if($this->Mcustomer->update_info($post_data, $where)){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('保存失败');
            }
        }
        
        $id = intval($id);
        !$id && show_404();
        
        $data['info'] = $this->Mcustomer->info($id);
        if($data['info']['venue_id']){
            $data['info']['venue_id'] = explode(',', $data['info']['venue_id']);
        }
        $data['dinner_type'] = C('party');
        //宴会场馆
        $data['venue_list'] = $this->Mvenue->lists();
        $this->load->view('customer/modify', $data);
    }
    
    /**
     * 删除
     * @author chaokai@gz-zc.cn
     */
    public function del(){
        $id = intval($this->input->post('id'));
        !$id && show_404();
        
        $where = array('id' => $id);
        $post_data = array('is_del' => 1);
        
        if($this->Mcustomer->update_info($post_data, $where)){
            $this->return_success();
        }else{
            $this->return_failed('操作失败');
        }
    }
    
    /**
     * 跟踪记录列表
     * @author chaokai@gz-zc.cn
     */
    public function review($user_id = 0){
        
        $user_id = intval($user_id);
        !$user_id && show_404();
        
        $data = $this->data;
        $data['customer_id'] = $user_id;
        $data['title'] = array('首页', '客户列表', '客户回访记录');
        
        $data['list'] = $this->Mcustomer_review->lists($user_id);
        
        //客户信息及意向宴会详情
        $data['info'] = $this->Mcustomer->detail_info($user_id);
        
        $this->load->view('customer/review', $data);
    }
    
    /**
     * 添加回访记录
     * @author chaokai@gz-zc.cn
     */
    public function add_review(){
        if(IS_POST){
            $this->form_validation->set_rules('customer_id', '客户编号', 'numeric', array('numeric' => '%s数据类型不正确'));
            $this->form_validation->set_rules('remark', '备注', 'trim|required', array('required' => '%s不能为空'));
            
            if($this->form_validation->run() == false){
                $this->return_json(['msg' => strip_tags(validation_errors())]);
            }
            
            $post_data = $this->input->post();
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['create_admin'] = $post_data['update_admin'] = $this->data['userInfo']['id'];
            
            if($this->Mcustomer_review->create($post_data)){
                $this->return_json(['code' => 1]);
            }else{
                $this->return_json(['msg' => '保存失败']);
            }
        }else{
            show_404();
        }
    }
    
    /**
     * 修改回访记录
     * @author chaokai@gz-zc.cn
     */
    public function modify_review(){
        
        if(IS_POST){
            $this->form_validation->set_rules('id', '编号', 'numeric', array('numeric' => '%s数据类型不正确'));
            $this->form_validation->set_rules('remark', '备注', 'trim|required', array('required' => '%s不能为空'));
            
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
            
            $post_data = $this->input->post();
            $where = array('id' => $post_data['id']);
            unset($post_data['id']);
            
            if($this->Mcustomer_review->update_info($post_data, $where)){
                $this->return_success([], '修改成功');
            }else{
                $this->return_failed('修改失败');
            }
        }
        
        $id = intval($this->input->get('id'));
        !$id && show_404();
        
        $field = 'id,question,answer,remark';
        $where = array('id' => $id);
        $info = $this->Mcustomer_review->get_one($field, $where);
        
        if($info){
            $this->return_success($info);
        }else{
            $this->return_failed('记录不存在');
        }
    }
    
    /**
     * 删除
     * @author chaokai@gz-zc.cn
     *  
     */
    public function del_review(){
        $id = $this->input->get('id');
        !$id && show_404();
        
        $data = array('is_del' => 1);
        $where = array('id' => $id);
        if($this->Mcustomer_review->update_info($data, $where)){
            $this->return_success();
        }else{
            $this->return_failed('删除失败');
        }
    }
}