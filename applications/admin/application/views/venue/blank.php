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
        				<?php for($i = 0; $i < intval(count($list[$k])/6)+1; $i++):?>
                            <tr>
                               <?php for($j = $i*6; $j < $i*6+6 && $j < count($list[$k]); $j++):?>
                               <?php 
                                    $day = explode('-', $list[$k][$j]['solar_time']);
                                    $day[2] = preg_replace('/^0*/', '', $day[2]);
                               
                               ?>
                               <?php if(isset($list[$k][$j]['dinner_id'])):?>
                            	<td class="info">
                            		<p class="text-left" style="color: red;font-weight:bold"><?php echo $list[$k][$j]['solar_time']?></p>
                            		<p class="text-center" style="color: red;font-weight:bold">预留</p>
                            		<p class="text-center">
                            		    <a class="btn btn-primary btn-xs detail" href='<?php echo "/dinner/edit/{$list[$k][$j]['dinner_id']}"?>' style="background-color:red">修改</a>&nbsp;
                            		</p>
                            	</td>
                            	<?php else:?>
                            	<td class="info">
                            		<p class="text-left"><?php echo $list[$k][$j]['solar_time']?></p>
                            		<p class="text-center">未预约</p>
                            		<p class="text-center">
                            		    <a class="btn btn-primary btn-xs detail" href='<?php echo "/dinner/add?year={$year}&month={$month}&day={$day[2]}&venue_id={$k}"?>'>点击预约</a>&nbsp;
                            		</p>
                            	</td>
                            	<?php endif;?>
                            	<?php endfor;?>
                            </tr>
                        <?php endfor;?>
        				</tbody>
        				
        				
        			</table>
        		</div>
        	</div>
        	</div>
        	<hr>
        	<?php endif;?>
        	<?php endforeach;?>
        	<?php elseif(isset($full) && ($full == 1)):?>
        	<?php else:?>
        	<?php foreach ($venue_name as $key=>$val):?>
            	   <div class="row contain" style="margin-left:10px;">
            		<div class="col-sm-5 left" style="height:100%;min-height:400px;border:dashed 1px;  width:400px">
            			<div class="row">
            				<h1 class="text-left"><?php echo $venue_name[$key]?></h1>
            			</div>
            			<hr>
            			<img class="img-rounded" src="<?php echo get_img_url($venue_img[$key])?>" style="height:auto;width:100%">
            			<hr>
            		</div>
            		<div class="col-sm-7 right" style="min-height:400px">
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
            				<?php for($i = 0; $i < intval($days/6)+1; $i++):?>
                                <tr>
            				 <?php for($kk = $i*6+1; $kk <= $i*6+6 && $kk <= $days; $kk++):?>
                                   <?php $j = $kk < 10 ? '0'.$kk : $kk; ?>
                                	<td class="info">
                                		<p class="text-left"><?php echo $year.'年'.$month.'月'.$j.'日'?></p>
                                		<p class="text-center">未预约</p>
                                		<p class="text-center">
                                		    <a class="btn btn-primary btn-xs detail" href='<?php echo "/dinner/add?year={$year}&month={$month}&day={$kk}&venue_id={$key}"?>'>点击预约</a>&nbsp;
                                		</p>
                                	</td>
                                <?php endfor;?>
                                </tr>
            				
            				<?php endfor;?>
            				
            				</tbody>
            			</table>
            		</div>
            	</div>
            	<br>
            	<?php endforeach;?>
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