/** 
 * 公共模块
 * 
 * @author: james
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    require('dialog');
    require('jqueryplaceholder');
    
    module.exports = {
    		/**
    		 * IEplaceholder
    		 */
    		setPlaceholder:function(){
    			 $('input').placeholder();
    		},
    		
    		 /**
    	     * 暴露提示信息模块
    	     */
    		showTips:showTips,
    		
    		/**
    		 * 暴露弹出框
    		 */
    		showDialog:showDialog
    		
    		
    }
    
    /**
     * 绝对定位的提示信息
     * 
     * @param id
     * @param msg
     * @param position
     */
    function showTips (id, msg, position){
		var position = arguments[2] ? arguments[2] : 'right';
    	 var d = dialog({
             align: position,
             content: msg,
             quickClose: true
         });
         d.show(document.getElementById(id));
	}
    
    /**
     * 普通提示信息
     * 
     * @param msg
     * @param title
     * @param url 
     */
    function showDialog(msg, title, url){

    	var title = arguments[1] ? arguments[1] : '提示信息';
    	var url = arguments[2] ? arguments[2] : '';
        var d = dialog({
        	id:'FVASDF',
            title: title,
            content: msg,
            width: 300,
            okValue: '确定',
            cancelValue: '取消',
            ok: function () {
            	if(url != '' && Object.prototype.toString.call(url) === "[object String]")
            	{
            		window.location.href=url;
            	}else if(url != '' && Object.prototype.toString.call(url) === "[object Function]"){
            	  url();
            	}
              return true;
            },
            cancel: function () {
              return true;
            }
        });
        d.showModal();
    }
    
});

