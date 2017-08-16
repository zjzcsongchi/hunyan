/**
 * 资讯页js
 * @author yonghua@gz-zc.cn
 */
define(function(require, exports, module){
	
	var public = require('public');
	module.exports = {
	    get:function(){
	    	$('.get').on('click', function(){
	    		var url = $(this).attr('data');
	    		window.location.href=url;
	    	})
	    }
	}
});