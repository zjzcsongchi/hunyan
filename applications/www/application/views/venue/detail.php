<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('swiper.min.css', 'www')?>">    
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('venues.css', 'www')?>">
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
            <?php elseif(isset($venue_info['venue_video']) && $venue_info['venue_video']):?>
            <video src="<?php echo get_vedio_url($venue_info['venue_video'])?>" controls="controls" loop="loop" style=" position: absolute; width: 100%;" autoplay="autoplay" poster="<?php echo $domain['static']['url']?>/www/images/banner.jpg"></video>
            <?php else:?>
            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/banner.jpg" >
            <?php endif;?>
            
            
        </div>
        <div class="index-main">
            <div class="page-main">
                <p class="banquet-title" style="margin: 25px auto;"><?php echo $venue_info['name']?></p>
                <p class="banquet-text">最大桌数：<span><?php echo $venue_info['max_table']?></span>桌&nbsp;&nbsp; 楼层/层高：<?php echo $venue_info['floor'] == 1 ? '独栋' : $venue_info['floor'].'层'?>/ <?php echo $venue_info['height']?> &nbsp;&nbsp; 场地面积：<span><?php echo floor($venue_info['area_size'])?></span>平 &nbsp;&nbsp;低消：<span><?php echo floor($venue_info['min_consume'])?></span>/桌</p>
                <p class="banquet-text">适合类型：<?php echo $venue_info['fit_type']?>&nbsp;&nbsp;  容纳人数：<span><?php echo $venue_info['container']?></span>人&nbsp;&nbsp; 设备支持：<?php echo $venue_info['device']?></p>
                <a href="javasvript:;" class="destine">立即预定</a>
                <ul class="img-lists">
                    <?php foreach ($images as $k=>$v):?>
                        <li class="act">
                            <?php if(isset($images[$k]) && $images[$k]):?>
                                <?php foreach ($images[$k]['img'] as $key=>$val):?>
                                    <?php if($images[$k]['img'][$key]):?>
                                    <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo get_img_url($val);?>">
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endif;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <?php if(isset($dinners) && $dinners):?>
        <div class="rank-main">
            <!-- Swiper -->
            <div class="wap-banner">
                <div class="swiper-wrapper">
                    <!-- slide start-->
                    <?php $class_name = ['first', 'second', 'third']; foreach ($dinners as $k => $v):?>
                        <div class="swiper-slide">
                            <!-- 鲜花-->
                            <div class="rank-cont l">
                                <p class="head">礼物印记</p>
                                <div class="contect">
                                    <p class="title">新郎：<?php echo $v['roles_main']?>&新娘：<?php echo $v['roles_wife']?></p>
                                    <ul>
                                        <?php if(isset($flower[$v['id']]) && $flower[$v['id']]):?>
                                        <?php foreach ($flower[$v['id']] as $k2 => $v2):?>
                                            <li class="<?php echo $class_name[$k2]?>">
                                                <i></i><img src="<?php echo $v2['head_img']?>">
                                                <p class="name"><?php echo $v2['name']?></p>
                                                <p class="count"><?php echo $v2['num']?></p>
                                            </li>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                            <!-- 祝福-->
                            <div class="rank-cont r">
                                <p class="head">祝福印记</p>
                                <div class="contect">
                                    <p class="title">新郎：<?php echo $v['roles_main']?>&新娘：<?php echo $v['roles_wife']?></p>
                                    <ul>
                                        <?php if(isset($bless[$v['id']]) && $bless[$v['id']]):?>
                                        <?php foreach ($bless[$v['id']] as $k2 => $v2):?>
                                            <li class="<?php echo $class_name[$k2]?>">
                                                <i></i><img src="<?php if(isset($v2['head_img']) && !empty($v2['head_img'])):?><?php echo get_img_url($v2['head_img'])?> <?php else:?><?php echo $domain['static']['url'].'/wap/images/touxiang.png'?> <?php endif;?>">
                                                <div class="cont">
                                                    <p class="user"><?php echo $v2['name']?></p>
                                                    <p class="text"><?php echo $v2['content']?></p>
                                                </div>
                                                <p class="count"><?php echo $v2['zan_count']?></p>
                                            </li>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                    <!-- slide end-->
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php endif;?>
        <div class="index-main">
            <div class="page-main">
                <p class="head">贵宾印记</p>
                <ul class="project-list">
                    <?php if(isset($wedding_photo) && $wedding_photo):?>
                    <?php foreach ($wedding_photo as $k => $v):?>
                        <li data-id="<?php echo $v['id']?>">
                        <a href="javascript:;" class="project_card">
                            <img src="<?php echo isset($v['m_cover_img']) && !empty($v['m_cover_img']) ? get_img_url($v['cover_img']) : $domain['static']['url'].'/www/images/default-banner1.jpg'?>" class="project_image">
                            <div class="project_detail">
                                <div class="bag-opa"></div>
                                <div class="info">新郎：<?php echo $v['roles_main']?>&新娘：<?php echo $v['roles_wife']?></div>
                                <div class="shadows"></div>
                            </div>
                        </a>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>

                </ul>
            </div>
        </div>
    </div>  
    <!-- 预约弹窗 -->
    <div class="page-bg"></div>
    <div class="popup-destine">
        <div class="close"></div>
        <p class="head">立即预定</p>
        <input type="hidden" name="venue_id" id="venue_id" value="<?php echo $venue_info['id']?>">
        <input type="text" name="name" placeholder="&#x59D3;&#x540D;">
        <input type="tel" name="phone"placeholder="&#x7535;&#x8BDD;">
        <input type="text" name="time" class="date Wdate" placeholder="&#x9884;&#x7EA6;&#x65F6;&#x95F4;">

    
       <select class="sum" name="venue" id="venue" style="width: 298px;z-index:5">
       <?php if(isset($venue)):?>
       <?php foreach ($venue as $k=>$v):?>
           <option <?php if($k == $wedding):?>selected<?php endif;?> value="<?php echo $k?>"><?php echo $v?></option>
       <?php endforeach;?>
       <?php endif;?>
       </select>
       
        <input type="tel" name="menus_count" placeholder="预约桌数">
        <textarea name="address" placeholder="备注"></textarea>
        <a href="javasvript:;" class="destine submit">立即预定</a>
        <p class="message"></p>
        
    </div>
    <!-- 预约弹窗 -->
    
    <!-- 底部 -->
     <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('venue.js', 'www')?>', '<?php echo css_js_url('jquery.hover3d.js', 'www')?>','<?php echo css_js_url('jquery.lazyimg.js', 'www')?>', '<?php echo css_js_url('swiper.min.js', 'www')?>','wdate'], function(a){
    			a.load();
    			a.submit(); //预定场馆
    			a.detail();
    			a.jump();
    			$("img").lazyimg({threshold:300});//阀值，距可视区域300px 时再进行图片加载
    			$(".project-list li").hover3d({
                    selector: ".project_card",
                    shine: true,
                });
                $(".project-list li:nth-child(3n)").css("margin-right", "0");
                $(".project-list li:last-child").css("margin-bottom", "100px");

                $(function(){
              	  $(".Wdate").focus(function(){
                       WdatePicker({dateFmt:'yyyy-MM-dd'})
                	  });
                })

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
