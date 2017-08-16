<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/milan"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- add -->
    <a class="btn btn-primary" href="/theme/add">添加主题</a>
    <hr>
    <!-- search -->
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>标题</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach($lists as $key => $val):?>
                <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                    <td><?php echo $val['id']?></td>
                    <td><?php echo $val['title']?></td>
                    <td><?php echo $val['create_time']?></td>
                    <td><?php echo $val['update_time']?></td>
                    <td>
                        <a class="btn btn-primary btn-xs" href="/theme/edit/<?php echo $val['id'];?>" >修改</a>   
                        <a class="btn btn-primary btn-xs delete" url="/theme/del/<?php echo $val['id']?>">删除</a>
                    </td>
                </tr> 
            <?php endforeach;?>
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
	seajs.use([ '<?php echo css_js_url('theme.js', 'admin')?>'], function(a){
	a.delete();
	})
</script>
</body>
</html>
