<div class="main">
	
<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>书籍信息</h3>
		<div class="content_box">
			<div class="box_demo search_results">
				<div class="book_img">
					<img src="" id="image" value="9787040223903"/>
				</div>
				<dl>
					<input type="hidden" id="isbncode" value="<?php echo $book_info[0]->ISBN; ?>" />
					<dt><?php echo $book_info[0]->name;?></dt>
					<dd>作者：<span><?php echo $book_info[0]->author;?></span></dd>
					<dd>发放对象:<span><?php echo $book_info[0]->course_category;?></span></dd>
					<dd>出版社:<span><?php echo $book_info[0]->publish;?></span></dd>
					<dd>版次:<span><?php echo $book_info[0]->version;?></span></dd>
		
				</dl>
				<table>
					<tbody>
						<tr>
							<th>姓名</th>
							<th>专业</th>
							<th>生活区</th>
						</tr>
						<?php $n = 0;
						foreach ($user['user'] as $value) 
						{
							echo
							"<tr>
							<td><a href='".site_url('home/book_owner').'/'.$value['id']."'>".$value['truename']."</a></td>
							<td>".$value['major']."</td>
							<td>".$value['dormitory']."</td>
						</tr>";
						$n++;
						}?>
						<!--
						<tr>
							<td><a href="book_info.html">xxx</a></td>
							<td>线性代数</td>
							<td>n次</td>
						</tr>
						<tr>
							<td><a href="book_info.html">大学物理</a></td>
							<td>大学物理</td>
							<td>n次</td>
						</tr>
						<tr>
							<td><a href="book_info.html">大学英语</a></td>
							<td>大学英语</td>
							<td>n次</td>
						</tr>
						<tr>
							<td><a href="book_info.html">高等数学</a></td>
							<td>高等数学</td>
							<td>n次</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					-->
					</tbody>
				</table>
				<ul class="get_book">
					<?php for ($i=0; $i<$n ; $i++) 
					{ 
						echo "<form action='".site_url('home/check_step')."' method='post'>";
						echo "<input type='hidden' name='user' value='".$user['user'][$i]['id']."''>";
						echo "<input type='hidden' name='book' value='".$book_info[0]->id."''>";
						echo '<li><input type="submit" value="借阅" /></li>';
						echo '</form>';
					}?>
					<!--
					<li><a href="check_step.html">借阅</a></li>
					<li><a href="check_step.html">借阅</a></li>
					<li><a href="check_step.html">借阅</a></li>
					<li><a href="check_step.html">借阅</a></li>
					<li><a href="check_step.html">借阅</a></li>
					-->
				</ul>
				<ul class="pages">
					<li class="prev"><a href='<?php echo site_url('home/book_info')."/".$book_info[0]->id.'/'.$page['prevpage'];?>'></a></li>
					<?php for ($i=1; $i <= $page['num']; $i++) 
					{ 
						if($i==$page['currentpage'])
						{
							echo "<li class='page on_select'><a href='".site_url('home/book_info')."/$i'></a></li>";
						}
						else
						{
							echo "<li class='page'><a href='".site_url('home/book_info').'/'.$book_info[0]->id."/$i'></a></li>";
						}
					}
					?>
					<li class="next"><a href="<?php echo site_url('home/book_info').'/'.$book_info[0]->id.'/'.$page['nextpage'];?>"></a></li>
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
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
