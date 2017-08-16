<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Drink extends MY_Controller{
    private $drink_video;
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
                'Model_about_us' => 'Mabout_us',
                'Model_drink_class' => 'Mdrinkclass',
                'Model_drink' => 'Mdrink',
                'Model_drink_appoint_order' => 'Mdrinkappointorder',
                'Model_drink_ml_num' => 'Mdrinkmlnum',
                'Model_flower' => 'Mflower',
                'Model_bless' => 'Mbless',
                'Model_manual' => 'Mmanual',
                'Model_products' => 'Mproducts',
                'Model_products_attribute' => 'Mproducts_attribute',
                'Model_specifications' => 'Mspecifications',
                'Model_order' => 'Morder',
                'Model_order_detail' => 'Morder_detail',
                'Model_order_addr' => 'Morder_addr',
        ));
        //统计收到的祝福条数和鲜花数
        $this->data['bless_num'] = $this->Mbless->count(['is_del' => 0]);
        $this->data['flower_num'] = $this->Mflower->count(['is_del' => 0]);
        
        //加载相关类库
        $weixin_config = array(
            'app_id' => C('wechat_app.app_id.value'),
            'app_secret' => C('wechat_app.app_secret.value'),
            'key' => C('wechat_app.key.value'),
            'mch_id' => C('wechat_app.mch_id.value'),
            'trade_type' => 'NATIVE'
        );
        
        $this->load->library('weixinpay', $weixin_config);
    }
    
    /**
     * 首页
     * @author louhang@gz-zc.cn
     */
    public function index(){
        //统计宾客数量、视频数量
        $this->count();
        $data = $this->data;
        $data['action'] = 'drink';
        
        //获取酒水分类
        $data['class_list'] = C('products.drinks_class');
        $data['class_list'] = array_column($data['class_list'], 'name', 'id');
        //显示默认酒水类型
        $lists = $this->Mproducts->get_lists('*', array('is_del'=>0, 'class_id'=>C('products.drinks_class.wine.id'), 'is_show'=>0));

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
                    $lists[$k][$key] = $val;
                }
            }
        }
        foreach ($lists as $k=>$v){
            $lists[$k]['is_promotion'] = $v['original_price'] - $v['present_price'] > 0 ;
            if($lists[$k]['flag']){
                $lists[$k]['flag'] = explode(',', $lists[$k]['flag']);
            }
        }
        $data['lists'] = $lists;
        //获取酒水商城视频
        $data['video'] = $this->Mmanual->get_one('video', array('manual_class_id'=>C('public.manual_class.drink.id')));
        $this->load->view('drink1/index', $data);
    }
    
    public function lists(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $class_id = $this->input->post('class_id');
            //显示默认酒水类型
            $lists = $this->Mproducts->get_lists('*', array('is_del'=>0, 'is_show'=>0, 'class_id'=>$class_id));
            $products_id = array_column($lists, 'id');
            
            if($lists){
                $detail = $this->Mproducts_attribute->get_lists('*', array('in'=>array('products_id'=>$products_id)));
                $new_lists= array();
                foreach ($detail as $k=>$v){
                    $new_lists[$v['products_id']][$v['attribute']] = $v['value'];
                }
                
                foreach ($lists as $k=>$v){
                    if(isset($new_lists[$v['id']])){
                        foreach ($new_lists[$v['id']] as $key=>$val){
                            $lists[$k][$key] = $val;
                        }
                    }
                }
                
                foreach ($lists as $k=>$v){
                    $lists[$k]['is_promotion'] = $v['original_price'] - $v['present_price'] > 0 ;
                    if($lists[$k]['flag']){
                        $lists[$k]['flag'] = explode(',', $lists[$k]['flag']);
                    }
                }
                $data['lists'] = $lists;
                $this->load->view('drink1/ajax_lists', $data);
            }else{
                echo 'nodata';exit;
            }
        }
        
    }
    
    
    
    /**
     * 酒水详情页
     * @author songchi@gz-zc.cn
     */
    public function detail(){
        $this->count();
        $data = $this->data;
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        $data['title'] = '酒水批发';
        $id = intval($this->input->get('id', TRUE));
        $info = $this->Mproducts->get_one('*', array('id'=>$id));
        if(!$id || !$info ){
            echo "没有数据";exit;
        }
        if($info['flag']){
            $info['flag'] = explode(",", $info['flag']);
        }
        $where['products_id'] = $id;
        $detail = $this->Mproducts_attribute->get_lists('*', $where);
        
        $new_lists= array();
        foreach ($detail as $k=>$v){
            $new_lists[$v['attribute']] = $v['value'];
        }
        foreach ($new_lists as $k=>$v){
            $info[$k] = $v;
        }
        
        $data['new_lists'] = $new_lists;

        if($info['images']){
            $info['images'] = explode(',', $info['images']);
        }
        
        $info['is_promotion'] = $info['original_price'] - $info['present_price'] > 0 ;
        
        $data['info'] = $info;
        
        $limit = 5;
        $products_other = $this->Mproducts->get_lists('*', ['id !=' =>$id,'class_id' => $info['class_id'], 'is_show'=>0, 'is_del' => 0], 0, $limit);
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
                if(isset($products_other[$k]['flag']) && $products_other[$k]['flag']){
                    $products_other[$k]['flag'] = explode(',', $products_other[$k]['flag']);
                }
            }
            $data['class'] = $products_other;
        }
        
        //获取酒水商城视频
        $data['video'] = $this->Mmanual->get_one('video', array('manual_class_id'=>C('public.manual_class.drink.id')));
        
        //获取规格参数
        $data['special_lists'] = $this->Mspecifications->get_lists('*', array('products_id'=>$id));
        if(isset($data['special_lists'][0]['version_price']) && $data['special_lists'][0]['version_price']){
            $data['info']['present_price'] = $data['special_lists'][0]['version_price'];
        }
        
        $this->load->view('drink1/detail', $data);
    }
    
    public function order(){
        $data = $this->data;
        $add['drink_id'] =(int) $this->input->post('id', TRUE);
        $add['drink_title'] =trim($this->input->post('title', TRUE));
        $add['cover_img'] =trim($this->input->post('img', TRUE));
        $add['price'] = $this->input->post('price', TRUE);
        $add['user_name'] =trim($this->input->post('user_name', TRUE));
        $add['user_mobile'] =(int) $this->input->post('user_mobile', TRUE);
        $add['user_addr'] =trim($this->input->post('user_addr', TRUE));
        $add['post_method'] =(int) $this->input->post('post_method', TRUE);
        $add['unit_price'] = $add['price'];
        $add['num'] =(int) $this->input->post('num', TRUE);
        $add['special_id'] = $special_id = (int) $this->input->post('special_id', TRUE);
        //校验价格是否正确
        if($special_id){
            $price = $this->Mspecifications->get_one('version_price, version_name', array('id'=>$special_id, 'version_price'=>$add['price']));
            if(!$price){
                $this->return_json('未知错误');
            }
        }else{
            $res = $this->Mproducts->get_one('id', ['id' => $add['drink_id'], 'present_price' => $add['price']]);
            if(!$res){
                $this->return_json('未知错误');
            }
        }
        
        //计算总价格
        $add['price'] = $add['price']*$add['num'];
        $add['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
        $add['create_time'] = date('Y-m-d H:i:s');
        //add
        $res = $this->Mdrinkappointorder->create($add);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
 
    
    
    public function car(){
        $data = $this->data;
        $data['status'] = 0;
        if(isset($data['user_info']) && $data['user_info']){
            $data['status'] = 1;
        }
        $data['title']= "酒水商城";
        $data['delivery_type'] = C('order.delivery_type');
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post("arr");
            if($post_data){
                $product_id = array_column($post_data, 'product_id');
                $special_id = array_column($post_data, 'special_id');
                
                $special_lists = $this->Mspecifications->get_lists("*", array('in'=>array('id'=>$special_id)));
                $temp = array();
                foreach ($special_lists as $k=>$v){
                    if($v['id']){
                        $temp[$v['id']] = $v;
                    }
                    
                }
                
                $data['special_lists'] = $temp;
                
                $data['car_lists'] = $post_data;
                
                $lists =  $this->Mproducts->get_lists('*', array('in'=>array('id'=>$product_id)));
                $detail = $this->Mproducts_attribute->get_lists('*', array('in'=>array('products_id'=>$product_id)));
                $new_lists= array();
                foreach ($detail as $k=>$v){
                    $new_lists[$v['products_id']][$v['attribute']] = $v['value'];
                }
                
                foreach ($lists as $k=>$v){
                    if(isset($new_lists[$v['id']])){
                        foreach ($new_lists[$v['id']] as $key=>$val){
                            $lists[$k][$key] = $val;
                        }
                    }
                }
                
                $lists_temp = array();
                foreach ($lists as $k=>$v){
                    $lists_temp[$v['id']] = $v;
                }
                
                $data['lists'] = $lists_temp;
                $data['attr_lists'] = $new_lists;
                if($data['lists']){
                    $this->load->view("/drink1/car_ajax", $data);
                }else{
                    echo "nodata";exit;
                }
            }
        }else{
            $this->load->view('drink1/car', $data);
        }
    }
    
    public function submit(){
        $data = $this->data;
        if(!isset($data['user_info'])){
            //如果没有登陆，则先跳转到微信登陆
//             $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('wechat_app.app_id.value');
//             $url .= '&redirect_uri='.urlencode($this->data['domain']['mobile']['url'].'/passport/weixin_smarty_login?id='.$id);
//             $url .= '&response_type=code&scope=snsapi_userinfo#wechat_redirect';
//             redirect($url);
            $this->return_failed("请先登录", array('code'=>-2));
        }
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if(!isset($post_data['arr']) || !$post_data['arr']){
                $this->return_failed("请选择至少一件商品");
            }
            
            if(!$post_data['sum_price']){
                $this->return_failed("创建订单失败");
            }
            //价格核实
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
            
            if($sum != $post_data['sum_price']){
                $this->return_failed("订单失败");
            }
            
            //是否邮寄
            $order_lists['need_pay'] = $sum;
            $delivery_type = $post_data['delivery_type'];
            if($delivery_type == C('order.delivery_type.express.id')){
                $order_lists['need_pay'] += C('order.delivery_type.express.price');
            }
            $order_lists['order_type'] = C('order.product_type.drink.id');
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
                $post_data['arr'][$k]['product_type'] = C('order.product_type.drink.id');
                unset($post_data['arr'][$k]['num']);
                if($v['special_id']){
                    $post_data['arr'][$k]['price'] = $special_price[$v['special_id']];
                    $post_data['arr'][$k]['special_name'] = $special_name[$v['special_id']];
                }else{
                    $post_data['arr'][$k]['price'] = $product_lists[$v['product_id']];
                    $post_data['arr'][$k]['special_name'] = '';
                }
                
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
    
    public function pay(){
        $data = $this->data;
        $data['title'] = "酒水支付";
        $orde_id = (int)$this->input->get('order_id');
        
        $data['order_id'] = $orde_id;
        $field = '*';
        $where = array('id' => $orde_id);
        $order = $this->Morder->get_one($field, $where);
        $data['order'] = $order;
        if(!$order){
            p('请求错误');
        }
        //查询用户openid
        $user_info = $this->Muser->get_one('open_id', array('id' => $this->data['user_info']['id']));
        //微信支付统一下单
        $type = C('order.product_type');
        $type = array_column($type, 'name', 'id');
        $type_name = $type[$order['order_type']];
        $pay_param = array(
            'body' => '百年婚宴 '.$type_name,
            'out_trade_no' => $order['order_id'],
            'spbill_create_ip' => $order['bill_create_ip'],
            'total_fee' => $order['need_pay']*100,
            'notify_url' =>$this->data['domain']['mobile']['url'].'/wxpay/notify',
            'openid' => $user_info['open_id']
        );
        $response = $this->weixinpay->create_order($pay_param);
        
        //发生错误
        if($response['error'] == 1){
            p($response['msg']);
        }
        //预付订单号保存到订单表
        $this->Morder->update_info(array('prepay_id' => $response['data']['prepay_id']), array('id' => $orde_id));
        //获取支付二维码地址
        $data['code_url'] = $response['data']['code_url'];
        
        $this->load->view('drink1/pay',$data);
    }
    
    /**
     * 查询订单状态
     * @author chaokai@gz-zc.cn
     */
    public function status(){
        $order_id = intval($this->input->post('order_id'));
        if(!$order_id){
            $this->return_failed('参数错误');
        }
    
        $order = $this->Morder->get_one('status', array('id' => $order_id));
        !$order && $this->return_failed();
        $this->return_success($order);
    }
    
    public function about(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if(!$post_data){
                echo "nodata";exit;
            }
            
            $post_data = $post_data['about_arr'];
            $lists = $this->Mproducts->get_lists('class_id', array('in'=>array('id'=>$post_data)));
            $class_id = array_column($lists, 'class_id');
            $order_by['sort'] = 'desc';
            if($class_id){
                $recommend_lists = $this->Mproducts->get_lists('*', array('in'=>array('class_id'=>$class_id), 'is_recommend'=>1, 'is_del' => 0), $order_by, 5);
                $data['recommend_lists'] = $recommend_lists;
            }
            
            $this->load->view('drink1/recommend', $data);
        }
    }
    
}


