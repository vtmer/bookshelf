<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>工大书架</title>
<link href="../resources/css/reset.css" type="text/css" rel="stylesheet" />
<link href="../resources/css/header.css" type="text/css" rel="stylesheet" />
<link href="../resources/css/home.css" type="text/css" rel="stylesheet" />
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
		<a href="#"><input type="submit" value="" /></a>
	</div>
	</form>
	<div class="mid_content">
		<div class="content_box">
			<div class="box_demo needed_book">
				<h3>您本学期需要的教材有：</h3>
				<p>数字媒体技术专业10级 [<a href="./index" alt="修改">修改</a>]</p>
				<table>
					<tbody>
						<tr>
							<th>书名</th>
							<th>课程名称</th>
							<th>作者</th>
							<th>发放对象</th>
							<th>出版社</th>
							<th>版次</th>
						</tr>
						
						<?php foreach ($book_need as $row)
						{   
							echo
							"<tr><td><a href='./book_info/".$row['id']."'>" . $row['name'] . "</a></td>".
							"<td>" . $row['course_name'] . "</td>".
							"<td>" . $row['author'] ."</td>".
							"<td>" . $row['course_category']. "</td>".
							"<td>" . $row['publish'] . "</td>".
							"<td>" . $row['version'] . "</td></tr>";			
						}
						?>
						
						<!--<tr>
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
		</div><!-- end of content_box 包裹整块质感效果的div -->
		<div class="content_box">
			<div class="box_demo match_book">
				<h3>系统匹配结果：</h3>
				<table>
					<tbody>
					<tr>
						<th>姓名</th>
						<th>所在生活区</th>
						<th>拥有你需要的教材数</th>
					</tr>
					<?php 
					foreach ($system_match['user'] as $user) 
						{
							echo 
							"<tr>
							<td><a href='book_owner.html/".$user['id']."'/>".$user['truename'].'</a></td>
							<td>'.$user['dormitory'].'</td>
							<td>'.$user['number'].
								'<div class="book_list">
									<h6>书目</h6>';						
					?>
									<ul>
									<?php
									foreach ($system_match['book'] as $book) 
									{
										if($user['id']==$book['from_id'])
										{
											echo "<li>".$book['name']."</li>";
										}
									}	
									?>
									<!--
										<li>线性代数</li>
										<li>高等代数</li>
										<li>大学英语</li>
										<li></li>
										<li></li>
									-->
									</ul>
									<span>全选</span>
									<a href="check_step.html" class="order"></a>
								</div>
							</td>
						</tr>
					<?php }?>
					<!--
					<tr>
						<td><a href="book_owner.html">甄大钊</a></td>
						<td>东</td>
						<td>7
							<div class="book_list">
								<h6>书目</h6>
								<ul>
									<li>线性代数</li>
									<li>高等代数</li>
									<li>大学英语</li>
									<li></li>
									<li></li>
								</ul>
								<span>全选</span>
								<a href="check_step.html" class="order"></a>
							</div>
						</td>
					</tr>
					<tr>
						<td><a href="book_owner.html">苏嘉庆</a></td>
						<td>东</td>
						<td>6
							<div class="book_list">
								<h6>书目</h6>
								<ul>
									<li>大学物理</li>
									<li>高等代数</li>
									<li>计算机图形学</li>
									<li></li>
									<li></li>
								</ul>
								<span>全选</span>
								<a href="check_step.html" class="order"></a>
							</div>
						</td>
					</tr>
					<tr>
						<td><a href="book_owner.html">马永恒</a></td>
						<td>东</td>
						<td>6
							<div class="book_list">
								<h6>书目</h6>
								<ul>
									<li>线性代数</li>
									<li>数据结构</li>
									<li>动漫基础</li>
									<li></li>
									<li></li>
								</ul>
								<span>全选</span>
								<a href="check_step.html" class="order"></a>
							</div>
						</td>
					</tr>
					<tr>
						<td><a href="book_owner.html">黄大仙</a></td>
						<td>东</td>
						<td>5
							<div class="book_list">
								<h6>书目</h6>
								<ul>
									<li>线性代数</li>
									<li>毛泽东思想、邓小平理论与三个代表</li>
									<li>大学英语</li>
									<li></li>
									<li></li>
								</ul>
								<span>全选</span>
								<a href="check_step.html" class="order"></a>
							</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>
							<div class="book_list">
								<h6>书目</h6>
								<ul>
									<li>木有</li>
									<li>啥都木有啊</li>
									<li>什么什么东西</li>
									<li>还是没有</li>
									<li></li>
								</ul>
								<span>全选</span>
								<a href="check_step.html" class="order"></a>
							</div>
						</td>
					</tr>-->
					</tbody>
				</table>
				<ul class="pages">
					<li class="prev"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="page on_select"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="next"><a href=""></a></li>
				</ul>
			</div>
			<div class="bottom_shadow"></div>
		</div><!-- end of content_box 包裹整块质感效果的div -->
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
	$(".main .match_book table tr:eq(1)").children(2).addClass("hover_td");
	$(".main .match_book table tr").children(2).bind("mouseover",function(){
		$(this).addClass("hover_td");
	});
	$(".main .match_book table tr").children(2).bind("mouseout",function(){
		$(this).removeClass("hover_td");
	});
</script>
</html>