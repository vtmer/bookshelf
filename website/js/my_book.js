$(".ajax_page").bind('click', function(){
var url = $(this).attr("href");
        $.get(url,{t:Math.random()},function(res){
        	var	jsonData =  eval('(' + res + ')');
        	update(jsonData);
        });
window.event.returnValue = false;//支持IE
});

function update(dat)
{
	var	data = dat['books'];
	for(var i=0;i<data.length;i++)
	{
		var	status=0,right=0,submit;
		(data[i].book_status==1) ? status = "预约中" : status = "闲置中";
		(data[i].book_right==1) ? right = "共同": right = "私有";
		if(data[i].book_status==0&&data[i].book_right==0)
		{			
			submit ="<form action='http://"+document.domain+"/index.php/my_book/pull_off' method='post' class='ajaxForm'><input type='hidden' name='book_id' value='"+data[i].id+"' /><input type='submit' value='下架'' /></form>	";
		}
		else
		{
			submit =" ";
		}
		$("tr:eq("+(i+1)+") td:nth-child(1)").html(data[i].name);
		$("tr:eq("+(i+1)+") td:nth-child(2)").html(status);
		$("tr:eq("+(i+1)+") td:nth-child(3)").html(right);
		$("tr:eq("+(i+1)+") td:nth-child(4)").html(submit);
	}
	//替换分页
	var	page = dat['page'];
	$(".pages").replaceWith(page);
	//重新绑定事件
	$(".ajax_page").bind('click', function(){
	var url = $(this).attr("href");
	        $.get(url,{t:Math.random()},function(res){
	        	//document.write(res);
	        	var	jsonData =  eval('(' + res + ')');
	        	update(jsonData);
	        });
	window.event.returnValue = false;//支持IE
	});
    $(".ajaxForm").bind('submit', function(){//回调函数
        ajaxSubmit(this, function(data){  
	        	 var jsonobj = eval('('+data+')');  
	        	if(jsonobj.type=='alert')
	        	{
		            $("#popContent").html(jsonobj.content);
		            $("#pop_title").html(jsonobj.title);
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();
				}			
             });
        return false;
    });
}


//history收缩
$(".my_book .s_h").parent("h5").bind("click",function(){
	$(this).next("div").slideToggle("slow");
})