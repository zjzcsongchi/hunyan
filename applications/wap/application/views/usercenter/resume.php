<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-<?php echo $title?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('m-staff.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="mainfix">
        <div class="banner">
            <img src="<?php echo get_img_url($head_img)?>">
            <p class="name"><?php echo $name?></p>
            <span style="display:none">办公室</span><span><?php echo $group_name?></span>
        </div>
        <?php if(isset($list) && $list):?>
        <ul class="staff-list">
        <?php foreach ($list as $k=>$v):?>
            <p class="tip"><?php echo $k?>年<i></i></p>
            <?php foreach ($v as $key=>$val):?>
            <li>
                <i></i>
                <p class="head"><?php echo $val['occur_time']?></p>
                <div class="cont borbot">
                    <?php if($val['resume_type'] == C('resume.type.birthday.id')):?>
                    <a href="/usercenter/staffdetail?id=<?php echo $val['id']?>&user_id=<?php echo $user_info['id']?>">
                    <div class="img-cont bor-red">
                        <img src="<?php echo $domain['static']['url']?>/wap/images/head-1.jpg">
                    <?php else:?>
                    <div class="img-cont bor-block">
                        <?php foreach (C('resume.type') as $keys => $vals):?>
                            <?php if($val['resume_type'] == $vals['id']):?>
                                <img src="<?php echo $domain['static']['url'].'/wap/images/'.$vals['img']?>">
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                    </div>
                    <div class="con">
                        <p class="title">
                            <?php 
                                foreach (C('resume.type') as $kk => $vv){
                                    if($val['resume_type'] == $vv['id']){
                                        echo $vv['name'];
                                    }
                                }
                            ?>
                        </p>
                        <p class="text"><?php echo $val['title']?></p>
                    </div>
                    <?php if($val['resume_type'] == C('resume.type.birthday.id')):?>
                    </a>
                    <?php endif;?>
                </div>
                <?php if(!empty($val['image'])):?>
                <div class="cont">
                <?php foreach ($val['image'] as $kk=>$vv):?>
                    <img src="<?php echo get_img_url($vv)?>">
                <?php endforeach;?>
                </div>
                <?php endif;?>
            </li>
            <?php endforeach;?>
        <?php endforeach;?>
        </ul>
        <?php endif;?>
    </div> 
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
</body>
</html>
