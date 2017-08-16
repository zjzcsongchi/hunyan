<!-- 带bootstrap的header -->
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" >
        <!-- 启用360浏览器的极速模式 -->
        <meta name="renderer" content="webkit">
	    <title>百年婚宴运营管理后台</title>
	    
	    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('my_dialog.css', 'admin');?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('admin_new.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('calendar.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('jquery.dataTables.min.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('dataTables.bootstrap.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('dragula.min.css', 'admin')?>" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo $domain['static']['url']?>/admin/wangeditor/css/wangEditor.min.css" type="text/css" rel="stylesheet"/>
	    <link href="<?php echo css_js_url('signature-pad.css', 'admin') ?>" type="text/css" rel="stylesheet" >

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
          <script src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
	    <script type="text/javascript">
	    	var baseUrl = "<?php echo $domain['admin']['url'];?>";
	        var staticUrl = "<?php echo $domain['static']['url']?>";
	        var uploadUrl = "<?php echo $domain['upload']['url']?>";
	    </script>
	    <style>
	    .sign img{
	    	width:100%;
	    	height:100%;
	    }
	    </style>
	</head>
	<body>
	<?php $this->load->view('common/calendar')?>