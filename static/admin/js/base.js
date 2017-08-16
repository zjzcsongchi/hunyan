/** 
 * 后台公用js文件
 * @author: jianmign@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    require('datepicker');
    require('tabs');
    require('dialog');

    module.exports = {
        //弹出框
        comfirmModal: function(content,hasBtn, callback){
            if(hasBtn===false){
                $("#sure").hide();
                $("#cancel").val("我知道了");
                $("#cancel").attr("class","sure");
            }else{
                $("#sure").show();
                $("#cancel").attr("class","cancel");
                $("#cancel").val("取消");

            }
            $(".content").html(content);
            $(".tip").fadeIn(200);

            $(".tiptop a").click(function(){
                $(".tip").fadeOut(200);
            });

            $("#sure").click(function(){
                $(".tip").fadeOut(100);
            });

            $("#cancel").click(function(){
                $(".tip").fadeOut(100);
            });
        },

        //时间控件
        initDatePicker: function(format) {
        	if(!format){
        		format = 'yyyy-MM-dd HH:mm:ss';
        	}
            $(".Wdate").focus(function(){
                WdatePicker({dateFmt: format})
            });
        },

        //初始化tab框
        initTabs: function() {
            $("#usual1 ul").idTabs();
        },

        //dialog弹出框
        showDialog:showDialog

    }

    function showDialog(msg, title, url){
        var title = arguments[1] ? arguments[1] : '提示信息';
        var url = arguments[2] ? arguments[2] : '';
        var d = dialog({
            title: title,
            content: msg,
            okValue: '确定',
            ok: function () {
                if(url != '')
                {
                    window.location.href=url;
                }
                return true;
            }
        });
        d.width(320);
        d.showModal();
    }
     
});