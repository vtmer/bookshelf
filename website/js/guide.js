var gg_college = {
	"all_college" :[
	{
		"college" : "机电工程学院",
		"major" : ["工业工程","车辆工程","包装工程","数字媒体技术","机械设计制造及其自动化（机械电子工程方向）","机械设计制造及其自动化（微电子制造装备及	自动化方向）"]
	},
	{
		"college" : "自动化学院",
		"major" : ["自动化","电气工程及其自动化(电气与电子技术方向)","电气工程及其自动化(电力系统自动化方向)","电子信息科学与技术","物联网工程"]
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
		"major" : ["材料成型及控制工程（成型加工及模具CAD/CAM方向）","材料成型及控制工程（材料加工控制及信息化方向）","金属材料工程","高分子材料与工程","热能与动力工程（制冷与空调方向）","热能与动力工程（热电工程方向）","电子科学与技术","微电子学"]
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
		"major" : ["建筑学","城市规划","景观设计"]
	},
	{
		"college" : "艺术设计学院",
		"major" : ["工业设计","服装与服装工程","视觉传达","环境设计","数字媒体与动画","美术"]
	},
	{
		"college" : "政法学院",
		"major" : ["法学","社会工作","公共事业管理"]
	}
	]
}

function setMajor(get_college){
	$(".main .second_step ul li").remove();
	var get_major;
	for(var i = 0;i<gg_college.all_college.length;i++){
		if(get_college == gg_college.all_college[i].college)
			get_major = gg_college.all_college[i].major;
	}
	for(var j = 0;j<get_major.length;j++){
		var li = document.createElement("li");
		$(li).text( get_major[j]);
		$(".main .second_step ul").append(li);
	}
	$(".main .second_step ul li").bind("click",function(){
		$("form input#major_select").val($(this).text());
		$(".main .second_step").hide();$(".main .third_step").show();
	});
}
$(function(){
	//校区选择的动作
	$(".campus li").bind("click",function(){
		if(!$(this).hasClass("current")){
			$(".campus li").removeClass("current")
			var x = $(this).addClass("current").detach();$(".campus").prepend(x);
			$(".first_step ul").hide();
			var get_college = $(this).attr("data-no");
			$("." + get_college).show();
		}
	});

	// 下面是第一步，选择学院的动作
	$(".main .first_step ul li span.college").bind("click",function(){
		$("form input#college_select").val($(this).next().text());
		$("form input#campus_select").val($(".campus .current").attr("data-no"));
		setMajor($(this).next().text());
		$(".selected_logo span").addClass(this.className).addClass($(".current").attr("data-no"));	
		$(".main .first_step").hide();$(".main .selected_logo").show();$(".main .second_step").show();
	});
	// 第二步动作放在setMajor内绑定。
	// 下面是返回键的动作
	$(".main .second_step .step_back").bind("click",function(){
		$("form input#college_select").val(" ");
		$(".main .selected_logo").hide();$(".main .second_step").hide();$(".main .first_step").show();
	});
	$(".main .third_step .step_back").bind("click",function(){
		$("form input#major_select").val(" ");
		$("form input#grade_select").val(" ");
		$(".main .third_step").hide();$("form #submit").hide();$(".main .second_step").show();
	});

	// 下面是第三步的动作
	$(".main .third_step ul li").bind("click",function(){
		$("form input#grade_select").val($(this).text())  ;
		$("form").submit();
	})
});
