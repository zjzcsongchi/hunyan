<?php 
    /**
    * 预定列表控制器
    * @author yonghua@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Order extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_drink_appoint_order' => 'Mdrinkappointorder',
                'Model_drink' => 'Mdrink',
                'Model_drink_class' => 'Mdrinkclass',
               'Model_user' => 'Muser',
        ]);
    }
    
    
    /**
    * 预定列表首页
    * @author yonghua@gz-zc.cn
    */
    public function index(){
        $data = $this->data;
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $data['order_num'] = trim($this->input->get('order_num', TRUE)); 
        $data['user_name'] = trim($this->input->get('user_name', TRUE));
        $data['user_mobile'] = trim($this->input->get('user_mobile', TRUE));
        $data['page'] = $page;
        $where = [];
        if(!empty($data['order_num'])){
            $where['order_num'] = $data['order_num'];
        }
        if(!empty($data['user_mobile'])){
            $where['user_mobile'] = $data['user_mobile'];
        }
        if(!empty($data['user_name'])){           
            $where['user_name'] = $data['user_name'];
        }
        
        $list = $this->Mdrinkappointorder->get_lists('*', $where, ['create_time' => 'desc'], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        $user = $this->Muser->get_lists("id,realname,mobile_phone");
        if($list && $user){
            // 分页信息
            $data['count'] = $this->Mdrinkappointorder->count($where);
            $pageconfig['base_url'] = "/order?".http_build_query($where);
            $pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); 
            
            $data['list'] = $list;
            foreach ($list as $k => $v){
                if($v['cover_img']){
                    $data['list'][$k]['cover_img'] = get_img_url($v['cover_img']);
                }
            }
        }
        $this->load->view('order/index', $data);
    }
    
    /**
    * 手动添加
    * @author yonghua@gz-zc.cn
    */
    public function add(){
        $data = $this->data;
        $data['type'] = $this->Mdrinkclass->get_lists('id,cn_name', ['is_del' => 0]);
        if(IS_POST){
            $add = $this->input->post();
            //查询商品信息
            $drink_field = 'cn_name,cover_img,price';
            $info = $this->Mdrink->get_one($drink_field, ['id' => $add['drink_id']]);
            if(!$info){
                $this->error('操作失败');
            }
            $add['drink_title'] = $info['cn_name'];
            $add['cover_img'] = $info['cover_img'];
            $add['unit_price'] = $info['price'];
            $add['price'] = $info['price']*$add['num'];
            $add['order_num'] = 'BN'.date('YmdHis').mt_rand(100, 1000);
            $add['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdrinkappointorder->create($add);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('提交成功', '/order');
        }
        $this->load->view('order/add', $data);
    }
    
   
    /**
     * 订单删除和状态恢复
     * yonghua@gz-zc.cn
     */
    public function change(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->return_json('未知错误');
        }
        $id = (int) $this->input->post('id',TRUE);
        $k = (int) $this->input->post('k',TRUE);
        $field = trim($this->input->post('field', TRUE));
        $res = $this->Mdrinkappointorder->update_info([$field => $k], ['id' => $id]);
        if(!$res){
            $this->return_json('操作失败');
        }
        $this->return_json(1);
    }
    
    public function erji(){
        $data = $this->data;
        $class_id = $this->input->get('class_id', TRUE);
        $list = $this->Mdrink->get_lists('id,cn_name,price', ['class_id' => $class_id, 'is_del' => 0]);
        if(!$list){
            $this->return_json(['code' => 0]);
        }
        $this->return_json(['code' => 1, 'arr' => $list]);
    }
    /**
     * 编辑预定订单
     */
    public function edit(){
        $data = $this->data;
        $id = (int) $this->input->get('id',TRUE);
        if(empty($id)){
            redirect($data['domain']['admin']['url'].'/order');
        }
        if(IS_POST){
            $id = (int) $this->input->post('id', 'TRUE');
            $up = $this->input->post();
            unset($up['id']);
            $up['price'] = $up['num']*$up['unit_price'];
            $up['update_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdrinkappointorder->update_info($up, ['id' => $id]);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('编辑成功', '/order');
        }
        $data['type'] = $this->Mdrinkclass->get_lists('id,cn_name', ['is_del' => 0]);
        $data['info'] = $this->Mdrinkappointorder->get_one('*',['id' => $id]);
        $this->load->view('order/edit', $data);
    }
}


















