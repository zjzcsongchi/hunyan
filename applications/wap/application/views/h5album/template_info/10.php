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
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 277px; height: 183px; left: 50%; top: 17px;margin-left: -138px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont1.png">
                </li>
                <li class="ani" style="width: 251px; height: 22px; left: 50%; top: 102px;margin-left: -125px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont2.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; top: 74px;margin-left: -160px; color: rgb(236, 124, 122);text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : '李文龙'?> &nbsp;
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : '赵丹丹'?>
                </li>
                <li class="ani" style="width: 99px; height: 37px; left: 50%; top: 118px;margin-left: -50px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont3.png">
                </li>
                <li class="ani" style="width: 56px; height: 232px; left: 50%; top: 182px;margin-left: -28px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont4.png">
                </li>
                <li class="ani" style="width: 73px; height: 73px; left: 50%; bottom: 100px;margin-left: -36px;" swiper-animate-effect="wobble" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont5.png">
                </li>
                <li class="ani" style="width: 320px; height: 36px; left: 50%; bottom: 50px;margin-left: -160px;text-align: center;" swiper-animate-effect="zoomIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '2018年02月12日11:18'?>
                </li>
            </ul>   
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 100%; height: 320px; left: 0; bottom: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[1]][1]['default']) ?  get_img_url($elements[$page_ids[1]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 146px; left: 0; bottom: 190px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont6.png">
                </li>
                <li class="ani" style="width: 90%; height: 200px; left: 5%; top: 25px;" swiper-animate-effect="zoomIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 107px; height: 32px; left: 21px; bottom: 280px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont7.png">
                </li>
                <li class="ani" style="width: 245px; height: 37px; left: 0px; bottom: 240px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont8.png">
                </li>
                <li class="ani" style="width: 209px; height: 33px; left: 4px; bottom: 213px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont9.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg2.jpg); "></div>
            <ul>
                <li class="ani" style="width: 100%; height: 320px; left: 0; bottom: 0;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][1]['default']) ?  get_img_url($elements[$page_ids[2]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 146px; left: 0; bottom: 190px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont6.png">
                </li>
                <li class="ani" style="width: 90%; height: 200px; left: 5%; top: 25px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="1s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 130px; height: 39px; left: 3px; bottom: 280px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont10.png">
                </li>
                <li class="ani" style="width: 245px; height: 37px; left: 0px; bottom: 240px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont11.png">
                </li>
                <li class="ani" style="width: 209px; height: 33px; left: 39px; bottom: 213px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont12.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg2.jpg); "></div>
            <ul>
                <li class="ani" style="width: 90%; height: 200px; left: 5%; top: 270px;" swiper-animate-effect="flipInY" swiper-animate-duration="4s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[3]][1]['default']) ?  get_img_url($elements[$page_ids[3]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 90%; height: 200px; left: 5%; top: 46px;" swiper-animate-effect="flipInY" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 90%; height: 60px; left: 5%; top: 419px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont6.png">
                </li>
                <li class="ani" style="width: 90%; height: 60px; left: 5%; top: 194px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont6.png">
                </li>
                <li class="ani" style="width: 319px; height: 36px; left: 0px; top: 205px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont13.png">
                </li>
                <li class="ani" style="width: 316px; height: 31px; left: 1px; top: 430px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont14.png">
                </li>
                <li class="ani" style="width: 217px; height: 46px; left: 50%; bottom: 50px;margin-left: -108px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont15.png">
                </li>
            </ul> 
        </section> 
        <section class="swiper-slide">
            <div class="wrapper_bg" style=" background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg2.jpg);"></div>
            <ul>
                <li class="ani" style="width: 45%; height: 25%; left: 3%; top: 8%;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 45%; height: 25%; right: 3%; top: 8%;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[4]][1]['default']) ?  get_img_url($elements[$page_ids[4]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 45%; height: 25%; left: 3%; top: 38%;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo isset($elements[$page_ids[4]][2]['default']) ?  get_img_url($elements[$page_ids[4]][2]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 45%; height: 25%; right: 3%; top: 38%;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo isset($elements[$page_ids[4]][3]['default']) ?  get_img_url($elements[$page_ids[4]][3]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 45%; height: 25%; left: 3%; top: 68%;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="4s">
                    <img src="<?php echo isset($elements[$page_ids[4]][4]['default']) ?  get_img_url($elements[$page_ids[4]][4]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 45%; height: 25%; right: 3%; top: 68%;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="5s">
                    <img src="<?php echo isset($elements[$page_ids[4]][5]['default']) ?  get_img_url($elements[$page_ids[4]][5]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;background-color: rgba(0,0,0,0.4);" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="5s">
                </li>
                <li class="ani" style="width: 146px; height: 42px; left: 50%; top: 50%;margin: -21px 0 0 -73px;" swiper-animate-effect="zoomIn" swiper-animate-duration="1s" swiper-animate-delay="6s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont16.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <div class="wrapper_bg" style=" background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg2.jpg); "></div>
            <ul>
                <li class="ani" style="width: 286px; height: 178px; left: 50%; top: 32px;margin-left: -143px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/map.png">
                </li>
                <li class="ani" style="width: 316px; height: 172px; left: 50%; top: 226px;margin-left: -158px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont17.png">
                </li>
                <li class="ani" style="width: 231px; height: 40px; left: 65%; top: 253px;margin-left: -115px;line-height: 40px;" swiper-animate-effect="bounceInRight" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[5]][0]['default']) ?  $elements[$page_ids[5]][0]['default'] : '鸢飞大酒店'?>
                </li>
                <li class="ani" style="width: 235px; height: 40px; left: 65%; top: 310px;margin-left: -117px;line-height: 40px;" swiper-animate-effect="bounceInRight" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[5]][1]['default']) ?  $elements[$page_ids[5]][1]['default'] : '胜利街四平路'?>
                </li>
                <li class="ani" style="width: 127px; height: 35px; left: 20px; top: 500px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="tel:<?php echo isset($elements[$page_ids[5]][2]['default']) ?  $elements[$page_ids[5]][2]['default'] : '135xxxx7895'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont18.png"></a>
                </li>
                <li class="ani" style="width: 128px; height: 34px; right: 20px; top: 500px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="tel:<?php echo isset($elements[$page_ids[5]][3]['default']) ?  $elements[$page_ids[5]][3]['default'] : '135xxxx7895'?>"><img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont19.png"></a>
                </li>
                <li class="ani" style="width: 108px; height: 31px; left: 50%; top: 435px;margin-left: -54px; border-radius: 3px;overflow: hidden;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont20.png">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model6-bg1.jpg);"></div>
            <ul>
                <li class="ani" style="width: 167px; height: 167px; left: 50%; top: 110px;margin-left: -83px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont21.png">
                </li>
                <li id="bless" class="ani" style="width: 124px; height: 34px; left: 50%; top: 309px;margin-left: -62px;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont22.png">
                </li>
                <li class="ani" style="width: 292px; height: 84px; left: 50%; top: 17px;margin-left: -146px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont23.png">
                </li>
                <li id="message" class="ani" style="width: 127px; height: 35px; left: 50%; top: 370px;margin-left: -63px;" swiper-animate-effect="fadeIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont24.png">
                </li>
                <li class="ani" style="display:none;width: 127px; height: 35px; left: 50%; top: 430px;margin-left: -63px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href=""><img src="<?php echo $domain['static']['url']?>/wap/images/model/model6-cont25.png"></a>
                </li>
            </ul>                 
        </section>      
    </div>    
    <div class="swiper-pagination"></div>
    <div class="popup bless">
        <a href="javascript:;" class="close_mask"></a>
        <div id="post_zone">
            <form method="post">
                <table width="100%" class="szf" cellspacing="10">
                    <tr>
                        <td width="40" align="center">姓名:</td>
                        <td><input class="name" type="text" id="send" style="height:28px;"></td>
                    </tr>
                    <tr>
                        <td width="40" align="center">来宾:</td>
                        <td>
                            <select name="whos" id="whos" style="width:100px">
                                <option value="1">男方</option>
                                <option value="2">女方</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">寄语:</td>
                        <td>
                            <textarea id="content" class="input" name="content" style="width:180px;height:28px;" rows="3"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td>（注：留言内容限60字以内）</td>
                    </tr>
                    <tr>
                        <td align="center">出席:</td>
                        <td><select name="num" id="wall_num" style="height:28px;">
                            <option value="0">待定</option>
                            <option value="1" selected>1人出席</option>
                            <option value="2">2人出席</option>
                            <option value="3">3人出席</option>
                            <option value="4">4人出席</option>
                            <option value="5">5人出席</option>
                            <option value="6">6人出席</option>
                            <option value="7">7人出席</option>
                            <option value="8">8人出席</option>
                            <option value="9">9人出席</option>
                            <option value="10">10人出席</option>
                            <option value="11">不出席</option>
                        </select></td>
                    </tr>
                </table>
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

          
//           var index = mySwiper.activeIndex;
//           mySwiper.slideTo(6);
          
		})
    </script>

</body>
</html>
