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
	}]
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
	$("#home_page a").text(" ");
	$(".main .first_step ul li span.college").bind("click",function(){
	$("form input#college_select").val($(this).next().text());
	setMajor($(this).next().text());
	$(".selected_logo span").addClass(this.className);	
	$(".main .first_step").hide();$(".main .selected_logo").show();$(".main .second_step").show();
});
$(".main .second_step .step_back").bind("click",function(){
	$("form input#college_select").val(" ");
	$(".main .selected_logo").hide();$(".main .second_step").hide();$(".main .first_step").show();
});
$(".main .third_step .step_back").bind("click",function(){
	$("form input#major_select").val(" ");
	$("form input#grade_select").val(" ");
	$(".main .third_step").hide();$("form #submit").hide();$(".main .second_step").show();
});
$(".main .third_step ul li").bind("click",function(){
	$("form input#grade_select").val($(this).text())  ;
	$("form").submit();
})
})
