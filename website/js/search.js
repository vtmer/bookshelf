$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
$(document).ready(function(){
$('html,body').animate({scrollTop:500},1000);
$(".ajax_page").bind('click', function(){
var url = $(this).attr("href").replace(/search/,"search/ajaxPage");
        $.get(url,{t:Math.random()},function(data){
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
	var link = document.URL.substr(0,document.URL.indexOf('search'));
	var	data = dat['books'];
	for(var i=0;i<data.length;i++)
	{
		$("tr:eq("+(i+1)+") td:nth-child(1)").html("<a href='"+link+"home/book_info/"+data[i].id+"'>"+data[i].name+"</a>");
		$("tr:eq("+(i+1)+") td:nth-child(2)").html(data[i].course_name);
		$("tr:eq("+(i+1)+") td:nth-child(3)").html(data[i].author);
		$("tr:eq("+(i+1)+") td:nth-child(4)").html(data[i].course_category);
		$("tr:eq("+(i+1)+") td:nth-child(5)").html(data[i].publish);
		$("tr:eq("+(i+1)+") td:nth-child(6)").html(data[i].version);
	}
	//替换分页
	var	page = dat['page'];
	$(".pages").replaceWith(page);
	//重新绑定事件
	$(".ajax_page").bind('click', function(){
	var url = $(this).attr("href").replace(/search/,"search/ajaxPage");
	        $.get(url,{t:Math.random()},function(data){
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
});