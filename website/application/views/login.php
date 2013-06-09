<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录页</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/login.css'); ?>" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>"></script>
<script language="javascript" src="<?php echo base_url('js/pop_box.js'); ?>">
</script>
</head>
<body>

<div id="home_page">
	<a href="<?php echo site_url('home');?>" title="前往首页">工大书架</a>
</div>
<div class="main">
	<div class="sign">
	<img src="<?php echo base_url('img/shujia.jpg'); ?>" class="shujia" alt="工大书架" />
		<form action="<?php echo site_url('login/check'); ?>" method="POST" class="ajaxForm"> 
			<span>已有帐号登录:</span>
			<label for="user_name">用户名：<input type="text" name="username"/ ></label>
			<label for="password">密码：<input type="password" name="pwd" /></label>	
			<input type="submit" class="confirm" value="登陆" />
		</form>
		<a href="<?php echo site_url('register');?>" class="sign_up"></a>
</div>

	<div class="bottom_shadow"></div>
	<div class="shelf_bg"></div>

	<?php if(isset($active_error)):?>
		<div class="alert">
		    <strong>帐号未激活！</strong>
		</div>
	<?php elseif(isset($pwd_error)):?>
		<div class="alert">
		    <strong>密码错误！</strong>
		</div>
	<?php endif;?>

</div><!--end of main-->
<script>
document.getElementById('home_page').getElementsByTagName('a')[0].innerText= " ";
</script>
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
.popbox .ok-btn{height:30px; border:none; margin-left:99px; background:#c6c4b6; padding:0 17px; box-shadow:0 -2px 4px -1px rgba(0,0,0,.6); border-radius:5px; font-size:14px; line-height:28px; text-align:center; cursor:pointer;}
.popbox .ok-btn:hover { background:#e8a126; color:#fff;} 
#screen{width:100%;height:100%;position:absolute;top:0;left:0;display:none;z-index:100;background-color:#000;opacity:0.5;filter:alpha(opacity=50);-moz-opacity:0.5;}
/*popboxcss end*/
</style>

<div id="screen"></div><!--screen end-->

<div class="popbox">
	<h2 ><span id ="pop_title">提示信息</span><a class="close-btn" href="#">关闭</a></h2>
	<div class="mainlist">
		<div>
		<span id="popContent"></span>
		</div>
		<span>
		<input class="ok-btn" type='button' value='确定'/>
		</span>
	</div>
</div><!--popbox end-->
</body>
</html>
