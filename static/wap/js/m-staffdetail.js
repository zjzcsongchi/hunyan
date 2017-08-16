/** 
 * 我的资料修改js文件
 * @author: yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	require('dialog');
	var my_dialog =require('my_dialog');
	module.exports = {
		load_more:function(){
			$(document).on('click', '.more', function(){
				var status = $(this).attr('data-status');
				var staff_id = $(this).attr('data-id');
				var user_id = $(this).attr('data-user_id');
				if(status == 1){
					var page = $(this).attr('data-page');
					var _obj = $(this);
					$.get('/usercenter/staff_get_more', {'page':page,'id':staff_id, 'user_id':user_id}, function(data){
						if(data != 'nodata'){
							_obj.before(data);
							page = parseInt(page)+1;
							_obj.attr('data-page', page);
						}else{
							my_dialog.alert('已经加载完咯！');
							_obj.text('已经加载完咯！');
							_obj.attr('data-status', 0);
						}
					})
				}
			})
		}
	}
});