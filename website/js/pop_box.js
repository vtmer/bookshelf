//将form转为AJAX提交
function ajaxSubmit(frm, fn) {
    var dataPara = getFormJson(frm);
    $.ajax({
        url: frm.action,
        type: frm.method,
        data: dataPara
    }).done(fn);
}

//将form中的值转换为键值对。
function getFormJson(frm) {
    var JsonData = {};
    var a = $(frm).serializeArray();
    $.each(a, function () {
        if (JsonData[this.name] !== undefined) {
            if (!JsonData[this.name].push) {
                JsonData[this.name] = [JsonData[this.name]];
            }
            JsonData[this.name].push(this.value || '');
        } else {
            JsonData[this.name] = this.value || '';
        }
    });
    return JsonData;
}
//调用

$(document).ready(function(){
    $(".ajaxForm").bind('submit', function(){//回调函数
        ajaxSubmit(this, function(data){  
        //document.write(data);  	
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
					$("#popContent").html(jsonobj.content);
		            $("#pop_title").html(jsonobj.title);
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();
					setTimeout("window.location.href='"+jsonobj.url+"'",1000);
				}
             });
        return false;
    });
    //关闭按钮
    $('.close-btn,.ok-btn ').click(function(){
		$('.popbox').fadeOut(function(){ $('#screen').hide(); 
		window.top.location.reload();});
		return false;
	});
});

jQuery.fn.center = function(loaded) {
	var obj = this;
	body_width = parseInt($(window).width());
	body_height = parseInt($(window).height());
	block_width = parseInt(obj.width());
	block_height = parseInt(obj.height());
	
	left_position = parseInt((body_width/2) - (block_width/2)  + $(window).scrollLeft());
	if (body_width<block_width) { left_position = 0 + $(window).scrollLeft(); };
	
	top_position = parseInt((body_height/2) - 100 - (block_height/2) + $(window).scrollTop());
	if (body_height - 180<block_height) { top_position = 0 + $(window).scrollTop(); };
	
	if(!loaded) {
		
		obj.css({'position': 'absolute'});
		obj.css({ 'top': top_position, 'left': left_position });
		$(window).bind('resize', function() { 
			obj.center(!loaded);
		});
		$(window).bind('scroll', function() { 
			obj.center(!loaded);
		});
		
	} else {
		obj.stop();
		obj.css({'position': 'absolute'});
		obj.animate({ 'top': top_position }, 200, 'linear');
	}
}
