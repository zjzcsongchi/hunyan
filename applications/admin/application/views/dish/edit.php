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
                <option  value="<?php echo $val['id'];?>" <?php if($val['id'] == $info['class_id']):?> selected="selected"<?php endif;?>><?php echo $val['name'];?></option>
                <?php endforeach;?>
            </select>
        </li>
        <li><label>菜品名称</label><input name="name" type="text" class="dfinput" required value="<?php echo $info['name']?>" /><b>*</b></li>
        <li><label>价格</label><input name="price" type="text" class="dfinput" required value="<?php echo $info['price']?>" /><b>*</b></li>
        <li><label>推荐</label><input name="is_recommend" type="radio"  value="0" <?php if($info['is_recommend'] == 0):?> checked="checked"<?php endif;?> required />不推荐
            <input name="is_recommend" type="radio" value="1" <?php if($info['is_recommend'] == 1):?> checked="checked"<?php endif;?> required />推荐
      
      <li>
            <label>头像</label>
            <ul id="uploader_cover_img">
                <?php if($info['cover_img']):?>
                <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                    <a class='close del-pic' href='javascript:;'></a>
                    <a href="<?php echo $info['cover_img'];?>" target="_blank"><img src="<?php echo get_img_url($info['cover_img']);?>" style='width:100%;height:100%'/></a>
                    <input type="hidden" name="cover_img" value="<?php echo $info['cover_img'];?>"/>
                </li>
                <?php endif;?>
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

</body>
</html>