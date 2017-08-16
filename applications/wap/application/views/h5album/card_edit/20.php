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
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[0]][0]['default']) ?  get_img_url($elements[$page_ids[0]][0]['default']) : ''?>);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 98%; left: 0; top: 1%;background-color: rgba(77,59,82,0.7); " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont1.png"></li>
                <li class="ani" style="width: 34px; height: 29px; left: 50%;margin-left: -17px; top: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 174px; height: 122px; left: 50%;margin-left: -87px; top: 110px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont3.png"></li>
                <li class="ani" style="width: 320px; height: 38px; left: 50%;margin-left: -160px; top: 279px;color: rgb(255, 255, 255);font-size: 18px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '小卡卡'?></li>
                <li class="ani" style="width: 30px; height: 26px; left: 50%;margin-left: -15px; top: 322px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 320px; height: 38px; left: 50%;margin-left: -160px; top: 350px;color: rgb(255, 255, 255);font-size: 18px;text-align: center;line-height: 38px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '小丁丁'?></li>
                <li class="ani" style="width: 320px; height: 38px; left: 50%;margin-left: -160px; top: 448px;color: rgba(250, 150, 186, 0.5); font-size: 15px;text-align: center;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <?php echo isset($elements[$page_ids[0]][3]['default']) ?  $elements[$page_ids[0]][3]['default'] : '2020.09.20'?></li>
            </ul> 
        </section>  
        <section class="swiper-slide">
         <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[1]?>/1">
        <span style="font-size:16px;">编辑此页</span></a>   
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>);"></div>
            <ul>
                <li class="ani" style="width: 170px; height: 100%; left: 0; top: 0;background-color: rgba(77,59,82,0.7);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 34px; height: 29px; left: 68px; top: 119px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 29px; height: 25px; left: 75px; top: 241px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 320px; height: 63px; left: -76px; top: 180px;color: rgb(255, 255, 255); font-size: 12px;text-align: center;line-height: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">他遇到了她<br>故事由此开始</li>
                <li class="ani" style="width: 320px; height: 39px; left: -76px; top: 155px; color: rgba(250, 150, 186, 0.5); font-size: 16px;text-align: center;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">SOME DAY</li>
                <li class="ani" style="width: 14px; height: 364px; left: 78px; top: -250px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont4.png"></li>
                <li class="ani" style="width: 14px; height: 364px; left: 82px; top: 284px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont4.png"></li>
            </ul>             
        </section>
        <section class="swiper-slide"> 
         <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[2]?>/2">
        <span style="font-size:16px;">编辑此页</span></a>     
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 250px; left: 0; bottom: 0;background-color: rgba(77,59,82,0.7);" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 34px; height: 29px; left: 50%;margin-left: -17px; bottom: 200px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 320px; height: 90px; left: 50%;margin-left: -160px; bottom: 20px;color: rgb(255, 255, 255); font-size: 12px;text-align: center;line-height: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">她说：<br>你猝不及防的到来，却给了我<br>我要的细水长流的温暖</li>
                <li class="ani" style="width: 320px; height: 90px; left: 50%;margin-left: -160px; bottom: 100px; color: rgba(250, 150, 186, 0.5); font-size: 12px;text-align: center;line-height: 25px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">他说：<br>那时，我从不曾知道，你漂亮的眉眼，<br>因为我而弯。<br></li>
                <li class="ani" style="width: 14px; height: 364px; left: -100px; bottom: -50px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont4.png" style=" transform: rotateZ(90deg);"></li>
                <li class="ani" style="width: 14px; height: 364px; right: -100px; bottom: -50px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont4.png" style=" transform: rotateZ(90deg);"></li>
            </ul>               
        </section>
        <section class="swiper-slide">  
         <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[3]?>/3">
        <span style="font-size:16px;">编辑此页</span></a>      
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>); "></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont5.png"></li>
                <li class="ani" style="width: 100%; height: 140px; left: 0; top: 276px;background-color: rgba(77,59,82,0.7);" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 34px; height: 29px; right: 45px; top: 15px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont6.png"></li>
                <li class="ani" style="width: 320px; height: 86px; left: 50%;margin-left: -160px; top: 335px;color: rgb(255, 255, 255); font-size: 12px;line-height: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">一生甘苦相伴，生死永不相弃。<br>与你携手，此志不渝，是我给你的诺言。</li>
                <li class="ani" style="width: 320px; height: 36px; left: 49%;margin-left: -160px; top: 303px;color: rgba(250, 150, 186, 0.5); font-size: 20px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">他：</li>
                <li class="ani" style="width: 100%; height: 27px; left: 0; top: 276px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont7.png"></li>
                <li class="ani" style="width: 100%; height: 27px; left: 0; top: 392px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont7.png"></li>
            </ul> 
        </section> 
        <section class="swiper-slide"> 
         <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[4]?>/4">
        <span style="font-size:16px;">编辑此页</span></a>     
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont5.png"></li>
                <li class="ani" style="width: 100%; height: 140px; left: 0; top: 276px;background-color: rgba(77,59,82,0.7);" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 34px; height: 29px;right: 45px; top: 15px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont6.png"></li>
                <li class="ani" style="width: 320px; height: 86px; left: 50%;margin-left: -160px; top: 335px;color: rgb(255, 255, 255); font-size: 12px;line-height: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">挽子青丝，挽子一世情思<br>扶子之肩，驱尔一世沉寂，是我给你的承诺。</li>
                <li class="ani" style="width: 320px; height: 36px; left: 49%;margin-left: -160px; top: 303px;color: rgba(250, 150, 186, 0.5);font-size: 20px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">她：</li>
                <li class="ani" style="width: 100%; height: 27px; left: 0; top: 276px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont7.png"></li>
                <li class="ani" style="width: 100%; height: 27px; left: 0; top: 392px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont7.png"></li>
            </ul>               
        </section>
        <section class="swiper-slide">  
         <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[5]?>/5">
        <span style="font-size:16px;">编辑此页</span></a>    
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;background-color: rgba(77,59,82,0.7);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 300px; height: 350px; left: 50%;margin-left: -150px; top: 120px;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont9.png"></li>
                <li class="ani" style="width: 30px; height: 25px; left: 50%;margin-left: -15px; top: 190px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 100%; height: 39px; left: 0px; top: 225px;color: rgba(250, 150, 186, 0.5); font-size: 20px;text-align: center;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">时间</li>
                <li class="ani" style="width: 144px; height: 122px; left: 50%;margin-left: -72px; top: 40px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont8.png"></li>
                <li class="ani" style="width: 100%; height: 47px; left: 0px; top: 70px;color: rgb(255, 255, 255); font-weight: bold; font-size: 32px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">婚礼详情</li>
                <li class="ani" style="width: 100%; height: 86px; left: 0px; top: 265px;color: rgb(255, 255, 255); font-size: 13px;text-align: center;line-height: 22px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <br><?php echo isset($elements[$page_ids[5]][1]['default']) ?  $elements[$page_ids[5]][1]['default'] : '2020年09月20日星期一 11:58 AM'?></li>
                <li class="ani" style="width: 100%; height: 39px; left: 0px; top: 360px;color: rgba(250, 150, 186, 0.5); font-size: 20px;text-align: center;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">地点</li>
                <li class="ani" style="width: 100%; height: 73px; left: 0px; top: 400px;color: rgb(255, 255, 255); font-size: 13px;text-align: center;line-height: 22px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <br><?php echo isset($elements[$page_ids[5]][2]['default']) ?  $elements[$page_ids[5]][2]['default'] : '广州市天河区幸福路1314号'?></li>
                <li class="ani" style="width: 30px; height: 25px; left: 50%;margin-left: -15px; top: 325px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont2.png"></li>
                <li class="ani" style="width: 100%; height: 39px; left: 0px; top: 460px;color: rgba(250, 150, 186, 0.5);font-size: 13px;text-align: center;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">LOVING YOU</li>
            </ul>                 
        </section>
        <section class="swiper-slide">    
         <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[6]?>/6">
        <span style="font-size:16px;">编辑此页</span></a>    
            <div class="wrapper_bg" style="background-image: url(<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;background-color: rgba(77,59,82,0.7);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s"></li>
                <li class="ani" style="width: 290px; height: 340px; left: 50%;margin-left: -145px; top: 86px;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont9.png"></li>
                <li class="ani" style="width: 174px; height: 121px; left: 50%;margin-left: -87px; top: 132px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont3.png"></li>
                <li class="ani" style="width: 107px; height: 48px; left: 65px; top: 362px;color: rgb(255, 255, 255); line-height: 22px; font-size: 12px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <a style="color:white;" href="tel:<?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '139xxxx9874'?>">联系新郎</a></li>
                <li class="ani" style="width: 100%; height: 39px; left: 0px; top: 410px;color: rgba(250, 150, 186, 0.5); font-size: 13px;text-align: center;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="1s">LOVING</li>
                <li class="ani" style="width: 24px; height: 22px; left: 65px; top: 362px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont10.png"  li="">
                </li><li class="ani" style="width: 24px; height: 22px; right: 135px; top: 362px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1s"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont10.png"></li>
                <li class="ani" style="width: 107px; height: 48px; right: 48px; top: 362px;color: rgb(255, 255, 255); line-height: 22px; font-size: 12px;text-align: center;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <a style="color:white;" href="tel:<?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '139xxxx9874'?>">联系新娘</a></li>
                <li id="bless" class="ani" style="width: 122px; height: 43px; left: 50px; top: 294px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont11.png"></li>
                <li class="ani" style="width: 122px; height: 43px; right: 50px; top: 295px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model16-cont12.png"></a></li>
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
