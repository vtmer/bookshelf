<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索书籍</title>
<link href="../resources/css/reset.css" type="text/css" rel="stylesheet" char/>
<link href="../resources/css/header.css" type="text/css" rel="stylesheet" />
<link href="../resources/css/search.css" type="text/css" rel="stylesheet" />
<script language="javascript" src="../resources/js/jquery-1.7.2.js">
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
	<a href="./home" title="前往首页"></a>
</div>
<div class="main">
	<?php echo form_open('search');?>
	<div class="search_bar">
		<input type="text" name="keywords" value="请输入要查找的书目" />
		<a href="#"><input type='submit' value='' /></a>
	</div>
	</form>
	<div class="mid_content">
		<div class="content_box">	
			<div class="box_demo search_results">
				<h3>搜索结果：</h3>
				<table>
					<tbody>
						<tr><?php 
						if ($books!=null) 
							{
								echo "
								<th>书名</th>
								<th>课程名称</th>
								<th>作者</th>
								<th>发放对象</th>
								<th>出版社</th>
								<th>版次</th>";
							}
						else
						{
							echo "<th>哎呀，没有找到呀!</th>";
						}
						?>
						</tr>

						<?php foreach ($books as $value) 
						{
							echo 
							"<tr>
							<td><a href='./book_info/".$value['id']."'>".$value['name']."</a></td>
							<td>".$value['course_name']."</td>
							<td>".$value['author']."</td>
							<td>".$value['course_category']."</td>
							<td>".$value['publish']."</td>
							<td>".$value['version']."</td>
						</tr>";
						}?>
						<!--
						<tr>
							<td><a href="book_info.html">线性代数</a></td>
							<td>线性代数</td>
							<td>李钊</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td><a href="book_info.html">大学物理</a></td>
							<td>大学物理</td>
							<td>爱因斯坦</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td><a href="book_info.html">大学英语</a></td>
							<td>大学英语</td>
							<td>韩梅梅</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td><a href="book_info.html">高等数学</a></td>
							<td>高等数学</td>
							<td>华罗庚</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>-->
					</tbody>
				</table>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
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
	$(".main .search_bar input").bind("click",function(){if(this.value=="请输入要查找的书目")this.value=""}).bind("blur",function(){if(!this.value)this.value="请输入要查找的书目"});
</script>
</html>