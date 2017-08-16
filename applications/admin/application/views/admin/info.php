<?php $this->load->view("common/header2");?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/admin"><?php echo $title[0]?></a></li>
    <li class="active"><?php echo $title[1]?></li>
</ol>

<div class="container-fluid" style="margin:10px">
   <fieldset>
    <legend>身份信息</legend>
    <table class="table table-bordered">
      <tbody>
        <tr>
            <td class="info">角色:</td>
            <td><?php echo $groups[$info['group_id']];?></td>
         </tr>
        <tr class="odd">
            <td class="info">登录名:</td>
            <td><?php echo $info['name'];?></td>
        </tr>
        <tr>
            <td class="info">姓名:</td>
            <td><?php echo $info['fullname'];?></td>
        </tr>
        <tr>
            <td class="info">生日:</td>
            <td><?php echo $info['birthday']?></td>
        </tr>
        <tr class="odd">
            <td class="info">Email:</td>
            <td><?php echo $info['email'];?></td>
        </tr>
        <tr>
            <td class="info">手机:</td>
            <td><?php echo $info['tel'];?></td>
        </tr>
        <?php if(isset($info['wx_info'])):?>
        <tr>
            <td class="info">微信头像:</td>
            <td ><img style="max-height:50px;" src="<?php echo get_img_url($info['wx_info']['head_img'])?>" ></td>
        </tr>
        <tr>
            <td class="info">微信昵称:</td>
            <td><?php echo $info['wx_info']['nickname']?></td>
        </tr>
        <?php endif;?>
        <tr class="odd">
            <td class="info">描述：</td>
            <td><?php echo $info['describe'];?></td>
        </tr>
      </tbody>
    </table>
   </fieldset>
   <fieldset>
    <legend>履历信息 <a class="btn btn-primary" href="/adminresume/add/<?php echo $info['id']?>">添加履历</a></legend>
    <table class="table table-bordered">
        <thead>
            <tr class="info">
                <th>编号</th>
                <th>履历类型</th>
                <th>简介</th>
                <th>内容</th>
                <th>备注</th>
                <th>发生时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($list)):?>
            <?php foreach ($list as $k => $v):?>
            <tr>
                <td><?php echo $k+1 ?></td>
                <td><?php echo $v['resume_type_text']?></td>
                <td><?php echo $v['title']?></td>
                <td><?php echo $v['content']?></td>
                <td><?php echo $v['remark']?></td>
                <td><?php echo $v['occur_time']?></td>
                <td>
                    <a href="/adminresume/edit/<?php echo $v['id']?>" class="btn btn-primary btn-xs">修改</a>
                    <a href="/adminresume/show_images/<?php echo $v['id']?>" class="btn btn-primary show_images btn-xs">查看照片</a>
                    <a data-id="<?php echo $v['id']?>" class="btn btn-primary btn-xs del">删除</a>
                </td>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
        </tbody>
    </table>
   </fieldset>
   
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use(['<?php echo css_js_url('admin_info.js', 'admin')?>'], function(a){
		a.del();
	})
</script>
</body>
</html>