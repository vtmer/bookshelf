
function do_jsonp() 
	{
		 var id = document.getElementById('isbncode').value;
		 $.getJSON("https://api.douban.com/v2/book/isbn/"+id+"?callback=?",
			 function(data) {
			   $('#image').attr('src',data.image);		
		   });
	}
function do_main()
{
	var id = document.getElementById('isbncode').value;
	alert(id);
}
$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});