<div class="left-nav">
    <ul>
        <li class="nav1 <?php if($act == 'info'){ echo 'act'; }?>">
            <a href="/usercenter/index"><i></i>个人资料</a>
        </li>
        <li class="nav7 <?php if($act == 'resetpwd'){ echo 'act'; }?>">
            <a href="/usercenter/modify_pwd"><i></i>修改密码</a>
        </li>
        <li class="nav2 <?php if($act == 'auth'){ echo 'act'; }?>">
            <a href="/usercenter/authenticate"><i></i>身份认证</a>
        </li>
        <li class="nav3 <?php if($act == 'apply') { echo 'act'; } ?>">
            <a href="/usercenter/buy_apply"><i></i>申请查询</a>
        </li>
        <li class="nav4 <?php if($act == 'allowance') { echo 'act'; } ?>">
            <a href="/usercenter/buy_allowance"><i></i>补贴查询</a>
        </li>
        <li class="nav5 <?php if($act == 'message') { echo 'act'; } ?>">
            <a href="/usercenter/message"><i></i>我的消息</a>
        </li>
        <li class="nav6 <?php if($act == 'comment') { echo 'act'; } ?>">
            <a href="/usercenter/comment"><i></i>我的点评</a>
        </li>
    </ul>
</div>