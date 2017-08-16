<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title><?php echo $dinner['roles_main']?>和<?php echo $dinner['roles_wife']?>的婚礼</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('swiper.min.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-waps.css', 'wap');?>" type="text/css" rel="stylesheet" />

    <link href="<?php echo css_js_url('m-banquets.css', 'wap');?>" type="text/css" rel="stylesheet" />
    
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="mainfix">
            <div class="video-cont">                        
                <video id="media" loop src="<?php echo get_vedio_url($video['venue_video'])?>" style="position: absolute; width: 100%;left: 50%;margin-left: -50%;top:0;z-index: 2; object-fit:cover;"></video>
                <img class="act" src="<?php echo $domain['static']['url'].'/wap/images/m-banner.jpg'?>">
                <i class="act"></i>
                <div class="baner-title"><img src="<?php echo $domain['static']['url'].'/wap/images/baner-title.png'?>"></div>                        
            </div>
            <div class="banqute-detail">
                <?php if($flag == 0):?>
                <p class="name">
                <span class="l-text">新郎：<?php echo $dinner['roles_main']?></span><span class="r-text">新娘：<?php echo $dinner['roles_wife']?></span>
                </p>
                <?php else:?>
                <p class="name" style="background-image:url();">
                <span class="r-text" style="position:initial"><?php echo $dinner['roles_main']?></span>
                </p>
                <?php endif;?>
                
                <p class="adres">【<?php echo $venue['name']?>】</p>
                <p class="text">开席时间：<?php echo $dinner['banquet_time']?></p>
                <div class="text">地址：安顺市中华中路103号百年婚宴</div>
                <div class="text"><a href="http://api.map.baidu.com/geocoder?address=安顺市中华东路103号&output=html&src=百年婚宴"><i></i></a></div>
                <p class="icon"><?php if($flag  == 0):?>农历婚期：<?php endif;?> <?php echo $dinner['lunar_time']?></p>
                <p class="icon"><?php if($flag  == 0):?>公历婚期：<?php endif;?> <?php echo $dinner['solar_time']?></p>
                <?php if(isset($dinner['following_effect'])&&!empty($dinner['following_effect'])):?>
                <p class="top-bg"></p>
                <p class="title">最美跟拍照片</p>
                <div class="wap-banner wap-banner2">
                    <div class="swiper-wrapper">
                        <?php foreach ($dinner['following_effect'] as $k => $v):?>
                        <div class="swiper-slide"><img src="<?php echo get_img_url($v);?>"></div>
                        <?php endforeach;?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination2"></div>
                </div>
                <?php endif;?>
                <?php if(isset($art)):?>
                <?php if(!isset($dinner['following_effect'])||empty($dinner['following_effect'])):?>
                <p class="top-bg"></p>
                <?php endif;?>
                <ul class="media-list">
                    <li>
                        <a href="/news/detail?id=<?php echo $art['id']?>">
                        <img src="<?php echo get_img_url($art['cover_img']);?>">
                        <div class="cont">
                            <p class="l-title"><?php echo $art['title']?></p>
                            <p class="l-text"><?php echo $art['summary']?></p>
                            <div class="l-con">
                                <p class="r icon1"><?php echo $art['read']?></p>
                                <p class="r icon2"><?php echo $art['zan_number']?></p>  
                            </div>
                        </div>
                        </a>
                    </li>
                </ul>
                <?php endif;?>
                <?php if(isset($dinner['cover_img']) && $dinner['cover_img']):?>
                <p class="top-bg"></p>
                <p class="title"><?php if($flag  == 0):?>婚礼<?php endif;?>照片</p>
                
                <!-- Swiper -->
                <div class="wap-banner wap-banner1">
                    <div class="swiper-wrapper">
                            <?php foreach ($dinner['cover_img'] as $k=>$v):?>
                            <div class="swiper-slide"><img src="<?php echo get_img_url($v)?>"></div>
                            <?php endforeach;?>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination swiper-pagination1"></div>
                </div>
                <?php endif;?>
                <!-- 关联文章 -->
                <?php if(isset($article)):?>
                <ul class="media-list" >
                    <li>
                        <a href="/news/detail?id=<?php echo $article['id']?>"> 
                            <img src="<?php echo get_img_url($article['cover_img'])?>">
                            <div class="cont">
                                <p class="title"><?php echo $article['title']?></p>
                                <p class="text"><?php echo $article['summary']?></p>
                                <div class="con">
                                    <p class="l"><?php echo $article['agency']?></p>
                                    <p class="r icon1"><?php echo $article['read']?></p>
                                    <p class="r icon2"><?php echo $article['zan_number']?></p>
                                </div>
                            </div>
                        </a>
                     </li>
                </ul>
                <?php endif;?>
                
                <?php if(isset($dinner['combo_img'])):?>
                <p class="top-bg"></p>
                <p class="title">套餐标准</p>
                <div class="set-meal"><img style="margin-top: -0.9rem;" src="<?php echo get_img_url($dinner['combo_img']);?>"></div>
                <?php endif;?>
                <p class="top-bg"></p>
                <p class="title">贡献统计</p>
                <ul class="devote-list">
                    <li>共收到的桃心<i></i><p><?php echo $dinner['zan_count']?></p></li>
                    <li>共收到的鲜花<i></i><p><?php if(isset($count['flowers']['num'])){echo $count['flowers']['num'];}else{ echo 0;}?></p></li>
                    <li>共收到的祝福<i></i><p><?php if(isset($count['bless'])){echo $count['bless'];}else{ echo 0;}?></p></li>
                </ul>
                <?php if(isset($flowers)):?>
                <p class="top-bg"></p>
                <p class="title">收到礼物排行榜</p>
                <ul id="more1" class="rank-list">
                    <?php foreach ($flowers as $k => $v):?>
                    <li>
                        <p class="tip"><?php echo $k+1;?></p>
                        <img src="<?php echo $v['head_img'];?>">
                        <p class="list-name"><?php echo $v['nickname'];?></p>
                        <p class="count"><?php echo $v['num'];?></p>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php if(count($flowers) == 5):?>
                <a href="javascript:;" data='2' dataid='more1' class="more">查看更多</a>
                <?php endif;?>
                <?php endif;?>
                <?php if(isset($bless)):?>
                <p class="top-bg"></p>
                <p class="title">收到祝福排行</p>
                <ul id="more2" class="rank-list rank1">
                    <?php foreach ($bless as $k => $v):?>
                    <li id="t_<?php echo $v['id'];?>" data="<?php echo $k+1;?>">
                        <p class="tip"><?php echo $k+1;?></p>
                        <img src="<?php echo $v['head_img'];?>">
                        <div class="cont">
                            <p class="list-title"><?php echo $v['nickname']?></p>
                            <p class="list-text"><?php echo $v['content']?></p>
                        </div>
                        <p class="count" num="<?php echo $v['zan_count']?>" data="<?php echo $v['id'];?>"><i>+1</i><?php echo $v['zan_count']?></p>
                    </li>
                    <?php endforeach;?>
                    
                </ul>
                <?php if(count($bless) == 5):?>
                <a href="javascript:;" data='2' dataid='more2' class="more">查看更多</a>
                <?php endif;?>
                <?php endif;?>
            </div>
            <div class="suspend">
                <a href="http://statics.holdfun.cn/live/material/live-list.html?enterId=a1a70d774bf44011a52927a82f5180d8"></a>
                <a href="/bless/index?id=<?php echo $id?>"></a>
            </div>
            <?php $this->load->view('common/new_footer');?>
        </div>  
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script>
    seajs.use(['<?php echo css_js_url('m-today.js', 'wap')?>','<?php echo css_js_url('m-public.js', 'wap')?>',"http://res.wx.qq.com/open/js/jweixin-1.0.0.js", '<?php echo css_js_url('iscroll.min.js', 'wap')?>','<?php echo css_js_url('swiper.min.js', 'wap')?>'], function(a,b,wx){
        a.more(<?php echo $dinner['id']?>);
        b.load();
        var swiper = new Swiper('.wap-banner2', {
            pagination: '.swiper-pagination2',
            paginationClickable: true,
            autoplay:2500
        });
        var swiper = new Swiper('.wap-banner1', {
            pagination: '.swiper-pagination1',
            paginationClickable: true,
            autoplay:2500
        });

        var myVideo=document.getElementById("media");
        $(".video-cont").click(function() {
           $(".video-cont i").removeClass("act");
           $(".video-cont img").removeClass("act");
           myVideo.play();
        });

        wx.config(<?php echo $jssdk;?>);
        wx.ready(function(){
            //分享给朋友
            wx.onMenuShareAppMessage({
                title: '<?php echo $dinner['roles_main']?>和<?php echo $dinner['roles_wife']?>的婚礼', // 分享标题
                desc: '', // 分享描述
                link: '<?php echo $domain['mobile']['url'].'/today/detail?id='.$id?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '<?php echo get_img_url($dinner['cover_img'][0]) ?>' // 分享图标
                
            });
            //分享到朋友圈
            wx.onMenuShareTimeline({
                title: '<?php echo $dinner['roles_main']?>和<?php echo $dinner['roles_wife']?>的婚礼', // 分享标题
                link: '<?php echo $domain['mobile']['url'].'/today/detail?id='.$id?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                imgUrl: '<?php echo get_img_url($dinner['cover_img'][0]) ?>', // 分享图标
                
            });
        })
    })
    </script>
</body>
</html>
