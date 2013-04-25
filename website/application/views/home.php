<div class="main">
	<form action="<?php echo site_url('search'); ?>" method="POST"> 
	<div class="search_bar">
	<input type="text" name="keywords" value="请输入要查找的书目" />
	<a href="#"><input type='submit' value='' /></a>
	</div>
	</form>
	<div class="mid_content">
		<div class="content_box">
			<div class="box_demo needed_book">
				<h3>您本学期需要的教材有：</h3>
				<p><?php echo $this->session->userdata['grade'].'级  '.$this->session->userdata['major'];
					if($this->session->userdata['is_logged_in']==NULL)
					{
						echo "[<a href='".site_url('guide')."' alt='修改'>修改</a>]";
					}
					?>
				</p>
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
							"<tr><td><a href='".site_url('home/book_info')."/".$row['id']."'>" . $row['name'] . "</a></td>".
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
							<td><a href='".site_url('home/book_owner')."/".$user['id']."'/>".$user['truename'].'</a></td>
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
									<a href="<?php echo site_url('home/check_step');?>" class="order"></a>
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
					<li class="prev"><a href='<?php echo site_url('home/index')."/".($page['prevpage']);?>'></a></li>
					<?php for ($i=1; $i <= $page['num']; $i++) 
					{ 
						if($i==$page['currentpage'])
						{
							echo "<li class='page on_select'><a href='".site_url('home/index')."/$i'></a></li>";
						}
						else
						{
							echo "<li class='page'><a href='".site_url('home/index')."/$i'></a></li>";
						}
					}
					?>
					<li class="next"><a href="<?php echo site_url('home/index').'/'.($page['nextpage']);?>"></a></li>
					<!--
					<li class="prev"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="page on_select"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="next"><a href=""></a></li>
					-->
				</ul>
			</div>
			<div class="bottom_shadow"></div>
		</div><!-- end of content_box 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
