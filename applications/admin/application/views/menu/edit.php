<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/menu/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" class="form-horizontal col-sm-10">
    <input type="hidden" name="id" value="<?php echo $menue_id?>">
    <input type="hidden" name="dinner_id" value="<?php echo $dinner_id?>">
    <input type="hidden" name="solar_time" value="<?php echo $solar_time?>">
    <input type="hidden" name="venue_type" value="<?php echo $venue_type;?>">
        <div class="form-group">
            <label class="col-sm-3 control-label">选择婚礼场馆 *</label>
            <div class="col-sm-5">
                <select class="form-control" name="venue_id">
                    <option value="">请选择场馆</option>
                    <?php foreach ($venue_name as $k => $v):?>
                    <option value="<?php echo $k?>" <?php if($k == $info['venue_id']):?> selected <?php endif;?>><?php echo $v?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <?php if($venue_type == C('party.wedding.id')):?>
         <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">新郎 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_main" class="form-control" placeholder="新郎姓名" msg="宴会主角不能为空" value="<?php echo $info['roles_main']?>" readonly>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_main_mobile" placeholder="新郎电话号码" value="<?php echo $info['roles_main_mobile']?>" readonly>
            </div>
        </div>
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">新娘 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_wife" class="form-control" placeholder="新娘姓名"  msg="宴会主角不能为空" value="<?php echo $info['roles_wife']?>" readonly>
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_wife_mobile" placeholder="新娘电话号码" value="<?php echo $info['roles_wife_mobile']?>" readonly>
            </div>
        </div>
        <?php else:?>
        <div class="form-group dinner_other show">
          <label class="col-sm-3 control-label">宴会主角 *</label>
          <div class="col-sm-3">
            <input type="text" name="roles_main_other" class="form-control" placeholder="请输入宴会主角" valtype="required" msg="宴会主角不能为空" value="<?php echo $info['roles_main']?>" readonly>
          </div>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="roles_main_other_mobile" placeholder="请输入主角电话" value="<?php echo $info['roles_main_mobile']?>" readonly>
          </div>
        </div>
        <?php endif;?>
        
        
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">联系人 *</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" placeholder="联系人姓名" value="<?php if(isset($customer['name'])):?><?php echo $customer['name']?><?php else:?> <?php endif;?>" readonly>
                <input type="hidden" name="customer_id" value="<?php if(isset($customer['id'])):?><?php echo $customer['id']?><?php endif;?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" placeholder="联系人电话号码" value="<?php if(isset($customer['mobile_phone'])):?><?php echo $customer['mobile_phone']?><?php endif;?>" readonly>
            </div>
        </div>
        
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">婚礼时间</label>
            <div class="col-sm-3">
                <input type="hidden" id="schedule_time" value="<?php echo $info['solar_time']?>">
                <input type="text" class="form-control" readonly value="<?php echo $info['solar_time']?>&nbsp;&nbsp;&nbsp;农历<?php echo $time['lunar_time']?>">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" placeholder="开席时间" value="<?php echo $time['banquet_time']?>" readonly>
            </div>
        </div>
        
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">客户经理</label>
            <div class="col-sm-3">
                <input type="text" name="manager" class="form-control" placeholder="客户经理" value="<?php echo $info['manager'];?>">
            </div>
        </div>
        
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">宴会负责人</label>
            <div class="col-sm-3">
                <input type="text" name="responsible_person" class="form-control" placeholder="宴会负责人" value="<?php echo isset($info['responsible_person']) ? $info['responsible_person'] : '';?>">
            </div>
        </div> 
        
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">委托代理人</label>
            <div class="col-sm-3">
                <input type="text" name="agent" class="form-control" placeholder="委托代理人" value="<?php echo isset($info['agent']) ? $info['agent'] : '';?>">
            </div>
        </div> 

        <div class="form-group">
            <label class="col-sm-3 control-label">合同编号</label>
            <div class="col-sm-5">
                <input type="text" name="contract_num" class="form-control" placeholder="请输入合同编号" value="<?php echo $info['contract_num']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">合同签订日期</label>
            <div class="col-sm-5">
                <input type="text" name="contract_date" class="form-control Cdate" placeholder="请选择合同签订日期" value="<?php echo $info['contract_date']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">订单日期</label>
            <div class="col-sm-5">
                <input type="text" name="order_time" class="form-control Cdate" placeholder="请选择订单日期" value="<?php echo $info['order_time']?>">
            </div>
        </div>
        
       <?php foreach($admins as $k => $v):?>
        <?php if(isset($v['children'])):?>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $v['name']?></label>
            <div class="col-sm-5">
                <ul class="list-inline">
                    
                    <?php foreach ($v['children'] as $k2 => $v2):?>
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="radio" value="<?php echo $v2['id']?>" name="staff_type[<?php echo $k?>]" <?php echo in_array($v2['id'], $schedule) ? 'checked' : '' ?>/>
                                <?php echo $v2['fullname']?>
                            </label>
                            <span class="blank btn btn-sm btn-primary" data-id="<?php echo $v2['id']?>" data-type="<?php echo $k?>">查看档期</span>
                        </div>
                    </li>
                    <?php endforeach;?>
                    
                    <li style="top: 1px;right: 1px;position: absolute;">
                        <div class="checkbox">
                            
                            <span class="btn btn-sm btn-danger cancel-checked" >取消选择 </span>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <?php endif?>
        <?php endforeach;?>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">婚庆公司*</label>
            <div class="col-sm-5">
                <ul class="list-inline">
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="radio" value="milan" name="company" checked>米兰婚礼
                            </label>
                        </div>
                    </li>
                    
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="radio" value="other" name="company" <?php echo $info['menus_id']==-1 && $info['theme_id']==-1 ? 'checked' : '' ?> >其他婚庆公司
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="form-group milan_company" <?php echo $info['menus_id']==-1 ? 'style="display:none;"' : '' ?> >
            <label class="col-sm-3 control-label">选择套餐 *</label>
            <div class="col-sm-5">
                <select class="form-control" name="menus">
                    <option value="">请选择套餐</option>
                    <?php foreach ($combo_menu as $k => $v):?>
                    <option value="<?php echo $v['id']?>" <?php echo $info['menus_id']==$v['id'] ? 'selected' : '' ?>><?php echo $v['name']. "(价格:{$v['price']}元)"?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
       
       <div class="form-group milan_company" <?php echo $info['theme_id']==-1 ? 'style="display:none;"' : '' ?> >
            <label class="col-sm-3 control-label">选择主题 *</label>
            <div class="col-sm-5">
                <select class="form-control" name="theme">
                    <option value="">请选择主题</option>
                    <?php foreach ($theme as $k => $v):?>
                    <option value="<?php echo $k?>" <?php if($info['theme_id'] == $k):?> selected<?php endif;?>><?php echo $v?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-3 control-label">备注</label>
          <div class="col-sm-5">
            <input type="text" name="remark" value="<?php echo $info['remark'];?>" class="form-control">
          </div>
        </div>
       
        <br>
        <br>
        <div class="form-group ">
            <div class="col-sm-7 text-center">
                <input type="submit" class="btn btn-danger" value="保  存"/>
            </div>
        </div>
    </form>
    <div id="blank" style="position:fixed; right:300px;">
    </div>
</div>

<?php $this->load->view('common/footer')?>
<script>
var object = [{"obj": "#uploaders_cover_img", "btn": "#btn_cover_img"},{"obj": "#uploaders_m_cover_img", "btn": "#btn_m_cover_img"}];
seajs.use(['<?php echo css_js_url('menu_add.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
	a.cancelCheck();
	a.edit();
	a.blank();
	a.close_blank();
    <?php if(isset($min_date) && isset($max_date)):?>
    a.datepick(<?php echo $min_date?>, <?php echo $max_date?>);
    <?php else:?>
    a.datepick();
    <?php endif;?>

    swfupload.swfupload(object);
})
</script>
</body>
</html>
