<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/milancombo/index">婚礼套餐列表</a></li>
        <li><a href="javascript:;">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>添加婚礼套餐</span></div>
    <ul class="forminfo">
        <li><label>套餐名称</label><input name="name" type="text" class="dfinput" valType="required" msg="请输入名称"/><b>*</b></li>
        <li><label>价格</label><input name="price" type="text" class="dfinput" valType="required" msg="请输入价格"/><b>*</b></li>
        <li><label>特色</label><input name="feature" type="text" class="dfinput" /></li>
        <li>
            <label>封面图</label>
            <ul id="uploader_cover_img">
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        <li>
            <label>简介</label>
            <textarea name="desc" class="textinput"></textarea>
        </li>
        <li>
            <label>备注</label>
            <textarea name="info" class="textinput"></textarea>
        </li>
        <li><label>&nbsp;</label><input  type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
var object = [{"obj": "#uploader_cover_img", "btn": "#file_cover_img"}];
seajs.use(['admin_uploader','jqvalidate','jqueryswf','swfupload','jqvalidate'], function(a){
	a.swfupload(object);
})
</script>
</body>
</html>













