<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/manual">手工位内容</a></li>
        <li><a href="javascript:;">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>手工内容</span></div>
    <ul class="forminfo">
        <li>
            <label>手工位置<b>*</b></label>
            <select class="dfinput selects" name="manual_class_id">
            <option value="">---请选择手工位置---</option>
             <?php foreach ($manual_class as $k=>$v) :?>
                        <option value="<?php echo $v['id']?>" <?php if($v['id']==$manual_class_id):?>selected="true"<?php endif;?>><?php echo $v['name']?></option>
             <?php endforeach;?>
            </select>
        </li>
        <li><label>标题</label><input name="title" type="text" class="dfinput" valType="required" msg="不能为空"/><i></i></li>
        <li><label>链接地址</label><input name="url" type="text" class="dfinput" /><i></i></li>
        <li>
            <label>导读图片<b>*</b></label>
            <ul id="uploader_img_url">
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="btn_img_url"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        <li>
            <label>导读视频</label>
            <ul id="uploader_video" data-type="video">
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="btn_video"><span>+</span><br>添加视频</a>
                </li>
            </ul>
        </li>
        
        <li>
            <label>排序</label>
            <input name="sort" type="text" class="dfinput" value="0"/><i></i>
        </li>
        
        <li>
            <label>简介</label>
            <textarea name="summary" class="textinput" maxlength="255"></textarea>
        </li>

        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
</div>
<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jquery.swfupload.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('swfupload.js', 'admin')?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('common.js', 'admin');?>"></script>
<script src="<?php echo css_js_url('jq.validate.js','admin');?>"></script>

<script src="<?php echo css_js_url('sea.js','common');?>"></script>
<script type="text/javascript">
  seajs.config({
      base: "<?php echo $domain['static']['url'];?>",
      alias: {
        "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
      }
  });
  var object =[
       {"obj": "#uploader_img_url", "btn": "#btn_img_url"},
       {"obj": "#uploader_video", "btn": "#btn_video", "type":'video'},

   ];
  
   seajs.use(['admin_uploader'], function(swfUploader){
       swfUploader.swfupload(object);
   })
</script>

<?php $this->load->view('common/footer');?>

</body>
</html>