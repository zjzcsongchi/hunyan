        <div class="user-banner">
            <div class="cont">
                <div class="head">
                    <img src="<?php echo isset($user_info['head_img']) && !empty($user_info['head_img']) ? get_img_url($user_info['head_img']) : $domain['static']['url'].'/www/images/head.jpg';?>">
                </div>
                <div class="info">
                    <div class="name">
                        <?php echo isset($user_info['nickname']) ? $user_info['nickname'] : '';?>
                        <p class="phone"><?php echo isset($user_info['mobile_phone']) ? $user_info['mobile_phone'] : '';?></p>
                    </div>
                    <a href="javascript:;" class="edit">编辑资料</a>
                </div>
                <ul>
                    <li><span><?php echo isset($bless_nums) ? $bless_nums : 0;?></span><br>祝福</li>
                    <li><span><?php echo isset($coupon_nums) ? $coupon_nums : 0;?></span><br>优惠券</li>
                </ul>
            </div>
        </div>
        
        <div class="popup-userinfo">
            <p class="title"><span>会员基本信息</span>（百年婚宴将会对您的所有信息严格保密，请放心填写）</p>
            <div class="close"></div>
            <form id='userinfo'>
                <div class="head-cont">
                    <div class="head" id="uploadbtn">
                        <img src="<?php echo get_img_url($user_info['head_img'])?>">
                        <input type="hidden" id="head_img" name="head_img" value="<?php echo $user_info['head_img']?>">
                    </div>
                    
                    <input type="file" id="uploadImg" style="display:none" name="Filedata">
                                        
                    <p>点击头像更换</p>
                </div>
                <ul>
                    <li>
                        <p>姓名</p>
                        <input type="hidden" id="user_id" name="user_id"  value="<?php echo $user_info['id']?>"/>
                        <input  type="text" id="realname" name="realname" value="<?php echo $user_info['realname']?>"/>
                    </li>
                    <li>
                        <p>用户名</p>
                        <input id="nickname" type="text" name="nickname" value="<?php echo $user_info['nickname']?>"/>
                    </li>
                    <li>
                        <p>性别</p>
                        <select id='sex' name="sex">
                            <option value="1" <?php if($user_info['sex']==1) echo 'selected';?>>男</option>
                            <option value="0" <?php if($user_info['sex']==0) echo 'selected';?>>女</option>
                        </select>
                    </li>
                    <li>
                        <p>出生日期</p>
                        
                        <input id="birthday" style="cursor:pointer" readonly type="text" name="birthday" value="<?php echo $user_info['birthday']?>" placeholder="1990-00-00">
                    </li>
                    <li>
                        <p>手机号</p>
                        <input id="mobile" type="text" name="mobile" value="<?php echo $user_info['mobile_phone']?>"/>
                    </li>
                    <li>
                        <p>现居地址</p>
                        <textarea id="address" name="address" placeholder="&#x8BF7;&#x8F93;&#x5165;&#x73B0;&#x5C45;&#x5730;&#x5740;"><?php echo $user_info['address']?></textarea>
                    </li>
                </ul>
            
                <p class="message"></p>
                <div class="but-cont">
                    <a href="javascript:;" class="cancel" >取消</a>
                    <a href="javascript:;" class="but">保存提交</a>
                </div>
            </form>
        </div>
        <div class="page-bg"></div>
        
        