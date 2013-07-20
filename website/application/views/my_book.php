
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
							<th>操作</th>
						</tr>

						<?php if (empty($books)): ?>
								<tr><td colspan='4' style='text-align:center'>暂没记录</td></tr>
						<?php endif; ?>
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
								<a href="<?php echo site_url('my_book/pull_off')."?book_id=".$book['cb_id'];?>" class="pull_off">[下架]</a>
								<!--
								<form action="<?php echo site_url('my_book/pull_off'); ?>" method="POST" class="ajaxForm">
									<input type="hidden" name="book_id" value="<?php echo $book['cb_id'];?>" />
									<input type="submit" value="[下架]" />
								</form>	-->	
								<?php endif;?>
							</td>
							
						</tr>
						<?php endforeach ?>						

					</tbody>
				</table>

				<h5><span>查看历史记录</span><span class="s_h">>></span></h5>
				<div class="my_history">
					<table>
						<tr>
							<th>借出书籍</th>
							<th>借书人</th>
							<th>借出时间</th>
						</tr>
							<?php if (empty($log)): ?>
								<tr><td colspan='3'>暂没记录</td></tr>
							<?php endif; ?>

							<?php
							foreach ($log as $key=>$value): ?>
							<tr>
								<td><?php echo $value['name'];?></td>
								<td><?php echo $value['truename'];?></td>
								<td><?php echo $value['time'];?></td>
							</tr>
						<?php endforeach; ?>					
					</table>						

					<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->
				</div>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->

