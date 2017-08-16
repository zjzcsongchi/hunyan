<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/menu/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <a class="btn btn-primary" href="/menu/add_jump">添加订单</a>
    <!-- list -->
    <fieldset>
        <legend><?php echo isset($year) ? $year : ''?>年<?php echo isset($month) ? $month : ''?>月 所有订单</legend>
        
        <table class="table table-striped table-bordered dataTable no-footer" id="table">
            <thead>
                <tr>
                    <th><div style="width:100px">合同编号</div></th>
                    <th><div style="width:70px">宴会日期</div></th>
                    <th>新郎</th>
                    <th>新娘</th>
                    <?php foreach (C('milan_staff_type') as $k => $v):?>
                    <th><?php echo $v['name']?></th>
                    <?php endforeach;?>
                    
                    <th><div style="width:100px">宴会厅</div></th>
                    <th>套系</th>
                    <th>联系人</th>
                    <th><div style="width:90px">联系方式</div></th>
                    <th>主题</th>
                    <th>类型</th>
                    <th>签订合同日期</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr class="other_tr">
                    <td><?php echo isset($v['contract_num']) ? $v['contract_num'] : ''?></td>
                    <td><?php echo isset($v['solar_time']) ? $v['solar_time'] : ''?></td>
                    <td><?php echo isset($v['roles_main']) ? $v['roles_main'] : ''?></td>
                    <td><?php echo isset($v['roles_wife']) ? $v['roles_wife'] : ''?></td>
                    
                    <?php foreach (C('milan_staff_type') as $k2 => $v2):?>
                    <td>
                        <?php if(isset($v['milan_staffs'][$v2['id']])):?>
                            <?php echo $v['milan_staffs'][$v2['id']]['staff_name'] .'-'. $v['milan_staffs'][$v2['id']]['status']?>
                        <?php endif?>
                    </td>
                    <?php endforeach;?>

                    <td><?php echo isset($v['venue_name']) ? $v['venue_name'] : ''?></td>
                    <td><?php echo $v['menus'].(!empty($v['price']) ? '【'.$v['price'].'】' : '')?></td>
                    <td><?php echo isset($v['customer_name']) ? $v['customer_name'] : ''?></td>
                    <td><?php echo isset($v['customer_tel']) ? $v['customer_tel'] : ''?></td>
                    <td><?php echo isset($v['theme']) ? $v['theme'] : ''?></td>
                    <td>
                        <?php foreach (C('party') as $key => $val):?>
                            <?php if($v['venue_id'] == $val['id']):?>
                            <?php echo $val['name'];?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </td>
                    <td><?php echo isset($v['contract_date']) ? $v['contract_date'] : ''?></td>
                    <td>
                    <?php if(isset($v['id'])):?>
                        <a class="btn btn-primary btn-xs" href="/menu/show_detail/<?php echo $v['id']?>">详情</a>
                        <a href="/menu/edit/<?php echo $v['id']?>" class="btn btn-primary btn-xs">修改</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
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
	seajs.use(['<?php echo css_js_url('menu_add.js', 'admin')?>'], function(a){
		a.del();
		a.show_tables();
		a.up_show();
	})
</script>
</body>
</html>
