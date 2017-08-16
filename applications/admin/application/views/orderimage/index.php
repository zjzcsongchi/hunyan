<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li class="active">相册订单管理</li>
</ol>

<div class="container-fluid" style="margin:10px">
    <fieldset>
        <legend>相册订单管理</legend>
        <form class="form-inline" method="post">
            <div class="form-group">
                <label class="control-label">订单号：</label>
                <input type="text" name="order_id" class="form-control" placeholder="请输入订单号">
            </div>
            <div class="form-group">
                <label class="control-label">客户手机号：</label>
                <input type="text" name="mobile_phone" class="form-control" placeholder="请输入手机号">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> 搜 索</button>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" onclick="window.location.reload()"><span class="glyphicon glyphicon-refresh"></span> 刷 新</button>
            </div>
            <div class="form-group">
<!--                 <a class="btn btn-primary" href="/orderimage/add"><span class="glyphicon glyphicon-plus-sign"></span> 添 加</a> -->
            </div>
        </form>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <tr class="info">
                    <th>订单号</th>
                    <th>客户姓名</th>
                    <th>客户手机号</th>
                    <th>宴会厅</th>
                    <th>宴会时间</th>
                    <th>订单金额</th>
                    <th>支付金额</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $v['order_id']?></td>
                    <td><?php echo $v['roles_name']?></td>
                    <td><?php echo $v['mobile_phone']?></td>
                    <td><?php echo $v['venue_name']?></td>
                    <td><?php echo $v['solar_time']?></td>
                    <td><?php echo $v['need_pay'] + $v['favorable']?></td>
                    <td><?php echo $v['need_pay']?></td>
                    <td><?php echo $v['create_time']?></td>
                    <td><?php echo $v['status_text']?>；<?php echo $v['delivery_status_text']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/orderimage/edit?id=<?php echo $v['id']?>"><span class="glyphicon glyphicon-edit"></span> 修改</a>
                        <a class="btn btn-primary btn-xs" href="/orderimage/detail?id=<?php echo $v['id']?>"><span class="glyphicon glyphicon-info-sign"></span> 详情</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>"><span class="glyphicon glyphicon-floppy-remove"></span> 删除</a>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
        <!-- page -->
        <div class="row">
            <nav style="float: right">
                <ul class="pagination">
                    <li class="disabled"><a>共<?php echo $count?>条</a></li>
                    <?php echo isset($pagestr) ? $pagestr : ''?>
                </ul>
            </nav>
        </div>
    </fieldset>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('order_image.js', 'admin')?>'], function(a){
	a.del();
		})
</script>

</body>
</html>