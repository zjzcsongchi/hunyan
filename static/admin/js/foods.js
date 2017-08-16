/**
 *菜品管理js
**/
define(function(require, exports, module){
    window.jQuery = window.$ = require('jquery');
    var base = require('base');
    
    module.exports = {
            //删除
            del:function(){
                $('.del').click(function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                    var d = dialog({
                        title: '提示',
                        content: '确认删除？',
                        okValue: '确定',
                        ok: function () {
                            var obj = this;
                            $.get(url, function(data){
                                if(data.status == 0){
                                    window.location.reload();
                                }else{
                                    obj.title('错误');
                                    obj.content(data.msg);
                                }
                            })
                            return false;
                        },
                        cancel: function(){
                            d.close();
                        },
                        cancelValue: '取消'
                    });
                    d.width(320);
                    d.showModal();
                })
            },

            //详情
            detail:function(){
                $('.detail').click(function(e){
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $.get(url, function(data){
                        var d = dialog({
                            title:'菜品详情',
                            content:data,
                            okValue:'关闭',
                            ok:function(){}
                        })
                        d.width(400);
                        d.showModal();
                    })
                })
            }
    }
    
})