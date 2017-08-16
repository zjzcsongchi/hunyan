<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('animate.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <link href="<?php echo css_js_url('new_h5.css', 'wap');?>" type="text/css" rel="stylesheet" />
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
    <?php if(isset($page_ids[0])):?>
    <?php //if(isset($elements[$page_ids[0]]) && $elements[$page_ids[0]]):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p1e1']['default']) && $elements['p1e1']['default']):?> <?php echo get_img_url($elements['p1e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg1.jpg'?> <?php endif;?>); ">
            </div>
            <ul>
                <li class="ani" style="width: 97px; height: 79px; left: 50%;margin-left: -48px;top: 250px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.5s" swiper-animate-delay="0.5s">
                <img class="wxuploader" src="<?php echo isset($elements['p1e4']) ? get_img_url($elements['p1e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont2.png'?>">
                </li>
                
                <li class="ani" style="width: 86px; height: 235px; right: 0; top: 105px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                <img class="wxuploader"  src="<?php echo isset($elements['p1e3']) ? get_img_url($elements['p1e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont4.png'?>">
                </li>
                
                <li class="ani" style="width: 288px; height: 112px; left: 2px; bottom:0;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                <img class="wxuploader"  src="<?php echo isset($elements['p1e6']) ? get_img_url($elements['p1e6']['default']) : $domain['static']['url'].'/wap/images/model1-cont5.png'?>">
                </li>
                
                <li class="ani" style="width: 222px; height: 36px; left: 50%;margin-left: -111px; top: 350px;" swiper-animate-effect="lightSpeedIn" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                <img class="wxuploader" src="<?php echo isset($elements[$page_ids[0]][0]['default']) ? get_img_url($elements[$page_ids[0]][0]['default']) : $domain['static']['url'].'/wap/images/model1-cont3.png'?>">
                <input type="hidden" name="<?php echo $page_ids[0]?>[0]" value="<?php echo isset($elements[$page_ids[0]][0]['default']) ?  get_img_url($elements[$page_ids[0]][0]['default']) : $domain['static']['url'].'/wap/images/model1-cont3.png'?>" />
                </li>
                
                <li class="ani" style="width: 109px; height: 98px; left: 50%;margin-left: -54px; top: 14px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                <img class="wxuploader"  src="<?php echo isset($elements['p1e2']) ? get_img_url($elements['p1e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont1.png'?>">
                </li>
                
            </ul>                 
        </section>  
        <?php //endif;?>
        <?php endif;?>
        
        <?php if(isset($page_ids[1])):?>
        <?php //if(isset($elements[$page_ids[1]]) && $elements[$page_ids[1]]):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p2e1']['default']) && $elements['p2e1']['default']):?> <?php echo get_img_url($elements['p2e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg2.jpg'?> <?php endif;?>);"></div>
            <ul>
                <li class="ani" style="width: 44px; height: 38px; left: 75px; top: 190px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.2s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url'].'/wap/images/model1-cont6.png'?>"></li>
                <li class="ani" style="width: 43px; height: 38px; left: 135px; top: 190px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.2s" swiper-animate-delay="0.4s"><img src="<?php echo $domain['static']['url'].'/wap/images/model1-cont7.png'?>"></li>
                <li class="ani" style="width: 315px; height: 115px; left: 20px; bottom: 50px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.5s" swiper-animate-delay="1.8s"><img src="<?php echo $domain['static']['url'].'/wap/images/model1-cont10.png'?>"></li>
                <li class="ani" style="width: 40px; height: 37px; left: 195px; top: 190px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.2s" swiper-animate-delay="0.8s"><img src="<?php echo $domain['static']['url'].'/wap/images/model1-cont8.png'?>"></li>
                <li class="ani" style="width: 41px; height: 37px; left: 250px; top: 190px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.2s" swiper-animate-delay="1.2s"><img src="<?php echo $domain['static']['url'].'/wap/images/model1-cont9.png'?>"></li>        
                <li class="ani" style="width: 163px; height: 36px; left: 20px; top: 245px;color: rgb(172, 25, 15);text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.8s">
                <?php echo isset($elements[$page_ids[1]][0]['default'])? $elements[$page_ids[1]][0]['default']:'新郎：张鑫' ?>
                <input type="hidden" name="<?php echo $page_ids[1]?>[0]" value="<?php echo isset($elements[$page_ids[1]][0]['default'])? $elements[$page_ids[1]][0]['default']:'新郎：张鑫' ?>" />
                </li>
                
                <li class="ani" style="width: 163px; height: 36px; left: 190px; top: 245px;color: rgb(172, 25, 15);text-align: center;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1.5s" swiper-animate-delay="0.8s">
                <?php echo isset($elements[$page_ids[1]][1]['default'])? $elements[$page_ids[1]][1]['default']:'新娘：郭婷' ?>
                <input type="hidden" name="<?php echo $page_ids[1]?>[1]" value="<?php echo isset($elements[$page_ids[1]][1]['default'])? $elements[$page_ids[1]][1]['default']:'新娘：郭婷' ?>" />
                </li>
                
                <li class="ani" style="width: 100%; height: 150px; left: 0px; top: 285px;color: rgb(172, 25, 15);text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.4s">
                <?php echo isset($elements[$page_ids[1]][2]['default'])? $elements[$page_ids[1]][2]['default']:'席设：潍坊万达万达铂尔曼酒店' ?></li>
                <input type="hidden" name="<?php echo $page_ids[1]?>[2]" value="<?php echo isset($elements[$page_ids[1]][2]['default'])? $elements[$page_ids[1]][2]['default']:'席设：潍坊万达万达铂尔曼酒店' ?>" />
            </ul>
            
        </section>
        <?php endif;?>
        <?php //endif;?>
        
        <?php if(isset($page_ids[2])):?>
        <?php //if(isset($elements[$page_ids[2]]) && $elements[$page_ids[2]]):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p3e1']['default']) && $elements['p3e1']['default']):?> <?php echo get_img_url($elements['p3e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg3.jpg'?> <?php endif;?>); "></div>
            <ul>                
                <li class="ani" style="width: 171px; height: 171px; left: 50%;margin-left: -85px; top: 164px;border-radius: 160px;overflow: hidden;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                <img class="wxuploader" src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : $domain['static']['url'].'/wap/images/p1.png'?>">
                <input type="hidden" name="p3e4" value="<?php echo isset($elements['p3e4']) ?  get_img_url($elements['p3e4']['default']) : $domain['static']['url'].'/wap/images/p1.png'?>" />
                </li>
                
                <li class="ani" style="width: 185px; height: 37px; left: 50%;margin-left: -93px; top: 47px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p3e2']) ? get_img_url($elements['p3e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont11.png'?>">
                <input type="hidden" name="p3e2" value="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont11.png'?>" />
                </li>
                
                <li class="ani" style="width: 278px; height: 285px; left: 50%;margin-left: -139px; top: 109px;" swiper-animate-effect="rotateIn" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p3e3']) ? get_img_url($elements['p3e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont12.png'?>">
                <input type="hidden" name="p3e3" value="<?php echo isset($elements['p3e3']) ?  get_img_url($elements['p3e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont12.png'?>" />
                </li>
                 
            </ul>                     
        </section>
        <?php //endif;?>
        <?php endif;?>
        
        <?php if(isset($page_ids[3])):?>
        <section class="swiper-slide page">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : $domain['static']['url'].'/wap/images/p1.png'?>">
                </li>
                
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="2s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[3]][1]['default']) ?  get_img_url($elements[$page_ids[3]][1]['default']) : $domain['static']['url'].'/wap/images/p3.png'?>">
                </li>
                
                <li class="ani" style="width: 107px; height: 211px; left: -24px; top: 235px;">
                <img class="wxuploader" src="<?php echo isset($elements['p4e5']) ? get_img_url($elements['p4e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont15.png'?>">
                <input type="hidden" name="p4e5" value="<?php echo isset($elements['p4e5']) ?  get_img_url($elements['p4e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont15.png'?>" />
                </li>
                
                <li class="ani" style="width: 182px; height: 186px; right: 0; top: -8px;">
                <img class="wxuploader" src="<?php echo isset($elements['p4e3']) ? get_img_url($elements['p4e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont13.png'?>">
                <input type="hidden" name="p4e3" value="<?php echo isset($elements['p4e3']) ?  get_img_url($elements['p4e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont13.png'?>" />
                </li>
                
                <li class="ani" style="width: 45px; height: 149px; left: 2px; top: 63px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p4e4']) ? get_img_url($elements['p4e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont14.png'?>">
                <input type="hidden" name="p4e4" value="<?php echo isset($elements['p4e4']) ?  get_img_url($elements['p4e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont14.png'?>" />
                </li>
                
                <li class="ani" style="width: 140px; height: 42px; left: 50%;margin-left: -70px; bottom: 65px;">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[3]][2]['default']) ?  get_img_url($elements[$page_ids[3]][2]['default']) : $domain['static']['url'].'/wap/images/model1-cont16.png'?>">
                </li> 
            </ul>            
        </section>
         <?php endif;?>
        
        <?php if(isset($page_ids[4])):?>
        <section class="swiper-slide page">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : $domain['static']['url'].'/wap/images/p4.png'?>">
                </li>
                
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[4]][1]['default']) ?  get_img_url($elements[$page_ids[4]][1]['default']) : $domain['static']['url'].'/wap/images/p5.png'?>">
                </li>
                
                <li class="ani" style="width: 106px; height: 210px; left: -29px; top: 221px;;">
                <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e5']) ? get_img_url($elements['p5e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont15.png'?>">
                <input type="hidden" name="p5e5" value="<?php echo isset($elements['p5e5']) ?  get_img_url($elements['p5e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont15.png'?>" />
                </li>
                
                <li class="ani" style="width: 197px; height: 202px; right: 0; top: -13px;">
                <img class="wxuploader" src="<?php echo isset($elements['p5e3']) ? get_img_url($elements['p5e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont13.png'?>">
                <input type="hidden" name="p5e3" value="<?php echo isset($elements['p5e3']) ?  get_img_url($elements['p5e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont13.png'?>" />
                </li>
                
                <li class="ani" style="width: 45px; height: 149px; left: 2px; top: 63px;">
                <img class="wxuploader" src="<?php echo isset($elements['p5e4']) ? get_img_url($elements['p5e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont17.png'?>">
                <input type="hidden" name="p5e4" value="<?php echo isset($elements['p5e4']) ?  get_img_url($elements['p5e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont17.png'?>" />
                </li>
                
                <li class="ani" style="width: 140px; height: 42px; left: 50%;margin-left: -70px; bottom: 65px;">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[4]][2]['default']) ?  get_img_url($elements[$page_ids[4]][2]['default']) : $domain['static']['url'].'/wap/images/model1-cont16.png'?>">
                </li>
                
            </ul>
        </section>
        <?php endif;?>
        
        <?php if(isset($page_ids[5])):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p6e1']['default']) && $elements['p6e1']['default']):?> <?php echo get_img_url($elements['p6e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg4.jpg'?> <?php endif;?>); "></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : $domain['static']['url'].'/wap/images/p2.png'?>">
                </li>
                
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="2s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[5]][1]['default']) ?  get_img_url($elements[$page_ids[5]][1]['default']) : $domain['static']['url'].'/wap/images/p1.png'?>">
                </li>
                
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="3s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[5]][2]['default']) ?  get_img_url($elements[$page_ids[5]][2]['default']) : $domain['static']['url'].'/wap/images/p4.png'?>">
                </li>
                
                <li class="ani" style="width: 90px; height: 178px; left: -17px; top: 204px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p6e6']) ? get_img_url($elements['p6e6']['default']) : $domain['static']['url'].'/wap/images/model1-cont15.png'?>">
                <input type="hidden" name="p6e6" value="<?php echo isset($elements['p6e6']) ?  get_img_url($elements['p6e6']['default']) : $domain['static']['url'].'/wap/images/model1-cont15.png'?>" />
                </li>
                
                <li class="ani" style="width: 172px; height: 177px; right: 0; top: -11px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e5']) ? get_img_url($elements['p6e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont13.png'?>">
                <input type="hidden" name="p6e5" value="<?php echo isset($elements['p6e5']) ?  get_img_url($elements['p6e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont13.png'?>" />
                </li>
            </ul>
        </section>
        <?php endif;?>
        
        <?php if(isset($page_ids[6])):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p7e1']['default']) && $elements['p7e1']['default']):?> <?php echo get_img_url($elements['p7e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg4.jpg'?> <?php endif;?>); "></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : $domain['static']['url'].'/wap/images/p3.png'?>">
                </li>
                
                <li class="ani" style="width: 103px; height: 108px; left: 58px; top: 347px;" swiper-animate-effect="fadeOutRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p7e3']) ? get_img_url($elements['p7e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont18.png'?>">
                <input type="hidden" name="p7e3" value="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont18.png'?>" />
                </li>
                
                <li class="ani" style="width: 78px; height: 118px; left: 157px; top: 341px;" swiper-animate-effect="fadeOutLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p7e4']) ? get_img_url($elements['p7e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont19.png'?>">
                <input type="hidden" name="p7e4" value="<?php echo isset($elements['p7e4']) ?  get_img_url($elements['p7e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont19.png'?>" />
                </li>
                
                <li class="ani" style="width: 158px; height: 158px; left: 50%;margin-left: -79px; top: 326px;;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.5s" swiper-animate-delay="2s">
                <img class="wxuploader" src="<?php echo isset($elements['p7e5']) ? get_img_url($elements['p7e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont20.png'?>">
                <input type="hidden" name="p7e5" value="<?php echo isset($elements['p7e5']) ?  get_img_url($elements['p7e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont20.png'?>" />
                </li>
            </ul>
        </section>
        <?php endif;?>
        
        <?php if(isset($page_ids[7])):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p8e1']['default']) && $elements['p8e1']['default']):?> <?php echo get_img_url($elements['p8e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg5.jpg'?> <?php endif;?>); "></div>
            <ul>
                <li class="ani" style="width: 88%; height: 365px; left: 6%; top: 135px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p8e3']) ? get_img_url($elements['p8e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont29.png'?>">
                <input type="hidden" name="p8e3" value="<?php echo isset($elements['p8e3']) ?  get_img_url($elements['p8e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont29.png'?>" />
                </li>
                
                <li class="ani" style="width: 109px; height: 83px; left: 50%;margin-left: -55px; top: 12px;" swiper-animate-effect="wobble" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p8e2']) ? get_img_url($elements['p8e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont21.png'?>">
                <input type="hidden" name="p8e2" value="<?php echo isset($elements['p8e2']) ?  get_img_url($elements['p8e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont21.png'?>" />
                </li>
                
                <li class="ani" style="width: 88%; height: 62px; left: 6%; top: 160px;color: rgb(255, 255, 255);text-align: center;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0.8s">
                <?php echo isset($elements[$page_ids[7]][0]['default']) ? $elements[$page_ids[7]][0]['default']: '距结婚典礼还有548天18小时47分' ?>
                </li>
                
                <li class="ani" style="width: 88%; height: 107px; left: 6%; top: 220px;color: rgb(162, 32, 36);text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="1.2s">
                <?php echo isset($elements[$page_ids[7]][1]['default']) ? $elements[$page_ids[7]][1]['default']: '席设： 潍坊万达万达铂尔曼酒店' ?>
                </li>
                
                <li class="ani" style="width: 145px; height: 40px; left: 50%;margin-left: -73px; top: 350px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="1.5s"><a href="http://map.baidu.com/" target="_blank">
                <img class="wxuploader" src="<?php echo isset($elements['p8e4']) ? get_img_url($elements['p8e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont22.png'?>"></a>
                <input type="hidden" name="p8e4" value="<?php echo isset($elements['p8e4']) ?  get_img_url($elements['p8e4']['default']) : $domain['static']['url'].'/wap/images/model1-cont22.png'?>" />
                </li>
                
                <li class="ani" style="width: 128px; height: 40px; left: 10%; top: 404px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                <a href="tel:<?php echo isset($elements[$page_ids[7]][2]['default']) ? $elements[$page_ids[7]][2]['default']: '' ?>">
                <img class="wxuploader" src="<?php echo isset($elements['p8e5']) ? get_img_url($elements['p8e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont23.png'?>"></a>
                </li>
                
                <li class="ani" style="width: 123px; height: 43px; right: 10%; top: 403px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                <a href="tel:<?php echo isset($elements[$page_ids[7]][3]['default']) ? $elements[$page_ids[7]][3]['default']: '' ?>">
                <img class="wxuploader" src="<?php echo isset($elements['p8e6']) ? get_img_url($elements['p8e6']['default']) : $domain['static']['url'].'/wap/images/model1-cont24.png'?>"></a>
                </li>
            </ul>
        </section>
        <?php endif;?>
        
        <?php if(isset($page_ids[8])):?>
        <section class="swiper-slide page">
            <div class="wrapper_bg" style=" background-image: url(<?php if(isset($elements['p9e1']['default']) && $elements['p9e1']['default']):?> <?php echo get_img_url($elements['p9e1']['default'])?><?php else:?><?php echo $domain['static']['url'].'/wap/images/model1-bg5.jpg'?> <?php endif;?>); "></div>
            <ul>
                <li class="ani" style="width: 88%; height: 365px; left: 6%; top: 135px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p9e3']) ? get_img_url($elements['p9e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont29.png'?>">
                <input type="hidden" name="p9e3" value="<?php echo isset($elements['p9e3']) ?  get_img_url($elements['p9e3']['default']) : $domain['static']['url'].'/wap/images/model1-cont29.png'?>" />
                </li>
                
                <li class="ani" style="width: 226px; height: 54px; left: 50%;margin-left: -113px; top: 50px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" src="<?php echo isset($elements['p9e2']) ? get_img_url($elements['p9e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont25.png'?>">
                <input type="hidden" name="p9e2" value="<?php echo isset($elements['p9e2']) ?  get_img_url($elements['p9e2']['default']) : $domain['static']['url'].'/wap/images/model1-cont25.png'?>" />
                </li>
                
                <li class="ani" style="width: 247px; height: 165px; left: 50%;margin-left: -124px; top: 155px;border: 4px solid rgb(220, 192, 105); border-radius: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <img class="wxuploader" data-group="g4" src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : $domain['static']['url'].'/wap/images/p5.png'?>">
                </li>
                
                <li class="ani" style="width: 145px; height: 40px; left: 50%;margin-left: -73px; top: 350px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                <a href="http://map.baidu.com/mobile/webapp/index/index/" target="_blank">
                <img src="<?php echo $domain['static']['url']?>/wap/images/model1-cont22.png">
                </a>
                </li>
                
                <li class="ani" style="width: 114px; height: 40px; left: 12%; top: 397px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0.5s">
                <a href="/h5album/bless/<?php echo $host_id?>">
                <img id="message" class="wxuploader" src="<?php echo isset($elements['p9e6']) ? get_img_url($elements['p9e6']['default']) : $domain['static']['url'].'/wap/images/model1-cont28.png'?>">
                </a>
                <input type="hidden" name="p9e6" value="<?php echo isset($elements['p9e6']) ?  get_img_url($elements['p9e6']['default']) : $domain['static']['url'].'/wap/images/model1-cont28.png'?>" />
                </li>
                
                <li class="ani" style="width: 145px; height: 40px; left: 50%;margin-left: -73px; top: 350px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                <img src="<?php echo $domain['static']['url']?>/wap/images/model1-cont22.png">
                </a>
                </li>
                
                <li class="ani" style="width: 119px; height: 37px; right: 12%; top: 398px; z-index: 5;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1.5s" swiper-animate-delay="0.5s">
                <img id="bless" src="<?php echo isset($elements['p9e7']) ? get_img_url($elements['p9e7']['default']) : $domain['static']['url'].'/wap/images/model1-cont27.png'?>">
                <input type="hidden" name="p9e7" value="<?php echo isset($elements['p9e7']) ?  get_img_url($elements['p9e7']['default']) : $domain['static']['url'].'/wap/images/model1-cont27.png'?>" />
                </li>
                
                <li class="ani" style=" display:none;width: 117px; height: 38px; left: 50%;margin-left: -58px; top: 350px;" swiper-animate-effect="bounceInUp" swiper-animate-duration="1.5s" swiper-animate-delay="0.5s">
                <img class="wxuploader" src="<?php echo isset($elements['p9e5']) ? get_img_url($elements['p9e5']['default']) : $domain['static']['url'].'/wap/images/model1-cont26.png'?>">
                </li>
            </ul>
        </section>  
        <?php endif;?>
        
    </div>    
    <div class="swiper-pagination"></div> 
    <?php $this->load->view('common/bless')?>
    
    
</div>


<?php $this->load->view('common/jsfooter')?>
<script>
	var template_id = "<?php echo $template_id?>";
	var host_id = "<?php echo $host_id?>";
	var template_id = "<?php echo $template_id?>";
</script>
<script type="text/javascript">
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
