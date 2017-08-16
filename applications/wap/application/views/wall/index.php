<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>项目名称</title>
    <meta name="keywords" content="&#x9879;&#x76EE;&#x5173;&#x952E;&#x8BCD;">
    <meta name="description" content="&#x9879;&#x76EE;&#x63CF;&#x8FF0;">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="format-detection" content="telephone=no">

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('m-wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-wall.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo css_js_url('dropload.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    </style>

</head>

<body class="grey">
    <div class="mainfix">
        <div class="banner">
            <p class="title">搜索新人</p>
            <p class="text">您可以按姓名、婚礼时间、婚宴场馆搜索新人相关信息</p>
            <div class="input-cont">
                <input type="text" id="search">
                <p class="icon">搜 索</p>
            </div>
        </div>
        <div class="chose-cont">
            <div class="cont time">
                <p id="datePicker" class="text" data-id="">请选择婚宴时间</p>
                <i></i>
            </div>
            <div class="cont venue">
                <p id="singleLinePicker" class="text">请选择婚宴场馆</p>
                <i></i>
                <input type="hidden" name="venue" value="">
            </div>
        </div>
        <ul class="wall-list">
        <?php if(isset($lists)):?>
        <?php foreach ($lists as $k=>$v):?>
            <li>
                <a href="/today/detail?id=<?php echo $v['id']?>">
                    <img src="<?php echo $v['m_cover_img'] ?  get_img_url($v['m_cover_img']) : $domain['static']['url'].'/wap/images/default-banner1.jpg'?>">
                    <p class="name"><?php echo $v['roles_main']?> & <?php echo $v['roles_wife']?></p>
                    <div class="cont">
                        <p class="l">
                            <?php if(isset($venue_name[$v['id']][0])):?><?php echo $venue_name[$v['id']][0]?><?php endif;?>
                        </p>
                        <p class="r"><?php echo $v['solar_time']?></p>
                    </div>
                </a>
            </li>
        <?php endforeach;?>
        <?php endif;?>    
        </ul>
        
        <input type="hidden" name="page" value="2"/>
        
        
        <div class="wall-popup time"></div>
    </div> 
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    	var count = "<?php echo count($venue)?>";
    	venue = '<?php echo json_encode($venue)?>';
    	venue_name = JSON.parse(venue);
    </script>
    <script type="text/javascript">
        seajs.use(['<?php echo css_js_url('wall.js', 'wap')?>'], function(a){
			a.load();
			a.load_more();
        })
    </script>
    
    
</body>
</html>
