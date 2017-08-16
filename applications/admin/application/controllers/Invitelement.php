<?php 
    /**
    * 微请帖用户模板控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Invitelement extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_invit_element' => 'Minvit_element',
                'Model_user' => 'Muser',
                'Model_template' => 'Mtemplate',
                'Model_music' => 'Mmusic',
                'Model_elements' => 'Melements',
                'Model_invit_element' => 'Minvit_element',
                'Model_invit' => 'Minvit'
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
        
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        
        $name = $this->input->post('name');
        if($name){
            $template_search_id = $this->Mtemplate->get_lists('id', array('like'=>array('name'=>$name)));
            $template_search_id = array_column($template_search_id, 'id');
            if($template_search_id){
               $where['in'] = array('template_id'=>$template_search_id) ;
            }else{
                $where['in'] = array('template_id'=>0) ;
            }
            $data['name'] = $name;
        }
        
        $user = $this->input->post('user');
        if($user){
            $user_search_id = $this->Muser->get_lists('id', array('like'=>array('nickname'=>$user)));
            $user_search_id = array_column($user_search_id, 'id');
            if($user_search_id){
                $where['in'] = array('user_id'=>$user_search_id) ;
            }else{
                $where['in'] = array('user_id'=>0);
            }
            $data['user'] = $user;
        }
        
        $where['is_del'] = 0;
//         $where['flag>'] = 0;
//         $order_by['id'] = 'desc';
        $group_by = 'template_id, user_id';
//         $group_by = array();
        $lists = $this->Minvit_element->get_lists('id, user_id, template_id, flag', $where,0,$this->pageconfig['per_page'], $offset,$group_by);
        
        //获取新郎
        $roles_main = $this->Minvit_element->get_lists('id, user_id, template_id, default', array_merge($where, array('flag'=>1)),0,$this->pageconfig['per_page'], $offset,$group_by);
        
        
        $data['roles_main'] = array();
        foreach ($roles_main as $k=>$v){
            $data['roles_main'][$v['user_id']][$k]['template_id'] = $v['template_id'];
            $data['roles_main'][$v['user_id']][$k]['default'] = $v['default'];
        }
        //获取新娘
        $roles_wife = $this->Minvit_element->get_lists('id, user_id, template_id, default', array_merge($where, array('flag'=>2)),0,$this->pageconfig['per_page'], $offset,$group_by);

        $data['roles_wife'] = array();
        foreach ($roles_wife as $k=>$v){
            $data['roles_wife'][$v['user_id']][$k]['template_id'] = $v['template_id'];
            $data['roles_wife'][$v['user_id']][$k]['default'] = $v['default'];
        }

        //获取时间
        
        $begin_time = $this->Minvit_element->get_lists('user_id, template_id, default', array_merge($where, array('flag'=>3)),0,$this->pageconfig['per_page'], $offset,$group_by);
        
        $data['begin_time'] = array();
        foreach ($begin_time as $k=>$v){
            $data['begin_time'][$v['user_id']][$k]['template_id'] = $v['template_id'];
            $data['begin_time'][$v['user_id']][$k]['default'] = $v['default'];
        }
        
//         $data['count'] = $this->Minvit_element->count($where);
        $data['count'] = count($this->Minvit_element->get_lists('id, user_id, template_id, flag', $where,0,0,0,$group_by));
        $user_id = array_unique(array_column($lists, 'user_id'));
        $template_id = array_unique(array_column($lists, 'template_id'));
        if($user_id){
            $user_list = array();
            $user_info = $this->Muser->get_lists('id, realname, nickname, head_img', array('in'=>array('id'=>$user_id)));
            foreach ($user_info as $k=>$v){
                $user_list[$v['id']] = $v;
            }
            $data['user_list'] = $user_list;
        }
        if($template_id){
            $template_info = $this->Mtemplate->get_lists('*', array('in'=>array('id'=>$template_id)));
            $template_name = array_column($template_info, 'name', 'id');
            $template_music = array_column($template_info, 'music_id', 'id');
            $music_id = array_column($template_info, 'music_id');
            $music_list = $this->Mmusic->get_lists('*', array('in'=>array('id'=>$music_id)));
            $music_info = array();
            foreach ($music_list as $k=>$v){
                $music_info[$v['id']] = $v;
            }
            
            foreach ($template_music as $k=>$v){
                $template_music[$k] = $music_info[$v];
            }
            
            foreach ($lists as $k=>$v){
                $lists[$k]['user_name'] = isset($user_list[$v['user_id']]) ? $user_list[$v['user_id']]['nickname'] : $user_list[$v['user_id']]['realname'];
                $lists[$k]['template'] = $template_name[$v['template_id']];
                $lists[$k]['music'] = $template_music[$v['template_id']]['music'];
                $lists[$k]['music_name'] = $template_music[$v['template_id']]['name'];
            }
            
        }
        $data['lists'] = $lists;
        if($data['lists']){
            $this->pageconfig['base_url'] = '/invitelement/index'.'?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        $this->load->view("invitelement/index", $data);
    }
    
    public function del(){
        $data = $this->data;
        $post_data = $this->input->post();
        $where['template_id'] = $post_data['template_id'];
        $where['user_id'] = $post_data['user_id'];
        
        $update = $this->Minvit_element->delete($where);
        if($update){
            $this->return_success([], '操作成功');
        }else{
            $this->return_failed('修改失败');
        }
    }
    
    public function page($user_id, $template_id){
        $data = $this->data;
        $data['user_id'] = $user_id;
        $data['template_id'] = $template_id;
        $data['title'] = array('首页', '页面列表');
        
        $where['is_del'] = 0;
        $where['user_id'] = $user_id;
        $where['template_id'] = $template_id;
        $order_by['sort'] = 'asc';
        $group_by = 'page_id';
        
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        
        $page_lists = $this->Minvit_element->get_lists('id, page_id, user_id, template_id, sort', $where, $order_by, $this->pageconfig['per_page'], $offset, $group_by);
        $data['count'] = count($page_lists);
        
        $name = $this->Mtemplate->get_one('name', array('id'=>$template_id));
        $data['name'] = $name['name'];
        $data['list'] = $page_lists;

        if($data['list']){
            $this->pageconfig['base_url'] = '/invitelement/page/'.$user_id.'/'.$template_id.'?'.http_build_query($where);
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
                $post_data['user_id'] = $user_id;
                $post_data['template_id'] = $template_id;
                $insert_id = $this->Minvit_element->create($post_data);
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
        $this->load->view('invitelement/page', $data);
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
            $ele_lists = $this->Minvit_element->get_lists('*', $page_where, $order_by, $this->pageconfig['per_page'], $offset);
            $data['count'] = count($this->Minvit_element->get_lists('*', $page_where));
            //分页
            if($ele_lists){
                $this->pageconfig['base_url'] = '/invitelement/element/'.$page_id.'?'.http_build_query($page_where);
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
                $insert_id = $this->Minvit_element->update_info($post_data, $where);
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('添加失败');
            }
        }
    
        $this->load->view('invitelement/element', $data);
    
    }
    
    public function element_del(){
        $data = $this->data;
        $id = $this->input->post('id');
        if(!$id){
            $this->return_failed("操作失败");
        }
    
        $where['id'] = $id;
        $post['is_del'] = 1;
        $update_id = $this->Minvit_element->update_info($post, $where);
        if($update_id){
            $this->return_success([], '操作成功');
        }else{
            $this->return_failed("操作失败");
        }
    }
    
    public function message($user_id){
        $data = $this->data;
        $data['title'] = array('首页', '留言列表');
        $data['attend_num'] = C('attendance.num');
        
        $this->pageconfig = C('page.config_bootstrap');
        $page = $this->input->get('per_page') ? : 1;
        $offset = ($page-1)*$this->pageconfig['per_page'];
        
        $user_id = intval($user_id);
        $where['host_id'] = $user_id;
        $where['is_del'] = 0;
        
        $message = $this->Minvit->get_lists('*', $where, 0, $this->pageconfig['per_page'], $offset);
        $data['count'] = count($message);
        //分页
        if($message){
            $this->pageconfig['base_url'] = '/invitelement/message/'.$user_id.'?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        $user_id = array_unique(array_column($message, 'user_id'));
        if($user_id){
            $user = $this->Muser->get_lists('id, nickname, realname, head_img', array('in'=>array('id'=>$user_id)));
            $user_info = array();
            foreach ($user as $k=>$v){
                $user_info[$v['id']]['user_name'] = isset($v['realname']) &&  $v['realname']? $v['realname'] : $v['nickname']; 
                $user_info[$v['id']]['head_img'] = isset($v['head_img']) &&  $v['head_img']? $v['head_img'] : '';
            }
            $data['user'] = $user_info;
        }
        $data['lists'] = $message;
        $this->load->view("invitelement/message", $data);
    }
    
    public function message_edit(){
        $data = $this->data;
        $id = $this->input->get('id');
        if(!$id){
            $this->return_failed("操作失败");
        }
        $data['id'] = $id;
        $info = $this->Minvit->get_one('*', array('id'=>$id));
        $data['info'] = $info;
        $data['attend_num'] = C('attendance.num');
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $this->form_validation->set_rules('name', '姓名', 'trim|required', array('required' => '%s不能为空'));
            
            if($this->form_validation->run() == false){
                $this->return_failed(strip_tags(validation_errors()));
            }
            $where['id'] = $id;
            $update_id = $this->Minvit->update_info($post_data, $where);
            if($update_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed("操作失败");
            }
            
        }
       
        $this->load->view('invitelement/message_edit', $data);
    }
    
    public function message_del(){
        $data = $this->data;
        $id = $this->input->post('id');
        if(!$id){
            $this->return_failed("操作失败");
        }
        
        $where['id'] = $id;
        $post['is_del'] = 1;
        $update_id = $this->Minvit->update_info($post, $where);
        if($update_id){
            $this->return_success([], '操作成功');
        }else{
            $this->return_failed("操作失败");
        }
    }
    
}
