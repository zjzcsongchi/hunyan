<?php
/**
 * 场馆管理
 * @author chaokai@gz-zc.cn
 */
class Venue extends MY_Controller{

    public function __construct(){

        parent::__construct();
        
        $this->load->model(array(
            'Model_venue' => 'Mvenue',
                        'Model_user' => 'Muser',
                        'Model_dinner' => 'Mdinner',
                        'Model_dish' => 'Mdish',
                        'Model_combo' => 'Mcombo',
                        'Model_dinner_detail' => 'Mdinner_detail',
                        'Model_customer_case' => 'Mcustomer_case',
                        'Model_dinner_venue' => 'Mdinner_venue',
                        'Model_venue_images' => 'Mvenueimages',
        ));
        
        $this->load->library('form_validation');
    
    }

    /**
     * 列表页
     * @author chaokai@gz-zc.cn
     */
    public function index($id = 0){

        $id = intval($id);
        
        $data = $this->data;
        $this->load->helper('date');
        
        $where = array();
        if($id){
            $where['id'] = $id;
        }
        $data['list'] = $this->Mvenue->lists($where);
        
        //获取该月天数
        $data['month'] = $month = date('m');
        $data['year'] = $year = date('Y');
        $data['days'] = days_in_month($month, $year);
        $data['venue_id'] = $id;
        //获取场馆预约情况
        $appoint_list = $this->Mdinner->get_appoint(array(), $month, $year);
        foreach ($data['list'] as $k => $v){
            foreach ($appoint_list as $key => $value){
                if($v['id'] == $key){
                    $data['list'][$k]['appoint_list'] = $value;
                    break;
                }
            }
        }
        $this->load->view('venue/index', $data);
    
    }

    /**
     * 添加场馆页面
     * @author chaokai@gz-zc.cn
     */
    public function add(){

        $data = $this->data;
        if(IS_POST)
        {
            $this->form_validation->set_rules('name', '场馆名称', 'trim|required', array(
                'required' => '%s不能为空'
            ));
            
            if($this->form_validation->run() == false)
            {
                $this->return_failed(validation_errors());
            }
            
            $post_data = $this->input->post();

            //将客户案例信息单独存表
            if(isset($post_data['case_cover_img'])){
                $case_cover_img = $post_data['case_cover_img'];
                unset($post_data['case_cover_img']);
                $case_video = $post_data['case_video'];
                unset($post_data['case_video']);
            }
            
            if(isset($post_data['venue_img'])){
                $post_data['images'] = implode(',', $post_data['venue_img']);
            }
            unset($post_data['venue_img']);
            $time = date('Y-m-d H:i:s');
            $post_data['create_time'] = $post_data['update_time'] = $time;
            $post_data['create_admin'] = $post_data['update_admin'] = $data['userInfo']['id'];
            
            if($venue_id = $this->Mvenue->create($post_data))
            {
                if(isset($case_cover_img)){
                    $datalist = array();
                    foreach($case_video as $key => $video){
                        $cover_img = isset($case_cover_img[$key]) ? $case_cover_img[$key] : '';
                        $datalist[] = ['venue_id' => $venue_id, 'case_video' => $video, 'case_cover_img' => $cover_img, 'create_time' => $time];
                    }
                    
                    if($this->Mcustomer_case->create_batch($datalist)){
                        $this->return_success([], '添加成功');
                    }else{
                        $this->return_failed('添加失败');
                    }
                }else{
                    $this->return_success([], '添加成功');
                }
            }
            else
            {
                $this->return_failed('添加失败');
            }
        }
        
        //获取包房分类
        $venue_type = C('public.venue_type');
        $data['venue_type'] = array_column($venue_type, 'name', 'id'); 
        
        $this->load->view('venue/add', $data);
    
    }
    
    
    /**
     * 修改场馆信息
     * @author chaokai@gz-zc.cn
     */
    public function modify($id = 0){
        
        $data = $this->data;
        
        if(IS_POST){
            $this->form_validation->set_rules('id', '参数', 'integer', array('integer' => '%s不合法'));
            $this->form_validation->set_rules('name', '场馆名称', 'trim|required', array(
                'required' => '%s不能为空'
            ));
            
            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }
            
            $post_data = $this->input->post();
            
            //将客户案例信息单独存表
            if(isset($post_data['case_cover_img'])){
                $case_cover_img = $post_data['case_cover_img'];
                unset($post_data['case_cover_img']);
                $case_video = $post_data['case_video'];
                unset($post_data['case_video']);
            }
            
            //查询场馆名称是否已存在
            if($this->Mvenue->get_one('id', array('id !=' => $post_data['id'], 'name' => $post_data['name']))){
                $this->return_failed('场馆名称已存在');
            }
            $venue_id = intval($post_data['id']);
            $where = array('id' => $venue_id);
            unset($post_data['id']);
            
            if(isset($post_data['images'])){
                $post_data['images'] = implode(',', $post_data['images']);
            }
            if($this->Mvenue->update_info($post_data, $where)){
                //先删除原有的客户案例记录
                $this->Mcustomer_case->delete(array('venue_id' => $venue_id));
                
                $datalist = array();
                $time = date('Y-m-d H:i:s');
                if(isset($case_cover_img)){
                    foreach($case_video as $key => $video){
                        $cover_img = isset($case_cover_img[$key]) ? $case_cover_img[$key] : '';
                        $datalist[] = ['venue_id' => $venue_id, 'case_video' => $video, 'case_cover_img' => $cover_img, 'create_time' => $time];
                    }
                    
                    if($this->Mcustomer_case->create_batch($datalist)){
                        $this->return_success([], '修改成功');
                    }else{
                        $this->return_failed('修改失败');
                    }
                }else{
                    $this->return_success([], '修改成功');
                }

            }else{
                $this->return_failed('操作失败');
            }
        }
        $id = intval($id);
        !$id && show_404();
        $data['info'] = $this->Mvenue->info($id);
        
