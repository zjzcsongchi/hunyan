<?php $this->load->view('common/header2')?>
<ol class="breadcrumb no_print"> 
    <li><a href="/common"><?php echo $title[0]?></a></li>
    <li><a href="/xingguang"><?php echo $title['1']?></a></li>
    <li class="active"><?php echo $title[2]?></li>
</ol>

<div class="container-fluid no_print" style="margin:10px">
    <button class="btn btn-primary" onclick="window.history.go(-1);"><span class="glyphicon glyphicon-circle-arrow-left"></span> 返 回</button>
    <p class="text-center">
        <button class="btn btn-primary" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> 打 印</button>
        <?php if($info['auth_status'] == 0):?>
        <button class="btn btn-primary" id="auth" data-id="<?php echo $info['id']?>"><span class="glyphicon glyphicon-info-sign"></span> 审 核</button>
        <?php elseif($info['auth_status'] == 1):?>
        <button class="btn btn-success" disabled><span class="glyphicon glyphicon-ok-sign"></span> 审核通过</button>
        <?php elseif($info['auth_status'] == 2):?>
        <button class="btn btn-default" disabled><span class="glyphicon glyphicon-remove-circle"></span> 未通过审核</button>
        <?php endif;?>
    </p>
</div>
<hr>

<div class="container" style="margin-bottom:40px">
    <p class="text-center h1">CCTV《星光大道》选手信息表</p>
    <table class="table table-bordered">
        <tr>
            <th width="100">姓名</th>
            <td width="100"><?php echo $info['realname']?></td>
            <th>性别</th>
            <td><?php echo $info['sex_text']?></td>
            <th>民族</th>
            <td><?php echo $info['nation']?></td>
            <td rowspan="5"><img style="max-width:200px; max-height:250px;" src="<?php echo $info['profile_url']?>"></td>
        </tr>
        <tr>
            <th>出生年月</th>
            <td><?php echo $info['birthday']?></td>
            <th>身高</th>
            <td><?php echo $info['height']?></td>
            <th>体重</th>
            <td><?php echo $info['weight']?></td>
        </tr>
        <tr>
            <th>政治面貌</th>
            <td><?php echo $info['political_status_text']?></td>
            <th>婚姻状况</th>
            <td><?php echo $info['marry_status_text']?></td>
            <th>籍贯</th>
            <td><?php echo $info['native_place']?></td>
        </tr>
        <tr>
            <th>身份证号</th>
            <td colspan="3"><?php echo $info['id_number']?></td>
            <th>健康状况</th>
            <td><?php echo $info['health']?></td>
        </tr>
        <tr>
            <th>所学专业</th>
            <td colspan="3"><?php echo $info['profession']?></td>
            <th>学历</th>
            <td><?php echo $info['education']?></td>
        </tr>
        <tr>
            <th>毕业院校</th>
            <td colspan="4"><?php echo $info['university']?></td>
            <th>唱法</th>
            <td><?php echo $info['sing_method']?></td>
        </tr>
        <tr>
            <th>工作单位</th>
            <td colspan="4"><?php echo $info['work_unit']?></td>
            <th>职业</th>
            <td><?php echo $info['job']?></td>
        </tr>
        <tr>
            <th>家庭住址</th>
            <td colspan="4"><?php echo $info['home_address']?></td>
            <th>邮编</th>
            <td><?php echo $info['zipcode']?></td>
        </tr>
        <tr>
            <th>通讯地址</th>
            <td colspan="4"><?php echo $info['postal_address']?></td>
            <th>联系电话</th>
            <td><?php echo $info['mobile_phone']?></td>
        </tr>
        <tr>
            <th rowspan="<?php echo count($info['program'])?>">参选节目名称</th>
            <?php if($info['program']):?>
            <td><?php echo $info['program'][0]['program_type_text']?></td>
            <td colspan="5"><?php echo $info['program'][0]['name']?></td>
            <?php endif;?>
        </tr>
        <?php if($info['program'] && count($info['program']) > 1):?>
        <?php for($i = 1; $i < count($info['program']);  $i++):?>
        <tr>
            <td><?php echo $info['program'][$i]['program_type_text']?></td>
            <td colspan="5"><?php echo $info['program'][$i]['name']?></td>
        </tr>
        <?php endfor;?>
        <?php endif;?>
        <!-- 家庭成员 -->
        <tr>
            <th rowspan="<?php echo count($info['family'])?>">家庭成员</th>
            <?php if($info['family']):?>
            <th>姓名</th>
            <td><?php echo $info['family'][0]['name']?></td>
            <th>关系</th>
            <td><?php echo $info['family'][0]['relation']?></td>
            <th>联系电话</th>
            <td><?php echo $info['family'][0]['mobile_phone']?></td>
            <?php endif;?>
        </tr>
        <?php if($info['family'] && count($info['family']) > 1):?>
        <?php for($i = 1; $i < count($info['family']); $i++):?>
        <tr>
            <th>姓名</th>
            <td><?php echo $info['family'][$i]['name']?></td>
            <th>关系</th>
            <td><?php echo $info['family'][$i]['relation']?></td>
            <th>联系电话</th>
            <td><?php echo $info['family'][$i]['mobile_phone']?></td>
        </tr>
        <?php endfor;?>
        <?php endif;?>
        <!-- 其他信息 -->
        <tr>
            <th colspan="2">成长经历（情感故事）（成长中最感动、最难忘的人和事）</th>
            <td colspan="5"><?php echo $info['otherinfo']['growth_exprience']?></td>
        </tr>
        <tr>
            <th colspan="2">接触音乐的时间、地点、心里感受以及对音乐的认知(包括对音乐的感情、态度、情怀、以及抱有的梦想）</th>
            <td colspan="5"><?php echo $info['otherinfo']['music_feel']?></td>
        </tr>
        <tr>
            <th colspan="2">自我介绍（兴趣、爱  好、特长等）</th>
            <td colspan="5"><?php echo $info['otherinfo']['myself_intro']?></td>
        </tr>
        <tr>
            <th colspan="2">选手对参加节目胜出与淘汰的看法、心态</th>
            <td colspan="5"><?php echo $info['otherinfo']['race_attitude']?></td>
        </tr>
        <tr>
            <th colspan="2">曾参加活动或获奖情况（如没有添无）</th>
            <td colspan="5"><?php echo $info['otherinfo']['history_activity']?></td>
        </tr>
        <tr>
            <th colspan="2" rowspan="2">选手各方面能力自我简述（每栏一句话）</th>
            <th>形象自我描述</th>
            <th>感情表达及控制能力</th>
            <th>语言表诉能力</th>
            <th>才艺模仿能力</th>
            <th>游戏互动能力</th>
        </tr>
        <tr>
            <td><?php echo $info['otherinfo']['my_image_desc']?></td>
            <td><?php echo $info['otherinfo']['my_feeling_express']?></td>
            <td><?php echo $info['otherinfo']['my_language_desc']?></td>
            <td><?php echo $info['otherinfo']['my_talent_desc']?></td>
            <td><?php echo $info['otherinfo']['my_game_desc']?></td>
        </tr>
        <tr>
            <th colspan="2">选手所处地域文化特色、民俗民风名人名事、民族特色、地方特产、著名景点、家乡方言、地方文艺剧种、地方传统文化
            </th>
            <td colspan="5"><?php echo $info['otherinfo']['born_place_desc']?></td>
        </tr>
        <tr>
            <th colspan="2">选手的职业技能和职业理想</th>
            <td colspan="5"><?php echo $info['otherinfo']['skill_desc']?></td>
        </tr>
        <tr>
            <th colspan="2">参加节目最想见的人是谁</th>
            <td colspan="5"><?php echo $info['otherinfo']['want_see_people']?></td>
        </tr>
        <tr>
            <th colspan="2">选手最喜欢的音乐作品、电影、电视剧最关心的社会热点和网络流行话题（正面、积极）</th>
            <td colspan="5"><?php echo $info['otherinfo']['like_works']?></td>
        </tr>
        <tr>
            <th colspan="2">选手熟悉的生活小窍门（各种各样）</th>
            <td colspan="5"><?php echo $info['otherinfo']['know_life_tips']?></td>
        </tr>
        <tr>
            <th colspan="2">审核意见</th>
            <td colspan="5"><?php echo $info['auth_suggestion']?></td>
        </tr>
    </table>
    
</div>
<?php $this->load->view('common/footer')?>
<script>
	seajs.use('<?php echo css_js_url('xingguang.js', 'admin')?>', function(a){
		a.auth();
	})
</script>

</body>
</html>