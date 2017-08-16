<?php 
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 手机端 相册详情
 * @author louhang@gz-zc.cn
 */
class Album extends MY_Controller{
    
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
                
        ]);

        $this->free_quota = C('order.product_type.image.free_quota');       //照片免费额度
        $this->photo_unit_price = C('order.product_type.image.unit_price');  //照片单价
        $this->delivery_price = C('order.delivery_type.express.price');    //邮费
    }
    

    
    /**
     * 相册详情 首页
     * @author louhang@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $id = (int) $this->input->get('id');
        
        //相册信息
        $field = '*';
        $where = array('id' => $id, 'is_del' => 0);
        $album = $this->Mdinner_album->get_one($field, $where);
        $data['album'] = $album;
        
        //已购买过的照片
        $field = 'id';
        
        $where = array('dinner_id' => $album['dinner_id'], 'status' => C('order.pay_status.success.id'), 'is_del' => 0);
        $purchased_order_ids = $this->Morder->get_lists($field, $where);
        $purchased_order_ids = $purchased_order_ids ? array_column($purchased_order_ids, 'id') : '';
        $field = 'product_id';
        $where = array('in' => array('order_id' => $purchased_order_ids), 'product_type' => C('order.product_type.image.id'));
        $purchased_photo = $this->Morder_detail->get_lists($field, $where);
        $purchased_photo = $purchased_photo ? array_column($purchased_photo, 'product_id') : [];
        
        //相册包含的照片
        $field = 'id,img,thumb,sy_img';
        $where = array('album_id' => $id, 'is_del' => 0);
        $album_photos = $this->Mdinner_images->get_lists($field, $where);
        //标记已购买过的相片
        foreach ($album_photos as $k => $v){
            $album_photos[$k]['is_purchased'] = in_array($v['id'], $purchased_photo) ? 1 : 0;
        }
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
        
        //相册关联的文章
        $field = 'id, title, summary';
        $where = array('id' => $album['article_id'], 'is_del' => 0);
        $news = $this->Mnews->get_one($field, $where);
        $data['news'] = $news;
        
        //该相册的关联相册
        $field = 'id, name, cover_img';
        $where = array('dinner_id' => $album['dinner_id'], 'is_del' => 0);
        $order_by = array('create_time' => 'desc');
        $switch_album = $this->Mdinner_album->get_lists($field, $where, $order_by);
        $album_ids = $switch_album ? array_column($switch_album, 'id') : '';
        $field = 'album_id, count(id) as num';
        $where = array('in' => array('album_id' => $album_ids), 'is_del' => 0);
        $group_by = 'album_id';
        $album_num = $this->Mdinner_images->get_lists($field, $where, $order_by, 0, 0, $group_by);
        $album_num = $album_num ? array_column($album_num, 'num', 'album_id') : [];
        foreach ($switch_album as $k => $v){
            $switch_album[$k]['num'] = isset($album_num[$v['id']]) ? $album_num[$v['id']] : 0; 
        }
        $data['switch_album'] = $switch_album;

        //照片剩余免费张数
        $data['available_quota'] = $this->available_quota($album['dinner_id']);

        //获取地址
        $field = '*';
        $addr = $this->Muser_addr->get_one($field, array('user_id' => $data['user_info']['id'], 'is_del' => 0));
        $data['addr'] = $addr;
        
        //获取用户积分
        $score = $this->Mdinner_score->get_one($field, array('dinner_id' => $album['dinner_id']));
        $data['score'] = $score ? $score['score'] : 0;
        
        $this->load->view('album/index', $data);
    }
    
    /**
     * 填写收货地址 首页
     * @author louhang@gz-zc.cn
     */
    public function address(){
        $data = $this->data;
        $para = $this->input->get('para');
        $para = json_decode($para, true);
        $dinner_id = (int)$para['dinner_id'];
        $photo_ids = isset($para['ids']) && !empty($para['ids']) ? $para['ids'] : '';
        $data['dinner_id'] = $dinner_id;
        //判断是否整册购买
        $order_type = isset($para['type']) && !empty($para['type']) ? intval($para['type']) : '';
        
        //购买的照片
        $field = 'id, thumb,sy_img';
        $where = array('is_del' => 0);
        if($order_type == C('order.order_type.all_image.id')){
            $where['album_id'] = $photo_ids;
            //查询相册价格等信息
            $data['album'] = $this->Mdinner_album->get_one('id,price', array('id' => $photo_ids));
        }else{
            $where['in'] = array('id' => $photo_ids);
        }
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
        
        //获取用户收货地址
        $field = '*';
        $where = array('user_id' => $data['user_info']['id'], 'is_del' => 0);
        $addr = $this->Muser_addr->get_one($field, $where);
        $data['addr'] = $addr;
        
        //获取用户积分
        $field = '*';
        $where = array('dinner_id' => $dinner_id);
        $score = $this->Mdinner_score->get_one($field, $where);
        $data['score'] = $score ? $score['score'] : 0;
        
        //照片剩余免费张数
        $data['available_quota'] = $this->available_quota($dinner_id);
        
        //用户可用积分
        $total_price = ( $data['photo_count'] -$data['available_quota'] ) * $this->photo_unit_price;
        $data['available_score'] = $data['score'] > $total_price ? $total_price : $data['score'];
        
        if($order_type == C('order.order_type.all_image.id')){
            $this->load->view('album/pay_all_image', $data);
        }else{
            $this->load->view('album/address', $data);
        }
    }
    
    /**
     * 订单信息确认
     * @author louhang@gz-zc.cn
     */
    public function checkout(){
        $data = $this->data;
        
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            //是否全册购买
            $is_all_image = isset($post_data['type']) && $post_data['type'] == C('order.order_type.all_image.id');
            
            $dinner_id = (int)$post_data['dinner_id'];
            
            //免费照片额度：favorable,  积分抵消: score_favorable
            $favorable = 0;
            $score_favorable = 0;
            
            //照片核实，计算总价
            $photo_ids = isset($post_data['photo_ids']) && !empty($post_data['photo_ids']) ? $post_data['photo_ids'] : '';
            if(!$photo_ids){
                $this->return_failed('订单创建失败,请重新下单');
            }
            
            if($is_all_image){
                //如果是购买全册，查询全册价格
                $album = $this->Mdinner_album->get_one('id,name,price', array('id' => $photo_ids[0]));
                if(!$album){
                    $this->return_failed('订单创建失败');
                }
                $need_pay = $album['price'];
                $favorable = 0;
            }else{
                $field = 'id';
                $where = array('in' => array('id' => $photo_ids), 'is_del' => 0);
                $album_photos = $this->Mdinner_images->get_lists($field, $where);
                $photo_count = count($album_photos);
                $need_pay = $photo_count * $this->photo_unit_price;
                
                //免费照片
                $data['available_quota'] = $this->available_quota($dinner_id);
                $data['available_quota'] = $data['available_quota'] > $photo_count ? $photo_count : $data['available_quota'];
                $favorable += $data['available_quota'] * $this->photo_unit_price;
            }
            
            
            //是否积分抵消
            if($post_data['is_use_score']){
                $field = '*';
                $where = array('dinner_id' => $dinner_id);
                $score = $this->Mdinner_score->get_one($field, $where);
                $score = $score ? $score['score'] : 0;
                $score_favorable = $score > $need_pay ? $need_pay : $score;

                //减去用掉的积分
                $this->Mdinner_score->update_info(array('decr' => array('score' => $score_favorable)), $where);
            }
            
            //需要支付的金额
            $need_pay -= ($favorable + $score_favorable);
            
            //订单类型
            if($is_all_image){
                $product_type = C('order.product_type.all_image');
            }else{
                $product_type = C('order.product_type.image');
            }
            //生成订单
            $order_date = array(
                'order_id' => get_orderid(),
                'user_id' => $data['user_info']['id'],
                'dinner_id' => $dinner_id,
                'bill_create_ip' => get_client_ip(),
                'need_pay' => $need_pay,
                'favorable' => $favorable,
                'score_favorable' => $score_favorable,
                'pay_type' => 1, //默认微信支付
                'delivery_type' => C('order.delivery_type.ziti.id'),
                'order_type' => $product_type['id'],
                'create_time' => date('Y-m-d H:i:s'),
            );
            if($need_pay == 0){
                $order_date['status'] = C('order.pay_status.success.id');
            }
            $order_id = $this->Morder->create($order_date);
            if($order_id <= 0){
                $this->return_failed('订单创建失败,请重新下单');
            }
            
            //照片信息记录到order_detail 表
            $photos_data = array();
            if(empty($photo_ids)){
                $this->return_failed('订单创建失败,请重新下单');
            }
            foreach ($photo_ids as $photo_id){
                $photos_data[] = array(
                    'order_id' => $order_id,
                    'product_id' => $photo_id,
                    'product_type' => $product_type['id'],
                    'product_name' => $is_all_image ? $album['name'] : $product_type['name'],
                    'price' => $is_all_image ? $album['price'] : $this->photo_unit_price,
                    'count' => 1
                );
            }
            $this->Morder_detail->create_batch($photos_data);
            
            //物流信息
            $delivery_data = array(
                'name' => $post_data['addr_name'],
                'mobile_phone' => $post_data['addr_mobile_phone']
            );
            $delivery_data['order_id'] = $order_id;
            $this->Morder_addr->create($delivery_data);
            
            $this->return_success(array('id' => $order_id), '订单创建成功,请及时付款!');

        }
    }
    
    /**
     * 付款页面
     * @author louhang@gz-zc.cn
     */
    public function payment(){
        $data = $this->data;
        $orde_id = (int)$this->input->get('id');
        $field = '*';
        $where = array('id' => $orde_id);
        $order = $this->Morder->get_one($field, $where);
        $data['order'] = $order;
        
        if(!$order){
            p('请求错误');
        }
        
        $where = array('order_id' => $order['id'], 'is_del' => 0);
        $album_photos = $this->Morder_detail->get_lists($field, $where);
        $photo_count = count($album_photos);
        $data['photo_count'] = $photo_count;
        $data['photo_unit_price'] = $this->photo_unit_price;
        $data['delivery_price'] = $this->delivery_price;

        $this->load->view('album/payment', $data);
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

    