<!doctype html>
<html>
<head>
<meta charset="utf-8">
        <title>贵阳市公安局</title>
        <meta name="keywords" content="&#x9879;&#x76EE;&#x5173;&#x952E;&#x8BCD;">
	    <meta name="description" content="&#x9879;&#x76EE;&#x63CF;&#x8FF0;">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"/>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge，chrome=1"/>
	    <meta name="randerer" content="webkit"/>
		<link href="<?php echo css_js_url('video-js.css', 'wap')?>" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css"/>-->
		<link rel="stylesheet" href="<?php echo css_js_url('e_public.css', 'wap')?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo css_js_url('e_css1.css', 'wap')?>"/>
			
		<!-- If you'd like to support IE8 -->
		<script src="<?php echo css_js_url('videojs-ie8.min.js', 'wap')?>"></script>
</head>

<body>
	<div class="m">
		<video id="my-video" playsinline webkit-playsinline poster="<?php echo $domain['static']['url']?>/wap/images/e4_v1.png" class="video-js my-video1" vjs-fluid controls preload="auto"
		       data-setup="{}">
		       <!--poster="img/v1.png"-->
			<source src="<?php echo get_video_url('20170419/yangpian4.mp4')?>" type="video/mp4">
			<source src="<?php echo get_video_url('20170419/yangpian4.mp4')?>" type="video/webm">
			<source src="<?php echo get_video_url('20170419/yangpian4.mp4')?>" type="video/ogg">
			<p class="vjs-no-js">
			  To view this video please enable JavaScript, and consider upgrading to a web browser that
			  <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
			</p>
		 </video> 
	</div>
    <div class="main2">
    	
    	<img src="<?php echo $domain['static']['url']?>/wap/images/e4_f1.png" class="img1"/>
    	<img style="top:173px;" src="<?php echo $domain['static']['url']?>/wap/images/e4_f4.png" class="img2"/>
    </div>
</body>
        <script src="<?php echo css_js_url('video.min.js', 'wap')?>"></script>	
        <script src="<?php echo css_js_url('jquery-3.1.1.min.js', 'wap')?>" type="text/javascript" charset="utf-8"></script>
		  <script type="text/javascript">
			var myPlayer = videojs('my-video');
			videojs("my-video").ready(function(){
				var myPlayer = this;
				myPlayer.play();
			});
	    
	             
	            setTimeout(function(){
					$('.img1').stop().animate({left:'0px'},1000,function(){
						$('.img2').stop().animate({right:'0px'},1000)
				             })
			            },3000)
           	
		  </script>
</html>
