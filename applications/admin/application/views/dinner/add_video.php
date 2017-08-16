<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <?php foreach ($title as $k => $v):?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endforeach;?>
</ol>

<div class="container-fluid">
    <fieldset>
        <legend>添加附件</legend>
        <form class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $info['id']?>"/>
            <div class="form-group">
                <label class="col-sm-3 control-label">上传视频</label>
                <div class="col-sm-5">
                    <ul id="uploader_video" data-type="video">
                        <?php if(!empty($info['video'])):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <p><?php echo $info['video']?></p>
                            <input type="hidden" name="video" value="<?php echo $info['video'];?>"/>
                        </li>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_video"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">视频标题</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="video_title" value="<?php echo $info['video_title']?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">视频介绍</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="video_intro" rows="3"><?php echo $info['video_intro']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 text-center">
                    <button class="btn btn-danger" type="button" id="save">保 存</button>
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
	var backurl = "<?php echo $title[1]['url']?>";
	var object = [{"obj": "#uploader_video", "btn": "#btn_video", 'type':'video'}];
	seajs.use(['<?php echo css_js_url('add_file.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
	    a.edit(backurl);
	    swfupload.swfupload(object);
	})
</script>

</body>
</html>