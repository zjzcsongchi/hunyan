<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link href="<?php echo css_js_url('style.css', 'admin');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo css_js_url('admin.css', 'admin');?>" type="text/css" rel="stylesheet"/>
<script src="<?php echo css_js_url('jquery.min.js','admin');?>"></script>
<script src="<?php echo $domain['static']['url'];?>/common/js/datepicker/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){   
    //顶部导航切换
    $(".nav li a").click(function(){
        $(".nav li a.selected").removeClass("selected")
        $(this).addClass("selected");
    })  
    $('.search').click(function(){
			var year = $("#year").val();
			var month = $('#month').val();
			if(month){
				month = month < 10 ? '0'+month:month;
			}
			var time = year +'-'+ month;

			
			var day = $("#day select").val();
			day = parseInt(day);
			if(day){
				day = day < 10 ? '0'+day : day;
				var time = year +'-'+ month+'-'+day;
				
			}
			
			if(time){
				window.parent.rightFrame.location.href="/venue/blank?time="+time;
			}
			
    })
    
    //搜索预留
    $('.reserve').click(function(){

			var year = $("#year").val();
			var month = $('#month').val();
			var time = year +'-'+ month;
			
			var day = $("#day select").val();
			day = parseInt(day);
			if(day){
				day = day < 10 ? '0'+day : day;
				var time = year +'-'+ month+'-'+day;
			}
			
			
			if(time){
				window.parent.rightFrame.location.href="/venue/reserve?time="+time;
			}
			
    })
    
    //时间选择器
		$(".Wdate").focus(function(){
            WdatePicker({dateFmt:'yyyy-MM'})
        });
    $('.calendar').click(function(){
    	$(window.parent.rightFrame.document).find('.calendar_wrap').show();
    })
    
})  
</script>


</head>

<body class="top-body">
    <div class="topleft">
        <a href="/home" target="_parent"><img src="<?php echo $domain['static']['url'];?>/admin/images/logo1.png" title="系统首页" /></a>
    </div>
    <div class="topright">    
        <ul>
            <li><a href="/admin/set_admin" target="rightFrame">个人设置</a></li>
            <li><a href="/login/out" target="_parent">退出</a></li>
        </ul>
        <div class="user">
            <span>当前用户：<?php echo $userInfo['name'];?></span>
        </div>    
    </div>
    <div class="topcenter">
        <ul>
            <li><a class="calendar">查看日历</a></li>
            <li>
            <select id="year" id="year">
                <?php foreach ($year as $v):?>
                <option value="<?php echo $v;?>" <?php if($v == $now_year):?>selected<?php endif;?>><?php echo $v;?>年</option>
                <?php endforeach;?>
            </select>
            </li>
            <li>
            <select id="month" id="month">
                <?php foreach ($month as $v):?>
                <option value="<?php echo $v;?>" <?php if($v == $now_month):?>selected<?php endif;?>><?php echo $v;?>月</option>
                <?php endforeach;?>
            </select>
            </li>
            <li id="day">
            <select >
                <option></option>
            </select>
            </li>
            <li>
                <button class="search">搜索空档</button>
            </li>
        </ul>
    </div>
    
    <script>
    var year = $("#year").val();
	var month = $("#month").val();
	$.post('',{year:year,month:month}, function(data){
			if(data.status == 0){
				var day = data.data;
				html = '<select>';
				html += '<option></option>'
				for(var i=1;i<=day;i++){
					html += '<option value="'+i+'">'+i+'日</option>'
				}
				html += '</select>';
				$("#day").html(html);
			}
		})

    
	$("#month").change(function(){
		var year = $("#year").val();
		var month = $("#month").val();
		$.post('',{year:year,month:month}, function(data){
				if(data.status == 0){
					var day = data.data;
					html = '<select>';
					html += '<option></option>'
					for(var i=1;i<=day;i++){
						html += '<option value="'+i+'">'+i+'日</option>'
					}
					html += '</select>';
					$("#day").html(html);
				}
			})
	})
</script>
    
</body>

</html>
