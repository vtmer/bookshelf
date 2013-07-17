<div class="main">
	
<?php include "template/search_bar.php"; ?>
	
	<div class="mid_content">
		<div class="content_box">
			<div class="box_demo needed_book">
				<h3>您本学期需要借的教材有：</h3>
				<p><span>专业：<?php echo $this->session->userdata['major'].'专业  '.$this->session->userdata['grade'].'级  ';
					if($this->session->userdata['is_logged_in']==NULL)
					{
						echo "[<a href='".site_url('guide')."' alt='修改'>修改</a>]";
					}
					?></span><span>学年：<?php echo $trans_grade['school_year'];?></span><span>学期：<?php echo $trans_grade['term'];?></span>
				</p>
				<table>
					<tbody>
						<tr>
							<th>书名</th>
							<th>课程名称</th>
							<th>作者</th>
							<th>出版社</th>
							<th>版 次</th>
							<th>状 态</th>
						</tr>
						
						<?php foreach ($book_need as $row)
						{   
							echo
							"<tr><td><a target='_blank' href='".site_url('home/book_info')."/".$row['id']."'>" . $row['name'] . "</a></td>".
							"<td>" . $row['course_name'] . "</td>".
							"<td>" . $row['author'] ."</td>".
							"<td>" . $row['publish']. "</td>".
							"<td>" . $row['version'] . "</td>";
							if($row['book_status']==0)
							{
								echo "<td>需求中</td></tr>";
							}
							else if($row['book_status']==1)
							{
								echo "<td>预约中</td></tr>";
							}
							else
							{
								echo "<td>已借到</td></tr>";
							}
								
						}
						?>
	
					</tbody>
				</table>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- end of content_box 包裹整块质感效果的div -->
		<div class="content_box">
			<div class="box_demo match_book">
				<h3>这些人有你想要的书：</h3>
				<table>
					<tbody>
					<tr>
						<th>姓名</th>
						<th>所在生活区</th>
						<th>拥有你需要的教材数</th>
					</tr>

					<?php
					if(empty($system_match['data']))
					{
						echo "
						<tr>
						<th colspan=3>暂时没找到哦！</th>
						</tr>";
					}else 
					foreach ($system_match['data'] as $user) 
						{
							echo 
							"<tr>
							<td><a href='".site_url('book_owner')."/".$user['uid']."'/>".$user['truename'].'</a></td>
							<td>'.$user['dormitory'].'</td>

							<td>'.count($user['book']).'本 <span class="hidden_list"> [查看]</span></td>
							</tr>';						
					?>				
							<tr class="book_list">
								<td colspan="3">
									<form action="<?php echo site_url('home/check_step');?>" method='post' >
									<input type="hidden" value="<?php echo $user['uid'];?>" name="user" />
									<ul>
									<?php
									foreach ($user['book'] as $book) 
									{
											echo "<li><label><input type='checkbox' value='".$book['book_id']."' name='book".$book['book_id']."' /><span></span>".$book['name']."</label></li>";
									}	
									?>
									</ul>
									<p class="book_list_bottom"><span class="select_all">全选</span><input type="submit" id="submit" value=""/></p>
									</form>
								</td>
							</tr>
					<?php }?>

					</tbody>
				</table>
				<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->

			</div>
			<div class="bottom_shadow"></div>
		</div><!-- end of content_box 包裹整块质感效果的div -->
	</div>
</div><!--end of main--> 
