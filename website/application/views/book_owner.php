
<div class="main">
	<form action="<?php echo site_url('search'); ?>" method="POST"> 
	<div class="search_bar">
	<input type="text" name="keywords" value="请输入要查找的书目" />
	<a href="#"><input type='submit' value='' /></a>
	</div>
	</form>
	<div class="mid_content">
		<h3>书源人信息</h3>
		<div class="content_box">
			<div class="box_demo book_owner">
				<ul class="owner_info">
					<li><?php echo $user[0]['truename'];?></li>
					<li>专业：<span><?php echo $user[0]['major'];?></span></li>
					<li>年级：<span><?php echo $user[0]['grade']."级";?></span></li>
					<li>拥有书本数：<span>##</span></li>
					<li>分享度：<span>##</span></li>
				</ul>
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
						<?php foreach ($books as $value) 
						{
							echo 
							"<tr>
							<td><a href='".site_url('home/book_info')."/".$value['id']."'>".$value['name']."</a></td>
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
						</tr>
						-->
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
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
