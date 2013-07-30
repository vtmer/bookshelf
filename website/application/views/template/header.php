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
	<div class="header"><ul>
		<li id="logo"><a href="<?php echo site_url('guide');?>" title="工大书架"></a></li>
		<li><a href="<?php echo site_url('login/logout'); ?>" id="logout">[退出]</a></li>
		<li><span class="score">积分:<?php echo $this->user_model->show_user_point($this->session->userdata('uid')); ?></span></li>
		<li><a href="<?php echo site_url('message'); ?>" id="message" title="您有<?php echo $this->user_model->show_message_num($this->session->userdata['uid']); ?>条信息"><sub>(<?php echo $this->user_model->show_message_num($this->session->userdata['uid']); ?>)</sub></a></li>
		<!-- 如果有信息，把background-color 设为 #eb5056 -->
		<li><a href="<?php echo site_url('home/personal_config');?>" id="p_config" title="个人设置"> </a></li>
	</ul></div>
</div>
<div class="home_page">
	<a href="<?php echo site_url('guide');?>" title="前往首页"></a>
</div>
<?php include "pop_box.php";?><!--弹出层-->
