<?php 
    /**
    * 酒水分类控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Drinkclass extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_about_us' => 'Maboutus',
               'Model_admins' => 'Madmins',
               'Model_drink_class'=>'Mdrinkclass'
        ]);
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        //分页配置加载
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        
        $where['is_del']= 0;
        if ($this->input->get('cn_name')) {
            $where['like']['cn_name'] = trim($this->input->get('cn_name', TRUE));
            $data['cn_name'] = trim($this->input->get('cn_name', TRUE));
        }
        
        $data['list'] = $this->Mdrinkclass->get_lists("*", $where, array('sort' => 'desc'), $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        $data_count = $this->Mdrinkclass->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;
        
        $param = trim($this->input->get('cn_name', TRUE));
        if(isset($param) && !empty($param)){
            $pageconfig['base_url'] = "/drinkclass?name=".$param;
        }else{
            $pageconfig['base_url'] = "/drinkclass";
        }
        
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        
        $this->load->view("drinkclass/index", $data);
    }
    
    
    /**
     * 增加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        $list = $this->input->post();
        if($list){
            $list['create_time'] = date("Y-m-d H:i:s");
            $list['update_time'] = date("Y-m-d H:i:s");

            $add = $this->Mdrinkclass->create($list);
            if($add){
                $this->success("添加成功！！", '/drinkclass');
            }
            
        }
        $this->load->view("drinkclass/add", $data);
    }
    
    
    /**
     * 删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $del = $this->Mdrinkclass->update_info(array('is_del'=>1), $where);
        if($del){
           $this->success("操作成功！！");
        }
    }
    
    /**
     * 修改
     * @author songchi@gz-zc.cn
     */
    public function edit($id='0'){
        $data = $this->data;
        $id = intval($id);
        $data['info'] = $this->Mdrinkclass->get_one('*', array('id'=>$id));
        $list = $this->input->post();
        if($list){
            $list['update_time'] = date("Y-m-d H:i:s");
            $update = $this->Mdrinkclass->update_info($list, array('id'=>$list['id']));
            if($update){
                $this->success("修改成功！！", '/drinkclass');
            }
    
        }
        $this->load->view("drinkclass/edit", $data);
    }
    
}
