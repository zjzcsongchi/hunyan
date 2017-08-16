<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Navclass extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_navclass' => 'Mnavclass',
            'Model_nav' => 'Mnav',
            'Model_media' => 'Mmedia',
            'Model_channels' => 'Mchannels'
        ]);
    }

    public function channel_classes(){
        try
        {
            //前端显示的一级分类id
            $query = ['parent_id' => 0,'is_show' => 1,'is_del' => 0];
            $level0 = $this->Mchannels->get_lists(array('id','parent_id','name','sort'),$query,['sort' => 'asc']);
            $level0 && is_array($level0) && $level0_ids = array_column($level0, 'id');

            $where['is_del'] = 0;
            if(!empty($level0_ids))
            {
                $where['in']['parent_id'] = $level0_ids;
            }

            $order['sort'] = 'asc';
            $class = $this->Mchannels->get_lists(array('id','parent_id','name','sort'),$where,$order);
    
            //整理归类数据
            if(!empty($level0) && !empty($class))
            {
                foreach ($level0 as $key => $value)
                {
                    foreach ($class as $v)
                    {
                        if($value['id'] == $v['parent_id'])
                        {
                            $level0[$key]['sub_class'][] = $v;
                        }
                    }
                }
            }
    
            $this->return_success($level0,count($level0));
    
        }
        catch (Exception $e)
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    public function media_navs(){
        try
        {
            if(!empty($is_recommend = $this->input->get_post('is_recommend')))
            {
                $where['is_recommend'] = $is_recommend;
            }
            if(!empty($is_show = $this->input->get_post('is_show')))
            {
                $where['is_show'] = $is_show;
            }
            if(!empty($is_del = $this->input->get_post('is_show')))
            {
                $where['is_del'] = $is_del;
            }
            if(!empty($title = $this->input->get_post('keyword')))
            {
                $where['like']['title'] = $title;
            }
    
            $page = $this->input->get_post('page')?: 1;
            $size = $this->input->get_post('pagesize')?: 9;
            $where['is_del'] = 0;
            $order['sort'] = 'desc';
            $result = $this->Mmedia->get_lists('*',$where,$order,$size,($page-1)*$size);
            $count = $this->Mmedia->count($where);
            $this->return_success($result,$count);
        }
        catch (Exception $e)
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * interface:获取众筹导航分类列表(仅限于前端显示的分类)
     * @method get|post
     * @author yuanxiaolin@global28.com
     * @ruturn json
     */
    public function classes(){
        try 
        {
            //前端显示的一级分类id
            $query = ['parent_id' => 0,'is_show' => 1,'is_del' => 0];
            $level0 = $this->Mnavclass->get_lists(array('id','parent_id','name','sort'),$query,['sort' => 'asc']);
            $level0 && is_array($level0) && $level0_ids = array_column($level0, 'id');
            
            $where['is_del'] = 0;
            if(!empty($level0_ids))
            {
                $where['in']['parent_id'] = $level0_ids; 
            }
            
            $order['sort'] = 'asc';
            $class = $this->Mnavclass->get_lists(array('id','parent_id','name','sort'),$where,$order);
            
            //整理归类数据
            if(!empty($level0) && !empty($class))
            {
                foreach ($level0 as $key => $value)
                {
                    foreach ($class as $v)
                    {
                        if($value['id'] == $v['parent_id'])
                        {
                            $level0[$key]['sub_class'][] = $v;
                        }
                    }
                }
            }
            
            $this->return_success($level0,count($level0));
        
        } 
        catch (Exception $e) 
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * interface: 获取子集分类,只获取直接下级
     * @author yuanxiaolin@global28.com
     * @param number $class_id 父级分类ID，默认去一级分类
     * @param number $is_show 是否获取前台显示的分类（只对一级分类有效）
     * @ruturn return_type
     */
    public function level($class_id = 0,$is_show = ''){
        try 
        {
            $where['is_del'] = 0;
            if(!empty($class_id))
            {
                $where['parent_id'] = $class_id;
            }
            if($is_show !== '')
            {
                $where['is_show'] = $is_show;
            }
            $order['sort'] = 'desc';
            $result = $this->Mnavclass->get_lists(array('id','parent_id','name','sort'),$where,$order);
            
            $this->return_success($result,count($result));
        } 
        catch (Exception $e) 
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    
    
    /**
     * interface:  导航分类列表
     * 
     * @param array $where  条件数组
     * @param array $order  排序数组
     * @param string $field  要获取的字段
     * @ruturn json
     */
    public function get_list(){
        try
        {
            $where = $this->input->post('where');
            $order = $this->input->post('order');
    
            $field = $this->input->post('field');
            if(empty($field)){
                $field = '*';
            }
    
            $default_where = ['is_del'=>0,'is_show'=>1];
            $default_order = ['id'=>'desc'];
            if (! is_null($where)){
                $where = array_merge($where, $default_where);
            }else{
                $where = $default_where;
            }
    
            if (! is_null($order)){
                $order = array_merge($order, $default_order);
            }else{
                $order = $default_order;
            }
    
            $lists = $this->Mnavclass->get_lists($field, $where, $order);
    
            if(!empty($lists)){
                $this->return_success($lists);
            }else{
                $this->return_failed();
            }
        }catch (Exception $e){
            $this->return_failed($e->getMessage());
        }
         
    }
    
    
    /**
     * interface:获取某分类下导航列表
     * @method:get|post
     * @author yuanxiaolin@global28.com
     * @param number $site_source 来源站点ID
     * @param number $project_type 项目类型ID
     * @param number $gather_type 众筹类型ID
     * @param number $project_progress 项目进程ID
     * @param number $city_id 城市ID
     * @param number $page     偏移量
     * @param number $size     分页大小
     * @ruturn json
     */
    public function navs(){
        try 
        {
            if(!empty($class_product = $this->input->get_post('class_product')))
            {
                $where['class_product'] = $class_product;
            }
            
            if(!empty($class_industry = $this->input->get_post('class_industry')))
            {
                $where['class_industry'] = $class_industry;
            }
            
            if(!empty($gather_type = $this->input->get_post('gather_type')))
            {
                $where['gather_type'] = $gather_type;
            }
            
            if(!empty($project_status = $this->input->get_post('project_status')))
            {
                $where['project_status'] = $project_status;
            }
            
            if(!empty($is_recommend = $this->input->get_post('is_recommend')))
            {
                $where['is_recommend'] = $is_recommend;
            }
            if(!empty($is_show = $this->input->get_post('is_show')))
            {
                $where['is_show'] = $is_show;
            }
            if(!empty($title = $this->input->get_post('keyword')))
            {
                $where['like']['title'] = $title;
            }
            
            $page = $this->input->get_post('page')?: 1;
            $size = $this->input->get_post('pagesize')?: 9;
            $where['is_show'] = 1;
            $where['is_del'] = 0;
            $order['sort'] = 'desc';
            $result = $this->Mnav->get_lists('*',$where,$order,$size,($page-1)*$size);
            $count = $this->Mnav->count($where);
            $this->return_success($result,$count);
        } 
        catch (Exception $e) 
        {
            $this->return_failed($e->getMessage());
        }
    }
    
    /**
     * interface: 众筹导航城市列表接口
     * @author yuanxiaolin@global28.com
     * @return return_type
     */
    public function cities(){
       $where['is_del'] = 0;
       $where['is_show'] = 1;
       $citied = $this->Mnav->get_lists(array('city_id','city_name'),$where);
       $this->return_success($citied);
    }

}
