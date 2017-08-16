<?php $this->load->view('common/header');?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">资讯管理</a></li>
        <li><a href="#">资讯列表</a></li>
    </ul>
</div>    

<div class="rightinfo">
    <div class="tools">
        <ul class="toolbar">
            <li onclick="javascript:window.location.href='/news/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>发布资讯</li>
        </ul>
    </div>
    <div class="tools">
        <form method="get">
            <ul class="placeul">
                <li>  
                    资讯标题：<input type="text" class="dfinput" name="title" value="<?php echo $title; ?>" style="width: 220px">
                    资讯分类：
                    <select class="dfinput selects news-class" name="class_id" style="width: 220px">
                        <option value="">---请选择资讯分类---</option>
                        <?php foreach ($class_list as $key => $val): ?>
                        <option data-level="<?php echo $val['level'];?>" value="<?php echo $val['id'];?>" <?php if($val['id'] == $class_id){ echo "selected"; }?>><?php echo str_repeat('——', $val['level']).$val['name'];?></option>
                        <?php endforeach;?>
                    </select>
                    是否删除：
                    <select class="dfinput selects" name="is_del" style="width: 120px">
                        <option value="0" <?php if($is_del == 0){ echo "selected"; }?>>未删除</option>
                        <option value="1" <?php if($is_del == 1){ echo "selected"; }?>>已删除</option>
                    </select>
                    <input type="hidden" name="is_has_child" value="<?php echo $is_has_child;?>">
                    <input type="submit" value="搜 索" class="btn">
                </li>
            </ul>
        </form>
    </div>

    <table class="tablelist">
        <thead>
            <tr>
                <th><input name="check_all" class="check-all" type="checkbox"></th>
                <th>编号</th>
                <th>排序</th>
                <th>资讯标题</th>
                <th>资讯分类</th>
                <th>是否推荐</th>
                <th>是否删除</th>
                <th>显示状态</th>
                <th>发布时间</th>
                <th>发布人</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($news_list as $key => $val):?>
            <tr <?php if($key%2 !=0 ){ echo 'class="odd"';}?>>
                <td><input name="checkbox" type="checkbox" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['id'];?></td>
                <td><?php echo $val['sort'];?></td>
                <td><?php echo $val['title'];?></td>
                <td><?php echo $news_class[$val['news_class_id']];?></td>
                <td><?php echo $val['is_recommend'] == 1 ? '是' : '否';?></td>
                <td><?php echo $val['is_del'] == 1 ? '<span style="color:red">已删除</span>' : '未删除';?></td>
                <td><?php echo $val['is_show'] == 1 ? '<span style="color:green">显示</span>' : '<span style="color:red">不显示</span>';?></td>
                <td><?php echo $val['publish_time'];?></td>
                <td><?php echo $admins[$val['create_user']];?></td>
                <td>
                    <a href="/news/view_comments/<?php echo $val['id'];?>" class="tablelink">查看评论</a> 
                    
                    <a href="/news/edit/<?php echo $val['id'];?>" class="tablelink">修改</a>   

                    <?php if($val['is_del'] == 1): ?>  
                    <a href="/news/del/<?php echo $val['id'];?>/0" class="tablelink"> 取消删除</a>
                    <?php else:?>
                    <a href="/news/del/<?php echo $val['id'];?>/1" class="tablelink"> 删除</a>
                    <?php endif; ?>

                    <?php if($val['is_show'] == 0):?>
                    <a href="/news/update_status/<?php echo $val['id'];?>/1" class="tablelink">显示</a>
                    <?php else:?>
                    <a href="/news/update_status/<?php echo $val['id'];?>/0" class="tablelink">不显示</a>
                    <?php endif;?>
                    <a class="tablelink" target="_black" href="<?php echo $domain['base']['url'].'/news/show_for_admin/'.$val['id'];?>" >查看</a>
                </td>
            </tr> 
            <?php endforeach;?>
        </tbody>
    </table>

    <div class="pagin">
        <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
        <ul class="paginList">
            <?php echo $pagestr;?>
        </ul>
    </div>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
    seajs.use("<?php echo css_js_url('news.js', 'admin');?>", function(a){
        a.batchPublish();
        a.checkAll('input[name="checkbox"]');
        a.selectChange();
    });
</script>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>