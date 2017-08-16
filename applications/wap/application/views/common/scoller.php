<div class="mainMenu scroller">
    <div class="scrollerCon" style="transition-timing-function:cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
    <nav>
        <ul>
            <li <?php if($action == 'index'):?>class="active"<?php endif;?>><a href="/">首页</a></li>
            <li <?php if($action == 'today'):?>class="active"<?php endif;?>><a href="/today">今日宴会</a></li>
            <li <?php if($action == 'venue'):?>class="active"<?php endif;?>><a href="/venue">婚宴场馆</a></li>
            <li <?php if($action == 'news'):?>class="active"<?php endif;?>><a href="/news">自媒体</a></li>
            <li <?php if($action == 'drink'):?>class="active"<?php endif;?>><a href="/drink">酒水菜单</a></li>
            <li><a href="/usercenter/wedding">会员中心</a></li>
        </ul>
    </nav>
    <p class="login">
        <?php if(!isset($user_info)):?>
        <a href="/passport/register">注册</a>
            <span>or</span>
        <a href="/passport/login_page">登录</a>
        <?php else:?>
        <a href="/passport/logout">退出</a>
        <?php endif;?>
    </p>
    </div>
</div> 