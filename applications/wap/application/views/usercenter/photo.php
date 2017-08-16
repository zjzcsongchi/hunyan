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
                    <div class="photo">
                        <?php if(isset($images)):?>
                        <?php foreach ($images as $k => $v):?>
                        <img src="<?php echo get_img_url($v);?>">
                        <?php endforeach;?>
                        <?php endif;?>
                    </div>

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
        })
    </script>
</body>
</html>
                    