<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta name="keywords" content="百年婚宴 - 电子合同">
    <meta name="description" content="百年婚宴 - 电子合同">
    

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"> 

    <!-- 引入项目css资源文件,并配置构建地址演示 -->
    <link href="<?php echo css_js_url('word_print.css', 'admin');?>" type="text/css" rel="stylesheet"/>

</head>
<body>
<div class="bg">
    <div class="page-main">
        <h2 class="head">百年婚宴定餐合同</h2>
        <p>甲方：<span>安顺市百年婚宴有限公司</span></p>
        <p>乙方： <span><?php echo $dinner['name']?></span> </p>
        <div class="text-indent">
        	<p>十分感谢您选择“百年婚宴”举办您即将到来的宴会，根据《中华人民共和国合同法》《中华人民共和国消费者权益保护法》及有关法律法规，结合本次消费的具体情况，甲乙双方在自愿平等，公平诚信的原则基础上，经双方协商一致，签订本合同。</p>
        </div>
        <div class="dic">一. 定餐细则：</div>
        <p class="pact-text yuding"> 1. 预收定金：甲乙双方签订此协议时，乙方需向甲方交付预定金人民币大写：
            <span class="type2"><?php echo $dinner['deposit']?></span> （大写：<span class="type2"><?php echo $dinner['deposit_daxie']?></span> 元） 
                        （
                 <?php foreach (C('order.pay_type') as $v):?>
                        <label><input type="radio" name="pay_type" value="<?php echo $v['id']?>" <?php echo $v['id'] == $dinner['pay_type'] ? 'checked="checked"' : '' ?> class="cbx"> <?php echo $v['name']?> </label>  
                <?php endforeach;?>
                
                          ） 本协议方为生效，否则甲方有权不履行协议的预订。
        </p>
        <div class="form">
          <form action="#" method="post" >
            <p style="font-size:16px ;font-weight: bolder;">宴会时间：</p>
        	<div class="form1">	
        	     <ul>
                    <li style="width:25%;">
                                            公历：
        		    <span class="type2"><?php echo $dinner['solar_time']?></span>
                    </li>
                    
                    <li style="width:25%;">
                                             农历：
        		      <span class="type2"><?php echo $dinner['lunar_time']?></span>
                    </li>
                    
                    <li style="width:25%;">
                                             星期：
        		     <span class="type2"><?php echo $dinner['week']?></span>
                    </li>
                    
                    <li style="width:25%;">
                    <label>晚餐<input type="radio" name="dinner_time" value="1" <?php echo $dinner['dinner_time']==1?'checked="checked"':'';?> /></label>
                    <label>中餐<input type="radio" name="dinner_time" value="2" <?php echo $dinner['dinner_time']==2?'checked="checked"':'';?> /></label>
                    </li>
        		</ul>

        	</div>
        	
        	
        	<p style="font-size:16px ;font-weight: bolder;">宴会类型：</p>
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
        		<ul>
                    <li style="width:25%;">
                                             新郎：<span><?php echo $dinner['roles_main']?></span>
                    </li>
                    <li style="width:25%;">
                                             电话：
	        		     <span><?php echo $dinner['roles_main_mobile']?></span>
                    </li>
                    <li style="width:25%;">
                                             新娘：
	        		     <span><?php echo $dinner['roles_wife']?></span>
                    </li>
                    <li style="width:25%;">
                                             电话：
	        		     <span><?php echo $dinner['roles_wife_mobile']?></span>
                    </li>
        		</ul>
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
        	
        	<p style="font-size:16px ;font-weight: bolder;">宴会场馆：</p>
        	<div class="form1">
        		<ul>
        		<?php foreach($venue_list as $k => $v):?>
                <?php $flag = false; ?>
                <?php if (in_array($v['id'], $dinner['venue_ids'])) {$flag = true;}?>
        		    <li><label>
                    <input type="checkbox" value="<?php echo $v['id']?>" name="venue_id[]" <?php echo $flag ? 'checked="checked"' : '';?> /><span <?php echo $flag ? 'style="background-color:rgb(167, 202, 200)"' : ''; ?>><?php echo $v['name']?></span>
                    </label></li>
                <?php endforeach;?>
        		</ul>	
        	</div>
        	<div class="zs">
        	   <ul>
    			 <li><p style="font-size:16px ;font-weight: bolder;">预定桌数 <i>（10人/席）</i>：<span><?php echo $dinner['menus_count']?></span> 桌</p></li>
    			 <li><p style="font-size:16px ;font-weight: bolder;">保证桌数 <i>（10人/席）</i>：<span><?php echo $dinner['promise_count']?></span> 桌</p></li>
        	   </ul>
        	</div>  
        	<p style="font-size:16px ;font-weight: bolder;">宴会餐标：</p>
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
        	
        	<p style="font-size:16px ;font-weight: bolder;">是否需要偏酒：</p>
        	<div class="form1">
        		<ul>
        			<?php if(!isset($dinner_extend[C('dinner_extend.pianjiu.id')])):?>
                        <li><label><input type="radio" name="wine" value="0" checked="checked"/>不需要</label></li>
                        <li><label><input type="radio" name="wine" value="1" />需要</label></li>
                    <?php else:?>
                        <li><label><input type="radio" name="wine" value="0" />不需要</label></li>
            			<li style="width:50%"><label><input type="radio" name="wine" value="1" checked="checked" />需要</label><?php if (isset($dinner_extend[C('dinner_extend.pianjiu.id')]['remark'])):?>(备注：<span> <?php echo $dinner_extend[C('dinner_extend.pianjiu.id')]['remark']?></span>)<?php endif;?></li>
                    <?php endif;?>

        		</ul>
        	</div>
        	
        	<p style="font-size:16px ;font-weight: bolder;">是否需要打屏：</p>
        	<div class="form1">
        		<ul>
        			<?php if(!isset($dinner_extend[C('dinner_extend.daping.id')])):?>
                        <li><label><input type="radio" name="screen" value="0" checked="checked"/>不需要</label></li>
                        <li><label><input type="radio" name="screen" value="1" />需要</label></li>
                    <?php else:?>
                        <li><label><input type="radio" name="screen" value="0" />不需要</label></li>
            			<li style="width:50%"><label><input type="radio" name="screen" value="1" checked="checked" />需要</label><?php if (isset($dinner_extend[C('dinner_extend.daping.id')]['remark'])):?>(备注：<span> <?php echo $dinner_extend[C('dinner_extend.daping.id')]['remark']?> </span>)<?php endif;?></li>
                    <?php endif;?>
        		</ul>
        	</div>
            
            <p style="font-size:16px ;font-weight: bolder;">是否需要司仪：</p>
        	<div class="form1">
        		<ul>
        			<?php if(!isset($dinner_extend[C('dinner_extend.mc.id')])):?>
                        <li><label><input type="radio" name="mc" value="0" checked="checked"/>不需要</label></li>
                        <li><label><input type="radio" name="mc" value="1" />需要</label></li>
                    <?php else:?>
                        <li><label><input type="radio" name="mc" value="0" />不需要</label></li>
            			<li style="width:50%"><label><input type="radio" name="mc" value="1" checked="checked" />需要</label><?php if (isset($dinner_extend[C('dinner_extend.mc.id')]['remark'])):?>(备注：<span> <?php echo $dinner_extend[C('dinner_extend.mc.id')]['remark']?> </span>)<?php endif;?></li>
                    <?php endif;?>
        		</ul>
        	</div>
        	
        	<p style="font-size:16px ;font-weight: bolder;">宴会请帖：</p>
        	<div class="form1">
        		<ul>
        		    <?php foreach (C('dinner_extend.invitation.type') as $k => $v):?>
        		        <li><label><input <?php echo isset($dinner_extend[C('dinner_extend.invitation.id')]) && $dinner_extend[C('dinner_extend.invitation.id')]['num']==$v['id']?'checked="checked"':'';?> type="radio" name="invitation" value="<?php echo $v['id']?>" /><?php echo $v['name']?> </label></li>
                    <?php endforeach;?>
        		</ul>
        		<div style="margin-left: 20px">
        		<div>
        		  <?php if (isset($dinner_extend[C('dinner_extend.invitation.id')]['remark']) && $dinner_extend[C('dinner_extend.invitation.id')]['remark']):?>（宴会请帖备注：<span> <?php echo $dinner_extend[C('dinner_extend.invitation.id')]['remark']?> </span>）<?php endif;?>
        		</div>
        		<div>定制个人请柬须提前2个月发照片到公司QQ邮箱：1991743888</div>
        		</div>
        		
            </div>
            <div>
            	
            </div>
            
        	<p style="font-size:16px ;font-weight: bolder;">米兰代金券：</p>
        	<div class="form-coupon">
                <ul>
        	       <?php if($coupon):?>
            	       <?php foreach ($coupon as $k => $v):?>
            	       <li>
            	           <span>编号：<span class="underline"><?php echo $v['number']?></span></span>
            	           <span>金额：<span class="underline"><?php echo $v['money']?> 元</span></span>
            	       </li>
            	       <?php endforeach;?>
            	   <?php else:?>
                	   <li>无</li>
            	   <?php endif;?>
                </ul>
        	</div>
        	
        	<div class="gm">
        	   <ul>
    			 <li><p style="font-size:16px ;font-weight: bolder;">婚庆公司：<span><?php echo $dinner['company']?></span> </p></li>
    			 <li><p style="font-size:16px ;font-weight: bolder;">麻 将<i>（按10比2分配）</i>：<span><?php echo isset($dinner_extend[C('dinner_extend.mahjong.id')]) ? $dinner_extend[C('dinner_extend.mahjong.id')]['num'] : 0;?></span> 桌</p></li>
        	   </ul>
        	</div> 
        		
        	<p style="font-size:16px ;font-weight: bolder;">中餐米粉<i>（10元/碗）</i>：</p>
        	<div class="form1">
        	   <ul>
    			<?php if(!isset($dinner_extend[C('dinner_extend.rice_noodle.id')])):?>
                    <li><label><input type="radio" name="rice_noodle" value="0" checked="checked" />不需要 </label></li>
                    <li><label><input type="radio" name="rice_noodle" value="1" />需要 </label> </li>
                <?php else:?>
                    <li><label><input type="radio" name="rice_noodle" value="0"  />不需要 </label></li>
                    <li style="width: 50%"><label><input type="radio" name="rice_noodle" value="1" checked="checked" />需要  </label>
                        <?php if (isset($dinner_extend[C('dinner_extend.rice_noodle.id')]['num'])):?>(<span> <?php echo $dinner_extend[C('dinner_extend.rice_noodle.id')]['num']?> </span>/碗 )<?php endif;?>
                    </li>
                <?php endif;?>
                </ul>
        	</div> 
        	
        	<p style="font-size:16px ;font-weight: bolder;">鸡蛋<i>（0.52元/个，185元/件）</i>：</p>
        	<div class="form1">
        		<ul>
    			<?php if(!isset($dinner_extend[C('dinner_extend.egg.id')])):?>
                    <li><label><input type="radio" name="egg" value="0" checked="checked" />不需要 </label></li>
                    <li><label><input type="radio" name="egg" value="1" />需要 </label> </li>
                <?php else:?>
                    <li><label><input type="radio" name="egg" value="0"  />不需要 </label></li>
                    <li style="width: 50%"><label><input type="radio" name="egg" value="1" checked="checked" />需要  </label>
                        <?php if (isset($dinner_extend[C('dinner_extend.egg.id')]['num'])):?>(<span> <?php echo $dinner_extend[C('dinner_extend.egg.id')]['num']?> </span>/个 )<?php endif;?>
                    </li>
                <?php endif;?>
                </ul>
        	</div>

        	<p style="font-size:16px ;font-weight: bolder;">主桌</i>：</p>
        	<div class="form1">
        		<ul>
    			<?php if(!isset($dinner_extend[C('dinner_extend.zuzhuo.id')])):?>
                    <li><label><input type="radio" name="zuzhuo" value="0" checked="checked" />不需要 </label></li>
                    <li><label><input type="radio" name="zuzhuo" value="1" />需要 </label> </li>
                <?php else:?>
                    <li><label><input type="radio" name="zuzhuo" value="0"  />不需要 </label></li>
                    <li style="width: 50%"><label><input type="radio" name="zuzhuo" value="1" checked="checked" />需要  </label>
                        <?php if (isset($dinner_extend[C('dinner_extend.zuzhuo.id')]['num'])):?>(<span> <?php echo $dinner_extend[C('dinner_extend.zuzhuo.id')]['num']?> </span>/个 )<?php endif;?>
                    </li>
                <?php endif;?>
                </ul>
        	</div>
        	
        	
    	   <p style="font-size:16px ;font-weight: bolder;">定餐客户现住地址:<span><?php echo $dinner['customer_address']?></span> </p>
    	   <p style="font-size:16px ;font-weight: bolder;">定餐客户公司单位:<span><?php echo $dinner['customer_company']?></span> </p>
	       <p style="font-size:16px ;font-weight: bolder;">客户身份证复印件：</p>
        	<div class="card">
        		<img style="width: 93mm;height: 53mm;"src="<?php echo get_img_url($dinner['id_card_photo'])?>">
        	</div>
        	<div class="card" style="margin-top:5px;">
        		<img style="width: 93mm;height: 53mm;"src="<?php echo get_img_url($dinner['id_card_back_photo'])?>">
        	</div>
        	<div class="tex">
        		备注：<?php echo $dinner['remark']?>
        	</div>
        	

        	<p style="font-size:16px ;font-weight: bolder;">客户须知:</p>
        	<div class="res" style="padding-left:20px ;">
        		    <p>1.带壳花生、瓜子、坚果类不允许带入酒店<i style="font-style:normal;color:#B7B7B7;font-weight: 100;">(糖果类不限制)</i> </p>
                    <p>2.纸质喷花、瓶装啤酒不允许带入酒店；</p>     
                    <p>3.19:00前需要上菜的客户，乙方须提前1天电话/短信提醒甲方。  </p>
        		    <p>4.预定桌数为保证桌数的10%； </p>
                    <p>5.婚宴场地按预定桌数保留位置；</p>
                    <p>6.婚宴用餐地点均不包场:</p>
                    <p>7.百年好合厅迎宾区：进门右边（共用金色年华厅通道）。  </p>
                    <p>8.金色年华厅迎宾区：进门左边。</p>
                    <p>9.<?php echo date('Y')?>年定<?php echo date('Y')+1 ?>年的酒席，执行<?php echo date('Y')+1?>年的菜单及价格（乙方不能强行或无理要求甲方按<?php echo date('Y')?>年的菜单及价格收费，并以此作为拒付款或打折付款的理由）。</p>
                    <div style="width:70%;padding: 10px;background: #E9E9E9;margin-top: 15px;">
                    	<p class="red">特别提示：对客户须知1-9项的全部内容完全明白和同意!</p>
                    </div>
        	</div>
          </form>
        </div>
        	
        	<div class="text3">
    				<p>1.婚庆公司进场费用：<span>人民币大写：壹仟元小写：1000元/单场</span>（详见进场协议）</p>
    				<p>2.预定桌数：如果当天宴席桌数多于合同确认的保证桌数，甲方仍按照实际桌数收取费用；</p>
    				<p>3.保证桌数：如果当天宴席桌数少于合同确认的保证桌数，甲方按合同确认的保证桌数50%结账（如乙方全额付款，需要补吃由甲方根据空闲场地安排，为确保遗留菜品质量，乙方必须3日内补吃完毕，3日后视作自动放弃，补吃仅限于晚餐，上菜时间19：00或19:30。</p>
    				<p class="red">4.婚宴场地按预定桌数保留位置，如乙方临时增加桌数，甲方场地已排满，甲方不承担任何赔偿责任（甲方尽量协调其他厅或贵宾房供乙方使用，乙方不能以此作为拒付款或打折付款的理由）。</p>
    				<p class="red">5.菜品及服务如有质量问题，请于宴席当天内反映，超出此时间本公司不受理；如由于菜品有异物，甲方最高按有异物的菜品给以双倍赔偿；（乙方不能以此作为拒付款或打折付款的理由）。 </p>
    				<p class="red">6.中餐米粉：预定的中餐米粉如需全部取消，在就餐的前1天通知取消，不收取任何费用。在就餐的当天取消，按预定碗数总金额的40%赔偿损失。</p>
    				<p>7.乙方烟酒饮料，由乙方自行保管、自行发放上桌及回收。就餐期间乙方烟酒饮料若出现数目不对，甲方不承担任何赔偿责任（乙方不能以此作为拒付款或打折付款的理由）；</p>
    				<p>8.为确保宾客的安全，宴会场所内禁止使用冷焰火、易燃、易爆物品（玻璃瓶装啤酒，氢气球等），若乙方任性使用，所造成的一切后果及赔偿责任由乙方全部承担；</p>
    				<p>9.乙方外请的婚庆公司由乙方自行跟婚庆公司对接相关事宜，甲方不参与婚庆公司的任何工作对接，如婚庆出现失误及安全事故，乙方自行跟婚庆公司协商解决，甲方不承担任何赔偿责任（乙方不能以此作为拒付款或打折付款的理由）；</p>
    				<p>10.付款方式：乙方于当日宴席结束，以现金或银行卡向甲方付清宴席尾款，甲方承担刷卡手续费；</p>
    				<p>11.婚宴合同签订之日起乙方取消宴席，甲方概不退还定金。</p>
    				<p>12.因自身原因，任何一方于3月前要求取消宴席，以预定的桌数及最低餐标60%作为违约金赔偿；于2月前要求取消取消宴席，以预定的桌数及最低餐标80%作为违约金赔偿；于1月前要求取消宴席，以预定的桌数及餐标100%作为违约金赔偿。</p>
    				<p>13.在本合同有效期内，由于自然灾难等不可抗力因素而使甲方直接或间接地不能履行其义务，甲方对此不承担任何责任，但甲方应采取必要的措施以减少造成的损失。</p>
    				<p>14.宴会过程中由于到场人员较多，乙方有责任向到场来宾告知：监护人需照顾好随行的老人、未成年人，保管好随身财物，在行走、玩耍、上下楼梯过程中，请注意安全，避免发生危险。如发生意外事故，由乙方自行负责，甲方不承担任何责任。</p>
    				<p>15.上述条款由双方在平等协商的基础上，共同确定。双方特此声明，对本合同的全部内容完全明白和同意。</p>
    				<p>16.本合同一式两份,甲乙双方各执一份，本合同自双方代表人签字并盖章后生效。未尽事宜双方协商解决，双方发生纠纷时，按本合同一系列内容执行。</p>
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
        		<li style="margin-bottom: 20px;    position: relative;">甲方（盖章有效）：安顺市百年婚宴有限公司
        		<div style="margin-top: -50px; margin-left: 80px; width:150px;"> <img src="<?php echo $domain['static']['url']?>/admin/images/seal.png" class="img" ></div></li>
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
        <h4 class="dic">菜单附件</h4>
        <table  width="860" border="0" cellspacing="0" cellpadding="0" class="martop">
            <tr>
                <td colspan="4"><strong><?php echo $combo['name'];?></strong></td>
            </tr>
            <tr>
                <td colspan="2">原价：<?php echo sprintf('%.2f', $combo['old_price']);?>元</td>
                <td colspan="2">现价：<?php echo $combo['price'];?>元</td>
            </tr>
            <tr>
                <td colspan="4"><strong>菜品</strong></td>
            </tr>
            <tr>
                <td colspan="2">菜品名称</td>
                <td colspan="2">价格</td>
            </tr>

            <?php foreach($combo['dishes'] as $k => $v):?>
            <tr>
                <td colspan="2"><?php echo $v['name'];?></td>
                <td colspan="2"><?php echo $v['price'];?> 元</td>
            </tr>
            <?php endforeach;?>
            
            <tr style="height: 100px;" >
                <td colspan="4" style="text-align: left;padding: 10px;">
                   <p>菜单备注：</p> 
                   <p><?php echo $dinner['menu_remark']?> </p>
                </td>
            </tr>
        </table>
        <?php endif;?>

    </div>
   </div>

    <?php $this->load->view('common/footer') ?>
</body>
</html>
