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
    <a style="position: absolute;z-index:9999;width:120px;height:30px;background-color: rgba(0,0,0,0.5);border-radius:3px;top:20px;font-size:16px;text-indent: 40px;line-height:30px; left:20px;background-position: 10px center;color:#fff;    background-repeat: no-repeat;background-image:url(<?php echo $domain['static']['url']?>/wap/images/user-deit.png)"  href="/H5album/invit/<?php echo $template_id?>">
            返回修改</a>
    <div class="pre-wrap">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="swiper-wrapper">
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 260px; height: 13px; left: 50%; top: 220px;margin-left: -130px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont1.png">
                </li>
                <li class="ani" style="width: 120px; height: 35px; left: 10%; top: 255px;color: rgb(0, 87, 131);line-height: 35px;text-align: center;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '张迪'?>
                </li>
                <li class="ani" style="width: 120px; height: 35px; left: 60%; top: 290px;color: rgb(0, 87, 131);line-height: 35px;text-align: center;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '陈晨'?> 
                </li>
                <li class="ani" style="width: 51px; height: 47px; left: 50%; top: 265px;margin-left: -25px;" swiper-animate-effect="bounceInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont2.png">
                </li>
                <li class="ani" style="width: 30px; height: 12px; left: 30px; top: 350px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont3.png">
                </li>
                <li class="ani" style="width: 30px; height: 12px; right: 30px; top: 350px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont3.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; top: 340px;margin-left: -160px; color: rgb(0, 87, 131);text-align: center;" swiper-animate-effect="fadeInUp" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '2018年04月22日17:12'?> 
                </li>
                <li class="ani" style="width: 98px; height: 39px; right: 50px; bottom: 100px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont4.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 281px; height: 386px; left: 50%; top: 70px;margin-left: -140px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont5.png">
                </li>
                <li class="ani" style="width: 115px; height: 115px; left: 50%; top: 110px;margin-left: -57px;border: 3px solid rgb(177, 208, 239); border-radius: 160px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 320px; height: 86px; left: 50%; top: 360px;margin-left: -160px;color: rgb(117, 146, 178);text-align: center;line-height: 35px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                  <?php echo isset($elements[$page_ids[1]][1]['default']) ?  $elements[$page_ids[1]][1]['default'] : '席设： 潍坊伯尔曼酒店'?> 
                </li>
                <li class="ani" style="width: 320px; height: 59px; left: 50%; top: 470px;margin-left: -160px; color: rgb(7, 75, 120);line-height: 35px;text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                   <?php echo isset($elements[$page_ids[1]][2]['default']) ?  $elements[$page_ids[1]][2]['default'] : '距结婚典礼还有487天6小时9分'?> 
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg3.jpg);"></div>
            <ul>
                <li class="ani" style="width: 296px; height: 202px; left: 50%; top: 37px;margin-left: -148px;box-shadow: rgba(103, 161, 192, 0.498039) 2px 2px 13px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 140px; height: 121px; left: 25px; top: 272px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont6.png">
                </li>
                <li class="ani" style="width: 229px; height: 71px; right: 30px; top: 420px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont7.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide"> 
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg4.jpg);"></div>
            <ul>
                <li class="ani" style="width: 297px; height: 203px; left: 50%; top: 42px;margin-left: -148px; box-shadow: rgba(103, 161, 192, 0.498039) 2px 2px 13px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                   <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 131px; height: 117px; right: 30px; top: 276px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont8.png">
                </li>
                <li class="ani" style="width: 223px; height: 98px; left: 20px; top: 380px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont9.png">
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg5.jpg);"></div>
            <ul>
                <li class="ani" style="width: 305px; height: 207px; right: 0px; top: 34px;box-shadow: rgba(103, 161, 192, 0.498039) 2px 2px 13px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 104px; height: 104px; right: 201px; top: 195px;border-radius: 20px; box-shadow: rgba(91, 154, 189, 0.498039) 2px 2px 13px;overflow: hidden;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[4]][1]['default']) ?  get_img_url($elements[$page_ids[4]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 256px; height: 69px; left: 50px; bottom: 100px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont10.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg2.jpg);"></div>   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0; ">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont11.png">
                </li>
                <li class="ani" style="width: 143px; height: 123px; right: 20px; top: 270px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont12.png">
                </li>
                <li class="ani" style="width: 202px; height: 68px; left: 50%; bottom: 100px;margin-left: -101px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont13.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide"> 
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[6]][0]['default']) ?  get_img_url($elements[$page_ids[6]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1.8s">
                    <img src="<?php echo isset($elements[$page_ids[6]][1]['default']) ?  get_img_url($elements[$page_ids[6]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="rollIn" swiper-animate-duration="2s" swiper-animate-delay="3.6s">
                    <img src="<?php echo isset($elements[$page_ids[6]][2]['default']) ?  get_img_url($elements[$page_ids[6]][2]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="5.4s">
                    <img src="<?php echo isset($elements[$page_ids[6]][3]['default']) ?  get_img_url($elements[$page_ids[6]][3]['default']) : ''?>">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg6.jpg);"></div>
            <ul>
                <li class="ani" style="width: 218px; height: 38px; left: 50%; top: 80px;margin-left: -109px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont14.png">
                </li>
                <li class="ani" style="width: 264px; height: 9px; left: 50%; top: 120px;margin-left: -132px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont15.png">
                </li>
                <li class="ani" style="width: 270px; height: 165px; left: 50%; top: 140px;margin-left: -135px;color: rgb(11, 79, 120);text-align: center;line-height: 35px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.8s">
                    <?php echo isset($elements[$page_ids[7]][0]['default']) ?  $elements[$page_ids[7]][0]['default'] : '将于2018年04月22日17:12 举行新婚典礼 敬备喜宴 恭候光临'?>
                    <br><?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '详细地址：潍坊伯尔曼酒店伯尔曼酒店'?>
                </li>
                <li class="ani" style="width: 117px; height: 38px; left: 50%; top: 322px;margin-left: -58px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="1s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont16.png"></a>
                </li>
                <li class="ani" style="width: 121px; height: 34px; right: 40px; top: 376px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1.5s" swiper-animate-delay="1s">
                    <a href="tel:<?php echo isset($elements[$page_ids[7]][2]['default']) ?  $elements[$page_ids[7]][2]['default'] : '139xxxx6958'?>">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont17.png">
                    </a>
                </li>
                <li class="ani" style="width: 121px; height: 36px; left: 40px; top: 376px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1.5s" swiper-animate-delay="1s">
                    <a href="tel:<?php echo isset($elements[$page_ids[7]][2]['default']) ?  $elements[$page_ids[7]][2]['default'] : '139xxxx6958'?>">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont18.png">
                    </a>
                </li>
            </ul> 
        </section>
        <section class="swiper-slide">  
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model10-bg6.jpg);"></div>
            <ul>
                <li class="ani" style="width: 130px; height: 130px; left: 35px; top: 151px;border-radius: 50%;overflow: hidden;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[8]][0]['default']) ?  get_img_url($elements[$page_ids[8]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 130px; height: 130px; left: 190px; top: 235px;border-radius: 50%;overflow: hidden;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0.5s">
                    <img src="<?php echo isset($elements[$page_ids[8]][1]['default']) ?  get_img_url($elements[$page_ids[8]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 239px; height: 65px; left: 50%; top: 70px;margin-left: -149px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont19.png">
                </li>
                <li class="ani" style="width: 272px; height: 9px; left: 50%; top: 115px;margin-left: -136px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont15.png">
                </li>
                <li class="ani" style="width: 156px; height: 37px; left: 125px; top: 190px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont20.png">
                </li>
                <li class="ani" style="width: 153px; height: 42px; left: 55px; top: 280px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="1s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont21.png">
                </li>
                <li id="bless" class="ani" style="width: 146px; height: 33px; left: 50%; top: 435px;margin-left: -73px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.2s" swiper-animate-delay="1.7s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont22.png">
                </li>
                <li id="message" class="ani" style="width: 146px; height: 33px; left: 50%; top: 480px;margin-left: -73px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.2s" swiper-animate-delay="1.9s">
                    <a href="/h5album/bless/<?php echo $user_info['id']?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont23.png"></a>
                </li>
                <li class="ani" style="display:none;width: 146px; height: 33px; left: 50%; top: 388px;margin-left: -73px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1.2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model10-cont24.png">
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
</div>

<?php $this->load->view('common/jsfooter')?>
<script type="text/javascript">
        var wxConfig = <?php echo $wxConfigJSON?>;
        var host_id = "<?php echo $host_id?>";
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

		})
    </script>
</body>
</html>
