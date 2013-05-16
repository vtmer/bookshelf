
<div class="main">

<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>我的书架</h3>
		<div class="content_box">
			<div class="box_demo my_book">
				<table>
					<tbody>
						<tr>
							<th>当前所拥有书籍</th>
							<th>当前状态</th>
							<th>归属权</th>
							<th></th>
						</tr>
						<?php foreach ($books as $book): ?>
						<tr>
							<td><?php echo $book['name'];?></td>
							<td>
								<?php if($book['book_status']==0) echo "闲置中"; 
										elseif ($book['book_status']==1) echo "预约中";
										else echo "借出";	
								?>
							</td>
							<td><?php if($book['book_right']) echo "共同";else echo "私有"; ?></td>
							<td class="remove">
								<?php if($book['book_status']==0&&$book['book_right']==0):?>
								<form action="<?php echo site_url('home/my_book'); ?>" method="POST">
									<input type="hidden" name="book_id" value="<?php echo $book['id'];?>" />
									<input type="submit" value="下架" />
								</form>		
								<?php endif;?>
							</td>
							
						</tr>
						<?php endforeach ?>						
						<!--
						<tr>
							<td>毛邓三的那些事</td>
							<td>借出</td>
							<td>共同</td>
							<td></td>
						</tr>
						<tr>
							<td>xxx的xxx</td>
							<td>预约中</td>
							<td>个人</td>
							<td></td>
						</tr>
						<tr>
							<td>xxx的xxx</td>
							<td>闲置中</td>
							<td>个人</td>
							<td class="remove"><a href="#">下架</a></td>
						</tr>
						<tr>
							<td>xxx的xxx</td>
							<td>闲置中</td>
							<td>个人</td>
							<td class="remove"><a href="#">下架</a></td>
						</tr>
						-->
					</tbody>
				</table>
				<a href="<?php echo site_url('home');?>" class="back_up">返回</a>
				<ul class="pages">
					<li class="prev"><a href='<?php echo site_url('home/my_book')."/".($page['prevpage']);?>'></a></li>
					<?php for ($i=1; $i <= $page['num']; $i++) 
					{ 
						if($i==$page['currentpage'])
						{
							echo "<li class='page on_select'><a href='".site_url('home/my_book')."/$i'></a></li>";
						}
						else
						{
							echo "<li class='page'><a href='".site_url('home/my_book')."/$i'></a></li>";
						}
					}
					?>
					<li class="next"><a href="<?php echo site_url('home/my_book').'/'.($page['nextpage']);?>"></a></li>
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
