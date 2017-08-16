<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>百年婚宴 - 电子合同</title>
    <meta name="keywords" content="百年婚宴 - 电子合同">
    <meta name="description" content="百年婚宴 - 电子合同">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"> 

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('word.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('bootstrap.min.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo css_js_url('signature-pad.css', 'admin');?>">
    <link href="<?php echo css_js_url('my_dialog.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo css_js_url('ui-dialog.css', 'admin');?>" type="text/css" rel="stylesheet"/>
    
    <link href="<?php echo css_js_url('ht.css', 'admin');?>" type="text/css" rel="stylesheet"/>

</head>
<body>
<div class="bg">
    <div class="page-main">
        <h1 class="head">百年婚宴定餐合同</h1>
        <p class="pact-text jia">甲方：<span>安顺市百年婚宴有限公司</span></p>
        <p class="pact-text yi">乙方： <span><?php echo $dinner['name']?></span> </p>
        <div class="pact-text text-indent">
        	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;十分感谢您选择“百年婚宴”举办您即将到来的宴会，根据《中华人民共和国合同法》《中华人民共和国消费者权益</p></br>
        	<p>&nbsp;&nbsp;保护法》及有关法律法规，结合本次消费的具体情况，甲乙双方在自愿平等，公平诚信的原则基础上，经双方协商一致，</p><br />
        	<p>&nbsp;&nbsp;签订本合同。</p>
        </div>
        <div class="dic">一. 定餐细则：</div>
        <p class="pact-text yuding"> 1. 预收定金：甲乙双方签订此协议时，乙方需向甲方交付预定金人民币大写：
                          
            <span class="type2"><?php echo $dinner['deposit']?></span> （大写：<span class="type2"><?php echo $dinner['deposit_daxie']?> </span> 元） 
                        （
                 <?php foreach (C('order.pay_type') as $v):?>
                        <label><input type="radio" name="pay_type" value="<?php echo $v['id']?>" <?php echo $v['id'] == $dinner['pay_type'] ? 'checked="checked"' : '' ?> class="cbx"> <?php echo $v['name']?> </label>  
                <?php endforeach;?>
                
                          ） 
                          本协议方为生效，否则甲方有权不履行协议的预订。
        </p>
        <div class="form">
          <form action="#" method="post" >
          
            <h6 >宴会时间：</h6>
        	<div class="form1 " style="margin-left: 15px;margin-bottom: 50px;">
        		<p class="width25">公历：
        		    <span class="type2"><?php echo $dinner['solar_time']?></span>
        		</p>
        		<p class="width25">农历：
        		      <span class="type2"><?php echo $dinner['lunar_time']?></span>
        		    
        		</p>
        		<p class="width25">星期：
        		     <span class="type2"><?php echo $dinner['week']?></span>
        		</p>
        		<p class="width25">

        		    <label>晚餐<input type="radio" name="dinner_time" value="1" <?php echo $dinner['dinner_time']==1?'checked="checked"':'';?> /></label>
                <label>中餐<input type="radio" name="dinner_time" value="2" <?php echo $dinner['dinner_time']==2?'checked="checked"':'';?> /></label>
        		</p>
        	</div>
        	
        	
        	<h6 style="margin-top: 10px;">宴会类型：</h6>
        	<div class="form1">
        		<ul>
                    <?php foreach($party_type as $k => $v):?>
                        <li>
                        <label>
                        <input type="radio" name="venue_type" value="<?php echo $v['id']?>" <?php echo $v['id'] == $dinner['venue_type']? 'checked="checked"': '';?> />
                            <?php echo $v['name']?>
                        </label>
                        </li>
                    <?php endforeach;?>
        		</ul>
        		<?php if($dinner['venue_type'] == C('party.wedding.id')):?>
        		<div class="dinner_marry" style="margin-bottom: 40px;">
	        		<p class="width25">新郎：
	        			<span class="type2"><?php echo $dinner['roles_main']?></span>
	        		</p>
	        		<p class="width25">电话：
	        		     <span class="type2"><?php echo $dinner['roles_main_mobile']?></span>
	        		</p>
	        		<p class="width25">新娘：
	        		     <span class="type2"><?php echo $dinner['roles_wife']?></span>
	        		</p>
	        		<p class="width25">电话：
	        		     <span class="type2"><?php echo $dinner['roles_wife_mobile']?></span>
	        		</p>
	            </div>
		        <?php elseif(in_array($dinner['venue_type'],[C('party.champion.id'), C('party.bairiyan.id'), C('party.manyuejiu.id')])): ?>
	            <ul>
                    <li style="width:50%;">
                                             宴会主角：
	        			 <span ><?php echo $dinner['roles_main']?></span>
                    </li>
                    <li style="width:25%;">
                                             电话：
	        		     <span ><?php echo $dinner['roles_main_mobile']?></span>
                    </li>
                    <li style="width:50%;">
                                             父亲：
	        			 <span ><?php echo $dinner['roles_father']?></span>
                    </li>
                    <li style="width:25%;">
                                             母亲：
	        		     <span ><?php echo $dinner['roles_mother']?></span>
                    </li>
        		</ul>
        		<?php else: ?>
        		<ul>
                    <li style="width:50%;">
                                             宴会主角：
	        			 <span ><?php echo $dinner['roles_main']?></span>
                    </li>
                    <li style="width:25%;">
                                             电话：
	        		     <span ><?php echo $dinner['roles_main_mobile']?></span>
                    </li>
        		</ul>
	            <?php endif;?>
	            
        	</div>
        	
        	<h6>宴会场馆：</h6>
        	<div class="form1">
        		<ul>
        		<?php foreach($venue_list as $k => $v):?>
        		    <li>
                    <label>
                        <input type="checkbox" value="<?php echo $v['id']?>" name="venue_id[]" <?php echo in_array($v['id'], $dinner['venue_ids'])?'checked="checked"':'';?> /><?php echo $v['name']?>
                    </label>
                    </li>
                <?php endforeach;?>
        		</ul>	
        	</div>
        	<div class="req fix" style="line-height:40px;">
        		<ul>
        			<li><p style="font-size:16px ;font-weight: bolder;">预定桌数 <i >（10人/席）</i>：<span><?php echo $dinner['menus_count']?></span> 桌</p></li>
        			<li><p style="font-size:16px ;font-weight: bolder;">保证桌数 <i>（10人/席）</i>：<span><?php echo $dinner['promise_count']?></span> 桌</p></li>
        		</ul>
        	</div>  
        	<h6 >宴会餐标：</h6>
        	<div class="form1">
        		<ul>
        		<?php foreach($combo_menus as $k => $v):?>
                    <li>
                    <label>
                        <input type="radio" name="menus" value="<?php echo $v['id']?>" <?php echo $dinner['menus_id']==$v['id']?'checked="checked"':'';?> />
                        <?php echo $v['combo_name']?>
                    </label>
                    </li>
                <?php endforeach;?>
                <li><label><input type="radio" name="menus" value="0" />未确定</label></li>
        		</ul>	
        	</div>
        	
        	<div class="req fix mif" style="line-height:40px;">
        		<ul>
        			<li><p style="font-size:16px ;font-weight: bolder;">中餐米粉<i>（10元/碗）</i>：</p></li>
        			
        			
        			<?php if(!isset($dinner_extend[C('dinner_extend.rice_noodle.id')])):?>
                        <li><label><input type="radio" name="rice_noodle" value="0" checked="checked" />不需要 </label></li>
                        <li><label><input type="radio" name="rice_noodle" value="1" />需要 </label> </li>
                    <?php else:?>
                        <li><label><input type="radio" name="rice_noodle" value="0"  />不需要 </label></li>
                        <li><label><input type="radio" name="rice_noodle" value="1" checked="checked" />需要  </label>
                            (<span> <?php echo $dinner_extend[C('dinner_extend.rice_noodle.id')]['num']?> </span>/碗 ) 
                        </p>
                    <?php endif;?>
                    
        		</ul>
        	</div> 
        	
        	<div class="req fix mif" style="line-height:40px;">
        		<ul>
        			<li><p style="font-size:16px ;font-weight: bolder;">鸡蛋<i>（0.52元/个，185/件）</i>：</p></li>
        			<?php if(!isset($dinner_extend[C('dinner_extend.egg.id')])):?>
                        <li><label><input type="radio" name="egg" value="0" checked="checked" />不需要 </label></li>
                        <li><label><input type="radio" name="egg" value="1" />需要 </label> </li>
                    <?php else:?>
                        <li><label><input type="radio" name="egg" value="0"  />不需要 </label></li>
                        <li><label><input type="radio" name="egg" value="1" checked="checked" />需要  </label>
                            (<span> <?php echo $dinner_extend[C('dinner_extend.egg.id')]['num']?> </span>/个 ) 
                        </p>
                    <?php endif;?>
        		</ul>
        	</div>
        	<div class="req">
        		<ul>
        			<li><h6 style="display: inline-block;">是否需要偏酒</h6></li>
        			
        			<?php if(!isset($dinner_extend[C('dinner_extend.pianjiu.id')])):?>
                        <li style="margin: 0px 32px;"><label><input type="radio" name="wine" value="0" checked="checked"/>不需要</label></li>
                        <li><label><input type="radio" name="wine" value="1" />需要</label></li>
                    <?php else:?>
                        <li style="margin: 0px 32px;"><label><input type="radio" name="wine" value="0" />不需要</label></li>
            			<li><label><input type="radio" name="wine" value="1" checked="checked" />需要</label>(备注：<span> <?php echo $dinner_extend[C('dinner_extend.pianjiu.id')]['remark']?> </span> )</li>
                    <?php endif;?>

        		</ul>
        	</div>
        	<div class="req" style="line-height:40px;">
        		<ul>
        			<li><h6 style="display: inline-block;">是否需要打屏</h6></li>
        			<?php if(!isset($dinner_extend[C('dinner_extend.daping.id')])):?>
                        <li style="margin: 0px 32px;"><label><input type="radio" name="screen" value="0" checked="checked"/>不需要</label></li>
                        <li><label><input type="radio" name="screen" value="1" />需要</label></li>
                    <?php else:?>
                        <li style="margin: 0px 32px;"><label><input type="radio" name="screen" value="0" />不需要</label></li>
            			<li><label><input type="radio" name="screen" value="1" checked="checked" />需要</label>(备注：<span> <?php echo $dinner_extend[C('dinner_extend.daping.id')]['remark']?> </span> )</li>
                    <?php endif;?>
        		</ul>
        	</div>
        	<h6>宴会请帖：</h6>
        	<div class="form2">
        		<ul>
        		    <?php foreach (C('dinner_extend.invitation.type') as $k => $v):?>
        		        <li><label><input <?php echo isset($dinner_extend[C('dinner_extend.invitation.id')]) && $dinner_extend[C('dinner_extend.invitation.id')]['num']==$v['id']?'checked="checked"':'';?> type="radio" name="invitation" value="<?php echo $v['id']?>" /><?php echo $v['name']?> </label></li>
                    <?php endforeach;?>
        		</ul>
        		<div style="margin-left: 60px">
        		(宴会请帖备注：<span> <?php echo isset($dinner_extend[C('dinner_extend.invitation.id')]) ? $dinner_extend[C('dinner_extend.invitation.id')]['remark'] : '无'?> </span>)
        		</div>
            </div>
            
            <div style="padding:20px 0px;">
            	<h6>定制个人请柬须提前2个月发照片到公司QQ邮箱:1991743888</h6>
            </div>
            
            <h6 >米兰代金券：</h6>
        	<div class="form-coupon">
        	   <ul>
                   <?php if($coupon):?>
                        <?php $flag = false; ?>
            	        <?php foreach ($coupon as $k => $v):?>
                            <?php if ($v['number'] && $v['money']):?>
                               <?php $flag = true ?>
                               <li>
                                   <span>编号：<span class="underline"><?php echo $v['number']?></span></span>
                                   <span>金额：<span class="underline"><?php echo $v['money']?> 元</span></span>
                               </li>
                            <?php endif;?>
            	        <?php endforeach;?>
                        <?php if (!$flag) { echo '<p>无</p>'; } ?>
            	   <?php else:?>
                	<p>无</p>
            	   <?php endif;?>
        	   </ul>
        	</div>
            
        	
        	<div class="req fix" style="line-height:40px;">
        		<ul>
        			<li><p style="font-size:16px ;font-weight: bolder;">婚庆公司：<span><?php echo $dinner['company']?></span> </p></li>
        			<li><p style="font-size:16px ;font-weight: bolder;">麻 将<i>（10人/席）</i>：<span><?php echo isset($dinner_extend[C('dinner_extend.mahjong.id')]) ? $dinner_extend[C('dinner_extend.mahjong.id')]['num'] : 0;?></span> 桌</p></li>
        		</ul>
        	</div> 
        			
        	
        	<h6>定餐客户现住地址:<span><?php echo $dinner['customer_address']?></span> </h6>
        	<h6 style="line-height: 50px;">定餐客户公司单位:<span><?php echo $dinner['customer_company']?></span> </h6>
        	
        	<h6 style="line-height: 50px;">客户身份证复印件：</h6>
        	<div class="card">
        		<img style="width: 93mm;height: 53mm;"src="<?php echo get_img_url($dinner['id_card_photo'])?>">
        	</div>
        	<div class="card">
        		<img style="width: 93mm;height: 53mm;"src="<?php echo get_img_url($dinner['id_card_back_photo'])?>">
        	</div>
        	
        	<div class="tex">
        		<textarea name="remark" rows="" cols="">备注：<?php echo $dinner['remark']?> </textarea>
        	</div>

        	<h6 style="margin-top: 30px;line-height: 30px;">客户须知:</h6>
        	<div class="res" style="padding-left:20px ;">
        		    <p class="table-text1">1.带壳花生、瓜子、坚果类不允许带入酒店<i style="font-style:normal;color:#B7B7B7;font-weight: 100;">(糖果类不限制)</i> </p>
                    <p class="table-text1">2.纸质喷花、瓶装啤酒不允许带入酒店；</p>
                    
                    <p class="table-text1">3.19:00前需要上菜的客户，乙方须提前1天电话/短信提醒甲方。  </p>
        		    <p class="table-text1">4.预定桌数为保证桌数的10%； </p>
                    <p class="table-text1">5.婚宴场地按预定桌数保留位置；</p>
                    <p class="table-text1">6.婚宴用餐地点均不包场:</p>
                    <p class="table-text1">7.百年好合厅迎宾区：进门右边（共用金色年华厅通道）。  </p>
                    <p class="table-text1">8.金色年华厅迎宾区：进门左边。</p>
                    <p class="table-text1">9.<?php echo date('Y')?>年定<?php echo date('Y')+1 ?>年的酒席，执行<?php echo date('Y')+1?>年的菜单及价格（乙方不能强行或无理要求甲方按<?php echo date('Y')?>年的菜单及价格收费，并以此作为拒付款或打折付款的理由）。</p>
                    <div style="width:70%;padding: 10px;background: #E9E9E9;margin-top: 15px;">
                    	<p style="color: #f00;"><span>特别提示：对客户须知1-9项的全部内容完全明白和同意</span></p>
                    	
                    </div>
        	</div>
        	
        	
        	
          </form>
        </div>
        	
        	<div class="text3">
        		<ul>
        			<li>
        				<p class="pact-text">2.婚庆公司进场费用：<span>人民币大写：壹仟元小写：1000元/单场</span>（详见进场协议）</p>
        			</li>
        			<li>
        				<p class="pact-text">3.预定桌数：如果当天宴席桌数多于合同确认的保证桌数，甲方仍按照实际桌数收取费用；</p>
        			</li>
        			<li>
        				<p class="pact-text">4.保证桌数：如果当天宴席桌数少于合同确认的保证桌数，甲方按合同确认的保证桌数50%结账（如乙方全额付款，需要补吃由甲方根据空闲场地安排，为确保遗留菜品质量，乙方必须3日内补吃完毕，3日后视作自动放弃，补吃仅限于晚餐，上菜时间19：00或19:30。</p>
        			</li>
        			<li class="red">
        				<p class="pact-text">5.婚宴场地按预定桌数保留位置，如乙方临时增加桌数，甲方场地已排满，甲方不承担任何赔偿责任（甲方尽量协调其他厅或贵宾房供乙方使用，乙方不能以此作为拒付款或打折付款的理由）。</p>
        			</li>
        			
        			<li class="red" >
        				<p class="pact-text">6.菜品及服务如有质量问题，请于宴席当天内反映，超出此时间本公司不受理；如由于菜品有异物，甲方最高按有异物的菜品给以双倍赔偿；
		                                               （乙方不能以此作为拒付款或打折付款的理由）。   </p>
        			</li>
        			<li class="red">
        				<p class="pact-text">7.中餐米粉：预定的中餐米粉如需全部取消，在就餐的前1天通知取消，不收取任何费用。在就餐的当天取消，按预定碗数总金额的40%赔偿损失。</p>
        			</li>
        			<li>
        				<p class="pact-text">8.乙方烟酒饮料，由乙方自行保管、自行发放上桌及回收。就餐期间乙方烟酒饮料若出现数目不对，甲方不承担任何赔偿责任（乙方不能以此作为拒付款或打折付款的理由）；</p>
        			</li>
        			<li>
        				<p class="pact-text">9.为确保宾客的安全，宴会场所内禁止使用冷焰火、易燃、易爆物品（玻璃瓶装啤酒，氢气球等），若乙方任性使用，所造成的一切后果及赔偿责任由乙方全部承担；</p>
        			</li>
        			<li>
        				<p class="pact-text">10.乙方外请的婚庆公司由乙方自行跟婚庆公司对接相关事宜，甲方不参与婚庆公司的任何工作对接，如婚庆出现失误及安全事故，乙方自行跟婚庆公司协商解决，
		        	            甲方不承担任何赔偿责任（乙方不能以此作为拒付款或打折付款的理由）；</p>
        			</li>
        			<li>
        				<p class="pact-text">11.付款方式：乙方于当日宴席结束，以现金或银行卡向甲方付清宴席尾款，甲方承担刷卡手续费；</p>
        			</li>
        			<li>
        				<p class="pact-text">12.婚宴合同签订之日起乙方取消宴席，甲方概不退还定金。</p>
        			</li>
        			<li>
        				<p class="pact-text">13.因自身原因，任何一方于3月前要求取消宴席，以预定的桌数及最低餐标60%作为违约金赔偿；于2月前要求取消取消宴席，以预定的桌数及最低餐标80%作为违约金赔偿；
		        	            于1月前要求取消宴席，以预定的桌数及餐标100%作为违约金赔偿。</p>
        			</li>
        			<li>
        				<p class="pact-text">14.在本合同有效期内，由于自然灾难等不可抗力因素而使甲方直接或间接地不能履行其义务，甲方对此不承担任何责任，但甲方应采取必要的措施以减少造成的损失。</p>
        			</li>
        			<li>
        				<p class="pact-text">15.宴会过程中由于到场人员较多，乙方有责任向到场来宾告知：监护人需照顾好随行的老人、未成年人，保管好随身财物，在行走、玩耍、上下楼梯过程中，请注意安全，避免发生危险。如发生意外事故，由乙方自行负责，甲方不承担任何责任。</p>
        			</li>
        			<li>
        				<p class="pact-text blue">16.上述条款由双方在平等协商的基础上，共同确定。双方特此声明，对本合同的全部内容完全明白和同意。</p>
        			</li>
        			<li>
        				<p class="pact-text blue">17.本合同一式两份,甲乙双方各执一份，本合同自双方代表人签字并盖章后生效。未尽事宜双方协商解决，双方发生纠纷时，按本合同一系列内容执行。</p>
        			</li>
        		</ul>
        	</div>
        	
        	<table  width="860" border="0" cellspacing="0" cellpadding="0" class="martop">
            <tr>
                <td colspan="4"><strong>场地/LED屏/灯光/婚车租用费用</strong></td>
            </tr>
         
            <tr>
                <td width="85">序号</td>
                <td width="240">产品名称</td>
                <td width="170">合同价</td>
                <td width="365">备注</td>
            </tr>
         
            <?php $i=1; foreach ($lists as $k => $v): ?>
                <?php if(isset($v['child'])):?>
                <?php foreach ($v['child'] as $k2 => $v2): ?>
                     <tr>
                        <td><?php echo $i++;?></td>
                        <td class="left"><label><input type="checkbox" name="service[]" value="<?php echo $v2['id'];?>" <?php echo in_array($v2['id'], $dinner_extra_service)?'checked="checked"':'';?> /> <?php echo $v2['name'];?></label></td>
                        <td><?php echo $v2['price'];?></td>
                        <?php if($k2 === 0):?>
                            <td class="left" rowspan="<?php echo count($v['child'])?>">
                                <?php foreach (explode("\n", $v['desc']) as $v3): ?>
                                    <p class="table-cont text-left"><?php echo $v3?></p> 
                                <?php endforeach;?>
                            </td>
                        <?php endif;?>
                        
                    </tr>
                <?php endforeach;?>
                <?php endif;?>
            <?php endforeach;?>
            
            <tr style="height: 100px;" >
                <td colspan="4" style="text-align: left;padding: 10px;">
                   <p>须知：</p> 
                   <p><?php echo date('Y')?>年定<?php echo date('Y')+1?>年的LED屏，执行<?php echo date('Y')+1?>年的价格（乙方不能强行或无理要求甲方按<?php echo date('Y')?>年的LED屏收费，并以此作为拒付款或打折付款的理由）。 </p>
                </td>
            </tr>
        </table>
        
        <div id="bill">
        	
        	<p class="red">
        		特别提示：本合同标红的条款请客户认真阅读，一旦签字即代表对本合同的全部内容完全明白和同意。
        	</p>
        </div>
        
        <!--盖章部分-->
        <div class="gZ">
        	<ul>
        		<li style="margin-bottom: 20px;">甲方（盖章有效）：安顺市百年婚宴有限公司<i><img src="<?php echo $domain['static']['url']?>/admin/images/seal.png" class="img"></i></li>
        		<li style="margin-bottom: 20px;">乙方签字：<div class="sign customer_signature"><img src="<?php echo get_img_url($dinner['customer_signature']);?>"></div></li>

        		<li >
        			<p class="width25">甲方代表：
        			 <span><?php echo $dinner['receiver']?></span>
        		    </p>
        		</li>
        		<li>
        			<p class="width25">联系电话：
        		      <span><?php echo $dinner['mobile_phone']?></span>
        		    </p>
        		</li>
        		<li >联系电话：0851-33611666 </li>
        		<li >合同签约地点：百年婚宴接待中心</li>
        		<li >单位地址：安顺市中华东路103号</li>
        		<li >合约签约日期：<span><?php echo $dinner['contract_date']?></span>  </li>
        		
        		
        	</ul>
        </div>
        
        <?php if(isset($combo['name']) && $combo['name']):?>
        <div class="combo_menu" >
            <h4 class="dic">菜单附件</h4>
            <div class="tb2">
            	<ul>
            		<li id="combo_name" class="dic"><?php echo $combo['name'];?></li>
            		<li>
            			<p>原价：<b id="combo_old_price"><?php echo sprintf('%.2f', $combo['old_price']);?></b> 元 </p>
            			<p>优惠：<b id="combo_price"><?php echo $combo['favorable'];?></b> 元 </p>
            		</li>
            		<li class="dic">
            			菜品
            		</li>
            		<li>
            			<p>菜品名称</p>
            			<p style="border: none;">价格</p>
            		</li>
            		<?php foreach($combo['dishes'] as $k => $v):?>
                    <li>
                        <p><?php echo $v['name'];?></p>
                        <p><?php echo $v['price'];?> 元</p>
                    </li>
                    <?php endforeach;?>
            	</ul>
            </div>
            
            <div class="tex">
                <textarea name="menu_remark" rows="" cols="">菜单备注：<?php echo $dinner['menu_remark']?> </textarea>
            </div>
        </div>    
        <?php endif;?>

        <br>
        <div style="text-align: center;">
        <?php if ( $dinner['is_del'] == C('dinner.is_del.normal.id') ): ?>
            <?php if ($dinner['is_examined'] != C('dinner.examine.archived.id')): ?>
            <a class="btn btn-primary examination" style="color:white; margin: 5px auto" data-id="<?php echo $dinner['id']; ?>" data-examination_suatus="<?php echo $dinner['is_examined']; ?>" data-examination_reason="<?php echo $dinner['examined_reason']; ?>"><?php if ($dinner['is_examined'] != C('dinner.examine.to_archive.id')): ?>审核<?php else: ?>归档<?php endif; ?></a>
            <?php else: ?>
            <p>合同已归档</p>
            <?php endif; ?>
        <?php else: ?>
        <p>异常合同备注：<?php echo $dinner['unusual_remark'] ?: '无'; ?></p> 
        <?php endif; ?>
        </div>

        
    </div>
   </div>


    <?php $this->load->view('common/footer')?>
    <script>
    	seajs.use(['<?php echo css_js_url('dinner.js', 'admin')?>'], function(a){
    		a.del();
    		a.show_tables();
    		a.up_show();
    		a.examination();
    	})
    </script>
</body>
</html>
