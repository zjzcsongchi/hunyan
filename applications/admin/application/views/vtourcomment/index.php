<?php $this->load->view('common/header2'); ?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li>VR评论列表</li>
</ol>
<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <form class="form-inline" method="GET">
            <div class="form-group">
                <label>名称：</label>
                <input type="text" name="name" placeholder="请输入场景名称" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">搜 索</button>
            </div>
        </form>
        <hr>
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>场景名称</th>
                    <th>用户</th>
                    <th>评论内容</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                <?php foreach ($lists as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo isset($vtour_name[$v['vtour_id']]) && $vtour_name[$v['vtour_id']] ? $vtour_name[$v['vtour_id']]:'' ?></td>
                    <td><?php echo isset($user_name[$v['user_id']]) && $user_name[$v['user_id']] ?$user_name[$v['user_id']]:'' ?></td>
                    <td><?php echo $v['content']?></td>
                    <td>
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

</body>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('vtour.js', 'admin')?>'], function(a){
		a.del_comment();
	})
</script>
</html>