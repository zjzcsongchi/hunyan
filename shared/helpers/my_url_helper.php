<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
     
/**
 * 获取图片地址全路径
 *
 * @param string $img_uri 数据库存放的图片资源文件名
 */
if (! function_exists('get_full_img_url')){
    function get_full_img_url($img_uri, $is_full = TRUE, $sub_dir = ''){
        if (strpos($img_uri, "http://") !== false){
            return $img_uri;
        }

        $img_url = '';
        $is_uploads_dir = strpos($img_uri, '/uploads/');
        if ($is_uploads_dir !== false){
            if ($is_full){
                $img_url = C('domain.img.url') . '/' . substr($img_uri, $is_uploads_dir + 9);
            }else{
                $img_url = substr($img_uri, $is_uploads_dir + 9);
            }
        }else{
            if (! empty($sub_dir) && ! empty($img_uri)){
                if ($is_full){
                    $img_url = C('domain.img.url') . '/' . $sub_dir . '/' . $img_uri;
                }else{
                    $img_url = $sub_dir . '/' . $img_uri;
                }
            }
            
        }
        return $img_url;
    }
}


/**
 * 获取图片路径(不保存uplaod/images)
 *
 * @param string $img_uri 数据库存放的图片资源文件名
 */
if (! function_exists('get_img_url')){
    function get_img_url($img_uri, $is_full = TRUE, $sub_dir = ''){
        if (strpos($img_uri, "http://") !== false){
            return $img_uri;
        }
        $is_uploads_dir = strpos($img_uri, '/uploads/');
        if($is_uploads_dir !== false){
            $img = substr($img_uri, $is_uploads_dir + 9);
            $img_url = C('domain.img.url').'/'.$img;
            
        }else{
            $img_url = C('domain.img.url').'/image/'.$img_uri;
        }
        return $img_url;
        
    }
}

/**
 * 获取文件路径
 *
 * @param string $img_uri 数据库存放的图片资源文件名
 */
if (! function_exists('get_file_url')){
    function get_file_url($file_url){
        if (strpos($file_url, "http://") !== false){
            return $file_url;
        }
        $is_uploads_dir = strpos($file_url, '/uploads/');
        if($is_uploads_dir !== false){
            $file = substr($file_url, $is_uploads_dir + 9);
            $file_url = C('domain.img.url').'/'.$file;

        }else{
            $file_url = C('domain.img.url').'/files/'.$file_url;
        }
        return $file_url;

    }
}
 
/**
 * 视频路径
 *
 * @param string $img_uri 视频资源文件名
 */
if (! function_exists('get_vedio_url')){
    function get_vedio_url($vedio_uri, $is_full = TRUE, $sub_dir = ''){
        if (strpos($vedio_uri, "http://") !== false){
            return $vedio_uri;
        }
        $is_uploads_dir = strpos($vedio_uri, '/uploads/');
        if($is_uploads_dir !== false){
            $vedio = substr($vedio_uri, $is_uploads_dir + 9);
            $vedio_url = C('domain.img.url').'/'.$vedio;

        }else{
            $vedio_url = C('domain.img.url').'/video/'.$vedio_uri;
        }
        return $vedio_url;

    }
}

/**
 * 视频路径
 *
 * @param string $img_uri 视频资源文件名
 */
if (! function_exists('get_video_url')){
    function get_video_url($vedio_uri, $is_full = TRUE, $sub_dir = ''){
        if (strpos($vedio_uri, "http://") !== false){
            return $vedio_uri;
        }
        $is_uploads_dir = strpos($vedio_uri, '/uploads/');
        if($is_uploads_dir !== false){
            $vedio = substr($vedio_uri, $is_uploads_dir + 9);
            $vedio_url = C('domain.img.url').'/'.$vedio;

        }else{
            $vedio_url = C('domain.img.url').'/video/'.$vedio_uri;
        }
        return $vedio_url;

    }
}

