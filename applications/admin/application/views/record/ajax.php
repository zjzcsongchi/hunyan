<style type="text/css">
*{margin:0;padding: 0}
ul,ol,li { list-style-type: none; }
p{-webkit-margin-before: 0;-webkit-margin-after: 0;}
.main-cont{width: 500px;height: auto;}
.name{text-align: center;font-size: 20px;font-weight: bold;margin-top: 20px;}
.img-cont{text-align: center;}
.img-cont img{width: 170px;}
.main-cont ul{width: 100%;margin: 0 auto;height: auto;overflow: hidden;}
.main-cont li{width: 100%;margin-top: 10px;border-bottom: 1px solid gainsboro;}
.main-cont .title{font-size: 20px;color: #333;}
.main-cont .text{font-size: 18px;color: #444;line-height: 20px;}
</style>
<div class="main-cont">
    	<div class="img-cont"><img src="/publicservice/qr_code?link=<?php echo $domain['mobile']['url'].'/record/detail?id='.$id?>"></div>
    	<p class="name"><?php echo $record['husband']?>&<?php echo $record['wife']?></p>
    	<ul>
            <li>
                <p class="title">问：你们的职业？</p>
                <p class="text">答：新郎职业：<?php echo $record['info']['profession']; ?> &nbsp;&nbsp;&nbsp;&nbsp;新娘职业：<?php echo $record['info']['profession_wife'] ?></p>
            </li>
            <li>
                <p class="title">问：你们什么时候相识的？</p>
                <p class="text">答：<?php echo $record['info']['first_meet_time']?></p>
            </li>
            <li>
                <p class="title">问：在哪里？</p>
                <p class="text">答：<?php echo $record['info']['first_meet_addr']?></p>
            </li>
             <li>
                <p class="title">问：初次约会是在什么时候？</p>
                <p class="text">答：<?php echo $record['info']['appointmen_addr']?></p>
            </li>
            <li>
                <p class="title">问：你觉得对方是个什么样的人？</p>
                <p class="text">答：<?php echo $record['info']['eyes']?></p>
            </li>
            <li>
                <p class="title">问：对于你们来说有没有属于彼此之间特殊的事物(比如一首歌，一句话，一份吃的或是爱好)？</p>
                <p class="text">答：<?php echo $record['info']['special_thing']?></p>
            </li>
            <li>
                <p class="title">问：讲讲你们恋爱时让你们最难忘的事？</p>
                <p class="text">答：<?php echo $record['info']['unforget']?></p>
            </li>
            <li>
                <p class="title">问：在婚礼上想要对对方说点什么或做点什么？</p>
                <p class="text">答：<?php echo $record['info']['do_what']?></p>
            </li>
            <li>
                <p class="title">问：新人是通过什么方式认识对方的？</p>
                <p class="text">答：<?php echo $record['info']['how_to_know']?></p>
            </li>
            <li>
                <p class="title">问：在婚礼感恩环节有没有特殊情怀想对父母表达？(如有特殊家庭情况请注明)？</p>
                <p class="text">答：<?php echo $record['info']['say_for_parent']?></p>
            </li>
            <li>
                <p class="title">问：婚礼的来宾有要关照的人吗？</p>
                <p class="text">答：<?php echo $record['info']['care']?></p>
            </li>
            <li>
                <p class="title">问：你们的生日是不是在婚礼当天？</p>
                <p class="text">答：<?php echo $record['info']['is_today']?></p>
            </li>
            <li>
                <p class="title">问：有没有特殊的纪念日？</p>
                <p class="text">答：<?php echo $record['info']['jinianri']?></p>
            </li>
            <li>
                <p class="title">问：备注</p>
                <p class="text">答：<?php echo $record['info']['remark']?></p>
            </li>
        </ul>
</div>
