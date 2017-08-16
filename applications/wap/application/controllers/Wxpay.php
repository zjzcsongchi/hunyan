<?php
/**
 * 微信支付
 * @author chaokai@gz-zc.cn
 */
class Wxpay extends MY_Controller{
    
    public function __construct(){
        
        parent::__construct();
        
        $this->load->model(array(
                        'Model_products' => 'Mproducts',
                        'Model_order' => 'Morder',
                        'Model_order_detail' => 'Morder_detail',
                        'Model_user' => 'Muser'
        ));
        
        //加载相关类库
        $weixin_config = array(
                        'app_id' => C('wechat_app.app_id.value'),
                        'app_secret' => C('wechat_app.app_secret.value'),
                        'key' => C('wechat_app.key.value'),
                        'mch_id' => C('wechat_app.mch_id.value')
        );
        $this->load->library('weixinpay', $weixin_config);
        $this->load->library(array('form_validation', 'weixinhelper'));
    }
    
    /**
     * 提交订单
     * @param count 商品数量
     * @param product_id 商品id
     * @author chaokai@gz-zc.cn
     */
    public function pay(){
        //验证数据
        $this->form_validation->set_rules('count', '数量', 'required|integer', array('integer' => '%s不能为空'));
        $this->form_validation->set_rules('product_id', '商品', 'required|integer', array('integer' => '需要选择商品'));
        if($this->form_validation->run() === false){
            $this->return_failed(validation_errors());
        }
        
        $count = $this->input->post('count');
        $product_id = $this->input->post('product_id');
        //查询用户openid
        $user_info = $this->Muser->get_one('open_id', array('id' => $this->data['user_info']['id']));
        !$user_info && $this->return_failed('用户未绑定微信号');
        
        //查询商品信息
        $product_where = array('id' => $product_id, 'is_del' => 0);
        $product_info = $this->Mproducts->get_one('*', $product_where);
        if(!$product_info){
            $this->return_failed('商品不存在');
        }
        
        $order_info = array(
                        'order_id' => $this->get_orderid(),
                        'user_id' => $this->data['user_info']['id'],
                        'bill_create_ip' => get_client_ip(),
                        'need_pay' => $count*$product_info['price'],
                        'pay_type' => C('pay_type.wxpay.id'),
                        'create_time' => date('Y-m-d H:i:s')
        );
        $order_id = $this->Morder->create($order_info);
        !$order_id && $this->return_failed('创建订单失败');
        
        //创建订单详情
        $order_detail_info = array(
                        'order_id' => $order_id,
                        'product_id' => $product_id,
                        'product_name' => $product_info['name'],
                        'price' => $product_info['price'],
                        'count' => $count
        );
        $this->Morder_detail->create($order_detail_info);
        
        //统一下单
        $order = array(
                        'body' => '百年婚宴 '.$product_info['name'],
                        'out_trade_no' => $order_info['order_id'],
                        'spbill_create_ip' => $order_info['bill_create_ip'],
                        'total_fee' => $order_info['need_pay'] * 100,
                        'notify_url' => $this->data['domain']['mobile']['url'].'/wxpay/notify',
                        'openid' => $user_info['open_id']
        );
        $this->unifiedorder($order, $order_id);
    }
    
    /**
     * 支付结果异步通知
     * @author cahokai@gz-zc.cn
     */
    public function notify(){
        
        $response = $this->weixinpay->verify_notify();
        $return_data = array('return_code' => 'SUCCESS', 'return_msg' => 'OK');
        if($response['error'] == 1){
            $return_data['return_code'] = 'FAIL';
            $return_data['return_msg'] = '签名失败';
            echo Weixinhelper::array_to_xml($return_data);
            exit;
        }
        
        $response_data = $response['data'];
        //更新订单支付状态
        $out_trade_id = $response_data['out_trade_no'];
        //查询订单状态是否已更改
        $is_change = $this->Morder->get_one('status', array('order_id' => $out_trade_id));
        if(!$is_change || $is_change['status']){//订单不存在或订单状态已更改返回操作成功通知
            die(Weixinhelper::array_to_xml($return_data));
        }
        
        if($response['error'] == 2){
            //订单支付失败
            $update_data = array('status' => 2, 'error_desc' => $response_data['return_msg']);
        }elseif($response['error'] == 3){
            $update_data = array('status' => 2, 'error_desc' => $response_data['err_code_des']);
        }else{
            $update_data = array('status' => 1);
        }
        $update_data['pay_time'] = date('Y-m-d H:i:s');
        $this->Morder->update_info($update_data, array('order_id' => $out_trade_id));
        
        //返回结果
        echo Weixinhelper::array_to_xml($return_data);
    }
    
    /**
     * 查询订单状态
     * @author cahokai@gz-zc.cn
     */
    public function check_order(){
        $order_id = $this->input->get('order_id');
        !$order_id && $this->return_failed('参数错误');
        
        $order_info = $this->Morder->get_one('*', array('id' => $order_id));
        !$order_info && $this->return_failed('订单不存在');
        
        $this->return_success(array('status' => $order_info['status'], 'error_desc' => $order_info['error_desc']));
    }
    
    /**
     * 生成订单编号
     * @author cahokai@gz-zc.cn
     */
    private function get_orderid(){
        $rand_code = get_code();
        return 'bn'.date('YmdHis').$rand_code;
    }
    
    /**
     * 微信统一下单
     * @param $order_info 订单详情
     * @author chaokai@gz-zc.cn
     */
    private function unifiedorder($order_info, $order_id){
        $response = $this->weixinpay->create_order($order_info);
        //发生错误
        if($response['error'] == 1){
            $this->return_failed($response['msg']);
        }
        
        //预付订单号保存到订单表
        $this->Morder->update_info(array('prepay_id' => $response['data']['prepay_id']), array('id' => $order_id));
        //获取jsbridge配置json串
        $jsbridge_str = $this->weixinpay->get_jsbridge_param($response['data']['prepay_id']);
        
        $this->return_success(array('order_id' => $order_id, 'js_bridge' => $jsbridge_str));
        
    }
    
}