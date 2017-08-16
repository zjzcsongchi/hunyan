<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_index.css', 'www')?>">
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>

    <!-- 内容 -->
    <div class="container">
        <div class="banner-cont">
            <?php if(isset($video) && $video['video']):?>
            <video src="<?php echo get_vedio_url($video['video'])?>" controls="controls" loop="loop" style=" position: absolute; width: 100%;" autoplay="autoplay" poster="<?php echo $domain['static']['url']?>/www/images/banner.jpg"></video>
            <?php else:?>
            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/banner.jpg" >
            <?php endif;?>
            <div class="banner-con">
                <div class="baner-cont">
                    <div class="ewm">
                        <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg" >
                        <p>扫一扫关注百年婚宴</p>
                    </div>
                    <div class="banner-title" onclick="window.open('/news/detail/68')"></div>
                </div>
                <div class="search">
                    <input type="text" placeholder="&#x767E;&#x5E74;&#x5E78;&#x798F;&#x5385;">
                    <a href="javascript:;">搜索</a>
                </div>
            </div>
            <div class="count-cont">
                <div class="cont">
                    <div class="count"><span><?php echo $guest_num;?></span>位<br>已接待宾客</div>
                    <em></em>
                    <div class="count"><span><?php echo $wedding_num;?></span>场<br>已策划婚礼</div>
                    <em></em>
                    <div class="count"><span><?php echo $bless_num?></span>份<br>已收到祝福</div>
                    <em></em>
                    <div class="count"><span><?php echo $flower_num?></span>朵<br>已收到鲜花</div>
                </div>                
            </div>
        </div>
        <div class="index-main">
            <div class="page-main">
                <p class="head">酒水批发</p>
                <div class="subtitle"><img src="<?php echo $domain['static']['url']?>/www/images/index-title3.png"></div>
                <div class="drink-chose">
                    <?php foreach ($class_list as $k => $v):?>
                        <a class="<?php if($k == 14):?>act<?php endif;?> drink_class" data-id="<?php echo $k?>"><?php echo $v?></a>
                    <?php endforeach;?>
                </div>

                <?php if(isset($lists) && $lists):?>
                    <ul class="venue-list">
                    <?php foreach ($lists as $k => $v):?>
                    
                        <?php 
                            if(($k+1)%5 == 0){
                                $flag = 1;
                            }else{
                                $flag = 0;
                            }
                            
                        ?>
                    
                        <li <?php if($flag == 1):?>style="margin-right: 0px;"<?php endif;?> data_id="<?php echo $v['id']?>">
                            <?php if($v['is_promotion']):?>
                                <em>促<br>销</em>
                            <?php endif;?>
                            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo get_img_url($v['cover_img']) ?>">
                            <p class="title"><?php echo $v['title'] ;?></p>
                            <p class="icon">
                            <?php if(isset($v['flag']) && $v['flag'] ):?>
                            <?php foreach ($v['flag'] as $key=>$val):?>
                            <span><?php echo $val?></span>
                            <?php endforeach;?>
                            <?php endif;?>
                            </p>
                            <div class="price">¥<span> <?php echo $v['present_price'];?></span>/ <?php echo $v['unit'] ;?><p>批发价<i></i></p></div>
                        </li>
                    <?php endforeach;?>
                    </ul>
                <?php endif;?>
            </div>
        </div>
    </div>
    

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('drink.js', 'www')?>', '<?php echo css_js_url('jquery.lazyimg.js', 'www')?>'], function(a){
    			a.load();
    			a.drink_class();
    			$("img").lazyimg({threshold:300});//阀值，距可视区域300px 时再进行图片加载
        })
    </script>
</body>
</html>
