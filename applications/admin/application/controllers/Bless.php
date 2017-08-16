<?php 
    /**
    * 祝福语控制器
    * @author louhang@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class Bless extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_user' => 'Muser',
               'Model_venue' => 'Mvenue',
               'Model_dinner' => 'Mdinner',
               'Model_bless' => 'Mbless',
               'Model_dinner_venue' => 'Mdinner_venue'
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
        
    }

    /**
     * 首页
     * @author louhang@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        
        $page =  intval(trim($this->input->get("per_page",true))) ?  :1;
        $size = $this->pageconfig['per_page'];
        $order_by = array('zan_count' => 'desc');
        
        $data['venus'] = $this->Mvenue->get_lists('id, name');
        $venus = array_column($data['venus'], 'name', 'id');
        
        //按场馆查询祝福语
        $where = array();
        $venue_id = $this->input->get_post('venue_id');
        if($venue_id){
            $where['venue_id'] = $venue_id;
        }else{
            $where['venue_id'] = isset($data['venus'][0]['id']) ? $data['venus'][0]['id'] : 1; //默认显示该场馆的祝福语
        }
        //按日期查询祝福语
        $time = $this->input->get_post('time');
        if(!$time){
            $time = date('Y-m-d');
        }
        //用于分页显示时保留查询参数
        $data['venue_id'] = $venue_id;
        $data['time'] = $time;
        
        //先拿到所有在 $venue_id 下举办婚礼的 dinner_id
        $dinners = $this->Mdinner_venue->get_lists('dinner_id', array('venue_id' => $venue_id));
        $dinners = array_column($dinners, 'dinner_id');
        
        if(!$dinners){
            $dinners = '';
        }
        $dinner = $this->Mdinner->get_one('id', array('in' => array('id' => $dinners), 'solar_time' => $time, 'is_del' => 0));
        
        if($dinner){
            $data_count = $this->Mbless->count(array('dinner_id' => $dinner['id']));
            $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $dinner['id']), $order_by, $size, ($page-1)*$size);
            $user = array_column($data['bless'], 'user_id');
            $user = $this->Muser->get_lists('id, nickname, mobile_phone, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
            $user = array_column($user, null, 'id');
            foreach($data['bless'] as $key => $value){
                $data['bless'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
                $data['bless'][$key]['mobile_phone'] = isset($user[$value['user_id']]['mobile_phone']) ? $user[$value['user_id']]['mobile_phone'] : '未填写';
                $data['bless'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : '';
            }
           
        }else{
            $data_count = 0;
            //该日期下该场馆没有被预定，相应也没有祝福数据
        }
        if(! empty($data['bless'])){
            $this->pageconfig['base_url'] = "/bless/index?venue_id=".$venue_id."&time=".$time;
            $this->pageconfig['total_rows'] = $data_count;
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        }
        $data['page'] = $page;
        $data['data_count'] = $data_count;
        
        $this->load->view("bless/index", $data);
    }

    
    
    public function del($id = '0'){
        $id = intval($id);
        $del_status = $this->Mbless->get_one('is_del', array('id'=>$id))['is_del'];
    
        $data['is_del'] = $del_status == 1 ? 0 : 1;
        $where['id'] = $id;
        $update = $this->Mbless->update_info($data, $where);
        if($update){
            $this->success('操作成功');
        }else{
            $this->error('操作失败', '/bless');
        }
    }
    
    /**
     * 脏话管理
     * @author louhang@gz-zc.cn
     */
    public function dirty_word(){
        $data = $this->data;
        if (IS_POST) {
            $post_data = $this->input->post();
            $post_data['dirty_word'] = str_replace('，', ',', $post_data['dirty_word']);
            $post_data['dirty_word'] = $post_data['dirty_word'];
            $fp = fopen(BASEPATH.'../shared/config/'.ENVIRONMENT.'/dirty_dict.txt', "w");
            fwrite($fp, $post_data['dirty_word']);
            fclose($fp);
            if($fp){
                //txt 文件转换为 bin
                $this->load->file(BASEPATH.'../shared/libraries/SimpleDict.php');
                SimpleDict::make(BASEPATH.'../shared/config/'.ENVIRONMENT.'/dirty_dict.txt', BASEPATH.'../shared/config/'.ENVIRONMENT.'/dirty_dict.bin');
                $this->success('操作成功');
            }else{
                $this->error('操作失败');
            }
        }
        
        
        $content = file_get_contents(BASEPATH.'../shared/config/'.ENVIRONMENT.'/dirty_dict.txt');
        $data['dirty_word'] = $content;
        $this->load->view("bless/edit", $data);

    }
    
}

