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
    <?php $this->load->view('common/tongji')?>

</head>

<body class="grey">
    <div class="page-main">
        <div class="user-head" style="background-image: url(<?php echo $domain['static']['url'];?>/wap/images/head-bg.jpg);">
            <div class="head"><a href="/usercenter/info"><img src="<?php if(isset($user_info['head_img'])){echo get_img_url($user_info['head_img']);}else{echo $domain['static']['url'].'/wap/images/head.jpg';}?>"></a></div>
            <p class="name"><a style="color: #fff;" href="/usercenter/info"><?php if(isset($user_info['nickname'])){echo $user_info['nickname'];}?></a></p>
            <div class="info">
                <a href="javascript:;"><p>鲜花</p><br><span><?php echo $flower_num?></span></a>
                <a href="javascript:;"><p>祝福</p><br><span><?php echo $bless_num?></span></a>
                <a href="javascript:;"><p>订单</p><br><span><?php echo $order_num?></span></a>
            </div>
        </div>
        <ul class="user-nav">
            <li><a href="<?php if(isset($dinner_id)){echo '/today/detail?id='.$dinner_id;}else{echo '/usercenter/no_dinner';}?>">
            <span  style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/user-icon1.png?v=e0eed); background-size: 1rem 0.78rem;"></span>
            <p>我的婚礼</p></a></li>
            <li><a href="/order/index">
            <span  style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/user-icon6.png?v=f2d5e); background-size: 1rem 0.78rem;">
            </span><p>我的订单</p></a></li>
            <?php if($exsit == 1):?>
            <li>
            <a href="/usercenter/resume?user_id=<?php echo $user_info['id']?>">
            <span  style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/cz.png?v=85bbf); background-size: 2rem 1.78rem;"></span><p>个人成长</p></a></li>
            <?php else:?>
            <li><a href="/usercenter/uservideo">
            <span  style="background-image: url(<?php echo $domain['static']['url']?>/wap/images/user-icon3.png?v=85bbf); background-size: 1rem 0.78rem;""></span><p>婚礼视频</p></a></li>
            <?php endif;?>
        </ul>
        <?php if($is_customer_manager):?>
        <div class="user-cont mar-top20 search">
            <input type="text" placeholder="请输入新郎或新娘的名字" id="search_text">
            <a href="javascript:;" id="search_btn"></a>
        </div>
        <?php endif;?>
        <div class="user-cont mar-top20">
            <?php if(isset($roles) && $roles):?><p class="max-title"> <?php echo $roles['roles_main']?> & <?php echo $roles['roles_wife']?>的最美婚礼跟拍</p><?php endif;?>
            <ul class="user-list2" id="search_result">
                <?php $this->load->view('usercenter/ajax_user_album')?>
            </ul>
        </div>
        <div class="user-cont mar-top20">
            <p class="max-title">专属相册（效果图）</p>
            <ul class="user-list2">
                <?php if(isset($lists)):?>
                <?php foreach ($lists as $k => $v):?>
                    <li <?php if($k%2 == 0) echo 'style="float:left"';?>>
                        <a href="/usercenter/album_detail?id=<?php echo $v['id']?>"><img class="height200" src="<?php echo get_img_url($v['cover_img'])?>"><p class="title"><?php echo $v['title']?></p></a>
                    </li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('user.js', 'wap')?>'], function(p, user){
            p.load();
            user.search();
        })
    </script>
</body>
</html>
