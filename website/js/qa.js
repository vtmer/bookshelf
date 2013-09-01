$(".qaq").bind("click",function() {
	$(".qaa").slideUp();
	$(".qaq span").html('[查看]');
	if ($(this).next().is(':visible')) {
		$(this).next().slideUp();
		$(this).children('span').html('[查看]');
	} else{
		$(this).next().slideDown();
		$(this).children('span').html('[收起]');
	};

})
$(document).ready(function() {
	$('#next').unbind("click");//取消‘下一步‘点击事件
});

function count(sec)
{
	$('#time').html(sec+" 秒");
	sec-=1;
	var id = setTimeout("count("+sec+")",1000);
	if(sec<0)
	{
		clearTimeout(id);
		$('#time').remove();
		$('#next').removeClass('unable');
		$('#next').attr("href","../guide");
	}
}
$(document).ready(count(15));
