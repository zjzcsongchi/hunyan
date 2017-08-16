<?php for($i = 0; $i < intval($days/6)+1; $i++):?>
    <tr>
        <?php for($k = $i*6+1; $k <= $i*6+6 && $k <= $days; $k++):?>
            <?php $j = $k < 10 ? '0'.$k : $k; 
            if(isset($appoint_list[$staff_id][$j])):?>
                <td class="success">
                    <p class="text-left"><?php echo $year.'年'.$month.'月'.$k.'日'?></p>
                    <?php foreach ($appoint_list[$staff_id][$j] as $v2):?>
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