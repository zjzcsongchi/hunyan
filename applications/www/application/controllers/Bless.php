<?php 
defined('BASEPATH') or exit('No direct script access allowed');
class Bless extends MY_Controller{
    //每页显示数量
    private $pagesize;
    public function __construct(){
        parent::__construct();
        $this->load->model([
                'Model_bless' => 'Mbless',
                'Model_dinner' => 'Mdinner',
                'Model_user' => 'Muser',
                'Model_flower' => 'Mflower',
                'Model_admins' => 'Madmins',
                'Model_cake' => 'Mcake'
        ]);
         
    }


    public function index() {
        $data = $this->data;
        $dinner_id = intval($this->input->get('id'));
        
        if($dinner_id == C('own_party.party.id')){
            redirect(C('domain.base.url') . '/bless/cake');
        }
        
        $data['dinner_id'] = $dinner_id;
        
        //祝福语获赞数top2
        $data['thumbup'] = $this->Mbless->get_lists('id, user_id, zan_count', array('is_del' => 0, 'zan_count >' => 0, 'dinner_id' => $dinner_id), array('zan_count' => 'desc') ,2);
        $thumb_user_ids = array_column($data['thumbup'], 'user_id');
        
        $data['comment'] = $this->Mbless->get_lists('*', array('dinner_id' => $dinner_id, 'is_del' => 0), array('create_time' => 'desc'), 8);

        if($data['comment']){
            //从user表获取祝福留言用户的头像，昵称
            $user_ids = array_column($data['comment'], 'user_id');
            $user_ids = array_merge($user_ids, $thumb_user_ids);
            $user_info = $this->Muser->get_lists('id, nickname, realname,head_img', array('in' => array('id' => !empty($user_ids) ? $user_ids : '')));
            $user_info = array_column($user_info, null, 'id');
            foreach ($data['comment']  as $k => $v){
                $name = '匿名';
                if(!empty($user_info[$v['user_id']]['realname'])){
                    $name = $user_info[$v['user_id']]['realname'];
                }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                    $name = $user_info[$v['user_id']]['nickname'];
                }
                $data['comment'][$k]['name'] = $name;
                $data['comment'][$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
                $data['comment'][$k]['time'] = $this->deal_time($data['comment'][$k]['create_time']);
            }
            $data['last_id'] = $data['comment'][0]['id'];
        }else{
            $data['last_id'] = 0;
        }
        
        //祝福语获赞数top2 获取该user_id的用户名
        if ($data['thumbup']) {
            foreach ($data['thumbup']  as $k => $v){
                $name = '匿名';
                if(!empty($user_info[$v['user_id']]['realname'])){
                    $name = $user_info[$v['user_id']]['realname'];
                }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                    $name = $user_info[$v['user_id']]['nickname'];
                }
                $data['thumbup'][$k]['name'] = $name;
                $data['thumbup'][$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
            
            }
        }

                
        //获取祝福条数
        $data['bless_count'] = $this->Mbless->count(array('dinner_id' => $dinner_id, 'is_del' => 0));
        //获取封面图和结婚人姓名,共点赞的次数，共收到的鲜花
        $data['bless_info'] = $this->Mdinner->info($dinner_id);
        
        //获取温馨提示
        $data['tips'] = C('bless_tips');
        //送花排行
        $flower_up = $this->get_flower_up($dinner_id);
        $flower_up && $data['flower_up'] = $flower_up;
       
        $this->load->view('bless/bless',$data);
    }
    
