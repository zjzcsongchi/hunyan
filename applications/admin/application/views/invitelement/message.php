<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <!-- search -->
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>名字</th>
                    <th>昵称</th>
                    <th>头像</th>
                    <th>出席人数</th>
                    <th>留言</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                <?php foreach ($lists as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $user[$v['user_id']]['user_name']?></td>
                    <td><img style="width:100px;" src="<?php echo $user[$v['user_id']]['head_img']?>"></td>
                    <td><?php if($v['wall_num'] == 10):?>不出席<?php else:?><?php echo $attend_num[$v['wall_num']]?>人<?php endif;?></td>
                    <td><?php echo $v['content']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/invitelement/message_edit?id=<?php echo $v['id']?>">修改</a>
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
	seajs.use(['<?php echo css_js_url('invitelement.js', 'admin')?>'], function(a){
		a.message_del();
	})
</script>
</body>
</html>
