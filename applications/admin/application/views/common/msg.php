<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="<?php echo css_js_url('jquery.min.js','admin');?>"></script>
    <title></title>
    <style>
        .main{ padding-left: 120px; border-top: 2px solid #80BDCB; background: #ffffff; padding-bottom: 15px;}
        p{ font-size: 13px;}
        a{ text-decoration: none; }
        i{font-style: normal;}
        li{ list-style: none}
        .btm{ height: 50px; text-align: center; color: #9CACAF; font-size: 12px; background: #F4FAFB; margin-top: 15px; line-height: 50px}
    </style>

</head>

<body style="background: #DDEEF2">

<div class="main">
    <h5><?php echo $message;?></h5>
    <p>如果您不做出选择，将在 <i id="spanSeconds"><?php echo $waitSecond;?></i>秒钟跳转</p>
    <p><a href="<?php echo $jumpUrl;?>" >如果您的浏览器没有跳转请点这里</a></p>
</div>

<div class="btm">管里中心</div>
</body>

<script language="JavaScript">
    <!--
    var seconds = <?php echo $waitSecond;?>;
    var defaultUrl = "<?php echo $jumpUrl;?>";


    onload = function()
    {
        if (defaultUrl == 'javascript:history.go(-1)' && window.history.length == 0)
        {
            document.getElementById('redirectionMsg').innerHTML = '';
            return;
        }

        window.setInterval(redirection, 1000);
    }
    function redirection()
    {
        if (seconds <= 0)
        {
            window.clearInterval();
            return;
        }

        seconds --;
        document.getElementById('spanSeconds').innerHTML = seconds;

        if (seconds == 0)
        {
            location.href = defaultUrl;
        }
    }
    //-->
</script>
</html>
