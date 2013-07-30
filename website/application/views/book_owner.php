
<div class="main">
	
<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>书源人信息</h3>
		<div class="content_box">
			<div class="box_demo book_owner">
				<ul class="owner_info">
					<li><?php echo $user[0]['truename'];?></li>
					<li>专业：<span><?php echo $user[0]['major'];?></span></li>
					<li>年级：<span><?php echo $user[0]['grade']."级";?></span></li>
					<li>拥有书本数：<span><?php echo $user[0]['booknum'];?></span></li>
					<li>分享度：<span><?php echo $user[0]['share'].'%';?></span></li>
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
						<?php 
						if(empty($books))
						{
							echo '<tr><td colspan=\'6\'>暂没记录！</td></tr>';
						}
						else
						foreach ($books as $value) 
						{
							echo 
							"<tr>
							<td><a href='".site_url('home/book_info')."/".$value['book_id']."'>".$value['name']."</a></td>
							<td>".$value['course_name']."</td>
							<td>".$value['author']."</td>
							<td>".$value['course_category']."</td>
							<td>".$value['publish']."</td>
							<td>".$value['version']."</td>
						</tr>";
						}?>

					</tbody>
				</table>
				<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->