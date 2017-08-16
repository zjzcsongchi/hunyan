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
    <a style="position: absolute;z-index:9999;font-size:16px;width:80px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; right:50px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user_view.png)" href="/h5album/show/<?php echo $template_id?>/<?php echo $user_info['id']?>">
            预览
    </a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[0]?>/0">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model12-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 228px; height: 74px; left: 50%; top: 102px;margin-left: -114px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont1.png">
                </li>
                <li class="ani" style="width: 100%; height: 73px; left: 0; top: 360px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont2.png">
                </li>
                <li class="ani" style="width: 248px; height: 40px; right: 0px; top: 377px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont3.png">
                </li>
                <li class="ani" style="width: 169px; height: 19px; left: 145px; top: 387px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont4.png">
                </li>
                <li class="ani" style="width: 106px; height: 37px; left: 13px; top: 374px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont5.png">
                </li>
                <li class="ani" style="width: 131px; height: 36px; left: 25px; top: 268px;color: rgb(255, 255, 255);text-align: right;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '田凯'?> 
                </li>
                <li class="ani" style="width: 131px; height: 36px; right: 25px; top: 268px;color: rgb(255, 255, 255);text-align: left;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '许丽丽'?> 
                </li>
                <li class="ani" style="width: 320px; height: 50px; left: 50%; top: 437px;color: rgb(255, 255, 255);margin-left: -160px;text-align: center;">
                    <br><?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '婚礼倒计时:555天4小时20分'?>
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[1]?>/1">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model12-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 133px; height: 133px; left: 30px; top: 120px;border-radius: 160px; overflow: hidden;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 133px; height: 133px; right: 30px; top: 350px;border-radius: 160px;overflow: hidden;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[1]][1]['default']) ?  get_img_url($elements[$page_ids[1]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 147px; height: 24px; left: 82px; top: 280px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont6.png">
                </li>
                <li class="ani" style="width: 168px; height: 21px; left: 74px; top: 315px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont7.png">
                </li>
                <li class="ani" style="width: 160px; height: 36px; left: 170px; top: 170px;color: rgb(53, 55, 131);text-align: center;" swiper-animate-effect="bounceInRight" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                   <?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '新郎：田凯'?>
                </li>
                <li class="ani" style="width: 160px; height: 36px; left: 10px; top: 400px;color: rgb(53, 55, 131);text-align: center;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                   <?php echo isset($elements[$page_ids[1]][3]['default']) ?  $elements[$page_ids[1]][3]['default'] : '新娘：许丽丽'?> 
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">    
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[2]?>/2">
        <span style="font-size:16px;">编辑此页</span></a>  
            <ul>
                <li class="ani" style="width: 90%; height: 35%; left: 5%; top: 45px; " swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 45%; height: 40%; right: 7%; top: 35%;border: 4px solid rgb(255, 255, 255);" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][1]['default']) ?  get_img_url($elements[$page_ids[2]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 142px; height: 36px; left: 10px; top: 45%;color: rgb(38, 79, 137);font-weight: bold;font-size: 18px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    我们相遇了
                </li>
                <li class="ani" style="width: 169px; height: 162px; left: 10px; top: 50%; color: rgb(38, 92, 150);font-size: 12px;line-height: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    在时间的洪流中<br>于千万人之中 <br>没有早一步 没有晚一步<br>在一个对的时间<br>彼此都熟悉的城市<br>刚好再次相遇
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[3]?>/3">
        <span style="font-size:16px;">编辑此页</span></a>      
            <ul>
                <li class="ani" style="width: 300px; height: 195px; left: 50%; top: 40px; margin-left: -150px; " swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 304px; height: 19px; left: 50%; top: 245px;margin-left: -152px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont8.png">
                </li>
                <li class="ani" style="width: 136px; height: 131px; left: 8px; top: 347px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont9.png">
                </li>
                <li class="ani" style="width: 80px; height: 49px; left: 37px; top: 384px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont10.png">
                </li>
                <li class="ani" style="width: 147px; height: 50px; right: 30px; top: 480px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont11.png">
                </li>
                <li class="ani" style="width: 196px; height: 113px; right: 30px; top: 340px;color: rgb(47, 85, 161);text-align: right;font-size: 12px;line-height: 25px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                    缘分是一个很有魔力的东西<br>冥冥之中<br>两个人拉在了一起
                </li>
                <li class="ani" style="width: 175px; height: 68px; right: 30px; top: 290px;color: rgb(47, 85, 161);text-align: right;font-size: 12px;line-height: 25px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                    他说：我愿照顾你一生<br>她说：我的一生拜托了
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[4]?>/4">
        <span style="font-size:16px;">编辑此页</span></a>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="8s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 324px; height: 508px; left: 50%; top: 50%;margin: -254px 0 0 -162px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont12.png">
                </li>
                <li class="ani" style="width: 100%; height: 71px; left: 0; top: 362px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont13.png">
                </li>
                <li class="ani" style="width: 267px; height: 40px; left: 20px; top: 380px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.6s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont14.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[5]?>/5">
        <span style="font-size:16px;">编辑此页</span></a>   
            <ul>
                <li class="ani" style="width: 290px; height: 336px; left: 50%; top: 40px;margin-left: -145px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 174px; height: 121px; left: 50%; bottom: 50px;color: rgb(92, 95, 184);margin-left: -87px;text-align: center;line-height: 30px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    一愿郎君千岁，<br>二愿妾身常健，<br>三愿如同梁上燕，<br>岁岁长相见。
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[6]?>/6">
        <span style="font-size:16px;">编辑此页</span></a>      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 159px; height: 159px; left: 50%; top: 312px;margin-left: -80px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont15.png">
                </li>
                <li class="ani" style="width: 131px; height: 87px; left: 50%; top: 350px;margin-left: -65px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont16.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[7]?>/7">
        <span style="font-size:16px;">编辑此页</span></a>        
            <ul>
                <li class="ani" style="width: 105px; height: 29px; left: 5%; top: 54px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: fadeInDown 1.5s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont17.png"></div>
                </li>
                <li class="ani" style="width: 99px; height: 10px; left: 5%; top: 78px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: zoomIn 2s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont18.png"></div>
                </li>
                <li class="ani" style="width: 90%; height: 10px; left: 5%; top: 82px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont19.png">
                </li>
                <li class="ani" style="width: 90%; height: 10px; left: 5%; top: 320px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont19.png">
                </li>
                <li class="ani" style="width: 133px; height: 20px; right: 5%; top: 68px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont20.png">
                </li>
                <li class="ani" style="width: 90%; height: 196px; left: 5%; top: 115px;border-radius: 22px;text-align: center;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                    <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 226px; height: 34px; left: 50%; bottom: 50px;margin-left: -113px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont21.png">
                </li>
                <li class="ani" style="width: 288px; height: 121px; left: 25px; top: 350px;color: rgb(73, 98, 184);line-height: 40px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                    想，每天醒来第一眼就能看见你<br>念，每一分每一秒都是你<br>你，是我最重要的决定
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[8]?>/8">
        <span style="font-size:16px;">编辑此页</span></a>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="8s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 324px; height: 508px; left: 50%; top: 50%;margin: -254px 0 0 -162px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont22.png">
                </li>
                <li class="ani" style="width: 100%; height: 71px; left: 0; top: 362px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont13.png">
                </li>
                <li class="ani" style="width: 196px; height: 42px; left: 62px; top: 378px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.6s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont23.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[9]?>/9">
        <span style="font-size:16px;">编辑此页</span></a>  
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[9]][0]['default']) ?  get_img_url($elements[$page_ids[9]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 66px; height: 32px; right: 78px; bottom: 155px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont24.png">
                </li>
                <li class="ani" style="width: 175px; height: 116px; right: 25px; bottom: 60px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont25.png">
                </li>
                <li class="ani" style="width: 126px; height: 93px; right: 48px; bottom: 65px;color: rgb(54, 93, 168);text-align: center;font-size: 12px;line-height: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                    一定是<br>特别的缘分<br>才可以一路走来<br>变成了一家人
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">   
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[10]?>/10">
        <span style="font-size:16px;">编辑此页</span></a>   
            <ul>
                <li class="ani" style="width: 55%; height: 25%; left: 20px; top: 5%;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[10]][0]['default']) ?  get_img_url($elements[$page_ids[10]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 55%; height: 25%; left: 20px; top: 35%;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <img src="<?php echo isset($elements[$page_ids[10]][1]['default']) ?  get_img_url($elements[$page_ids[10]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 55%; height: 25%; left: 20px; top: 65%;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[10]][2]['default']) ?  get_img_url($elements[$page_ids[10]][2]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 30px; top: 87px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont26.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 30px; top: 140px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont27.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 30px; top: 185px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont28.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 30px; top: 230px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont29.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 60px; top: 290px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.6s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont30.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 60px; top: 340px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.8s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont27.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 60px; top: 390px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont31.png">
                </li>
                <li class="ani" style="width: 30px; height: 40px; right: 60px; top: 440px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="1.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont32.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">   
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[11]?>/11">
        <span style="font-size:16px;">编辑此页</span></a>     
            <ul>
                <li class="ani" style="width: 65%; height: 100%; right: 0px; top: 0;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[11]][0]['default']) ?  get_img_url($elements[$page_ids[11]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 35px; height: 520px; left: 75px; top: -181px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont33.png">
                </li>
                <li class="ani" style="width: 35px; height: 520px; left: 5px; top: 195px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont33.png">
                </li>
                <li class="ani" style="width: 23px; height: 434px; left: 46px; top: 46px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.6s" swiper-animate-delay="0.8s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont34.png">
                </li>
                <li class="ani" style="width: 30px; height: 30px; left: 77px; top: 88px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont35.png">
                </li>
                <li class="ani" style="width: 30px; height: 30px; left: 77px; top: 135px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont35.png">
                </li>
                <li class="ani" style="width: 30px; height: 30px; left: 77px; top: 182px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont35.png">
                </li>
                <li class="ani" style="width: 30px; height: 30px; left: 7px; top: 422px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont35.png">
                </li>
                <li class="ani" style="width: 30px; height: 30px; left: 7px; top: 376px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont35.png">
                </li>
                <li class="ani" style="width: 30px; height: 30px; left: 7px; top: 328px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont35.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[12]?>/12">
        <span style="font-size:16px;">编辑此页</span></a>
            <ul>
                <li class="ani" style="width: 282px; height: 360px; left: 50%; top: 126px;margin-left: -141px;" swiper-animate-effect="rollIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[12]][0]['default']) ?  get_img_url($elements[$page_ids[12]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 79px; height: 36px; left: 214px; top: 31px;color: rgb(101, 114, 158);text-align: right;font-weight: bold;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    爱情
                </li>
                <li class="ani" style="width: 223px; height: 36px; left: 72px; top: 58px;color: rgb(82, 95, 163); text-align: right;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.2s">
                    你陪着我 我牵着你
                </li>
                <li class="ani" style="width: 204px; height: 36px; left: 92px; top: 83px;color: rgb(55, 94, 171);text-align: right;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="1.2s">
                    不用多语 静静地走下去
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[13]?>/13">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model12-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 84%; height: 194px; left: 8%; bottom: 70px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[13]][0]['default']) ?  get_img_url($elements[$page_ids[13]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 173px; height: 247px; left: 8%; top: 60px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[13]][1]['default']) ?  get_img_url($elements[$page_ids[13]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 37px; height: 32px; right: 20%; top: 75px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont36.png">
                </li>
                <li class="ani" style="width: 122px; height: 119px; right: 10%; top: 120px;color: rgb(90, 106, 166);text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    如果你仔细<br>寻找，你会<br>发现爱其实<br>无处不在。
                </li>
            </ul>             
        </section>
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[14]?>/14">
        <span style="font-size:16px;">编辑此页</span></a>     
            <ul>
                <li class="ani" style="width: 100%; height: 35%; left: 0; top: 0;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[14]][0]['default']) ?  get_img_url($elements[$page_ids[14]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 55%; height: 60%; right: 0; bottom: 0;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[14]][1]['default']) ?  get_img_url($elements[$page_ids[14]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 103px; height: 36px; left: 10px; top: 40%;color: rgb(77, 95, 158);text-align: center;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    多年后
                </li>
                <li class="ani" style="width: 147px; height: 172px; left: 10px; top: 45%;color: rgb(70, 105, 158);line-height: 30px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.6s">
                    我们白发苍苍<br>回首曾经的这些<br>我们一起欢笑<br>一起歌唱<br>一起回想
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[15]?>/15">
        <span style="font-size:16px;">编辑此页</span></a>        
            <ul>
                <li class="ani" style="width: 167px; height: 89px; left: 50%; top: 35px;margin-left: -83px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont37.png">
                </li>
                <li class="ani" style="width: 254px; height: 312px; left: 50%; top: 140px;margin-left: -127px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[15]][0]['default']) ?  get_img_url($elements[$page_ids[15]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 246px; height: 36px; left: 50%; top: 480px;color: rgb(66, 98, 179);margin-left: -123px;text-align: center;" swiper-animate-effect="twisterInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    相守就是最浪漫的告白
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[16]?>/16">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model12-bg4.jpg);"></div>
            <ul>
                <li class="ani" style="width: 94px; height: 26px; left: 26px; top: 56px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont39.png">
                </li>
                <li class="ani" style="width: 99px; height: 10px; left: 23px; top: 80px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont18.png">
                </li>
                <li class="ani" style="width: 272px; height: 10px; left: 23px; top: 82px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont19.png">
                </li>
                <li class="ani" style="width: 133px; height: 20px; left: 163px; top: 69px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont38.png">
                </li>
                <li class="ani" style="width: 320px; height: 140px; left: 50%; top: 130px;color: rgb(53, 75, 131);margin-left: -160px;text-align: center;line-height: 30px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    谨定于<br><?php echo isset($elements[$page_ids[16]][0]['default']) ?  $elements[$page_ids[16]][0]['default'] : '2018年06月30日14:07'?>
                    <br>举行结婚典礼<br>敬备喜宴 恭候光临
                </li>
                <li class="ani" style="width: 281px; height: 122px; left: 50%; top: 260px;color: rgb(53, 75, 131);margin-left: -140px;text-align: center;line-height: 35px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.3s" swiper-animate-delay="0.5s">
                    <br><?php echo isset($elements[$page_ids[16]][1]['default']) ?  $elements[$page_ids[16]][1]['default'] : '喜宴地址：潍坊市铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 128px; height: 32px; left: 50%; top: 365px;margin-left: -64px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont40.png"></a>
                </li>
                <li class="ani" style="width: 124px; height: 31px; left: 30px; top: 417px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href="tel:<?php echo isset($elements[$page_ids[16]][2]['default']) ?  $elements[$page_ids[16]][2]['default'] : '139xxxx3658'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont41.png"></a>
                </li>
                <li class="ani" style="width: 128px; height: 31px; right: 30px; top: 417px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href="tel:<?php echo isset($elements[$page_ids[16]][3]['default']) ?  $elements[$page_ids[16]][3]['default'] : '139xxxx3658'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont42.png"></a>
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[17]?>/17">
        <span style="font-size:16px;">编辑此页</span></a>  
            <ul>
                <li class="ani" style="width: 140px; height: 140px; right: 40px; top: 220px;border-radius: 50%;overflow: hidden;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.7s">
                    <img src="<?php echo isset($elements[$page_ids[17]][0]['default']) ?  get_img_url($elements[$page_ids[17]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 140px; height: 140px; left: 40px; top: 125px;border-radius: 50%;overflow: hidden;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.7s">
                    <img src="<?php echo isset($elements[$page_ids[17]][1]['default']) ?  get_img_url($elements[$page_ids[17]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 99px; height: 10px; left: 23px; top: 80px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont18.png">
                </li>
                <li class="ani" style="width: 94px; height: 26px; left: 26px; top: 56px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont43.png">
                </li>
                <li id="bless" class="ani" style="width: 128px; height: 32px; left: 30px; top: 460px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont44.png">
                </li>
                <li class="ani" style="width: 272px; height: 10px; left: 23px; top: 82px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont19.png">
                </li>
                <li  class="ani" style="width: 128px; height: 32px; right: 30px; top: 460px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href="/h5album/bless/<?php echo $user_info['id']?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont45.png"></a>
                </li>
                <li class="ani" style="display:none;width: 128px; height: 32px; left: 50%; top: 400px; margin-left: -64px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href=""><img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont46.png"></a>
                </li>
                <li class="ani" style="width: 144px; height: 18px; left: 153px; top: 71px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model12-cont47.png">
                </li>
            </ul>             
        </section>        
    </div>    
    <div class="swiper-pagination"></div> 
       <?php $this->load->view('common/bless')?>
</div>

<?php $this->load->view('common/jsfooter')?>
<script type="text/javascript">
        var wxConfig = <?php echo $wxConfigJSON?>;
        var host_id = "<?php echo $user_info['id']?>";
        var per_page = "<?php echo $per_page?>";
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
          mySwiper.slideTo(per_page);
		})
    </script>
</body>
</html>
