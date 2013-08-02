
<div class="main">
	
<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<div class="content_box">	
			<div class="box_demo search_results">
				<h3>搜索结果：</h3>
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

					<?php if ($books==null) {echo "<tr><td colspan='6'>哎呀，没有找到呀!</td></tr>";	}?>

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
					</tbody>
				</table>
					<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
			</div>

			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->