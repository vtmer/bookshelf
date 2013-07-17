$(function(){
	// var $first_tr = $(".main .match_book .hidden_list:eq(0)").addClass("hover_td");
	// $(".main .match_book .hidden_list").bind("mouseover",function(){
	// 	$(".main .match_book .hidden_list").removeClass("hover_td");
	// 	$(this).addClass("hover_td");
	// }).bind("mouseout",function(){
	// 	$(this).removeClass("hover_td");
	// 
	var $chakan = $(".main .match_book .hidden_list");
	var $book_list = $(".main .match_book .book_list");
	$chakan.bind("click",function(){
	var $i = $(this).parent("td").parent("tr").index();
	var $j = ($i - 1)/2;
		$chakan.css("color","#130e7a");
		$(this).css("color","#999999");
		$book_list.css({display:'none'});
		$book_list.eq($j).css('display','table-row');
	});
	$(".select_all").bind("click", function(){
		$(this).parent().prev().find("input[type=checkbox]").attr("checked", "checked");
	})
})
