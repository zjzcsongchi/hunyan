<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-我的婚礼</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('user.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('venue.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>

    <!-- 内容 -->
    <div class="container">
        <?php $this->load->view('common/user_head')?>
        <!--相框弹出-->
        <div id="showimg" class="popup-bespeak">
	        <a class="close"></a>
	        <img style="width: 100%;height:100%" src="" />
        </div>
        <?php if(isset($dinner)):?>
        <div class="user-main">
            <p class="head">婚宴厅</p>
            <p class="head-s">WEDDING BANQUET HALL<br>百年婚宴-每一道菜都是一种表现，是一种敬业</p>
            <div class="hall-cont">
                <i></i>
                <div class="scroll">                
                    <ul>
                        <li><img src="<?php echo $dinner['cover_img']?>"></li>
                        <?php foreach($venue['images'] as $k => $v):?>
                        <li><img src="<?php echo $v?>"></li>
                        <?php endforeach;?>
                    </ul>
                    <a href="javascript:;" class="but prev"></a>
                    <a href="javascript:;" class="but next"></a>
                </div>
                <div class="right-cont">
                    <p class="title"><?php echo $venue['name']?></p>
                    <p class="text">最大桌数：<?php echo $venue['max_table']?>桌</p>
                    <p class="text">容纳人数：<?php echo $venue['container']?>人</p>
                    <p class="text">设备支持：<?php echo $venue['device']?></p>
                    <p class="text">婚礼时间：<?php echo $dinner['banquet_time']?></p>
                    <p class="icon">农历婚期：<?php echo $dinner['lunar_time']?></p>
                    <p class="icon">公历婚期：<?php echo $dinner['solar_time']?></p>
                </div>
            </div>
        </div>
        <?php else:?>
        <div class="user-main">
             <div class="user-message">
                   <img src="<?php echo $domain['static']['url']?>/www/images/user.png"><p>目前还没有数据哦~</p>
             </div>
        </div>
        <?php endif;?>
        <?php if(isset($dinner)&&isset($dish)):?>
        <div class="menu-cont">
            <div class="user-main">
                <p class="head">婚宴菜单</p>
                <p class="head-s">WEDDING BANQUET HALL<br>百年婚宴-每一道菜都是一种表现，是一种敬业</p>
                <div class="chose-cont">
                    <p id="dish_status"><?php if($dinner['is_dish_share'] == 1){echo '您已经共享了婚礼菜单';}else{echo '是否共享婚宴菜单：';}?></p>
                    <p id="dish_yes" <?php if($dinner['is_dish_share'] == 1) echo 'class="act"';?>><i></i>是</p>
                    <p id="dish_no" <?php if($dinner['is_dish_share'] == 0) echo 'class="act"';?>><i></i>否</p>
                </div>
                <ul id="dish" data='1' class="wedding-list">
                    <?php if(isset($dish)):?>
                    <?php foreach ($dish as $k => $v) :?>
                    <li>
                        <img src="<?php echo $v['cover_img']?>">
                        <p class="bg"></p>
                        <div class="info">
                            <p class="title"><?php echo $v['name']?></p>
                            <p class="text"><?php echo $v['description']?></p>
                        </div>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <?php if(isset($dish)):?>
                <?php if($dish_page > 1):?>
                <div class="pages-cont">
                    <div class="pages">
                        <a href="javascript:;" id="d_back" class="but">上一页</a>
                        <?php for($i=1; $i <=$dish_page; $i++):?>
                            <a href="javascript:;" class="dish_p"  data="<?php echo $i;?>"><?php echo $i;?></a>
                        <?php endfor;?>
                        <a href="javascript:;" id="d_next" class="but act">下一页</a>
                    </div>
                </div>
                <?php endif;?>
                <?php endif;?>
            </div>
        </div>
        <?php endif;?>
        <?php if(isset($dinner)):?>
        <div class="user-main">
            <p class="head">婚礼照片</p>
            <p class="head-s">WEDDING BANQUET HALL<br>百年婚宴-每一道菜都是一种表现，是一种敬业</p>
            <div class="chose-cont">
                <p id="image_status"><?php if($dinner['is_images_share'] == 1){echo '您已经共享了婚礼相册';}else{echo '是否共享婚礼相册：';}?></p>
                <p id="image_yes" <?php if($dinner['is_images_share'] == 1) echo 'class="act"';?>><i></i>是</p>
                <p id="image_no" <?php if($dinner['is_images_share'] == 0) echo 'class="act"';?>><i></i>否</p></div>
            <ul id="image" data="1" class="wedding-list">
                <?php if(isset($images)):?>
                <?php foreach ($images as $k => $v):?>
                <li><img src="<?php echo $v?>"></li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
            <?php if(isset($images)):?>
            <?php if($image_page > 1):?>
            <div class="pages-cont">
                <div class="pages">
                    <a href="javascript:;" id="back" class="but">上一页</a>
                    <?php for($i=1; $i <=$image_page; $i++):?>
                    <a href="javascript:;" class="image_p" data="<?php echo $i;?>" ><?php echo $i;?></a>
                    <?php endfor;?>
                    <a href="javascript:;" id="next" class="but act">下一页</a>
                </div>
            </div>
            <?php endif;?>
            <?php endif;?>
        </div>
        <?php endif;?>
        <?php if(isset($dinner)):?>
        <div class="video-cont" style="background-image: url(<?php echo $domain['static']['url']?>/www/images/wedding-bg2.jpg);">
            <div class="user-main">
                <p class="head">婚礼视频</p>
                <p class="head-s">WEDDING BANQUET HALL<br>百年婚宴-每一道菜都是一种表现，是一种敬业</p>
                <div class="chose-cont">
                    <p id="video_status"><?php if($dinner['is_video_share'] == 1){echo '您已经共享了婚宴视频';}else{echo '是否共享婚宴视频：';}?></p>
                    <p id="video_yes" <?php if($dinner['is_video_share'] == 1) echo 'class="act"';?>><i></i>是</p>
                    <p id="video_no" <?php if($dinner['is_video_share'] == 0) echo 'class="act"';?>><i></i>否</p>
                </div>
            </div>
            <div class="video-con">
                <div class="img-cont"><i></i><img src="<?php echo $dinner['cover_img']?>"></div>
                <div class="info-cont">
                    <p class="date"><?php echo $dinner['solar_time']?></p>
                    <p class="title"><?php echo $dinner['video_title']?></p>
                    <span></span>
                    <p class="text"><?php echo $dinner['video_intro']?></p>
                </div>
            </div>
            <div class="popup-video">
                <a href="javascript:;" class="close-video"></a>
                <video src="<?php echo get_img_url($dinner['video'])?>" controls="controls" style=" position: absolute; width: 800px; "></video>
            </div>
        </div>
        <?php endif;?>
    </div>
    <div class="page-bg"></div>
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('wedding.js', 'www')?>','public','<?php echo css_js_url('slide.js', 'www')?>'], function(a,b){
            $(".wedding-list li:nth-child(4n)").css("margin-right", "0");
            a.changevideo("<?php if(isset($dinner)) echo $dinner['id'];?>");
            a.changeimage("<?php if(isset($dinner)) echo $dinner['id'];?>");
            a.changedish("<?php if(isset($dinner)) echo $dinner['id'];?>");
            a.image_go();
            a.next_back(<?php if(isset($image_page)) echo $image_page?>);
            a.dish_go();
            a.d_next_back(<?php if(isset($dish_page)) echo $dish_page?>);
            a.showbigimg();
            b.load();

            $(".user-main .chose-cont p").click(function() {                
                $(this).parent().children("p.act").removeClass("act");
                $(this).addClass("act");
            });

            $(".wedding-list li:nth-child(4n)").css("margin-right", "0");

            $(".video-con i").click(function() {
                $(".page-bg").addClass("act");
                $(".popup-video").addClass("act");
            });

            $(".close-video").click(function() {
                $(".page-bg").removeClass("act");
                $(".popup-video").removeClass("act");
            });
        })
    </script>
</body>
</html>
