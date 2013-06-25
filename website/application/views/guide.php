<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>引导页</title>
<link href="<?php echo base_url('css/reset.css'); ?>" type="text/css" rel="stylesheet" />
<link href="<?php echo base_url('css/index.css'); ?>" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.7.2.js'); ?>">
</script>
</head>
<body>

<div id="home_page">
	<a href="<?php echo site_url('guide');?>" title="前往首页">工大书架</a>
</div>
<div class="main">
	<div class="first_step">
		<h3>请选择你所在的学院:</h3>
		<ul>
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
	</div>
	<div class="selected_logo"><span></span>
	<form action="<?php echo site_url('guide/choose'); ?>" method="post">
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
	<div class="shelf_bg"><a href="<?php echo site_url('login'); ?>"><span></span></a></div>
</div><!--end of main-->
<script type="text/javascript" src="<?php echo base_url('js/guide.js'); ?>"></script>
</body>
</html>
