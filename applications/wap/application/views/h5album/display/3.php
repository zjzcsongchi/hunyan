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
    </style>
</head>

<body onmousewheel="return false;">

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
                <li class="ani" style="width: 100%;; height: 90%;; left: 0px; top: 5%;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img id="p1e1" class="wxuploader" data-group="g1"  src="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"  ></li>
                <li class="ani" style="width: 100%;; height: 90%;; left: 0px; top: 5%;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0.2s"><img id="p1e2" class="wxuploader" data-group="g1" src="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"  ></li>
                <li class="ani" style="width: 100%; height: 35%; left: 0px; bottom: 0px;"><img src="<?php echo $domain['static']['url']?>/wap/images/album2-cont1.png"></li>
                <li class="ani" style="width: 100%; height: 38px; left: 0; bottom: 110px;text-align: center;color: rgb(0, 0, 0);" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.4s">在路上遇见另一个自己</li>
                <li class="ani" style="width: 100%; height: 68px; left: 0; bottom: 40px; font-size: 24px;text-align: center;color: rgb(0, 0, 0); font-weight: bold;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">P E R S O N A L I T Y<br>P H O T O S</li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 98%; left: 0; top: 1%; border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.2s"><img id="p2e1" class="wxuploader" src="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                <li class="ani" style="width: 320px; height: 42px; left: 50%;margin-left: -160px; top: 357px; text-align: right;font-weight: bold; font-size: 14px;color: rgb(255, 255, 255);" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0.8s">寻找／心灵的归宿</li>
                <li class="ani" style="width: 134px; height: 60px; left: 20px; top: 50px;font-size: 18px;color: rgb(0, 0, 0);line-height: 30px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.6s">NOT<br> NORMAL</li>
                <li class="ani" style="width: 0; height: 0; right: 0; top: 0;border-top: 300px solid #fff;border-left: 100px solid transparent; " swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 0; height: 0; left: 0; bottom: 0;border-bottom: 300px solid #fff;border-right: 100px solid transparent;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 320px; height: 62px; left: 50%;margin-left: -160px; top: 275px;font-weight: bold;color: rgb(255, 255, 255);font-size: 24px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s">P E R S O N A L I T Y<br>P H O T O S</li>
                <li class="ani" style="width: 320px; height: 2px; left: 50%;margin-left: -160px; top: 345px;background-color: #fff;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s"></li>
                <li class="ani" style="width: 320px; height: 42px; left: 50%;margin-left: -160px; top: 385px;text-align: right;font-weight: bold; font-size: 14px;color: rgb(255, 255, 255);" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="1s">释放自己的美</li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 138px; height: 172px; left: 4%; top: 6%;color: rgb(51, 51, 51); font-size: 32px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s">P<br>HO<br>TO<br>S</li>
                <li class="ani" style="width: 70%; height: 65%; right: 0; top: 27%; border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0.2s">
                    
                    <img id="p3e1" class="wxuploader" src="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                
                </li>
                <li class="ani" style="width: 125px; height: 89px; right: 15px; top: 52px;text-align: right;color: rgb(0, 0, 0); font-size: 12px;line-height: 25px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0.8s">2017<br>04<br>02</li>
                <li class="ani" style="width: 18px; height: 239px; left: 64px; top: 246px;color: rgb(51, 51, 51); font-size: 12px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.8s">寻找前所未有的自己</li>
                <li class="ani" style="width: 40%; height: 30%; left: 3%; top: 5%; border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.4s"></li>
                <li class="ani" style="width: 25%; height: 22%; left: 18%; top: 5%; border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                
                    <img id="p3e2" class="wxuploader" src="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                
                </li>
            </ul>                 
        </section> 
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 80%; left: 0px; top: 15px;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                
                    <img id="p4e1" class="wxuploader" src="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                
                </li>
                <li class="ani" style="width: 200px; height: 260px; left: 50%;margin-left: -100px; bottom: 30px;border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s"></li>
                <li class="ani" style="width: 100%; height: 62px; left: 0px; bottom: 180px;color: rgb(255, 255, 255); font-weight: bold;font-size: 24px;text-align: center;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.2s">P E R S O N A L I T Y<br>P H O T O S</li>
                <li class="ani" style="width: 100%; height: 50px; left: 0px; bottom: 60px;text-align: center;color: rgb(0, 0, 0);font-size: 12px; font-weight: bold;line-height: 25px;font-weight: bold;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.4s">珍贵时光，需要独享！<br>致无处安放的青春</li>
                <li class="ani" style="width: 100%; height: 30px; left: 0px; bottom: 110px;font-weight: bold; font-size: 16px;text-align: center;color: rgb(0, 0, 0);" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.4s">个 . 性 .摄 .记</li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 62px; left: 0px; top: 45px;text-align: center;font-weight: bold;font-size: 24px;color: rgb(0, 0, 0);" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">P E R S O N A L I T YM<br>P H O T O S</li>
                <li class="ani" style="width: 100%; height: 38px; left: 0px; top: 110px;text-align: center;font-weight: bold;font-size: 24px;color: rgb(0, 0, 0);" swiper-animate-effect="flipInY" swiper-animate-duration="1s" swiper-animate-delay="0.2s">个 .性 .摄 .记</li>
                <li class="ani" style="width: 100%; height: 30px; left: 0px; top: 150px;font-weight: bold; font-size: 12px;text-align: center;color: rgb(0, 0, 0);" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.4s">在路上遇见另一个自己</li>
                <li class="ani" style="width: 82%; height: 60%; left: 9%; top: 180px;border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                
                <img id="p5e1" class="wxuploader" src="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"">
                
                </li>
                <li class="ani" style="width: 319px; height: 62px; left: 20px; top: 380px;color: rgb(51, 51, 51);font-size: 12px;line-height: 25px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.4s">撑开自信的帆破流向前，<br>展示搏击的风采。</li>
                <li class="ani" style="width: 134px; height: 61px; left: 20px; top: 435px;font-size: 24px;color: rgb(0, 0, 0);" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0.6s">NOT<br> NORMAL</li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 320px; height: 62px; right: 20px; top: 50px;text-align: right;font-weight: bold;font-size: 24px; color: rgb(0, 0, 0);" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s">P E R S O N A L I T Y<br>P H O T O S</li>
                <li class="ani" style="width: 320px; height: 38px; right: 20px; top: 120px;font-weight: bold; font-size: 16px;text-align: right;color: rgb(0, 0, 0);" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s">个 .性 .摄 .记</li>
                <li class="ani" style="width: 66%; height: 49%; right: 0px; bottom: 60px;border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="0s">
                
                    <img id="p6e1" class="wxuploader" src="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                <li class="ani" style="width: 32%; height: 26%; left: 0px; bottom: 60px;border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.2s">
                
                    <img id="p6e2" class="wxuploader" src="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 230px; height: 62px; right: 20px; top: 145px;color: rgb(51, 51, 51);font-size: 12px;text-align: right;line-height: 25px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s">选取自信，<br>就离成功再近了一步。</li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 254px; height: 254px; left: 50%;margin-left: -127px; top: 180px;border-radius: 50%;overflow: hidden;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.2s">
                
                    <img id="p7e1" class="wxuploader" src="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 50%; height: 100%; left: 0px; top: 0;background-color: #fff;"></li>
                <li class="ani" style="width: 48%; height: 206px; left: 0; top: 190px;text-align: right;font-size: 15px;color: rgb(0, 0, 0);line-height: 30px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">生命太短暂，<br>哪有时间去遗憾！<br>做最好的自己，<br>无需苛求他人！<br>永远相信那句话：<br>你若盛开，<br>清风自来。</li>
                <li class="ani" style="width: 100%; height: 62px; left: 0px; top: 40px; text-align: center;font-weight: bold;font-size: 24px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.2s">P E R S O N A L I T Y<br>P H O T O S</li>
                <li class="ani" style="width: 100%; height: 38px; left: 0px; top: 120px;text-align: center;font-weight: bold; font-size: 16px;color: rgb(0, 0, 0);" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.4s">个 .性 .摄 .记</li>
                <li class="ani" style="width: 100%; height: 62px; left: 1px; top: 460px;text-align: center;font-weight: bold; font-size: 12px;line-height: 25px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0.4s">珍惜当下的好时光，是你需要做的最对的事情。<br>珍贵时光，需要独享！</li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 92%; height: 2px; left: 8%; top: 405px;background-color: #000;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s"></li>
                <li class="ani" style="width: 260px; height: 67px; left: 8%; top: 460px;color: rgb(51, 51, 51); font-size: 12px;line-height: 20px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">你不仅要跟别人不一样，<br>你还要有能够辨识的自我标签。</li>
                <li class="ani" style="width: 100%; height: 45%; left: -1px; top: 20px;border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0.2s">
                
                    <img id="p8e1" class="wxuploader" src="<?php echo isset($elements['p8e1']) ?  get_img_url($elements['p8e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 307px; height: 63px; left: 8%; top: 330px;font-weight: bold;font-size: 24px;color: rgb(0, 0, 0);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.2s">P E R S O N A L I T Y<br>P H O T O S</li>
                <li class="ani" style="width: 320px; height: 38px; left: 8%; top: 425px; font-weight: bold; font-size: 16px;color: rgb(0, 0, 0);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.4s">个 . 性 .摄 .记</li>
                <li class="ani" style="width: 12px; height: 11px; right: 50px; top: 510px;background-color: #000;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.6s"></li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 70%; height: 55%; left: 5px; top: 165px;border: 1px solid rgb(0, 0, 0);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                
                    <img id="p9e1" class="wxuploader" src="<?php echo isset($elements['p9e1']) ?  get_img_url($elements['p9e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 320px; height: 62px; right: 15px; top: 70px;text-align: right;font-weight: bold; font-size: 48px;color: rgb(0, 0, 0);" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s">I'M HERE</li>
                <li class="ani" style="width: 320px; height: 38px; right: 15px; top: 60px;font-weight: bold; font-size: 12px;color: rgb(0, 0, 0);text-align: right;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s">致我们无处安放的青春</li>
                <li class="ani" style="width: 14px; height: 392px; right: 15px; top: 130px;color: rgb(51, 51, 51); font-size: 14px;text-align: center;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">做自己想做的事情，去自己想去的地方<br>，<br>完美<br>！</li>
                <li class="ani" style="width: 14px; height: 302px; right: 45px; top: 130px; color: rgb(51, 51, 51); font-size: 14px;text-align: center;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0.2s">去努力完成自己曾经的梦想<br>。<br>完美<br>！</li>
                <li class="ani" style="width: 12px; height: 12px; right: 45px; top: 450px;background-color: #000;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.6s"></li>
            </ul>
        </section>  
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 40%; height: 45%; right: 0px; top: 48%;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1s">
                
                    <img id="p10e1" class="wxuploader" src="<?php echo isset($elements['p10e1']) ?  get_img_url($elements['p10e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                
                </li>
                </li>
                <li class="ani" style="width: 100%; height: 45%; left: 0px; top: 3%; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                
                    <img id="p10e2" class="wxuploader" src="<?php echo isset($elements['p10e2']) ?  get_img_url($elements['p10e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 100%; height: 100px; left: 0px; top: 150px;background-color: rgba(255,255,255,0.36);" swiper-animate-effect="flipInX" swiper-animate-duration="2s" swiper-animate-delay="0.2s"></li>
                <li class="ani" style="width: 100%; height: 38px; left: 0px; top: 165px;color: rgb(255, 255, 255); font-size: 24px;text-align: center;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.4s">P E R S O N A L I T Y</li>
                <li class="ani" style="width: 100%; height: 38px; left: 0px; top: 205px;color: rgb(255, 255, 255); font-size: 18px;text-align: center;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.6s">个 . 性 . 摄 . 记</li>
                <li class="ani" style="width: 55%; height: 36px; left: 0px; top: 385px;color: rgb(0, 0, 0);font-size: 24px;text-align: right;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.2s">P H O N O T S</li>
                <li class="ani" style="width: 55%; height: 46px; left: 0px; top: 420px;color: rgb(51, 51, 51); font-size: 14px;text-align: right;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.4s">POINT PRPRICE</li>
                <li class="ani" style="width: 55%; height: 42px; left: 0px; top: 445px;text-align: right;color: rgb(51, 51, 51); font-size: 12px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.6s">珍贵时光，需要独享！</li>
            </ul>
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 254px; height: 254px; left: 50%;margin-left: -127px; top: 220px; border: 1px solid rgb(0, 0, 0);border-radius: 50%;overflow: hidden;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.2s">
                
                    <img id="p11e1" class="wxuploader" src="<?php echo isset($elements['p11e1']) ?  get_img_url($elements['p11e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>"></li>
                
                </li>
                <li class="ani" style="width: 50%; height: 100%; left: 0px; top: 0px;background-color: #fff;"></li>
                <li class="ani" style="width: 48%; height: 206px; left: 0px; top: 220px;text-align: right;color: rgb(0, 0, 0);font-size: 15px;line-height: 30px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">生命太短暂，<br>哪有时间去遗憾！<br>做最好的自己，<br>无需苛求他人！<br>永远相信那句话：<br>你若盛开，<br>清风自来。</li>
                <li class="ani" style="width: 320px; height: 62px; right: 20px; top: 50px;font-size: 24px;font-weight: bold;text-align: right;">T R A V E L<br>P H O T O S</li>
                <li class="ani" style="width: 230px; height: 62px; right: 20px; top: 140px;text-align: right;color: rgb(0, 0, 0);font-size: 14px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">相信自己，<br>就离成功再近了一步</li>
                <li class="ani" style="width: 320px; height: 38px; right: 20px; top: 115px; font-weight: bold; font-size: 16px;text-align: right;">行 .走 .摄 .记</li>
            </ul>
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record-bg.gif);"></div>
            <ul>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px;" swiper-animate-effect="puffIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url'].'/wap/images/record-cont12.png' ;?>"></li>
                <li class="ani" style="width: 44px; height: 74px; left: 52px; top: -8px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 37px; height: 63px; right: 0px; bottom: 200px; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 37px; height: 63px; left: -7px; bottom: 0px; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 100%; height: 38px; left: 0px; top: 335px;text-align: center;color: rgb(255, 222, 117); font-size: 18px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1s">识别二维码关注百年婚宴</li>
                <li class="ani" style="width: 322px; height: 38px; left: 50%;margin-left: -156px; top: 500px;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1.5s"><a  style="color: rgb(255, 222, 117); font-size: 18px; font-weight: bold;">点击访问百年官网</a></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px;" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px;" swiper-animate-effect="rollIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px; " swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>

                <li class="ani" style="width: 135px; height: 135px; left: 50%;margin-left: -67px; top: 161px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-bg10.jpg"></li>
                <li class="ani" style="width: 59px; height: 59px; left: 50%;margin-left: -30px; top: 415px;" swiper-animate-effect="flash" swiper-animate-duration="2s" swiper-animate-delay="0s"><a href="<?php echo $domain['mobile']['url']?>" ><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont15.png"></a></li>
            </ul>
        </section>
        
  
    </div>
  <div class="swiper-pagination"></div>
</div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    	
        
        seajs.use([
           '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('swiper.min.js', 'wap')?>',
           '<?php echo css_js_url('swiper.animate.min.js', 'wap')?>',
        ], function(h5){

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
