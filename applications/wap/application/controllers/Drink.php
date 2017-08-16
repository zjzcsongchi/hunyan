<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Drink extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_drink_class'=>'Mdrinkclass',
                'Model_drink'=>'Mdrink',
                'Model_drink_appoint_order' => 'Mdrinkappointorder',
            'Model_products' => 'Mproducts',
            'Model_products_attribute' => 'Mproducts_attribute',
            'Model_specifications' => 'Mspecifications',
            'Model_user_addr' => 'Muser_addr',
            'Model_order' => 'Morder',
            'Model_order_detail' => 'Morder_detail',
            'Model_manual' => 'Mmanual'
        ]);
         
    }

    public function index($class_id='0') {
        $data = $this->data;
        if(!$class_id){
            $class_id = 14;
        }
        $data['class_id'] = $class_id;
        $data['action'] = 'drink';
        
        //首页轮播图
        $data['manual'] = $this->Mmanual->get_lists('*' ,array('is_del' => 1,'manual_class_id' => C('class.drink.id')));

        //获取酒水分类
        $data['class_list'] = C('products.drinks_class');
        $data['class_list'] = array_column($data['class_list'], 'name', 'id');
        //显示默认酒水类型
        $lists = $this->Mproducts->get_lists('*', array('is_del'=>0, 'class_id'=>$class_id, 'is_show'=>0));
        !$lists && show_404();
        $products_id = array_column($lists, 'id');
        
        if($lists){
            $detail = $this->Mproducts_attribute->get_lists('*', array('in'=>array('products_id'=>$products_id)));
        }
        
        $new_lists= array();
        foreach ($detail as $k=>$v){
            $new_lists[$v['products_id']][$v['attribute']] = $v['value'];
        }
        
        foreach ($lists as $k=>$v){
            if(isset($new_lists[$v['id']])){
                foreach ($new_lists[$v['id']] as $key=>$val){
                    $lists[$k]['attr'][$key] = $val;
                }
            }
        }
        
        foreach ($lists as $k=>$v){
            $lists[$k]['is_promotion'] = $v['original_price'] - $v['present_price'] > 0 ;
            $lists[$k]['cover_img'] = get_img_url($v['cover_img']);
            if($lists[$k]['flag']){
                $lists[$k]['flag'] = explode(',', $lists[$k]['flag']);
            }
        }
        
        //根据商品ids获取规格
        $goods_ids = array_column($lists, 'id');
        if($goods_ids){
            $size = $this->Mspecifications->get_lists('*', ['in' => array('products_id'=>$goods_ids)]);
            if($size){
                foreach ($lists as $k => $v){
                    foreach ($size as $key => $val){
                        if($v['id'] == $val['products_id']){
                            $lists[$k]['size_list'][] = $val;
                        }
                    }
                }
            }
        }
        
        $data['lists'] = $lists;
        $this->load->view('drink/index', $data);
    }
    
    public function ajax_data(){
        if($this->input->is_ajax_request()){
            
            $post_data = $this->input->post();
            $class_id = $post_data['class_id'];
            $next_page = $post_data['next_page'];
            $order_by['publish_time'] = 'desc';
            
            $list = $this->Mnews->get_lists('*', array('news_class_id'=>$class_id), $order_by, 4, ($next_page-1)*4);
            $this->return_json($list);
        }
        
    }
    
    /**
     * 酒水详情页
     * @author songchi@gz-zc.cn
     */
    public function detail(){
        $data = $this->data;
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        $data['title'] = '酒水批发';
        $id = intval($this->input->get('id', TRUE));
        $info = $this->Mproducts->get_one('*', array('id'=>$id));
        if(!$id || !$info ){
            show_404();
        }
        $where['products_id'] = $id;
        $detail = $this->Mproducts_attribute->get_lists('*', $where);
        
        $new_lists= array();
        foreach ($detail as $k=>$v){
            $new_lists[$v['attribute']] = $v['value'];
        }
        $data['new_lists'] = $new_lists;
        foreach ($new_lists as $k=>$v){
            $info[$k] = $v;
        }
        
        if($info['images']){
            $info['images'] = explode(',', $info['images']);
        }
        
        if($info['cover_img']){
            $info['cover_img'] = get_img_url($info['cover_img']);
        }
        $info['is_promotion'] = $info['original_price'] - $info['present_price'] > 0 ;
        
        $data['info'] = $info;
        $limit = 5;
        $products_other = $this->Mproducts->get_lists('*', ['id !=' =>$id, 'class_id' => $info['class_id'], 'is_show'=>0], 0, $limit);
        $products_id = array_column($products_other, 'id');
        if($products_id){
            $detail = $this->Mproducts_attribute->get_lists('*', array('in'=>array('products_id'=>$products_id)));
            $new_lists= array();
            foreach ($detail as $k=>$v){
                $new_lists[$v['products_id']][$v['attribute']] = $v['value'];
            }
        
            foreach ($products_other as $k=>$v){
                if(isset($new_lists[$v['id']])){
                    foreach ($new_lists[$v['id']] as $key=>$val){
                        $products_other[$k][$key] = $val;
                    }
                }
            }
        
            foreach ($products_other as $k=>$v){
                $products_other[$k]['is_promotion'] = $v['original_price'] - $v['present_price'] > 0 ;
                if($products_other[$k]['flag']){
                    $products_other[$k]['flag'] = explode(',', $products_other[$k]['flag']);
                }
            }
            $data['class'] = $products_other;
        }
        
        //获取规格参数
        $data['special_lists'] = $this->Mspecifications->get_lists('*', array('products_id'=>$id));
        if(isset($data['special_lists'][0]['version_price']) && $data['special_lists'][0]['version_price']){
            $data['info']['present_price'] = $data['special_lists'][0]['version_price'];
        }
        $this->load->view('drink/detail', $data);
    }
    
    public function order(){
        $data = $this->data;
        $add['drink_id'] =(int) $this->input->post('id', TRUE);
        $add['user_name'] =trim($this->input->post('user_name', TRUE));
        $add['user_mobile'] =(int) $this->input->post('user_mobile', TRUE);
        if(!preg_match(C('regular_expression.mobile'), $add['user_mobile'])){
            $this->return_json('请认真填写手机号！');
        }
        $add['user_addr'] =trim($this->input->post('user_addr', TRUE));
        $add['post_method'] =(int) $this->input->post('post_method', TRUE);
        $add['num'] =(int) $this->input->post('num', TRUE);
        $add['special_id'] = $special_id = (int) $this->input->post('special_id', TRUE);
        $add['price'] = (int) $this->input->post('price', TRUE);
        $res =array();
        //校验价格是否正确
        if($special_id){
            $price = $this->Mspecifications->get_one('products_id, version_price, version_name', array('id'=>$special_id, 'version_price'=>$add['price']));
            if(!$price){
                $this->return_json('未知错误');
            }else{
                $products_name = $this->Mproducts->get_one('title, cover_img', array('id'=>$price['products_id']));
                $res['present_price'] = $price['version_price'];
                $res['title'] = $products_name['title'];
                $res['cover_img'] = $products_name['cover_img'];
            }
        }else{
            $res = $this->Mproducts->get_one('*', ['id' => $add['drink_id'], 'present_price' => $add['price']]);
            if(!$res){
                $this->return_json('未知错误');
            }
        }
        
        
        if($add['num'] <=0){
            $this->return_json('数量必须大于1！');
        }
        //计算总价格
        $add['unit_price'] = $res['present_price'];
        $add['drink_title'] = $res['title'];
        $add['price'] = $res['present_price']*$add['num'];
        $add['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
        $add['create_time'] = date('Y-m-d H:i:s');
        $add['cover_img'] = $res['cover_img'];
        $res = $this->Mdrinkappointorder->create($add);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    
    public function cars(){
        $data = $this->data;
        //读取用户收货信息
        if(isset($data['user_info'])){
            $addr = $this->Muser_addr->get_one('*', ['user_id' => $data['user_info']['id'], 'is_del' => 0]);
            if($addr){
                $data['addr'] = $addr;
            }
        }
        $this->load->view('drink/cars',$data);
    }
    
    public function checkuser(){
        if(IS_POST){
            $data = $this->data;
            if(!isset($data['user_info'])){
                $this->return_json(0);
            }
            $this->return_json(1);
        }else{
            $this->return_json(0);
        }
    }
    
    public function add_order(){
        $data = $this->data;
        if(!isset($data['user_info'])){
            $this->return_failed("请先登陆！");
        }
        $post_data = $this->input->post();
        if(!isset($post_data['arr']) || !$post_data['arr']){
            $this->return_failed("请选择至少一件商品");
        }
        //获取有规格商品价格
        $special_id = array_column($post_data['arr'], 'special_id');
        $special_price = $this->Mspecifications->get_lists('*', array('in'=>array('id'=>$special_id)));
        $special_name = array_column($special_price, 'version_name', 'id');
        $special_price = array_column($special_price, 'version_price', 'id');
        
        //获取商品原价格
        $product_id = array_column($post_data['arr'], 'product_id');
        $product_lists = $this->Mproducts->get_lists('id, present_price, title', array('in'=>array('id'=>$product_id)));
        $product_name = array_column($product_lists, 'title','id');
        $product_lists = array_column($product_lists, 'present_price','id');
        
        
        $sum = 0;
        foreach ($post_data['arr'] as $k=>$v){
            if(isset($special_price[$v['special_id']]) && $special_price[$v['special_id']]){
                $sum += $special_price[$v['special_id']]*$v['num'];
            }else{
                $sum += $product_lists[$v['product_id']]*$v['num'];
            }
        }
        
        //是否邮寄
        $order_lists['need_pay'] = $sum;
        $delivery_type = $post_data['delivery_type'];
        if($delivery_type == C('order.delivery_type.express.id')){
            $order_lists['need_pay'] += C('order.delivery_type.express.price');
        }
        $order_lists['order_type'] = C('order_type.drink.id');
        $order_lists['create_time'] = date("Y-m-d H:i:s", time());
        $order_lists['user_id'] = $data['user_info']['id'];
        $order_lists['order_id'] = get_orderid();
        $order_lists['delivery_type'] = $post_data['delivery_type'];
        $order_lists['bill_create_ip'] = get_client_ip();
        $order_id = $this->Morder->create($order_lists);
        if(!$order_id){
            $this->return_failed('添加失败，请重试！');
        }
        
        foreach ($post_data['arr'] as $k=>$v){
            $post_data['arr'][$k]['order_id'] = $order_id;
            $post_data['arr'][$k]['product_name'] = $order_id;
            $post_data['arr'][$k]['product_name'] = $product_name[$v['product_id']];
            $post_data['arr'][$k]['count'] = $post_data['arr'][$k]['num'];
            unset($post_data['arr'][$k]['num']);
            if($v['special_id']){
                $post_data['arr'][$k]['price'] = $special_price[$v['special_id']];
                $post_data['arr'][$k]['special_name'] = $special_name[$v['special_id']];
            }else{
                $post_data['arr'][$k]['price'] = $product_lists[$v['product_id']];
                $post_data['arr'][$k]['special_name'] = '';
            }
            $post_data['arr'][$k]['product_type'] = C('order.product_type.drink.id');
            
        }
        
        $order_detail_id = $this->Morder_detail->create_batch($post_data['arr']);
        
        //用户订单地址
        $order_addr = array();
        $order_addr['order_id'] = $order_id;
        $order_addr['name'] = $post_data['name'];
        $order_addr['mobile_phone'] = $post_data['tel'];
        $order_addr['address'] = $post_data['address'];
        
        $order_addr_id = $this->Morder_addr->create($order_addr);
        $this->return_success(array('order_id'=>$order_id));
    }
    
}

