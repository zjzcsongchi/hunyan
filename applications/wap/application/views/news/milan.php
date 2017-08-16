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
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('wap-ml.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('dropload.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>
</head>

<body class="grey">
    <div class="page-main padbot150">
        <!-- Swiper -->
        <div class="wap-banner">
            <div class="swiper-wrapper">
                <?php foreach ($manual_list as $k=>$v):?>
                    <div class="swiper-slide" data-url="<?php echo $v['url']?>">
                        <img src="<?php echo get_img_url($v['cover_img'])?>"><p><?php echo $v['title']?></p>
                    </div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <ul class="list-nav">
            <li <?php echo $class_id==C('news.milan.children.following_shot.id')?'class="act"':'';?> ><a href="/news/milan/<?php echo C('news.milan.children.following_shot.id')?>" ><?php echo C('news.milan.children.following_shot.name')?></a></li>
            <li <?php echo $class_id==C('news.milan.children.front_info.id')?'class="act"':'';?> ><a href="/news/milan/<?php echo C('news.milan.children.front_info.id')?>">前沿资讯</a></li>
            <li <?php echo $class_id==C('news.milan.children.marry_method.id')?'class="act"':'';?> ><a href="/news/milan/<?php echo C('news.milan.children.marry_method.id')?>">备婚攻略</a></li>
            <li <?php echo $class_id==C('news.milan.children.cars.id')?'class="act"':'';?> ><a href="/news/milan/<?php echo C('news.milan.children.cars.id')?>"><?php echo C('news.milan.children.cars.name')?></a></li>
        </ul>
        <div class="page-cont" style=" padding: 0;">
            <ul class="media-list" >
               <?php foreach ($list as $k=>$v):?>
               <a href="/news/detail?id=<?php echo $v['id']?>">
               <li>
                    <?php if(isset($v['video_url']) && $v['video_url']):?>
                    <i class="act"></i>
                    <?php endif;?>
                    <img src="<?php echo get_img_url($v['cover_img'])?>">
                    <div class="cont">
                        <p class="title"><?php echo $v['title']?></p>
                        <p class="text"><?php echo $v['summary']?></p>
                        <div class="con">
                            <p class="l"><?php echo $v['agency']?></p>
                            <p class="r icon1"><?php echo $v['read']?></p>
                            <p class="r icon2"><?php echo $v['zan_number']?></p>
                        </div>
                    </div>
                </li>
                </a>
              <?php endforeach;?>
            </ul>
            <input type="hidden" name="page" value="2"/>
            <input type="hidden" name="class_id" value="<?php echo $class_id?>"/>
            <div class="dropload-down">
                <div class="dropload-noData">↑上拉加载更多</div>
            </div>
        </div>
        
        <?php $this->load->view('common/new_footer')?>
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
     <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('new_new.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('iscroll.min.js', 'wap')?>', '<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(a,p){
			a.load();
			p.load();
			a.load_more();

			$(function() {
                var swiper = new Swiper('.wap-banner', {
                    pagination: '.swiper-pagination',
                    paginationClickable: true,
                    autoplay:2500
                });

                $('.swiper-slide').on('click', function(){
                  window.location.href = $(this).data('url');
                })
            })
        })
    </script>
</body>
</html>
