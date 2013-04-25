<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>捐献书籍</title>
<link href="css/reset.css" type="text/css" rel="stylesheet" char/>
<link href="css/header.css" type="text/css" rel="stylesheet" />
<link href="css/add_book.css" type="text/css" rel="stylesheet" />
<script language="javascript" src="js/jquery-1.7.2.js">
</script>
</head>
<body>
<div id="float_head">
	<div class="header">
		<a href="http://www.gdutonline.com" id="gdutonline"></a>
		<span class="score">积分：0</span>
		<a href="message.html" id="message">收到短信息<span>(0)</span></a>
		<div class="user_info">
			<span class="user_name">董晓丁</span>
			<a href="personal_info.html">个人设置</a>
			<a href="bookshelf.html">我的书架</a>
			<a href="#">退出</a>
		</div>
		<a href="add_book.html" id="add_book">捐书</a>
	</div>
</div>
<div class="home_page">
	<a href="home.html" alt="回到首页" title="前往首页"></a>
</div>
<div class="main">
	<div class="search_bar">
		<input type="text" value="请输入要查找的书目" />
		<a href="search.html"></a>
	</div>
	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<form action="" method="get">
			<div class="box_demo add_book">
				<div class="step1 now_step">
					<span>步骤1：输入ISBN码</span>
					<div class="step_box">
						<input type="text" value="请输入书籍的ISBN码" id="isbncode"/>
						<a href="#" class="next_step" onclick="do_jsonp() ">下一步</a>
						<img src="img/tip.jpg" alt="ISBN码位于书籍背面标价处"/>
					</div>
				</div>
				<div class="step2">
					<span>步骤2：确认信息</span>
					<div class="step_box">
						<ul>
							<li id="booktitle">书名</li>
							<li class="isbn" id="isbn">ISBN</li>
							<li id="author">作者</li>
							<li id="publish">出版社</li>
							<li class="isbn">发布对象：大n</li>
							<li>版次：n</li>
							<a href="#" class="next_step">下一步</a>
							<a href="#" class="prev">上一步</a>
						</ul>
					</div>
				</div>
				<div class="step3">
					<span>步骤3：成功捐书</span>
					<div class="step_box">
						<p>您好，您已经成功捐出《xxx的那些事》</p>
						<a href="index.html" class="prev">返回首页</a>
						<a href="add_book.html" class="prev">继续捐书</a>
						<a href="my_book.html" class="bookshelf">前往我的书架</a>
					</div>		
				</div>

			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
			</form>
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
<div class="footer">
	<div class="safa"></div>
	<ul>
		<li>Copyright @ 2012 Product Of vtmer 维生数工作室</li>
		<li>联系我们 关于我们 后台管理 @工大书架</li>
	</ul>
</div>
</body>
<script>
	function do_jsonp() 
	{
		var id = document.getElementById('isbncode').value;
		$.getJSON("https://api.douban.com/v2/book/isbn/"+id+"?callback=?",
			function(data) {
				$('#booktitle').html('书名:'+data.title);
				$('#isbn').html('ISBN码:'+data.isbn13);
				$('#author').html('作者:'+data.author);
				$('#publish').html('出版社:'+data.publisher);
				});
	}
	$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
	$(".main .step1 .step_box input").bind("click",function(){if(this.value=="请输入书籍的ISBN码")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入书籍的ISBN码"});
	var nowShowing = $(".main .step1");
	$(".main .step1 .step_box a.next_step").bind("click",function(){
		$(nowShowing).removeClass("now_step");
		$(".main .step2").addClass("now_step");
		nowShowing = $(".main .step2");
		return false;
	});
	$(".main .step2 .step_box a.prev").bind("click",function(){
		$(nowShowing).removeClass("now_step");
		$(".main .step1").addClass("now_step");
		nowShowing = $(".main .step1");
		return false;
	});
	$(".main .step2 .step_box a.next_step").bind("click",function(){
		$(nowShowing).removeClass("now_step");
		$(".main .step3").addClass("now_step");
		nowShowing = $(".main .step3");
		
		return false;
	});
</script>
</html>
