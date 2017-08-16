<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">酒水商城</a></li>
        <li><a href="#">酒水分类</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<form class="formbody" method="post" id="form" action="/drinkclass/add"> 
    <div id="usual1" class="usual"> 
      	<div id="tab1" class="tabson">
            <ul class="forminfo">
            <li><label>中文名称</label><input name="cn_name" type="text" class="dfinput" required/><b>*</b></li>
            <li><label>英文名称</label><input name="en_name" type="text" class="dfinput" required/><b>*</b></li>
            <li><label>简介</label><textarea name="summary" class="textinput"></textarea></li>
            <li><label>排序</label><input name="sort" type="text" class="dfinput" value="0"/></li>
			<li><label>&nbsp;</label><input name="" type="submit" class="btn" value="保 存"/></li>
			</ul>
        </div>
    </div> 
</form> 
<?php $this->load->view("common/footer");?>
	</body>
</html>