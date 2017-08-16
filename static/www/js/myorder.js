/** 
 * 我的资料修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	module.exports = {
			del:function(){
				$('.del').click(function(){
					var id = $(this).attr('id');
					var user_id = $(this).attr('data');
					$.post('/usercenter/del_order',{'id':id,'user_id':user_id},function(data){
						if(data){
							if(data == 1){
								$('#t_'+id).remove();
								module.exports.msg('操作成功');
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
				    content: msg
				});
				d.show();
				setTimeout(function () {
				    d.close().remove();
				}, 2000);
			}
	}
});