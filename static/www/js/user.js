/** 
 * 我的资料修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	require('wdate');
	module.exports = {
			edit:function(){
				$('.submit').click(function(){
					var id = $('#user_id').val();
					var realname = $('#realname').val();
					var nickname = $('#nickname').val();
					var sex = $(':radio[name="sex"]:checked').val();
					var birthday = $('#birthday').val();
					var mobile = $('#mobile').val();
					var head_img = $('input[name="cover_img"]').val();
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
					}else if(birthday == '' ){
						module.exports.msg('请选择日期');
						return false;
					}else if(mobile == '' ){
						module.exports.msg('请天填写正确的手机号');
						return false;
					}else if(address == '' ){
						module.exports.msg('地址不能为空');
						return false;
					}
					$.post('/usercenter/edit_info',{'id':id,'realname':realname,'nickname':nickname,'sex':sex,'birthday':birthday,'mobile':mobile,'head_img':head_img,'address':head_img,'address':address},function(data){
						if(data){
							if(data == 1){
								var d = dialog({
									title:"提示",
									content:'提交成功',
									cancelValue:"取消",
									ok:function(){
										window.location.href ='/usercenter/info';
									},
									okValue:"确定"
								})
								d.width(320);
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
					cancelValue:"取消",
					cancel:function(){},
					okValue:"确定"
				})
				d.width(320);
				d.showModal();
			},
			//时间选择器
			datepick:function(){
				$(".Wdate").focus(function(){
		            WdatePicker({dateFmt:'yyyy-MM-dd'})
		        });
			}
	}
});