<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/customer/index"><?php echo $title[1]?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid" style="margin: 10px">
    <!-- user_info -->
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th class="active">客户姓名</td>
                <td><?php echo $customer['name']?></td>
                <th class="active">客户电话</td>
                <td><?php echo $customer['mobile']?></td>
                <th class="active">接待日期</th>
                <td><?php if($customer['create_time'] != '0000-00-00 00:00:00'){echo date('Y-m-d', strtotime($customer['create_time']));}else{echo '未确定';}?></td>
                <th class="active">宴会日期</th>
                <td><?php if($customer['dinner_time'] != '0000-00-00 00:00:00'){echo date('Y-m-d', strtotime($customer['dinner_time']));}else{echo '未确定';}?></td>
            </tr>
            <tr>
                <th class="active">接单员</td>
                <td><?php echo $customer['reception']?></td>
                <th class="active">类型</td>
                <td>
                    <?php foreach (C('party') as $k => $v):?>
                        <?php if($customer['type'] == $v['id']){echo $v['name'];}?>
                    <?php endforeach;?>
                </td>
                <th class="active">状态</th>
                <td><?php if($customer['is_del'] == 0){echo '正常';}else{echo '已删除';}?></td>
                <th class="active">备注</th>
                <td><?php echo $customer['remark']?></td>
            </tr>
        </tbody>
    </table>
    <hr>
    <!-- list -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>序号</th>
                <th>回访内容</th>
                <th>创建时间</th>
            </tr>
        </thead>
        <tbody id="first">
            <?php if(isset($list)):?>
            <?php foreach ($list as $k => $v):?>
            <tr data-id="<?php echo $k+1?>">
                <td><?php echo $k+1?></td>
                <td><?php echo $v['content']?></td>
                <td><?php echo $v['create_time']?></td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
    <table class="table table-bordered">
        <tr>
            <td colspan='2'><input type="hidden" id="customer_id" value="<?php echo $id;?>" /><textarea rows="2" id="content" class="form-control" placeholder="请输入回访内容"></textarea></td>
            <td><p id="add" type='submit' class="btn btn-primary">提交</p>
        </tr>
    </table>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('log.js', 'admin')?>'], function(a){
		a.add();
	})
</script>

</body>
</html>