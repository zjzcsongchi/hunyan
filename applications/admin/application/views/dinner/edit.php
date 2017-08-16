<?php $this->load->view('common/header2')?>
<ol class="breadcrumb">
    <li><a href="/common">首页</a></li>
    <li><a href="/dinner/index"><?php echo $title[0]?></a>
    <li><a href="#"><?php echo $title[1]?></a></li>
</ol>

<div class="container-fluid">
    <form id="base" class="form-horizontal col-sm-10">
        <input type="hidden" name="id" value="<?php echo $info['id']?>"/>
        <input type="hidden" name="user_id" value="<?php echo $info['user']['id'] ?>"?>
        <div class="form-group">
            <label class="col-sm-3 control-label">姓名 *</label>
            <div class="col-sm-5">
                <input type="text" name="name" value="<?php echo $info['user']['name']?>" class="form-control" valType="required" msg="请输入姓名" placeholder="请输入客户姓名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">手机号 *</label>
            <div class="col-sm-5">
                <input type="text" name="mobile_phone" value="<?php echo $info['user']['mobile_phone']?>" class="form-control" valType="MOBILE" msg="手机号输入不合法" placeholder="请输入客户手机号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">接单人</label>
            <div class="col-sm-5">
                <input type="text" name="receiver" class="form-control" value="<?php echo $info['receiver']?>" placeholder="请输入接单人"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">合同编号</label>
            <div class="col-sm-5">
                <input type="text" name="contract_num" value="<?php echo $info['contract_num']?>" class="form-control" placeholder="请输入合同编号">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">订单类型</label>
            <div class="col-sm-5">
                <div class="radio">
                    <label><input type="radio" name="contract_type" value="0" <?php if($info['contract_type'] == 0):?>checked<?php endif;?>>订单合同</label>
                    <label><input type="radio" name="contract_type" value="1" <?php if($info['contract_type'] == 1):?>checked<?php endif;?>>预留场地</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">合同签订日期</label>
            <div class="col-sm-5">
                <input type="text" name="contract_date" class="form-control Cdate" value="<?php echo $info['contract_date']?>" placeholder="请选择合同签订日期">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">显示隐藏</label>
            <div class="col-sm-5">
                <div class="radio">
                    <label><input type="radio" name="is_show" value="0" <?php if($info['is_show'] == 0):?>checked<?php endif;?>>显示</label>
                    <label><input type="radio" name="is_show" value="1" <?php if($info['is_show'] == 1):?>checked<?php endif;?>>隐藏</label>
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
                                <input type="checkbox" value="<?php echo $v['id']?>" name="venue_id[]" <?php if(in_array($v['id'], $info['venue_ids'])) echo 'checked'?>/>
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
                    <?php foreach ($combo_menu as $k => $v):?>
                    <option value="<?php echo $v['id']?>" <?php if(isset($info['detail']['menus_id']) && $info['detail']['menus_id'] == $v['id']) echo 'selected';?>><?php echo $v['combo_name']?></option>
                    <?php endforeach;?>
                    <option value="0" <?php if(!isset($info['detail']['menus_id'])) echo 'selected'?>>套餐未确认</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">就餐时间</label>
            <div class="col-sm-5">
                <?php foreach ($dinner_time as $k => $v):?>
                <label class="radio-inline"><input type="radio" name="dinner_time" <?php if($k == $info['dinner_time']) echo 'checked'?> value="<?php echo $k?>"><?php echo $v?></label>
                <?php endforeach;?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">预定桌数 *</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="menus_count" value="<?php echo $info['menus_count']?>" valType="NUMBER" msg="请输入总份数" placeholder="请输入总份数"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">保证桌数</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="promise_count" placeholder="请输入保证桌数" value="<?php echo $info['promise_count']?>"/>
            </div>
        </div>
        <div id='pc' class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-5">
                <a href="javascript:;" id='pc_'>点击显示PC端封面图 </a>
            </div>
        </div>
        <div id='pc_img' style='display: none;' class="form-group">
			<label class="col-sm-3 control-label">PC端封面图</label>
			<div class="col-sm-9">
				<ul id="uploaders_cover_img">
    				<?php if($info['cover_img']):?>
    				<?php foreach ($info['cover_img'] as $k => $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo $info['cover_img_url'][$k];?>" target="_blank"><img src="<?php echo $info['cover_img_url'][$k];?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="cover_img[]" value="<?php echo $v;?>"/>
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
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
    				<?php if($info['m_cover_img']):?>
    				<?php foreach ($info['m_cover_img'] as $k => $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo $info['m_cover_img_url'][$k]?>" target="_blank"><img src="<?php echo $info['m_cover_img_url'][$k]?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="m_cover_img[]" value="<?php echo $v;?>"/>
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
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
    				<?php if(isset($info['album_url']) && $info['album_url']):?>
    				<?php foreach ($info['album_url'] as $k => $v):?>
                        <li class='pic pro_gre' style='margin-right: 20px; clear:none;'>
                            <a class='close del-pic' href='javascript:;'></a>
                            <a href="<?php echo get_img_url($info['album_url'][$k])?>" target="_blank"><img src="<?php echo get_img_url($info['album_url'][$k])?>" style='width:100%;height:100%'/></a>
                            <input type="hidden" name="album[]" value="<?php echo $v;?>"/>
                        </li>
                    <?php endforeach;?>
                    <?php endif;?>
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
                    <?php if (isset($info['id_card_photo']) && $info['id_card_photo']): ?>
                    <li class="pic pro_gre" style="margin-right: 20px; clear:none;">
                        <a class="close del-pic" href="javascript:;"></a>
                        <a href="<?php echo get_img_url($info['id_card_photo']); ?>" target="_blank"><img src="<?php echo get_img_url($info['id_card_photo']); ?>" style="width:100%;height:100%"/></a>
                        <input type="hidden" name="id_card_photo[]" value="<?php echo $info['id_card_photo']; ?>"/>
                    </li>
                    <?php endif; ?>
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
                    <?php if (isset($info['id_card_back_photo']) && $info['id_card_back_photo']): ?>
                    <li class="pic pro_gre" style="margin-right: 20px; clear:none;">
                        <a class="close del-pic" href="javascript:;"></a>
                        <a href="<?php echo get_img_url($info['id_card_back_photo']); ?>" target="_blank"><img src="<?php echo get_img_url($info['id_card_back_photo']); ?>" style="width:100%;height:100%"/></a>
                        <input type="hidden" name="id_card_back_photo[]" value="<?php echo $info['id_card_back_photo']; ?>"/>
                    </li>
                    <?php endif; ?>
                    <li class="pic pic-add add-pic" style="float: left;width: 220px;height: 175px;clear:none;">
                        <a href="javascript:;" class="up-img"  id="btn_id_card_back_photo"><span>+</span><br>添加照片</a>
                    </li>
                </ul>
            </div>
        </div>

       <div class="form-group">
            <label class="col-sm-3 control-label">预约公历时间 *</label>
            <div class="col-sm-5">
                <input type="text" value="<?php echo $info['solar_time']?>" class="form-control Wdate" style="height:34px" name="solar_time" placeholder="请输入预约公历时间">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">预约农历时间</label>
            <div class="col-sm-5">
                <input type="text" class="form-control lunardate" value="<?php echo $info['lunar_time']?>" name="lunar_time" readonly>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">星期</label>
            <div class="col-sm-5">
                <input type="text" class="form-control week" value="<?php echo $info['week']; ?>" readonly/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">开席时间</label>
            <div class="col-sm-5">
                <input type="text" class="form-control tdate" value="<?php echo $info['banquet_time']?>" style="height:34px" name="banquet_time" placeholder="请选择开席时间">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">宴会类型</label>
            <div class="col-sm-5">
                <select name="venue_type" valType="required" msg="请选择宴会类型" class="form-control" id="dinnertype">
                <?php foreach($party_type as $k => $v):?>
                <option value="<?php echo $v['id']?>" <?php echo $info['venue_type'] == $v['id'] ? 'selected' : '';?>><?php echo $v['name']?></option>
                <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group dinner_marry <?php echo $info['venue_type'] == C('party.wedding.id') ? 'show' : 'hide'?>">
            <label class="col-sm-3 control-label">新郎 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_main" class="form-control" placeholder="请输入新郎姓名" value="<?php echo $info['roles_main']?>" valType="required" msg="宴会主角不能为空">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_main_mobile" value="<?php echo $info['roles_main_mobile']?>" placeholder="请输入新郎电话号码">
            </div>
        </div>
        <div class="form-group dinner_marry <?php echo $info['venue_type'] == C('party.wedding.id') ? 'show' : 'hide'?>">
            <label class="col-sm-3 control-label">新娘 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_wife" value="<?php echo $info['roles_wife']?>" class="form-control" placeholder="请输入新娘姓名" valType="required" msg="宴会主角不能为空">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" value="<?php echo $info['roles_wife_mobile']?>" name="roles_wife_mobile" placeholder="请输入新娘电话号码">
            </div>
        </div>
        <div class="form-group dinner_other <?php echo $info['venue_type'] == C('party.wedding.id') ? 'hide' : 'show'?>">
            <label class="col-sm-3 control-label">宴会主角 *</label>
            <div class="col-sm-3">
                <input type="text" name="roles_main_other" value="<?php echo $info['roles_main']?>" class="form-control" placeholder="请输入宴会主角" valType="required" msg="宴会主角不能为空">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="roles_main_other_mobile" value="<?php echo $info['roles_main_mobile']?>" placeholder="请输入主角电话">
            </div>
        </div>
        
        
        <div class="form-group dinner_parent <?php echo in_array($info['venue_type'], [C('party.birthday.id'), C('party.champion.id'), C('party.bairiyan.id'), C('party.manyuejiu.id')]) ? 'show' : 'hide'?>">
            <label class="col-sm-3 control-label">主角父亲</label>
            <div class="col-sm-2">
                <input type="text" name="roles_father" value="<?php echo $info['roles_father']?>" class="form-control" placeholder="请输入宴会主角父亲">
            </div>
            
            <label class="col-sm-1 control-label">主角母亲</label>
            <div class="col-sm-2">
                <input type="text" name="roles_mother" value="<?php echo $info['roles_mother']?>" class="form-control" placeholder="请输入宴会主角母亲" >
            </div>
        </div>

        
        <div class="form-group">
            <label class="col-sm-3 control-label">签订合同人</label>
            <div class="col-sm-3">
                <input type="text" name="sign_contract" class="form-control" value="<?php echo $info['sign_contract']?>" placeholder="签订合同人"/>
            </div>
            <div class="col-sm-3">
                <input type="text" name="sign_contract_mobile" class="form-control" value="<?php echo $info['sign_contract_mobile']?>" placeholder="签订合同人电话"/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">订金支付方式</label>
            <div class="col-sm-5">
                <select name="deposit_pay_type" valType="required" msg="请选择订金支付方式" class="form-control" >
                <?php foreach(C('order.pay_type') as $k => $v):?>
                <?php if (isset($v['id'])):?>
                    <option value="<?php echo $v['id']?>" <?php echo $deposit_pay_type == $v['id'] ? 'selected' : '';?> ><?php echo $v['name']?></option>
                <?php endif;?>
                <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">已交订金</label>
            <div class="col-sm-5">
                <input type="text" value="<?php echo $info['deposit']?>" class="form-control" name="deposit" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">婚庆公司</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="company" value="<?php echo $info['company']?>" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">微请帖信息</label>
            <div class="col-sm-5">
                <textarea rows="3" class="form-control" name="card_info"><?php echo $info['card_info']?></textarea>
            </div>
        </div>
        <div class="form-group" style="display:none">
            <label class="col-sm-3 control-label">代金券信息</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="coupon_info" value="<?php echo $info['coupon_info']?>" >
            </div>
        </div>
	
	<?php if(!$old_coupon_lists):?>
	     <div id="coupon" class="form-group dinner_marry <?php echo $info['venue_type'] == C('party.wedding.id') ? 'show' : 'hide'?>">
	     <label class="col-sm-3 control-label">代金券信息</label>
	     <div class="col-sm-3">
                <input type="text" name="coupon[0][number]" class="form-control" placeholder="请输入代金券编号" value=""  >
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="coupon[0][money]" placeholder="请输入代金券金额"  value="" >
            </div>
		<a class="btn btn-primary btn-xs" id="add">添加</a>
	    </div>
	<?php else:?>
	
	<?php foreach($old_coupon_lists as $k => $v):?>
	<?php if($k == 0):?>	
	<div id="coupon" class="form-group dinner_marry <?php echo $info['venue_type'] == C('party.wedding.id') ? 'show' : 'hide'?>">
            <label class="col-sm-3 control-label">代金券信息</label>
	<?php else:?>
	<div class="form-group dinner_marry "><label class="col-sm-3 control-label"></label>
	<?php endif;?>
            <div class="col-sm-3">
                <input type="text" name="coupon[<?php echo $k?>][number]" class="form-control" placeholder="请输入代金券编号" value="<?php echo $v['number']?>" valType="required" msg="请输入代金券编号" >
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="coupon[<?php echo $k?>][money]" placeholder="请输入代金券金额"  value="<?php echo $v['money']?>" valType="required" msg="请输入代金券金额">
            </div>
	    <?php if($k == 0):?>
		<a class="btn btn-primary btn-xs" id="add">添加</a>
	    <?php else:?>
		<a class="coupon_del btn btn-primary btn-xs">删除</a>
	    <?php endif;?>
        </div>
	<?php endforeach;?>
	<?php endif;?>


        <div class="form-group">
            <label class="col-sm-3 control-label">棋牌室信息</label>
            <div class="col-sm-5">
                <textarea rows="3" class="form-control" name="chess_card"><?php echo $info['chess_card']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">米粉</label>
            <div class="col-sm-5">
                <textarea rows="4" name="rice_flour" class="form-control" placeholder="请输入米粉信息"><?php echo $info['rice_flour']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">备注</label>
            <div class="col-sm-5">
                <textarea rows="3" class="form-control" name="remark"><?php echo $info['remark']?></textarea>
            </div>
        </div>

	<div class="form-group">
            <label class="col-sm-3 control-label">菜单备注</label>
            <div class="col-sm-5">
                <textarea rows="3" name="menu_remark" class="form-control" ><?php echo $info['menu_remark']?></textarea>
            </div>
        </div>	

        <div class="form-group">
            <label class="col-sm-3 control-label">排序</label>
            <div class="col-sm-5">
                <input type="text" name="order" class="form-control" placeholder="请输入排序数字" value="<?php echo $info['order']?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">是否需要偏酒</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[4]" value="0" class="drink" <?php if(empty($extend[4]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[4]" value="1" class="drink" <?php if(!empty($extend[4]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[4][]" value="<?php echo isset($extend[4]['num'])? $extend[4]['num']:'' ?>" placeholder="请输入偏酒数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[4][]" value="<?php echo isset($extend[4]['remark'])? $extend[4]['remark']:'' ?>" placeholder="备注" valType="required" msg="请输入备注">
            </div>
        </div>
        
         <div class="form-group" id="spring">
            <label class="col-sm-3 control-label">是否需要打屏</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[5]" value="0" class="drink" <?php if(empty($extend[5]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[5]" value="1" class="drink" <?php if(!empty($extend[5]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2 hide" >
                <input type="text" class="form-control" name="extend[5][]" value="0" placeholder="请输入打屏数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[5][]" value="<?php echo isset($extend[5]['remark'])? $extend[5]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>

         <div class="form-group" id="mc">
            <label class="col-sm-3 control-label">是否需要司仪</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[7]" value="0" class="drink" <?php if(empty($extend[7]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[7]" value="1" class="drink" <?php if(!empty($extend[7]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2 hide" >
                <input type="text" class="form-control" name="extend[7][]" value="0">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[7][]" value="<?php echo isset($extend[7]['remark'])? $extend[7]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>

         <div class="form-group" id="egg">
        
            <label class="col-sm-3 control-label">是否需要鸡蛋</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[2]" value="0" class="drink" <?php if(empty($extend[2]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[2]" value="1" class="drink" <?php if(!empty($extend[2]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[2][]" value="<?php echo isset($extend[2]['num']) ? $extend[2]['num'] :'' ?>" placeholder="请输入鸡蛋数量">
            </div>
            <div class="col-sm-3 "  >
                <input type="text" class="form-control" name="extend[2][]" value="<?php echo isset($extend[2]['remark'])? $extend[2]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="majiang">
            <label class="col-sm-3 control-label">是否需要麻将</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[3]" value="0" class="drink" <?php if(empty($extend[3]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[3]" value="1" class="drink" <?php if(!empty($extend[3]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[3][]" value="<?php echo isset($extend[3]['num']) ?$extend[3]['num'] :'' ?>" placeholder="请输入麻将数量">
            </div>
            <div class="col-sm-3 " >
                <input type="text" class="form-control" name="extend[3][]" value="<?php echo isset($extend[3]['remark'])? $extend[3]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="majiang">
        <label class="col-sm-3 control-label">是否需要米粉</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[1]" value="0" class="drink" <?php if(empty($extend[1]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[1]" value="1" class="drink" <?php if(!empty($extend[1]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[1][]" value="<?php echo isset($extend[1]['num']) ?$extend[1]['num'] :'' ?>" placeholder="请输入米粉数量">
            </div>
            <div class="col-sm-3 " >
                <input type="text" class="form-control" name="extend[1][]" value="<?php echo isset($extend[1]['remark'])? $extend[1]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="zuzhuo">
            <label class="col-sm-3 control-label">是否需要主桌</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[8]" value="0" class="drink" <?php if(empty($extend[8]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[8]" value="1" class="drink" <?php if(!empty($extend[8]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <input type="text" class="form-control" name="extend[8][]" value="<?php echo isset($extend[8]['num']) ?$extend[8]['num'] :'' ?>" placeholder="请输入主桌数量">
            </div>
            <div class="col-sm-3" >
                <input type="text" class="form-control" name="extend[8][]" value="<?php echo isset($extend[8]['remark'])? $extend[8]['remark']:'' ?>" placeholder="备注">
            </div>
        </div>
        
        <div class="form-group" id="spring">
            <label class="col-sm-3 control-label">是否需要微请帖</label>
            <div class="col-sm-2">
                <label class="radio-inline"><input type="radio" name="is_check[6]" value="0" class="drink" <?php if(empty($extend[6]['is_need'])):?>checked<?php endif;?>>不需要</label>
                <label class="radio-inline"><input type="radio" name="is_check[6]" value="1" class="drink" <?php if(!empty($extend[6]['is_need'])):?>checked<?php endif;?>>需要</label>
            </div>
            <div class="col-sm-2" >
                <select class="form-control" name="extend[6][]">
                    <option value="0">请选择微请帖</option>
                    <?php foreach ($invitation as $k=>$v):?>
                    <option value="<?php echo $k?>" <?php if(isset($extend[6]['num']) && ($k == $extend[6]['num'])):?>selected<?php endif;?>><?php echo $v?></option>
                    <?php endforeach;?>
                </select>
            </div>
            
            <div class="col-sm-3 " >
                <input type="text" class="form-control" name="extend[6][]" value="<?php echo isset($extend[6]['remark'])? $extend[6]['remark']:'' ?>" placeholder="备注">
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
    <!-- 显示菜谱 套餐 -->
    <form class="form-horizontal hide" id="combo">
    <table class="table table-bordered table-condensed">
    <?php foreach ($combo_menu as $k => $v):?>
        <tr>
            <td>
                <div class="form-group" style="margin-bottom:0">
                    <div class="checkbox col-sm-8">
                        <label>
                            <input type="checkbox" value="<?php echo $v['id']?>" ><?php echo $v['combo_name']?>
                        </label>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" value="<?php echo isset($v['buy_number']) ? $v['buy_number'] : '1'?>">
                    </div>
                    <label class="control-label">份</label>
                </div>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
    </form>
    <!-- 菜谱显示  单份-->
    <form class="form-horizontal hide" id="single">
    <table class="table table-bordered table-condensed">
    <?php if(isset($single_menu) && $single_menu):?>
    <?php foreach ($single_menu as $v):?>
    <tr>
    <td>
        <div class="form-group" style="margin-bottom:0">
            <div class="checkbox col-sm-8">
                <label>
                    <input type="checkbox" value="<?php echo $v['id']?>" <?php echo isset($v['checked']) ? $v['checked'] : ''?>><?php echo $v['name']?>
                </label>
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control input-sm" value="<?php echo isset($v['buy_number']) ? $v['buy_number'] : '1'?>">
            </div>
            <label class="control-label">份</label>
        </div>
    </td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    </table>
    </form>
</div>

<?php $this->load->view('common/footer')?>
<script>
var object = [{"obj": "#uploaders_cover_img", "btn": "#btn_cover_img"},
              {"obj": "#uploaders_m_cover_img", "btn": "#btn_m_cover_img"},
              {"obj": "#uploaders_album", "btn": "#btn_album"},
              {"obj": "#uploaders_id_card_photo", "btn": "#btn_id_card_photo"},
              {"obj": "#uploaders_id_card_back_photo", "btn": "#btn_id_card_back_photo"},
            ];
seajs.use(['<?php echo css_js_url('dinner.js', 'admin')?>', 'admin_uploader','jqvalidate','jqueryswf','swfupload'], function(a, swfupload){
    a.add_coupon();
    a.remove_coupon();
    // a.extend_show();
    a.edit();
    a.show();
    a.datepick();
    a.choose_menus();
    a.dinner_type();
    swfupload.swfupload(object);
})
</script>
</body>
</html>
