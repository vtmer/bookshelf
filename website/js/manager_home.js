function setCookie(c_name,value,expiredays)
{
var exdate=new Date()
exdate.setDate(exdate.getDate()+expiredays)
document.cookie=c_name+ "=" +escape(value)+
((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return unescape(document.cookie.substring(c_start,c_end))
    } 
  }
return "";
}
//绑定左侧导航栏事件
$(".nav.nav-list>li[class!='nav-header']").click(function(){
	 console.log($(this).index())
	 setCookie('clicked_tab',$(this).index(),7);
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
$(document).ready(function(){
	var index = getCookie('clicked_tab');
	if(index!=''){
		$(".nav.nav-list>li[class!='nav-header']").removeClass();
		$(".nav.nav-list>li").eq(index).addClass('active');
		ajax_base(index);
	}
	else{
		$(".nav.nav-list>li[class!='nav-header']").removeClass();
		$(".nav.nav-list>li").eq(1).addClass('active');
		ajax_base(1);
	}

});
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