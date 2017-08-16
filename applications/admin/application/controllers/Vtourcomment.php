<?php 
/**
 * 热点评论管理
 * @author chaokai@gz-zc.cn
 */
class Vtourcomment extends MY_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->model(array(
			'Model_vtour_comment' => 'Mvtour_comment',
		    'Model_vtour' => 'Mvtour',
		    'Model_user' => 'Muser'
		));
		$this->load->library('pagination');
	}

	public function index(){
		$data = $this->data;
		
		$this->pageconfig = C('page.config_bootstrap');
		$page = $this->input->get('per_page') ? : 1;
		$offset = ($page-1)*$this->pageconfig['per_page'];
		
		$name = $this->input->get('name');
		if($name){
		    $query['name'] = $name;
		    $vtour_id = $this->Mvtour->get_lists('id, name', array('like' => array('name' => $name )));
		    $vtour_id = array_column($vtour_id, 'id');
		    if($vtour_id){
		        $where['in'] = array('vtour_id' => $vtour_id);
		    }else{
		        $where['id'] = 0;
		    }
		}
		$where['is_del'] = 0;
		$query['is_del'] = 0;
		$order_by = array('create_time' => 'desc');
		
		$field = 'id, vtour_id, user_id, content';
		$where['is_del'] = 0;
        $lists = $this->Mvtour_comment->get_lists($field, $where, $order_by, $this->pageconfig['per_page'], $offset);
        $data['lists'] = $lists;
        $data['count'] = count($this->Mvtour_comment->get_lists('id', $where));
        //分页
        if($data['lists']){
            $this->pageconfig['base_url'] = '/vtourcomment/index?'.http_build_query($query);
            $this->pageconfig['total_rows'] = $data['count'];
            $this->pagination->initialize($this->pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        //获取场景
        $vtour = $this->Mvtour->get_lists('id, name', ['is_del' => 0]);
        $data['vtour_name'] = array_column($vtour, 'name', 'id');
        //获取用户
        $user_id = array_column($lists, 'user_id');
        if($user_id){
            $user_name = $this->Muser->get_lists('id, nickname', array('in' => array('id' => $user_id)));
            $data['user_name'] = array_column($user_name, 'nickname', 'id');
        }
		$this->load->view('vtourcomment/index', $data);
	}

	
 /**
     * 删除场景
     * @author songchi@gz-zc.cn
     */
    public function del(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');
        
        $where = array('id' => $id);
        $this->Mvtour_comment->delete($where);
        $this->return_success();
    }
	
}