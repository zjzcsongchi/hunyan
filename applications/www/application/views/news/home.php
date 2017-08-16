<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('swiper_new.min.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('media_new.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>

    <!-- 内容 -->
    <div class="container">
        <?php if(isset($top_banner)):?>
        <div class="slides">
            <div class="slideInner">
                <?php foreach ($top_banner as $k => $v):?>
                <a class="banner_list" href="<?php echo $v['url'];?>"><img src="<?php echo get_img_url($v['img_url']);?>"><p><?php echo $v['title'];?></p></a>
                <?php endforeach;?>
            </div>
            <div class="slides-nav">
                <a class="prev" href="javascript:;"></a>
                <a class="next" href="javascript:;"></a>
            </div>
        </div>
        <?php endif;?>
        <div class="page-main">
            <div class="mediav2-list">
                <div class="list-cont">
                   <div class="head">走进百年</div>
                    <ul class="nav" id="bainian">
                        <?php foreach ($class_list as $k=>$v):?>
                        <li <?php if($k == 0):?>class="first" <?php endif;?> data-id="<?php echo $v['id']?>"><a href="/news?class_id=<?php echo $v['id']?>"><?php echo $v['name']?></a></li>
                        <?php endforeach;?>
                        <a href="/news" class="more">更多></a>
                    </ul> 
                </div>                
                <div class="list-cont bainian_list">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-container1 ">
                        <div class="swiper-wrapper">
                        <?php foreach ($list as $k=>$v):?>
                        
                            <div class="swiper-slide">
                                <a href="/news/detail/<?php echo $v['id']?>">
                                <img src="<?php echo get_img_url($v['cover_img'])?>">
                                </a>
                                <p class="icon1"></p>
                                <p class="icon2">阅读  <?php echo $v['read']?></p>
                                <p class="title">
                                <?php 
                                    if(mb_strlen($v['title'])>15){
                                        $v['title'] = mb_substr($v['title'],0,15,'utf-8').'..';
                                    }
                                
                                ?>
                                <?php  echo $v['title'];?>
                                </p>
                                <p class="text"><?php echo $v['summary']?></p>
                            </div>
                            
                        <?php endforeach;?>    
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-next1"></div>
                        <div class="swiper-button-prev swiper-button-prev1"></div>
                    </div>
                    <ul class="site-piclist ">
                    <?php foreach ($list as $k=>$v):?>
                    <a href="/news/detail/<?php echo $v['id']?>">
                        <li>
                        
                            <img src="<?php echo get_img_url($v['cover_img'])?>">
                            <p class="icon1"></p>
                            <p class="icon2">阅读  <?php echo $v['read']?></p>
                            <p class="title"><?php echo $v['title']?></p>
                            <p class="text"><?php echo $v['summary']?></p>
                        </li>
                        </a>
                   <?php endforeach;?>    
                   </ul>
                </div>                
            </div>
            <div class="mediav2-list">
                <div class="list-cont">
                   <div class="head">米兰婚礼</div>
                    <ul class="nav" id="milan">
                        <?php foreach ($milan_class_list as $k=>$v):?>
                        <li <?php if($k == 0):?>class="first" <?php endif;?> data-id="<?php echo $v['id']?>"><a href="/news?class_id=<?php echo $v['id']?>"><?php echo $v['name']?></a></li>
                        <?php endforeach;?>
                        <a href="/news" class="more">更多></a>
                    </ul> 
                </div>                
                <div class="list-cont milan_list">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-container2">
                        <div class="swiper-wrapper">
                            <?php foreach ($milan_list as $k=>$v):?>
                            <div class="swiper-slide">
                                <a href="/news/detail/<?php echo $v['id']?>">
                                <img src="<?php echo get_img_url($v['cover_img'])?>">
                                </a>
                                <p class="icon1"></p>
                                <p class="icon2">阅读  <?php echo $v['read']?></p>
                                <?php 
                                    if(mb_strlen($v['title'])>17){
                                        $v['title'] = mb_substr($v['title'],0,17,'utf-8').'..';
                                    }
                                
                                ?>
                                <p class="title"><?php  echo $v['title'];?></p>
                                <p class="text"><?php echo $v['summary']?></p>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-next2"></div>
                        <div class="swiper-button-prev swiper-button-prev2"></div>
                    </div>
                    <ul class="site-piclist">
                    <?php foreach ($milan_list as $k=>$v):?>
                        <a href="/news/detail/<?php echo $v['id']?>">
                        <li>
                            <img src="<?php echo get_img_url($v['cover_img'])?>">
                            <p class="icon1"></p>
                            <p class="icon2">阅读  <?php echo $v['read']?></p>
                            <p class="title"><?php echo $v['title']?></p>
                            <p class="text"><?php echo $v['summary']?></p>
                        </li>
                        </a>
                     <?php endforeach;?>  
                    </ul>
                </div>                
            </div>
            <?php if(isset($bainian_child_lists) && $bainian_child_lists):?>
            <?php foreach ($bainian_child_lists as $k=>$v):?>
            <div class="mediav2-list">
                <div class="list-cont">
                   <div class="head"><?php echo $bainian_child_name[$k]?></div>
                   <ul class="nav">
                        <a href="/news?class_id=<?php echo $k?>" class="more">更多></a>
                    </ul> 
                </div>                
                <div class="list-cont milan_list">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-container2">
                        <div class="swiper-wrapper">
                            <?php foreach ($bainian_child_lists[$k] as $key=>$val):?>
                            <div class="swiper-slide">
                                <a href="/news/detail/<?php echo $val['id']?>">
                                <img src="<?php echo get_img_url($val['cover_img'])?>">
                                </a>
                                <p class="icon1"></p>
                                <p class="icon2">阅读  <?php echo $val['read']?></p>
                                <?php 
                                    if(mb_strlen($val['title'])>17){
                                        $val['title'] = mb_substr($val['title'],0,17,'utf-8').'..';
                                    }
                                
                                ?>
                                <p class="title"><?php  echo $val['title'];?></p>
                                <p class="text"><?php echo $val['summary']?></p>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-next2"></div>
                        <div class="swiper-button-prev swiper-button-prev2"></div>
                    </div>
                    <ul class="site-piclist">
                    <?php foreach ($bainian_child_lists[$k] as $key=>$val):?>
                        <li>
                        <a href="/news/detail/<?php echo $val['id']?>">
                            <img src="<?php echo get_img_url($val['cover_img'])?>">
                            <p class="icon1"></p>
                            <p class="icon2">阅读  <?php echo $val['read']?></p>
                            <p class="title"><?php echo $val['title']?></p>
                            <p class="text"><?php echo $val['summary']?></p>
                            </a>
                        </li>
                        
                     <?php endforeach;?>  
                    </ul>
                </div>                
            </div>
            <?php endforeach;?>
            <?php endif;?>
            
            
            <?php if(isset($milan_child_lists) && $milan_child_lists):?>
            <?php foreach ($milan_child_lists as $k=>$v):?>
            <div class="mediav2-list">
                <div class="list-cont">
                   <div class="head"><?php echo $milan_child_name[$k]?></div>
                   <ul class="nav">
                        <a href="/news?class_id=<?php echo $k?>" class="more">更多></a>
                    </ul> 
                </div>                
                <div class="list-cont milan_list">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-container2" style="display:none">
                        <div class="swiper-wrapper">
                            <?php foreach ($milan_child_lists[$k] as $key=>$val):?>
                            <div class="swiper-slide">
                                <a href="/news/detail/<?php echo $val['id']?>">
                                <img src="<?php echo get_img_url($val['cover_img'])?>">
                                </a>
                                <p class="icon1"></p>
                                <p class="icon2">阅读  <?php echo $val['read']?></p>
                                <?php 
                                    if(mb_strlen($val['title'])>17){
                                        $val['title'] = mb_substr($val['title'],0,17,'utf-8').'..';
                                    }
                                
                                ?>
                                <p class="title"><?php  echo $val['title'];?></p>
                                <p class="text"><?php echo $val['summary']?></p>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-next2"></div>
                        <div class="swiper-button-prev swiper-button-prev2"></div>
                    </div>
                    <ul class="site-piclist milan_child">
                    <?php foreach ($milan_child_lists[$k] as $key=>$val):?>
                        
                        <li>
                        <a href="/news/detail/<?php echo $val['id']?>">
                            <img src="<?php echo get_img_url($val['cover_img'])?>">
                            <p class="icon1"></p>
                            <p class="icon2">阅读  <?php echo $val['read']?></p>
                            <p class="title"><?php echo $val['title']?></p>
                            <p class="text"><?php echo $val['summary']?></p>
                            </a>
                        </li>
                        
                     <?php endforeach;?>  
                    </ul>
                </div>                
            </div>
            <?php endforeach;?>
            <?php endif;?>
            
            
        </div>
    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('public.js', 'www')?>','<?php echo css_js_url('media.js', 'www')?>', '<?php echo css_js_url('slider.js', 'www')?>', 'media_swiper'], function(a,b){
			a.load();
			b.load();
// 			a.change_bainian();
// 			a.change_milan();
			$(document).ready(function() {
				var num = 0;
				$('.banner_list').each(function(i,v){
					num = i; 
				});
				var status = false;
				if(num > 0){
					status = true;
			    }
	            $(".slideInner").slide({
	                slideContainer: $('.slideInner a'),
	                effect: 'easeOutCirc',
	                autoRunTime: 4500,
	                slideSpeed: 800,
	                nav: true,
	                autoRun: status,
	                prevBtn: $('a.prev'),
	                nextBtn: $('a.next')
	            });
	        });
        })
    </script>
    
</body>
</html>
