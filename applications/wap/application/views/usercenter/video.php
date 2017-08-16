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
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-user2.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>

</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="user-nav">
                       <li><a href="/usercenter/uservenue" <?php if($actions == 'uservenue'){echo 'class="act"';}?>>宴会厅</a></li>
                        <li><a href="/usercenter/userphoto" <?php if($actions == 'userphoto'){echo 'class="act"';}?>>婚礼照片</a></li>
                        <li><a href="/usercenter/uservideo" <?php if($actions == 'uservideo'){echo 'class="act"';}?>>婚礼视频</a></li>
                    </ul>
                    <?php if(isset($info)):?>
                    <div class="video-cont">                        
                        <video loop src="<?php echo get_img_url($info['video'])?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2;"></video>
                        <img class="act" src="<?php echo get_img_url($info['video_intro']);?>">
                        <i class="act"></i>
                        <div class="baner-title"><img src="<?php echo $domain['static']['url']?>/wap/images/baner-title.png"></div>                        
                    </div>
                    <div class="user-video">
                        <p class="date"><?php echo $info['solar_time']?></p>
                        <p class="title"><?php echo $info['video_title']?></p>
                        <p class="line"></p>
                        <p class="text"><?php echo $info['video_intro']?></p>
                    </div> 
                    <?php else:?>
                    <img src="<?php echo $domain['static']['url'];?>/wap/images/1.png" style="width: 10rem; margin-top: 5rem;  margin-left: 2.5rem;" />
                    <?php endif;?>
                    <!-- 底部 -->
                    <?php $this->load->view('common/new_footer')?>
                </div>   
            </div>
        </div> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>'], function(p){
            p.load();
        	var myVideo=document.getElementById("media");
            $(".video-cont").click(function() {
               $(".video-cont i").removeClass("act");
               $(".video-cont img").removeClass("act");
               myVideo.play();
            });
        })
    </script>
</body>
</html>