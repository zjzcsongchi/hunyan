<?php 
/**
* 资讯管理控制器
* @author jianming@gz-zc.cn
*/
defined('BASEPATH') or exit('No direct script access allowed');
class News extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model([
             'Model_news' => 'Mnews',
             'Model_keywords' => 'Mkeywords',
             'Model_news_class' => 'Mnews_class',
             'Model_admins' => 'Madmins',
             'Model_user' => 'Muser',
             'Model_news_comment' => 'Mnews_comment'
        ]);
    }
    

    /**
     * 资讯列表页
     */
    public function index() {
        $data = $this->data;
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';

        $where = array();
        if ($this->input->get('title')) {
            $where['like']['title'] = $this->input->get('title');
            
        }

        if ($this->input->get('class_id')) {
            if ($this->input->get('is_has_child') == 0) {
                $where['news_class_id'] = (int)$this->input->get('class_id');
            } else {
                $where['parent_class_id'] = (int)$this->input->get('class_id');
            }
        }

        if ($this->input->get('is_del')) {
            $where['is_del'] = $this->input->get('is_del');
        } else {
            $where['is_del'] = 0;
        }

        $data['title'] = $this->input->get('title');
        $data['class_id'] = (int)$this->input->get('class_id');
        $data['is_has_child'] = $this->input->get('is_has_child');
        $data['is_del'] = $this->input->get('is_del');

        $data['news_list'] = $this->Mnews->get_lists("*", $where, array("publish_time" => "DESC"), $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        $data_count = $this->Mnews->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;

        //获取分页
        //判断是否带条件查询
        $urls= array();
        $class_id = (int) $this->input->get('class_id', TRUE);
        if(isset($class_id)){
            $urls['class_id'] = $class_id;
        }
        $is_del = (int) $this->input->get('is_del', TRUE);
        if(isset($is_del)){
            $urls['is_del'] = $is_del;
        }
        $is_has_child = (int) $this->input->get('is_has_child');
        if($is_has_child){
            $urls['is_has_child'] = $is_has_child;
        }
        $title = trim($this->input->get('title', TRUE));
        if(isset($title)){
            $urls['title'] = $title;
        }
        $pageconfig['base_url'] = "/news/index?".http_build_query($urls);
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息

        $data['class_list'] = class_loop_list(class_loop($this->Mnews_class->get_lists("id, name, parent_id", array('is_del' => 0))));
        $data['news_class'] = array_column($data['class_list'], "name", "id");
        $admins = $this->Madmins->get_lists("id,name");
        $data['admins'] = array_column($admins,"name","id");
        $this->load->view("news/index", $data);
    }


    /**
     * 发布资讯
     */
    public function add() {
    	$data = $this->data;
        if (IS_POST) {
            $post_data = $this->input->post();
            
            //剔除图片上传器创建的input
            unset($post_data['sy_rich_text_img'], $post_data['rich_text_img'], $post_data['ys_rich_text_img']);

            //写入文章资讯表t_news
            unset($post_data['file'], $post_data['SEO_title'], $post_data['SEO_keywords'], $post_data['SEO_description'], $post_data['rich_text_img']);
            $post_data['is_show'] = 0;
            $post_data['parent_class_id'] = $this->Mnews_class->get_one('parent_id', array('id' => $post_data['news_class_id']))['parent_id'];
            $post_data['create_user'] = $post_data['update_user'] = $_SESSION['USER']['id'] ? $_SESSION['USER']['id'] : 0;
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['content'] = htmlspecialchars_decode($post_data['content']); //把富文本自动转义的标签反转义后存入
            $post_data['content'] = strip_content_domain_text($post_data['content']);
            $id = $this->Mnews->create($post_data);
            if ($id) {
                //写入关键字表t_keywords
                $keywords_data['object_id'] = $id;
                $keywords_data['title'] = $this->input->post('SEO_title');
                $keywords_data['keywords'] = $this->input->post('SEO_keywords');
                $keywords_data['description'] = $this->input->post('SEO_description');
                $keywords_data['type'] = 1;
                $post_data['create_user'] = $keywords_data['update_user'] = $_SESSION['USER']['id'] ? $_SESSION['USER']['id'] : 0;
                $keywords_data['create_time'] = $keywords_data['update_time'] = date('Y-m-d H:i:s');
                $this->Mkeywords->create($keywords_data);

                $this->success("发布成功","/news");
            } else {
                $this->success("发布失败","/news");
            }
        } else {
            $data['news_class'] = class_loop_list(class_loop($this->Mnews_class->get_lists("id, name, parent_id", array('is_del' => 0))));
            $this->load->view("news/add", $data);
        }
    }



    /* 
     * 编辑资讯
     */
    public function edit($id) {
        $data = $this->data;
        $data['id'] = $id;

        if (IS_POST) {
            $post_data = $this->input->post();
            
            //剔除图片上传器创建的input
            unset($post_data['sy_rich_text_img'], $post_data['rich_text_img'], $post_data['ys_rich_text_img']);
            
            //保存文章资讯
            unset($post_data['file'], $post_data['SEO_title'], $post_data['SEO_keywords'], $post_data['SEO_description']);
            $post_data['parent_class_id'] = $this->Mnews_class->get_one('parent_id', array('id' => $post_data['news_class_id']))['parent_id'];
            $post_data['update_user'] = $_SESSION['USER']['id'] ? $_SESSION['USER']['id'] : 0;
            $post_data['update_time'] = date('Y-m-d H:i:s');
            $post_data['content'] = htmlspecialchars_decode($post_data['content']); //把富文本自动转义的标签反转义后存入
            $post_data['content'] = strip_content_domain_text($post_data['content']);
            
            $res = $this->Mnews->update_info($post_data, array("id" => $post_data['id']));
            if ($res) {
                //保存SEO关键字
                $keywords_data['title'] = $this->input->post('SEO_title');
                $keywords_data['keywords'] = $this->input->post('SEO_keywords');
                $keywords_data['description'] = $this->input->post('SEO_description');
                $keywords_data['update_user'] = $_SESSION['USER']['id'] ? $_SESSION['USER']['id'] : 0;
                $keywords_data['update_time'] = date('Y-m-d H:i:s');

                $keywords = $this->Mkeywords->get_lists("*", array("object_id" => $post_data['id']));
                if ($keywords) {
                    $this->Mkeywords->update_info($keywords_data, array("object_id" => $post_data['id']));
                } else {
                    $post_data['create_user'] = $_SESSION['USER']['id'] ? $_SESSION['USER']['id'] : 0;
                    $post_data['create_time'] = date('Y-m-d H:i:s');
                    $keywords_data['object_id'] = $id;
                    $keywords_data['type'] = 1;
                    $this->Mkeywords->create($keywords_data);
                }
                
                $this->success("修改成功","/news");
            } else {
                $this->success("修改失败，请重试！","/news");
            }
        } else {
            $data['info'] = $this->Mnews->get_one("*", array('id' => $id));
            $data['info']['content'] = get_full_content_img_url($data['info']['content']);
            $data['news_class'] = class_loop_list(class_loop($this->Mnews_class->get_lists("id, name, parent_id",array('is_del' => 0))));
            $data['keywords'] = $this->Mkeywords->get_one("*", array('object_id' => $data['info']['id']));
            $this->load->view("news/edit", $data);
        }
    }

    /*
     * 删除和取消删除资讯
     */
    public function del($id, $state) {
        $res = $this->Mnews->update_info(array('is_del' => $state), array('id' => $id));
        if ($res) {
            $this->success("操作成功！", "/news");
        } else {
            $this->success("操作失败！请重试！", "/news");
        }
    }



    /*
     * 更新发布状态
     */
    public function update_status($id, $state) {
        $res = $this->Mnews->update_info(array('is_show' => $state), array('id' => $id));
        if ($res) {
            $this->success("操作成功！", "/news");
        } else {
            $this->success("操作失败！请重试！", "/news");
        }
    }


    /**
     * 资讯类别列表
     */
    public function class_list() {
        $data = $this->data;

        $where = array();
        if ($this->input->get('name')) {
            $where['like']['name'] = $this->input->get('name');
        }

        if ($this->input->get('parent_id')) {
            $where['parent_id'] = $this->input->get('parent_id');
        }

        if ($this->input->get('is_del')) {
            $where['is_del'] = $this->input->get('is_del');
        } else {
            $where['is_del'] = 0;
        }

        $data['name'] = $this->input->get('name');
        $data['parent_id'] = $this->input->get('parent_id');
        $data['is_del'] = $this->input->get('is_del');

        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        //获取当前页页码
        $page = $this->input->get_post('per_page') ? : '1';
        $data['lists'] = $this->Mnews_class->get_lists("*", $where, array('create_time' => 'desc'), $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);  
        $data_count = $this->Mnews_class->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;

        //获取分页
        //构造带条件查询的分页
        $urls = array();
        if(isset($data['parent_id'])){
            $urls['parent_id'] = $data['parent_id'];
        }
        if(isset($data['is_del'])){
            $urls['is_del'] = $data['is_del'];
        }
        $name = trim($this->input->get('name', TRUE));
        if(isset($name)){
            $urls['name'] = $name;
        }
        $pageconfig['base_url'] = "/News/class_list?".http_build_query($urls);
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息

        //父级分类
        $data['parent_lists'] = $this->Mnews_class->get_lists("id, name", array('parent_id' => 0, 'is_del' => 0));
        $data['parent_class'] = array_column($data['parent_lists'], 'name', 'id');
        $this->load->view("news/class", $data);
    }


    /**
     * 添加资讯分类
     */
    public function add_class() {
        $data = $this->data;

        if (IS_POST) {
            $name = trim($this->input->post("name", TRUE));
            if(empty($name)){
                $this->error("分类名称不能为空！", "/news/class_list");
                exit();
            }
            $parent_id = (int) (trim($this->input->post("parent_id", TRUE)));
            if($this->check_cate_exists($name, $parent_id)){
                $this->error("分类名称已经存在！", "/news/class_list");
                exit();
            }
            $post_data = array('name' => $name, 'parent_id' => $parent_id,'is_del' => 0);
            $post_data['create_user'] = $post_data['update_user'] = 1;
            $post_data['create_time'] = $post_data['update_time'] = date('Y-m-d H:i:s');
            $id = $this->Mnews_class->create($post_data);
            if ($id) {
                $this->success("添加成功！", "/news/class_list");
            } else {
                $this->error("添加失败！请重试", "/news/class_list");
            }
        } else {
            $data['parent_class'] = $this->Mnews_class->get_lists("id, name", array('parent_id' => 0, 'is_del' => 0));
            $this->load->view("news/add_class", $data);
        }
    }

    /* 
     * 修改资讯分类
     */
    public function edit_class($id) {
        $data = $this->data;
        if (IS_POST) {
            $post_data = $this->input->post();
            $post_data['update_user'] = $_SESSION['USER']['id'] ? $_SESSION['USER']['id'] : 0;
            $post_data['update_time'] = date('Y-m-d H:i:s');
            $res = $this->Mnews_class->update_info($post_data, array('id' => $post_data['id']));
            if ($res) {
                $this->success("修改成功！", "/news/class_list");
            } else {
                $this->success("修改失败！请重试！", "/news/class_list");
            }
        } else {
            $data['id'] = $id;
            $data['parent_class'] = $this->Mnews_class->get_lists("id, name", array('parent_id' => 0));
            $data['info'] = $this->Mnews_class->get_one("*", array('id' => $id));
            $this->load->view("news/add_class", $data);
        }
    }


    /*
     * 删除资讯分类
     */
    public function del_class($id, $state) {
        $res = $this->Mnews_class->update_info(array('is_del' => $state), array('id' => $id));
        if ($res) {
            $this->success("操作成功！", "/news/class_list");
        } else {
            $this->success("操作失败！请重试！", "/news/class_list");
        }
    }
    
    /**
     * 检测分类否存在
     * @author yonghua@gz-zc.cn
     * @param string $name 分类名称
     * @parent_id 父级分类
     * @return boolean
     */
    public function check_cate_exists($name ='', $id = '')
    {
        $res = $this->Mnews_class->get_one("id", array('name' => $name, 'parent_id' => $id));
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * 查看该新闻的评论
     * @author  louhang@gz-zc.cn
     */
    public function view_comments($id) {
        $id = (int)$id;
        $data = $this->data;
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        
        $where = array('news_id' => $id);
        $data_count = $this->Mnews_comment->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;
        $data['comments_list'] = $this->Mnews_comment->get_lists("*", $where, array("create_time" => "DESC"), $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        
        //获取用户信息
        $users = array_column($data['comments_list'], 'user_id');
        if(!$users){
            $users = '';
        }
        $users = $this->Muser->get_lists('id, nickname', array('in' => array('id' => $users)));
        $users = array_column($users, null, 'id');
        foreach ($data['comments_list'] as $k => $v){
            $data['comments_list'][$k]['username'] = $users[$v['user_id']]['nickname'];
        }
        
        
        //获取分页
        //判断是否带条件查询
        $urls= array();
        $pageconfig['base_url'] = "/news/index?".http_build_query($urls);
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        
        $admins = $this->Madmins->get_lists("id,name");
        $data['admins'] = array_column($admins,"name","id");
        $this->load->view("news/comments", $data);
    }
    
    
    
    /*
     * 删除和取消删除评论
     */
    public function comment_del($id, $state) {
        $res = $this->Mnews_comment->update_info(array('is_del' => $state), array('id' => $id));
        if ($res) {
            $this->success("操作成功！");
        } else {
            $this->success("操作失败！请重试！");
        }
    }
    
    /**
     * 搜索文章
     * @author chaokai@gz-zc.cn
     */
    public function search(){
        $name = $this->input->post('name');
        !$name && $this->return_success(array());
        $field = 'id,title';
        $where = array(
                        'like' => array('title' => $name),
                        'is_del' => 0
        );
        $list = $this->Mnews->get_lists($field, $where);
        
        $this->return_success($list);
    }
    
    /**
     * 评论管理
     * @author fengyi@gz-zc.cn
     */
    public function comment_manage() {
        $data = $this->data;
        $pageconfig = C('page.config_log');
        $this->load->library('pagination');
        $page = (int)$this->input->get_post('per_page') ? : '1';
        
        $where = array('is_del' => 0);
        $data_count = $this->Mnews_comment->count($where);
        $data['data_count'] = $data_count;
        $data['page'] = $page;
        $data['comments_list'] = $this->Mnews_comment->get_lists("*", $where, ["create_time" => "DESC"], $pageconfig['per_page'], ($page-1)*$pageconfig['per_page']);
        
        //获取用户信息
        $users = array_column($data['comments_list'], 'user_id');
        if(!$users){
            $users = '';
        }
        $users = $this->Muser->get_lists('id,nickname,head_img', array('in' => array('id' => $users)));
        $users = array_column($users, null, 'id');
        foreach ($data['comments_list'] as $k => $v){
            $data['comments_list'][$k]['username'] = $users[$v['user_id']]['nickname'];
            $data['comments_list'][$k]['head_img'] = $users[$v['user_id']]['head_img'];
        }
        
        //获取资讯信息
        $news = array_column($data['comments_list'], 'news_id');
        if (!$news) {
            $news = '';
        }
        $news = $this->Mnews->get_lists('id,title,news_class_id', array('in' => array('id' => $news)));
        $news = array_column($news, null, 'id');
        foreach ($data['comments_list'] as $k => $v) {
            $data['comments_list'][$k]['news_title'] = $news[$v['news_id']]['title'];
            $data['comments_list'][$k]['news_class_id'] = $news[$v['news_id']]['news_class_id'];
        }
        $news_classes = array_column($news, 'news_class_id');
        if (!$news_classes) {
            $news_classes = '';
        }
        $news_classes = $this->Mnews_class->get_lists('id,name', array('in' => array('id' => $news_classes)));
        $news_classes = array_column($news_classes, null, 'id');       
        foreach ($data['comments_list'] as $k => $v) {
            $data['comments_list'][$k]['news_class'] = $news_classes[$v['news_class_id']]['name'];
        }
        
        //获取分页
        $urls= array();
        $pageconfig['bas_eurl'] = "/news/comment_manage?".http_build_query($urls);
        $pageconfig['total_rows'] = $data_count;
        $this->pagination->initialize($pageconfig);
        $data['pagestr'] = $this->pagination->create_links(); // 分页信息
        
        $this->load->view("news/comment_manage", $data);
    }
}

