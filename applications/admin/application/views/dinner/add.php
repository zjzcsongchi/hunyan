<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/dinner/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" class="form-horizontal col-sm-10">
        <div class="form-group">
            <label class="col-sm-3 control-label">姓名 *</label>
            <div class="col-sm-5">
                <input type="text" name="name" class="form-control" valType="required" msg="请输入姓名" placeholder="请输入客户姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">手机号 *</label>
            <div class="col-sm-5">
                <input type="text" name="mobile_phone" class="form-control" valType="MOBILE" msg="手机号输入不合法" placeholder="请输入客户手机号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">接单人</label>
            <div class="col-sm-5">
                <input type="text" name="receiver" class="form-control" placeholder="请输入接单人"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">合同编号</label>
            <div class="col-sm-5">
                <input type="text" name="contract_num" class="form-control" placeholder="请输入合同编号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">订单类型</label>
            <div class="col-sm-5">
                <div class="radio">
                    <label><input type="radio" name="contract_type" value="0" checked>订单合同</label>
                    <label><input type="radio" name="contract_type" value="1">预留场地</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">合同签订日期</label>
            <div class="col-sm-5">
                <input type="text" name="contract_date" class="form-control Cdate" placeholder="请选择合同签订日期">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">显示隐藏</label>
            <div class="col-sm-5">
                <div class="radio">
                    <label><input type="radio" name="is_show" value="0" checked>显示</label>
                    <label><input type="radio" name="is_show" value="1">隐藏</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">宴会场馆 *</label>
            <div class="col-sm-5">
                <ul class="list-inline">
                    <?php foreach($venue_list as $k => $v):?>
                    <li>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="<?php echo $v['id']?>" name="venue_id[]"/>
                                <?php echo $v['name']?>
                            </label>
                        </div>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">选择套餐 *</label>
            <div class="col-sm-5">
                <select class="form-control" name="menus">
                    <option value="">请选择套餐</option>
                    <?php foreach ($combo_menu as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['combo_name']?></option>
                    <?php endforeach;?>
                    <option value="0">套餐未确认</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">就餐时间</label>
            <div class="col-sm-5">
                <?php foreach ($dinner_time as $k => $v):?>
                <label class="radio-inline"><input type="radio" name="dinner_time" <?php if($k == C('dinner.time.evening.id')) echo 'checked'?> value="<?php echo $k?>"><?php echo $v?></label>
                <?php endforeach;?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">预定桌数 *</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="menus_count" valType="NUMBER" msg="请输入总份数" placeholder="请输入总份数"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">保证桌数</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="promise_count" placeholder="请输入保证桌数"/>
            </div>
        </div>
        <div id='pc' class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
                <a href="javascript:;" id='pc_'>点击上传PC端封面图 </a>
            </div>
        </div>
        
        <div id='pc_img' style='display: none;' class="form-group">
			<label class="col-sm-3 control-label">PC端封面图</label>
			<div class="col-sm-9">
				<ul id="uploaders_cover_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_cover_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">手机端封面图</label>
			<div class="col-sm-9">
				<ul id="uploaders_m_cover_img">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_m_cover_img"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">相册图片</label>
			<div class="col-sm-9">
				<ul id="uploaders_album">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_album"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">身份证（正面）</label>
			<div class="col-sm-9">
				<ul id="uploaders_id_card_photo">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_id_card_photo"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">身份证（背面）</label>
			<div class="col-sm-9">
				<ul id="uploaders_id_card_back_photo">
	                <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
	                    <a href="javascript:;" class="up-img"  id="btn_id_card_back_photo"><span>+</span><br>添加照片</a>
	                </li>
	            </ul>
			</div>
		</div>

        <div class="form-group">
            <label class="col-sm-3 control-label">预约公历时间 *</label>
            <div class="col-sm-5">
                <input type="text" class="form-control Wdate" style="height:34px" name="solar_time"  placeholder="请输入预约公历时间">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">预约农历时间</label>
            <div class="col-sm-5">
                <input type="text" class="form-control lunardate" style="height:34px" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">星期</label>
            <div class="col-sm-5">
                <input type="text" class="form-control week" readonly/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">开席时间</label>
            <div class="col-sm-5">
                <input type="text" class="form-control tdate" style="height:34px" name="banquet_time" placeholder="请选择开席时间">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">宴会类型</label>
            <div class="col-sm-5">
                <select name="venue_type" valType="required" msg="请选择宴会类型" class="form-control" id="dinnertype">
                <?php foreach($party_type as $k => $v):?>
                <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">新郎 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_main" class="form-control" placeholder="请输入新郎姓名" valType="required" msg="宴会主角不能为空">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_main_mobile" placeholder="请输入新郎电话号码">
            </div>
        </div>
        <div class="form-group dinner_marry">
            <label class="col-sm-3 control-label">新娘 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_wife" class="form-control" placeholder="请输入新娘姓名" valType="required" msg="宴会主角不能为空">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_wife_mobile" placeholder="请输入新娘电话号码">
            </div>
        </div>
        <div class="form-group dinner_other hide">
            <label class="col-sm-3 control-label">宴会主角 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_main_other" class="form-control" placeholder="请输入宴会主角" valType="required" msg="宴会主角不能为空">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_main_other_mobile" placeholder="请输入主角电话">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">签订合同人</label>
            <div class="col-sm-3">
                <input type="text" name="sign_contract" class="form-control" placeholder="签订合同人"/>
            </div>
            <div class="col-sm-3">
                <input type="text" name="sign_contract_mobile" class="form-control" placeholder="签订合同人电话"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">订金支付方式</label>
            <div class="col-sm-5">
                <select name="deposit_pay_type" valType="required" msg="请选择订金支付方式" class="form-control" >
                <?php foreach(C('order.pay_type') as $k => $v):?>
                <?php if (isset($v['id'])):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php endif;?>
                <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">已交订金</label>
            <div class="col-sm-5">
                <input type="text" name="deposit" class="form-control" placeholder="请输入已交订金"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">婚庆公司</label>
            <div class="col-sm-5">
                <input type="text" name="company" class="form-control" placeholder="请输入婚庆公司">
            </div>
        </div>
        
        <div class="form-group" style="display:none">
            <label class="col-sm-3 control-label">代金券信息</label>
            <div class="col-sm-5">
                <input type="text" name="coupon_info" class="form-control" placeholder="请输入代金券信息">
            </div>
        </div>
             <div id="coupon" class="form-group dinner_marry dinner_other">
             <label class="col-sm-3 control-label">代金券信息</label>
             <div class="col-sm-3">
                <input type="text" name="coupon[0][number]" class="form-control" placeholder="请输入代金券编号" value=""  >
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="coupon[0][money]" placeholder="请输入代金券金额"  value="" >
            </div>
                <a class="btn btn-primary btn-xs" id="add">添加</a>
            </div>

        <!--  
        <div class="form-group">
            <label class="col-sm-3 control-label">米粉</label>
            <div class="col-sm-5">
                <textarea rows="4" name="rice_flour" class="form-control" placeholder="请输入米粉信息"></textarea>
            </div>
        </div>
        
         <div class="form-group">
            <label class="col-sm-3 control-label">微请帖信息</label>
            <div class="col-sm-5">
                <textarea rows="3" name="card_info" class="form-control" placeholder="请输入微请帖信息"></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">棋牌室信息</label>
            <div class="col-sm-5">
                <textarea rows="3" name="chess_card" class="form-control" placeholder="请输入棋牌室信息"></textarea>
            </div>
        </div>
        -->
        <div class="form-group">
            <label class="col-sm-3 control-label">备注</label>
            <div class="col-sm-5">
                <textarea rows="3" name="remark" class="form-control" ></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">菜单备注</label>
            <div class="col-sm-5">
                <textarea rows="3" name="menu_remark" class="form-control" ></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">排序</label>
            <div class="col-sm-5">
                <input type="text" name="order" class="form-control" placeholder="请输入排序数字">
            </div>
        </div>
        
        <div class="form-group">
        
            <label class="col-sm-3 control-label">是否需要偏酒</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[4]" value="0" class="drink" <?php if(!isset($extend[4])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[4]" value="1" class="drink" <?php if(isset($extend[4])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[4][]" value="" placeholder="请输入偏酒数量" valType="required" msg="请输入数量">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="extend[4][]" value="" placeholder="备注" valType="required" msg="请输入备注">
            </div>
        </div>
        
         <div class="form-group" id="spring">
            <label class="col-sm-3 control-label">是否需要打屏</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[5]" value="0" class="drink" <?php if(!isset($extend[5])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[5]" value="1" class="drink" <?php if(isset($extend[5])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2 hide" >
                <input type="text" class="form-control" name="extend[5][0]" value="0" placeholder="请输入打屏数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[5][1]" value="<?php echo isset($extend[5]['remark'])? $extend[5]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="spring">
            <label class="col-sm-3 control-label">是否需要司仪</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[7]" value="0" class="drink" <?php if(!isset($extend[7])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[7]" value="1" class="drink" <?php if(isset($extend[7])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2 hide" >
7               <input type="text" class="form-control" name="extend[7][0]" value="0">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[7][1]" value="<?php echo isset($extend[7]['remark'])? $extend[7]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>
        
         <div class="form-group" id="egg">
        
            <label class="col-sm-3 control-label">是否需要鸡蛋</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[2]" value="0" class="drink" <?php if(!isset($extend[2])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[2]" value="1" class="drink" <?php if(isset($extend[2])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[2][0]" value="" placeholder="请输入鸡蛋数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[2][1]" value="" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="majiang">
            <label class="col-sm-3 control-label">是否需要麻将</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[3]" value="0" class="drink" <?php if(!isset($extend[3])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[3]" value="1" class="drink" <?php if(isset($extend[3])):?>checked<?php endif;?>>需要</label>
            </div>
            
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[3][]" value="" placeholder="请输入麻将数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[3][]" value="" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="majiang">
        <label class="col-sm-3 control-label">是否需要米粉</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[1]" value="0" class="drink" <?php if(!isset($extend[1])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[1]" value="1" class="drink" <?php if(isset($extend[1])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[1][]" value="" placeholder="请输入米粉数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[1][]" value="" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="zuzhuo">
        <label class="col-sm-3 control-label">是否需要主桌</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[8]" value="0" class="drink" <?php if(!isset($extend[8])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[8]" value="1" class="drink" <?php if(isset($extend[8])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[8][]" value="" placeholder="请输入主桌数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[8][]" value="" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="spring">
            <label class="col-sm-3 control-label">是否需要微请帖</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[6]" value="0" class="drink" <?php if(!isset($extend[6])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[6]" value="1" class="drink" <?php if(isset($extend[6])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <select class="form-control" name="extend[6][]">
                    <option value="0">请选择微请帖</option>
                    <?php foreach ($invitation as $k=>$v):?>
                    <option value="<?php echo $k?>" ><?php echo $v?></option>
                    <?php endforeach;?>
                </select>
            </div>
            
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[6][]" value="" placeholder="备注">
            </div>
            
        </div>
        
        <br>
        <br>
        <div class="form-group">
            <div class="col-sm-7 text-center">
                <input type="submit" class="btn btn-danger" value="保  存"/>
            </div>
        </div>
    </form>
</div>

<?php $this->load->view('common/footer')?>
<script>
var object = [
              {"obj": "#uploaders_cover_img", "btn": "#btn_cover_img"},
              {"obj": "#uploaders_m_cover_img", "btn": "#btn_m_cover_img"},
              {"obj": "#uploaders_album", "btn": "#btn_album"},
              {"obj": "#uploaders_id_card_photo", "btn": "#btn_id_card_photo"},
              {"obj": "#uploaders_id_card_back_photo", "btn": "#btn_id_card_back_photo"},
              ];
seajs.use(['<?php echo css_js_url('dinner.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
    a.add_coupon();
    a.remove_coupon();
    // a.extend_show();
    a.save();
    a.show();
    <?php if(isset($min_date) && isset($max_date)):?>
    a.datepick(<?php echo $min_date?>, <?php echo $max_date?>);
    <?php else:?>
    a.datepick();
    <?php endif;?>
    a.choose_menus();
    a.dinner_type();
    swfupload.swfupload(object);
})
</script>
</body>
</html>
