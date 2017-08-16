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
    <link href="<?php echo css_js_url('m-staff.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-my_dialog.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="mainfix">
        <div class="banner">
            <img src="<?php if(isset($user_info['head_img'])){echo get_img_url($user_info['head_img']);}else{echo $domain['static']['url'].'/wap/images/head.png';}?>">
            <p class="name"><?php if(isset($admin['fullname'])){echo $admin['fullname'];}elseif(isset($admin['name'])){echo $admin['name'];}?></p>
            <span><?php echo $group_name;?></span>
        </div>
        <div class="staff-list staff-detail">
            <p class="head"><?php echo $info['occur_time']?></p>
            <div class="cont borbot">
                <div class="img-cont bor-red"><img src="<?php echo $domain['static']['url']?>/wap/images/head-1.jpg"></div>
                <div class="con">
                    <p class="title"><?php echo C('resume.type.birthday.name');?></p>
                    <p class="text"><?php echo $info['title']?></p>
                </div>
            </div>
            <div class="detail-cont">
                <?php if(!empty($info['images'])):?>
                <?php foreach ($info['images'] as $k => $v):?>
                <img src="<?php echo get_img_url($v);?>">
                <?php endforeach;?>
                <?php endif;?>
                <p class="text1">
                    <?php echo $info['content']?>
                </p>
            </div>
        </div>
        <div class="rank-cont">
            <ul class="rank-list">
                <li>收到礼物</li>
                <?php if(isset($cake)):?>
                <?php foreach ($cake as $k => $v):?>
                <li>
                    <p class="tip"><?php echo $k+1?></p>
                    <img src="<?php echo $v['head_img'];?>">
                    <p class="list-name"><?php echo $v['username']?></p>
                    <p class="count"><?php echo $v['nums']?></p>
                </li>
                <?php endforeach;?>
               <?php endif;?>
               <?php if(isset($cake)&&count($cake) == 10):?>
                <a href="javascript:;"data-page="2" data-user_id="<?php echo $user_info['id'];?>" data-id="<?php echo $id?>" data-status="1" class="more">查看更多</a>
                <?php endif;?>
            </ul>
        </div>
    </div> 
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('m-staffdetail.js', 'wap')?>'], function(a,b){
    		a.load();
    		b.load_more();
        })
    </script>
    
</body>
</html>
