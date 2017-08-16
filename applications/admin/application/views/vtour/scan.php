<!DOCTYPE html>
<html>
<head>
	<title>VR全景--<?php echo $info['name']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
	<style>
		@-ms-viewport { width:device-width; }
		@media only screen and (min-device-width:800px) { html { overflow:hidden; } }
		html { height:100%; }
		body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#FFFFFF; background-color:#000000; }
	</style>
  <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo css_js_url('bootstrap.min.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo css_js_url('vtour.css', 'admin')?>" type="text/css" rel="stylesheet" />
	<link href="<?php echo css_js_url('vtour_scan.css', 'admin')?>" type="text/css" rel="stylesheet" />
</head>
<body>

<script src="<?php echo $domain['static']['url']?>/krpano/tour.js"></script>
<div class="textfield">
  <span>人气：<?php echo $info['scan_count'] ?></span>
  <br>
  <span>点赞：<?php echo $info['zan'] ?></span>
</div>
<?php if(!empty($info['logo'])):?>
<img class="logo" src="<?php echo get_img_url($info['logo'])?>"/>
<?php else:?>
<img class="logo" src="<?php echo $domain['static']['url']?>/admin/images/bainian_vr_logo.png"/>
<?php endif;?>
<div class="control-area">
	<!-- 控制背景音乐按钮 -->
	<?php if(!empty($info['bgmusic'])):?>
	<div class="bgmusic_btn"></div>
	<audio id="audioplay" loop src="<?php echo get_img_url($info['bgmusic']) ?>" autoplay style="display:none;"></audio>
	<?php endif;?>
	<!-- 控制自动巡游按钮 -->
	<div class="autoscan_btn"></div>
	<!-- 点赞按钮 -->
	  <div class="zan_cover">
	  <div class="<?php echo $is_zan ? 'zaned_btn' : 'zan_btn'?>" data-id="<?php echo $id ?>"></div>
	  </div>
	<!-- 关闭热点语音按钮 -->
	<div class="voice_btn"></div>
	<!--控制显示/隐藏评论热点-->
	<div class="talk_manage_cover">
	  <div class="talk_hide" id="talk_manage"></div>
	</div>
	<!-- 说一说功能 -->
	<div class="talk_cover">
	  <div class="talk_btn" id="talk" title="说一说"></div>
	</div>
</div>
<!-- 二维码显示 -->
<div class="qrcode">
    <p>扫码二维码查看</p>
    <img src="/publicservice/qr_code?link=<?php echo urlencode($domain['admin']['url'].'/vtour/scan/'.$id);?>" />
    <p>浏览数：<?php echo $info['scan_count']?></p>
</div>

<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
<?php $this->load->view('common/footer')?>
<script>
var vtour_data = <?php echo $info['json']?>;
var comment_data = <?php echo $comment_data ?>;
var id = <?php echo $id ?>;
var is_show = true;//控制是否显示评论热点
var imgUrl = "<?php echo $domain['img']['url']?>";
function krpano_ready(krpano){
    seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>', '<?php echo css_js_url('talk_vtour.js', 'admin') ?>'], function(vtour, talk){
      vtour.bgmusic_btn();
      vtour.onresize();
      vtour.auto_scan();
      talk.talk();
      talk.show_hide_talk();
      vtour.zan();
    })
}
</script>
	<script>
		embedpano({id:"krpano", swf:"<?php echo $domain['static']['url']?>/krpano/tour.swf", xml:"/vtour/load_xml/<?php echo $id?>",onready:krpano_ready, target:"pano", html5:"prefer", mobilescale:1.0, passQueryParameters:true, });
	</script>
<script src="<?php echo css_js_url('common_vtour.js', 'admin') ?>"></script>
</div>

</body>
</html>