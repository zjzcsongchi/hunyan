<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">系统管理</a></li>
        <li><a href="#">手机端菜单</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<form class="formbody" method="post" id="form">
    <div id="usual1" class="usual"> 
      	<div id="tab1" class="tabson">
            <ul class="forminfo">
            <li><label>父级：</label>
                <select class="dfinput selects" name="pid" style="width:240px">
                    <option value="0">--　顶级　--</option>
                    <?php if(isset($list)):?>
                    <?php foreach ($list as $k =>$v):?>
                        <option value="<?php echo $v['id']?>">--<?php echo $v['title']?>--</option>
                    <?php endforeach;?>
                    <?php endif;?>
                </select>
            </li>
            <li><label>名称</label><input name="title" type="text" class="dfinput"/></li>
            <li><label>URL</label><input name="url" value="/" type="text" class="dfinput"/></li>
            <li><label>排序</label><input name="sort" value="0" placeholder="数值越大越靠前，默认为0" type="text" class="dfinput"/></li>
			<li><label>&nbsp;</label><input  type="submit" class="btn" value="保 存"/></li>
			</ul>
        </div>
    </div> 
</form> 
<?php $this->load->view("common/footer");?>
	</body>
</html>