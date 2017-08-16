<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/customer/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid" style="margin: 10px">
    <input type="hidden" id="customer_id" value="<?php echo $customer_id?>">
    <!-- user_info -->
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th class="active">客户姓名</th>
                <td><?php echo $info['name']?></td>
                <th class="active">客户电话</th>
                <td><?php echo $info['mobile_phone']?></td>
                <th class="active">家庭住址</th>
                <td><?php echo $info['address']?></td>
            </tr>
            <tr>
                <th class="active">宴会类型</th>
                <td><?php if(isset($info['dinner_type_name'])) echo $info['dinner_type_name'];?></td>
                <th class="active">预约场馆</th>
                <td><?php if(isset($info['venue_name'])) echo $info['venue_name'];?></td>
                <th class="active">预约时间</th>
                <td><?php echo $info['dinner_time']?></td>
            </tr>
            <tr>
                <th class="active">接单员</th>
                <td><?php if(isset($info['receive_admin_name'])) echo $info['receive_admin_name'];?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <!-- list -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>序号</th>
                <th>客户姓名</th>
                <th>备注</th>
                <th>创建时间</th>
                <th>创建人</th>
                <th>更新人</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if($list):?>
            <?php foreach ($list as $k => $v):?>
            <tr>
                <td><?php echo $k+1?></td>
                <td><?php echo $v['customer_name']?></td>
                <td><?php echo $v['remark']?></td>
                <td><?php echo $v['create_time']?></td>
                <td><?php echo $v['create_admin_name']?></td>
                <td><?php echo $v['update_admin_name']?></td>
                <td>
                    <a class="btn btn-primary btn-xs edit" data-id="<?php echo $v['id']?>">修改</a>
                    <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
                </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
    <table class="table table-bordered">
        <tr>
            <td></td>
            <td colspan='3'><textarea name="remark" placeholder="备注" class="form-control" cols="1"></textarea></td>
            <td><button class="btn btn-primary" id="add">添加记录</button></td>
        </tr>
    </table>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('review.js', 'admin')?>'], function(a){
		a.add();
		a.modify();
		a.del();
	})
</script>

</body>
</html>