<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目名称</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('animate.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('new_h5.css', 'wap');?>" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">   
    
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
    <div class="audio_btn rotate">
        <audio loop="true" src="<?php echo get_img_url($music);?>" id="media" autoplay preload=""></audio>
    </div>
    <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;font-size:16px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/invit/<?php echo $template_id?>">
            返回修改</a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-bg1.jpg">
                </li>
                <li class="ani" style="width: 257px; height: 74px; left: 11px; top: 52px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont1.png">
                </li>
                <li class="ani" style="width: 164px; height: 35px; left: 148px; top: 121px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont2.png">
                </li>
                <li class="ani" style="width: 307px; height: 46px; left: 9px; top: 150px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="0.5s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont3.png">
                </li>
                <li class="ani" style="width: 304px; height: 251px; left: 50%;margin-left: -152px; top: 240px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont4.png">
                </li>
                <li class="ani" style="width: 276px; height: 46px;top: 275px; left: 50%;margin-left: -138px;color: rgb(86, 54, 121);text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1.2s">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '李坤'?>
                    &amp; 
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '韩敏'?>
                </li>
                <li class="ani" style="width: 178px; height: 20px; top: 315px; left: 50%;margin-left: -89px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont5.png">
                </li>
                <li class="ani" style="width: 278px; height: 49px; left: 50%;margin-left: -139px; top: 345px;color: #563679;text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '524天3小时13分'?>
                </li>
                <li class="ani" style="width: 263px; height: 92px; left: 50%;margin-left: -132px; top: 375px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont6.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 892px; height: 100%; left: -300px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="18s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-bg2.jpg">
                </li>
                <li class="ani" style="width: 904px; height: 100%; left: -292px; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont7.png">
                </li>
                <li class="ani" style="width: 288px; height: 36px; left:50%; margin-left: -144px; top: 65px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont8.png">
                </li>
                <li class="ani" style="width: 260px; height: 12px; left: 50%; margin-left: -130px; top: 165px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont9.png" style="width: 317px; margin-left: -28.5px;">
                </li>
                <li class="ani" style="width: 260px; height: 12px; left: 50%; margin-left: -130px; top: 280px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont10.png">
                </li>
                <li class="ani" style="width: 320px; height: 92px; left: 50%; margin-left: -160px; top: 200px;color: rgb(255, 255, 255);text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '万达广场铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 320px; height: 46px; left: 50%; margin-left: -160px; top: 115px;text-align: center;color: #fff;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[1]][0]['default']) ?  $elements[$page_ids[1]][0]['default'] : '李坤'?>
                    &amp; 
                    <?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : '韩敏'?>
                </li>
                <li class="ani" style="width: 280px; height: 56px; left: 50%; margin-left: -140px; top: 310px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont11.png">
                </li>
                <li class="ani" style="width: 320px; height: 41px; left: 50%; margin-left: -160px; top: 375px;color: #fff;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0.4s">
                    <?php echo isset($elements[$page_ids[1]][3]['default']) ?  $elements[$page_ids[1]][3]['default'] : '2018年05月21日17:39'?>
                </li>
                <li class="ani" style="width: 184px; height: 118px; left: 50%; margin-left: -94px; top: 420px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont12.png">
                </li>
            </ul>            
        </section>
        <section class="swiper-slide">     
            <ul>
                <li class="ani" style="width: 300px; height: 194px; left: 50%;margin-left: -150px; top: 32px; " swiper-animate-effect="fadeInLeft" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>" style="transform: rotateZ(-6deg);">
                </li>
                <li class="ani" style="width: 280px; height: 184px; left: 50%;margin-left: -140px; top: 335px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][1]['default']) ?  get_img_url($elements[$page_ids[2]][1]['default']) : ''?>" style=" transform: rotateZ(9deg);">
                </li>
            </ul>                
        </section>
        <section class="swiper-slide"> 
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>" style="width: 788px; height: 100%; margin-left: -216px;">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="3s" swiper-animate-delay="2.5s">
                    <img src="<?php echo isset($elements[$page_ids[3]][1]['default']) ?  get_img_url($elements[$page_ids[3]][1]['default']) : ''?>" style="width: 788px; height: 100%; margin-left: -216px;">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2.5s" swiper-animate-delay="4.5s">
                    <img src="<?php echo isset($elements[$page_ids[3]][2]['default']) ?  get_img_url($elements[$page_ids[3]][2]['default']) : ''?>" style="width: 788px; height: 100%;  margin-left: -216px;">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2.5s" swiper-animate-delay="7s">
                    <img src="<?php echo isset($elements[$page_ids[3]][3]['default']) ?  get_img_url($elements[$page_ids[3]][3]['default']) : ''?>" style="width: 788px; height: 100%; margin-left: -216px;">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0; " swiper-animate-effect="showBreath" swiper-animate-duration="12s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide"> 
            <ul>
                <li class="ani" style="width: 810px; height: 100%; left: -250px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="12s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>" style="width: 831px; height: 100%;margin-left: -231px;left: -172px;">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][1]['default']) ?  get_img_url($elements[$page_ids[6]][1]['default']) : ''?>" style="width: 831px; height: 100%;  margin-left: -231px; left: -90px;">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-bg3.jpg">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont13.png">
                </li>
                <li class="ani" style="width: 71px; height: 28px; left: 34px; top: 66px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont14.png">
                </li>
                <li class="ani" style="width: 243px; height: 91px; left: 27px; top: 117px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont15.png">
                </li>
                <li class="ani" style="width: 168px; height: 47px; left: 105px; top: 58px;color: #fff;line-height: 47px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <?php echo isset($elements[$page_ids[7]][0]['default']) ?  $elements[$page_ids[7]][0]['default'] : '李坤'?>
                </li>
                <li class="ani" style="width: 266px; height: 176px; left: 50%;margin-left: -133px; top: 267px; transform: rotateZ(-8deg);border: 5px solid rgb(255, 255, 255);border-radius: 21px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[7]][1]['default']) ?  get_img_url($elements[$page_ids[7]][1]['default']) : ''?>" style="width: 266px; height: 177px;">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-bg3.jpg">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont13.png">
                </li>
                <li class="ani" style="width: 71px; height: 28px; left: 34px; top: 66px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont16.png">
                </li>
                <li class="ani" style="width: 168px; height: 47px; left: 105px; top: 58px;color: #fff;line-height: 47px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <?php echo isset($elements[$page_ids[8]][0]['default']) ?  $elements[$page_ids[8]][0]['default'] : '韩敏'?>
                </li>
                <li class="ani" style="width: 266px; height: 176px; left: 50%;margin-left: -133px; top: 267px; transform: rotateZ(8deg);border: 5px solid rgb(255, 255, 255); border-radius: 21px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[8]][1]['default']) ?  get_img_url($elements[$page_ids[8]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 264px; height: 66px; left: 23px; top: 113px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont17.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[9]][0]['default']) ?  get_img_url($elements[$page_ids[9]][0]['default']) : ''?>" style="width: 100%; height: 100%; ">
                </li>
                <li class="ani" style="width: 307px; height: 315px; left: 50%;margin-left: -153px; top: 47px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont18.png">
                </li>
                <li class="ani" style="width: 219px; height: 49px; left: 50%;margin-left: -110px; top: 78px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont19.png">
                </li>
                <li class="ani" style="width: 100px; height: 30px; left: 50%;margin-left: -50px; top: 113px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont20.png">
                </li>
                <li class="ani" style="width: 262px; height: 23px;left: 50%;margin-left: -131px; top: 139px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont21.png">
                </li>
                <li class="ani" style="width: 61px; height: 19px; left: 50%;margin-left: -30px; top: 167px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont22.png">
                </li>
                <li class="ani" style="width: 127px; height: 19px; left: 50%;margin-left: -63px; top: 229px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont23.png">
                </li>
                <li class="ani" style="width: 178px; height: 20px; left: 50%;margin-left: -89px; top: 260px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont24.png">
                </li>
                <li class="ani" style="width: 260px; height: 96px; left: 50%;margin-left: -100px; top: 280px;color: #563679;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[9]][2]['default']) ?  $elements[$page_ids[9]][2]['default'] : '地址：万达广场铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 288px; height: 39px; left: 50%;margin-left: -144px; top: 186px;color: rgb(86, 54, 121);text-align: center;line-height: 39px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[9]][1]['default']) ?  $elements[$page_ids[9]][1]['default'] : '2018年05月21日17:39'?>
                </li>
                <li class="ani" style="width: 150px; height: 48px; left: 50%;margin-left: -75px; top: 371px;" swiper-animate-effect="bounceIn" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont25.png"></a>
                </li>
                <li class="ani" style="width: 8rem; height: 45px; left: 30px; top: 421px;" swiper-animate-effect="bounceIn" swiper-animate-duration="1s" swiper-animate-delay="2s">
                    <a href="tel:<?php echo isset($elements[$page_ids[9]][3]['default']) ?  $elements[$page_ids[9]][3]['default'] : '130xxxx5785'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont26.png"></a>
                </li>
                <li class="ani" style="width: 8rem; height: 46px; right: 30px; top: 420px;" swiper-animate-effect="bounceIn" swiper-animate-duration="1s" swiper-animate-delay="2.5s">
                    <a href="tel:<?php echo isset($elements[$page_ids[9]][4]['default']) ?  $elements[$page_ids[9]][4]['default'] : '130xxxx5785'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont27.png"></a>
                </li>
            </ul>            
        </section>
        <section class="swiper-slide"> 
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[10]][0]['default']) ?  get_img_url($elements[$page_ids[10]][0]['default']) : ''?>" style="width: 100%; height: 100%; ">
                </li>
                <li class="ani" style="width: 286px; height: 294px;left: 50%;margin-left: -143px; top: 70px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont28.png">
                </li>
                <li class="ani" style="width: 219px; height: 49px; left: 50%;margin-left: -110px; top: 88px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont29.png">
                </li>
                <li class="ani" style="width: 100px; height: 30px; left: 50%;margin-left: -50px; top: 131px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont30.png">
                </li>
                <li class="ani" style="width: 262px; height: 23px; left: 50%;margin-left: -131px; top: 158px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont31.png">
                </li>
                <li class="ani" style="width: 8rem; height: 48px; left: 30px; top: 428px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img id="bless" src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont32.png">
                </li>
                <li class="ani" style="width: 8rem; height: 46px; right: 30px; top: 428px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="/h5album/bless/<?php echo $user_info['id']?>"> <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont33.png"></a>
                </li>
                <li class="ani" style="display:none ;width: 150px; height: 46px; left: 50%;margin-left: -75px; top: 383px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont34.png">
                </li>
                <li class="ani" style="width: 264px; height: 33px; left: 50%;margin-left: -132px; top: 180px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont35.png">
                </li>
                <li class="ani" style="width: 197px; height: 59px; left: 50%;margin-left: -98px; top: 233px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.8s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont36.png">
                </li>
                <li class="ani" style="width: 287px; height: 39px; left: 50%;margin-left: -143px;top: 306px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model4-cont37.png" style="width: 347px; height: 39px; margin-left: -30px;">
                </li>
            </ul>                 
        </section>       
    </div>    
    <div class="swiper-pagination"></div> 
    <div class="popup bless" >
        <a href="javascript:;" class="close_mask"></a>
        <div id="post_zone">
            <form method="post">
                <table width="100%" class="szf" cellspacing="10">
                    <tr>
                        <td width="40" align="center">姓名:</td>
                        <td><input class="name" type="text" name="name" id="name" style="height:28px;"></td>
                    </tr>
                    <tr>
                        <td width="40" align="center">来宾:</td>
                        <td>
                            <select  id="whos" style="width:100px;height:28px;" name="whos" >
                                <option value="1">男方</option>
                                <option value="2">女方</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">寄语:</td>
                        <td>
                            <textarea id="content" class="input" name="content" style="width:180px" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>（注：留言内容限60字以内）</td>
                    </tr>
                    <tr>
                        <td align="center">出席人数:</td>
                        <td><select  id="wall_num" name="wall_num" style="height:28px;">
                            <?php foreach ($attend_num as $k=>$v):?>
                            <option value="<?php echo $k?>" <?php if($k == 0):?>selected<?php endif;?>><?php if($v == 11):?>不出席<?php else:?> <?php echo $v?><?php endif;?></option>
                            <?php endforeach;?>
                        </select></td>
                    </tr>
                </table>
                <input type="hidden" name="template_id" value="<?php echo $template_id;?>" />
            </form>
            <div id="btn_zone">
                <a class="btn fl">提交</a>
                <a class="btn fr">查看</a>
            </div>
        </div>
    </div> 
    <div class="popup message">
        <a href="javascript:;" class="close_mask"></a>
        <div id="infos_list">
            <ul>
                <li>
                姓名：<span>王伟</span><br>
                出席：1人出席<br>
                祝福：玉侠           </li>
                <li>
                姓名：<span>吴浩楠</span><br>
                出席：1人出席<br>
                祝福：新婚快乐         </li>
            </ul>
        </div>
    </div> 
</div>

<?php $this->load->view('common/jsfooter')?>
<script type="text/javascript">
		var wxConfig = <?php echo $wxConfigJSON?>;
		var host_id = "<?php echo $host_id?>";
		var template_id = "<?php echo $template_id?>";
        seajs.use([
		   '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('swiper.min.js', 'wap')?>',
           '<?php echo css_js_url('swiper.animate.min.js', 'wap')?>',
           
           

        ], function(h5){
          h5.submit();
          h5.pup();
          h5.autoPlayMusic();
          
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
          onSlideChangeStart: function(){//当滑块滚动开始调用
              console.log(mySwiper.activeIndex);//当前滑块索引号
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

          
          var index = mySwiper.activeIndex;
          
		})
    </script>
</body>
</html>
