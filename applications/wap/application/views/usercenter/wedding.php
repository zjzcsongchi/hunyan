<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body class="grey">
    <div class="outerWrap">
        <div class="innerWrap">
            <!-- 头部 -->
            <?php $this->load->view('common/header')?>
            <div class="mainContainer">
                <div class="mainfix">
                    <!--会员公共头部 -->
                    <?php $this->load->view('common/user_header')?>
                    
                    <div class="user-cont">
                        <?php if(!isset($dish) && !isset($dinner)):?>
                            <div style="text-align:center;" >
                                <img style="width: 3rem;height:3rem;" src="<?php echo $domain['static']['url']?>/www/images/user.png"><p>您目前还没有预约哦~</p>
                            </div>
                        <?php endif;?>
                        <?php if(isset($dish)):?>
                        <p class="user-title"><i></i><span>婚宴菜单</span>每一道菜都是一种表现，是一种敬业</p>
                        <div class="device">
                            <div class="swiper-container swiper-container1">
                                <div class="swiper-wrapper">
                                    <?php if(isset($dish)){echo $dish;}?>
                                </div>
                            </div>
                            <div class="pagination pagination1"></div>
                        </div>
                        <?php endif;?>
                    </div>
                    <?php if(isset($images)):?>
                    <div class="user-cont">
                        <p class="user-title"><i></i><span>婚礼照片</span>每一道菜都是一种表现，是一种敬业</p>
                        <div class="device">
                            <div class="swiper-container swiper-container2">
                                <div class="swiper-wrapper">
                                    <?php if(isset($images)){echo $images;}?>
                                </div>
                            </div>
                            <div class="pagination pagination2"></div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if(isset($dinner)):?>
                    <div class="user-cont video-cont">
                        <p class="user-title"><i></i><span>婚礼视频</span>让全世界人参加你的婚礼</p>
                        <div class="video"><i class="video-but"></i><img src="<?php if(isset($dinner['cover_img'])){echo $dinner['cover_img'];}?>"></div>
                        <p class="date"><?php if(isset($dinner['solar_time'])){echo $dinner['solar_time'];}?></p>
                        <p class="title"><?php if(isset($dinner['video_title'])){echo $dinner['video_title'];}?></p>
                        <p class="text"><?php if(isset($dinner['video_intro'])){echo $dinner['video_intro'];}?></p>
                    </div>

                    <div class="popup-video">
                        <video autoplay id="media" loop src="<?php if(isset($dinner['video'])){echo get_img_url($dinner['video']);}?>" style="width: 100%;"></video>
                    </div>
                    <?php endif;?>
                    <div class="page-bg"></div>
                    <!-- 底部 -->
                    <?php $this->load->view('common/footer')?>
                </div>   
            </div>
        </div>
        <!-- 左边栏 -->
        <?php $this->load->view('common/scoller')?> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('iscroll.min.js', 'wap')?>','<?php echo css_js_url('idangerous.swiper.min.js', 'wap')?>'], function(){
			a.load();
			var mySwiper = new Swiper('.swiper-container1',{
                pagination: '.pagination1',
                loop:true,
                grabCursor: true,
                paginationClickable: true,
                // Disable preloading of all images
                preloadImages: false,
                // Enable lazy loading
                lazyLoading: true
            })

            var mySwiper = new Swiper('.swiper-container2',{
                pagination: '.pagination2',
                loop:true,
                grabCursor: true,
                paginationClickable: true,
                // Disable preloading of all images
                preloadImages: false,
                // Enable lazy loading
                lazyLoading: true
            });
			var myVideo=document.getElementById("media");
            $(".video-cont .video-but").click(function() {
                $(".page-bg").addClass("act");
                $(".popup-video").addClass("act");
                if($(".popup-video").hasClass("act")){ 
                    myVideo.play();
                }
                else{
                    myVideo.pause();
                }
            });
            $(".page-bg").click(function() {
                $(".page-bg").removeClass("act");
                $(".popup-video").removeClass("act");
            });
        });
  </script>
</body>
</html>
