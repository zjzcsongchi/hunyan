<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('animate.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('h5.css', 'wap');?>" type="text/css" rel="stylesheet" />
    
    <link href="<?php echo css_js_url('my_dialog.css', 'wap');?>" type="text/css" rel="stylesheet" />

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
    .swiper-slide{overflow: hidden;}
    </style>
</head>

<body>

<div class="swiper-container">
    <div class="audio_btn rotate">
        <audio loop="true" src="<?php echo get_img_url($music);?>" id="media" autoplay preload=""></audio>
    </div>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0px; top: 0px;background-color: #c62828;"></li>               
                <li class="ani" style="z-index: 1; width: 180px; height: 180px; left: 50%;margin-left: -90px; top: 53px;border-radius: 50%;overflow: hidden; " swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                
                    <img id="p1e1" class="wxuploader" src="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 252px; height: 252px; left: 50%;margin-left: -126px; top: 20px;" swiper-animate-effect="rotateIn" swiper-animate-duration="18s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont1.png"></li>
                <li class="ani" style="width: 100%; height: 100%; left: 0px; top: 180px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 100%; height: 40px; left: 0px; top: 190px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.6s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont2.png"></li>
                <li class="ani" style="width: 300px; height: 90px; left: 50%;margin-left: -150px; top: 270px;font-size: 18px;color: rgb(97, 21, 33);line-height: 30px;" swiper-animate-effect="flipInX" swiper-animate-duration="1s" swiper-animate-delay="1.2s">在时间的洪流中,于千万人之中，没有早一步，没有晚一步，在一个对的时间,彼此都熟悉的城市,刚好相遇</li>
                <li class="ani" style="width: 200px; height: 116px; left: 50%;margin-left: -100px; top: 400px;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont3.png"></li>
                <li class="ani" style="width: 100%; height: 40px; left: 0px; bottom: 0px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.6s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont2.png" style=" transform: rotateZ(180deg);"></li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0px; top: 0px;background-color: #c62828;"></li>
                <li class="ani" style="width: 96%; height: 90%; left: 2%; top: 5%;" swiper-animate-effect="flipInX" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont4.png"></li>
                <li class="ani" style="width: 100%; height: 35px; left: 0px; top: 3%;"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont5.png"></li>
                <li class="ani" style="width: 100%; height: 35px; left: 0px; bottom: 3%;"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont5.png"></li>
                <li class="ani" style="width: 100%; height: 130px; left: 0px; top: 58px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont6.png"></li>
                <li class="ani" style="width: 238px; height: 158px; left: 50%;margin-left: -119px; top: 110px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    
                    <img id="p2e1" class="wxuploader" src="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                    
                </li>
                <li class="ani" style="width: 24px; height: 52px; left: 205px; top: 68px;" swiper-animate-effect="bounceInDown" swiper-animate-duration="1s" swiper-animate-delay="0.4s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont7.png"></li>                
                <li class="ani" style="width: 374px; height: 123px; left: -150px; bottom: 195px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont6.png"></li>
                <li class="ani" style="width: 238px; height: 158px; left: 50%;margin-left: -125px; bottom: 100px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.6s">
                
                    <img id="p2e2" class="wxuploader" src="<?php echo isset($elements['p2e2']) ?  get_img_url($elements['p2e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 24px; height: 53px; left: 95px; bottom: 255px;" swiper-animate-effect="bounceInDown" swiper-animate-duration="1s" swiper-animate-delay="1.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont7.png"></li>
                <li class="ani" style="width: 174px; height: 44px; right: 25px; bottom: 60px;" swiper-animate-effect="bounceInRight" swiper-animate-duration="1s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont9.png"></li>
                <li class="ani" style="width: 92px; height: 90px; left: 15px; top: 50%;margin-top: -46px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="1s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont8.png"></li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0px; top: 0px;background-color: #c62828;"></li>
                <li class="ani" style="width: 100%; height: 532px; left: 0px; bottom: -70px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 238px; height: 158px; left: 50%;margin-left: -125px; bottom: 275px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0.6s">
                
                    <img id="p3e1" class="wxuploader" src="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 100%; height: 500px; left: 0px; bottom: -180px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 238px; height: 158px; left: 50%;margin-left: -125px; bottom: 130px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                
                    <img id="p3e3" class="wxuploader" src="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 100%; height: 400px; left: 0px; bottom: -220px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0.4s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 238px; height: 140px; left: 50%;margin-left: -125px; bottom: 10px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                
                    <img id="p3e3" class="wxuploader" src="<?php echo isset($elements['p3e3']) ?  get_img_url($elements['p3e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 134px; height: 100px; left: 50%;margin-left: -67px; top: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont12.png"></li>
                <li class="ani" style="width: 80px; height: 70x; left: 20x; top: 40px;" swiper-animate-effect="wobble" swiper-animate-duration="10s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont11.png"></li>
                <li class="ani" style="width: 80px; height: 70px; right: 20px; top: 40px;" swiper-animate-effect="wobble" swiper-animate-duration="01s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont11.png"></li>
            </ul> 
        </section> 
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0px; top: 0px;background-color: #c62828;"></li>
                <li class="ani" style="width: 390px; height: 100%; left: -330px; top: 0px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 390px; height: 100%; right: -330px; top: 0px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 240px; height: 160px; left: 50%;margin-left: -126px; top: 126px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0.6s">
                
                    <img id="p4e1" class="wxuploader" src="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>              
                <li class="ani" style="width: 240px; height: 160px; left: 50%;margin-left: -126px; top: 346px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                
                    <img id="p4e2" class="wxuploader" src="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 114px; height: 100px; left: -65px; top: 10px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont14.png"></li>
                <li class="ani" style="width: 114px; height: 100px; right: -65px; top: 10px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont14.png"></li>
                <li class="ani" style="width: 306px; height: 47px; left: 50%;margin-left: -153px; top: 298px;background-color: rgb(219, 0, 34);text-align: center;line-height: 47px;font-size: 24px;color: rgb(255, 179, 11);" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">爱要永远在一起</li>
                <li class="ani" style="width: 200px; height: 73px; left: 50%;margin-left: -100px; top: 25px;"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont15.png"></li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0px; top: 0px;background-color: #c62828;"></li>
                <li class="ani" style="width: 100%; height: 240px; left: 0px; top: 130px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 114px; height: 100px; left: -45px; top: 10px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont14.png"></li>
                <li class="ani" style="width: 114px; height: 100px; right: -45px; top: 10px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="2.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont14.png"></li>
                <li class="ani" style="width: 180px; height: 92px; left: 50%;margin-left: -90px; top: 20px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont16.png"></li>
                <li class="ani" style="width: 300px; height: 200px; left: 50%;margin-left: -150px; top: 145px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.6s">
                
                    <img id="p5e1" class="wxuploader" src="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 100%; height: 240px; left: 0px; top: 390px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 300px; height: 200px; left: 50%;margin-left: -150px; top: 405px;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.2s">
                
                    <img id="p5e2" class="wxuploader" src="<?php echo isset($elements['p5e2']) ?  get_img_url($elements['p5e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="album-save ani" style="color: white;
                                               top:55px;
                                               display: block;
                                               right: 20px;
                                               z-index: 900;
                                               width: 35px;
                                               height: 35px;
                                               background-color: rgba(0, 0, 0, 0.6);
                                               border-radius: 50%;
                                               text-align: center;">
                                        点击保存
                </li>
                <li class="ani" style="width: 105%; height: 100%; left: 0px; top: -5px;"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 400px; height: 400px; left: 50%;margin-left: -200px; top: -200px;" swiper-animate-effect="bounceInDown" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont13.png"></li>
                <li class="ani" style="width: 400px; height: 400px; left: 50%;margin-left: -200px; bottom: -200px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont13.png"></li>
                <li class="ani" style="width: 90%; height: 64%; left: 5%; top: 18%;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="0.4s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont10.png"></li>
                <li class="ani" style="width: 38%; height: 34%; left: 8%; top: 20%;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="twisterInUp" swiper-animate-duration="1s" swiper-animate-delay="0.6s">
                
                    <img id="p6e1" class="wxuploader" src="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 81%; height: 21%; left: 8%; top: 58%;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="2s" swiper-animate-delay="1s">
                
                    <img id="p6e2" class="wxuploader" src="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 38%; height: 34%; right: 8%; top: 20%;border:solid 6px #fff;box-shadow: rgb(145, 99, 0) 0px 2px 2px;" swiper-animate-effect="twisterInUp" swiper-animate-duration="1s" swiper-animate-delay="0.8s">
                
                    <img id="p6e3" class="wxuploader" src="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 180px; height: 79px; left: 50%;margin-left: -90px; top: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s"><img src="<?php echo $domain['static']['url']?>/wap/images/album3-cont17.png"></li>
            </ul>                 
        </section>
        <input id="template_id" type="hidden" name="template_id" value="<?php echo $template_id;?>" />
        
    </div>    
    <div class="swiper-pagination"></div>  
</div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    	var wxConfig = <?php echo $wxConfigJSON?>;
        
        seajs.use([
           '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('swiper.min.js', 'wap')?>',
           '<?php echo css_js_url('swiper.animate.min.js', 'wap')?>',
        ], function(h5){
          h5.template4();
          h5.autoPlayMusic();

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

            }); 

		})
    </script>

</body>
</html>
