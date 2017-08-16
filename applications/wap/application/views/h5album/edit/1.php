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
    
    <link href="<?php echo css_js_url('my_dialog.css', 'wap');?>" type="text/css" rel="stylesheet" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e1" value="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 119px; left: 0; top: 339px; z-index: 2;">
                        <div class="element-box" style=" animation: zoomIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p1e2" value="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" style="width: 807px; height: 1210px; margin-top: -337px; top: 142px;">
                            <input type="hidden" name="p2e1" value="<?php echo isset($elements['p2e1']) ?  get_img_url($elements['p2e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 74px; height: 180px; right: 50px; top: 302px; z-index: 2;">
                        <div class="element-box" style="animation: fadeIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p2e2']) ?  get_img_url($elements['p2e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p2e2" value="<?php echo isset($elements['p2e2']) ?  get_img_url($elements['p2e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p3e1" value="<?php echo isset($elements['p3e1']) ?  get_img_url($elements['p3e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 73px; height: 177px; right: 50px; top: 10px; z-index: 2;">
                        <div class="element-box" style="animation: flipInY 3s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p3e2" value="<?php echo isset($elements['p3e2']) ?  get_img_url($elements['p3e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" data-group="g4" src="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e1" value="<?php echo isset($elements['p4e1']) ?  get_img_url($elements['p4e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 100%; height: 100%; left: 0; top: 0; z-index: 2;">
                        <div class="element-box" style=" animation: fadeInLeft 2.5s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g4" src="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e2" value="<?php echo isset($elements['p4e2']) ?  get_img_url($elements['p4e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 97px; height: 130px; left: 19px; top: 346px; z-index: 3;">
                        <div class="element-box" style="animation: fadeInLeft 2s ease 1.8s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p4e3']) ?  get_img_url($elements['p4e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p4e3" value="<?php echo isset($elements['p4e3']) ?  get_img_url($elements['p4e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e1" value="<?php echo isset($elements['p5e1']) ?  get_img_url($elements['p5e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 80px; height: 135px; left: 27px; top: 353px; z-index: 2;">
                        <div class="element-box" style="animation: zoomIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p5e2']) ?  get_img_url($elements['p5e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p5e2" value="<?php echo isset($elements['p5e2']) ?  get_img_url($elements['p5e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e1" value="<?php echo isset($elements['p6e1']) ?  get_img_url($elements['p6e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 151px; height: 239px; left: 25px; top: 269px; z-index: 3; transform: rotateZ(5deg);">
                        <div class="element-box" style=" border: 5px solid rgb(255, 255, 255);  animation: fadeInLeft 1s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e2" value="<?php echo isset($elements['p6e2']) ?  get_img_url($elements['p6e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 147px; height: 231px; right: 50px; top: 184px; z-index: 4; transform: rotateZ(4deg);">
                        <div class="element-box" style=" border: 5px solid rgb(255, 255, 255); animation: fadeInLeft 1s ease 0.8s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e3" value="<?php echo isset($elements['p6e3']) ?  get_img_url($elements['p6e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 162px; height: 259px; left: 35px; top: 2px; z-index: 5; transform: rotateZ(4deg);">
                        <div class="element-box" style=" border: 5px solid rgb(255, 255, 255);animation: fadeInLeft 1s ease 1.6s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p6e4']) ?  get_img_url($elements['p6e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p6e4" value="<?php echo isset($elements['p6e4']) ?  get_img_url($elements['p6e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e1" value="<?php echo isset($elements['p7e1']) ?  get_img_url($elements['p7e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 220px; height: 159px; left: 50%;margin-left: -110px; top: 41px; z-index: 3; transform: rotateZ(10deg);">
                        <div class="element-box" style="left: 50%;margin-left: -110px; border: 5px solid rgb(255, 255, 255); animation: rollIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e2']) ?  get_img_url($elements['p7e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e2" value="<?php echo isset($elements['p7e2']) ?  get_img_url($elements['p7e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 220px; height: 159px; left: 50%;margin-left: -110px; top: 183px; z-index: 4; transform: rotateZ(-10deg);">
                        <div class="element-box" style="left: 50%;margin-left: -110px; border: 5px solid rgb(255, 255, 255); animation: rollIn 2s ease 1s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e3" value="<?php echo isset($elements['p7e3']) ?  get_img_url($elements['p7e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 220px; height: 159px; left: 50%;margin-left: -110px; top: 340px; z-index: 5; transform: rotateZ(10deg);">
                        <div class="element-box" style="left: 50%;margin-left: -110px; border: 5px solid rgb(255, 255, 255);animation: rollIn 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p7e4']) ?  get_img_url($elements['p7e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p7e4" value="<?php echo isset($elements['p7e4']) ?  get_img_url($elements['p7e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
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
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e1']) ?  get_img_url($elements['p8e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e1" value="<?php echo isset($elements['p8e1']) ?  get_img_url($elements['p8e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 60%; height: 59%; right: 0; top: 0px; z-index: 2;">
                        <div class="element-box" style=" border: 0px solid rgb(255, 255, 255); animation: fadeInDown 1s ease 0.8s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e2']) ?  get_img_url($elements['p8e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e2" value="<?php echo isset($elements['p8e2']) ?  get_img_url($elements['p8e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 37%; height: 29%; left: 0px; top: 0px; z-index: 3;">
                        <div class="element-box" style="border: 0px solid rgb(255, 255, 255); animation: fadeInLeft 1s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e3']) ?  get_img_url($elements['p8e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e3" value="<?php echo isset($elements['p8e3']) ?  get_img_url($elements['p8e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 37%; height: 29%; left: 0px; top: 30%; z-index: 4;">
                        <div class="element-box" style=" animation: fadeInUp 1s ease 1.6s 1 both;">
                            <img class="element comp_image editable-image wxuploader" src="<?php echo isset($elements['p8e4']) ?  get_img_url($elements['p8e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p8e4" value="<?php echo isset($elements['p8e4']) ?  get_img_url($elements['p8e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page8 nr">
        <section class="main-page">
            <div class="album-save" style="color: white;
                                           top:55px;position: fixed;
                                           display: block;
                                           right: 20px;
                                           z-index: 900;
                                           width: 35px;
                                           height: 35px;
                                           background-color: rgba(0, 0, 0, 0.6);
                                           border-radius: 50%;
                                           text-align: center;">
                                    点击保存
            </div>
            <div class="m-img" id="page9">
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 66px; height: 483px; left: 8px; top: 28px; z-index: 1;">
                        <div class="element-box" style="animation: fadeInDown 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image" src="<?php echo isset($elements['p9e1']) ?  get_img_url($elements['p9e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e1" value="<?php echo isset($elements['p9e1']) ?  get_img_url($elements['p9e1']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 262px; height: 100%; right: 0; top: 0; z-index: 2;">
                        <div class="element-box">
                            <img  class="element comp_image editable-image wxuploader" data-group="g9" src="<?php echo isset($elements['p9e2']) ?  get_img_url($elements['p9e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e2" value="<?php echo isset($elements['p9e2']) ?  get_img_url($elements['p9e2']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 262px; height: 100%; right: 0; top: 0; z-index: 3;">
                        <div class="element-box" style="width: 100%; height: 100%; animation: fadeInRight 2s ease 2s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g9" src="<?php echo isset($elements['p9e3']) ?  get_img_url($elements['p9e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e3" value="<?php echo isset($elements['p9e3']) ?  get_img_url($elements['p9e3']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 262px; height: 100%; right: 0; top: 0; z-index: 4;">
                        <div class="element-box" style="animation: fadeInRight 2s ease 4s 1 both;">
                            <img class="element comp_image editable-image wxuploader" data-group="g9" src="<?php echo isset($elements['p9e4']) ?  get_img_url($elements['p9e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>">
                            <input type="hidden" name="p9e4" value="<?php echo isset($elements['p9e4']) ?  get_img_url($elements['p9e4']['default']) : $domain['static']['url'].'/wap/images/m-bancont.png'?>" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div> 
    
    
    <input type="hidden" name="template_id" value="<?php echo $template_id;?>" />

</div>
</form>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var wxConfig = <?php echo $wxConfigJSON?>;
		
        seajs.use([	
           '<?php echo css_js_url('h5.js', 'wap')?>',
           '<?php echo css_js_url('jquery.touchSwipe.min.js', 'wap')?>',
           '<?php echo css_js_url('idangerous.swiper.min.js', 'wap')?>',
           

        ], function(h5){
          h5.load();
          h5.saveAlbum();
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

                               if(nowpage > 8){
                                  nowpage = 8;
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
