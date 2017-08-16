<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/add">菜品列表</a></li>
        <li><a href="javascript:;">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>添加菜品</span></div>
    <ul class="forminfo">
         <li>
            <label>菜系:</label>
            <select class="dfinput selects" name="class_id" style="width: 150px">
                <option value="">----请选择菜系----</option>
                <?php foreach ($dish_class as $key => $val): ?>
                <option  value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                <?php endforeach;?>
            </select>
        </li>
        <li><label>菜品名称</label><input name="name" type="text" class="dfinput" required/><b>*</b></li>
        <li><label>价格</label><input name="price" type="text" class="dfinput" required/><b>*</b></li>
        <li><label>推荐</label><input name="is_recommend" type="radio"  value="0" checked="checked"  required />不推荐
            <input name="is_recommend" type="radio" value="1" required />推荐
        <li>
            <label>封面图</label>
            <ul id="uploader_cover_img">
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        <li><label>&nbsp;</label><input  type="submit" class="btn" value="确认保存"/></li>
    </ul>
    </form>
</div>
<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jquery.swfupload.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('swfupload.js', 'admin')?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('admin_upload.js', 'admin');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('dialog.js', 'admin');?>"></script>
<script src="<?php echo css_js_url('jq.validate.js','admin');?>"></script>

<?php $this->load->view('common/footer');?>
<script>
     $("form").submit(function(e){
    	 e.preventDefault();
    	 var post_arr_data = $("form").serializeArray();
    	 $.post("",{arr:post_arr_data},function(data){
  			if(data.status == 0){
  				showDialog(data.msg, '', '/dish');
  			}else{
  				showDialog(data.msg);
  			}
  			
  		  });
     })
     
     //弹框函数
    function showDialog(msg, title, url){
        var title = arguments[1] ? arguments[1] : '提示信息';
        var url = arguments[2] ? arguments[2] : '';
        var d = dialog({
            title: title,
            content: msg,
            modal:false,
            okValue: '确定',
            ok: function () {
                if(url != '')
                {
                    window.location.href=url;
                }
                return true;
            }
        });
        d.width(320);
        d.show();
}
</script>
</body>
</html>