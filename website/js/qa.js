$(".qaq").bind("click",function () {
	$(".qaq span").html("[查看]");
	// $(".qaq").css("font-weight","blod");
	$(".qaa").slideUp();
	// $(this).next().slideDown();
	$(this).next().is(':visible')?$(this).next().slideUp() : $(this).next().slideDown();
	// $(this).children("span").html("[收起]");
})
$(document).ready(function(){
	$('#next').unbind("click");//取消‘下一步‘点击事件
});