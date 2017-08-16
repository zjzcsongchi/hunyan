<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/hotspotico/scene_change">热点图标管理</a></li>
    <li>添加</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <form class="form-horizontal">
        <div class="form-group">
			<label class="col-sm-3 control-label">图标地址</label>
			<div class="col-sm-9">
				<ul id="uploader_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
        </div>
        <div class="form-group">
			<label class="col-sm-3 control-label">动态图标地址</label>
			<div class="col-sm-9">
				<ul id="uploader_dynamic_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_dynamic_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
        </div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">是否动态图标</label>
		  <div class="col-sm-6">
		      <input type="radio"  value='1' name="is_dynamic" checked="checked" />是
		      <input type="radio"  value='0' name="is_dynamic"/>否
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">是否默认图标</label>
		  <div class="col-sm-6">
		      <input type="radio"  value='1' name="is_default" checked="checked" />是
		      <input type="radio"  value='0' name="is_default"/>否
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-sm-3 control-label">动态图标参数</label>
		  <div class="col-sm-6">
		      <input name="dynamic_param" type="text" class="form-control">
		      <span class="help-block">格式为：“100,100,60”，三个参数以英文逗号分隔，第一个为动画每一帧图片宽，第二个为每一帧图片高，第三个为每一帧图片切换频率。</span>
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-sm-6 text-center">
		      <a class="btn btn-primary" id="make_vtour">添加</a>
		  </div>
		</div>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [
      {"obj": "#uploader_img", "btn": "#btn_img"},
      {"obj":　"#uploader_dynamic_img", "btn": "#btn_dynamic_img"},
     ];

var upload_domain = '<?php echo $domain['upload']['url']?>';
seajs.use(['<?php echo css_js_url('hotspot.js', 'admin')?>', 'admin_uploader', 'jqueryswf', 'swfupload'], function (hotspot,admin_uploader) {
	admin_uploader.swfupload(object);
    hotspot.make();
});
</script>
</body>
</html>
