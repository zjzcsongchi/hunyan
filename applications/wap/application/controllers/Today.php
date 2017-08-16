<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Today extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_manual' => 'Mmanual',
                'Model_dinner' => 'Mdinner',
                'Model_flower' => 'Mflowers',
                'Model_dinner_detail' => 'Mdinnerdetail',
                'Model_venue' => 'Mvenue',
                'Model_dish' => 'Mdish',
                'Model_user_dinner' => 'Muser_dinner',
                'Model_dinner_venue'=>'Mdinner_venue',
                'Model_bless'=>'Mbless',
                'Model_admins'=>'Madmin',
                'Model_bless_zan' => 'Mbless_zan',
                'Model_combo'=>'Mcombo',
                        'Model_dinner_article' => 'Mdinner_article',
                        'Model_news' => 'Mnews'
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    
    public function is_login(){
        $data = $this->data;
        if(isset($data['user_info']['id'])){
            $user_info = $this->Muser->get_one('open_id', array('id'=>$data['user_info']['id']));
            if(isset($user_info['open_id']) && $user_info['open_id']){
                $this->return_success(array('status'=>0));
            }else{
                $this->return_success(array('status'=>-1));
            }
        }else{
            $this->return_success(array('status'=>-2));
        }
    }
    
    
    
    public function detail(){
        $data = $this->data;
        $id = intval($this->input->get('id'));
        if($id == 0){
            redirect($data['domain']['mobile']['url'].'/today');
        }
        $data['flag'] = 0;
        if($id == C('own_party.party.id')){
            $data['flag'] = 1;
        }
        $data['title'] = '宴会详情';
        $data['action'] = 'today';

        $data['id'] = $id = intval($this->input->get('id'));
        $dinner = $this->Mdinner->get_one('*', ['id' => $id, 'is_del' => 0]);
        //获取场馆视频
        $venue_id = $this->Mdinner_venue->get_lists('venue_id', array('dinner_id'=>$dinner['id']));
        $venue_id = array_column($venue_id, 'venue_id');
        if($venue_id){
            $video = $this->Mvenue->get_lists('venue_video, id, venue_class_id', array('in'=>array('id'=>$venue_id)));
            if($video){
                $new_video = array();
                foreach ($video as $k=>$v){
                    $new_video[$v['venue_class_id']][] = $v;
                } 
            }
            
            foreach ($new_video as $k=>$v){
                if($k == 1){
                    $flag = true;
                    break;
                }else{
                    $flag = false;
                }
            }
            if($flag == true){
                $data['video'] = $new_video[1][0];
            }else{
               $data['video'] = $video[0];
            }
            
        }
       
        
        //优先读取相册图片
        if($dinner['album']){
            $dinner['cover_img'] = explode(';', $dinner['album']);
        }else{
            if($dinner['m_cover_img']){
                $dinner['cover_img'] = explode(';', $dinner['m_cover_img']);
            }
            else if($dinner['cover_img']){
                $dinner['cover_img'] = explode(';', $dinner['cover_img']);
            }
        }
        
        if(!$dinner){
            redirect($data['domain']['mobile']['url'].'/today');
        }
        $data['dinner'] = $dinner;
        
        //查找宴会详情的封面图
        $ret = $this->Mdinnerdetail->get_one('menus_id', ['dinner_id' => $dinner['id'], 'is_del' => 0]);
        if($ret){
            $res = $this->Mcombo->get_one('cover_img', ['id' => $ret['menus_id']]);
            $data['dinner']['combo_img'] = $res['cover_img'];
        }
        //统计祝福数
        $data['count']['bless'] = $this->Mbless->count(['dinner_id' => $id, 'is_del' => 0]);
        $data['count']['flowers'] = $this->Mflowers->get_one(['sum(num) as num'], ['dinner_id' => $id, 'is_del' => 0]);
        $data['count']['red'] = $dinner['zan_count'];
        
        if($id){
            $query['in'] = array('dinner_id'=>$id);
            $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
            $venue_id = array_column($lists, 'venue_id');
            if($venue_id[0]){
                $venue = $this->Mvenue->get_one('*', array('id'=>$venue_id[0]));
                $data['venue'] = $venue;
            }
                        
            
        }
        //鲜花排行
        $data['flowers'] = $this->Mflowers->get_lists('id,dinner_id,user_id,sum(num) as num', array('dinner_id' => $dinner['id']), ['num' => 'desc', 'create_time' => 'desc'], 5, 0, 'user_id');
        $user = array_column($data['flowers'], 'user_id');
        $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
        $user = array_column($user, null, 'id');
        foreach($data['flowers'] as $key => $value){
            $data['flowers'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
            $data['flowers'][$key]['mobile_phone'] = isset($user[$value['user_id']]['mobile_phone']) ? $user[$value['user_id']]['mobile_phone'] : '未填写';
            $data['flowers'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
        }
        //祝福排行
        $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $id, 'is_del' => 0), ['zan_count' => 'desc', 'create_time' => 'desc'], 5);
        $user = array_column($data['bless'], 'user_id');
        $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
        $user = array_column($user, null, 'id');
        foreach($data['bless'] as $key => $value){
            $data['bless'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
            $data['bless'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
        }
        
        //婚礼更拍组图
        if($data['dinner']['following_effect']){
            $data['dinner']['following_effect'] = explode(';', $data['dinner']['following_effect']);
        }
        //查找获取关联文章
        if($data['dinner']['id']){
            $res = $this->Mdinner_article->get_one('article_id', ['dinner_id' => $data['dinner']['id']]);
            if($res){
                //获取文章
                $fields = 'id,title,summary,cover_img,create_user,publish_time,read,zan_number';
                $art = $this->Mnews->get_one($fields, ['id' => $res['article_id'], 'is_del' => 0]);
                if($art){
                    //获取发布者
                    $data['art'] = $art;
                    $user = $this->Madmin->get_one('name', ['id' => $art['create_user'], 'is_del' => 1]);
                    if($user){
                        $data['art']['create_user'] = $user['name'];
                    }else{
                        $data['art']['create_user'] = '';
                    }
                }
            }
        }

        $data['first_url'] = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('wechat_app.app_id.value');
        $data['first_url'] .= '&redirect_uri='.urlencode($this->data['domain']['mobile']['url'].'/passport/dump/');
        $data['tail_url'] = '&response_type=code&scope=snsapi_base#wechat_redirect';

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

        $this->load->view('today/new_detail', $data);
    }
    

    
    public function get_bless(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $page = (int) $this->input->post('page');
            $id = (int) $this->input->post('id');
            $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $id), ['zan_count' => 'desc', 'create_time' => 'desc'], 5, ($page-1)*5);
            if(!$data['bless']){
                $this->return_json(0);
            }
            $user = array_column($data['bless'], 'user_id');
            $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
            $user = array_column($user, null, 'id');
            foreach($data['bless'] as $key => $value){
                $data['bless'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
                $data['bless'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
            }
            $this->return_json($data['bless']);
        }
    }
    
    public function get_flowers(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $page = (int) $this->input->post('page');
            $id = (int) $this->input->post('id');
            $this->db->select('user_id,sum(num) as num');
            $this->db->where('dinner_id', $id);
            $this->db->order_by('num','desc');
            $this->db->order_by('create_time','desc');
            $this->db->group_by('user_id');
            $query = $this->db->get('t_flower', 5, ($page-1)*5);
            $list = $query->result_array();
            if(!isset($list[0])){
                $this->return_json(0);
            }
            $data['flowers'] = $list;
            $user = array_column($data['flowers'], 'user_id');
            $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
            $user = array_column($user, null, 'id');
            foreach($data['flowers'] as $key => $value){
                $data['flowers'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
                $data['flowers'][$key]['mobile_phone'] = isset($user[$value['user_id']]['mobile_phone']) ? $user[$value['user_id']]['mobile_phone'] : '未填写';
                $data['flowers'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
            }
            $this->return_json($data['flowers']);
        }
        echo 1;
    }
    
    /**
     * 祝福排行榜评论点赞
     * @author yonghua@gz-zc.cn
     */
        public function zan_bless(){
        if($this->input->is_ajax_request()){
            
            $data = $this->data;
            $bless_id = (int)$this->input->post('bless_id');
            $where = array('user_id' => $data['user_info']['id'], 'bless_id' =>$bless_id);
            if($this->Mbless_zan->get_one('id', $where)){
                $this->return_json('请勿重复操作');
            }
            
            $update = array('incr' => array('zan_count' => 1));
            $where = array('id' => $bless_id);
            $res = $this->Mbless->update_info($update, $where);
            if($res){
                $add_post = array();
                $add_post['user_id'] = $data['user_info']['id'];
                $add_post['bless_id'] = $bless_id;
                $add_post['create_time'] = date('Y-m-d H:i:s');
                $res = $this->Mbless_zan->create($add_post);
                if($res){
                    $this->return_json(1);
                }else{
                    $this->return_json('操作失败');
                }
            }else{
                $this->return_json('操作失败');
            }
        }
    }
    
}