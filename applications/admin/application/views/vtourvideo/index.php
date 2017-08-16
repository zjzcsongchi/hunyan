<?php $this->load->view('common/header2') ?>
<ol class="breadcrumb">
	<li><a href="common">首页</a></li>
	<li class="active">全景视频列表</li>
</ol>
<div class="container-fluid" style="margin:10px">
	<fieldset>
		<legend>全景视频列表</legend>
		<a href="/vtourvideo/add" class="btn btn-primary">添加全景视频</a>
		<hr>
		<form class="form-inline" method="GET">
            <div class="form-group">
                <label>名称：</label>
                <input type="text" name="name" placeholder="请输入名称" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">搜 索</button>
            </div>
        </form>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr class="bg-info">
                    <th>序号</th>
                    <th>名称</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $k => $v):?>
                <tr>
                    <td><?php echo $k+1?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $v['create_time']?></td>
                    <td>
                        <a href="/vtourvideo/modify?id=<?php echo $v['id']?>" class="btn btn-primary btn-xs">修改</a>
                        <a href="/vtourvideo/scan/<?php echo $v['id']?>" target="_blank"  class="btn btn-primary btn-xs">查看</a>
                        <a data-id="<?php echo $v['id']?>" class="del btn btn-primary btn-xs">删除</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <!-- page -->
        <div class="row">
            <nav style="float: right">
                <ul class="pagination">
                    <li class="disabled"><a>共<?php echo $data_count?>条</a></li>
                    <?php echo !empty($pagestr) ? $pagestr : ''?>
                </ul>
            </nav>
        </div>
	</fieldset>
</div>