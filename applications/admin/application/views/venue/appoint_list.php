<?php for($i = 0; $i < intval($days/6)+1; $i++):?>
<tr>
<?php for($k = $i*6+1; $k <= $i*6+6 && $k <= $days; $k++):?>
   <?php $j = $k < 10 ? '0'.$k : $k; if(isset($appoint_list[$venue_id][$j])):?>
	<td class="success">
		<p class="text-left" <?php if( $appoint_list[$venue_id][$j]['contract_type'] == C('contract_type.yuliu.id')){echo 'style="color:red;"';}?> ><?php echo $year.'年'.$month.'月'.$k.'日'?></p>
		<p class="text-center" <?php if( $appoint_list[$venue_id][$j]['contract_type'] == C('contract_type.yuliu.id')){echo 'style="color:red;"';}?> >已预约 | <?php echo $appoint_list[$venue_id][$j]['venue_type_text']?></p>
		<p class="text-right" <?php if($appoint_list[$venue_id][$j]['contract_type'] == C('contract_type.yuliu.id')){echo 'style="color:red;"';}?> ><?php echo $appoint_list[$venue_id][$j]['roles_main']?>&nbsp;<?php echo $appoint_list[$venue_id][$j]['roles_wife']?></p>
		<p class="text-center">
		<a class="btn btn-primary btn-xs " href="/dinner/show_detail/<?php echo $appoint_list[$venue_id][$j]['id']?>">详情</a>&nbsp;
		<a class="btn btn-primary btn-xs " target="_blank" href="<?php echo $domain['base']['url']?>/bless/index?id=<?php echo $appoint_list[$venue_id][$j]['id']?>">查看大屏</a>&nbsp;
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