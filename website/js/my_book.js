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
window.event.returnValue = false;//支持IE
});

function update(dat)
{
	var	data = dat['log'];
	var length = data.length;
	for(var i=0;i<length;i++)//更新表格
	{
		$(".my_history tr:eq("+(i+1)+") td:nth-child(1)").html(data[i].name);
		$(".my_history tr:eq("+(i+1)+") td:nth-child(2)").html(data[i].truename);
		$(".my_history tr:eq("+(i+1)+") td:nth-child(3)").html(data[i].time);
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
	window.event.returnValue = false;//支持IE
	});
}


//history收缩
$(".my_book .s_h").parent("h5").bind("click",function(){
	$(this).next("div").slideToggle("slow");
})