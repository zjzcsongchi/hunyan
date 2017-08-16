<?php
defined('BASEPATH') or exit('No direct script access allowed');
class News extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model([
                   'Model_news_class' => 'Mnews_class',
                   'Model_news' => 'Mnews',
                   'Model_admins' => 'Madmins',
                   'Model_news_comment' => 'Mnews_comment',
                   'Model_manual' => 'Mmanual'
        ]);
        $this->pageconfig = C('page.config_log');
        $this->load->library('pagination');
    }
    
    /**
     * 首页
     */
    public function home(){
        $data = $this->data;
        //获取走进百年子菜单
        $data['class_list'] = $this->Mnews_class->get_lists('id, name', array('parent_id'=>1, 'is_del'=>0));
        $bainian_child_id = array_column($data['class_list'], 'id');
        $where['is_del'] = 0;
        $where['is_show'] = 1;
        $where['is_recommend'] = 1;
        $order_by['publish_time'] = 'desc';
        
        $bainian = array_column($data['class_list'], 'id');
        if($bainian){
            $where['in'] = array('news_class_id'=>$bainian);
        }
        $list = $this->Mnews->get_lists('id, title,summary,cover_img,publish_time, read', $where, $order_by, 8);
        $data['list'] = $list;
        
        //获取米兰子菜单
        $data['milan_class_list'] = $this->Mnews_class->get_lists('id, name', array('parent_id'=>2, 'is_del'=>0));
        $milan_child_id = array_column($data['milan_class_list'], 'id');
        $defualt_where['is_del'] = 0;
        $defualt_where['is_show'] = 1;
        $defualt_where['is_recommend'] = 1;
        
        $milan_id = array_column( $data['milan_class_list'], 'id');
        if($milan_id){
            $defualt_where['in'] = array('news_class_id'=>$milan_id);
        }
        $data['milan_list'] = $this->Mnews->get_lists('id, title, summary, cover_img, publish_time, read', $defualt_where, $order_by, 8);
        
        
        $child_where['is_del'] = 0;
        $child_where['is_recommend'] = 1;
        //获取走进百年子菜单数据
        $data['bainian_child_name'] = array_column($data['class_list'], 'name', 'id');
        if($bainian_child_id){
            $child_where_bainian['in'] = array('news_class_id'=>$bainian_child_id);
            $bainian_child_lists = $this->Mnews->get_lists('id, title, summary, cover_img, publish_time, read, news_class_id', array_merge($child_where,$child_where_bainian));
            if($bainian_child_lists){
                $tmp = array();
                foreach ($bainian_child_lists as $k=>$v){
                    $tmp[$v['news_class_id']][] = $v;
                }
            }
            
//             $data['bainian_child_lists'] = $tmp;
        }
        
        //获取百年资讯首页轮播推荐
        $new_banner = $this->Mmanual->get_lists('*', ['manual_class_id' => C('manual.news_banner.id'), 'is_del' => 1], ['sort' => 'desc'], C('manual.news_banner.limit'));
        if($new_banner){
            $data['top_banner'] = $new_banner;
        }
        //获取米兰婚礼子菜单数据
        $data['milan_child_name'] = array_column($data['milan_class_list'], 'name', 'id');
        if($milan_child_id){
            $child_where_milan['in'] = array('news_class_id'=>$milan_child_id);
            $milan_child_lists = $this->Mnews->get_lists('id, title, summary, cover_img, publish_time, read, news_class_id', array_merge($child_where,$child_where_milan), array('sort'=>'desc'));
            if($milan_child_lists){
                $tmp_milan = array();
                foreach ($milan_child_lists as $k=>$v){
                    $tmp_milan[$v['news_class_id']][] = $v;
                }
            }
            $data['milan_child_lists'] = $tmp_milan;
        }
        
        if($this->input->is_ajax_request()){
            $class_id = intval($this->input->post("class_id"));
            $news_lists = $this->Mnews->get_lists('id, title,summary,cover_img,publish_time,read', array('is_del'=>0, 'news_class_id'=>$class_id, 'is_recommend'=>1), $order_by, 8);
            if($news_lists){
                $data['news_lists'] = $news_lists;
                $this->load->view("news/change", $data);
            }else{
                echo "nodata";exit;
            }
        }else{
            $this->load->view('news/home', $data);
        }
        
        
        
    }
    
    
    public function milan(){
        $data = $this->data;
        $class_id = intval($this->input->post("class_id"));
        $order_by['publish_time'] = 'desc';
        $news_lists = $this->Mnews->get_lists('id, title,summary,cover_img,publish_time, read', array('is_del'=>0, 'news_class_id'=>$class_id, 'is_recommend'=>1), $order_by, 8);
        if($news_lists){
            $data['news_lists'] = $news_lists;
            $this->load->view("news/milan", $data);
        }else{
            echo "nodata";exit;
        }
    }
    
    public function index(){
        $data = $this->data;
        $data['action'] = 'news';
        
        $where['is_del'] = 0;
        $order_by['publish_time'] = 'desc';        
        //只显示走进百年和米兰婚礼标签
        $data['tags'] = $this->Mnews_class->get_lists('id, parent_id, name', $where);       
        $where['is_show'] = 1;
        //设置默认数据类型
        $class_id = (int) $this->input->get_post('class_id');
        $parent_class_id = (int) $this->input->get_post('parent_class_id');
        $where['is_show'] = 1;
        if($class_id){
            $where['news_class_id'] = $class_id;
            //查找当前分类是否有子分类
            $have_son = $this->Mnews_class->count(['parent_id' => $class_id]);
            if($have_son){
                unset($where['news_class_id']);
                $where['or'] = ['parent_class_id' => $class_id,'news_class_id' => $class_id];
            }
            $where['is_show'] = 1;
            $data['class_id'] = $class_id;
        }
        if($parent_class_id){
            $data['parent_class_id'] = $parent_class_id;
            $where['parent_class_id'] = $parent_class_id;
            if(isset($where['class_id'])){
                unset($where['class_id']);
            }
        }
        
        //获取当前面包屑导航
        $now_class = $this->Mnews_class->get_one('id,parent_id,name',['is_del' => 0, 'id' => $class_id]);
        if($now_class){
            $parent = $this->Mnews_class->get_one('id,name',['is_del' => 0, 'id' => $now_class['parent_id']]);
            if($parent){
                $data['now_class'][0] = $parent;
                $data['now_class'][1] = $now_class;
            }else{
                $data['now_class'][0] = $now_class;
            } 
        }
        
        //获取发布者数据
        $admin = $this->Madmins->get_lists('id, fullname');
        $data['admin'] = array_column($admin, 'fullname', 'id');
        
        //获取资讯banner推荐数据
        $data['banner'] = $this->Mnews->get_lists('id, cover_img', array('is_del'=>0, 'is_show' => 1, 'is_recommend'=>1), $order_by, 4);
        if($this->input->is_ajax_request()){
            $page = $this->input->post('page');
            if($page){
                $ajax_data = $this->Mnews->get_lists('*', $where, $order_by, 5, ($page-1)*5);
                if($ajax_data){
                    foreach ($ajax_data as $k=>$v){
                        $ajax_data[$k]['cover_img'] = get_img_url($v['cover_img']);
                        $ajax_data[$k]['publisher'] = $data['admin'][$v['create_user']];
                    }
                }
            }else{
                $ajax_data = 0;
            }
            $this->return_json($ajax_data);
        }else{
            $data['lists'] = $this->Mnews->get_lists('*', $where, $order_by, 5);
            if($data['lists']){
                $data['exist'] = true; 
            }else{
                $data['exist'] = false;
            }
        }
        
        $data['header_show'] = 1;
        
        //获取走进百年数据
        $data['class_list'] = $this->Mnews_class->get_lists('id, name', array('parent_id'=>1, 'is_del'=>0));
        $default_where['is_del'] = 0;
        $default_where['is_show'] = 1;
        $order_by['publish_time'] = 'desc';
        
        $bainian = array_column($data['class_list'], 'id');
        if($bainian){
            $default_where['in'] = array('news_class_id'=>$bainian);
        }
        $data['bainian_list'] = $this->Mnews->get_lists('id, title, summary, cover_img', $default_where, $order_by, 5);
        
        
        //获取米兰数据
        $data['milan_class_list'] = $this->Mnews_class->get_lists('id, name', array('parent_id'=>2, 'is_del'=>0));
        
        $milan_where['is_del'] = 0;
        $milan_where['is_show'] = 1;
        
        $milan_id = array_column( $data['milan_class_list'], 'id');
        if($milan_id){
            $milan_where['in'] = array('news_class_id'=>$milan_id);
        }
        $data['milan_list'] = $this->Mnews->get_lists('id, title, summary, publish_time', $milan_where, $order_by, 5);
        
        $this->load->view('news/index', $data);
    }
    
    public function detail($id = 0){
        $data = $this->data;
        $data['action'] = 'news';
        $id = intval($id);
        if($id === 0){
            redirect(C('domain.base.url'));
        }
        //判断已经评论的次数
        $have = (int) $this->session->userdata('art_'.$id);
        if($have && $have > 2){
            $data['have_two'] = 1;
        }
        $where['is_del'] = 0;
        $order_by['publish_time'] = 'desc';
        //只显示走进百年和米兰婚礼标签
        $data['tags'] = $this->Mnews_class->get_lists('id, parent_id, name', $where);
        
        $data['info'] = $this->Mnews->get_one('*', array('id'=>$id, 'is_show' => 1, 'is_del' => 0));
        if(isset($data['info']['id'])){
            $data['info']['content'] = get_full_content_img_url($data['info']['content']);
            //获取阅读数量
            $add_data =  $data['info']['read']+1;
            $data['info']['read'] = $data['info']['read']+1;
            $add = $this->Mnews->update_info(array('read'=>$add_data), array('id'=>$id));

        }else{
            redirect($data['domain']['base']['url'].'/news');
        }
        
        //获取当前面包屑导航
        $class_ids = [
            $data['info']['parent_class_id'],
            $data['info']['news_class_id']
        ];
        $now_class = $this->Mnews_class->get_lists('id,name',['is_del' => 0, 'in' => ['id' => $class_ids]]);
        if($now_class){
            $data['now_class'] = $now_class;
        }
         
        //获取上一篇下一篇文章
        $data['next'] = $this->Mnews->get_lists('id, title', array('is_del'=>0, 'is_show' => 1, 'news_class_id'=>$data['info']['news_class_id'], 'id>'=>$id), 0 ,1);
        $order_by['id'] = 'desc';
        $data['before'] = $this->Mnews->get_lists('id, title', array('is_del'=>0, 'is_show' => 1, 'news_class_id'=>$data['info']['news_class_id'], 'id<'=>$id), $order_by ,1);

        //获取走进百年数据
        $data['class_list'] = $this->Mnews_class->get_lists('id, name', array('parent_id'=>1, 'is_del'=>0));
        $default_where['is_del'] = 0;
        $default_where['is_show'] = 1;
        $order_by['publish_time'] = 'desc';
        
        $bainian = array_column($data['class_list'], 'id');
        if($bainian){
            $default_where['in'] = array('news_class_id'=>$bainian);
        }
        $data['bainian_list'] = $this->Mnews->get_lists('id, title, summary, cover_img', $default_where, $order_by, 5);
        
        
        //获取米兰数据
        $data['milan_class_list'] = $this->Mnews_class->get_lists('id, name', array('parent_id'=>2, 'is_del'=>0));
        
        $milan_where['is_del'] = 0;
        $milan_where['is_show'] = 1;
        
        $milan_id = array_column( $data['milan_class_list'], 'id');
        if($milan_id){
            $milan_where['in'] = array('news_class_id'=>$milan_id);
        }
        $data['milan_list'] = $this->Mnews->get_lists('id, title, summary, publish_time', $milan_where, $order_by, 5);
        
        $data['header_show'] = 1;
        //读取文章评论,一级评论//取12条
        $total_count = $this->Mnews_comment->count(['news_id' => $id, 'is_del' => 0, 'news_comment_id' => 0]);
        if(!empty($total_count) && $total_count > 12){
            $data['total_page'] = ceil($total_count/12);
        }
        $say = $this->Mnews_comment->get_lists('*', ['news_id' => $id, 'is_del' => 0, 'news_comment_id' => 0], ['zan_count' => 'desc','create_time' => 'desc'], 12);
        if($say){
            $user_ids = array_column($say, 'user_id');
            $user = $this->Muser->get_lists('id,realname,head_img,nickname', ['is_del'=> 0, 'is_limit' => 0, 'in' => array('id' => $user_ids)]);
            if($user){
                foreach ($say as $k => $v){
                    foreach ($user as $kk => $vv){
                        if($vv['id'] == $v['user_id']){
                            $say[$k]['realname'] = $vv['realname'] ? : $vv['nickname'];
                            $say[$k]['head_img'] = !empty($vv['head_img']) ? $vv['head_img'] : $data['domain']['static']['url'].'/wap/images/touxiang.png';
                        }
                    }
                    $say[$k]['create_time'] = $this->deal_time($v['create_time']);
                }
            }
            //拼接二级评论
            $news_comment_ids = array_column($say, 'id');
            $say_er = $this->Mnews_comment->get_lists('*', ['news_id' => $id, 'is_del' => 0, 'in' => array('news_comment_id' => $news_comment_ids)], ['zan_count' => 'desc','create_time' => 'desc']);
            if($say_er){
                $user = $this->Muser->get_lists('id,realname,head_img,nickname', ['is_del'=> 0, 'is_limit' => 0]);
                if($user){
                    foreach ($say_er as $k => $v){
                        $say_er[$k] =$v;
                        foreach ($user as $kk => $vv){
                            if($vv['id'] == $v['user_id']){
                                $say_er[$k]['realname'] = $vv['realname'] ? : $vv['nickname'];
                                $say_er[$k]['head_img'] = !empty($vv['head_img']) ? $vv['head_img'] : $data['domain']['static']['url'].'/wap/images/touxiang.png';
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
        
        $this->load->view('/news/detail', $data);
    }
    
    /**
     * 一级评论和二级评论
     */
    public function say(){
        $data = $this->data;
        if(!isset($data['user_info'])){
            $this->return_json(['code' => -1, 'info' => '请先登陆']);
        }
        $add = [];
        $add['news_id'] = $this->input->post('news_id');
        $add['user_id'] = $this->input->post('user_id');
        $add['content'] = trim($this->input->post('content'));
        $news_comment_id = (int) $this->input->post('news_comment_id');
        $have = (int) $this->session->userdata('art_'.$add['news_id']);
        if($have && $have > 2 && $news_comment_id == 0){
            //判断验证码
            $code = (int) $this->input->post('article_code');
            if(!$code){
                $this->return_json(['code' => -2, 'info'=>'验证码不能为空']);
            }else{
                $v_code = $this->session->userdata(md5('article_'.$add['news_id']));
                if($code != $v_code){
                    $this->return_json(['code' => -3, 'info' => '验证码不正确']);
                }
            }
        }
        $haves = (int) $this->session->userdata('say_'.$news_comment_id);
        if($haves && $haves > 2){
            //判断验证码
            $code = (int) $this->input->post('sec_code');
            if(!$code){
                $this->return_json(['code' => -2, 'info'=>'验证码不能为空']);
            }else{
                $v_code = $this->session->userdata(md5('say_'.$news_comment_id));
                if($code != $v_code){
                    $this->return_json(['code' => -3, 'info' => '验证码不正确']);
                }
            }
        }
        if($news_comment_id){
            $add['news_comment_id'] = $news_comment_id;
        }
        $add['create_time'] = date('Y-m-d H:i:s');
        $res = $this->Mnews_comment->create($add);
        if(!$res){
            $this->return_json(['code' => 0, 'info' => '评论失败']);
        }
        $post = $this->input->post();
        $post['content'] = trim($this->input->post('content'));
        if(isset($post['news_comment_id'])){
            $post['news_comment_id'] = $res;
            //二级评论
            $haves = (int) $this->session->userdata('say_'.$news_comment_id);
            if(empty($haves)){
                $this->session->set_userdata(['say_'.$news_comment_id => 1]);
            }else{
                $this->session->set_userdata(['say_'.$news_comment_id => $haves+1]);
            }
            $this->load->view('news/load_sec', $post);
        }else{
            //一级评论
            $have = (int) $this->session->userdata('art_'.$add['news_id']);
            if(empty($have)){
                $this->session->set_userdata(['art_'.$add['news_id'] => 1]);
            }else{
                $this->session->set_userdata(['art_'.$add['news_id'] => $have+1]);
            }
            $post['news_comment_id'] = $res;
            $this->load->view('news/load', $post);
        }
        
    }
    
    /*
     * 检测是否添加验证码
     */
    public function check_code_status(){
        if(IS_POST){
            //判断已经评论的次数
            $id = (int) $this->input->post('id');
            $have = (int) $this->session->userdata('art_'.$id);
            if($have && $have > 2){
                $this->load->view('news/code',['id' => $id]);
            }else{
                $this->return_json(0);
            }
        }else{
            $this->return_json(0);
        }
    }
    
    public function check_sec_code(){
        if(IS_POST){
            //判断已经评论的次数
            $id = (int) $this->input->post('id');
            $have = (int) $this->session->userdata('say_'.$id);
            if($have && $have > 2){
                $this->load->view('news/sec_code',['id' => $id]);
            }else{
                $this->return_json(0);
            }
        }else{
            $this->return_json(0);
        }
    }
    
    /**
     * 文章详情页的一级评论分页
     */
    public function get_page(){
        $data = $this->data;
        $page= (int) $this->input->get('page');
        $id = (int) $this->input->get('id');
        if(!$id){
            $this->return_json('nodata');
        }
        $data['id'] = $id;
        //判断已经评论的次数
        $have = (int) $this->session->userdata('art_'.$id);
        if($have && $have > 2){
            $data['have_two'] = 1;
        }
        $size = 12;
        if(!$page){
            $page = 1;
        }
        //读取文章评论,一级评论//取12条
        $total_count = $this->Mnews_comment->count(['news_id' => $id, 'is_del' => 0, 'news_comment_id' => 0]);
        if(!empty($total_count) && $total_count > 12){
            $data['total_page'] = ceil($total_count/12);
        }
        $say = $this->Mnews_comment->get_lists('*', ['news_id' => $id, 'is_del' => 0, 'news_comment_id' => 0], ['zan_count' => 'desc','create_time' => 'desc'], $size,($page-1)*$size);
        if($say){
            $user_ids = array_column($say, 'user_id');
            $user = $this->Muser->get_lists('id,realname,head_img,nickname', ['is_del'=> 0, 'is_limit' => 0, 'in' => array('id' => $user_ids)]);
            if($user){
                foreach ($say as $k => $v){
                    foreach ($user as $kk => $vv){
                        if($vv['id'] == $v['user_id']){
                            $say[$k]['realname'] = $vv['realname'] ? : $vv['nickname'];
                            $say[$k]['head_img'] = !empty($vv['head_img']) ? $vv['head_img'] : $data['domain']['static']['url'].'/wap/images/touxiang.png';
                        }
                    }
                    $say[$k]['create_time'] = $this->deal_time($v['create_time']);
                }
            }
            //拼接二级评论
            $news_comment_ids = array_column($say, 'id');
            $say_er = $this->Mnews_comment->get_lists('*', ['news_id' => $id, 'is_del' => 0, 'in' => array('news_comment_id' => $news_comment_ids)], ['zan_count' => 'desc','create_time' => 'desc']);
            if($say_er){
                $user = $this->Muser->get_lists('id,realname,head_img,nickname', ['is_del'=> 0, 'is_limit' => 0]);
                if($user){
                    foreach ($say_er as $k => $v){
                        $say_er[$k] =$v;
                        foreach ($user as $kk => $vv){
                            if($vv['id'] == $v['user_id']){
                                $say_er[$k]['realname'] = $vv['realname'] ? : $vv['nickname'];
                                $say_er[$k]['head_img'] = !empty($vv['head_img']) ? $vv['head_img'] : $data['domain']['static']['url'].'/wap/images/touxiang.png';
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
            $this->load->view('news/page', $data);
        }else{
            $this->return_json('nodata');
        }
    }
    
    public function sec_page(){
        $page= (int) $this->input->get('page');
        $id = (int) $this->input->get('id');
        if(!$id){
            $this->return_json('nodata');
        }
        $size = 6;
        if(!$page){
            $page = 1;
        }
        //读取文章评论,一级评论//取12条
        $total_count = $this->Mnews_comment->count(['is_del' => 0, 'news_comment_id =' => $id]);
        if(!empty($total_count) && $total_count > 12){
            $data['total_page'] = ceil($total_count/12);
        }
        $say_er = $this->Mnews_comment->get_lists('*', ['is_del' => 0, 'news_comment_id ' => $id], ['zan_count'=> 'desc','create_time' => 'desc'], $size,($page-1)*$size);
        if($say_er){
            $user_ids = array_unique(array_column($say_er, 'user_id'));
            $user = $this->Muser->get_lists('id,realname,head_img,nickname', ['in' => ['id' => $user_ids],'is_del'=> 0, 'is_limit' => 0]);
            if($user){
                foreach ($say_er as $k => $v){
                    $say_er[$k] =$v;
                    foreach ($user as $kk => $vv){
                        if($vv['id'] == $v['user_id']){
                            $say_er[$k]['realname'] = $vv['realname'] ? : $vv['nickname'];
                            $say_er[$k]['head_img'] = !empty($vv['head_img']) ? $vv['head_img'] : $data['domain']['static']['url'].'/wap/images/touxiang.png';
                        }
                    }
                    $say_er[$k]['create_time'] = date('Y-m-d H:i', strtotime($v['create_time']));
                }
            }
            $data['say'] = $say_er;
            //加载模板
            $this->load->view('news/loop_sec', $data);
        }else{
            $this->return_json('nodata');
        }
        
        
        
    }
    
    /**
     * 后台用于预览的控制器
     * @param number $id
     */
    public function show_for_admin($id = 0){
        $data = $this->data;
        $data['action'] = 'news';
        $id = intval($id);
        if($id === 0){
            redirect(C('domain.base.url'));
        }
        $data['info'] = $this->Mnews->get_one('*', array('id'=>$id));
        if(isset($data['info']['id'])){
            $data['info']['content'] = get_full_content_img_url($data['info']['content']);
            //获取阅读数量
            $add_data =  $data['info']['read']+1;
            $data['info']['read'] = $data['info']['read']+1;
            $add = $this->Mnews->update_info(array('read'=>$add_data), array('id'=>$id));
    
        }else{
            redirect($data['domain']['base']['url'].'/news');
        }
         
        //获取上一篇下一篇文章
        $data['next'] = $this->Mnews->get_lists('id, title', array( 'news_class_id'=>$data['info']['news_class_id'], 'id>'=>$id), 0 ,1);
        $order_by['id'] = 'desc';
        $data['before'] = $this->Mnews->get_lists('id, title', array( 'news_class_id'=>$data['info']['news_class_id'], 'id<'=>$id), $order_by ,1);
    
        //获取备婚攻略数据
        $custom_class_id = C('public.news.bak.id');
        $data['custom'] = $this->Mnews->get_lists('id, summary, title', array('news_class_id'=>$custom_class_id), $order_by, 4);
    
        //获取非常婚礼数据
        $diomand_class_id = C('public.news.marriage.id');
        $data['diamond'] = $this->Mnews->get_lists('id, summary, title', array('news_class_id'=>$diomand_class_id), $order_by, 4);
    
        //获取标签数据
        $where['is_del'] = 0;
        $data['tags'] = $this->Mnews_class->get_lists('id, name', $where);
    
        $this->load->view('/news/detail', $data);
    }
    
    
    /**
     * 评论点赞
     */
    public  function get_ajax_zan(){
        if($this->input->is_ajax_request()){
            $id = intval($this->input->post("id"));
            if($this->check_pdz_token($id))
            {
                $return_arr['status'] =-1;
            }
            else{
                $this->set_token_pdz($id);
                $this->Mnews_comment->update_info(['incr' => ["zan_count"=> 1] ],array("id"=>$id));
                $return_arr['status'] = 0;
            }
            $this->return_json($return_arr);
    
        }
    }
    
    /**
     * 文章点赞
     */
    public function article_zan(){
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
    
    /*
     * 验证码
     * yonghua@gz-zc.cn
     */
    public function code($id="0", $type="article"){
        $this->load->library('valicode');
        $str = md5($type.'_'.$id);
        $this->valicode->outImg($str);
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
    
    public function show(){
        show_404();
    }
    
}

