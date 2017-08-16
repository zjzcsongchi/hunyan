/** 
 * 我的资料修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	var my_dialog = require('my_dialog');
	module.exports = {
			edit:function(){
				$('.submit').on('click', function(){
					var id = $('#user_id').val();
					var realname = $('#realname').val();
					var nickname = $('#nickname').val();
					var sex = $(':radio[name="sex"]:checked').val();
					var mobile_phone = $('#mobile_phone').val();
					var address = $('#address').val();
					if(realname == ''){
						module.exports.msg('姓名不能为空');
						return false;
					}else if(nickname == '' ){
						module.exports.msg('用户名不能为空');
						return false;
					}else if(sex == '' ){
						module.exports.msg('请选中性别');
						return false;
					}else if(mobile_phone == '' ){
						module.exports.msg('请天填写正确的手机号');
						return false;
					}else if(address == '' ){
						module.exports.msg('地址不能为空');
						return false;
					}
					
					$.post('/usercenter/edit_info',{'id':id,'realname':realname,'nickname':nickname,'sex':sex,'mobile_phone':mobile_phone,'address':address},function(data){
						if(data){
							if(data == 1){
								var d = dialog({
									title:"提示",
									content:'提交成功',
									cancelValue:"取消",
									ok:function(){
										window.location.href ='/usercenter/index';
									},
									okValue:"确定"
								})
								d.width(300);
								d.showModal();
							}else{
								module.exports.msg(data);
							}
						}else{
							module.exports.msg('网络错误');
						}
					})
				});
			},
			msg:function(msg){
				var d = dialog({
					title:"提示",
					content:msg,
					cancelValue:"确定",
					cancel:function(){},
				})
				d.width(320);
				d.showModal();
			},
			//时间选择器
			datepick:function(){
				$(".Wdate").on('focus', function(){
		            WdatePicker({dateFmt:'yyyy-MM-dd'})
		        });
			},
			//搜索相册
			search:function(){
			  $('#search_btn').on('click', function(){
			    var search_name = $('#search_text').val();
			    if(!search_name){
			      my_dialog.alert('搜索内容不能为空');
			      return false;
			    }
			    $.post('/usercenter/search_dinner', {search_name:search_name}, function(data){
			      if(data.status != 0){
			        my_dialog.alert(data.msg);
			      }else{
			        $('#search_result').html(data.data);
			      }
			    })
			  })
			}
	}
});