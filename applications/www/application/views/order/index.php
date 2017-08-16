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
                <p class="max-title">我的订单</p>
                <ul class="order-list">
                    <?php if(isset($list)):?>
                    <?php foreach ($list as $k => $v):?>
                    <li class="jump" data="<?php echo $v['id'];?>" id="t_<?php echo $v['id'];?>">
                        <div class="img-comt"><img src="<?php if(isset($v['cover_img'])){echo get_img_url($v['cover_img']);}?>"><p class="num"><?php if(isset($v['num']) && $v['num'] >0){echo $v['num'];}?></p></div>
                        <div class="cont">
                            <p class="title">订单号   <?php echo $v['order_id']?></p>
                            <?php if(isset($v['num']) && $v['num'] >0):?>
                            <div class="text1"><p class="z">总</p>共有<span><?php echo $v['num']?></span> 张照片</div>
                            <?php endif;?>
                        </div>
                        <div class="r">
                            <p class="price"><!--del>原价￥<?php echo $v['favorable']+$v['need_pay'];?></del-->￥<?php echo $v['need_pay']?></p>
                            <div class="but">
                                <?php if(C('order.pay_status.success.id') != $v['status']):?>
                                    <a href="javascript:;" id="del_order" data="<?php echo $v['id']?>" class="cancel">取消订单</a>
                                <?php endif;?>
                                <a href="javascript:;" class="topay <?php if(C('order.pay_status.success.id') == $v['status']){echo 'unable';}elseif(C('order.pay_status.fail.id') == $v['status']){echo 'error';}else{echo 'use';}?>">
                                    <?php foreach (C('order.pay_status') as $kk => $vv):?>
                                        <?php if($v['status'] == $vv['id']):?>
                                        <?php echo $vv['name']?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </div>    

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['public', '<?php echo css_js_url('order_pc.js', 'www')?>'], function(a,b){
		a.load();
		b.del();
		b.hidden();
		$(".user-banner .edit").click(function() {
            $(".page-bg").addClass("act");
            $(".popup-userinfo").addClass("act");
        });
        $(".popup-userinfo .close").click(function() {
            $(".page-bg").removeClass("act");
            $(".popup-userinfo").removeClass("act");
        });
		b.jump();
    })
    </script>
</body>
</html>
