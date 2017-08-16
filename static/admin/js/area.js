var J_province = $(".province");
var J_city = $(".city");
var J_district = $(".district");

//获取数据
var get_area = function(parent_id, container, select){
  	var pid = arguments[0] ? arguments[0] : 0;
  	var selected = arguments[2] ? arguments[2] : 0;
  	
    var url = "/area/get_area";
    $.getJSON(url,{parent_id:pid},function(data){
    	 var html = '';
    	  
    	 $.each(data,function(i,item){
    		 if(item.id == select)
    		 {
    			 html+='<option selected=selected value="'+item.id+'">'+item.name+'</option>'; 
    		 }
    		 else
    		 {
    			 html+='<option value="'+item.id+'">'+item.name+'</option>';
    		 }
            
         });
    	 container.append(html);
    });
    
    container.children('option[value="'+select+'"]').attr('selected','true').siblings().removeAttr('selected')
}

//初始化省、直辖市
var province = function(select){
	get_area(0, J_province, select);
};

//赋值市、区、县
var city = function(province_id, select){
	J_city.html('<option value="0">-- 请选择市、县  --</option>');
	var province_id = arguments[0] ? arguments[0] : J_province.children("option:selected").val();
 
	if(province_id == 0)
	{
		return false;
	}
	get_area(province_id, J_city, select);
    district();
};

//赋值县、乡、镇
var district = function(city_id, select){
	J_district.html('<option value="0">-- 请选择区、乡、镇  --</option>');
	var city_id = J_city.children("option:selected").val();
	var city_id = arguments[0] ? arguments[0] : J_city.children("option:selected").val();
	
	if(city_id == 0)
	{
		return false;
	}
	get_area(city_id, J_district, select);
};

//选择省改变市
J_province.change(function(){
    city();
});

//选择市改变县
J_city.change(function(){
    district();
});