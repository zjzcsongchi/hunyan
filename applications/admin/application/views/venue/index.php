<?php $this->load->view('common/header2'); ?>
<ol class="breadcrumb">
  <li><a href="/common">首页</a></li>
  <li><a href="/express/index">场馆管理</a></li>
</ol>

<div class="container-fluid">
    <?php foreach ($list as $v):?>
	<div class="row contain" style="margin-left:10px;">
		<div class="col-sm-5 left" style="height:100%;min-height:400px;border:dashed 1px;">
			<div class="row">
				<h1 class="text-left"><?php echo $v['name']?></h1>
				<p style="display: inline-block;position: absolute;right: 5px;top: 25px;">
					<a href="/venue/album?venue_id=<?php echo $v['id']?>" class="btn btn-primary show_images">相册</a>
					<a href="/venue/modify/<?php echo $v['id']?>" class="btn btn-primary">修改</a>
					<a href="JavaScript:;" class="btn btn-primary del_venue" data-id="<?php echo $v['id']?>">删除</a>
				</p>
			</div>
			<hr>
			<img class="img-rounded" src="<?php echo $v['cover_img']?>" style="height:auto;width:100%">
			<hr>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>楼层：</td>
						<td><?php echo $v['floor']?></td>
					</tr>
					<tr>
						<td>楼层高：</td>
						<td><?php echo $v['height']?></td>
					</tr>
					<tr>
						<td>消费：</td>
						<td><?php echo $v['min_consume']?>~<?php echo $v['max_consume']?></td>
					</tr>
					<tr>
					   <td>适合宴会类型：</td>
					   <td><?php echo $v['fit_type']?></td>
					</tr>
					<tr>
					   <td>容纳人数：</td>
					   <td><?php echo $v['container']?></td>
					</tr>
					<tr>
					   <td>最大桌数：</td>
					   <td><?php echo $v['max_table']?></td>
					</tr>
					<tr>
					   <td>场馆设备：</td>
					   <td><?php echo $v['device']?></td>
					</tr>
					<tr>
					   <td>是否推荐到首页：</td>
					   <td><?php echo $v['is_recommend_text']?></td>
					</tr>
				</tbody>
			</table>
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
				<thead>
				    <tr>
				        <th colspan="6">
				            <div class="form-inline">
				                <input type="text" class="form-control Wdate date" style="height:34px" placeholder="请选择时间"/> 
				                <input type="hidden" class="venue_id" value="<?php echo $v['id']?>"/>
				                <input type="button" class="btn btn-primary date_search" value="切换"/>
				            </div>
				        </th>
				    </tr>
				</thead>
				<tbody>
				    <?php for($i = 0; $i < intval($days/6)+1; $i++):?>
                    <tr>
                    <?php for($k = $i*6+1; $k <= $i*6+6 && $k <= $days; $k++):?>
                       <?php $j = $k < 10 ? '0'.$k : $k; if(isset($v['appoint_list'][$j])):?>
                    	<td class="success">
                    		<p class="text-left" <?php if( $v['appoint_list'][$j]['contract_type'] == C('contract_type.yuliu.id')){echo 'style="color:red;"';}?>><?php echo $year.'年'.$month.'月'.$k.'日'?></p>
                    		<p class="text-center" <?php if( $v['appoint_list'][$j]['contract_type'] == C('contract_type.yuliu.id')){echo 'style="color:red;"';}?>>已预约 | <?php echo $v['appoint_list'][$j]['venue_type_text']?></p>
                    		<p class="text-right" <?php if($v['appoint_list'][$j]['contract_type'] == C('contract_type.yuliu.id')){echo 'style="color:red;"';}?>>
                    		<?php echo $v['appoint_list'][$j]['roles_main']?>&nbsp;
                    		<?php if($v['appoint_list'][$j]['venue_type'] == C('party.wedding.id')):?>
                    		<?php echo $v['appoint_list'][$j]['roles_wife']?>
                    		<?php endif;?>
                    		</p>
                    		<p class="text-center">
                    		<a class="btn btn-primary btn-xs " href="/dinner/show_detail/<?php echo $v['appoint_list'][$j]['id']?>">详情</a>&nbsp;
                    		<a class="btn btn-primary btn-xs " target="_blank" href="<?php echo $domain['base']['url']?>/bless/index?id=<?php echo $v['appoint_list'][$j]['id']?>">查看大屏</a>&nbsp;
                    		</p>
                    	</td>
                    	<?php else:?>
                    	<td class="info">
                    		<p class="text-left"><?php echo $year.'年'.$month.'月'.$k.'日'?></p>
                    		<p class="text-center">未预约</p>
                    		<p class="text-center">
                    		    <a class="btn btn-primary btn-xs detail" href='<?php echo "/dinner/add?year={$year}&month={$month}&day={$k}&venue_id={$venue_id}"?>'>点击预约</a>&nbsp;
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
	<hr>
	<?php endforeach;?>
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