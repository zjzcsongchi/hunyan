<?php $this->load->view('common/header2');?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/dinner/album?dinner_id=<?php echo $dinner_id;?>">宴会相册</a></li>
    <li class="active">添加相册</li>
</ol>

<div class="container-fluid" style="margin:10px">
<fieldset>
    <legend><button class="btn btn-primary" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返回</button>&nbsp;添加相册</legend>
    
    <form class="form-horizontal" method="post">
        <input type="hidden" name="dinner_id" value="<?php echo $dinner_id?>">
        <div class="form-group">
            <label class="col-sm-2 control-label">相册名称：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="请输入相册名称" valType="required" name="name" msg="名称不能为空">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">价格：</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="请输入价格" valType="required" name="price" msg="名称不能为空">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">描述：</label>
            <div class="col-sm-4">
                <textarea class="form-control" placeholder="请输入描述信息" name="desc" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">封面图：</label>
            <div class="col-sm-6">
                <ul id="uploader_cover_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">关联资讯文章：</label>
            <div class="col-sm-4">
                <input type="hidden" name="article_id" id="article_id" >
                <input type="text" class="form-control" id="search_name" placeholder="输入文章名称查找">
                <div id="search_result" style="max-height:300px;overflow-y: scroll;overflow-x: hidden;border:1px solid #ccc; box-shadow: inset 0 1px 1px rgba(0,0,0,.075);">
                    
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6 text-center">
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> 保 存</button>
            </div>
        </div>
    </form>
</fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [{"obj": "#uploader_cover_img", "btn": "#btn_cover_img"}];
seajs.use(['<?php echo css_js_url('dinner_album.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','<?php echo css_js_url('jquery.swfupload.js', 'common');?>','swfupload'], function(a, swfupload){
	a.search_news();
	a.sure_select();
    swfupload.swfupload(object);
})
</script>
</body>
</html>
