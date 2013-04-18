document.getElementById('home_page').getElementsByTagName('a')[0].innerText= " ";
$(".main .first_step ul li span.college").bind("click",function(){
	$("form input#college_select")[0].value = $(this).next().text();
	$(".selected_logo span").addClass(this.className);	
	$(".main .first_step").hide();
	$(".main .selected_logo").show();
	$(".main .second_step").show();
});
$(".main .second_step .step_back").bind("click",function(){
	$("form input#college_select")[0].value = "";
	$(".main .selected_logo").hide();
	$(".main .second_step").hide();
	$(".main .first_step").show();
});
$(".main .third_step .step_back").bind("click",function(){
	$("form input#major_select")[0].value = "";
	$("form input#grade_select")[0].value = "";
	$(".main .third_step").hide();
	$("form a#submit").hide();
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
})