define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    var base = require('base');
    require('dialog');
   var common = require('public');
    require('lightbox');
    module.exports = {

        check_del: function(){

            $("#all_check").click(function(){
                sel(this);
            });

        },

        delAll: function(){
            //遍历选择的房屋
            $("#delAll").click(function(){
                if(($('input:checked').length) <= 0){
                    common.showDialog("请选择房屋");
                }
                var ids = "";
                $(".check_body td input[type=checkbox]").each(function(){
                    if(this.checked){
                        ids+= $(this).val()+"-";
                    }
                });

                var title = arguments[1] ? arguments[1] : '提示信息';
               var d = dialog({
                    title: title,
                    content: "你确定要删除吗？",
                    okValue: '确定',
                    cancelValue: "取消",
                   cancel: function(){},
                    ok: function () {
                        $.ajax( {
                            url:"/rooms/get_ajax_delrooms",
                            data: {
                                'ids': ids
                            },
                            type:'POST',
                            dataType:'json',
                            success:function(data) {
                                if(data.status == 0){
                                    document.location.reload();
                                }else{
                                    common.showDialog("删除失败,请重新操作！");
                                }

                            }

                        });
                    }
                });
                d.width(320);
                d.showModal();
            });
        },
        //是否删除
        isDel: function() {
         $(".del").click(function(){
              var str = $(this).attr("title");
              var url = $(this).attr("url");
              common.showDialog("你确定删除 "+str+" ","",url);
            });
        },
        showImg: function(){
            $('#gallery a').lightBox({ fixedNavigation: true });
         }

    }

    function sel(obj) {
        if (obj.checked) {
            var attr = $(".check_body").find("input");
            for (var i = 0; i <= attr.length; i++) {
                if (attr[i] != undefined || attr[i] != null)
                    attr[i].checked = true;
            }
        } else {
            var attr = $(".check_body").find("input");
            for (var i = 0; i <= attr.length; i++) {
                if (attr[i] != undefined || attr[i] != null)
                    attr[i].checked = false;
            }

        }
    }


});