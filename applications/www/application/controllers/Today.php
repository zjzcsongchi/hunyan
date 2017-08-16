<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Today extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_manual' => 'Mmanual',
                'Model_dinner' => 'Mdinner',
                'Model_dinner_detail' => 'Mdinnerdetail',
                'Model_venue' => 'Mvenue',
                'Model_dish' => 'Mdish',
                'Model_news' => 'Mnews',
                'Model_user_dinner' => 'Muser_dinner',
                'Model_dinner_venue' => 'Mdinner_venue',
                'Model_dinner_article' => 'Mdinner_article',
                'Model_combo' => 'Mcombo',
                'Model_flower' => 'Mflowers',
                'Model_user'=>'Muser',
                'Model_admins'=>'Madmin',
                'Model_bless'=>'Mbless',
                'Model_vtour' => 'Mvtour',
                'Model_vtour_comment' => 'Mvtour_comment'
        ]);
        
    }
    
    /**
     * 首页
     */
    public function index(){
        $data = $this->data;
        $data['action'] = 'today';

        $where['is_del'] = 0;
        $where['solar_time'] = date('Y-m-d');
        
        $data['lists'] = $this->Mdinner->get_lists('*', $where);
        
        $type = C('party');
        $data['type'] = array_column($type, 'name', 'id');
        
        //获取宴会厅
        $dinner_id = array_column($data['lists'], 'id');
        if($dinner_id){
            $query['in'] = array('dinner_id'=>$dinner_id);
            $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
            $venue_lists = array_column($lists, 'venue_id');
            
            $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
            $venue_name = array_column($venue_name, 'name', 'id');
            
            foreach($lists as $k=>$v){
                $lists[$k]['venue_name'] = $venue_name[$v['venue_id']];
            }
            
            $venue = array();
            foreach($dinner_id as $k=>$v){
                foreach($lists as $key=>$val){
                    if($dinner_id[$k] == $val['dinner_id']){
                        $venue[$k]['name'][] = $val['venue_name'];
                        $venue[$k]['dinner_id'] = $val['dinner_id'];
                    }
                }
            }
            
            $data['venue'] = array_column($venue, 'name', 'dinner_id');

        }

        $this->load->view('today/index', $data);
    }
    
    public function detail(){
        $data = $this->data;
        $data['action'] = 'today';
        $data['id'] = $dinner_id = (int) $this->input->get('id', TRUE);
        if($dinner_id === 0){
            redirect(C('domain.base.url'));
        }
        
        $data['list'] = $this->Mdinner->get_one('*', array('id'=>$dinner_id));
        //优先读取相册图片
        if($data['list']['album']){
            $data['list']['cover_img'] = explode(';', $data['list']['album']);
        }else{
            if($data['list']['cover_img']){
                $data['list']['cover_img'] = explode(';', $data['list']['cover_img']);
            }else{
                $data['list']['cover_img'] = explode(';', $data['list']['m_cover_img']);
            }
        }
        //婚礼更拍组图
        if($data['list']['following_effect']){
            $data['list']['following_effect'] = explode(';', $data['list']['following_effect']);
        }
        //查找获取关联文章
        if($data['list']['id']){
            $res = $this->Mdinner_article->get_one('article_id', ['dinner_id' => $data['list']['id']]);
            if($res){
                //获取文章
                $fields = 'id,title,summary,cover_img,create_user,publish_time,read';
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
       
        //获取场馆视频
        $venue_id = $this->Mdinner_venue->get_lists('venue_id', array('dinner_id'=>$dinner_id));
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
        
        //获取大厅
        $venue_name = $this->Mvenue->get_lists('name, id', array('is_del'=>0));
        $venue_name = array_column($venue_name, 'name', 'id');
        $venue_id = $this->Mdinner_venue->get_lists('*', array('dinner_id'=>$dinner_id));
        foreach ($venue_id as $k=>$v){
            if($v['venue_id']){
                $venue_id[$k]['venue_name'] = $venue_name[$v['venue_id']];
            }
        }
       
        $venue = array();
        foreach ($venue_id as $k=>$v){
            if($v['venue_id']){
                $venue['venue_name'][] = $venue_name[$v['venue_id']];
            }
        }
        $data['venue_name'] = $venue;
       
        //获取套餐
        $menu = $this->Mdinnerdetail->get_one('menus_id, dinner_id', array('dinner_id'=>$dinner_id, 'is_del' => 0));
        $data['combo'] = $this->Mcombo->get_one('cover_img', array('id'=>$menu['menus_id']));
        //统计祝福数和鲜花数
        $data['count']['bless'] = $this->Mbless->count(['dinner_id' => $dinner_id, 'is_del' => 0]);
        $data['count']['flowers'] = $this->Mflowers->get_one(['sum(num) as num'], ['dinner_id' => $dinner_id, 'is_del' => 0]);

        
        //获取鲜花
        $data['flowers'] = $this->Mflowers->get_lists('id,dinner_id,user_id,sum(num) as num', array('dinner_id' => $dinner_id), ['num' => 'desc','create_time' => 'desc'], 5, 0, 'user_id');
        $user = array_column($data['flowers'], 'user_id');
        $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
        $user = array_column($user, null, 'id');
        foreach($data['flowers'] as $key => $value){
            $data['flowers'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
            $data['flowers'][$key]['mobile_phone'] = isset($user[$value['user_id']]['mobile_phone']) ? $user[$value['user_id']]['mobile_phone'] : '未填写';
            $data['flowers'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
        }
        
        //祝福排行
        $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $dinner_id, 'is_del' => 0), ['zan_count' => 'desc','create_time' => 'desc'], 5);
        $user = array_column($data['bless'], 'user_id');
        $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
        $user = array_column($user, null, 'id');
        foreach($data['bless'] as $key => $value){
            $data['bless'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
            $data['bless'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
        }

        //获取房间VR
        $venue_vr = $this->Mvtour->get_by_venue(array($venue_id[0]['venue_id']));
        if(!empty($venue_vr[$venue_id[0]['venue_id']])){
            $data['vr_info'] = $this->get_vr_info($venue_vr[$venue_id[0]['venue_id']]);
            //获取VR评论
            $comment_data = $this->Mvtour_comment->get_lists('*', array('vtour_id' => $venue_vr[$venue_id[0]['venue_id']]));
            $data['comment_data'] = json_encode($comment_data);
        }

        $this->load->view('today/detail',$data);
    }
    
    public function more_flower(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $next_page = intval($this->input->post('next_page'));
            $dinner_id = intval($this->input->post('dinner_id'));
            $data['flowers'] = $this->Mflowers->get_lists('id,dinner_id,user_id,sum(num) as num', array('dinner_id' => $dinner_id), ['num' => 'desc' ,'create_time' => 'desc'], 5, ($next_page-1)*5, 'user_id');
            $user = array_column($data['flowers'], 'user_id');
            $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
            $user = array_column($user, null, 'id');
            foreach($data['flowers'] as $key => $value){
                $data['flowers'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
                $data['flowers'][$key]['mobile_phone'] = isset($user[$value['user_id']]['mobile_phone']) ? $user[$value['user_id']]['mobile_phone'] : '未填写';
                $data['flowers'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
            }
            $this->return_success($data['flowers']);
          
        }
    }
    
    
    public function more_bless(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $next_page = intval($this->input->post('next_page'));
            $dinner_id = intval($this->input->post('dinner_id'));
            
            $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $dinner_id, 'is_del' => 0), ['zan_count' => 'desc','create_time' => 'desc'], 5, ($next_page-1)*5);
           
            $user = array_column($data['bless'], 'user_id');
            $user = $this->Muser->get_lists('id, nickname, head_img', array('in' => array('id' => !empty($user) ? $user : '')));
            $user = array_column($user, null, 'id');
            foreach($data['bless'] as $key => $value){
                $data['bless'][$key]['nickname'] = isset($user[$value['user_id']]['nickname']) ? $user[$value['user_id']]['nickname'] : '匿名';
                $data['bless'][$key]['head_img'] = isset($user[$value['user_id']]['head_img']) && !empty($user[$value['user_id']]['head_img']) ? get_img_url($user[$value['user_id']]['head_img']) : $data['domain']['static']['url'].'/wap/images/touxiang.png';
            }
            
            $this->return_success($data['bless']);
    
        }
    }
    
    public function news(){
      show_404();
    }

    /**
     * 获取VR信息
     */
    private function get_vr_info($id){
        $info = $this->Mvtour->get_one('id,logo,name,bgmusic,xml_string,json,scan_count,venue_id,zan', array('id' => intval($id)));
        //浏览数加一
        $this->Mvtour->update_info(array('incr' => ['scan_count' => 1]), array('id' => $id));

        $json = json_decode($info['json'], true);
        if(!empty($json['hotspot'])){
            foreach ($json['hotspot'] as $k => $v){
                foreach ($v['attr'] as $key => $value){
                    if($value['hotspot_type'] == 'voice'){
                        $json['hotspot'][$k]['attr'][$key]['music_url'] = get_img_url($value['music_url']);
                        $json['hotspot'][$k]['attr'][$key]['onclick'] = 'playsound('.$value['name'].','.get_img_url($value['music_url']).'); jscall($(".voice_btn").show();$(".voice_btn").attr("data-name", "'.$value['name'].'"));)';
                    }
        
                    if($value['hotspot_type'] == 'video'){
                        $videourl = get_video_url($value['videourl']);
                        $posterurl = !empty($value['posterurl']) ? get_img_url($value['posterurl']) : '';
        
                        $json['hotspot'][$k]['attr'][$key]['videourl'] = $videourl;
                        $json['hotspot'][$k]['attr'][$key]['posterurl'] = $posterurl;
                        $json['hotspot'][$k]['attr'][$key]['url.html5'] = $this->data['domain']['static']['url'].'/krpano/plugins/videoplayer.js';
                          $json['hotspot'][$k]['attr'][$key]['url.flash'] = $this->data['domain']['static']['url'].'/krpano/plugins/videoplayer.swf';
        
                    }
                }
            }
        
        }else{
            $json['hotspot'] = [];
        }
        $info['json'] = json_encode($json);
        return $info;
    }
}

