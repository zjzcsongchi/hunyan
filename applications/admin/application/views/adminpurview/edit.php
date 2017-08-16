<?php $this->load->view("common/header");?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common/index">首页</a></li>
        <li><a href="/adminspurview"><?php echo $title[0];?></a></li>
        <li><a href=""> 编辑--<?php echo $title[1];?></a></li>
    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span><?php echo $title[1];?></span></div>
    <ul class="forminfo">
        <form method="post">
        <li>
            <label>上级分类<b>*</b></label>
            <select class="dfinput selects" name="parent_id">
                <option value="0">顶级权限</option>
                {if $parent_purviews}
                <?php if($parent_purviews){?>
                    <?php foreach($parent_purviews as $id=>$v){
                            if($v['id'] != $info['id']){
                        ?>
                          <option value="<?php echo $v['id']?>" <?php if($v['id'] == $info['parent_id']){?> selected="true" <?php }?>>
                                   <?php echo  str_repeat("——",$v['level']).$v['name'];?>
                          </option>


                            <?php }} ?>
                <?php }?>
            </select>
        </li>
        <li><label>权限代码</label><input type="text"  value="<?php echo $info['url'];?>" name="url" class="dfinput" /><i><b>*</b></i></li>
        <li><label>权限名称</label><input type="text" value="<?php echo $info['name'];?>" name="name" class="dfinput" /><i><b>*</b></i></li>
        <li><label>排序</label><input type="text"  value="<?php echo $info['sort'];?>" name="sort" class="dfinput" /><i><b>*</b></i></li>
        <li><label>&nbsp;</label><input name="" type="submit" class="btn" value="确定"/></li>
        </form>
    </ul>
</div>
<?php $this->load->view("common/footer");?>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>