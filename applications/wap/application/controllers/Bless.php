<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Bless extends MY_Controller{
    //每页显示数量
    private $pagesize;
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_bless' => 'Mbless',
                'Model_user' => 'Muser',
                'Model_dinner' => 'Mdinner',
                'Model_bless_comment' => 'Mbless_comment',
                'Model_flower' => 'Mflower',
                'Model_dinner_zan' => 'Mdinner_zan',
                'Model_bless_zan' => 'Mbless_zan',
                'Model_bless_comment_zan' => 'Mbless_comment_zan',
                'Model_admins' => 'Madmins',
                'Model_cake' => 'Mcake',
                'Model_manual' => 'Mmanual'
        ]);

    }
    
    
    private function deal_time($time){
    
        $time_num = time() - strtotime($time);
    
        if($time_num >= 0 && $time_num < 30){
            $time_text = '刚刚';
        }elseif($time_num >= 30 && $time_num < 60){
            $time_text = '一分钟前';
        }elseif($time_num/60 >= 1 && $time_num/60 < 30){
            $time_text = intval($time_num/60).'分钟前';
        }elseif($time_num/60 >= 30 && $time_num/60 < 60){
            $time_text = '一小时前';
        }elseif($time_num/60/60 >= 1 && $time_num/60/60 < 12){
            $time_text = '半天前';
        }elseif($time_num/60/60 >= 12 && $time_num/60/60 < 24){
            $time_text = '一天前';
        }elseif($time_num/60/60/24 >= 1 && $time_num/60/60/24 < 30){
            $time_text = intval($time_num/60/60/24).'天前';
        }elseif($time_num/60/60/24/30 >= 1){
            $time_text = intval($time_num/60/60/24/30).'月前';
        }else{
            $time_text = '未知';
        }
    
        return $time_text;
    }


    public function index($id = 0) {
        if($id == 0){
            $id = $this->input->get('id');
        }
        $dinner_id = (int)$id; 
        $data = $this->data;

        $data['action'] = "today";
        $data['title'] = '送祝福';

        $data['dinner_id'] = $dinner_id;
        //宴会信息
        $data['dinner'] = $this->Mdinner->info($dinner_id);

        $data['dinner']['m_cover_img_url'] = isset($data['dinner']['m_cover_img_url']) ? $data['dinner']['m_cover_img_url'][0] : C('domain.static.url').'/wap/images/banner.jpg';
        //收到祝福数量
        $data['bless_count'] = $this->Mbless->count(array('dinner_id' => $dinner_id, 'is_del' => 0));
        
        //收到的祝福详细
        $data['bless'] = $this->get_bless($dinner_id);
        
        //判断登录用户是否给祝福点过赞
        $data['bless'] = $this->get_bless_zan($data['bless']);
        
        //用户信息
        $user = $this->Muser->get_one('id,nickname,head_img', array('id' => $data['user_info']['id']));
        $user['head_img'] = $user['head_img'] ? get_img_url($user['head_img']) : C('domain.static.url').'/wap/images/touxiang.png';
        $data['user'] = $user;
        
        //用户当前鲜花余额
        $res = $this->Mflower->get_one('sum(num) as sent_flower_num' ,array('user_id' => $data['user_info']['id'],'dinner_id'=>$dinner_id, 'date'=>date('Y-m-d')));
        $data['remain_available_flower'] = (int)(10 - $res['sent_flower_num']);
        
        //判断是否本公司年会
        $data['is_own_party'] = in_array($dinner_id, array_column(C('own_party'), 'id'));
        if($data['is_own_party']){
            $data['birthday_girl'] = $this->get_birthday();
        }
        //查询广告
        $ad_where = array('manual_class_id' => C("class.ad.id"), 'is_del' => 0);
        $data['ad'] = $this->Mmanual->get_lists('*', $ad_where);

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

        $this->load->view('bless/index',$data);
    }
    
    /**
     * 加载更多祝福
     * @author chaokai@gz-zc.cn
     */
    public function submit(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $post_data['content'] = $this->input->post('content');
            $post_data['create_time'] = date("Y-m-d H:i:s");
            $post_data['dinner_id'] = (int)$this->input->post('dinner_id');
            
            //脏话判断
            $this->load->file(BASEPATH.'../shared/libraries/SimpleDict.php');
            $dict = new SimpleDict(BASEPATH.'../shared/config/'.ENVIRONMENT.'/dirty_dict.bin');
            //去掉空格
            $str = str_replace(' ', '', $post_data['content']);
            $result = $dict->search($str);
            if($result){
                $this->return_failed('请文明用词！');
            }
            
            $where = array('user_id' => $data['user_info']['id']);
            $order_by = 'create_time desc';
            $res = $this->Mbless->get_one('create_time', $where, $order_by);

            $white_number = array(
                '18519209831',
                '18685399995',
                '15519047376',
                '18798887211',
                '17784999332',
                '13385532111',
                '13885061994'
            );
            
            if($res && !in_array($data['user_info']['mobile_phone'], $white_number)){
                //判断上一次发送祝福的时间间隔
                if($this->is_less_interval(strtotime($res['create_time']))){
                    $this->return_failed('您发送的频率过快！请稍后再试 :(');
                }
                
                //判断祝福内容是否重复
                $where = array('user_id' => $data['user_info']['id'], 'dinner_id' => $post_data['dinner_id'], 'content' => $post_data['content']);
                $res = $this->Mbless->get_lists('id', $where);
                if($res){
                    $this->return_failed('请勿发送重复内容  :(');
                }
            }

            //更新用户昵称
            $realname = $this->input->post('realname');
            $this->Muser->update_info(array('realname' => $realname), array('id' => $data['user_info']['id']));
            
            $post_data['user_id'] = $data['user_info']['id'];
            $add = $this->Mbless->create($post_data);
            if($add){
                $data['bless'] = $this->get_bless_by_id($add);
                $this->load->view('bless/load_more', $data);
            }else{
                 $this->return_failed('发送失败！ :(');
            }
          
        }
    }
    
    /**
     * 判断发送祝福时间间隔
     * @author louhang@gz-zc.cn
     */
    public function is_less_interval($time, $interval = 20){
        if(time() - $time < $interval){
            return true;
        }
        return false;
    }
    
    
    /** 
     * 加载更多祝福
     * @author chaokai@gz-zc.cn
     */
    public function load_more($dinner_id = 0, $offset = 1){
        $dinner_id = intval($dinner_id);
        if(!$dinner_id){
            echo '<li>参数错误！</li>';
            exit;
        }
        
        $data['bless'] = $this->get_bless($dinner_id, 4, $offset);
        //判断登录用户是否给祝福点过赞
        $data['bless'] = $this->get_bless_zan($data['bless']);
        if(!$data['bless']){
            echo 'nodata';exit;
        }
        $this->load->view('bless/load_more', $data);
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
            $data[$k]['time'] = $this->deal_time($data[$k]['create_time']);
        }
    
        return $data;
    }
    
    /**
     * 根据user_id 获取用户信息 判断用户是否对祝福点过赞
     * @author louhang@gz-zc.cn
     */
    private function get_bless_zan($data){
        $user_data = $this->data;
        $user_id = $user_data['user_info']['id'];
        $bless_ids = array_column($data,'id');
        $bless_zan = $this->Mbless_zan->get_lists('bless_id, user_id', array('user_id' => $user_id ,'in' => array('bless_id' => !empty($bless_ids) ? $bless_ids : '')));
        $bless_zan = array_column($bless_zan, 'user_id', 'bless_id');
        foreach ($data  as $k => $v){
            $data[$k]['is_had_zan'] = isset($bless_zan[$v['id']]) ? true : false;
        }
        return $data;
    }
    
    /**
     * 根据user_id 获取用户信息 判断用户是否对评论点过赞
     * @author louhang@gz-zc.cn
     */
    private function get_bless_comment_zan($data){
        $user_data = $this->data;
        $user_id = $user_data['user_info']['id'];
        $bless_comment_ids = array_column($data,'id');
        $bless_comment_zan = $this->Mbless_comment_zan->get_lists('bless_comment_id, user_id', array('user_id' => $user_id ,'in' => array('bless_comment_id' => !empty($bless_comment_ids) ? $bless_comment_ids : '')));
        $bless_comment_zan = array_column($bless_comment_zan, 'user_id', 'bless_comment_id');
        foreach ($data  as $k => $v){
            $data[$k]['is_had_zan'] = isset($bless_comment_zan[$v['id']]) ? true : false;
        }
        return $data;
    }
    
    /**
     * 获取祝福信息
     * @author louhang@gz-zc.cn
     */
    private function get_bless($dinner_id, $size =4, $offset = 1){
        $data = array();
        //祝福信息
        $data['bless'] = $this->Mbless->get_lists('*', array('dinner_id' => $dinner_id, 'is_del' => 0), array('zan_count' => 'desc'), $size, ($offset-1)*$size);
        
        //从user表获取祝福留言用户的头像，昵称
        $data['bless'] = $this->get_user_detail($data['bless']);
        
        //获取对祝福的评论数
        $bless_ids = array_column($data['bless'], 'id');
        $where = array('in' => array('bless_id' => !empty($bless_ids) ? $bless_ids : ''), 'is_del' => 0);
        $order_by = array('zan_count' => 'desc');
        $group_by = 'bless_id';
        $bless_comments = $this->Mbless_comment->get_lists('bless_id, count(*) as count', $where, $order_by, 0, 0, $group_by);
        $bless_comments = array_column($bless_comments, 'count', 'bless_id');
        foreach ($data['bless'] as $k => $v){
            $data['bless'][$k]['comment_count'] = isset($bless_comments[$v['id']]) ? $bless_comments[$v['id']] : 0;
        }

        return $data['bless'];
    }
    
    /**
     * 根据祝福id获取祝福信息
     * @author louhang@gz-zc.cn
     */
    private function get_bless_by_id($bless_id){
        $data = array();
        //祝福信息
        $data['bless'] = $this->Mbless->get_lists('*', array('id' => $bless_id, 'is_del' => 0));
    
        //从user表获取祝福留言用户的头像，昵称
        $data['bless'] = $this->get_user_detail($data['bless']);
    
        //获取对祝福的评论数
        $bless_ids = array_column($data['bless'], 'id');
        $where = array('in' => array('bless_id' => !empty($bless_ids) ? $bless_ids : ''), 'is_del' => 0);
        $order_by = array('zan_count' => 'desc');
        $group_by = 'bless_id';
        $bless_comments = $this->Mbless_comment->get_lists('bless_id, count(*) as count', $where, $order_by, 0, 0, $group_by);
        $bless_comments = array_column($bless_comments, 'count', 'bless_id');
        foreach ($data['bless'] as $k => $v){
            $data['bless'][$k]['comment_count'] = isset($bless_comments[$v['id']]) ? $bless_comments[$v['id']] : 0;
        }
        
        $data['bless'] = $this->get_bless_zan($data['bless']);
        return $data['bless'];
    }
    
    /**
     * 给新人点赞
     * @author louhang@gz-zc.cn
     */
    public function thumb_up($dinner_id){
        $data = $this->data;
        $dinner_id = (int)$dinner_id;
        $where = array('user_id' => $data['user_info']['id'], 'dinner_id' =>$dinner_id);
        if($this->Mdinner_zan->get_one('id', $where)){
            $this->return_failed('请勿重复操作');
        }
        
        $update = array('incr' => array('zan_count' => 1));
        $where = array('id' => $dinner_id);
        $res = $this->Mdinner->update_info($update, $where);
        if($res && isset($data['user_info']['id']) && !empty($data['user_info']['id'])){
            $add_post = array();
            $add_post['user_id'] = $data['user_info']['id'];
            $add_post['dinner_id'] = $dinner_id;
            $add_post['create_time'] = date('Y-m-d H:i:s');
            $res = $this->Mdinner_zan->create($add_post);
            if($res){
                $this->return_success();
            }else{
                $this->return_failed('操作失败,dinner表已更新,flower表未更新');
            }
        }else{
            $this->return_failed('操作失败');
        }
    }
    
    /**
     * 祝福点赞
     * @author louhang@gz-zc.cn
     */
    public function zan_bless(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $bless_id = (int)$this->input->post('bless_id');
            $where = array('user_id' => $data['user_info']['id'], 'bless_id' =>$bless_id);
            if($this->Mbless_zan->get_one('id', $where)){
                $this->return_failed('请勿重复操作');
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
                    $this->return_success();
                }else{
                    $this->return_failed('操作失败');
                }
            }else{
                $this->return_failed('操作失败');
            }
        }
    }
    
    /**
     * 祝福评论点赞
     * @author louhang@gz-zc.cn
     */
    public function zan_comment(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $bless_comment_id = (int)$this->input->post('bless_comment_id');
            $where = array('user_id' => $data['user_info']['id'], 'bless_comment_id' =>$bless_comment_id);
            if($this->Mbless_comment_zan->get_one('id', $where)){
                $this->return_failed('请勿重复操作');
            }
            
            $update = array('incr' => array('zan_count' => 1));
            $where = array('id' => $bless_comment_id);
            $res = $this->Mbless_comment->update_info($update, $where);
            if($res){
                $add_post = array();
                $add_post['user_id'] = $data['user_info']['id'];
                $add_post['bless_comment_id'] = $bless_comment_id;
                $add_post['create_time'] = date('Y-m-d H:i:s');
                $res = $this->Mbless_comment_zan->create($add_post);
                if($res){
                    $this->return_success();
                }else{
                    $this->return_failed('操作失败');
                }
            }else{
                $this->return_failed('操作失败');
            }
        }
    }
    
    /**
     * 送花
     * @author louhang@gz-zc.cn
     */
    public function send_flower($dinner_id, $flower_count){
        $data = $this->data;
        $dinner_id = (int)$dinner_id;
        $flower_count = (int)$flower_count;

        $update = array('incr' => array('flower_count' => $flower_count));
        $where = array('id' => $dinner_id);

        //查找用户送花详情
        $res = $this->Mflower->get_one('sum(num) as sent_flower_num' ,array('user_id' => $data['user_info']['id'],'dinner_id'=>$dinner_id, 'date'=>date('Y-m-d')));
      
        //最大鲜花数
        $max_flower = 10;
        //白名单
        $white_number = array(
                        '18519209831',
                        '18685399995',
                        '15519047376',
                        '18798887211',
                        '17784999332',
                        '13385532111'
        );
        if(in_array($data['user_info']['mobile_phone'], $white_number)){
            $max_flower = 10000;
        }
        
        if($flower_count > $max_flower){
            $this->return_failed('你目前只能上传10朵鲜花');
        }
        //数据库中有数据
        if(isset($res) && $res['sent_flower_num']){
            //用户送完后剩余鲜花数量
            $remain_available_num = $max_flower - $flower_count- $res['sent_flower_num'];

            if($remain_available_num >= 0){
                if($res = $this->Mdinner->update_info($update, $where)){
                    $add_post = array();
                    $add_post['user_id'] = $data['user_info']['id'];
                    $add_post['dinner_id'] = $dinner_id;
                    $add_post['num'] = $flower_count;
                    $add_post['create_time'] = date('Y-m-d H:i:s');
                    $add_post['date'] = date('Y-m-d');
                    if($res = $this->Mflower->create($add_post)){
                        $this->return_success();
                    }else{
                        $this->return_failed('操作失败');
                    }
                
                }else{
                    $this->return_failed('操作失败');
                }
            }else{
                if($max_flower-$res['sent_flower_num'] < 1){
                    $msg = '操作失败,您的免费鲜花已送完';
                }else{
                    $msg = '操作失败,您至多还能送花'.($max_flower-$res['sent_flower_num']).'朵';
                }
                $this->return_failed($msg);
            }
        }
        //数据库中无数据，填充数据
        else
        {
            if($res = $this->Mdinner->update_info($update, $where)){

                $add_post = array();
                $add_post['user_id'] = $data['user_info']['id'];
                $add_post['dinner_id'] = $dinner_id;
                $add_post['num'] = $flower_count;
                $add_post['create_time'] = date('Y-m-d H:i:s');
                $add_post['date'] = date('Y-m-d');
                if($res = $this->Mflower->create($add_post)){
                    $this->return_success();
                }else{
                    $this->return_failed('操作失败,dinner表已更新,flower表未更新');
                }
            
            }else{
                $this->return_failed('操作失败');
            }
        }
        
       
    }
    
    /**
     * 评论祝福
     * @author louhang@gz-zc.cn
     */
    public function send_comment(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $post_data['content'] = $this->input->post('content');
            $post_data['bless_id'] = (int)$this->input->post('bless_id');
            $post_data['create_time'] = date("Y-m-d H:i:s");
            if(isset($data['user_info']['id']) && !empty($data['user_info']['id'])){
                $post_data['user_id'] = $data['user_info']['id'];
                $add = $this->Mbless_comment->create($post_data);
                if($add){
                    $this->return_success();
                }else{
                    $this->return_failed('发送失败，请稍后再试 :)');
                }
            }else{
                $this->return_failed('请重新登陆 :)');
            }
        }
    }
    
    /**
     * 送蛋糕
     * @author chaokai@gz-zc.cn
     * 
     */
    public function send_cake(){
        $data = $this->data;
        $admin_id = (int)$this->input->get('admin_id');
        $cake_count = (int)$this->input->get('cake_count');
        $dinner_id = (int)$this->input->get('dinner_id');
        if(empty($admin_id) || empty($cake_count) || empty($dinner_id)){
            $this->return_failed('参数错误');
        }
        
        //查找用户送蛋糕详情
        $res_where = array(
                        'user_id' => $data['user_info']['id'],
                        'admin_id'=>$admin_id, 
                        'dinner_id' => $dinner_id,
                        'create_time >=' => date('Y-m-d').' 00:00:00',
                        'create_time <=' => date('Y-m-d').' 23:59:59'
        );
        $res = $this->Mcake->get_one('sum(num) as sent_cake_num' ,$res_where);
        //最大蛋糕数
        $max_cake = 10;
        
        if($cake_count > $max_cake){
            $this->return_failed('你目前只能赠送10个蛋糕');
        }
        //数据库中有数据
        if(isset($res) && $res['sent_cake_num']){
            //用户送完后剩余蛋糕数量
            $remain_available_num = $max_cake - $cake_count- $res['sent_cake_num'];
        
            if($remain_available_num >= 0){
                $add_post = array();
                $add_post['user_id'] = $data['user_info']['id'];
                $add_post['admin_id'] = $admin_id;
                $add_post['num'] = $cake_count;
                $add_post['create_time'] = date('Y-m-d H:i:s');
                $add_post['dinner_id'] = $dinner_id;
                if($res = $this->Mcake->create($add_post)){
                    $this->return_success();
                }else{
                    $this->return_failed('操作失败');
                }
            }else{
                if($max_cake-$res['sent_cake_num'] < 1){
                    $msg = '操作失败,您的免费蛋糕已送完';
                }else{
                    $msg = '操作失败,您至多还能送蛋糕'.($max_cake-$res['sent_cake_num']).'个';
                }
                $this->return_failed($msg);
            }
        }
        //数据库中无数据，填充数据
        else
        {
            $add_post = array();
            $add_post['user_id'] = $data['user_info']['id'];
            $add_post['admin_id'] = $admin_id;
            $add_post['num'] = $cake_count;
            $add_post['create_time'] = date('Y-m-d H:i:s');
            $add_post['dinner_id'] = $dinner_id;
            if($res = $this->Mcake->create($add_post)){
                $this->return_success();
            }else{
                $this->return_failed('操作失败');
            }
        
        }
    }
    
    /**
     * 查看祝福评论
     * @author louhang@gz-zc.cn
     */
    public function view_comment(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $bless_id = (int)$this->input->get('bless_id');
            if(!$bless_id){
                echo '<li>参数错误！</li>';
                exit;
            }
            
            $data['bless_id'] = $bless_id;
            $data['bless_comment'] = $this->get_bless_comment($bless_id);

            if(!$data['bless_comment']){
                echo 'nodata';exit;
            }
            
            //判断评论是否被当前用户点过赞
            $data['bless_comment'] = $this->get_bless_comment_zan($data['bless_comment']);
            
            $comment_count = $this->Mbless_comment->count(array('bless_id' => $bless_id, 'is_del' => 0));
            $data['is_have_more'] = $comment_count > 4;
            
            $this->load->view('bless/view_comment', $data);
        }
    }
    
    /**
     * 查看更多祝福评论
     * @author louhang@gz-zc.cn
     */
    public function view_more_comment(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $bless_id = (int)$this->input->get('bless_id');
            if(!$bless_id){
                echo '<li>参数错误！</li>';
                exit;
            }
            $data['bless_id'] = $bless_id;
            $data['bless_comment'] = $this->get_bless_comment($bless_id, 0);
            $data['bless_comment'] = array_slice($data['bless_comment'], 4);
            if(!$data['bless_comment']){
                echo 'nodata';exit;
            }
            
            $data['bless_comment'] = $this->get_bless_comment_zan($data['bless_comment']);

            $this->load->view('bless/view_more_comment', $data);
        }
    }
    
    /**
     * 获取祝福评论信息
     * @author louhang@gz-zc.cn
     */
    private function get_bless_comment($bless_id, $size =4, $offset = 1){
        $data = array();
        //祝福信息
        $data['bless_comment'] = $this->Mbless_comment->get_lists('*', array('bless_id' => $bless_id, 'is_del' => 0), array('create_time' => 'asc'), $size, ($offset-1)*$size);
    
        //从user表获取祝福留言用户的头像，昵称
        $data['bless_comment'] = $this->get_user_detail($data['bless_comment']);

        return $data['bless_comment'];
    }
    
    /**
     * 获取本月寿星及蛋糕统计信息
     * @author chaokai@gz-zc.cn
     */
    private function get_birthday(){
        $birthday_list = $this->Madmins->get_birthday_girl();
        if(empty($birthday_list)){
            return false;
        }
        
        $admin_ids = array_column($birthday_list, 'id');
        
        $count_list = $this->Mcake->count_cake($admin_ids);
        foreach ($birthday_list as $k => $v){
            foreach ($count_list as $key => $value){
                if($v['id'] == $value['admin_id']){
                    $birthday_list[$k]['all_num'] = $value['all_num'];
                }
            }
        }
        foreach ($birthday_list as $k => $v){
            if(!isset($v['all_num'])){
                $birthday_list[$k]['all_num'] = 0;
            }
        }
        //重新排序
        $temp_arr = array();
        foreach ($birthday_list as $k => $v){
            $temp_arr[$k] = $v['all_num'];
        }
        array_multisort($temp_arr, SORT_DESC, $birthday_list);
        return $birthday_list;
    }
}

