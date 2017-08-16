<?php 
    /**
    * 版本号控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Version extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_version' => 'Mversion',
               'Model_admins' => 'Madmins',
        ]);
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $data['list'] = $this->Mversion->get_lists();
        $this->load->view("version/index", $data);
    }
    
    
    /**
     * 刷新版本号
     * @author songchi@gz-zc.cn
     */
    public function refresh($id){
        $data = $this->data;
        $info['js_version_id'] = $info['css_version_id'] = date("Ymdhis");;
        $info['update_time'] = date("Y-m-d h:i:s");
        $where['id'] = $id;
        $update = $this->Mversion->update_info($info, $where);
        if($update){
            $this->success('刷新成功');
        }else{
            $this->success('刷新失败');
        }
    }
    
    
    /**
     * 添加版本号
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        $info = $this->input->post();
        if($info){
            $info['web_type'] = trim($this->input->post('web_type',  TRUE));
            if(empty($info['web_type'])){
                $this->error('名称不能为空！');
                exit();
            }
            if($this->check_type_exists($info['web_type'])){
                $this->error('已经存在的名称，请重新填写！');
                exit();
            }
            $info['js_version_id'] = $info['css_version_id'] = date("Ymdhis");
            $info['create_time'] = date("Y-m-d h:i:s");
            $info['update_time'] = date("Y-m-d h:i:s");
            $add = $this->Mversion->create($info);
            if($add){
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }
        $this->load->view("version/add", $data);
    }
    
    
    
    /**
     * 版本号删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $del = $this->Mversion->delete($where);
        if($del){
            $this->success("操作成功！！");
        }
    }
    
    /**
     * 版本号的类型的是否存在
     * @param string $type 版本号类型
     * @return boolean
     */
    public function check_type_exists($type='')
    {
        $res = $this->Mversion->get_one("id", ['web_type' => $type]);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}