        $data['info']['customer_case'] = $this->Mcustomer_case->get_lists('*' ,array('venue_id' => $id, 'is_del' => 0));
        

        //获取包房分类
        $venue_type = C('public.venue_type');
        $data['venue_type'] = array_column($venue_type, 'name', 'id');
        $data['venue_id'] = (int) $id;
        $this->load->view('venue/modify', $data);
    }
    
    public function album(){
        $data = $this->data;
        $venue_id = $this->input->get('venue_id');
        $list = $this->Mvenueimages->get_lists('*', ['venue_id' => $venue_id, 'is_del' => 0]);
        if($list){
            $data['list'] = $list;
        }
        $data['venue_id'] = $venue_id;
        $data['title'] = array('首页', '场馆管理');
        $this->load->view('venue/album', $data);
    }
    
    public function add_venue_album(){
        $data = $this->data;
        $venue_id = (int) $this->input->get('venue_id');
        if($venue_id == 0){
            $this->error('拒绝操作');
        }
        $data['venue_id'] = $venue_id;
        if(IS_POST){
            if(!isset($data['userInfo'])){
                $this->error('拒绝操作');
            }
            $add['venue_id'] = (int) $this->input->post('venue_id');
            if($add['venue_id'] == 0){
                $this->error('拒绝操作');
            }
            $add['title'] = trim($this->input->post('title'));
            if(empty($add['title'])){
                $this->error('相册名称不能为空');
            }
            $images = $this->input->post('venue_img');
            if(count($images)>0){
                $add['images'] = implode(',', $images);
            }else{
                $this->error('请添加相片');
            }
            $res = $this->Mvenueimages->create($add);
            if(!$res){
                $this->error('操作失败');
            }
            $this->success('添加成功！', '/venue/album?venue_id='.$add['venue_id']);
        }
        $this->load->view('venue/venue_add_album', $data);
    }
    
    public function del_album(){
        $data = $this->data;
        if(!isset($data['userInfo'])){
            $this->error('拒绝操作');
        }
        $id = (int) $this->input->get('id');
        if($id == 0){
            $this->error('拒绝操作');
        }
        $ret = $this->Mvenueimages->get_one('images', ['id' => $id]);
        if(!empty($ret['images'])){
            $this->error('该相册内还有相片，您不能删除');
        }
        $res = $this->Mvenueimages->update_info(['is_del' => 1], ['id' => $id]);
        if(!$res){
            $this->error('操作失败');
        }
        $this->success('删除成功！');
    }
    
    public function album_detail(){
        $data = $this->data;
        if(IS_POST){
            if(!isset($data['userInfo'])){
                $this->error('拒绝操作');
            }
            $id = (int) $this->input->post('id');
            $images = $this->input->post('venue_img');
            if(!isset($images[0])){
                $up['images'] = '';
            }else{
                $up['images'] = implode(',', $images);
            }
            $res = $this->Mvenueimages->update_info($up, ['id' => $id]);
            if(!$res){
                $this->error('操作失败');
            }
            $venue_id = (int) $this->input->get('venue_id');
            $this->success('保存成功！', '/venue/album?venue_id='.$venue_id);
        }
        $id = $this->input->get('id');
        $data['venue_id'] = $this->input->get('venue_id');
        if(!isset($data['userInfo'])){
            $this->error('拒绝操作');
        }
        if($id == 0){
            $this->error('拒绝操作');
        }
        $info = $this->Mvenueimages->get_one('id,title,images', ['id' => $id]);
        if($info){
            $data['info'] = $info;
            if(!empty($info['images'])){
                $data['info']['images'] = explode(',', $info['images']);
            }
        }
        $this->load->view('venue/album_detail', $data);
    }
    
    /**
     * 切换显示月份
     * @author chaokai@gz-zc.cn
     * 
     */
    public function change_date(){
        $data = $this->data;
        //数据验证
        $this->form_validation->set_rules('year', '年份', 'numeric', array('numeric' => '%s数据不正确'));
        $this->form_validation->set_rules('month', '月份', 'numeric', array('numeric' => '%s数据不正确'));
        $this->form_validation->set_rules('venue_id', '场馆', 'numeric', array('numeric' => '%s数据不正确'));
        
        if($this->form_validation->run() == false){
            show_404();
        }
        
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $venue_id = $this->input->post('venue_id');
        $data['year'] = $year;
        $data['month'] = $month;
        $data['venue_id'] = $venue_id;
        
        //计算搜索月的天数
        $this->load->helper('date');
        $data['days'] = days_in_month($month, $year);
        
        $data['appoint_list'] = $this->Mdinner->get_appoint(array($venue_id), $month, $year);
        $this->load->view('venue/appoint_list', $data);
    }
    
    /**
     * 详情/相册
     * @author chaokai@gz-zc.cn
     */
    public function show_images(){
        $this->form_validation->set_rules('id', '参数', 'integer', array('integer' => '%s不合法'));
        
        if($this->form_validation->run() == false){
            $this->return_failed(validation_errors());
        }
        $id = $this->input->post('id');
        $info = $this->Mvenue->info($id);
        
        $this->return_success($info['images_url']);
    }
    
    /**
     * 删除场馆
     * @author chaokai@gz-zc.cn
     */
    public function del_venue($id){
        $id = intval($id);
        !$id && $this->return_failed('参数不合法');
        
        if($this->Mvenue->update_info(array('is_del' => 1), array('id' => $id))){
            $this->return_success();
        }else{
            $this->return_failed('操作失败');
        }
        
    }
    
    /**
     * 查询空余场馆
     * @author songchi@gz-zc.cn
     */
    public function blank(){
        $data = $this->data;
        $time = $this->input->get('time');
        $reserve_time = $this->reserve($time);

        //获取年月
        $data['year'] = $year = date('Y', strtotime($time));
        $data['month'] = $month = date('m', strtotime($time));
        $this->load->helper('date');
        // 获取天数
        $days = days_in_month($month, $year);
        //判断是否精确到日搜索
        $post_day = substr($time,8,2) == true ? substr($time,8,2) : '0';
        if(!$post_day){
            $time_begin = $time.'-01';
            $time_end = $time.'-'.$days;
            $where['solar_time>='] = $time_begin;
            $where['solar_time<='] = $time_end;
        }else{
            $where['solar_time'] = $time;
        }
        
        //默认筛选条件
        $where['is_del'] = 0;
        $order_by['solar_time'] = 'asc'; 
        
        //获取订单id和预订时间
        $list = $this->Mdinner->get_lists('id,solar_time', $where, $order_by ,0 ,0);
        
        //获取订单id
        $data['dinner_id'] = $dinner_id = array_column($list, 'id');
       
        //获取预订时间(订单id指向预订时间)
        $date = array_column($list, 'solar_time', 'id');
        
        //获取所有场馆名字和封面图
        $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
        $data['venue_name'] = $venue_name = array_column($venue_list, 'name', 'id');
        $data['venue_img'] = array_column($venue_list, 'cover_img', 'id');
        
        //获取宴会厅
        if($dinner_id){
            //获取宴会场馆id和订单id
            $query['in'] = array('dinner_id'=>$dinner_id);
            $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', array_merge($query, array('venue_id!='=>0)));
           
            //组合数组 把场馆名称和预约时间组合
            foreach($lists as $k=>$v){
                $lists[$k]['venue_name'] = $venue_name[$v['venue_id']];
                $lists[$k]['solar_time'] = $date[$v['dinner_id']];
            }
            
            //提取场馆id(t_dinner_venue表中搜索出符合条件的场馆id)
            $day_venue_id = array_column($lists, 'venue_id');
            
            //定义一个$a数组把lists数组变成键值是venue_id
            $a= array();
            foreach ($lists as $k=>$v){
                $a[$v['venue_id']][] = $v;
            }
            //删除venue_id=0的数据
            foreach ($a as $k=>$v){
                if(!$k){
                    unset($a[$k]);
                }
            }
            
            foreach ($a as $k => $v){
                $a[$k] = array_column($v, 'solar_time');
            }
            $rest_date = array();
            $new_rest = array();
            if(!$post_day){
                //这个月有订单的场馆 获取这些场馆没有被预定的日期
                foreach ($a as $k => $v){
                    for ($i = 1; $i <= $days; $i++){
                        $m = $month;
                        $d = $i < 10 ? '0'.$i : $i;
                        if(!in_array($year.'-'.$m.'-'.$d, $v)){
                            $rest_date[$k][] = array('solar_time'=>$year.'-'.$m.'-'.$d);
                        }

                    }
                }
                //获取这个月没有订单的场馆 显然这些场馆该月是一天都没被预定的
                foreach ($venue_list as $k=>$v){
                    if(!isset($a[$v['id']]) || !$a[$v['id']]){
                        for ($i = 1; $i <= $days; $i++){
                            $m = $month;
                            $d = $i < 10 ? '0'.$i : $i;
                            $new_rest[$v['id']][] = array('solar_time'=>$year.'-'.$m.'-'.$d);
                        }
                    }
                }
                
                //把有订单的场馆和没有订单的场馆预定情况合并
                foreach ($new_rest as $k=>$v){
                    $rest_date[$k] = $v;
                }
                
                $data['list'] = $rest_date;
                
                //预留数据和空当数据组合
                if($reserve_time){
                    foreach ($data['list'] as $k=>$v){
                        foreach ($reserve_time as $key=>$val){
                            if($k == $key){
                                $data['list'][$k] = array_merge($v, $val);
                            }
                        }
                    }
                    
                    //排序
                    foreach ($data['list'] as $k=>$v){
                        usort($data['list'][$k], function($a, $b) {
                            $al = $a['solar_time'];
                            $bl = $b['solar_time'];
                            if ($al == $bl)
                                return 0;
                            return ($al > $bl) ? 1 : -1;
                        });
                    }
                    
                }
                
                
            }else{
                //天数存在
                foreach($venue_name as $k=>$v){
                    if(!in_array($k, $day_venue_id)){
                        $rest_date[$k][] = array('solar_time'=>$time);
                    }
                }
                foreach ($reserve_time as $key=>$val){
                    $rest_date[$key] = $val;
                }

                $data['list'] = $rest_date;
            }
            //某一天所有场馆订满了则不显示
            if(!$rest_date){
                if($reserve_time){
                    $data['list'] = $reserve_time;
                }
                else{
                    $data['full'] = 1;
                }
            }
            
        }else{
            if($post_day){
                foreach($venue_name as $k=>$v){
                    $rest_date[$k][] = array('solar_time'=>$time);
                }
                $data['list'] = $rest_date;
            }else{
                $data['list'] = array();
            }
            
        }
        
        $data['days'] = $days;
        $data['post_day'] = $post_day;
        
        $this->load->view('venue/blank', $data);
    }
    
    
    public function reserve($time){
        $data = $this->data;
        
        //获取年月
        $data['year'] = $year = date('Y', strtotime($time));
        $data['month'] = $month = date('m', strtotime($time));
        $this->load->helper('date');
        // 获取天数
        $days = days_in_month($month, $year);
        //判断是否精确到日搜索
        $post_day = substr($time,8,2) == true ? substr($time,8,2) : '0';

        if(!$post_day){
            $time_begin = $time.'-01';
            $time_end = $time.'-'.$days;
            $where['solar_time>='] = $time_begin;
            $where['solar_time<='] = $time_end;
        }else{
            $where['solar_time'] = $time;
        }
        //默认筛选条件
        $where['is_del'] = 0;
        $where['contract_type'] = 1;
        $order_by['solar_time'] = 'asc';
        
        //获取订单id和预订时间
        $list = $this->Mdinner->get_lists('id,solar_time', $where, $order_by ,0 ,0);

        //获取订单id
        $data['dinner_id'] = $dinner_id = array_column($list, 'id');
     
        //获取预订时间(订单id指向预订时间)
        $date = array_column($list, 'solar_time', 'id');
        
        //获取所有场馆名字和封面图
        $venue_list = $this->Mvenue->get_lists('id, name, cover_img', array('is_del'=>0));
        $data['venue_name'] = $venue_name = array_column($venue_list, 'name', 'id');
        $data['venue_img'] = array_column($venue_list, 'cover_img', 'id');
        
        //获取宴会厅
        if($dinner_id){
            //获取宴会场馆id和订单id
            $query['in'] = array('dinner_id'=>$dinner_id);
            $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
            
            //组合数组 把场馆名称和预约时间组合
            foreach($lists as $k=>$v){
                $lists[$k]['venue_name'] = $venue_name[$v['venue_id']];
                $lists[$k]['solar_time'] = $date[$v['dinner_id']];
            }
            
            //定义一个$a数组把lists数组变成键值是venue_id
            $a= array();
            foreach ($lists as $k=>$v){
                $a[$v['venue_id']][] = $v;
            }
            
            foreach ($a as $k=>$v){
                if(!$k){
                    unset($a[$k]);
                }
            }
            $data['list'] = $a;
        
        }

        $data['days'] = $days;
        $data['post_day'] = $post_day;
        
        return  isset($data['list']) && $data['list'] ? $data['list']: 0;
        
        
        $this->load->view('venue/reserve', $data);
    }
    
    
    public function calendar(){
        $this->load->view('common/calendar');
    }
    
}
