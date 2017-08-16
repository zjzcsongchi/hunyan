<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Record extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_user' => 'Muser',
                'Model_venue' => 'Mvenue',
                'Model_record' => 'Mrecord',
                'Model_dinner' => 'Mdinner',
                'Model_dinner_venue' => 'Mdinner_venue'
        ]);
    }
    
    /**
     * 婚礼档案列表
     */
    public function index(){
        $data = $this->data;
        $data['title'] = ['首页','婚礼档案'];
        $this->load->library('pagination');
        $pageconfig = C('page.config_log');
        $size = $pageconfig['per_page'];
        $page = (int)$this->input->get_post('per_page') ? : '1';
        $name = trim($this->input->get('name'));
        if(!empty($name)){
            $data['name'] = $name;
            //根据用户名查出用户id
            $user_where['is_del'] = 0;
            $user_where['or_like'] = [
                'realname' => $name,
                'nickname' => $name
            ];
            $user = $this->Muser->get_lists('id',$user_where);
            if($user){
                $user_ids = array_column($user, 'id');
                if($user_ids){
                    $where['in'] = [
                        'user_id' => $user_ids
                    ];
                }
                unset($user_ids);
            }
        }
        $where['is_del'] = 0; 
        $list = $this->Mrecord->get_lists("*", $where, ['create_time' => 'desc'], $size, $size*($page-1));
        if($list){
            $data['list'] =  $list;
            //感觉user_id查询用户姓名
            $user_ids = array_column($list, 'user_id');
            if(!empty($user_ids)){
                $user_list = $this->Muser->get_lists('id,nickname,realname', ['in' => ['id' => $user_ids], 'is_del' => 0]);
                if($user_list){
                    foreach ($list as $k => $v){
                        $data['list'][$k]['name'] = '';
                        foreach ($user_list as $key => $val){
                            if($v['user_id'] == $val['id']){
                                $data['list'][$k]['name'] = !empty($val['nickname']) ? $val['nickname'] : $val['realname'];
                            }
                        }
                    }
                }
            }
            //根据宴会id查询宴会时间以及场馆
            $dinner_ids = array_column($list,'dinner_id');
            //获取宴会列表信息
            if($dinner_ids){
                $dinner = $this->get_dinner_by_ids($dinner_ids);
                if($dinner && !empty($dinner)){
                    $data['dinner_venue'] = $dinner;
                }
            }
            
            $count = $this->Mrecord->count($where);
            $data['count'] = $count;
            if(count($list) >= $size){
                //构建分页
                $pageconfig['base_url'] = "/record/index";
                $pageconfig['total_rows'] = $count;
                $this->pagination->initialize($pageconfig);
                $data['pagestr'] = $this->pagination->create_links(); // 分页信息
            }
        }
        $this->load->view('record/index', $data);
    }
    
    public function detail(){
        $data = $this->data;
        $id = (int) $this->input->get('id');
        if(!$id){
            echo 'nodata';exit;
        }
        $data['id'] = $id;
        $record = $this->Mrecord->get_one('id,husband,wife,info', ['id' => $id, 'is_del' => 0]);
        if($record){
            $data['record'] = $record;
            $data['record']['info'] = (array) json_decode($record['info']);
            $this->load->view('record/ajax', $data);
        }else{
            echo 'nodata';exit;
        }
        
    }
    
    /**
     * @return $info array 宴会信息,场馆名称
     * @param unknown $ids
     */
    private function get_dinner_by_ids($ids){
        $info = [];
        $where = ['in' => ['id' => $ids, 'venue_type' => C('party.wedding.id'), 'is_del' => 0] ];
        $info['dinner'] = $this->Mdinner->get_lists('id,solar_time',$where);
        //宴会id查询所在的场馆id
        $venue = $this->Mdinner_venue->get_lists('dinner_id,venue_id', [ 'in' => ['dinner_id' => $ids]]);
        //合并dinner,venue
        if($venue){
            foreach ($info['dinner'] as $k => $v){
                foreach ($venue as $key => $val){
                    if($v['id'] == $val['dinner_id']){
                        $info['dinner'][$k]['venue_id'][] = $val['venue_id'];
                    }
                }
            }
        }
        //根据场馆id查询场馆名称
        $venue_ids = array_column($venue, 'venue_id');
        if($venue_ids){
            $info['venue_lists'] = $this->Mvenue->get_lists('id, name', [ 'in' => ['id' => $venue_ids]]);
        }
        return $info;
    }
    
    public function del(){
        $data = $this->data;
        if(!isset($data['userInfo']['id'])){
            $this->return_json(['code' => 0, 'msg' => '系统拒绝']);
        }
        $id = (int) $this->input->get('id');
        if(!$id){
            $this->return_json(['code' => 0, 'msg' => '缺少参数']);
        }
        $res = $this->Mrecord->update_info(['is_del' => 1], ['id' => $id]);
        if(!$res){
            $this->return_json(['code' => 0, 'msg' => '删除失败，请重试！']);
        }
        $this->return_json(['code' => 1, 'msg' => '操作成功！']);
    }
    
    
}


















