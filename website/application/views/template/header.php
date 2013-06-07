<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{title}</title>
<link href="<?php echo base_url('css/reset.css');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/header.css');?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css');?>/{css_file}" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js');?>"></script>
<script language="javascript" src="<?php echo base_url('js/pop_box.js');?>"></script>
</head>
<body onload="do_jsonp();">
<div id="float_head">
	<div class="header">
		<a href="http://www.gdutonline.com" id="gdutonline"></a>
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
		<span id="login">
			<a href="<?php echo site_url('login'); ?>">登录</a>
		</span>
		<span id="register">
			<a href="<?php echo site_url('register'); ?>">注册</a>
		</span>
		<?php endif;?>
	</div>
</div>
<div class="home_page">
	<a href="<?php echo base_url('index.php/home');?>" title="前往首页"></a>
</div>

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
