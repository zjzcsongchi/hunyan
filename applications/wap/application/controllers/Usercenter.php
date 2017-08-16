<?php
/**
 * 个人中心制器
 * @author yonghua@gz-zc.cn
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Usercenter extends MY_Controller
{

    private $appid, $appsecret;
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'Model_dinner' => 'Mdinner',
            'Model_user_dinner' => 'Muser_dinner',
            'Model_dinner_detail' => 'Mdinner_detail',
            'Model_bless' => 'Mbless',
            'Model_venue' => 'Mvenue',
            'Model_dish' => 'Mdish',
            'Model_user' => 'Muser',
            'Model_coupon' => 'Mcoupon',
            'Model_user_coupon' => 'Muser_coupon',
            'Model_coupon_type' => 'Mcoupon_type',
            'Model_customer' => 'Mcustomer',
            'Model_bless' => 'Mbless',
            'Model_flower' => 'Mflower',
            'Model_dinner_album' => 'Mdinner_album',
            'Model_dinner_images' => 'Mdinner_images',
            'Model_products' => 'Mproducts',
            'Model_products_attribute' => 'Mproducts_attribute',
            'Model_order' => 'Morder',
            'Model_order_detail' => 'Morder_detail',
            'Model_user_addr' => 'Muser_addr',
            'Model_order_addr' => 'Morder_addr',
            'Model_album_image' => 'Malbum_image',
            'Model_specifications' => 'Mspecifications',
            'Model_admins' => 'Madmins',
            'Model_admin_resume' => 'Madmin_resume',
            'Model_admins_group' => 'Madmins_group',
            'Model_cake' => 'Mcake',
            'Model_weixin' => 'Mweixin',
            'Model_access_token' => 'Maccess_token'
        ]);
        $data = $this->data;
        if (!$data['user_info'] || empty($data['user_info']['mobile_phone'])) {
            redirect(C('domain.mobile.url') . '/passport/redirect_wechat_login');
        }
        $this->appid = C('wechat_app.app_id.value');
        $this->appsecret = C('wechat_app.app_secret.value');
        $param = array(
            'app_id' => $this->appid,
            'app_secret' => $this->appsecret,
            'cache_dir' => APPPATH.'cache/'
        );
        $this->load->library('weixinjssdk', $param);
    }
    /**
     * 会员中心新首页
     * @author yonghua@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $data['action'] = 'user';
        $user_id = $data['user_info']['id'];
        $user_dinner = $this->Muser_dinner->get_lists('dinner_id', ['user_id' => $user_id]);
        //过滤掉已删除宴会
        $dinners = array();
        if($user_dinner){
            $dinners = $this->Mdinner->get_lists('id', array('is_del' => 0, 'in' => array('id' => array_column($user_dinner, 'dinner_id'))));
        }
        $res = [];
        if($dinners){
            $res['dinner_id'] = $dinners[0]['id'];
        }
        $data['bless_num'] = 0;
        $data['flower_num'] = 0;
        if($res){
            //祝福数
            $data['bless_num'] = $this->Mbless->count(['is_del' => 0, 'dinner_id' => $res['dinner_id']]);
            //鲜花数
            $data['flower_num'] = $this->Mflower->count(['is_del' => 0, 'dinner_id' => $res['dinner_id']]);
            //查询宴会的相册
            $list = $this->Mdinner_album->get_lists('*', ['dinner_id' => $res['dinner_id'], 'is_del' => 0]);
            if($list){
                $list = $this->image_count($list);
                $data['list'] = $list;
            }
        }
        //查询相册册子产品
        $data['lists'] = $this->Mproducts->get_lists('id,title,cover_img', ['is_del' => 0,'class_id' => C('order.product_type.album.id')]);
        //查询当前订单个数
        $data['order_num'] = $this->Morder->count(['user_id' => $data['user_info']['id'], 'is_del' => 0]);
        if($res){
            $data['dinner_id'] = $res['dinner_id'];
            //获取新郎新娘名称
            $data['roles'] = $this->Mdinner->get_one('id, roles_main, roles_wife', array('id'=>$res['dinner_id']));
        }
        //查询用户角色是否为客户经理
        $is_customer_manager = $this->is_customer_manager($data['user_info']['mobile_phone']);
        $data['is_customer_manager'] = $is_customer_manager ? 1 : 0;
        
        //通过登录手机号查询是否是百年婚宴员工
        $exsit = $this->Madmins->get_one('id', array('tel' =>$data['user_info']['mobile_phone'], 'is_del'=>1));
        if($exsit){
            $data['exsit'] = 1;
        }else{
            $data['exsit'] = 0;
        }
       
        $this->load->view('usercenter/index', $data);
    }
    
    /**
     * 册子详情
     * @author yonghua@gz-zc.cn
     */
    public function album_detail(){
        $data = $this->data;

        $id = (int) $this->input->get('id');
        $list = $this->Mproducts->get_one('id,title,cover_img,present_price,info',['is_del'=> 0, 'id' => $id]);
        if(!$list){
            redirect(C('domain.mobile.url').'/usercenter');
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
     * 添加订单详情页面
     */
    public function album_detail_info(){
        $data = $this->data;
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
        $info_list = $this->Mproducts_attribute->get_lists('attribute,value', ['products_id' => $product_id]);
        if($info_list){
            $data['info_list'] = $info_list;
        }
        $num = (int) $this->input->get('num');
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
            $ret = $this->Mproducts_attribute->get_lists('attribute,value', ['products_id' => $product_id]);
            if($ret){
                foreach ($ret as $k => $v){
                    $data['msg'][$v['attribute']]= $v['value'];
                }
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
            $product = $this->Morder_detail->get_lists('order_id,product_id', ['in' => ['order_id' => $order_ids], 'is_del' => 0]);
            //获得所有的相片id
            $product_ids = array_unique(array_column($product, 'product_id'));
            if(count($product_ids) > 0){
                $img_list = $this->Mdinner_images->get_lists('id, thumb,img', ['in' => ['id' => $product_ids], 'is_del' => 0]);
            }
            if(isset($img_list)){
                $data['img_list_right'] = array();
                $data['img_list_left'] = array();
                foreach ($img_list as $k => $v){
                    if($k%2 == 0){
                        $data['img_list_left'][] = $v;
                    }else{
                        $data['img_list_right'][] = $v;
                    }
                }
                
                $data['img_list'] = $img_list;
            }
        }
        
        $this->load->view('usercenter/detail_info', $data);
    }
    
    /**
     * 会员中心婚礼相册
     * @author yonghua@gz-zc.cn
     */
    public function userphoto(){
        $data = $this->data;
        $data['action'] = 'user';
        $data['actions'] = 'userphoto';
        $user_id = $data['user_info']['id'];
        $res = $this->Muser_dinner->get_one('dinner_id', ['user_id' => $user_id]);
        if($res){
            $img= $this->Mdinner->get_one('images', ['id' => $res['dinner_id'], 'venue_type' => C('party.wedding.id')]);
            if($img){
                $data['images'] = explode(',', $img['images']);
            }
        }
        $this->load->view('usercenter/photo', $data);
    }
    
    /**
     * 会员中心婚礼相册
     * @author yonghua@gz-zc.cn
     */
    public function uservideo(){
        $data = $this->data;
        $data['action'] = 'user';
        $data['actions'] = 'uservideo';
        $user_id = $data['user_info']['id'];
        $res = $this->Muser_dinner->get_one('dinner_id', ['user_id' => $user_id]);
        if($res){
            $info= $this->Mdinner->get_one('solar_time,cover_img,video,video_title,video_intro', ['id' => $res['dinner_id'], 'venue_type' => C('party.wedding.id')]);
            if($info){
                $data['info'] = $info;
            }
        }
        $this->load->view('usercenter/video', $data);
    }
    
    public function uservenue(){
        $data = $this->data;
        $data['action'] = 'user';
        $data['actions'] = 'uservenue';
        $user_id = $data['user_info']['id'];
        $res = $this->Muser_dinner->get_one('dinner_id', ['user_id' => $user_id]);
        $info= $this->Mdinner->get_one('venue_id', ['id' => $res['dinner_id'], 'venue_type' => C('party.wedding.id')]);
        if($res && $info){
            $venue_field = 'name,max_table,container,device,images,fit_type,area_size,min_consume,floor,height';
            $venue = $this->Mvenue->get_one($venue_field, [
                'id' => $info['venue_id']
            ]);
            // 拼接场馆信息
            if ($venue) {
                $img_list = explode(',', $venue['images']);
                foreach ($img_list as $kk => $vv) {
                    $images_list[] = get_img_url($vv);
                }
                $data['venue'] = $venue;
                $data['venue']['images'] = $images_list;
            }
        }
        $this->load->view('usercenter/venue', $data);
    }
    
    public function staffdetail(){
        $data = $this->data;
        $id = (int) $this->input->get('id');//履历ID
        $data['id'] = $id;
        //获取寿星信息
        $user_id = (int) $this->input->get('user_id');
        $data['user_info'] = $this->Muser->get_one('*', ['id'=>$user_id, 'is_del' => 0]);
        if(!isset($data['user_info']['mobile_phone'])||!$data['user_info']['mobile_phone']){
            show_404();exit;
        }
        unset($data['user_info']['password']);
        //获取员工信息
        $user_field = 'id,grade,fullname,name,group_id';
        $user_where = [
            'tel' => $data['user_info']['mobile_phone'],
            'is_del' => 1,
            'disabled' => 1
        ];
        $admin = $this->Madmins->get_one($user_field, $user_where);
        if($admin){
            $data['admin'] = $admin;
            $group_name = $this->Madmins_group->get_one('id, name', array('id'=>$admin['group_id'], 'is_del'=>1));
            $data['group_name'] = $group_name['name'];
            //获取职员生日履历
            $fields = 'id,admin_id,resume_type,title,content,images,remark,occur_time';
            $where = [
                'id' => $id,
                'admin_id' => $admin['id'],
                'is_del' => 0,
                'resume_type' => C('resume.type.birthday.id')
            ];
            $info = $this->Madmin_resume->get_one($fields, $where);
            if(!$info){
                show_404();exit;
            }
            $data['info'] = $info;
            $data['info']['images'] = !empty($data['info']['images']) ? explode(';', $data['info']['images']) : '';
            //获取前5蛋糕的排行榜
            $cake_where = [
                'admin_id' => $admin['id'],
                'is_del' => 0,
                'year(create_time)' => date('Y', strtotime($info['occur_time']))
            ];
            $cake_fields = "id,user_id,sum(num) as nums";
            $cake_group = 'user_id';
            $order_by = [
                'nums' => 'desc',
                'create_time' => 'desc'
            ];
            $cake_top = $this->Mcake->get_lists($cake_fields, $cake_where, $order_by, 10, 0, $cake_group);
            if($cake_top){
                $data['cake'] = $cake_top;
                //获取赠送用户ids
                $user_ids = array_column($cake_top, 'user_id');
                if($user_ids){
                    $user = $this->Muser->get_lists('id,realname,nickname,head_img', ['in' => ['id' => $user_ids]]);
                    if($user){
                        foreach ($cake_top as $k => $v){
                            foreach ($user as $key => $val){
                                if($v['user_id'] == $val['id']){
                                    if(!empty($val['nickname'])){
                                        $tmp_name = $val['nickname'];
                                    }else{
                                        $tmp_name = $val['realname'];
                                    }
                                    $data['cake'][$k]['username'] = $tmp_name;
                                    if(!empty($val['head_img'])){
                                        $tmp_img = get_img_url($val['head_img']);
                                    }else{
                                        $tmp_img = $data['domain']['static']['url'].'/wap/images/head.png';
                                    }
                                    $data['cake'][$k]['head_img'] = $tmp_img;
                                }
                            }
                        }
                    }
                }
            }
            $this->load->view('usercenter/staffdetail', $data);
        }else{
            show_404();
        }
    }
    
    public function staff_get_more(){
        $data = $this->data;
        if(!$data['user_info']){
            echo 'nodata';exit;
        }
        $id = (int) $this->input->get('id');//履历ID
        //获取寿星信息
        $user_id = (int) $this->input->get('user_id');
        $data['user_info'] = $this->Muser->get_one('*', ['id'=>$user_id, 'is_del' => 0]);
        if(!isset($data['user_info']['mobile_phone'])||!$data['user_info']['mobile_phone']){
            show_404();exit;
        }
        unset($data['user_info']['password']);
        //获取员工信息
        $user_field = 'id,grade';
        $user_where = [
            'tel' => $data['user_info']['mobile_phone'],
            'is_del' => 1,
            'disabled' => 1
        ];
        $admin = $this->Madmins->get_one($user_field, $user_where);
        if($admin){
            $fields = 'occur_time';
            $where = [
                'id' => $id,
                'admin_id' => $admin['id'],
                'is_del' => 0,
                'resume_type' => C('resume.type.birthday.id')
            ];
            $info = $this->Madmin_resume->get_one($fields, $where);
            if(!$info){
                echo 'nodata';exit;
            }
            //获取蛋糕的排行榜
            $cake_where = [
                'admin_id' => $admin['id'],
                'is_del' => 0,
                'year(create_time)' => date('Y', strtotime($info['occur_time']))
            ];
            $cake_fields = "id,user_id,sum(num) as nums";
            $cake_group = 'user_id';
            $order_by = [
                'nums' => 'desc',
                'create_time' => 'desc'
            ];
            $page = (int) $this->input->get('page');
            $data['page'] = $page;
            $size = 10;
            $cake_top = $this->Mcake->get_lists($cake_fields, $cake_where, $order_by, $size, ($page-1)*$size, $cake_group);
            if($cake_top){
                $data['cake'] = $cake_top;
                //获取赠送用户ids
                $user_ids = array_column($cake_top, 'user_id');
                if($user_ids){
                    $user = $this->Muser->get_lists('id,realname,nickname,head_img', ['in' => ['id' => $user_ids]]);
                    if($user){
                        foreach ($cake_top as $k => $v){
                            foreach ($user as $key => $val){
                                if($v['user_id'] == $val['id']){
                                    if(!empty($val['nickname'])){
                                        $tmp_name = $val['nickname'];
                                    }else{
                                        $tmp_name = $val['realname'];
                                    }
                                    $data['cake'][$k]['username'] = $tmp_name;
                                    if(!empty($val['head_img'])){
                                        $tmp_img = get_img_url($val['head_img']);
                                    }else{
                                        $tmp_img = $data['domain']['static']['url'].'/wap/images/head.png';
                                    }
                                    $data['cake'][$k]['head_img'] = $tmp_img;
                                }
                            }
                        }
                    }
                }
                $this->load->view('usercenter/staff_load_more', $data);
            }else{
                echo 'nodata';
            }
        }else{
            echo 'nodata';
        }
    }

    public function wedding()
    {
        $data = $this->data;
        $data['title'] = '我的婚礼';
        $data['url'] = 'wedding';
        $data['action'] = 'user';
        $start = 1;
        $dstart = 1;
        $size = 8;
        $user_dinner = $this->Muser_dinner->get_one('dinner_id', [
            'user_id' => $data['user_info']['id']
        ]);
        if ($user_dinner) {
            $dinner_field = 'id,venue_id,solar_time,lunar_time,banquet_time,cover_img,images,video,video_title,video_intro,is_dish_share,is_images_share,is_video_share';
            $dinner_where = array(
                'id' => $user_dinner['dinner_id'],
                'is_del' => 0,
                'venue_type' => C('party.wedding.id')
            );
            $dinner = $this->Mdinner->get_one($dinner_field, $dinner_where);
            // 拼接婚宴信息
            if ($dinner) {
                $img_list = explode(',', $dinner['images']);
                foreach ($img_list as $kk => $vv) {
                    $temp[] = get_img_url($vv);
                }
                $data['dinner'] = $dinner;
                $data['dinner']['cover_img'] = get_img_url($dinner['cover_img']);
                $images = $temp;
                // 查找宴会详情包含的菜谱
                $res = $this->Mdinner_detail->get_one('id,dishs_id', [
                    'dinner_id' => $dinner['id']
                ]);
                if ($res) {
                    $dish_field = 'name,cover_img,description';
                    $dish = $this->Mdish->get_lists($dish_field, [
                        'in' => array(
                            'id' => array_unique(explode(',', $res['dishs_id']))
                        )
                    ]);
                    foreach ($dish as $k => $v) {
                        $dish[$k] = $v;
                        $dish[$k]['cover_img'] = get_img_url($v['cover_img']);
                    }
                }
                
                $venue_field = 'name,max_table,container,device,images';
                $venue = $this->Mvenue->get_one($venue_field, [
                    'id' => $dinner['venue_id']
                ]);
                // 拼接场馆信息
                if ($venue) {
                    $img_list = explode(',', $venue['images']);
                    foreach ($img_list as $kk => $vv) {
                        $images_list[] = get_img_url($vv);
                    }
                    $data['venue'] = $venue;
                    $data['venue']['images'] = $images_list;
                }
                if (isset($images)) {
                    $html = '';
                    for ($i = 0; $i < ceil(count($images) / 6); $i ++) {
                        $html .= '<div class="swiper-slide">';
                        $html .= '<ul>';
                        for ($k = $i * 6; $k <= ($i * 6 + 5) && isset($images[$k]); $k ++) {
                            $html .= "<li><img class='swiper-lazy' data-src='" . $images[$k] . "'></li>";
                        }
                        $html .= '</ul>';
                        $html .= '</div>';
                    }
                    $data['images'] = $html;
                }
                if (isset($dish)) {
                    $html = '';
                    for ($i = 0; $i < ceil(count($dish) / 6); $i ++) {
                        $html .= '<div class="swiper-slide">';
                        $html .= '<ul>';
                        for ($k = $i * 6; $k <= ($i * 6 + 5); $k ++) {
                            if (isset($dish[$k]['name']) && isset($dish[$k]['cover_img'])) {
                                $html .= "<li><img class='swiper-lazy' data-src='" . $dish[$k]['cover_img'] . "'><p>" . $dish[$k]['name'] . "</p></li>";
                            }
                        }
                        $html .= '</ul>';
                        $html .= '</div>';
                    }
                    $data['dish'] = $html;
                }
            }
        }
        
        $this->load->view('usercenter/wedding', $data);
    }

    /**
     * 优惠卷控制器
     */
    public function coupon()
    {
        
        $data = $this->data;
        $data['title'] = '我的优惠劵';
        $data['action'] = 'user';
        $data['status'] = C('coupon'); // 获取优惠卷状态配置文件
                                       // 查询当前会员优惠卷
        $field = 'id,coupon_id,number,create_time,end_time,status';
        $limit = 8;
        $data['now'] = date("Y-m-d H:i:s");
        
        $where = array('user_id' => $data['user_info']['id']);
        $status = $this->input->get('status');
        if(isset($status)){
            $where['status'] = (int) $this->input->get('status');
            $data['status'] = $where['status'];
        }
        $coupon = $this->Muser_coupon->get_lists($field, $where, [
            'create_time' => 'desc',
            'end_time' => 'desc'
        ], $limit);
        if ($coupon) {
            $ids = array_column($coupon, 'coupon_id') ? array_column($coupon, 'coupon_id') : "";
            $coupons = $this->Mcoupon->get_lists('id,favorable,type_id', [
                'in' => [
                    'id' => $ids
                ]
            ]);
            $type_field = 'id,name';
            $coupon_type = $this->Mcoupon_type->get_lists($type_field);
            $coupon_type = array_column($coupon_type, 'name', 'id');
            foreach ($coupons as $key => $val) {
                $coupons[$key]['name'] = $coupon_type[$val['type_id']];
            }
            $coupons = array_column($coupons, null, 'id');
            
            foreach ($coupon as $k => $v) {
                $coupon[$k]['name'] = $coupons[$v['coupon_id']]['name'];
                $coupon[$k]['favorable'] = $coupons[$v['coupon_id']]['favorable'];
            }
            $data['coupon'] = $coupon;
        }
        
        $this->load->view('usercenter/new_coupon', $data);
    }

    public function mycard()
    {
        $data = $this->data;
        $data['title'] = '微请帖';
        $data['url'] = 'mycard';
        $data['action'] = 'user';
        $this->load->view('usercenter/mycard', $data);
    }
    
    private function getsignpackage(){
        return json_encode($this->weixinjssdk->getSignPackage());
    }
    
    public function weixin_upload_img(){
        
    }
    
    /**
     * 个人信息
     * 
     * @author yonghua@gz-zc.cn
     */
    public function info(){
        $data = $this->data;
        $data['action'] = 'user';
        //微信图片上传, 配置参数
        $data['wxConfigJSON'] = json_encode($this->weixinjssdk->getSignPackage(), JSON_UNESCAPED_SLASHES);
        $user_id = $data['user_info']['id'];
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            //正则验证电话号码是否正确
            if(!$post_data['mobile_phone'] ||!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone']) || !$post_data['nickname'])
            {
               $this->return_failed();
            }
            $update = $this->Muser->update_info($post_data, array('id'=>$user_id));
            
            if($update){
                $this->return_success();
            }else{
                $this->return_failed();
            }
        }
        $this->load->view('user/info', $data);
    }

    public function edit_info()
    {
        $data = $this->data;
        $data['title'] = '编辑资料';
        $data['url'] = 'info';
        $data['action'] = 'user';
        if (IS_POST) {
            $id = (int) ($this->input->post('id', TRUE));
            if ($data['user_info']['id'] != $id) {
                $this->return_json('非法提交');
            }
            $updata['realname'] = trim($this->input->post('realname', TRUE));
            if (empty($updata['realname'])) {
                $this->return_json('姓名不能为空');
            }
            $updata['nickname'] = trim($this->input->post('nickname', TRUE));
            if (empty($updata['nickname'])) {
                $this->return_json('用户名不能为空');
            }
            $updata['sex'] = (int) $this->input->post('sex', TRUE);
            $updata['mobile_phone'] = trim($this->input->post('mobile_phone', TRUE));
            if (! preg_match(C('regular_expression.mobile'), $updata['mobile_phone'])) {
                $this->return_json('手机号格式不正确');
            }
            $updata['address'] = trim($this->input->post('address', TRUE));
            $res = $this->Muser->update_info($updata, [
                'id' => $id
            ]);
            if (! $res) {
                $this->return_json('操作失败');
            }
            $this->return_json(1);
        }
        $this->load->view('usercenter/edit_info', $data);
    }

    /**
     * 我的预约
     * 
     * @author yonghua@gz-zc.cn
     */
    public function myorder()
    {
        $data = $this->data;
        $data['title'] = '我的预约';
        $data['url'] = 'myorder';
        $data['action'] = 'user';
        $limit = 6;
        $venue = $this->Mvenue->get_lists('id,name,cover_img', [
            'is_del' => 0
        ]);
        $order = $this->Mcustomer->get_lists('id,name,venue_id,dinner_time,dinner_type,address,user_id', [
            'is_del' => 0,
            'user_id' => $data['user_info']['id']
        ]);
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
        $this->load->view('usercenter/myorder', $data);
    }

    /**
     * 我的预约删除
     * 
     * @author yonghua@gz-zc.cn
     */
    public function del_order()
    {
        $data = $this->data;
        $id = (int) $this->input->post('id', TRUE);
        $user_id = (int) $this->input->post('user_id', TRUE);
        if ($user_id != $data['user_info']['id']) {
            $this->return_json('非法提交');
        }
        $res = $this->Mcustomer->update_info([
            'is_del' => 1
        ], [
            'id' => $id,
            'user_id' => $user_id
        ]);
        if (! $res) {
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    
    /**
     * 我收到的祝福
     * 
     * @author louhang@gz-zc.cn
     */
    public function bless($status = 0)
    {
    
        $data = $this->data;
        $data['title'] = '我收到的祝福';
        $data['action'] = 'user';
        
        $where = array('user_id' => $data['user_info']['id'], 'is_del' => 0);
        $dinner_id =  $this->Mdinner->get_one('id', $where);
        $data['bless'] = array();
        if($dinner_id){
            $order_by = array('create_time' => 'desc');
            $res = $this->Muser_dinner->get_one('dinner_id', ['user_id' => $user_id]);
            if($res){
               $data['bless_count'] = $this->Mbless->count(array('dinner_id' => $res['id'], 'is_del' => 0));
               $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $res['id'], 'is_del' => 0), $order_by, 5);
            }
        }
        
        if($data['bless']){
            $users = array_column($data['bless'], 'user_id');
            $user_info =  $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => $users)));
            $user_info = array_column($user_info, null,'id');

            foreach ($data['bless'] as $key => $value){
                $data['bless'][$key]['nickname'] = $user_info[$value['user_id']]['nickname'];
                $data['bless'][$key]['head_img'] = $user_info[$value['user_id']]['head_img'];
            }
        }

        $this->load->view('usercenter/bless', $data);
    }
    
    /**
     * 我收到的祝福- 查看更多
     *
     * @author louhang@gz-zc.cn
     */
    public function get_more_bless($status = 0)
    {
    
        $data = $this->data;
        $data['title'] = '我收到的祝福';
        $data['action'] = 'user';
        $page = (int) ($this->input->get('page', TRUE));
        $where = array('user_id' => $data['user_info']['id'], 'is_del' => 0);
        $dinner_id =  $this->Mdinner->get_one('id', $where);
        $data['bless'] = array();
        if($dinner_id){
            $order_by = array('create_time' => 'desc');
            $data['bless_count'] = $this->Mbless->count(array('dinner_id' => $dinner_id['id'], 'is_del' => 0));
            $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $dinner_id['id'], 'is_del' => 0), $order_by, 10, 10*$page);
        }
    
        if($data['bless']){
            $users = array_column($data['bless'], 'user_id');
            $user_info =  $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => $users)));
            $user_info = array_column($user_info, null,'id');
    
            foreach ($data['bless'] as $key => $value){
                $data['bless'][$key]['nickname'] = $user_info[$value['user_id']]['nickname'];
                $data['bless'][$key]['head_img'] = get_img_url($user_info[$value['user_id']]['head_img']);
            }
            $this->return_success($data['bless']);
        }
        
        $this->return_failed('没有更多数据');
        

    }
    
    /**
     * 无宴会页面
     * @author chaokai@gz-zc.cn
     */
    public function no_dinner(){
        $data = $this->data;
        $this->load->view('usercenter/no_dinner', $data);
    }
    
    /**
     * 搜索宴会相册
     * @author chaokai@gz-zc.cn
     */
    public function search_dinner(){
        $data = $this->data;
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('search_name', '搜索内容', 'trim|required', array('required' => '%s不能为空'));
        try{
            if($this->form_validation->run() === false){
                throw new Exception(validation_errors());
            }
            //判断是否客户经理
            if(!$this->is_customer_manager($data['user_info']['mobile_phone'])){
                throw new Exception('您的身份不是客户经理');
            }
            //搜索新郎或新娘姓名对应宴会
            $name = $this->input->post('search_name');
            $dinner_list = $this->Mdinner->search_dinner_list($name);
            if(!$dinner_list){
                throw new Exception('搜索结果为空');
            }
            $dinner_ids = array_column($dinner_list, 'id');
            $dinner_album = $this->Mdinner_album->get_lists('*', array('in' => array('dinner_id' => $dinner_ids), 'is_del' => 0));
            
            $list = $this->image_count($dinner_album);
            //搜索的相册中加入新郎新娘姓名
            foreach ($list as $k => $v){
                foreach ($dinner_list as $key => $value){
                    if($value['id'] == $v['dinner_id']){
                        $list[$k]['roles_main'] = $value['roles_main'];
                        $list[$k]['roles_wife'] = $value['roles_wife'];
                    }
                }
            }
            $data['list'] = $list;
            $return_text = $this->load->view('usercenter/ajax_user_album', $data, true);
            $this->return_success($return_text);
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * 查询用户角色，并判断是否为客户经理
     * @param string $mobile_phone 客户手机号
     * @author chaokai@gz-zc.cn
     */
    private function is_customer_manager($mobile_phone){
        $this->load->model('Model_admins', 'Madmins');
        
        $manager = $this->Madmins->get_one('id,group_id', array('tel' => $mobile_phone, 'is_del' => 1, 'grade' => 1));
        if(!$manager){
            return false;
        }
        $allow_rolse = array_column(C('roles'), 'id');
        if(in_array($manager['group_id'], $allow_rolse)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 计算相册中的照片数量
     * @param $list array 相册数组
     * @author cahokai@gz-zc.cn
     */
    public function image_count($list){
        $album_ids = array_column($list, 'id');
        if(count($album_ids) > 0){
            //获取当前宴会所有的相册
            $album = $this->Mdinner_images->get_lists('id,album_id',['is_del' => 0, 'in' => ['album_id' => $album_ids]]);
            //拼接相册包含的相片数目
            if($album){
                foreach ($list as $k => $v){
                    $list[$k]['count'] = 0;
                    foreach ($album as $kk => $vv){
                        if($v['id'] == $vv['album_id']){
                            $list[$k]['count'] += 1;
                        }
                    }
                }
            }
        }
        
        return $list;
    }
    
    
    
    public function resume(){
        $data = $this->data;
        $user_id = (int) $this->input->get('user_id');
        $data['user_info'] = $this->Muser->get_one('*', ['id'=>$user_id, 'is_del' => 0]);
        if(!isset($data['user_info']['mobile_phone'])||!$data['user_info']['mobile_phone']){
            show_404();
        }
        unset($data['user_info']['password']);
        $data['title'] = '个人成长';
        $mobile_phone = $data['user_info']['mobile_phone'];
        $admin_id = $this->Madmins->get_one('id, fullname, group_id', array('tel' =>$mobile_phone));
        $data['name'] = isset($admin_id['fullname']) && $admin_id['fullname'] ?$admin_id['fullname']:'';
        $group_name = $this->Madmins_group->get_one('id, name', array('id'=>$admin_id['group_id'], 'is_del'=>1));
        $data['group_name'] = $group_name['name'];
        //查询履历信息
        $order_by['occur_time'] = 'desc';
        $list = $this->Madmin_resume->get_lists('*', array('admin_id'=>$admin_id['id'], 'is_del'=>0), $order_by);
        
        foreach ($list as $k=>$v){
            $list[$k]['year'] = explode('-', $v['occur_time'])[0];
            $list[$k]['image'] = !empty($v['images']) ? explode(';', $v['images']) : '';
        }
        
        foreach ($list as $k=>$v){
            $data['list'][$v['year']][] = $v;
        }
        
        $data['head_img'] = isset($data['user_info']['head_img']) && !empty($data['user_info']['head_img']) ? $data['user_info']['head_img']:$data['domain']['static']['url'].'/wap/images/head.png';
        $this->load->view('usercenter/resume', $data);
    }
}







