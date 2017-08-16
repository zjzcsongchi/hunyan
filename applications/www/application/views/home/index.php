<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_index.css', 'www')?>">
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
        
        <div class="index-main">
            <div class="page-main">
                <p class="head">百年宴会</p>
                <div class="subtitle"><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/index-title1.png" ></div>
                <div class="index-nav">
                    <a href="javascript:;" data-date="<?php echo $yesterday_date;?>">昨天</a>
                    <a href="javascript:;" data-date="<?php echo $today_date;?>" class="act">今天</a>
                    <a href="javascript:;" data-date="<?php echo $tomorrow_date;?>" >明天</a>
                </div>
                
                <ul class="banquet-list">
                    <?php if($dinner):?>
                    <?php foreach ($dinner as $k => $v):?>
                    <?php if($v['venue_type'] != C('party.qita.id')):?>
                    <li>
                        <?php if($v['venue_type'] == C('party.wedding.id')):?>
                        <a href="/today/detail?id=<?php echo $v['id']?>">
                        <?php else:?>
                        <?php if(isset($v['venue']) && $v['venue']):?>
                            <a href="/venue/detail?id=<?php echo $v['venue'][0]?>">
                            <?php endif;?>
                        <?php endif;?>
                        
                         <?php if($v['venue_type'] == C('party.wedding.id')):?>
                            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-banner1.jpg'?>" >
                            <div class="cont">
                            <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                            <p class="name">新郎：<?php echo $v['roles_main']?><br>新娘：<?php echo $v['roles_wife']?></p>
                         <?php elseif ($v['venue_type'] == C('party.birthday.id')):?>
                         
                            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-birthday.jpg'?>" >
                            <div class="cont">
                            <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                            <p class="name">生日：<?php echo $v['roles_main']?></p>
                        
                        
                         <?php elseif ($v['venue_type'] == C('party.shouyan.id')):?>
                         <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-old.jpg'?>" > 
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">寿星：<?php echo $v['roles_main']?></p>
                         
                         <?php elseif ($v['venue_type'] == C('party.champion.id')):?>
                          <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-champion.jpg'?>" >
                          <div class="cont">
                          <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                          <p class="name">状元：<?php echo $v['roles_main']?></p>
                         
                         
                         <?php elseif ($v['venue_type'] == C('party.bairiyan.id')):?>
                          <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-hundred.jpg'?>" >
                          <div class="cont">
                          <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                          <p class="name">宝贝：<?php echo $v['roles_main']?></p>
                          
                          <?php elseif ($v['venue_type'] == C('party.manyuejiu.id')):?>
                          <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-baby.jpg'?>" >
                          <div class="cont">
                          <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                          <p class="name">宝贝：<?php echo $v['roles_main']?></p>
                         
                         <?php elseif ($v['venue_type'] == C('party.qiaoqianyan.id')):?>
                         <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-home.jpg'?>" >
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">房主：<?php echo $v['roles_main']?></p>
                         
                         
                         <?php elseif ($v['venue_type'] == C('party.nianhui.id')):?>
                         <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-qiye.jpg'?>" >
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">企业：<?php echo $v['roles_main']?></p>
                        
                         <?php elseif ($v['venue_type'] == C('party.lingcan.id')):?>
                         <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo !empty($v['cover_img']) ?  get_img_url($v['cover_img'][0]) : $domain['static']['url'].'/www/images/default-food.jpg'?>" >
                         <div class="cont">
                         <p class="date"><?php echo str_replace('-', '/', $v['solar_time'])?></p>
                         <p class="name">零餐：<?php echo $v['roles_main']?></p>
                         <?php endif;?>
                        
                            <em></em>
                            <p class="adres">宴会厅：<?php foreach ($venue_name as $key=>$val):?><?php if($key == $v['id']):?><?php foreach ($val as $vv):?> <?php echo $vv?><?php endforeach;?> <?php endif;?> <?php endforeach;?></p>
                            <em></em>
                            <p class="text">时间：<?php echo $v['solar_time'].'  '.$v['banquet_time']?><br>地址：安顺市中华中路103号百年婚宴</p>
                            <em></em>
                            <span class="icon1">直</span>
                            <span class="icon2">互</span>
                            <span class="icon3">￥</span>
                            <p class="arrow"></p>
                        </div>
                        </a>
                    </li>
                    <?php endif;?>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
        <div class="index-main">
            <div class="page-main">
                <p class="head">婚宴场馆</p>
                <div class="subtitle"><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/index-title2.png" ></div>
                <div class="venue-cont">
                    <ul class="venue-chose">
                    <?php if(isset($venue) && $venue):?>
                    <?php foreach ($venue as $k => $v):?>     
                        <li class="<?php if($k == 0):?> act <?php endif;?> "><?php echo $v['name']?></li>
                    <?php endforeach;?>
                    <?php endif;?>
                    </ul>
                    <?php if(isset($venue) && $venue):?>
                    <?php foreach ($venue as $k => $v):?> 
                    <div class="venue-detail <?php if($k == 0):?>act<?php endif;?> ">
                    <a href="/venue/detail?id=<?php echo $v['id']?>">
                         <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $v['cover_img']?>" >
                     </a>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                </div>
                <a href="/venue" class="more">查看更多场馆</a>
            </div>
        </div>
        <div class="index-main">
            <div class="page-main">
                <p class="head">酒水批发</p>
                <div class="subtitle"><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/index-title3.png" ></div>
                <ul class="venue-list drink">
                    <?php if($drink):?>
                    <?php foreach ($drink as $k => $v):?>
                            <li <?php echo ($k == 4) ? 'style="margin-right: 0px;"' : '' ?> drink_id="<?php echo $v['id']?>">
                                <?php if($v['present_price'] - $v['original_price'] > 0):?>
                                    <em>促<br>销</em>
                                <?php endif;?>
                                    <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo get_img_url($v['cover_img'])?>" >
                                <p class="title"><?php echo $v['title']?></p>
                                <p class="icon">
                                
                                <?php if(isset($v['flag']) && $v['flag']):?>
                                <?php 
                                    $flag = explode(',', $v['flag']);
                                ?>
                                <?php foreach ($flag as $key=>$val):?>
                                <span><?php echo $val?></span>
                                <?php endforeach;?>
                                <?php endif;?>
                            
                                </p>
                                <div class="price">¥<span><?php echo $v['present_price']?></span>/<?php echo $v['unit']?><p>批发价<i></i></p></div>
                            </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <a href="/drink" class="more">查看更多酒水</a>
            </div>
        </div>
        <div class="index-main">
            <div class="page-main">
                <p class="head">自媒体</p>
                <div class="subtitle"><img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo $domain['static']['url']?>/www/images/index-title4.png" ></div>
                <ul class="chose-list">
                    <li class="act recommend">推荐资讯</li>
                    <li class="recent">最新发布</li>
                </ul>
                <ul class="media-list recommend-news">
                <?php if($recommend_news):?>
                    <?php foreach ($recommend_news as $k => $v):?>
                        <li news_id=<?php echo $v['id']?>>
                            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo get_img_url($v['cover_img']) ?>" >
                            <div class="cont">
                               <p class="title"><?php echo $v['title'] ?></p>
                               <p class="text"><?php echo $v['summary'] ?></p>
                               <div class="icon">
                                   <p class="name"><?php echo $v['agency'] ?></p>|
                                   <p class="date"><?php echo substr($v['publish_time'],0 ,10) ?></p>
                               </div>
                            </div> 
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
                
                <ul class="media-list recent-news" style="display: none">
                <?php if($recent_news):?>
                    <?php foreach ($recent_news as $k => $v):?>
                        <li news_id=<?php echo $v['id']?>>
                            <img class="lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?php echo get_img_url($v['cover_img']) ?>" >
                            <div class="cont">
                               <p class="title"><?php echo $v['title'] ?></p>
                               <p class="text"><?php echo $v['summary'] ?></p>
                               <div class="icon">
                                   <p class="name"><?php echo $v['agency'] ?></p>|
                                   <p class="date"><?php echo substr($v['publish_time'],0 ,10) ?></p>
                               </div>
                            </div> 
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('index.js', 'www')?>', '<?php echo css_js_url('jquery.lazyimg.js', 'www')?>'], function(a){
    			a.load();
    			a.switch_day();
    			$("img").lazyimg({threshold:300});//阀值，距可视区域300px 时再进行图片加载
        })
    </script>
</body>
</html>