/**
 * 替换文章内容中图片为全路径
 *
 * @param string $content
 * @return mixed
 */

if (! function_exists('get_full_content_img_url')){
    function get_full_content_img_url($content){
        return preg_replace_callback('{(<img[^>]+src\s*=\s*")(.*?)(".*?[^>]*>)}i', function($match){
            return $match[1].get_img_url($match[2]).$match[3];
        }, $content);
    }
}

/**
 * 去除文章内容中图片地址前面的域名
 * @author chaokai@gz-zc.cn
 */
if(!function_exists('trip_content_domain_text')){
    function strip_content_domain_text($content){
        return str_replace(C('domain.img.url').'/image/', '', $content);
        
    }
}
 


/**
 * 获取头像地址
 * 
 * @param string $img_uri
 * @param boolean  $is_full
 * @return string
 */

if (! function_exists('get_portrait_url')){
    function get_portrait_url($img_uri = '', $is_full = TRUE){
        $portrait_url = '';
        if($is_full){
            $portrait_url = C('domain.img.url') . '/'.'portrait/'.$img_uri;
        }else{
            $portrait_url = '/portrait/'.$img_uri;
        }
        return $portrait_url;
    }
}

/**
 * 获取css和js的url
 *
 * @param string $css_js_uri css或者js的uri
 *
 * @return string $css_js_url
 */
if (! function_exists('css_js_url')){
    function css_js_url($css_js_uri, $app_type){

        $static_url = C('domain.static.url');
        $type = 'css';
        if (strpos($css_js_uri, '.js') !== FALSE){
            $type = 'js';
        }

        //优先读取压缩过的文件
        $is_merge = FALSE;
        if (strpos($css_js_uri, ",") !== FALSE){
            $is_merge = TRUE;
        }

        $css_js_url_arr = explode(',', $css_js_uri);
        foreach ($css_js_url_arr as $key=>$v){
            if (strpos($v, '.min.') === FALSE)
            {
                $min_css_js_uri = str_replace('.' . $type, '.min.' . $type, $v);
                $min_static_file = C('css_js.static_path').'/' . $app_type . '/' . $type.'/'. $min_css_js_uri;
                if(file_exists($min_static_file)){
                    $css_js_url_arr[$key] = $min_css_js_uri;
                }
            }
        }
        $version = C('css_js_version')[$app_type][$type];
        //从数据库中查询版本号
        $CI = get_instance();
        $CI->db->from('t_version');
        $CI->db->where(['web_type' => $app_type]);
        $result = $CI->db->get();
        $version_result = $result->row();
        if($version_result){
	        $api_version = '';
	        if($type == 'css'){
	        	$api_version = $version_result->css_version_id;
	        }else{
	        	$api_version = $version_result->js_version_id;
	        }
	        $file = BASEPATH.'../shared/config/css_js_version.php';
	        $config_time = 0;
	        if(file_exists($file)){
		        $config_time = filemtime($file);
	        }
	        $database_time = strtotime($version_result->update_time);

	        //比较配置文件和数据库中的版本号，选取较大的一个
	        $version = intval($database_time) >= intval($config_time) ? $api_version :$version;
        }


        $css_js_uri = $type .'/'. implode(','. $type .'/', $css_js_url_arr);
        if ($is_merge){
            $css_js_url = $static_url . '/'. $app_type.'/??'. $css_js_uri . '?v='. $version;
        }else{
            $css_js_url = $static_url . '/'. $app_type.'/'. $css_js_uri . '?v='. $version;
        }

        return $css_js_url;
    }
}

/**
 * 返回CSS和JS导入文件
 *
 * @param string $css_js_uri css或者js的uri
 *
 * @return string $css_js_url
 **/

