/**
 * 场馆管理js
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	module.exports={
		//保存场馆
		save:function(){
			$("form").submit(function(e){
				 e.preventDefault();
				 var post_arr_data = $("form").serializeArray();
				 $.post("",{arr:post_arr_data},function(data){
						if(data.status == 0){
							showDialog(data.msg, '', '/theme');
						}else{
							showDialog(data.msg);
						}
						
				  });
				 function showDialog(msg, title, url){
				    var title = arguments[1] ? arguments[1] : '提示信息';
				    var url = arguments[2] ? arguments[2] : '';
				    var d = dialog({
				        title: title,
				        content: msg,
				        modal:false,
				        okValue: '确定',
				        ok: function () {
				            if(url != '')
				            {
				                window.location.href=url;
				            }
				            return true;
				        }
				    });
				    d.width(320);
				    d.show();
				}
			})
			
		},
		delete:function(){
			$(".delete").click(function(){
				var url=$(this).attr("url");
				var d = dialog({
			        title: '删除',
			        content: '是否删除',
			        modal:false,
			        okValue: '确定',
			        ok: function () {
			            if(url != '')
			            {
			                window.location.href=url;
			            }
			            return true;
			        }
			    });
			    d.width(320);
			    d.show();
				
			})
		}
		
	}
})