
<div class="main">
	<div class="mid_content">
	<form action="<?php echo site_url('home/receipt');?>" method ='POST'>
			<h3>借书流程</h3>
<!-- <p class="step_01"><span>1</span>搜索选择自己要借的书</p>
		<p class="dots"><span></span></p>
		<p class="dots"><span></span></p>
		<p class="dots"><span></span></p>
		<p class="step_02"><span>2</span>电话或者短信联系</p> -->
		<div class="content_box">

			<div class="box_demo">
				<div class="check_step"><div>
				<h5>书源人联系方式：</h5>
				<?php echo 
				"<p><span>书源人:".$user[0]['truename']."</span>
					<span>生活区：".$user[0]['dormitory']."</span>
					<span>长号：".$user[0]['phone_number']."</span>
					<span>短号：".$user[0]['subphone_number']."</span>
					<span>专业：".$user[0]['major']."</span>
				</p>";
				?>
				<span class="tips">温馨提示：注意休息时间不要打扰到人噢！</span>					
				</div></div>
				<div class="explain">
					<h5>请认真阅读以下说明<span>[收起]</span></h5>
					<p><span></span>如果预约成功，请在下表中勾选预约到的书籍，然后点击“是”</p>
					<p><span></span>如果预约失败（或没有即时得到捐书者回复），请点击“否”</p>
					<h6>是否预约到您的书</h6>
					<input type="submit" value="是" />
					<input type="submit" value="否" />
				</div>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->

		<div class="content_box">
			<div class="box_demo search_results">
				<h3>你所预约的书籍</h3>
				<table>
					<tbody>
						<tr>
							<th>书名</th>
							<th>课程名称</th>
							<th>作者</th>
							<!-- <th>发放对象</th> -->
							<th>出版社</th>
							<th>版次</th>
							<th>预约</th>
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
							<td><label><input type='checkbox' value='".$value['cb_id']."' name='".$value['cb_id']."' /><span></span></label></td>
							</tr>";
						}
						?>
					</tbody>
				</table>		
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div>
		
		<!-- <p class="dots"><span></span></p> -->
		<!-- <p class="dots"><span></span></p> -->
		<!-- <p class="step_03"><span>3</span>确定预约结果</p> -->
<!-- 		<div class="receipt">
			// <?php 
			// $hidden = array();
			// foreach ($books as $key => $value) 
			// {
				// $hidden = $hidden+array($key=>$value['book_id']);	
			// }
				// echo form_open('home/receipt','',$hidden);
				// echo form_hidden('from_id',$user[0]['id']);
			?>
			<input type="submit" class="receipt_succ" value="" />
			</form>
			<span>,or</span>
			<input type="submit" class="receipt_unsucc" value="" />
			
			<span>?</span>
			<p>tips:若有某一本书预约失败可在回执中取消</p> -->
		<!-- </div> -->
	</form>
	</div><!--end of mid_content-->
</div><!--end of main-->
<script type="text/javascript">
	$(".explain h5").bind("click",function () {
		if ($(this).next("p").css("display") == "none") {
			$(".explain h5 span").html("[收起]");
			$(".explain").children("p").slideDown();
		} else{
			$(".explain h5 span").html("[查看]");
			$(".explain").children("p").slideUp();
		};
	})
</script>