<?php 
    /**
    * 手工位名称控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Manualclass extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_manual_class' => 'Mmanualclass',
               'Model_manual' => 'Mmanual',
               'Model_admins' => 'Madmins',
        ]);
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;

        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';

        $where['is_del'] = 1;
        if ($this->input->get('name')) {
            $where['like']['name'] = trim($this->input->get('name', TRUE));
        }
        $data['name'] = $this->input->get('name');
        $manual_list = $this->Mmanualclass->get_lists("*", $where, array('sort' => 'desc'), $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        $data['list'] = $manual_list;

        $data_count = $this->Mmanualclass->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;

        //获取分页
        $param = trim($this->input->get('name', TRUE));
        if(isset($param) && !empty($param)){
            $pageconfig['base_url'] = "/manualclass?name=".$param;
        }else{
            $pageconfig['base_url'] = "/manualclass";
        }
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息

        //获取操作人
        $admins = $this->Madmins->get_lists("id,name");
        $data['admins'] = array_column($admins, "name","id");
        $this->load->view("manualclass/index", $data);
    }
    
    
    /**
     * 手工位名称添加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        $post_data = $this->input->post();
        if($post_data){
            $post_data['name'] = trim($this->input->post('name', TRUE));
            if($post_data['name']){
                if($this->check_manual_exists($post_data['name'])){
                    $this->error("已经存在的手工位，请重新提交！", "/manualclass");
                    exit();
                }
                $post_data['sort'] = (int) trim($this->input->post('sort', TRUE));
                $post_data['create_time'] = date("Y-m-d H:i:s");
                $post_data['update_time'] = date("Y-m-d H:i:s");
                $post_data['is_del'] = 1;
                $post_data['create_user'] = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] : 0;
                $add = $this->Mmanualclass->create($post_data);
                if($add){
                    $this->success("操作成功！！", "/manualclass");
                }else{
                    $this->error("操作失败，请重新提交！", "/manualclass");
                }
            }else{
                $this->error("手工位名称必填！", "/manualclass");
            }

        }
        $this->load->view("manualclass/add", $data);
    }
    
    /**
     * 手工位名称编辑
     * @author songchi@gz-zc.cn
     */
    public function edit($id){
        $data = $this->data;
        $where['id'] = $id;
        $info = $this->Mmanualclass->get_one('*', $where);
        $data['info'] = $info?$info:'';
        $list = $this->input->post();
        if($list){
            $where['id'] = $id;
            if($list['name']){
                $list['update_time'] = date("Y-m-d H:i:s");
                $update = $this->Mmanualclass->update_info($list, $where);
                if($update){
                    $this->success("操作成功！！", "/manualclass");
                }
            }
    
        }
        $this->load->view("manualclass/edit", $data);
    }
    
    
    /**
     * 手工位名称删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $data['is_del'] = 0;
        $del = $this->Mmanualclass->update_info($data, $where);
        if($del){
            $this->success("操作成功！！");
        }
    }
    
    /**
     * 检测分类否存在
     * @author yonghua@gz-zc.cn
     * @param string $name 分类名称
     * @parent_id 父级分类
     * @return boolean
     */
    public function check_manual_exists($name ='')
    {
        $res = $this->Mmanualclass->get_one("id", ['name' => $name]);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
}

