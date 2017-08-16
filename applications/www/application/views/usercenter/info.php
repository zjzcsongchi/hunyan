<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $seo['title']?>-个人资料</title>
    <meta name="keywords" content="<?php echo $seo['keywords']?>">
    <meta name="description" content="<?php echo $seo['description']?>">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <base target="_blank">
    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('public.css', 'www');?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo css_js_url('user.css', 'www');?>" type="text/css" rel="stylesheet" />
    
    <?php $this->load->view('common/baidu_tongji')?>

</head>
<body>
    <!-- 头部 -->
    <?php $this->load->view('common/header')?>

    <!-- 内容 -->
    <div class="container">
        <?php $this->load->view('common/user_head')?>

        <div class="user-main">
            <ul class="info-list">
                <li>
                    <p class="title">姓名</p>
                    <p><?php echo $user['realname']?></p>
                </li>
                <li>
                    <p class="title">用户名</p>
                    <p><?php echo $user['nickname']?></p>
                </li>
                <li>
                    <p class="title">性   别</p>
                    <p><?php if($user['sex'] == 1){echo '女';}else{echo '男';}?></p>
                </li>
                <li>
                    <p class="title">出生日期</p>
                    <p><?php echo $user['birthday']?></p>
                </li>
                <li>
                    <p class="title">手机号</p>
                    <p><?php echo $user['mobile_phone']?></p>
                </li>
                <li>
                    <p class="title">现居地址</p>
                    <p><?php echo $user['address']?></p>
                </li>
            </ul>
        </div>

    </div>

    <!-- 底部 -->
    <?php $this->load->view('common/footer')?>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
		seajs.use('public',function(a){
			a.load();
		})
    </script>
</body>
</html>
