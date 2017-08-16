<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('wap-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>

</head>

<body class="grey">
    <div class="page-main order">
        <p class="max-title">我的订单</p>
        <ul class="order-list">
            <?php if(isset($list)):?>
            <?php foreach ($list as $k => $v):?>
            <li class="jump" data="<?php echo $v['id']?>" id="o_<?php echo $v['id']?>">
                <div class="cont borbot">
                    <img src="<?php if(isset($v['cover_img'])){echo get_img_url($v['cover_img']);}?>">
                    <div class="birfe">
                        <p class="title">订单号  <?php echo $v['order_id']?><span class="r"></span></p>
                        <?php if(isset($v['num']) && $v['num'] >0):?>
                        <p class="text">总共<?php echo $v['num']?> 张照片</p>
                        <?php endif;?>
                        <div class="icon">
                            <?php foreach (C('order_type') as $key => $val ):?>
                                <?php if($val['id'] == $v['order_type']):?>
                                <p class="<?php if($v['order_type'] == C('order_type.album.id')){echo 'z';}else{echo 'h';}?>" ><?php echo $val['name'];?></p></div>
                                <?php endif;?>
                            <?php endforeach;?>
                    </div>
                </div>
                <div class="cont">
                    <p class="price">￥<?php echo $v['need_pay']?></p>
                    <a href="javascript:;" class="but <?php if(C('order.pay_status.success.id') == $v['status']){echo 'unable';}elseif(C('order.pay_status.fail.id') == $v['status']){echo 'error';}else{echo 'use';}?>">
                        <?php foreach (C('order.pay_status') as $kk => $vv):?>
                            <?php if($v['status'] == $vv['id']):?>
                            <?php echo $vv['name']?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </a>
                    <?php if(C('order.pay_status.success.id') != $v['status']):?>
                        <a href="javascript:;" data="<?php echo $v['id']?>" class="but cancel">取消订单</a>
                    <?php endif;?>
                </div>
            </li>
            <?php endforeach;?>
            <?php endif;?>
        </ul>
        <div class="page-bg"></div>
        <div class="order-popup to-cancel">
            <p class="title1">确定取消当前订单吗？</p>
            <a href="javascript:;" class="no">否</a>
            <a href="javascript:;" data="" class="yes">是</a>
        </div>
        <div class="order-popup cancel-succes">
            <p class="title2">取消成功</p>
            <a href="javascript:;" class="succes">完成</a>
        </div>
    </div>
    <div class="page-bg"></div>
    <div class="order-popup to-cancel">
        <p class="title1">确定取消当前订单吗？</p>
        <a href="javascript:;" class="no">否</a>
        <a href="javascript:;" data="" class="yes">是</a>
    </div>
    <div class="order-popup cancel-succes">
        <p class="title2">取消成功</p>
        <a href="javascript:;" class="succes">完成</a>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('order.js', 'wap')?>'], function(p,o){
            p.load();
            o.del();
            o.jump()
            $(function(){
                $(".cancel").click(function(e) {
                    e.stopPropagation();
                    $(".page-bg").addClass("act");
                    $(".to-cancel").addClass("act");
                    $('.yes').attr('data',$(this).attr('data'));
                });
            });
            $('.no').on('click',function(){
            	$(".page-bg").removeClass("act");
                $(".to-cancel").removeClass("act");
            })
        })
    </script>
</body>
</html>
