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
    <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('wap-ml.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>

</head>
<body class="grey">
    <div class="page-main">
        <div class="video-cont">                        
            <video loop="" src="<?php echo get_video_url($theme['video']);?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;" poster="<?php echo get_img_url($theme['cover_img']);?>"></video>                     
        </div>
    
        <div class="page-cont martop20">
            <p class="max-title">案例欣赏<span class="r"></p>            
        </div>
        <div class="container2">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                 <?php foreach ($theme['images'] as $v):?>
                     <div class="swiper-slide"><img src="<?php echo get_img_url($v);?>"></div>
                 <?php endforeach;?>
                </div>
            </div>
        </div>
        <div class="page-cont martop20">
            <ul class="news-list list1">
                <?php foreach ($news as $k => $v):?>
                    <li data-id="<?php echo $v['id'];?>">
                        <img src="<?php echo get_img_url($v['cover_img']);?>">
                        <div class="cont">
                            <p class="title"><?php echo $v['title'];?></p>
                            <p class="text"><?php echo $v['summary'];?></p>
                            <div class="con">
                                <p class="l"><?php echo $v['agency'];?></p>
                                <p class="r icon1"><?php echo $v['read'];?></p>
                                <p class="r icon2"><?php echo $v['zan_number'];?></p>  
                            </div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(p){
    	p.load();

        $(function(){
          //视频播放
          var myVideo=document.getElementById("media");
          $(".video-cont i").click(function() {
            $(this).removeClass("act");
            $(".video-cont img").removeClass("act");
            myVideo.play();
          });
          $(".video-cont").click(function() {
             $(".video-cont i").removeClass("act");
             $(".video-cont img").removeClass("act");
             myVideo.play();
          });

         //滑动插件
          var swiper = new Swiper('.swiper-container', {
            pagination: false,
            slidesPerView: 'auto',
            centeredSlides: true,
            paginationClickable: true,
            spaceBetween: 0
          });

          //文章详情跳转
          $(".news-list li").on('click', function() {
              var url = '/news/detail?id=' + $(this).data('id');
              window.location.href = url ;
          });

      });
       
       
    })
    </script>
      
</body>
</html>
