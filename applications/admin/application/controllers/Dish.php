<?php 
    /**
    * 菜品控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Dish extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_user' => 'Muser',
               'Model_admins' => 'Madmins',
               'Model_file' => 'Mfile',
               'Model_dish' => 'Mdish',
               'Model_dish_class' => 'Mdishclass',
                        
        ]);
        $this->pageconfig = C('page.config_food');
        $this->load->library('pagination');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        $page =  intval(trim($this->input->get("per_page", true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        //条件查询
        $name = $this->input->get_post('name');
        if($name){
            $where['like'] = array('name'=>$name);
            $data['name'] = $name;
        }
        
        $order_by = array('create_time'=>'desc'); 
        $where['is_del'] = 0;
        $data['lists'] = $this->Mdish->get_lists('*', $where, $order_by, $size, ($page-1)*$size);
        $data_count = $this->Mdish->count($where);
        if(! empty($data['lists'])){
            $this->pageconfig['base_url'] = "/dish/index?name=".$name;
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $data['page'] = $page;
        $data['data_count'] = $data_count;
        
        $data['dish_class'] = $this->Mdishclass->get_lists('id, name', $where);
        $data['dish_class'] = array_column($data['dish_class'], 'name', 'id');
        
        $this->load->view("dish/index", $data);
    }
    
    
    public function add(){
        $data = $this->data;
        $where['is_del'] = 0;
        $data['dish_class'] = $this->Mdishclass->get_lists('id, name', $where);
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            $ajax_data = array();
            foreach($post_data['arr'] as $k=>$v){
                $ajax_data[$v['name']] = trim($v['value']);
            }
            
            if($ajax_data){
                $exsit = $this->Mdish->get_one('id', array('name'=>$ajax_data['name'], 'is_del'=>0));
                if($exsit){
                    $list = array('status'=>-1, 'msg'=>"该菜品已经存在了");
                    $this->return_json($list);
                }
                $ajax_data['create_time'] = date('Y-m-d h:i:s', time());
                $ajax_data['update_time'] = date('Y-m-d h:i:s', time());
                $add = $this->Mdish->create($ajax_data);
                if($add){
                    $list = array('status'=>0, 'msg'=>"添加成功");
                    $this->return_json($list);
                }else{
                    $list = array('status'=>-1, 'msg'=>"添加失败");
                    $this->return_json($list);
                }
            }

        }else{
            $this->load->view('dish/add',$data);
            
        }

        
    }
    
    
    
    public function del($id = '0'){
        $id = intval($id);
        $del_status = $this->Mdish->get_one('is_del', array('id'=>$id))['is_del'];
    
        $data['is_del'] = !$del_status;
        $where['id'] = $id;
        $update = $this->Mdish->update_info($data, $where);
        if($update){
            $list = array('status'=>0, 'msg'=>"删除成功");
            $this->return_json($list);
        }else{
            $list = array('status'=>-1, 'msg'=>"删除失败");
            $this->return_json($list);
        }
    }
    
    
    public function edit($id = '0'){
        $data = $this->data;
        $id = intval($id);
        $where['is_del'] = 0;
        $data['info'] = $this->Mdish->get_one('*', array('id'=>$id));
        
        //获取菜系
        $data['dish_class'] = $this->Mdishclass->get_lists('id, name', $where);
        
        if(IS_POST){
            $post_data = $this->input->post();
            if($post_data){
                $post_data['name'] = trim($post_data['name']);
                $update = $this->Mdish->update_info($post_data, array('id'=>$id));
                if($update){
                   $this->success('修改成功', '/dish');
                }else{
                   $this->error('修改失败', '/dish');
                }
            }
        }
        
        $this->load->view('dish/edit', $data);
    }
    
    
    
    /**
     * 详情
     * @author songchi@gz-zc.cn
     */
    public function detail($id) {
        $id = intval($id);
        ! $id && $this->error('参数错误');
        $data = $this->data;
    
        $data['info'] = $this->Mdish->get_one("*", array('id'=>$id));
    
        //获取分类
        $where['is_del'] = 0;
        $data['dish_class'] = $this->Mdishclass->get_lists('id, name', $where);
        $data['dish_class'] = array_column($data['dish_class'], 'name', 'id');
        $this->load->view('dish/ajax_info', $data);
    }
}

