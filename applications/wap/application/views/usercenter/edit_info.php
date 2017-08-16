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
    <link href="<?php echo css_js_url('ui-dialog.css', 'common');?>" type="text/css" rel="stylesheet" />
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
                                <p>用户名</p>
                                <input type="hidden" id="user_id" value="<?php echo $user['id']?>"/>
                                <input type="text" id="realname" value="<?php echo $user['realname']?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x7528;&#x6237;&#x540D;">
                            </li>
                            <li>
                                <p>昵称</p>
                                <input type="text" id="nickname" value="<?php echo $user['nickname']?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x7528;&#x6237;&#x540D;">
                            </li>
                            <li>
                                <p>性   别</p>
                                <label><input name="sex" value='0' type="radio" <?php if($user['sex']==0){echo 'checked';}?>>男</label>
                                <label><input name="sex" value='1' type="radio" <?php if($user['sex']==1){echo 'checked';}?>>女</label>
                            </li>
                            <li>
                                <p>手机号</p>
                                <input type="text" id="mobile_phone" value="<?php echo $user['mobile_phone']?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x624B;&#x673A;&#x53F7;">
                            </li>
                            <li>
                                <p>现居地址</p>
                                <input type="text" id="address"  value="<?php echo $user['address']?>" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x73B0;&#x5C45;&#x5730;&#x5740;">
                            </li>
                        </ul>
                        <div class="but-cont">
                            <a href="javascript:;" class="submit" >保存</a>
                        </div>
                    </div>

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
        seajs.use(['<?php echo css_js_url('user.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>'],'<?php echo css_js_url('iscroll.min.js', 'wap')?>'], function(a,b){
			a.edit();
			b.load();
        	$(".info-list label").click(function() {
                $(".info-list label.act").removeClass("act");
                $(this).addClass("act");
            });
        })
    </script>  
</body>
</html>
