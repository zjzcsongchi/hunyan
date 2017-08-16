<?php
/**
 * vtour_scene表content数据转字段 
 */
 
use DiDom\Document;
class Vtourscene extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model([
            'Model_vtour_scene' => 'Mvtour_scene',
        ]);
        
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Document.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Errors.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Element.php');
        $this->load->file(BASEPATH.'../shared/libraries/DiDom/Query.php');
    }

    public function index() {

        $success = 0;
        $faild = 0;
        
        $lists = $this->Mvtour_scene->get_lists('id,content');
        $lists = array_column($lists, 'content', 'id');
        foreach ($lists as $id => $content) {
            
            $document = new Document($content);
            
            $scene = $document->find('scene')[0];
            if (is_null($scene)) {
                continue;
            }
            
            $scene_name = $scene->attr('name');
            $scene_thumburl = $scene->attr('thumburl');
            
            $preview_url = $scene->first('preview')->attr('url');
            
            $image = $scene->first('image');
            foreach ($image->children() as $item) {
                if ($item->attr('devices')) {
                    $mobile_image = $item->attr('url');
                } else {
                    $pc_image = $item->attr('url');
                }
            }
            
            $view = $scene->first('view');
            $view_fov = $view->attr('fov');
            $view_fovmax = $view->attr('fovmax');
            $view_fovmin = $view->attr('fovmin');
            $view_fovtype = $view->attr('fovtype');
            
            $scene_data = array(
                'scene_name' => $scene_name,
                'scene_thumburl' => $scene_thumburl,
                'preview_url' => $preview_url,
                'mobile_image' => $mobile_image,
                'pc_image' => $pc_image,
                'view_fov' => $view_fov,
                'view_fovmax' => $view_fovmax,
                'view_fovmin' => $view_fovmin,
                'view_fovtype' => $view_fovtype,
            );
            
            $res = $this->Mvtour_scene->update_info($scene_data, array('id' => $id));

            
            if ($res) {
                $success += 1;
            } else {
                $faild += 1;
            }
            
        }
        echo "成功：{$success}，失败：{$faild}";
    }
}
