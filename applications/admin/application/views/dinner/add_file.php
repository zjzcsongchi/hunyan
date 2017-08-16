<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <?php foreach ($title as $k => $v):?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endforeach;?>
</ol>

<div class="container-fluid">
    <fieldset>
        <legend>管理相片</legend>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">相册名称</label>
                <div class="col-sm-4 text-center">
                    <select class="form-control" disabled>
                    <?php if(isset($list)):?>
                    <?php foreach ($list as $k => $v):?>
                    <option <?php if(isset($album_id) && $album_id == $v['id']){echo 'selected';}?> value="<?php echo $v['id']?>" ><?php echo $v['name']?></option>
                    <?php endforeach;?>
                    <?php endif?>
                    </select>
                    <input type="hidden"  name="album_id" value="<?php echo $album_id?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">相册图片</label>
                <div class="col-sm-9">
                    <ul id="uploaders_images">
                        <?php if($images):?>
                        <?php foreach ($images as $k => $v):?>
                        <li class="pic pro_gre" style="margin-right: 20px; clear: none">
                            <a class="close del-pic" href="javascript:;"></a>
                            <img src="<?php echo get_img_url($v['thumb'])?>" style="width: 100%; height: 100%">
                            <input type="hidden" name="images[]" value="<?php echo $v['img']?>">
                            <input type="hidden" name="sy_images[]" value="<?php echo $v['sy_img']?>">
                            <input type="hidden" name="ys_images[]" value="<?php echo $v['thumb']?>">
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
    	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
    	                    <a href="javascript:;" class="up-img"  id="btn_images"><span>+</span><br>添加照片</a>
    	                </li>
    	            </ul>
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
	var object = [{"obj": "#uploaders_images", "btn": "#btn_images"}];
	seajs.use(['<?php echo css_js_url('add_file.js', 'admin')?>', 'admin_upload_shuiyin','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
	    a.save(backurl);
	    swfupload.swfupload(object);
	})
</script>

</body>
</html>