<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('pc-user.css', 'www')?>">
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
                <p class="max-title"><?php echo $album['name'];?>
                    <a href="javascript:window.history.go(-1)">
                        <i class="arow"></i>
                    </a>
                </p>
                <div class="album-brife">
                    <div class="img-cont"><img src="<?php echo get_img_url($album['cover_img']);?>"><p class="num"><?php echo $photo_count;?></p></div>
                    <div class="cont">
                        <p class="title"><?php echo isset($news['title'])?$news['title']:'';?></p>
                        <p class="text"><?php echo isset($news['summary'])?$news['summary']:'';?><?php if(isset($news['id'])):?><a style="color:#333;" href="/news/detail/<?php echo $news['id'];?>">阅读全文</a><?php endif;?></p>
                    </div>
                </div>
                <div class="right-chose">
                    <label><input id='is_album' type="checkbox" ><span>全选</span></label>
                    <p><a class="but" href="javascript:;" id="all_image" data-album_id="<?php echo $album['id']?>" data-order_type="<?php echo C('order.order_type.all_image.id')?>"><?php echo $album['price'];?>元购买全册</a></p>
                    <?php if($next_album):?>
                        <a href="/album/index?id=<?php echo $next_album['id'];?>" class="next"><?php echo $next_album['name'];?></a>
                    <?php endif?>
                    <?php if($prev_album):?>
                        <a href="/album/index?id=<?php echo $prev_album['id'];?>" class="prev"><?php echo $prev_album['name'];?></a>
                    <?php endif?>
                </div>
                <ul class="album-list order-album">
                <?php foreach ($album_photos as $k => $v) :?>
                    <li data-id="<?php echo $v['id']; ?>" data-is_purchased="<?php echo $v['is_purchased']; ?>">
                        <img src="<?php echo get_img_url($v['sy_img'])?>">
                        <?php if($v['is_purchased']):?>
                            <p class="tip">已购买</p>
                        <?php else:?>
                            <i></i>
                        <?php endif?>
                    </li>
                <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>

    <div class="bottom-cont">
        <div class="car"><p id='allChosePhotoNum'>2</p></div>
        <div class="bottom-con">
            <!--div class="cont">
                <p class="icon">惠</p>
                <p class="text">更多购买优惠，请猛戳这里……</p>
            </div-->
            <div class="cont">
                <p class="cuont">《<?php echo $album['name'];?>》共 <span><?php echo $photo_count;?></span> 张照片，已选中 <span id='current_chosen_count'>2</span> 张</p>
                <p class="text1">剩余免费张数：<span id='available_quota' data-available_quota="<?php echo $available_quota;?>" ><?php echo $available_quota;?></span>张</p>
            </div>
            <div class="r">
                <p class="price">总计：<span>￥<span id='pay_price'>0.00</span></span></p>
                <a href="javascript:;" class="but address">立即结算</a>
            </div>
        </div>
        <input type="hidden" id="dinner_id" name="dinner_id" value="<?php echo $album['dinner_id'];?>">
    </div>

    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var unitPrice = <?php echo C('order.product_type.image.unit_price');?>;  //相册中照片单价
        seajs.use([
           '<?php echo css_js_url('album.js', 'www')?>','<?php echo css_js_url('pinterest_grid.js', 'www')?>'

        ], function(album){
          	album.load();
          	album.checkAll();
        	album.choosePhoto();
        	album.switch_album();
        	album.address();
        	album.pay_all();
        	$(".order-album").pinterest_grid({
                no_columns: 3,
                padding_x: 10,
                padding_y: 10,
                margin_bottom: 30,
                single_column_breakpoint: 700
            });
		})
    </script>

</body>
</html>
