<?php 
    /**
    * 手机端菜单管理
    * @author yonghua@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Wapmenus extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_wap_urls' => 'Mwap_urls'
        ]);
    }
    
    /**
     * 首页
     */
    public function index(){
        $data = $this->data;
        $list = $this->Mwap_urls->get_lists('*', ['is_del' => 0], ['sort' => 'desc']);
        if($list){
            $data['list'] = $this->myloop($list);
        }
        $this->load->view('wapmenus/index', $data);
    }
    
    public function add(){
        $data= $this->data;
        if(IS_POST){
            $add = $this->input->post();
            if(!isset($add['title'])){
                $this->error('菜单名称不能为空');
            }
            if(!isset($add['url'])){
                $this->error('url不能为空');
            }
            $add['title'] = trim($add['title']);
            $add['url'] = trim($add['url']);
            $res = $this->Mwap_urls->create($add);
            if(!$res){
                $this->error('添加失败！');
            }
            $this->success('操作成功', '/wapmenus/index');
        }
        $list = $this->Mwap_urls->get_lists('id,title', ['is_del' => 0, 'pid' => 0], ['sort' => 'desc']);
        if($list){
            $data['list'] = $list;
        }
        $this->load->view('wapmenus/add', $data);
    }
    
    public function edit(){
        $data= $this->data;
        if(IS_POST){
            $up = $this->input->post();
            $id = (int) $this->input->post('id');
            unset($up['id']);
            if(!isset($up['title'])){
                $this->error('菜单名称不能为空');
            }
            if(!isset($up['url'])){
                $this->error('url不能为空');
            }
            $up['title'] = trim($up['title']);
            $up['url'] = trim($up['url']);
            $res = $this->Mwap_urls->update_info($up, ['id' => $id]);
            if(!$res){
                $this->error('保存失败！');
            }
            $this->success('操作成功', '/wapmenus/index');
        }
        $id = (int) $this->input->get('id');
        $data['parent'] = $this->Mwap_urls->get_lists('id,title', ['is_del' => 0, 'pid' => 0], ['sort' => 'desc']);
        $info = $this->Mwap_urls->get_one('*', ['is_del' => 0, 'id' => $id]);
        if($info){
            $data['info'] = $info;
        }
        $this->load->view('wapmenus/edit', $data);
    }
    
    public function del(){
        $id = (int) $this->input->get('id');
        if($id){
            $res = $this->Mwap_urls->update_info(['is_del' => 1], ['id' => $id]);
            if(!$res){
                $this->error('删除失败！');
            }
            $this->success('操作成功');
        }
        $this->error('操作失败！');
    }
    
    public function change(){
        $id = (int) $this->input->get('id');
        $status = (int) $this->input->get('status');
        if($id){
            $res = $this->Mwap_urls->update_info(['is_show' => $status], ['id' => $id]);
            if(!$res){
                $this->error('操作失败！');
            }
            $this->success('操作成功');
        }
        $this->error('操作失败！');
    }
    
    /**
     * 递归处理婚礼的类别所包含的内容
     * @author yonghua@gz-zc.cn
     */
    public function myloop($data,$parent=0){
    
        $result = array();
        if($data)
        {
            foreach($data as $key=>$val)
            {
                if($val['pid']==$parent)
                {
                    $temp = $this->myloop($data,$val['id']);
                    if($temp) $val['child'] = $temp;
                    $result[] = $val;
                }
            }
        }
        return $result;
    }
}