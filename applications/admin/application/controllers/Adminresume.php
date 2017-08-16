<?php
/**
 * 员工履历管理
 * @author chaokai@gz-zc.cn
 */
class Adminresume extends MY_Controller{
    
    //履历类型
    private $resume_type;
    public function __construct(){
        parent::__construct();
        
        $this->load->model(array(
                        'Model_admin_resume' => 'Madmin_resume',
                        'Model_admins' => 'Madmins'
        ));
        $this->load->library('form_validation');
        $this->resume_type = array_column(C('resume.type'), 'name', 'id');
    }
    
    /**
     * 添加员工履历
     * @author chaokai@gz-zc.cn
     */
    public function add($id){
        $data = $this->data;
        $data['resume_type'] = $this->resume_type;
        
        if(IS_POST){
            $resume_str = implode(',', array_keys($this->resume_type));
            $this->form_validation->set_rules('resume_type', '履历类型', 'required|in_list['.$resume_str.']', array(
                            'required' => '%s不能为空',
                            'in_list' => '不允许的%s'
            ));
            $this->form_validation->set_rules('title', '标题', 'trim|required', array(
                            'required' => '%s不能为空'
            ));
            if($this->form_validation->run() === FALSE){
                $this->error(validation_errors());
            }
            
            $post_data = $this->input->post();
            $post_data['images'] = implode(';', $post_data['images']);
            $post_data['create_admin'] = $data['userInfo']['id'];
            $post_data['create_time'] = date('Y-m-d H:i:s');
            $post_data['admin_id'] = $id;
            
            if($this->Madmin_resume->create($post_data)){
                $this->success('', '/admin/read/'.$id);
            }else{
                $this->error('保存失败');
            }
        }
        
        
        $this->load->view('adminresume/add', $data);
    }
    
    /**
     * 删除
     * @author cahokai@gz-zc.cn
     */
    public function del(){
        $id = intval($this->input->get('id'));
        
        if(!$id){
            $this->return_failed('参数错误');
        }
        
        if($this->Madmin_resume->update_info(array('is_del' => 1), array('id' => $id))){
            $this->return_success();
        }else{
            $this->return_failed('删除失败');
        }
        
    }
    
    /**
     * 查看照片
     * @author cahokai@gz-zc.cn
     */
    public function show_images($id){
        $data = $this->data;
        $id = intval($id);
        !$id && $this->error('错误', $_SERVER['HTTP_REFERER']);
        
        //履历信息
        $resume_field = 'id,admin_id,title,images,occur_time';
        $resume_where = array('is_del' => 0, 'id' => $id);
        $resume_info = $this->Madmin_resume->get_one($resume_field, $resume_where);
        
        !$resume_info && $this->error('履历不存在', $_SERVER['HTTP_REFERER']);
        if(!empty($resume_info['images'])){
            $resume_info['images'] = explode(';', $resume_info['images']);
        }
        //员工信息
        $admin_info = $this->Madmins->get_one('fullname', array('id' => $resume_info['admin_id']));
        
        $resume_info['admin_name'] = $admin_info['fullname'];
        
        $data['info'] = $resume_info;
        
        $this->load->view('adminresume/show_images', $data);
    }
    
    /**
     * 修改履历信息
     * @author cahokai@gz-zc.cn
     */
    public function edit($id){
        $data = $this->data;
        $id = intval($id);
        !$id && $this->error('参数错误', $_SERVER['HTTP_REFERER']);
        $data['resume_type'] = $this->resume_type;
        
        //查询履历信息
        $field = 'id,resume_type,title,content,images,remark,occur_time,admin_id';
        $where = array('is_del' => 0, 'id' => $id);
        $info = $this->Madmin_resume->get_one($field, $where);
        !$info && $this->error('信息不存在', $_SERVER['HTTP_REFERER']);
        
        if(IS_POST){
            $resume_str = implode(',', array_keys($this->resume_type));
            $this->form_validation->set_rules('resume_type', '履历类型', 'required|in_list['.$resume_str.']', array(
                            'required' => '%s不能为空',
                            'in_list' => '不允许的%s'
            ));
            $this->form_validation->set_rules('title', '标题', 'trim|required', array(
                            'required' => '%s不能为空'
            ));
            if($this->form_validation->run() === FALSE){
                $this->error(validation_errors());
            }
            
            $post_data = $this->input->post();
            $post_data['images'] = implode(';', $post_data['images']);
            $post_data['update_admin'] = $data['userInfo']['id'];
            $post_data['create_time'] = date('Y-m-d H:i:s');
            
            if($this->Madmin_resume->update_info($post_data, array('id' => $id))){
                $this->success('', '/admin/read/'.$info['admin_id']);
            }else{
                $this->error('保存失败');
            }
        }
        
        
        if(!empty($info['images'])){
            $info['images'] = explode(';', $info['images']);
        }
        $data['info'] = $info;
        
        $this->load->view('adminresume/edit', $data);
    }
}