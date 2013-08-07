<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录页</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/login.css'); ?>" type="text/css" rel="stylesheet" />
<style type="text/css">
/* popboxcss */
.popbox{width:350px;background-color:rgba(219,213,189,1);padding:1px;position:absolute;top:0;left:0;display:none;z-index:120;  
    /* 设置阴影 */
    -webkit-box-shadow:1px 1px 3px #292929;
    -moz-box-shadow:1px 1px 3px #292929;
    box-shadow:1px 3px 13px #292929;
	}
.popbox h2{height:25px;font-size:14px;background-color:rgba(224,188,138,1);position:relative;padding-left:10px;line-height:25px;color:#fff;}
.popbox h2 a{position:absolute;right:5px;font-size:12px;color:#fff;}
.popbox .mainlist{padding:10px;}
.popbox .mainlist span{margin:5px 5px 5px 5px;font-family:"宋体";font-size:14px;font-weight:400;color:#000;}
.popbox .mainlist div{margin:5px 5px 30px 5px;}
.popbox .ok-btn{height:30px; border:none; background:#c6c4b6; padding:0 17px; box-shadow:0 -2px 4px -1px rgba(0,0,0,.6); border-radius:5px; font-size:14px; line-height:28px; text-align:center; cursor:pointer;}
.popbox .ok-btn:hover { background:#e8a126; color:#fff;} 
#screen{width:100%;height:100%;position:absolute;top:0;left:0;display:none;z-index:100;background-color:#000;opacity:0.5;filter:alpha(opacity=50);-moz-opacity:0.5;}
/*popboxcss end*/
</style>
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>"></script>
</head>
<body>

<div id="home_page">
	<a href="<?php echo site_url('home');?>" title="前往首页">工大书架</a>
</div>
<div class="main">
	<div class="sign"><ul>
		<li>
		 <img src="<?php echo base_url('img/shujia.png'); ?>" class="shujia" alt="工大书架" />
			<form action="<?php echo site_url('login/check'); ?>" method="POST" class="ajaxForm">
				<div>
					<!-- <span>已有帐号登录:</span> -->
					<label for="user_name">学号：<input type="text" name="username" value='' placeholder="  请输入您的学号"/ ></label>
					<label for="password">密码：<input type="password" name="pwd" value=''/></label>
					<!-- <label for="" class="yanzheng">验证码：<input type="text"/> <img src="" /></label> -->
					<label for="remember" class="check_label"><input type="checkbox" id="remember" name="auto_login" value="true"/><span unselectable="on">一周内自动登录</span><a href="#" class="forget">忘记密码？</a></label>
					
					<input type="submit" class="confirm" value="登 录" />			
				</div> 
			</form>
			<div class="sign_up">
				<p>本平台仅限于广工在校学生使用，请输入 <span>学生工作信息管理系统的学号和密码</span> 进行登录。</p>
				<a href="" id="addus">加入我们</a>
			</div>
			<div class="poins"></div>
		</li>
		<li class="verifier">
		 <img src="<?php echo base_url('img/shujia.png'); ?>" class="shujia" alt="工大书架" />
			<form action="<?php echo site_url('login/check'); ?>" method="POST" class="ajaxForm">
				<div>
					<label for="user_name">学号：<input type="text" name="username" value='' placeholder="  请输入您的学号"/ ></label>
					<label for="password">密码：<input type="password" name="pwd" value=''/></label>
					<input type="submit" class="confirm" value="验 证" />			
				</div> 
			</form>
			<div class="sign_up">
				<p>本平台仅限于广工在校学生使用，请输入 <span>学生工作信息管理系统的学号和密码</span> 进行验证。</p>
				<a href="#" id="have">已有账号登录</a>
			</div>
		</li>		
	</ul></div>

	<div class="bottom_shadow"></div>
	<div class="shelf_bg"></div>
</div><!--end of main-->
<script>
document.getElementById('home_page').getElementsByTagName('a')[0].innerText= " ";
</script>


<div id="screen"></div><!--screen end-->

<div class="popbox">
	<h2 ><span id ="pop_title">提示信息</span><a class="close-btn" href="#">关闭</a></h2>
	<div class="mainlist">
		<div>
		<span id="popContent"></span>
		</div>
		<span>
		<input class="ok-btn" type='button' value='确 定'/>
		</span>
	</div>
</div><!--popbox end-->
<script type="text/javascript">
//将form转为AJAX提交
function ajaxSubmit(frm, fn) {
    var dataPara = getFormJson(frm);
    $.ajax({
        url: frm.action,
        type: frm.method,
        data: dataPara,
        beforeSend:function(XMLHttpRequest){
        			var url = "/img/loading.gif";
        			$(".mainlist").html("<img src="+url+" alt='loading...'/>");
        			$(".mainlist").css('text-align','center');
		            $("#pop_title").html("正在登录");
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();            
                 }
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
                if (typeof data !== 'object') 
                {
    	    		jsonobj = JSON.parse(data);
                } 
                else 
                {
                    jsonobj = data;
                }
	        	if(jsonobj.type=='alert')
	        	{
		            $(".mainlist").html("<div><span id='popContent'>"+jsonobj.content+"</span></div><span><input class='ok-btn' type='button' value='确 定'></span>");
		            $("#pop_title").html(jsonobj.title);
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();
					if(jsonobj.content=='用户名不存在')
					{
						//关闭按钮
					    $('.close-btn,.ok-btn ').click(function(){
							$('.popbox').fadeOut(function(){ $('#screen').hide();
								$('input[type=text]').val('');
								$('input[type=password]').val('');
								$('input[type=text]').focus();
							});
							return false;
						});
					}
					else if(jsonobj.content=='密码不正确')
					{
						//关闭按钮
					    $('.close-btn,.ok-btn ').click(function(){
							$('.popbox').fadeOut(function(){ $('#screen').hide();
							$('input[type=password]').val('');
							$('input[type=password]').focus();
							});
							return false;
						});
					}
				}
				else if(jsonobj.type=='redirect')
				{
					if(typeof jsonobj.content == 'object')
					{
						$(".mainlist").html("<div><span id='popContent'>"+jsonobj.content+"</span></div><span></span>");
					}
					$("#pop_title").html('登录成功');
		          	var h = $(document).height();
					$('#screen').css({ 'height': h });	
					$('#screen').show();
					$('.popbox').center();
					$('.popbox').fadeIn();
					window.location.href=jsonobj.url;
				}
             });
        return false;
    });
	
	$("#addus").bind('click', function() {
		$(".sign ul").animate({left: "-504px"},"slow");
		return false;
	});
	$("#have").bind('click', function() {
		$(".sign ul").animate({left: "0px"},"slow");
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
</script>
</body>
</html>
