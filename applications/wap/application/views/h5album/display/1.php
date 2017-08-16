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
    <link href="<?php echo css_js_url('idangerous.swiper.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('font.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('main_new.css', 'wap');?>" type="text/css" rel="stylesheet" />
    
    <link href="<?php echo css_js_url('h5.css', 'wap');?>" type="text/css" rel="stylesheet" />
</head>

<body onmousewheel="return false;">
<form>
<div class="container">
    <div class="audio_btn rotate">
        <audio loop="true" src="<?php echo get_img_url($music);?>" id="media" autoplay preload=""></audio>
    </div>
    
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="page page0 cur nr">
        <section class="main-page z-current">
            <div class="m-img" id="page1">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image inside-hover" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box" style=" animation: showBreath 10s linear 0s infinite both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e1" value="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 119px; left: 0; top: 339px; z-index: 2;">
                        <div class="element-box" style=" animation: zoomIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page1 nr">
        <section class="main-page">
            <div class="m-img" id="page2">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image inside-hover" style="width: 807px; height: 100%; left: -249px; top: 0; z-index: 1;">
                        <div class="element-box" style="animation: showWaver 16s linear 0s infinite both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" style="width: 807px; height: 1210px; margin-top: -337px; top: 142px;">
                            <input type="hidden" name="p2e1" value="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 74px; height: 180px; right: 50px; top: 302px; z-index: 2;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p2e2']) ?  get_img_url($elements['p2e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page2 nr">
        <section class="main-page">
            <div class="m-img" id="page3">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box" style="animation: showBreath 10s linear 0s infinite both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p3e1" value="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 73px; height: 177px; right: 50px; top: 10px; z-index: 2;">
                        <div class="element-box" style="animation: flipInY 3s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page3 nr">
        <section class="main-page">
            <div class="m-img" id="page4">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box" style="animation: fadeInRight 2.5s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g4" src="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e1" value="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box" style=" animation: fadeInLeft 2.5s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g4" src="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e2" value="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 97px; height: 130px; left: 19px; top: 346px; z-index: 3;">
                        <div class="element-box" style="animation: fadeInLeft 2s ease 1.8s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p4e3']) ?  get_img_url($elements['p4e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page4 nr">
        <section class="main-page">
            <div class="m-img" id="page5">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box" style="animation: showBreath 10s linear 0s infinite both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e1" value="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 135px; left: 27px; top: 353px; z-index: 2;">
                        <div class="element-box" style="animation: zoomIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p5e2']) ?  get_img_url($elements['p5e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page5 nr">
        <section class="main-page">
            <div class="m-img" id="page6">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e1" value="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 151px; height: 239px; left: 25px; top: 269px; z-index: 3; transform: rotateZ(5deg);">
                        <div class="element-box" style=" border: 5px solid rgb(255, 255, 255);  animation: fadeInLeft 1s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e2" value="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 147px; height: 231px; right: 50px; top: 184px; z-index: 4; transform: rotateZ(4deg);">
                        <div class="element-box" style=" border: 5px solid rgb(255, 255, 255); animation: fadeInLeft 1s ease 0.8s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e3" value="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 162px; height: 259px; left: 35px; top: 2px; z-index: 5; transform: rotateZ(4deg);">
                        <div class="element-box" style=" border: 5px solid rgb(255, 255, 255);animation: fadeInLeft 1s ease 1.6s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e4']) ?  get_img_url($elements['p6e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e4" value="<?php echo isset($elements['p6e4']) ?  get_img_url($elements['p6e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page6 nr">
        <section class="main-page">
            <div class="m-img" id="page7">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e1" value="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 220px; height: 159px; left: 50%;margin-left: -110px; top: 41px; z-index: 3; transform: rotateZ(10deg);">
                        <div class="element-box" style="left: 50%;margin-left: -110px; border: 5px solid rgb(255, 255, 255); animation: rollIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e2']) ?  get_img_url($elements['p7e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e2" value="<?php echo isset($elements['p7e2']) ?  get_img_url($elements['p7e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 220px; height: 159px; left: 50%;margin-left: -110px; top: 183px; z-index: 4; transform: rotateZ(-10deg);">
                        <div class="element-box" style="left: 50%;margin-left: -110px; border: 5px solid rgb(255, 255, 255); animation: rollIn 2s ease 1s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e3" value="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 220px; height: 159px; left: 50%;margin-left: -110px; top: 340px; z-index: 5; transform: rotateZ(10deg);">
                        <div class="element-box" style="left: 50%;margin-left: -110px; border: 5px solid rgb(255, 255, 255);animation: rollIn 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e4']) ?  get_img_url($elements['p7e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e4" value="<?php echo isset($elements['p7e4']) ?  get_img_url($elements['p7e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page7 nr">
        <section class="main-page">
            <div class="m-img" id="page8">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 40%; left: 0px; bottom: 0; z-index: 1;">
                        <div class="element-box" style="animation: fadeInRight 1s ease 1.8s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e1']) ?  get_img_url($elements['p8e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e1" value="<?php echo isset($elements['p8e1']) ?  get_img_url($elements['p8e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 60%; height: 59%; right: 0; top: 0px; z-index: 2;">
                        <div class="element-box" style=" border: 0px solid rgb(255, 255, 255); animation: fadeInDown 1s ease 0.8s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e2']) ?  get_img_url($elements['p8e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e2" value="<?php echo isset($elements['p8e2']) ?  get_img_url($elements['p8e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 37%; height: 29%; left: 0px; top: 0px; z-index: 3;">
                        <div class="element-box" style="border: 0px solid rgb(255, 255, 255); animation: fadeInLeft 1s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e3']) ?  get_img_url($elements['p8e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e3" value="<?php echo isset($elements['p8e3']) ?  get_img_url($elements['p8e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 37%; height: 29%; left: 0px; top: 30%; z-index: 4;">
                        <div class="element-box" style=" animation: fadeInUp 1s ease 1.6s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e4']) ?  get_img_url($elements['p8e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e4" value="<?php echo isset($elements['p8e4']) ?  get_img_url($elements['p8e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page8 nr">
        <section class="main-page">
            <div class="m-img" id="page9">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 66px; height: 483px; left: 8px; top: 28px; z-index: 1;">
                        <div class="element-box" style="animation: fadeInDown 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p9e1']) ?  get_img_url($elements['p9e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 262px; height: 100%; right: 0; top: 0; z-index: 2;">
                        <div class="element-box">
                            <img class="element comp_image editable-image wxuploader" data-group="g9" src="<?php echo isset($elements['p9e2']) ?  get_img_url($elements['p9e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e2" value="<?php echo isset($elements['p9e2']) ?  get_img_url($elements['p9e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 262px; height: 100%; right: 0; top: 0; z-index: 3;">
                        <div class="element-box" style="width: 100%; height: 100%; animation: fadeInRight 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g9" src="<?php echo isset($elements['p9e3']) ?  get_img_url($elements['p9e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e3" value="<?php echo isset($elements['p9e3']) ?  get_img_url($elements['p9e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 262px; height: 100%; right: 0; top: 0; z-index: 4;">
                        <div class="element-box" style="animation: fadeInRight 2s ease 4s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g9" src="<?php echo isset($elements['p9e4']) ?  get_img_url($elements['p9e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e4" value="<?php echo isset($elements['p9e4']) ?  get_img_url($elements['p9e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    
    <div class="page page9 nr">
    
        <section class="main-page swiper-slide">
            <div id="page10" class="m-img wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record-bg.gif);"></div>
            <ul>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px;" swiper-animate-effect="puffIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 44px; height: 74px; left: 52px; top: -8px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 37px; height: 63px; right: 0px; bottom: 200px; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 37px; height: 63px; left: -7px; bottom: 0px; " swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont13.png"></li>
                <li class="ani" style="width: 100%; height: 38px; left: 0px; top: 335px;text-align: center;color: rgb(255, 222, 117); font-size: 18px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1s">识别二维码关注百年婚宴</li>
                <li class="ani" style="width: 322px; height: 38px; left: 50%;margin-left: -156px; top: 500px;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1.5s"><a style="color: rgb(255, 222, 117); font-size: 18px; font-weight: bold;">点击访问百年官网</a></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px;" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px;" swiper-animate-effect="rollIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 207px; height: 191px; left: 50%;margin-left: -103px; top: 135px; " swiper-animate-effect="flipInY" swiper-animate-duration="0.5s" swiper-animate-delay="0.2s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont12.png"></li>
                <li class="ani" style="width: 135px; height: 135px; left: 50%;margin-left: -67px; top: 161px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s"><img src="<?php echo $domain['static']['url']?>/wap/images/record-bg10.jpg"></li>
                <li class="ani" style="width: 59px; height: 59px; left: 50%;margin-left: -30px; top: 415px;" swiper-animate-effect="flash" swiper-animate-duration="2s" swiper-animate-delay="0s"><a href="<?php echo $domain['mobile']['url']?>"><img src="<?php echo $domain['static']['url']?>/wap/images/record-cont15.png"></a></li>
            </ul>
        </section>
    </div>


