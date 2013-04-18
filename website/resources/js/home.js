$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
$(".main .match_book table tr:eq(1)").children(2).addClass("hover_td");
$(".main .match_book table tr").children(2).bind("mouseover",function(){
	$(this).addClass("hover_td");
});
$(".main .match_book table tr").children(2).bind("mouseout",function(){
	$(this).removeClass("hover_td");
});
