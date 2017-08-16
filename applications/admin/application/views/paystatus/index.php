<?php $this->load->view('common/header2')?>

<style media=print type="text/css"> .noprint{display : none } </style>
<style>
.fixed {
    width: 280px;
}
</style>
 
<ol class="breadcrumb noprint">
    <li><a href="/milan"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- search -->
    <div class="row noprint">
    <hr/>
        <form class="form-inline" >
        
            <div class="form-group">
                <label>支付类型：</label>
                <select class="form-control" name="payment" >
                     <option value="0">请选择支付类型</option>
                     <?php foreach ($payment as $k => $v):?>
                     <option value="<?php echo $k?>" <?php if(isset($payment_id) && $payment_id == $k):?>selected="selected" <?php endif;?> ><?php echo $v?></option>
                     <?php endforeach;?>
                </select>
            </div>
            
            <div class="form-group">
                <label>支付方式：</label>
                <select class="form-control" name="pay_type" >
                     <option value="0">请选择支付类型</option>
                     <?php foreach ($pay_type as $k => $v):?>
                     <option value="<?php echo $k?>" <?php if(isset($pay_type_id) && $pay_type_id == $k):?>selected="selected" <?php endif;?> ><?php echo $v?></option>
                     <?php endforeach;?>
                </select>
            </div>
            
            <div class="form-group">
                <label>支付时间：</label>
                <input type="text" name="pay_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择日期" value="<?php if(isset($pay_time)):?><?php echo $pay_time?><?php endif;?>">
            </div>
            
            <button class="btn btn-primary" type="submit">搜索</button>
            <button id="print_me" class="btn btn-primary" type="button" onclick='javascript:window.print();'>打印</button>
        </form>
    <hr/>
    </div>   
    
    <!-- list -->
    <!--startprint-->
    <div class="row">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>合同编号</th>
                    <th>客户</th>
                    <th>宴会日期</th>
                    <th>场馆</th>
                    <th>宴会类型</th>
                    <th>餐标</th>
                    
                    <th>支付类型</th>
                    <th>支付方式</th>
                    <th>支付金额</th>
                    <th>优惠金额</th>
                    <th>支付日期</th>
                    
                    <th>接单人</th>
                    <th class="fixed">备注</th>
                    <th class="noprint">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php $money = 0; $coupon = 0; $num = 0;?>
            <?php foreach($lists as $key => $val): ++$num;?>
                <?php foreach($val as $k => $v): ?>
                <tr>
                    <?php if($k == 0): ?>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo $num?></td>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo $v['contract_num']?></td>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo isset($user[$v['customer_id']]) ? $user[$v['customer_id']] : ''?></td>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo $v['solar_time']?></td>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo $dinner_venue[$v['dinner_id']]?></td>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo $v['venue_type']?></td>
                    <td rowspan="<?php echo count($val) ?>" style="vertical-align: middle;"><?php echo $v['menus_name']?></td>
                    <?php endif; ?>
                    
                    <td><?php echo $payment[$v['payment']]?></td>
                    <td><?php if ($v['payment'] == C('order.payment.remaining.id')) { echo $pay_type_archive[$v['pay_type']]; } else { echo $pay_type[$v['pay_type']]; }?></td>
                    <td><?php echo $v['money']; $money += floatval($v['money']); ?></td>
                    <td><?php echo $v['coupon']; $coupon += floatval($v['coupon']); ?></td>
                    <td><?php echo $v['pay_time']?></td>
                   
                    <td><?php echo isset($admin[$v['create_admin']]) && $admin[$v['create_admin']] ? $admin[$v['create_admin']]: ''?></td>
                    <td class="fixed"><?php echo $v['remark']; ?></td>
                    
                    <td class="noprint">
                        <a class="btn btn-primary btn-xs" href="/dinner/contract_display?id=<?php echo $v['dinner_id'];?>" >查看合同</a>   
                        <a class="btn btn-primary btn-xs" href="/dinner/show_detail/<?php echo $v['dinner_id'];?>" >查看订单</a>
                        <a class="btn btn-primary btn-xs" href="/consume/detail?dinner_id=<?php echo $v['dinner_id'] ?>">查看消费清单</a>   
                        <a class="btn btn-primary btn-xs" href="/paystatus/edit/<?php echo $v['id'];?>" >修改</a>   
                        <a class="btn btn-primary btn-xs del" url="/paystatus/del/<?php echo $v['id']?>" data-id="<?php echo $v['id']?>">删除</a>
                    </td>
                </tr> 
                <?php endforeach; ?>
            <?php endforeach;?>
            <tr>
                <td>合计</td>
                <td colspan="2">支付总金额（元）</td>
                <td colspan="5"><?php echo number_format($money, 2); ?></td>
                <td colspan="2">优惠金额（元）</td>
                <td colspan="5"><?php echo number_format($coupon, 2); ?></td>
            </tr>
            </tbody>   
        </table>
    </div>
    <!--endprint-->
    
    <!-- page -->
    <div class="row noprint">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled"><a>共<?php if(isset($count)){echo $count;}else{echo 0;}?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>

<?php $this->load->view('common/footer')?>
<script>
	seajs.use([ '<?php echo css_js_url('paystatus.js', 'admin')?>'], function(a){
		a.del();
		$(function(){
	          $(".Wdate").focus(function(){
	              WdatePicker({dateFmt:'yyyy-MM-dd'})
	          });
	      });
	})
</script>
</body>
</html>
