<?php 
/**
* 首页控制器
* @author yonghua@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Contract extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->Model([
            'Model_item_of_contract' => 'Mitem_of_contract',
            'Model_class_item_contract' => 'Mclass_item_contract',
            'Model_dinner' => 'Mdinner',
            'Model_combo' => 'Mcombo',
            'Model_dish' => 'Mdish',
                        
            'Model_dinner_extend' => 'Mdinner_extend',
            'Model_dinner_extra_service' => 'Mdinner_extra_service',
            'Model_pay_status' => 'Mpay_status',
            'Model_admins_dinner_examined' => 'Madmins_dinner_examined',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_user_coupon' => 'Muser_coupon',
            'Model_milan_combo' => 'Mmilancombo',
            'Model_consume_list' => 'Mconsume_list',
            'Model_consume_extend' => 'Mconsume_extend'
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
        $this->load->view('item_of_contract/index', $data);
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
        $list = $this->Mclass_item_contract->get_lists("id,pid,name", ['is_del' => 0,'combo_id' => $id], ['create_time' => 'asc']);
        if($list){
            $data['list'] = $this->myloop($list);
        }
        $this->load->view('item_of_contract/detail', $data);
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
        $this->load->view('item_of_contract/add', $data);
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
        $this->load->view('item_of_contract/edit', $data);
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
     * 彻底删除
     * @author chaokai@gz-zc.cn
     */
    public function thorough_del(){
        if($this->data['pur_code'] == 1){
            $this->return_failed('您没有该操作权限');
        }
        $id = intval($this->input->post('id'));

        !$id && $this->return_failed('参数错误');

        if($this->Mdinner->delete(array('id' => $id))){
            $this->return_success();
        }else{
            $this->return_failed('删除失败');
        }
    }
    
    /**
     * 婚礼套餐服务
     * @author yonghua@gz-zc.cn
     */
    public function service(){
        $data = $this->data;

        $lists = $this->Mclass_item_contract->get_lists('id,name,desc', ['is_del' => 0]);
        $lists = $lists ? array_column($lists, null, 'id') : [];

        $item_lists = $this->Mitem_of_contract->get_lists('id,name,pid,price', ['is_del' => 0]);
        foreach ($item_lists as $k => $v){
            if(isset($lists[$v['pid']]))
                $lists[$v['pid']]['child'][] = $v;
        }
        
        $data['lists'] = $lists;
        $this->load->view('item_of_contract/service', $data);
    }
    
    /**
     * 添加婚礼服务类型
     * @author yonghua@gz-zc.cn
     */
    public function add_pid(){
        $data = $this->data;
        $add['name'] = trim($this->input->post('name'));
        $add['desc'] = trim($this->input->post('desc'));

        if(empty($add['name'])){
            $this->return_json(['msg' =>'分类名称不能为空']);
        }

        $add['create_time'] = $add['update_time'] = date('Y-m-d H:i:s');
        $res = $this->Mclass_item_contract->create($add);
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

        $add['name'] = trim($this->input->post('name'));
        $add['price'] = trim($this->input->post('price'));
        $add['pid'] = intval($this->input->post('pid'));

        if(empty($add['name'])){
            $this->return_json(['msg' =>'分类名称不能为空']);
        }
        if(! is_numeric($add['price'])){
            $this->return_json(['msg' =>'请填写合法的价格']);
        }
        $add['create_time'] = $add['update_time'] = date('Y-m-d H:i:s');
        $res = $this->Mitem_of_contract->create($add);
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
            $price = trim($this->input->post('price'));
            if($id === 0){
                $this->return_json(['msg' => '系统拒绝服务']);
            }
            if(empty($name)){
                $this->return_json(['msg' => '产品名称不能为空']);
            }
            if(empty($price)){
                $this->return_json(['msg' => '价格不能为空']);
            }
            $res = $this->Mitem_of_contract->update_info(['name' => $name, 'price' => $price], ['id' => $id]);
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
            $desc = trim($this->input->post('desc'));
            if($id === 0){
                $this->return_json(['msg' => '系统拒绝服务']);
            }
            if(empty($name)){
                $this->return_json(['msg' => '内容不能为空']);
            }
            if(empty($desc)){
                $this->return_json(['msg' => '介绍不能为空']);
            }
            $res = $this->Mclass_item_contract->update_info(['name' => $name, 'desc' => $desc], ['id' => $id]);
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
            $res = $this->Mitem_of_contract->update_info(['is_del' => 1], ['id' => $id]);
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
            $ret = $this->Mitem_of_contract->count(['pid' => $id, 'is_del' => 0]);
            if($ret){
                $this->return_json(['msg' =>'该分类下还有服务的项目，请先删除当前分类下的所有服务后再进行此分类的删除']);
            }
            $res = $this->Mclass_item_contract->update_info(['is_del' => 1], ['id' => $id]);
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

    /**
     * 未审核合同管理
     * @author fengyi@gz-zc.cn
     */
    public function not_audit_contract() {
        $data = $this->data;
        $data['title'] = array('首页', '合同管理', '合同列表');
        $page =  intval(trim($this->input->get("per_page", true))) ? : 1;
        $size = $this->pageconfig['per_page'];
        $where = array(
                        'in' => array('is_examined' => [C('dinner.examine.not.id'),  C('dinner.examine.backend_add.id')]),
                        //'is_examined' => C('dinner.examine.not.id'),
                        'contract_type' => 0,
                        'is_del' => 0,
        );
        $order_by = array('solar_time' => 'asc');
        $query_data = [];

        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in'] = array('id' => $ids);
            
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }

        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $where['solar_time'] = $create_time;
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        
        if($name || $mobile){
	    $data['name'] = isset($name) && $name ? $name : '';
	    $data['mobile'] = isset($mobile) && $mobile ? $mobile : '';
            //$data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['in' => array('is_examined' => [C('dinner.examine.not.id'), C('dinner.examine.to_recheck.id')])]);
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['is_examined' => C('dinner.examine.not.id')]);
        }else{
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
        }

        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
    
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }
    
            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/contract/not_audit_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	    if(!$name && !$mobile){
                $data['pagestr'] = $this->pagination->create_links(); // 分页信息
            }
        }
    
        $data['query_data'] = http_build_query($query_data);
    
        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');


        $this->load->view("contract/lists", $data);
    }
    
    /**
     * 待复审合同
     * @author fengyi@gz-zc.cn
     */
    public function to_recheck_contract() {
        $data = $this->data;
        $data['title'] = array('首页', '合同管理', '合同列表');
        $page =  intval(trim($this->input->get("per_page", true))) ? : 1;
        $size = $this->pageconfig['per_page'];
        $where = array(
            'is_examined' => C('dinner.examine.to_recheck.id'),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $order_by = array('solar_time' => 'asc');
        $query_data = [];

        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in'] = array('id' => $ids);
            
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }

        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $where['solar_time'] = $create_time;
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        
        if($name || $mobile){
	    $data['name'] = isset($name) && $name ? $name : '';
	    $data['mobile'] = isset($mobile) && $mobile ? $mobile : '';
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['is_examined' =>  C('dinner.examine.to_recheck.id')]);
            
        }else{
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
        }

        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
    
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }
    
            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/contract/to_recheck_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	    if(!$name && !$mobile){
                $data['pagestr'] = $this->pagination->create_links(); // 分页信息
            }
        }
    
        $data['query_data'] = http_build_query($query_data);
    
        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');


        $this->load->view("contract/lists", $data);
    }
    
    /**
     * 待归档合同管理
     * @author fengyi@gz-zc.cn
     */
    public function not_archive_contract() {
        $data = $this->data;
        $data['title'] = array('首页', '合同管理', '合同列表');
        $page =  intval(trim($this->input->get("per_page", true))) ? : 1;
        $size = $this->pageconfig['per_page'];
        $where = array(
            'is_examined' => C('dinner.examine.to_archive.id'),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $order_by = array('solar_time' => 'asc');
        $query_data = [];
         
        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in'] = array('id' => $ids);
            
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }

        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $where['solar_time'] = $create_time;
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }

        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        
        if($name || $mobile){
	    $data['name'] = isset($name) && $name ? $name : '';
            $data['mobile'] = isset($mobile) && $mobile ? $mobile : '';
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['is_examined' => C('dinner.examine.to_archive.id')]);
        }else{
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
        }
        
        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
    
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }
    
            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/contract/not_archive_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	    if(!$name && !$mobile){
		$data['pagestr'] = $this->pagination->create_links(); // 分页信息
	    }
        }
    
        $data['query_data'] = http_build_query($query_data);

        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');
        
        $this->load->view("contract/lists", $data);
    
    }
    /**
     * 已归档合同管理
     * @author fengyi@gz-zc.cn
     */
    public function archived_contract() {
        $data = $this->data;
        $data['title'] = array('首页', '合同管理', '合同列表');
        $page =  intval(trim($this->input->get("per_page", true))) ? : 1;
        $size = $this->pageconfig['per_page'];
        $where = array(
            //'in' => array('is_examined' => [C('dinner.examine.archived.id'), C('dinner.examine.backend_add.id')]),
            'is_examined' => C('dinner.examine.archived.id'),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $order_by = array('solar_time' => 'asc');
        $query_data = [];
         
        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in']['id'] = $ids;
            
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }

        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $where['solar_time'] = $create_time;
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        
        if($name || $mobile){
	    $data['name'] = isset($name) && $name ? $name : '';
            $data['mobile'] = isset($mobile) && $mobile ? $mobile : '';
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['in' => array('is_examined' => [C('dinner.examine.archived.id'), C('dinner.examine.backend_add.id')])]);
        }else{
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
        }
        

        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
    
        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
    
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }
    
            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/contract/archived_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	    if(!$name && !$mobile){
                $data['pagestr'] = $this->pagination->create_links(); // 分页信息
            }
        }
    
        $data['query_data'] = http_build_query($query_data);
    
        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');
        
        $this->load->view("contract/lists", $data);
    
    }
    
    /**
     * 已审核合同管理
     * @author fengyi@gz-zc.cn
     */
    public function audit_contract() {
        $data = $this->data;
        $data['title'] = array('首页', '合同管理', '合同列表');
        $page =  intval(trim($this->input->get("per_page", true))) ? : 1;
        $size = $this->pageconfig['per_page'];
        $where = array(
            'in' => array(
                'is_examined' => [C('dinner.examine.failure.id'), C('dinner.examine.to_archive.id')]
            ),
            'contract_type' => 0,
            'is_del' => 0,
        );
        $order_by = array('solar_time' => 'asc');
        $query_data = [];
         
        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in']['id'] = $ids;
            
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }

        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $where['solar_time'] = $create_time;
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        //审核时间搜索
        $examine_time = $this->input->get('examine_time');
        if(!empty($examine_time)){
            $where['examine_time like'] = $examine_time.'%';
            $query_data['examine_time'] = $data['examine_time'] = $examine_time;
        }

        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        
        if($name || $mobile){
	    $data['name'] = isset($name) && $name ? $name : '';
            $data['mobile'] = isset($mobile) && $mobile ? $mobile : '';
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['in' => array('is_examined' => [C('dinner.examine.failure.id'), C('dinner.examine.to_archive.id')])]);
        }else{
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
        }
        
        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
    
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }
    
            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/contract/audit_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	    if(!$name && !$mobile){
                $data['pagestr'] = $this->pagination->create_links(); // 分页信息
            }

        }
    
        $data['query_data'] = http_build_query($query_data);
    
        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');
        
        $this->load->view("contract/audit_contract", $data);
    }
    
    /**
     * 合同预览
     * @author louhang@gz-zc.cn
     */
    public function contract_display($id = 0){
        $data = $this->data;
    
        $dinner_id = (int)$this->input->get('id');
        if ($id) {
            $dinner_id = (int)$id;
        }
    
        //宴会类型
        $data['party_type'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        //套餐菜品
        $data['combo_menus'] = $this->Mcombo->lists();
    
        //附加项目列表
        $lists = $this->Mclass_item_contract->get_lists('id,name,desc', ['is_del' => 0]);
        $lists = $lists ? array_column($lists, null, 'id') : [];
        $item_lists = $this->Mitem_of_contract->get_lists('id,name,pid,price', ['is_del' => 0]);
        foreach ($item_lists as $k => $v){
            if(isset($lists[$v['pid']]))
                $lists[$v['pid']]['child'][] = $v;
        }
        $data['lists'] = $lists;
    
        $dinner = $this->Mdinner->get_one('*', ['id' => $dinner_id]);
        $dinner_detail = $this->Mdinner->info($dinner_id);
        $dinner['name'] = $dinner_detail['user']['name'];
        $dinner['venue_ids'] = $dinner_detail['venue_ids'];
         
        $dinner['menus_id'] = isset($dinner_detail['detail']['menus_id']) ? $dinner_detail['detail']['menus_id'] : '0';
        $dinner['mobile_phone'] = $dinner_detail['user']['mobile_phone'];
        $dinner['deposit_daxie'] = convert_money($dinner['deposit']);
        $dinner['lunar_time'] = solar_to_lunar($dinner['solar_time']);
    
        $lunar_time = solar_to_lunar($dinner['solar_time']);
        $dinner['lunar_time'] = $lunar_time['lunar_time'];
    
        $week = array('日', '一', '二', '三', '四', '五', '六');
        $dinner['week'] =  '星期'. $week[date('w', strtotime($dinner['solar_time']))];
        $data['dinner'] = $dinner;
    
        $dinner_extend = $this->Mdinner_extend->get_lists('*', ['dinner_id' => $dinner_id, 'is_del' => 0]);
        $dinner_extend = $dinner_extend ? array_column($dinner_extend, null, 'type') : [];
        $data['dinner_extend'] = $dinner_extend;
    
        $dinner_extra_service = $this->Mdinner_extra_service->get_lists('*', ['dinner_id' => $dinner_id, 'is_del' => 0]);
        $dinner_extra_service = $dinner_extra_service ? array_column($dinner_extra_service, 'service_id') : [];
        $data['dinner_extra_service'] = $dinner_extra_service;
    
        $combo = $this->get_combo($dinner['menus_id'], true);
        $data['combo'] = $combo;
        
        //优惠券
        $data['coupon'] = $this->Muser_coupon->get_lists('*', ['dinner_id' => $dinner_id, 'is_del' => 0]);

        $this->load->view('contract/display', $data);
      
    
    }
    
    /**
     * 获取菜品信息
     * @author louhang@gz-zc.cn
     */
    public function get_combo($id = 0, $inner_call = false){
        $combo_id = (int)$this->input->get('id');
    
        //控制器调用
        if ($id) {
            $combo_id = (int)$id;
        }
    
        $combo = $this->Mcombo->get_one('*', array('id' => $combo_id, 'is_del' => 0));
        $data['price'] = $combo ? $combo['price'] : 0;
        $data['name'] = $combo ? $combo['combo_name'] : '';
    
        $dish_ids = $combo ? explode(',', $combo['relevance_id']) : '';
        $dishes = $this->Mdish->get_lists('name, price', array('in' => array('id' => $dish_ids), 'is_del' => 0));
        $data['dishes'] = $dishes ;
    
        $sum = 0;
        foreach ($dishes as $k => $v) {
            $sum += $v['price'];
        }
    
        $data['old_price'] = $sum;
        $data['favorable'] = sprintf('%.2f', $sum-$data['price']);
    
        //内部控制器调用
        if ($inner_call) {
            return $data;
        }
    
        $this->return_success($data, 'success');
    }
    
    /**
     * 获取归档页面
     * @author fengyi@gz-zc.cn
     */
    public function get_contract_archive_html() {
        $data = $this->data;
    
        //获取支付方式
        $pay_type = C('order.pay_type');
        $data['pay_type'] = $pay_type;
    
        //获取可用的代金券
        $dinner_id = intval($this->input->get('id'));  
        $field = 'id,number,money';
        $where = [
            'dinner_id' => $dinner_id,
   	    'is_del' => 0
            //'status' => C('coupon.status.no_use.id'),
            //todo 添加也过期代金券过滤
        ];
        $lists = $this->Muser_coupon->get_lists($field, $where);
        $data['lists'] = $lists;
    
        $this->load->view('contract/contract_archive_html', $data);
    }

    /**
     * 异常订单管理
     * @author fengyi@gz-zc.cn
     */
    public function unusual_contract() {
        $data = $this->data;
        $data['title'] = array('首页', '合同管理', '异常合同列表');

        $query_data = [];

        $page = intval( trim( $this->input->get('per_page', true) ) ) ?: 1;
        $size = $this->pageconfig['per_page'];

        $where = [];
        $in = [];
        # 订单未打印搜索
        $order_exception =  $this->input->get('order_exception');
        if (!empty($order_exception)) {
            $where['is_del'] = $order_exception;
            $query_data['is_del'] = $order_exception;
        } else {
            $where['is_del <>'] = 0 ; # 默认取出所有异常
        }
        $where_del = [ C('dinner.is_del.delete.id'),
            C('dinner.is_del.unusual.id'),
            C('dinner.is_del.return.id'),
            C('dinner.is_del.other.id') ];
        $in['is_del'] = $where_del;

        //搜索
        $data['venue_id'] = '';
        $venue_id = trim( $this->input->get('venue_id') );
        if ($venue_id) {
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id] );
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            if ($ids) {
                $in['id'] = $ids;
            }
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }
        $create_time = trim($this->input->get('create_time'));
        if ($create_time) {
            $where['solar_time like'] = "$create_time%";
            $query_data['create_time'] = $data['create_time'] = $create_time;  
        }
        //异常时间
        $unusual_time = $this->input->get('unusual_time');
        if($unusual_time){
            $where['unusual_time like'] = "$unusual_time%";
            $query_data['unusual_time'] = $data['unusual_time'] = $unusual_time;
        }

        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        if ($name || $mobile) {
            $data['name'] = ( isset($name) && $name ) ? $name : '';
            $data['mobile'] = ( isset($mobile) && $mobile ) ? $mobile : '';
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['in' => ['is_del' => $where_del]]);
        } else {
            $where['in'] = $in;
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, ['solar_time' => 'desc'], $size, ($page-1)*$size);
        }

        //场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $venue = $venue ? array_column($venue, 'name', 'id') : [];
        $data['venue'] = $venue; 
        
        if ($data['list']) {
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');

            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }

            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;

            $this->pageconfig['base_url'] = "/contract/unusual_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	        if (!$name && !$mobile) {
		        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
	        }
        }
    
        $data['query_data'] = http_build_query($query_data);

        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');

        $data['is_unusual'] = true;       
        $is_del = C('dinner.is_del');
        $data['order_exception'] = $is_del;
        $data['is_del'] = array_column($is_del, 'name', 'id'); 

        $this->load->view("contract/unusual", $data);
    }
    
    /**
     * 预留订单管理
     * @author fengyi@gz-zc.cn
     */
    public function reserved_contract() {
         $data = $this->data;
        $data['title'] = array('首页', '订单管理', '预留订单');
        $page =  intval(trim($this->input->get("per_page", true))) ? : 1;
        $size = $this->pageconfig['per_page'];
        $where = array(
            'contract_type' => 1,
            'is_del' => 0,
        );
        $order_by = array('solar_time' => 'asc');
        $query_data = [];
         
        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $ids = $this->Mdinner_venue->get_lists('dinner_id', ['venue_id' => $venue_id]);
            $ids = $ids ? array_column($ids, 'dinner_id') : [];
            $where['in']['id'] = $ids;
            
            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }

        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $where['solar_time'] = $create_time;
            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        //审核时间搜索
        $examine_time = $this->input->get('examine_time');
        if(!empty($examine_time)){
            $where['examine_time like'] = $examine_time.'%';
            $query_data['examine_time'] = $data['examine_time'] = $examine_time;
        }

        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile'));
        
        if($name || $mobile){
	        $data['name'] = isset($name) && $name ? $name : '';
            $data['mobile'] = isset($mobile) && $mobile ? $mobile : '';
            $data['list'] = $this->Mdinner->search_dinner_list($name, $mobile, ['in' => array('is_examined' => [C('dinner.examine.failure.id'), C('dinner.examine.to_archive.id')])]);
        }else{
            if(!$create_time){
                //如果不按时间搜索 则默认获取大于等于今天时间的订单
                $where['solar_time>='] = date("Y-m-d", time());
            }
            $data['list'] = $this->Mdinner->get_dinner_list_examined($where, $order_by, $size, ($page-1)*$size);
        }
        
        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        if($data['list']){
            $create_admins = array_column($data['list'] , 'create_admin', 'id');
            $create_admins = $this->Madmins->get_lists('id, fullname', array('in' => array('id' => $create_admins)));
            $create_admins = array_column($create_admins , 'fullname', 'id');
    
            foreach ($data['list'] as $key => $val){
                if(isset($data['list'][$key]['create_admin'])){
                    $data['list'][$key]['create_admin'] = $create_admins[$val['create_admin']];
                }
            }
    
            $data_count = $this->Mdinner->count($where);
            if($name || $mobile){
                $data_count = count($data['list']);
            }
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/contract/reserved_contract?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
	    if(!$name && !$mobile){
                $data['pagestr'] = $this->pagination->create_links(); // 分页信息
            }

        }
    
        $data['query_data'] = http_build_query($query_data);
    
        $color_name = C('dinner.examine');
        $data['color_name'] = array_column($color_name, 'color_name', 'id');
        
        $this->load->view("contract/reserved_contract", $data);
    }

}
