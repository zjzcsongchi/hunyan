<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">系统管理</a></li>
        <li><a href="/followingshot">相册管理</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<div class="formbody">
<form  method="post" id="form">
    <div class="formtitle"><span>编辑</span></div>
    <ul class="forminfo">
        <li>
            <label>相册标题</label>
            <input name="title" type="text" class="dfinput" value="" valType="required" msg="不能为空"/><i></i>
        </li>
        <li>
            <label>相册简介</label>
            <textarea name="desc" type="text" class="textinput"  valType="required" msg="不能为空"/></textarea><i></i>
        </li>
        <li>
            <label>相册封面图<b>*</b></label>
            <ul id="uploader_cover_img">
            <?php if(isset($info['cover_img'])):?>
                <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                    <a class='close del-pic' href='javascript:;'></a>
                    <a href="<?php echo get_img_url($info['cover_img']);?>" target="_blank"><img src="<?php echo get_img_url($info['cover_img']);?>" style='width:100%;height:100%'/></a>
                    <input type="hidden" name="cover_img" />
                </li>
                <?php endif;?>
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="file_cover_img"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        <li>
            <label>相册<b>*</b></label>
            <ul id="uploader_theme_img">
            <?php if(isset($info['images'])):?>
                <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                    <a class='close del-pic' href='javascript:;'></a>
                    <a href="<?php echo get_img_url($info['images']);?>" target="_blank"><img src="<?php echo get_img_url($info['images']);?>" style='width:100%;height:100%'/></a>
                    <input type="hidden" name="theme_img" value="<?php echo $info['images'];?>"/>
                </li>
                <?php endif;?>
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="file_theme_img"><span>+</span><br>添加照片</a>
                </li>
            </ul>
        </li>
        
        <li>
            <label>视频</label>
            <ul id="uploader_video" data-type="video">
                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                    <a href="javascript:;" class="up-img"  id="btn_video"><span>+</span><br>添加视频</a>
                </li>
            </ul>
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
<script src="<?php echo css_js_url('dialog.js','admin');?>"></script>

<script src="<?php echo css_js_url('sea.js','common');?>"></script>
<script type="text/javascript">
  seajs.config({
      base: "<?php echo $domain['static']['url'];?>",
      alias: {
        "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
      }
  });
  var object =[
       {"obj": "#uploader_cover_img", "btn": "#file_cover_img"},
       {"obj": "#uploader_theme_img", "btn": "#file_theme_img"},
       {"obj": "#uploader_video", "btn": "#btn_video", "type":'video'},
   ];
  
   seajs.use(['admin_uploader'], function(swfUploader){
       swfUploader.swfupload(object);
   })
</script>


<script type="text/javascript">
$("form").submit(function(e){
	 e.preventDefault();
	 var post_arr_data = $("form").serializeArray();
	 $.post("",{arr:post_arr_data},function(data){
			if(data.status == 0){
				showDialog(data.msg, '', '/followingshot');
			}else{
				showDialog(data.msg);
			}
			
	  });

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
})
    
</script>
</body>
</html>