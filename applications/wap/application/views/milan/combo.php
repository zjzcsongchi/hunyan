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
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('wap-ml.css', 'wap')?>">
    <?php $this->load->view('common/tongji')?>

</head>
<body class="grey">
    <div class="page-main padbot150">
        <div class="setmeal-cont <?php echo $class_name;?>">
            <div class="head"><?php echo $combo['name'];?><span class="r"><?php echo $combo['price'];?>元</span></div>
            <ul>
                <?php foreach ($combo_detail as $k => $v):?>
                    <?php if(isset($v['child'])):?>
                        <li class="title"><?php echo $v['name']?></li>
                        <?php foreach ($v['child'] as $k2 => $v2):?>
                            <li class="text"><i></i><?php echo $v2['name']?></li>
                        <?php endforeach;?>
                    <?php endif?>
                <?php endforeach;?>
                
            </ul>
        </div>
        <!-- footer -->
        <?php $this->load->view('common/new_footer')?>
        <!-- footer -->
    </div>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    seajs.use(['<?php echo css_js_url('m-public.js', 'wap')?>'], function(p){
    	p.load();
       
    })
    </script>
      
</body>
</html>
