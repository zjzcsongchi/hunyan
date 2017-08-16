 /**
  * 场馆页js
  * @author songchi@gz-zc.cn
  */
 define(function(require, exports, module){
 	
 	var public = require('public');
 	require('fastclick');
 	require('weui');
  var attachFastClick  = Origami.fastclick;
 	require('swiper');
 	module.exports = {
 			load:function(){
 					public.load();
 					 $(function(){
 						 $(".info-list li").click(function() {
 							 if($(this).attr('id') != 'uploadbtn'){
 								 $(".page-bg").addClass("act");
 								 $(this).next(".popup-user").addClass("act");
 							 }
 					     });
 					     $(".popup-user .cancel").click(function() {
 					         $(".page-bg").removeClass("act");
 					         $(".popup-user").removeClass("act");
 					     });
 						});
 		},
 		
 		sex:function(){
 			$(".sex").click(function() {
                 var value = $(this).attr("data-id");
                 $("input[name='sex']").val(value);
                 
                 var text = $(this).text();
                 $('.sex_show').text(text);
                 $(".page-bg").removeClass("act");
                 $(this).parent().removeClass("act");
             });
 		},
 		submit:function(){
 			$('.submit').click(function(){
 				var realname = $("input[name='realname']").val();
 				var address = $("input[name='address']").val();
 				var nickname = $("input[name='nickname']").val();
 				var sex = $("input[name='sex']").val();
 				var mobile_phone = $("input[name='mobile_phone']").val();
 				var birthday = $("input[name='birthday']").val();
 				var head_img = $('input[name=head_img]').val();
 				if(!nickname){
 					showDialog('用户名不能为空！');
 				}
 				if(!sex){
 					showDialog('性别不能为空！');
 				}
 				if(!mobile_phone){
 					showDialog('手机号不能为空！');
 				}
 				if(!/^1(3[0-9]|5[0-9]|7[0-9]|8[0-9])\d{8}$/.test(mobile_phone)){
 			        showDialog('手机号格式不正确！');
		        }
 				
 				$.post('',{realname:realname, address:address, nickname:nickname, sex:sex, mobile_phone:mobile_phone,birthday:birthday,head_img:head_img}, function(data){
 					if(data.status == 0){
 						showDialog('修改成功');
 					}else{
 						showDialog('修改失败');
 					}
 				})
 				
 			})
 		},
 		
 		sure:function(){
 			$('.sure').click(function(){
 				var val = $(this).siblings('div').find('input').val();
 				$(this).parent().prev('li').find('.t-block').text(val);
 				$(this).parent().removeClass("act");
 				$(".page-bg").removeClass("act");
 			})
 		},
 		
 		datepick:function(){
 		 $('#datePicker').click(function(){
       var date = new Date();
       
       weui.datePicker({
         start:1920,
         end:2017,
         defaultValue:[date.getFullYear(), date.getMonth()+1, date.getDate()],
         id:'datePicker',
         onConfirm:function(result){
           $('#datePicker').val(result[0]+'-'+result[1]+'-'+result[2]);
         }
       })
       
     })
 		},
 		
 		
 		upload_img:function(_self){
 		  var notNeed = attachFastClick.FastClick.notNeeded(document.body);
   		$.fn.triggerFastClick=function(){
   		    this.trigger("click");
   		        if(!notNeed){
   		        this.trigger("click");
   		    }
   		}
 		  
 		  
			$("#uploadbtn").click(function(){
				$("#uploadImg").triggerFastClick('click');
				$('#uploadImg').unbind().on('change',function(e){
					_self = $(_self);
					data = new FormData();
					$.each($('#uploadImg')[0].files, function(i, file) {
						data.append('Filedata', file);
					});
                    data.append('type', 'image');
					$.ajax({
						url:uploadUrl+'/file/upload',
						type:'POST',
						data:data,
						cache: false,
						contentType: false,    
						processData: false,
						dataType:'json',
						beforeSend:function(){
						},
						success:function(data){
								$('#uploadbtn').children('input').val(data.url);
								$('#uploadbtn').children('img').attr('src', data.full_url);
								e.stopPropagation();
						}
					});
				})
			})
		},
 		
 	
 	}
 	
 	function showDialog(msg, title, url){

     	var title = arguments[1] ? arguments[1] : '提示信息';
     	var url = arguments[2] ? arguments[2] : '';
     	var title = arguments[1] ? arguments[1] : '提示信息';
      var url = arguments[2] ? arguments[2] : '';
      weui.alert(msg, function(){
        if(url != ''){
          window.location.href=url;
        }
      });
     }
 	
 	//url ajax请求地址   url1跳转地址
 	function ajaxDialog(msg, title, url, url1){

     	var title = arguments[1] ? arguments[1] : '提示信息';
     	var url = arguments[2] ? arguments[2] : '';
     	var url1 = arguments[3] ? arguments[3] : '';
     	
      if(url != '')
      {
        $.get(url, function(data){})
      }
      weui.alert(msg, function(){
        window.location.href=url1;
      })
     }
 	
 })