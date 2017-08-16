<?php 
    /**
    * 投票候选人类控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Candidate extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_admins' => 'Madmins',
               'Model_activity' => 'Mactivity',
               'Model_candidate' => 'Mcandidate',
               'Model_vote' => 'Mvote'
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
        
        
        $mobile = $this->input->post("mobile_phone");
        $activity_post = $this->input->post("activity_id");
        if($mobile || $activity_post){
            p($mobile);
            p($activity_post);
        }
        
        $where['is_del'] = 0;
        $order_by = array('vote_num' => 'desc', 'create_time' => 'desc');
        $field = '*';
        $list = $this->Mcandidate->get_lists($field, $where, $order_by, $this->pageconfig['per_page'], $offset);
        
        //获取活动名称
        $activity_id = array_column($list, 'activity_id');
        if($activity_id){
           $activity_name = $this->Mactivity->get_lists('id, name', array('in'=>array('id'=>$activity_id)));
           $data['activity_name'] = array_column($activity_name, 'name', 'id');
        }
        
        $activity = $this->Mactivity->get_lists('id, name', array('is_del'=>0));
        $data['activity'] = array_column($activity, 'name', 'id');
        //获取用户
        $user_id = array_column($list, 'create_user_id');
        if($user_id){
            $user = $this->Muser->get_lists('id, mobile_phone', array('in'=>array('id'=>$user_id)));
            $user = array_column($user, 'mobile_phone', 'id');
            $data['user'] = $user;
        }
        
        //统计所得票数
//         $candidate_id = array_column($list, 'id');
//         if($candidate_id){
//             $votes = $this->Mvote->get_lists('candidate_id, count(candidate_id) as num', array('in'=>array('candidate_id'=>$candidate_id), 'is_del'=>0), 0, 0 , 0, 'candidate_id');
//             $data['vote'] = array_column($votes, 'num', 'candidate_id');
//         }
        
        $data['list'] = $list;

        $data['count'] = count($this->Mcandidate->get_lists($field, $where));
        //分页
        if($data['list']){
            $this->pageconfig['base_url'] = '/candidate/index?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        $this->load->view("candidate/index", $data);
    }
    
    
    public function check($id){
        $data = $this->data;
        $id = intval($id);
        !$id && show_404();
        
        
        $post_data = $this->input->post();
        $where['id'] = $id;
        
        if($post_data){
              $update = $this->Mcandidate->update_info($post_data, $where); 
              if($update){
                  $this->return_success([], '审核成功');
              }
              else{
                  $this->return_failed('审核失败');
              }
        }else{
            $this->return_failed('审核失败');
        }
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
        $info = $this->Mcandidate->get_one('*',$where);
        if($info['images']){
            $info['images'] = explode(',', $info['images']);
        }
        
        $data['info'] = $info;
        
        //获取活动名称
        $data['activity'] = $this->Mactivity->get_one('id, name', array('id'=>$info['activity_id']));
        //获取用户名
        $data['user'] = $this->Muser->get_one('id, mobile_phone', array('id'=>$info['create_user_id']));
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                $post_data['update_time'] = date('Y-m-d H:i:s', time());
                $post_data['update_admin'] = $data['userInfo']['id'];
                if($post_data['images']){
                    $post_data['images'] = implode(',', $post_data['images']);
                }
                
                $insert_id = $this->Mcandidate->update_info($post_data, ['id'=>$id]);
            }
    
            if(isset($insert_id) && $insert_id){
                $this->return_success([], '操作成功');
            }else{
                $this->return_failed('修改失败');
            }
    
        }
    
        $this->load->view('candidate/modify', $data);
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
        $update = $this->Mcandidate->update_info($post_data, $where);
        if($update){
            $this->return_success([], '删除成功');
        }else{
            $this->return_failed('操作失败');
        }
    }
}
