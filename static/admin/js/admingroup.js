/** 
 * 管理员角色js文件
 * @author: jianming@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    require('dialog');
    var common = require('public'); 
    var base = require('base');

    module.exports = {
        //保存
        save: function() {
            $(".btn").click(function(){
                var token = $.trim($("#token").val());
                if(token == "0"){
                	common.showDialog("请重新填写别的角色名");
                    return false;
                }
                
                if($("#role_type").val() == -1){
                  common.showDialog("请选择管理员类型");
                  return false;
                }
             
                $.ajax( {
                    url:'/admingroup/add',
                    data: {
                        'name': $.trim($("#name").val()),
                        'describe': $.trim($("#describe").val()),
                        'role_type':$("#role_type").val()
                    },
                    type:'POST',
                    dataType:'json',
                    success:function(data) {
                        if(data.code == 0){
                            common.showDialog("添加成功",'系统提示信息' ,"/admingroup");
                        }else if(data.code == 2){
                        	common.showDialog("角色名称已经存在！");
                        }else{
                        	common.showDialog('请填写角色名');
                        }
                    },
                    error : function() {
                    	common.showDialog("网络异常！");
                    }
                });
            });
        },

        //检测角色名唯一性
        checkGroup: function(){
            $("#name").keyup(function(){
                $.ajax( {
                    url:'/admingroup/check_name',
                    data: {
                        'name': $.trim($("#name").val())
                     },
                    type:'POST',
                    dataType:'json',
                    success:function(data) {
                        if(data.code == 0){
                        	common.showDialog("该角色已经存在");
                        }
                        $("#token").val(data.code);
                    },
                    error : function() {
                    	common.showDialog("网络异常！");
                    }
                });
            });
        }
        
    }

});