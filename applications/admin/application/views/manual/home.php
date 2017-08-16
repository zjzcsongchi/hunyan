<?php $this->load->view('common/header');?>
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="/common">首页</a></li>
            <li><a href="/manual">手工位内容</a></li>
        </ul>
    </div>
    
    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
            <li onclick="javascript:window.location.href='/Manual/add';"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t01.png" /></span>添加</li>
            <li style="display:none"><span><img src="<?php echo $domain['static']['url'];?>/admin/images/t03.png" /></span>删除</li>
            </ul>
        </div>

        <div class="tools">
            <form method="get">
                <ul class="placeul">
                        <li>  
                                                   标题：<input type="text" class="dfinput" name="title" value="<?php echo $title;?>" style="width: 220px">
                           <label>手工位名称：</label>
                            <select class="dfinput selects" name="manual_class_id">
                                <option value="">---请选择名称---</option>
                                <?php foreach ($manual_class_lists as $key=>$v){?>
                                <option value="<?php echo $key; ?>"<?php if(@$manual_class_id&&@$manual_class_id==$key):?>selected="selected"<?php endif;?>><?php echo $v?></option>
                                <?php }?>
                            </select>
                             <input type="submit" value=" 搜索 " class="btn">
                      </li>
                </ul>  
            </form>
        </div>

        <table class="tablelist">
            <thead>
            <tr>
                <th>ID</th>
        		<th>标题</th>
        		<th>简介</th>
        		<th>导读图</th>
        		<th>链接地址</th>
        		<th>删除状态</th>
        		<th>最后修改人</th>
        		<th>最后修改时间</th>
        		<th>排序</th>
        		<th>操作</th>
	        </tr>
            </thead>
            <tbody>
            <?php if($list):?>
	<?php foreach ($list as $k=>$v):?>
            <tr <?php if($k%2 !=0 ){ echo 'class="odd"';}?>>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['title']?></td>
                <td style="width: 40px"><?php echo $v['summary']?></td>
                <td><a href="<?php echo $v['img_url'];?>" target="_blank"><img src="<?php echo get_img_url($v['img_url']);?>" style="width: 200px; "></a></td>
                <td style="width: 40px"><?php echo $v['url']?></td>
                <td><?php if ($v['is_del']==1):?>正常
        		<?php else:?>删除
        		<?php endif;?>
        		</td>
                <td><?php echo $admins[$v['create_user']];?></td>
                <td><?php echo $v['update_time']?></td>
                <td><?php echo $v['sort']?></td>
                <td><a href="/manual/edit/<?php echo $v['id']?>" class="tablelink">修改</a> 
                <a href="/manual/del/<?php echo $v['id']?>" class="tablelink" onClick="if(confirm('你确定删除?'))return true;return false;">删除</a></td>
            </tr> 
          <?php endforeach;?>
	<?php endif;?>  
            
            </tbody>
        </table>
    
   
        <div class="pagin">
            <div class="message">共<i class="blue"><?php echo $data_count;?></i>条记录，当前显示第&nbsp;<i class="blue"><?php echo $page;?>&nbsp;</i>页</div>
            <ul class="paginList">

                <?php echo $pagestr;?>

            </ul>
        </div>
        
        
        <div class="tip">
            <div class="tiptop"><span>提示信息</span><a></a></div>
            <div class="tipinfo">
                <span><img src="<?php echo $domain['static']['url'];?>/admin/images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button"  class="sure" value="确定" />&nbsp;
                <input name="" type="button"  class="cancel" value="取消" />
            </div>
        </div>
    </div>
<?php $this->load->view('common/footer');?>
<script>
    seajs.use("<?php echo css_js_url('selectbox.js', 'admin');?>", function (select) {
    	selectbox('.selects');
    });
</script>
	</body>
</html>