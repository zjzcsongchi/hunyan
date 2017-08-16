<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('new_media.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>

    <!-- 内容 -->
    <div class="container">    

        <div class="page-main">
            <ul class="page-nav">
                <p>当前位置：</p>
                <li class="first"><a href="/news/home">百年资讯</a></li>
                <?php if(isset($now_class)):?>
                <?php foreach ($now_class as $k => $v):?>
                <li><a href="/news/index?class_id=<?php echo $v['id'];?>" target="_self"><?php echo $v['name']?></a></li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
            <div class="left-cont">
                <div class="out">
                    <ul class="img">
                    <?php if(isset($banner)):?>
                        <?php foreach ($banner as $k=>$v):?>
                        <li><a href="/news/detail/<?php echo $v['id']?>"><img src="<?php echo get_img_url($v['cover_img'])?>"></a><i></i></li>
                        <?php endforeach;?>   
                    <?php endif;?>               
                    </ul>
                    <ul class="num"></ul>
                </div>
                <ul class="media-nav" style="display:none">
                     <?php if(isset($tags)):?>
                            <li class="<?php if(!isset($class_id)&&!isset($parent_class_id)){echo 'act';}?>"><a href="/news" target="_self">最新资讯</a><i></i></li>
                            <?php foreach ($tags as $k=>$v):?>
                                <?php if($v['parent_id'] == 0):?>
                                <li class="<?php if(isset($class_id) && $class_id == $v['id']){echo 'act';}elseif (isset($parent_class_id)&&$parent_class_id == $v['id']){echo 'act';}?>" value="<?php echo $v['id']?>" ><a href="/news?parent_class_id=<?php echo $v['id']?>" target="_self"><?php echo $v['name']?></a><i></i></li>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                </ul>
                <ul class="media-list">
                    
                   <?php foreach ($lists as $k=>$v):?>
                    <li>
                    <a href="/news/detail/<?php echo $v['id']?>">
                        <img src="<?php echo get_img_url($v['cover_img'])?>">
                        <?php if($v['video_url']):?>
                        <i></i>
                        <?php endif;?>
                        <div class="info">
                            <p class="title"><?php echo $v['title']?></p>
                            <p class="text"><?php echo $v['summary']?></p>
                            <p class="bot"><span class="l">发布者：<?php if(isset($admin[$v['create_user']])):?> <?php echo $admin[$v['create_user']]?><?php endif;?>  <?php echo $v['publish_time']?></span>
                            <span class="r">阅读  <?php echo $v['read']?></span></p>
                        </div>
                    </a>
                    </li>
                <?php endforeach;?>    
                <?php if(isset($exist) && $exist):?>
                    <a href="javascript:;" class="more" next_page="2" id="load_more">查看更多</a>
                <?php else:?>
                    <a href="javascript:;" class="more" style="background:#CDC5BF">没有数据</a>
                <?php endif;?>
                </ul>
            </div>
            <div class="right-cont">
                <div class="right-con">
                    <p class="head">热门标签</p>
                    <ul class="hot-list">
                        <?php if(isset($tags)):?>
                        <?php foreach ($tags as $k=>$v):?>
                            <?php if($v['parent_id'] != 0):?>
                            <li value="<?php echo $v['id']?>" class="<?php if(isset($class_id) && $class_id == $v['id']){echo 'act';}elseif (isset($parent_class_id)&&$parent_class_id == $v['id']){echo 'act';}?>">
                            <a <?php if($v['parent_id'] == 0){echo 'href="/news?parent_class_id='.$v['id'].'"';}else{echo 'href="/news?class_id='.$v['id'].'"';}?> target="_self"> <?php echo $v['name']?></a>
                            </li>
                            <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="right-con">
                    <p class="head">百年资讯</p>
                    <ul class="right-list">
                    <?php if(isset($bainian_list)):?>
                        <?php foreach ($bainian_list as $k=>$v):?>
                        <li>
                            <a href ="/news/detail/<?php echo $v['id']?>">
                                <p class="title"><?php echo $v['title']?></p>
                                <?php if($k == 0):?>
                                <img src="<?php if(!empty($v['cover_img'])){echo get_img_url($v['cover_img']);}?>">
                                <?php endif;?>
                                <p class="text"><?php echo $v['summary']?></p>
                            </a>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="right-con">
                    <p class="head">米兰婚礼</p>
                    <ul class="right-list diamond">
                        <?php if(isset($milan_list)):?>
                        <?php foreach ($milan_list as $k=>$v):?>
                        <li>
                            <a href ="/news/detail/<?php echo $v['id']?>">
                            <p class="title"><?php echo $v['title']?></p>
                            <?php if($k == 0):?>
                                <img src="<?php if(!empty($v['cover_img'])){echo get_img_url($v['cover_img']);}?>">
                                <?php endif;?>
                            <p class="text"><?php echo $v['summary']?></p>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="right-con ewm">
                    <div><img src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg"></div>
                    <p>微信扫一扫，关注百年婚宴</p>
                </div>
            </div>
        </div>
        

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('news.js', 'www')?>', '<?php echo css_js_url('banner.js', 'www');?>'], function(a){
			a.load();
			a.more();
			$('.menu').on('click', function(){
				$(this).addClass('act');
			})
			$(".hot-list li:nth-child(4n)").css("margin-right", "0");
            $(".media-nav li:last-child").css("border-right", "none");
        })
    </script>

</body>
</html>
