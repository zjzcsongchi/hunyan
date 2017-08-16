<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_admins extends MY_Model {

    private $_table = 't_admins';

    public function __construct() {
        parent::__construct($this->_table);
        
        $this->load->model(array(
                        'Model_venue' => 'Mvenue',
                        'Model_user' => 'Muser'
        ));
    }

    #获得用户左侧菜单
    public function getMenus(){
        $menu = C('menu');
        $menu = $menu['menu'];
        
        if($_SESSION['USER']['id']==1) //超级管理员
        {
            $venue_list = $this->Mvenue->lists();
            foreach ($menu as $k => $v){
                if($v['code'] == 'venue_manage'){
                    foreach ($venue_list as $key => $value){
                        $menu[$k]['list'][] = array('/venue/index/'.$value['id'], $value['name']);
                    }
                    break;
                }
            }
            return $menu;
        }
        if($menu)
        {
            foreach($menu as $key=>$child)
            {

                if(in_array($child['code'], $_SESSION['USER']['purview_url'])==false)
                {
                    //过滤一级目录
                    unset($menu[$key]);
                }
                else
                {
                    if($child['list'])
                    {
                        foreach($child['list'] as $key2=>$v)
                        {
                            $url = strtolower(trim(trim($v[0]),'/'));
                            if(in_array($url,$_SESSION['USER']['purview_url'])==false)
                            {
                                //过滤二级目录
                                unset($menu[$key]['list'][$key2]);
                            }
                        }
                    }
                }
            }
        }
        #将场馆列表加入到菜单中
        $venue_list = $this->Mvenue->lists();
        if($_SESSION['USER']['type'] == C('public.type.venue.id')){
            foreach ($menu as $k => $v){
                if($v['code'] == 'venue_manage'){
                    foreach ($venue_list as $key => $value){
                        if($value['id'] == $_SESSION['USER']['venue_id']){
                            $menu[$k]['list'][] = array('/venue/index/'.$value['id'], $value['name']);
                            break;
                        }
                    }
                    break;
                }
            }
        }else{
            foreach ($menu as $k => $v){
                if($v['code'] == 'venue_manage'){
                    foreach ($venue_list as $key => $value){
                        $menu[$k]['list'][] = array('/venue/index/'.$value['id'], $value['name']);
                    }
                    break;
                }
            }
        }
        return $menu;
    }


    /*
     * 根据组id 获取对应名称
     * nengfu@gz-zc.cn
     */
    public function get_admin_list( $group_id = '' ){
         $where['is_del'] = 1;
        if($group_id){
            $where['group_id'] = $group_id;
        }
        return $this->get_lists("id,fullname",$where);
    }



    /*
     * 获得组管理员数量
     * nengfu@gz-zc.cn
     */
    public function get_admin_count($group_id=''){
        $where['is_del'] = 1;
        if($group_id !='')
        {
            $where['group_id'] = $group_id;
        }
        return $this->count($where);
    }

    /*
    * 判断用户名是否存在
    * nengfu@gz-zc.cn
    */
     public  function is_exist_adminname($name = ""){
         if(empty($name)) return '';
         $where['is_del'] = 1;
         $where['name'] = $name;
         return  $count = $this->count($where);
     }


    #删除权限
    public function del_purview( $purviews, $purview_del ){

        #如果组没有权限，直接返回
        if(empty($purview_del))
        {
            return $purviews;
        }
        else
        {
            $purviews = explode(',',$purviews);
            $purview_del = explode(',',$purview_del);
            foreach($purviews as $key=>$id)
            {
                #逐个删除
                if(in_array($id,$purview_del))
                {
                    unset($purviews[$key]);
                }
            }
        }
        return implode(',',$purviews);
    }


    #同步到相关人员权限
    public function setDiffPurview( $group_id, $del_diff, $add_diff ){

        #管理员列表
        $Adminss = $this->get_lists("id,purview_ids",array("is_del"=>1,"group_id"=>$group_id));
//        echo $this->db->last_query();
//        print_r($Adminss);
        if($Adminss)
        {
            foreach($Adminss as $v)
            {
                $purview_ids = array();
                if($v['purview_ids'])
                {
                    $purview_ids = explode(',',$v['purview_ids']);
                    #删除旧权限
                    if($del_diff)
                    {
                        foreach($del_diff as $val)
                        {
                            $exist = array_search($val, $purview_ids);
                            if($exist!==false)
                            {
                                unset($purview_ids[$exist]);
                            }
                        }
                    }
                }

                #添加新权限
                $purview_ids = array_merge($purview_ids,$add_diff);
                $purview_ids = implode(',',$purview_ids);

                $this->update_info(array("purview_ids"=>$purview_ids),array('id'=>$v['id']));
            }
        }
    }
    
    /**
     * 查询本月寿星
     * @author chaokai@gz-zc.cn
     */
    public function get_birthday_girl(){
        
        $month = date('m');
        $where = array(
                        'is_del' => 1,
                        'month(birthday)' => $month
        );
        $field = 'id,fullname,tel,birthday';
        
        $birthday_list = $this->get_lists($field, $where);
        if(empty($birthday_list)){
            return FALSE;
        }
        
        $tel_list = array_column($birthday_list, 'tel');
        $user_list = $this->Muser->get_users_by_tel($tel_list);
        //如果在用户表未查询到相关员工的信息，返回
        if(empty($user_list)){
            return $birthday_list;
        }
        
        foreach ($birthday_list as $k => $v){
            foreach ($user_list as $key => $value){
                if($v['tel'] == $value['mobile_phone']){
                    $birthday_list[$k]['head_img'] = $value['head_img'];
                    $birthday_list[$k]['nickname'] = $value['nickname'];
                    $birthday_list[$k]['user_id'] = $value['id'];
                }
            }
        }
        return $birthday_list;
        
    }


}