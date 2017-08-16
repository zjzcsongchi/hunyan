<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $list['roles_main']?>和<?php echo $list['roles_wife']?>的婚礼</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('today_public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('slider-pro.min.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('banquet.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('ui-dialog.css', 'admin')?>">
    <link href="<?php echo css_js_url('vtour.css', 'www'); ?>" type="text/css" rel="stylesheet" >
    <script src="<?php echo $domain['static']['url']?>/krpano/tour.js"></script>
    
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <div class="banner-cont">
            <?php if(isset($vr_info)): ?>
            <iframe style="width:100%;height:100%;border:none;" src="/vtour/scan/<?php echo $vr_info['id']?>/pc_venue"></iframe>
            <?php elseif(isset($video['venue_video']) && $video['venue_video']):?>
            <video src="<?php echo get_vedio_url($video['venue_video'])?>" controls="controls" loop="loop" style=" position: absolute; width: 100%;" autoplay="autoplay" poster="<?php echo $domain['static']['url']?>/www/images/banner.jpg"></video>
            <?php else:?>
            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/banner.jpg" >
            <?php endif;?> 
        </div>
        <div class="index-main">
            <div class="page-main">
                <div class="bride-cont">
                    <p class="l-text">新郎：<?php echo $list['roles_main']?></p>
                    <p class="r-text">新娘：<?php echo $list['roles_wife']?></p>
                </div>
                <p class="banquet-name">
                <?php foreach ($venue_name['venue_name'] as $k=>$v):?>
                                                【<?php echo $v?>】
                <?php endforeach;?>
                </p>
                <p class="banquet-text">开席时间：<?php echo $list['banquet_time']?><br>地址：安顺市中华中路103号百年婚宴</p>
                <div class="date-cont">
                    <p>农历婚期：<?php echo $list['lunar_time']?></p>
                    <p>公历婚期：<?php echo $list['solar_time']?></p>
                </div>
                <?php if(isset($list['following_effect'])&&!empty($list['following_effect'])):?>
                <p class="head">最美婚礼跟拍</p>
                <?php endif;?>
                <div class="follow-shot">
                    <?php if(isset($list['following_effect'])&&!empty($list['following_effect'])):?>
                    <div class="banner">
                        <ul class="img">
                            <?php foreach ($list['following_effect'] as $k => $v):?>
                            <li><a href="#"><img src="<?php echo get_img_url($v);?>"></a></li> 
                            <?php endforeach;?>
                        </ul>                            
                        <ul class="num"></ul>                            
                        <div class="btn btn_l"></div>
                        <div class="btn btn_r"></div>
                    </div>
                    <?php endif;?>
                    <?php if(isset($art)):?>
                    <div class="shot-list">
                        <img src="<?php echo get_img_url($art['cover_img']);?>">
                        <div class="cont">
                            <p class="title"><?php echo $art['title']?></p>
                            <p class="text"><?php echo $art['summary']?></p>
                            <div class="bot">
                                <p class="l">发布者：<?php echo $art['create_user']?>&nbsp;&nbsp;<?php echo $art['publish_time']?>&nbsp;&nbsp;&nbsp;&nbsp;阅读  <?php echo $art['read']?></p>
                                <a href="/news/detail/<?php echo $art['id'];?>">阅读全文</a>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <?php if( isset($list['cover_img']) && !empty(reset($list['cover_img']))):?>
                <p class="head">婚礼照片</p>
                <div class="subtitle"><img src="<?php echo $domain['static']['url']?>/www/images/index-title1.png"></div>
                <div class="img-lists">
                    <div id="example" class="slider-pro">
                        <div class="sp-slides">
                        <?php foreach ($list['cover_img'] as $k=>$v):?>
                            <div class="sp-slide">
                                <img class="sp-image" src="<?php echo get_img_url($v)?>">
                            </div>
                        <?php endforeach;?>   
                        </div>

                        <div class="sp-thumbnails">
                        <?php foreach ($list['cover_img'] as $k=>$v):?>
                            <div class="sp-thumbnail">
                                <img class="sp-thumbnail-image" src="<?php echo get_img_url($v)?>">
                            </div>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>  
                <?php endif?>              
                <p class="head">套餐标准</p>
                <div class="set-meal"><img src="<?php echo get_img_url($combo['cover_img'])?>"></div>
            </div>
        </div>
        <div class="index-main grey">
            <div class="page-main">
                <p class="head">贡献统计</p>
                <ul class="devote-list">
                    <li>
                        <img src="<?php echo $domain['static']['url']?>/www/images/devote1.png">
                        <p class="num"><?php echo $list['zan_count']?:$list['zan_count'];0 ?></p>
                        <p class="text">共收到的桃心</p>
                    </li>
                    <li>
                        <img src="<?php echo $domain['static']['url']?>/www/images/devote2.png">
                        <p class="num"><?php echo $count['flowers']['num']?$count['flowers']['num']:0; ?></p>
                        <p class="text">共收到的鲜花</p>
                    </li>
                    <li>
                        <img src="<?php echo $domain['static']['url']?>/www/images/devote3.png">
                        <p class="num"><?php echo $count['bless']?$count['bless']:0; ?></p>
                        <p class="text">共收到的祝福</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="index-main">
            <div class="page-main">
                <div class="rank-main lw">
                    <p class="title">礼物排行榜</p>
                    <ul>
                        <?php foreach ($flowers as $k=>$v):?>
                        <li>
                            <p class="tip <?php if($k == 0 ):?>first<?php elseif($k ==1):?>second<?php elseif($k == 2):?>third <?php endif;?>"><?php echo $k+1?></p>
                            <img src="<?php echo get_img_url($v['head_img'])?>">
                            <p class="name"><?php echo $v['nickname']?></p>
                            <p class="count"><?php echo $v['num']?></p>
                        </li>
                        <?php endforeach;?>
                    
                    </ul>
                    <a href="javascript:;" class="more more_flower" next_page="2">查看更多</a>
                    <a href="javascript:;" class="no_data more" style="display: none">没有更多了</a>
                </div>
                <input type="hidden" value="<?php echo $id?>" name="dinner_id">
                <div class="rank-main zf">
                    <p class="title">祝福排行榜</p>
                    <ul>
                        
                        <?php foreach ($bless as $k=>$v):?>
                        <li>
                            <p class="tip <?php if($k == 0 ):?>first<?php elseif($k ==1):?>second<?php elseif($k == 2):?>third <?php endif;?>"><?php echo $k+1?></p>
                            <img src="<?php echo get_img_url($v['head_img'])?>">
                            <div class="cont">
                                <p class="list-title"><?php echo $v['nickname']?></p>
                                <p class="text"><?php echo $v['content']?></p>
                            </div>
                            <p class="count"><?php echo $v['zan_count']?></p>
                        </li>
                        <?php endforeach;?>
                        
                    </ul>
                    <a href="javascript:;" class="more more_bless" next_page= '2'>查看更多</a>
                    <a href="javascript:;" class="no_bless more" style="display: none">没有更多了</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('today_detail.js', 'www')?>','<?php echo css_js_url('jquery.sliderPro.min.js', 'www')?>', '<?php echo css_js_url('jquery.lazyimg.js', 'www')?>', '<?php echo css_js_url('vmc.slider.full.min.js', 'www')?>'], function(a){
			a.load();
			a.load_more();
			a.load_more_bless();
			$("img").lazyimg({threshold:300});//阀值，距可视区域300px 时再进行图片加载
        })

        var vtour_data = <?php echo $vr_info['json']?>;
        var id = <?php echo $vr_info['id'] ?>;
        var comment_data = <?php echo $comment_data ?>;
        var is_show = true;//是否显示评论热点
        var imgUrl = "<?php echo $domain['img']['url']?>";
        seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>', '<?php echo css_js_url('talk_vtour.js', 'admin') ?>'], function(vtour, talk){
          vtour.bgmusic_btn();
          vtour.onresize();
          vtour.auto_scan();
          talk.talk();
            talk.show_hide_talk();
        })
    </script>
    <script src="<?php echo css_js_url('common_vtour.js', 'admin') ?>"></script>
</body>
</html>
