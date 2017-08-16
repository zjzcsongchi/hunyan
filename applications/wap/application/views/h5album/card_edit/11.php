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
    <a style="position: absolute;z-index:9999;font-size:16px;width:80px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; right:50px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user_view.png)" href="/h5album/show/<?php echo $template_id?>/<?php echo $user_info['id']?>">
            预览
    </a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[0]?>/0">
        <span style="font-size:16px;">编辑此页</span></a> 
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo isset($elements[$page_ids[0]][0]['default']) ?  get_img_url($elements[$page_ids[0]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 186px; height: 220px; right: 30px; bottom: 30px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont2.png">
                </li>
                <li class="ani" style="width: 185px; height: 45px; right: 30px; bottom: 115px;color: #fff;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '李坤'?>&amp; 
                    <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '韩娇'?>
                </li>
                <li class="ani" style="width: 156px; height: 59px; right: 45px; bottom: 70px;color: #fff;text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    婚礼倒计时<br><?php echo isset($elements[$page_ids[0]][3]['default']) ?  $elements[$page_ids[0]][3]['default'] : '518天20小时32分'?>
                </li>
                <li class="ani" style="width: 80px; height: 20px; right: 85px; bottom: 55px;" swiper-animate-effect="tada" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont3.png">
                </li>
                <li class="ani" style="width: 300px; height: 338px; left: 10px; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont4.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[1]?>/1">
        <span style="font-size:16px;">编辑此页</span></a>   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model7-bg1.jpg);"></div>
            <ul style="margin-top: 7.5px;">
                <li class="ani" style="width: 229px; height: 126px; left: 50%; top: 40px;margin-left: -115px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont5.png">
                </li>
                <li class="ani" style="width: 284px; height: 213px; left: 50%; top: 200px;margin-left: -142px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.8s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont6.png">
                </li>
                <li class="ani" style="width: 320px; height: 122px; left: 50%; top: 274px;margin-left: -160px; color: #888; transform: rotateZ(-0.126495deg);text-align: center;line-height: 30px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.8s" swiper-animate-delay="0s">
                    婚礼日期：<?php echo isset($elements[$page_ids[1]][0]['default']) ?  $elements[$page_ids[1]][0]['default'] : '2018年05月19日12:00'?>
                    <br><?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : '婚礼地址：万达广场'?>
                    <br><?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '铂尔曼酒店'?>
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[2]?>/2">
        <span style="font-size:16px;">编辑此页</span></a>     
            <ul>
                <li class="ani" style="width: 250px; height: 166px; left: 50%; top: 20%;margin-left: -125px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont1.png">
                </li>
                <li class="ani" style="width: 226px; height: 186px; left: 50%; top: 290px;margin-left: -113px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont7.png">
                </li>
                <li class="ani" style="width: 110%; height: 200px; right: 0; bottom: 0;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont8.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">    
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[3]?>/3">
        <span style="font-size:16px;">编辑此页</span></a>     
            <ul>
                <li class="ani inside-hover" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="10s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 80px; height: 119px; left: 0; top: 339px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/album-cont1.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[4]?>/4">
        <span style="font-size:16px;">编辑此页</span></a> 
            <ul>
                <li class="ani inside-hover" style="width: 807px; height: 100%; left: -249px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="16s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>" style="width: 807px; height: 1210px; margin-top: -337px; top: 142px;">
                </li>
                <li class="ani" style="width: 74px; height: 180px; right: 50px; top: 302px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/album-cont2.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[5]?>/5">
        <span style="font-size:16px;">编辑此页</span></a>  
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="10s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 73px; height: 177px; right: 50px; top: 10px;" swiper-animate-effect="flipInY" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/album-cont3.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide"> 
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[6]?>/6">
        <span style="font-size:16px;">编辑此页</span></a>      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][1]['default']) ?  get_img_url($elements[$page_ids[6]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 97px; height: 130px; left: 19px; top: 346px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="1.8s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/album-cont4.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">  
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[7]?>/7">
        <span style="font-size:16px;">编辑此页</span></a>       
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="showBreath" swiper-animate-duration="10s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 80px; height: 135px; left: 27px; top: 353px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/album-cont5.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[8]?>/8">
        <span style="font-size:16px;">编辑此页</span></a> 
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont9.png">
                </li>
                <li class="ani" style="width: 286px; height: 128px; left: 50%; top: 39px; margin-left: -143px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont10.png">
                </li>
                <li class="ani" style="width: 116px; height: 29px; left: 50%; top: 83px;margin-left: -58px; " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont11.png">
                </li>
                <li class="ani" style="width: 135px; height: 37px; left: 50%; top: 385px;margin-left: -67px; " swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="6s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont12.png">
                </li>
                <li class="ani" style="width: 135px; height: 37px; left: 30px; top: 450px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="6s">
                    <a href="tel:<?php echo isset($elements[$page_ids[8]][1]['default']) ?  $elements[$page_ids[8]][1]['default'] : '158xxxx4851'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont13.png"></a>
                </li>
                <li class="ani" style="width: 135px; height: 37px; right: 30px; top: 450px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="6s">
                    <a href="tel:<?php echo isset($elements[$page_ids[8]][2]['default']) ?  $elements[$page_ids[8]][2]['default'] : '158xxxx4851'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont14.png"></a>
                </li>
                <li class="ani" style="width: 260px; height: 163px; left: 50%; top: 180px; margin-left: -130px;border: 5px solid rgb(255, 255, 255); border-radius: 20px; " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="5s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/map.png">
                    </a>
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">
        <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/page_edit/<?php echo $user_info['id']?>/<?php echo $template_id?>/<?php echo $page_ids[9]?>/9">
        <span style="font-size:16px;">编辑此页</span></a>    
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[9]][0]['default']) ?  get_img_url($elements[$page_ids[9]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont9.png">
                </li>
                <li class="ani" style="width: 286px; height: 128px; left: 50%; top: 53px;margin-left: -143px; " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont10.png">
                </li>
                <li class="ani" style="width: 116px; height: 29px; left: 50%; top: 95px;margin-left: -58px; " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont15.png">
                </li>
                <li class="ani" style="width: 250px; height: 84px; left: 50%; top: 190px;margin-left: -125px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont16.png">
                </li>
                <li class="ani" style="width: 152px; height: 38px; left: 50%; top: 300px;margin-left: -76px; " swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont17.png">
                </li>
                <li id="bless" class="ani" style="width: 135px; height: 37px; left: 30px; top: 450px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="4.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont18.png">
                </li>
                <li id="message" class="ani" style="width: 135px; height: 37px; right: 30px; top: 450px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="4.5s">
                    <a href="/h5album/bless/<?php echo $user_info['id']?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont19.png"></a>
                </li>
                <li class="ani" style="width: 135px; height: 37px; left: 50%; top: 385px;margin-left: -67px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="4.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model7-cont20.png">
                </li>
            </ul>             
        </section>        
    </div>    
    <div class="swiper-pagination"></div>
    <?php $this->load->view('common/bless')?>
</div>
<?php $this->load->view('common/jsfooter')?>
<script type="text/javascript">

		var wxConfig = <?php echo $wxConfigJSON?>;
		var host_id = "<?php echo $user_info['id']?>";
		var per_page = "<?php echo $per_page?>";
		var template_id = "<?php echo $template_id?>";
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
          mySwiper.slideTo(per_page);

		})
    </script>
</body>
</html>
