<?php 
/**
* 首页控制器
* @author yonghua@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Milancombo extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->Model([
            'Model_milan_combo' => 'Mmilancombo',
            'Model_milan_combo_service' => 'Mmilancomboservice'
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    /**
     * 婚礼套餐列表
     * @author yonghua@gz-cn.cn
     */
    public function index(){
        $data = $this->data;
        $data['title'] = ['米兰管理','婚礼套餐'];
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $data['page'] = $page;
        $size = $this->pageconfig['per_page'];
        $order_by = array('create_time' => 'desc');
        $where = [];
        $where['is_del'] = 0;
        $name = trim($this->input->get('name'));
        if(!empty($name)){
            $data['name'] = $name;
            $where['name'] = $name;
        }
        $list = $this->Mmilancombo->get_lists('*', $where, $order_by, $size, ($page-1)*$size);
        if($list){
            $data['lists'] = $list;
            $data_count = $this->Mmilancombo->count($where);
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/milancombo/index?".http_build_query($where);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $this->load->view('milancombo/index', $data);
    }
    /**
     * 套餐详情
     */
    public function detail(){
        $data = $this->data;
        $id = (int) $this->input->get('id');
        $info = $this->Mmilancombo->get_one('*', ['id' => $id, 'is_del' => 0]);
        if(!$info){
            $this->error('套餐不存在');
        }
        $data['info'] = $info;
        //获得所有包含的服务
        $list = $this->Mmilancomboservice->get_lists("id,pid,name", ['is_del' => 0,'combo_id' => $id], ['create_time' => 'asc']);
        if($list){
            $data['list'] = $this->myloop($list);
        }
        $this->load->view('milancombo/detail', $data);
    }
    
    /**
     * 婚礼套餐添加
     * @author yonghua@gz-cn.cn
     */
    public function add(){
        $data = $this->data;
        if(IS_POST){
            $add = $this->input->post();
            $add['name'] = trim($add['name']);
            $add['price'] = trim($add['price']);
            if(empty($add['name'])){
                $this->error('套餐名称不能为空');
            }
            if(empty($add['price'])){
                $this->error('套餐价格必填');
            }
            if(empty($add['cover_img'])){
                $this->error('套餐封面图必须上传');
            }
            $add['create_time'] = $add['update_time'] = date('Y-m-d H:i:s');
            $add['create_admin'] = $add['update_admin'] = $data['userInfo']['id'];
            $res = $this->Mmilancombo->create($add);
            if(!$res){
                $this->error('添加失败');
            }
            $this->success('操作成功', '/milancombo/index');
        }
        $this->load->view('milancombo/add', $data);
    }
    /**
     * 婚礼套餐编辑
     * @author yonghua@gz-cn.cn
     */
    public function edit(){
        $data = $this->data;
        if(IS_POST){
            $id = $this->input->post('id');
            $add = $this->input->post();
            unset($add['id']);
            $add['name'] = trim($add['name']);
            $add['price'] = trim($add['price']);
            if(empty($add['name'])){
                $this->error('套餐名称不能为空');
            }
            if(empty($add['price'])){
                $this->error('套餐价格必填');
            }
            if(empty($add['cover_img'])){
                $this->error('套餐封面图必须上传');
            }
            $add['update_time'] = date('Y-m-d H:i:s');
            $add['update_admin'] = $data['userInfo']['id'];
            $res = $this->Mmilancombo->update_info($add, ['id' => $id]);
            if(!$res){
                $this->error('添加失败');
            }
            $this->success('操作成功', '/milancombo/index');
        }
        $id = (int) $this->input->get('id');
        if($id === 0){
            $this->error('系统拒绝');
        }
        $info = $this->Mmilancombo->get_one("*", ['id' => $id, 'is_del' => 0]);
        if(!$info){
            $this->error('系统拒绝');
        }
        $data['info'] = $info;
        $this->load->view('milancombo/edit', $data);
    }
    
    /**
     * 婚礼套餐删除
     * @author yonghua@gz-cn.cn
     */
    public function del() {
        $data = $this->data;
        $id = (int) $this->input->get('id');
        if($id === 0){
            $this->error('系统拒绝');
        }
        $res = $this->Mmilancombo->update_info(['is_del' => 1, 'update_time'=> date('Y-m-d H:i:s'), 'update_admin' => $data['userInfo']['id']], ['id' =>$id]);
        if(!$res){
            $this->error('添加失败');
        }
        $this->success('操作成功');
    }
    
    /**
     * 婚礼套餐服务
     * @author yonghua@gz-zc.cn
     */
    public function service(){
        $data = $this->data;
        $id = (int) $this->input->get('id');
        if($id === 0){
            $this->error('系统拒绝');
        }
        $data['id'] = $id;
        $data['pid'] = $this->Mmilancomboservice->get_lists('id,name', ['combo_id' => $id,'pid'=> 0,'is_del' => 0]);
        //获得所有包含的服务
        $list = $this->Mmilancomboservice->get_lists("id,pid,name", ['is_del' => 0,'combo_id' => $id], ['create_time' => 'asc']);
        if($list){
            $data['list'] = $this->myloop($list);
        }
        $this->load->view('milancombo/service', $data);
    }
    
    /**
     * 添加婚礼服务类型
     * @author yonghua@gz-zc.cn
     */
    public function add_pid(){
        $data = $this->data;
        $add['combo_id'] = (int) $this->input->post('combo_id');
        $add['name'] = trim($this->input->post('name'));
        if($add['combo_id'] === 0){
            $this->return_json(['msg' =>'系统拒绝']);
        }
        if(empty($add['name'])){
            $this->return_json(['msg' =>'分类名称不能为空']);
        }
        $add['pid'] = 0;
        $add['create_time'] = $add['update_time'] = date('Y-m-d H:i:s');
        $res = $this->Mmilancomboservice->create($add);
        if(!$res){
            $this->return_json(['msg' =>'添加失败']);
        }
        $this->return_json(['code' =>1, 'name' => $add['name'], 'id' => $res]);
    }
    
    /**
     * 添加婚礼服务类型
     * @author yonghua@gz-zc.cn
     */
    public function add_service(){
        $data = $this->data;
        $add['combo_id'] = (int) $this->input->post('combo_id');
        $add['name'] = trim($this->input->post('name'));
        $add['pid'] = trim($this->input->post('pid'));
        if($add['combo_id'] === 0){
            $this->return_json(['msg' =>'系统拒绝']);
        }
        if(empty($add['name'])){
            $this->return_json(['msg' =>'分类名称不能为空']);
        }
        $add['create_time'] = $add['update_time'] = date('Y-m-d H:i:s');
        $res = $this->Mmilancomboservice->create($add);
        if(!$res){
            $this->return_json(['msg' =>'添加失败']);
        }
        $this->return_json(['code' =>1, 'id' => $res]);
    }
    
    /**
     * 保存套餐婚礼服务
     */
    public function update_service(){
        $data = $this->data;
        if(IS_POST){
            $id = (int) $this->input->post('id');
            $name = trim($this->input->post('name'));
            if($id === 0){
                $this->return_json(['msg' => '系统拒绝服务']);
            }
            if(empty($name)){
                $this->return_json(['msg' => '内容不能为空']);
            }
            $res = $this->Mmilancomboservice->update_info(['name' => $name], ['pid>' => 0, 'id' => $id]);
            if(!$res){
                $this->return_json(['msg' =>'更新失败']);
            }
            $this->return_json(['code' =>1]);
        }
    }
    
    /**
     * 保存套餐婚礼服务
     */
    public function update_pid_service(){
        $data = $this->data;
        if(IS_POST){
            $id = (int) $this->input->post('id');
            $name = trim($this->input->post('name'));
            if($id === 0){
                $this->return_json(['msg' => '系统拒绝服务']);
            }
            if(empty($name)){
                $this->return_json(['msg' => '内容不能为空']);
            }
            $res = $this->Mmilancomboservice->update_info(['name' => $name], ['pid' => 0, 'id' => $id]);
            if(!$res){
                $this->return_json(['msg' =>'更新失败']);
            }
            $this->return_json(['code' =>1]);
        }
    }
    
    /**
     * 删除套餐婚礼服务
     */
    public function del_service(){
        $data = $this->data;
        if(IS_POST){
            $id = (int) $this->input->post('id');
            if($id === 0){
                $this->return_json(['msg' => '系统拒绝服务']);
            }
            $res = $this->Mmilancomboservice->update_info(['is_del' => 1], ['pid>' => 0, 'id' => $id]);
            if(!$res){
                $this->return_json(['msg' =>'删除失败']);
            }
            $this->return_json(['code' =>1]);
        }
    }
    
    /**
     * 删除套餐婚礼服务
     */
    public function del_service_pid(){
        $data = $this->data;
        if(IS_POST){
            $id = (int) $this->input->post('id');
            if($id === 0){
                $this->return_json(['msg' => '系统拒绝服务']);
            }
            $ret = $this->Mmilancomboservice->count(['pid' => $id, 'is_del' => 0]);
            if($ret){
                $this->return_json(['msg' =>'该分类下还有服务的项目，请先删除当前分类下的所有服务后再进行此分类的删除']);
            }
            $res = $this->Mmilancomboservice->update_info(['is_del' => 1], ['pid' => 0, 'id' => $id]);
            if(!$res){
                $this->return_json(['msg' =>'删除失败']);
            }
            $this->return_json(['code' =>1]);
        }
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
                    unset($data['$key']);
                    $temp = $this->myloop($data,$val['id']);
                    if($temp) $val['child'] = $temp;
                    $result[] = $val;
                }
            }
        }
        return $result;
    }
}



