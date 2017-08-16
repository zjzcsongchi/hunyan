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
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
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
                    <!-- Swiper -->
                    <?php if(isset($venue)):?>
                    <div class="wap-banner">
                        <div class="swiper-wrapper">
                            <?php if(isset($venue)):?>
                            <?php foreach ($venue['images'] as $k => $v) :?>
                            <div class="swiper-slide"><img src="<?php echo get_img_url($v);?>" alt=""></div>
                            <?php endforeach;?>
                            <?php endif;?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="user-venue">
                        <p class="name"><?php echo $venue['name']?></p>
                        <p class="text">最大桌数：<span><?php echo $venue['max_table']?></span>桌&nbsp;&nbsp;楼层/层高：<?php echo $venue['floor']?>/<?php echo $venue['height']?>米</p>
                        <p class="text">场地面积：<span><?php echo number_format($venue['area_size'],0);?></span>平&nbsp;&nbsp;低消：<span><?php echo number_format($venue['min_consume'],0);?></span>/桌</p>
                        <p class="text">适合类型：<?php echo $venue['fit_type']?>&nbsp;&nbsp;容纳人数：<span><?php echo $venue['container']?></span>人</p>
                        <p class="text">设备支持：<?php echo $venue['device']?></p>
                    </div>
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
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(p){
            p.load();
            var swiper = new Swiper('.wap-banner', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay:2500
            });
        })
    </script>
</body>
</html>
