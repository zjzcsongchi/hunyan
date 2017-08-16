<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/milan"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/milan/add_customer">添加客户</a>
    <hr>
    <!-- search -->
    <div class="row">
        <form class="form-inline">
            <div class="form-group">
                <label>客户姓名：</label>
                <input type="text" name="name" class="form-control" placeholder="请输入客户姓名" value="<?php if(isset($name)){echo $name;}?>">
            </div>
            <div class="form-group">
                <label>手机号：</label>
                <input type="text" name="mobile" class="form-control" placeholder="请输入客户手机号" value="<?php if(isset($mobile)){echo $mobile;}?>"/>
            </div>
            
            <div class="form-group">
                <label>日期：</label>
                <input type="text" name="create_time" class="form-control Wdate" style="height: 34px;" placeholder="请选择接待日期" value="<?php if(isset($create_time)){echo $create_time;}?>">
            </div>
            <button class="btn btn-primary" type="submit">搜索</button>
            <span class="btn btn-primary" id="send_message">发送短信</span>
        </form>
        
    </div>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>选择</th>
                    <th>序号</th>
                    <th>客户姓名</th>
                    <th>手机号</th>
                    <th>接待日期</th>
                    <th>宴会日期</th>
                    <th>宴会类型</th>
                    <th>接单员</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($list)):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><input type="checkbox" name="message[]" value="<?php echo $v['id']?>"></td>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $v['mobile']?></td>
                    <td><?php if($v['create_time'] != '0000-00-00 00:00:00'){echo date('Y-m-d', strtotime($v['create_time']));}else{echo '未确定';}?></td>
                    <td><?php if($v['dinner_time'] != '0000-00-00 00:00:00'){echo date('Y-m-d', strtotime($v['dinner_time']));}else{echo '未确定';}?></td>
                    <td>
                        <?php foreach (C('party') as $kk => $vv):?>
                            <?php if($v['type'] == $vv['id']):?>
                                <?php echo $vv['name']?>
                            <?php endif;?>
                        <?php endforeach;?>
                    </td>
                    <td><?php echo $v['reception']?></td>
                    <td><?php echo $v['remark'];?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/milan/customer_modify?id=<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs" href="/milan/log?id=<?php echo $v['id']?>">回访记录</a>
                        <a class="btn btn-primary btn-xs del" href="/milan/customer_del?id=<?php echo $v['id']?>" >删除</a>
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
                <li class="disabled"><a>共<?php if(isset($count)){echo $count;}else{echo 0;}?>条</a></li>
                <?php echo isset($pagestr) ? $pagestr : ''?>
            </ul>
        </nav>
    </div>
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('milanstaff.js', 'admin')?>', 'wdate'], function(a){
		a.send_message();
		$(function(){
	          $(".Wdate").focus(function(){
	              WdatePicker({dateFmt:'yyyy-MM-dd'})
	          });
	      });
	})
</script>
</body>
</html>
