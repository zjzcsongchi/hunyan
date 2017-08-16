(function() {
	function k(a, b, c) {
		if (a.addEventListener) a.addEventListener(b, c, false);
		else a.attachEvent && a.attachEvent("on" + b, c)
	}
	function g(a) {
		if (typeof window.onload != "function") window.onload = a;
		else {
			var b = window.onload;
			window.onload = function() {
				b();
				a()
			}
		}
	}
	function h() {
		var a = {};
		for (type in {
			Top: "",
			Left: ""
		}) {
			var b = type == "Top" ? "Y": "X";
			if (typeof window["page" + b + "Offset"] != "undefined") a[type.toLowerCase()] = window["page" + b + "Offset"];
			else {
				b = document.documentElement.clientHeight ? document.documentElement: document.body;
				a[type.toLowerCase()] = b["scroll" + type]
			}
		}
		return a
	}
	function l() {
		var a = document.body,
		b;
		if (window.innerHeight) b = window.innerHeight;
		else if (a.parentElement.clientHeight) b = a.parentElement.clientHeight;
		else if (a && a.clientHeight) b = a.clientHeight;
		return b
	}
	function i(a) {
		this.parent = document.getElementsByClassName('page-main')[0];
		this.createEl(this.parent, a);
		this.size = Math.random() * 5 + 5;
		this.el.style.width = "100px";
		this.el.style.height =  "65px";
		this.maxLeft = document.body.offsetWidth - this.size - 100;
		this.maxTop = document.body.offsetHeight - this.size;
		this.left = Math.random() * this.maxLeft;
		this.top = h().top + 1;
		this.angle = 1.4 + 0.5 * Math.random();
		this.minAngle = 1.4;
		this.maxAngle = 1.6;
		this.angleDelta = 0.02 * Math.random();
		this.speed = 3 + Math.random()
	}
	var j = false;
	g(function() {
		j = true
	});
	var f = true;
	
	//队列数组
	var data_arr = [];
	
	var a, a1, b, b1;
//	a = data_arr[0].info;
//	a1 = data_arr[1].info;
//	b1 = data_arr[0].num;
//	b2 = data_arr[1].num;
//	b = b1 + b2;
	b = 0;
	var cut_num = 0;
	window.createSnow = function(info, num) {
		if (j) {
			data_arr.push({info:info,num:num});
			var c = [],
			m = setInterval(function() {
				if(b <= 0 && data_arr.length >= 1){
					if(cut_num != 0){
						data_arr.splice(0, cut_num);
					}
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
				f && b > c.length && ! b && !c.length && clearInterval(m);
				for (var e = h().top, n = l(), d = c.length - 1; d >= 0; d--) if (c[d]) if (c[d].top > 800 || c[d].top + c[d].size + 1 > e + n) {
					c[d].remove();
					c[d] = null;
					c.splice(d, 1)
					b--;
				} else {
					c[d].move();
					c[d].draw()
				}
			},
			40);
			k(window, "scroll",
			function() {
				for (var e = c.length - 1; e >= 0; e--) c[e].draw()
			})
		} else g(function() {
			createSnow(a, b)
		})
	};
	window.removeSnow = function() {
		f = false
	};
	i.prototype = {
		createEl: function(a, b) {
			this.el = document.createElement("div");
			this.el.className = "page-get";
			this.parent.appendChild(this.el)
			this.el.innerHTML =b.name+"<br /><span>赠送鲜花</span><img src='"+b.head_img+"'><div class='flowers'></div>"

		},
		move: function() {
			if (this.angle < this.minAngle || this.angle > this.maxAngle) this.angleDelta = -this.angleDelta;
			this.angle += this.angleDelta;
			this.left += this.speed * Math.cos(this.angle * Math.PI);
			this.top -= this.speed * Math.sin(this.angle * Math.PI);
			if (this.left < 0) this.left = this.maxLeft;
			else if (this.left > this.maxLeft) this.left = 0
		},
		draw: function() {
			this.el.style.top = Math.round(this.top) + "px";
			this.el.style.left = Math.round(this.left) + "px"
		},
		remove: function() {
			this.parent.removeChild(this.el);
			this.parent = this.el = null
		}
	}
})();