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
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model14-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 287px; height: 99px; left: 50%; top: 22px;margin-left: -143px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont1.png">
                </li>
                <li class="ani" style="width: 314px; height: 283px; left: 50%; top: 178px;margin-left: -157px;" swiper-animate-effect="zoomIn" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont2.png">
                </li>
                <li class="ani" style="width: 288px; height: 18px; left: 50%; top: 247px;margin-left: -144px;" swiper-animate-effect="zoomIn" swiper-animate-duration="4s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont3.png">
                </li>
                <li class="ani" style="width: 288px; height: 18px; left: 50%; top: 326px;margin-left: -144px;" swiper-animate-effect="zoomIn" swiper-animate-duration="4s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont4.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; top: 213px;margin-left: -160px;color: rgb(255, 255, 255);text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '田宇'?>&amp;
                    <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '乔娜'?> 
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; top: 270px;margin-left: -160px;color: rgb(255, 255, 255);text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <?php echo isset($elements[$page_ids[0]][3]['default']) ?  $elements[$page_ids[0]][3]['default'] : '2018年04月28日12:00'?> 
                </li>
                <li class="ani" style="width: 320px; height: 109px; left: 50%; top: 350px;margin-left: -160px;color: rgb(255, 255, 255);line-height: 30px;text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <br><?php echo isset($elements[$page_ids[0]][4]['default']) ?  $elements[$page_ids[0]][4]['default'] : '万达铂尔曼酒店'?>
                </li>
                <li class="ani" style="width: 194px; height: 34px; left: 50%; top: 299px;margin-left: -97px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont5.png">
                </li>
                <li class="ani" style="width: 320px; height: 58px; left: 50%; top: 90px;margin-left: -160px;color: rgb(255, 255, 255);text-align: center;line-height: 30px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <br><?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '距结婚典礼还有490天19小时46分'?> 
                </li>
                <li class="ani" style="width: 296px; height: 226px; left: 71px; top: 140px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont1.gif">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="10s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: showBreath 10s linear 0s infinite both;">
                    <img src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>"></div>
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont6.png">
                </li>
                <li class="ani" style="width: 233px; height: 64px; left: 10px; bottom: 10%;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont7.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0; ">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 457px; height: 578px; left: -173px; top: -204px; transform: rotateZ(14deg);" swiper-animate-effect="fadeInLeft" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont8.png">
                </li>
                <li class="ani" style="width: 637px; height: 516px; left: -147px; top: 138px; transform: rotateZ(353deg);" swiper-animate-effect="fadeInRight" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont9.png">
                </li>
                <li class="ani" style="width: 100%; height: 500px; left: 0px; top: 371px;" swiper-animate-effect="slideUp" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: slideUp 4s linear 0s 10 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont10.png"></div>
                </li>
                <li class="ani" style="width: 316px; height: 56px; left: 0px; top: 15%;color: #fff;" swiper-animate-effect="zoomIn" swiper-animate-duration="6s" swiper-animate-delay="0s">
                    其实每个人都在等待的，犹豫到底你是不是我一辈<br>子愿意去陪伴的人
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="12s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: showBreath 12s linear 0s infinite both;">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                    </div>
                </li>
                <li class="ani" style="width: 246px; height: 218px; right: -50px; top: -26px; transform: rotateZ(346deg);" swiper-animate-effect="showWaver" swiper-animate-duration="12s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: showWaver 12s linear 0s infinite both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont11.png"></div>
                </li>
                <li class="ani" style="width: 273px; height: 61px; left: 33px; top: 293px;color: #fff;" swiper-animate-effect="showBreath" swiper-animate-duration="6s" swiper-animate-delay="0s">
                    <div class="element-box" style="line-height: 0.75; animation: showBreath 6s linear 0s 2 both;"><div class="element comp_paragraph editable-text" style="margin-left:20px;cursor: default; width: 273px; height: 61px;"><font color="#ffffff" size="2">那么，你离开吧。但是如果你心里有一丝</font><div><font color="#ffffff" size="2">顾虑，也就已经离不开了</font></div></div></div>
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 813px; height: 100%; left: -256px; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: showWaver 16s linear 0s infinite both;">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                    </div>
                </li>
                <li class="ani" style="width: 294px; height: 255px; left: -54px; top: -15px; transform: rotateZ(283deg);">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont11.png">>
                </li>
                <li class="ani" style="width: 276px; height: 61px; left: 28px; top: 332px;color: #fff;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="line-height: 0.75; animation: showBreath 6s linear 0s 10 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 276px; height: 61px;"><font color="#ffffff" size="2">时间，总是要给我们开很多玩笑，时间短</font><div><font color="#ffffff" size="2">了也不行，长了也不行</font></div></div></div>
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 817px; height: 100%; left: -280px; top: 0; " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: showWaver 16s linear 0s infinite both;">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                    </div>
                </li>
                <li class="ani" style="width: 381px; height: 482px; left: -73px; top: -148px; transform: rotateZ(14deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style=" animation: fadeInLeft 3s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont8.png"></div>
                </li>
                <li class="ani" style="width: 507px; height: 411px; left: -81px; top: 180px; transform: rotateZ(353deg);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: fadeInRight 3s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont9.png"></div>
                </li>
                <li class="ani" style="width: 100%; height: 500px; left: 0px; top: 550px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: slideUp 4s ease 0s 10 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont10.png"></div>
                </li>
                <li class="ani" style="width: 226px; height: 36px; left: 24px; top: 45px;color: #fff;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: zoomIn 6s ease 0s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 226px; height: 36px;"><font color="#ffffff" size="2">但是今天，我们要对时间说</font></div></div>
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: puffIn 4s ease 0s 1 both;">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                    </div>
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: fadeInLeft 2s ease 3.5s 1 both;">
                    <img src="<?php echo isset($elements[$page_ids[6]][1]['default']) ?  get_img_url($elements[$page_ids[6]][1]['default']) : ''?>">
                    </div>
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: zoomInRoll 3s ease 5s 1 both;">
                    <img src="<?php echo isset($elements[$page_ids[6]][2]['default']) ?  get_img_url($elements[$page_ids[6]][2]['default']) : ''?>">
                    </div>
                </li>
                <li class="ani" style="width: 262px; height: 65px; left: 31px; top: 45px;color: #fff;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="line-height: 0.75;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 262px; height: 65px;"><font size="2" color="#ffffff">任你如何的改变世事，我们都已经决</font><div><font size="2" color="#ffffff">定，相伴到老</font></div></div></div>
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model14-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 329px; height: 478px; left: 50%; top: 19px;margin-left: -165px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: puffIn 3s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont12.png"></div>
                </li>
                <li class="ani" style="width: 154px; height: 50px; left: 50%; top: 49px;margin-left: -77px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: zoomIn 3s ease 1s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont13.png"></div>
                </li>
                <li class="ani" style="width: 309px; height: 200px; left: 50%; top: 135px;margin-left: -155px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: fadeIn 3s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont14.png"></div>
                </li>
                <li class="ani" style="width: 156px; height: 49px; left: 50%; top: 347px;margin-left: -78px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: bounceIn 2s ease 2.5s 1 both;">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont15.png"></a></div>
                </li>
                <li class="ani" style="width: 128px; height: 40px; left: 45px; top: 401px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style=" animation: bounceIn 2s ease 2.5s 1 both;">
                    <a href="tel: <?php echo isset($elements[$page_ids[7]][2]['default']) ?  $elements[$page_ids[7]][2]['default'] : '137xxxx7373'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont16.png"></a></div>
                </li>
                <li class="ani" style="width: 134px; height: 45px; right: 45px; top: 398px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: bounceIn 2s ease 2.5s 1 both;">
                    <a href="tel:<?php echo isset($elements[$page_ids[7]][3]['default']) ?  $elements[$page_ids[7]][3]['default'] : '137xxxx7373'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont17.png"></a></div>
                </li>
                <li class="ani" style="width: 320px; height: 163px; left: 50%; top: 153px;margin-left: -160px; color: rgb(255, 255, 255);text-align: center;line-height: 30px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style=" line-height: 1.2;animation: fadeIn 2s ease 2s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 163px;">
                    <div style="text-align: center;"><span style="font-size: medium; color: inherit;"><?php echo isset($elements[$page_ids[7]][0]['default']) ?  $elements[$page_ids[7]][0]['default'] : '将于2018年04月28日12:00'?></span></div>
                    <div style="text-align: center;"><span style="font-size: medium; color: inherit;">举行新婚典礼 敬备喜宴 恭候光临</span></div>
                    <div style=""><span style="font-size: medium; color: inherit; ">
                    <?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '地址：万达铂尔曼酒店'?></span></div>
                    </div></div>
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model14-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 329px; height: 478px; left: 50%; top: 19px;margin-left: -165px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: puffIn 3s ease 0s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont12.png"></div>
                </li>
                <li class="ani" style="width: 132px; height: 43px; left: 50%; top: 56px;margin-left: -66px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: zoomIn 3s ease 1s 1 both;"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont18.png"></div>
                </li>
                <li class="ani" style="width: 293px; height: 189px; left: 50%; top: 137px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: zoomIn 3s ease 0s 1 both;margin-left: -146px;">
                    <img src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>"></div>
                </li>
                <li id="bless" class="ani" style="width: 131px; height: 41px; left: 45px; top: 410px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: bounceIn 2s ease 2.5s 1 both;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont19.png"></div>
                </li>
                <li id="message" class="ani" style="width: 114px; height: 36px; right: 45px; top: 412px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: bounceIn 2s ease 2.5s 1 both;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont20.png"></div>
                </li>
                <li class="ani" style="display:none;width: 122px; height: 41px; left: 50%; top: 364px;margin-left: -61px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <div class="element-box" style="animation: bounceIn 2s ease 2.5s 1 both;"><a href=""><img src="<?php echo $domain['static']['url']?>/wap/images/model/model14-cont21.png"></a></div>
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
