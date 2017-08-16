<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="javascript:;">候选人列表</a>
    <hr>
    <!-- search -->
    <div class="row">
        <form class="form-inline" method="post">
            <div class="form-group">
                <label>用户电话：</label>
                <input type="text" name="mobile_phone" class="form-control" placeholder="请输入用户电话" value="<?php if(isset($mobile_phone)):?><?php echo $mobile_phone?><?php endif;?>">
            </div>
            <div class="form-group">
                <label>活动：</label>
                <select class="form-control" name="activity_id">
                     <option value="-1">请选择活动</option>
                     <?php foreach ($activity as $k=>$v):?>
                     <option value="<?php echo $k?>" <?php if(isset($activity_id) && $activity_id == $k):?> selected="selected" <?php endif;?>> <?php echo $v?></option>
                     <?php endforeach;?>
                </select>
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
                    <th>活动名称</th>
                    <th>用户电话</th>
                    <th>标题</th>
                    <th>描述</th>
                    <th>封面图</th>
                    <th>状态</th>
                    <th>得票数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list):?>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $activity_name[$v['activity_id']]?></td>
                    <td><?php echo $user[$v['create_user_id']]?></td>
                    <td><?php echo $v['title']?></td>
                    <td><?php echo $v['desc']?></td>
                    <td style="width: 15%"><img src="<?php echo get_img_url($v['cover_img'])?>" style="width:150px;"></td>
                    <td><?php if($v['auth_status'] == 0): ?><?php echo '待审核'?><?php elseif ($v['auth_status'] == 1):?><?php echo "审核通过"?><?php elseif ($v['auth_status'] == 2):?><?php echo '审核不通过'?><?php endif;?></td>
                    <td><?php echo $v['vote_num'] ?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/candidate/modify/<?php echo $v['id']?>">修改</a>
                        <a class="btn btn-primary btn-xs check" data-id="<?php echo $v['id']?>">审核</a>
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
	seajs.use(['<?php echo css_js_url('candidate.js', 'admin')?>'], function(a){
		a.del();
		a.check();
	})
</script>
</body>
</html>
