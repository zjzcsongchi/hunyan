<?php
/**
 * 星光大道报名系统
 * @author chaokai@gz-zc.cn
 */
class Xingguang extends MY_Controller{
    
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
                        'Model_xg_userinfo' => 'Mxg_userinfo',
        ));
        $this->load->library('form_validation');
    }
    
    /**
     * 报名列表页
     * @author chaokai@gz-zc.cn
     */
    public function index(){
        
        $data = $this->data;
        $data['title'] = array('首页', '星光大道报名');
        
        $page = intval($this->input->post('per_page')) ? : 1;
        
        $where = array();
        if(IS_POST){
            if($realname = $this->input->post('realname')){
                $where['like'] = array('realname' => $realname);
                $data['realname'] = $realname;
            }
            if($mobile_phone = $this->input->post('mobile_phone')){
                $where['mobile_phone'] = $mobile_phone;
                $data['mobile_phone'] = $mobile_phone;
            }
            if($this->input->post('auth_status') !== ''){
                $data['auth_status'] = $where['auth_status'] = $this->input->post('auth_status');
            }
            
        }
        //报名列表数据
        $pageconfig = C('page.config_bootstrap');
        $pagesize = $pageconfig['per_page'];
        $offset = ($page-1) * $pagesize;
        $data['list'] = $this->Mxg_userinfo->lists($where, $pagesize, $offset);
        $data['count'] = $this->Mxg_userinfo->count(array_merge(array('is_del' => 0), $where));
        
        //分页
        $this->load->library('pagination');
        $pageconfig['base_url'] = '/xingguang/index'.http_build_query($where);
        $pageconfig['total_rows'] = $data['count'];
        
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links();
        
        $this->load->view('xingguang/index', $data);
    }
    
    /**
     * 详情
     * @param GET id int 报名id
     * @author chaokai@gz-zc.cn
     */
    public function detail(){
        $id = intval($this->input->get('id'));
        !$id && show_404();
        $data = $this->data;
        $data['title'] = array(
                        '首页',
                        '报名列表',
                        '详细信息'
        );
        
        $info = $this->Mxg_userinfo->info($id);
        if(!$info){
            show_404();
        }
        $data['info'] = $info;
        $this->load->view('xingguang/detail', $data);
    }
    
    /**
     * 审核
     * @param POST auth_status int 审核状态
     * @param POST auth_suggestion string 审核意见
     * @author chaokai@gz-zc.cn
     */
    public function auth(){
        
        $this->form_validation->set_rules('id', '', 'integer', array('integer' => '编号错误'));
        $this->form_validation->set_rules('auth_status', '', 'integer|in_list[1,2]', array('integer' => '审核状态错误', 'in_list' => '审核状态错误'));
        if($this->form_validation->run() === false){
            $this->return_failed(validation_errors());
        }
        
        $id = $this->input->post('id');
        $auth_status = $this->input->post('auth_status');
        $auth_suggestion = $this->input->post('auth_suggestion');
        
        $where = array('id' => $id);
        $post_data = array(
                        'auth_status' => $auth_status,
                        'auth_suggestion' => $auth_suggestion
        );
        
        $this->Mxg_userinfo->update_info($post_data, $where);
        $this->return_success();
    }
    
    /**
     * 修改
     * @param GET id 报名id
     * @author chaokai@gz-zc.cn
     */
    public function edit(){
        $id = intval($this->input->get('id'));
        !$id && show_404();
        
        //报名详情
        $info = $this->Mxg_userinfo->info($id);
        !$info && show_404();
        
        $data = $this->data;
        
        if(IS_POST){
            $post_data = $this->input->post();
            //家庭
            $family_relation = $post_data['family_relation'];
            unset($post_data['family_relation']);
            $family_name = $post_data['family_name'];
            unset($post_data['family_name']);
            $family_mobile_phone = $post_data['family_mobile_phone'];
            unset($post_data['family_mobile_phone']);
            $family = array();
            for ($i = 0; $i < count($family_name); $i++){
                $family[$i]['xg_user_id'] = $id;
                $family[$i]['relation'] = $family_relation[$i];
                $family[$i]['name'] = $family_name[$i];
                $family[$i]['mobile_phone'] = $family_mobile_phone[$i];
            }
            //节目
            $program_type = $post_data['program_type'];
            unset($post_data['program_type']);
            $program_name = $post_data['program_name'];
            unset($post_data['program_name']);
            for ($i = 0; $i < count($program_name); $i++){
                $program[$i]['xg_user_id'] = $id;
                $program[$i]['program_type'] = $program_type[$i];
                $program[$i]['name'] = $program_name[$i];
            }
            //其他信息
            $other_info = array(
                            'growth_exprience' => $post_data['growth_exprience'],
                            'music_feel' => $post_data['music_feel'],
                            'myself_intro' => $post_data['myself_intro'],
                            'race_attitude' => $post_data['race_attitude'],
                            'history_activity' => $post_data['history_activity'],
                            'my_image_desc' => $post_data['my_image_desc'],
                            'my_feeling_express' => $post_data['my_feeling_express'],
                            'my_language_desc' => $post_data['my_language_desc'],
                            'my_talent_desc' => $post_data['my_talent_desc'],
                            'my_game_desc' => $post_data['my_game_desc'],
                            'born_place_desc' => $post_data['born_place_desc'],
                            'skill_desc' => $post_data['skill_desc'],
                            'want_see_people' => $post_data['want_see_people'],
                            'like_works' => $post_data['like_works'],
                            'know_life_tips' => $post_data['know_life_tips']
            );
            unset($post_data['growth_exprience'], $post_data['music_feel'], $post_data['myself_intro'], $post_data['race_attitude'], $post_data['history_activity']);
            unset($post_data['my_image_desc'], $post_data['my_feeling_express'], $post_data['my_language_desc'], $post_data['my_talent_desc'], $post_data['my_game_desc']);
            unset($post_data['born_place_desc'], $post_data['skill_desc'], $post_data['want_see_people'], $post_data['like_works'], $post_data['know_life_tips']);
            
            $this->db->trans_start();
            //更新用户信息
            $post_data['auth_status'] = 0;//修改后需要重新审核
            $this->Mxg_userinfo->update_info($post_data, array('id' => $id));
            //更新其他信息
            $this->Mxg_otherinfo->update_info($other_info, array('xg_user_id' => $id));
            //更新家庭信息
            $this->Mxg_family->delete(array('xg_user_id' => $id));
            $this->Mxg_family->create_batch($family);
            //更新节目信息
            $this->Mxg_program->delete(array('xg_user_id' => $id));
            $this->Mxg_program->create_batch($program);
            
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $this->error();
            }else{
                $this->success('', '/xingguang');
            }
        }
        
        $data['info'] = $info;
        //加载配置文件
        $data['program_name'] = C('program_name');
        $data['political_status'] = C('political_status');
        $data['marry_status'] = C('marry_status');
        
        $this->load->view('xingguang/edit', $data);
    }
}