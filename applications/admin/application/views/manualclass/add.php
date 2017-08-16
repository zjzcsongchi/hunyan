<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">手工位管理</a></li>
        <li><a href="#">手工位名称</a></li>
        <li><a href="#">添加</a></li>
    </ul>
</div>

<form class="formbody" method="post" id="form" action="/manualclass/add"> 
    <div id="usual1" class="usual"> 
      	<div id="tab1" class="tabson">
            <ul class="forminfo">
            <li><label>名称</label><input name="name" type="text" class="dfinput" required/></li>
            <li><label>排序</label><input name="sort" type="text" class="dfinput" value="0"/></li>
            <li>
                <label>状态</label>
                <cite>
                    <input type="radio" name="is_del" value="1"  checked="true">正常
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="is_del" value="2"  >删除
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