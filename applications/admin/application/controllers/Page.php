<?php 
    /**
    * 电子相册控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Page extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_admins' => 'Madmins',
               'Model_template' => 'Mtemplate',
               'Model_page' => 'Mpage',
               'Model_elements' => 'Melements'
        ]);
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index($template_id){
        $data = $this->data;
        $data['title'] = array('首页', '模板列表');
        
        if(!$template_id){
            show_404();
        }
        $data['template_id'] = $template_id;
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        
        $where['is_del'] = 0;
        $where['template_id'] = $template_id;
        $order_by = array('sort' => 'asc');
        $lists = $this->Mpage->get_lists('*', $where, $order_by, $this->pageconfig['per_page'], $offset);
        $data['list'] = $lists;
        $data['name'] = $this->Mtemplate->get_one('name, id', array('id'=>$template_id));
        $data['count'] = count($this->Mpage->get_lists('*', $where));
        //分页
        if($data['list']){
            $this->pageconfig['base_url'] = '/page/index/'.$template_id.'?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                if($post_data['element_type'] == 0 && isset($post_data['image'])){
                    $post_data['default'] = $post_data['image'];
                    unset($post_data['image']);
                }
                $insert_id = $this->Melements->create($post_data);
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
            
        }
        
        $this->load->view("page/index", $data);
    }
    
    public function add($template_id){
        $data = $this->data;
        if(!$template_id){
            show_404();
        }
        $data['template_id'] = $template_id;
        
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules('sort', '序号', 'trim|required', array('required' => '%s不能为空'));
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
            
            $post_data = $this->input->post();
            if(!$post_data){
                $this->return_failed('操作失败');
            }
            
            $post_data['template_id'] = $template_id;
            
            $insert_id = $this->Mpage->create($post_data);
            
            if($insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
        
        $this->load->view('page/add', $data);
    }
   
    
    public function modify($id = 0){
        $data = $this->data;
        if(!$id){
            show_404();
        }
        $where['is_del'] = 0;
        $where['id'] = $id;
        $info = $this->Mpage->get_one('*', $where);
        $data['info'] = $info;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                $insert_id = $this->Mpage->update_info($post_data, ['id'=>$id]);
            }
            
            if(isset($insert_id) && $insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('修改失败');
            }
            
        }
        
        $this->load->view('page/modify', $data);
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
    
        if($this->Mpage->update_info($post_data, $where)){
            $this->return_success();
        }else{
            $this->return_failed('操作失败');
        }
    }
    
    
    public function element($page_id){
        $data = $this->data;
        $data['title'] = array('首页', '元素列表');
        if($page_id){
            $page_where['is_del'] = 0;
            $page_where['page_id'] = $page_id;
            
            $this->pageconfig = C('page.config_bootstrap');
            $page = $this->input->get('per_page') ? : 1;
            $offset = ($page-1)*$this->pageconfig['per_page'];
            
            $order_by = array('sort' => 'asc');
            $ele_lists = $this->Melements->get_lists('*', $page_where, $order_by, $this->pageconfig['per_page'], $offset);
            $data['count'] = count($this->Melements->get_lists('*', $page_where));
            //分页
            if($ele_lists){
                $this->pageconfig['base_url'] = '/page/element/'.$page_id.'?'.http_build_query($page_where);
                $this->pageconfig['total_rows'] = $data['count'];
                $this->pagination->initialize($this->pageconfig);
                $data['pagestr'] = $this->pagination->create_links();
            }
            
            $data['element'] = $ele_lists;
        }else{
            show_404();
        }
        
        $data['page_id'] = $page_id;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                if($post_data['element_type'] == 0 && isset($post_data['image'])){
                    $post_data['default'] = $post_data['image'];
                    unset($post_data['image']);
                }
                if($post_data['element_type'] == 1 && isset($post_data['image'])){
                    unset($post_data['image']);
                }
            
                
                $where['id'] = $post_data['element_id'];
                unset($post_data['element_id']);
                $insert_id = $this->Melements->update_info($post_data, $where);
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
        
        $this->load->view('page/element', $data);
        
    }
    
    public function element_del(){
        $data = $this->data;
        $id = $this->input->post('id');
        if(!$id){
            $this->return_failed("操作失败");
        }
        
        $where['id'] = $id;
        $post['is_del'] = 1;
        $update_id = $this->Melements->update_info($post, $where);
        if($update_id){
            $this->return_success([], '操作成功');
        }else{
            $this->return_failed("操作失败");
        }
    }
    
}
