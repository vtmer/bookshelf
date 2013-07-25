$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
$(document).ready(function(){
$('html,body').animate({scrollTop:500},1000);
$(".ajax_page").bind('click', function(){
var url = $(this).attr("href").replace(/search/,"search/ajaxPage");
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
	var link = document.URL.substr(0,document.URL.indexOf('search'));
	var	data = dat['books'];
	//删除所有tr，除了第一行
	$("table tr:gt(0)").empty();
	for(var i=0;i<data.length;i++)
	{
		$("tr:eq("+(i+1)+")").append("<td><a href='"+link+"home/book_info/"+data[i].id+"'>"+data[i].name+"</a></td>");
		$("tr:eq("+(i+1)+")").append("<td>"+data[i].course_name+"</td>");
		$("tr:eq("+(i+1)+")").append("<td>"+data[i].author+"</td>");
		$("tr:eq("+(i+1)+")").append("<td>"+data[i].course_category+"</td>");
		$("tr:eq("+(i+1)+")").append("<td>"+data[i].publish+"</td>");
		$("tr:eq("+(i+1)+")").append("<td>"+data[i].version+"</td>");
	}
	//替换分页
	var	page = dat['page'];
	$(".pages").replaceWith(page);
	//重新绑定事件
	$(".ajax_page").bind('click', function(){
	var url = $(this).attr("href").replace(/search/,"search/ajaxPage");
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
});