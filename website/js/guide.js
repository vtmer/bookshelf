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