<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class News extends MY_Controller{
    //每页显示数量
    private $pagesize;
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_about_us' => 'Mabout_us',
                'Model_manual' => 'Mmanual',
                'Model_venue' => 'Mvenue',
                'Model_dinner' => 'Mdinner',
                'Model_theme' => 'Mtheme',
                'Model_news_class' => 'Mnewsclass',
                'Model_news_comment' => 'Mnewscomment',
                'Model_news' => 'Mnews',
        ]);
        $this->pagesize = 3;
         
    }

    //songchi
    public function index($class_id='0') {
        $data = $this->data;
        $data['action'] = "news";
        
        //获取走进百年子菜单
        $data['class_list'] = $this->Mnewsclass->get_lists('id, name', array('parent_id'=>1, 'is_del'=>0));
        
        $where['is_del'] = 0;
        $where['is_show'] = 1;
        $order_by['publish_time'] = 'desc';
    
        //获取发布者数据
        $admin = $this->Madmins->get_lists('id, name');
        $data['admin'] = array_column($admin, 'name', 'id');

        if($class_id){
            $where['news_class_id'] = $class_id;
        }else{
            $bainian = array_column($data['class_list'], 'id');
            if($bainian){
                $where['in'] = array('news_class_id'=>$bainian);
            }
        }
        $list = $this->Mnews->get_lists('*', $where, $order_by, 4);
        $data['list'] = $list;
        $data['class_id'] = $class_id;

        //获取媒体手工位内容
        if($class_id){
            $media_id = $this->media_id($class_id);
            $media_where['id'] = $media_id;
        }else{
            $bainian_id = C('news.in_bainian.children');
            $bainian_id = array_column($bainian_id, 'media_id');
            if($bainian_id){
                $media_where['in'] = array('id'=>$bainian_id);
            }
        }

        $data['class_id'] = $class_id;
        $data['manual_list'] = $this->Mmanual->get_lists('img_url, video', array_merge(array('is_del'=>1), $media_where));
        $img = array();
        $video =array();
        foreach ($data['manual_list'] as $k=>$v){
            if($v['video']){
                $video['video'][$k]['video'] = $v['video'];
                $video['video'][$k]['img_url'] = $v['img_url'];
            }
            else{
                if($v['img_url']){
                    $img['img_url'][] = $v['img_url'];
                }
            }
        }
        
        $data['img_url'] =  $img;
        $data['video'] = $video;
        
        $this->load->view('news/index',$data);
    }
    
    /**
     * 米兰婚礼
     * @author louhang@gz-zc.cn
     */
    public function milan($class_id=0){
        $data = $this->data;
        $data['action'] = "news";
        $where['is_del'] = 0;
        $where['is_show'] = 1;
        $order_by['publish_time'] = 'desc';
        
        //获取发布者数据
        $admin = $this->Madmins->get_lists('id, name');
        $data['admin'] = array_column($admin, 'name', 'id');
        
        if($class_id){
            $where['news_class_id'] = $class_id;
        }
        else{
            $default = $this->Mnewsclass->get_lists('id', array('parent_id'=>C('news.milan.id')));
            $default = array_column($default, 'id');
            if($default){
                $where['in'] = array('news_class_id'=>$default);
            }
            
        }
        
        $list = $this->Mnews->get_lists('*', $where, $order_by, 4);
        $data['list'] = $list;
        $data['class_id'] = $class_id;
        
        
        //获取米兰国际栏目下的推荐文章
        unset($where['news_class_id']);
        $where['parent_class_id'] = C('news.milan.id');
        $where['is_recommend'] = 1;
        $recommend_news_lists = $this->Mnews->get_lists('id, title, cover_img', $where, $order_by,5);
        foreach ($recommend_news_lists as $k => $v){
            $recommend_news_lists[$k]['url'] = '/news/detail?id='.$v['id'];
        }
        
        //获取[米兰国际][最美跟拍] 媒体手工位内容
        $media_ids = array(C('class.milan.id'), C('class.following_shot.id'));
        $manual_list = $this->Mmanual->get_lists('id, title, img_url, manual_class_id', array('is_del'=>1,'in'=>array('manual_class_id' => $media_ids)));
        foreach ($manual_list as $k => $v){
            if($v['manual_class_id'] == C('class.milan.id')){
                $manual_list[$k]['url'] = '/milan';
            }else if($v['manual_class_id'] == C('class.following_shot.id')){
                $manual_list[$k]['url'] = '/milan/following_shot';
            }
            $manual_list[$k]['cover_img'] = $v['img_url'];

        }
        
//         $data['manual_list'] = array_merge($recommend_news_lists, $manual_list);
        $data['manual_list'] = $recommend_news_lists;

        $this->load->view('news/milan',$data);
        
    }
    
    
    public function media_id($class_id){
        if($class_id == C('news.in_bainian.children.gold_service.id')){
            return C('news.in_bainian.children.gold_service.media_id');
        }
        if($class_id == C('news.in_bainian.children.king_env.id')){
            return C('news.in_bainian.children.king_env.media_id');
        }
        if($class_id == C('news.in_bainian.children.bainian_taste.id')){
            return C('news.in_bainian.children.bainian_taste.media_id');
        }
        if($class_id == C('news.in_bainian.children.company_impression.id')){
            return C('news.in_bainian.children.company_impression.media_id');
        }
        
    }
    
    
    public function ajax_data(){
        if($this->input->is_ajax_request()){
            
            $post_data = $this->input->post();
            $class_id = $post_data['class_id'];
            $next_page = $post_data['next_page'];
            $order_by['publish_time'] = 'desc';
            
            $list = $this->Mnews->get_lists('*', array('news_class_id'=>$class_id, 'is_del' => 0, 'is_show' => 1), $order_by, 4, ($next_page-1)*4);
            if($list){
                foreach($list as $k=>$v){
                    $list[$k]['cover_img'] = get_img_url($v['cover_img']);
                }
                
            }
            $this->return_json($list);
        }
        
    }
    
    
    public  function detail(){
        $id = (int)$this->input->get('id');
        $data = $this->data;
        if(!isset($data['user_info'])){
            //如果没有登陆，则先跳转到微信登陆
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.C('wechat_app.app_id.value');
            $url .= '&redirect_uri='.urlencode($this->data['domain']['mobile']['url'].'/passport/weixin_smarty_login?id='.$id);
            $url .= '&response_type=code&scope=snsapi_userinfo#wechat_redirect';
            redirect($url);
        }
        $data['action'] = 'news';
        $data['info'] = $this->Mnews->get_one('*', array('id'=>$id));
        //如果记录不存在则返回自媒体页面
        if(!$data['info']){
            redirect($data['domain']['mobile']['url'].'/news');
        }
        //处理内容中的图片
        $data['info']['content'] = get_full_content_img_url($data['info']['content']);
        //获取发布者数据
        $admin = $this->Madmins->get_lists('id, name');
        $data['admin'] = array_column($admin, 'name', 'id');
        $data['info']['publisher'] = $data['admin'][$data['info']['create_user']];
        
        $add_data =  $data['info']['read']+1;
        $data['info']['read'] = $data['info']['read']+1;
        $add = $this->Mnews->update_info(array('read'=>$add_data), array('id'=>$id));

        //读取文章评论,一级评论
        $say = $this->Mnewscomment->get_lists('*', ['news_id' => $id, 'is_del' => 0, 'news_comment_id' => 0], ['create_time' => 'desc']);
        if($say){
            $user_ids = array_column($say, 'user_id');
            $user = $this->Muser->get_lists('id,realname,head_img,nickname', ['is_del'=> 0, 'is_limit' => 0, 'in' => array('id' => $user_ids)]);
            if($user){
                foreach ($say as $k => $v){
                    foreach ($user as $kk => $vv){
                        if($vv['id'] == $v['user_id']){
                            $say[$k]['realname'] = !empty($vv['realname']) ? : $vv['nickname'];
                            $say[$k]['head_img'] = !empty($vv['head_img']) ? $vv['head_img'] : $data['domain']['static']['url'].'/wap/images/touxiang.png';
                        }
                    }
                    $say[$k]['create_time'] = $this->deal_time($v['create_time']);
                }
            }
            //拼接二级评论
            $news_comment_ids = array_column($say, 'id');
            $say_er = $this->Mnewscomment->get_lists('*', ['news_id' => $id, 'is_del' => 0, 'in' => array('news_comment_id' => $news_comment_ids)], ['create_time' => 'asc']);
            if($say_er){
                $user = $this->Muser->get_lists('id,realname,nickname', ['is_del'=> 0, 'is_limit' => 0]);
                if($user){
                    foreach ($say_er as $k => $v){
                        $say_er[$k] =$v;
                        foreach ($user as $kk => $vv){
                            if($vv['id'] == $v['user_id']){
                                $say_er[$k]['realname'] = $vv['realname'] ? : $vv['nickname'];
                            }
                        }
                        $say_er[$k]['create_time'] = date('Y-m-d H:i', strtotime($v['create_time']));
                    }
                }
            }

            if($say && $say_er){
                //评论归位
                foreach ($say as $k => $v ){
                    foreach ($say_er as $kk => $vv){
                        if($vv['news_comment_id'] == $v['id'] && $vv['news_id'] == $v['news_id']){
                            $say[$k]['son'][] = $vv;
                        }
                    }
                }
            }
            
            $data['say'] = $say;
        }
        $data['jssdk'] = $this->get_jssdk_info();
        $this->load->view('news/new_detail', $data);
    }
    
        /**
         * 获取微信jssdk权限验证配置
         * @author chaokai@gz-zc.cn
         */
        private function get_jssdk_info(){
            $param = array(
                  'app_id' => C('wechat_app.app_id.value'),
                  'app_secret' => C('wechat_app.app_secret.value'),
                  'cache_dir' => APPPATH.'cache/'
             );
             $this->load->library('weixinjssdk', $param);
                
             $jssdk_info = $this->weixinjssdk->getSignPackage();
             $jssdk_info['jsApiList'] = ['onMenuShareTimeline', 'onMenuShareAppMessage'];
             $jssdk_info['debug'] = false;
                
            return json_encode($jssdk_info);
        }
    
    
    public function say(){
        $data = $this->data;
        if(!isset($data['user_info'])){
            $this->return_json(['code' => -1, 'info' => '请先登陆']);
        }
        $add = $this->input->post();
        $add['content'] = trim($add['content']); 
        $add['create_time'] = date('Y-m-d H:i:s');
        $res = $this->Mnewscomment->create($add);
        if(!$res){
            $this->return_json(['code' => 0, 'info' => '评论失败']);
        }
        $this->return_json(['code' => 1, 'id' => $res, 'info' => date('m-d H:i:s', strtotime($add['create_time']))]);
    }
    //评论点赞
    public function p_zan(){
        $data = $this->data;
        if(!isset($data['user_info'])){
            $this->return_json(['code' => -1, 'info' => '请先登陆']);
        }
        $id =(int) $this->input->post('id');
        if(!$this->check_pdz_token($id))
        {
            $res = $this->Mnewscomment->update_info(['incr' => ['zan_count' => 1]], ['id' => $id]);
            if(!$res){
                $this->return_json(['code' => 0, 'info' => '点赞失败']);
            }
            $this->set_token_pdz($id);
            $this->return_json(['code' => 1]);
            
        }
        $this->return_json(['code' => 0, 'info' => '你已经赞过了！']);
        
        
        
    }
    
    
    public  function get_ajax_zan(){
        if($this->input->is_ajax_request()){
            $id = intval($this->input->post("id"));
            if($this->check_dz_token($id))
            {
                $return_arr['status'] =-1;
            }
            else{
                $this->set_token_dz($id);
                $this->Mnews->update_info([ 'incr' => ['zan_number' => 1] ], array("id"=>$id));
                $return_arr['status'] = 0;
            }
            $this->return_json($return_arr);
    
        }
    }
    
    /**
     * 处理时间
     * @author cahokai@gz-zc.cn
     */
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

    
    public function load_more(){
        $data = $this->data;
        //获取发布者数据
        $admin = $this->Madmins->get_lists('id, name');
        $data['admin'] = array_column($admin, 'name', 'id');
        if($this->input->is_ajax_request()){
            $class_id = $this->input->get('class_id');
            if($class_id){
                $where['news_class_id'] = $class_id;
            }
            $where['is_del'] = 0;
            $where['is_show'] = 1;
            $order_by['publish_time'] = 'desc';
            $page = $this->input->get('page');
            $pagesize = 4;
            $offset = $pagesize * ($page - 1);
            $data['news_list'] = $this->Mnews->get_lists('*', $where, $order_by, $pagesize, $offset);
            
            if(!$data['news_list']){
                echo 'nodata';exit;
            }
            $this->load->view('news/load_more', $data);
        }
    }
    
    
}
    
    
    

