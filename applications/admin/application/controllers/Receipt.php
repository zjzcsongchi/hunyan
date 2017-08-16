<?php 
/**
* 执行单管理
* @author louhang@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Receipt extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->Model([
            'Model_admins' => 'Madmins',
            'Model_admins_group' => 'Madmins_group',
            'Model_milan_execute' => 'Mmilan_execute',
            'Model_staff_schedule' => 'Mstaff_schedule',
            'Model_venue' => 'Mvenue',
            'Model_menu' => 'Mmenu',
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
        
        $this->data['status'] = C('milan_schedule_status');
        $this->data['examination_status'] = C('examination_status');
    }

    #主页面
    public function index(){
        $data = $this->data;
        $data['title'] = ['米兰管理','执行单管理'];
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('create_time' => 'desc');
        $where = [];
        $query_data = [];
        //筛选条件
        $venue_id = trim($this->input->get('venue_id'));
        $data['venue_id'] = '';
        if($venue_id){
            $menu_ids = $this->Mmenu->get_lists('id', array('venue_id' => $venue_id));
            $menu_ids = $menu_ids ? array_column($menu_ids, 'id') : [0];
            $where['in'] = array('menu_id' => $menu_ids);

            $query_data['venue_id'] = $data['venue_id'] = $venue_id;
        }
        
        $group_id = trim($this->input->get('group_id'));
        $data['group_id'] = '';
        if($group_id){
            $where['staff_type_id'] = $group_id;
            $query_data['group_id'] = $data['group_id'] = $group_id;
        }
        
        $fullname = trim($this->input->get('fullname'));
        if(!empty($fullname)){
            $query_data['fullname'] = $data['fullname'] = $fullname;
            
            $staffs = $this->Madmins->get_lists('id ,fullname', array('like' => array('fullname' => $fullname)));
            
            $staffs = $staffs ? array_column($staffs, 'id') : '';

            $where['in'] = array_merge(isset($where['in']) ? $where['in'] : [], array('staff_id' => $staffs));
        }
        
        //宴会时间搜索
        $create_time = trim($this->input->get('create_time'));
        if(!empty($create_time)){
            $time_menu_id = $this->Mmenu->get_lists('id', array('solar_time'=>$create_time));
           
            $time_menu_id = array_column($time_menu_id, 'id'); 
            
            if (isset($where['in']['menu_id']) && !empty($where['in']['menu_id'])) {
                
                $time_menu_id = array_intersect($where['in']['menu_id'], $time_menu_id);
                
            }
            
            $where['in']['menu_id'] = $time_menu_id ?: '';

            $query_data['create_time'] = $data['create_time'] = $create_time;
        }
        
        $where['is_del'] = 0;
        $list = $this->Mmilan_execute->get_lists('id, menu_id, staff_id,staff_type_id, create_time, money, status, examination_status', $where, $order_by, $size, ($page-1)*$size);
        
        
        //获取新郎新娘
        $menu_id = array_column($list, 'menu_id');
        if($menu_id){
            $menu = $this->Mmenu->get_lists('id, roles_main, roles_wife, solar_time', array('in'=>array('id'=>$menu_id)));
            $menu_name = array();
            foreach ($menu as $k=>$v){
                $menu_name[$v['id']] = $v;
            }
            $data['menu_name'] = $menu_name;
        }
       
        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        //获取职员姓名
        $staff_ids = $list ? array_column($list, 'staff_id') : '';
        $staffs = $this->Madmins->get_lists('id, group_id, fullname, tel', array('in' => array('id' => $staff_ids)));
        $staffs = array_column($staffs, null, 'id');
        
        //获取职员类型
        $staff_type_ids = $list ? array_column($list, 'staff_type_id') : '';
        $staff_types = $this->Madmins_group->get_lists('id, name', array('in' => array('id' => $staff_type_ids)));
        $staff_types = array_column($staff_types, 'name', 'id');
        
        //获取执行场馆
        $menu_ids = $list ? array_column($list, 'menu_id') : '';
        $venue_ids = $this->Mmenu->get_lists('id, venue_id', array('in' => array('id' => $menu_ids)));
        $menu_to_venue = [];
        foreach ($venue_ids as $k => $v){
            $menu_to_venue[$v['id']] = isset($venue[$v['venue_id']]) ? $venue[$v['venue_id']] : '';
        }
        
        $status = array_column(C('milan_schedule_status'), 'color_name', 'status');
        $examination_status = array_column(C('examination_status'), 'color_name', 'id');
        foreach ($list as $k => $v){
            $list[$k]['fullname'] = isset($staffs[$v['staff_id']]) ? $staffs[$v['staff_id']]['fullname'] : '';
            $list[$k]['tel'] = isset($staffs[$v['staff_id']]) ? $staffs[$v['staff_id']]['tel'] : '';
            $list[$k]['staff_type'] = isset($staff_types[$v['staff_type_id']]) ? $staff_types[$v['staff_type_id']] : '';
            $list[$k]['venue'] = $menu_to_venue[$v['menu_id']] ;
            $list[$k]['status'] = $status[$v['status']];
            $list[$k]['examination_status'] = $examination_status[$v['examination_status']];
        }
        if($list){
            $data['list'] = $list;
            $data_count = $this->Mmilan_execute->count($where);
            $data['count'] = $data_count;
            $this->pageconfig['base_url'] = "/Receipt/index?".http_build_query($query_data);
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        
        $data['query_data'] = http_build_query($query_data);
        
        $this->load->view("receipt/index", $data);
    }
    
    /**
     * 导出数据 EXCEL
     * @author chaokai@gz-zc.cn
     *
     */
    public function out_excel(){
        $data = $this->data;
        
        $order_by = array('create_time' => 'desc');
        $where = ['is_del' => 0];
        //筛选条件
        $venue_id = $this->input->get('venue_id');
        if($venue_id){
            $menu_ids = $this->Mmenu->get_lists('id', array('venue_id' => $venue_id));
            $menu_ids = $menu_ids ? array_column($menu_ids, 'id') : '';
            $where['in'] = array('menu_id' => $menu_ids);
        }
        
        $group_id = $this->input->get('group_id');
        if($group_id){
            $where['staff_type_id'] = $group_id;
        }
        
        $fullname = trim($this->input->get('fullname'));
        if(!empty($fullname)){
            $staffs = $this->Madmins->get_lists('id ,fullname', array('like' => array('fullname' => $fullname)));
        
            $staffs = $staffs ? array_column($staffs, 'id') : '';
        
            $where['in'] = array_merge(isset($where['in']) ? $where['in'] : [], array('staff_id' => $staffs));
        }
        
        $create_time = $this->input->get('create_time');
        if(!empty($create_time)){
            $where['create_time'] = $create_time;
        }
        
        $list = $this->Mmilan_execute->get_lists('id, menu_id, staff_id,staff_type_id, create_time, money, status, examination_status', $where, $order_by);
        
        !$list && $this->error('暂无数据');
        
        //获取场馆
        $venue = $this->Mvenue->get_lists('id, name', array('is_del' => 0));
        $data['venue'] = $venue = $venue ? array_column($venue, 'name', 'id') : '';
        
        //获取职员姓名
        $staff_ids = $list ? array_column($list, 'staff_id') : '';
        $staffs = $this->Madmins->get_lists('id, group_id, fullname, tel', array('in' => array('id' => $staff_ids)));
        $staffs = array_column($staffs, null, 'id');
        
        //获取职员类型
        $staff_type_ids = $list ? array_column($list, 'staff_type_id') : '';
        $staff_types = $this->Madmins_group->get_lists('id, name', array('in' => array('id' => $staff_type_ids)));
        $staff_types = array_column($staff_types, 'name', 'id');
        
        //获取执行场馆
        $menu_ids = $list ? array_column($list, 'menu_id') : '';
        $venue_ids = $this->Mmenu->get_lists('id, venue_id', array('in' => array('id' => $menu_ids)));
        $menu_to_venue = [];
        foreach ($venue_ids as $k => $v){
            $menu_to_venue[$v['id']] = isset($venue[$v['venue_id']]) ? $venue[$v['venue_id']] : '';
        }
        
        $status = array_column(C('milan_schedule_status'), 'name', 'status');
        $examination_status = array_column(C('examination_status'), 'name', 'id');
        foreach ($list as $k => $v){
            $list[$k]['number'] = $k + 1 ;
            $list[$k]['fullname'] = isset($staffs[$v['staff_id']]) ? $staffs[$v['staff_id']]['fullname'] : '';
            $list[$k]['tel'] = isset($staffs[$v['staff_id']]) ? $staffs[$v['staff_id']]['tel'] : '';
            $list[$k]['staff_type'] = isset($staff_types[$v['staff_type_id']]) ? $staff_types[$v['staff_type_id']] : '';
            $list[$k]['venue'] = $menu_to_venue[$v['menu_id']] ;
            $list[$k]['status'] = $status[$v['status']];
            $list[$k]['examination_status'] = $examination_status[$v['examination_status']];
        }

        //使用phpexcel
        $this->load->library('PHPExcel');
        $excel_config = C('excel_config');
    
        //表头
        $i = 0;
        foreach($excel_config as $k => $v){
            $cell = PHPExcel_Cell::stringFromColumnIndex($i).'1';
            $this->phpexcel->setActiveSheetIndex(0)->setCellValue($cell, $v);
            
            $this->phpexcel->getActiveSheet(0)->getStyle($cell)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $i++;
        }
   
        //记录内容
        $h = 2;
        foreach ($list as $k => $v){
            $j = 0;
            foreach($excel_config as $key => $value){
                $cell = PHPExcel_Cell::stringFromColumnIndex($j++).$h;
                $this->phpexcel->getActiveSheet(0)->setCellValue($cell, $v[$key].' ');
                
                if($key == 'status' || $key == 'examination_status'){
                    if($v[$key] != '已确认' && $v[$key] != '审核通过'){
                        $this->phpexcel->getActiveSheet(0)->getStyle($cell)->getFont()->getColor()->setARGB('FF993300');
                    }else{
                        $this->phpexcel->getActiveSheet(0)->getStyle($cell)->getFont()->getColor()->setARGB('8900800');
                    }
                }
            }
            $h++;
        }
        $this->phpexcel->setActiveSheetIndex(0);
        $filename = 'ZhiXingDan'.date('Y-m-d');
        // 输出
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename.'.xls');
        header('Cache-Control: max-age=0');
    
        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel5');
        $objWriter->save('php://output');
    }
    
    
    /**
     * 执行单审核
     * @author louhang@gz-zc.cn
     *
     */
    public function examination(){
        if($this->input->is_ajax_request()){
            if($this->data['pur_code'] == 1){
                $this->return_failed('抱歉，您没有此操作权限!');
            }
            $receipt_id = (int)$this->input->post('id');
            $examination_status = (int)$this->input->post('examination_status');
            $examination_reson = $this->input->post('examination_reson');

            $res = $this->Mmilan_execute->update_info(array('examination_status' => $examination_status, 'examination_reson' => $examination_reson), array('id' => $receipt_id));
            if($res){
                
                //发送通知短信
                $this->send_message_for_examination($receipt_id);
                $this->return_success('', '操作成功 :)');
                
            }else{
                $this->return_failed('操作失败!');
            }
        } 
    }
    
    /**
     * 执行单审核短信发送
     * @author louhang@gz-zc.cn
     */
    public function send_message_for_examination($receipt_id){
    
        //获取工作人员id
        $receipt = $this->Mmilan_execute->get_one('staff_id,menu_id, examination_status', array('id'=>$receipt_id));
        if($receipt){
            $staff = $this->Madmins->get_one('id, fullname, tel', array('id' => $receipt['staff_id']));
        }
    
        //获取婚宴日期，地点
        $venues = $this->Mvenue->get_lists('*');
        $venues = array_column($venues, 'name', 'id');
        $venue = $this->Mmenu->get_one('dinner_id, venue_id, solar_time', array('id' => $receipt['menu_id'], 'is_del' => 0));
        
        if($venue){
            $time = $venue['solar_time'];
            $venue = $venues[$venue['venue_id']];
        }else{
            return false;
        }

        //发送短信
        if($staff){
            //send_msg_huaxing($staff['tel'], "您在 {$venue} 的执行任务已审核，请登录后查看详情 http://rrd.me/bgcSS");
            send_msg($staff['tel'], 'receipt_examined_remind', ['venue' => $venue]);
        }
    
    }
    
    /**
     * 删除执行单
     * @author chaokai@g-zc.cn
     */
    public function del(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');
        
        $this->Mmilan_execute->update_info(array('is_del' => 1), array('id' => $id));
        
        $this->return_success();
    }
    
}
