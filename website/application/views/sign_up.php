<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>加入工大书架</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" char/>
<link href="<?php echo base_url('css/header.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/sign_up.css'); ?>" type="text/css" rel="stylesheet" />
<script language="javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>"></script>
<script language="javascript" src="<?php echo base_url('js/pop_box.js');?>"></script>
</head>
<body>
<div id="float_head">
	<div class="header">
		<a href="<?php echo site_url('home');?>" id="gdutonline"></a>
		<!--<span class="score">积分：0</span>
		<a href="message.html" id="message">收到短信息<span>(0)</span></a>  
		<div class="user_info">
			<span class="user_name">董晓丁</span>
			<a href="personal_info.html">个人设置</a>
			<a href="bookshelf.html">我的书架</a>
			<a href="#">退出</a>
		</div>
		<a href="add_book.html" id="add_book">捐书</a>-->
	</div>
</div>
<?php include("./application/views/template/pop_box.php");?>
<div class="home_page">
	<a href="<?php echo site_url('home');?>" title="前往首页"></a>
</div>
<div class="main">
	<!--<div class="search_bar">
		<input type="text" class="search_input" placeholder="请输入要查找的书目" />
		<input type="submit" class="search_submit" value=""/>
	</div>-->
	<div class="mid_content">
		<!--<h3>个人信息设置：</h3>-->
		<div class="content_box">
			<div class="box_demo sign_info">
			<img src="<?php echo base_url('img/join_us.jpg'); ?>" alt="加入我们" class="join_us"/>
				<form action="<?php echo site_url('register/check'); ?>" method="post" class="ajaxForm">
					<label for="mail"><span>邮箱</span>
						<input type="text" id="mail" name="username"/>
						<span class="notice">填写常用邮箱以便验证</span>
					</label>
					<label for="password"><span>密码</span>
						<input type="password" id="password" name="pwd"/>
						<span></span>
					</label>
					<label for="password_confirm"><span>确认密码</span>
						<input type="password" id="password_confirm" name="pwd_confirm"/>
						<span></span>
					</label>
					<label for="name"><span>真实姓名</span>
						<input type="text" id="name" name="truename"/>
						<span></span>
					</label>
					<p class="notice">为了尊重并保障你和他人的利益，请填写真实姓名</p>
					<label for="stu_id"><span>学号</span>
						<input type="text" id="stu_id" name="student_id"/>
						<span></span>
					</label>
					<label><span>学院</span>
						<select id="college" name="faculty">
						</select>
						<span></span>
					</label>
					<label><span>专业</span>
						<select id="major" name="major">
						</select>
						<span></span>
					</label>
					<label><span>年级</span>
						<select id="grade" name="grade">
						</select>
						<span></span>
					</label>
					<label for="phone"><span>长号</span>
						<input type="text" id="phone" name="phone_num"/>
						<span></span>
					</label>
					<label for="mini_phone"><span>短号</span>
						<input type="text" id="mini_phone" name="subphone_num"/>
						<span class="notice">若无短号，可不填写</span>
					</label>
					<label><span>生活区</span>
						<div class="select_button">
							<label><input type="radio" value="西区" checked="checked" class="qu" name="dormitory"/>西区</label>
							<label><input type="radio" value="东区" class="qu" name="dormitory"/>东区</label>
						</div>
					</label>
					<p class="notice">以上内容皆为必填项，为了保障良好的借书环境，请认真阅读填写.</p>
					<label for="captcha"><span>验证码</span>
						<input type="text" id="captcha" name="captcha"/>
						<span></span><a href="javascript:reloadCode();"><img src="<?php echo site_url('captcha');?>" name="checkCodeImg" id="checkCodeImg" border="0" alt="换一张"/>换一张</a>
					</label>
					<input type="submit" class="config_submit" value="注册" />
				</form>
				<?php if(isset($error)): ?>
				<div class="alert_mail_once">
 					<strong>抱歉！你所注册的邮箱已被使用，请你使用新的邮箱注册！</strong>
				</div>
				<?php endif;?>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
<script type="text/javascript">
/*
$(document).ready(function(){
	 $("#mail").focusout(function() {
	 	$.get(document.URL+"/ajax_check",{mail:this.value,t:Math.random()},function(data){
	 		var	jsonData =  eval('(' + data + ')');
			  $("input#mail + span").addClass("notice alert").text(jsonData.content);
			});
	});
 });
*/
</script>