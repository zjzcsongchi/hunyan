<?php $this->load->view('common/header2') ?>
<ol class="breadcrumb">
	<li><a href="/common">首页</a></li>
	<li class="active"><a href="/venue/album?venue_id=<?php echo $venue_id;?>">相册管理</a></li>
</ol>
<div class="container-fluid">
	<form class="form-horizontal tab-content" method="post">
	    <input type="hidden" name="venue_id" value="<?php echo $venue_id?>"/>    
	    <div class="tab-pane active" id="images">
            <div class="form-group">
    			<label class="col-sm-2 control-label">相册名称:</label>
    			<div class="col-sm-2">
    				<input class="form-control" type="text" name="title" value="" valType="required" msg="请填写相册名称"/>  
    			</div>
    		</div>
    		
        </div> 
        <!-- 相册 -->
        <div class="tab-pane active" id="images">
            <div class="form-group">
    			<label class="col-sm-2 control-label">上传相册:</label>
    			<div class="col-sm-10">
    				<ul id="uploaders_venue_img">
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="file_venue_img"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
    			</div>
    		</div>
    		
        </div>
        <!-- save -->
        <div class="form-group">
            <div class="col-sm-6 text-center">
                <input type="submit" value="保 存" class="btn btn-danger">
            </div>
        </div>
        <br>
        <br>
        <br>
	</form>
</div>
<?php $this->load->view('common/footer') ?>
<script>
    var object =[
        {"obj": "#uploaders_venue_img", "btn": "#file_venue_img"},
    ];
    
    seajs.use(['admin_uploader','bootstrap','jqvalidate','jqueryswf','swfupload'], function(swfUploader){
        swfUploader.swfupload(object);
    })
</script>
</body>
</html>