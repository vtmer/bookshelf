
	var nowShowing = $(".main .step1");
	$(".main .step1 .step_box a.next_step").bind("click",function(){
		$(nowShowing).removeClass("now_step");
		$(".main .step2").addClass("now_step");
		nowShowing = $(".main .step2");
		return false;
	});
	$(".main .step2 .step_box a.prev").bind("click",function(){
		$(nowShowing).removeClass("now_step");
		$(".main .step1").addClass("now_step");
		nowShowing = $(".main .step1");
		return false;
	});
	$(".main .step2 .step_box a.next_step").bind("click",function(){
		$(nowShowing).removeClass("now_step");
		$(".main .step3").addClass("now_step");
		nowShowing = $(".main .step3");
		
		return false;
	});


/*var rule = /^[0-9]+$/;
var keywords = $('#isbncode').val();
if (rule.test(keywords)) 
{*/
var timer = null;//初始化一个定时器 
var delay = 300;//设定延迟
function startTimer(inputString)
{
    window.clearTimeout(timer);
    timer = window.setTimeout(_lookup(inputString),delay);//重新设定时器
}
function _lookup(_inputString)//返回一个无参数的函数
{
    return function(){
    lookup(_inputString);
	}
}
function lookup(inputString) { 
var url=document.URL+"/search";
if(inputString.length == 0) { 
// Hide the suggestion box. 
$('#suggestions').hide(); 
} else { 
$.post(url, {queryString: ""+inputString+""}, function(data){ 
if(data.length >0) { 
$('#suggestions').show(); 
$('#autoSuggestionsList').html(data); 
} 
}); 
} 
} // lookup
//绑定输入框的回车事件
$(document).ready(function()
{
   $("#isbncode").keyup(function(e){
   var curKey = e.which;
   if(curKey == 13)
   {
       do_jsonp();
    	$(nowShowing).removeClass("now_step");
		$(".main .step2").addClass("now_step");
		nowShowing = $(".main .step2");
   }else
   {
   	   startTimer($("#isbncode").val());
   }
   });
});  

function fill(thisValue) { 
$('#isbncode').attr("value",thisValue); 
$('#booktitle').attr("value",thisValue);
setTimeout("$('#suggestions').hide();", 200); 
}//fill 

$(".next_step").bind("click",function(){
	$('#booktitle').attr('disabled',"true");
	
})



function do_jsonp() 
	{
		var id = $('#isbncode').val();
		$.getJSON("https://api.douban.com/v2/book/isbn/"+id+"?callback=?",
			function(data) {
				$('#booktitle').attr("value",data.title);
				$('#isbn').html("ISBN:"+data.isbn13);
				$('#isbn').attr("value",data.isbn13);
				$('#author').val(data.author);
				$('#publish').val(data.publisher);
				var title = data.title;
				});
		if(id !== '')
		{$('#booktitle').attr('disabled',"true");}

	}
