<?php $this->load->view('common/header2')?>

<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li>全景图制作</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <form class="form-horizontal" method="POST">
        <div class="form-group">
			<label class="col-sm-3 control-label">上传视频</label>
			<div class="col-sm-9">
				<ul id="uploader_video_url" data-type="video">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_video_url"><span>+</span><br>添加照片</a>
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
		  <div class="col-sm-6 text-center">
		      <button class="btn btn-primary" type="submit">制 作</button>
		  </div>
		</div>
    </form>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [
              {"obj": "#uploader_video_url", "btn": "#btn_video_url", type:'video'}
              ];
var upload_domain = '<?php echo $domain['upload']['url']?>';
seajs.use(['admin_uploader', 'jqueryswf','swfupload'], function(swfupload){
  swfupload.swfupload(object);
});
</script>
</body>
</html>