if (! function_exists('css_js_url_v2')){
    function css_js_url_v2($css_js_uri, $app_type) {
        $type = "css";
        $link_url = "";
        if (strpos($css_js_uri, '.js')){
            $type = 'js';
        }
      if($type == 'css'){
            $link_url = '<link href="%s" rel="stylesheet"> ';
        }
        else{
            $link_url = '<script src="%s"></script>';
        }
        if(@C('css_js.development')){ //线下
            $css_js_url_arr = explode(',', $css_js_uri);
            foreach ($css_js_url_arr as $key=>$v){
                printf($link_url, $string_url =  css_js_url($v, $app_type));
                echo "\n\r";
            }
        }else{ //线上
            $string_url =  css_js_url($css_js_uri, $app_type);
            printf($link_url,$string_url);
            echo "\n\r";
        }

    }
}

/**
 * 获取文章详细页url
 * 
 * @param number $id 文章id
 * @param string $is_full_url  是否带域名  TRUE-带域名  FALSE-不带域名
 */
if(!function_exists('news_url')) {
    function news_url($id=0, $is_full_url = FALSE){
        
        if ($is_full_url){
            return C('domain.news.url').'/category/detail/'.$id.'.html';
        }
        return '/category/detail/'.$id.'.html';
        
    }
}

/**
 * 获取文章分类url
 * 
 * @param number $id 分类id
 * @param number $level 分类层级 1-一级分类  2-二级分类
 * @param string $is_full_url  是否带域名  TRUE-带域名  FALSE-不带域名
 */
if(!function_exists('news_category_url')) {
    function news_category_url($id=0, $level=1,$is_full_url = FALSE){
        if ($is_full_url){
            return C('domain.news.url').'/category/c'.$level.'_'.$id.'.html';
        }
        return '/category/c'.$level.'_'.$id.'.html';
        
    }
}
    
/**
 * 获取楼盘分类url
 *
 * @param number $area_id  地区id
 * @param number $model_id 房型id
 * @param number $price_id 价格id
 * @param number $type     建筑类型id
 * @param number $character_id 特色id
 * @param number $time     时间(排序)id
 * @param number $sort     价格(排序)id
 * @param string $is_full_url  是否带域名  TRUE-带域名  FALSE-不带域名
 */
if(!function_exists('loupan_category_url')) {
    function loupan_category_url($area_id=0, $model_id=0, $price_id=0, $type=0, $character_id=0, $time=0, $sort=0, $is_full_url = FALSE, $suffix = TRUE){
        $url = '';
        if ($is_full_url)
        {
            $url = C('domain.loupan.url').'/loupan/a'.$area_id.'m'.$model_id.'p'.$price_id.'t'.$type.'c'.$character_id.'sti'.$time.'spr'.$sort.'.html';
        }
        else 
        {
            $url =  '/loupan/a'.$area_id.'m'.$model_id.'p'.$price_id.'t'.$type.'c'.$character_id.'sti'.$time.'spr'.$sort.'.html';
        }
        if (!$suffix)
        {
            $url = str_replace(".html", '', $url);
        }
        
        return $url;
    }
}


/**
 * 获取楼盘详细页url
 *
 * @param number $id 楼盘id
 * @param string $is_full_url  是否带域名  TRUE-带域名  FALSE-不带域名
 */
if(!function_exists('loupan_url')) {
    function loupan_url($id=0, $is_full_url = FALSE){

        if ($is_full_url){
            return C('domain.loupan.url').'/loupan/detail/'.$id.'.html';
        }
        return '/loupan/detail/'.$id.'.html';

    }
}

/**
 * 获取楼盘属性url（手机端）
 *
 * @param number $id 楼盘id
 * @param string $is_full_url  是否带域名  TRUE-带域名  FALSE-不带域名
 */
if(!function_exists('loupan_property_url')) {
    function loupan_property_url($id=0, $is_full_url = FALSE){

        if ($is_full_url){
            return C('domain.mobile.url').'/loupan/detail/property/'.$id.'.html';
        }
        return '/loupan/detail/property/'.$id.'.html';

    }
}
    
 
 

