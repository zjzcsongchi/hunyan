<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">菜系管理</a></li>
        <li><a href="#">菜系名称</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<form class="formbody" method="post" id="form" action="/dishclass/edit"> 
    <div id="usual1" class="usual"> 
      	<div id="tab1" class="tabson">
            <ul class="forminfo">
            <li><label>名称</label><input name="name" type="text" class="dfinput" required value="<?php echo $info['name']?>" /></li>
            <li><label>排序</label><input name="sort" type="text" class="dfinput" value="<?php echo $info['sort']?>" /></li>
            <input name="id" type="hidden" class="dfinput" value="<?php echo $info['id']?>" />
            <li>
                <label>状态</label>
                <cite>
                    <input type="radio" name="is_del" value="0"  <?php if($info['is_del'] == 0):?>checked="true"<?php endif;?>>正常
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="is_del" value="1"  <?php if($info['is_del'] == 1):?>checked="true"<?php endif;?>>删除
                </cite>
			</li>
			<li><label>&nbsp;</label><input name="" type="submit" class="btn" value="保 存"/></li>
			</ul>
        </div>
    </div> 
</form> 
<?php $this->load->view("common/footer");?>
	</body>
</html>