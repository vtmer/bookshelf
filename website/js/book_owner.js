$(".ajax_page").live('click', function(){
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
		$("tr:eq("+(i+1)+") td:nth-child(1)").html("<a href='http://"+document.domain+"index.php/home/book_info/"+data[i].id+"'>"+data[i].name+"</a>");
		$("tr:eq("+(i+1)+") td:nth-child(2)").html(data[i].course_name);
		$("tr:eq("+(i+1)+") td:nth-child(3)").html(data[i].author);
		$("tr:eq("+(i+1)+") td:nth-child(4)").html(data[i].course_category);
		$("tr:eq("+(i+1)+") td:nth-child(5)").html(data[i].publish);
		$("tr:eq("+(i+1)+") td:nth-child(6)").html(data[i].version);
	}
	//替换分页
	var	page = dat['page'];
	$(".pages").replaceWith(page);
}
