<thead>
<tr>
    <th>
        <div class="form-inline">
        <a class="btn btn-primary btn-xs " ><?php echo $admin['fullname']?></a>
        <input type="text" class="form-control" style="width:91px; border:1px solid #ccc;border-radius:4px;display:none" >
        <a class="close"></a>
        </div>
    </th>
</tr>
</thead>
<tbody>
    <?php for($i = 0; $i < intval($days/6)+1; $i++):?>
    <tr>
    <?php for($k = $i*6+1; $k <= $i*6+6 && $k <= $days; $k++):?>
    <?php if(isset($list[$k]) && $list[$k]):?>
    	<td class="success" style="background-color:#dff0d8; border-width:1px;border-style:solid;border-color:rgb(221, 221, 221);padding:8px;" >
    		<p class="text-left" ><?php echo $list[$k]['time']?></p>
    		<p class="text-center" ><?php if($list[$k]['is_full']):?><a class="btn btn-danger btn-xs " >已预约</a><a class="btn btn-danger btn-xs " ><?php echo isset($count[$list[$k]['time']]) && $count[$list[$k]['time']] ? $count[$list[$k]['time']].'场': ''?></a><?php else:?><a class="btn btn-primary btn-xs " >空挡</a><?php endif;?></p>
    		<p class="text-right" ></p>&nbsp;
    	</td>
	<?php endif;?>
    	<?php endfor;?>
    </tr>
    <?php endfor;?>
</tbody>
