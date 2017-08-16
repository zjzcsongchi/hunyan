<?php 
    /**
    * 菜系控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Dishclass extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_user' => 'Muser',
               'Model_admins' => 'Madmins',
               'Model_dish_class' => 'Mdishclass',
                        
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    /**
     * 菜系列表
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        $page =  intval(trim($this->input->get("per_page", true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('sort'=>'desc'); 
        
        $data['list'] = $this->Mdishclass->get_lists('*', array(), $order_by, $size, ($page-1)*$size);
        $data_count = $this->Mdishclass->count();
        
        if(! empty($data['list'])){
            $this->pageconfig['base_url'] = "/dishclass/index?";
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        
        $data['page'] = $page;
        $data['data_count'] = $data_count;
        $data['admin'] = $this->Madmins->get_lists('id, name');

        $data['admin'] = array_column($data['admin'], 'name', 'id');

        $this->load->view("dishclass/index", $data);
    }
    
    
    /**
     * 菜系添加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        if(IS_POST){
            $post_data = $this->input->post();
            if($post_data){
                $post_data['create_time'] = date('Y--m-d h:i:s', time());
                $post_data['update_time'] = date('Y-m-d h:i:s', time());
                $post_data['create_user'] = $data['userInfo']['id'];
                $add = $this->Mdishclass->create($post_data);
                if($add){
                    $this->success('添加成功', '/dishclass');
                }else{
                    $this->error('添加失败', '/dishclass');
                }
            }

            
        }
        $this->load->view('dishclass/add',$data);
        
    }
    
    
    /**
     * 菜系删除
     * @author songchi@gz-zc.cn
     */
    public function del($id = '0'){
        $id = intval($id);
        $del_status = $this->Mdishclass->get_one('is_del', array('id'=>$id))['is_del'];
    
        $data['is_del'] = !$del_status;
        $where['id'] = $id;
        $update = $this->Mdishclass->update_info($data, $where);
        if($update){
            $this->success('操作成功', '/dishclass');
        }else{
            $this->error('操作失败', '/dishclass');
        }
    }
    
    
    /**
     * 菜系修改
     * @author songchi@gz-zc.cn
     */
    public function edit($id = '0'){
        $data = $this->data;
        $id = intval($id);
        $data['info'] = $this->Mdishclass->get_one('*', array('id'=>$id));
        
        if(IS_POST){
            $post_data = $this->input->post();
            if($post_data){
                $update = $this->Mdishclass->update_info($post_data, array('id'=>$post_data['id']));
                if($update){
                    $this->success('修改成功', '/dishclass');
                }else{
                    $this->error('修改失败', '/dishclass');
                }
            }

        }
        
        $this->load->view('dishclass/edit', $data);
    }
    
    
}