</div>
</form>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        document.addEventListener("WeixinJSBridgeReady", function () {
          document.getElementById('media').play();
        }, false);
        document.addEventListener('touchstart', function(){ 
          document.getElementById('media').play();
        }, false);
        
        seajs.use([
           '<?php echo css_js_url('jquery.touchSwipe.min.js', 'wap')?>',
           '<?php echo css_js_url('idangerous.swiper.min.js', 'wap')?>',
        ], function(h5){

          $(document).ready(
              function() {
                  var nowpage = 0;
                  $(".container").swipe(
                      {
                          swipe:function(event, direction, distance, duration, fingerCount) {
                               if(direction == "up"){
                                  nowpage = nowpage + 1;
                               }else if(direction == "down"){
                                  nowpage = nowpage - 1;
                               }

                               if(nowpage > 9){
                                  nowpage = 9;
                               }

                               if(nowpage < 0){
                                  nowpage = 0;
                               }

                              $(".container").animate({"top":nowpage * -100 + "%"},400);

                              $(".page").eq(nowpage).addClass("cur").siblings().removeClass("cur");
                              $(".page").children("section.z-current").removeClass("z-current");
                              $(".page").eq(nowpage).children("section").addClass("z-current");
                          }
                      }
                  );
              }        
          );
          var myVideo=document.getElementById("media");
          $(".audio_btn").click(function() {
              $(this).toggleClass("rotate");
              if($(".audio_btn").hasClass("rotate")){
                  myVideo.play();
              }
              else{
                 myVideo.pause(); 
              }
          });

		})
    </script>

</body>
</html>
