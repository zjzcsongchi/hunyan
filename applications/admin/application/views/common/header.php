<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" > 
        <!-- 启用360浏览器的极速模式 -->
        <meta name="renderer" content="webkit">
	    <title>百年婚宴运营管理后台</title>
	    <link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet" />
	    <link href="<?php echo css_js_url('admin.css', 'admin');?>" type="text/css" rel="stylesheet" />
	    <link href="<?php echo css_js_url('ui-dialog.css', 'admin');?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('calendar.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('foods-lists.css', 'common');?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('ui-selectbox.css', 'admin');?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo $domain['static']['url']?>/admin/wangeditor/css/wangEditor.min.css" type="text/css" rel="stylesheet"/>
	    <script type="text/javascript">
	    	var baseUrl = "<?php echo $domain['admin']['url'];?>";
	        var staticUrl = "<?php echo $domain['static']['url']?>";
	        var uploadUrl = "<?php echo $domain['upload']['url']?>";
	    </script>
	</head>
	<body>
	<?php $this->load->view('common/calendar')?>