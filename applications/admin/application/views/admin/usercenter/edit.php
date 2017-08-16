<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>个人设置</title>
    <link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet">

    <script src="<?php echo css_js_url('jquery.min.js','admin');?>"></script>
    <script src="<?php echo css_js_url('common.js','admin');?>"></script>

    <style>
        label{ text-align: right; font-weight: bold; padding-right: 5px;}
        #select .dfinput{ width: 120px;}
    </style>
</head>
<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="#">个人设置</a></li>

    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span>个人设置</span></div>
    <form action="" method="post">
    <ul class="forminfo">

        <li>
            <label>新密码:</label><input name="password" type="password" value="" type="text" class="dfinput" id="password" />
            <i  style="color: red">*</i>
        </li>

        <li><label>姓名:</label><input name="fullname"  value="<?php echo $info['fullname']?>" type="text" class="dfinput" id="fullname" />
            <i  style="color: red">*</i>
        </li>
        <li><label>Email:</label><input name="email" value="<?php echo $info['email']?>"  type="text" class="dfinput" id="email" /><i></i></li>
        <li><label>手机:</label><input name="tel" value="<?php echo $info['tel']?>" type="text" class="dfinput" id="tel" /><i></i></li>
        <li><label>描述:</label><input name="describe" value="<?php echo $info['describe']?>"   type="text" class="dfinput" id="describe" /><i></i></li>
        <label>&nbsp;</label><input name="" type="submit" class="btn" value="修改"/></li>
    </ul>
    <form>
</div>
<?php $this->load->view("common/popup");?>

</body>
</html>
