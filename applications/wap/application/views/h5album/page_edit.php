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
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-user-new.css', 'wap');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-my_dialog.css', 'wap')?>">
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    .weui-dialog__btn{ line-height: 48px;font-size: 18px;}
    .user-list.info-list{height:auto;overflow: hidden; border-bottom: solid 1px #eee;}
    .user-list.info-list li{float:left;width:60%;}
    .user-list.info-list li:nth-child(2n){width:40%;}
    .user-list.info-list li span{display: inline-block;}
    .user-list.info-list li:nth-child(2n) input{width:50px;}
    .user-list li{ height: 4.5rem;line-height: 4.5rem;}
    .info-list img{height: 4rem;width:7.4rem;max-width:7.4rem;border-radius:5px;}
    .user-list i{margin-top:1.1rem;}
    </style>
    <?php $this->load->view('common/tongji')?>
</head>

<body>
<form>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="user-list info-list">
                    <?php foreach ($element as $k=>$v):?>
                    <?php if($v['element_type'] == 0):?>
                        <li class="uploadbtn">
                            <img src="<?php echo get_img_url($v['default'])?>"/>
                            <input type="hidden" name="head_img[<?php echo $v['sort']?>]" value="<?php echo $v['default']?>"/>
                        </li>
                        <li>排序:<span><input value="<?php echo $v['sort']?>" class="sort img" name="sort[]" style=" font-size: 0.6rem; line-height: 2.4rem; height: 2.4rem; "></span></li>
                    <?php endif;?>
                    <?php if($v['element_type'] == 1):?>
                        <li style="height: 2.5rem;line-height: 2.5rem;">
                        <input name="word[<?php echo $v['sort']?>]"  value="<?php echo $v['default']?>" style="width:7.9rem;margin-top:22px;" > 
                        </li>
                        <li style="height: 2.5rem;line-height: 2.5rem;">排序:<span>
                        <input class="sort word" value="<?php echo $v['sort']?>" name="sort[]" style="width:50px;text-indent: 8px; font-size: 0.6rem; line-height: 2.4rem;  height: 2.4rem; "></span>
                        <input type="hidden" name="flag[<?php echo $v['sort']?>]" class="flag" value="<?php echo $v['flag']?>">
                        </li>
                    <?php endif;?>   
                    <?php endforeach;?>    
                    </ul>
                    <button class="sure submit yes">提交</button>
                    <div class="page-bg"></div>

                </div>   
            </div>
        </div> 
    </div>
</form>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script>
    var page_id = "<?php echo $page_id?>";
    var template_id = "<?php echo $template_id?>";
    var user_id = "<?php echo $user_info['id']?>";
    var per_page = "<?php echo $per_page?>";
    </script>
    <script type="text/javascript">
    	var uploadUrl = "<?php echo $domain['upload']['url']?>";
    	var wxConfig = <?php echo $wxConfigJSON?>;
        seajs.use(['<?php echo css_js_url('page_edit.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('weixin_upload_imgs.js', 'wap')?>'], function(a, p, w){
        	a.blur();
            a.submit();
            w.load();
        })
    </script>
    
</body>
</html>
