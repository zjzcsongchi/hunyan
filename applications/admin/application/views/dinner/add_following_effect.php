<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <?php foreach ($title as $k => $v):?>
    <li><a href="<?php echo $v['url']?>"><?php echo $v['text']?></a></li>
    <?php endforeach;?>
</ol>

<div class="container-fluid">
    <fieldset>
        <legend>最美跟拍相片</legend>
        <form class="form-horizontal">
            <input type="hidden" name="id" value="<?php echo $info['id']?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">上传图片</label>
                <div class="col-sm-9">
                    <ul id="uploaders_following_effects">
                        <?php if($info['following_effect']):?>
                        <?php foreach ($info['following_effect'] as $k => $v):?>
                        <li class="pic pro_gre" style="margin-right: 20px; clear: none">
                            <a class="close del-pic" href="javascript:;"></a>
                            <img src="<?php echo get_img_url($v)?>" style="width: 100%; height: 100%">
                            <input type="hidden" name="yt_following_effects[]" value="<?php echo $v?>">
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
	var object = [{"obj": "#uploaders_following_effects", "btn": "#btn_images"}];
	seajs.use(['<?php echo css_js_url('add_following_effect.js', 'admin')?>', 'admin_upload_shuiyin','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
	    a.save(backurl);
	    swfupload.swfupload(object);
	})
</script>

</body>
</html>