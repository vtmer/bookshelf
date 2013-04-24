<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>引导页</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/index.css'); ?>" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>"></script>
<script language="javascript" src="<?php echo base_url('js/guide.js'); ?>"></script>
</head>
<body>

<div id="home_page">
	<a href="index.html" title="前往首页"></a>
</div>
<div class="main">
	<div class="first_step">
		<h3>请选择你所在的学院:</h3>
		<ul>
			<li><span class="college logo_01"></span><p><?php echo $one;?></p></li>
			<li><span class="college logo_02"></span><p><?php echo $two;?></p></li>
			<li><span class="college logo_03"></span><p><?php echo $three;?></p></li>
			<li><span class="college logo_04"></span><p><?php echo $four;?></p></li>
			<li><span class="college logo_05"></span><p><?php echo $five;?></p></li>
			<li><span class="college logo_06"></span><p><?php echo $six;?></p></li>
			<li><span class="college logo_07"></span><p><?php echo $seven;?></p></li>
			<li><span class="college logo_08"></span><p><?php echo $eight;?></p></li>
			<li><span class="college logo_09"></span><p><?php echo $nine;?></p></li>
			<li><span class="college logo_10"></span><p><?php echo $ten;?></p></li>
		</ul>
	</div>
	<div class="selected_logo"><span></span>
	<form>
		<label>
		<input type="text" id="college_select" />
		</label>
		<label>
		<input type="text" id="major_select" />
		</label>
		<label>
		<input type="text" id="grade_select" />
		</label>
		<a href="home.html" id="submit" value="确定">确定</a>
	</form>
	</div>

	<div class="second_step">
		<span class="step_back"></span>
		<h3>请选择您所在的专业:</h3>

		<ul id="mach_elec">
			<li>工业工程</li>
			<li>车辆工程</li>
			<li>包装工程</li>
			<li>数字媒体技术</li>
			<li>机械自动化制造及其自动化（机械电子工程方向）</li>
			<li>机械自动化制造及其自动化（微电子制造装备及其自动化方向）</li>	
			<div class="bottom_shadow"></div>		
		</ul>

		<ul id="auto">
			<li>自动化</li>
			<li>电气工程及其自动化（电气与电子技术方向）</li>			
			<li>电气工程及其自动化（电力系统自动化方向）</li>			
			<li>电子信息科学与技术</li>			
			<li>物联网工程</li>
			<div class="bottom_shadow"></div>							
		</ul>

		<ul id="light_chemical">
			<li>化学工程与工艺</li>
			<li>食品科学与工程</li>			
			<li>生物工程</li>			
			<li>应用化学</li>			
			<li>制药工程</li>			
			<div class="bottom_shadow"></div>
		</ul>

		<ul id="info_engine">
			<li>通信工程</li>
			<li>信息工程（电子信息工程方向）</li>			
			<li>信息工程学院（应用电子技术方向）</li>			
			<li>测控技术与仪器（计算机测控技术方向）</li>			
			<li>测控技术与仪器（光机电一体化方向）</li>			
			<div class="bottom_shadow"></div>
		</ul>

		<ul id="build_transport">
			<li>土木工程</li>
			<li>土木工程（道路与桥梁工程方向）</li>			
			<li>工程管理</li>			
			<li>给水排水工程</li>			
			<li>建筑环境与设备工程</li>			
			<li>交通运输</li>			
			<li>测绘工程</li>
			<div class="bottom_shadow"></div>
		</ul>

		<ul id="computer">
			<li>计算机科学与技术</li>
			<li>软件工程</li>			
			<li>网络工程</li>			
			<div class="bottom_shadow"></div>
		</ul>
					
		<ul id="material_energy">
			<li>材料成型及控制工程（成型加工及模具CAD/CAM方向）</li>
			<li>材料成型及控制工程（材料加工控制及信息化方向）</li>			
			<li>金属材料工程</li>			
			<li>高分子材料与工程</li>			
			<li>热能与动力工程（制冷与空调方向）</li>			
			<li>热能与动力工程（热电工程方向）</li>	
			<li>电子科学与技术</li>
			<li>微电子学</li>	
		</ul>

		<ul id="envir_science">	
			<li>环境工程</li>
			<li>环境科学</li>
			<li>生物工程（环境生物技术方向）</li>
			<li>安全工程</li>
			<div class="bottom_shadow"></div>
		</ul>

		<ul id="foreign_lang">	
			<li>英语（翻译方向）</li>
			<li>英语（科技方向）</li>
			<li>商务英语</li>
			<li>日语</li>
			<div class="bottom_shadow"></div>
		</ul>

		<ul id="physics_elec">	
			<li>电子科学与技术（光电子技术、微电子技术方向）</li>
			<li>光信息科学与技术</li>
			<div class="bottom_shadow"></div>
		</ul>

	</div>

	<div class="third_step">
		<span class="step_back"></span>
		<h3>请选择您所在的年级：</h3>
		<ul>
			<li>大一</li>
			<li>大二</li>
			<li>大三</li>
			<li>大四</li>
			<div class="bottom_shadow"></div>
		</ul>
		
	</div>
	<div class="shelf_bg"><span></span></div>

	<script>
	
	$(".main .first_step ul li span.college").bind("click",function(){
	$("form input#college_select")[0].value = $(this).next().text();
	$(".selected_logo span").addClass(this.className);	
	$(".main .first_step").hide();
	$(".main .selected_logo").show();
	if($("form input#college_select")[0].value == "机电工程学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}
		
	if($("form input#college_select")[0].value == "自动化学院")
	{$(".main .second_step #mach_elec").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "轻工化工学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "信息工程学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "土木与交通学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "计算机学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "材料与能源学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "环境科学与工程学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "外国语学院")
	{$(".main .second_step #auto").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step #physics_elec").hide();
	$(".main .second_step").show();}

	if($("form input#college_select")[0].value == "物理与光电工程学院")
	{$(".main .second_step #mach_elec").hide();
	$(".main .second_step #light_chemical").hide();
	$(".main .second_step #info_engine").hide();
	$(".main .second_step #build_transport").hide();
	$(".main .second_step #computer").hide();
	$(".main .second_step #material_energy").hide();
	$(".main .second_step #envir_science").hide();
	$(".main .second_step #foreign_lang").hide();
	$(".main .second_step #auto").hide();
	$(".main .second_step").show();}
	

});
	$(".main .second_step .step_back").bind("click",function(){
	$("form input#college_select")[0].value = "";
	$(".main .selected_logo").hide();
	$(".main .second_step ").hide();
	$(".main .first_step").show();
});
	$(".main .third_step .step_back").bind("click",function(){
	$("form input#major_select")[0].value = "";
	$("form input#grade_select")[0].value = "";
	$(".main .third_step").hide();
	$("form a#submit").hide();
	$(".main .second_step #mach_elec").hide();
	$(".main .second_step").show();
});
	$(".main .second_step ul li").bind("click",function(){
	$("form input#major_select")[0].value = this.innerText;
	$(".main .second_step").hide();
	$(".main .third_step").show();
	});
	$(".main .third_step ul li").bind("click",function(){
	$("form input#grade_select")[0].value = this.innerText;
	$("form a#submit").show();
});
	</script>

</div><!--end of main-->
</body>
</html>
