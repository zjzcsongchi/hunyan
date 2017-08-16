<?php 
    /**
    * 婚庆主题控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Followingshot extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_following_shot' => 'Mfollowing_shot',
               'Model_admins' => 'Madmins',
        ]);
        
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        
        $data_count = $this->Mfollowing_shot->count(array('is_del'=>0));
        $order_by = array('create_time' => 'desc');
        $data['lists'] = $this->Mfollowing_shot->get_lists('*', array('is_del'=>0), $order_by, $size, ($page-1)*$size);
        
        if(! empty($data['lists'])){
            $this->pageconfig['base_url'] = "/followingshot/index";
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $data['page'] = $page;
        $data['data_count'] = $data_count;

        $this->load->view("followingshot/index", $data);
    }
    
    
    public function add(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $images = [];
            foreach($post_data['arr'] as $k=>$v){
                if($v['name'] == 'theme_img'){
                    if($v['value']){
                        $images[] = $v['value'];
                    }else{
                        $images = '';
                    }
                }
                if($v['name'] == 'title'){
                    if($v['value']){
                        $title = $v['value'];
                    }else{
                        $title = '';
                    }
                    
                }
                if($v['name'] == 'desc'){
                    if($v['value']){
                        $desc = $v['value'];
                    }else{
                        $desc = '';
                    }
                
                }
                if($v['name'] == 'cover_img'){
                    if($v['value']){
                        $cover_img = $v['value'];
                    }else{
                        $cover_img = '';
                    }
                    
                }
                
                if($v['name'] == 'video'){
                    if($v['value']){
                        $video = $v['value'];
                    }else{
                        $video = '';
                    }
                
                }
            }
            
            if(!$title){
                $list = array('status'=>-1, 'msg'=>"标题不能为空");
                $this->return_json($list);
            }
            
            if(!$desc){
                $list = array('status'=>-1, 'msg'=>"简介不能为空");
                $this->return_json($list);
            }
            
            if(!isset($cover_img) || !$cover_img){
                $list = array('status'=>-3, 'msg'=>"封面图不能为空");
                $this->return_json($list);
            }
            if($images){
                $images = implode(',', $images);
            }else{
                $list = array('status'=>-1, 'msg'=>"相册不能为空");
                $this->return_json($list);
            }
            
            if(isset($video)  && $video){
                $add_data['video'] = $video;
            }
            
            $add_data['cover_img'] = $cover_img;
            $add_data['images'] = $images;
            $add_data['title'] = $title;
            $add_data['desc'] = $desc;
            $add_data['create_time'] = date('Y-m-d h:i:s', time());
            $add_data['update_time'] = date('Y-m-d h:i:s', time());
            $add = $this->Mfollowing_shot->create($add_data);
            if($add){
                $list = array('status'=>0, 'msg'=>"添加成功");
                $this->return_json($list);
            }else{
                $list = array('status'=>-1, 'msg'=>"添加失败");
                $this->return_json($list);
            }
        }
        $this->load->view('followingshot/add', $data);
    }
   
   
    public function edit($id){
        $data = $this->data;
        $id = intval($id);
        $data['info'] = $this->Mfollowing_shot->get_one('*', array('id'=>$id));
        $data['info']['images'] = explode(',', $data['info']['images']);

        
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $images = [];
            foreach($post_data['arr'] as $k=>$v){
                if($v['name'] == 'theme_img'){
                    if($v['value']){
                        $images[] = $v['value'];
                    }else{
                        $images = '';
                    }
                }
                if($v['name'] == 'title'){
                    if($v['value']){
                        $title = $v['value'];
                    }else{
                        $title = '';
                    }
            
                }
                if($v['name'] == 'desc'){
                    if($v['value']){
                        $desc = $v['value'];
                    }else{
                        $desc = '';
                    }
                
                }
                if($v['name'] == 'cover_img'){
                    if($v['value']){
                        $cover_img = $v['value'];
                    }else{
                        $cover_img = '';
                    }
            
                }
                
                if($v['name'] == 'video'){
                    if($v['value']){
                        $video = $v['value'];
                    }else{
                        $video = '';
                    }
                
                }
            }
            
            if(!$title){
                $list = array('status'=>-1, 'msg'=>"标题不能为空");
                $this->return_json($list);
            }
            if(!$desc){
                $list = array('status'=>-1, 'msg'=>"简介不能为空");
                $this->return_json($list);
            }
            
            if(!isset($cover_img) || !$cover_img){
                $list = array('status'=>-3, 'msg'=>"封面图不能为空");
                $this->return_json($list);
            }
            
            if($images){
                $images = implode(',', $images);
            }else{
                $list = array('status'=>-1, 'msg'=>"相册不能为空");
                $this->return_json($list);
            }
            
            if(isset($video)  && $video){
                $add_data['video'] = $video;
            }
            
            $add_data['cover_img'] = $cover_img;
            $add_data['images'] = $images;
            $add_data['title'] = $title;
            $add_data['desc'] = $desc;
            $add_data['update_time'] = date('Y-m-d h:i:s', time());
            $update = $this->Mfollowing_shot->update_info($add_data, array('id'=>$id));
            
            if($update){
                $list = array('status'=>0, 'msg'=>"修改成功");
                $this->return_json($list);
            }else{
                $list = array('status'=>-1, 'msg'=>"修改失败");
                $this->return_json($list);
            }
            
        }
        
        $this->load->view('followingshot/edit', $data);
    }
    
    
    public function del($id){
        $id = intval($id);
        $data['is_del'] = 1;
        $del = $this->Mfollowing_shot->update_info($data, array('id'=>$id));
        if($del){
            $this->success('删除成功', '/followingshot');
        }else{
            $this->success('失败', '/followingshot');
        }
    }
    
}
