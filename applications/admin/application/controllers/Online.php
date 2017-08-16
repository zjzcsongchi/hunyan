<?php 
    /**
    * 线下酒水订单控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class  Online extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_order' => 'Morder',
            'Model_order_addr' => 'Morderaddr',
            'Model_order_detail' => 'Morderdetail',
            'Model_products' => 'Mproducts',
            'Model_specifications' => 'Mspecifications',
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $pay_status = C('order.pay_status');
        $this->data['pay_status'] = array_column($pay_status, 'name', 'id');
    }
    /**
    * 优惠卷列表
    * @author yonghua@gz-zc.cn
    */
    public function index(){
        $data = $this->data;
        $data['title'] = array('酒水订单', '列表');
        $order_type = C('order.product_type.drink.id');
        
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['page'] = $page;
        
        $data['order_num'] = trim($this->input->get('order_num', TRUE));
        $data['order_man'] = trim($this->input->get('order_man', TRUE));
        $data['man_phone'] = trim($this->input->get('man_phone', TRUE));
        
        $where['is_del'] = 0;
        $where['order_type'] = $order_type;
        $is_del = $this->input->get('is_del');
        if(isset($is_del) && $is_del){
            $where['is_del'] = 1;
            $data['is_del'] = 1;
        }else{
            $where['is_del'] = 0;
            $data['is_del'] = 0;
        }
        
        if(!empty($data['order_num'])){
            $where['order_id'] = $data['order_num'];
        }
        if(!empty($data['man_phone'])){
            $addr_where['mobile_phone'] = $data['man_phone'];
        }
        if(!empty($data['order_man'])){
            $addr_where['like'] = array('name'=>$data['order_man']);
        }
        
        if(isset($addr_where)){
            $order_id = $this->Morderaddr->get_lists('order_id', array_merge($addr_where, array('is_del'=>0)));
            $order_id = array_column($order_id, 'order_id');
            if($order_id){
                $where['in'] = array('id'=>$order_id);
            }else{
                $where['in'] = array('id'=>0);
            }
        }
        
        $list = $this->Morder->get_lists('*', $where, ['create_time' => 'asc'], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        if($list){
            $data['count'] = $this->Morder->count($where);
            $pageconfig['base_url'] = "/online/index?".http_build_query($where);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
            $data['list'] = $list;
            $order_ids = array_column($list, 'id');
            if($order_ids){
                $addr_tmp = $this->Morderaddr->get_lists('*', array('in'=>array('order_id'=>$order_ids), 'is_del'=>0));
                $addr = array();
                foreach ($addr_tmp as $k=>$v){
                    $addr[$v['order_id']] = $v;
                }
                $data['addr'] = $addr;
            }
            
        }
        
        $this->load->view('online/index', $data);
    }
    
    public function edit(){
        $data = $this->data;
        $id = $this->input->get('id');
        $data['id'] = $id;
        
        
        
        $data['drink_class'] = C('products.drinks_class');
        $data['drink_class'] = array_column($data['drink_class'], 'name', 'id');
        
        $data['list'] = $this->Morderdetail->get_lists('*', array('order_id'=>$id, 'is_del'=>0));
        $special_id = array_column($data['list'], 'special_id');
        if($special_id){
            $special_name = $this->Mspecifications->get_lists('id, version_name', array('in'=>array('id'=>$special_id)));
            $data['special_name'] = array_column($special_name, 'version_name', 'id');
        }
        $product_id = array_column($data['list'], 'product_id');
        if($product_id){
            $class_id = $this->Mproducts->get_lists('id, class_id', array('in'=>array('id'=>$product_id)));
            $class_id = array_column($class_id, 'class_id', 'id');
        }
        foreach ($data['list'] as $k=>$v){
            if(isset($class_id[$v['product_id']])){
                $data['list'][$k]['class_id'] = $class_id[$v['product_id']];
            }
        }
        
        $data['info'] = $this->Morderaddr->get_one('*', array('order_id'=>$id));
        
        $data['order'] = $this->Morder->get_one('*', array('id'=>$id));
        $data['delivery_type'] = C('order.delivery_type');
        $this->load->view('online/edit', $data);
        
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
            $special_name = array_column($special, 'version_name', 'id');
        }
    
        //计算价格
        $total_price = 0;
        foreach ($post_data['product_id'] as $k=>$v){
            $total_price += $post_data['unit_price'][$k]*$post_data['num'][$k];
        }
        $need_pay = $total_price;
        if($total_price != $post_data['total']){
            $this->return_failed("订单创建失败!");
        }
        //更新order_addr表
        $addr_where['order_id'] = $post_data['id'];
        $addr_add['name'] = $post_data['name'];
        $addr_add['mobile_phone'] = $post_data['mobile_phone'];
        $addr_add['address'] = isset($post_data['address']) ? $post_data['address']:'';
        $update_addr = $this->Morderaddr->update_info($addr_add, $addr_where);
        
        if($update_addr){
            //删除详情表里订单数据
            $del = $this->Morderdetail->delete(array('order_id'=>$order_id));
            $add_data = array();
            foreach ($post_data['product_id'] as $k=>$v){
                $add_data[$k]['product_id'] = $v;
                $add_data[$k]['price'] = $post_data['unit_price'][$k];
                $add_data[$k]['count'] = $post_data['num'][$k];
                $add_data[$k]['special_id'] = isset($post_data['special_id'][$k]) ? $post_data['special_id'][$k]:0;
                $add_data[$k]['product_name'] = $product_name[$v];
                $add_data[$k]['order_id'] = $order_id;
                $add_data[$k]['product_type'] = C('order.product_type.drink.id');
                $add_data[$k]['special_name'] = isset($special_name[$post_data['special_id'][$k]]) ? $special_name[$post_data['special_id'][$k]]:'';
    
            }
            //添加商品详情数据
            $add_detail_id = $this->Morderdetail->create_batch($add_data);
            
            //修改order表里数据
            if(!$post_data['delivery_type']){
                $need_pay += C('order.delivery_type.express.price');
            }
            
            $add_order['need_pay'] = $need_pay;
            $add_order['delivery_type'] = $post_data['delivery_type'];
            $update = $this->Morder->update_info($add_order, array('id'=>$order_id));
            
            $this->return_success("修改成功!");
        }else{
            $this->return_failed("修改失败!");
        }
    
    }
    
    public function del(){
        $id = $this->input->get('id');
        if(!$id){
            die();
        }
        $del_order = $this->Morder->update_info(array('is_del'=>1), array('id'=>$id));
        $del_addr = $this->Morderaddr->update_info(array('is_del'=>1), array('order_id'=>$id));
        if($del_order && $del_addr){
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
        
    }
    
    
    public function detail($id){
        $data = $this->data;
        $data['title'] = array('线上订单', '详情');
        $id = intval($id);
        if(!$id){
            die();
        }
        $data['id'] = $id;
        $data['order_info'] = $this->Morder->get_one('*', array('id'=>$id));
        $data['info'] = $this->Morderaddr->get_one('*', array('order_id'=>$id));
        
        //获取详情
        $data['list'] = $this->Morderdetail->get_lists('*', array('is_del'=>0, 'order_id'=>$id));
        
        $sum = 0;
        foreach ($data['list'] as $k=>$v){
            $data['list'][$k]['per_price'] = $v['count']*$v['price'];
            $sum += $v['count']*$v['price'];
        }
        $data['sum'] = $sum?$sum:0;
        
        //获取商品图片
        $product_id = array_column($data['list'], 'product_id');
        if($product_id){
            $where['in'] = array('id'=>$product_id);
            $product_img = $this->Mproducts->get_lists('id, cover_img', $where);
            $data['product_img'] = array_column($product_img, 'cover_img', 'id');
        }
        
        //获取规格对应图片
        $special_id = array_column($data['list'], 'special_id');
        if($special_id){
            $default_where['in'] = array('id'=>$special_id);
            $special_img = $this->Mspecifications->get_lists('*', $default_where);
            $data['special_img'] = array_column($special_img, 'version_image', 'id');
        }
        $this->load->view('online/detail', $data);
        
    }
    
    
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
        
        $post_data['delivery_status'] = 1;
        $post_data['delivery_time'] = date('Y-m-d H:i:s');
        $where = array(
            'id' => $post_data['id']
        );
        unset($post_data['id']);
        $this->Morder->update_info($post_data, $where);
        $this->return_success();
    }
    
}

