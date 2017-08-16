<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/news">资讯管理</a></li>
        <li><a href="/news/add">编辑资讯</a></li>
    </ul>
</div>
 
<div class="formbody">
    <div class="formtitle"><span>编辑资讯</span></div>
    <form action="" method="post" >
        <ul class="forminfo">
            <li>
                <label>资讯标题<b>*</b></label>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="text" name="title" class="dfinput" value="<?php echo $info['title'];?>" required valType="required" msg="不能为空"/>
                <i></i>
            </li>
            
            <li><label>发布机构<b>*</b></label><input type="text" name="agency" class="dfinput" value="<?php echo $info['agency'];?>" required valType="required" msg="不能为空"/><i></i></li>
            
            <li>
                <label>视频上传<b></b></label>
                <ul id="uploader_video_url" data-type="video">
            	      <?php if(!empty($info['video_url'])):?>
                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                        <a class="close del-pic" href="javascript:;" style="z-index:1;"></a>
                        <video src="<?php echo get_vedio_url($info['video_url'])?>" controls style="width:100%; height:100%;">视频</video>
                        <input type="hidden" name="video_url" value="<?php echo $info['video_url'];?>"/>
                    </li>
                    <?php endif;?>
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;" >
                        <a href="javascript:;" class="up-img"  id="btn_video_url"><span>+</span><br>添加视频</a>
                    </li>
                </ul>
            </li>
            
            <li>
                <label>封面图<b>*</b></label>
                <ul id="uploader_cover_img">
                    <?php if($info['cover_img']):?>
                    <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                        <a class='close del-pic' href='javascript:;'></a>
                        <a href="<?php echo get_img_url($info['cover_img']);?>" target="_blank"><img src="<?php echo get_img_url($info['cover_img']);?>" style='width:100%;height:100%'/></a>
                        <input type="hidden" name="cover_img" value="<?php echo $info['cover_img'];?>"/>
                    </li>
                    <?php endif;?>
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                        <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
                    </li>
                </ul>
            </li>
            <li><label>排序<b>*</b></label><input type="text" name="sort" class="dfinput" value="<?php echo $info['sort'];?>" required valType="required" msg="不能为空"/><i></i></li>
            <li>
                <label>资讯分类<b>*</b></label>
                <select class="dfinput selects" name="news_class_id" required msg="请选择资讯分类">
                    <option value="">---请选择资讯分类---</option>
                    <?php foreach ($news_class as $key => $val): ?>
                    <option value="<?php echo $val['id'];?>" <?php if($val['id'] == $info['news_class_id']){ echo "selected"; } ?>><?php echo str_repeat('——', $val['level']).$val['name'];?></option>
                    <?php endforeach;?>
                </select>
            </li>
            <li><label>资讯摘要</label><textarea name="summary" class="textinput"><?php echo $info['summary'];?></textarea><i></i></li>
            <li>
                <label>资讯内容</label>
                <script id="editor" type="text/plain" style="float:left;width: 620px;" name="content"><?php echo $info['content'];?></script>
                <div class="edit-img">
                    <ul id="uploader_rich_text_img" data-type="rich_text">
                    </ul>
                    <div class="pic pic-add add-pic" >
                        <a href="javascript:;" class="up-img"  id="file_rich_text_img" style="background: #238ccd;border: solid 1px #238ccd;width:225px;height:40px;border-radius:5px;">添加照片</a>
                    </div>
                </div>
            </li>
            <li>
                <label>是否推荐</label>
                <cite>
                    <input name="is_recommend" type="radio" value="1" <?php if($info['is_recommend'] == 1){ echo "checked='checked'"; }?> />是
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="is_recommend" type="radio" value="0" <?php if($info['is_recommend'] == 0){ echo "checked='checked'"; }?> />否
                </cite>
            </li>
            <li>
                <label>发布时间</label>
                <input name="publish_time" type="text" value="<?php echo $info['publish_time'] ? $info['publish_time'] : date('Y-m-d H:i:s');?>" class="dfinput Wdate" style="height:32px;width:184px" onFocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"/>
                <i></i>
            </li>
            <li><label>SEO标题</label><input name="SEO_title" type="text" class="dfinput" value="<?php if(!empty($keywords)) { echo $keywords['title']; } ?>" /><i></i></li>
            <li><label>SEO关键字</label><input name="SEO_keywords" type="text" class="dfinput" value="<?php if(!empty($keywords)) { echo $keywords['keywords']; } ?>" /><i></i></li>
            <li><label>SEO关键字描述</label><textarea name="SEO_description" class="textinput"><?php if(!empty($keywords)) { echo $keywords['description']; } ?></textarea><i></i></li>
            <li><label>&nbsp;</label><input  type="submit" class="btn J_save" value="保 存"/></li>
        </ul>
    </form>
</div>

<script type="text/javascript" src="<?php echo css_js_url('jquery.min.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('datepicker/WdatePicker.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jquery.swfupload.js', 'common');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('swfupload.js', 'admin')?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('common.js', 'admin');?>"></script>
<script type="text/javascript" src="<?php echo css_js_url('jq.validate.js', 'admin');?>"></script>

<script type="text/javascript" charset="utf-8" src="<?php echo $domain['admin']['url'];?>/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $domain['admin']['url'];?>/ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $domain['admin']['url'];?>/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo css_js_url('selectbox.js','admin');?>"></script>

<script src="<?php echo css_js_url('sea.js','common');?>"></script>
<script type="text/javascript">
var static_url = "<?php echo $domain['img']['url']?>/image/";
  seajs.config({
      base: "<?php echo $domain['static']['url'];?>",
      alias: {
        "admin_uploader": "<?php echo css_js_url('admin_uploader.js', 'admin');?>",
        "admin_upload_shuiyin": "<?php echo css_js_url('admin_upload_shuiyin.js', 'admin');?>"
      }
  });
  var object =[
       {"obj": "#uploader_cover_img", "btn": "#btn_cover_img"},
       {"obj": "#uploader_video_url", "btn": "#btn_video_url", "type":'video'}];

  var obj1 = [{"obj": "#uploader_rich_text_img", "btn" : "#file_rich_text_img", "type": "rich_text"}];
  
   seajs.use(['admin_uploader', 'admin_upload_shuiyin'], function(swfUploader, uploadShuiyin){
       swfUploader.swfupload(object);
       swfUploader.swfupload(obj1);
   })
</script>

<script type="text/javascript">
	var ue = UE.getEditor('editor');
    $(function(){
        $(".Wdate").focus(function(){
            WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})
        });
        
    });
    selectbox('.selects');
</script>

</body>
</html>