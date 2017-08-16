/**
 * 编辑VR全景图文类型热点
 * @author chaokai@gz-zc.cn 
 */
define(function(require, exports, module){

	var layer = require('vtour_edit_layer')
	// var edit = require("edit_vtour")
	var wangeditor = require('wangeditor_api')
	require('jqueryswf')
  	require('swfupload')

  	var swfupload = require('admin_uploader')
	module.exports = {
		//添加
          //edit_obj 公共编辑对象
		add:function(edit_obj){
			var obj = this
			var content = $(add_vtour);

			layer.create_layer("添加场景切换热点", content)
			var object = [
                        {"obj":"#uploader_ico", "btn":"#btn_ico"}
                        ];
          	swfupload.swfupload(object)

          	//点击保存按钮
               $(".save_layer").unbind("click")
          	$(".save_layer").click(function(){
          		var hotspot_name = $("input[name=hotspot_name]").val()
          		var hotspot_text = $("input[name=hotspot_text]").val()
          		if($('li[class=active]').data('target') == 'customize'){
          		  var hotspot_target = $('#'+$('li[class=active]').data('target')).find('input[name=ico]');
          		}else{
          		  var hotspot_target = $('#'+$('li[class=active]').data('target')).find('input:checked[name=ico]');
          		}
          		var hotspot_ico = hotspot_target.val();
          		if(!hotspot_ico){
          			alert("请选择图标")
          			return false;
          		}
          		//判断是否为动态图标
          		var is_dynamic = hotspot_target.data('is_dynamic');
          		if(is_dynamic){
          		  var dynamic_url = hotspot_target.data('dynamic_url');
          		  var dynamic_param = hotspot_target.data('dynamic_param');
          		}else{
          		  var dynamic_url = false;
          		  var dynamic_param = false;
          		}

                    var linkedscene = $("input:checked[name=linkedscene]").val()
          		var hotspot_value = {
          			hotspot_type:"vtour",
          			hotspot_name:hotspot_name,
          			tooltip:hotspot_text,
          			url:hotspot_ico,
          			linkedscene:linkedscene
          		}
          		if(dynamic_url){
          			hotspot_value.url = dynamic_url
          			hotspot_value.ico_url = hotspot_ico
          		}
          		if(dynamic_param){
          			hotspot_value.dynamic_param = dynamic_param
          		}

          		edit_obj.add_hotspot(hotspot_value)
          		layer.close_layer()
          	})

		},
		//修改
          //edit_obj 公共编辑对象
          //hotspot 需要修改的热点数据
		edit:function(edit_obj, hotspot){
               var obj = this
               var content = $(edit_vtour);
               //数据赋值
               content.find("input[name='hotspot_name']").val(hotspot.hotspot_name)
               content.find("input[name='hotspot_text']").val(hotspot.tooltip)
               var is_default = edit_obj.ico_is_default(hotspot)//判断图标是否为默认图标
               var is_dynamic = hotspot.ico_url != '';//判断是否为动态图标
               if(is_default){
                    if(is_dynamic){
                         content.find("input[data-dynamic_url='"+hotspot.url+"']").prop("checked", true)
                    }else{
                         content.find("input[value='"+hotspot.url+"']").prop("checked", true)
                    }
               }else{
                    content.find("#system_nav").removeClass("active")
                    content.find("#system").removeClass("active")
                    content.find("#customize_nav").addClass("active")
                    content.find("#customize").addClass("active")

                    var customize_obj = $("<li class='pic pro_gre'></li>")
                    customize_obj.css({"margin-right":"20px", "clear":"none"})
                    var customize_a = $("<a class='close del-pic'></a>")
                    customize_obj.append(customize_a)

                    var customize_img = $("<img>")
                    customize_img.attr("src", edit_obj.get_img_url(hotspot.url))
                    customize_img.css({"width":"100%", "height":"100%"})
                    customize_obj.append(customize_img)

                    var customize_input = $("<input type='hidden' name='ico'>")
                    customize_input.attr("value", hotspot.url)
                    customize_obj.append(customize_input)

                    content.find("#uploader_ico").prepend(customize_obj)

               }
               content.find("input[name=linkedscene][value="+hotspot.linkedscene+"]").prop("checked", true)

               layer.create_layer("修改场景切换热点", content)
               //初始化添加图片按钮
               var object = [
                        {"obj":"#uploader_ico", "btn":"#btn_ico"}
                        ];
               swfupload.swfupload(object)

               //点击保存按钮
               $(".save_layer").unbind("click")
               $(".save_layer").click(function(){
                    var hotspot_name = $("input[name=hotspot_name]").val()
                    var hotspot_text = $("input[name=hotspot_text]").val()
                    if($('li[class=active]').data('target') == 'customize'){
                      var hotspot_target = $('#'+$('li[class=active]').data('target')).find('input[name=ico]');
                    }else{
                      var hotspot_target = $('#'+$('li[class=active]').data('target')).find('input:checked[name=ico]');
                    }
                    var hotspot_ico = hotspot_target.val();
                    if(!hotspot_ico){
                         alert("请选择图标")
                         return false;
                    }
                    //判断是否为动态图标
                    var is_dynamic = hotspot_target.data('is_dynamic');
                    if(is_dynamic){
                      var dynamic_url = hotspot_target.data('dynamic_url');
                      var dynamic_param = hotspot_target.data('dynamic_param');
                    }else{
                      var dynamic_url = false;
                      var dynamic_param = false;
                    }

                    var linkedscene = $("input:checked[name=linkedscene]").val()
                    if(!linkedscene){
                         alert("请选择场景")
                         return false;
                    }

                    hotspot.hotspot_name = hotspot_name
                    hotspot.tooltip = hotspot_text
                    hotspot.url = hotspot_ico
                    hotspot.linkedscene = linkedscene
                    if(dynamic_url){
                         hotspot.url = dynamic_url
                         hotspot.ico_url = hotspot_ico
                    }else{
                         hotspot.ico_url = '';
                    }
                    if(dynamic_param){
                         hotspot.dynamic_param = dynamic_param
                    }else{
                         hotspot.dynamic_param = ''
                    }

                    edit_obj.update_hotspot(hotspot)
                    layer.close_layer()
               })

		}

	}
})