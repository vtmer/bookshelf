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
$(".ajaxForm").bind('submit', function(){//回调函数
  			ajaxSubmit(this, function(data){
  			  if (typeof data !== 'object') {
	        	    jsonobj = JSON.parse(data);
                        } else {
                            jsonobj = data;
                        }
	        	if(jsonobj.type=='alert')
	        	{
		            $("#popContent").html(jsonobj.content);
		            $("#pop_title").html(jsonobj.title);
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();

				}else
				if(jsonobj.type=='redirect')
				{
					window.location.href=jsonobj.url;
				}
			});
        return false;
    });
  	//关闭按钮
    $('.close-btn,.ok-btn ').click(function(){
		$('.popbox').fadeOut(function(){ $('#screen').hide(); 
	});
		return false;
	});