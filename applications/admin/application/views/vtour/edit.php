<!DOCTYPE html>
<html>
<head>
    <title>VR修改--<?php echo $info['name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('admin_new.css', 'admin')?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin')?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $domain['static']['url']?>/admin/wangeditor/css/wangEditor.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('vtour.css', 'admin') ?>" type="text/css" rel="stylesheet" />

    <style>
        @-ms-viewport { width:device-width; }
        @media only screen and (min-device-width:800px) { html { overflow:hidden; } }
        html { height:100%; }
        body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; /*color:#FFFFFF;*/ background-color:#000000; }
        .logo {position:fixed; top:10px; left:10px; z-index:1; max-width:200px; max-height:200px;}
        
    </style>
</head>
<body>
<input type="hidden" id="id" value="<?php echo $id?>"/>
<script src="<?php echo $domain['static']['url']?>/krpano/tour.js"></script>
<?php if(!empty($info['logo'])):?>
<img class="logo" src="<?php echo get_img_url($info['logo'])?>"/>
<?php else:?>
<img class="logo" src="<?php echo $domain['static']['url']?>/admin/images/bainian_vr_logo.png"/>
<?php endif;?>
<!-- 二维码显示 -->
<div class="qrcode">
    <p>扫码二维码查看</p>
    <img src="/publicservice/qr_code?link=<?php echo urlencode($domain['base']['url'].'/vtour/scan/'.$id);?>" />
    <p>浏览数：<?php echo $info['scan_count']?></p>
</div>
<div class="" style="position:absolute; top: 0; right:0; z-index:10000;">
    <div class="pull-right" style="margin-top:20px;">
        <button class="btn btn-danger" id="save">保 存</button>
        <br>
        <br>
        <button class="btn btn-success" id="hotspot">热 点</button>
        <br>
        <br>
        <button class="btn btn-success" id="view">视 角</button>
    </div>
    <div class="pull-right show" id="hotspot_panel" style="margin-right:20px; width:300px; height:200px;margin-top:67px;">
        <div class=" panel panel-info" >
            <div class="panel-heading">热点设置</div>
            <div class="panel-body">
                <button class="btn btn-info hotspot_type" data-type="vtour">全景切换</button>
                <button class="btn btn-info hotspot_type" data-type="link">超 链 接</button>
                <button class="btn btn-info hotspot_type" data-type="voice">语音热点</button>
                <button class="btn btn-info hotspot_type" data-type="video">视频热点</button>
                <button class="btn btn-info hotspot_type" data-type="article">图文热点</button>
            </div>
        </div>
        <div class="panel panel-info hide" id="hotspot_list">
            <input type="hidden" id="hotspot_type_value"/>
            <div class="panel-heading">已添加热点</div>
            <div class="panel-body">
                
            </div>
            <div class="panel-footer text-center container-fluid">
                <button class="btn btn-info col-sm-12 add_hotspot">添加热点</button>
            </div>
        </div>
    </div>
    <div class="pull-right hide" id="view_panel" style="margin-right:20px; width:300px;margin-top:67px;">
        <div class=" panel panel-info" >
            <div class="panel-heading">视角设置</div>
            <div class="panel-body">
                <button class="btn btn-info view_set_wrap" data-type="view">初始视角设置</button>
                <button class="btn btn-info view_set_wrap" data-type="fov">FOV设 置</button>
            </div>
        </div>
        <div class="panel panel-info hide" id="view_set">
            <div class="panel-heading">初始视角设置</div>
            <div class="panel-body">
                <button class="center-block btn btn-info" id="backto_current_view">回到初始视角</button>
                <button class="center-block btn btn-info" id="current_view">设置当前为初始视角</button>
            </div>
        </div>
        <div class="panel panel-info hide" id="fov_set" style="color:#000">
            <div class="panel-heading">FOV设置</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-6 control-label">初始视角值：</label>
                        <div class="col-xs-6">
                            <input type="text" value="" name="fov_default"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-6 control-label">最小视角值：</label>
                        <div class="col-xs-6">
                            <input type="text" value="" name="fov_min"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-6 control-label">最大视角值：</label>
                        <div class="col-xs-6">
                            <input type="text" value="" name="fov_max"  class="form-control" >
                        </div>
                    </div>
                    <span class="help-block"></span>
                    <div class="form-group text-center">
                        <button class="btn btn-info" id="fov_save">保 存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
<div id="pano" style="width:100%;height:100%;">
    <noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
    <?php $this->load->view('common/footer')?>
    <script>
        var static_domain = '<?php echo $domain['static']['url']?>';
        var vtour_data = <?php echo $vtour_data?>;
        var uploadUrl = "<?php echo $domain['upload']['url']?>";
        var staticUrl = "<?php echo $domain['static']['url']?>";
        var imgUrl = "<?php echo $domain['img']['url']?>";
        var default_ico = <?php echo $default_ico ?>;
        var is_show = false;

        //弹框模板
        var add_article = '<?php echo $add_article; ?>';
        var edit_article = '<?php echo $edit_article; ?>';
        var add_vtour = '<?php echo $add_vtour ?>';
        var edit_vtour = '<?php echo $edit_vtour ?>';
        var add_link = '<?php echo $add_link ?>';
        var edit_link = '<?php echo $edit_link ?>';
        var add_voice = '<?php echo $add_voice ?>';
        var edit_voice = '<?php echo $edit_voice ?>';
        var add_video = '<?php echo $add_video ?>';
        var edit_video = '<?php echo $edit_video ?>';

        seajs.config({
            alias:{
                "vtour_edit_article":"<?php echo css_js_url('vtour_edit_article.js', 'admin') ?>",
                "vtour_edit_layer":"<?php echo css_js_url('vtour_edit_layer.js', 'admin') ?>",
                "vtour_edit_vtour":"<?php echo css_js_url('vtour_edit_vtour.js', 'admin') ?>",
                "edit_vtour":"<?php echo css_js_url("edit_vtour.js", "admin") ?>",
                "vtour_edit_link":"<?php echo css_js_url('vtour_edit_link.js', 'admin') ?>",
                "vtour_edit_voice":"<?php echo css_js_url('vtour_edit_voice.js', 'admin') ?>",
                "vtour_edit_video":"<?php echo css_js_url('vtour_edit_video.js', 'admin') ?>"
            }
        })
    function krpano_ready(krpano){

    seajs.use(['edit_vtour', '<?php echo css_js_url('vtour.js', 'admin')?>'], function(vtour, scan_vtour){
        vtour.scene_change();
        vtour.init();
        vtour.select_scene();
        vtour.save();
        vtour.hotspot_change();
        vtour.add_hotspot_act();
        vtour.edit_hotspot();
        vtour.del_hotspot();
        vtour.view_fov_change();

        scan_vtour.bgmusic_btn();
        //切换显示设置
        vtour.change_set();
        //设置当前视角
        vtour.set_current_view();
        //回到初始视角
        vtour.backto_current_view();

    })
    }
function pause(){
    krpano.set('autorotate.enabled', false)
}

</script>
<script src="<?php echo css_js_url('common_vtour.js', 'admin') ?>"></script>
    <script>
        embedpano({id:"krpano", swf:"<?php echo $domain['static']['url']?>/krpano/tour.swf", onready:krpano_ready, xml:"/vtour/load_xml/<?php echo $id?>", target:"pano", html5:"prefer", mobilescale:1.0, passQueryParameters:true});
    </script>
</div>

</body>
</html>