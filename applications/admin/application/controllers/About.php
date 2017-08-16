<?php 
    /**
    * 关于我们控制器
    * @author songchi@gz-zc.cn
    */
defined('BASEPATH') or exit('No direct script access allowed');
class About extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
               'Model_about_us' => 'Maboutus',
               'Model_admins' => 'Madmins',
        ]);
    }
    
    
    /**
     * 首页
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $query['id>'] = 0;
        $list_data = $this->Maboutus->get_one('*', $query);
        $id = $list_data['id'];
        $list = $this->input->post();
        if($list){
            unset($list['rich_text_img']);
            $list['create_time'] = date("Y-m-d H:i:s");
            $list['create_user'] = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] :0;
            $list['update_time'] = date("Y-m-d H:i:s");
            $list['update_user'] = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] : 0;
            $where['id'] = $id;
            $add = $this->Maboutus->update_info($list, $where);
            if($add){
                $this->success("操作成功！！");
            }
        }
        //获取数据
        $where['id'] = $id;
        $info = $this->Maboutus->get_one("*", $where);
        $data['info'] = $info?:"";
        $this->load->view("about/edit", $data);
    }
    
    
    /**
     * 增加
     * @author songchi@gz-zc.cn
     */
    public function add(){
        $data = $this->data;
        $list = $this->input->post();
        if($list){
            unset($list['rich_text_img']);
            $list['create_time'] = date("Y-m-d H:i:s");
            $list['create_user'] = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] : 0;
            $list['update_time'] = date("Y-m-d H:i:s");
            $list['update_user'] = $this->session->userdata('USER')['id'] ? $this->session->userdata('USER')['id'] : 0;
            $add = $this->Maboutus->create($list);
            if($add){
                $this->success("操作成功！！");
            }
            
        }
        $data['list'] = $list;
        $this->load->view("about/add", $data);
    }
    
    
    /**
     * 删除
     * @author songchi@gz-zc.cn
     */
    public function del($id){
        $where['id'] = $id;
        $del = $this->Maboutus->delete($where);
        if($del){
           $this->success("操作成功！！");
        }
    }
    
    
    /**
     * 获取位置经纬度
     * @author songchi@gz-zc.cn
     */
    public function get_Map(){
        $map = $this->input->post('map');
        $json = file_get_contents("http://api.map.baidu.com/geocoder/v2/?address=".$map."&output=json&ak=rSGb43yGs0giA1ubvBGo3vCeYYlpDL4D");
        $infolist=json_decode($json);
        $points=array('errorno'=>'1');
        if(isset($infolist->result->location) && !empty($infolist->result->location)){
            $points=array(
                            'lng'=>round($infolist->result->location->lng,5),
                            'lat'=>round($infolist->result->location->lat,5),
                            'errorno'=>'0'
            );
        }
        $this->return_json($points);
    } 
    
}
