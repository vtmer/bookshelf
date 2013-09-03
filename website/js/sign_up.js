var gg_college = {
	"all_college" :[
	{
		"college" : "机电工程学院",
		"major" : ["工业工程","车辆工程","包装工程","数字媒体技术","机械自动化制造及其自动化（机械电子工程方向）","机械自动化制造及其自动化（微电子制造装备及其自动化方向）"]
	},
	{
		"college" : "自动化学院",
		"major" : ["自动化","电气工程及其自动化（电气与电子技术方向）","电气工程及其自动化（电力系统自动化方向）","电子信息科学与技术","物联网工程"]
	},
	{
		"college" : "轻工化工学院",
		"major" : ["化学工程与工艺","食品科学与工程","生物工程","应用化学","制药工程"]
	},
	{
		"college" : "信息工程学院",
		"major" : ["通信工程","信息工程（电子信息工程方向）","信息工程学院（应用电子技术方向）","测控技术与仪器（计算机测控技术方向）","测控技术与仪器（光机电一体化方向）"]
	},
	{
		"college" : "土木与交通学院",
		"major" : ["土木工程","土木工程（道路与桥梁工程方向）","工程管理","给水排水工程","建筑环境与设备工程","交通运输","测绘工程"]
	},
	{
		"college" : "计算机学院",
		"major" : ["计算机科学与技术","软件工程","网络工程"]
	},
	{
		"college" : "材料与能源学院",
		"major" : ["材料成型及控制工程（成型加工及模具CAD","材料成型及控制工程（材料加工控制及信息化方向）","金属材料工程","高分子材料与工程","热能与动力工程（制冷与空调方向）","热能与动力工程（热电工程方向）","电子科学与技术","微电子学"]
	},
	{
		"college" : "环境科学与工程学院",
		"major" : ["环境工程","环境科学","生物工程（环境生物技术方向）","安全工程"]
	},
	{
		"college" : "外国语学院",
		"major" : ["英语（翻译方向）","英语（科技方向）","商务英语","日语"]
	},
	{
		"college" : "物理与光电工程学院",
		"major" : ["电子科学与技术（光电子技术、微电子技术方向）","光信息科学与技术"]
	},
	//以下是龙洞校区的学院信息
	{
		"college" : "管理学院",
		"major" : ["工商管理","市场营销","人力管理资源","物流管理","管理科学","信息管理与信息系统","电子商务","会计学","财务管理","土地资源管理","旅游管理"]
	},
	{
		"college" : "经济与贸易学院",
		"major" : ["经济学","投资学","国际经济与贸易","会展经济与管理"]
	},
	{
		"college" : "应用数学学院",
		"major" : ["信息与计算科学（信息计算方向）","信息与计算科学（信息安全方向）","统计学"]
	},
	//以下是东风路校区的学院信息
	{
		"college" : "建筑学院",
		"major" : ["建筑学","城乡规划","风景园林"]
	},
	{
		"college" : "艺术设计学院",
		"major" : ["工业设计","产品设计","服装设计与工程","服装与服饰设计","服装与服饰设计（形象设计与服装表演方向）","视觉传达设计","环境设计","动画","数字媒体与动画","美术学"]
	},
	{
		"college" : "政法学院",
		"major" : ["法学","社会工作","公共事业管理"]
	}
	]
};
var check_func = {
	email : function(value){
		var $notice = $("input#mail + span");
		if(!value){
			$notice.addClass("notice alert").text("请填写您的邮箱");
			return false;
		}
		var mailReg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+(\.[a-zA-Z]{2,3})+$/;
		if(!mailReg.test(value)){
			$notice.addClass("notice alert").text("邮箱格式错误");
			return false;
		}
		else if(mailReg.test(value)){
				$.get(document.URL+"/ajax_check",{mail:$("#mail").attr("value"),t:Math.random()},function(data){
					if(data==1) 
						{
							$notice.removeClass("notice alert").text(" ");
						} 
						else
						{
							$notice.addClass("notice alert").text("邮箱已注册，请重试！");
						}
				});
				if($notice.text()==" ") 
				{
					return true;
				}
				else
				{
					return false;
				} 
			}
	},
	password : function(value1,value2){
		var $notice1 = $("input#password + span"),$notice2 = $("input#password_confirm + span");
		if(!value1){
			$notice1.addClass("notice alert").text("密码不能为空");
			return false;
		}
		else if(value1.length < 6){
			$notice1.addClass("notice alert").text("密码长度不能小于6");
			return false;
		}
		else{
			$notice1.removeClass("notice alert").text(" ");
			if(arguments[1] && value1 != value2){
				$notice2.addClass("notice alert").text("两次密码输入不同");
				return false;
			}
			else {
			$notice2.removeClass("notice alert").text(" ");
			return true;
			}
		}
	},
	name : function(value){
		var $notice = $("input#name + span");
		if(!value){
			$notice.addClass("notice alert").text("请填写您的姓名");
			return false;
		}
		else {
			$notice.removeClass("notice alert").text(" ");
			return true;
		}
	},
	stu_id : function(value){
		var $notice = $("input#stu_id + span");
		var stuReg = /^([1-9]{1})+\d{9}$/;
		if(!value){
			$notice.addClass("notice alert").text("请填写您的学号");
			return false;
		}
		else if(!stuReg.test(value)){
			$notice.addClass("notice alert").text("学号填写错误");
			return false;
		}
		else {
			$notice.removeClass("notice alert").text(" ");
			return true;
		}
	},
	phone : function(value){
		var $notice = $("input#phone + span");
		if(!value){
			$notice.addClass("notice alert").text("请填写您的手机号码");
			return false;
		}
		var phoneReg = /^((1[358]{1}[0-9]{1}))+\d{8}$/;
		if(!phoneReg.test(value)){
			$notice.addClass("notice alert").text("手机号码格式错误");
			return false;
		}
		else $notice.removeClass("notice alert").text(" ");
		return true;
	},
	mini_phone : function(value){
		var $notice = $("input#mini_phone + span");
		if(!value){
			$notice.removeClass("alert").text("若无短号，可不填写");
			return true;
		}
		var mini_phoneReg = /^\d{4,8}$/;
		if(!mini_phoneReg.test(value)){
			$notice.addClass("notice alert").text("手机短号格式错误");
			return false;
		}
		else $notice.removeClass("notice alert").text(" ");
		return true;
	},
	captcha : function(value)
	{
		var $notice = $("input#captcha + span");
		if(!value){
			$notice.addClass("notice alert").text("请输入验证码！");
			return false;
		}
		else
		{	
			$.get(document.URL+"/ajax_check",{captcha:$("#captcha").attr("value"),t:Math.random()},function(data){	
				if(data==0)
				{ 	
					$notice.addClass("notice alert").text("验证码错误，请重试！");
				}
				else
				{
					$notice.removeClass("notice alert").text(" ");
				}
				});
			if($notice.text()==" ") 
				{
					return true;
				}
				else
				{
					return false;
				} 
		}
	}
}
$(function(){
	var change_select = {
		college : function(begin,end){
			for(var i=begin; i<=end; i++){
			var option = document.createElement("option");
			option.innerText = gg_college.all_college[i].college;
			option.setAttribute("data-base",i);
			$("#college").append(option);
			}
		},
		major : function(Mno){
			$("#major").children().remove();
			for(var i=0; i < gg_college.all_college[Mno].major.length; i++){
			var option = document.createElement("option");
			option.innerText = gg_college.all_college[Mno].major[i];
			$("#major").append(option);
			}
		}
	}
	var qu_select = $(".select_button").children().clone();
	change_select.college(0,9);
	(function(){
		var set_time = new Date;
		var year = (set_time.getMonth() > 8) ? set_time.getFullYear() : set_time.getFullYear()-1;
		for(var i=0; i < 4; i++){
			var option = document.createElement("option");
			option.innerText = year-i;
			$("#grade").append(option);
		}
	})();
	// 增加年级选择框
	$("#campus").bind("change",function(){
		$("#college").children().remove();
		$("#major").children().remove();
		$("#college").append("<option data-base='-1'>请选择学院</option>");
		var campus_data = $(this).find("option:selected").attr("data-base").split(",");
		change_select.college(campus_data[0],campus_data[1]);
		var qu_input = "<input type='text' name='quarters' class='quarters' disabled='disabled' />"
		switch(campus_data[0]){
			case "10" : 
				$(".select_button").children().remove();
				$(".select_button").append(qu_input).find("input").val("龙洞");
				break;
			case "13" :
				$(".select_button").children().remove();
				$(".select_button").append(qu_input).find("input").val("东风路");
				break;
			case "0" : 
				$(".select_button").children().remove();
				$(".select_button").append(qu_select);
		}
	})
	// 校区选择动作
	$("#college").change(function(){
		$("#college option[data-base=-1]").remove();
		var getMajor = $(this).find("option:selected").attr("data-base");
		change_select.major(getMajor);
	})
	// 学院选择动作
	
	// 以上是选择框的联动动作
	var checkCookie = function(){
		var getCookie = document.cookie;
		var c_star,c_end;
		if(getCookie.length >0){
			c_start = getCookie.indexOf("getSelect=");
			if(c_start != -1){
				c_start +=  10;
				c_end = getCookie.indexOf(";",c_start);
				if(c_end == -1) c_end = getCookie.length;
			}	
		}
		var getStr = unescape(getCookie.substring(c_start,c_end));	
		getStr = getStr.split(";");
		if(getStr.length == 4){
			switch(getStr[0]){
				case "daxuecheng" : getStr[0] = "大学城";
					break;
				case "longdong" : getStr[0] = "龙洞";
					break;
				case "dongfenglu" : getStr[0] = "东风路";
					break;
				break;
		 	};
		 	switch(getStr[3]){
		 		case "大一" : getStr[3] = 0;
		 			break;
		 		case "大二" : getStr[3] = 1;
		 			break;
		 		case "大三" : getStr[3] = 2;
		 			break;
		 		case "大四" : getStr[3] = 3;
		 			break;
		 		break;
		 	};
		 	var getCampus = $("#campus option");
		 	for(var i=0; i<$("#campus option").length; i++){
		 		if($("#campus option")[i].innerText == getStr[0]){
		 			$("#campus option")[i].selected = true;
		 			var campus_data = $("#campus option:eq("+ i + ")").attr("data-base").split(",");
		 			$("#college").children().remove();
					$("#major").children().remove();
		 			change_select.college(campus_data[0],campus_data[1]);
		 			break;
		 		}
		 	}
		 	 getCollege =$("#college option");
		 	for(var i=0; i<getCollege.length; i++){
		 		if(getCollege[i].innerText == getStr[1]){
		 			getCollege[i].selected = true;
		 			var college_data = $("#college option:eq("+ i + ")").attr("data-base");
					change_select.major(college_data); break;
		 		}
		 	}
		 	getMajor = $("#major option"); 
		 	for(var i=0; i<getMajor.length; i++){
		 		if(getMajor[i].innerText == getStr[2]){
		 			getMajor[i].selected = true; break;
		 		}
		 	}
		 	$("#grade option:eq(" + getStr[3] + ")")[0].selected = true;
		}
	}()
	//以上是获取cookie填写专业
	$("input#mail").bind("blur", function(){
		check_func.email(this.value);
		});
	// $("input#password").bind("blur",function(){
	// 	check_func.password(this.value);
	// });
	// $("input#password_confirm").bind("blur",function(){
	// 	check_func.password($("input#password")[0].value, this.value);
	// });
	// $("input#name").bind("blur", function(){
	// 	check_func.name(this.value);
	// });
	// $("input#stu_id").bind("blur", function(){
	// 	check_func.stu_id(this.value);
	//})
	$("input#phone").bind("blur", function(){
		check_func.phone(this.value);
	});
	$("input#mini_phone").bind("blur",function(){
		check_func.mini_phone(this.value);
	});

	$("input#captcha").bind("blur", function(){
		check_func.captcha(this.value);
	});
	
	$("input[type=submit]").bind("click", function(){
		var check_control = true;
		check_control = check_func.email($("input#mail")[0].value);
		// check_control = check_func.password($("input#password")[0].value, $("input#password_confirm")[0].value);
		check_control = check_func.phone($("input#phone")[0].value);
		// check_control = check_func.name($("input#name")[0].value);
		// check_control = check_func.stu_id($("input#stu_id")[0].value);
		check_control = check_func.captcha($("input#captcha")[0].value);
		if(!check_control) return false;
		//等待提交
		var url = "/img/loading.gif";
		$(".mainlist").html("<img src="+url+" alt='loading...'/>");
		$(".mainlist").css('text-align','center');
        $("#pop_title").html("正在提交");
      	var h = $(document).height();
		$('#screen').css({ 'height': h });	
		$('#screen').show();
		$('.popbox').center();
		$('.popbox').fadeIn();            
	});	
});
function reloadCode()
{
	$("#checkCodeImg").attr("src","../captcha?t="+Math.random());
}
