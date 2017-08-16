<?php 
/**
* 场馆控制器
* @author yonghua@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class Venue extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
            'Model_venue' => 'Mvenue',
            'Model_customer'=> 'Mcustomer',
            'Model_user'=> 'Muser',
            'Model_theme' => 'Mtheme',
            'Model_dinner' => 'Mdinner',
            'Model_about_us' => 'Mabout_us',
            'Model_flower' => 'Mflower',
            'Model_bless' => 'Mbless',
            'Model_venue_images' => 'Mvenue_images',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_vtour' => 'Mvtour',
            'Model_vtour_comment' => 'Mvtour_comment'
        ]);
        //统计收到的祝福条数和鲜花数
        $this->data['bless_num'] = $this->Mbless->count(['is_del' => 0]);
        $this->data['flower_num'] = $this->Mflower->count(['is_del' => 0]);
    }
    
    /**
     * 场馆列表
     * @author songchi@gz-zc.cn
     */
    public function index(){
        $this->count();
        $data = $this->data;
        $data['action'] = 'venue';
        $field ='id,name,cover_img,venue_class_id,images';
        $list = $this->Mvenue->get_lists($field, ['is_del' => 0, 'is_recommend'=>1]);
        if($list){
            foreach ($list as $k => $v){
                $data['list'][$k] = $v;
                $data['list'][$k]['cover_img'] = get_img_url($v['cover_img']);
                $img_list = explode(',', $v['images']);
                foreach ($img_list as $kk => $vv){
                    $temp[] = get_img_url($vv);
                }
                $data['list'][$k]['images'] = $temp;
            }
        }
        
        $tmp = array();
        foreach ($list as $k=>$v){
            $tmp[$v['venue_class_id']][] = $v;
        }
        
        $data['lists'] = $tmp;

        //获取包房分类
        $venue_class = C('public.venue_type');
        $data['venue_class'] = array_column($venue_class, 'name', 'id');
        
        $data['about'] = $this->Mabout_us->get_one('index_vedio_url', array('id>'=>0));
        
        $this->load->view('venue/venue',$data);
    }
    
    /**
     * 场馆详情
     * @author louhang@gz-zc.cn
     */
    public function detail(){
        $data = $this->data;
        $data['title'] = '场馆详情';
        $data['action'] = 'venue';
        
        $time = date("Y-m-d");
        $id = (int) $this->input->get('id', TRUE);
        if($id === 0){
            redirect(C('domain.base.url'));
        }
        $field = 'id,name,introduce,cover_img,floor,height,area_size,fit_type,max_table,container,min_consume,max_consume,images,device,venue_video';
        $data['venue_info'] = $this->Mvenue->get_one($field, [
            'is_del' => 0,
            'id' => $id
        ]);
        
        //获取场馆相关图片:大厅，洗手间，化妆间……
        $images = $this->Mvenue_images->get_lists('*', array('is_del'=>0, 'venue_id'=>$id));
        $title = array_column($images, 'title');
        $data['title'] = $title;
        foreach ($images as $k=>$v){
            $images[$k]['img'] = explode(',', $v['images']);
        }
        $data['images'] = $images;
        
        //根据venue_id 查找在该场馆举办过的婚礼
        $vaild_dinner = $this->get_dinner_list($id);
        $data['dinners'] = $vaild_dinner;
        
        $vaild_dinner_ids = array_column($vaild_dinner, 'id');
        if(empty($vaild_dinner_ids)){
            $vaild_dinner_ids = '';
        }
        
        //鲜花礼物
        $data['flower'] = $this->get_flower_list($vaild_dinner_ids);
        
        //祝福语
        $data['bless'] = $this->get_bless_list($vaild_dinner_ids);
        
        //获取宴会类型
        $venue = C('party');
        $data['venue'] = array_column($venue, 'name', 'id');

        //设置默认选择宴会类型
        $data['wedding']= C('party.wedding.id');
        
        //获取贵宾印记数据
        $order_by['solar_time'] = 'desc';
        $dinner_info = $this->Mdinner->get_lists('id, m_cover_img, roles_main, roles_wife', array('is_show'=>0, 'is_del'=>0, 'solar_time<'=>date('Y-m-d'),'venue_type'=>C('party.wedding.id')), $order_by, 6);
        foreach ($dinner_info as $k=>$v){
            $img = $v['m_cover_img'];
            if($pos = strpos($img, ';')){
                $img = substr($img, 0, $pos);
            }
            $dinner_info[$k]['cover_img'] = $img; 
        }
        $data['wedding_photo'] = $dinner_info;

        //获取房间VR
        $venue_vr = $this->Mvtour->get_by_venue(array($id));
        if(!empty($venue_vr[$id])){
            $data['vr_info'] = $this->Mvtour->get_scan_info($venue_vr[$id]);
            $data['vr_info']['id'] = $venue_vr[$id];
            //获取VR评论
            $comment_data = $this->Mvtour_comment->get_lists('*', array('vtour_id' => $venue_vr[$id]));
            $data['comment_data'] = json_encode($comment_data);
        }
        $this->load->view('venue/detail', $data);
    }
    
    
    
