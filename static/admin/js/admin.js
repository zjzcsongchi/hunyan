/** 
 * 管理员js文件
 * @author: jianming@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    var base = require('base');
    require('dialog');
    var common = require('public'); 
    var base = require('base');

    module.exports = {
        //设置不可用
        setDisabled: function(btn) {
            $(btn).attr("disabled", false).addClass("btn-disable");
        },

        //保存
        save: function() {
            $(".btn").click(function(){
                var password = $.trim($("#password").val());
                var fullname = $.trim($("#fullname").val());
                var name = $.trim($("#name").val());
                var group_id = $.trim($("select[name=group_id]").val());
                var email = $.trim($("#email").val());
                var tel = $.trim($("#tel").val());
                var disabled =  $('input[name="disabled"]:disabled ').val();
                var describe = $.trim($("#describe").val());
                $.ajax( {
                    url:'/admin/add',
                    data: {
                        'name': name,
                        'group_id':group_id,
                        'password':password,
                        'fullname':fullname,
                        'email':email,
                        'tel':tel,
                        'describe':describe,
                        'disabled':disabled
                    },
                    type:'POST',
                    dataType:'json',
                    success:function(data) {
                        if(data.code == 0){
                        	common.showDialog(data.msg, '', '/admin' );
                        }else{
                        	common.showDialog(data.msg);
                        }                    
                    },
                    error : function() {
                    	common.showDialog("网络异常");
                    }
                });
            });
        },

        //校验密码
        confirmPwd: function() {
            $("#confirpassword").blur(function(){
                if($.trim($("#confirpassword").val()) != $.trim($("#password").val())){
                	common.showDialog("两次输入的密码不统一");
                    $("#token2").val(0);
                }
                else{
                    $("#confirpassword-msg").html("*");
                    $("#token2").val(1);
                }
            });
        },

        checkFullname: function() {
            $("#fullname").keyup(function(){
                 check();
            });   
        },

        //检查登录名是否存在
        checkAdmin: function() {
            $("#name").keyup(function(){
            	if($.trim($("#name").val()) != ''){
                $.ajax( {
                    url:'/admin/check_admin',
                    data: {
                        'name': $.trim($("#name").val())
                     },
                    type:'POST',
                    dataType:'json',
                    success:function(data) {
                        if(data.code == 0){
                        	common.showDialog("登陆名已经存在!");
                        }
                        $("#token").val(data.code);
                        check();
                    },
                    error : function() {
                    	common.showDialog("网络异常！");
                    }
                });
            	}else{
                	common.showDialog("登陆名不能为空！");
            	}
            });
        },

        
    }

    function check(){
        var token = $.trim($("#token").val());
        var token2 = $.trim($("#token2").val());
        var password = $.trim($("#password").val());
        var confirpassword = $.trim($("#confirpassword").val());
        var fullname = $.trim($("#fullname").val());
        var name = $.trim($("#name").val());
        if(token !=0 && token2 != 0 && fullname != "" && confirpassword != "" && password != "" && name != ""){
            $(".btn").attr("disabled", false).removeClass("btn-disable");
        }
        else{
            $(".btn").attr("disabled", true).addClass("btn-disable");
        }
    }
     
});