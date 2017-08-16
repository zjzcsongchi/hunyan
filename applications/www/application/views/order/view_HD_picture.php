<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('pc-public.css', 'www')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('pc-user.css', 'www')?>">
    <?php $this->load->view('common/baidu_tongji')?>
</head>
<body class="grey">
   
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <!-- 用户信息头部 -->
        <?php $this->load->view('common/user_banner')?>
        
        <div class="page-main">
            <div class="down-cont">
                <img src="<?php echo $image;?>">
                <a href="/order/download_picture?order_id=<?php echo $order_id;?>&photo_id=<?php echo $photo_id;?>">下载原图</a>
            </div>
        </div>
    </div>

   
    
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		var unitPrice = <?php echo C('order.product_type.image.unit_price');?>; 
        seajs.use([
           '<?php echo css_js_url('order.js', 'www')?>'
        ], function(order){
          order.load();

		})
    </script>

</body>
</html>
