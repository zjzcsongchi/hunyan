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
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 225px; height: 152px; left: 50%; top: 226px;margin-left: -112px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont1.png">
                </li>
                <li class="ani" style="width: 100%; height: 160px; left: 0; top: 0px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont2.png">
                </li>
                <li class="ani" style="width: 53px; height: 218px; right: 30px; top: 11px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont3.png">
                </li>
                <li class="ani" style="width: 212px; height: 48px; left: 50%; top: 383px;margin-left: -106px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont4.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[1]?>/1">
        <span style="font-size:16px;">编辑此页</span></a> 
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont5.png">
                </li>
                <li class="ani" style="width: 80px; height: 73px; left: 207px; top: 29px;opacity: 0.67;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2.5s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont6.png">
                </li>
                <li class="ani" style="width: 80px; height: 73px; left: 207px; top: 29px;opacity: 0.67;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2.5s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont6.png">
                </li>
                <li class="ani" style="width: 90px; height: 36px; left: 22%; top: 32%;line-height: 36px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                   <?php echo isset($elements[$page_ids[1]][0]['default']) ? $elements[$page_ids[1]][0]['default'] : '李昊'?> 
                </li>
                <li class="ani" style="width: 102px; height: 36px; left: 52%; top: 32%;line-height: 36px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : '田雨蒙'?>
                </li>
                <li class="ani" style="width: 200px; height: 36px; left: 23%; top: 69%;line-height: 36px;text-align: right;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="2.8s">
                    <?php echo isset($elements[$page_ids[1]][0]['default']) ?  $elements[$page_ids[1]][0]['default'] : '李昊'?> &amp;
                    <?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : '田雨蒙'?>
                </li>
                <li class="ani" style="width: 278px; height: 36px; left: 20%; top: 46%;line-height: 36px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.6s">
                    <?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '2016年10月30日22:25'?>
                </li>
                <li class="ani" style="width: 267px; height: 92px; left: 24%; top: 55%;line-height: 40px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.8s">
                    <?php echo isset($elements[$page_ids[1]][3]['default']) ?  $elements[$page_ids[1]][3]['default'] : '潍坊万达广场 · 万达铂尔曼酒店'?>
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[2]?>/2">
        <span style="font-size:16px;">编辑此页</span></a>      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg2.jpg); "></div>
            <ul>
                <li class="ani" style="width: 262px; height: 173px; left: 30px; top: 30px;border: 2px solid rgb(255, 255, 255);" swiper-animate-effect="zoomInRoll" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 250px; height: 166px; right: 30px; top: 230px; border: 2px solid rgb(255, 255, 255);" swiper-animate-effect="flipInY" swiper-animate-duration="3s" swiper-animate-delay="2.5s">
                    <img src="<?php echo isset($elements[$page_ids[2]][1]['default']) ?  get_img_url($elements[$page_ids[2]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 276px; height: 38px; left: 18px; top: 445px; ">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont7.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[3]?>/3">
        <span style="font-size:16px;">编辑此页</span></a>      
            <div class="wrapper_bg" style=" background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 84%; height: 80%; left: 8%; top: 8%;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 92%; height: 84%; left: 4%; top: 5%;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont8.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[4]?>/4">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 268px; height: 181px; left: 50%; top: 46px;margin-left: -134px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 281px; height: 194px; left: 50%; top: 40px;margin-left: -140px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont9.png">
                </li>
                <li class="ani" style="width: 268px; height: 181px; left: 50%; top: 272px;margin-left: -134px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][1]['default']) ?  get_img_url($elements[$page_ids[4]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 281px; height: 194px; left: 50%; top: 265px;margin-left: -140px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont9.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[5]?>/5">
        <span style="font-size:16px;">编辑此页</span></a> 
            <div class="wrapper_bg" style=" background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg3.jpg); "></div>
            <ul>
                <li class="ani" style="width: 90%; height: 90%; left: 5%; top: 5%;" swiper-animate-effect="filterSaturate" swiper-animate-duration="8s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 210px; height: 139px; left: -35px; top: -38px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont10.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[6]?>/6">
        <span style="font-size:16px;">编辑此页</span></a>      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 90%; height: 90%; left: 5%; top: 5%;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[7]?>/7">
        <span style="font-size:16px;">编辑此页</span></a>       
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg3.jpg); "></div>
            <ul>
                <li class="ani" style="width: 90%; height: 90%; left: 5%; top: 5%;" swiper-animate-effect="zoomInRoll" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[8]?>/8">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 223px; height: 39px; left: 12px; top: 133px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont11.png">
                </li>
                <li class="ani" style="width: 125px; height: 41px; left: 90px; top: 174px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont12.png">
                </li>
                <li class="ani" style="width: 274px; height: 173px; left: 50%; top: 229px;margin-left: -137px; border: 2px solid rgb(255, 255, 255); border-radius: 12px;overflow: hidden;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[9]?>/9">
        <span style="font-size:16px;">编辑此页</span></a>  
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg4.jpg); "></div>
            <ul>
                <li class="ani" style="width: 123px; height: 80px; left: -25px; top: -2px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont10.png">
                </li>
                <li class="ani" style="width: 150px; height: 40px; left: 144px; top: 34px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont13.png">
                </li>
                <li class="ani" style="width: 322px; height: 148px; left: 50%; top: 245px;margin-left: -161px;text-align: center;line-height: 35px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                    <br><?php echo isset($elements[$page_ids[9]][0]['default']) ?  $elements[$page_ids[9]][0]['default'] : '距结婚典礼还有30天'?><br>
                    <?php echo isset($elements[$page_ids[9]][1]['default']) ?  $elements[$page_ids[9]][1]['default'] : '席设：万达铂尔曼酒店潍坊万达广场'?>
                </li>
                <li class="ani" style="width: 80px; height: 27px; left: 50%; top: 155px;margin-left: -40px;">
                    <a href=""><img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont14.png"></a>
                </li>
                <li class="ani" style="width: 57px; height: 67px; left: 50%; top: 181px;margin-left: -28px;" swiper-animate-effect="showBreath" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont15.png">
                    </a>
                </li>
                <li class="ani" style="width: 126px; height: 44px; right: 20px; top: 378px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href="tel:<?php echo isset($elements[$page_ids[9]][3]['default']) ?  $elements[$page_ids[9]][3]['default'] : '138xxxx6985'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont16.png"></a>
                </li>
                <li class="ani" style="width: 130px; height: 45px; left: 20px; top: 379px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.2s">
                    <a href="tel:<?php echo isset($elements[$page_ids[9]][2]['default']) ?  $elements[$page_ids[9]][2]['default'] : '138xxxx6985'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont17.png"></a>
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">   
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[10]?>/10">
        <span style="font-size:16px;">编辑此页</span></a>   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model9-bg5.jpg); "></div>
            <ul>
                <li class="ani" style="width: 196px; height: 176px; left: 50%; top: 157px;margin-left: -98px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont18.png">
                </li>
                <li class="ani" style="width: 138px; height: 138px; left: 50%; top: 179px;margin-left: -69px;border-radius: 160px; border: 2px solid rgb(112, 89, 89);overflow: hidden;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[10]][0]['default']) ?  get_img_url($elements[$page_ids[10]][0]['default']) : ''?>">
                </li>
                <li id="bless" class="ani" style="width: 121px; height: 43px; left: 35px; top: 336px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont19.png">
                </li>
                <li id="message" class="ani" style="width: 119px; height: 43px; right: 35px; top: 337px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <a href="/h5album/bless/<?php echo $user_info['id']?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont20.png"></a>
                </li>
                <li class="ani" style="display:none;width: 119px; height: 41px; left: 50%; top: 400px; margin-left: -60px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont21.png">
                </li>
                <li class="ani" style="width: 156px; height: 35px; left: 50%; top: 48px;margin-left: -78px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model9-cont22.png">
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
