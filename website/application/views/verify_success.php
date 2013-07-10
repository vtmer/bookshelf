<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>邮箱验证成功</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" char/>
<link href="<?php echo base_url('css/header.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/receipt.css'); ?>" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>"></script>
<script language="javascript" src="<?php echo base_url('js/pop_box.js');?>"></script>
</head>
<body>
<div id="float_head">
	<div class="header">
		<a href="<?php echo site_url('home');?>" id="gdutonline"></a>
	</div>
</div>
<?php include("./application/views/template/pop_box.php");?>
<div class="home_page">
	<a href="<?php echo site_url('home');?>" title="前往首页"></a>
</div>
	<!--<div class="search_bar">
		<input type="text" class="search_input" placeholder="请输入要查找的书目" />
		<input type="submit" class="search_submit" value=""/>
	</div>-->
<div class="main">
	<div class="mid_content">
		<h3>邮箱验证</h3>
		<div class="content_box">
			<div class="box_demo receipt">
				<span>恭喜你邮箱验证成功</span>
				<p>您的邮箱已经成功验证，马上登录：<a href = '<?php echo site_url('login');?>' >点击登录</a></p>
				<p>希望您使用愉快</p>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div><!--end of mid_content-->
</div><!--end of main-->