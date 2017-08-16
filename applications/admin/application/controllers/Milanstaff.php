<?php 
/**
* 米兰国际人员 档期安排
* @author louhang@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Milanstaff extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_staff_schedule' => 'Mstaff_schedule',
               'Model_admins' => 'Madmins',
               'Model_admins_group' => 'Madmins_group',
               'Model_dinner' => 'Mdinner',
               'Model_menu' => 'Mmenu',
               'Model_venue' => 'Mvenue',

        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $this->load->library('form_validation'); 
    }

    /**
     * 首页
     * @author louhang@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];

        //米兰职员类型
        $data['milan_staff_type'] = $milan_staff_type = C('milan_staff_type');
        
        $milan_staff_type = array_column($milan_staff_type, 'name', 'id');
        
        $where = array('in' => array('group_id' => array_keys($milan_staff_type)), 'is_del' => 1); //米兰国际职员
        
        //按职员类型查找 (司仪，灯光，摄影……)
        $group_id = trim($this->input->get_post('group_id'));
        if(!empty($group_id)){
            $where['group_id'] = $group_id;
        }
        //按姓名查找
        $fullname = trim($this->input->get_post('fullname'));
        if(!empty($fullname)){
            $where['like'] = array('fullname' => $fullname);
        }
        //用于分页显示时保留查询参数
        $data['group_id'] = $group_id;
        $data['fullname'] = $fullname;
        
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $order_by = array();
        $data['lists'] = $this->Madmins->get_lists('*', $where, $order_by,  $this->pageconfig['per_page'], ($page-1)*$this->pageconfig['per_page']);
        $data_count = $this->Madmins->count($where);
        
        //职员类型 id => name
        foreach ($data['lists'] as $k => $v){
            $data['lists'][$k]['group'] = isset($milan_staff_type[$v['group_id']]) ? $milan_staff_type[$v['group_id']] : '';
        }

        if(! empty($data['lists'])){
            $this->pageconfig['base_url'] = "/milanstaff/index?group_id=".$group_id."&fullname=".$fullname;
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $data['page'] = $page;
        $data['data_count'] = $data_count;

        $this->load->view("milan_staff/index", $data);
    }

    
    
    /**
     * 删除管理员
     * nengfu@gz-zc.cn
     */
    public function del($id = 0 )
    {
        #不能删除管理员
        if($id==1)
        {
            $this->return_json(array("code"=>1,"msg"=>"不能删除超级管理员。"));
        }

        #标记删除
        $this->Madmins->update_info(array("is_del"=>2),array("id"=>$id)) ;
        $this->success("操作成功","/milanstaff");
    }
    
    /**
     * 职员管理
     * @author louhang@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        if(IS_POST)
        {
            $name = trim($this->input->post('name', TRUE));
            $fullname = trim($this->input->post('fullname', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $re_password = trim($this->input->post("confirpassword", TRUE));
            if(empty($name)){
                $this->return_json(['msg' => "登陆名不能为空!"]);
            }
            if(empty($fullname)){
                $this->return_json(['msg' => "姓名不能为空!"]);
            }
            $count = $this->Madmins->count(array('is_del'=>1,'name'=>$this->input->post("name", TRUE)));
            if($count){
                $this->return_json(['msg' => "已存在的登陆名，请重新填写！"]);
            }
            if(empty($password)){
                $this->return_json(['msg' => "密码不能为空!"]);
            }
            if(trim($this->input->post("password", TRUE)) != trim($this->input->post("confirpassword", TRUE))){
                $this->return_json(['msg' => "两次密码不一致"]);
            }
            $da =$this->input->post();
            $da['is_del'] = 1;
            $da['create_admin'] =$this->data['userInfo']['id'] ;
            $da['create_time'] = date("Y-m-d H:i:s");
            $da['password'] = md5(trim($this->input->post("password", TRUE)));
            $da['group_id'] = (int) trim($this->input->post('group_id', TRUE));
            $da['type'] = (int) trim($this->input->post('type', TRUE));
            $da['grade'] = 3; 
            unset($da['confirpassword']);
            $result_id =  $this->Madmins->create($da);
            if($result_id){
                $this->return_json(['code' => 1, 'msg' => "添加成功"]);
            }else{
                $this->return_json(['msg' => "添加管理员失败"]);
            }
        }

        $data['title'] = array("职员列表","添加职员"); 
      
        $this->load->view("milan_staff/add",$data);
    }
    
    /**
     * 编辑管理员
     * nengfu@gz-zc.cn
     */
    public function edit($id = 0 )
    {
        $data = $this->data;
        if(IS_POST){
            $post_data = $this->input->post();
            $post_data['id'] = (int)$post_data['id'];

            $name = trim($this->input->post('name', TRUE));
            $fullname = trim($this->input->post('fullname', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $re_password = trim($this->input->post("confirpassword", TRUE));

            
            if(empty($name)){
                $this->return_json(['msg' => "登陆名不能为空!"]);
            }
            if(empty($fullname)){
                $this->return_json(['msg' => "姓名不能为空!"]);
            }
            $count = $this->Madmins->count(array('id !=' => $post_data['id'],'is_del'=>1,'name'=>$this->input->post("name", TRUE)));
            if($count){
                $this->return_json(['msg' => "已存在的登陆名，请重新填写！"]);
            }
            //判断是否需要修改密码
            $old_info = $this->Madmins->get_one("password,create_time,create_admin",array('id'=>$post_data['id']));
            if(!empty($password) && md5($password) != $old_info['password']){
                if(trim($this->input->post("password", TRUE)) != trim($this->input->post("confirpassword", TRUE))){
                    $this->return_json(['msg' => "两次密码不一致"]);
                }
                
                unset($post_data['confirpassword']);
                $post_data['password'] = md5($password);
            }else{
                unset($post_data['password']);
                unset($post_data['confirpassword']);
            }
            
            $result_id =  $this->Madmins->update_info($post_data, array('id' => $post_data['id']));
            if($result_id){
                $this->return_json(['code' => 1, 'msg' => "添加成功"]);
            }else{
                $this->return_json(['msg' => "修改管理员失败"]);
            }
    
    
        }
    
        $data = $this->data;
        $data['title'] = array("管理员","编辑管理员");

        //管理员信息
        $data['info'] = $this->Madmins->get_one("*",array("id"=>$id));
       
    
        $this->load->view("milan_staff/edit",$data);
    }
    
    
    /**
     * 档期查看
     * @author louhang@gz-zc.cn
     */
    public function schedule($staff_id = 0){
        $data = $this->data;
        $this->load->helper('date');
        
        $where = array('is_del' => 1);
        $where['id'] = (int)$staff_id;

        $data['list'] = $this->Madmins->get_lists('*', $where); 
        //显示职位
        $milan_staff_type = $this->get_staff_group();
        $milan_staff_type = array_column($milan_staff_type, 'name', 'id');
        foreach ($data['list'] as $k => $v){
            $data['list'][$k]['type'] = isset($milan_staff_type[$v['group_id']]) ? $milan_staff_type[$v['group_id']] : '';
        }
        
        //获取该月天数
        $data['month'] = $month = date('m');
        $data['year'] = $year = date('Y');
        $data['days'] = days_in_month($month, $year);
        $data['staff_id'] = $staff_id;
        //获取场馆预约情况
        $appoint_list = $this->get_appoint($staff_id, $month, $year);
        foreach ($data['list'] as $k => $v){
            foreach ($appoint_list as $key => $value){
                if($v['id'] == $key){
                    $data['list'][$k]['appoint_list'] = $value;
                    break; 
                }
            }
        }
        
        $data['appoint_status'] = ['未确认', '已确认档期', '拒绝排档'];
        
        $this->load->view('milan_staff/schedule', $data);
        
    }
    
    public function get_appoint($staff_id = array(), $month = 0, $year = 0){
    
        $year = $year ?  : date('Y');
        $month = $month ?  : date('m');
    
        $this->load->helper('date');
        $days = days_in_month($month, $year);
    
        // 获取预约数据
        $where = array(
                'is_del' => 0,
                'schedule_time >=' => $year . '-' . $month . '-01',
                'schedule_time <=' => $year . '-' . $month . '-' . $days,
                'staff_id' => $staff_id
        );
      
        $list = $this->Mstaff_schedule->get_lists('*', $where);
        
        //用 menu_id 查找  t_staff_schedule中的 venue_id
        $menu_ids = array_column($list, 'menu_id', 'menu_id');
        $menu_ids = $menu_ids ?: '';
        $where = array('is_del' => '0', 'in' => array('id' => $menu_ids));
        $menus = $this->Mmenu->get_lists('id, venue_id', $where);
        
        //将 menus中 venue_id替换为相应的场馆名称
        $venues =  $this->Mvenue->get_lists('id, name');
        $venues = array_column($venues, 'name', 'id');
        foreach ($menus as $k => $v){
            $menus[$k]['venue'] = isset($venues[$v['venue_id']]) ? $venues[$v['venue_id']] : '';
        }
        $menus = array_column($menus, 'venue', 'id');
        
        //用 $data['list']中的menu_id 查找该订单对应的场馆名称
        foreach ($list as $k => $v){
            $list[$k]['venue'] = isset($menus[$v['menu_id']]) ? $menus[$v['menu_id']] : '';
        }

        $new_list = array();
        foreach($list as $k => $v)
        {
            for($i = 1; $i <= $days; $i ++)
            {
                $i < 10 && $i = '0' . $i;
                if($v['schedule_time'] == $year . '-' . $month . '-' . $i)
                {
                    $new_list[$v['staff_id']][$i][] = $v;
                }
            }
        }
    
        return $new_list;
    
    }
    
    /**
     * 切换显示月份
     * @author chaokai@gz-zc.cn
     */
    public function change_date(){
        $data = $this->data;
        //数据验证
        $this->form_validation->set_rules('year', '年份', 'numeric', array('numeric' => '%s数据不正确'));
        $this->form_validation->set_rules('month', '月份', 'numeric', array('numeric' => '%s数据不正确'));
        $this->form_validation->set_rules('staff_id', '职员', 'numeric', array('numeric' => '%s数据不正确'));
    
        if($this->form_validation->run() == false){
            show_404();
        }
    
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $staff_id = $this->input->post('staff_id');
        $data['year'] = $year;
        $data['month'] = $month;
        $data['staff_id'] = $staff_id;
    
        //计算搜索月的天数
        $this->load->helper('date');
        $data['days'] = days_in_month($month, $year);
    
        $data['appoint_list'] = $this->get_appoint($staff_id, $month, $year);
        
        $data['appoint_status'] = ['未确认', '已确认档期', '拒绝排档']; 
        $this->load->view('milan_staff/appoint_list', $data); 
    }
    
    /**
     * 获取 t_admin.group_id 与职员名称对应关系 (该职称下已存在职员)
     * @author louhang@gz-zc.cn
     */
    public function get_staff_group(){
        return C('milan_staff_type');
        
        $field = 'group_id';
        $where = array('type' => C('public.type.milan_staff.id'),'is_del' => 1);
        $milan_staffs =  $this->Madmins->get_lists($field, $where);
    
        if($milan_staffs){
            $milan_staffs = array_column($milan_staffs, 'group_id');
        }else{
            $milan_staffs = '';
        }
    
        $field = 'id ,name';
        $where = array('in' => array('id' => $milan_staffs));
        $res = $this->Madmins_group->get_lists($field, $where);
        return $res;
    }

}

