<?php $this->load->view('common/header');?>
<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/common">首页</a></li>
        <li><a href="/milancombo/index">婚礼套餐</a></li>
        <li><a href="javascript:;">服务</a></li>
    </ul>
</div>

<div class="formbody">
    <div class="formtitle"><span>添加婚礼服务</span></div>
    <ul class="forminfo">
        <input type="hidden" id="id" value="<?php echo $id;?>" />
        <li>
            <label>婚礼服务类型</label>
            <input id="name" type="text" class="dfinput"/>
            <input type="submit" class="btn" id="addpid" value="添加类型"/>
        </li>
        <br/>
        <li>
            <label>婚礼服务类型</label>
            <select class="dfinput selects" id="pid" name="pid" >
                <option value="0">--请选择类型--</option>
                <?php if(isset($pid)):?>
                <?php foreach ($pid as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php endforeach;?>
                <?php endif;?>
            </select>
            <b>*</b>
        </li>
        <li>
            <label>服务内容</label>
            <input  id="desc" type="text" class="dfinput" />
            <input id="add" type="submit" class="btn" value="添加"/>
        </li>
    </ul>
    <table id="service" class="tablelist" style="width: 50%;margin-left: 22px;">
        <?php if(isset($list)):?>
        <?php foreach ($list as $k => $v):?>
            <tr class="pid" id="p_<?php echo $v['id'];?>" style="border-bottom: 1px solid #c7c7c7;border-top:1px solid #c7c7c7"><th id="txt_pid_<?php echo $v['id']?>" colspan="2" style="text-align: center"><?php echo $v['name']?></th><th><a type="edit_pid" data="<?php echo $v['id']?>" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;<a type="del_pid" data="<?php echo $v['id'];?>" class="tablelink">删除</a></th></tr>
            <?php if(isset($v['child'])):?>
            <?php foreach ($v['child'] as $kk => $vv):?>
                <tr class="p_<?php echo $v['id'];?>" data="<?php echo $kk+1?>" style="border-top:1px solid #c7c7c7">
                    <td style="border-right:1px solid #c7c7c7;"><?php echo $kk+1?></td>
                    <td style="width:80%;" id="txt_<?php echo $vv['id']?>"><?php echo $vv['name']?></td>
                    <td><a type="edit" data="<?php echo $vv['id']?>" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;<a type="del" pid="p_<?php echo $v['id'];?>" kid="<?php echo $kk+1?>" data="<?php echo $vv['id']?>" class="tablelink">删除</a></td>
                </tr>
                <?php endforeach;?>
            <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
seajs.use(['<?php echo css_js_url('service.js', 'admin')?>','jqvalidate'], function(a){
	a.add_pid();
	a.add();
	a.del();
	a.del_pid();
	a.edit();
	a.edit_pid();
})
</script>
</body>
</html>