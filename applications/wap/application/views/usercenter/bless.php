<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?> - 我收到的祝福</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-user_coupon.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <div class="user-bless">
                        <p class="title">我收到的祝福</p>
                        <p class="bless-title">共收到祝福：<?php if(isset($bless_count)){echo $bless_count;}?>条</p>
                        <ul class="bless-lists">
                            <?php if (isset($bless) && !empty($bless)):?>
                                <?php foreach ($bless as $k => $v):?>
                                    <li>
                                        <img src="<?php echo get_img_url($v['head_img']) ;?>">
                                        <p><span><?php echo $v['nickname'] ;?> ：</span><?php echo $v['content'] ;?></p>
                                    </li>
                                <?php endforeach;?>
                            <?php else:?>
                               <!-- 没数据时提示 -->
                            <?php endif;?>

                            
                            
                        </ul>
                        <a href="javascript:;" class="more">查看更多祝福</a>
                    </div>

                    <?php $this->load->view('common/new_footer')?>
                </div>   
            </div>
        </div> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('receive_bless.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>'], function(bless, p){
            p.load();
			bless.get_more_bless();
        })
    </script>
</body>
</html>
