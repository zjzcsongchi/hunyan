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
    <a class=" album-save use" style="position: absolute;z-index:9999;width:100px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-align: center;line-height:30px;    text-decoration: none; left:20px;color:#fff;" href="/h5album/invit/<?php echo $template_id?>">使用模板
    </a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/model/model3-bg1.jpg&apos;);"></div>
            <ul>
                <li class="ani" style="width: 34px; height: 36px; left: 223px; top: 412px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 50px; height: 53px; left: 46px; top: 282px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 52px; height: 55px; left: 2px; top: 231px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 80px; height: 85px; left: 238px; top: 357px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 103px; height: 36px; left: 210px; top: 292px;text-align: center;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '于彤'?>
                </li>
                <li class="ani" style="width: 103px; height: 36px; left: 90px; top: 292px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '乔林'?>
                </li>
                <li class="ani" style="width: 46px; height: 36px; left: 186px; top: 293px;">
                    &amp;
                </li>
                <li class="ani" style="width: 230px; height: 171px; left: 50%;margin-left: -115px; top: 51px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont2.png">
                </li>
            </ul>    
        </section>   
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/model/model3-bg2.jpg&apos;);"></div>
            <ul>
                <li class="ani" style="width: 150px; height: 88px; left: 41px; top: 34px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont3.png">
                </li>
                <li class="ani" style="width: 66px; height: 87px; left: 185px; top: 101px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont4.png">
                </li>
                <li class="ani" style="width: 46px; height: 61px; left: 265px; top: 178px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont5.png">
                </li>
                <li class="ani" style="width: 34px; height: 41px; left: 235px; top: 245px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont6.png">
                </li>
                <li class="ani" style="width: 53px; height: 70px; left: 270px; top: 290px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont7.png">
                </li>
                <li class="ani" style="width: 20px; height: 108px; left: 270px; top: 375px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont8.png">
                </li>
                <li class="ani" style="width: 194px; height: 139px; left: 45px; top: 341px;text-align: right;color: #31d6c2;line-height: 25px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                <?php echo isset($elements[$page_ids[1]][0]['default']) ?  $elements[$page_ids[1]][0]['default'] : '从相遇的那一刻，每一天,路不再是路，而是陪伴。从相知的那一瞬，每一秒,生活不再是生活,而是彼此的融合'?><br>
                </li>
                <li class="ani" style="width: 80px; height: 85px; left: 77px; top: 223px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="3.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 52px; height: 55px; left: 224px; top: 55px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="5.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 50px; height: 53px; left: 32px; top: 170px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="4.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 51px; height: 54px; left: 61px; top: 458px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="6.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 0px; top: 100px;padding-left: 20px;">
                    I
                </li>
            </ul>            
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/model/model3-bg2.jpg&apos;);"></div>
            <ul>
                <li class="ani" style="width: 299px; height: 86px; left: -2px; top: 27px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont9.png">
                </li>
                <li class="ani" style="width: 142px; height: 36px; left: 6px; top: 110px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    新郎：&nbsp;<?php echo isset($elements[$page_ids[2]][0]['default']) ?  $elements[$page_ids[2]][0]['default'] : '乔林'?>
                </li>
                <li class="ani" style="width: 39px; height: 36px; left: 128px; top: 111px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    &amp;
                </li>
                <li class="ani" style="width: 141px; height: 36px; left: 152px; top: 111px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    新娘：<?php echo isset($elements[$page_ids[2]][1]['default']) ?  $elements[$page_ids[2]][1]['default'] : '于彤'?>
                </li>
                <li class="ani" style="width: 141px; height: 58px; left: 5px; top: 145px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont10.png">
                </li>
                <li class="ani" style="width: 296px; height: 36px; left: 12px; top: 198px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <?php echo isset($elements[$page_ids[2]][2]['default']) ?  $elements[$page_ids[2]][2]['default'] : '婚礼日期：2017年01月05日18:32'?>
                </li>
                <li class="ani" style="width: 298px; height: 73px; left: 12px; top: 243px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <?php echo isset($elements[$page_ids[2]][3]['default']) ?  $elements[$page_ids[2]][3]['default'] : '婚礼地址：潍坊万达铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 292px; height: 71px; left: 12px; top: 301px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                <?php echo isset($elements[$page_ids[2]][4]['default']) ?  $elements[$page_ids[2]][4]['default'] : '酒店：铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 71px; height: 75px; left: 18px; top: 348px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 288px; height: 108px; left: 15px; top: 430px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont11.png">
                </li>
                <li class="ani" style="width: 45px; height: 48px; left: 234px; top: 155px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.png">
                </li>
                <li class="ani" style="width: 49px; height: 90px; left: 248px; top: 3px;" swiper-animate-effect="swing" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont12.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0; " swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont13.png">
                </li>
                <li class="ani" style="width: 27px; height: 29px; right: 5px; bottom: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.gif">
                </li>
                <li class="ani" style="width: 27px; height: 70px; right: 40px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont14.png">
                </li>
                <li class="ani" style="width: 256px; height: 70px; left: 50%;margin-left: -128px;text-align: center; bottom: 10px;font-size: 14px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="2.5s">
                    <?php echo isset($elements[$page_ids[3]][1]['default']) ?  $elements[$page_ids[3]][1]['default'] : '在茫茫人海中，一个偶然的机会上天安排我们相遇了'?>
                </li>
                <li class="ani" style="width: 46px; height: 45px; left: 10px; bottom: 40px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 27px; height: 26px; left: 50px; bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont16.png">
                </li>
                <li class="ani" style="width: 27px; height: 29px; right: 5px; bottom: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.gif">
                </li>
                <li class="ani" style="width: 27px; height: 70px; right: 40px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont17.png">
                </li>
                <li class="ani" style="width: 272px; height: 70px; left: 25px; bottom: 10px;font-size: 14px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="2.5s">
                    <?php echo isset($elements[$page_ids[4]][1]['default']) ?  $elements[$page_ids[4]][1]['default'] : '有一天,我们相爱了,我们像糖沾豆一样了一直在爱情里面徜徉'?>
                </li>
                <li class="ani" style="width: 46px; height: 45px; left: 10px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 27px; height: 26px; left: 50px; bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
            </ul>   
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 757px; height: 100%; left: -170px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="20s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont18.png">
                </li>
                <li class="ani" style="width: 34px; height: 38px; right: 5px; bottom: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.gif">
                </li>
                <li class="ani" style="width: 38px; height: 70px; right: 40px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont19.png">
                </li>
                <li class="ani" style="width: 234px; height: 56px; left: 50px; bottom: 50px; transform: rotateZ(-5deg);color: #000;font-size: 14px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                   <?php echo isset($elements[$page_ids[5]][1]['default']) ?  $elements[$page_ids[5]][1]['default'] : '在四目相对的一刹那，我们都笑了因为我们知道这就是我们的缘份'?> 
                </li>
                <li class="ani" style="width: 28px; height: 27px; left: 10px; bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 40px; height: 39px; left: 150px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
            </ul>            
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="15s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont20.png">
                </li>
                <li class="ani" style="width: 32px; height: 35px; right: 5px; bottom: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.gif">
                </li>
                <li class="ani" style="width: 31px; height: 70px; right: 40px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont21.png">
                </li>
                <li class="ani" style="width: 50px; height: 49px; left: 2px; bottom: 20px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 271px; height: 53px; left: 20px; bottom: 45px; transform: rotateZ(3deg);font-size: 14px;text-align: center;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '我们常常联系，不久后，我们成了好朋友一起分享着彼此的快乐与痛苦'?> 
                </li>
                <li class="ani" style="width: 31px; height: 30px; left: 80px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 757px; height: 100%; left: -170px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="20s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont22.png">
                </li>
                <li class="ani" style="width: 34px; height: 38px; right: 5px; bottom: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.gif">
                </li>
                <li class="ani" style="width: 38px; height: 70px; right: 40px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont23.png">
                </li>
                <li class="ani" style="width: 247px; height: 56px; left: 35px; bottom: 40px; transform: rotateZ(-5deg);font-size: 14px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '爱情是可以长久、幸福是可以永远的感谢上天，因为是它把你赐给我'?>
                </li>
                <li class="ani" style="width: 26px; height: 25px; left: 41px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 41px; height: 40px; left: 2px; bottom: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;">
                    <img src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont24.png">
                </li>
                <li class="ani" style="width: 32px; height: 35px; right: 5px; bottom: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont1.gif">
                </li>
                <li class="ani" style="width: 50px; height: 49px; left: 0; bottom: 32px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 258px; height: 56px; left: 50%;margin-left: -129px; bottom: 40px; transform: rotateZ(3deg);font-size: 14px;text-align: center;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                   <?php echo isset($elements[$page_ids[8]][1]['default']) ?  $elements[$page_ids[8]][1]['default'] : '世上最浪漫的事情，不是说我爱你而是我要与你相守一辈子'?>
                </li>
                <li class="ani" style="width: 31px; height: 30px; left: 51px; bottom: 10px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 24px; height: 70px; right: 40px; bottom: 10px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont25.png">
                </li>
            </ul>            
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model3-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 108px; left: -4px; top: 302px;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[9]][1]['default']) ?  $elements[$page_ids[9]][1]['default'] : '地址：潍坊万达铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 97px; height: 40px; left: 50%;margin-left: -48px; top: 23px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont26.png">
                </li>
                <li class="ani" style="width: 274px; height: 164px; left: 50%;margin-left: -137px; top: 73px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴"><img src="<?php echo $domain['static']['url']?>/wap/images/model/map.png"></a>
                </li>
                <li class="ani" style="width: 165px; height: 39px; left: 50%;margin-left: -83px; top: 411px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="tel:<?php echo isset($elements[$page_ids[9]][2]['default']) ?  $elements[$page_ids[9]][2]['default'] : '135xxxx0273'?>">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont27.png"></a>
                </li>
                <li class="ani" style="width: 165px; height: 39px;top: 464px; left: 50%;margin-left: -83px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="tel:<?php echo isset($elements[$page_ids[9]][3]['default']) ?  $elements[$page_ids[9]][3]['default'] : '135xxxx0274'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont28.png"></a>
                </li>
                <li class="ani" style="width: 55px; height: 53px; right: 20px; top: 238px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 43px; height: 42px; left: 21px; top: 278px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 49px; height: 48px; right: 20px; top: 396px;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 100%; height: 61px; left: 1px; top: 246px;text-align: center;">
                <?php echo isset($elements[$page_ids[9]][0]['default']) ?  $elements[$page_ids[9]][0]['default'] : '距结婚典礼还有24天1小时42分'?>
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">  
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model3-bg2.jpg);"></div>      
            <ul>
                <li class="ani" style="width: 100%; height: 245px; left: 0; top: 74px;" swiper-animate-effect="showBreath" swiper-animate-duration="12s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[10]][0]['default']) ?  get_img_url($elements[$page_ids[10]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 520px; left: 0; top: 0px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont29.png">
                </li>
                <li class="ani" style="width: 97px; height: 40px; left: 50%;margin-left: -48px; top: 25px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont30.png">
                </li>
                <li class="ani" id="bless" style="width: 165px; height: 39px; left: 50%;margin-left: -83px; top: 343px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont31.png">
                </li>
                <li class="ani" id="message" style="width: 165px; height: 39px; left: 50%;margin-left: -83px;margin-top:15px; top: 397px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont32.png">
                </li>
                <li style="display:none" class="ani" style="width: 165px; height: 39px; left: 50%;margin-left: -83px; top: 451px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <a href=""><img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont33.png"></a>
                </li>
                <li class="ani" style="width: 67px; height: 65px; right: 30px; top: 261px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 47px; height: 46px; left: 15px; top: 317px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
                </li>
                <li class="ani" style="width: 58px; height: 57px; right: 20px; top: 439px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model3-cont15.png">
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

          
          var index = mySwiper.activeIndex;
//           mySwiper.slideTo(10);
          
		})
    </script>

</body>
</html>
