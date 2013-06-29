
<div class="main">
	<div class="mid_content">
		<h3>借书流程</h3>
		<p class="step_01"><span>1</span>搜索选择自己要借的书</p>
		<p class="dots"><span></span></p>
		<p class="dots"><span></span></p>
		<p class="dots"><span></span></p>
		<p class="step_02"><span>2</span>电话或者短信联系</p>
		<div class="content_box">
			<div class="box_demo search_results">
				<h2>书源人联系方式：</h2>
				<?php echo 
				"<p><span>名称:".$user[0]['truename']."</span><span>年级：".$user[0]['grade']."</span><span>长号：".$user[0]['phone_number']."</span><span>短号：".$user[0]['subphone_number']."</span><span>".$user[0]['dormitory']."</span></p>";
				?>
				<span class="tips">tips:在您联系书源人时请考虑当前时间，选择使用短信或是电话联系</span>
				<h4>您要借的书籍：</h4>
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
							<td>".$value['name']."</td>
							<td>".$value['course_name']."</td>
							<td>".$value['author']."</td>
							<td>".$value['course_category']."</td>
							<td>".$value['publish']."</td>
							<td>".$value['version']."</td>
							</tr>";
						}
						?>
						<!--
						<tr>
							<td>线性代数</td>
							<td>线性代数</td>
							<td>李钊</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td>大学物理</td>
							<td>大学物理</td>
							<td>爱因斯坦</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td>大学英语</td>
							<td>大学英语</td>
							<td>韩梅梅</td>
							<td>大二</td>
							<td>人民出版社</td>
							<td>n次</td>
						</tr>
						<tr>
							<td>高等数学</td>
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
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
		<p class="dots"><span></span></p>
		<p class="dots"><span></span></p>
		<p class="step_03"><span>3</span>确定预约结果</p>
		<div class="receipt">
			<?php 
			$hidden = array();
			foreach ($books as $key => $value) 
			{
				$hidden = $hidden+array($key=>$value['book_id']);	
			}
				echo form_open('home/receipt','',$hidden);
				echo form_hidden('from_id',$user[0]['id']);
			?>
			<input type="submit" class="receipt_succ" value="" />
			</form>
			<span>,or</span>
			<input type="submit" class="receipt_unsucc" value="" />
			
			<span>?</span>
			<p>tips:若有某一本书预约失败可在回执中取消</p>
		</div>
	</div><!--end of mid_content-->
</div><!--end of main-->
