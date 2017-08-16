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
    <a style="position: absolute;z-index:9999;font-size:16px;width:80px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; right:50px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user_view.png)" href="/h5album/show/<?php echo $template_id?>/<?php echo $user_info['id']?>">
            预览
    </a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="page page0 cur nr">
        <section class="main-page z-current">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[0]?>/0">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page1">
                <div class="wrapper_bg" style="background-color: rgb(0, 0, 0);"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 200px; left: -193px; top: 146px; z-index: 1;">
                        <div class="element-box" style="animation: fadeInRight 2s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont1.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 3;">
                        <div class="element-box" style=""><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont1.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 4;">
                        <div class="element-box" style="animation: fadeIn 1s linear 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont2.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 220px; left: -21px; top: 143px; z-index: 5;">
                        <div class="element-box" style="animation: bachelordom01 1.5s linear 1.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont3.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 6;">
                        <div class="element-box" style="animation: fadeIn 0.5s linear 3.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont2.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 7;">
                        <div class="element-box" style="animation: earthquake 3s linear 3.5s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[0]][0]['default']) ?  get_img_url($elements[$page_ids[0]][0]['default']) : ''?>"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page1 nr">
        <section class="main-page">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[1]?>/1">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page2">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 1;">
                        <div class="element-box" style="animation: fadeInLeft 0.5s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont3.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 2;">
                        <div class="element-box" style="animation: fadeIn 1s linear 0.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont2.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 296px; height: 159px; left: 8px; top: 123px; z-index: 3;">
                        <div class="element-box" style="animation: rotate03 2s linear 1.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont4.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 139px; height: 412px; right: 0px; top: 44px; z-index: 4;">
                        <div class="element-box" style="animation: fadeInRight 1s linear 4.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont5.png"?> div="">
                    </div></li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 223px; height: 128px; left: 28px; top: 120px; z-index: 5;">
                        <div class="element-box" style="animation: immigration 1.5s linear 3.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont6.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 137px; height: 84px; left: 40px; top: 19px; z-index: 6;">
                        <div class="element-box" style="animation: immigration2 1.5s linear 4.3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 7;">
                        <div class="element-box" style="animation: fadeInDown 1s ease 5.2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 8;">
                        <div class="element-box" style="animation: fadeInRight 1s ease 6s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 9;">
                        <div class="element-box" style="animation: fadeIn 2s linear 7s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 109px; height: 100%; left: 0px; top: 0px; z-index: 10;">
                        <div class="element-box" style="animation: towards1 2s linear 7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont4.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 109px; height: 100%; left: 109px; top: 0px; z-index: 11;">
                        <div class="element-box" style="animation: towards2 2s linear 7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont5.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 109px; height: 100%; left: 218px; top: 0px; z-index: 12;">
                        <div class="element-box" style="animation: towards3 2s linear 7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont6.jpg"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page2 nr">
        <section class="main-page">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[2]?>/2">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page3">
                <div class="wrapper_bg" style="background-color: rgb(0, 0, 0);"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 264px; height: 112px; left: 0px; top: 76px; z-index: 2;">
                        <div class="element-box" style="animation: shakedong 1.5s linear 0.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont10.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 246px; height: 117px; left: 51px; top: 131px; z-index: 3;">
                        <div class="element-box" style="animation: shakedong 1.5s linear 2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont11.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 143px; height: 413px; right: 0px; top: 39px; z-index: 4;">
                        <div class="element-box" style=" animation: fadeInRight 1s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont12.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 5;">
                        <div class="element-box" style="animation: fadeInLeft 1s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 6;">
                        <div class="element-box" style="animation: fadeInRight 1s linear 4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont14.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 7;">
                        <div class="element-box" style="animation: fadeIn 0.5s linear 4.2s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 109px; height: 100%; left: 0px; top: 0px; z-index: 8;">
                        <div class="element-box" style="animation: towards1 1s linear 4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont7.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 109px; height: 100%; left: 109px; top: 0px; z-index: 9;">
                        <div class="element-box" style="animation: towards2 1s linear 4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont8.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 109px; height: 100%; left: 218px; top: 0px; z-index: 10;">
                        <div class="element-box" style="animation: towards3 1s linear 4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont9.jpg"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page3 nr">
        <section class="main-page">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[3]?>/3">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page4">
                <div class="wrapper_bg" style="background-color: rgb(0, 0, 0);"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 311px; height: 35px; left: 50%; top: 220px; z-index: 2;">
                        <div class="element-box" style="margin-left: -156px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont15.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 311px; height: 35px; left: 50%; top: 220px; z-index: 3;">
                        <div class="element-box" style="margin-left: -156px;animation: fadeOut 0.5s linear 1.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont16.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 311px; height: 35px; left: 50%; top: 220px; z-index: 4;">
                        <div class="element-box" style="margin-left: -156px;animation: fadeOut 0.5s linear 0.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont17.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 180px; left: 50%; top: 24px; z-index: 5;">
                        <div class="element-box" style="margin-left: -160px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont1.gif"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 180px; left: 50%; top: 270px; z-index: 6;">
                        <div class="element-box" style="margin-left: -160px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont2.gif"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 7;">
                        <div class="element-box" style="animation: fadeIn 1s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont2.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 117px; height: 100%; left: 234px; top: 0px; z-index: 8;">
                        <div class="element-box" style="animation: towards3 2s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont10.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 117px; height: 100%; left: 113px; top: 0px; z-index: 9;">
                        <div class="element-box" style="animation: towards2 2s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont18.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 117px; height: 100%; left: 0px; top: 0px; z-index: 10;">
                        <div class="element-box" style="animation: towards1 2s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont19.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 297px; height: 104px; left: 50%; top: 8px; z-index: 11;">
                        <div class="element-box" style="animation: Shrinko 4.5s linear 5s 1 both;margin-left: -148px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont20.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 44px; left: 50%; top: 414px; z-index: 12;">
                        <div class="element-box" style="animation: Shrinko 4.5s linear 8s 1 both;margin-left: -160px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont21.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 315px; height: 71px; left: 50%; top: 147px; z-index: 13;">
                        <div class="element-box" style="animation: immigration4 2.5s linear 6s 1 both;margin-left: -157px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont22.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 253px; height: 38px; left: 50%; top: 292px; z-index: 14;">
                        <div class="element-box" style="animation: immigration3 2.5s linear 7s 1 both;margin-left: -126px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont23.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 116px; height: 117px; left: 41px; top: 138px; z-index: 15;">
                        <div class="element-box" style="animation: flicker 0.4s linear 7.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont24.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 116px; height: 117px; left: 73px; top: 360px; z-index: 16;">
                        <div class="element-box" style="animation: flicker 0.4s linear 10s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont24.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 116px; height: 117px; left: 147px; top: -2px; z-index: 17;">
                        <div class="element-box" style="animation: flicker 0.4s linear 6.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont24.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 114px; height: 115px; left: 203px; top: 106px; z-index: 18;">
                        <div class="element-box" style="animation: flicker 0.5s linear 7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont25.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 114px; height: 115px; left: 207px; top: 354px; z-index: 19;">
                        <div class="element-box" style="animation: flicker 0.5s linear 9s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont25.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 20;">
                        <div class="element-box" style="animation: puffIn 1s linear 9.5s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 128px; left: 0; top: 360px; z-index: 21;">
                        <div class="element-box" style="animation: immigration3 2s linear 10s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont26.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 258px; height: 71px; right: 0; top: 367px; z-index: 22;">
                        <div class="element-box" style="animation: Shrinko 1.5s linear 10s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont29.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 23;">
                        <div class="element-box" style="animation: flicker 0.2s linear 12s 3 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont30.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 286px; height: 452px; left: -14px; bottom: 25px; z-index: 24;">
                        <div class="element-box" style="animation: searchlight 2.5s linear 9s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont31.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 235px; left: 0x; top: 296px; z-index: 25;">
                        <div class="element-box" style="animation: fadeIn 2s linear 11s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont27.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 133px; height: 88px; left: 171px; top: 344px; z-index: 26;">
                        <div class="element-box" style="line-height: 1.5; animation: fadeIn 2s linear 11s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 133px; height: 88px;"><div style="text-align: right;"><span><font color="#ffffff" size="4">新郎</font></span></div><div style="text-align: right;"><span><font size="5" color="#f4711f">
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[3]][1]['default']) ?  $elements[$page_ids[3]][1]['default'] : '乔治'?></span></font></span></div></div></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page4 nr">
        <section class="main-page">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[4]?>/4">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page5">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 1;">
                        <div class="element-box" style="animation: puffIn 2s linear 0s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 135px; left: 0px; top: 360px; z-index: 2;">
                        <div class="element-box" style="animation: immigration3 2s linear 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont26.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 235px; left: 0px; top: 300px; z-index: 3;">
                        <div class="element-box" style="animation: fadeIn 2s linear 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont27.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 240px; height: 66px; right: 10px; top: 368px; z-index: 4;">
                        <div class="element-box" style="animation: Shrinko 1.5s linear 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont28.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 290px; height: 457px; left: -12px; bottom: 26px; z-index: 5;">
                        <div class="element-box" style="animation: searchlight 2.5s linear 2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont31.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0px; top: 0px; z-index: 6;">
                        <div class="element-box" style="animation: flicker 0.2s linear 4s 3 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont30.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 133px; height: 88px; left: 171px; top: 344px; z-index: 7;">
                        <div class="element-box" style="line-height: 1.5;animation: fadeIn 2s linear 3s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 133px; height: 88px;"><div style="text-align: right;"><span><font color="#ffffff" size="4">新娘</font></span></div><div style="text-align: right;"><span><font size="5" color="#f4711f">
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[4]][1]['default']) ?  $elements[$page_ids[4]][1]['default'] : '杰西卡'?></span></font></span></div></div></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page5 nr">
        <section class="main-page">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[5]?>/5">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page6">
                <div class="wrapper_bg" style="background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/model/model15-bg1.jpg&apos;);"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 33%; height: 100%; left: 66%; top: 1px; z-index: 2;">
                        <div class="element-box" style="animation: towards3 2s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont11.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 33%; height: 100%; left: 33%; top: 0px; z-index: 3;">
                        <div class="element-box" style="animation: towards2 2s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont32.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 34%; height: 100%; left: 0; top: 0px; z-index: 4;">
                        <div class="element-box" style="animation: towards1 2s linear 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont33.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside" style="width: 100%; height: 220px; left: 0; top: 30px; z-index: 5;">
                        <div class="element-box" style="animation: fadeIn 1s linear 1.7s 1 both; overflow: visible;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside" style="width: 100%; height: 220px; left: 0; top: 30px; z-index: 5;">
                        <div class="element-box" style="animation: fadeInLeft 1s linear 3.2s 1 both; overflow: visible;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[5]][1]['default']) ?  get_img_url($elements[$page_ids[5]][1]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside" style="width: 100%; height: 220px; left: 0; top: 30px; z-index: 5;">
                        <div class="element-box" style="animation: fadeInLeft 1s linear 4.5s 1 both; overflow: visible;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[5]][2]['default']) ?  get_img_url($elements[$page_ids[5]][2]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 30px; left: 0px; top: 220px; z-index: 6;">
                        <div class="element-box" style="animation: fadeIn 1s linear 1.7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont34.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 71px; height: 15px; left: 6px; top: 222px; z-index: 7;">
                        <div class="element-box" style="animation: fadeIn 1s linear 2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont35.png"></div>
                    </li>
                    <li id="message" class="comp-resize comp-rotate inside wsite-image" style="display:none;width: 80px; height: 80px; left: 50%; top: 285px; z-index: 8;">
                        <div class="element-box" style="animation: zoomIn 1s linear 2s 1 both;margin-left: -40px;"><a href="iframe://wp.7192.com/mvideo_909738.html">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont36.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 80px; left: 55px; top: 378px; z-index: 9;">
                        <div class="element-box" style="animation: zoomIn 1s linear 2s 1 both;">
                        <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont37.png"></a></div>
                    </li>
                    <li id="bless" class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 80px; right: 55px; top: 378px; z-index: 10;">
                        <div class="element-box" style="animation: zoomIn 1s linear 2s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont38.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 249px; height: 36px; left: 69px; top: 212px; z-index: 11;">
                        <div class="element-box" style="animation: fadeIn 1s linear 1.7s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 249px; height: 36px;">
                        <font size="2" color="#ffffff"><span class="djs_item"><?php echo isset($elements[$page_ids[5]][3]['default']) ?  $elements[$page_ids[5]][3]['default'] : '主场婚礼倒计时：26天2小时35分'?></span></font></div></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page6 nr">
        <section class="main-page">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[6]?>/6">
        <span style="font-size:16px;">编辑此页</span></a>
            <div class="m-img" id="page7">
                <div class="wrapper_bg" style="background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/model/model15-bg1.jpg&apos;);"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 300px; height: 30px; left: 50%; top: 140px; z-index: 2;">
                        <div class="element-box" style="margin-left: -150px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont39.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 36px; left: 50%; top: 131px; z-index: 3;">
                        <div class="element-box" style="animation: fadeIn 2s linear 1s 1 both;margin-left: -160px;"><div class="element comp_paragraph editable-text" style=" width: 320px; height: 36px;"><div style="text-align: center;">
                        <span style="color: rgb(255, 255, 255); font-size: medium;"><?php echo isset($elements[$page_ids[6]][0]['default']) ?  $elements[$page_ids[6]][0]['default'] : '将于2017年01月21日13:18'?></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 319px; height: 36px; left: 50%; top: 185px; z-index: 4;">
                        <div class="element-box" style="animation: fadeIn 2s linear 1s 1 both;margin-left: -160px;"><div class="element comp_paragraph editable-text" style=" width: 319px; height: 36px;"><div style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: medium; ">举行新婚典礼 敬备喜宴 恭候光临</span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 60px; left: 50%; top: 230px; z-index: 5;">
                        <div class="element-box" style="margin-left: -160px;line-height: 0.75; animation: fadeIn 2s linear 1s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 60px;"><div style="text-align: center;">
                        <span style="color: rgb(255, 255, 255); font-size: medium;"><?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : '席设酒店： 鸢飞大酒店'?></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 64px; left: 50%; top: 260px; z-index: 6;">
                        <div class="element-box" style="margin-left: -160px;line-height: 0.75;animation: fadeIn 2s linear 1s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 64px;"><div style="text-align: center;">
                        <span style="color: rgb(255, 255, 255); font-size: medium;"><?php echo isset($elements[$page_ids[6]][2]['default']) ?  $elements[$page_ids[6]][2]['default'] : '详细地址： 鸢飞大酒店'?></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 36px; left: 50%; top: 450px; z-index: 7;">
                        <div class="element-box" style="margin-left: -160px; animation: fadeIn 2s linear 1s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; height: 36px;"><div style="text-align: center;">
                        <span style="color: rgb(255, 255, 255); font-size: medium;"><span class="djs_item"><?php echo isset($elements[$page_ids[6]][5]['default']) ?  $elements[$page_ids[6]][5]['default'] : '婚礼倒计时 ：26天2小时35分'?></span></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 280px; height: 84px; left: 50%; top: 20px; z-index: 8;">
                        <div class="element-box" style="margin-left: -140px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont40.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 112px; height: 28px; right: 25px; top: 410px; z-index: 9;">
                        <div class="element-box" style="animation: fadeInRight 1s linear 1.5s 1 both;">
                        <a href="tel:<?php echo isset($elements[$page_ids[6]][3]['default']) ?  $elements[$page_ids[6]][3]['default'] : '137xxxx5251'?>"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont41.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 112px; height: 28px; left: 25px; top: 410px; z-index: 10;">
                        <div class="element-box" style="animation: fadeInLeft 1s linear 1.5s 1 both;">
                        <a href="tel:<?php echo isset($elements[$page_ids[6]][4]['default']) ?  $elements[$page_ids[6]][4]['default'] : '137xxxx5251'?>"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont42.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="display:none;width: 112px; height: 28px; left: 50%; top: 335px; z-index: 11;">
                        <div class="element-box" style="margin-left: -56px;animation: fadeInDown 1s linear 0.5s 1 both;"><a href="iframe://wp.7192.com/getinfo_909738.html">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model15-cont43.png"></a></div>
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
    	var host_id = "<?php echo $user_info['id']?>";
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

                                     if(nowpage > 6){
                                        nowpage = 6;
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
