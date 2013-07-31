$(document).ready(function(){
    $(".ajaxForm").bind('submit', function(){//回调函数

		$(".mainlist").html("<div style='text-align:center'><span id='popContent'>正在提交，请稍后。</span></div>");
        $("#pop_title").html('提交反馈');
      	var h = $(document).height();
		$('#screen').css({ 'height': h });	
		$('#screen').show();
		$('.popbox').center();
		$('.popbox').fadeIn();

        ajaxSubmit(this, function(data){  
        			if(data==true)
        			{
        				$(".mainlist").html("<div style='text-align:center'><span id='popContent'>提交成功，感谢您的支持！</span></div>");
        				setTimeout("$('.popbox').fadeOut(function(){$('#screen').hide();}); ",1000);
        				setTimeout("window.location='http://"+document.domain+"'",1500);
        			}
        			else
        			{
        				$(".mainlist").html("<div style='text-align:center'><span id='popContent'>提交失败，请重试！</span></div>");
        				setTimeout("$('.popbox').fadeOut(function(){$('#screen').hide();}); ",1000);
        			} 
             });
        return false;
    });
    //关闭按钮
    $('.close-btn,.ok-btn ').click(function(){
		$('.popbox').fadeOut(function(){ $('#screen').hide(); 
		// window.top.location.reload();
	});
		return false;
	});
});