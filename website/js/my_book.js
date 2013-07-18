$(document).ready(function(){
    $(".pull_off").click(function(){//回调函数
    	var url = $(this).attr('href');
    	var	$a = $(this);
        $.get(url, function(data){   	
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
					if(jsonobj.status==true)
					{
						$a.parent().parent().hide();
					}
				}
             });
        	window.event.returnValue = false;
    });
    //关闭按钮
    $('.close-btn,.ok-btn ').click(function(){
		$('.popbox').fadeOut(function(){ $('#screen').hide(); 
	});
		return false;
	});
});
//history收缩
$(".my_book .s_h").parent("h5").bind("click",function(){
	$(this).next("div").slideToggle("slow");
})