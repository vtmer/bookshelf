

$(".main .message .message_box .msg_title").bind("click",function(){
	$(".main .message .message_box .message_content").slideUp();
	$(".main .message .message_box h5").removeClass("click_h5");
	$(this).parent("h5").next().is(':visible')?$(this).parent("h5").removeClass("click_h5").next().slideUp() : $(this).parent("h5").addClass("click_h5").next().slideDown();
	var url = $(this).nextAll("a").attr("href");
    var url = url.replace("del_msg","msg_readed");
    var $flag = $(this);
    if($flag.prev(".readed").html()=="未读")
    {
		$.get(url,function(data){
				if(data=='true')
				{
					$flag.prev(".readed").html("已读");
					$flag.prev(".readed").parent().removeClass("unread");
				}
			});
	}
})

$(".main .message .message_box span.hide").bind("click",function(){
	$(this).parent().parent().slideUp();
	$(this).parent().parent().prev().removeClass("click_h5");
	// $("html,body").animate({scrollTop:$(".mid_content").offset().top},500);
})

$(".main .message .message_box input.confirm").bind("click",function(){
	$(this).parent().slideUp();
	$(this).parent().prev().removeClass("click_h5");
	getChild = $(this).parent().prev().children(".readed").html("已读");
	$("html,body").animate({scrollTop:$(".mid_content").offset().top},600);
})

$(".del_message").click(function(){
	var url = $(this).attr('href');
	var $a = $(this);
	var flag = window.confirm("你真的要删除这条信息吗？");
	if(flag) 
	{
		$.get(url,function(data){
			if(data=='true')
			{
				$a.parent().parent("div").fadeOut("fast");
			}
		});
	}
	window.event.returnValue = false;
});
