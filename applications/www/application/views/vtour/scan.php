<!DOCTYPE html>
<html>
<head>
	<title>VR全景--<?php echo $info['name']?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo css_js_url('vtour.css', 'admin')?>" type="text/css" rel="stylesheet" />
	<link href="<?php echo css_js_url('vtour_talk.css', 'admin')?>" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
	<link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap') ?>">
	<style>
		@-ms-viewport { width:device-width; }
		@media only screen and (min-device-width:800px) { html { overflow:hidden; } }
		html { height:100%; }
		body { height:100%; overflow:hidden; margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; background-color:#000000; }
		.popup-login{
			z-index:30010;
		}
		.nav a{text-decoration:none}
        .menu a{text-decoration:none}
		.header .nav{
	        overflow:inherit;
		}
        .header .logo11 {
          float: left; 
            display: block;
            height: 100%;
            width: 415px;
            background-repeat: no-repeat;
            background-image: url(<?php echo $domain['static']['url']?>/www/images/logo.png);
            position:relative;
            top:-10px;
		    left:200px;
             background-position: left center; 
        }
		.header .user-center{
            padding:3.5px 10px;
         }
		
	     .header ul{
		   width:816px;
		   height:45px;
		   position:fixed;
		   right:107px;
		   top:10px;
		   background:#FFFFFF;
 		   border-radius:5px;
				}
		.header ul li{
			width:136px;
		    text-align:center;
		    line-height:45px;
	       margin:0px;
 		    border-right:1px solid #D6D6D6; 
		}
        .header ul li a{
		color:#646464;
		}
	    .sY_img{
        	 position:absolute;
            top:-27px;
        	right:-15px;
		
		}
       #popular{
        	z-index:2;
        	}
		.control-area{
			z-index:101;
		}
        	</style>
</head>
<body>
<!-- 头部/登录框 -->
<!-- 头部 -->
    <?php if($id == C('public.vtour.default_id')):?>
    <div class="header" style="background-image:none">

        <div class="nav" style="width:100%">
            <a href="/" class="logo11"></a>
            <ul class="menu" style="margin-top:1px;margin-left: 443.5px;float:none;">
                <li><a href="/" target="_self"  style="position:relative;display:block;">百年<img src="<?php echo $domain['static']['url']?>/www/images/01.png" class="sY_img"></a></li>
                <li><a href="/home" target="_self">百年宴会</a></li>
                <li><a href="/wall" target="_self">百年新人</a></li>
                <li><a href="/venue" target="_self">百年场馆</a></li>
                <li><a href="/drink" target="_self">百年商城</a></li>
                <li  style="border:none;border-radius:0px 5px 5px 0px;"><a href="/news/home" target="_self">百年资讯</a></li>
            </ul>
            
        </div>
    </div>
    <?php endif;?>

<script src="<?php echo $domain['static']['url']?>/krpano/tour.js"></script>
<div id="popular">
  <span>人气：<?php echo $info['scan_count'] ?></span>&nbsp;<span>点赞：<?php echo $info['zan'] ?></span>
</div>
<?php if(!empty($info['logo'])):?>
<img class="logo" src="<?php echo get_img_url($info['logo'])?>" style="display:none"/>
<?php else:?>
<img class="logo" src="<?php echo $domain['static']['url']?>/admin/images/bainian_vr_logo.png" style="display:none"/>
<?php endif;?>
	<!-- 关闭热点语音按钮 -->
	<div class="voice_btn"></div>
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
	<!--控制显示/隐藏评论热点-->
	<div class="talk_manage_cover">
	  <div class="talk_hide" id="talk_manage"></div>
	</div>
	<!-- 说一说功能 -->
	<div class="talk_cover">
	  <div class="talk_btn" id="talk" title="说一说"></div>
	</div>
	<!-- 拨打电话 -->
		<div class="tel_cover" id="tel_btn">
			<div class="tel_btn" data-tel="<?php echo $about['customer_service_tel'] ?>"></div>
		</div>
		<?php if(!empty($info['location'])): ?>
		<div class="location_cover">
		  <a class="location_btn" target="_blank" href="http://apis.map.qq.com/tools/poimarker?type=0&marker=coord:<?php echo $info['location'][1] ?>,<?php echo $info['location'][0] ?>;title:位置导航;addr:<?php echo $info['place']?>&key=<?php echo C('map_config.tenxun_map_key') ?>&referer=<?php echo C('map_config.tenxun_map_name') ?>"></a>
		</div>
		<?php endif; ?>
</div>
<!-- 二维码显示 -->
<div class="qrcode" style="width:194px;">
    <p>扫码二维码查看</p>
    <img src="/publicservice/qr_code?link=<?php echo urlencode($domain['base']['url'].'/vtour/scan/'.$id);?>" />
    <p>浏览数：<?php echo $info['scan_count']?></p>
</div>

<div id="pano" style="width:100%;height:100%;">
	<noscript><table style="width:100%;height:100%;"><tr style="vertical-align:middle;"><td><div style="text-align:center;">ERROR:<br/><br/>Javascript not activated<br/><br/></div></td></tr></table></noscript>
<?php $this->load->view('common/jsfooter')?>
<script src='<?php echo css_js_url('jquery.min.js', 'www')?>'>
	
</script>
<script type="text/javascript">
$(".nav li").hover(function(){
	$(this).css('background','#FFAD0A').siblings().css('background','#FFFFFF')
	$(this).find("a").css('color','#FFFFFF');
	},function(){
		$(this).find("a").css('color','#646464');
		})
        seajs.use('public',function(a){
         a.load()
        })
    </script>
<script>
var vtour_data = <?php echo $info['json']?>;
var comment_data = <?php echo $comment_data ?>;
var id = <?php echo $id ?>;
var is_show = true;//控制是否显示评论热点
var imgUrl = "<?php echo $domain['img']['url']?>";
var staticUrl = "<?php echo $domain['static']['url'] ?>";
function krpano_ready(krpano){
    seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>', '<?php echo css_js_url('talk_vtour.js', 'admin') ?>'], function(vtour, talk){
      vtour.bgmusic_btn();
      vtour.onresize();
      vtour.auto_scan();
      talk.talk();
      talk.show_hide_talk();
      // talk.is_login();
      vtour.zan();
      vtour.tel();
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