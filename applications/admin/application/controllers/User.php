<?php 
    /**
    * 客户控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class User extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_user' => 'Muser',
               'Model_admins' => 'Madmins',
               'Model_file' => 'Mfile'
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
        $order_by = array('create_time'=>'desc'); 
        
        //姓名查询
        $where = array();
        $name = $this->input->get_post('name');
        if($name){
            $where['like'] = array('realname'=>$name);
        }
        //电话查询
        $phone = $this->input->get_post('phone');
        if($phone){
            $where['mobile_phone'] = $phone;
        }
        
        $is_del = (int) $this->input->get('is_del');
        $where['is_del'] = $is_del;
        $data['is_del'] = $is_del;
        
        $data['name'] = $name;
        $data['phone'] = $phone;
        
        //会员类型判断依据：如果没有绑定手机号和头像的，判断为散客；有手机号没有头像的，判断为客户，有头像，有名称，有手机号的判断为会员
        $user_type = (int) $this->input->get('user_type');
        
        $data['user_type'] = $user_type;
        if($user_type === 0 || $user_type === 1){
            $where['mobile_phone !='] = '';
            $where['head_img !='] = '';
            $where['realname !='] = '';
        }
        if($user_type === 2){
            $where['mobile_phone !='] = '';
            $where['head_img'] = '';
            $where['realname !='] = '';
        }
        if($user_type === 3){
            $where['mobile_phone'] = '';
        }
        
        $data['user'] = $this->Muser->get_lists('*', $where, $order_by, $size, ($page-1)*$size);
        //获取添加人姓名
        $admin_id = array_column($data['user'], 'create_user');
        $query = array();
        if($admin_id){
            $query['in'] = array('id'=>$admin_id);
        }
        $admin = $this->Madmins->get_lists('id, name', $query);
        $data['admin'] = array_column($admin, 'name', 'id');
        
        $data_count = $this->Muser->count($where);
        if(! empty($data['user'])){
            $this->pageconfig['base_url'] = "/user/index?name=".$name."&phone=".$phone."&user_type=".$user_type."&is_del=".$is_del;
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $data['page'] = $page;
        $data['data_count'] = $data_count;
        
        $this->load->view("user/index", $data);
    }
    
    
    public function add(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            
            $arr1 = array();
            if($post_data['arr']){
                foreach($post_data['arr'] as $k=>$v){
                    $arr1[$v['name']] = $v['value'];
                }
            }
            
            //电话验证
            if($arr1['mobile_phone']){
                if(!preg_match("/^1[34578]\d{9}$/", $arr1['mobile_phone'])){
                    $list = array('status'=>-1, 'msg'=>"电话格式不正确");
                    $this->return_json($list);
                }
            }
            
            //如果没有填写昵称，则使用姓名当作昵称
            if(empty($arr1['nickname'])){
                $arr1['nickname'] = $arr1['realname'];
            }
            
            //身份证验证
            if($arr1['id_number']){
                if(!checkIdCard($arr1['id_number'])){
                    $list = array('status'=>-1, 'msg'=>"身份证格式不正确");
                    $this->return_json($list);
                }
                
            }
            

            $arr1['create_user'] = $data['userInfo']['id'];
            $arr1['create_time'] = date('Y-m-d H:i:s', time());
            $add = $this->Muser->create($arr1);
            if($add){
                $list = array('status'=>0, 'msg'=>"添加成功");
                $this->return_json($list);
            }else{
                $list = array('status'=>-1, 'msg'=>"添加失败");
                $this->return_json($list);
            }
        }else{
            $this->load->view('user/add',$data);
        }
        
    }
    
    
    
    public function limit($id = '0'){
        $id = intval($id);
        $where['is_del'] = 0;
        $where['id'] = $id;
        $limit_status = $this->Muser->get_one('is_limit', $where)['is_limit'];
        $data['is_limit'] = $limit_status == 1 ? 0 : 1;
        $where['id'] = $id;
        $update = $this->Muser->update_info($data, $where);
        if($update){
            $this->success('操作成功', '/user');
        }else{
            $this->error('操作失败', '/user');
        }
    }
   
    
    
    public function del($id = '0'){
        $id = intval($id);
        $del_status = $this->Muser->get_one('is_del', array('id'=>$id))['is_del'];
    
        $data['is_del'] = !$del_status;
        $where['id'] = $id;
        $update = $this->Muser->update_info($data, $where);
        if($update){
            $this->success('操作成功', '/user');
        }else{
            $this->error('操作失败', '/user');
        }
    }
    
    
    public function edit($id = '0'){
        $data = $this->data;
        $id = intval($id);
        $data['info'] = $this->Muser->get_one('*', array('id'=>$id));
        
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $arr1 = array();
            if($post_data['arr']){
                foreach($post_data['arr'] as $k=>$v){
                    $arr1[$v['name']] = $v['value'];
                }
            }
        
            //电话验证
            if($arr1['mobile_phone']){
                if(!preg_match("/^1[34578]\d{9}$/", $arr1['mobile_phone'])){
                    $list = array('status'=>-1, 'msg'=>"电话格式不正确");
                    $this->return_json($list);
                }
            }
            
            //身份证验证
            if($arr1['id_number']){
                if(!checkIdCard($arr1['id_number'])){
                    $list = array('status'=>-1, 'msg'=>"身份证格式不正确");
                    $this->return_json($list);
                }
            
            }
            
            $arr1['create_user'] = $data['userInfo']['id'];
            $arr1['update_time'] = date('Y-m-d H:i:s', time());
            $update = $this->Muser->update_info($arr1, array('id'=>$id));
            if($update){
                $list = array('status'=>0, 'msg'=>"修改成功");
                $this->return_json($list);
            }else{
                $list = array('status'=>-1, 'msg'=>"修改失败");
                $this->return_json($list);
            }
        }
        
        
        $this->load->view('user/edit', $data);
    }
    
    
    
    public function view($id = '0'){
        $data = $this->data;
        $id = intval($id);
        $data['user'] = $this->Muser->get_one('*', array('id'=>$id));
        
        //获取添加人姓名
        $data['create_user'] = $this->Madmins->get_one('name', array('id'=>$data['user']['create_user']))['name'];
        $this->load->view('user/info', $data);
        
    }
    
}

