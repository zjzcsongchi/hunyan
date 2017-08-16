<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/dinner/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
   
    <!-- list -->
    <fieldset>
        <legend>百年婚宴订单</legend>
        
        <table class="hover table table-striped table-bordered dataTable" id="table">
            <thead>
                <tr>
                    <th><div style="width:70px">宴会日期</div></th>
                    
                    <th>联系人</th>
                    <th>新郎/宴会主角</th>
                    <th>新娘</th>
                    <th><div style="width:40px">桌数</div></th>
                    <th>类型</th>
                    <th>司仪</th>
                    <th>餐标</th>
                    <th><div style="width:100px">宴会厅</div></th>
                    
                    <th>接单人</th>
                    <th>下单日期</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr class="other_tr">
                  
                    <td><?php echo isset($v['solar_time']) ? $v['solar_time'] : ''?><br><?php echo isset($v['lunar_time']) ? $v['lunar_time'] : ''?></td>
                   
                    <td><?php echo isset($v['customer_name']) ? $v['customer_name'] : ''?><br><?php echo isset($v['customer_mobile']) ? $v['customer_mobile'] : ''?></td>
                    <td><?php echo isset($v['roles_main']) ? $v['roles_main'] : ''?></td>
                    <td><?php echo isset($v['roles_wife']) ? $v['roles_wife'] : ''?></td>
                    <td><?php echo isset($v['menus_count']) ? $v['menus_count'] : ''?>/<?php echo isset($v['promise_count']) ? $v['promise_count'] : ''?></td>
                    <td>
                        <?php
                            foreach (C('party') as $key => $val){
                                if($v['venue_type'] == $val['id']){
                                    echo $val['name'];
                                }
                            }
                        ?>
                    </td>
                    <td><?php echo isset($v['mc_need']) ? $v['mc_need'] : ''?><br><?php echo isset($v['mc_remark']) ? $v['mc_remark'] : ''?></td>
                    <td><?php echo isset($v['menus_name']) ? $v['menus_name'] : ''?></td>
                    <td><?php echo isset($v['venue_name']) ? $v['venue_name'] : ''?></td>
                    
                  
        	
                    <td><?php echo isset($v['receiver']) ? $v['receiver'] : ''?></td>
                    <td><?php echo isset($v['create_time']) ? $v['create_time'] : ''?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/dinner/show_detail/<?php echo $v['id']?>">详情</a>
                        <?php if(empty($v['milan_menu_id'])):?>    
                            <a href="/menu/add/<?php echo $v['id']?>" class="btn btn-primary btn-xs">添加订单</a>
                        <?php else:?>
                            <a href="/menu/edit/<?php echo $v['milan_menu_id']?>" class="btn btn-warning btn-xs">修改订单</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('dinner.js', 'admin')?>'], function(a){
		a.del();
		a.show_tables2();
		a.up_show();
	})
</script>
</body>
</html>
