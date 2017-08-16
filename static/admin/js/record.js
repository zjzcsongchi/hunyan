/** 
 * 资讯管理js文件
 * @author: jianmign@gz-zc.cn
 */
define(function(require, exports, module){
	window.jQuery = window.$ = require("jquery");
    var base = require('base'); 
    module.exports = {	
    	alert:function(msg){
    		var d = dialog({
    			id: 'EF893Ld',
    		    title: '提示',
    		    width:200,
    		    cancelValue: '取消',
    		    content: msg
    		});
    		d.show();
    	},
    	del:function(){
        	$('.delete').on('click', function(){
        		var id = $(this).attr('data-id');
        		var d = dialog({
        			id: 'EF893L',
        		    title: '提示',
        		    width:300,
        		    content: '确定要删除吗？',
        		    cancel: true,
        		    cancelValue: '取消',
        		    cancal: function(){
        		    	return false;
        		    },
        		    okValue: '确定',
        		    ok: function () {
	               		 $.get('/record/del',{'id':id}, function(data){
	           				if(data){
	           					if(data.code == 1){
	           						$("#tr_"+id).remove();
	           					}else{
	           						module.exports.alert(data.msg);
	           					}
	           				}else{
	           					module.exports.alert('网络超时');
	           				}
	           			 });
        		    }
        		});
        		d.show();
        	})
        },
        showimg:function(){
        	$('.ewm').on('click', function(){
        		var id = $(this).attr('data-id');
        		$.get('/record/detail', {'id':id}, function(data){
        			if(data != 'nodata'){
        				var d = dialog({
                        	id: 'EF893Ld',
                		    title: '请扫描屏幕二维码查看手机端效果',
                		    width:500,
                		    hight:800,
                		    cancelValue: '关闭',
                		    content: data
                		});
                		d.showModal();
        			}
        		})
                
        	});
        },
        
        record_ewm:function(){
        	$('#record_ewm').on('click', function(){
        		var url = $(this).attr('data-url');
                var d = dialog({
                	id: 'EF893Ls',
        		    title: '请微信扫描屏幕二维码查看',
        		    width:200,
        		    cancelValue: '取消',
        		    content: '<img style="width:200px" src="/publicservice/qr_code?link='+url+'">'
        		});
        		d.showModal();
        	});
        }
    }
});