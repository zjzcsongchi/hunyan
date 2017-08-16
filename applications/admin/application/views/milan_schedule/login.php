<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="renderer" content="webkit">
    <title>档期管理 - 登录</title>

    <link href="<?php echo css_js_url('/bootstrap.min.css', 'admin');?>" type="text/css" rel="stylesheet" />


</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">米兰国际</h1>

            </div>
            <h3>档期管理</h3>

            <form class="m-t col-lg-12" role="form" >
                <div class="form-group">
                    <input type="text" class="form-control loginuser" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control loginpwd" placeholder="密码" required="">
                </div>
                <button type="button" class="btn btn-primary loginbtn " style="width: 100%">登 录</button>


            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <?php $this->load->view("common/footer");?>
    <script>
        seajs.use(
            "<?php echo css_js_url('milan/milanstaff.js', 'milan_mobile');?>",
        function (a) {
            a.lgoin();
        	
        });
    </script>
</body>

</html>

