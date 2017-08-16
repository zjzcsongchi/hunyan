<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li>全景图制作</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <form class="form-horizontal">
        <div class="form-group">
			<label class="col-sm-3 control-label">上传全景图</label>
			<div class="col-sm-9">
				<ul id="uploaders_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_img"><span>+</span><br>添加照片</a>
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
		  <label class="col-sm-3 control-label">类型</label>
		  <div class="col-sm-6">
		      <select name="type" class="form-control">
		          <?php foreach ($type as $k => $v):?>
		          <option value="<?php echo $k?>"><?php echo $v?></option>
		          <?php endforeach;?>
		      </select>
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-sm-6 text-center">
		      <a class="btn btn-primary" id="make_vtour">制 作</a>
		  </div>
		</div>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [
              {"obj": "#uploaders_img", "btn": "#btn_img"}
              ];
var upload_domain = '<?php echo $domain['upload']['url']?>';
seajs.use(['<?php echo css_js_url('vr_upload.js', 'admin')?>','<?php echo css_js_url('vtour.js', 'admin')?>','admin_uploader', 'jqueryswf','swfupload'], function(swfupload, vtour, admin_uploader){
  swfupload.swfupload(object);
  vtour.make();
});
</script>
</body>
</html>