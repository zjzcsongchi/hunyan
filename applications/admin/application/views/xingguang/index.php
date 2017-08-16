<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title['1']?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <form class="form-inline" method="post">
        <div class="form-group">
            <label>姓名：</label>
            <input type="text" name="realname" class="form-control" placeholder="请输入姓名">
        </div>
        <div class="form-group">
            <label>手机号：</label>
            <input type="text" name="mobile_phone" class="form-control" placeholder="请输入手机号">
        </div>
        <div class="form-group">
            <label>审核状态：</label>
            <select name="auth_status" class="form-control">
                <option value="">请选择审核状态</option>
                <option value="0">未审核</option>
                <option value="1">审核成功</option>
                <option value="2">审核失败</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> 搜索</button>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" onclick="window.location.reload()"><span class="glyphicon glyphicon-refresh"></span> 刷新</button>
        </div>
    </form>
    
    <hr>
    <table class="table table-bordered table-hover" >
        <thead>
            <tr>
                <th>姓名</th>
                <th>手机号</th>
                <th>性别</th>
                <th>民族</th>
                <th>籍贯</th>
                <th>出生日期</th>
                <th>政治面貌</th>
                <th>婚姻状况</th>
                <th>审核状态</th>
                <th>申请时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if($list):?>
            <?php foreach ($list as $k => $v):?>
            <tr>
                <td><?php echo $v['realname']?></td>
                <td><?php echo $v['mobile_phone']?></td>
                <td><?php echo $v['sex_text']?></td>
                <td><?php echo $v['nation']?></td>
                <td><?php echo $v['native_place']?></td>
                <td><?php echo $v['birthday']?></td>
                <td><?php echo $v['political_status_text']?></td>
                <td><?php echo $v['marry_status_text']?></td>
                <td><?php echo $v['auth_status_text']?></td>
                <td><?php echo $v['create_time']?></td>
                <td>
                    <a href="/xingguang/detail?id=<?php echo $v['id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> 详情</a>
                    <a href="/xingguang/edit?id=<?php echo $v['id']?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> 修改</a>
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
</div>

</body>
</html>