    public function update_comment() {
        $data = array();
        $data_domain = $this->data['domain'];
        if($this->input->is_ajax_request()){
            $dinner_id = intval($this->input->post('dinner_id'));
            $last_id = intval($this->input->post('last_id'));
            $flower_last_id = intval($this->input->post('flower_last_id'));
            $comment = $this->Mbless->get_lists('*', array('dinner_id' => $dinner_id, 'is_del' => 0, 'id >' => $last_id), array('create_time' => 'asc'), 1);
            //暂时没有新留言，不用刷新
            
            //祝福语获赞数top2
            $data['thumbup'] = $this->Mbless->get_lists('id, user_id, zan_count', array('is_del' => 0, 'zan_count >' => 0, 'dinner_id' => $dinner_id), array('zan_count' => 'desc') ,2);
            $thumb_user_ids = array_column($data['thumbup'], 'user_id');
            
            //从user表获取祝福留言用户的头像，昵称
            $user_ids = array_column($comment, 'user_id');
            if(!empty($user_ids) || !empty($thumb_user_ids)){
                $user_ids = array_merge($user_ids, $thumb_user_ids);
                $user_info = $this->Muser->get_lists('id, nickname, realname,head_img', array('in' => array('id' => $user_ids)));
                $user_info = array_column($user_info, null, 'id');
            }
            if($comment){
    
                foreach ($comment  as $k => $v){
                    $name = '匿名';
                    if(!empty($user_info[$v['user_id']]['realname'])){
                        $name = $user_info[$v['user_id']]['realname'];
                    }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                        $name = $user_info[$v['user_id']]['nickname'];
                    }
                    $name = $this->format_name_length($name, 10);
                    $comment[$k]['name'] = $name;
                    $comment[$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
                    $comment[$k]['time'] = $this->deal_time($comment[$k]['create_time']);
                }
                $data['comment'] = $comment;
                
                $count = $this->Mbless->count(array('dinner_id' => $dinner_id, 'is_del' => 0));
                $data['count'] = $count;
                $data['last_id'] = isset($comment[0]['id']) ? $comment[0]['id'] : $last_id;
            }
            
            //获取祝福条数
            $data['bless_count'] = $this->Mbless->count(array('dinner_id' => $dinner_id, 'is_del' => 0));
            //更新共点赞的次数，共收到的鲜花
            $data['bless_info'] = $this->Mdinner->get_one('zan_count, flower_count', array('id'=>$dinner_id));
            //祝福语获赞数top2 获取该user_id的用户名
            if ($data['thumbup']) {
                foreach ($data['thumbup']  as $k => $v){
                    $name = '匿名';
                    if(!empty($user_info[$v['user_id']]['realname'])){
                        $name = $user_info[$v['user_id']]['realname'];
                    }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                        $name = $user_info[$v['user_id']]['nickname'];
                    }
                    $name = $this->format_name_length($name);
                    $data['thumbup'][$k]['name'] = $name;
                    $data['thumbup'][$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
                
                }
            }
            
            //送花
            $flower = $this->get_flower($dinner_id, $flower_last_id);
            $flower && $data['flower'] = $flower;
            

            //送花排行
            $flower_up = $this->get_flower_up($dinner_id);
            $flower_up && $data['flower_up'] = $flower_up;

            $this->return_success($data);
           
        }
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
            $time_text = '刚刚';
        }
    
