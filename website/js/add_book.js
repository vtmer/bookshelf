
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

function lookup(inputString) { 
var url="http://localhost/bookshelf/website/index.php/add_book/search";
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
