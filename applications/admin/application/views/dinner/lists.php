<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/dinner/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <a class="btn btn-primary" href="/dinner/add?year=<?php echo isset($year) ? $year : ''?>&month=<?php echo isset($month) ? $month : ''?>">添加订单</a>
    
    <a class="btn btn-default" style="margin-left: 50px;" href="/dinner/lists?year=<?php echo isset($year) ? $year : ''?>&month=<?php echo isset($month) ? $month : ''?>">全部订单</a>
    <?php foreach (C('dinner_extend') as $k => $v):?>
        <a class="btn btn-default" href="/dinner/lists?dinner_extend=<?php echo $v['id'];?>&year=<?php echo isset($year) ? $year : ''?>&month=<?php echo isset($month) ? $month : ''?>"><?php echo $v['name'].'订单'?></a>
    <?php endforeach;?>
    
    <!-- list -->
    <fieldset>

        <legend><?php echo isset($year) ? $year : ''?>年<?php echo isset($month) ? $month : ''?>月</legend>
        
        <table class="table table-striped table-bordered dataTable" id="table">
            <thead>
                <tr>
                    <th><div style="width:100px">合同编号</div></th>
                    <th><div style="width:70px">宴会日期</div></th>
                    <th>联系人</th>
                    <th><div style="width:50px">桌数</div></th>
                    <th>餐标</th>
                    <th><div style="width:100px">宴会厅</div></th>
                    <th>订金</th>
                    <th><div style="width:30px">备注</div></th>
                    <th>麻将</th>
                    <th>接单人</th>
                    <th>合同日期</th>
                    <th>推送状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php $temp_time = $list[0]['solar_time']; $temp_color=false; foreach ($list as $k => $v):?>
                <tr >
                    <td style="width:15%"><?php echo isset($v['contract_num']) ? $v['contract_num'] : ''?><br><?php echo $v['contract_type_text'] ?></td>
                    <td><?php echo isset($v['solar_time']) ? $v['solar_time'] : ''?><br><?php echo isset($v['lunar_time']) ? $v['lunar_time'] : ''?><br><?php echo isset($v['week']) ? $v['week'] : ''?></td>
                    <td><?php echo isset($v['customer_name']) ? $v['customer_name'] : ''?><br><?php echo isset($v['customer_mobile']) ? $v['customer_mobile'] : ''?></td>
                    <td><?php echo isset($v['menus_count']) ? '预定'.$v['menus_count'].'桌' : ''?>/<?php echo isset($v['promise_count']) ? '保证'.$v['promise_count'].'桌' : ''?></td>
                    <td><?php echo isset($v['menus_name']) ? $v['menus_name'] : ''?></td>
                    <td><?php echo isset($v['venue_name']) ? $v['venue_name'] : ''?><br><?php echo isset($v['dinner_type_text']) ? $v['dinner_type_text'] : ''?></td>
                    <td><?php echo isset($v['deposit']) ? $v['deposit'] : ''?></td>
        		    <td style="width:20%"><?php echo isset($v['remark']) ? $v['remark'] : ''?></td>
        		    <td><?php echo isset($v['chess_card']) ? $v['chess_card'] : ''?></td>
                    <td><?php echo isset($v['receiver']) ? $v['receiver'] : ''?></td>
                    <td><?php echo isset($v['contract_date']) ? $v['contract_date'] : ''?></td>
                    <td>
                    <?php if($v['is_send_menu'] || $v['is_send_egg'] || $v['is_send_noodle']):?>
                                                    已推送(<?php if($v['is_send_menu']):?>菜单&nbsp;<?php endif;?><?php if($v['is_send_egg']):?>鸡蛋&nbsp;<?php endif;?><?php if($v['is_send_noodle']):?>米粉&nbsp;<?php endif;?>)
                    <?php else:?>
                                                   未推送
                    <?php endif;?>
                    </td>
                    <td>
                    <?php if(isset($v['id'])):?>
                        <a data-id="<?php echo $v['id']?>" class="btn btn-primary btn-xs detail">详情</a>
                        <a class="btn btn-primary btn-xs" href="/dinner/album?dinner_id=<?php echo $v['id']?>">相册</a>
                        <a data-id="<?php echo $v['id']?>" class="btn btn-primary btn-xs edit">修改</a>
                        <a data-id="<?php echo $v['id'] ?>" data-is_send_menu="<?php echo $v['is_send_menu'] ?>" data-is_send_egg="<?php echo $v['is_send_egg'] ?>" data-is_send_noodle="<?php echo $v['is_send_noodle'] ?>" class="btn btn-primary btn-xs push">推送</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">异常</a>
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
		a.show_tables();
		a.up_show();
		a.examination();

		a.go_to_edit();
		a.go_to_detail();
        a.push();
	})
</script>
</body>
</html>
