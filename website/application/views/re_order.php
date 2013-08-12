
<div class="main re_order">
	<div class="mid_content">
	<form action="<?php echo site_url('home/receipt');?>" method ='POST'>
		<h3>重新预约：</h3>
		<div class="content_box">
			<div class="box_demo">

			<!-- 这里是借书人的信息
			======================================== -->
				<div class="borrower_info">
					<p><strong>借书者联系方式：</strong></p>

					<p><span>借书者:2222同学</span>
						<span>生活区：123</span>
						<span>专业：sdfasdfasdfasdfasdfasdfasdfasdf</span>
					</p>
					<p>	<span>长号：12312312123</span>
						<span>短号：121111</span>
					</p>
					<p class="tips">温馨提示：注意休息时间不要打扰到人噢！</p>					
				</div>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->

		<div class="content_box">
			<div class="box_demo search_results">
				<h3>借书者所需的书籍：</h3>
				<table>
					<tbody>
						<tr>
							<th>书名</th>
							<th>课程名称</th>
							<th>作者</th>
							<th>出版社</th>
							<th>版次</th>
							<th>借出</th>
						</tr>
						<?php foreach ($books as $value) 
						{
							echo 
							"<tr>
							<td>".$value['name']."</td>
							<td>".$value['course_name']."</td>
							<td>".$value['author']."</td>
							<td>".$value['publish']."</td>
							<td>".$value['version']."</td>
							<td><label><input type='checkbox' value='".$value['cb_id']."' name='".$value['book_id']."' /><span></span></label></td>
							</tr>";
						}
						?>
					</tbody>
				</table>
				<p class="tips"><strong>注意：请先电话联系借书者确认需要借出的书籍</strong><input type="submit" value="提 交" /></p>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div>

	</form>
	</div><!--end of mid_content-->
</div><!--end of main-->