/**
     * 场馆预约
     * @author songchi@gz-zc.cn
     */
    public function appoint(){
        $data = $this->data;
        if($this->input->is_ajax_request()){
            $post_data = $this->input->post();
            if(!$post_data['realname']){
                $list = array('status'=>-1, 'msg'=>"用户名不能为空");
                $this->return_json($list);
            }
            if(!$post_data['mobile_phone']){
                $list = array('status'=>-2, 'msg'=>"电话不能为空");
                $this->return_json($list);
            }
            
            if(!$post_data['time']){
                $list = array('status'=>-4, 'msg'=>"预约时间不能为空");
                $this->return_json($list);
            }

            if(!intval($post_data['menus_count'])){
                $list = array('status'=>-4, 'msg'=>"请填写预约桌数");
                $this->return_json($list);
            }
            
            if($post_data){
                $add_data['mobile_phone'] = intval($post_data['mobile_phone']);
                
//                 $is = $this->Muser->get_one('id', array('mobile_phone'=>$add_data['mobile_phone']));
                
                //没有登录
//                 if(!isset($this->data['user_info']['id']) && $is){
//                     $list = array('status'=>-7, 'msg'=>"您已经注册过本平台账号，请登录!");
//                     $this->return_json($list);
//                 }
                
                //一个用户手机号只能预定一次
                $is_today = $this->Mcustomer->get_one('id', array('mobile_phone'=>$add_data['mobile_phone'], 'dinner_type'=>$post_data['dinner_type'], 'dinner_time'=>$post_data['time']));
                if($is_today){
                    $list = array('status'=>-5, 'msg'=>"您已经预约过了");
                    $this->return_json($list);
                }
                //手机验证
                if(!preg_match(C('regular_expression.mobile'), $post_data['mobile_phone'])){
                    $list = array('status'=>-6, 'msg'=>"手机格式不正确");
                    $this->return_json($list);
                }
                
                $add_data['create_time'] = date('Y-m-d h:i:s', time());
                $add_data['update_time'] = date('Y-m-d h:i:s', time());
                $add_data['name'] = $post_data['realname'];
                $add_data['dinner_type'] = intval($post_data['dinner_type']);
                $add_data['remark'] = $post_data['address'];
                $add_data['dinner_time'] = $post_data['time'];
                $add_data['venue_id'] = intval($post_data['venue_id']);
                $add_data['menus_count'] = $post_data['menus_count'];
                $add_data['source'] = 2;
                $add_data['order_time'] = date('Y-m-d', time());
                //加密字符串设置 
                $str = md5($add_data['mobile_phone'].$add_data['venue_id'].$post_data['time']);
                if(isset($this->data['user_info']['id'])){
                    $add_data['user_id'] = $this->data['user_info']['id'];
                }

                
//                 if(isset($_SESSION['token_appoint'])){
//                     $list = array('status'=>-7, 'msg'=>"您最近已经预约过了");
//                     $this->return_json($list);
//                 }
                $add = $this->Mcustomer->create($add_data);
                $customer_id =  $this->db->insert_id();
                
                if(isset($customer_id) && $customer_id){
                    $user['mobile_phone'] = $add_data['mobile_phone'];
                    $user['realname'] = $post_data['realname'];
                    $user['address'] = $post_data['address'];
                    $user['create_time'] = date('Y-m-d h:i:s', time());
                    $user['customer_id'] = $customer_id;
                    $list = array('status'=>0, 'msg'=>"预约成功", 'data'=>$user);
                    
                    //token限制
                    $this->set_token_msg($str);
                    $this->return_json($list);
                }else{
                    $list = array('status'=>-3, 'msg'=>"失败");
                    $this->return_json($list);
                }
            }

        }
    }
    
    //给用户注册账号
