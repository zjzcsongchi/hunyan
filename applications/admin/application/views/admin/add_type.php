<?php $this->load->view("common/header");?>
<style>
.formbody a{  display: block; line-height: 35px;float: left;margin-right: 10px;text-align: center}
.formbody a:hover{ color: #f0f9fd}
</style>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="#"><?php echo $title[0];?></a></li>
        <li><a href="#"><?php echo $title[1];?></a></li>
    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span><?php echo $title[1];?>入口</span></div>
    <a href="/admin/add/0" class="btn" >综合管理</a>
    <a href="/admin/add/1" class="btn" >房开商</a>
    <a href="/admin/add/2" class="btn" >补贴中心</a>
</div>
