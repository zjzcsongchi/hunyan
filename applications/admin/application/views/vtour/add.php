<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li>全景图制作</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <form class="form-horizontal">
        <div class="form-group">
			<label class="col-sm-3 control-label">选择场景类型</label>
			<div class="col-sm-6">
				<select class="form-control" id="scene_type">
				<option value >请选择场景类型</option>
				<?php foreach ($type as $k => $v):?>
				<option value="<?php echo $k?>"><?php echo $v?></option>
				<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label">选择场景</label>
		    <div class="col-sm-9">
		        <ul class="list-inline" id="scene_list">
		          
		        </ul>
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">选择场馆</label>
			<div class="col-sm-6">
				<select class="form-control" name="venue_id">
				<option value >请选择场馆</option>
				<?php foreach ($venue_list as $k => $v):?>
				<option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
				<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">上传封面图</label>
			<div class="col-sm-9">
				<ul id="uploader_cover_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">上传logo</label>
			<div class="col-sm-9">
				<ul id="uploader_logo">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_logo"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">上传背景音乐</label>
			<div class="col-sm-9">
				<ul id="uploader_bgmusic" data-type="music">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_bgmusic"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">名称</label>
		  <div class="col-sm-6">
		      <input type="text" class="form-control" name="name" />
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">场景地址</label>
		  <div class="col-sm-6">
		      <input type="text" class="form-control" name="place" />
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">位置坐标</label>
		  <div class="col-sm-6">
		      <input type="text" class="form-control" name="location" />
		      <p class="help-block">填写位置坐标，点击<a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">这里</a>手动拾取坐标</p>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">简介</label>
		  <div class="col-sm-6">
		      <textarea rows="3" class="form-control" name="introduce"></textarea>
		  </div>
		</div>
		
		<div class="form-group">
		  <div class="col-sm-6 text-center">
		      <a class="btn btn-primary" id="add_vtour">制 作</a>
		  </div>
		</div>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object1 = [
{"obj":"#uploader_logo", "btn": "#btn_logo"},
{"obj":"#uploader_cover_img", "btn": "#btn_cover_img"},
{"obj":"#uploader_bgmusic", "btn": "#btn_bgmusic"}
               ];
var upload_domain = '<?php echo $domain['upload']['url']?>';
seajs.use(['<?php echo css_js_url('vr_upload.js', 'admin')?>','<?php echo css_js_url('vtour.js', 'admin')?>','admin_uploader', 'jqueryswf','swfupload'], function(swfupload, vtour, admin_uploader){
  admin_uploader.swfupload(object1);
  vtour.add();
  vtour.ajax_scene();
  vtour.dragula();
});
</script>
</body>
</html>