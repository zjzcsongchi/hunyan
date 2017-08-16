<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?></title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link rel="stylesheet" href="<?php echo css_js_url('public.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('venue.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/header')?>

    <!-- 内容 -->
    <div class="container">
        

        <div class="page-main">
            <ul class="pckage-list">
            
            <?php if($lists):?>
            <?php foreach ($lists as $k=>$v):?>
                <li>
                    <div class="cont">
                        <img src="<?php echo get_img_url($v['cover_img'])?>">
                        <div class="bg"></div>
                        <p class="anmt-title"><?php echo $v['combo_name']?></p>
                        <div class="info">
                            <p class="title"><?php echo $v['combo_name']?></p>
                            <p class="text">总计：<?php echo $v['all_price']?>元 /优惠：<?php echo $v['all_price']-$v['price']?>元 /套餐价：￥<?php echo $v['price']?>/桌</p>
                            <table border="0" cellspacing="0" cellpadding="0">
                            <?php foreach ($v['dish'] as $key=>$val):?>
                            <?php if($key <=11):?>
                            <?php if($key%2 == 0):?> 
                                <tr>
                                   <td value="<?php echo $key?>"><?php if(isset($v['dish'][$key])):?> <?php echo $dish[$v['dish'][$key]]?><?php endif;?></td>
                                   <td value="<?php echo $key+1?>"><?php if(isset($v['dish'][$key+1])):?>  <?php echo $dish[$v['dish'][$key+1]]?><?php endif;?> </td>
                                </tr>
                            <?php endif;?>  
                            <?php endif;?>
                            <?php endforeach;?>
                            </table>
                        </div>
                    </div> 
                </li>
                <?php endforeach;?>
                <?php endif;?>
            </ul>
        </div>
        

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('news.js', 'www')?>'], function(a){
			a.load();
        })
    </script>
</body>
</html>
