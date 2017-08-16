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
            'Model_combo' => 'Mcombo',
            'Model_dish' => 'Mdish',
            'Model_customer'=> 'Mcustomer',
            'Model_user'=> 'Muser',
            'Model_theme' => 'Mtheme',
            'Model_customer_case' => 'Mcustomer_case',
            'Model_dinner_venue' => 'Mdinner_venue',
            'Model_dinner' => 'Mdinner',
            'Model_flower' => 'Mflower',
            'Model_bless' => 'Mbless',
            'Model_venue_images' => 'Mvenue_images',
                        'Model_vtour' => 'Mvtour',
            'Model_manual' => 'Mmanual'
        ]);
        
    }
    
    /**
     * 场馆列表
     * @author yonghua@gz-zc.cn
     */
    public function index(){
        $data = $this->data;
        $data['title'] = '婚宴场馆';
        $data['action'] = 'venue';
        
        $default_where['is_del'] = 0;
        $default_where['is_recommend'] = 1;
        $data['venue_class_id'] = $default_where['venue_class_id'] = C('public.venue_type.hall.id');
        $field ='id,name,cover_img,max_table,container,area_size,floor,height,fit_type,min_consume,images,device';
        $list = $this->Mvenue->get_lists($field, $default_where);
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
        
        //获取宴会类型
        $venue = C('party');
        $data['venue'] = array_column($venue, 'name', 'id');
        
        //设置默认选择宴会类型
        $data['wedding']= C('party.wedding.id');
        
        //获取包房分类
        $venue_class = C('public.venue_type');
        $data['venue_class'] = array_column($venue_class, 'name', 'id');
        
        //获取房间VR
        $venue_vr = $this->Mvtour->get_by_venue(array_column($list, 'id'));
        foreach ($data['list'] as $k => $v){
            if(isset($venue_vr[$v['id']])){
                $data['list'][$k]['detail_link'] = '/vtour/bn_scan/'.$venue_vr[$v['id']];
            }else{
                $data['list'][$k]['detail_link'] = '/venue/detail?id='.$v['id'];
                
            }
        }
        
        //查询广告
        $ad_where = array('manual_class_id' => C("class.ad.id"), 'is_del' => 0);
        $data['ad'] = $this->Mmanual->get_lists('*', $ad_where);
        // p($data['ad']);

        $this->load->view('venue/venue',$data);
    }
    
    
    public function ajax_data(){
        $data = $this->data;
        $default_where['is_del'] = 0;
        $default_where['is_recommend'] = 1;
        if($this->input->is_ajax_request()){
            $venue_class_id = $this->input->get_post('venue_class_id');
            if(isset($venue_class_id) && $venue_class_id){
                $default_where['venue_class_id'] = $venue_class_id;
                $field ='id,name,cover_img,max_table,container,area_size,floor,height,fit_type,min_consume,images,device';
                $list = $this->Mvenue->get_lists($field, $default_where);
                if($list){
                    foreach ($list as $k => $v){
                        $data['list'][$k] = $v;
                        $data['list'][$k]['cover_img'] = get_img_url($v['cover_img']);
                        $data['list'][$k]['area_size'] = intval($v['area_size']);
                        $data['list'][$k]['min_consume'] = intval($v['min_consume']);
                    }
                    //获取房间VR
                    $venue_vr = $this->Mvtour->get_by_venue(array_column($list, 'id'));
                    foreach ($data['list'] as $k => $v){
                        if(isset($venue_vr[$v['id']])){
                            $data['list'][$k]['detail_link'] = '/vtour/bn_scan/'.$venue_vr[$v['id']];
                        }else{
                            $data['list'][$k]['detail_link'] = '/venue/detail?id='.$v['id'];
                    
                        }
                    }
                    $this->return_success(array('list'=>$data['list']));
                
                }else{
                    $this->return_failed();
                }
                
            }else{
                $this->return_failed();
            }
        }
    }
    
    
    /**
     * 场馆详情
     * @author songhci@gz-zc.cn
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
            $field = 'id,name,introduce,cover_img,floor,height,area_size,fit_type,max_table,container,min_consume,max_consume,images,device,venue_video,video_cover_img';
            $data['venue_info'] = $this->Mvenue->get_one($field, [
                'is_del' => 0,
                'id' => $id
            ]);
            
            //获取场馆相关图片
            
            $images = $this->Mvenue_images->get_lists('*', array('is_del'=>0, 'venue_id'=>$id));
            $title = array_column($images, 'title');
            $data['title'] = $title;
            
            foreach ($images as $k=>$v){
                $images[$k]['img'] = explode(',', $v['images']);
            }
            $data['images'] = $images;

            $order_by['solar_time'] = 'desc';
            $limit = 100;
            //获取最近50条婚宴场馆
            $dinner_id = $this->Mdinner->get_lists('id', array('is_show'=>0, 'is_del'=>0, 'solar_time<'=>date('Y-m-d'), 'venue_type'=>C('party.wedding.id')), $order_by, $limit);
            $dinner_id = array_column($dinner_id, 'id');
            if($dinner_id){
                $new_dinner_venue_id = $this->Mdinner_venue->get_lists('dinner_id, venue_id', array('in'=>array('dinner_id'=>$dinner_id), 'venue_id'=>$id));
                $new_dinner_id = array_unique(array_column($new_dinner_venue_id, 'dinner_id'));
                $new_venue_id = array_column($new_dinner_venue_id, 'venue_id');
                //获取用户名字信息
                if($new_dinner_id){
                    $query['in'] = array('id'=>$new_dinner_id);
                    $role_name_new = $this->Mdinner->get_lists('id, roles_main, roles_wife', $query);
                    $role = array();
                    foreach ($role_name_new as $v){
                        $role[$v['id']] = $v;
                    }
                    $data['role_name'] = $role;
                    
                    //鲜花排行榜
                    $flower = $this->get_flower_up($new_dinner_id, $role);
                    $data['flower'] = array();
                    $i = 0;
                    foreach ($flower as $k=>$v){
                        if($i<7){
                            $data['flower'][$k] = $v;
                        }
                        $i++;
                    }
                    
                    $comment = $this->comment($new_dinner_id, $role);
                    $data['comment'] = $comment;
                    
                }
         
            }
            //获取宴会类型
            $venue = C('party');
            $data['venue'] = array_column($venue, 'name', 'id');
    
            //设置默认选择宴会类型
            $data['wedding']= C('party.wedding.id');
            
            //获取贵宾印记数据
            $dinner_more = $this->Mdinner->get_lists('id, m_cover_img, cover_img', array('is_show'=>0, 'is_del'=>0, 'solar_time<'=>date('Y-m-d'),'venue_type'=>C('party.wedding.id')), $order_by, 100);
            foreach ($dinner_more as $k=>$v){
                $dinner_more[$k]['m_cover_img'] = $v['m_cover_img'] ? $v['m_cover_img']:  $v['cover_img'];
            }
            $more = array();
            foreach ($dinner_more as $k=>$v){
                $more[$v['id']] = $v;
            }
            
            $dinner_more_id = array_column($dinner_more, 'id');
            $dinner_more_img = array_column($dinner_more, 'm_cover_img', 'id');

            if($dinner_more_id){
                $dinner_merge_id = $this->Mdinner_venue->get_lists('dinner_id', array('in'=>array('dinner_id'=>$dinner_more_id), 'venue_id'=>$id));
                foreach ($dinner_merge_id as $k=>$v){
                    $dinner_merge_id[$k]['m_cover_img'] = explode(';', $more[$v['dinner_id']]['m_cover_img'])[0];
                }
                $data['dinner_more_data'] = $dinner_merge_id;
            }
            
            
            $this->load->view('venue/new_detail', $data);
    }
    
    /**
     * 获取评论
     * @author songchi@gz-zc.cn
     */
    public function comment($dinner_id){
        //祝福语获赞数top3
        if($dinner_id){
            $where['in'] = array('dinner_id'=>$dinner_id);
            
            $data['thumbup'] = $this->Mbless->get_lists('id, user_id, zan_count, dinner_id, content', array_merge(array('is_del' => 0), $where), array('zan_count' => 'desc'));
            
            $user_id = array_column($data['thumbup'], 'user_id');
            if($user_id){
                $user_name = $this->Muser->get_lists('id, nickname, realname, head_img', array('in'=>array('id'=>$user_id)));
               
                $user = array();
                foreach ($user_name as $k=>$v){
                    $user[$v['id']] = $v;
                }
            }
           
            $tmp = array();
            foreach($data['thumbup'] as $k=>$v) {
            
                if(!isset($tmp[$v['dinner_id']][$v['user_id']])){
                    $tmp[$v['dinner_id']][$v['user_id']] = $v;
                }
            
            }
            
            $arr = array();
            foreach ($tmp as $k=>$v){
                $arr[$k] = array_chunk($tmp[$k], 3)[0];
            }
            
            
            foreach ($arr as $k=>$v){
                foreach ($v as $key=>$val){
                    $arr[$k][$key]['name'] = isset($user[$val['user_id']]['nickname']) ? $user[$val['user_id']]['nickname'] :'';
                    $arr[$k][$key]['head_img'] = isset($user[$val['user_id']]['head_img']) ? $user[$val['user_id']]['head_img']:'';
                }
            }
            
            
        }
        
        return $arr;
    }
    
    /**
     * 鲜花排行榜
     * @author songchi@gz-zc.cn
     */
    private function get_flower_up($dinner_id, $role){
        $where['is_del'] = 0;
        if($dinner_id){
            $where['in'] = array('dinner_id'=>$dinner_id);
            $query['in'] = array('id'=>$dinner_id);
            $order_by['num'] = 'desc';
            $list = $this->Mflower->get_lists('*', $where, $order_by);
            //获取鲜花榜用户信息
            $user_id = array_column($list, 'user_id');
            if($user_id){
                $user_name = $this->Muser->get_lists('id, nickname, realname, head_img', array('in'=>array('id'=>$user_id)));
                $user = array();
                foreach ($user_name as $k=>$v){
                    $user[$v['id']] = $v;
                }
            }
    
            $tmp  = array();
            if($list){
                foreach($list as $k=>$v) {
    
                    if(!isset($tmp[$v['dinner_id']][$v['user_id']])){
                        $tmp[$v['dinner_id']][$v['user_id']] = $v;
                    }else {
                        $tmp[$v['dinner_id']][$v['user_id']]['num'] += $v['num'];
                    }
    
                }
    
            }
            if(!$tmp){
                return false;
            }
             
    
            foreach ($tmp as $k=>$v){
                usort($tmp[$k], function($a, $b) {
                    $al = $a['num'];
                    $bl = $b['num'];
                    if ($al == $bl)
                        return 0;
                    return ($al > $bl) ? -1 : 1;
                });
            }
            $arr = array();
            foreach ($tmp as $k=>$v){
                $arr[$k] = array_chunk($tmp[$k], 3)[0];
            }
    

            foreach ($arr as $k=>$v){
                foreach ($v as $key=>$val){
                    $arr[$k][$key]['name'] = isset($user[$val['user_id']]['nickname']) ? $user[$val['user_id']]['nickname'] :'';
                    $arr[$k][$key]['head_img'] = isset($user[$val['user_id']]['head_img']) ? $user[$val['user_id']]['head_img']:'';
                }
            }
    
            return $arr;
    
        }
    
    
    }
     /**
     * 场馆预约
     * @author songchi@gz-zc.cn
     */
    public function appoint(){
        $data = $this->data;
        if(IS_POST){
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
    
}