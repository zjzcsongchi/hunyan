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
	<link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    .weui-dialog__btn{ line-height: 48px;font-size: 18px;}
    </style>
	<link href="<?php echo css_js_url('bn_vtour.css', 'wap')?>" type="text/css" rel="stylesheet" />
  <link href="<?php echo css_js_url('vtour.css', 'admin')?>" type="text/css" rel="stylesheet" />
  <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo css_js_url('vtour_talk.css', 'admin')?>" type="text/css" rel="stylesheet" />
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
  <!-- 关闭热点语音按钮 -->
  <div class="voice_btn"></div>
  <!-- 点赞按钮 -->
  <div class="zan_cover">
  <div class="<?php echo $is_zan ? 'zaned_btn' : 'zan_btn'?>" data-id="<?php echo $id ?>"></div>
  </div>
  <!--控制显示/隐藏评论热点-->
  <div class="talk_manage_cover">
    <div class="talk_hide" id="talk_manage"></div>
  </div>
  <!-- 说一说功能 -->
  <div class="talk_cover">
    <div class="talk_btn" id="talk" title="说一说"></div>
  </div>
  <!-- 拨打电话 -->
  <div class="tel_cover">
    <a class="tel_btn" href="tel:<?php echo $about['customer_service_tel'] ?>"></a>
  </div>
  <?php if(!empty($info['location'])): ?>
  <div class="location_cover">
    <a class="location_btn" target="_blank" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:<?php echo $info['location'][1] ?>,<?php echo $info['location'][0] ?>;title:位置导航;addr:<?php echo $info['place']?>&key=<?php echo C('map_config.tenxun_map_key') ?>&referer=<?php echo C('map_config.tenxun_map_name') ?>"></a>
  </div>
  <?php endif; ?>
</div>
<!-- 二维码显示 -->
<div class="qrcode">
    <p>扫码二维码查看</p>
    <img src="/publicservice/qr_code?link=<?php echo urlencode($domain['admin']['url'].'/vtour/scan/'.$id);?>" />
    <p>浏览数：<?php echo $info['scan_count']?></p>
</div>
<!-- 预定场馆按钮 -->
<div class="reserve">
    <button class="bespeak"  id="submit" data-id="<?php echo $info['venue_id']?>">立即预定</button>
</div>
<!-- 预定弹框-->
<div><p id="default_id" style="display:none"></p></div>
<div class="page-bg"></div>
<div class="popup-destine">
    <p class="close"></p>
    <p class="title">场馆预约</p>
    <input type="text" name="name" placeholder="&#x59D3;&#x540D;">
    <input type="tel" name="phone" placeholder="&#x7535;&#x8BDD;">
    <input type="text" name="time" class="time date" readonly id="datePicker" placeholder="&#x9884;&#x7EA6;&#x65F6;&#x95F4;">
    
    <select name="venue" id="venue">
    <?php if(isset($venue)):?>
    <?php foreach ($venue as $k=>$v):?>
       <option <?php if($k == $wedding):?>selected<?php endif;?> value="<?php echo $k?>"><?php echo $v?></option>
    <?php endforeach;?>
    <?php endif;?>
    </select>
    <input type="tel" name="menus_count" placeholder="预约桌数">
    <textarea name="address" placeholder="备注"></textarea>
    <p class="message"></p>
    <a href="javascript:;" class="but submit">立即预约</a>
</div>

<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
<?php $this->load->view('common/jsfooter')?>
<script>
var m_domain = '<?php echo $domain['mobile']['url']?>';
var vtour_data = <?php echo $info['json']?>;
var comment_data = <?php echo $comment_data ?>;
var imgUrl = "<?php echo $domain['img']['url']?>";
var staticUrl = "<?php echo $domain['static']['url'] ?>";
var is_show = true;//控制是否显示评论热点
var id = <?php echo $id ?>;
function krpano_ready(krpano){
    seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>', '<?php echo css_js_url('vtour_venue.js', 'admin')?>', '<?php echo css_js_url('talk_vtour.js', 'admin') ?>'], function(vtour, venue, talk){
      vtour.bgmusic_btn();
      vtour.onresize();
      vtour.auto_scan();
      venue.show();
      venue.submit();
      venue.datepick();
      venue.zan();

      talk.talk();
      talk.show_hide_talk();
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