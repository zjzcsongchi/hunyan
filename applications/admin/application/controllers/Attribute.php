<?php 
    /**
    * 相册管理控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Attribute extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_products_attribute' => 'Mproducts_attribute',
            'Model_products' => 'Mproducts',
            'Model_products_class'=>'Mproducts_class',
            'Model_specifications' => 'Mspecifications'
        ]);
        $this->load->library('form_validation');
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $data['attribute_type'] = $this->Mproducts_class->get_lists('id, name, parent_id', array('is_del'=>0));
        $data['title'] = array('相册管理', '列表');
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $offset = ($page-1)*$size;
        
        $class_id = $this->input->get('class_id');
        if($class_id){
            $where['class_id'] = $class_id;
            $data['class_id'] = $class_id;
        }
        
        $is_show = $this->input->get('is_show');
        if($is_show != 2){
            if(isset($is_show)){
                $where['is_show'] = $is_show;
                $data['is_show'] = $is_show;
            }
        }
        
        $is_del = (int) $this->input->get('is_del');
        $where['is_del'] = $is_del;
        $data['is_del'] = $is_del;

        $search_title = $this->input->get('search_title');
        if($search_title){
            $where['like'] = array('title'=>$search_title);
            $data['search_title'] = $search_title;
        }
        
        $order_by['sort'] = 'desc';
        $lists = $this->Mproducts->get_lists('*', $where, $order_by, $size, $offset);
        $products_id = array_column($lists, 'id');
        $data['count'] = $this->Mproducts->count($where);
        //分页
        if($lists){
            $this->pageconfig['base_url'] = '/attribute/index?'.http_build_query($where);
            $this->pageconfig['total_rows'] = $data['count'];
        
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        $data['list'] = $lists;
        $data['count'] = count($lists);
        $this->load->view("attribute/index", $data);
    }
    
    
    /**
     * 增加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        $data['attribute_type'] = $this->Mproducts_class->get_lists('id, name, parent_id', array('is_del'=>0));
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('title', '商品名称', 'trim|required', array('required' => '%s不能为空'));
            $this->form_validation->set_rules('class_id', '商品分类', 'trim|required', array('required' => '%s不能为空'));
            
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            
            $post_data = $this->input->post();
            if($post_data){
                //名称写入t_attribute表
                $time = date("Y-m-d H:i:s",time());
                $add_pro['title'] = $post_data['title'];
                $add_pro['sub_title'] = $post_data['sub_title'];
                $add_pro['cover_img'] = isset($post_data['cover_img']) ? $post_data['cover_img'] : '';
                $add_pro['summary'] = $post_data['summary'];
                $add_pro['firm'] = $post_data['firm'];
                $add_pro['is_show'] = $post_data['is_show'];
                $add_pro['is_recommend'] = $post_data['is_recommend'];
                $add_pro['info'] = $post_data['info'];
                $add_pro['sort'] = $post_data['sort'];
                $add_pro['flag'] = $post_data['flag'];
                $add_pro['allow_num'] = $post_data['allow_num'];
                $add_pro['class_id'] = $post_data['class_id'];
                $add_pro['is_del'] = $post_data['is_del'];
                $add_pro['original_price'] = $post_data['original_price'];
                $add_pro['present_price'] = $post_data['present_price'];
                $add_pro['unit'] = $post_data['unit'];
                $add_pro['create_time'] = $time;
                $add_pro['update_time'] = $time;
                
                //相册处理
                if(isset($post_data['images']) && $post_data['images']){
                    $add_pro['images'] = implode(',', $post_data['images']);
                }
                
                $add_pro_id = $this->Mproducts->create($add_pro);
                if($add_pro_id){
                    //特殊属性写入
                     if((isset($post_data['attr_name']) && $post_data['attr_name'])){
                        foreach ($post_data['attr_name'] as $k=>$v){
                            if($v  && $post_data['attr_value'][$k]){
                                $attr[$k]['attribute'] = $v;
                                $attr[$k]['value'] = $post_data['attr_value'][$k];
                                $attr[$k]['products_id'] = $add_pro_id;
                                $attr[$k]['create_time'] = date('Y-m-d H:i:s', time());
                                $attr[$k]['update_time'] = date('Y-m-d H:i:s', time());
                            }
                        }
                        if(isset($attr) && $attr){
                            $add_attr= $this->Mproducts_attribute->create_batch($attr);
                        }
                    }
                    
                    $temp_img = array();
                    for($i=0;$i<count($post_data['version_name']);$i++){
                        if(isset($post_data['version_image_'.$i])){
                            $temp_img[$i] = $post_data['version_image_'.$i] ? $post_data['version_image_'.$i]:'';
                        }
                    }
                    
                    //规格写入
                    if((isset($post_data['version_name']) && $post_data['version_name'])){
                        foreach ($post_data['version_name'] as $k=>$v){
                            if($v && (isset($post_data['version_price'][$k]) && $post_data['version_price'][$k] )){
                                $specifications[$k]['version_name'] = $v;
                                $specifications[$k]['version_price'] = $post_data['version_price'][$k];
                                $specifications[$k]['products_id'] = $add_pro_id;
                                $specifications[$k]['version_image'] = isset($temp_img[$k]) && $temp_img[$k] ?  $temp_img[$k]: '';
                            }
                        }
                        if(isset($specifications) && $specifications){
                            $add_specifications= $this->Mspecifications->create_batch($specifications);
                        }
                    }
                
                    
                    $this->return_success([],'添加成功');

                }
            }
        }
                
        $this->load->view("attribute/add", $data);
    }
    
    
    public function modify($id, $tab=0){
        $data = $this->data;
        $data['attribute_type'] = $this->Mproducts_class->get_lists('id, name, parent_id', array('is_del'=>0));
        $id = intval($id);
        $data['tab'] = intval($tab);
        $info = $this->Mproducts->get_one('*', array('id'=>$id));
        //相册处理
        if($info['images']){
            $info['images_list'] = explode(',', $info['images']);
        }
        
        $data['info'] = $info; 
        //获取属性类型响应的模板
        $detail = $this->Mproducts_attribute->get_lists('*', array('products_id'=>$info['id']));
        $new_lists= array();
        foreach ($detail as $k=>$v){
            $new_lists[$v['attribute']] = $v['value'];
        }
        
        $data['new_lists'] = $new_lists;
        $data['attr_lists'] = $this->Mproducts_attribute->get_lists('*', array('products_id'=>$id));
        //获取规格信息
        $data['specifications_lists'] = $this->Mspecifications->get_lists('*', array('products_id'=>$id));
        if($this->input->is_ajax_request()){
            
            $post_data = $this->input->post();
            $time = date("Y-m-d H:i:s",time());
            $add_pro['title'] = $post_data['title'];
            $add_pro['sub_title'] = $post_data['sub_title'];
            $add_pro['cover_img'] = isset($post_data['cover_img']) ? $post_data['cover_img'] : '';
            $add_pro['firm'] = $post_data['firm'];
            $add_pro['is_show'] = $post_data['is_show'];
            $add_pro['is_recommend'] = $post_data['is_recommend'];
            $add_pro['summary'] = $post_data['summary'];
            $add_pro['info'] = $post_data['info'];
            $add_pro['class_id'] = $post_data['class_id'];
            $add_pro['sort'] = $post_data['sort'];
            $add_pro['flag'] = $post_data['flag'];
            $add_pro['allow_num'] = $post_data['allow_num'];
            $add_pro['is_del'] = $post_data['is_del'];
            $add_pro['original_price'] = $post_data['original_price'];
            $add_pro['present_price'] = $post_data['present_price'];
            $add_pro['unit'] = $post_data['unit'];
            $add_pro['update_time'] = $time;
            
            //相册处理
            if(isset($post_data['images']) && $post_data['images']){
                $add_pro['images'] = implode(',', $post_data['images']);
            }
            
            $update_id = $this->Mproducts->update_info($add_pro, array('id'=>$post_data['id']));
            if($update_id){
                $del = $this->Mproducts_attribute->delete(array('products_id'=>$post_data['id']));
                //特殊属性写入
                if((isset($post_data['attr_name']) && $post_data['attr_name'])){
                    $del_attr = $this->Mproducts_attribute->delete(array('products_id'=>$post_data['id']));
                    foreach ($post_data['attr_name'] as $k=>$v){
                        if($v  && $post_data['attr_value'][$k]){
                            $attr[$k]['attribute'] = $v;
                            $attr[$k]['value'] = $post_data['attr_value'][$k];
                            $attr[$k]['products_id'] = $post_data['id'];
                            $attr[$k]['create_time'] = date('Y-m-d H:i:s', time());
                            $attr[$k]['update_time'] = date('Y-m-d H:i:s', time());
                        }
                    }
                    if(isset($attr) && $attr){
                        $add_attr= $this->Mproducts_attribute->create_batch($attr);
                    }
                }
                
                $temp_img = array();
                for($i=0;$i<count($post_data['version_name']);$i++){
                    if(isset($post_data['version_image_'.$i])){
                        $temp_img[$i] = $post_data['version_image_'.$i] ? $post_data['version_image_'.$i]:'';
                    }
                }
                //规格更新
                if((isset($post_data['version_name']) && $post_data['version_name'])){
                    $del_specifications = $this->Mspecifications->delete(array('products_id'=>$post_data['id']));
                    foreach ($post_data['version_name'] as $k=>$v){
                        if($v && (isset($post_data['version_price'][$k]) && $post_data['version_price'][$k] )){
                            $specifications[$k]['version_name'] = $v;
                            $specifications[$k]['version_price'] = $post_data['version_price'][$k];
                            $specifications[$k]['products_id'] = $post_data['id'];
                            $specifications[$k]['version_image'] = isset($temp_img[$k]) && $temp_img[$k] ?  $temp_img[$k]: '';
                        }
                    }
                    if(isset($specifications) && $specifications){
                        $add_specifications= $this->Mspecifications->create_batch($specifications);
                    }
                }
                
                $this->return_success([],'修改成功');
                
            }
        }
        
        $this->load->view("attribute/modify", $data);
    }
    
    /**
     * 删除
     * @author songchi@gz-zc.cn
     */
    public function del(){
        $data =$this->data;
        if(!isset($data['userInfo']['id'])){
            $this->return_failed("系统拒绝执行");
        }
        $id = intval($this->input->post('id')); 
        $is_del = (int) $this->input->post('is_del');
        $where['products_id'] = $id;
        $update = $this->Mproducts->update_info(array('is_del'=>$is_del), array('id'=>$id));
        if($update){
            $del = $this->Mproducts_attribute->delete($where);
            $this->return_success([],'操作成功');
        }else{
            $this->return_failed("操作失败");
        }
        
    }
    
    
    public function info($products_id){
        $data = $this->data;
        $data['attribute_type'] = $this->Mproducts_class->get_lists('id, name, parent_id', array('is_del'=>0));
        $data['attribute_type'] = array_column($data['attribute_type'], 'name', 'id');
        $products_id = intval($products_id);
        if($products_id){
            $where['id'] = $products_id;
            $info = $this->Mproducts->get_one('*', $where);
            if(isset($info['images']) && $info['images']){
                $info['img_lists'] = explode(',', $info['images']);
            }
            $data['info'] = $info;
            $data['special_lists'] = $special_lists = $this->Mspecifications->get_lists('*', array('products_id'=>$products_id));
            $data['attr_lists'] = $this->Mproducts_attribute->get_lists('*', array('products_id'=>$products_id));
            
            $data['title'] = array(
                ['url' => '/common', 'text' => '首页'],
                ['url' => $_SERVER['HTTP_REFERER'], 'text' => '商品列表'],
                ['url' => '', 'text' => '商品详情']
            );
        }
        $this->load->view('attribute/info', $data);
    }
    
    
    public function attributeclass(){
        $data = $this->data;
        $data['title'] = array('商品分类', '列表');
        $lists = $this->Mproducts_class->get_lists('id, name, parent_id', array('is_del'=>0));
        $data['class_name'] = array_column($lists, 'name', 'id');
        $data['class_name'][0] = '顶级分类';
        $data['lists'] = $lists;
        $data['count'] = count($lists);
        $this->load->view('productsclass/index', $data);
    }
    
    public function add_attributeclass(){
        $data = $this->data;
        $data['title'] = array('商品分类', '添加');
        $data['class'] = class_loop_list(class_loop($this->Mproducts_class->get_lists("id, name, parent_id", array('is_del' => 0))));
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                $add_data['parent_id'] = $post_data['parent_id'];
                if(!$post_data['name']){
                    $this->return_failed("名称不能为空!");
                }
                $add_data['name'] = $post_data['name'];
                $add_data['is_del'] = $post_data['is_del'];
                $add = $this->Mproducts_class->create($add_data);
                if($add){
                    $this->return_success([], "添加成功");
                }else{
                    $this->return_failed("操作失败");
                }
            }else{
                $this->return_failed("操作失败");
            }
        }
        $this->load->view('productsclass/add', $data);
    }
    
    public function edit_attributeclass($id){
        $data = $this->data;
        $id = intval($id);
        $data['title'] = array('商品分类', '修改');
        $data['class'] = class_loop_list(class_loop($this->Mproducts_class->get_lists("id, name, parent_id", array('is_del' => 0))));
        $data['info'] = $this->Mproducts_class->get_one('id, name, parent_id', array('id'=>$id));
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if($post_data){
                $add_data['parent_id'] = $post_data['parent_id'];
                if(!$post_data['name']){
                    $this->return_failed("名称不能为空!");
                }
                $add_data['name'] = $post_data['name'];
                $add_data['is_del'] = $post_data['is_del'];
                $add = $this->Mproducts_class->update_info($add_data, array('id'=>$post_data['id']));
                if($add){
                    $this->return_success([], "修改成功");
                }else{
                    $this->return_failed("修改失败");
                }
            }else{
                $this->return_failed("操作失败");
            }
        }
        $this->load->view('productsclass/edit', $data);
    }
    
    public function del_products_class(){
        $id = intval($this->input->post('id'));
        $update = $this->Mproducts_class->update_info(array('is_del'=>1), array('id'=>$id));
        if($update){
            $this->return_success([], '删除成功');
        }else{
            $this->return_failed("删除失败");
        }
    }
    
    
    public function set_special($products_id){
        $data = $this->data;
        $data['products_id'] = $products_id;
        //获取规格信息
        $data['specifications_lists'] = $this->Mspecifications->get_lists('*', array('products_id'=>$products_id));
        
        //规格写入
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            
            $temp_img = array();
            for($i=0;$i<count($post_data['version_name']);$i++){
                if(isset($post_data['version_image_'.$i])){
                    $temp_img[$i] = $post_data['version_image_'.$i] ? $post_data['version_image_'.$i]:'';
                }
            }
            
            if((isset($post_data['version_name']) && $post_data['version_name'])){
                $del_specifications = $this->Mspecifications->delete(array('products_id'=>$post_data['products_id']));
                foreach ($post_data['version_name'] as $k=>$v){
                    if($v  && $post_data['version_price'][$k]){
                        $specifications[$k]['version_name'] = $v;
                        $specifications[$k]['version_price'] = $post_data['version_price'][$k];
                        $specifications[$k]['products_id'] = $post_data['products_id'];
                        $specifications[$k]['version_image'] = isset($temp_img[$k]) && $temp_img[$k] ?  $temp_img[$k]: '';
                    }
                }
                if(isset($specifications) && $specifications){
                    $add_specifications= $this->Mspecifications->create_batch($specifications);
                }
            }
            $this->return_success([],'添加成功');
        }
        
        $this->load->view('attribute/set_special', $data);
    }
    
    
    public function set_attr($products_id){
        $data = $this->data;
        $data['products_id'] = $products_id;
        //获取规格信息
        $data['attr_lists'] = $this->Mproducts_attribute->get_lists('*', array('products_id'=>$products_id));
        //规格写入
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if((isset($post_data['attr_name']) && $post_data['attr_name'])){
                $del_attr = $this->Mproducts_attribute->delete(array('products_id'=>$post_data['products_id']));
                foreach ($post_data['attr_name'] as $k=>$v){
                    if($v  && $post_data['attr_value'][$k]){
                        $attr[$k]['attribute'] = $v;
                        $attr[$k]['value'] = $post_data['attr_value'][$k];
                        $attr[$k]['products_id'] = $post_data['products_id'];
                        $attr[$k]['create_time'] = date('Y-m-d H:i:s', time());
                        $attr[$k]['update_time'] = date('Y-m-d H:i:s', time());
                    }
                }
                if(isset($attr) && $attr){
                    $add_attr= $this->Mproducts_attribute->create_batch($attr);
                }
            }
            $this->return_success([],'添加成功');
        }
    
        $this->load->view('attribute/set_attr', $data);
    }
    
    
    public function show($products_id){
        $data['products_id'] = intval($products_id);
        if($data['products_id']){
            $is_show = $this->Mproducts->get_one('is_show', array('id'=>$data['products_id']));
            $show = !$is_show['is_show'] ? !$is_show['is_show']:0;
            $update_data['is_show'] = $show;
            $update = $this->Mproducts->update_info($update_data, array('id'=>$data['products_id']));
            if($update){
                $this->success("操作成功!");
            }else{
                $this->error("操作失败");
            }
        }
    }
    
    
//     public function classify(){
//         $post_data = $this->input->post();
//         if($post_data){
//             $add_data['parent_id'] = $post_data['parent_id'];
//             if(!$post_data['name']){
//                 $this->return_failed("名称不能为空!");
//             }
//             $add_data['name'] = $post_data['name'];
//             $add_data['is_del'] = $post_data['is_del'];
//             $add = $this->Mproducts_class->create($add_data);
//             if($add){
//                 $this->return_success([], "添加成功");
//             }else{
//                 $this->return_failed("操作失败");
//             }
//         }
//     }
    
}
