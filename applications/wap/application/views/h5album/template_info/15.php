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
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-bg1.jpg">
                </li>
                <li class="ani" style="width: 219px; height: 285px; left: 3px; top: 17px;" swiper-animate-effect="flipInY" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont1.png">
                </li>
                <li class="ani" style="width: 318px; height: 212px; left: 50%; top: 315px;margin-left: -159px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont2.png">
                </li>
                <li class="ani" style="width: 166px; height: 36px; left: 48px; top: 249px;color: rgb(212, 171, 101);line-height: 36px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[0]][0]['default']) ?  $elements[$page_ids[0]][0]['default'] : 'Haley'?> 
                </li>
                <li class="ani" style="width: 166px; height: 36px; left: 48px; top: 280px;color: rgb(212, 171, 101);line-height: 36px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[0]][1]['default']) ?  $elements[$page_ids[0]][1]['default'] : 'Peggy'?>
                </li>
                <li class="ani" style="width: 191px; height: 119px; left: 50%; top: 370px;margin-left: -95px;" swiper-animate-effect="fadeInRight" swiper-animate-duration="1.2s" swiper-animate-delay="1.8s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont3.png">
                </li>
                <li class="ani" style="width: 320px; height: 34px; left: 50%; top: 331px;margin-left: -160px;color: rgb(0, 0, 0);line-height: 34px;text-align: center;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="2.7s">
                    <?php echo isset($elements[$page_ids[0]][2]['default']) ?  $elements[$page_ids[0]][2]['default'] : '2018年05月21日09:00'?> 
                </li>
                <li class="ani" style="width: 160px; height: 201px; right: 20px; top: 21px;" swiper-animate-effect="showWaver" swiper-animate-duration="8s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont4.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-bg2.jpg">
                </li>
                <li class="ani" style="width: 90%; height: 72%; left: 5%; bottom: 10px;" swiper-animate-effect="puffIn" swiper-animate-duration="2s" swiper-animate-delay="4s">
                    <img src="<?php echo isset($elements[$page_ids[1]][0]['default']) ?  get_img_url($elements[$page_ids[1]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 90%; height: 72%; left: 5%; bottom: 10px;" swiper-animate-effect="fadeOutRight" swiper-animate-duration="2s" swiper-animate-delay="3s">
                    <img src="<?php echo isset($elements[$page_ids[1]][1]['default']) ?  get_img_url($elements[$page_ids[1]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 90%; height: 72%; left: 5%; bottom: 10px;" swiper-animate-effect="fadeOutRight" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo isset($elements[$page_ids[1]][2]['default']) ?  get_img_url($elements[$page_ids[1]][2]['default']) : ''?>">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model11-bg4.png);"></div>
            <ul>
                <li class="ani" style="width: 294px; height: 478px; left: 50%; top: 50%;margin: -239px 0 0 -147px;" swiper-animate-effect="filterBlur" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[2]][0]['default']) ?  get_img_url($elements[$page_ids[2]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 122px; left: 0; top: 311px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont5.png">
                </li>
                <li class="ani" style="width: 111px; height: 57px; left: 9px; top: 318px;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="2.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont6.png">
                </li>
                <li class="ani" style="width: 209px; height: 34px; left: 59px; top: 384px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="2.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont7.png">
                </li>
                <li class="ani" style="width: 258px; height: 29px; left: 53px; top: 366px;" swiper-animate-effect="fadeInDown" swiper-animate-duration="2s" swiper-animate-delay="2.2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont8.png">
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <div class="wrapper_bg" style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/model/model11-bg4.png);"></div>
            <ul>
                <li class="ani" style="width: 296px; height: 480px; left: 50%; top: 30px;margin-left: -148px;" swiper-animate-effect="filterGrayScale" swiper-animate-duration="4s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[3]][0]['default']) ?  get_img_url($elements[$page_ids[3]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 321px; height: 84px; left: 47%; top: 433px;margin-left: -148px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont9.png">
                </li>
                <li class="ani" style="width: 205px; height: 41px; left: 25px; top: 445px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont10.png">
                </li>
                <li class="ani" style="width: 280px; height: 35px; left: 30px; top: 477px;" swiper-animate-effect="fadeInUp" swiper-animate-duration="2s" swiper-animate-delay="2.4s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont11.png">
                </li>
            </ul> 
        </section> 
        <section class="swiper-slide">
            <ul>
                <li class="ani" style="width: 536px; height: 50%; left: -109px; top: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="16s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][0]['default']) ?  get_img_url($elements[$page_ids[4]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 536px; height: 50%; left: -110px; bottom: 0;" swiper-animate-effect="showWaver" swiper-animate-duration="20s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[4]][1]['default']) ?  get_img_url($elements[$page_ids[4]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont12.png">
                </li>
                <li class="ani" style="width: 88%; height: 94%; left: 6%; top: 4%;" swiper-animate-effect="puffIn" swiper-animate-duration="3s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont13.png">
                </li>
            </ul>    
        </section>  
        <section class="swiper-slide">   
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-bg1.jpg">
                </li>
                <li class="ani" style="width: 86%; height: 43%; left: 7%; top: 6%;" swiper-animate-effect="rollIn" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo isset($elements[$page_ids[5]][0]['default']) ?  get_img_url($elements[$page_ids[5]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 42%; height: 40%; left: 7%; bottom: 6%;" swiper-animate-effect="rollIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <img src="<?php echo isset($elements[$page_ids[5]][1]['default']) ?  get_img_url($elements[$page_ids[5]][1]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 42%; height: 40%; right: 7%; bottom: 6%;" swiper-animate-effect="rollIn" swiper-animate-duration="2s" swiper-animate-delay="2s">
                    <img src="<?php echo isset($elements[$page_ids[5]][2]['default']) ?  get_img_url($elements[$page_ids[5]][2]['default']) : ''?>">
                </li>
            </ul>             
        </section>
        <section class="swiper-slide">      
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-bg3.jpg">
                </li>
                <li class="ani" style="width: 264px; height: 79px; left: 48px; top: 50px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont14.png">
                </li>
                <li class="ani" style="width: 112px; height: 39px; left: 126px; top: 49px;color: #fff;" swiper-animate-effect="bounceInDown" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    婚礼邀约
                </li>
                <li class="ani" style="width: 326px; height: 204px; left: 50%; top: 155px;margin-left: -163px;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont15.png">
                </li>
                <li class="ani" style="width: 303px; height: 181px; left: 50%; top: 163px;margin-left: -151px;color: #fff;padding-left: 15px;padding-top: 15px;line-height: 25px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[6]][0]['default']) ?  $elements[$page_ids[6]][0]['default'] : 'Haley'?> &amp;
                    <?php echo isset($elements[$page_ids[6]][1]['default']) ?  $elements[$page_ids[6]][1]['default'] : 'Peggy'?>
                    <br>诚挚邀请您参加新婚典礼<br><?php echo isset($elements[$page_ids[6]][2]['default']) ?  $elements[$page_ids[6]][2]['default'] : '时间：2018年05月21日09:00'?>
                    <br><?php echo isset($elements[$page_ids[6]][3]['default']) ?  $elements[$page_ids[6]][3]['default'] : '详细地址：万达 铂尔曼酒店'?><br>敬备喜宴 恭请光临
                </li>
                <li class="ani" style="width: 320px; height: 39px; left:50%; top: 360px;margin-left: -160px;color: #fff;text-align: center;line-height: 39px;" swiper-animate-effect="fadeIn" swiper-animate-duration="2s" swiper-animate-delay="1s">
                    <?php echo isset($elements[$page_ids[6]][4]['default']) ?  $elements[$page_ids[6]][4]['default'] : '距典礼还有：515天17小时57分'?>
                </li>
                <li class="ani" style="width: 134px; height: 52px; left: 50%; top: 420px;margin-left: -67px;" swiper-animate-effect="bounceIn" swiper-animate-duration="2s" swiper-animate-delay="1.5s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont16.png"></a>
                </li>
            </ul>                 
        </section>
        <section class="swiper-slide">        
            <ul>
                <li class="ani" style="width: 100%; height: 100%; left: 0; top: 0;">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-bg4.jpg">
                </li>
                <li class="ani" style="width: 64%; height: 184px; left: 18%; top: 18%;">
                     <img src="<?php echo isset($elements[$page_ids[7]][0]['default']) ?  get_img_url($elements[$page_ids[7]][0]['default']) : ''?>">
                </li>
                <li class="ani" style="width: 80px; height: 22px; left: 19%; top: 52%;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="tel:<?php echo isset($elements[$page_ids[7]][1]['default']) ?  $elements[$page_ids[7]][1]['default'] : '139xxxx2589'?>">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont17.png">
                    </a>
                </li>
                <li id="bless" class="ani" style="width: 80px; height: 24px; left: 19%; top: 63%;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont18.png">
                </li>
                <li class="ani" style="width: 80px; height: 25px; left: 19%; top: 75%;" swiper-animate-effect="fadeInLeft" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&amp;output=html&amp;src=百年婚宴">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont19.png">
                    </a>
                </li>
                <li class="ani" style="width: 80px; height: 23px; right: 19%; top: 52%;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <a href="tel:<?php echo isset($elements[$page_ids[7]][2]['default']) ?  $elements[$page_ids[7]][2]['default'] : '139xxxx2589'?>">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont20.png">
                    </a>
                </li>
                <li id="message" class="ani" style="width: 80px; height: 23px; right: 19%; top: 63%;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont21.png">
                </li>
                <li class="ani" style="width: 80px; height: 24px; right: 19%; top: 75%;" swiper-animate-effect="fadeInRight" swiper-animate-duration="2s" swiper-animate-delay="0s">
                    <img src="<?php echo $domain['static']['url']?>/wap/images/model/model11-cont22.png">
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
