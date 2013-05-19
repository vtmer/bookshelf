<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录页</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/sign.css'); ?>" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>">
</script>
</head>
<body>

<div id="home_page">
	<a href="index.html" title="前往首页">工大书架</a>
</div>
<div class="main">
	<div class="sign">
	<img src="<?php echo base_url('img/shujia.jpg'); ?>" class="shujia" alt="工大书架" />
		<form action="<?php echo site_url('login/check'); ?>" method="POST"> 
			<span>已有帐号登录:</span>
			<label for="user_name">用户名：<input type="text" name="username"/ ></label>
			<label for="password">密码：<input type="password" name="pwd" /></label>	
			<input type="submit" class="confirm" value="登陆" />
		</form>
		<a href="<?php echo site_url('register');?>" class="sign_up"></a>
</div>

	<div class="bottom_shadow"></div>
	<div class="shelf_bg"></div>

	<?php if(isset($error)):?>
		<div class="alert">
		    <strong>登陆失败！</strong>
		</div>
	<?php endif;?>

</div><!--end of main-->
<script>
document.getElementById('home_page').getElementsByTagName('a')[0].innerText= " ";
</script>
</body>
</html>
