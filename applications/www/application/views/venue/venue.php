<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('new_index.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
    
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <div class="banner-cont">
            <?php if(isset($about['index_vedio_url']) && $about['index_vedio_url']):?>
            <video src="<?php echo get_vedio_url($about['index_vedio_url'])?>" controls="controls" loop="loop" style=" position: absolute; width: 100%;" autoplay="autoplay" poster="<?php echo $domain['static']['url']?>/www/images/banner.jpg"></video>
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
        <?php foreach ($lists as $k=>$v):?>
        <?php if($k == C('public.venue_type.hall.id')):?>
        <div class="index-main">
            <div class="page-main">
                <p class="head"><?php echo C('public.venue_type.hall.name')?></p>
                <div class="venue-cont">
                    <ul class="venue-chose">
                        <?php foreach ($v as $key=>$val):?>
                        <li class="<?php if($key == 0):?>act<?php endif;?>"><?php echo $val['name']?></li>
                        <?php endforeach;?>
                    </ul>
                    <?php foreach ($v as $key=>$val):?>
                    <div class="venue-detail <?php if($key == 0):?>act<?php endif;?>"><a href="/venue/detail?id=<?php echo $val['id']?>"><img src="<?php echo get_img_url($val['cover_img'])?>"></a></div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
        
        <?php if($k == C('public.venue_type.rooms.id')):?>
        <div class="index-main">
            <div class="page-main">
                <p class="head"><?php echo C('public.venue_type.rooms.name')?></p>
                <div class="venue-cont">
                    <ul class="venue-chose">
                        <?php foreach ($v as $key=>$val):?>
                        <li class="<?php if($key == 0):?>act<?php endif;?>"><?php echo $val['name']?></li>
                        <?php endforeach;?>
                    </ul>
                    
                    <?php foreach ($v as $key=>$val):?>
                    <div class="venue-detail <?php if($key == 0):?>act<?php endif;?>"><a href="/venue/detail?id=<?php echo $val['id']?>"><img src="<?php echo get_img_url($val['cover_img'])?>"></a></div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
        <?php if($k == C('public.venue_type.vip.id')):?>
        <div class="index-main">
            <div class="page-main">
                <p class="head"><?php echo C('public.venue_type.vip.name')?></p>
                <div class="venue-cont">
                    <ul class="venue-chose">
                        <?php foreach ($v as $key=>$val):?>
                        <li class="<?php if($key == 0):?>act<?php endif;?>"><?php echo $val['name']?></li>
                        <?php endforeach;?>
                    </ul>
                    <?php foreach ($v as $key=>$val):?>
                    <div class="venue-detail <?php if($key == 0):?>act<?php endif;?>"><a href="/venue/detail?id=<?php echo $val['id']?>"><img src="<?php echo get_img_url($val['cover_img'])?>"></a></div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
        <?php endif;?>
        <?php endforeach;?>
    </div>
    <!-- 底部 -->
     <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('venue.js', 'www')?>', '<?php echo css_js_url('jquery.lazyimg.js', 'www')?>'], function(a){
    			a.load();
    			$("img").lazyimg({threshold:300});//阀值，距可视区域300px 时再进行图片加载
        })
    </script>
</body>
</html>
