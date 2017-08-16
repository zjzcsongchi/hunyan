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
 		
 		blur:function(){
 			$(".sort").blur(function(){
 				var sort = $(this).val();
 				if($(this).hasClass("img")){
 					$(this).parent().parent("li").prev("li").find("input").attr("name", "head_img["+sort+"]");
 				}
 				
 				if($(this).hasClass("word")){
 					$(this).parent().parent("li").prev("li").find("input").attr("name", "word["+sort+"]");
 					$(this).parent("span").next("input").attr("name", "flag["+sort+"]");
 				}
 			})
 		},
 		submit:function(){
 			$('.submit').click(function(e){
 				e.preventDefault();
 				data = $("form").serialize();
 				$.post('/h5album/page_edit/'+user_id+'/'+template_id+'/'+page_id+'/'+per_page, data, function(res){
 					if (res.status == 0) {
 						showDialog("操作成功!","提示");
	 						$(".weui-dialog__btn_primary").click(function(){
	 							window.location.href="/h5album/invit/"+template_id+'/'+per_page; 
	 						})
		            }else{
		            	showDialog(res.msg,"提示");
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