<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller{
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model(array(
                        'Model_about_us' => 'Mabout_us',
                        'Model_news' => 'Mnews',
                        'Model_venue' => 'Mvenue',
                        'Model_dinner' => 'Mdinner',
                        'Model_theme' => 'Mtheme',
                        'Model_manual' => 'Mmanual',
                        'Model_about_us' => 'Mabout_us',
                        'Model_drink' => 'Mdrink',
                        'Model_bless' => 'Mbless',
                        'Model_flower' => 'Mflower',
                        'Model_products' => 'Mproducts',
        ));
    }
    
    /**
     * 首页
     * @author chaokai@gz-zc.cn
     */
    public function index(){
        //统计宾客数量、视频数量
        $this->count();
        $data = $this->data;
        $data['action'] = 'index';
        $type = $this->input->get('type');
        if($type){
            echo "<script>window.location.href='http://m.bai-nian.com/today'</script>";
        }
        
        //获取统计数量
        $data['yesterday_date'] = date("Y-m-d",strtotime("-1 day"));
        $data['today_date'] = date("Y-m-d");
        $data['tomorrow_date'] = date("Y-m-d",strtotime("+1 day"));
        
        //今日婚宴
        $dinner_where = array('contract_type' => 0);
        $data['dinner'] = $this->Mdinner->today($dinner_where);
        
        //统计收到的祝福条数和鲜花数
        $data['bless_num'] = $this->Mbless->count(['is_del' => 0]);
        $data['flower_num'] = $this->Mflower->count(['is_del' => 0]);
        //婚宴场馆
        $venue_where = array('is_recommend' => 1);
        $data['venue'] = $this->Mvenue->lists($venue_where);
        $data['venue'] = array_slice($data['venue'], 0, 5);//截取前五条记录
        
        //酒水批发
        $where = array('is_del' => 0);
        $drink = $this->Mproducts->get_lists('*', array('is_del'=>0, 'class_id'=>C('products.drinks_class.wine.id'), 'is_show'=>0), 0,5);
        
        $data['drink'] = $drink;
        
        //自媒体 - 推荐到首页资讯
        $filed = 'id, title, summary, agency, cover_img, create_time, publish_time';
        $where = array('is_recommend' => 1, 'is_del' => 0, 'is_show' => 1);
        $order_by = array('sort' => 'desc', 'publish_time' => 'desc');
        $data['recommend_news'] = $this->Mnews->get_lists($filed, $where, $order_by, 4);
        
        //自媒体 - 最新资讯
        $filed = 'id, title, summary, agency, cover_img, create_time, publish_time';
        $where = array('is_del' => 0, 'is_show' => 1);
        $order_by = array('publish_time' => 'desc');
        $data['recent_news'] = $this->Mnews->get_lists($filed, $where, $order_by, 4);
        
        /*****************************OLD******************************/

        //获取宴会厅
        if(!$data['dinner']) {
            $data['dinner'] = array();
        }
        $dinner_id = array_column($data['dinner'], 'id');
        if($dinner_id){
            $query['in'] = array('dinner_id'=>$dinner_id);
            $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
            $venue_lists = array_column($lists, 'venue_id');
        
            $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
            $venue_name = array_column($venue_name, 'name', 'id');
        
            foreach($lists as $k=>$v){
                if(!$v['venue_id']){
                    unset($lists[$k]);
                }
            }
            
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
        
            foreach($data['dinner'] as $k=>$v){
                foreach($lists as $key=>$val){
                    if($data['dinner'][$k]['id'] == $val['dinner_id']){
                        $data['dinner'][$k]['venue'][] = $val['venue_id'];
                    }
                }
            }
            
            $data['venue_name'] = array_column($venue, 'name', 'dinner_id');
            
        }
        
        $data['about'] = $this->Mabout_us->get_one('index_vedio_url', array('id>'=>0));
        
        $this->load->view('home/index', $data);
    }
    
    public function switch_day(){
        if($this->input->is_ajax_request()){
            $data = $this->data;
            $date = $this->input->get('date');
            $dinner_where = array();
            $data['dinner'] = $this->Mdinner->today($dinner_where, $date);
            
            //获取宴会厅
            if(!$data['dinner']) {
                echo 'nodata';exit;
            }
            $dinner_id = array_column($data['dinner'], 'id');
            if($dinner_id){
                $query['in'] = array('dinner_id'=>$dinner_id);
                $lists = $this->Mdinner_venue->get_lists('venue_id, dinner_id', $query);
                $venue_lists = array_column($lists, 'venue_id');
            
                $venue_name = $this->Mvenue->get_lists('id, name', array('is_del'=>0));
                $venue_name = array_column($venue_name, 'name', 'id');
            
                foreach($lists as $k=>$v){
                    if(!$v['venue_id']){
                        unset($lists[$k]);
                    }
                }
            
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
            
                foreach($data['dinner'] as $k=>$v){
                    foreach($lists as $key=>$val){
                        if($data['dinner'][$k]['id'] == $val['dinner_id']){
                            $data['dinner'][$k]['venue'][] = $val['venue_id'];
                        }
                    }
                }
            
                $data['venue_name'] = array_column($venue, 'name', 'dinner_id');
            }
            
            $this->load->view('home/switch_day', $data);
            
        }
    }
    
}


