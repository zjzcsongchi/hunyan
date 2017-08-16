/**
 * 场馆管理js
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	var common = require('public');
	module.exports={

		//时间选择器
		datepick:function(){
			$(".Wdate").focus(function(){
	            WdatePicker({dateFmt:'yyyy-MM-dd'})
	        });
			$(".tdate").focus(function(){
				WdatePicker({dateFmt:'HH:mm'})
			});
		},
		//首页高度调整
		height_auto:function(){
			$('.contain').each(function(){
				var left_height = $(this).children('.left').height();
				var right_height = $(this).children('.right').height();
				if(left_height > right_height){
					$(this).children('.right').css({height:left_height});
				}else if(right_height > left_height){
					$(this).children('.left').css({height:right_height});
				}
			})
		},
		//列表页时间选择器
		index_datepick:function(){
			$(".Wdate").focus(function(){
	            WdatePicker({dateFmt:'yyyy-MM'})
	        });
		},
		
		//发送短信
		send_message:function(){
			$("#send_message").click(function(){
				var arr = $("input[type='checkbox']");
				var a = new Array();
				for(i=0;i<arr.length;i++){
					if(arr[i].checked){
					a[i] = arr[i].value;
					}
				}
				
				if(a && a.length > 0){
					$.post('/milan/send_message', {arr:a},function(data){
						if(data.status == 0){
							 common.showDialog('短信发送成功');
						}else{
							common.showDialog('短信发送失败');
						}
					})
				}else{
					common.showDialog('请选择需要发送的用户');
				}
				
				console.log(a);
			});
		},
		
		//切换场馆月份显示
		change_date:function(){
			$('.date_search').click(function(){
				var date = $(this).siblings('.date').val();
				var data_arr = date.split('-');
				var year = data_arr[0];
				var month = data_arr[1];
				var staff_id = $(this).siblings('.staff_id').val();
				
				var obj = $(this);
				$.ajax({
					url:'/milanstaff/change_date',
					data:{year:year,month:month,staff_id:staff_id},
					type:'POST',
					dataType:'html',
					beforeSend:function(){
						var wait_data = '<tr><td colspan="6">加载中</td></tr>';
						obj.parents('thead').next('tbody').html(wait_data);
					},
					success:function(data){
						obj.parents('thead').next('tbody').html(data);
					}
				})
			})
		},
		
		//登录
		lgoin: function(){
  		  $(".loginbtn").click(function(){
    		    var loginuser = $(".loginuser").val();
            var loginpwd = $(".loginpwd").val();
         
            if(loginuser == "" ){
                alert("请输入用户名");
                $(".loginuser").focus();
                return false;
            }
            if(loginpwd == "" ){
                alert("请输入密码");
                $(".loginpwd").focus();
                return false;
            }

            $.ajax({
                url:'/milanschedule/login',
                data: {
                    'name':loginuser,
                    'password':loginpwd,
                },
                type:'POST',
                dataType:'json',
                beforeSend:function(){
                   $(".loginbtn").val("登录中...");
                },
                success:function(res) {
                  $(".loginbtn").val("登录");
                  if(res.status == 0){
                    window.location.href = '/milanschedule/schedule';
                  }else{
                    alert(res.msg);
                  }
                },
                error : function() {
                   alert("网络异常！");
                }
            });
        });
		
		}
	}
	
	
})