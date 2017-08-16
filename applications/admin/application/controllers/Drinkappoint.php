<?php 
    /**
    * 预定列表控制器
    * @author yonghua@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Drinkappoint extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_drink_appoint_order' => 'Mdrinkappointorder',
                'Model_drink' => 'Mdrink',
                'Model_drink_class' => 'Mdrinkclass',
               'Model_user' => 'Muser',
            'Model_products' => 'Mproducts',
            'Model_specifications' => 'Mspecifications'
        ]);
        $this->data['user_info']['id'] = 40;
    }
    
    
    /**
    * 预定列表首页
    * @author yonghua@gz-zc.cn
    */
    public function index(){
        $data = $this->data;
        $data['title'] = array('酒水预定','列表');
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['order_num'] = trim($this->input->get('order_num', TRUE)); 
        $data['user_name'] = trim($this->input->get('user_name', TRUE));
        $data['user_mobile'] = trim($this->input->get('user_mobile', TRUE));
        $data['page'] = $page;
        
        $is_del = $this->input->get('is_del');
        if(isset($is_del) && $is_del){
            $where['is_del'] = 1;
            $data['is_del'] = 1;
        }else{
            $where['is_del'] = 0;
            $data['is_del'] = 0;
        }
        
        if(!empty($data['order_num'])){
            $where['order_num'] = $data['order_num'];
        }
        if(!empty($data['user_mobile'])){
            $where['user_mobile'] = $data['user_mobile'];
        }
        if(!empty($data['user_name'])){           
            $where['user_name'] = $data['user_name'];
        }
        
        $list = $this->Mdrinkappointorder->get_lists('*', $where, ['create_time' => 'desc'], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        //获取规格
        $special_id = array_unique(array_column($list, 'special_id'));
        $special = array();
        foreach ($special_id as $k=>$v){
            if($v){
                $special[$k] = $v;
            }
        }
        
        if($special){
            $special_name = $this->Mspecifications->get_lists('id, version_name', array('in'=>array('id'=>$special)));
            $data['special_name'] = array_column($special_name, 'version_name', 'id');
        }
        
        $user = $this->Muser->get_lists("id,realname,mobile_phone");
        if($list && $user){
            // 分页信息
            $data['count'] = $this->Mdrinkappointorder->count($where);
            $pageconfig['base_url'] = "/drinkappoint?".http_build_query($where);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); 
            
            $data['list'] = $list;
            foreach ($list as $k => $v){
                if($v['cover_img']){
                    $data['list'][$k]['cover_img'] = get_img_url($v['cover_img']);
                }
            }
        }
        $this->load->view('drinkappoint/index', $data);
    }
    
    /**
    * 手动添加
    * @author yonghua@gz-zc.cn
    */
    public function add(){
        $data = $this->data;
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        if(IS_POST){
            $add = $this->input->post();
            //查询商品信息
            $drink_field = 'title, cover_img, present_price';
            $info = $this->Mproducts->get_one($drink_field, array('is_del'=>0, 'id'=>$add['drink_id']));
            if(!$info){
                $this->error('操作失败');
            }
            
            if($add['special_id']){
                $price = $this->Mspecifications->get_one('version_price', array('id'=>$add['special_id']));
                $add['price'] = $price['version_price']*$add['num'];
                $add['unit_price'] = $price['version_price'];
            }else{
                $add['price'] = $info['present_price']*$add['num'];
                $add['unit_price'] = $info['present_price'];
            }
            
            $add['drink_title'] = $info['title'];
            $add['cover_img'] = $info['cover_img'];
            $add['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
            $add['create_time'] = date('Y-m-d H:i:s');
            unset($add['class_id']);
            $res = $this->Mdrinkappointorder->create($add);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('提交成功', '/drinkappoint');
        }
        $this->load->view('drinkappoint/add', $data);
    }
    
   
    /**
     * 订单删除和状态恢复
     * yonghua@gz-zc.cn
     */
    public function change(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('未知错误');
        }
        $id = (int) $this->input->post('id',TRUE);
        $k = (int) $this->input->post('k',TRUE);
        $field = trim($this->input->post('field', TRUE));
        $res = $this->Mdrinkappointorder->update_info([$field => $k], ['id' => $id]);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    
    public function erji(){
        $data = $this->data;
        $class_id = $this->input->get('class_id', TRUE);
        $list = $this->Mproducts->get_lists('id, title', array('is_del'=>0, 'class_id'=>$class_id));
        if(!$list){
            $this->return_json(['code' => 0]);
        }
        $this->return_json(['code' => 1, 'arr' => $list]);
    }
    
    public function special(){
        $data = $this->data;
        $products_id = $this->input->get('products_id', TRUE);
        $list = $this->Mspecifications->get_lists('*', array('products_id'=>$products_id));
        if(!$list){
            $this->return_json(['code' => 0]);
        }
        $this->return_json(['code' => 1, 'arr' => $list]);
    }
    
    /**
     * 编辑预定订单
     */
    public function edit(){
        $data = $this->data;
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        $id = (int) $this->input->get('id',TRUE);
        if(empty($id)){
            redirect($data['domain']['admin']['url'].'/drinkappoint');
        }
        $data['info'] = $this->Mdrinkappointorder->get_one('*',['id' => $id]);
        $class_id = $this->Mproducts->get_one('class_id', array('id'=>$data['info']['drink_id']));
        $data['class_id'] = $class_id['class_id'];
        $data['products_lists'] = $this->Mproducts->get_lists('id, title', array('class_id'=>$class_id['class_id']));
        $data['special_lists'] = $this->Mspecifications->get_lists('*', array('products_id'=>$data['info']['drink_id']));
        if(IS_POST){
            $up = $this->input->post();
            $products_id = $up['products_id'];
            unset($up['products_id']);
            unset($up['class_id']);
            $drink_field = 'title, cover_img, present_price';
            $info = $this->Mproducts->get_one($drink_field, array('is_del'=>0, 'id'=>$up['drink_id']));
            
            
            if($up['special_id']){
                $price = $this->Mspecifications->get_one('version_price', array('id'=>$up['special_id']));
                $up['price'] = $price['version_price']*$up['num'];
                $up['unit_price'] = $price['version_price'];
            }else{
                $up['price'] = $info['present_price']*$up['num'];
                $up['unit_price'] = $info['present_price'];
            }
            
            $up['drink_title'] = $info['title'];
            $up['update_time'] = date('Y-m-d H:i:s');
            $up['cover_img'] = $info['cover_img'];
            $res = $this->Mdrinkappointorder->update_info($up, ['id' => $products_id]);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('编辑成功', '/drinkappoint');
        }
        
        $this->load->view('drinkappoint/edit', $data);
    }
}




