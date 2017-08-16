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
                <div class="wrapper_bg" style="background-image: url('<?php echo $domain['static']['url'].'/wap/images/album-bg1.jpg'?>');"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 280px; height: 104px; left: 50%;margin-left: -140px; top: 32px; z-index: 2;">
                        <div class="element-box" style="left: 50%;margin-left: -140px;animation: puffIn 1.5s ease 0s 1 both;">
                            <img class="element comp_image editable-image " src="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e1" value="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 308px; height: 210px; left: 50%;margin-left: -154px; top: 136px; z-index: 3;">
                        <div class="element-box" style="left: 50%;margin-left: -154px;animation: zoomIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e2" value="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 267px; height: 32px; left: 50%;margin-left: -133px; top: 357px; z-index: 4;">
                        <div class="element-box" style="left: 50%;margin-left: -133px;animation: fadeIn 2s ease 1.2s 1 both;">
                            <img class="element comp_image editable-image " src="<?php echo isset($elements['p1e3']) ?  get_img_url($elements['p1e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e3" value="<?php echo isset($elements['p1e3']) ?  get_img_url($elements['p1e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 141px; height: 40px; left: 50%;margin-left: -70px; top: 392px; z-index: 5;">
                        <div class="element-box" style="left: 50%;margin-left: -70px; animation: fadeIn 2s ease 1.8s 1 both;">
                            <img class="element comp_image editable-image " src="<?php echo isset($elements['p1e4']) ?  get_img_url($elements['p1e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e4" value="<?php echo isset($elements['p1e4']) ?  get_img_url($elements['p1e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page1 nr">
        <section class="main-page">
            <div class="m-img" id="page2">
                <div class="wrapper_bg" style="background-image: url('<?php echo $domain['static']['url'].'/wap/images/album-bg2.jpg'?>');"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 303px; height: 202px; left: 50%;margin-left: -151px; top: 95px; z-index: 2;">
                        <div class="element-box" style="left: 50%;margin-left: -151px;animation: fadeInLeft 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p2e1" value="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                        </li>
                        <li class="comp-resize comp-rotate inside wsite-image" style="width: 303px; height: 202px; left: 50%;margin-left: -151px; top: 320px; z-index: 3;">
                            <div class="element-box" style="left: 50%;margin-left: -151px;animation: fadeInRight 2s ease 0s 1 both;">
                                <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p2e2']) ?  get_img_url($elements['p2e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                                <input type="hidden" name="p2e2" value="<?php echo isset($elements['p2e2']) ?  get_img_url($elements['p2e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                            </div>
                        </li>
                        <li class="comp-resize comp-rotate inside wsite-image" style="width: 130px; height: 50px; left: 50%;margin-left: -65px; top: 35px; z-index: 4;">
                            <div class="element-box" style="left: 50%;margin-left: -65px;animation: fadeInDown 2s ease 1.2s 1 both;">
                                <img class="element comp_image editable-image " src="<?php echo isset($elements['p2e3']) ?  get_img_url($elements['p2e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                                <input type="hidden" name="p2e3" value="<?php echo isset($elements['p2e3']) ?  get_img_url($elements['p2e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                            </div>
                        </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page2 nr">
        <section class="main-page">
            <div class="m-img" id="page3">
                <div class="wrapper_bg" style="background-image: url('<?php echo $domain['static']['url'].'/wap/images/album-bg1.jpg'?>');"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 258px; height: 29px; left: 0px; top: 91px; z-index: 2;">
                        <div class="element-box" style="animation: fadeInLeft 3s ease 0s 1 both;">
                            <img class="element comp_image editable-image " src="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p3e1" value="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 211px; left: 50%;margin-left: -160px; top: 167px; z-index: 3;">
                        <div class="element-box" style="left: 50%;margin-left: -160px; animation: zoomInRoll 2.8s linear 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p3e2" value="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 161px; height: 53px; left: 79px; top: 307px; z-index: 4;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image " src="<?php echo isset($elements['p3e3']) ?  get_img_url($elements['p3e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p3e3" value="<?php echo isset($elements['p3e3']) ?  get_img_url($elements['p3e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page3 nr">
        <section class="main-page">
            <div class="m-img" id="page4">
                <div class="wrapper_bg" style="background-image: url('<?php echo $domain['static']['url'].'/wap/images/album-bg2.jpg'?>');"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 60%; height: 60%; right: 0; top: 0; z-index: 2;">
                        <div class="element-box" style="animation: fadeInDown 2s ease 1s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e1" value="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 40%; height: 30%; left: 0; top: 0; z-index: 3;">
                        <div class="element-box" style="animation: fadeInDown 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e2" value="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 40%; height: 30%; left: 0; top: 30%; z-index: 4;">
                        <div class="element-box" style=" animation: fadeInLeft 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p4e3']) ?  get_img_url($elements['p4e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e3" value="<?php echo isset($elements['p4e3']) ?  get_img_url($elements['p4e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 40%; left: 0; bottom: 0; z-index: 5;">
                        <div class="element-box" style=" animation: fadeInRight 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p4e4']) ?  get_img_url($elements['p4e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e4" value="<?php echo isset($elements['p4e4']) ?  get_img_url($elements['p4e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 50%; height: 51%; right: 0; bottom: 0; z-index: 1;">
                        <div class="element-box" style="animation: fadeInUp 2s ease 1s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e1" value="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image inside-hover" style="width: 50%; height: 51%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box" style="animation: fadeInDown 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e2']) ?  get_img_url($elements['p5e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e2" value="<?php echo isset($elements['p5e2']) ?  get_img_url($elements['p5e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 50%; height: 49%; right: 0; top: 0; z-index: 3;">
                        <div class="element-box" style="animation: fadeInRight 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e3']) ?  get_img_url($elements['p5e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e3" value="<?php echo isset($elements['p5e3']) ?  get_img_url($elements['p5e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 50%; height: 49%; left: 0; bottom: 0; z-index: 4;">
                        <div class="element-box" style=" animation: fadeInLeft 2s ease 1s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e4']) ?  get_img_url($elements['p5e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e4" value="<?php echo isset($elements['p5e4']) ?  get_img_url($elements['p5e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 101px; height: 101px; left: 50%; top: 50%;margin: -50px 0 0 -50px; z-index: 5;">
                        <div class="element-box" style="margin: -50px 0 0 -50px;animation: zoomIn 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p5e5']) ?  get_img_url($elements['p5e5']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e5" value="<?php echo isset($elements['p5e5']) ?  get_img_url($elements['p5e5']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 93px; height: 60px; left: 50%; top: 50%;margin: -30px 0 0 -46px; z-index: 6;">
                        <div class="element-box" style="margin: -30px 0 0 -46px;animation: fadeIn 2s ease 3s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p5e6']) ?  get_img_url($elements['p5e6']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e6" value="<?php echo isset($elements['p5e6']) ?  get_img_url($elements['p5e6']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page5 nr">
        <section class="main-page">
            <div class="m-img" id="page6">
                <div class="wrapper_bg" style="background-image: url(&apos;./assets/images/album-bg3.jpg&apos;); "></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 290px; height: 80%; left: 35px; top: 25px; z-index: 2;">
                        <div class="element-box">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e1" value="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 290px; height: 80%; left: 35px; top: 25px; z-index: 3;">
                        <div class="element-box" style="animation: fadeInRight 1s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e2" value="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 290px; height: 80%; left: 35px; top: 25px; z-index: 4;">
                        <div class="element-box" style="animation: fadeInRight 1s ease 4s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e3" value="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 290px; height: 80%; left: 35px; top: 25px; z-index: 5;">
                        <div class="element-box" style="animation: fadeInRight 1s ease 6s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e4']) ?  get_img_url($elements['p6e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e4" value="<?php echo isset($elements['p6e4']) ?  get_img_url($elements['p6e4']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image inside-hover" style="width: 100%; height: 100%; left: 0; top: 0px; z-index: 6;">
                        <div class="element-box">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p6e5']) ?  get_img_url($elements['p6e5']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e5" value="<?php echo isset($elements['p6e5']) ?  get_img_url($elements['p6e5']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 82px; left: 240px; top: 0px; z-index: 7;">
                        <div class="element-box" style=" animation: fadeInDown 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p6e6']) ?  get_img_url($elements['p6e6']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e6" value="<?php echo isset($elements['p6e6']) ?  get_img_url($elements['p6e6']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 57px; height: 41px; right: 97px; bottom: 145px; z-index: 8;">
                        <div class="element-box" style="animation: fadeInDown 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p6e7']) ?  get_img_url($elements['p6e7']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e7" value="<?php echo isset($elements['p6e7']) ?  get_img_url($elements['p6e7']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 155px; height: 101px; right: 50px; bottom: 65px; z-index: 9;">
                        <div class="element-box" style=" animation: fadeInUp 1s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p6e8']) ?  get_img_url($elements['p6e8']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e8" value="<?php echo isset($elements['p6e8']) ?  get_img_url($elements['p6e8']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 121px; height: 66px; right: 68px; bottom: 80px; z-index: 10;">
                        <div class="element-box" style="animation: fadeIn 2s ease 1s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p6e9']) ?  get_img_url($elements['p6e9']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e9" value="<?php echo isset($elements['p6e9']) ?  get_img_url($elements['p6e9']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0px; z-index: 2;">
                        <div class="element-box" style=" animation: fadeInRight 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e1" value="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0px; z-index: 3;">
                        <div class="element-box" style=" animation: rollIn 2.5s ease 1.8s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e2']) ?  get_img_url($elements['p7e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e2" value="<?php echo isset($elements['p7e2']) ?  get_img_url($elements['p7e2']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0px; z-index: 4;">
                        <div class="element-box" style=" animation: puffIn 2.5s ease 3.5s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e3" value="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    
    <div class="page page7 nr">
    
        <section class="main-page swiper-slide">
            <div id="page8" class="m-img wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/record-bg.gif);"></div>
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

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		
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

                               if(nowpage > 7){
                                  nowpage = 7;
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
