<?php
/**
 * 相册订单管理
 * @author chaokai@gz-zc.cn
 */
class Orderimage extends MY_Controller{
    
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
                        'Model_order' => 'Morder',
                        'Model_dinner_images' => 'Mdinner_images',
                        'Model_album_image' => 'Malbum_image',
                        'Model_specifications' => 'Mspecifications',
                        'Model_dinner' => 'Mdinner'
        ));
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    
    public function index(){
        $data = $this->data;
        $page = intval($this->input->get('per_page')) ? : 1;
        
        $search_where = array();
        //判断是否搜索到数据，避免未搜索到客户手机号查找出所有数据
        $is_null = false;
        if($order_id = $this->input->post_get('order_id')){
            $search_where['order_id'] = $order_id;
        }
        if($mobile_phone = $this->input->post_get('mobile_phone')){
            $users = $this->Muser->get_one('id', array('mobile_phone' => $mobile_phone));
            if($users){
                $search_where['user_id'] = $users['id'];
            }else{
                $is_null = true;
            }
        }
        
        $pageconfig = C('page.config_bootstrap');
        $pagesize = $pageconfig['per_page'];
        $offset = ($page - 1) * $pagesize;
        $type = [C('order.order_type.image.id'), C('order.order_type.album.id'), C('order.order_type.all_image.id')];
        $where = array('in' => array('order_type' => $type));
        $where = array_merge($where, $search_where);
        //获取列表
        $data['list'] = !$is_null ? $this->Morder->lists($where, $pagesize, $offset) : [];
        //获取订单对应的新郎新娘
        if($data['list']){
            $data['list'] = $this->get_dinner_info($data['list']);
        }
        //获取总数
        $data['count'] = !$is_null ? $this->Morder->count(array_merge($where, array('is_del' => 0))) : 0;
        //分页
        $pageconfig['total_rows'] = $data['count'];
        $pageconfig['base_url'] = '/orderimage/index?'.http_build_query($search_where);
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links();
        $this->load->view('orderimage/index', $data);
    }
    
    /**
     * 添加订单
     * @author chaokai@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        
        $this->load->view('orderimage/add', $data);
    }
    
    /**
     * 订单详情
     * @author chaokai@gz-zc.cn
     */
    public function detail(){
        $id = $this->input->get('id');
        !$id && show_404();
        $data = $this->data;
        $info = $this->Morder->info($id, 'image');
        if(!$info){
            show_404();
        }
        //查询关联的相片订单id所包含的照片
        $order_info = $this->Malbum_image->get_one('image_order_id,album_cover_image_id, special_id', ['album_order_id' => $info['id']]);
        if($order_info){
            $img_ids = explode(',', $order_info['image_order_id']);
            $album_cover = $order_info['album_cover_image_id'];
            if($img_ids){
                //如果包含有相片id则根据相片id读取相应的相片
                
                if(count($img_ids) > 0){
                    $img = $this->Mdinner_images->get_lists('img,thumb', ['in' => ['id' => $img_ids]]);
                }
                if($img){
                    $data['img_lists'] = $img;
                }
            }
            $info['album_cover'] = $this->Mdinner_images->get_one('img,thumb', array('id' => $album_cover));
            //读取册子规格
            if(!empty($order_info['special_id'])){
                $special = $this->Mspecifications->get_one('*', ['id' => $order_info['special_id']]);
                if($special){
                    $data['special'] = $special;
                }
            }
        }
        $data['info'] = $info;
        
        $this->load->view('orderimage/detail', $data);
    }
    
    
    /**
     * 录入快递信息
     * @author chaokai@gz-zc.cn
     */
    public function input_express(){
        $this->form_validation->set_rules('id', '', 'integer', array('integer' => '参数错误'));
        $this->form_validation->set_rules('express_company', '快递公司', 'trim|required', array('required' => '%s不能为空'));
        $this->form_validation->set_rules('express_number', '快递单号', 'trim|required', array('required' => '%s不能为空'));
        if($this->form_validation->run() === false){
            $this->return_failed(validation_errors());
        }
        
        $post_data = $this->input->post();
        $post_data['delivery_status'] = 1;
        $post_data['delivery_time'] = date('Y-m-d H:i:s');
        $where = array(
                        'id' => $post_data['id']
        );
        unset($post_data['id']);
        $this->Morder->update_info($post_data, $where);
        $this->return_success();
    }
    
    /**
     * 修改订单信息
     * @author chaokai@gz-zc.cn
     */
    public function edit(){
        $id = intval($this->input->get('id'));
        !$id && show_404();
        $data = $this->data;
        
        if(IS_POST){
            $post_data = $this->input->post();
            //更新订单表
            $order_where = array('id' => $id);
            $order_data = array(
                            'delivery_type' => $post_data['delivery_type'],
                            'express_company' => $post_data['express_company'],
                            'express_number' => $post_data['express_number']
            );
            $this->db->trans_start();
            $this->Morder->update_info($order_data, $order_where);
            //更新订单地址表
            $where = array('order_id' => $id);
            $address_data = array(
                            'name' => $post_data['address_name'],
                            'mobile_phone' => $post_data['address_mobile_phone'],
                            'address' => $post_data['address']
            );
            $this->Morder_addr->update_info($address_data, $where);
            //更新商品详情表
            $product_data = array();
            if($post_data['product_type'] == C('order.product_type.image.id')){
                foreach ($post_data['image_id'] as $k => $v){
                    $product_data[] = array(
                                    'order_id' => $id,
                                    'product_id' => $v,
                                    'product_type' => $post_data['product_type'],
                                    'product_name' => '相片',
                                    'price' => '',
                                    'count' => 1
                    );
                }
            }elseif($post_data['product_type'] == C('order.product_type.album.id')){
                $product_name_arr = $this->Mproducts->get_lists('id,title,present_price', array('in' => array('id' => $post_data['image_id'])));
                //组合选择的相簿id和数量
                $product_post_arr = array();
                foreach ($post_data['image_id'] as $k => $v){
                    $product_post_arr[$v] = intval($post_data['image_id_count'][$k]);
                }
                foreach ($product_name_arr as $k => $v){
                    $product_data[] = array(
                                    'order_id' => $id,
                                    'product_type' => $post_data['product_type'],
                                    'product_id' => $v['id'],
                                    'product_name' => $v['title'],
                                    'price' => $v['present_price'],
                                    'count' => $product_post_arr[$v['id']]
                    );
                }
                
            }
            
            $this->Morder_detail->update_info(array('is_del' => 1), $where);
            $this->Morder_detail->create_batch($product_data);
            
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $this->error();
            }else{
                $this->success('', '/orderimage');
            }
        }
        
        $info = $this->Morder->info($id, 'image');
        if(!$info){
            show_404();
        }
        $data['info'] = $info;
        //宴会所有相册相片
        $data['images'] = $this->Mdinner_images->all_images($info['dinner_id']);
        //所有相簿产品
        $data['album'] = $this->Mproducts->get_lists('id,title,cover_img', array('is_del' => 0, 'type' => C('products.type.album.id')));
        //已购买的相片/相册
        if($info['detail']){
            $data['buy_images'] = array_column($info['detail'], 'count', 'product_id');
        }else{
            $data['buy_images'] = array();
        }
        $this->load->view('orderimage/edit', $data);
    }
    
    /**
     * 取消订单
     * @author chaokai@gz-zc.cn
     */
    public function del(){
        $id = $this->input->get('id');
        !$id && $this->return_failed();
        
        if($this->Morder->update_info(array('is_del' => 1), array('id' => $id))){
            $this->return_success();
        }else{
            $this->return_failed('删除失败');
        }
    }
    
    /**
     * 获取订单对应的新郎新娘信息
     * @param array $lists 订单数组
     * @author chaokai@gz-zc.cn
     */
    private function get_dinner_info($lists){
        
        $dinner_ids = array_column($lists, 'dinner_id');
        
        $field = 'id,roles_main,roles_wife';
        $where = array('in' => array('id' => $dinner_ids));
        $dinner_lists = $this->Mdinner->get_dinner_by_ids($dinner_ids);
        
        foreach ($lists as $k => $v){
            foreach ($dinner_lists as $key => $value){
                if($v['dinner_id'] == $value['id']){
                    $lists[$k]['roles_name'] = $value['roles_main'].' & '.$value['roles_wife'];
                    $lists[$k]['venue_name'] = $value['venue_name'];
                    $lists[$k]['solar_time'] = $value['solar_time'];
                }
            }
        }
        
        return $lists;
    }
}