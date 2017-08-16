<?php 
/**
 * VR场景
 * @author chaokai@gz-zc.cn
 */
use DiDom\Document;
use DiDom\Element;
class Vtour extends MY_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model(array(
			'Model_vtour' => 'Mvtour',
            'Model_vtour_comment' => 'Mvtour_comment'
		));

		$this->load->file(BASEPATH.'../shared/libraries/DiDom/Document.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Errors.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Element.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Query.php');

		$this->load->library(array('user_agent', 'form_validation'));
	}

	/**
     * 百年婚宴场馆预定VR
     * @author chaokai@gz-zc.cn
     */
    public function bn_scan($id){
        $data = $this->data;
        $data['id'] = intval($id);
        
        //浏览数加一
        $this->Mvtour->update_info(array('incr' => ['scan_count' => 1]), array('id' => $id));
        //判断是否赞过
        $is_zan = $this->session->userdata('is_zan');
        $data['is_zan'] = !empty($is_zan) && in_array($id, $is_zan);

        //判断是否手机端
        $is_mobile = $this->agent->is_mobile();

        $info = $this->Mvtour->get_scan_info($id, $is_mobile);
        if(empty($info)){
            show_404();
        }

        $data['info'] = $info;
        //获取宴会类型
        $venue = C('party');
        $data['venue'] = array_column($venue, 'name', 'id');
        //设置默认选择宴会类型
        $data['wedding']= C('party.wedding.id');

        //评论内容
        $comment_data = $this->Mvtour_comment->lists($id);
        $data['comment_data'] = json_encode($comment_data);
        $this->load->view('vtour/bn_scan', $data);
    }

    /**
     * 查看全景图
     * @author chaokai@gz-zc.cn
     */
    public function scan($id){
        $data = $this->data;
        $data['id'] = intval($id);
        //判断是否手机端
        $is_mobile = $this->agent->is_mobile();

        $info = $this->Mvtour->get_scan_info($id, $is_mobile);
        if(empty($info)){
            show_404();
        }
        $info['json'] = json_encode($info['json']);
        $data['info'] = $info;
        //浏览数加一
        $this->Mvtour->update_info(array('incr' => ['scan_count' => 1]), array('id' => $id));

        //评论内容
        $comment_data = $this->Mvtour_comment->lists($id);
        $data['comment_data'] = json_encode($comment_data);

        //判断是否赞过
        $is_zan = $this->session->userdata('is_zan');
        $data['is_zan'] = !empty($is_zan) && in_array($id, $is_zan);
        
        $this->load->view('vtour/scan', $data);
    }

    /**
     * 场景点赞
     */
    public function zan(){
        $id = intval($this->input->get('id'));
        !$id && $this->return_failed('参数错误');

        $is_zan = $this->session->userdata('is_zan');
        if(!empty($is_zan) && in_array($id, $is_zan)){
            $this->return_failed('您已经点过赞了');
        }

        $this->Mvtour->update_info(array('incr' => array('zan' => 1)), array('id' => $id));
        $is_zan = !empty($is_zan) ? $is_zan : array();
        array_push($is_zan, $id);
        $this->session->set_userdata('is_zan', $is_zan);
        $this->return_success();
    }

    /**
     * 加载xml
     * @author chaokai@gz-zc.cn
     */
    public function load_xml($id){
        $id = intval($id);
        !$id && show_404();
        
        $is_mobile = $this->agent->is_mobile();
        
        header('Content-Type:text/xml');
        echo $this->Mvtour->load_xml($id, $is_mobile);
    }

    /**
     * 场景说一说
     * @author chaokai@gz-zc.cn
     */
    public function talk(){
        if(IS_POST){
            $this->form_validation->set_rules('vtour_id', '参数', 'integer|required', array('integer' => '参数错误', 'required' => '参数错误'));
            $this->form_validation->set_rules('content', '评论内容', 'required', array('required' => '%s不能为空'));

            if($this->form_validation->run() == false){
                $this->return_failed(validation_errors());
            }

            $post_data = $this->input->post();
            unset($post_data['headurl']);
            $insert_data = array(
                'create_time' => date('Y-m-d H:i:s'),
                'hotspot_name' => uniqid('h_'),
                'user_id' => !empty($this->data['user_info']['id']) ? $this->data['user_info']['id'] : 0
            );

            $inser_data = array_merge($post_data, $insert_data);
            if($this->Mvtour_comment->create($inser_data)){
                $this->return_success(array(
                    'hotspot_name' => $inser_data['hotspot_name'], 
                ));
            }else{
                $this->return_failed('评论失败');
            }


        }
    }

    /**
     * 加载视频播放
     * @author chaokai@gz-zc.cn
     * @param $id int t_vtour_hotspot表主键id
     */
    public function playvideo(){
        try {
            $id = intval($this->input->get('id'));
            if(!$id){
                throw new Exception("参数错误");
            }

            $info = $this->Mvtour_hotspot->get_one("id,source_url", array('id' => $id));
            if(empty($info)){
                throw new Exception("数据不存在");
            }

            $data['info'] = $info;
            $this->return_success($this->load->view('vtour/ajax_playvideo', $data, true));
        } catch (Exception $e) {
            $this->return_failed($e->getMessage());
        }

    }
}