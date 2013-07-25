$(document).ready(function(){
	$(".ajax_page").bind('click', function(){
	var url = $(this).attr("href");
        $.get(url,{},function(data){
        	 if (typeof data !== 'object') {
	        	    jsonobj = JSON.parse(data);
                        } else {
                            jsonobj = data;
                        }
        	update(jsonobj);
        });
window.event.returnValue = false;
});
function update(dat)
{
	var	data = dat['log'];
	var length = data.length;
	$(".my_history table tr:gt(0)").empty();
	for(var i=0;i<length;i++)//更新表格
	{
		$(".my_history tr:eq("+(i+1)+")").append("<td>"+data[i].name+"</td>");
		$(".my_history tr:eq("+(i+1)+")").append("<td>"+data[i].truename.substr(0,1)+"同学</td>");
		$(".my_history tr:eq("+(i+1)+")").append("<td>"+data[i].time+"</td>");
	}
	//替换分页
	var	page = dat['page'];
	$(".pages").replaceWith(page);
	//重新绑定事件
	$(".ajax_page").bind('click', function(){
	var url = $(this).attr("href");
	        $.get(url,{},function(data){
	        	 if (typeof data !== 'object') {
	        	    jsonobj = JSON.parse(data);
                        } else {
                            jsonobj = data;
                        }
	        	update(jsonobj);
	        });
	window.event.returnValue = false;
	});
}
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