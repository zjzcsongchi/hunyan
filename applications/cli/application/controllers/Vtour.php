<?php
/**
 * 数据恢复
 * @author chaokai@gz-zc.cn
 */
use DiDom\Document;
use DiDom\Element;
class Vtour extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model(array(
                        'Model_vtour' => 'Mvtour',
                        'Model_vtour_scene' => 'Mvtour_scene',
                        'Model_venue' => 'Mvenue',
                        'Model_hotspot_ico' => 'Mhotspot_ico',
                        'Model_vtour_comment' => 'Mvtour_comment',
                        'Model_vtour_view' => 'Mvtour_view',
                        'Model_vtour_include_scene' => 'Mvtour_include_scene'
        ));

        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Document.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Errors.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Element.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Query.php');
	}

	public function index(){
		//查询出所有场景数据
		$list = $this->Mvtour->get_lists('*', array('id' => 26));

		foreach ($list as $key => $value) {
			$doc = new Document($value['xml_string']);
			$scene_arr = [];
			foreach($doc->find('scene') as $k => $v){
				$scene_arr[] = array(
					'vtour_id' => $value['id'],
					'name' => $v->getAttribute('name'),
					'thumb_img' => $v->getAttribute('thumburl') ? $v->getAttribute('thumburl') : '',
					'scene_name' => $v->getAttribute('name'),
					'preview_img' => $v->find('preview')[0]->getAttribute('url'),
					'cube_pc_img' => $v->find('cube')[0]->getAttribute('url'),
					'cube_wap_img' => $v->find('cube[devices=mobile]')[0]->getAttribute('url'),
				);
			}

			$json = json_decode($value['json'], true);

			$view_arr = [];
			foreach($json['view'] as $k => $v){
				$view_arr[] = array(
					'vtour_id' => $value['id'],
					'scene' => $v['scene'],
					'fov' => !empty($v['attr']['fov']) ? $v['attr']['fov'] : '140',
					'fovmax' => !empty($v['attr']['fovmax']) ? $v['attr']['fovmax'] : '140',
					'fovmin' => !empty($v['attr']['fovmin']) ? $v['attr']['fovmin'] : '70',
					'fovtype' => !empty($v['attr']['fovtype']) ? $v['attr']['fovtype'] : 'MFOV',
					'hlookat' => $v['attr']['hlookat'],
					'vlookat' => $v['attr']['vlookat'],
					'limitview' => !empty($v['attr']['limitview']) ? $v['attr']['limitview'] : '',
					'maxpixelzoom' => !empty($v['attr']['maxpixelzoom']) ? $v['attr']['maxpixelzoom'] : '',
				);
			}
			
			$hotspot_arr = [];
			// p($json['hotspot']);
			foreach ($json['hotspot'] as $k => $v) {
				$scene_name = $v['scene'];
				foreach($v['attr'] as $k1 => $v1){
					$temp_arr = array(
						'vtour_id' => $value['id'],
						'name' => $v1['name'],
						'ath' => $v1['ath'],
						'atv' => $v1['atv'],
						'hotspot_name' => $v1['hotspot_name'],
						'hotspot_type' => $v1['hotspot_type'],
						'ico_url' => !empty($v1['ico_url']) ? $v1['ico_url'] : '',
						'url' => !empty($v1['url']) ? $v1['url'] : '',
						'distorted' => !empty($v1['distorted']) ? $v1['distorted'] : '',
						'tooltip' => !empty($v1['tooltip']) ? $v1['tooltip'] : '',
						'scale' => !empty($v1['scale']) ? $v1['scale'] : '',
						'linkedscene' => !empty($v1['linkedscene']) ? $v1['linkedscene'] : '',
						'posterurl' => !empty($v1['posterurl']) ? $v1['posterurl'] : ''
					);
					if($v1['hotspot_type'] == 'voice'){
						$temp_arr['source_url'] = $v1['music_url'];
					}else if($v1['hotspot_type'] == 'video'){
						$temp_arr['source_url'] = $v1['videourl'];
					}else if($v1['hotspot_type'] == 'link'){
						$temp_arr['source_url'] = $v1['hotspot_link'];
					}
					if(!empty($v1['onloaded'])){

					$dynamic_pos = strpos($v1['onloaded'], 'do_crop_animation');
					$dynamic_pos = $dynamic_pos+18;
					$dynamic_str = substr($v1['onloaded'], $dynamic_pos);
					$dynamic_end = strpos($dynamic_str, ');');
					$dynamic_param = substr($dynamic_str, 0, $dynamic_end);

					$temp_arr['dynamic_param'] = str_replace(',', ';', $dynamic_param);
					}
					$temp_arr['scene'] = $scene_name;

					$hotspot_arr[] = $temp_arr;

				}
			}
			foreach($hotspot_arr as $v){

			$this->Mvtour_hotspot->create($v);
			}
			foreach ($view_arr as $key => $value) {
				# code...
			$this->Mvtour_view->create($value);
			}
			foreach($scene_arr as $v){

			$this->Mvtour_include_scene->create($v);
			}
		}


	}
}