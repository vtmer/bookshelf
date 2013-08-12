//绑定左侧导航栏事件
$(".nav.nav-list>li[class!='nav-header']").click(function(){
	 console.log($(this).index())
	$(".nav.nav-list>li[class!='nav-header']").removeClass();
	$(this).addClass('active');
	ajax_base($(this).index())
	return false;
});
//绑定所有下拉框
$('.dropdown-toggle').dropdown().next().children().click(function(){
	$(this).parent().prev().html($(this).text()+"<b class='caret'></b>");
});
$("#ok").click(function(){
	alert($("#faculty").text()+$("#major").text()+$("#grade").text());
	return false;
});
//抓取豆瓣信息
function do_jsonp(isbn,title,author,publish) 
{
	var id = document.getElementById(isbn).value;
	$.getJSON("https://api.douban.com/v2/book/isbn/"+id+"?callback=?",
	function(data) {
			$('#'+title).val(data.title);
			$('#'+author).val(data.author);
			$('#'+publish).val(data.publisher);
	});
}
$(document).ready(ajax_base(1));
function ajax_base(id)
{
	$.ajax({
		type:"GET",
		url:'./home/ajax_base',
		data: "id="+id,
		dataType: "html",
		beforeSend:function (XMLHttpRequest) {   	
			 $(".span9 .row-fluid[id!='div"+id+"']").hide();
			 $("#div0").show();
		},
		success: function(data){
			$("#div"+id).replaceWith(data);
		},
	   complete: function(XMLHttpRequest, textStatus){
	   	 $("#div0").slideUp('fast');
	   	 $("#div"+id).fadeIn();
		},
		error:function(XMLHttpRequest, textStatus, errorThrown) {
		    if(XMLHttpRequest.status=='404')
		    	alert('请求失败！请重试！');
		}
	});
}