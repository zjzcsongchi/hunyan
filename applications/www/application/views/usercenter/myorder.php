<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-我的预约</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('user.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/header')?>

    <!-- 内容 -->
    <div class="container">
        <?php $this->load->view('common/user_head')?>

        <div class="user-main marbot">
            <?php if(isset($order)):?>
            <p class="head">我的预约</p>
            <p class="head-s">MY PREFERENTIAL VOLUME<br>百年婚宴-虽然我不是一个善于表达内心情感的人，但我是一个用实际行动去做的人</p>
            <?php endif;?>
            <?php if(isset($order)):?>
            <?php foreach ($order as $k => $v):?>
            <table id="t_<?php echo $v['id']?>" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="5" class="t-head">编号 :<?php echo $v['id']?><a id="<?php echo $v['id']?>" data="<?php echo $v['user_id']?>" href="javascript:;" class="del"></a></td>
                </tr>
                <tr>
                    <td class="cont"><img src="<?php echo $v['cover_img']?>"><p><span>场馆</span><br><span class="text"><?php echo $v['venue_name']?></span></p></td>
                    <td><span>类型</span><br>
                        <?php 
                            if($v['dinner_type'] == C('party.wedding.id')){
                                echo C('party.wedding.name');
                            }elseif ($v['dinner_type'] == C('party.birthday.id')){
                                echo C('party.birthday.name');
                            }elseif ($v['dinner_type'] == C('party.champion.id')){
                                echo C('party.champion.name');
                            }
                        ?>
                    </td>
                    <td><span>预约时间</span><br><?php echo $v['dinner_time']?></td>
                    <td><span>姓名</span><br><?php echo $v['name']?></td>
                    <td><span>地址</span><br><?php echo $v['address']?></td>
                </tr>
            </table>
            <?php endforeach;?>
            <?php else:?>
                <div class="user-message">
                       <img src="<?php echo $domain['static']['url']?>/www/images/user.png"><p>您目前还没有预约哦~</p>
                </div>
            <?php endif;?>
        </div>

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
 		seajs.use(['public','<?php echo css_js_url('myorder.js', 'www')?>'],function(a,b){
 	        a.load();
 	        b.del();
 	 	})
        
    </script>
</body>
</html>
