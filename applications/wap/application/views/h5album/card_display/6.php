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
    <link href="<?php echo css_js_url('model2.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
</head>

<body onmousewheel="return false;">
<div class="container">
    <div class="audio_btn rotate">
        <audio loop="true" src="<?php echo get_img_url($music);?>" id="media" autoplay preload=""></audio>
    </div>
    <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;font-size:16px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/invit/<?php echo $template_id?>">
            返回修改</a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="page page0 cur nr">
        <section class="main-page z-current"> 
            <div class="m-img" id="page1">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0;">
                        <div class="element-box">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[0]][1]['default']) ?  get_img_url($elements[$page_ids[0]][1]['default']) : ''?>">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 258px; height: 258px; left: 28px; top: 237px; z-index: 2;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont1.png">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 119px; height: 70px; left: 120px; top: 338px; z-index: 3;">
                        <div class="element-box" style="animation: bounceIn 1s linear 0.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont2.png">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 121px; height: 88px; left: 52px; top: 319px; z-index: 4;">
                        <div class="element-box" style=" animation: bounceIn 1s linear 0.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont3.png">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 124px; height: 59px; left: 133px; top: 306px; z-index: 5;">
                        <div class="element-box" style="animation: bounceIn 1s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont4.png">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 139px; height: 61px; left: 68px; top: 377px; z-index: 6;">
                        <div class="element-box" style="animation: bounceIn 1s linear 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont5.png">
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 282px; height: 67px; left: 19px; top: 11px; z-index: 7;">
                        <div class="element-box" style=" opacity: 0.68;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont6.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 45px; height: 45px; left: 35px; top: 23px; z-index: 8;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.gif"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 214px; height: 61px; left: 78px; top: 9px; z-index: 9;">
                    <div class="element-box"><div class="element-box-contents" style="width: 100%; height: 100%;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 214px; height: 61px;"><font size="3" color="#ffffff">婚 礼 倒 计 时：</font><div><font size="3" color="#ffffff"><span class="djs_item" rel="1483092420">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '33天4小时3分'?>
                    </span></font></div></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 178px; top: 5px; z-index: 10;"><div class="element-box" style="animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 11;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 12;">
                        <div class="element-box" style="animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 13;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 14;">
                        <div class="element-box" style="animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 15;">
                        <div class="element-box" style="animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 16;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 17;">
                        <div class="element-box" style="animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 18;">
                        <div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                </ul>
            </div>
        </section> 
    </div>
    <div class="page page1 nr">
        <section class="main-page">
            <div class="m-img" id="page2">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0;">
                        <div class="element-box" style="animation: showBreath 10s linear 0s infinite both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 65px; left: 0px; top: 420px; z-index: 2;"><div class="element-box"><div class="element-box-contents" style="width: 100%; height: 100%;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 65px;">
                    <font size="2" color="#ffffff"><?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : 'Grow old together with a loved one'?>
                    </font>
                    <div>
                    <font size="2" color="#ffffff"><?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '遇一人白首，择一城终老。'?></font>
                    </div></div></div></div>
                    </li>
                    
                    
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 3;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 4;">
                        <div class="element-box" style="animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 5;"><div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 6;"><div class="element-box" style="animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 7;">
                        <div class="element-box" style="animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 8;">
                        <div class="element-box" style="animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 9;">
                        <div class="element-box" style="animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 10;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 11;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                </ul>
        </div></section>
    </div>
    <div class="page page2 nr">
        <section class="main-page">
            <div class="m-img" id="page3">
                <ul id="edit_area6383" class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 800px; height: 100%; left: -264px; top: 0; ">
                        <div class="element-box" style=" animation: showWaver 10s linear 0s infinite both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 65px; left: 0px; top: 420px; z-index: 2;">
                        <div class="element-box"><div class="element-box-contents" style="width: 100%; height: 100%;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 65px;">
                        <font color="#ffffff" size="2"><span style="line-height: 13px;"><?php echo isset($elements[$page_ids[2]][1]['default']) ?  $elements[$page_ids[2]][1]['default'] : 'Brief is life,but love is long...'?></span></font><br><div>
                        <font size="2" color="#ffffff"><?php echo isset($elements[$page_ids[2]][2]['default']) ?  $elements[$page_ids[2]][2]['default'] : '生命虽然短暂，但爱永恒...'?></font></div></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 3;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 4;">
                        <div class="element-box" style="animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 5;">
                        <div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 6;">
                        <div class="element-box" style="animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 7;">
                        <div class="element-box" style="animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 8;">
                        <div class="element-box" style="animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 9;">
                        <div class="element-box" style="animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 10;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 11;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page3 nr">
        <section class="main-page">
            <div class="m-img" id="page4">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; ">
                        <div class="element-box" style="animation: showBreath 10s linear 0s infinite both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 65px; left: 0px; top: 420px; z-index: 2;">
                        <div class="element-box">
                            <div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 65px;">
                                <font color="#ffffff" size="2"><span style="line-height: 13px;"><?php echo isset($elements[$page_ids[3]][1]['default']) ?  $elements[$page_ids[3]][1]['default'] : 'Decide,let the happiness continue...'?></span></font><br>
                                <div><font color="#ffffff" size="2"><span style="line-height: 13px;"><?php echo isset($elements[$page_ids[3]][2]['default']) ?  $elements[$page_ids[3]][2]['default'] : '我们决定，让幸福延续...'?></span></font></div>
                            </div>
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 3;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 4;">
                        <div class="element-box" style="animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 5;">
                        <div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 6;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 7;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 8;">
                        <div class="element-box" style="animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 9;">
                        <div class="element-box" style="animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 10;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 11;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page4 nr">
        <section class="main-page">
            <div class="m-img" id="page5">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;"><div class="element-box" style="animation: showBreath 10s linear 0s infinite both;">
                    <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 65px; left: 0px; top: 420px; z-index: 2;">
                        <div class="element-box"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 65px;">
                        <font color="#ffffff" size="2"><span style="line-height: 13px;"><?php echo isset($elements[$page_ids[4]][1]['default']) ?  $elements[$page_ids[4]][1]['default'] : 'Looking forward to witness our wedding！'?></span></font><br><div>
                        <font color="#ffffff" size="2"><span style="line-height: 13px;"><?php echo isset($elements[$page_ids[4]][2]['default']) ?  $elements[$page_ids[4]][2]['default'] : '期待，您见证我们的婚礼！'?></span></font></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 3;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 4;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 5;">
                        <div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 6;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 7;">
                        <div class="element-box" style="animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 8;">
                        <div class="element-box" style=" animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 9;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 10;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 11;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page5 nr">
        <section class="main-page">
            <div class="m-img" id="page6">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 800px; height: 100%; left: -280px; top: 0; z-index: 1;">
                        <div class="element-box" style="animation: showWaver 10s linear 0s infinite both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box" style="animation: flash 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont10.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 136px; height: 100px; left: 50%;margin-left: -68px; bottom: 100px; z-index: 3;">
                        <div class="element-box" style=" left: 50%;margin-left: -68px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont11.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 4;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 5;">
                        <div class="element-box" style="animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 6;">
                        <div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 7;">
                        <div class="element-box" style="animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 8;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 9;">
                        <div class="element-box" style="animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 10;">
                        <div class="element-box" style="animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 11;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 12;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page6 nr">
        <section class="main-page">
            <div class="m-img" id="page7">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont12.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 54px; height: 98px; left: 22px; top: -1px; z-index: 3;">
                        <div class="element-box" style="animation: swing2 11s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 34px; height: 62px; left: 91px; top: 38px; z-index: 4;">
                        <div class="element-box" style="animation: swing2 7s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 47px; height: 85px; left: 150px; top: -5px; z-index: 5;">
                        <div class="element-box" style="animation: swing2 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 6;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 7;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 8;">
                        <div class="element-box" style="animation: slideUp3 8s linear 3s infinite both;"><imgclass="element comp_image="" editable-image"="" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></imgclass="element></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 9;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 10;">
                        <div class="element-box" style="animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 11;">
                        <div class="element-box" style=" animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 76px; left: 243px; top: -2px; z-index: 12;">
                        <div class="element-box" style=" animation: swing2 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 13;">
                        <div class="element-box" style="animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 14;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 15;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 30px; height: 53px; left: 200px; top: 25px; z-index: 16;">
                        <div class="element-box" style=" animation: swing2 8s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 205px; height: 79px; right: 0; top: 338px; z-index: 17;">'
                        <div class="element-box" style=" animation: fadeInUp 2s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont14.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 186px; height: 79px; right: 0; top: 355px; z-index: 18;">
                        <div class="element-box" style="animation: fadeInUp 2s linear 0s 1 both;">
                            <div class="element comp_paragraph editable-text" style="cursor: default; width: 186px; height: 79px;"><font color="#ffffff" size="3">新郎：
                            <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '杰克'?></span></font><div><font color="#ffffff" size="3">The handsome man</font></div></div>
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
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>"></div>
                    </li>
                    <li lass="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont12.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 54px; height: 98px; left: 22px; top: -1px; z-index: 3;">
                        <div class="element-box" style=" animation: swing2 11s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 34px; height: 62px; left: 91px; top: 38px; z-index: 4;">
                        <div class="element-box" style="animation: swing2 7s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 47px; height: 85px; left: 150px; top: -5px; z-index: 5;">
                        <div class="element-box" style=" animation: swing2 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 30px; height: 53px; left: 200px; top: 25px; z-index: 6;">
                        <div class="element-box" style=" animation: swing2 8s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 7;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 8;">
                        <div class="element-box" style="animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 9;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 10;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 11;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 12;">
                        <div class="element-box" style="animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 13;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 76px; left: 243px; top: -2px; z-index: 14;">
                        <div class="element-box" style="animation: swing2 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 15;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 16;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 205px; height: 79px; left: -20px; top: 338px; z-index: 17;">
                        <div class="element-box" style=" animation: fadeInUp 2s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont14.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 186px; height: 79px; left: 0px; top: 338px; z-index: 18;">
                        <div class="element-box" style="animation: fadeInUp 2s linear 0s 1 both;">
                            <div class="element comp_paragraph editable-text" style="cursor: default; width: 186px; height: 79px;"><font color="#ffffff" size="3">新娘：
                            <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '琪琪'?></span></font><div><font color="#ffffff" size="3">The handsome girl</font></div></div></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page8 nr">
        <section class="main-page">
            <div class="m-img" id="page9">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box"><img ctype="4" class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 80px; left: 25px; top: 65px; z-index: 2;">
                        <div class="element-box"><div ctype="2" class="element comp_paragraph editable-text" style="cursor: default; "><div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: small; line-height: inherit; background-color: initial;">
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[8]][1]['default']) ?  $elements[$page_ids[8]][1]['default'] : '杰克'?></span></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 80px; left: 105px; top: 65px; z-index: 3;">
                        <div class="element-box"><div ctype="2" class="element comp_paragraph editable-text" style="cursor: default; "><div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: small; line-height: inherit; background-color: initial;">
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[8]][2]['default']) ?  $elements[$page_ids[8]][2]['default'] : '琪琪'?></span></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 154px; height: 66px; right: 20px; top: 60px; z-index: 4;">
                        <div class="element-box"><div class="element-box-contents" style="width: 100%; height: 100%;"><div ctype="2" class="element comp_paragraph editable-text" style="cursor: default; width: 154px; height: 66px;">
                        <font color="#ffffff" size="3"><?php echo isset($elements[$page_ids[8]][3]['default']) ?  $elements[$page_ids[8]][3]['default'] : '2016年12月30日18:07'?></font></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 5;">
                        <div class="element-box" style="animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 75px; top: -6px; z-index: 6;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 7;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 8;">
                        <div class="element-box" style="animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 9;">
                        <div class="element-box" style=" animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 10;">
                        <div class="element-box" style=" animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 11;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 12;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 13;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 36px; left: 50%;margin-left: -160px; top: 140px; z-index: 14;">
                        <div class="element-box" style=" left: 50%;margin-left: -160px;"><div ctype="2" class="element comp_paragraph editable-text" style="cursor: default; height: 36px;"><div style="text-align: center;">
                        <span style="color: rgb(255, 255, 255); font-size: large; line-height: inherit; background-color: initial;"><?php echo isset($elements[$page_ids[8]][4]['default']) ?  $elements[$page_ids[8]][4]['default'] : '鸢飞大酒店'?></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 67px; left: 50%;margin-left: -160px; top: 215px; z-index: 15;">
                        <div class="element-box" style=" left: 50%;margin-left: -160px;"><div ctype="2" class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 67px;"><div style="text-align: center;"><span style="font-size: medium; line-height: inherit; background-color: initial;"><font color="#ffffff"></font></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 150px; height: 73px; left: 0; bottom: 100px; z-index: 16;">
                        <div class="element-box" style="animation: fadeInLeft 2s linear 0s 1 both;"><a href="tel:<?php echo isset($elements[$page_ids[8]][5]['default']) ?  $elements[$page_ids[8]][5]['default'] : '137xxxx4545'?>" style="width: 152px; height: 73px; margin-top: 0px; margin-left: -1px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont15.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 154px; height: 76px; right: 0; bottom: 100px; z-index: 17;">
                        <div class="element-box" style=" animation: fadeInRight 2s linear 0s 1 both;"><a href="tel:<?php echo isset($elements[$page_ids[8]][6]['default']) ?  $elements[$page_ids[8]][6]['default'] : '137xxxx4545'?>" style="width: 157px; height: 76px; margin-top: 0px; margin-left: -1.5px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont16.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 43px; height: 48px; left: 50%;margin-left: -21px; top: 290px; z-index: 18;">
                        <div class="element-box" style="left: 50%;margin-left: -21px;animation: showBreath 4s linear 0s 10 both;"><a href="" style="width: 43px; height: 49px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont17.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 137px; height: 36px; left: 50%;margin-left: -69px; top: 350px; z-index: 19;">
                    
                        <div class="element-box" style="left: 50%;margin-left: -69px;background-color: rgba(255, 255, 255, 0);"><div class="element comp_paragraph editable-text" style="cursor: default; width: 137px; height: 36px;">
                        <font color="#ffffff" style="background-color: rgba(255, 255, 255, 0);" face="minijianxiuying_6391_25">一键</font></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 114px; height: 42px; left: 50%;margin-left: -57px; top: 350px; z-index: 20;">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                        <div class="element-box" style="left: 50%;margin-left: -57px;">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont18.png"></div></a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page9 nr">
        <section class="main-page">
            <div class="m-img" id="page10">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[9]][0]['default']) ?  get_img_url($elements[$page_ids[9]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 42px; height: 42px; left: 17px; top: -16px; z-index: 3;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 4s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 116px; top: -8px; z-index: 4;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 3s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 140px; top: 9px; z-index: 5;">
                        <div class="element-box" style="animation: slideUp3 7s linear 2s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 160px; top: -9px; z-index: 6;">
                        <div class="element-box" style="animation: slideUp3 7s linear 3.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 20px; left: 181px; top: 5px; z-index: 7;">
                        <div class="element-box" style=" animation: slideUp3 10s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 27px; height: 27px; left: 223px; top: -1px; z-index: 8;">
                        <div class="element-box" style=" animation: slideUp3 9s linear 5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 254px; top: -3px; z-index: 9;">
                        <div class="element-box" style=" animation: slideUp3 8s linear 2.5s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 25px; height: 25px; left: 277px; top: -3px; z-index: 10;">
                        <div class="element-box" style="animation: slideUp3 8s linear 1s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 11;">
                        <div class="element-box" style=" animation: fadeIn 4s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont19.png"></div>
                    </li>
                    <!--<li class="comp-resize comp-rotate inside wsite-image"  style="width: 134px; height: 42px; left: 50%;margin-left: -67px; bottom: 150px; z-index: 12;">
                        <div class="element-box"  style="left: 50%;margin-left: -67px; animation: fadeInUp 2s linear 1.5s 1 both;"><a href="iframe://wp.7192.com/getinfo_909727.html" style="width: 135px; height: 42px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont22.png"></a></div>
                    </li>-->
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 141px; height: 44px; left: 20px; bottom: 100px; z-index: 13;">
                        <div class="element-box" style=" animation: fadeInLeft 2s linear 1.5s 1 both;">
                        <img class="element comp_image editable-image" id="bless" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont20.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 142px; height: 42px; right: 20px; bottom: 100px; z-index: 14;">
                        <div class="element-box" style=" animation: fadeInRight 2s linear 1.5s 1 both;">
                        <a href="/h5album/bless/<?php echo $user_info['id']?>">
                        <img class="element comp_image editable-image" id="message" src="<?php echo $domain['static']['url']?>/wap/images/model/model2-cont21.png">
                        </a>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    
    <?php $this->load->view('common/bless')?>
    
</div>

    
<!-- 引入项目js资源文件,并配置构建地址演示 -->
<?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var wxConfig = <?php echo $wxConfigJSON?>;
		var host_id = "<?php echo $host_id?>";
		var template_id = "<?php echo $template_id?>";
        seajs.use([	
           '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('jquery.touchSwipe.min.js', 'wap')?>',
           '<?php echo css_js_url('idangerous.swiper.min.js', 'wap')?>',
           

        ], function(h5){
        	h5.submit();
            h5.pup();
            h5.autoPlayMusic();
          
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
          

		})
    </script>
</body>
</html>
