<?php 
/**
* 个人中心制器
* @author yonghua@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Usercenter extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_dinner' => 'Mdinner',
            'Model_user_dinner' => 'Muser_dinner',
            'Model_dinner_detail' => 'Mdinner_detail',
            'Model_dinner_images' => 'Mdinner_images',
            'Model_venue' => 'Mvenue',
            'Model_dish' => 'Mdish',
            'Model_user' => 'Muser',
            'Model_coupon' => 'Mcoupon',
            'Model_user_coupon' => 'Muser_coupon',
            'Model_coupon_type' => 'Muser_coupon_type',
            'Model_customer' => 'Mcustomer',
            'Model_products' => 'Mproducts',
            'Model_order' => 'Morder',
            'Model_news' => 'Mnews',
            'Model_bless' => 'Mbless',
            'Model_album_image' => 'Malbum_image',
            'Model_products_attribute' => 'Mproducts_attribute',
            'Model_specifications' => 'Mspecifications'
        ]);
        $this->data['header_show'] = true; //调整header class
        $data = $this->data;
        if(!$data['user_info']['id']){
            redirect(C('domain.base.url'));
        }
        
        //查找用户婚宴id
        $dinner = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $data['user_info']['id']]);
        if($dinner){
            $info = $this->Mdinner->get_one('id', ['in' => ['id' => array_column($dinner, 'dinner_id')], 'venue_type' => C('party.wedding.id'), 'is_del' => 0 ]);
        }
        if(isset($info)){ 
            $data['dinner_id'] = $info['id'];
            //祝福数
            $this->data['bless_nums'] = $this->Mbless->count(['is_del' => 0, 'dinner_id' =>  $info['id']]);
        }
        $this->data['coupon_nums'] = $this->Muser_coupon->count(['user_id' => $data['user_info']['id'], 'status' => C('coupon.status.no_use.id')]);
        $this->data['header_show'] = true; //调整header class
    }
    
    public function wedding(){
        
        $data = $this->data;
        $data['url'] = 'wedding';
        $data['action'] = 'usercenter/wedding';
        $start = 1;
        $dstart = 1;
        $size = 8;
        $user_dinner = $this->Muser_dinner->get_one('dinner_id',['user_id' => $data['user_info']['id']]);
        if($user_dinner){
            $dinner_field = 'id,venue_id,solar_time,lunar_time,banquet_time,cover_img,images,video,video_title,video_intro,is_dish_share,is_images_share,is_video_share';
            $dinner_where = array('is_del' => 0, 'venue_type' => C('party.wedding.id'));
            $dinner = $this->Mdinner->info($user_dinner['dinner_id'], $dinner_where);
            //拼接婚宴信息
            if($dinner){
                $img_list = explode(',', $dinner['images']);
                if(!empty($img_list[0])){
                    foreach ($img_list as $kk => $vv){
                        $temp[] = get_img_url($vv);
                    }
                    $images = $temp;
                }
                
                $data['dinner'] = $dinner;
                $data['dinner']['cover_img'] = $dinner['cover_img'] ? get_img_url($dinner['cover_img']) : $data['domain']['static']['url'].'/www/images/default-banner1.jpg';
                
                //查找宴会详情包含的菜谱
                $res = $this->Mdinner_detail->get_one('id,dishs_id', ['dinner_id' => $dinner['id']]);
                if($res){
                    $dish_field = 'name,cover_img,description';
                    $dish = $this->Mdish->get_lists($dish_field, ['in' => array('id' => array_unique(explode(',', $res['dishs_id']))) ]);
                    foreach ($dish as $k => $v){
                        $dish[$k] = $v;
                        $dish[$k]['cover_img'] = get_img_url($v['cover_img']);
                    }
                }
            
                $venue_field = 'name,max_table,container,device,images';
                $venue_list = $this->Mvenue->get_lists($venue_field, array('in' => ['id' => $dinner['venue_ids'] ]));
                //拼接场馆信息
                if($venue_list){
                    foreach ($venue_list as $k => $v){
                        $image_list = explode(',', $v['images']);
                        if($image_list){
                            foreach ($image_list as $key => $value){
                                $image_list[$key] = get_img_url($value);
                            }
                        }
                        $venue_list[$k]['images'] = $image_list;
                    }
                    $data['venue'] = $venue_list[0];
                }
                if(isset($images)){
                    $data['image_page'] = ceil(count($images)/$size);
                    //如果没有指定分页
                    for($i=($start-1)*($size-1); $i<($start+$size-1); $i++){
                        if(isset($images[$i])){
                            $data['images'][$i] = $images[$i];
                        }
                    }
                }
                
                if(isset($dish)){
                    $data['dish_page'] = ceil(count($dish)/$size);
                    for($i=($dstart-1)*($size-1); ($i<($dstart+$size-1)); $i++){
                        if(isset($dish[$i])){
                            $data['dish'][$i] = $dish[$i];
                        }
                    }
                }
                
            }
        }
        
        $this->load->view('usercenter/wedding', $data);
    }
    
    public function user(){
        $data = $this->data;
        //p($data);
        $data['action'] = '/usercenter/user';
        $user_id = $data['user_info']['id'];
        $user_dinner = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $user_id]);
        //过滤掉已删除宴会
        $dinners = array();
        if($user_dinner){
            $dinners = $this->Mdinner->get_lists('id', array('is_del' => 0, 'in' => array('id' => array_column($user_dinner, 'dinner_id'))));
        }
        $res = [];
        if(isset($dinners[0]['id'])){
            $data['dinner_id'] = $res['dinner_id'] = $dinners[0]['id'];
        }
        if($res){
            //查询宴会的相册
            $list = $this->Mdinner_album->get_lists('*', ['dinner_id' => $res['dinner_id'], 'is_del' => 0]);
            if($list){
                $data['list'] = $list;
                $album_ids = array_column($list, 'id');
                if(count($album_ids) > 0){
                    //获取当前宴会所有的相册
                    $album = $this->Mdinner_images->get_lists('id,album_id',['is_del' => 0, 'in' => ['album_id' => $album_ids]], ['create_time' => 'desc']);
                    //拼接相册包含的相片数目
                    if($album){
                        foreach ($list as $k => $v){
                            $data['list'][$k]['count'] = 0;
                            foreach ($album as $kk => $vv){
                                if($v['id'] == $vv['album_id']){
                                    $data['list'][$k]['count'] += 1;
                                }
                            }
                        }
                    }
                    //查询关联的文章
                    //获得文章id
                    $article_ids = array_column($list, 'article_id');
                    if(count($article_ids) > 0){
                        $new = $this->Mnews->get_lists('id, title,summary', ['in' => ['id' => $article_ids], 'is_del' => 0]);
                        if($new){
                            foreach ($list as $k => $v){
                                foreach ($new as $kk => $vv){
                                    if($v['article_id'] == $vv['id']){
                                        $data['list'][$k]['art'] = $vv;
                                    }
                                }
                            }
                        }
                    } 
                }
            }
        }
        
        //查询相册册子产品
        $data['lists'] = $this->Mproducts->get_lists('id,title,cover_img', ['is_del' => 0,'class_id' => C('order.product_type.album.id')]);
        
        $this->load->view('usercenter/user', $data);
    }
    
    /**
     * 添加订单详情页面
     */
    public function is_have_photo_order(){
        $data = $this->data;
        $user_id = $data['user_info']['id'];
        $res = $this->Morder->get_one('id', array('user_id' =>$user_id, 'status' => C('order.pay_status.success.id'), 'order_type' => C('order.order_type.image.id'),'is_del' => 0));
        if($res){
            $this->return_success('','参数错误');
        }else{
            $this->return_failed('请先购买相片');
        }
    }
    
    /**
     * 册子详情
     * @author yonghua@gz-zc.cn
     */
    public function album_detail(){
        $data = $this->data;
        $data['action'] = '/usercenter/user';
        $id = (int) $this->input->get('id');
        $list = $this->Mproducts->get_one('id,title,cover_img,images,info,present_price',['is_del'=> 0, 'id' => $id]);
        if(!$list){
            redirect(C('domain.mobile.url').'/usercenter');
        }
        if(!empty($list['images'])) {
            $list['images'] = explode(',', $list['images']);
        }
        $data['id'] = $id;
        $info = $this->Mproducts_attribute->get_lists('attribute,value', ['products_id' => $id]);
        if($info){
            $list['list'] = $info;
        }
        $data['info'] = $list;
        //读取册子的规格
        $p_type = $this->Mspecifications->get_lists('id,version_name,version_price', ['products_id' => $id]);
        if($p_type){
            $data['info']['type_price'] = $p_type;
        }
        //读取当前宴会跟拍
        $user_id = $data['user_info']['id'];
        $user_dinner = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $user_id]);
        $dinner_ids = array_column($user_dinner, 'dinner_id');
        if(count($dinner_ids) > 0){
            if($user_dinner){
                $dinners = $this->Mdinner->get_one('following_effect', array('is_del' => 0,'venue_type' => C('party.wedding.id'),'in' => array('id' => $dinner_ids)));
                if($dinners){
                    $data['info']['following_effect'] = $dinners['following_effect'];
                }
            }
        }
        $this->load->view('usercenter/album_detail', $data);
    }
    
    /**
     * 添加订单详情页面
     */
    public function album_detail_info(){
        $data = $this->data;
        $data['action'] = '/usercenter/user';
        if(IS_POST){
            //参数判断
            $id = (int) $this->input->post('product_id');
            if($id == 0){
                $this->return_failed('参数错误');
            }
            $num = (int) $this->input->post('num');
            if($num < 1){
                $this->return_failed('数量参数错误');
            }
            $delivery_type = (int) $this->input->post('delivery_type');
            $delivery_data['name'] = trim($this->input->post('name'));
            if(empty($delivery_data['name'])){
                $this->return_failed('收货人不能为空');
            }
            $delivery_data['mobile_phone'] = trim($this->input->post('mobile_phone'));
            if(!preg_match(C('regular_expression.mobile'), $delivery_data['mobile_phone'])){
                $this->return_failed('手机号格式不正确');
            }
            $delivery_data['address'] = trim($this->input->post('address'));
            if(empty($delivery_data['address'])){
                $this->return_failed('收货地址不能为空');
            }
            $image_order_ids = $this->input->post('image_order_ids');
            if(empty($image_order_ids)){
                $this->return_failed('必须关联照片');
            }
            $cover_img = (int) $this->input->post('cover_img');
            if($cover_img === 0){
                $this->return_failed('必须选择一张照片作为封面图');
            }
            $type_id = (int) $this->input->post('type_id');
            $type = $this->Mspecifications->get_one('id,version_price', ['id' => $type_id, 'products_id' => $id]);
            //查询册子价格，计算总价
            $info = $this->Mproducts->get_one('present_price,original_price,title', ['id' => $id, 'is_del' => 0]);
            if(empty($info)){
                $this->return_failed('商品不存在');
            }
            if(!empty($type)){
                $add['need_pay'] = $type['version_price']*$num;
            }else{
                $add['need_pay'] = $info['present_price']*$num;
            }
            
            //是否邮寄
            if($delivery_type == C('order.delivery_type.express.id')){
                $add['need_pay'] += C('order.delivery_type.express.price');
            }
            //生成订单编号
            $add['order_id'] = get_orderid();
            //获取用户下单ip
            $add['bill_create_ip'] = get_client_ip();
            $add['user_id'] = $data['user_info']['id'];
            //邮寄方式
            $add['delivery_type'] = $delivery_type;
    
            //根据用户id，查找宴会id
            $dinner = $this->Muser_dinner->get_one('dinner_id', ['user_id' => $add['user_id']]);
            if(!empty($dinner['dinner_id'])){
                $add['dinner_id'] = $dinner['dinner_id'];
            }
            //计算优惠价格
            if(!empty($type)){
                if($info['original_price'] - $type['version_price'] > 0){
                    $add['favorable'] = ($info['original_price'] - $type['version_price'])*$num;
                }
            }else{
                if($info['original_price'] - $info['present_price'] > 0){
                    $add['favorable'] = ($info['original_price'] - $info['present_price'])*$num;
                }
            }
            
            $add['order_type'] = C('order_type.album.id');
            $add['create_time'] = date('Y-m-d H:i:s');
            $order_id = $this->Morder->create($add);
            if(!$order_id){
                $this->return_failed('添加失败，请重试！');
            }
            //添加订单详情
            $detail['order_id'] = $order_id;
            $detail['product_id'] = $id;
            $detail['product_type'] = C('order.product_type.album.id');
            $detail['product_name'] = $info['title'];
            if(!empty($type)){
                $detail['price'] = $type['version_price'];
            }else{
                $detail['price'] = $info['present_price'];
            }
            $detail['count'] = $num;
            $this->Morder_detail->create($detail);
    
            //物流信息
            if($delivery_type == C('order.delivery_type.express.id')){
                //新建或更新 用户收货地址
                $delivery_data['user_id'] = $data['user_info']['id'];
                $where = array('user_id' => $data['user_info']['id'], 'is_del' => 0);
                $original = $this->Muser_addr->get_one('id', $where);
                if($original){
                    $this->Muser_addr->update_info($delivery_data, $where);
                }else{
                    $this->Muser_addr->create($delivery_data);
                }
                unset($delivery_data['user_id']);
            }
            $delivery_data['order_id'] = $order_id;
            $this->Morder_addr->create($delivery_data);
    
            //关联 相册订单与 相片订单与封面图
            $data_album_order = [
                'album_order_id' => $order_id,
                'image_order_id' => implode(',', $image_order_ids),
                'album_cover_image_id' => $cover_img,
                'special_id' => $type_id
            ];
            $this->Malbum_image->create($data_album_order);
    
            $this->return_success(array('order_id' => $order_id));
        }
    
        //读取订单id的信息,判断订单是否存在和归属
        $product_id = (int) $this->input->get('product_id');
        $num = (int) $this->input->get('num');
        if($num === 0 || $num < 1){
            $num = 1;
        }
        //规格的id
        $type_id = (int) $this->input->get('type_id');
        
        $type = $this->Mspecifications->get_one('id,version_price', ['id' => $type_id, 'products_id' => $product_id]);
        if(!empty($type)){
            $data['type'] = $type;
        }
        $data['product_id'] = $product_id;
        $data['num'] = $num;
        //查询对应的商品
        $msg = $this->Mproducts->get_one('id,title,cover_img,present_price,original_price',['is_del'=> 0, 'id' => $product_id]);
        if($msg){
            $data['msg'] = $msg;
            if($msg['original_price'] - $msg['present_price'] > 0){
                if(!empty($type)){
                    $data['msg']['hui'] = ($msg['original_price'] - $type['version_price'])*$num;
                }else{
                    $data['msg']['hui'] = ($msg['original_price'] - $msg['present_price'])*$num;
                }
            }
            //查询对应的商品属性
            $info = $this->Mproducts_attribute->get_lists('attribute,value', ['products_id' => $product_id]);
            if($info){
                $data['info_list'] = $info;
            }
            if(!empty($type)){
                $data['price'] =  $num * $type['version_price'];
            }else{
                $data['price'] =  $num * $msg['present_price'];
            }
            
        }
        //
        
        $data['num'] =  $num ;
    
        //读取用户收货信息
        $addr = $this->Muser_addr->get_one('*', ['user_id' => $data['user_info']['id'], 'is_del' => 0]);
        if($addr){
            $data['addr'] = $addr;
        }
    
        //用户已购相片订单
        $where = [
            'is_del' => 0,
            'user_id' => $data['user_info']['id'],
            'status' => C('order.pay_status.success.id'),
            'order_type' => C('order.order_type.image.id'),
        ];
        $order =['create_time' => 'desc'];
        $list = $this->Morder->get_lists('id,order_id,need_pay,favorable,status', $where, $order);
        if($list){
            $data['list'] = $list;
            //查找订单包含的产品
            $order_ids = array_column($list, 'id');
            //p($order_ids);
            $product = $this->Morder_detail->get_lists('order_id,product_id', ['in' => ['order_id' => $order_ids], 'product_type' => C('order.product_type.image.id'), 'is_del' => 0]);
            $product_ids = array_unique(array_column($product, 'product_id'));
            //根据相片id查询相片
            if(count($product_ids) > 0){
                $img_list = $this->Mdinner_images->get_lists('id,thumb,sy_img,img',  ['in' => ['id' => $product_ids], 'is_del' => 0]);
                if($img_list){
                    $data['img_list'] = $img_list;
                }
            }
        }
    
        $this->load->view('usercenter/album_detail_info', $data);
    }
    
    public function get_image(){
        $data = $this->data;
        $data['action'] = 'usercenter';
        $user_id = $data['user_info']['id'];
        $start = (int) $this->input->get('start',TRUE);
        $start = $start ? $start : 1;
        $size = 8;
        $user_dinner = $this->Muser_dinner->get_one('dinner_id',['user_id' => $data['user_info']['id']]);
        if($user_dinner){
            $dinner_field = 'images';
            $dinner = $this->Mdinner->get_one($dinner_field, ['id' => $user_dinner['dinner_id'], 'is_del' => 0]);
            if($dinner){
                $img_list = explode(',', $dinner['images']);
                foreach ($img_list as $kk => $vv){
                    $temp[] = get_img_url($vv);
                }
                $images = $temp;
            }
            //指定分页
            $img = [];
            for($i=($start-1)*($size-1); $i<($start+$size-1); $i++){
                if(isset($images[$i])){
                    $img[$i] = $images[$i];
                }
            } 
        }
        
        $this->return_json($img);
    }
    
    public function get_dish(){
        $data = $this->data;
        $data['action'] = 'usercenter';
        $user_id = $data['user_info']['id'];
        $dstart = (int) $this->input->get('dstart',TRUE);
        $dstart = $dstart ? $dstart : 1;
        $size = 8;
        $dinner_field = 'id';
        $user_dinner = $this->Muser_dinner->get_one('dinner_id',['user_id' => $data['user_info']['id']]);
        if($user_dinner){
            $dinner = $this->Mdinner->get_one($dinner_field, ['id' => $user_dinner['dinner_id'], 'is_del' => 0]);
            //拼接婚宴信息
            if($dinner){
                $res = $this->Mdinner_detail->get_one('id,dishs_id', ['dinner_id' => $dinner['id']]);
                if($res){
                    $dish_field = 'name,cover_img,description';
                    $dish = $this->Mdish->get_lists($dish_field, ['in' => array('id' => array_unique(explode(',', $res['dishs_id']))) ]);
                    
                    foreach ($dish as $k => $v){
                        $dish[$k] = $v;
                        $dish[$k]['cover_img'] = get_img_url($v['cover_img']);
                    }
                }
            }
            //指定分页
            $img = [];
            for($i=($dstart-1)*($size-1); $i<($dstart+$size-1); $i++){
                if(isset($dish[$i])){
                    $tmp[$i] = $dish[$i];
                }    
            }
            $this->return_json($tmp);
        }
        
    }
    
    /**
     * 我的婚礼，菜品，相册，视频是否共享
     */
    public function change(){
        $k = (int) $this->input->get('k', TRUE);    //k:0 or 1
        $id = (int) $this->input->get('id', TRUE);   //dinner   ->  id;
        $field = trim($this->input->get('field',TRUE)); //要修改的字段
        $data = $this->data;
        $user_id = $data['user_info']['id']; //当前登陆的id
        //判断当前登陆id是否为新娘，新郎
        $ret = $this->Muser_dinner->get_one('id',['dinner_id' => $id, 'user_id' => $user_id]);
        if(!$ret){
            $this->return_json(0);
        }
        $res = $this->Mdinner->update_info([$field => $k], ['id' => $id]);
        if(!$res){
            $this->return_json(0);
        }
        $this->return_json(1);
    }
    /**
     * 优惠卷控制器
     */
    public function coupon(){
        $this->data['header_show'] = true; //调整header class
        $data = $this->data;
        //左侧 leftmenu 样式控制
        $data['action'] = '/usercenter/coupon';
        $data['status'] = C('coupon');//获取优惠卷状态配置文件
        //查询当前会员优惠卷
        $field = 'id,coupon_id,number,end_time,status';
        $limit = 8;
        $now = date("Y-m-d H:i:s");
        $coupon = $this->Muser_coupon->get_lists($field, ['user_id' => $data['user_info']['id']],['create_time' => 'desc','end_time' => 'desc'], $limit);
        if($coupon){
            $ids = array_column($coupon, 'coupon_id') ? array_column($coupon, 'coupon_id') : "";
            $coupons = $this->Mcoupon->get_lists('id,favorable,type_id',['in' => ['id' => $ids]]);
            $type_field = 'id,name';
            $coupon_type = $this->Muser_coupon_type->get_lists($type_field);
            $coupon_type = array_column($coupon_type, 'name', 'id');
            foreach ($coupons as $key => $val){
                $coupons[$key]['name'] = $coupon_type[$val['type_id']];
            }
            $coupons = array_column($coupons, null, 'id');
            $data['coupon'] = $coupon;
            
            //根据使用状态构造对应类名
            $status = array(
                $data['status']['status']['no_use']['id']  => array('class' => 'to-use', 'name' => $data['status']['status']['no_use']['name']),
                $data['status']['status']['use']['id']     => array('class' => 'used', 'name' => $data['status']['status']['use']['name']),
                $data['status']['status']['timeout']['id'] => array('class' => 'used', 'name' => $data['status']['status']['timeout']['name'])
            );
            foreach ($coupon as $k => $v){
                $coupon[$k]['name'] = $coupons[$v['coupon_id']]['name'];
                $coupon[$k]['favorable'] = $coupons[$v['coupon_id']]['favorable'];
                $coupon[$k]['class_name'] = $status[$v['status']]['class'];
                $coupon[$k]['status_name'] = $status[$v['status']]['name'];
            }
            $data['coupon'] = $coupon;
           
        }
        $this->load->view('usercenter/coupon', $data);
    }
    
    public function mycard(){
        $data = $this->data;
        $data['url'] = 'mycard';
        $data['action'] = 'usercenter';
        $this->load->view('usercenter/mycard', $data);
    }
    /**
     * 个人信息
     * @author yonghua@gz-zc.cn
     */
    public function info(){
        $data = $this->data;
        $data['url'] = 'info';
        $data['action'] = 'usercenter';
        $this->load->view('usercenter/info',$data);
    }
    
    public function edit_info(){
        $data = $this->data;
        if(IS_POST){
            $id = (int)($this->input->post('user_id', TRUE));
            if($data['user_info']['id'] != $id){
                $this->return_failed('非法提交');
            }
            $updata['realname'] = trim($this->input->post('realname', TRUE));
            if(empty($updata['realname'])){
                $this->return_failed('姓名不能为空');
            }
            $updata['nickname'] = trim($this->input->post('nickname', TRUE));
            if(empty($updata['nickname'])){
                $this->return_failed('用户名不能为空');
            }
            $updata['sex'] = (int) $this->input->post('sex',TRUE);
            $updata['birthday'] = trim($this->input->post('birthday', TRUE));
            if(empty($updata['birthday'])){
                $this->return_failed('请选择生日日期');
            }
            $updata['mobile_phone'] = trim($this->input->post('mobile', TRUE));
            if(!preg_match(C('regular_expression.mobile'), $updata['mobile_phone'])){
                $this->return_failed('手机号格式不正确');
            }
            $head_img = trim($this->input->post('head_img', TRUE));
            if($head_img){
                $updata['head_img'] = $head_img;
            }
            $updata['address'] = trim($this->input->post('address', TRUE));
            $res = $this->Muser->update_info($updata,['id' => $id,]);
            if(!$res){
                $this->return_failed('操作失败');
            }
            $this->return_success(1, '保存成功');
        }
        
    }
    
    /**
     * 我的预约
     * @author yonghua@gz-zc.cn
     */
    public function myorder(){
        $data = $this->data;
        $data['url'] = 'myorder';
        $data['action'] = 'usercenter';
        $limit = 6;
        $venue = $this->Mvenue->get_lists('id,name,cover_img',['is_del' => 0]);
        $order = $this->Mcustomer->get_lists('id,name,venue_id,dinner_time,dinner_type,address,user_id',['is_del' =>0, 'user_id' => $data['user_info']['id']]);
        if ($venue && $order) {
            foreach ($order as $k => $v) {
                $data['order'][$k] = $v;
                foreach ($venue as $kk => $vv) {
                    if ($vv['id'] == $v['venue_id']) {
                        $data['order'][$k]['venue_name'] = $vv['name'];
                        $data['order'][$k]['cover_img'] = get_img_url($vv['cover_img']);
                    }
                }
            }
        }
        $this->load->view('usercenter/myorder',$data);
    }
    
    /**
     * 我的预约删除
     * @author yonghua@gz-zc.cn
     */
    
    public function del_order(){
        $data = $this->data;
        $id = (int) $this->input->post('id', TRUE);
        $user_id = (int) $this->input->post('user_id', TRUE);
        if($user_id != $data['user_info']['id']){
            $this->return_json('非法提交');
        }
        $res = $this->Mcustomer->update_info(['is_del' => 1], ['id' => $id, 'user_id' => $user_id]);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    /**
     * 婚礼视频
     * @author yonghua@gz-zc.cn
     */
    public function videos(){
        $data = $this->data;
        $data['action'] = '/usercenter/videos';
        //查询当前用户的婚礼，查找婚礼视频
        $res = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $data['user_info']['id']]);
        if($res){
            $dinner = $this->Mdinner->get_one('id', ['in' => ['id' => array_column($res, 'dinner_id')], 'venue_type' => C('party.wedding.id'), 'is_del' => 0 ]);
            if($dinner){
                $info = $this->Mdinner->get_one('video_title,video_intro, video,cover_img,m_cover_img', ['id' => $dinner['id'], 'venue_type' => C('party.wedding.id')]);
            }
            if($info){
                $data['info'] = $info;
                $info['cover_img'] = explode(';', $info['cover_img']);
                $info['m_cover_img'] = explode(';', $info['m_cover_img']);
            }
        }
        $this->load->view('usercenter/videos', $data);
    }
    
    /**
     * 没有婚礼默认显示的页面,有婚礼则调转到婚礼详情
     */
    public function no_wedding(){
        $data = $this->data;
        $data['action'] = '/usercenter/no_wedding';
        $res = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $data['user_info']['id']]);
        if($res){
            $info = $this->Mdinner->get_one('id', ['in' => ['id' => array_column($res, 'dinner_id')], 'venue_type' => C('party.wedding.id'), 'is_del' => 0 ]);
            if($info){
                redirect(C('domain.base.url').'/today/detail?id='.$info['id']);
            }
        }
        $this->load->view('usercenter/no_wedding', $data);
    }
}