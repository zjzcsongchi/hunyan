<?php $this->load->view('common/header2'); ?>
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="/express/index">场馆管理</a></li>
</ol>
<div class="container-fluid">
        <?php if(isset($list) && $list):?>
        
        <?php foreach ($venue_name as $k=>$v):?>
            <?php if(isset($list[$k])):?>
        	<div class="row contain" style="margin-left:10px;">
        		<div class="col-sm-5 left" style="height:100%;min-height:200px;border:dashed 1px; width:400px">
        			<div class="row">
        				<h1 class="text-left"><?php echo $venue_name[$k]?></h1>
        			</div>
        			<hr>
        			<img class="img-rounded" src="<?php echo get_img_url($venue_img[$k])?>" style="height:auto;width:100%">
        			<hr>
        		</div>
        		<?php if(!$post_day):?>
        		<div class="col-sm-7 right" style="min-height:400px">
        		<?php else:?>
        		<div class="col-sm-2 right" style="min-height:400px">
        		<?php endif;?>
        			<table class="table table-bordered" style="margin-bottom:0">
        				<colgroup>
        					<col style="width:16%;height:50px;"></col>
        					<col style="width:16%"></col>
        					<col style="width:16%"></col>
        					<col style="width:16%"></col>
        					<col style="width:16%"></col>
        					<col style="width:16%"></col>
        				</colgroup>
        				
        				<tbody>
        				
                            <tr>
                            <?php foreach ($list[$k] as $key=>$val):?>
                            	<td class="info">
                            		<p class="text-left"><?php echo $val['solar_time']?> </p>
                            		<p class="text-center">预留</p>
                            		<p class="text-center">
                            		    <a class="btn btn-primary btn-xs detail" href='<?php echo "/dinner/edit/{$val['dinner_id']}"?>'>点击修改</a>&nbsp;
                            		</p>
                            	</td>
                        	<?php endforeach;?>
                            </tr>
                        
        				</tbody>
        				
        				
        			</table>
        		</div>
        	</div>
        	</div>
        	<hr>
        	<?php endif;?>
        	<?php endforeach;?>
        	<?php else:?>
        	<?php endif;?>
    
</div>
<?php $this->load->view('common/footer') ?>
<script>
seajs.use(['<?php echo css_js_url('venue.js', 'admin')?>'], function(a){
	a.height_auto();
	a.index_datepick();
	a.change_date();
	a.show_images();
	a.show_big_img();
	a.del_venue();
	a.show_detail();
})
</script>
</body>
</html>