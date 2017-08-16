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
    <a class=" album-save use" style="position: fixed;z-index:999999;width:100px;height:30px;background-color: rgba(0,0,0,0.4);border-radius:3px;top:20px;text-align: center;line-height:30px;    text-decoration: none; left:20px;color:#fff;" href="/h5album/invit/<?php echo $template_id?>">
            <span style="font-size:16px;">使用模板</span>
    </a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="page page0 cur nr">
        <section class="main-page z-current">
            <div class="m-img" id="page1">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 302px; height: 324px; left: 50%; top: 94px; z-index: 2;">
                        <div class="element-box" style="margin-left: -151px; animation: rotateIn 6s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont1.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 306px; height: 230px; left: 50%; top: 139px; z-index: 3;">
                        <div class="element-box" style="margin-left: -153px; animation: bounceIn 2s ease 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont2.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 31px; left: 50%; top: 260px; z-index: 4;">
                        <div class="element-box" style="margin-left: -10px; animation: puffIn 2s ease 1.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont3.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 120px; height: 36px; left: 40%; top: 255px; z-index: 5; transform: rotateZ(7deg);">
                        <div class="element-box" style="margin-left: -60px; animation: puffIn 1s ease 1.5s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 120px; height: 36px;"><font color="#7e2412" size="4"><span style="line-height: 18px;">&nbsp;
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '罗尔'?></span></span></font></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 120px; height: 36px; left: 60%;margin-left: -60px; top: 266px; z-index: 6; transform: rotateZ(7deg);">
                        <div class="element-box" style="  animation: puffIn 1s ease 1.5s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 120px; height: 36px;"><font color="#7e2412" size="4"><span style="line-height: 18px;">&nbsp;
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '张洁'?></span></span></font></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 188px; height: 36px; left: 50%; top: 305px; z-index: 7; transform: rotateZ(7deg);">
                        <div class="element-box" style="margin-left: -94px; animation: puffIn 1s ease 1.5s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 188px; height: 36px;"><font color="#7e2412" size="3">
                        <span style="line-height: 18px;"><?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '2017年08月17日17:51'?></span></font></div></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page1 nr">
        <section class="main-page">
            <div class="m-img" id="page2">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 324px; height: 279px; left: -2px; top: 179px; z-index: 2;">
                        <div class="element-box" style=" animation: puffIn 1s ease 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont4.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 48px; height: 49px; left: 247px; top: 168px; z-index: 3; transform: rotateZ(5deg);">
                        <div class="element-box" style=" animation: bounceIn 2s ease 1.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont5.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 30px; left: 289px; top: 158px; z-index: 4; transform: rotateZ(29deg);">
                        <div class="element-box" style=" animation: fadeIn 2s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont6.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 52px; height: 62px; left: -14px; top: 230px; z-index: 5;">
                        <div class="element-box" style=" animation: bounceIn 1s ease 1.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont7.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 216px; height: 195px; left: 52px; top: 223px; z-index: 6;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 1.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 68px; height: 62px; left: 12px; top: 407px; z-index: 7; transform: rotateZ(7deg);">
                        <div class="element-box" style=" animation: swing 2s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont9.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 107px; height: 75px; left: 60px; top: 231px; z-index: 8;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 1.7s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 107px; height: 75px; left: 60px; top: 320px; z-index: 9;">
                        <div class="element-box" style="animation: fadeIn 2s ease 1.7s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][1]['default']) ?  get_img_url($elements[$page_ids[1]][1]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 88px; height: 165px; left: 173px; top: 230px; z-index: 10;">
                        <div class="element-box" style="animation: fadeIn 2s ease 1.5s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][2]['default']) ?  get_img_url($elements[$page_ids[1]][2]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 216px; height: 195px; left: 52px; top: 223px; z-index: 11;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 3s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont59.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 188px; height: 78px; left: 67px; top: 236px; z-index: 12;">
                        <div class="element-box" style=" animation: flipInY 2s ease 3.6s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][3]['default']) ?  get_img_url($elements[$page_ids[1]][3]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 188px; height: 78px; left: 67px; top: 324px; z-index: 13;">
                        <div class="element-box" style=" animation: flipInY 2s ease 3.6s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][4]['default']) ?  get_img_url($elements[$page_ids[1]][4]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 216px; height: 195px; left: 53px; top: 222px; z-index: 14;">
                        <div class="element-box" style=" animation: zoomIn 2s ease 6s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont8.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 200px; height: 183px; left: 56px; top: 229px; z-index: 15;">
                        <div class="element-box" style=" animation: zoomIn 2s ease 6s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[1]][5]['default']) ?  get_img_url($elements[$page_ids[1]][5]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 194px; height: 22px; left: 50%;margin-left: -97px; top: 69px; z-index: 16;">
                        <div class="element-box" style="margin-left: -97px;animation: fadeIn 1s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont10.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 263px; height: 23px; left: 50%;margin-left: -131px; top: 115px; z-index: 17;">
                        <div class="element-box" style="margin-left: -131px; animation: fadeIn 1s ease 0.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont11.png"></div>
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
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 36px; left: 50%;margin-left: -160px; top: 116px; z-index: 2;">
                        <div class="element-box" style="margin-left: -160px; animation: fadeIn 2s ease 1.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont12.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 312px; height: 39px; left: 50%;margin-left: -156px; top: 78px; z-index: 3;">
                        <div class="element-box" style="margin-left: -156px; animation: fadeIn 2s ease 0.9s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont13.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 321px; height: 24px; left: 50%;margin-left: -156px; top: 50px; z-index: 4;">
                        <div class="element-box" style="margin-left: -156px; animation: fadeIn 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont14.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 302px; height: 231px; left: 3px; top: 217px; z-index: 5;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont15.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 105px; height: 156px; left: 49px; top: 262px; z-index: 6; transform: rotateZ(-10deg);">
                        <div class="element-box" style="animation: bounceInLeft 2s ease 3s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 105px; height: 156px; left: 160px; top: 239px; z-index: 7; transform: rotateZ(-10deg);">
                        <div class="element-box" style=" animation: bounceInRight 2s ease 3s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[2]][1]['default']) ?  get_img_url($elements[$page_ids[2]][1]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 239px; height: 158px; left: 40px; top: 249px; z-index: 8; transform: rotateZ(-10deg);">
                        <div class="element-box" style="animation: zoomIn 2s ease 5s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[2]][2]['default']) ?  get_img_url($elements[$page_ids[2]][2]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 241px; height: 160px; left: 39px; top: 248px; z-index: 9; transform: rotateZ(-10deg);">
                        <div class="element-box" style=" animation: rollIn 1.5s ease 7.5s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[2]][3]['default']) ?  get_img_url($elements[$page_ids[2]][3]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 131px; height: 41px; left: 196px; top: 438px; z-index: 10;">
                        <div class="element-box" style="animation: fadeInRight 8s ease 2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont16.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 68px; height: 70px; left: 241px; top: 172px; z-index: 11;">
                        <div class="element-box" style=" animation: bounceIn 2s ease 2.4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont17.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 66px; left: 11px; top: 426px; z-index: 12;">
                        <div class="element-box" style="animation: bounceIn 2s ease 2.6s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont18.png"></div>
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
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 168px; height: 168px; left: 16px; top: 22px; z-index: 2;">
                        <div class="element-box" style="animation: rollIn 1s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont19.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 168px; height: 168px; right: 15px; top: 176px; z-index: 3;">
                        <div class="element-box" style=" animation: rollIn 1s ease 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont19.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 168px; height: 168px; left: 13px; top: 329px; z-index: 4;">
                        <div class="element-box" style=" animation: rollIn 1s ease 2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont19.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 22px; height: 47px; left: 161px; top: 167px; z-index: 5;">
                        <div class="element-box" style="animation: fadeIn 2s linear 1.6s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont20.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 22px; height: 47px; left: 150px; top: 307px; z-index: 6; transform: rotateZ(78deg);">
                        <div class="element-box" style=" animation: fadeIn 2s linear 1.6s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont20.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 50px; height: 22px; left: 205px; top: 96px; z-index: 7;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont21.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 50px; height: 22px; left: 58px; top: 254px; z-index: 8;">
                        <div class="element-box" style="animation: fadeIn 2s ease 1.2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont22.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 50px; height: 22px; left: 207px; top: 410px; z-index: 9;">
                        <div class="element-box" style="animation: fadeIn 2s ease 2.4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont23.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 148px; height: 148px; left: 24px; top: 34px; z-index: 10;">
                        <div class="element-box" style="border-radius: 160px; animation: rollIn 2s ease 0s 1 both;"><div class="element-box-contents" style="width: 100%; height: 100%; border-radius: 160px;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>"></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 148px; height: 148px; right: 25px; top: 187px; z-index: 11;">
                        <div class="element-box" style=" border-radius: 160px; animation: rollIn 2s ease 1s 1 both;"><div class="element-box-contents" style="width: 100%; height: 100%; border-radius: 160px;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[3]][1]['default']) ?  get_img_url($elements[$page_ids[3]][1]['default']) : ''?>"></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 148px; height: 148px; left: 22px; top: 341px; z-index: 12;">
                        <div class="element-box" style=" border-radius: 160px; animation: rollIn 2s ease 2s 1 both;"><div class="element-box-contents" style="width: 100%; height: 100%; border-radius: 160px;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[3]][2]['default']) ?  get_img_url($elements[$page_ids[3]][2]['default']) : ''?>"></div></div>
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
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 221px; height: 230px; left: 50%;margin-left: -110px; top: 15px; z-index: 2; transform: rotateZ(-24deg);">
                        <div class="element-box" style="margin-left: -110px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont4.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 194px; height: 161px; left: 50%;margin-left: -97px; top: 42px; z-index: 3; transform: rotateZ(-24deg);">
                        <div class="element-box" style="margin-left: -97px;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 34px; height: 20px; right: 30px; top: 271px; z-index: 4;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0.7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont24.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 41px; height: 54px; left: 20px; top: 3px; z-index: 5;">
                        <div class="element-box" style=" animation: flash 4s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont25.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 53px; height: 43px; left: 36px; top: 378px; z-index: 6;">
                        <div class="element-box" style=" animation: swing 2s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont26.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 177px; height: 150px; left: 155px; top: 350px; z-index: 7;">
                        <div class="element-box" style=" animation: fadeInRight 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont27.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page5 nr">
        <section class="main-page">
            <div class="m-img" id="page6">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box" style=" animation: fadeIn 3.5s ease 0s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box" style=" animation: zoomIn 2s ease 1.5s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[5]][1]['default']) ?  get_img_url($elements[$page_ids[5]][1]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 3;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont28.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 44px; height: 120%; left: 0; top: -10%; z-index: 4;">
                        <div class="element-box" style=" animation: fadeInUp 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont29.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 44px; height: 120%; right: 0; top: -10%; z-index: 5;">
                        <div class="element-box" style=" animation: fadeInDown 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont29.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 44px; height: 547px; left: 171px; top: -250px; z-index: 6; transform: rotateZ(90deg);">
                        <div class="element-box" style="animation: fadeInDown 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont29.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 44px; height: 547px; left: 130px; bottom: -250px; z-index: 7; transform: rotateZ(90deg);">
                        <div class="element-box" style=" animation: fadeInUp 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont29.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page6 nr">
        <section class="main-page">
            <div class="m-img" id="page7">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 532px; left: 0; bottom: 0; z-index: 1;">
                        <div class="element-box" style=" animation: fadeIn 3.5s ease 0s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 393px; left: 0; top: 0; z-index: 2;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont30.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 261px; height: 111px; left: 28px; top: 23px; z-index: 3;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont31.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 38px; height: 66px; left: 73px; top: 158px; z-index: 4;">
                        <div class="element-box" style="animation: flipInY 2s ease 0.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont32.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 38px; height: 66px; left: 23px; top: 158px; z-index: 5;">
                        <div class="element-box" style="animation: flipInY 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont33.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 54px; height: 66px; left: 106px; top: 157px; z-index: 6;">
                        <div class="element-box" style="animation: flipInY 2s ease 1s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont34.png"></div>
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
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 26px; left: 25px; top: 143px; z-index: 2;">
                        <div class="element-box" style=" animation: showBreath 2.3s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont35.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 21px; height: 31px; left: 52px; top: 181px; z-index: 3;">
                        <div class="element-box" style="animation: showBreath 2s ease 0.2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont36.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 67px; left: 255px; top: 58px; z-index: 4;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont37.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 22px; height: 33px; left: 282px; top: 24px; z-index: 5;">
                        <div class="element-box" style="animation: showBreath 2s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont36.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 21px; height: 17px; left: 282px; top: 118px; z-index: 6;">
                        <div class="element-box" style="animation: showBreath 2.7s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont38.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 192px; height: 194px; left: 50%;margin-left: -96px; top: 33px; z-index: 7;">
                        <div class="element-box" style="margin-left: -96px;border-radius: 160px; animation: fadeIn 2s ease 0.9s 1 both;"><div class="element-box-contents" style="width: 100%; height: 100%; border-radius: 160px;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>"></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 34px; height: 42px; left: 67px; top: 39px; z-index: 8;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont39.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 342px; height: 30px; left: 50%;margin-left: -171px; top: 305px; z-index: 9;">
                        <div class="element-box" style="margin-left: -171px; animation: fadeIn 2s ease 2.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont40.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 332px; height: 29px; left: 50%;margin-left: -166px; top: 275px; z-index: 10;">
                        <div class="element-box" style="margin-left: -166px; animation: fadeIn 2s ease 2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont41.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 320px; height: 97px; left: 50%;margin-left: -160px; top: 340px; z-index: 11;">
                        <div class="element-box" style="margin-left: -160px;animation: fadeIn 2s ease 3.4s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 320px; height: 97px;">
                        <div style="text-align: center;">
                        <span style="font-size: medium; color: inherit; line-height: inherit; background-color: initial;"><?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '请于2017年08月17日17:51一起见证我们的幸福！'?></span>
                        </div>
                        </div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 158px; height: 41px; left: 0; top: 415px; z-index: 12;">
                        <div class="element-box" style="animation: fadeIn 2s ease 3.8s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 158px; height: 41px;"><div style="text-align: right;"><span style="line-height: 16px; font-size: medium; color: inherit; background-color: initial;">新郎：
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[7]][2]['default']) ?  $elements[$page_ids[7]][2]['default'] : '罗尔'?></span></span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 158px; height: 41px; right: 0; top: 415px; z-index: 13;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 3.8s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 158px; height: 41px; text-align: center;"><font size="3"><span style="line-height: 16px;">新娘：
                        <span class="djs_xl_xn"><?php echo isset($elements[$page_ids[7]][3]['default']) ?  $elements[$page_ids[7]][3]['default'] : '张洁'?></span></span></font></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-text" style="width: 313px; height: 66px; left: 50%;margin-left: -156px; top: 460px; z-index: 14;">
                        <div class="element-box" style="margin-left: -156px; animation: fadeIn 2s ease 4.3s 1 both;"><div class="element comp_paragraph editable-text" style="cursor: default; width: 313px; height: 66px;"><div style="text-align: center;">
                        <span style="line-height: 16px; font-size: medium; color: inherit; background-color: initial;"><?php echo isset($elements[$page_ids[7]][4]['default']) ?  $elements[$page_ids[7]][4]['default'] : '席设：泛海大酒店'?></span></div><div style="text-align: center;">
                        <span style="display:none;line-height: 16px; font-size: medium; color: inherit; background-color: initial;">和平路198号泛海大酒店</span></div></div></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 26px; height: 36px; left: 50%;margin-left: -13px; top: 420px; z-index: 15;">
                        <div class="element-box" style="margin-left: -13px;animation: fadeIn 2s ease 3.8s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont42.png"></div>
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
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 32px; right: 0; top: 192px; z-index: 2;">
                        <div class="element-box" style="animation: fadeIn 2s ease 3.2s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont43.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 32px; right: 0; top: 160px; z-index: 3;">
                        <div class="element-box" style="animation: fadeIn 2s ease 2.5s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont44.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 228px; height: 149px; left: 77px; top: 278px; z-index: 4;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont45.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 32px; right: 0; top: 132px; z-index: 5;">
                        <div class="element-box" style="animation: fadeIn 2s ease 1.6s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont46.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 321px; height: 24px; right: 0; top: 108px; z-index: 6;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0.7s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont47.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 320px; height: 28px; right: 0; top: 81px; z-index: 7;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont48.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 37px; height: 22px; left: 133px; top: 91px; z-index: 8;">
                        <div class="element-box" style=" animation: showBreath 2s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont49.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 188px; height: 115px; left: 94px; top: 298px; z-index: 9;">
                        <div class="element-box" style="animation: puffIn 2s ease 4.2s 1 both;"><a href="" style="width: 188px; height: 115px;">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/map.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 179px; left: 12px; top: 252px; z-index: 10;">
                        <div class="element-box" style="animation: fadeIn 2s ease 3.4s 1 both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont50.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 20px; height: 22px; left: 175px; top: 340px; z-index: 11;">
                        <div class="element-box" style=" animation: fadeIn 2s ease 5s 1 both;"><a href="" style="width: 20px; height: 22px; margin-top: 0px; margin-left: 0px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont51.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 187px; height: 32px; left: 82px; top: 430px; z-index: 12;">
                        <div class="element-box"><a href="" style="width: 423px; height: 32px; margin-top: 0px; margin-left: -118.5px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont52.png"></a></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page9 nr">
        <section class="main-page">
            <div class="m-img" id="page10">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 1;">
                        <div class="element-box"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-bg.jpg"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 259px; height: 269px; left: 50%;margin-left: -130px; top: 15px; z-index: 2;">
                        <div class="element-box" style="margin-left: -130px;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont4.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 214px; height: 160px; left: 50%;margin-left: -107px; top: 56px; z-index: 3;">
                        <div class="element-box" style="margin-left: -107px;animation: bounceIn 2s ease 0s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo isset($elements[$page_ids[9]][0]['default']) ?  get_img_url($elements[$page_ids[9]][0]['default']) : ''?>"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 340px; height: 30px; left: 50%;margin-left: -170px; top: 226px; z-index: 4;">
                        <div class="element-box" style="margin-left: -170px; animation: fadeIn 2s ease 0.7s 1 both;">
                        <img id="bless" class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont53.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 34px; height: 20px; left: 85px; top: 232px; z-index: 5;">
                        <div class="element-box" style="animation: swing 2s linear 0s infinite both;"><img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont55.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 80px; left: 80px; top: 330px; z-index: 6;">
                        <div class="element-box" style="animation: bounceIn 2s ease 1.5s 1 both;">
                        <a href="tel:<?php echo isset($elements[$page_ids[9]][1]['default']) ?  $elements[$page_ids[9]][1]['default'] : '130xxxx8729'?>" style="width: 80px; height: 80px;">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont54.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 80px; right: 80px; top: 330px; z-index: 7;">
                        <div class="element-box" style="animation: bounceIn 2s ease 1.6s 1 both;">
                        <a href="tel:<?php echo isset($elements[$page_ids[9]][2]['default']) ?  $elements[$page_ids[9]][2]['default'] : '130xxxx8729'?>" style="width: 80px; height: 80px; margin-top: 0px; margin-left: 0px;">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont56.png"></a></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 80px; right: 80px; top: 440px; z-index: 8;">
                        <div class="element-box" style="animation: bounceIn 2s ease 1.8s 1 both;">
                        <img class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont57.png"></div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 80px; left: 80px; top: 440px; z-index: 9;">
                        <div class="element-box" style="animation: bounceIn 2s ease 1.7s 1 both;">
                        <img id="message" class="element comp_image editable-image" src="<?php echo $domain['static']['url']?>/wap/images/model/model5-cont58.png"></div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
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
    
    
<!-- 引入项目js资源文件,并配置构建地址演示 -->
<?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var wxConfig = <?php echo $wxConfigJSON?>;
		
        seajs.use([	
           '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('jquery.touchSwipe.min.js', 'wap')?>',
           '<?php echo css_js_url('idangerous.swiper.min.js', 'wap')?>',
           

        ], function(h5){
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
