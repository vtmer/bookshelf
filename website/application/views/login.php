<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录页</title>
<link href="<?=base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?=base_url('css/sign.css'); ?>" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?=base_url('js/jquery-1.7.2.js'); ?>">
</script>
</head>
<body>

<div id="home_page">
	<a href="index.html" title="前往首页">工大书架</a>
</div>
<div class="main">
	<div class="sign">
	<img src="<?=base_url('img/shujia.jpg'); ?>" class="shujia" alt="工大书架" />
		<form action="<?=site_url('login/check'); ?>" method="POST"> 
			<span>已有帐号登录:</span>
			<label for="user_name">用户名：<input type="text" id="username"/ ></label>
			<label for="password">密码：<input type="password" id="pwd" /></label>	
			<a href="<?=site_url('login/check'); ?>" class="confirm">登录</a>
		</form>
		<a href="sign_up" class="sign_up"></a>
	</div>

	<?php if(isset($error)):?>
	<strong>Login failed!</strong>
	<?php endif;?>

	<div class="bottom_shadow"></div>
	<div class="shelf_bg"></div>
</div><!--end of main-->
<script>
document.getElementById('home_page').getElementsByTagName('a')[0].innerText= " ";
</script>
</body>
</html>
