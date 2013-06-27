$(function(){
	var $first_tr = $(".main .match_book .hidden_list:eq(0)").addClass("hover_td");
	$(".main .match_book .hidden_list").bind("mouseover",function(){
		$(".main .match_book .hidden_list").removeClass("hover_td");
		$(this).addClass("hover_td");
	}).bind("mouseout",function(){
		$(this).removeClass("hover_td");
	});
	$(".select_all").bind("click", function(){
		$(this).parent().prev().find("input[type=checkbox]").attr("checked", "checked");
	})
})
