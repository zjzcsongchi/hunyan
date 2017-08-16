<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 订单详情
 * @author louhang@gz-zc.cn
 */
class Order extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_news' => 'Mnews',
                'Model_dinner_album' => 'Mdinner_album',
                'Model_dinner_images' => 'Mdinner_images',
                'Model_user_dinner' => 'Muser_dinner',
                'Model_order' => 'Morder',
                'Model_order_detail' => 'Morder_detail',
                'Model_user_addr' => 'Muser_addr',
                'Model_user_coupon' => 'Muser_coupon',
                'Model_order_addr' => 'Morder_addr',
                'Model_dinner_score' => 'Mdinner_score',
                'Model_products' => 'Mproducts',
                'Model_products_attribute' => 'Mproducts_attribute',
                'Model_bless' => 'Mbless',
                'Model_user_coupon' => 'Muser_coupon',
                'Model_album_image' => 'Malbum_images',
                'Model_specifications' => 'Mspecifications',
        ]);

        //加载相关类库
        $weixin_config = array(
                'app_id' => C('wechat_app.app_id.value'),
                'app_secret' => C('wechat_app.app_secret.value'),
                'key' => C('wechat_app.key.value'),
                'mch_id' => C('wechat_app.mch_id.value'),
                'trade_type' => 'NATIVE'
        );
        
        $this->load->library('weixinpay', $weixin_config);
        
        $this->free_quota = C('order.product_type.image.free_quota');              //照片免费额度
        $this->data['photo_unit_price'] = $this->photo_unit_price = C('order.product_type.image.unit_price');  //照片单价
        $this->data['delivery_price'] = $this->delivery_price = C('order.delivery_type.express.price');        //邮费
        
        $data = $this->data;
        if(!$data['user_info']['id']){
            redirect(C('domain.base.url'));
        }
       
        //查找用户婚宴id
        $dinner = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $this->data['user_info']['id']]);
        if($dinner){
            $info = $this->Mdinner->get_one('id', ['in' => ['id' => array_column($dinner, 'dinner_id')], 'venue_type' => C('party.wedding.id'), 'is_del' => 0 ]);
        }
        if(isset($info)){ 
            $this->data['dinner_id'] = $info['id'];
            //祝福数
            $data['bless_nums'] = $this->Mbless->count(['is_del' => 0, 'dinner_id' =>  $info['id']]);
        }
        //查寻用户优惠卷的数量
        $this->data['coupon_nums'] = $this->Muser_coupon->count(['user_id' => $data['user_info']['id'], 'status' => C('coupon.status.no_use.id')]);
        
        //左侧 leftmenu 样式控制
        $data['action'] = '/usercenter/user';
        //头部 header 样式控制
        $this->data['header_show'] = true;
    }

 
    /**
     * 订单列表
     */
    public function index($type = 0){
        $data = $this->data;

        $data['action'] = '/order/index';
        
        //获取当前用户订单
        if($type){
            $where['order_type'] = $type;
        }
        $data['type'] = $type;
        
        $where['is_del'] = 0;
        $where['user_id'] = $data['user_info']['id'];
        $order =['create_time' => 'desc'];
        $list = $this->Morder->get_lists('id,order_id,need_pay,favorable,status,order_type', $where, $order);
        
        if($list){
            $data['list'] = $list;
            //查找订单包含的产品
            $order_ids = array_column($list, 'id');
            $product = $this->Morder_detail->get_lists('order_id, product_id, special_id, count', ['in' => ['order_id' => $order_ids], 'is_del' => 0]);
            $product_id = array_column($product, 'product_id');
            $product_ids = array_unique(array_column($product, 'product_id'));
            
            //获取规格参数
            $special_id = array_column($product, 'special_id');
            if($special_id){
                $special_name = $this->Mspecifications->get_lists('*', array('in'=>array('id'=>$special_id)));
                foreach ($special_name as $k=>$v){
                    $data['special'][$v['id']] = $v;
                }
                $special_name = array_column($special_name, 'version_name','id');
                $data['special_name'] = $special_name;
            }
            $tmp_products = array();
            foreach ($product as $k=>$v){
                $tmp_products[$v['order_id']][] = $v;
            }
            $data['products'] = $tmp_products;
            //根据产品id查询产品封面图
            $info = $this->Mproducts->get_lists('id, cover_img, title, present_price', ['in' => ['id' => $product_ids]]);
            
            $data['present_price'] = array_column($info, 'present_price', 'id');
            //拼接封面图，封面图信息和订单详情合并
            if($product && $info){
                foreach ($product as $k => $v){
                    foreach ($info as $kk => $vv){
                        if($v['product_id'] == $vv['id']){
                            if(isset($vv['cover_img'])){
                                $product[$k]['cover_img'] = $vv['cover_img'];
                            }
                            $product[$k]['name'] = $vv['title'];
                        }
                    }
                }
            }
            
            foreach ($list as $k => $v){
                foreach ($product as $kk => $vv){
                    if($v['id'] == $vv['order_id']){
                        if(isset($vv['cover_img'])){
                            $data['list'][$k]['cover_img'] = $vv['cover_img'];
                        }
                        if(isset($vv['name'])){
                            $data['list'][$k]['name'] = $vv['name'];
                        }
                        
                        if(isset($vv['count'])){
                            $data['list'][$k]['count'] = $vv['count'];
                        }
                        
                    }
                }
            }
            $data['products_name'] = array_column($info, 'title', 'id');
            $data['products_img'] = array_column($info, 'cover_img', 'id');
            
            //统计相册订单的相片数目
            $album = $this->Morder_detail->get_lists('order_id,product_id,count', ['in' => ['order_id' => $order_ids], 'is_del' => 0, 'product_type' => C('order.product_type.image.id')]);
            if($album){
                foreach ($list as $k => $v){
                    $data['list'][$k]['num'] = 0;
                    foreach($album as $kk => $vv){
                        if($v['id'] == $vv['order_id']){
                            $data['list'][$k]['num'] += 1; 
                        }
                    }
                }
            }
            //获取相册的产品id
            $album_id = array_column($album, 'product_id', 'order_id');
            if(count($album_id)> 0){
                //一张相册
                $photo = $this->Mdinner_images->get_lists('id,thumb,sy_img', ['in' => ['id' => $album_id]]);
                if($photo){
                    $temp = array();
                    foreach ($photo as $k=>$v){
                        $temp[$v['id']] = $v;
                    }
                    if($temp){
                        foreach ($album_id as $k=>$v){
                            if(isset($temp[$v]) && $temp[$v]){
                                $new[$k] = $temp[$v]['sy_img'];
                            }
                
                        }
                        foreach ($data['list'] as $k => $v){
                            if(isset($new[$v['id']]) && $new[$v['id']]){
                                $data['list'][$k]['cover_img'] = $new[$v['id']];
                            }
                        }
                    }
                }
            }
            
            //查询是全册购买的订单信息
            $all_image_where = array(
                            'in' => ['order_id' => $order_ids], 
                            'is_del' => 0, 
                            'product_type' => C('order.product_type.all_image.id')
            );
            $all_image = $this->Morder_detail->get_lists('id,product_id,order_id', $all_image_where);
            if($all_image){
                $all_image_products = array_column($all_image, 'product_id');
                //查询整册的封面图
                $all_image_info = $this->Mdinner_album->get_lists('id,cover_img', array('in' => ['id' => $all_image_products]));
                foreach ($all_image as $k => $v){
                    foreach ($all_image_info as $key => $value){
                        if($v['product_id'] == $value['id']){
                            $all_image[$k]['cover_img'] = $value['cover_img'];
                            break;
                        }
                    }
                }
                //合并全册数据与订单数据
                foreach ($data['list'] as $k => $v){
                    foreach ($all_image as $key => $value){
                        if($v['id'] == $value['order_id']){
                            $data['list'][$k]['cover_img'] = $value['cover_img'];
                        }
                    }
                }
            }
             
        }
        $this->load->view('order/new_index', $data);
    }

    public function del_order(){
        if(IS_POST){
            $data = $this->data;
            $id = (int) $this->input->post('id');
            if($id === 0){
                $this->return_json(['msg'=> '系统拒绝服务']);
            }
            $res = $this->Morder->update_info(['is_del' => 1], ['id'=> $id, 'user_id' => $data['user_info']['id']]);
            if(!$res){
                $this->return_json(['msg'=>'删除失败，请重试']);
            }
            $this->return_json(['code' => 1]);
        }
    }
  
    /**
     * 付款页面
     * @author louhang@gz-zc.cn
     */
    public function payment(){
        $data = $this->data;

        $orde_id = (int)$this->input->get('id');
        $data['order_id'] = $orde_id;
        $field = '*';
        $where = array('id' => $orde_id);
        $order = $this->Morder->get_one($field, $where);

        if(!$order){
            p('请求错误');
        }

        $data['is_photo'] = $order['order_type'] == C('order.order_type.image.id');
        
        //总共购买照片
        $field = '*';
        $where = array('order_id' => $order['id'], 'is_del' => 0);
        $album_photos = $this->Morder_detail->get_lists($field, $where);
        $photo_count = count($album_photos);
        $data['photo_count'] = $photo_count;
        //照片单价
        $data['photo_unit_price'] = $this->photo_unit_price;
        //百年婚宴免费赠送
        $data['free_photo_num'] = $order['favorable'] / $this->photo_unit_price ;
        //积分抵换
        $data['score_favorable'] = $order['score_favorable'];
        //优惠金额
        $data['favorable'] = $order['favorable'];
        //应付金额
        $data['need_pay'] = $order['need_pay'];
        //应付邮费

        $data['delivery_price'] = ($order['delivery_type'] == C('order.delivery_type.express.id')) ? $this->delivery_price : 0;
        
        if($order['status'] == C('order.pay_status.success.id')){
            $data['is_pay'] = 1;
        }else{
            $data['is_pay'] = 0;
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
                            'notify_url' => $this->data['domain']['mobile']['url'].'/wxpay/notify',
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
        }

        $this->load->view('order/payment', $data);
    }
    
    /**
     * 订单详情
     * @author louhang@gz-zc.cn
     */
    public function order_detail(){
        $data= $this->data;
        $data['action'] = '/order/index';
        $order_id = (int)$this->input->get_post('id');
        
        $field = '*';
        $where = array('id' => $order_id, 'user_id' => $data['user_info']['id'], 'is_del' => 0);
        $order = $this->Morder->get_one($field, $where);
        if(empty($order)){
            header('location:' . C('domain.base.url') . "/usercenter/user");
            exit;
        }
        $data['order'] = $order;
        
        //积分抵换
        $data['score_favorable'] = $order['score_favorable'];
        //优惠金额
        $data['favorable'] = $order['favorable'];
        //应付金额
        $data['need_pay'] = $order['need_pay'];
        //应付邮费
        $data['delivery_price'] = ($order['delivery_type'] == C('order.delivery_type.express.id')) ? $this->delivery_price : 0;

        //获取收货地址
        $field = '*';
        $where = array('order_id' => $order_id, 'is_del' => 0);
        $addr = $this->Morder_addr->get_one($field, $where);
        $data['addr'] = $addr;

        $order_detail = $this->Morder_detail->get_one('product_id,product_type,count', array('order_id' => $order_id, 'is_del' => 0));

        if($order_detail['product_type'] == C('order.product_type.image.id')){
            //获取相片id
            $field = 'product_id';
            $where = array('order_id' => $order_id, 'is_del' => 0);
            $photo_ids = $this->Morder_detail->get_lists($field, $where);
            $photo_ids = $photo_ids ? array_column($photo_ids, 'product_id') : '';
            //获取相片路径
            $field = 'id, thumb,sy_img';
            $where = array('in' => array('id' => $photo_ids), 'is_del' => 0);
            $album_photos = $this->Mdinner_images->get_lists($field, $where);
            $data['album_photos'] = $album_photos;
            $data['photo_count'] = count($album_photos);
            
            //免费赠送相片数
            $data['free_photo_num'] = $data['order']['favorable'] / $this->photo_unit_price ;
            //当前积分
            $field = '*';
            $where = array('dinner_id' => $order['dinner_id']);
            $data['score'] = $this->Mdinner_score->get_one($field, $where);
            //照片剩余免费张数
            $data['available_quota'] = $this->available_quota($order['dinner_id']);
            
            $this->load->view('order/photo_detail', $data);
        }
        else if($order_detail['product_type'] == C('order.product_type.album.id')){
            //计算相册数量
            $data['count'] = $order_detail['count'];
            
            $field = '*';
            $where = array('id' => $order_detail['product_id']);
            $data['album'] = $this->Mproducts->get_one($field, $where);
            
            $field = '*';
            $where = array('products_id' => $order_detail['product_id']);
            $album_attr =  $this->Mproducts_attribute->get_lists($field, $where);
            foreach ($album_attr as $k => $v){
                if($v['attribute'] == 'width'){
                    $data['width'] = $v['value'];
                }
                if($v['attribute'] == 'height'){
                    $data['height'] = $v['value'];
                }
            }
            
            $field = 'id';
            $where = array('order_id' => $order_id);
            $is_exist =  $this->Morder_addr->get_one($field, $where);
            if(!$is_exist){
                header('location:' . C('domain.base.url') . "/usercenter/album_detail_info?id={$order_id}");
                exit;
            }
            
            //读取订单入册的照片
            $photo_ids = $this->Malbum_images->get_one('image_order_id', ['album_order_id' => $order_id]);
            if($photo_ids){
                $tmp_ids = explode(',', $photo_ids['image_order_id']);
                if(count($tmp_ids) > 0){
                    //根据相片id查询相片
                    $field = 'id, thumb,img';
                    $where = array('in' => array('id' => $tmp_ids), 'is_del' => 0);
                    $photos = $this->Mdinner_images->get_lists($field, $where);
                    if(!empty($photos)){
                        $data['photos'] = $photos;
                    }     
                }    
            }
            $this->load->view('order/album_detail', $data);
            
        }
        elseif($order_detail['product_type'] == C('order.product_type.all_image.id')){
            //如果为全册购买订单
            //获取相片id
            $field = 'product_id';
            $where = array('order_id' => $order_id, 'is_del' => 0);
            $all_image = $this->Morder_detail->get_one($field, $where);
            //获取相片路径
            $field = 'id, thumb,sy_img';
            $where = array('album_id' => $all_image['product_id'], 'is_del' => 0);
            $album_photos = $this->Mdinner_images->get_lists($field, $where);
            $data['album_photos'] = $album_photos;
            $data['photo_count'] = count($album_photos);
            
            //免费赠送相片数
            $data['free_photo_num'] = $data['order']['favorable'] / $this->photo_unit_price ;
            //当前积分
            $field = '*';
            $where = array('dinner_id' => $order['dinner_id']);
            $data['score'] = $this->Mdinner_score->get_one($field, $where);
            //照片剩余免费张数
            $data['available_quota'] = $this->available_quota($order['dinner_id']);
            
            $this->load->view('order/photo_detail', $data);
        }elseif($order_detail['product_type'] == C('order.product_type.drink.id')){
            
            $field = '*';
            $where = array('id' => $order_detail['product_id']);
            $data['drink'] = $this->Mproducts->get_one($field, $where);
            
            $where = array('products_id' => $order_detail['product_id']);
            $drink_attr =  $this->Mproducts_attribute->get_lists('*', array('products_id' => $order_detail['product_id']));
            $data['special_lists'] = $this->Mspecifications->get_lists('*', array('products_id'=>$order_detail['product_id']));
            $data['special_lists'] = array_column($data['special_lists'], 'version_name', 'id');
            
            
            
            //获取酒水订单详情 可能存在一个订单对应多个商品问题
            $data['detail'] = $detail = $this->Morder_detail->get_lists('*', array('order_id'=>$order_id));
            $products_id = array_column($detail, 'product_id');
            $produdts_img = $this->Mproducts->get_lists('id, cover_img, title', array('in'=>array('id'=>$products_id)));
            $data['produdts_name'] = array_column($produdts_img, 'title', 'id');
            $data['produdts_img'] = array_column($produdts_img, 'cover_img', 'id');
            
            //假如存在规格 则读取对应的规格图片
            $special_id = array_column($detail, 'special_id');
            $special_img = $this->Mspecifications->get_lists('id, version_image', array('in'=>array('id'=>$special_id)));
            $special_img = array_column($special_img, 'version_image', 'id');
            $data['special_img'] = $special_img;
            
            //获取规格
            $attr_lists = $this->Mproducts_attribute->get_lists('*', array('in'=>array('products_id' => $products_id)));
            $attr_tmp = array();
            foreach ($attr_lists as $k=>$v){
                $attr_tmp[$v['products_id']][$v['attribute']] = $v['value'];
                $data['attr'] = $attr_tmp;
            }
            $this->load->view('order/new_drink_detail', $data);
        }
    }
    
    /**
     * 查看大图 判断是否购买该图
     * @author louhang@gz-zc.cn
     */
    public function is_purchased_photo(){

        $photo_id = (int)$this->input->post('photo_id');
        $order_id = (int)$this->input->post('order_id');
        
        $field = 'order_id';
        $where = array(
                        'order_id' => $order_id, 
                        'product_id' => $photo_id, 
                        'in' => ['product_type' => [C('order.product_type.image.id'), C('order.product_type.all_image.id')]], 
                        'is_del'=>0
        );
        $order_detail = $this->Morder_detail->get_one($field, $where);

        $field = 'status,order_type';
        $where = array('id' => $order_id, 'is_del'=>0);
        $order_status = $this->Morder->get_one($field, $where);
        
        //如果是整册购买，不需要具体判断该相片是否购买
        $image_is_pay = FALSE;
        if($order_status['order_type'] == C('order.order_type.all_image.id')){
            $image_is_pay = TRUE;
        }else{
            if($order_detail){
                $image_is_pay = TRUE;
            }
        }
        
        if($order_status['status'] == C('order.pay_status.success.id') && $image_is_pay){
            $field = '*';
            $where = array('id' => $photo_id);
            $photo = $this->Mdinner_images->get_one($field, $where);
            if($photo){
                $this->return_success(array('image' => get_img_url($photo['img'])));
            }
            
        }else{
            $this->return_failed('您未购买该图片，请付款后查看高清图');
        }
    }
    
    /**
     * 查看大图
     * @author louhang@gz-zc.cn
     */
    public function view_HD_picture(){
        $data = $this->data;
        
        $photo_id = (int)$this->input->get('photo_id');
        $order_id = (int)$this->input->get('order_id');
        
        $field = 'order_id';
        $where = array(
                        'order_id' => $order_id, 
                        'product_id' => $photo_id, 
                        'in' => ['product_type' => [C('order.product_type.image.id'), C('order.product_type.all_image.id')]], 
                        'is_del'=>0
        );
        $order_detail = $this->Morder_detail->get_one($field, $where);

        $field = 'status,order_type';
        $where = array('id' => $order_id, 'is_del'=>0);
        $order_status = $this->Morder->get_one($field, $where);
        
        //如果是整册购买，不需要具体判断该相片是否购买
        $image_is_pay = FALSE;
        if($order_status['order_type'] == C('order.order_type.all_image.id')){
            $image_is_pay = TRUE;
        }else{
            if($order_detail){
                $image_is_pay = TRUE;
            }
        }
        
        if($order_status['status'] == C('order.pay_status.success.id') && $image_is_pay){
            $field = '*';
            $where = array('id' => $photo_id, 'is_del'=>0);
            $photo = $this->Mdinner_images->get_one($field, $where);
            $photo = isset($photo['img']) ? $photo['img'] : '';
            $data['image'] = get_img_url($photo);
            $data['photo_id'] = $photo_id;
            $data['order_id'] = $order_id;
            $this->load->view('order/view_HD_picture', $data);
        }  
    }
    
    /**
     * 下载图片
     * @author louhang@gz-zc.cn
     */
    public function download_picture(){
        $data = $this->data;
        
        $photo_id = (int)$this->input->get('photo_id');
        $order_id = (int)$this->input->get('order_id');
        $field = 'order_id';
        $where = array(
                        'order_id' => $order_id, 
                        'product_id' => $photo_id, 
                        'in' => ['product_type' => [C('order.product_type.image.id'), C('order.product_type.all_image.id')]], 
                        'is_del'=>0
        );
        $order_detail = $this->Morder_detail->get_one($field, $where);

        $field = 'status,order_type';
        $where = array('id' => $order_id, 'is_del'=>0);
        $order_status = $this->Morder->get_one($field, $where);
        
        //如果是整册购买，不需要具体判断该相片是否购买
        $image_is_pay = FALSE;
        if($order_status['order_type'] == C('order.order_type.all_image.id')){
            $image_is_pay = TRUE;
        }else{
            if($order_detail){
                $image_is_pay = TRUE;
            }
        }
        
        if($order_status['status'] == C('order.pay_status.success.id') && $image_is_pay){
            $field = '*';
            $where = array('id' => $photo_id, 'is_del'=>0);
            $photo = $this->Mdinner_images->get_one($field, $where);
            $file = get_img_url($photo['img']);
            $path_parts = pathinfo($file);
            $file_name  = $path_parts['basename'];
            $file_path  = '/mysecretpath/' . $file_name;
            
            $str = file_get_contents($file);
            header('Content-Description: File Transfer'); //描述页面返回的结果
            header('Content-Type: application/octet-stream'); //返回内容的类型，此处只知道是二进制流。具体返回类型可参考http://tool.oschina.net/commons
            header('Content-Disposition: attachment; filename='.basename($file));//可以让浏览器弹出下载窗口
            header('Content-Transfer-Encoding: binary');//内容编码方式，直接二进制，不要gzip压缩
            header('Expires: 0');//过期时间
            header('Cache-Control: must-revalidate');//缓存策略，强制页面不缓存，作用与no-cache相同，但更严格，强制意味更明显
            header('Pragma: public');
            header('Content-Length: ' . strlen($str));//文件大小，在文件超过2G的时候，filesize()返回的结果可能不正确
            
            echo $str;
        }  
    }
    
    /**
     * 照片剩余免费张数
     * @author louhang@gz-zc.cn
     */
    public function available_quota($dinner_id = 0){

        $dinner_id = (int)$dinner_id;
        
        //根据宴会id 获取订单信息
        $where = array('dinner_id' => $dinner_id, 'is_del' => 0, 'order_type' => C('order_type')['image']['id']);
        $order = $this->Morder->get_lists('id, order_type', $where);
        if(!$order){
            return $this->free_quota;
        }
        
        //读取相册照片购买形式
        $order_type = C('order_type');
        
        //订单分类
        $single_photo = array();
        $album = array();
        foreach ($order as $k => $v){
            //单张购买
            if($v['order_type'] == $order_type['image']['id']){
                $single_photo[] = $v['id'];
            }
        }
        
        //单张购买所使用的免费额度
        if($single_photo){
            $where = array('in' => array('order_id' => $single_photo));
            $photo_num = $this->Morder_detail->count($where);
            $this->free_quota = $this->free_quota - $photo_num;
            if($this->free_quota <= 0){
                return 0;
            }
        }
        
        //整本相册购买所使用的免费额度
        if($album){
            $where = array('in' => array('order_id' => $album));
            $photo_num = $this->Morder_detail->get_one('sum(count) as num' ,$where);
            $this->free_quota = $this->free_quota - $photo_num['num'];
            if($this->free_quota <= 0){
                return 0;
            }
        }
        
        return $this->free_quota;

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
}

    
