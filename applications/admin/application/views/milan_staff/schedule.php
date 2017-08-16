<?php $this->load->view('common/header2'); ?>
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="/milanstaff">档期管理</a></li>
</ol>

<div class="container-fluid">
    <?php foreach ($list as $v):?>
	<div class="row contain" style="margin-left:10px;">
		<div class="col-sm-12" style="height:100%;">
			<div class="row">
				<h1 class="text-left"></h1>
			</div>

			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>姓名：</td>
						<td><?php echo $v['fullname']?></td>
					</tr>
					<tr>
					  <td>职务：</td>
						<td><?php echo $v['type']?></td>
					</tr>
					<tr>
						<td>手机号：</td>
						<td><?php echo $v['tel']?:'未填写' ?></td>
					</tr>
					
				</tbody>
			</table>
		</div>
		<div class="col-sm-12" style="min-height:400px">
			<table class="table table-bordered" style="margin-bottom:0">
				<colgroup>
					<col style="width:16%;height:50px;"></col>
					<col style="width:16%"></col>
					<col style="width:16%"></col>
					<col style="width:16%"></col>
					<col style="width:16%"></col>
					<col style="width:16%"></col>
				</colgroup>
				<thead>
				    <tr>
				        <th colspan="6">
				            <div class="form-inline">
				                <input type="text" class="form-control Wdate date" style="height:34px" placeholder="请选择时间"/> 
				                <input type="hidden" class="staff_id" value="<?php echo $v['id']?>"/>
				                <input type="button" class="btn btn-primary date_search" value="切换"/>
				            </div>
				        </th>
				    </tr>
				</thead>
				<tbody>
				    <?php for($i = 0; $i < intval($days/6)+1; $i++):?>
                <tr>
                    <?php for($k = $i*6+1; $k <= $i*6+6 && $k <= $days; $k++):?>
                        <?php $j = $k < 10 ? '0'.$k : $k; 
                        if(isset($v['appoint_list'][$j])):?>
                            <td class="success">
                                <p class="text-left"><?php echo $year.'年'.$month.'月'.$k.'日'?></p>
                                <?php foreach ($v['appoint_list'][$j] as $v2):?>
                                    <p class="text-center" <?php echo $v2['status'] !=1 ? 'style="color:red;"' : 'style="color:green;"' ;?> >
                                        <?php echo $v2['venue'].'：'. $appoint_status[$v2['status']] ?>
                                    </p>
                                <?php endforeach;?>
                            </td>
                        <?php else:?>
                            <td class="info">
                            	<p class="text-left"><?php echo $year.'年'.$month.'月'.$k.'日'?></p>
                            	<p class="text-center">无档期</p>
                            </td>
                        <?php endif;?>
                    <?php endfor;?>
                </tr>
            <?php endfor;?>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<?php endforeach;?>
</div>
<?php $this->load->view('common/footer') ?>
<script>
seajs.use(['<?php echo css_js_url('milanstaff.js', 'admin')?>'], function(a){
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