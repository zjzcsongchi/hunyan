<?php $this->load->view('common/header2') ?>
<ol class="breadcrumb">
	<li><a href="/common">首页</a></li>
	<li class="active"><a href="/venue/album?venue_id=<?php echo $venue_id;?>">相册管理</a></li>
</ol>
<div class="container-fluid">
	<form class="form-horizontal tab-content" method="post">
	    <input type="hidden" name="id" value="<?php echo $info['id']?>"/>   
	    <input type="hidden" name="venue_id" value="<?php echo $venue_id?>"/>   
        <!-- 相册 -->
        <div class="tab-pane active" id="images">
            <div class="form-group">
    			<label class="col-sm-2 control-label"><?php echo $info['title']?>:</label>
    			<div class="col-sm-10">
    				<ul id="uploaders_venue_img">
    				    <?php if(isset($info['images'][0])):?>
    				    <?php foreach ($info['images'] as $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($v);?>" target="_blank"><img src="<?php echo get_img_url($v);?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="venue_img[]" value="<?php echo $v;?>"/>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
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