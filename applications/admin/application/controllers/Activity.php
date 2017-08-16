<?php 
    /**
    * 活动类控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Activity extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_admins' => 'Madmins',
               'Model_activity' => 'Mactivity'
        ]);
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $data['title'] = array('首页', '活动列表');
        
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        
        $where['is_del'] = 0;
        $order_by = array('create_time' => 'desc');
        $field = '*';
        $list = $this->Mactivity->get_lists($field, $where, $order_by, $this->pageconfig['per_page'], $offset);
        
        $data['list'] = $list;

        $data['count'] = count($this->Mactivity->get_lists($field, $where));
        //分页
        if($data['list']){
            $this->pageconfig['base_url'] = '/activity/index?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        $this->load->view("activity/index", $data);
    }
    
    
    public function add(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules('name', '活动名称', 'trim|required', array('required' => '%s不能为空'));
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
    
            $post_data = $this->input->post();
            if(!$post_data){
                $this->return_failed('操作失败');
            }
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s', time());
            $post_data['create_admin'] = $post_data['update_admin'] = $data['userInfo']['id'];
    
            $insert_id = $this->Mactivity->create($post_data);
    
            if($insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
    
        $this->load->view('activity/add', $data);
    }
    
    public function modify($id = 0){
        $data = $this->data;
        if(!$id){
            show_404();
        }
        $field = '*';
        $where['is_del'] = 0;
        $where['id'] = $id;
        $info = $this->Mactivity->get_one($field, $where);
        $data['info'] = $info;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                $post_data['update_time'] = date('Y-m-d H:i:s', time());
                $post_data['update_admin'] = $data['userInfo']['id'];
                $insert_id = $this->Mactivity->update_info($post_data, ['id'=>$id]);
            }
    
            if(isset($insert_id) && $insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('修改失败');
            }
    
        }
    
        $this->load->view('activity/modify', $data);
    }
    
    /**
     * 删除
     * @author songchi@gz-zc.cn
     */
    public function del(){
        $id = intval($this->input->post('id'));
        !$id && show_404();
    
        $where = array('id' => $id);
        $post_data = array('is_del' => 1);
        $update = $this->Mactivity->update_info($post_data, $where);
        if($update){
            $this->return_success([], '删除成功');
        }else{
            $this->return_failed('操作失败');
        }
    }
}
