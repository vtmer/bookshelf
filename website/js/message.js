

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

    $(".ajaxForm").bind('submit', function(){//回调函数
        ajaxSubmit(this, function(data){  
        //document.write(data);  	
                        if (typeof data !== 'object') {
	        	    jsonobj = JSON.parse(data);
                        } else {
                            jsonobj = data;
                        }
	        	if(jsonobj.type=='alert')
	        	{
		            $("#popContent").html(jsonobj.content);
		            $("#pop_title").html(jsonobj.title);
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();

				}else
				if(jsonobj.type=='redirect')
				{
					if(typeof jsonobj.content!='undefined')
					{
						$("#popContent").html(jsonobj.content);
			            $("#pop_title").html(jsonobj.title);
			          	var h = $(document).height();
						$('#screen').css({ 'height': h });	
						$('#screen').show();
						$('.popbox').center();
						$('.popbox').fadeIn();
					}
					setTimeout("window.location.href='"+jsonobj.url+"'",1000);
				}
             });
        return false;
    });
    //关闭按钮
    $('.close-btn,.ok-btn ').click(function(){
		$('.popbox').fadeOut(function(){ $('#screen').hide(); 
		 window.top.location.reload();
	});
		return false;
	});
