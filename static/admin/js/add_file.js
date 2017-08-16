
define(function(require, exports, module){
	
	require('dialog');
	
	module.exports = {
			save:function(backurl){
				$('#save').click(function(){
					var data = $('form').serialize();
					$.post('/dinner/add_file', data, function(data){
						var d = dialog({
							title:'提示',
							content : data.msg,
							ok:function(){
								if(data.status == 0){
									window.location.href=backurl;
								}
							},
							okValue:'确定'
						})
						d.width(320)
						d.showModal();
					})
				})
			},
			edit:function(backurl){
				$('#save').click(function(){
					var data = $('form').serialize();
					$.post('/dinner/add_video', data, function(data){
						var d = dialog({
							title:'提示',
							content : data.msg,
							ok:function(){
								if(data.status == 0){
									window.location.href=backurl;
								}
							},
							okValue:'确定'
						})
						d.width(320)
						d.showModal();
					})
				})
			}
	}
})