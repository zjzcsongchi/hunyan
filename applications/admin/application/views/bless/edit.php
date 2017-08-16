<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/bless/dirty_word">脏话库设置</a></li>
    </ul>
</div>
 
<div class="formbody">
    <div class="formtitle"><span>编辑脏话库</span></div>
    <form action="" method="post" >
        <ul class="forminfo">
            <li><label>脏话库</label><textarea name="dirty_word" class="textinput" style="width: 804px;height: 335px;overflow-y: auto;"><?php if(!empty($dirty_word)) { echo $dirty_word; } ?></textarea><i></i></li>
            <li><label>&nbsp;</label><input  type="submit" class="btn J_save" value="保 存"/></li>
            <i style="color: #C56767;margin-left: 300px;">每行一词，过滤词之间请用逗号分隔，最后一个词后面必须有逗号，当字库过大时，保存需要一定时间，请耐心等候</i>
        </ul>
    </form>
</div>

<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('common.js', 'admin');?>"></script>

</body>
</html>