//     public function email(){
//         $data = $this->data;
//         $mobile_phone = $this->input->get_post('mobile_phone');
//         $customer_id = $this->input->get_post('customer_id');
//         if(!isset($this->data['user_info']['id'])){
//         //没有注册的用户给他创建一个号码
//             $user['mobile_phone'] = intval($mobile_phone);
//             $is = $this->Muser->get_one('id', array('mobile_phone'=>$user['mobile_phone']));
//             if(!$is){
//                 $user['realname'] = $this->input->get_post('realname');
//                 $user['address'] = $this->input->get_post('address');
//                 $user['create_time'] = date('Y-m-d h:i:s', time());
//                 $code = get_code();
//                 $user['password'] = md5($code);
//                 $user_add = $this->Muser->create($user);
//                 $user_id = $this->db->insert_id();
//                 if($user_id){
//                     $update = $this->Mcustomer->update_info(array('user_id'=>$user_id), array('id'=>$customer_id));
//                     $msg = $user['mobile_phone'].'，'.'百年婚宴平台给您注册了惠民安居平台会员！您的用户名是:'.$user['mobile_phone'].'，初始密码是:'.$code.'，请妥善保存密码，点击http://t.cn/R5XgZR3登陆后修改密码。';
//                     send_msg($user['mobile_phone'], $msg);
//                 }
//             }
        
        
//         }
//     }
    
    
      public function email(){
          $data = $this->data;
          $venue = C('party');
          $venue = array_column($venue, 'name', 'id');
          $post_data = $this->input->get();
          if($post_data['venue_id']){
              $venue_name = $this->Mvenue->get_one('id, name', array('id'=>$post_data['venue_id']));
          }
          $mobile_phone = $this->input->get_post('mobile_phone');
          $msg = "亲爱的小主，您来了真好！ 世界上最幸福的事莫过于你喜欢我，我也喜欢你！您预约的场馆已经成功，稍后客户经理会与您联系。";
    //       if($mobile_phone){
    //           send_msg($mobile_phone, 'asdjasdjasdja');
    //       }
          
          if($this->check_token_msg($mobile_phone)){
              $this->return_failed('近期已经发送短信了');
          }
          
          $res = send_msg_huaxing($mobile_phone, $msg);
          if($res){
              $this->return_success('','发送成功');
          }else{
              $this->return_failed('发送失败');
          }
      }
    
    /**
     * 根据场馆id，获取在此场馆举办过的婚礼
     * @author louhang@gz-zc.cn
     */
    public function get_dinner_list($venue_id){
        //先获取在此场馆举办过的所有dinner_ids
        $where = array('venue_id' => $venue_id);
        $dinner_ids = $this->Mdinner_venue->get_lists('dinner_id', $where);
        if($dinner_ids){
            $dinner_ids = array_column($dinner_ids, 'dinner_id');
        }else{
            $dinner_ids = '';
        }
        
        //过滤，根据dinner_ids限制条件查找符合条件的宴会详情
        $fields = 'id,roles_main,roles_wife';
        $where = array(
            'is_show' => '0', 
            'is_del' => '0', 
            'in' => array('id' => $dinner_ids), 
            'solar_time<' => date('Y-m-d'), 
            'venue_type' => C('party.wedding.id')
        );
        $order_by['solar_time'] = 'desc';
        $limit = 20;
        $valid_dinner = $this->Mdinner->get_lists($fields, $where, $order_by, $limit);
        return $valid_dinner ? $valid_dinner : array();
    }
    

    /**
     * 根据user_id 获取用户信息后合并到原数组
     * @author louhang@gz-zc.cn
     */
    private function get_user_detail($data){
        $user_ids = array_column($data, 'user_id');
        $user_info = $this->Muser->get_lists('id, nickname, realname,head_img', array('in' => array('id' => !empty($user_ids) ? $user_ids : '')));
        $user_info = array_column($user_info, null, 'id');
    
        //合并用户的头像，昵称到 $data['bless']
        foreach ($data  as $k => $v){
            $name = '匿名';
            if(!empty($user_info[$v['user_id']]['realname'])){
                $name = $user_info[$v['user_id']]['realname'];
            }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                $name = $user_info[$v['user_id']]['nickname'];
            }
            $data[$k]['name'] = $name;
            $data[$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
        }
    
        return $data;
    }
    
    /**
     * 根据婚礼ids，获取婚礼的礼物(鲜花)排行
     * @author louhang@gz-zc.cn
     */
    public function get_flower_list($dinner_ids, $pagesize = 0){
        $field = 'dinner_id, user_id, sum(num) as num';
        $where = array('is_del' => 0, 'in' => array('dinner_id' => $dinner_ids));
        $order_by['dinner_id'] = 'desc';
        $order_by['num'] = 'desc';
        $group_by = 'dinner_id, user_id';
        $flower = $this->Mflower->get_lists($field, $where, $order_by, $pagesize, 0, $group_by);
        
        //获取送礼用户的信息
        $flower = $this->get_user_detail($flower);
        
        $temp_arr = array();
        foreach ($flower as $k => $v){
            if(!isset($temp_arr[$v['dinner_id']]) || count($temp_arr[$v['dinner_id']]) < 3){
                $temp_arr[$v['dinner_id']][] = $v;
            }
        }
        
        return $temp_arr;
    }
    
    /**
     * 根据婚礼ids，获取婚礼的祝福排行
     * @author louhang@gz-zc.cn
     */
    public function get_bless_list($dinner_ids){
        $field = 'dinner_id, user_id, content, zan_count';
        $where = array('is_del' => 0, 'in' => array('dinner_id' => $dinner_ids));
        $order_by['dinner_id'] = 'desc';
        $order_by['zan_count'] = 'desc';
        $bless = $this->Mbless->get_lists($field, $where, $order_by);
        
        //获取送礼用户的信息
        $bless = $this->get_user_detail($bless);
        
        $temp_arr = array();
        foreach ($bless as $k => $v){
            if(!isset($temp_arr[$v['dinner_id']]) || count($temp_arr[$v['dinner_id']]) < 3){
                $temp_arr[$v['dinner_id']][] = $v;
            }
        }
        
        return $temp_arr;
    
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