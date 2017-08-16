    <div class="header show">
        <div class="nav">
            <a href="/home" class="logo"></a>
            <div class="menu">
                <ul>
                    <li <?php if($action == 'index'):?>class="active"<?php endif;?>>
                        <a href="/home" class="width1" target="_self">
                            <p class="out">首页<br><span>Home</span></p><p class="over">首页<br><span>Home</span></p>
                        </a>
                    </li>
                    <li <?php if($action == 'today'):?>class="active"<?php endif;?>>
                        <a href="/today" target="_self">
                            <p class="out">今日宴会<br><span>Banquet</span></p><p class="over">今日宴会<br><span>Banquet</span></p>
                        </a>
                    </li>
                    <li <?php if($action == 'venue'):?>class="active"<?php endif;?>>
                        <a href="/venue" target="_self">
                            <p class="out">婚宴场馆<br><span>Venue</span></p><p class="over">婚宴场馆<br><span>Venue</span></p>
                        </a>
                    </li>
                    <li <?php if($action == 'drink'):?>class="active"<?php endif;?>>
                        <a href="/drink" target="_self">
                            <p class="out">酒水商城<br><span>Drinks</span></p><p class="over">酒水商城<br><span>Drinks</span></p>
                        </a>
                    </li>
                    <li <?php if($action == 'news'):?>class="active"<?php endif;?>>
                        <a href="/news" target="_self">
                            <p class="out">自媒体<br><span>Media</span></p><p class="over">自媒体<br><span>Media</span></p>
                        </a>
                    </li>
                </ul>
                <div class="cls"></div>
            </div>
            <?php if(isset($user_info)):?>
            <a href="/usercenter/wedding" class="user-center1">会员中心</a>
            <a href="/passport/logout" class="user-center2">退出登录</a>
            <?php else:?>
            <a href="javascript:;" class="user-center" id="usercenter">会员登录</a>
            <?php endif;?>
        </div>
    </div>
    
    
    <!-- 登录注册 -->
    <div class="page-bg"></div>
    <!-- 登录弹窗 -->
    <!-- 登录 -->
    <div class="popup-login login" id="login_box">
        <p class="close"></p>
        <div class="left-cont">
            <p class="head">百年婚宴</p>
            <p class="head-s">安顺婚宴第一品牌</p>
            <img src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg">
            <p>微信扫一扫，关注百年婚宴</p>
        </div>
        <div class="right-cont">
            <p class="title">登录</p>
            <form id="login_form">
            <ul>
                <li><i class="name"></i><input type="text" placeholder="请输入手机号" name="mobile"></li>
                <li><i class="pass"></i><input type="password" placeholder="请输入密码" name="password"></li>
            </ul>
            </form>
            <p class="text"><i id="login_auto"></i>记住我<a href="javascript:;" class="to-repass" id="repass">忘记密码？</a></p>
            <p class="message" id="login_msg"></p>
            <p class="but-cont">
                <a href="javascript:;" id="login_btn">立即登录</a>
                <a href="javascript:;" class="weix" id="weixin">微信登录</a>
            </p>
            <p class="bot">还没有帐号？<a href="javascript:;" class="to-reg" id="reg">立即注册</a></p>
        </div>
    </div>
    <!-- 微信登录 -->
    <div class="popup-login weix" id="weixin_box">
        <p class="close"></p>
        <div class="left-cont">
            <p class="head-s">打开微信 - 扫一扫</p>
            <img src="<?php echo $domain['static']['url']?>/www/images/wechat-scan-guide.png">
        </div>
        <div class="right-cont">
            <p class="title">微信登录</p>
            <img id="weixin_QR" src="">
            <p class="text1">请使用微信扫描二维码登录<br>“百年婚宴”</p>
            <!-- 
            <p class="bot"><a href="javascript:;" class="to-login">返回帐号登录</a></p>
            -->
        </div>
    </div>
    <!-- 注册 -->
    <div class="popup-login reg" id="reg_box">
        <p class="close"></p>
        <div class="left-cont">
            <p class="head">百年婚宴</p>
            <p class="head-s">安顺婚宴第一品牌</p>
            <img src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg">
            <p>微信扫一扫，关注百年婚宴</p>
        </div>
        <div class="right-cont">
            <p class="title">注册</p>
            <form id="reg_form">
            <input type="hidden" name="token" value="">
            <ul>
                <li><i class="name"></i><input type="text" placeholder="请输入手机号" name="mobile"></li>
                <li><i class="code"></i><input type="text" class="code" placeholder="请输入手机验证码" name="code"><button class="code-but" id="reg_code">获取验证码</button></li>
                <li><i class="pass"></i><input type="password" placeholder="请输入密码" name="password"></li>
            </ul>
            </form>
            <p class="text"><i id="reg_agree"></i>阅读并接受《注册协议》</p>
            <p class="message" id="reg_msg"></p>
            <a href="javascript:;" class="submit" id="reg_btn">注册</a>
        </div>
    </div>
    <!-- 找回密码 -->
    <div class="popup-login repass" id="repass_box">
        <p class="close"></p>
        <div class="left-cont">
            <p class="head">百年婚宴</p>
            <p class="head-s">安顺婚宴第一品牌</p>
            <img src="<?php echo $domain['static']['url']?>/www/images/ewm.jpg">
            <p>微信扫一扫，关注百年婚宴</p>
        </div>
        <div class="right-cont">
            <p class="title">找回密码</p>
            <form id="repass_form">
            <input type="hidden" value="" name="token">
            <ul>
                <li><i class="name"></i><input type="text" placeholder="请输入手机号" name="mobile"></li>
                <li><i class="code"></i><input type="text" class="code" placeholder="请输入手机验证码" name="code"><button class="code-but" id="repass_code">获取验证码</button></li>
                <li><i class="pass"></i><input type="password" placeholder="请输入密码" name="password"></li>
            </ul>
            </form>
            <p class="message" id="repass_msg"></p>
            <a href="javascript:;" class="submit" id="repass_btn">确定修改</a>
        </div>
    </div>