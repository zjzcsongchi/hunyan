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
        <li><label>套餐名称</label>
            <input type="hidden" name="id" value="<?php echo $info['id']?>" />
            <input name="name" value="<?php echo $info['name']?>" type="text" class="dfinput" valType="required" msg="请输入名称"/><b>*</b></li>
        <li><label>价格</label><input name="price" value="<?php echo $info['price']?>" type="text" class="dfinput" valType="required" msg="请输入价格"/><b>*</b></li>
        <li><label>特色</label><input name="feature" value="<?php echo $info['feature']?>" type="text" class="dfinput" /></li>
        <li>
            <label>封面图</label>
            <ul id="uploader_cover_img">
                <?php if(isset($info['cover_img'])):?>
                    <li id="SWFUpload_0_0" class="pic pro_gre" style="margin-right: 20px; clear: none">
                        <a class="close del-pic" href="javascript:;"></a>
                        <img src="<?php echo get_img_url($info['cover_img'])?>" style="width: 100%; height: 100%" />
                        <input type="hidden" name="cover_img" value="<?php echo $info['cover_img']?>">
                    </li>
                <?php endif;?>
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        <li>
            <label>简介</label>
            <textarea name="desc" class="textinput"><?php echo $info['desc']?></textarea>
        </li>
        <li>
            <label>备注</label>
            <textarea name="info" class="textinput"><?php echo $info['info']?></textarea>
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