<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{title}</title>
<link href="<?php echo base_url('css/reset.css');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/header.css');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/footer.css');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css');?>/{css_file}" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js');?>"></script>
<script language="javascript" src="<?php echo base_url('js/pop_box.js');?>"></script>
</head>
<body>
<div id="float_head">
	<div class="header">
		<a href="<?php echo site_url('home');?>" id="gdutonline"></a>
		<?php if($this->session->userdata['is_logged_in']!==FALSE) :?>
		<span class="score">积分:<?php echo $this->user_model->show_user_point($this->session->userdata['points']); ?></span>
		<a href="<?php echo site_url('message'); ?>" id="message">收到短信息(<span><?php echo $this->user_model->show_message_num($this->session->userdata['uid']); ?>)<span></a>
		<div class="user_info">
		<span class="user_name"><?php echo $this->session->userdata['truename'];?></span>
			<a href="<?php echo site_url('home/personal_config');?>">个人设置</a>
			<a href="<?php echo site_url('my_book');?>">我的书架</a>
			<a href="<?php echo site_url('login/logout'); ?>">退出</a>
		</div>
		<a href="<?php echo site_url('add_book')?>" id="add_book">捐书</a>
		<?php else: ?>		
		<a href="<?php echo site_url('login');?>"  id="login" >登录</a>
		<a href="<?php echo site_url('register'); ?>"  id="register">注册</a>
		<?php endif;?>
	</div>
</div>
<div class="home_page">
	<a href="<?php echo base_url('index.php/home');?>" title="前往首页"></a>
</div>
<?php include "pop_box.php";?><!--弹出层-->
