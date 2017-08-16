
define(function(require, exports, module){

	window.$ = require('jquery');
	require('wangeditor')($);
	
	module.exports = {
		load:function(){
			// 用来创建编辑器
			wangEditor.config.printLog = false;
	        var editor = new wangEditor('wang_editor');
	        editor.config.menus = [
	                               'source',
	                               '|',
	                               'bold',
	                               'underline',
	                               'italic',
	                               'strikethrough',
	                               'eraser',
	                               'forecolor',
	                               'bgcolor',
	                               '|',
	                               'quote',
	                               'fontfamily',
	                               'fontsize',
	                               'head',
	                               'unorderlist',
	                               'orderlist',
	                               'alignleft',
	                               'aligncenter',
	                               'alignright',
	                               '|',
	                               'link',
	                               'unlink',
	                               'table',
	                               '|',
	                               'img',
	                               'undo',
	                               'redo',
	                               'fullscreen'
	                               ];
	        editor.config.uploadImgUrl = uploadUrl+'/file/upload';
	        editor.config.menuFixed = false;
	        editor.config.uploadParams = {
	        		source:'editor',
	        		type:'image'
	        };
	        editor.create();
		}
	}
})