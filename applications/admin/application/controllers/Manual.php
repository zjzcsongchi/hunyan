<?php 
    /**
    * 手工位内容控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Manual extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_manual_class' => 'Mmanualclass',
               'Model_manual' => 'Mmanual',
               'Model_admins' => 'Madmins',    
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    /**
     * 手工位内容列表
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        //获取手工位名称
        $manual_class_lists = $this->Mmanualclass->get_lists('id, name', array('is_del' => 1));
        $data['manual_class_lists'] = array_column($manual_class_lists, 'name', 'id');
        $data['manual_class_id'] = $manual_class_id = (int)$this->input->get('manual_class_id');
        
        if($manual_class_id){
            $where['manual_class_id'] = $manual_class_id;
        }
        //获取当前页页码
        $page = (int)$this->input->get_post('per_page') ? : '1';
        
        $where['is_del'] = 1;
        if ($this->input->get('title')) {
            $where['like']['title'] = $this->input->get('title');
        }
        $data['title'] = $this->input->get('title');

        $manual_list = $this->Mmanual->get_lists("*", $where, array('sort' => 'desc'), $this->pageconfig['per_page'], ($page-1)*$this->pageconfig['per_page'] );
        $data_count = count($this->Mmanual->get_lists("*", $where));
        $data['list'] = $manual_list;
        $data['data_count'] = $data_count;
        $data['page'] = $page;

        //获取分页
        $urls = array();
        $title = trim($this->input->get('title', TRUE));
        if(isset($title)){
            $urls['title'] = $title;
        }
        $manual_class_id = (int) trim($this->input->get('manual_class_id', TRUE));
        if(isset($manual_class_id)){
            $urls['manual_class_id'] = $manual_class_id;
        }
        $this->pageconfig['base_url'] = "/manual/index?".http_build_query($urls);
        $this->pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($this->pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息

        //获取操作人
        $admins = $this->Madmins->get_lists("id,name");
        $data['admins'] = array_column($admins, "name","id");
        $this->load->view("manual/home", $data);
    }
    
    
    /**
     * 手工位内容添加
     * @author songchi@gz-zc.cn
     */
    public function add($class_id = 0){
        $data = $this->data;
        $list = $this->input->post();
        $user_id = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] : 0;
        if($list){
            unset($list['file'] , $list['rich_text_img']);
            $list['manual_class_id'] = (int) trim($this->input->post('manual_class_id', TRUE));
            $list['title'] = trim($this->input->post('title', TRUE));
            if(empty($list['title'])){
                $this->error('标题不能为空！');
                exit();
            }
            
            $list['url'] = trim($this->input->post('url', TRUE));
            $list['video'] = trim($this->input->post('video', TRUE));
            if(empty($list['url']) && empty($list['video'])){
                $this->error('链接地址不能为空！');
                exit();
            }
            $list['create_time'] = date("Y-m-d H:i:s");
            $list['create_user'] = $user_id;
            $list['update_time'] = date("Y-m-d H:i:s");
            $list['update_user'] = $user_id;
            $list['is_del'] = 1;
            $add = $this->Mmanual->create($list);
            if($add){
                $this->success("操作成功！！");
            }
        }
        //下拉框手工位选择数据
        $where['is_del'] = 1;
        $manual_class = $this->Mmanualclass->get_lists("*", $where);
        if($manual_class){
            $data['manual_class'] = $manual_class;
            $data['manual_class_id'] = $class_id;
        }
        $this->load->view("manual/add", $data);
    }
    
    
    /**
     * 手工位内容编辑
     * @author songchi@gz-zc.cn
     */
    public function edit($id){
        
        $data = $this->data;
        $list = $this->input->post();
        if($list){
            unset($list['file'] ,$list['rich_text_img']);
            $list['manual_class_id'] = (int) trim($this->input->post('manual_class_id', TRUE));
            $list['title'] = trim($this->input->post('title', TRUE));
            if(empty($list['title'])){
                $this->error('标题不能为空！');
                exit();
            }
            $list['url'] = trim($this->input->post('url', TRUE));
            $list['video'] = trim($this->input->post('video', TRUE));
            if(empty($list['url']) && empty($list['video'])){
                $this->error('链接地址不能为空！');
                exit();
            }
            $user_id = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] : 0;
            $list['create_user'] = $user_id;
            $list['update_time'] = date("Y-m-d H:i:s");
            $list['update_user'] = $user_id;
            $list['is_del'] = 1;
            $where['id'] = $id;
            $update = $this->Mmanual->update_info($list, $where);
            if($update){
                $this->success("操作成功！！");
            }
        }
        //下拉框手工位选择数据
        $where['is_del'] = 1;
        $manual_class = $this->Mmanualclass->get_lists("*", $where);
        if($manual_class){
            $data['manual_class'] = $manual_class;
            $manual_info = $this->Mmanual->get_one('*', array('id'=>$id));
            $data['manual_class_id'] = $manual_info['manual_class_id'];
            $data['manual_info'] = $manual_info;
        }

        $this->load->view("manual/edit", $data);
    }

    
    /**
     * 手工位内容删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $data['is_del'] = 2;
        $del = $this->Mmanual->update_info($data, $where);
        if($del){
            $this->success("操作成功！！");
        }
    }
}

