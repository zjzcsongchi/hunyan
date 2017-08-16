/**
 * 宴会相册管理
 */
define(function(require, exports, module){
	require('dialog');
	
	module.exports = {
			//搜索资讯文章
			search_news:function(){
				$('#search_name').on('keyup change', function(){
					var news_name = $('#search_name').val();
					var dialog_param = {
							title:'提示',
							okValue:'确认',
							cancelValue:'取消',
							ok:function(){},
							cancel:function(){}
					};
					$.post('/news/search', {name:news_name}, function(data){
						if(data.status != 0){
							var d = dialog(dialog_param);
							d.width(320);
							d.showModal();
						}else{
							var content = '';
							$.each(data.data, function(k, v){
								content += '<div class="radio">';
								content += '<label>';
								content += '<input type="radio" value="'+v.id+'">'+v.title;
								content += '</label>';
								content += '</div>';
							})
							$('#search_result').html(content);
						}
					})
					
				})
			},
			//确认选择文章
			sure_select:function(){
				$('#search_result').on('click', '.radio', function(){
					var content = $(this).children('label').text();
					var article_id = $(this).children('label').children('input').val();
					$('#search_name').val(content);
					$('#article_id').val(article_id)
				})
			}
	}
})