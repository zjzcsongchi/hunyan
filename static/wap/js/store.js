/**
 * 本地存储工具类
 * Created by Baby on 2016/8/1.
 */
define([], function(){
    return{
        setSessionStorage: function(key, value) {
            /**保存至sessionStorage*/
            var t = this;
            var o = sessionStorage;
            return void 0 === value ? t.remove(key) : (o.setItem(key, t.serialize(value)), value)
        },
        getSessionStorage: function(key, defaultValue) {
            /**从sessionStorage中取出*/
            var t = this;
            var o = sessionStorage;
            var n = t.deserialize(o.getItem(key));
            return void 0 === n ? defaultValue: n
        },
        remove: function(e) {
            /**从sessionStorage中删除*/
            sessionStorage.removeItem(e)
        },
        serialize: function(e) {
            /**JS Object格式化为json字符串*/
            return JSON.stringify(e)
        },
        deserialize: function(e) {
            /**json字符串格式化为JS Object*/
            if ("string" != typeof e) return void 0;
            try {
                return JSON.parse(e)
            } catch(t) {
                return e || void 0
            }
        },
        getPosInfo: function(n) {
            /**获取poi数据*/
            var t = this;
            var e = {};
            return n ? e = t.getSessionStorage("posInfo", {}) : sessionStorage.posInfo ? JSON.parse(sessionStorage.posInfo) : e
        },
        savePosInfo: function(n) {
            /**保存poi数据*/
            var t = this;
            if (n) {
                var e = t.getPosInfo();
                e = $.extend(e, n),
                sessionStorage.posInfo = JSON.stringify(e);
                var o = t.getPosInfo(!0);
                o = $.extend(o, n),
                t.setSessionStorage("posInfo", o)
            }
        },
        getCurrentAddressInfo: function(n) {
            /**获取当前位置数据*/
            var t = this;
            var e = {};
            return n ? e = t.getSessionStorage("currentAddressInfo", {}) : sessionStorage.currentAddressInfo ? JSON.parse(sessionStorage.currentAddressInfo) : e
        },
        saveCurrentAddressInfo: function(n) {
            /**保存当前位置数据*/
            var t = this;
            if (n) {
                var e = t.getCurrentAddressInfo();
                e = $.extend(e, n),
                sessionStorage.currentAddressInfo = JSON.stringify(e);
                var o = t.getCurrentAddressInfo(!0);
                o = $.extend(o, n),
                t.setSessionStorage("currentAddressInfo", o)
            }
        },
        getOpenCityList: function(n) {
            /**获取开通的城市列表数据*/
            return this.getSessionStorage('openCityList', '');
        },
        saveOpenCityList: function(n) {
            /**保存当开通的城市列表数据*/
            this.setSessionStorage('openCityList', n);
        },
    }
})
