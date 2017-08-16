<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Record extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_user_dinner' => 'Muser_dinner',
                'Model_dinner' => 'Mdinner',
                'Model_record' => 'Mrecord'
        ]);
    }
    
    public function index(){
        $data = $this->data;
        if(IS_POST){
            $post = $this->input->post();
            //如果是保存
            if(!isset($post['record_id']) || empty($post['record_id'])){
                if($this->check_record()){
                    $this->return_json(['code'=> 0, 'msg' => '您已经添加过婚礼档案']);
                }
                $this->to_save($post);
            }else{
                //更新婚礼档案
                $this->to_update($post);
            }
        }else{
            //判断是否已经存在婚礼档案
            $record = $this->check_record();
            if($record){
                $data['record'] = $record;
                $data['record']['info'] = (array) json_decode($record['info']);
            }
            //检查当前会员是否有婚宴
            $flag = $this->check_dinner();
            if($flag){
                $data['dinner_info'] = $flag;
            }
            //加载微信jssdk
            $param = array(
                  'app_id' => C('wechat_app.app_id.value'),
                  'app_secret' => C('wechat_app.app_secret.value'),
                  'cache_dir' => APPPATH.'cache/'
             );
             $this->load->library('weixinjssdk', $param);
                
             $jssdk_info = $this->weixinjssdk->getSignPackage();
             $jssdk_info['jsApiList'] = ['onMenuShareTimeline', 'onMenuShareAppMessage'];
             $jssdk_info['debug'] = false;
            $data['jssdk'] = json_encode($jssdk_info);

            $this->load->view('record/index', $data);
        }
    }
    
    /**
     * 保存婚礼档案
     * @param 提交的数据 $post
     * @return bool
     */
    private function to_save($post){
        //提取dinner_id,husband,wife
        $data = $this->data;
        $add = [];
        $add['dinner_id'] = (int) $post['dinner_id'];
        unset($post['dinner_id']);
        $add['husband'] = trim($post['husband']);
        if(!$add['husband']){
            $this->return_json(['code'=> 0, 'msg' => '新郎姓名不能为空']);
        }
        unset($post['husband']);
        $add['wife'] = trim($post['wife']);
        if(!$add['wife']){
            $this->return_json(['code'=> 0, 'msg' => '新娘姓名不能为空']);
        }
        unset($post['wife']);
        if(empty($post)){
            $post = '';
        }
        $add['info'] = json_encode($post);
        $add['create_time'] = $add['update_time'] = date('Y-m-d H:i:s');
        $add['user_id'] = $data['user_info']['id'];
        $res = $this->Mrecord->create($add);
        if(!$res){
            $this->return_json(['code'=> 0, 'msg' => '操作失败，请重试！']);
        }
        if(!$this->check_dinner()){
            $this->return_json(['code'=> 1, 'msg' => '您目前没有婚宴,婚礼档案添加成功']);
        }
        $this->return_json(['code'=> 1, 'msg' => '添加成功']);
    }
    
    /**
     * 更新婚礼档案
     * @param 提交的数据 $post
     * @return bool
     */
    private function to_update($post){
        //提取dinner_id,husband,wife
        $add = [];
        $add['dinner_id'] = (int) $post['dinner_id'];
        unset($post['dinner_id']);
        $add['husband'] = trim($post['husband']);
        if(!$add['husband']){
            $this->return_json(['code'=> 0, 'msg' => '新郎姓名不能为空']);
        }
        unset($post['husband']);
        $add['wife'] = trim($post['wife']);
        if(!$add['wife']){
            $this->return_json(['code'=> 0, 'msg' => '新娘姓名不能为空']);
        }
        unset($post['wife']);
        if(empty($post)){
            $post = '';
        }
        $id = (int) $post['record_id'];
        unset($post['record_id']);
        $add['info'] = json_encode($post);
        $add['update_time'] = date('Y-m-d H:i:s');
        $res = $this->Mrecord->update_info($add, ['id' => $id]);
        if(!$res){
            $this->return_json(['code'=> 0, 'msg' => '操作失败，请重试！']);
        }
        $this->return_json(['code'=> 1, 'msg' => '更新成功']);
    }
    
    /**
     * 判断是已经存在婚礼档案
     * @return record or false;
     */
    private function check_record(){
        $data = $this->data;
        return $this->Mrecord->get_one('*', ['user_id' => $data['user_info']['id'], 'is_del' => 0]);
    }
    
    /**
     * 判断当前登陆会员是否存在宴会
     * @return dinner or false;
     */
    private function check_dinner(){
        $data = $this->data;
        $info = $this->Muser_dinner->get_one('dinner_id', ['user_id' => $data['user_info']['id']]);
        if(!$info){
            return false;
        }
        //根据dinner_id查询宴会信息；如果不是婚宴，返回false
        $info = $this->Mdinner->get_one('id,roles_main,roles_wife,m_cover_img', ['id'=> $info['dinner_id'], 'venue_type' => C('party.wedding.id'), 'is_del' => 0]);
        if(!$info){
            return false;
        }
        return $info;
    }
    
    public function detail(){
        $data = $this->data;
        $data['title'] = ['婚礼档案'];
        $id = (int) $this->input->get('id');
        if(!$id){
            show_404();exit;
        }
        //根据档案id查询基本信息
        $info = $this->Mrecord->get_one('*', ['id' => $id, 'is_del' => 0]);
        if(!$info){
            show_404();exit;
        }
        $data['info'] = $info;
        $data['info']['info'] = (array) json_decode($info['info']);
        //根据宴会id查询新人
        $data['roles'] = $this->Mdinner->get_one('id,roles_main,roles_wife', ['id'=> $info['dinner_id'], 'venue_type' => C('party.wedding.id'), 'is_del' => 0]);
        if(isset($data['info']['husband']) && $data['info']['husband']){
            $husband = $data['info']['husband'];
        }else{
            $husband = isset($data['roles']['roles_main']) && $data['roles']['roles_main'] ? $data['roles']['roles_main']:'';
        }
        
        if(isset($data['info']['wife']) && $data['info']['wife']){
            $wife = $data['info']['wife'];
        }else{
            $wife = isset($data['roles']['roles_wife']) && $data['roles']['roles_wife'] ? $data['roles']['roles_wife']:'';
        }
        
        $data['title'] = ['婚礼档案', $husband.'&'.$wife.'的婚礼档案'];
        $this->load->view('record/detail', $data);
    }
}