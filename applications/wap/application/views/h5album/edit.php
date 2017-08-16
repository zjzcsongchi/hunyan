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
</head>

<body onmousewheel="return false;">
<form>
<div class="container">
    <div class="audio_btn rotate">
        <audio loop="true" src="<?php echo get_img_url($music);?>" id="media" autoplay preload=""></audio>
    </div>
    <div class="pre-wrap album-save">
        <div class="pre1"></div>
        <div class="pre2"></div>
    </div>
    <div class="page page0 cur nr">
        <section class="main-page z-current">
            <div class="m-img" id="page1">
                <div class="wrapper_bg" style=" background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/h5/album-bg1.jpg&apos;); "></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 280px; height: 104px; left: 50%;margin-left: -140px; top: 32px; z-index: 2;">
                        <div class="element-box" style="left: 50%;margin-left: -140px;animation: puffIn 1.5s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploder" src="<?php echo isset($elements['p1e1']) ?  get_img_url($elements['p1e1']['default']) : '123'?>">
                            <input type="hidden" name="p1e1" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 308px; height: 210px; left: 50%;margin-left: -154px; top: 136px; z-index: 3;">
                        <div class="element-box" style="left: 50%;margin-left: -154px;animation: zoomIn 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploder" src="<?php echo isset($elements['p1e2']) ?  get_img_url($elements['p1e2']['default']) : '123'?>">
                            <input type="hidden" name="p1e2" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 267px; height: 32px; left: 50%;margin-left: -133px; top: 357px; z-index: 4;">
                        <div class="element-box" style="left: 50%;margin-left: -133px;animation: fadeIn 2s ease 1.2s 1 both;">
                            <img class="element comp_image editable-image wxuploder" data-group="t1" src="<?php echo isset($elements['p1e3']) ?  get_img_url($elements['p1e3']['default']) : '123'?>">
                            <input type="hidden" name="p1e3" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 141px; height: 40px; left: 50%;margin-left: -70px; top: 392px; z-index: 5;">
                        <div class="element-box" style="left: 50%;margin-left: -70px; animation: fadeIn 2s ease 1.8s 1 both;">
                            <img class="element comp_image editable-image wxuploder" data-group="t1" src="<?php echo isset($elements['p1e4']) ?  get_img_url($elements['p1e4']['default']) : '123'?>">
                            <input type="hidden" name="p1e4" />
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <div class="page page1 nr">
        <section class="main-page">
            <div class="m-img" id="page2">
                <div class="wrapper_bg" style="background-image: url(&apos;<?php echo $domain['static']['url']?>/wap/images/h5/album-bg2.jpg&apos;);"></div>
                <ul class="edit_area weebly-content-area weebly-area-active">
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 303px; height: 202px; left: 50%;margin-left: -151px; top: 95px; z-index: 2;">
                        <div class="element-box" style="left: 50%;margin-left: -151px;animation: fadeInLeft 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploder" data-group="t2" src="<?php echo $domain['static']['url']?>/wap/images/test/album-p23.jpg">
                            <input type="hidden" name="p2e1" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 303px; height: 202px; left: 50%;margin-left: -151px; top: 320px; z-index: 3;">
                        <div class="element-box" style="left: 50%;margin-left: -151px;animation: fadeInRight 2s ease 0s 1 both;">
                            <img class="element comp_image editable-image wxuploder" data-group="t2" src="<?php echo $domain['static']['url']?>/wap/images/test/album-p24.jpg">
                            <input type="hidden" name="p2e2" />
                        </div>
                    </li>
                    <li class="comp-resize comp-rotate inside wsite-image" style="width: 130px; height: 50px; left: 50%;margin-left: -65px; top: 35px; z-index: 4;">
                        <div class="element-box" style="left: 50%;margin-left: -65px;animation: fadeInDown 2s ease 1.2s 1 both;">
                            <img class="element comp_image editable-image wxuploder" data-group="t2" src="<?php echo $domain['static']['url']?>/wap/images/h5/album-cont10.png">
                            <input type="hidden" name="p2e3" />
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
