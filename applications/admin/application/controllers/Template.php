<?php 
    /**
    * 电子相册控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Template extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_about_us' => 'Maboutus',
               'Model_admins' => 'Madmins',
               'Model_template' => 'Mtemplate',
               'Model_music' => 'Mmusic'
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
        $data['title'] = array('首页', '模板列表');
        
        $music = $this->Mmusic->get_lists('*', array('is_del'=>0));
        $data['music'] = array_column($music, 'music', 'id');
        $data['music_name'] = array_column($music, 'name', 'id');
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        
        $where['is_del'] = 0;
        
        $name = $this->input->post('name');
        if($name){
            $where['like'] = array('name'=>$name);
            $data['name'] = $name;
        }
        $type_id = $this->input->post('type_id');
        if(isset($type_id) && $type_id >= 0){
            $where['type_id'] = $type_id;
            $data['type_id'] = $type_id;
        }
        $order_by = array('create_time' => 'desc');
        $field = 'id, name, music_id, remark, is_del';
        $list = $this->Mtemplate->get_lists($field, $where, $order_by, $this->pageconfig['per_page'], $offset);
        $data['list'] = $list;

        $data['count'] = count($this->Mtemplate->get_lists($field, $where));
        //分页
        if($data['list']){
            $this->pageconfig['base_url'] = '/template/index?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        $this->load->view("template/index", $data);
    }
    
    public function add(){
        $data = $this->data;
        $music = $this->Mmusic->get_lists('id, name', array('is_del'=>0));
        $data['music'] = $music;
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules('name', '模板名称', 'trim|required', array('required' => '%s不能为空'));
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
            
            $post_data = $this->input->post();
            if(!$post_data){
                $this->return_failed('操作失败');
            }
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s', time());
            $post_data['create_admin'] = $post_data['update_admin'] = $data['userInfo']['id'];
            
            $insert_id = $this->Mtemplate->create($post_data);
            
            if($insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
        
        $this->load->view('template/add', $data);
    }
   
    
    public function modify($id = 0){
        $data = $this->data;
        if(!$id){
            show_404();
        }
        $music = $this->Mmusic->get_lists('id, name', array('is_del'=>0));
        $data['music'] = array_column($music, 'name', 'id');
        
        $field = 'id, name, music_id, remark, is_del, logo, cover_img, type_id';
        $where['is_del'] = 0;
        $where['id'] = $id;
        $info = $this->Mtemplate->get_one($field, $where);
        $data['info'] = $info;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                $post_data['update_time'] = date('Y-m-d H:i:s', time());
                $post_data['update_admin'] = $data['userInfo']['id'];
                $insert_id = $this->Mtemplate->update_info($post_data, ['id'=>$id]);
            }
            
            if(isset($insert_id) && $insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('修改失败');
            }
            
        }
        
        $this->load->view('template/modify', $data);
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
    
        if($this->Mtemplate->update_info($post_data, $where)){
            $this->return_success();
        }else{
            $this->return_failed('操作失败');
        }
    }
    
    public function get_music(){
        $data = $this->data;
        $music = $this->Mmusic->get_lists('*', array('is_del'=>0));
        
        if($music){
            foreach ($music as $k=>$v){
                $music[$k]['music'] = get_img_url($v['music']);
                $music[$k]['sort_music'] = $v['music'];
            }
        }
        $this->return_json(array('list'=>$music));
    }
    
}
