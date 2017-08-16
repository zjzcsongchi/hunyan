<?php 
/**
* 酒水订单控制器
* @author yonghua@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Orders extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_drink_order' => 'Mdrinkorder',
            'Model_venue' => 'Mvenue',
            'Model_admins' => 'Madmins',
            'Model_drink_class' => 'Mdrinkclass',
            'Model_drink' => 'Mdrink',
            'Model_drink_order_detail' => 'Mdrinkorderdetail'
        ]);
    }
    /**
     * 订单列表
     * @author yonghua@gz-zc.cn
     */
    public function index() {
        $data = $this->data;
        $field = 'id,order_num,order_man,man_phone,order_type,bargain_money,place_id,status,create_admin,receptionist,g_time,create_time,is_del';
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['order_num'] = trim($this->input->get('order_num', TRUE));
        $data['order_man'] = trim($this->input->get('order_man', TRUE));
        $data['man_phone'] = trim($this->input->get('man_phone', TRUE));
        $data['page'] = $page;
        $where = ['is_del' => 0];
        if(!empty($data['order_num'])){
            $where['order_num'] = $data['order_num'];
        }
        if(!empty($data['man_phone'])){
            $where['man_phone'] = $data['man_phone'];
        }
        if(!empty($data['order_man'])){
            $where['order_man'] = $data['order_man'];
        }
        $list = $this->Mdrinkorder->get_lists($field, $where, ['g_time' => 'desc'], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        $admin = $this->Madmins->get_lists('id,name');
        $venue = $this->Mvenue->get_lists('id,name',['is_del' => 0]);
        if($list){
            // 分页信息
            $data['count'] = $this->Mdrinkorder->count($where);
            $pageconfig['base_url'] = "/orders?".http_build_query($where);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
            
            $data['list'] = $list;
            foreach ($list as $k => $v){
                foreach ($admin as $kk => $vv){
                    if($v['create_admin'] == $vv['id']){
                        $data['list'][$k]['create_admin'] = $vv['name'];
                    }
                }
                
                foreach ($venue as $kk => $vv){
                    $place_ids = explode(',', $v['place_id']);
                    //var_dump($place_ids);exit;
                    foreach ($place_ids as $key => $value){
                        if($value == $vv['id']){
                            $data['list'][$k]['place_name'][] = $vv['name'];
                        }
                    }
                }
            }
        }
        
        $this->load->view('orders/index', $data);
    }
    /**
     * 订单列表
     * @author yonghua@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('请先登陆');
        }
        $data['title'] = ['订单列表', '添加'];
        //宴会类型
        $data['party'] = C('party');
        //场馆列表
        $data['venue_list'] = $this->Mvenue->lists();
        if(IS_POST){
            $add['order_man'] = trim($this->input->post('order_man', TRUE));
            $add['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $add['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $add['create_admin'] = $data['userInfo']['id'];
            $res = $this->Mdrinkorder->create($add);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败' ]);
            }
            $this->return_json(['code' => 1, 'id' => $res]);
        }
        $data['class'] = $this->Mdrinkclass->get_lists('id,cn_name',['is_del' => 0]);
        $this->load->view('orders/add', $data);
    }
    
    /**
     * 修改客户信息
     * yonghua@gz-zc.cn
     */
    public function edit_man(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('请先登陆');
        }
        if(IS_POST){
            $id = (int) $this->input->post('id', TRUE);
            $add['order_man'] = trim($this->input->post('order_man', TRUE));
            $add['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $add['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $add['create_admin'] = $data['userInfo']['id'];
            $res = $this->Mdrinkorder->update_info($add, ['id' => $id]);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败' ]);
            }
            $this->return_json(['code' => 1, 'id' => $res]);
        }
    }
    
    /**
     * 提交订单信息
     * yonghua@gz-zc.cn
     */
    public function addorderinfo(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        if(IS_POST){
            $updata = $this->input->post();
            $updata['id']= (int) $this->input->post('id', TRUE);
            $updata['order_man'] = trim($this->input->post('order_man', TRUE));
            $updata['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $updata['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $updata['create_admin'] = $data['userInfo']['id'];          
            $updata['place_id'] = implode(',', $updata['place_id']);
            $updata['bargain_money'] = $this->input->post('bargain_money', TRUE);
            $updata['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
            $updata['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdrinkorder->create($updata);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败']);
            }
            $this->return_json(['code' => 1, 'id' => $res, 'order_num' => $updata['order_num']]);
        }
    }
    
    /**
     * 提交订单信息
     * yonghua@gz-zc.cn
     */
    public function editorderinfo(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        if(IS_POST){
            $updata = $this->input->post();
            $id = (int) $this->input->post('id', TRUE);
            unset($updata['id']);
            $updata['order_man'] = trim($this->input->post('order_man', TRUE));
            $updata['man_phone'] = (int) $this->input->post('man_phone', TRUE);
            if(!preg_match(C('regular_expression.mobile'), $updata['man_phone'])){
                $this->return_json(['code' => -1, 'msg' => '手机号格式不正确' ]);
            }
            $add['order_info'] = trim($this->input->post('order_info', TRUE));
            $updata['place_id'] = implode(',', $updata['place_id']);
            $updata['bargain_money'] = $this->input->post('bargain_money', TRUE);
            $updata['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdrinkorder->update_info($updata, ['id' => $id]);
            if(!$res){
                $this->return_json(['code' => 0, 'msg' => '操作失败']);
            }
            $this->return_json(['code' => 1]);
        }
    }
    
    /**
     * 通过id获得价格
     * yonghua@gz-zc.cn
     */
    public function get_price_by_id(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $id = (int) $this->input->get('id', TRUE);
        $res = $this->Mdrink->get_one('price,cn_name', ['id' =>$id]);
        if($res){
            $this->return_json($res);
        }
    }
    
    /**
     * 添加商品
     * yonghua@gz-zc.cn
     */
    public function add_goods(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $add = $this->input->post();
        $res = $this->Mdrink->get_one('price,cn_name,cover_img,class_id', ['id' => $add['foods_id']]);
        if(!$res){
            $this->return_json('商品信息不存在');
        }
        $add['num'] = (int) $add['num'];
        $add['total_price'] = $res['price']*$add['num'];
        $add['cover_img'] = $res['cover_img'];
        $add['unit_price'] = $res['price'];
        $add['foods_name'] = $res['cn_name'];
        $add['class_id'] = $res['class_id'];
        unset($add['price']);
        $resk = $this->Mdrinkorderdetail->create($add);
        if(!$resk){
            $this->return_json('添加失败');
        }
        $rets = $this->Mdrinkclass->get_one('cn_name', ['id' => $res['class_id']]);
        
        $this->return_json(['code' => 1, 'id' => $resk, 'name' => $rets['cn_name']]); 
    }
    
    /**
     * 编辑商品
     * yonghua@gz-zc.cn
     */
    public function edit_goods(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $id = $this->input->post('id');
        $up['num'] = (int) $this->input->post('num', TRUE);
        $up['unit_price'] = $this->input->post('unit_price', TRUE);
        $up['total_price'] = $up['num']*$up['unit_price'];
        $res = $this->Mdrinkorderdetail->update_info($up, ['id' => $id]);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    
    }
    
    /**
     * 删除商品
     * yonghua@gz-zc.cn
     */
    public function del_goods(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $add = $this->input->post();
        $id = (int) $this->input->post('id', TRUE);
        $res = $this->Mdrinkorderdetail->update_info(['is_del' => 1], ['id' => $id]);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    
    /**
     * 保存订单
     * yonghua@gz-zc.cn
     */
    public function finsh(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('请先登陆');
        }
        $id = (int) $this->input->post('id',TRUE);
        $up['status'] = (int) $this->input->post('status', TRUE);
        if(C('orders_status.end.id') == $up['status']){
            $up['finsh_time'] = date('Y-m-d H:i:s');
        }
        $up['free_price'] = $this->input->post('free', TRUE);
        $up['total_price'] = $this->input->post('total_price', TRUE);
        $need = $this->Mdrinkorder->get_one('bargain_money', ['id' => $id]);
        if(!$need){
            $need['bargain_money'] = 0;
        }
        $up['need_pay'] = ($up['total_price'] - $up['free_price'] - $need['bargain_money']);
        //查询订单详情的价格与当前的总价格是否一致
        $ret = $this->Mdrinkorderdetail->get_lists('total_price', ['order_id' => $id, 'is_del' => 0]);
        if($ret){
            $s_total = 0;
            foreach ($ret as $k => $v){
                $s_total += $v['total_price']; 
            }
            if( $up['need_pay'] == ($s_total - $up['free_price'] - $need['bargain_money']) ){
                $res = $this->Mdrinkorder->update_info($up, ['id' => $id]);
                if(!$res){
                    $this->return_json('提交失败');
                }
                $this->return_json(1);
            }
            $this->return_json('价格校验不通过');
        }
        $this->return_json('至少添加一件商品');
        
    }
    
    /**
     * 编辑订单
     * yonghua@gz-zc.cn
     */
    public function edit(){
        $data = $this->data;
        $data['title'] = ['酒水列表','编辑'];
        $id = $this->input->get('id', TRUE);
        //宴会类型
        $data['party'] = C('party');
        $data['venue_list'] = $this->Mvenue->lists();
        $data['class'] = $this->Mdrinkclass->get_lists('id,cn_name',['is_del' => 0]);
        $list = $this->Mdrinkorderdetail->get_lists('*', ['order_id' => $id, 'is_del' => 0]);
        $data['class'] = $this->Mdrinkclass->get_lists('id,cn_name');
        if($list){
            $data['list'] = $list;
        }
        $info = $this->Mdrinkorder->get_one("*", ['id' => $id]);
        if($info){
            $data['info'] = $info;
        }
        //var_dump($info);exit;
        $this->load->view('orders/edit', $data);
    }
    /**
     * 订单详情
     * yonghua@gz-zc.cn
     */
    public function detail(){
        $data = $this->data;
        $data['title'] = ['酒水列表','查看'];
        $id = $this->input->get('id', TRUE);
        //宴会类型
        $data['party'] = C('party');
        $data['venue_list'] = $this->Mvenue->lists();
        $data['class'] = $this->Mdrinkclass->get_lists('id,cn_name',['is_del' => 0]);
        $list = $this->Mdrinkorderdetail->get_lists('*', ['order_id' => $id, 'is_del' => 0]);
        $info = $this->Mdrinkorder->get_one("*", ['id' => $id]);
        if($info){
            $data['info'] = $info;
            $res = $this->Madmins->get_one('name',['id' => $info['create_admin']]);
            if($res){
                $data['admin_name'] = $res['name'];
            }
        }
        if($list){
            $data['list'] = $list;
            $price = 0;
            foreach ($list as $k => $v){
                $price += $v['total_price'];
            }
            if($info['total_price'] != $price){
                //判断总价格是否相等
                $need_pay = $price - $info['bargain_money'] - $info['free_price'];
                $this->Mdrinkorder->update_info(['total_price' => $price ,'need_pay' => $need_pay], ['id' => $id]);
                $data['info']['total_price'] = $price;
                $data['info']['need_pay'] = $need_pay;
            }
        }
        $this->load->view('orders/detail', $data);
    }
    
    public function del(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('请先登陆');
        }
        $id =(int) $this->input->get('id', TRUE);
        $is_del = (int) $this->input->get('is_del', TRUE);
        $res = $this->Mdrinkorder->update_info(['is_del' => $is_del], ['id' => $id]);
        if(!$res){
            $this->error('操作失败');
        }
        $this->success('操作成功');
    }
}





















