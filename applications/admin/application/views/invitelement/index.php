<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <!-- search -->
    <div class="row">
        <form class="form-inline" method="post">
            <div class="form-group">
                <label>模板名称：</label>
                <input type="text" name="name" class="form-control" placeholder="请输入模板名称" value="<?php if(isset($name)):?><?php echo $name?><?php endif;?>">
            </div>
            
            <div class="form-group">
                <label>用户姓名：</label>
                <input type="text" name="user" class="form-control" placeholder="请输入用户姓名" value="<?php if(isset($user)):?><?php echo $user?><?php endif;?>">
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
                    <th>用户</th>
                    <th>新郎</th>
                    <th>新娘</th>
                    <th>婚礼时间</th>
                    <th>模板名称</th>
                    <th>音乐名称</th>
                    <th>音乐</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($lists):?>
                <?php foreach ($lists as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['user_name']?></td>
                    <td><?php if(isset($roles_main[$v['user_id']]) && $roles_main[$v['user_id']]):?> 
                    <?php foreach ($roles_main[$v['user_id']] as $key=>$val):?>
                        <?php if($v['template_id'] == $val['template_id']):?>
                        <?php echo $val['default']?>
                        <?php endif;?>
                    <?php endforeach;?>
                    <?php endif;?>
                    </td>
                    <td><?php if(isset($roles_wife[$v['user_id']]) && $roles_wife[$v['user_id']]):?> 
                    <?php foreach ($roles_wife[$v['user_id']] as $key=>$val):?>
                        <?php if($v['template_id'] == $val['template_id']):?>
                        <?php echo $val['default']?>
                        <?php endif;?>
                    <?php endforeach;?>
                    <?php endif;?>
                    </td>
                    
                     <td><?php if(isset($begin_time[$v['user_id']]) && $begin_time[$v['user_id']]):?> 
                    <?php foreach ($begin_time[$v['user_id']] as $key=>$val):?>
                        <?php if($v['template_id'] == $val['template_id']):?>
                        <?php echo $val['default']?>
                        <?php endif;?>
                    <?php endforeach;?>
                    <?php endif;?>
                    </td>
                    <td><?php echo $v['template']?></td>
                    <td><?php echo $v['music_name']?></td>
                    <td style="width:100px">
                    <?php if(isset($v['music']) && $v['music']):?>
                        <audio src="<?php echo get_img_url($v['music']);?>"  controls="controls"/>
                        </audio>
                        <?php endif;?>
                    </td>
                    <td>
                        <a style="display:none;" class="btn btn-primary btn-xs del" data-id="<?php echo $v['template_id']?>" data-user-id="<?php echo $v['user_id']?>">删除</a>
                        <a class="btn btn-primary btn-xs" href="/invitelement/page/<?php echo $v['user_id']?>/<?php echo $v['template_id']?>">页面</a>
                        <a class="btn btn-primary btn-xs message" href="/invitelement/message/<?php echo $v['user_id']?>">留言</a>
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
		a.del();
	})
</script>
</body>
</html>
