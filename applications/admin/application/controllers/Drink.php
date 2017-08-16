<?php 
    /**
    * 酒水控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Drink extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_about_us' => 'Maboutus',
               'Model_admins' => 'Madmins',
               'Model_drink_class'=>'Mdrinkclass',
               'Model_drink'=>'Mdrink',
               'Model_drink_ml_num' => 'Mdrinkmlnum'
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
        
        $where['is_del'] = 0;
        if ($this->input->get('cn_name')) {
            $where['like']['cn_name'] = trim($this->input->get('cn_name', TRUE));
            $data['cn_name'] = trim($this->input->get('cn_name', TRUE));
        }
        
        //状态
        if(isset($_GET['is_show'])){
            $is_show = $_GET['is_show'];
            if ($is_show === '0' || $is_show === '1') {
                $where['is_show']= $is_show;
                $data['is_show'] = $is_show;
            }
        }
        
        //分类
        $class = trim($this->input->get('class_name', TRUE));
        if(!empty($class)){
            $res = $this->Mdrinkclass->get_one('id', ['cn_name' => $class]);
            if($res){
                $where['class_id'] = $res['id'];
                $data['class_name'] = $class;
            }
        }
        
        $data['list'] = $this->Mdrink->get_lists("*", $where, array('sort' => 'desc'), $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
//         var_dump($this->db->last_query(),$data['list']);exit;
        $data_count = $this->Mdrink->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;
        
        $pageconfig['base_url'] = "/drink".http_build_query($where);
        //获取分类
        $type = $this->Mdrinkclass->get_lists('id, cn_name', array('is_del'=>0));
        $data['type'] = array_column($type, 'cn_name', 'id');

        $pageconfig['base_url'] = "/drink";
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        
        $this->load->view("drink/index", $data);
    }
    
    
    /**
     * 增加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        
        //获取分类
        $type = $this->Mdrinkclass->get_lists('id, cn_name', array('is_del'=>0));
        $data['type'] = array_column($type, 'cn_name', 'id');
        
        $list = $this->input->post();
        if($list){
            unset($list['rich_text_img']);
            $list['create_time'] = date("Y-m-d H:i:s");
            $list['update_time'] = date("Y-m-d H:i:s");
            if(empty($list['cover_img'])){
                $this->error('封面图必须上传');
            }
            if(empty($list['images'])){
                $this->error('相册必须上传');
            }
            $list['images'] = implode(',', $list['images']);
            $add = $this->Mdrink->create($list);
            if(!$add){
                $this->error('操作失败');
            }
            $this->success("添加成功！", '/drink');
            
        }
        $this->load->view("drink/add", $data);
    }
    
    
    
    
    /**
     * 删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $del = $this->Mdrink->update_info(array('is_del'=>1), $where);
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
        //获取分类
        $type = $this->Mdrinkclass->get_lists('id, cn_name', array('is_del'=>0));
        $data['type'] = array_column($type, 'cn_name', 'id');
        
        $data['info'] = $this->Mdrink->get_one('*', array('id'=>$id));
        $data['info']['images'] = explode(',', $data['info']['images']);
        $list = $this->input->post();
        if($list){
            unset($list['rich_text_img']);
            $list['update_time'] = date("Y-m-d H:i:s");
            $list['images'] = implode(',', $list['images']);
            $update = $this->Mdrink->update_info($list, array('id'=>$list['id']));
            if($update){
                $this->success("修改成功！！", '/drink');
            }
    
        }
        $this->load->view("drink/edit", $data);
    }
    

    /**
     * 上架下架
     * @author songchi@gz-zc.cn
     */
    public function show($id = 0){
        $id = intval($id);
        $is_show = $this->Mdrink->get_one('is_show', array('id'=>$id))['is_show'];
        $is_show = intval(!$is_show);
        $update = $this->Mdrink->update_info(array('is_del'=>$is_show), array('id'=>$id));
        if($update){
            $this->success('操作成功!', '/drink');
        }else{
            $this->success('操作失败!', '/drink');
        }
    }
}
