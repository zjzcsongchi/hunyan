<?php $this->load->view('common/header');?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="#">资讯管理</a></li>
        <li><a href="#">评论管理</a></li>
    </ul>
</div>    

<div class="rightinfo">
    <table class="tablelist">
        <thead>
            <tr>
                <th>编号</th>
                <th>回复人</th>
                <th>回复人头像</th>
                <th>回复内容</th>
                <th>回复时间</th>
                <!--<th>是否删除</th>-->
                <th>资讯标题</th>
                <th>资讯分类</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($comments_list as $key => $val):?>
            <tr <?php if ($key % 2 != 0){ echo 'class="odd"'; }?> >
                <td><?php echo $val['id'];?></td>
                <td><?php echo $val['username'];?></td>
                <td><img src="<?php echo $val['head_img'];?>" style='width:80px;height:80px'/></td>
                <td><?php echo $val['content'];?></td>
                <td><?php echo $val['create_time'];?></td>
                <!--<td><?php echo $val['is_del'] == 1 ? '<span style="color:red">已删除</span>' : '未删除';?></td>-->
                <td><?php echo $val['news_title'];?></td>
                <td><?php echo $val['news_class'];?></td>
                <td>
                    <!--
                    <?php if($val['is_del'] == 1): ?>
                    <a href="/news/comment_del/<?php echo $val['id'];?>/0" class="tablelink"> 取消删除</a>
                    <?php else:?>
                    <a href="/news/comment_del/<?php echo $val['id'];?>/1" class="tablelink"> 删除</a>
                    <?php endif; ?>
                    -->
                    <a href="/news/comment_del/<?php echo $val['id'];?>/1" class="tablelink">删除</a>
                    <a class="tablelink" target="_black" href="<?php echo $domain['base']['url'].'/news/show_for_admin/'.$val['id'];?>" >查看资讯</a>
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