<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/consume/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="row" style="margin: 10px 30px;">
    <form class="form-inline">
        <div class="form-group">
            <label>是否已付款：</label>
            <select class="form-control" name="is_pay" >
                <option value="2">请选择</option>
                <option value="0" <?php if (isset($_GET['is_pay']) &&  $_GET['is_pay']  == 0){echo "selected";} ?>>未付款</option>
                <option value="1" <?php if (isset($_GET['is_pay']) &&  $_GET['is_pay']  == 1){echo "selected";} ?>>已付款</option>
            </select>
        </div>
        <div class="form-group">
            <label>宴会大厅：</label>
            <select name="venue_name" class="form-control">
                <option value="2">请选择</option>
                <?php
                foreach ($venue_list as $venue) {
                    if ($venue['name'] == @$_GET['venue_name']) {
                        echo "<option selected>".$venue['name']."</option>";
                    }else{
                        echo "<option>".$venue['name'] ."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>姓名：</label>
            <input type="text" name="name" class="form-control" style="height: 34px;" value="<?php echo @$_GET['name']?>">
        </div>
        <div class="form-group">
            <label>酒席时间：</label>
            <input type="date" name="solar_time" class="form-control" style="height: 34px;" value="<?php echo @$_GET['solar_time']?>">
        </div>
       <!-- <div class="form-group">
            <label>&nbsp;&nbsp;按50%结算桌数：</label>
            <select class="form-control" name="is_half" >
                <option value="2">请选择</option>
                <?php
/*                    for ($i=5; $i <= 10; $i++) {
                        $temp = ($i*10);
                        if (@$_GET['is_half'] == $temp) {
                            echo "<option value='{$temp}' selected>{$temp}%</option>";
                        } else {
                            echo "<option value='{$temp}'>{$temp}%</option>";
                        }
                    }
                */?>
            </select>
        </div>-->
       <?php if (!empty($_GET['month'])):?>
           <input type="hidden" name="year" value="<?php echo @$_GET['year']?>"/>
           <input type="hidden" name="month" value="<?php echo @$_GET['month']?>"/>
        <?php endif;?>
        <button class="btn btn-primary" type="submit">搜索</button>
    </form>
</div>

<div class="container-fluid" style="margin:10px">
    
    <!-- list -->
    <fieldset>

        <legend><?php echo isset($year) ? $year : ''?>年<?php echo isset($month) ? $month : ''?>月<?php echo isset($day) ? $day . "日": ''?></legend>
        
        <table class="table table-bordered table-hover" id="table">
            <thead>
                <tr class="bg-info">
                    <th>序号</th>
                    <th>客户姓名</th>
                    <th>客户电话</th>
                    <th>宴会大厅</th>
                    <th>消费日期</th>
                    <th>订金</th>
                    <th>餐标</th>
                    <th>结账桌数</th>
                    <th>费用总计</th>
                    <th>优惠</th>
                    <th>实际支付费用</th>
                    <th>是否付款</th>
                    <th>是否补吃</th>
                    <th>按50%结算桌数</th>
                    <th>结账时间</th>
                    <th>备注</th>
                    <th>签字时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach($list as $k => $v): ?>
                <tr >
                    <td><?php echo $k+1 ?></td>
                    <td><?php echo $v['dinner_info']['customer_name'] ?></td>
                    <td><?php echo $v['dinner_info']['customer_mobile'] ?></td>
                    <td><?php echo $v['dinner_info']['venue_name'] ?></td>
                    <td><?php echo $v['dinner_info']['solar_time'] ?></td>
                    <td><?php echo $v['dinner_info']['deposit'] ?></td>
                    <td><?php echo $v['dinner_info']['menus_name'] ?></td>
                    <td><?php echo $v['menus_count'] ?></td>
                    <td><?php echo $v['all_fee'] ?></td>
                    <td><?php echo $v['preferentail_fee'] ?></td>
                    <td><?php echo $v['actual_fee'] ?></td>
                    <?php
                        if ($v['is_pay'] == 0) {
                            echo "<td style='color: red;'>未付款</td>";
                        } else {
                            echo "<td style='color: green;'>已付款</td>";
                        }
                        if ($v['is_addeat'] == 0) {
                            echo "<td style='color: red;'>否</td>";
                        } else {
                            echo "<td style='color: green;'>是</td>";
                        }
                    ?>
                    <td><?php  if($v['is_half']==0) { echo "否";}else{echo $v['is_half'];} ?></td>
                    <td><?php echo $v['checkout_time'] ?></td>
                    <td style="width:200px;"><?php echo $v['remark'] ?></td>
                    <td><?php echo $v['sign_time']; ?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/consume/detail?dinner_id=<?php echo $v['dinner_id'] ?>">详情</a>
                        <a  class="btn btn-primary btn-xs" href="/consume/edit?dinner_id=<?php echo $v['dinner_id'] ?>">修改</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
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
	seajs.use(['<?php echo css_js_url('consume.js', 'admin')?>'], function(a){
		a.del();
	})
</script>
</body>
</html>
