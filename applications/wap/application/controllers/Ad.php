<?php
/**
 * 广告
 * @author chaokai@gz-zc.cn
 */
class Ad extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = $this->data;

		$this->load->view('ad/index', $data);
	}
}