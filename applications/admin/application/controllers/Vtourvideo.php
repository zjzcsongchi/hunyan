<?php 
/**
 * 全景视频
 */
use DiDom\Document;
use DiDom\Element;
use OSS\OssClient;
use OSS\Core\OssException;
require_once(BASEPATH.'../shared/libraries/aliyunoss/autoload.php');
class Vtourvideo extends MY_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model(array(
			'Model_vtour_video' => 'Mvtour_video'
		));
		$this->load->file(BASEPATH.'../shared/libraries/DiDom/Document.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Errors.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Element.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Query.php');

		$this->load->library(array('form_validation', 'pagination'));
	}

	/**
	 * 全景视频列表
	 * @author chaokai@gz-zc.cn
	 */
	public function index(){
		$data = $this->data;

        $search_name = $this->input->get('name');
        $search_where = array();
        if($search_name){
            $search_where['like'] = array('name' => $search_name); 
        }
        
        $pageconfig = C('page.config_bootstrap');
        $pagesize = $pageconfig['per_page'];
        $page = intval($this->input->get('per_page'))?:1;
        $offset = $pagesize*($page - 1);
        
        $field = 'id,name,create_time';
        $where = array('is_del' => 0);
        $where = array_merge($where, $search_where);
        $order_by = array('create_time' => 'desc');
        $list = $this->Mvtour_video->get_lists($field, $where, $order_by, $pagesize, $offset);
        $data['data_count'] = $count = $this->Mvtour_video->count($where);
        
        if(!empty($list)){
            $pageconfig['total_rows'] = $count;
            $pageconfig['base_url'] = '/vtourvideo/index'.http_build_query($search_where);
            $this->pagination->initialize($pageconfig);
            $data['pagestr'] = $this->pagination->create_links();
        }
        
        $data['list'] = $list;
        
        $this->load->view('vtourvideo/index', $data);
	}


	/**
	 * 添加全景视频
	 * @author chaokai@gz-zc.cn
	 */
	public function add(){
		$data = $this->data;

		if(IS_POST){
			$this->form_validation->set_rules('name', '名称', 'required', array('required' => '场景名称不能为空'));
			$this->form_validation->set_rules('video_url', '视频', 'required', array('required' => '请上传视频'));
			if($this->form_validation->run() == false){
				$this->error(validation_errors());
			}

			$post_data = $this->input->post();
			$post_data['create_time'] = date('Y-m-d H:i:s');
			$post_data['create_admin'] = $data['userInfo']['id'];

			$this->Mvtour_video->create($post_data);
			$this->success('操作成功', '/vtourvideo/index');
		}

		$this->load->view('vtourvideo/add', $data);
	}

	/**
	 * 查看视频场景
	 * @author chaokai@gz-zc.cn
	 */
	public function scan($id = 0){
		$id = intval($id);
		!$id && show_404();
		$data = $this->data;

		$field = 'id,name,video_url';
		$where = array(
			'id' => $id,
			'is_del' => 0
		);
		$info = $this->Mvtour_video->get_one($field, $where);
		empty($info) && show_404();

		$data['info'] = $info;

		$this->load->view('vtourvideo/scan', $data);

	}

	/**
	 * 加载xml
	 * @author chaokai@gz-zc.cn
	 */
	public function load_xml($id){

		$id = intval($id);
		!$id && show_404();

		$field = 'id,name,video_url';
		$where = array(
			'id' => $id,
			'is_del' => 0
		);
		$info = $this->Mvtour_video->get_one($field, $where);
		empty($info) && show_404();

		//xml模板文件
		$xml_temp = BASEPATH.'../static/krpano/vtourvideo.xml';
		$xml_temp_str = file_get_contents($xml_temp);

		$document = new Document($xml_temp_str);

		foreach($document->find('include') as $k => $v){
			$v->attr('url', $this->data['domain']['static']['url'].'/krpano/'.$v->getAttribute('url'));
		}
		$document->find('plugin[name=video]')[0]->attr('videourl', '/video/'.$info['video_url']);

		header('Content-Type:text/xml');
        echo $document->find('krpano')[0]->xml();


	}

	/**
	 * 视频场景修改
	 * @author chaokai@gz-zc.cn
	 */
	public function modify(){
		$id = (int)$this->input->get('id');
        !$id && show_404();
        $data = $this->data;
        $field = 'id,name,video_url';
        $where = array(
                        'id' => $id,
                        'is_del' => 0
        );
        $info = $this->Mvtour_video->get_one($field, $where);
        if(empty($info)){
            show_404();
        }
        
        if(IS_POST){
            //表单验证
            $this->form_validation->set_rules('name', '名称', 'required', array('required' => '请输入名称'));
            $this->form_validation->set_rules('video_url', '视频', 'required', array('required' => '请上传视频'));
            if($this->form_validation->run() == false){
                $this->error(validation_errors());
            }
            $post_data = $this->input->post();
            
            $update_where = array('id' => $id);
            
            $this->Mvtour_video->update_info($post_data, $update_where);
            $this->success('修改成功', '/vtourvideo/index');
        }
        
        $data['info'] = $info;
        
        $this->load->view('vtourvideo/modify', $data);
	}




}