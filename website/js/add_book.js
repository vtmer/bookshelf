
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
	var $url = "http://"+document.domain+"/index.php/add_book/search";
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
			if(length >0) 
			{ 
				$('#suggest_box').show();
				$('#suggest_box ul').html('');
				for(var i = 0;i<length;i++)
				{
					$('#suggest_box ul').append("<li><a href='' title="+jsonObj[i].name+"><img src='/images/"+jsonObj[i].ISBN+".jpg' alt='' onerror=\"this.onerror=null; this.src=\'/img/loading.gif\'\"/></a></li>"); 
				}

				$('#suggest_box ul a').click(function(){
					var $index = $(this).parent('li').index();
					var $string = "<li><div><img src='/images/"+jsonObj[$index].ISBN+".jpg' alt='' onerror=\"this.onerror=null; this.src=\'/img/loading.gif\'\"/></div>"+
							"<ul><li>书 名：<span>"+jsonObj[$index].name+"</span></li>"+
								"<input type='hidden' value='"+jsonObj[$index].id+"' name='"+jsonObj[$index].id+"'>"+
								"<li>作 者：<span>"+jsonObj[$index].author+"</span></li>"+
								"<li>出版社：<span>"+jsonObj[$index].publish+"</span></li>"+
								"<li>版次：<span>"+jsonObj[$index].version+"</span></li>"+
							"</ul><a href='#' class='del_book'>[删除]</a>"+
						"</li>";
						$('.sele_book').prepend($string);
						// $('.sele_book').slideDown();
						$('#suggest_box').slideUp('fast',function(){
							$('#suggest_box ul').html('');
							$('#isbncode').attr('value','');
							});
					$(".del_book").click(function(){
							console.log($(this).parent('li'));
							$(this).parent('li').slideUp('fast',function(){
								$(this).parent('li').replaceWith('');
							});
							window.event.returnValue = false;
						});	

					window.event.returnValue = false;
				});

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
   		var rule = /^[0-9]*$/;
   		if(!rule.test($('#isbncode').val()))//如果不是数字
		{
			startTimer($("#isbncode").val());
		}
		else
		{
			if($("#isbncode").val().length>=10)
			{
				startTimer($("#isbncode").val());
			}
		}   	   
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
