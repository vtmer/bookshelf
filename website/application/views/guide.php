<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择你的专业(工大书架)</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/index.css'); ?>" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>">
</script>
</head>
<body>

<div id="home_page">
	<a href="<?php echo site_url('guide');?>" title="前往首页">工大书架</a>
	<ul class="campus">
		<li class="current" data-no="daxuecheng">[大学城]</li>
		<li data-no="longdong">[龙洞]</li>
		<li data-no="dongfenglu">[东风路]</li>
	</ul>
</div>
<div class="main">
	<div class="first_step">
		<h3>请选择你所在的学院:</h3>
		<ul class="daxuecheng">
			<li><span class="college logo_01"></span><p>机电工程学院</p></li>
			<li><span class="college logo_02"></span><p>自动化学院</p></li>
			<li><span class="college logo_03"></span><p>轻工化工学院</p></li>
			<li><span class="college logo_04"></span><p>信息工程学院</p></li>
			<li><span class="college logo_05"></span><p>土木与交通学院</p></li>
			<li><span class="college logo_06"></span><p>计算机学院</p></li>
			<li><span class="college logo_07"></span><p>材料与能源学院</p></li>
			<li><span class="college logo_08"></span><p>环境科学与工程学院</p></li>
			<li><span class="college logo_09"></span><p>外国语学院</p></li>
			<li><span class="college logo_10"></span><p>物理与光电工程学院</p></li>
		</ul>
		<ul class="longdong">
			<li><span class="college logo_11"></span><p>管理学院</p></li>
			<li><span class="college logo_12"></span><p>经济与贸易学院</p></li>
			<li><span class="college logo_13"></span><p>应用数学学院</p></li>
		</ul>
		<ul class="dongfenglu">
			<li><span class="college logo_14"></span><p>建筑学院</p></li>
			<li><span class="college logo_15"></span><p>艺术设计学院</p></li>
			<li><span class="college logo_16"></span><p>政法学院</p></li>
		</ul>
	</div>
	<div class="selected_logo"><span></span>
	<form action="<?php echo site_url('guide/choose'); ?>" method="post">
		<label>
		<input type="text" id="campus_select" name="campus" disabled />
		<input type="text" id="campus_select" name="campus" vlaue="" />
		</label>
		<label>
		<input type="text" id="college_select" name="faculty" disabled/>
		<input type="hidden" id="college_select" name="faculty" value=""/>
		</label>
		<label>
		<input type="text" id="major_select" name="major" disabled/>
		<input type="hidden" id="major_select" name="major" value=""/>
		</label>
		<label>
		<input type="text" id="grade_select" name="grade" disabled/>
		<input type="hidden" id="grade_select" name="grade" value=""/>
		</label>
	</form>
	</div>
	<div class="second_step">
		<span class="step_back"></span>
		<h3>请选择您所在的专业:</h3>
		<ul>
			<div class="bottom_shadow"></div>		
		</ul>
		
	</div>
	<div class="third_step">
		<span class="step_back"></span>
		<h3>请选择您所在的年级：</h3>
		<ul>
			<li>大一</li>
			<li>大二</li>
			<li>大三</li>
			<li>大四</li>
			<div class="bottom_shadow"></div>
		</ul>
		
	</div>
	<div class="shelf_bg">
		<div class="login_box">
		<a href="<?php echo site_url('login'); ?>" class="login">登录</a>
		<a href="<?php echo site_url('register'); ?>" class="sign">注册</a>
		</div>
	</div>
</div><!--end of main-->
<script type="text/javascript" src="<?php echo base_url('js/guide.js'); ?>"></script>
</body>
</html>
