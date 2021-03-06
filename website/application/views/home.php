<div class="main">
	
<?php include "template/search_bar.php"; ?>
	
	<div class="mid_content">
		<div class="content_box">
			<div class="box_demo needed_book">
				<h3>您本学期需要借的教材有：</h3>
				<p><span>专业：<?php echo $this->user_model->major_name().'专业  '.$this->session->userdata['grade'].'级  ';
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
			<div class="box_demo match_box">
				<h3>这些人有你想要的书：</h3>
				<div>
				<h5>
					<span>姓名</span>
					<span>所在生活区</span>
					<span>拥有你需要的教材数</span>
				</h5>
				<?php
				if(empty($system_match['data'][0]['book']))
				{
					echo 
					"<div class='match_list'><h5>暂时没找到哦！</h5></div>";
				}else 
				foreach ($system_match['data'] as $user) 
					{
					echo 
					"<div class='match_list'>
						<h5>
						<span><a href='".site_url('book_owner')."/".$user['uid']."'>".substr($user['truename'],0,3).'同学</a></span>
						<span>'.$user['dormitory'].'</span>
						<span>'.count($user['book']).'本 <strong class="chakan"> [查看]</strong></span>
						</h5>';						
				?>				
						<div class="match_book">
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
								<p class="book_list_bottom"><span class="select_all">全选</span><input type="submit" id="submit" value="借 阅"/></p>
							</form>
						</div>
					</div>
				<?php }?>
			</div>

				<p class="tips"> </p>
				<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->

			</div>
			<div class="bottom_shadow"></div>
		</div><!-- end of content_box 包裹整块质感效果的div -->
	</div>
</div><!--end of main--> 
