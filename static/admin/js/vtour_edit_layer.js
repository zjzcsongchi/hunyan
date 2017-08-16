/**
 * 编辑VR全景弹框
 * @author chaokai@gz-zc.cn 
 */
define(function(require, exports, module){

	module.exports = {

		//初始化方法
		init:function(){

		},
		//创建层
		create_layer:function(title, content_obj){
			var obj = this;
			//背景
			bg_layer = $("<div></div>")
			bg_layer.css({"position":"absolute", "width":"100%", "height":"100%", "background":"rgba(0,0,0,0.5)", "z-index":"10001", "top":"0"})
			//背景层
			var layer = $("<div></div>")
			layer.addClass("container")
			layer.css({"position":"absolute", "top":"50%", "margin-top":"-350px", "right":"0", "left":"0", "width":"1000px", "height":"750px", "background":"#fff", "border-radius":"3px", "box-shadow": "0 0 8px rgba(0, 0, 0, 0.1)"})
			//弹框头部
			var header = $("<div></div>")
			header.css({"height":"50px", "position":"relative"})
			//弹框头部title
			var header_title = $("<p></p>")
			header_title.addClass("h2")
			header_title.text(title)

			//关闭弹窗按钮
			var close_btn = $("<div></div>")
			close_btn.css({"position":"absolute", "top":"4px", "right":"4px", "width":"40px", "height":"40px", "cursor":"pointer"})
			//关闭按钮图片
			var btn_img = $("<img>")
			btn_img.attr("src", staticUrl+"/krpano/skin/close_black.png")
			btn_img.css({"width":"100%", "height":"100%"})

			//弹框内容
			var content = $("<div></div>")
			content.css({"position":"relative", "height":"600px", "border":"none", "overflow-y":"auto", "overflow-x":"hidden"})

			//弹框底部
			var bottom = $("<div></div>")
			bottom.addClass("text-right")
			bottom.css({"position":"relative", "height":"60px"})
			//底部按钮
			var bottom_btn1 = $("<button>关 闭</button>")
			bottom_btn1.addClass("btn btn-primary close_layer")
			var bottom_btn2 = $("<button>保 存</button>")
			bottom_btn2.addClass("btn btn-primary save_layer")
			bottom.append(bottom_btn1)
			bottom.append(bottom_btn2)

			//添加到页面中
			close_btn.append(btn_img)
			header.append(header_title)
			header.append(close_btn)
			content.append(content_obj)

			layer.append(header)
			layer.append(content)
			layer.append(bottom)

			bg_layer.append(layer)
			$("body").append(bg_layer)

			//绑定关闭弹框事件
			$(".close_layer").click(function(){
				obj.close_layer();
			})
			close_btn.click(function(){
				obj.close_layer();
			})

		},
		//关闭层
		close_layer:function(){
			bg_layer.remove();
		}
	}
})