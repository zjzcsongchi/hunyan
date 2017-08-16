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
    <link rel="stylesheet" href="<?php echo css_js_url('m-wap.css', 'wap');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-user-new.css', 'wap');?>">
    <link rel="stylesheet" href="<?php echo css_js_url('weui.css', 'wap')?>">
    <link rel="stylesheet" href="<?php echo css_js_url('m-my_dialog.css', 'wap')?>">
    <style type="text/css">
    .weui-picker__item{padding:0;line-height:34px;}
    .weui-dialog__btn{ line-height: 48px;font-size: 18px;}
    </style>
    <?php $this->load->view('common/tongji')?>

</head>

<body>
    <div class="outerWrap">
        <div class="innerWrap">
            <div class="mainContainer">
                <div class="mainfix">
                    <ul class="user-list info-list">
                        <li id="uploadbtn">头像<i></i>
                            <img src="<?php echo get_img_url($user_info['head_img'])?>"/>
                            <input type="hidden" name="head_img" value="<?php echo $user_info['head_img']?>"/>
                        </li>
                        
                        <li>姓名<i></i><span class="r t-block"><?php echo $user_info['realname']?></span></li>
                        <div class="popup-user">
                            <p class="title">编辑姓名</p>
                            <div class="cont"><em class="del"></em><input type="text" name="realname" value="<?php echo $user_info['realname']?>" placeholder="4-30&#x4E2A;&#x5B57;&#x7B26;&#xFF0C;&#x652F;&#x6301;&#x4E2D;&#x82F1;&#x6587;&#x3001;&#x6570;&#x5B57;"></div>
                            
                            <a href="javascript:;" class="cancel">取消</a>
                            <a href="javascript:;" class="sure">确定</a>
                        </div>
                        <li>用户名<i></i><span class="r t-block"><?php echo $user_info['nickname']?></span></li>
                        <div class="popup-user">
                            <p class="title">编辑用户名</p>
                            <div class="cont"><em class="del"></em><input name="nickname" value="<?php echo $user_info['nickname']?>" type="text" placeholder="4-30&#x4E2A;&#x5B57;&#x7B26;&#xFF0C;&#x652F;&#x6301;&#x4E2D;&#x82F1;&#x6587;&#x3001;&#x6570;&#x5B57;"></div>
                            
                            <a href="javascript:;" class="cancel">取消</a>
                            <a href="javascript:;" class="sure">确定</a>
                        </div>
                        <li>性别<i></i><span class="r t-block sex_show">男</span></li>
                        <div class="popup-user pad0">
                            <p class="sex" data-id="0">男</p>
                            <p class="sex" data-id="1">女</p>
                            <input name="sex" select-id="0" value="0" style="display:none">
                        </div>
                        
                        <li>出生日期<i></i><span class="r t-block"><?php echo $user_info['birthday']?></span></li>
                        <div class="popup-user">
                            <p class="title">出生日期</p>
                            <div class="cont"><em class="del"></em><input name="birthday" readonly id="datePicker" value="<?php echo $user_info['birthday']?>" type="text" placeholder="11&#x4F4D;&#x6570;&#x5B57;"></div>
                            
                            <a href="javascript:;" class="cancel">取消</a>
                            <a href="javascript:;" class="sure">确定</a>
                        </div>
                        <li>手机号<i></i><span class="r t-block"><?php echo $user_info['mobile_phone']?></span></li>
                        <div class="popup-user">
                            <p class="title">手机号</p>
                            <div class="cont"><em class="del"></em><input name="mobile_phone" value="<?php echo $user_info['mobile_phone']?>" type="text" placeholder="11&#x4F4D;&#x6570;&#x5B57;"></div>
                            
                            <a href="javascript:;" class="cancel">取消</a>
                            <a href="javascript:;" class="sure">确定</a>
                        </div>
                        <li>现居地址<i></i><span class="r t-block"><?php echo $user_info['address']?></span></li>
                        <div class="popup-user">
                            <p class="title">现居地址</p>
                            <div class="cont"><em class="del"></em><input name="address" value="<?php echo $user_info['address']?>" type="text" placeholder="地址"></div>
                            
                            <a href="javascript:;" class="cancel">取消</a>
                            <a href="javascript:;" class="sure">确定</a>
                        </div>
                    </ul>
                    <button class="sure submit">提交</button>
                    <div class="page-bg"></div>

                    <?php $this->load->view('common/new_footer')?>
                </div>   
            </div>
        </div> 
    </div>
    <!-- 引入项目js资源文件,并配置构建地址演示 -->
    <?php $this->load->view('common/jsfooter')?>
    <script type="text/javascript">
    	var uploadUrl = "<?php echo $domain['upload']['url']?>";
    	var wxConfig = <?php echo $wxConfigJSON?>;
        seajs.use(['<?php echo css_js_url('user_new.js', 'wap')?>', '<?php echo css_js_url('m-public.js', 'wap')?>', '<?php echo css_js_url('weixin_upload_img.js', 'wap')?>'], function(a, p, w){
            p.load();
            a.load();
            a.sex();
            a.submit();
            a.sure();
            a.datepick();
            w.load();
        })
    </script>
    
</body>
</html>
