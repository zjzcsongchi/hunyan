/**
 * 资讯页js
 * @author songchi@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	module.exports = {
		zan:function(){
			$(".zan").on('click', function(){
		        var _obj = $(this);
		        var number = parseInt(_obj.attr("data-num"));
		        $.ajax( {
		            url:'/news/get_ajax_zan',
		            data: {
		                'id': id,
		                'number': number
		            },
		            type:'POST',
		            dataType:'json',
		            success:function(da) {
		                if(da.status == 0){
		                    _obj.attr("data-num",number+1);
		                    $(".l i").html(number+1);
		                    $(".add").animate({
		                		  top:'3px',
		                	      opacity:'0',
		                	      height:'150px',
		                	      width:'150px'},2000);
		                }
		            }

		        });
		    });
		}
	
	}
})