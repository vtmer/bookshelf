
	// var nowShowing = $(".main .step1");
	// $(".main .step1 .step_box a.next_step").bind("click",function(){
	// 	$(nowShowing).removeClass("now_step");
	// 	$(".main .step2").addClass("now_step");
	// 	nowShowing = $(".main .step2");
	// 	return false;
	// });
	// $(".main .step2 .step_box a.prev").bind("click",function(){
	// 	$(nowShowing).removeClass("now_step");
	// 	$(".main .step1").addClass("now_step");
	// 	nowShowing = $(".main .step1");
	// 	return false;
	// });
	// $(".main .step2 .step_box a.next_step").bind("click",function(){
	// 	$(nowShowing).removeClass("now_step");
	// 	$(".main .step3").addClass("now_step");
	// 	nowShowing = $(".main .step3");
		
	// 	return false;
	// });

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
	var $url = document.URL+"/search";
	if(inputString.length == 0) 
	{ 
	// Hide the suggestion box. 
	$('#suggest_box').hide(); 
	} 
	else 
	{ 
		$.get($url, {keywords: inputString}, function(data){ 
			(typeof data !== 'object') ? jsonObj = JSON.parse(data) :  jsonObj = data ;
			var length = jsonObj.length;
			console.log(jsonObj);
			if(length >0) { 
				$('#suggest_box').show();
				$('#suggest_box ul').html('');
				for(var i = 0;i<length;i++)
				{
					$('#suggest_box ul').append("<li><a href='' title="+jsonObj[i].name+"><img src='http://"+document.domain+"/images/"+jsonObj[i].ISBN+".jpg' alt=''></a></li>"); 
				}
			}else
			{	
				$('#suggest_box').show();
				$('#suggest_box ul').html('');
				$('#suggest_box ul').append("没有找到哦"); 
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
  //      do_jsonp();
  //   	$(nowShowing).removeClass("now_step");
		// $(".main .step2").addClass("now_step");
		// nowShowing = $(".main .step2");
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
		var rule = /^[0-9]*$/;
		if(!rule.test($('#isbncode').val()))//如果不是数字
		{
			return false;
		}
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
