<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-编辑资料</title>
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

        <div class="user-main">
            <ul class="info-list">
                <li>
                    <p class="title">姓名</p>
                    <p><input type="hidden" id="user_id" value="<?php echo $user['id']?>"/><input id="realname" type="text" value="<?php echo $user['realname']?>"/></p>
                </li>
                <li>
                    <p class="title">用户名</p>
                    <p><input id="nickname" type="text" value="<?php echo $user['nickname']?>"/></p>
                </li>
                <li>
                    <p class="title">性   别</p>
                    <label><input type="radio" value='0' name="sex" <?php if($user['sex']==0) echo 'checked';?>>男</label>
                    <label><input type="radio" value='1' name="sex" <?php if($user['sex']==1) echo 'checked';?>>女</label>
                </li>
                <li>
                    <p class="title">出生日期</p>
                    <input id="birthday" type="text" value="<?php echo $user['birthday']?>" class="dfinput Wdate" style="height:32px;width:184px">
                </li>
                <li>
                    <p class="title">手机号</p>
                    <p><input id="mobile" type="text" value="<?php echo $user['mobile_phone']?>"/></p>
                </li>
                <li class="height-auto">
                    <p class="title">更改头像</p>
                    <ul id="uploader_cover_img">
                        <?php if($user['head_img']):?>
                        <li id="SWFUpload_0_0" class="pic pro_gre" style="margin-right: 20px; clear: none">
                        <a class="close del-pic" href="javascript:;"></a>
                        <img src="<?php echo $user['head_img']?>" style="width: 100%; height: 100%">
                        <input type="hidden" name="cover_img" value="<?php echo $user['input_img']?>">
                        </li>
    	                <?php endif;?>
    	                <li class="pic pic-add add-pic" style="">
    	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>更改头像</a>
    	                </li>
    	            </ul>
                </li>
                <li>
                    <p class="title">现居地址</p>
                    <p><input id="address" type="text" value="<?php echo $user['address']?>"/></p>
                </li>
                <li><input type="submit" value="保 存" class="submit"></li>
            </ul>
        </div>

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
        var staticUrl = "<?php echo $domain['static']['url']?>";
        var uploadUrl = "<?php echo $domain['upload']['url']?>";
	    //绑定图片上传器
    	var object =[
      	  	{"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},
       		{"obj": "#uploaders_venue_img", "btn": "#btn_venue_img"}
    	];

    	seajs.use(['admin_uploader','public','<?php echo css_js_url('user.js', 'www')?>','bootstrap','jqvalidate','jqueryswf','swfupload'], function(swfUploader,c,u){
        	swfUploader.swfupload(object);
        	c.load();
        	u.edit();
        	u.datepick();
    	})
    </script>
</body>
</html>
