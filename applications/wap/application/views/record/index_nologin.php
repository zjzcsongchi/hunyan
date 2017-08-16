<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    
    <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('animate.min.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('h5.css', 'wap')?>">
    <style>
    @-webkit-keyframes start {
        0%,30% {opacity: 0;-webkit-transform: translate(0,10px);}
        60% {opacity: 1;-webkit-transform: translate(0,0);}
        100% {opacity: 0;-webkit-transform: translate(0,-8px);}
    }
    @-moz-keyframes start {
        0%,30% {opacity: 0;-moz-transform: translate(0,10px);}
        60% {opacity: 1;-moz-transform: translate(0,0);}
        100% {opacity: 0;-moz-transform: translate(0,-8px);}
    }
    @keyframes start {
        0%,30% {opacity: 0;transform: translate(0,10px);}
        60% {opacity: 1;transform: translate(0,0);}
        100% {opacity: 0;transform: translate(0,-8px);}
    }
    </style>
</head>

<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 38px; height: 70px; left: 232px; top: 45px; transform: rotateZ(40deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 58px; height: 92px; left: 260px; top: 210px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont2.png"></li>
                <li class="ani" style="width: 78px; height: 159px; right: 0; top: 225px; transform: rotateZ(2deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.gif"></li>
                <li class="ani" style="width: 115px; height: 99px; left: 67px; top: 470px; transform: rotateZ(279deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont2.gif"></li>
                <li class="ani" style="width: 102px; height: 186px; left: 82px; top: -21px; transform: rotateZ(302deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont1.png"></li>
                <li class="ani" style="width: 255px; height: 418px; left: 50%;margin-left: -127px; top: 80px;border: 2px solid rgb(168, 168, 168);" swiper-animate-effect="rotateIn" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 225px; height: 262px; left: -68px; top: 44px; transform: rotateZ(337deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.7s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.gif"></li>
                <li class="ani" style="width: 110px; height: 198px; left: -20px; top: 325px; transform: rotateZ(342deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.gif"></li>
                <li class="ani" style="width: 98px; height: 156px; right: 0; top: 79px; transform: rotateZ(16deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont5.gif"></li>
                <li class="ani" style="width: 237px; height: 400px; left: 50%;margin-left: -118px; top: 91px;background-color: #fff;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 85px; height: 141px; right: 0; top: 390px; transform: rotateZ(45deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont3.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 237px; top: 169px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 65px; top: 65px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 56px; top: 326px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 38px; height: 38px; left: 244px; top: 73px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.4s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont4.png"></li>
                <li class="ani" style="width: 238px; height: 29px; left: 50%;margin-left: -119px; top: 460px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont5.png"></li>
                <li class="ani" style="width: 165px; height: 165px; left: 50%;margin-left: -82px; top: 250px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.png"></li>
                <li class="ani" style="width: 108px; height: 189px; left: 50%;margin-left: -54px; top: 115px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="3s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.png"></li>
                <li class="ani" style="width: 163px; height: 90px; left: 50%;margin-left: -82px; top: 309px;color: rgb(230, 181, 6); font-size: 24px; background-color: rgba(230, 181, 6, 0);font-weight: bold;text-align: center;" swiper-animate-effect="swing" swiper-animate-duration="2s" swiper-animate-delay="0s">对不起！<br>您还没有举办过婚宴</li>
                <li class="ani" style="width: 171px; height: 30px; left: 50%;margin-left: -85px; top: 380px;line-height: 16px; font-size: 12px;color: rgb(103, 103, 103); text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0.9s"></li>
                <li class="ani" style="width: 143px; height: 46px; left: 50%;margin-left: -72px; top: 405px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont8.png"></li>
                <li class="ani" style="width: 73px; height: 72px; left: 255px; top: 450px; " swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont6.gif"></li>
                <li class="ani" style="width: 54px; height: 48px; left: 223px; top: 472px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.3s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont7.gif"></li>
            </ul>  
        </section>        
    </div>    
  <div class="swiper-pagination"></div>  
</div>

<?php $this->load->view('common/jsfooter')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <script type="text/javascript">
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('swiper.min.js', 'wap')?>', '<?php echo css_js_url('swiper.animate.min.js', 'wap')?>'], function(p){
		p.load();
		$(function(){
		    scaleW=window.innerWidth/320;
		    scaleH=window.innerHeight/480;
		    var resizes = document.querySelectorAll('.resize');
		          for (var j=0; j<resizes.length; j++) {
		           resizes[j].style.width=parseInt(resizes[j].style.width)*scaleW+'px';
		           resizes[j].style.height=parseInt(resizes[j].style.height)*scaleH+'px';
		           resizes[j].style.top=parseInt(resizes[j].style.top)*scaleH+'px';
		           resizes[j].style.left=parseInt(resizes[j].style.left)*scaleW+'px'; 
		          }
		          
		    var mySwiper = new Swiper ('.swiper-container', {
		        direction : 'vertical',
		        pagination: false,
		        mousewheelControl : true,
		        onInit: function(swiper){
		        swiperAnimateCache(swiper);
		        swiperAnimate(swiper);
		    },
		    onSlideChangeEnd: function(swiper){
		        swiperAnimate(swiper);
		    },
		    onTransitionEnd: function(swiper){
		        swiperAnimate(swiper);
		    },  
		    
		    watchSlidesProgress: true,
		        onProgress: function(swiper){
		        for (var i = 0; i < swiper.slides.length; i++){
		            var slide = swiper.slides[i];
		            var progress = slide.progress;
		            var translate = progress*swiper.height/4;  
		            scale = 1 - Math.min(Math.abs(progress * 0.5), 1);
		            var opacity = 1 - Math.min(Math.abs(progress/2),0.5);
		            slide.style.opacity = opacity;
		            es = slide.style;
		            es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = 'translate3d(0,'+translate+'px,-'+translate+'px) scaleY(' + scale + ')';
		        }
		    },
		    
		    onSetTransition: function(swiper, speed) {
		        for (var i = 0; i < swiper.slides.length; i++){
		            es = swiper.slides[i].style;
		            es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = speed + 'ms';
		            }
		        },
		    })  

		    var myVideo=document.getElementById("media");
		    $(".audio_btn").click(function() {
		        $(this).toggleClass("rotate");
		        if($(".audio_btn").hasClass("rotate")){
		            myVideo.play();
		        }
		        else{
		           myVideo.pause(); 
		        }
		    });
		}); 
    })
    </script>
</body>
</html>

