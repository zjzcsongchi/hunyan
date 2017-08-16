/** 
 * 资讯管理js文件
 * @author: jianmign@gz-zc.cn
 */
define(function(require, exports, module){
    window.jQuery = window.$ = require("jquery");
    var base = require('base'); 

    module.exports = {
        //批量发布
        batchPublish: function(){
            $(".batch-publish").click(function(){
                var chk_value =[]; 
                $('input[name="checkbox"]:checked').each(function(){ 
                    chk_value.push($(this).val()); 
                }); 
                if (chk_value.length == 0) {
                    base.showDialog("请选择需要批量发布的文章！");
                    return false;
                } 

                $.post('/news/batch_publish', {'ids': chk_value}, function(data){
                    base.showDialog(data.msg, '', '/news');
                });

            });
        },

        //全选
        checkAll: function(obj) {
            $(".check-all").click(function(){
                $(obj).prop("checked", $(this).prop("checked"));
            });
        },

        //移除图片
        selectChange: function() {
            $('.news-class').change(function(){
                var level = $(this).find('option:selected').attr('data-level');
                if (level == 1) {
                    var is_has_child = $(this).find('option:selected').next().attr('data-level') == '2' ? '1' : '0';
                    $("input[name='is_has_child']").val(is_has_child);
                } else {
                    $("input[name='is_has_child']").val('0');
                }
            });
        }
    }
     
});