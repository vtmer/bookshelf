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
			 $(".span9 .row-fluid[id!='div"+id+"']").hide('fast',function(){$("#div0").show();});
			},
		success: function(data){
				     //alert( "Data Saved: " + data );
				     update(data, id);
				   },
		error:function(XMLHttpRequest, textStatus, errorThrown) {
				    // 通常 textStatus 和 errorThrown 之中
				    // 只有一个会包含信息
				    this; // 调用本次AJAX请求时传递的options参数
				}
	});
}
function update(data, id)
{
	$("#div0").hide('fast',function(){	$("#div"+id).replaceWith(data);$("#div"+id).show('slow');});
	console.log(data);

}