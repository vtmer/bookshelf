$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
$(".main .step1 .step_box input").bind("click",function(){if(this.value=="请输入书籍的ISBN码")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入书籍的ISBN码"});
var nowShowing = $(".main .step1");
$(".main .step1 .step_box a.next_step").bind("click",function(){
	$(nowShowing).removeClass("now_step");
	$(".main .step2").addClass("now_step");
	nowShowing = $(".main .step2");
	return false;
});
$(".main .step2 .step_box a.prev").bind("click",function(){
	$(nowShowing).removeClass("now_step");
	$(".main .step1").addClass("now_step");
	nowShowing = $(".main .step1");
	return false;
});
$(".main .step2 .step_box a.next_step").bind("click",function(){
	$(nowShowing).removeClass("now_step");
	$(".main .step3").addClass("now_step");
	nowShowing = $(".main .step3");
	
	return false;
});