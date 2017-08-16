<?php 
/**
* 酒水订单控制器
* @author yonghua@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Drinkorder extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_drink_order' => 'Mdrinkorder',
            'Model_dinner' => 'Mdinner',
            'Model_venue' => 'Mvenue',
            'Model_admins' => 'Madmins',
            'Model_drink_class' => 'Mdrinkclass',
            'Model_drink' => 'Mdrink',
            'Model_drink_order_detail' => 'Mdrinkorderdetail',
            'Model_products' => 'Mproducts',
            'Model_specifications' => 'Mspecifications',
            'Model_menu' => 'Mmenu',
            'Model_user' => 'Muser',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_products' => 'Mproducts',
            'Model_specifications' => 'Mspecifications',
            'Model_order' => 'Morder',
            'Model_order_addr' => 'Morderaddr'
        ]);
        $this->load->library('form_validation');
    }
    /**
     * 订单列表
     * @author yonghua@gz-zc.cn
     */
    public function index() {
        $data = $this->data;
        $data['title'] = array('酒水订单', '列表');
        $field = 'id,order_num,order_man,man_phone,order_type,bargain_money,place_id,status,create_admin,receptionist,g_time,create_time,is_del';
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['order_num'] = trim($this->input->get('order_num', TRUE));
        $data['order_man'] = trim($this->input->get('order_man', TRUE));
        $data['man_phone'] = trim($this->input->get('man_phone', TRUE));
        $data['page'] = $page;
        $where['is_del'] = 0;
        
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
        if(!empty($data['man_phone'])){
            $where['man_phone'] = $data['man_phone'];
        }
        if(!empty($data['order_man'])){
            $where['like'] = array('order_man'=>$data['order_man']);
        }
        $list = $this->Mdrinkorder->get_lists($field, $where, ['g_time' => 'desc'], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        $admin = $this->Madmins->get_lists('id,name');
        $venue = $this->Mvenue->get_lists('id,name',['is_del' => 0]);
        if($list){
            // 分页信息
            $data['count'] = $this->Mdrinkorder->count($where);
            $pageconfig['base_url'] = "/drinkorder?".http_build_query($where);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
            
            $data['list'] = $list;
            foreach ($list as $k => $v){
                foreach ($admin as $kk => $vv){
                    if($v['create_admin'] == $vv['id']){
                        $data['list'][$k]['create_admin'] = $vv['name'];
                    }
                }
                
                foreach ($venue as $kk => $vv){
                    $place_ids = explode(',', $v['place_id']);
                    //var_dump($place_ids);exit;
                    foreach ($place_ids as $key => $value){
                        if($value == $vv['id']){
                            $data['list'][$k]['place_name'][] = $vv['name'];
                        }
                    }
                }
            }
        }
        
        $this->load->view('drinkorder/index', $data);
    }
    
    
    public function add_jump(){
        $data = $this->data;
        $data['title'] = array('订单列表', '订单搜索');
    
        $this->load->view('drinkorder/add_jump', $data);
    }
    
    
    public function search_list(){
        $data= $this->data;
        $data['title'] = array('订单列表', '搜索列表');
        $this->load->helper('date');
    
        $time = $this->input->get('time');
        $name = trim($this->input->get('name'));
        $mobile = trim($this->input->get('mobile_phone'));
    
        if($name || $mobile || $time){
            $data['list'] = $this->Mmenu->search_dinner_list($time, $name, $mobile);
    
            $data['data_count'] = $data['list'] ? count($data['list']) : 0;
        }
    
        $this->load->view('drinkorder/search_list', $data);
    }
    
    
    
    public function dinner_detail($id = 0){
        $data = $this->data;
        !$id && show_404();
    
        $info = $this->Mdinner->info($id);
        !$info && show_404();
        //场馆
        $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $info['venue_ids'])));
        $venue_name = '';
        foreach ($venue as $v){
            $venue_name .= $v['name'].';';
        }
        $info['venue_name'] = $venue_name;
        //宴会类型
        $dinnertype = array_column(C('party'), 'name', 'id');
        $info['venue_type_name'] = $dinnertype[$info['venue_type']];
    
        $data = $this->data;
        $data['info'] = $info;
        $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $data['info']['create_admin']));
        $data['info']['create_admin'] = isset($admin_name['fullname']) && $admin_name['fullname'] ? $admin_name['fullname'] : ' ';
    
        $data['title'] = array(
            ['url' => '/common', 'text' => '首页'],
            ['url' => $_SERVER['HTTP_REFERER'], 'text' => '订单列表'],
            ['url' => '', 'text' => '预约详情']
        );
        $this->load->view('drinkorder/dinner_detail', $data);
    }
    
    
    
    public function add($id = 0){
        $data = $this->data;
        $id = intval($id);
        !$id && show_404();
        $data['id'] = $id;
        $dinner = $this->Mdinner->info($id);
        $dinnertype = array_column(C('party'), 'name', 'id');
        $dinner['venue_type_name'] = $dinnertype[$dinner['venue_type']];
    
        if($dinner){
            $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $dinner['venue_ids'])));
            $venue_name = '';
            foreach ($venue as $v){
                $venue_name .= $v['name'].';';
            }
            $dinner['venue_name'] = $venue_name;
        }
    
        $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $dinner['create_admin']));
        $dinner['create_admin'] = isset($admin_name['fullname']) && $admin_name['fullname'] ? $admin_name['fullname'] : ' ';
        
        $data['dinner'] = $dinner;
        $data['title'] = array(
            ['url' => '/common', 'text' => '首页'],
            ['url' => $_SERVER['HTTP_REFERER'], 'text' => '订单列表'],
            ['url' => '', 'text' => '详情']
        );
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        
        $this->load->view('drinkorder/add_detail', $data);
    }

    
    /**
     * 编辑订单
     * yonghua@gz-zc.cn
     */
        public function edit(){
            $data = $this->data;
            $data['drink_class'] = C('products.drinks_class');
            $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
            $data['title'] = ['酒水列表','编辑'];
            $id = $this->input->get('id', TRUE);
            
            $info = $this->Mdrinkorder->get_one("*", ['id' => $id]);
            $data['info'] = $info;
            
            $dinner = $this->Mdinner->info($info['dinner_id']);
            $dinnertype = array_column(C('party'), 'name', 'id');
            $dinner['venue_type_name'] = $dinnertype[$dinner['venue_type']];
            
            if($dinner){
                $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $dinner['venue_ids'])));
                $venue_name = '';
                foreach ($venue as $v){
                    $venue_name .= $v['name'].';';
                }
                $dinner['venue_name'] = $venue_name;
            }
            
            $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $dinner['create_admin']));
            $dinner['create_admin'] = isset($admin_name['fullname']) && $admin_name['fullname'] ? $admin_name['fullname'] : ' ';
            
            $data['dinner'] = $dinner;
            
            $list = $this->Mdrinkorderdetail->get_lists('*', ['order_id' => $id, 'is_del' => 0]);
            $data['list'] = $list;
            $special_id = array_unique(array_column($list, 'special_id'));
            $special = array();
            foreach ($special_id as $k=>$v){
                if($v){
                    $special[$k] = $v;
                }
            }
            if($special){
                $special_name = $this->Mspecifications->get_lists('*', array('in'=>array('id'=>$special)));
                $special_name = array_column($special_name, 'version_name', 'id');
                $data['special_name'] = $special_name;
            }
            $this->load->view('drinkorder/edit', $data);
        }
    
    
    
    
    /**
     * 修改客户信息
     * yonghua@gz-zc.cn
     */
    public function edit_man(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('请先登陆');
        }
        if(IS_POST){
            $id = (int) $this->input->post('id', TRUE);
            $add['order_man'] = trim($this->input->post('order_man', TRUE));
            $add['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $add['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $add['create_admin'] = $data['userInfo']['id'];
            $res = $this->Mdrinkorder->update_info($add, ['id' => $id]);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败' ]);
            }
            $this->return_json(['code' => 1, 'id' => $res]);
        }
    }
    
    /**
     * 提交订单信息
     * yonghua@gz-zc.cn
     */
    public function addorderinfo(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        if(IS_POST){
            $updata = $this->input->post();
            $updata['id']= (int) $this->input->post('id', TRUE);
            $updata['order_man'] = trim($this->input->post('order_man', TRUE));
            $updata['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $updata['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $updata['create_admin'] = $data['userInfo']['id'];          
            $updata['place_id'] = implode(',', $updata['place_id']);
            $updata['bargain_money'] = $this->input->post('bargain_money', TRUE);
            $updata['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
            $updata['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdrinkorder->create($updata);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败']);
            }
            $this->return_json(['code' => 1, 'id' => $res, 'order_num' => $updata['order_num']]);
        }
    }
    
    /**
     * 提交订单信息
     * yonghua@gz-zc.cn
     */
    public function editorderinfo(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        if(IS_POST){
            $updata = $this->input->post();
            $id = (int) $this->input->post('id', TRUE);
            unset($updata['id']);
            $updata['order_man'] = trim($this->input->post('order_man', TRUE));
            $updata['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $updata['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $updata['place_id'] = implode(',', $updata['place_id']);
            $updata['bargain_money'] = $this->input->post('bargain_money', TRUE);
            $updata['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdrinkorder->update_info($updata, ['id' => $id]);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败']);
            }
            $this->return_json(['code' => 1]);
        }
    }
    
    /**
     * 通过id获得价格
     * yonghua@gz-zc.cn
     */
    public function get_price_by_id(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $id = (int) $this->input->get('id', TRUE);
        $products_id = intval($this->input->get('products_id', TRUE));
        $res = array();
        //获取规格id
        if($id){
            $price = $this->Mspecifications->get_one('*', array('id'=>$id));
            $res['id'] = $price['products_id'];
            $res['title'] = $price['version_name'];
            $res['present_price'] = $price['version_price'];
        }else{
            $res = $this->Mproducts->get_one('id, present_price, title', ['id' =>$products_id]);
        }
        
        if($res){
            $this->return_json($res);
        }
    }
    
    /**
     * 添加商品
     * yonghua@gz-zc.cn
     */
    public function add_goods(){
        $data = $this->data;
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $post_data = $this->input->post();
        //获取商品图片
        if(!isset($post_data['product_id']) || !$post_data['product_id']){
            $this->return_failed("请选择商品");
        }
        
        $product = $this->Mproducts->get_lists('id, cover_img, title', array('in'=>array('id'=>$post_data['product_id'])));
        $product_img = array_column($product, 'cover_img', 'id');
        $product_name = array_column($product, 'title', 'id');
        
        //规格图片获取
        if($post_data['special_id']){
            $special = $this->Mspecifications->get_lists('*', array('in'=>array('id'=>$post_data['special_id'])));
            $special_img = array_column($special, 'version_image', 'id');
        }
        
        //如果已经存在该场馆的订单 则不允许再添加
        $exsit = $this->Mdrinkorder->get_one('id', array('dinner_id'=>$post_data['id']));
        if($exsit){
            $this->return_failed("订单已经存在,请直接修改");
        }

        //获取客户名称
        $dinner_user = $this->Mdinner->get_one('roles_main,roles_main_mobile, roles_wife,roles_wife_mobile, user_id, venue_type, solar_time, banquet_time,lunar_time', array('id'=>$post_data['id']));
        $user_name = $this->Muser->get_one('realname, mobile_phone', array('id'=>$dinner_user['user_id']));
        
        //获取场馆id
        $dinner_id = $post_data['id'];
        $venue_id = $this->Mdinner_venue->get_lists('venue_id', array('dinner_id'=>$dinner_id));
        $venue_id = array_column($venue_id, 'venue_id');
        $place_id = '';
        if($venue_id){
            $place_id = implode(',', $venue_id);
        }
        
        //计算价格
        $total_price = 0;
        foreach ($post_data['product_id'] as $k=>$v){
            $total_price += $post_data['unit_price'][$k]*$post_data['num'][$k];
        }
        $need_pay = $total_price-$post_data['bargain_money']-$post_data['free'];
        if($need_pay != $post_data['need_pay']){
            $this->return_failed("订单创建失败!");
        }
        
        $add_order = array();
        
        if($dinner_user['roles_main']){
            $order_man = $dinner_user['roles_main'];
            $add_order['man_phone'] = $dinner_user['roles_main_mobile'];
        }elseif($dinner_user['roles_wife']){
            $order_man = $dinner_user['roles_wife'];
            $add_order['man_phone'] = $dinner_user['roles_wife_mobile'];
        }else{
            $order_man = $user_name['realname'];
            $add_order['man_phone'] = $dinner_user['mobile_phone'];
        }
        
        
        $add_order['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
        $add_order['dinner_id'] = $post_data['id'];
        $add_order['order_man'] = $order_man;
        $add_order['order_type'] = $dinner_user['venue_type'];
        $add_order['g_time'] = $dinner_user['solar_time'];
        $add_order['start_time'] = $dinner_user['banquet_time'];
        $add_order['create_time'] = date("Y-m-d H:i:s", time());
        $add_order['free_price'] = $post_data['free'];
        $add_order['bargain_money'] = $post_data['bargain_money'];
        $add_order['order_info'] = $post_data['remark'];
        $add_order['need_pay'] = $need_pay;
        $add_order['total_price'] = $total_price;
        $add_order['n_time'] = $dinner_user['lunar_time'];
        $add_order['place_id'] = $place_id;
        $add_order['create_admin'] = $data['userInfo']['id'];
        
        $add_order_id = $this->Mdrinkorder->create($add_order);
        
        if($add_order_id){
            $add_data = array();
            foreach ($post_data['product_id'] as $k=>$v){
                $add_data[$k]['foods_id'] = $v;
                $add_data[$k]['class_id'] = $post_data['class_id'][$k];
                $add_data[$k]['unit_price'] = $post_data['unit_price'][$k];
                $add_data[$k]['num'] = $post_data['num'][$k];
                $add_data[$k]['special_id'] = isset($post_data['special_id'][$k]) ? $post_data['special_id'][$k]:0;
                $add_data[$k]['total_price'] = $post_data['price'][$k];
                $add_data[$k]['order_num'] = $add_order['order_num'];
                $add_data[$k]['order_id'] = $add_order_id;
                $add_data[$k]['foods_name'] = $product_name[$v];
                
                if(isset($special_img[$post_data['special_id'][$k]]) && $special_img[$post_data['special_id'][$k]]){
                    $add_data[$k]['cover_img'] = $special_img[$post_data['special_id'][$k]];
                }else{
                    $add_data[$k]['cover_img'] = $product_img[$v];
                }
                
            }
            $add_detail_id = $this->Mdrinkorderdetail->create_batch($add_data);
            $this->return_success("添加成功!");
        }else{
            $this->return_failed("添加失败!");
        }
        
        
    }
    
    /**
     * 编辑商品
     * yonghua@gz-zc.cn
     */
    public function edit_goods($order_id){
        
        $data = $this->data;
        $order_id = intval($order_id);
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $post_data = $this->input->post();
        //获取商品图片
        if(!isset($post_data['product_id']) || !$post_data['product_id']){
            $this->return_failed("请选择商品");
        }
        
        $product = $this->Mproducts->get_lists('id, cover_img, title', array('in'=>array('id'=>$post_data['product_id'])));
        $product_img = array_column($product, 'cover_img', 'id');
        $product_name = array_column($product, 'title', 'id');
        
        //规格图片获取
        if($post_data['special_id']){
            $special = $this->Mspecifications->get_lists('*', array('in'=>array('id'=>$post_data['special_id'])));
            $special_img = array_column($special, 'version_image', 'id');
        }
        
        //如果已经存在该场馆的订单 则不允许再添加
        $exsit = $this->Mdrinkorder->get_one('*', array('id'=>$order_id));
        if(!$exsit){
            $this->return_failed("该订单不存在");
        }
        
        
        //计算价格
        $total_price = 0;
        foreach ($post_data['product_id'] as $k=>$v){
            $total_price += $post_data['unit_price'][$k]*$post_data['num'][$k];
        }
        $need_pay = $total_price-$post_data['bargain_money']-$post_data['free'];
        if($need_pay != $post_data['need_pay']){
            $this->return_failed("订单创建失败!");
        }
        
        $add_order['free_price'] = $post_data['free'];
        $add_order['bargain_money'] = $post_data['bargain_money'];
        $add_order['order_info'] = $post_data['remark'];
        $add_order['need_pay'] = $need_pay;
        $add_order['total_price'] = $total_price;
        
        $update_order_id = $this->Mdrinkorder->update_info($add_order, array('id'=>$order_id));
        
        if($update_order_id){
            //删除详情表里订单数据
            $del = $this->Mdrinkorderdetail->delete(array('order_id'=>$order_id));
            $add_data = array();
            foreach ($post_data['product_id'] as $k=>$v){
                $add_data[$k]['foods_id'] = $v;
                $add_data[$k]['class_id'] = $post_data['class_id'][$k];
                $add_data[$k]['unit_price'] = $post_data['unit_price'][$k];
                $add_data[$k]['num'] = $post_data['num'][$k];
                $add_data[$k]['special_id'] = isset($post_data['special_id'][$k]) ? $post_data['special_id'][$k]:0;
                $add_data[$k]['total_price'] = $post_data['price'][$k];
                $add_data[$k]['order_num'] = $exsit['order_num'];
                $add_data[$k]['order_id'] = $order_id;
                $add_data[$k]['foods_name'] = $product_name[$v];
        
                if(isset($special_img[$post_data['special_id'][$k]]) && $special_img[$post_data['special_id'][$k]]){
                    $add_data[$k]['cover_img'] = $special_img[$post_data['special_id'][$k]];
                }else{
                    $add_data[$k]['cover_img'] = $product_img[$v];
                }
        
            }
            $add_detail_id = $this->Mdrinkorderdetail->create_batch($add_data);
            $this->return_success("修改成功!");
        }else{
            $this->return_failed("修改失败!");
        }
    
    }
    
    /**
     * 删除商品
     * yonghua@gz-zc.cn
     */
    public function del_goods(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $add = $this->input->post();
        $id = (int) $this->input->post('id', TRUE);
        $res = $this->Mdrinkorderdetail->update_info(['is_del' => 1], ['id' => $id]);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    
    /**
     * 保存订单
     * yonghua@gz-zc.cn
     */
    public function finish(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $id = (int) $this->input->post('id',TRUE);
        $up['status'] = (int) $this->input->post('status', TRUE);
        if(C('orders_status.end.id') == $up['status']){
            $up['finsh_time'] = date('Y-m-d H:i:s');
        }
        $up['free_price'] = $this->input->post('free', TRUE);
        $up['total_price'] = $this->input->post('total_price', TRUE);
        $need = $this->Mdrinkorder->get_one('bargain_money', ['id' => $id]);
        if(!$need){
            $need['bargain_money'] = 0;
        }
        $up['need_pay'] = ($up['total_price'] - $up['free_price'] - $need['bargain_money']);
        //查询订单详情的价格与当前的总价格是否一致
        $ret = $this->Mdrinkorderdetail->get_lists('total_price', ['order_id' => $id, 'is_del' => 0]);
        if($ret){
            $s_total = 0;
            foreach ($ret as $k => $v){
                $s_total += $v['total_price']; 
            }
            if( $up['need_pay'] == ($s_total - $up['free_price'] - $need['bargain_money']) ){
                $res = $this->Mdrinkorder->update_info($up, ['id' => $id]);
                if(!$res){
                    $this->return_json('提交失败');
                }
                $this->return_json(1);
            }
            $this->return_json('价格校验不通过');
        }
        $this->return_json('至少添加一件商品');
        
    }
    

    /**
     * 订单详情
     * yonghua@gz-zc.cn
     */
    public function detail($id){
        $data = $this->data;
        $data['title'] = ['酒水列表','查看'];
        $id = intval($id);
        $data['id'] = $id;
        //宴会类型
        $data['party'] = C('party');
        $data['venue_list'] = $this->Mvenue->lists();
        $list = $this->Mdrinkorderdetail->get_lists('*', ['order_id' => $id, 'is_del' => 0]);
        $info = $this->Mdrinkorder->get_one("*", ['id' => $id]);
        if($info){
            $data['info'] = $info;
            if($data['info']['delivery_type'] == 0){
                $data['info']['need_pay'] += 30;
            }
            $res = $this->Madmins->get_one('name',['id' => $info['create_admin']]);
            if($res){
                $data['admin_name'] = $res['name'];
            }
        }
        if($list){
            $data['list'] = $list;
            $price = 0;
            foreach ($list as $k => $v){
                $price += $v['total_price'];
            }
            if($info['total_price'] != $price){
                //判断总价格是否相等
                $need_pay = $price - $info['bargain_money'] - $info['free_price'];
                if($data['info']['delivery_type'] == 0){
                    $need_pay += 30;
                }
                $this->Mdrinkorder->update_info(['total_price' => $price ,'need_pay' => $need_pay], ['id' => $id]);
                $data['info']['need_pay'] = $need_pay;
                
            }
        }
        
        //百年婚宴婚宴信息        
        $dinner = $this->Mdinner->info($info['dinner_id']);
        $dinnertype = array_column(C('party'), 'name', 'id');
        $dinner['venue_type_name'] = $dinnertype[$dinner['venue_type']];
        
        if($dinner){
            $venue = $this->Mvenue->get_lists('name', array('in' => array('id' => $dinner['venue_ids'])));
            $venue_name = '';
            foreach ($venue as $v){
                $venue_name .= $v['name'].';';
            }
            $dinner['venue_name'] = $venue_name;
        }
        
        $admin_name = $this->Madmins->get_one('id, fullname',array('id' => $dinner['create_admin']));
        $dinner['create_admin'] = isset($admin_name['fullname']) && $admin_name['fullname'] ? $admin_name['fullname'] : ' ';
        
        $data['dinner'] = $dinner;
        
        
        $this->load->view('drinkorder/detail', $data);
    }
    
    
    /**
     * 录入快递信息
     * @author chaokai@gz-zc.cn
     */
    public function input_express(){
        $post_data = $this->input->post();
        if($post_data['delivery_type'] == 0){
            $this->form_validation->set_rules('id', '', 'integer', array('integer' => '参数错误'));
            $this->form_validation->set_rules('express_company', '快递公司', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('express_number', '快递单号', 'trim|required', array('required' => '%s不能为空'));
            if($this->form_validation->run() === false){
                $this->return_failed(validation_errors());
            }
        }
        $post_data['status'] = C('order.delivery_status.success.id');
        $where = array(
            'id' => $post_data['id']
        );
        unset($post_data['id']);
        $update = $this->Mdrinkorder->update_info($post_data, $where);
        if($update){
            $this->return_success();
        }else{
            $this->return_failed("添加失败");
        }
    }
    
    public function del(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('请先登陆');
        }
        $id =(int) $this->input->get('id', TRUE);
        $is_del = !(int) $this->input->get('is_del', TRUE);
        $res = $this->Mdrinkorder->update_info(['is_del' => $is_del], ['id' => $id]);
        if(!$res){
            $this->error('操作失败');
        }
        $this->success('操作成功');
    }
    
    
    public function special(){
        $data = $this->data;
        $products_id = $this->input->get('products_id', TRUE);
        $list = $this->Mspecifications->get_lists('*', array('products_id'=>$products_id));
        $present_price = $this->Mproducts->get_one('present_price', array('id'=>$products_id));
        if(!$list){
            $this->return_json(['code' => 0, 'arr' => $present_price['present_price']]);
        }
        
        $this->return_json(['code' => 1, 'arr' => $list, 'present_price'=>$present_price['present_price']]);
    }
}