        return $time_text;
    }
    
    /**
     * 获取最新送花数量
     * @author chaokai@gz-zc.cn
     */
    private function get_flower($dinner_id, $last_id = 0){
        $where = array('dinner_id' => $dinner_id);
        if($last_id){
            $where['id >'] = $last_id;
        }
        
        $order_by = 'id asc';
        
        $flower = $this->Mflower->get_one('*', $where, $order_by);
        if(!$flower){
            return false;
        }
        $flower['last_id'] = $flower['id'];
        //送花用户信息
        $user_id = $flower['user_id'];
        $user_info = $this->Muser->get_one('id,nickname,realname,head_img', array('id' => $user_id));
        $flower['name'] = $user_info['realname'] ? : $user_info['nickname'];
        $flower['name'] = $flower['name'] ? : '匿名';
        $flower['name'] = $this->format_name_length($flower['name'], 4);
        $flower['head_img'] = $user_info['head_img'] ? get_img_url($user_info['head_img']) : $this->data['domain']['static']['url'].'/www/images/touxiang.png';
        return $flower;
    }
    
    /**
     * 鲜花排行榜
     * @author chaokai@gz-zc.cn
     */
    private function get_flower_up($dinner_id){
        $field = 'user_id,sum(num) as flower_num';
        $where = array('dinner_id' => $dinner_id, 'is_del' => 0);
        $order_by = array('flower_num' => 'desc');
        $group_by = array('user_id');
        
        $list = $this->Mflower->get_lists($field, $where, $order_by, 3, 0, $group_by);
        
        if(!$list){
            return false;
        }
        
        //鲜花榜用户信息
        $user_ids = array_column($list, 'user_id');
        $user = $this->Muser->get_users($user_ids);
        
        foreach($list as $k => $v){
            foreach ($user as $key => $value){
                if($v['user_id'] == $value['id']){
                    $list[$k]['name'] = $this->format_name_length($value['name']);
                    $list[$k]['head_img'] = $value['head_img'];
                }
            }
        }
        
        return $list;
    }
    
    /**
     * 姓名长度限制
     * @author louhang@gz-zc.cn
     */
    public function format_name_length($name, $max_length = 6){
        if(!empty($name)){
            if(mb_strlen($name, 'utf8')> $max_length){
                $name = mb_substr($name, 0, $max_length, 'utf-8'). '...';
            }
        }
        return $name;
    }
    
    
    /**
     * 送蛋糕
     * @author songchi@gz-zc.cn
     */
    public function cake(){
        $data = $this->data;
        //获取本月寿星
        $birth_role = $this->Madmins->get_birthday_girl();
        $birth_admin_id = array_column($birth_role, 'id');
        $birth_admin_name = array_column($birth_role, 'fullname', 'id');
        $role = array();
        foreach ($birth_role as $k=>$v){
            $role[$v['id']] = $v;
        }
        
        $data['role'] = $role;
        //获取寿星收到的蛋糕
        
        $cake_count = $this->Mcake->count_cake($birth_admin_id, array('all_num'=>'desc'));
        foreach ($birth_role as $k => $v){
            foreach ($cake_count as $key => $value){
                if($v['id'] == $value['admin_id']){
                    $birth_role[$k]['all_num'] = $value['all_num'];
                }
            }
        }
        foreach ($birth_role as $k => $v){
            if(!isset($v['all_num'])){
                $birth_role[$k]['all_num'] = 0;
            }
        }
        //重新排序
        $temp_arr = array();
        foreach ($birth_role as $k => $v){
            $temp_arr[$k] = $v['all_num'];
        }
        
        array_multisort($temp_arr, SORT_DESC, $birth_role);
        
        $data['birth_role'] = $birth_role;
        $all_cake = 0;
        foreach ($cake_count as $k=>$v){
            //计算总蛋糕数
            $all_cake += $v['all_num'];
            $cake_count[$k]['fullname'] = isset($birth_admin_name[$v['admin_id']]) ?$birth_admin_name[$v['admin_id']]:'';
        }
        
        $data['cake_count'] = array_column($cake_count, null, 'admin_id');
        $data['all_cake'] = $all_cake;
        
        
        //获取评论
        $data['comment'] = $this->Mbless->get_lists('*', array('dinner_id' => C('own_party.party.id'), 'is_del' => 0), array('create_time' => 'desc'), 5);

        if($data['comment']){
            //从user表获取祝福留言用户的头像，昵称
            $user_ids = array_column($data['comment'], 'user_id');
            $user_info = $this->Muser->get_lists('id, nickname, realname, head_img', array('in' => array('id' => !empty($user_ids) ? $user_ids : '')));
            $user_info = array_column($user_info, null, 'id');
            
            foreach ($data['comment']  as $k => $v){
                $name = '匿名';
                if(!empty($user_info[$v['user_id']]['realname'])){
                    $name = $user_info[$v['user_id']]['realname'];
                }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                    $name = $user_info[$v['user_id']]['nickname'];
                }
                $data['comment'][$k]['name'] = $name;
                $data['comment'][$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
                $data['comment'][$k]['time'] = $this->deal_time($data['comment'][$k]['create_time']);
            }
            $data['last_id'] = $data['comment'][0]['id'];
        }else{
            $data['last_id'] = 0;
        }
        $data['dinner_id'] = C('own_party.party.id');
        
        //获取封面图和结婚人姓名,共点赞的次数，共收到的鲜花
        $data['bless_info'] = $this->Mdinner->info(C('own_party.party.id'));

        $this->load->view('bless/cake', $data);
    }
    
    
    
    public function update_cake_comment() {
        $data = array();
        $data_domain = $this->data['domain'];
        if($this->input->is_ajax_request()){
            $dinner_id = intval($this->input->post('dinner_id'));
            $last_id = intval($this->input->post('last_id'));
            $flower_last_id = intval($this->input->post('flower_last_id'));
            $cake_last_id = intval($this->input->post('cake_last_id'));
            $comment = $this->Mbless->get_lists('*', array('dinner_id' => C('own_party.party.id'), 'is_del' => 0, 'id >' => $last_id), array('create_time' => 'asc'), 1);

            //从user表获取祝福留言用户的头像，昵称
            $user_ids = array_column($comment, 'user_id');
            if(!empty($user_ids)){
                $user_info = $this->Muser->get_lists('id, nickname, realname,head_img', array('in' => array('id' => $user_ids)));
                $user_info = array_column($user_info, null, 'id');
            }
            if($comment){
    
                foreach ($comment  as $k => $v){
                    $name = '匿名';
                    if(!empty($user_info[$v['user_id']]['realname'])){
                        $name = $user_info[$v['user_id']]['realname'];
                    }else if(!empty($user_info[$v['user_id']]['nickname'])) {
                        $name = $user_info[$v['user_id']]['nickname'];
                    }
                    $name = $this->format_name_length($name, 10);
                    $comment[$k]['name'] = $name;
                    $comment[$k]['head_img'] = isset($user_info[$v['user_id']]['head_img']) && !empty($user_info[$v['user_id']]['head_img'])? get_img_url($user_info[$v['user_id']]['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
                    $comment[$k]['time'] = $this->deal_time($comment[$k]['create_time']);
                }
                $data['comment'] = $comment;
    
                $count = $this->Mbless->count(array('dinner_id' => $dinner_id, 'is_del' => 0));
                $data['count'] = $count;
                $data['last_id'] = isset($comment[0]['id']) ? $comment[0]['id'] : $last_id;
            }
    
            //获取祝福条数
            $data['bless_count'] = $this->Mbless->count(array('dinner_id' => $dinner_id, 'is_del' => 0));
            //更新共点赞的次数，共收到的鲜花
            $data['bless_info'] = $this->Mdinner->get_one('zan_count, flower_count', array('id'=>$dinner_id));
            
            //送花
            $flower = $this->get_flower($dinner_id, $flower_last_id);
            $flower && $data['flower'] = $flower;
            
            //蛋糕数据
            $cake = $this->get_cake($cake_last_id, $dinner_id);
            $cake && $data['cake'] = $cake;
            
            
            $birth_role = $this->Madmins->get_birthday_girl();
            $birth_admin_id = array_column($birth_role, 'id');
            //获取寿星收到的蛋糕
            $cake_new = $this->Mcake->count_cake($birth_admin_id, array('all_num'=>'desc'));
            $data['cake_count'] = $cake_new;
            
            
            //cake_rank
            $cake_count = $this->Mcake->count_cake($birth_admin_id, array('all_num'=>'desc'));
            foreach ($birth_role as $k => $v){
                foreach ($cake_count as $key => $value){
                    if($v['id'] == $value['admin_id']){
                        $birth_role[$k]['all_num'] = $value['all_num'];
                    }
                }
            }
            foreach ($birth_role as $k => $v){
                if(!isset($v['all_num'])){
                    $birth_role[$k]['all_num'] = 0;
                }
            }
            //重新排序
            $temp_arr = array();
            foreach ($birth_role as $k => $v){
                $temp_arr[$k] = $v['all_num'];
            }
            
            array_multisort($temp_arr, SORT_DESC, $birth_role);
            //解析头像
            foreach ($birth_role as $k => $v){
                $birth_role[$k]['head_img'] = !empty($v['head_img']) ? get_img_url($v['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
            }
            
            $data['cake_rank'] = $birth_role;
            $this->return_success($data);
             
        }
    }
    
    
    
    /**
     * 获取最新送花数量
     * @author chaokai@gz-zc.cn
     */
    private function get_cake($last_id = 0, $dinner_id = 0){
        $where['is_del'] = 0;
        $where['id >'] = $last_id;
        $where['dinner_id'] = $dinner_id;
        $order_by = 'id asc';
    
        $cake = $this->Mcake->get_one('*', $where, $order_by);
        if(!$cake){
            return false;
        }
        $cake['last_id'] = $cake['id'];
        //送花用户信息
        $user_id = $cake['user_id'];
        $user_info = $this->Muser->get_one('id,nickname,realname,head_img', array('id' => $user_id));
        $cake['name'] = $user_info['realname'] ? : $user_info['nickname'];
        $cake['name'] = $cake['name'] ? : '匿名';
        $cake['head_img'] = !empty($user_info['head_img']) ? get_img_url($user_info['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
        
        $roles_info = $this->Madmins->get_one('id, name, fullname, tel', array('id'=>$cake['admin_id']));
        $cake['admin_name'] = isset($roles_info['fullname']) && $roles_info['fullname'] ?$roles_info['fullname']:'';
        
        $admin = $this->Muser->get_one('id, head_img', array('mobile_phone'=>$roles_info['tel']));
        $cake['admin_head_img'] = !empty($admin['head_img']) ? get_img_url($admin['head_img']) : $this->data['domain']['static']['url'].'/www/images/user.png';
        return $cake;
    }
}

