<?php 
/**
* 首页控制器
* @author jianming@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Milan extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->Model([
            'Model_callback' => 'Mcallback',
            'Model_venue' => 'Mvenue',
            'Model_callback_detail' => 'Mcallbackdetail',
            'Model_menu' => 'Mmenu'
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }

    #主页面
    public function customer(){
        $data = $this->data;
        $data['title'] = ['米兰管理','客户列表'];
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('create_time' => 'desc');
        $where = [];
        $where['is_del'] = 0;
        $mobile = trim($this->input->get('mobile'));
        if(preg_match(C('regular_expression.mobile'), $mobile)){
            $where['mobile'] = $mobile;
            $data['mobile'] = $mobile;
        }
        $name = trim($this->input->get('name'));
        if(!empty($name)){
            $data['name'] = $name;
            $where['like'] = array('name'=>$name);
        }
        
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $data['create_time'] = $create_time;
            $where['create_time'] = $create_time;
        }
        $list = $this->Mcallback->get_lists('*', $where, $order_by, $size, ($page-1)*$size);
        if($list){
            $data['list'] = $list;
            $data_count = $this->Mcallback->count($where);
            $data['count'] = $data_count;
            unset($where['like']);
            if($name){
                $where['name'] = $name;
            }
            $where['name'] = $name;
            $this->pageconfig['base_url'] = "/milan/customer?".http_build_query($where);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $this->load->view("milan/list", $data);
    }

    
    public function send_message(){
        $data = $this->data;
        $post_data = $this->input->post("arr");
        if($post_data){
            $where['in'] = array('id'=>$post_data);
            $list = $this->Mcallback->get_lists('mobile', $where);
            $mobile = array_column($list, 'mobile');
            $is_exsit_mobile = $this->Mmenu->search_menu($mobile);
            if($is_exsit_mobile){
                foreach ($mobile as $k=>$v){
                    foreach ($is_exsit_mobile as $key=>$val){
                        if(in_array($v, $val)){
                            unset($mobile[$k]);
                        }
                    }
                }
            }
            if($mobile){
                $this->return_success();
                $msg = "爱是一种相守，亦是一种承诺！把您的婚礼交给米兰，米兰会让您的婚礼成为众人所羡慕的场景！小预算，大浪漫米兰婚礼电话：18085367773";
                send_msg_huaxing($mobile, $msg);
            }else{
                $this->return_failed();
            }
                
        }
    }
    
    //
    public function add_customer(){
        $data = $this->data;
        if(IS_POST){
            $add = $this->input->post();
            $content = $add['content'];
            if(empty($content)){
                $content = '';
            }
            unset($add['content']);
            if(empty(trim($add['name']))){
                $this->error('客户姓名不能为空');
            }
            if(!preg_match(C('regular_expression.mobile'), $add['mobile'])){
                $this->error('手机号格式不正确');
            }
            if(!isset($add['type'])){
                $this->error('宴会类型不能为空');
            }
            if(!isset($add['create_time'])){
                $add['create_time'] = date('Y-m-d H:i:s');
            }
            if(!isset($add['dinner_time'])){
                $this->error('宴会时间不能为空');
            }
            if(!isset($add['reception'])){
                $this->error('接单员必填');
            }
            $add['create_admin'] = $data['userInfo']['id'];
            $add['update_time'] = $add['create_time'];
            $add['remark'] = $add['remark'];
            $res = $this->Mcallback->create($add);
            if(!$res){
                $this->error('添加失败');
            }
            //创建一条详情记录
            $this->Mcallbackdetail->create(['customer_id' => $res, 'content' => $content, 'create_time' => $add['create_time']]);
            $this->success('操作成功', '/milan/customer');
            
        }
        //宴会场馆
        $data['venue_list'] = $this->Mvenue->lists();
        $this->load->view('milan/add_customer', $data);
    }
    
    public function customer_modify(){
        $data = $this->data;
        if(IS_POST){
            $id = (int) $this->input->get('id');
            if($id === 0){
                $this->error('系统拒绝');
            }
            $add = $this->input->post();
            if(empty(trim($add['name']))){
                $this->error('客户姓名不能为空');
            }
            if(!preg_match(C('regular_expression.mobile'), $add['mobile'])){
                $this->error('手机号格式不正确');
            }
            if(!isset($add['type'])){
                $this->error('宴会类型不能为空');
            }
            if(!isset($add['create_time'])){
                $add['create_time'] = date('Y-m-d H:i:s');
            }
            if(!isset($add['dinner_time'])){
                $this->error('宴会时间不能为空');
            }
            if(!isset($add['reception'])){
                $this->error('接单员必填');
            }
            $add['update_time'] = date('Y-m-d H:i:s');
            $add['create_admin'] = $data['userInfo']['id'];
            unset($add['id']);
            $res = $this->Mcallback->update_info($add, ['id' =>$id]);
            if(!$res){
                $this->error('添加失败');
            }
            $this->success('操作成功', '/milan/customer');
        }
        $id = (int) $this->input->get('id');
        $info = $this->Mcallback->get_one('*', ['id' => $id, 'is_del' => 0]);
        if(!$info){
            $this->error('系统拒绝操作');
        }
        $data['info'] = $info;
        $this->load->view('milan/customer_modify', $data);
    }
    
    public function log(){
        $data = $this->data;
        $data['title'] = ['米兰管理', '客户列表', '回访记录'];
        $id = (int) $this->input->get('id');
        if($id === 0){
            $this->error('系统拒绝');
        }
        $data['id'] = $id;
        $list = $this->Mcallbackdetail->get_lists('*', ['customer_id' => $id]);
        if($list){
            $data['list'] = $list;
        }
        //查询客户信息
        $data['customer'] = $this->Mcallback->get_one('*', ['id' => $id]);
        $this->load->view('milan/log', $data);
    }
    
    public function add_log(){
        $data = $this->data;
        if(IS_POST){
            $customer_id = (int) $this->input->post('customer_id');
            if($customer_id === 0){
                $this->return_json(['msg' => '系统拒绝']);
            }
            $content = trim($this->input->post('content'));
            if(empty($content)){
                $this->return_json(['msg' => '回访内容不能为空']);
            }
            $res = $this->Mcallbackdetail->create(['customer_id' => $customer_id, 'content' => $content, 'create_time' => date('Y-m-d H:i:s') ]);
            if(!$res){
                $this->return_json(['msg' => '添加失败']);
            }
            $this->return_json(['time'=> date('Y-m-d H:i:s'), 'code' => 1]);
        }
    }
    
    public function customer_del(){
        $data = $this->data;
        $id = (int) $this->input->get('id');
        if($id === 0){
            $this->error('系统拒绝');
        }
        $res = $this->Mcallback->update_info(['is_del' => 1], ['id' => $id]);
        if(!$res){
            $this->error('删除失败');
        }
        $this->success('操作成功', '/milan/customer');
    }

}