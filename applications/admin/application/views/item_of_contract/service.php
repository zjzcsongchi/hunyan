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

    <input type="button" class="btn"  id="add_product_type" value="添加产品类型"/>
    <input type="button" class="btn" id="add_product" value="添加产品"/>

    <div id="product_type" style="display: none">
    <br/>
        <li>
            <label>产品类型</label>
            <input id="class_name" type="text" class="dfinput"/>
        </li>
        <li>
            <label>产品类型备注</label>
            <textarea id="item_class_desc" type="text" class="textinput"/></textarea>
            <input type="submit" class="btn" id="addpid" value="添加类型"/>
        </li>
    </div>

    <div id="product" style="display: none">
    <br/>
        <li>
            <label>产品类型</label>
            <select class="dfinput selects" id="pid" name="pid" >
                <option value="0">--请选择类型--</option>
                <?php if(isset($lists)):?>
                <?php foreach ($lists as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php endforeach;?>
                <?php endif;?>
            </select>
            <b>*</b>
        </li>
        <li>
            <label>产品名称</label>
            <input  id="item_name" type="text" class="dfinput" />
        </li>
        <li>
            <label>产品价格</label>
            <input  id="item_price" type="text" class="dfinput" />
            <input id="add" type="submit" class="btn" value="添加"/>
        </li>
    </div>
    </ul>
    <br>

    <table id="service" class="tablelist" style="width: 50%;margin-left: 22px;">
        <?php if(isset($lists)):?>
        <?php foreach ($lists as $k => $v):?>
            <tr class="pid" id="p_<?php echo $v['id'];?>" style="border-bottom: 1px solid #c7c7c7;border-top:1px solid #c7c7c7">
                <th id="name_pid_<?php echo $v['id']?>" colspan="3" style="text-align: center"><?php echo $v['name']?></th>
                <th>
                    <a type="edit_pid" data="<?php echo $v['id']?>" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;
                    <a type="del_pid" data="<?php echo $v['id'];?>" class="tablelink">删除</a>
                </th>
            </tr>
            
            <tr>
                <td colspan="4" id="desc_pid_<?php echo $v['id']?>"><?php echo str_replace("\n", '<br/>', $v['desc'])?></td>
            </tr>
            
            <?php if(isset($v['child'])):?>
            <?php foreach ($v['child'] as $kk => $vv):?>
                <tr class="p_<?php echo $v['id'];?>" data="<?php echo $kk+1?>" style="border-top:1px solid #c7c7c7">
                    <td style="border-right:1px solid #c7c7c7;"><?php echo $kk+1?></td>
                    <td style="width:60%;" id="item_name_<?php echo $vv['id']?>"><?php echo $vv['name']?></td>
                    <td style="width:20%;" id="item_price_<?php echo $vv['id']?>"><?php echo $vv['price']?></td>
                    <td>
                        <a type="edit" data="<?php echo $vv['id']?>" status="0" class="tablelink">编辑</a>&nbsp;&nbsp;
                        <a type="del" pid="p_<?php echo $v['id'];?>" kid="<?php echo $kk+1?>" data="<?php echo $vv['id']?>" class="tablelink">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
            <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
    </table>
</div>
<?php $this->load->view('common/footer');?>
<script type="text/javascript">
seajs.use(['<?php echo css_js_url('item_of_contract.js', 'admin')?>','jqvalidate'], function(a){
	a.add_pid();
	a.add();
	a.del();
	a.del_pid();
	a.edit();
    a.edit_pid();
    a.show_add_product_type();
    a.show_add_product();
})
</script>
</body>
</html>
