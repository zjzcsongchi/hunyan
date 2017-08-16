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
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-bg1.jpg">
                </li>
                <li class="ani" style="width: 426px; height: 170px; left: 18px; top: 68px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont1.png">
                </li>
                <li class="ani" style="width: 211px; height: 50px; left: 105px; top: 113px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont2.png">
                </li>
                <li class="ani" style="width: 180px; height: 27px; left: 117px; top: 164px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont3.png">
                </li>
                <li class="ani" style="width: 55px; height: 57px; left: 70px; top: 155px;" swiper-animate-effect="tada" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont4.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-bg2.jpg">
                </li>
                <li class="ani" style="width: 172px; height: 17px; left: 76px; top: 56px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont5.png">
                </li>
                <li class="ani" style="width: 204px; height: 28px; left: 61px; top: 77px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont6.png">
                </li>
                <li class="ani" style="width: 211px; height: 58px; left: 56px; top: 108px;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont7.png">
                </li>
                <li class="ani" style="width: 31px; height: 123px; left: 32px; top: 49px; " swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont8.png">
                </li>
                <li class="ani" style="width: 30px; height: 121px; left: 262px; top: 50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont9.png">
                </li>
                <li class="ani" style="width: 29px; height: 29px; left: 59px; top: 50px;" swiper-animate-effect="flipInY" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont10.png">
                </li>
                <li class="ani" style="width: 29px; height: 29px; left: 235px; top: 51px;" swiper-animate-effect="flipInY" swiper-animate-duration="1s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont10.png">
                </li>
                <li class="ani" style="width: 50px; height: 54px; left: 232px; top: 6px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont11.png">
                </li>
                <li class="ani" style="width: 266px; height: 16px; left: 50%; top: 180px;margin-left: -133px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont12.png">
                </li>
                <li class="ani" style="width: 188px; height: 247px; left: 50%; top: 252px;margin-left: -94px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont13.png">
                </li>
                <li class="ani" style="width: 254px; height: 19px; left: 50%; top: 205px;margin-left: -127px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont14.png">
                </li>
                <li class="ani" style="width: 121px; height: 34px; left: 20px; top: 235px;text-align: center;color: #333;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[1]][0]['default']) ?  $elements[$page_ids[1]][0]['default'] : '董东'?>
                </li>
                <li class="ani" style="width: 141px; height: 36px; right: 20px; top: 235px;text-align: center;color: #333;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : '刘子涵'?>
                </li>
                <li class="ani" style="width: 80px; height: 27px; left: 50%; top: 240px;margin-left: -40px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont15.png">
                </li>
                <li class="ani" style="width: 154px; height: 29px; left: 50%; top: 285px;margin-left: -77px;" swiper-animate-effect="puffIn" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont16.png">
                </li>
                <li class="ani" style="width: 320px; height: 107px; left: 50%; top: 435px; margin-left: -160px;text-align: center;line-height: 35px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <br><?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '和平路198号泛海大酒店2楼'?> 
                </li>
                <li class="ani" style="width: 320px; height: 59px; left: 50%; top: 505px;margin-left: -160px;text-align: center;line-height: 30px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <br><?php echo isset($elements[$page_ids[1]][3]['default']) ?  $elements[$page_ids[1]][3]['default'] : '距结婚典礼还有520天3小时13分'?>
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="8s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 391px; height: 154px; left: 21px; top: 305px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont1.png">
                </li>
                <li class="ani" style="width: 232px; height: 17px; left: 71px; top: 350px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont17.png">
                </li>
                <li class="ani" style="width: 240px; height: 39px; left: 67px; top: 380px;" swiper-animate-effect="lightSpeedIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont18.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 816px; height: 100%; left: -248px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="14s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 425px; height: 140px; left: -117px; top: 37px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont1.png">
                </li>
                <li class="ani" style="width: 240px; height: 18px; left: 9px; top: 82px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont19.png">
                </li>
                <li class="ani" style="width: 240px; height: 36px; left: 9px; top: 108px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont20.png">
                </li>
            </ul> 
        </section> 
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][1]['default']) ?  get_img_url($elements[$page_ids[4]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 333px; height: 155px; left: 49px; top: 34px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont1.png">
                </li>
                <li class="ani" style="width: 240px; height: 18px; left: 85px; top: 80px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="2.6s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont21.png">
                </li>
                <li class="ani" style="width: 246px; height: 40px; left: 85px; top: 110px; " swiper-animate-effect="lightSpeedIn" swiper-animate-duration="3s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont22.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="zoomInRoll" swiper-animate-duration="3s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[5]][1]['default']) ?  get_img_url($elements[$page_ids[5]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="4s">
                    <img src="<?php echo isset($elements[$page_ids[5]][2]['default']) ?  get_img_url($elements[$page_ids[5]][2]['default']) : ''?>">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-bg3.jpg">
                </li>
                <li class="ani" style="width: 249px; height: 56px; left: 50%; top: 58px;margin-left: -124px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont23.png">
                </li>
                <li class="ani" style="width: 80px; height: 19px; left: 60%; top: 59px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont24.png">
                </li>
                <li class="ani" style="width: 266px; height: 20px; left: 50%; top: 114px;margin-left: -133px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont25.png">
                </li>
                <li class="ani" style="width: 74px; height: 23px; left: 50%; top: 145px;margin-left: -37px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont26.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; top: 168px;margin-left: -160px;text-align: center;line-height: 36px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="2.5s">
                    <?php echo isset($elements[$page_ids[6]][0]['default']) ?  $elements[$page_ids[6]][0]['default'] : '2018年05月26日18:20'?>
                </li>
                <li class="ani" style="width: 142px; height: 23px; left: 50%; top: 210px;margin-left: -71px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont27.png">
                </li>
                <li class="ani" style="width: 187px; height: 21px; left: 50%; top: 245px;margin-left: -93px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="3.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont28.png">
                </li>
                <li class="ani" style="width: 320px; height: 100px; left: 50%; top: 310px;margin-left: -160px;text-align: center;line-height: 35px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="4.5s">
                    <br><?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '和平路198号泛海大酒店2楼 '?>
                </li>
                <li class="ani" style="width: 94px; height: 27px; left: 50%; top: 280px;margin-left: -47px;" swiper-animate-effect="fadeIn" swiper-animate-duration="1.5s" swiper-animate-delay="4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont29.png">
                </li>
                <li class="ani" style="width: 150px; height: 43px; left: 50%; top: 400px;margin-left: -75px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="5s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont30.png"></a>
                </li>
                <li class="ani" style="width: 150px; height: 43px; left: 20px; top: 460px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="5s">
                    <a href="tel:<?php echo isset($elements[$page_ids[6]][2]['default']) ?  $elements[$page_ids[6]][2]['default'] : '153xxxx6898'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont31.png"></a>
                </li>
                <li class="ani" style="width: 150px; height: 43px; right: 20px; top: 460px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="5s">
                    <a href="tel:tel:<?php echo isset($elements[$page_ids[6]][3]['default']) ?  $elements[$page_ids[6]][3]['default'] : '153xxxx6898'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont32.png"></a>
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 100%; height: 40%; left: 0; top: 25%;" swiper-animate-effect="showBreath" swiper-animate-duration="10s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-bg4.png">
                </li>
                <li class="ani" style="width: 264px; height: 66px; left: 50%; top: 54px;margin-left: -132px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont33.png">
                </li>
                <li class="ani" style="width: 80px; height: 19px; left: 60%; top: 59px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont34.png">
                </li>
                <li class="ani" style="width: 280px; height: 21px; left: 50%; top: 118px;margin-left: -140px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont35.png">
                </li>
                <li id="bless" class="ani" style="width: 157px; height: 45px; left: 20px; top: 80%;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont36.png">
                </li>
                <li id="message" class="ani" style="width: 157px; height: 45px; right: 20px; top: 80%;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont37.png">
                </li>
                <li class="ani" style="display:none;width: 157px; height: 45px; left: 50%; top: 70%;margin-left: -78px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="2s">
                    <a href=""><img src="<?php echo $domain['static']['url']?>/wap/images/model/model13-cont38.png"></a>
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
