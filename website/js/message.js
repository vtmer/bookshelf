$(".main .message .message_box h5").bind("click",function(){
	$(this).next().is(':visible')?$(this).removeClass("click_h5").next().hide() : $(this).addClass("click_h5").next().show();
})
$(".main .message .message_box span.hide").bind("click",function(){
	$(this).parent().slideUp();
	$(this).parent().prev().removeClass("click_h5");
})
$(".main .message .message_box input.confirm").bind("click",function(){
	$(this).parent().slideUp();
	$(this).parent().prev().removeClass("click_h5");
	getChild = $(this).parent().prev().children(".readed").html("已读");
})
