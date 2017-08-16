<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/customer/add">添加客户</a>
    <a class="btn btn-primary" href="/customer/index">刷新</a>
    <hr>
    <!-- search -->
    <div class="row">
        <form class="form-inline" method="post">
            <div class="form-group">
                <label>客户姓名：</label>
                <input type="text" name="name" class="form-control" placeholder="请输入客户姓名" value="<?php echo $name?>">
            </div>
            <div class="form-group">
                <label>手机号：</label>
                <input type="text" name="mobile_phone" class="form-control" placeholder="请输入客户手机号" value="<?php echo $mobile_phone?>">
            </div>
            <button class="btn btn-primary" type="submit">搜索</button>
        </form>
    </div>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>客户姓名</th>
                    <th>手机号</th>
                    <th>预约场馆</th>
                    <th>预约桌数</th>
                    <th>预留时间</th>
                    <th>酒席日期</th>
                    <th>宴会类型</th>
                    <th>预约来源</th>
                    <th>接单员</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $v['mobile_phone']?></td>
                    <td>
                    <?php if(isset($v['venue_id']) && $v['venue_id']):?>
                        <?php foreach ($v['venue_id'] as $key=>$val):?>
                        <?php echo $venue_name[$val]?>
                        <?php endforeach;?>
                    <?php endif;?>
                    </td>
                    <td><?php echo $v['menus_count']?></td>
                    <td><?php echo $v['order_time']?></td>
                    <td><?php echo $v['dinner_time']?></td>
                    <td><?php echo $v['dinner_type_name']?></td>
                    <td>
                    <?php if($v['source'] == 1):?>线下
                    <?php elseif ($v['source'] == 2):?>线上
                    <?php else: ?>未知
                    <?php endif;?></td>
                    <td><?php echo $v['receive_admin']?></td>
                    <td><?php echo $v['remark']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/customer/modify/<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs" href="/customer/review/<?php echo $v['id']?>">跟踪记录</a>
                        <a class="btn btn-primary btn-xs del" data-id="<?php echo $v['id']?>">删除</a>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
    
    <!-- page -->
    <div class="row">
        <nav style="float: right">
            <ul class="pagination">
                <li class="disabled"><a>共<?php echo $count?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('customer.js', 'admin')?>'], function(a){
	a.del();
		})
</script>
</body>
</html>
