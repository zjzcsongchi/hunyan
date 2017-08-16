<?php 
/**
 * 全景视频
 * @author chaokai@gz-zc.cn
 */
class Model_vtour_video extends MY_Model{
	private $_table = 't_vtour_video';

	public function __construct(){
		parent::__construct($this->_table);
	}
}