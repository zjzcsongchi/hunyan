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
                        'Model_order_addr' => 'Morder_addr',
                        'Model_dinner_score' => 'Mdinner_score',
                        'Model_products' => 'Mproducts',
                        'Model_products_attribute' => 'Mproducts_attribute',
                        'Model_album_image' => 'Malbum_image',
                        'Model_specifications' => 'Mspecifications'
                
        ]);
        $data = $this->data;
        if (!$data['user_info']) {
            redirect(C('domain.mobile.url') . '/passport/redirect_wechat_login');
        }
        
        //加载相关类库
        $weixin_config = array(
                        'app_id' => C('wechat_app.app_id.value'),
                        'app_secret' => C('wechat_app.app_secret.value'),
                        'key' => C('wechat_app.key.value'),
                        'mch_id' => C('wechat_app.mch_id.value')
        );
        $this->load->library('weixinpay', $weixin_config);
        
        $this->free_quota = C('order.product_type.image.free_quota');       //照片免费额度
        $this->photo_unit_price = C('order.product_type.image.unit_price');  //照片单价
        $this->delivery_price = C('order.delivery_type.express.price');    //邮费

    }

 
    /**
     * 订单列表
     */
    public function index(){
        $data = $this->data;
        //获取当前用户订单
        $where = [
            'is_del' => 0,
            'user_id' => $data['user_info']['id'],
            'in' => ['order_type' => [C('order_type.image.id'), C('order_type.album.id'), C('order_type.drink.id'), C('order.order_type.all_image.id')] ]
        ];
        $order =['create_time' => 'desc'];
        $list = $this->Morder->get_lists('id,order_id,need_pay,favorable,status,order_type', $where, $order);
        if($list){
            $data['list'] = $list;
            //查找订单包含的产品
            $order_ids = array_column($list, 'id');
            $product = $this->Morder_detail->get_lists('order_id,product_id', ['in' => ['order_id' => $order_ids], 'is_del' => 0]);
            $product_ids = array_unique(array_column($product, 'product_id'));
            //根据产品id查询产品封面图
            $info = $this->Mproducts->get_lists('id,cover_img', ['in' => ['id' => $product_ids]]);
            //拼接封面图，封面图信息和订单详情合并
            if($product && $info){
                foreach ($product as $k => $v){
                    foreach ($info as $kk => $vv){
                        if($v['product_id'] == $vv['id']){
                            if(isset($vv['cover_img'])){
                                $product[$k]['cover_img'] = $vv['cover_img'];
                            }
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
                    }
                }
            }
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

            $this->load->view('order/index', $data);
        }else{
            $this->load->view('order/no_order', $data);
        }
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
        $order_id = (int)$this->input->get('id');
        $data['order_id'] = $order_id;
        $field = '*';
        $where = array('id' => $order_id);
        $order = $this->Morder->get_one($field, $where);
        $data['order'] = $order;
        
        
        if(!$order){
            p('请求错误');
        }
        
        if($order['status'] == C('order.pay_status.success.id')){
            redirect($data['domain']['mobile']['url'].'/order/order_detail?id='.$order_id);
            exit;
        }
        
        //获取收货地址
        $field = '*';
        $where = array('order_id' => $order_id, 'is_del' => 0);
        $addr = $this->Morder_addr->get_one($field, $where);
        $data['addr'] = $addr;
        $data['delivery_price'] = ($order['delivery_type'] == C('order.delivery_type.express.id')) ? $this->delivery_price : 0;

        $field = '*';
        $where = array('order_id' => $order['id'], 'is_del' => 0);
        $order_detail = $this->Morder_detail->get_lists($field, $where);
        
        switch ($order['order_type']){
            case C('order.order_type.image.id'):;
            case C('order.order_type.album.id'):
                $data['product_name'] = array_column($order_detail, 'product_name', 'product_name');
                break;
            case C('order.order_type.all_image.id'):
                $data['product_name'] = array_column($order_detail, 'product_name', 'product_name');
                break;
            case C('order.order_type.drink.id'):
                foreach ($order_detail as $k => $v){
                    $name = $v['product_name'];
                    $name .= $v['special_name']?'('.$v['special_name'].')':'';
                    $name .= ' X '.$v['count'];
                    
                    $data['product_name'][] = $name;
                }
                break;
        }
       
        $data['product_price'] = reset($order_detail)['price'];
        $data['count'] = reset($order_detail)['count'];
        
        $data['photo_unit_price'] = $this->photo_unit_price;
        //判断是否为相片
        if($order['order_type'] == C('order.order_type.image.id')){
            //总计张数
            $photo_count = count($order_detail);
            $data['photo_count'] = $photo_count;
            //免费赠送相片数
            $data['free_photo_num'] = $data['order']['favorable'] / $data['photo_unit_price'];
            
        }else if($order['order_type'] == C('order.order_type.album.id')){
            $images = $this->Malbum_image->get_one('*', array('album_order_id' => $order_id));
            $images = explode(',', $images['image_order_id']);
            $data['photo_count'] = count($images);
            
        }else if($order['order_type'] == C('order.order_type.drink.id')){
            
        }else if($order['order_type'] == C('order.order_type.all_image.id')){
            $data['photo_count'] = $this->Mdinner_images->count(array('album_id' => $order_detail[0]['product_id'], 'is_del' => 0));
        }

        
        //查询用户openid
        $user_info = $this->Muser->get_one('open_id', array('id' => $this->data['user_info']['id']));
        
        $type = C('order.product_type');
        $type = array_column($type, 'name', 'id');
        $type_name = $type[$order['order_type']];
        
        //微信支付统一下单
        $pay_param = array(
//                         'body' => '百年婚宴 相册',
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
        $this->Morder->update_info(array('prepay_id' => $response['data']['prepay_id']), array('id' => $order_id));
        //获取jsbridge配置json串
        $data['jsbridge_str'] = $this->weixinpay->get_jsbridge_param($response['data']['prepay_id']);

        $this->load->view('order/payment', $data);
    }
    
    /**
     * 订单详情
     * @author louhang@gz-zc.cn
     */
    public function order_detail(){
        $data= $this->data;
        $order_id = (int)$this->input->get_post('id');
        
        $field = '*';
        $where = array('id' => $order_id, 'is_del' => 0);
        $order = $this->Morder->get_one($field, $where);
        $data['order'] = $order;
        
        //获取收货地址
        $field = '*';
        $where = array('order_id' => $order_id, 'is_del' => 0);
        $addr = $this->Morder_addr->get_one($field, $where);
        $data['addr'] = $addr;

        $order_detail = $this->Morder_detail->get_one('product_id,product_type,count,price', array('order_id' => $order_id, 'is_del' => 0));
        if($order_detail['product_type'] == C('order.product_type.image.id')){
            //相片订单详情
            $this->images($data, $order, $order_id);
        }
        else if($order_detail['product_type'] == C('order.product_type.album.id')){
            //相册订单详情
            $this->albums($data, $order_detail, $order_id);
            
        }else if($order_detail['product_type'] == C('order.product_type.drink.id')){
            //酒水订单详情
            $this->drink($data,$order_id);
        }else if($order_detail['product_type'] == C('order.product_type.all_image.id')){
            //全册购买详情
            $this->all_image($data, $order, $order_id);
        }
    }
    /**
     * 相片订单详情
     * @param unknown $data
     * @param unknown $order
     * @param unknown $order_id
     */
    private function images($data, $order, $order_id){
        $field = 'product_id';
        $where = array('order_id' => $order_id, 'is_del' => 0);
        $photo_ids = $this->Morder_detail->get_lists($field, $where);
        $photo_ids = $photo_ids ? array_column($photo_ids, 'product_id') : '';
        //获取相片路径
        $field = 'id, thumb,sy_img';
        $where = array('in' => array('id' => $photo_ids));
        $album_photos = $this->Mdinner_images->get_lists($field, $where);
        
        //照片左右显示
        $data['album_photos_left'] = array();
        $data['album_photos_right'] = array();
        foreach ($album_photos as $k => $v){
            if($k % 2 == 0){
                $data['album_photos_left'][] = $v;
            }else{
                $data['album_photos_right'][] = $v;
            }
        }
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
    /**
     * 全册购买订单详情
     * @param unknown $data
     * @param unknown $order
     * @param unknown $order_id
     */
    private function all_image($data, $order, $order_id){
        $field = 'product_id';
        $where = array('order_id' => $order_id, 'is_del' => 0);
        $photo_id = $this->Morder_detail->get_one($field, $where);
        //获取相片路径
        $field = 'id, thumb,sy_img';
        $where = array('album_id' => $photo_id['product_id']);
        $album_photos = $this->Mdinner_images->get_lists($field, $where);
        
        //照片左右显示
        $data['album_photos_left'] = array();
        $data['album_photos_right'] = array();
        foreach ($album_photos as $k => $v){
            if($k % 2 == 0){
                $data['album_photos_left'][] = $v;
            }else{
                $data['album_photos_right'][] = $v;
            }
        }
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
    /*
     * 相册订单详情
     */
    private function albums($data, $order_detail, $order_id){
        $data['count'] = $order_detail['count'];
        $data['price'] = $order_detail['price'];
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
        
        $images = $this->Malbum_image->get_one('*', array('album_order_id' => $order_id));
        $images = explode(',', $images['image_order_id']);
        $images = $images ? $images : '';
        $album_photos = $this->Mdinner_images->get_lists('*', array('in' => array('id' => $images)));
        
        //照片左右显示
        $data['album_photos_left'] = array();
        $data['album_photos_right'] = array();
        foreach ($album_photos as $k => $v){
            if($k % 2 == 0){
                $data['album_photos_left'][] = $v;
            }else{
                $data['album_photos_right'][] = $v;
            }
        }
        $data['album_photos'] = $album_photos;
        $data['photo_count'] = count($album_photos);
        
        $this->load->view('order/album_detail', $data);
    }
    
    /**
     * 酒水订单详情
     * @param unknown $data
     * @param unknown $order_id
     */
    private function drink($data,$order_id){
        $where = [
            'is_del' => 0,
            'product_type' => C('order.product_type.drink.id'),
            'order_id' => $order_id
        ];
        $detail_list = $this->Morder_detail->get_lists('*',$where);
        if($detail_list){
            $data['detail_list'] = $detail_list;
            //获取special_id
            $special_ids = array_column($detail_list, 'special_id');
            if($special_ids){
                //获取规格的图片
                $where = [
                    'in' => ['id' => $special_ids]
                ];
                $special = $this->Mspecifications->get_lists('id,version_image', $where);
                if($special){
                    foreach ($detail_list as $k => $v){
                        foreach ($special as $key => $val){
                            if($v['special_id'] == $val['id']){
                                $data['detail_list'][$k]['img'] = $val['version_image'];
                            }
                        }
                    }
                }
            }
            //获取商品封面图
            $goods_ids = array_column($detail_list, 'product_id');
            if($goods_ids){
                $goods = $this->Mproducts->get_lists('id,title,cover_img', ['in'=> ['id' => $goods_ids], 'is_del'=> 0]);
                if($goods){
                    foreach ($detail_list as $k => $v){
                        foreach ($goods as $key => $val){
                            if($v['product_id'] == $val['id']){
                                $tmp = explode(',', $val['cover_img']);
                                $data['detail_list'][$k]['cover_img'] = $tmp[0];
                                $data['detail_list'][$k]['title'] = $val['title'];
                            }
                        }
                    }
                }
            }
        }
        
        $this->load->view('order/drink_detail', $data);
    }
    
    /**
     * 查看大图
     * @author louhang@gz-zc.cn
     */
    public function view_HD_picture(){
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

        $field = 'status, order_type';
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
            $this->return_success(array('image' => get_img_url($photo['img'])));
        }else{
            $this->return_failed('您未购买该图片，请付款后查看高清图');
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
    
}

    
