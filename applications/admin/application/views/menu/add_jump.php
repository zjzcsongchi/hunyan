<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <hr>
    <!-- search -->
    <form class="form-inline" method="get" action="/menu/search_list">
        <div class="form-group">
            <label class="control-label">日期：</label>
            <input type="text" name="time" class="form-control Cdate" placeholder="请输入日期">
        </div>
    
        <div class="form-group">
            <label class="control-label">姓名：</label>
            <input type="text" name="name" class="form-control" placeholder="请输入客户姓名/新郎姓名/新娘姓名" style="width:250px">
        </div>
        <div class="form-group">
            <label class="control-label">手机号：</label>
            <input type="text" name="mobile_phone" class="form-control" placeholder="请输入客户手机号">
        </div>
        <button class="btn btn-primary" type="submit">搜索</button>
    </form>
    <hr>
</div>
<?php $this->load->view('common/footer') ?>
<script>
seajs.use(['<?php echo css_js_url('menu.js', 'admin')?>'], function(a){
	 <?php if(isset($min_date) && isset($max_date)):?>
	    a.datepick(<?php echo $min_date?>, <?php echo $max_date?>);
	    <?php else:?>
	    a.datepick();
	    <?php endif;?>
})
</script>

</body>
</html>