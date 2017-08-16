<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Milan extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_milan_combo' => 'Mmilan_combo',
                'Model_milan_combo_service' => 'Mmilan_combo_service',
                'Model_theme' => 'Mtheme',
                'Model_news' => 'Mnews',
                        'Model_manual' => 'Mmanual',
                        'Model_following_shot' => 'Mfollowing_shot',
                        
        ]);
         
    }

    /**
     * 首页
     * @author louhang@gz-zc.cn
     */
    public function index() {
        $data = $this->data;
        $data['title'] = '今日宴会';
        $data['action'] = "today";
        
        //首页视频
        $data['manual'] = $this->Mmanual->get_one('*' ,array('is_del' => 1,'manual_class_id' => C('class.milan.id')));
        
        //米兰婚礼套餐
        $where = array('is_del' => 0);
        $order_by = array('price' => 'desc');
        $combos = $this->Mmilan_combo->get_lists('*', $where, $order_by);
        $class_name = C('combo_class');
        $class_name = array_column($class_name, null, 'id');
        foreach ($combos as $k => $v){
            $combos[$k]['class_name'] = isset($class_name[$v['id']]['class_name']) ? $class_name[$v['id']]['class_name'] : '';
        }
        $data['combos'] = $combos;
        
        //主题案例
        $where = array('is_del' => 0);
        $themes = $this->Mtheme->get_lists('id, cover_img, title', $where);
        $class_name = C('theme_class');
        $class_name = array_column($class_name, null, 'id');
        foreach ($themes as $k => $v){
            $themes[$k]['class_name'] = isset($class_name[$v['id']]['class_name']) ? $class_name[$v['id']]['class_name'] : '';
        }
        $data['themes'] = $themes;

        $this->load->view('milan/index',$data);
    }
    
    /**
     * 套餐详情
     * @author louhang@gz-zc.cn
     */
    public function combo() {
        $data = $this->data;
        $combo_id = (int)$this->input->get('id');

        $class_name = C('combo_class');
        $class_name = array_column($class_name, null, 'id');

        $data['class_name'] = isset($class_name[$combo_id]['class_name']) ? $class_name[$combo_id]['class_name'] : end($class_name)['class_name'];
        
        $where = array('id' => $combo_id, 'is_del' => 0);
        $combo = $this->Mmilan_combo->get_one('*', $where);
        $data['combo'] = $combo;
        
        $where = array('combo_id' => $combo_id, 'is_del' => 0);
        $combo_detail = $this->Mmilan_combo_service->get_lists('id, pid, name', $where);
        $combo_detail = $this->myloop($combo_detail);
        $data['combo_detail'] = $combo_detail;

        $this->load->view('milan/combo',$data);
    }
    
    /**
     * 主题案例详情
     * @author louhang@gz-zc.cn
     */
    public function case_detail() {
        $data = $this->data;
        $theme_id = (int)$this->input->get('id');
        
        //主题案例
        $where = array('id' => $theme_id, 'is_del' => 0);
        $theme = $this->Mtheme->get_one('*', $where);
        $theme['images'] = explode(',', $theme['images']);
        $data['theme'] = $theme;
        
        //关联文章
        $where = array('news_class_id' => C('news.milan.children.case.id'), 'is_del' => 0, 'is_show' => 1);
        $order_by = array();
        $news = $this->Mnews->get_lists('id, title, summary, agency, cover_img, read, zan_number', $where, $order_by, 4);
        $data['news'] = $news;

        $this->load->view('milan/case_detail',$data);
    
    }
    
    /**
     * 递归处理婚礼的类别所包含的内容
     * @author yonghua@gz-zc.cn
     */
    public function myloop($data, $parent=0){
    
        $result = array();
        if($data)
        {
            foreach($data as $key => $val)
            {
                if($val['pid'] == $parent)
                {
                    $temp = $this->myloop($data, $val['id']);
                    if($temp) $val['child'] = $temp;
                    $result[] = $val;
                }
            }
        }
        return $result;
    }
    
    /**
     * 最美跟拍 - 首页
     * @author louhang@gz-zc.cn
     */
    public function following_shot() {
        $data = $this->data;
        //首页视频
        $data['manual'] = $this->Mmanual->get_one('*' ,array('is_del' => 1,'manual_class_id' => C('class.following_shot.id')));
        
        //关联文章
        $field = 'id, title, summary, agency, cover_img, read, zan_number';
        $where = array('news_class_id' => C('news.milan.children.following_shot.id'), 'is_del' => 0, 'is_show' => 1);
        $order_by = array();
        $news = $this->Mnews->get_lists($field, $where, $order_by, 4);
        
        $first_news = $this->Mnews->get_one($field, array_merge($where, array('is_recommend' => 1)));
        if(empty($first_news)){
            $first_news = array_shift($news);
        }
        $data['news'] = $news;
        $data['first_news'] = $first_news;
        
        //最美跟拍
        $data['following_shot'] = $this->Mfollowing_shot->get_lists('id, title, cover_img', array('is_del => 0'));
        
        $this->load->view('milan/following_shot',$data);
        
    }
    
    /**
     * 最美跟拍 - 相册详情
     * @author louhang@gz-zc.cn
     */
    public function following_shot_detail() {
        $data = $this->data;
        $album_id = (int)$this->input->get('id');
        
        //最美跟拍
        $data['following_shot'] = $this->Mfollowing_shot->get_one('id, title, desc, cover_img, images', array('id' => $album_id, 'is_del => 0'));
        if($data['following_shot']){
            $data['following_shot']['images'] = explode(',', $data['following_shot']['images']);
        }
        
        $this->load->view('milan/following_shot_detail',$data);
    
    }
    
}

