$(function(){
	// var $first_tr = $(".main .match_book .hidden_list:eq(0)").addClass("hover_td");
	// $(".main .match_book .hidden_list").bind("mouseover",function(){
	// 	$(".main .match_book .hidden_list").removeClass("hover_td");
	// 	$(this).addClass("hover_td");
	// }).bind("mouseout",function(){
	// 	$(this).removeClass("hover_td");
	// 
	// var $chakan = $(".main .match_list .chakan");
	// var $book_list = $(".main .match_list .match_book");
	// $chakan.bind("click",function(){
	// var $i = $(this).parent("span").parent("h5").index();
	// var $j = ($i - 1)/2;
		// $chakan.css("color","#130e7a");
		// $(this).css("color","#999999");
		// $book_list.css({display:'none'});
		// $book_list.eq($j).css('display','table-row');
	// });
	$(".main .match_list .chakan").bind("click",function(){
		$(".main .match_list .chakan").css("color","#130e7a");
		$(this).css("color","#999");
		$(".main .match_list .match_book").slideUp();
		$(this).parent("span").parent("h5").next().is(':visible')?$(this).parent("span").parent("h5").next().slideUp() : $(this).parent("span").parent("h5").next().slideDown();
	})
	$(".select_all").bind("click", function(){
		$(this).parent().prev().find("input[type=checkbox]").attr("checked", "checked");
	})
})
