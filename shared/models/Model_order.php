<?php
/**
 * 商品
 */
class Model_order extends MY_Model {
    
    private $_table;
    //支付状态
    private $pay_status;
    //送货状态
    private $delivery_status;
    //送货类型
    private $delivery_type;
    //支付类型
    private $pay_type;
    
    public function __construct(){
        $this->_table = 't_order';
        
        parent::__construct($this->_table);
        
        $this->load->model(array(
                        'Model_user' => 'Muser',
                        'Model_user_addr' => 'Muser_addr',
                        'Model_dinner_images' => 'Mdinner_images',
                        'Model_order_detail' => 'Morder_detail',
                        'Model_products' => 'Mproducts',
                        'Model_order_addr' => 'Morder_addr',
        ));
        
        $this->pay_status = array_column(C('order.pay_status'), 'name', 'id');
        $this->delivery_status = array_column(C('order.delivery_status'), 'name', 'id');
        $this->pay_type = array_column(C('pay_type'), 'name', 'id');
        $this->delivery_type = array_column(C('order.delivery_type'), 'name', 'id');
    }
    
    /**
     * 获取订单列表
     * @author cahokai@gz-zc.cn
     */
    public function lists($where = array(), $pagesize = 0, $offset = 0){
        
        $default_where = array('is_del' => 0);
        $where = array_merge($default_where, $where);
        $field = '*';
        $order_by = array('create_time' => 'desc');
        $list = $this->get_lists($field, $where, $order_by, $pagesize, $offset);
        
        if(!$list){
            return false;
        }
        //查询用户信息
        $user_ids = array_column($list, 'user_id');
        $user_list = $this->Muser->get_users($user_ids);
        //组合用户信息
        foreach($list as $k => $v){
            foreach ($user_list as $key => $value){
                if($v['user_id'] == $value['id']){
                    $list[$k]['name'] = $value['name'];
                    $list[$k]['mobile_phone'] = $value['mobile_phone'];
                }
            }
        }
        //解析支付状态和配送状态
        foreach ($list as $k => $v){
            $list[$k]['status_text'] = $this->pay_status[$v['status']];
            $list[$k]['delivery_status_text'] = $this->delivery_status[$v['delivery_status']];
        }
        
        return $list;
        
    }
    
    /**
     * 订单详情
     * @param $id int 订单表id
     * @param $order_type string 订单类型
     * 'image' 相册订单
     * 'gift' 礼物订单
     * @author chaokai@gz-zc.cn
     */
    public function info($id, $order_type){
        $info = $this->get_one('*', array('id' => $id));
        if(!$info){
            return false;
        }
        $info['pay_type_text'] = $this->pay_type[$info['pay_type']];
        $info['delivery_type_text'] = $this->delivery_type[$info['delivery_type']];
        $info['delivery_status_text'] = $this->delivery_status[$info['delivery_status']];
        $info['status_text'] = $this->pay_status[$info['status']];
        
        //购买人信息
        $userinfo = $this->Muser->get_one('realname,mobile_phone', array('id' => $info['user_id']));
        $info['realname'] = $userinfo['realname'];
        $info['mobile_phone'] = $userinfo['mobile_phone'];
        
        //收货地址信息
        $address_info = $this->Morder_addr->get_one('*', array('order_id' => $info['id']));
        $info['address'] = $address_info;
        
        switch ($order_type){
            case 'image':
                $info['detail'] = $this->image_info($id);
                break;
            case 'gift':
                $info['detail'] = $this->gift_info($id);
        }
        
        return $info;
    }
    
    /**
     * 相册订单详细信息
     * @param $id int 订单id
     * @author chaokai@gz-zc.cn
     */
    private function image_info($id){
        $detail = $this->Morder_detail->get_lists('*', array('order_id' => $id, 'is_del' => 0));
        if(!$detail){
            return false;
        }
        
        //区分详情表中的图片和相册
        $image_arr = array();
        $album_arr = array();
        $all_image = array();
        foreach ($detail as $k => $v){
            if($v['product_type'] == C('order.product_type.image.id')){
                $image_arr[] = $v['product_id'];
            }elseif($v['product_type'] == C('order.product_type.album.id')){
                $album_arr[] = $v['product_id'];
            }elseif($v['product_type'] == C('order.product_type.all_image.id')){
                $all_image[] = $v['product_id'];
            }
        }
        
        $where = array();
        
        if($image_arr){
            //查询产品中的图片信息
            $where['in'] = array('id' => $image_arr);
                            
            $image = $this->Mdinner_images->get_lists('id,thumb,sy_img,img', $where);
            foreach ($detail as $k => $v){
                foreach ($image as $key => $value){
                    if($v['product_id'] == $value['id']){
                        $detail[$k]['sy_img'] = $value['sy_img'];
                        $detail[$k]['img'] = $value['img'];
                        break;
                    }
                }
            }
            
        }
        if($album_arr){
            $where['in'] = array('id' => $album_arr);
            
            $album = $this->Mproducts->get_lists('id,title,cover_img', $where);
            foreach ($detail as $k => $v){
                foreach ($album as $key => $value){
                    if($v['product_id'] == $value['id']){
                        $detail[$k]['cover_img'] = $value['cover_img'];
                        $detail[$k]['title'] = $value['title'];
                        break;
                    }
                }
            }
        }
        //如果是全册购买订单
        if($all_image){
            $where['in'] = array('album_id' => $all_image);
            $all_images = $this->Mdinner_images->get_lists('id,img,album_id,thumb,sy_img', $where);
            
            foreach ($all_images as $key => $value){
                unset($value['id']);
                $new_detail[] = array_merge($detail[0], $value);
            }
            $detail = $new_detail;
        }
        return $detail;
    }
}