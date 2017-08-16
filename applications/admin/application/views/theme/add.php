<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/customer/index">主题管理</a></li>
    <li class="active"><a href="#">添加主题</a></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend><h1>添加主题</h1></legend>
        <form class="form-horizontal" method="post" action="/theme/add">
            <div class="form-group">
                <label class="col-sm-2 control-label">标题*</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="title" valType="required" msg="标题不能为空" placeholder="请输入标题">
                </div>
            </div>
            
            <!-- 封面图 -->
            <div class="tab-pane" id="images">
                <div class="form-group">
                    <label class="col-sm-2 control-label">封面图</label>
                    <div class="col-sm-10">
                        <ul id="uploader_cover_img">
                            <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                                <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- 相册 -->
            <div class="tab-pane" id="images">
                <div class="form-group">
                    <label class="col-sm-2 control-label">相册</label>
                    <div class="col-sm-10">
                        <ul id="uploader_theme_img">
                            <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                                <a href="javascript:;" class="up-img"  id="btn_theme_img"><span>+</span><br>添加照片</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- 视频 -->
            <div class="tab-pane" id="video">
                <div class="form-group">
            			<label class="col-sm-2 control-label">导读视频:</label>
            			<div class="col-sm-10">
            				<ul id="uploader_video" data-type="video">
            	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
            	                    <a href="javascript:;" class="up-img"  id="btn_video"><span>+</span><br>添加照片</a>
            	                </li>
            	            </ul>
            			</div>
            		</div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <input type="submit" id="submit" value="保  存" class="btn btn-danger">
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script type="text/javascript">
var object = [{"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},{"obj": "#uploader_theme_img", "btn": "#btn_theme_img"},{"obj": "#uploader_video", "btn": "#btn_video","type":'video'}];
seajs.use(['<?php echo css_js_url('adddrinkorder.js', 'admin')?>','admin_uploader','<?php echo css_js_url('theme.js', 'admin')?>','jqvalidate','jqueryswf','swfupload'], function(a, swfupload,b){
	a.datepick();
	swfupload.swfupload(object);
	b.save();
})
</script>
</body>
</html>