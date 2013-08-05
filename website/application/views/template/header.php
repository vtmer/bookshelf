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
		<?php if($this->session->userdata('is_logged_in')): ?>
		<li><a href="<?php echo site_url('login/logout'); ?>" id="logout">[退出]</a></li>
		<li><span class="score">积分:<?php echo $this->user_model->show_user_point($this->session->userdata('uid')); ?></span></li>
		<?php $msg_num =  $this->user_model->show_message_num($this->session->userdata['uid']);
		if($msg_num==0):?>
			<li><a href="<?php echo site_url('message'); ?>" id="message" title="您有<?php echo $msg_num; ?>条信息"></a></li>
		<?php else :?><!-- 如果有信息，给id="message" 加上class"have_msg"-->
			<li><a href="<?php echo site_url('message'); ?>"  id="message" class='have_msg'title="您有<?php echo $msg_num; ?>条信息"></a></li>
	    <?php endif;?>
			<li><a href="<?php echo site_url('home/personal_config');?>" id="p_config" title="个人设置"> </a></li>
		<?php else: ?>
		<li><a href="<?php echo site_url('login'); ?>" id="logout">[登录]</a></li>
		<?php endif;?>
	</ul></div>
</div>
<div class="home_page">
	<a href="<?php echo site_url('guide');?>" title="前往首页"></a>
</div>

<a href="#" id="top"></a>

<?php include "pop_box.php";?><!--弹出层-->
