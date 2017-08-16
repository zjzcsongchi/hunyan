<?php $this->load->view('common/header2') ?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/admin">管理员列表</a></li>
    <li><a href="<?php echo $_SERVER['HTTP_REFERER']?>">员工信息</a>
    <li class="active">修改员工履历</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend>添加员工履历</legend>
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">履历类型：</label>
                <div class="col-sm-4">
                    <select name="resume_type" class="form-control">
                        <?php foreach ($resume_type as $k => $v):?>
                        <option value="<?php echo $k?>" <?php if($k == $info['resume_type']) echo 'checked';?>><?php echo $v?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">标题：</label>
                <div class="col-sm-4">
                    <input type="text" name="title" class="form-control" value="<?php echo $info['title']?>" valType="required" msg="标题不能为空"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">简介：</label>
                <div class="col-sm-4">
                    <textarea type="text" name="content" class="form-control" ><?php echo $info['content']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">发生时间：</label>
                <div class="col-sm-4">
                    <input type="text" name="occur_time" style="cursor:pointer" value="<?php echo $info['occur_time']?>" class="form-control date" readonly valType="required" msg="请选择发生时间"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">图片：</label>
                <div class="col-sm-10">
                    <ul id="uploaders_images">
                        <?php if($info['images']):?>
        				<?php foreach ($info['images'] as $k => $v):?>
                            <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                                <a class='close del-pic' href='javascript:;'></a>
                                <a href="<?php echo get_img_url($v);?>" target="_blank"><img src="<?php echo get_img_url($v);?>" style='width:100%;height:100%'/></a>
                                <input type="hidden" name="images[]" value="<?php echo $v;?>"/>
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
                <label class="col-sm-2 control-label">备注：</label>
                <div class="col-sm-4">
                    <textarea name="remark" class="form-control" ><?php echo $info['remark']?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 text-center">
                    <button class="btn btn-primary">保 存 <span class="glyphicon glyphicon-floppy-save"></span></button>
                </div>
            </div>
        </form>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
var object = [
              {"obj": "#uploaders_images", "btn": "#btn_images"}
              ];

seajs.use(['admin_uploader','jqvalidate','jqueryswf','swfupload', 'datepicker'], function(swfupload){
	swfupload.swfupload(object);
	$('.date').focus(function(){
	  WdatePicker({dateFmt:'yyyy-MM-dd'});
	})
})

</script>
</body>
</html>
