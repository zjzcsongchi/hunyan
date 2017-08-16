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
			var content = $(add_video);

			layer.create_layer("添加视频热点", content)
			var object = [
                        {"obj":"#uploader_video", "btn":"#btn_video", "type":"video"},
                        {"obj": "#uploader_image", "btn": "#btn_image"}
                        ];
          	swfupload.swfupload(object)

          	//点击保存按钮
               $(".save_layer").unbind("click")
          	$(".save_layer").click(function(){
          		var hotspot_name = $("input[name=hotspot_name]").val()

                    var source_url = $("input[name=video]").val()
                    if(!source_url){
                         alert("请上传视频")
                         return false
                    }
                    var scale = $("input[name=scale]").val()
                    if(!scale){
                         alert("请输入视频大小比例")
                         return false;
                    }
                    var posterurl = $("input[name=image]").val()
          		var hotspot_value = {
          			hotspot_type:"video",
          			hotspot_name:hotspot_name,
          			source_url:source_url,
                         scale:scale
          		}
                    if(posterurl){
                         hotspot_value.posterurl = posterurl;
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
               var content = $(edit_video);
               //数据赋值
               content.find("input[name='hotspot_name']").val(hotspot.hotspot_name)
               content.find("input[name=scale]").val(hotspot.scale)
               
               //修改视频
               var video_obj = $("<li class='pic pro_gre'></li>")
               video_obj.css({"margin-right":"20px", "clear":"none"})
               var video_a = $("<a class='close del-pic'></a>")
               video_obj.append(video_a)

               var video_img = $("<video>")
               video_img.attr("src", edit_obj.get_video_url(hotspot.source_url))
               video_img.attr("controls", "controls")
               video_img.css({"width":"100%", "height":"100%"})
               video_obj.append(video_img)

               var video_input = $("<input type='hidden' name='video'>")
               video_input.attr("value", hotspot.source_url)
               video_obj.append(video_input)

               content.find("#uploader_video").prepend(video_obj)
               //修改视频封面图
               if(hotspot.posterurl){
                    var image_obj = $("<li class='pic pro_gre'></li>")
                    image_obj.css({"margin-right":"20px", "clear":"none"})
                    var image_a = $("<a class='close del-pic'></a>")
                    image_obj.append(image_a)

                    var image_img = $("<img>")
                    image_img.attr("src", edit_obj.get_img_url(hotspot.posterurl))
                    image_img.css({"width":"100%", "height":"100%"})
                    image_obj.append(image_img)

                    var image_input = $("<input type='hidden' name='image'>")
                    image_input.attr("value", hotspot.posterurl)
                    image_obj.append(image_input)

                    content.find("#uploader_image").prepend(image_obj)
                    
               }


               layer.create_layer("修改视频热点", content)
               //初始化添加图片按钮
               var object = [
                        {"obj":"#uploader_video", "btn":"#btn_video", "type":"video"},
                        {"obj": "#uploader_image", "btn": "#btn_image"}
                        ];
               swfupload.swfupload(object)

               //点击保存按钮
               $(".save_layer").unbind("click")
               $(".save_layer").click(function(){
                    var hotspot_name = $("input[name=hotspot_name]").val()
                    var source_url = $("input[name=video]").val()
                    if(!source_url){
                         alert("请上传音乐")
                         return false;
                    }
                    var posterurl = $("input[name=image]").val()
                    var scale = $("input[name=scale]").val()

                    hotspot.hotspot_name = hotspot_name
                    hotspot.source_url = source_url
                    hotspot.scale = scale
                    if(posterurl){
                         hotspot.posterurl = posterurl
                    }

                    edit_obj.update_hotspot(hotspot)
                    layer.close_layer()
               })

		}

	}
})