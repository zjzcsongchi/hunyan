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
    <link rel="stylesheet" href="<?php echo css_js_url('wap-ml.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>

</head>
<body class="grey">
    <div class="page-main">
        <div class="video-cont">                        
            <video loop="" src="<?php echo isset($manual['video']) ? get_video_url($manual['video']) : '';?>" id="media" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;" poster="<?php echo isset($manual['img_url']) ? get_img_url($manual['img_url']) : '';?>"></video>                     
            <i class='act'> </i>
        </div>
        
        <div class="page-cont">
            <p class="max-title">套餐标准</p>
        </div>
        <ul class="set-meal">
            <?php foreach ($combos as $k=>$v):?>
                <li data-id = "<?php echo $v['id']?>" class="<?php echo $v['class_name']?>">
                    <p class="title"><?php echo $v['name']?><span class="r"><?php echo $v['price']?>元</span></p>
                    <div class="line"></div>
                    <p class="text"><?php echo $v['desc']?></p>
                    <p class="text"><?php echo $v['info']?></p>
                    <i></i>
                </li>
            <?php endforeach;?>
        </ul>
        <div class="page-cont">
            <p class="max-title">案例欣赏</p>
            <ul class="case-list">
                <?php foreach ($themes as $k => $v):?>
                    <li data-id = "<?php echo $v['id']?>" class="<?php echo $v['class_name']?>">
                        <img src="<?php echo get_img_url($v['cover_img'])?>">
                        <div class="bg"></div>
                        <p class="title"><?php echo $v['title']?></p>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>'], function(p){
    	p.load();
        $(function(){
        
        //视频播放
          var myVideo=document.getElementById("media");
          $(".video-cont, .video-cont i").click(function() {
           $(".video-cont i").removeClass("act");
           $(".video-cont img").removeClass("act");
           myVideo.play();
          });

            //套餐详情跳转
            $(".set-meal li").on('click', function() {
                var url = '/milan/combo?id=' + $(this).data('id');
                window.location.href = url ;
            });

          	//主题案例详情跳转
            $(".case-list li").on('click', function() {
                var url = '/milan/case_detail?id=' + $(this).data('id');
                window.location.href = url ;
            });
          
        });
    })
    </script>
      
</body>
</html>
