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
    <link href="<?php echo css_js_url('pc-public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('pc-user.css', 'www');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>
    
</head>
<body class="grey">
     <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <!-- 用户信息头部 -->
        <?php $this->load->view('common/user_banner')?>

        <div class="page-main padbot200">
            <!-- 用户中心 左侧菜单栏 -->
            <?php $this->load->view('common/user_leftmenu')?>
            <div class="user-right">
                <p class="max-title">最美婚礼跟拍</p>
                <ul class="user-list1">
                    <?php if(isset($list)):?>
                    <?php foreach ($list as $k => $v):?>
                    <li>
                        <div class="left-cont">
                        <a href="/album/index?id=<?php echo $v['id']?>">
                            <img src="<?php echo get_img_url($v['cover_img']);?>">
                            <p class="num">共<?php if(isset($v['count'])){echo $v['count'];}?>张</p>
                            <p class="name"><?php echo $v['name']?></p>
                        </a>
                        </div>
                        
                        <div class="right-cont">
                            <?php if(isset($v['art'])):?>
                                
                                <p class="title"><?php if(isset($v['art']['title'])){echo $v['art']['title'];}?></p>
                                <p class="text">
                                <?php if(isset($v['art']['summary'])){echo $v['art']['summary'];}?>
                                <a href="/news/detail/<?php echo $v['art']['id'];?>">阅读全文</a>
                                </p>
                                </a>
                            <?php endif;?>
                        </div>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
                <p class="max-title">专属相册（效果图）</p>
                <ul class="user-list2">
                    <?php if(isset($lists)):?>
                    <?php foreach ($lists as $k => $v):?>
                        <li>
                            <a href="/usercenter/album_detail?id=<?php echo $v['id']?>">
                                <img src="<?php echo get_img_url($v['cover_img'])?>">
                                <p class="name"><?php echo $v['title']?></p>
                            </a>
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
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['public', '<?php echo css_js_url('user_pc.js', 'www')?>'], function(a,b){
		a.load();
		b.hidden();
    })
    </script>
</body>
</html>
