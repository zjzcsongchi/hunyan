<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
    <!-- search -->
    <form class="form-inline">
        <div class="form-group">
            <label>用户名：</label>
            <input type="text" name="name" class="form-control" placeholder="请输入用户姓名" value="<?php if(isset($name)){echo $name;}?>">
            <button class="btn btn-primary" type="submit">搜索</button>
        </div>
        <a id="record_ewm" data-url="<?php echo $domain['mobile']['url']?>/record" class="btn btn-primary">婚礼档案填写入口【微信扫一扫二维码】</a>
    </form>
    <hr>
    <!-- list -->
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>用户</th>
                    <th>新郎</th>
                    <th>新娘</th>
                    <th>是否关联宴会</th>
                    <th>宴会时间</th>
                    <th>场馆</th>
                    <th>操作</th>
                </tr>
            </thead>
            
            <tbody>
            <?php if(isset($list)):?>
            <?php foreach($list as $key => $val):?>
                <tr id="tr_<?php echo $val['id']?>" <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                    <td><?php echo $val['id']?></td>
                    <td><?php if(isset($val['name'])){echo $val['name'];}?></td>
                    <td><?php echo $val['husband']?></td>
                    <td><?php echo $val['wife']?></td>
                    <td><?php if($val['dinner_id']){echo '是';}else{echo '否';}?></td>
                    <td>
                        <?php if(isset($dinner_venue) && isset($dinner_venue['dinner'])):?>
                            <?php foreach ($dinner_venue['dinner'] as $k => $v):?>
                                <?php if($val['dinner_id'] == $v['id']):?>
                                    <?php echo $v['solar_time'];?>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                    </td>
                    <td>
                        <?php if(isset($dinner_venue) && isset($dinner_venue['dinner']) && isset($dinner_venue['venue_lists'])):?>
                            <?php foreach ($dinner_venue['dinner'] as $k => $v):?>
                                <?php if($val['dinner_id'] == $v['id']):?>
                                    <?php if($v['venue_id']):?>
                                        <?php foreach ($v['venue_id'] as $keys => $vals):?>
                                            <?php foreach ($dinner_venue['venue_lists'] as $kk => $vv):?>
                                                <?php if($vv['id'] == $vals):?>
                                                <?php echo $vv['name'].'；';?>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>
                    </td>
                    <td>
                        <a class="btn btn-primary btn-xs ewm" data-id="<?php echo $val['id'];?>" >查看</a>   
                        <a class="btn btn-primary btn-xs delete" data-id="<?php echo $val['id'];?>">删除</a>
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
	seajs.use(['jquery', '<?php echo css_js_url('record.js', 'admin')?>', '<?php echo css_js_url('dialog.js', 'admin')?>'], function(a,b){
	    b.del();
	    b.showimg();
	    b.record_ewm();
	})
</script>
</body>
</html>
