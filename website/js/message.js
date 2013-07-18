

$(".main .message .message_box .msg_title").bind("click",function(){
	$(".main .message .message_box .message_content").slideUp();
	$(".main .message .message_box h5").removeClass("click_h5");
	$(this).parent("h5").next().is(':visible')?$(this).parent("h5").removeClass("click_h5").next().slideUp() : $(this).parent("h5").addClass("click_h5").next().slideDown();
})
$(".main .message .message_box span.hide").bind("click",function(){
	$(this).parent().slideUp();
	$(this).parent().prev().removeClass("click_h5");
	$("html,body").animate({scrollTop:$(".mid_content").offset().top},600);
})
$(".main .message .message_box input.confirm").bind("click",function(){
	$(this).parent().slideUp();
	$(this).parent().prev().removeClass("click_h5");
	getChild = $(this).parent().prev().children(".readed").html("已读");
	$("html,body").animate({scrollTop:$(".mid_content").offset().top},600);
})
