<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
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
    <a class=" album-save use" style="position: fixed;z-index:999999;width:100px;height:30px;background-color: rgba(0,0,0,0.4);border-radius:3px;top:20px;text-align: center;line-height:30px;    text-decoration: none; left:20px;color:#fff;" href="/h5album/invit/<?php echo $template_id?>">
        <span style="font-size:16px;">使用模板</span>
    </a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg1.jpg); "></div>
            <ul>
                <li class="ani" style="width: 216px; height: 63px; left: 125px; top: 438px;color: rgb(211, 65, 65);line-height: 30px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    &nbsp;<?php echo isset($elements[$page_ids[0]][4]['default']) ?  $elements[$page_ids[0]][4]['default'] : '山东省 潍坊市 奎文区 福寿东街6636号1号楼'?>
                </li>
                <li class="ani" style="width: 52px; height: 28px; left: 70px; top: 440px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont1.png">
                </li>
                <li class="ani" style="width: 191px; height: 191px; left: 50%; top: 200px;margin-left: -95px; border-radius: 160px;overflow: hidden;" swiper-animate-effect="rotateIn" swiper-animate-duration="6s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[0]][2]['default']) ?  get_img_url($elements[$page_ids[0]][2]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 218px; height: 199px; left: 50%; top: 195px;margin-left: -109px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont2.png">
                </li>
                <li class="ani" style="width: 189px; height: 36px; left: 50%; top: 160px;margin-left: -95px;color: rgb(211, 65, 65);text-align: center;line-height: 36px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '王伟'?> &nbsp;&amp; &nbsp;
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '王丽'?>
                </li>
                <li class="ani" style="width: 216px; height: 36px; left: 125px; top: 395px;color: rgb(211, 65, 65);line-height: 36px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <?php echo isset($elements[$page_ids[0]][3]['default']) ?  $elements[$page_ids[0]][3]['default'] : '九月二十九日十二时'?>
                </li>
                <li class="ani" style="width: 49px; height: 34px; left: 70px; top: 400px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont3.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 80px; height: 32px; left: 164px; top: 42px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont4.png">
                </li>
                <li class="ani" style="width: 22px; height: 42px; left: 244px; top: 36px;" swiper-animate-effect="wobble" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont5.png">
                </li>
                <li class="ani" style="width: 47px; height: 25px; left: 250px; top: 435px;" swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont6.png">
                </li>
                <li class="ani" style="width: 86%; height: 180px; left: 7%; top: 88px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 170px; height: 160px; left: 8%; top: 215px; border: 4px solid rgb(255, 255, 255);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[1]][1]['default']) ?  get_img_url($elements[$page_ids[1]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 165px; height: 140px; left: 15%; top: 335px;box-shadow: rgb(245, 230, 230) 0px 0px 0px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[1]][2]['default']) ?  get_img_url($elements[$page_ids[1]][2]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 72px; height: 99px; left: 250px; top: 266px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont7.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 210px; height: 250px; right: 40px; top: 45px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 290px; height: 180px; right: 40px; top: 320px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][1]['default']) ?  get_img_url($elements[$page_ids[2]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 80px; height: 109px; left: 18px; top: 68px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont7.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 93%; left: 0; top: 20px;bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont8.png">
                </li>
                <li class="ani" style="width: 265px; height: 335px; left: 50%; top: 80px;margin-left: -133px;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 20px; height: 21px; left: 60%; top: 450px; " swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont9.png">
                </li>
                <li class="ani" style="width: 80px; height: 52px; left: 50%; top: 440px;margin-left: -40px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont10.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 93%; left: 0; top: 20px;bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont8.png">
                </li>
                <li class="ani" style="width: 223px; height: 282px; left: 50%; top: 80px;margin-left: -112px;" swiper-animate-effect="showBreath" swiper-animate-duration="6s" swiper-animate-delay="0.5s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 20px; height: 23px; left: 60%; top: 450px;" swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont9.png">
                </li>
                <li class="ani" style="width: 80px; height: 52px; left: 50%; top: 440px;margin-left: -40px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont10.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 93%; left: 0; top: 20px;bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont8.png">
                </li>
                <li class="ani" style="width: 265px; height: 335px; left: 50%; top: 80px;margin-left: -133px;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 24px; height: 27px; left: 261px; top: 490px;" swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont9.png">
                </li>
                <li class="ani" style="width: 290px; height: 65px; left: 13px; top: 450px;color: rgb(121, 196, 80);" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <?php echo isset($elements[$page_ids[5]][1]['default']) ?  $elements[$page_ids[5]][1]['default'] : '人生最大的幸福，是发现自己爱的人正好也爱着自己。'?>
                </li>
            </ul>            
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style=" background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 93%; left: 0; top: 20px;bottom: 20px;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont8.png">
                </li>
                <li class="ani" style="width: 265px; height: 335px; left: 50%; top: 80px;margin-left: -133px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 284px; height: 72px; left: 50%;margin-left: -142px; top: 450px;color: rgb(121, 196, 80);" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '时间会告诉我们 ：简单的喜欢，最长远；平凡中的陪伴，最心安；懂你的人，最温暖；彼此相爱就是幸福。'?>
                </li>
                <li class="ani" style="width: 24px; height: 27px; right: 50px; top: 500px; " swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont9.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 93%; left: 0; top: 20px;bottom: 20px;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont8.png">
                </li>
                <li class="ani" style="width: 221px; height: 280px; left: 50%; top: 80px; margin-left: -110px;" swiper-animate-effect="showBreath" swiper-animate-duration="6s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 286px; height: 45px; left: 50%;margin-left: -143px; top: 415px;color: rgb(121, 196, 80);text-align: center;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '愿无岁月可回头，且以深情共白首。'?>
                </li>
                <li class="ani" style="width: 24px; height: 27px; right: 50px; top: 460px;" swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont9.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg4.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 230px; left: 0; top: 20px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont11.png">
                </li>
                <li class="ani" style="width: 89px; height: 64px; left: 50%; top: 145px;margin-left: -44px;" swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont12.png">
                </li>
                <li class="ani" style="width: 416px; height: 104px; left: 50%; top: 256px; margin-left: -208px;" swiper-animate-effect="flipInY" swiper-animate-duration="3s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont13.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; top: 290px;margin-left: -160px;color: #ff5400;line-height: 36px;text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <?php echo isset($elements[$page_ids[8]][0]['default']) ?  $elements[$page_ids[8]][0]['default'] : '再次感谢百忙之中 前来赴宴的贵宾们'?>
                </li>
                <li class="ani" style="width: 235px; height: 30px; left: 50%; top: 374px;margin-left: -117px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="1.5s" swiper-animate-delay="3.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont14.png">
                </li>
                <li class="ani" style="width: 122px; height: 38px; left: 40px; top: 414px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="4s">
                    <a href="tel:<?php echo isset($elements[$page_ids[8]][1]['default']) ?  $elements[$page_ids[8]][1]['default'] : '183xxxx2550'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont15.png"></a>
                </li>
                <li class="ani" style="width: 115px; height: 36px; right: 40px; top: 413px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="4s">
                    <a href="tel:<?php echo isset($elements[$page_ids[8]][2]['default']) ?  $elements[$page_ids[8]][2]['default'] : '183xxxx2550'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont16.png"></a>
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 126px; height: 90px; left: 50%; top: 36px;margin-left: -63px;" swiper-animate-effect="bounceIn" swiper-animate-duration="6s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont12.png">
                </li>
                <li class="ani" style="width: 80px; height: 11px; right: 35px; top: 86px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont17.png">
                </li>
                <li class="ani" style="width: 80px; height: 11px; left: 35px; top: 86px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont17.png">
                </li>
                <li class="ani" style="width: 308px; height: 38px; left: 50%; top: 130px;margin-left: -154px;color: #f4711f;text-align: center;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[9]][0]['default']) ?  $elements[$page_ids[9]][0]['default'] : '婚礼倒计时：吉时已到'?>
                </li>
                <li class="ani" style="width: 275px; height: 175px; left: 50%; top: 173px;margin-left: -138px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/map.png">
                </li>
                <li class="ani" style="width: 305px; height: 110px; left: 50%; top: 365px;margin-left: -152px;color: #f4711f;text-align: center;line-height: 35px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                   <?php echo isset($elements[$page_ids[9]][1]['default']) ?  $elements[$page_ids[9]][1]['default'] : '席设：万达铂尔曼酒店'?> <br>
                   <?php echo isset($elements[$page_ids[9]][2]['default']) ?  $elements[$page_ids[9]][2]['default'] : '地址：山东省 潍坊市 奎文区 福寿东街6636号1号楼'?> 
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model8-bg2.jpg); "></div>
            <ul>
                <li class="ani" style="width: 275px; height: 246px; left: 50%; top: 120px;margin-left: -138px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[10]][0]['default']) ?  get_img_url($elements[$page_ids[10]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 278px; height: 247px; left: 50%; top: 120px;margin-left: -139px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont18.png">
                </li>
                <li class="ani" style="width: 133px; height: 83px; left: 50%; top: 38px;margin-left: -66px;" swiper-animate-effect="flipInY" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont10.png">
                </li>
                <li id="bless" class="ani" style="width: 102px; height: 38px; left: 55px; top: 416px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont19.png">
                </li>
                <li id="message" class="ani" style="width: 107px; height: 36px; right: 55px; top: 414px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont20.png">
                </li>
                <li class="ani" style="display:none;width: 110px; height: 37px; left: 50%; top: 380px;margin-left: -55px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model8-cont21.png">
                </li>
            </ul>                 
        </section>       
    </div>    
    <div class="swiper-pagination"></div>
    <div class="popup bless">
        <a href="javascript:;" class="close_mask"></a>
        <div id="post_zone">
            <form method="post">
                <table width="100%" class="szf" cellspacing="10">
                    <tr>
                        <td width="40" align="center">姓名:</td>
                        <td><input class="name" type="text" id="send" style="height:28px;"></td>
                    </tr>
                    <tr>
                        <td width="40" align="center">来宾:</td>
                        <td>
                            <select name="whos" id="whos" style="width:100px">
                                <option value="1">男方</option>
                                <option value="2">女方</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">寄语:</td>
                        <td>
                            <textarea id="content" class="input" name="content" style="width:180px;height:28px;" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>（注：留言内容限60字以内）</td>
                    </tr>
                    <tr>
                        <td align="center">出席:</td>
                        <td><select name="num" id="wall_num" style="height:28px;">
                            <option value="0">待定</option>
                            <option value="1" selected>1人出席</option>
                            <option value="2">2人出席</option>
                            <option value="3">3人出席</option>
                            <option value="4">4人出席</option>
                            <option value="5">5人出席</option>
                            <option value="6">6人出席</option>
                            <option value="7">7人出席</option>
                            <option value="8">8人出席</option>
                            <option value="9">9人出席</option>
                            <option value="10">10人出席</option>
                            <option value="11">不出席</option>
                        </select></td>
                    </tr>
                </table>
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
        seajs.use([
		   '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('swiper.min.js', 'wap')?>',
           '<?php echo css_js_url('swiper.animate.min.js', 'wap')?>',
           
           

        ], function(h5){
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

		})
    </script>
</body>
</html>
