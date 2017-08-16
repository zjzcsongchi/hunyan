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
    <link href="<?php echo css_js_url('wap.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('m-user.css', 'wap');?>" type="text/css" rel="stylesheet" />
    <?php $this->load->view('common/tongji')?>
</head>


<body class="grey">
    <div class="outerWrap">
        <div class="innerWrap">
            <!-- 头部 -->
            <?php $this->load->view('common/header')?>
            <div class="mainContainer">
                <div class="mainfix">
                    <!--会员公共头部 -->
                    <?php $this->load->view('common/user_header')?>

                    <div class="user-cont info-cont">
                        <ul class="info-list">
                            <li>
                                <p>姓名</p>
                                <p><?php echo $user_info['realname']?></p>
                            </li>
                            <li>
                                <p>用户名</p>
                                <p><?php echo $user_info['nickname']?></p>
                            </li>
                            <li>
                                <p>性   别</p>
                                <p><?php if($user_info['sex'] == 1){echo '女';}else{echo '男';}?></p>
                            </li>
                            <li>
                                <p>出生日期</p>
                                <p><?php echo $user_info['birthday']?></p>
                            </li>
                            <li>
                                <p>手机号</p>
                                <p><?php echo $user_info['mobile_phone']?></p>
                            </li>
                            <li>
                                <p>现居地址</p>
                                <p><?php echo $user_info['address']?></p>
                            </li>
                        </ul>
                        <div class="but-cont">
                            <a href="/usercenter/edit_info">修改资料</a>
                        </div>
                    </div>

                    <!-- 底部 -->
                    <?php $this->load->view('common/footer')?>
                </div>   
            </div>
        </div>
        <!-- 左边栏 -->
        <?php $this->load->view('common/scoller')?>
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
        seajs.use([ '<?php echo css_js_url('m-public.js', 'wap')?>','<?php echo css_js_url('iscroll.min.js', 'wap')?>'], function(a){
			a.load();
            })
    </script>
</body>
</html>
