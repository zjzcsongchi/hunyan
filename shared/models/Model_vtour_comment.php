<?php
/**
 * 场景评论表
 * @author chaokai@gz-zc.cn
 */
class Model_vtour_comment extends MY_Model{

	private $_table = 't_vtour_comment';
	public function __construct(){
		parent::__construct($this->_table);

		$this->load->model(array('Model_user' => 'Muser'));
	}

	/**
	 * 获取某个场景的评论
	 * @author chaokai@gz-zc.cn
	 */
	public function lists($vtour_id){
		$comment_data = $this->Mvtour_comment->get_lists('*', array('vtour_id' => $vtour_id));
        $user_ids = array_column($comment_data, 'user_id');
        foreach ($user_ids as $key => $value) {
        	if($value == 0){
        		unset($user_ids[$key]);
        	}
        }

        if(empty($user_ids)){
        	return $comment_data;
        }
        $user_lists = $this->Muser->get_lists('id,head_img', array('in' => ['id' => $user_ids]));
        foreach ($comment_data as $key => $value) {
        	foreach ($user_lists as $k => $v) {
        		if($value['user_id'] == $v['id']){
        			$comment_data[$key]['headurl'] = get_img_url($v['head_img']);
        		}
        	}
        }

        return $comment_data;
	}
}