(function() {
//	function k(a, b, c) {
//		if (a.addEventListener) a.addEventListener(b, c, false);
//		else a.attachEvent && a.attachEvent("on" + b, c)
//	}
//	function g(a) {
//		if (typeof window.onload != "function") window.onload = a;
//		else {
//			var b = window.onload;
//			window.onload = function() {
//				b();
//				a()
//			}
//		}
//	}
//	function h() {
//		var a = {};
//		for (type in {
//			Top: "",
//			Left: ""
//		}) {
//			var b = type == "Top" ? "Y": "X";
//			if (typeof window["page" + b + "Offset"] != "undefined") a[type.toLowerCase()] = window["page" + b + "Offset"];
//			else {
//				b = document.documentElement.clientHeight ? document.documentElement: document.body;
//				a[type.toLowerCase()] = b["scroll" + type]
//			}
//		}
//		return a
//	}
//	function l() {
//		var a = document.body,
//		b;
//		if (window.innerHeight) b = window.innerHeight;
//		else if (a.parentElement.clientHeight) b = a.parentElement.clientHeight;
//		else if (a && a.clientHeight) b = a.clientHeight;
//		return b
//	}
	function i() {
		this.parent = document.getElementsByClassName('page-main')[0];
		this.createEl(this.parent, a);
		this.size = Math.random() * 5 + 5;
		this.el.style.width = "60px";
		this.el.style.height =  "65px";
//		this.maxLeft = document.body.offsetWidth - this.size - 100;
//		this.maxTop = document.body.offsetHeight - this.size;
//		this.left = Math.random() * this.maxLeft;
//		this.top = h().top + 1;
//		this.angle = 1.4 + 0.5 * Math.random();
//		this.minAngle = 1.4;
//		this.maxAngle = 1.6;
//		this.angleDelta = 0.02 * Math.random();
//		this.speed = 3 + Math.random()
	}
	var cut_num = 0;
	var data_arr = [];
	window.createCake = function(info, num) {
			data_arr.push({info:info,num:num});
			var c = [],
			m = setInterval(function() {
				if(data_arr.length >= 1){
					if(cut_num != 0){
						data_arr.splice(0, cut_num);
					}
//					console.log(data_arr[0]); 
					if(data_arr[0]){
						a = data_arr[0].info;
						b1 = data_arr[0].num;
						for(x = 0; x<b1; x++){
							c.push(new i(a));
						}
						cut_num = 1;
						b = b1;
					}
					if(data_arr[1]){
						a1 = data_arr[1].info;
						b2 = data_arr[1].num;
						for(y = 0; y<b2; y++){
							c.push(new i(a1));
						}
						b = parseInt(b) + parseInt(b2);
						cut_num = 2;
					}
					if(data_arr.length == 0){
						cut_num = 0;
					}
				}
				
				
			},
			4000);
			
			var ani = anime({
                targets: '.get-cake',
                translateY: [
                    0,
                    -800
                ],
                loop: false,
                easing: 'easeOutElastic',
                duration: 6000,
                complete:function(){
                  console.log('complete')
                }
            });
			console.log(anime.list);
	};
	
	
	window.removeSnow = function() {
		f = false
	};
	i.prototype = {
		createEl: function(a, b) {
			this.el = document.createElement("div");
			this.el.className = "get-cake";
			this.parent.appendChild(this.el)
			this.el.innerHTML ="<i></i><img src='"+b.head_img+"' class='img1'><p>李晓玲<span>赠送</span>张梦雪</p><img src='temp/head1.jpg' class='img2'></div>"
		},
		move: function() {
//			anime({
//                targets: '.get-cake',
//                translateY: [
//                    800
//                    ,
//                    -1500
//                ],
//                translateX: [
//     	                    200,
//     	                    0
//     	                ],
//                loop: false,
//                easing: 'linear',
//                duration: 6000
//            });
//			if (this.angle < this.minAngle || this.angle > this.maxAngle) this.angleDelta = -this.angleDelta;
//			this.angle += this.angleDelta;
//			this.left += this.speed * Math.cos(this.angle * Math.PI);
//			this.top -= this.speed * Math.sin(this.angle * Math.PI);
//			if (this.left < 0) this.left = this.maxLeft;
//			else if (this.left > this.maxLeft) this.left = 0
		},
		draw: function() {
			this.el.style.top = Math.round(this.top);
			this.el.style.left = Math.round(this.left)
//			anime({
//	          targets: '.get-cake',
//	          translateY: [
//	              800
//	              ,
//	              -1500
//	          ],
//	          translateX: [
//		                    200,
//		                    0
//		                ],
//	          loop: false,
//	          easing: 'linear',
//	          duration: 6000
//			});
		},
		remove: function() {
			this.parent.removeChild(this.el);
			this.parent = this.el = null
		}
	}
})();