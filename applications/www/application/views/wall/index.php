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
    <link rel="stylesheet" href="<?php echo css_js_url('new_public.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('wall.css', 'www');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('dcalendar.picker.css', 'www');?>">
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body class="today">
    <!-- 头部 -->
    <?php $this->load->view('common/new_header')?>
    <!-- 内容 -->
    <div class="container">
        <div class="wall-banner">
            <div class="cont">
                <p class="count">已服务新人：<?php echo $wedding_num?> 对</p>
                <div class="input-cont" style="margin:228px auto; margin-left:248px;">
                    <input id="name" type="text" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x65B0;&#x90CE;&#x6216;&#x65B0;&#x5A18;&#x59D3;&#x540D;">
                    <a id="find" href="javascript:;" target="_self">搜索</a>
                </div>
            </div>
        </div>
        <div class="page-main">
            <div class="chose-cont">
                <div class="cont l">
                    <p class="head">时间</p>
                    <p class="text"><input id="solar_time" style="height:32px;width:210px;border:none;margin-top: -10px;" type="text"/></p>
                    <i></i>
                </div>
                <div class="cont r">
                    <p class="head">场馆</p>
                    <p id="cg" data-id="" class="text act">请选择婚宴场馆</p>
                    <i></i>
                    <ul class="list">
                        <?php if(isset($venue)&&!empty($venue)):?>
                        <?php foreach ($venue as $k => $v):?>
                            <li class="venue_id" data="<?php echo $v['id']?>" ><?php echo $v['name']?></li>
                        <?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <ul class="project-list" status="1">
                <?php if(isset($lists)):?>
                <?php foreach ($lists as $k => $v):?>
                <li>
                    <a href="/today/detail?id=<?php echo $v['id']?>" class="project_card">
                        <img src="<?php echo $v['m_cover_img'] ?  get_img_url($v['m_cover_img']) : $domain['static']['url'].'/wap/images/default-banner1.jpg'?>">
                        <p class="name"><?php echo $v['roles_main']?> & <?php echo $v['roles_wife']?></p>
                        <div class="cont">
                            <p class="l"><?php if(isset($venue_name[$v['id']][0])):?><?php echo $venue_name[$v['id']][0]?><?php endif;?></p>
                            <p class="r"><?php echo $v['solar_time']?></p>
                        </div>
                        <div class="shoadw"></div>
                    </a>
                </li>
                <?php endforeach;?>
                <?php endif;?>
                
            </ul>
            <a id="load_more" class="more" style="display:none">加载更多</a>
        </div>
    </div>
    <input type="hidden" id="page" value="2">
    
    
    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>

    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use(['public', '<?php echo css_js_url('pc-wall.js', 'www')?>','<?php echo css_js_url('jquery.hover3d.js', 'www')?>','<?php echo css_js_url('dcalendar.picker.js', 'www')?>'], function(a,b){
			a.load();
			b.venue();
			b.find();
			b.time();
			b.load_more();//加载更多
			b.load_ajax();
			$(".chose-cont ul li:last-child").css("border-bottom", "none");
            $(".chose-cont .cont.r").click(function() {
                $(this).children(".list").toggleClass("act");
            });

            $(".project-list li:nth-child(3n)").css("margin-right", "0");
            $(".project-list li").hover3d({
                selector: ".project_card",
                shine: true,
            });
            //时间选择
            $('#solar_time').dcalendarpicker({format: 'yyyy-mm-dd'});
            
        })
    </script>
</body>
</html>