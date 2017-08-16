<?php 
/**
* 热点图标控制器
* @author fengyi@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Hotspotico extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model([
            'Model_hotspot_ico' => 'MHotspotico',       
        ]);       
        $this->load->library('pagination');
    }

    /**
     * 场景切换
     * @author fengyi@gz-zc.cn
     */
    public function scene_change() {
        $data = $this->data;
        $data['title'] = ['首页', '热点图标管理'];

        $pageconfig = C('page.config_bootstrap');
        $pagesize = $pageconfig['per_page'];
        $page = intval($this->input->get('per_page'))?:1;
        $offset = $pagesize*($page - 1);

        $field = 'id,url,dynamic_url,is_dynamic,is_default,dynamic_param,create_admin,create_time,update_admin,update_time';
        $where = array('is_del' => 0);
        $order_by = array('create_time' => 'desc');
        $list = $this->MHotspotico->get_lists($field, $where, $order_by, $pagesize, $offset);
        $data['data_count'] = $count = $this->MHotspotico->count($where);

        if(!empty($list)){
            $pageconfig['total_rows'] = $count;
            $pageconfig['base_url'] = '/hotspotico/scene_change';
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }

        $data['list'] = $list;
        
        $this->load->view('hotspotico/list', $data);
    }

    /**
     * 添加
     * @author fengyi@gz-zc.cn
     */
    public function add() {
        $data = $this->data;

        if (IS_POST) {
            $admin_info = $this->session->USER;
            $create_admin = $admin_info['name'];
            $create_time = date('Y-m-d H:i:s');

            $url = trim($this->input->post('img'));
            $dynamic_url = trim($this->input->post('dynamic_img'));
            $is_dynamic = intval($this->input->post('is_dynamic'));
            $is_default = intval($this->input->post('is_default'));
            $dynamic_param = $this->input->post('dynamic_param');
            
            $result = $this->MHotspotico->create([
                'url' => $url,
                'dynamic_url' => $dynamic_url,
                'is_dynamic' => $is_dynamic,
                'is_default' => $is_default,
                'dynamic_param' => $dynamic_param,
                'create_admin' => $create_admin,
                'create_time' => $create_time,
            ]);

            if ($result) {
                $this->return_success();
            } else {
                $this->return_failed('添加失败');
            }
        }

        $this->load->view('hotspotico/add', $data);
    }

    /**
     * 修改
     * @author fengyi@gz-zc.cn
     */
    public function edit() {
        $id = intval($this->input->get('id'));
        $data = $this->data;
        
        if (IS_POST) {
            $admin_info = $this->session->USER;
            $update_admin = $admin_info['name'];
            $update_time = date('Y-m-d H:i:s');
            
            $id = intval($this->input->post('id'));
            $url = trim($this->input->post('img'));
            $dynamic_url = trim($this->input->post('dynamic_img'));
            $is_dynamic = intval($this->input->post('is_dynamic'));
            $is_default = intval($this->input->post('is_default'));
            $dynamic_param = $this->input->post('dynamic_param');
            
            $where = ['id' => $id];
            $data = [
                'url' => $url,
                'dynamic_url' => $dynamic_url,
                'is_dynamic' => $is_dynamic,
                'is_default' => $is_default,
                'dynamic_param' => $dynamic_param,
                'update_admin' => $update_admin,
                'update_time' => $update_time,
            ];
            $result = $this->MHotspotico->update_info($data, $where);
            
            if ($result) {
                $this->return_success();
            } else {
                $this->return_failed('修改成功');
            }
        }

        $where = ['id' => $id];
        $field = 'id,url,dynamic_url,is_dynamic,is_default,dynamic_param';
        $info = $this->MHotspotico->get_one($field, $where);
        empty($info) && show_404();
        $data['info'] = $info;
        $this->load->view('hotspotico/edit', $data);
        
    }
    
    /**
     * 删除
     * @author fengyi@gz-zc.cn
     */
    public function del() {
        $id = intval($this->input->get('id'));
        $where = ['id' => $id];
        $data = ['is_del' => 1];
        $result = $this->MHotspotico->update_info($data, $where);
        if ($result) {
            $this->return_success();
        } else {
            $this->return_failed('删除失败');
        }
    }

}
