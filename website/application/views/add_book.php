<div class="main">
	
	<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo add_book">
			<form action="<?php echo site_url('add_book/add'); ?>" method="post">
				<div class="step1 now_step">
					<span>步骤1：输入ISBN码</span>
					<div class="step_box">
						<input type="text" value="请输入书籍的ISBN码" id="isbncode" name="isbncode"/>
						<a href="#" class="next_step" onclick="do_jsonp() ">下一步</a>
						<img src="<?php echo base_url('img/tip.jpg'); ?>" alt="ISBN码位于书籍背面标价处"/>
						</br></br><p>若书本为胶印，请直接忽略ISBN，直接点击下一步</p>
					</div>
				</div>
				<div class="step2">
					<span>步骤2：确认信息</span>
					<div class="step_box">
						<ul>
							书名:<input type="text" id="booktitle" name="booktitle" value=""/>
							<label id="isbn" name="isbn" value="" ></label></br>
							<!--作者:<ul id="author" value=""></ul>
							出版社:<input type="text" id="publish" name="publish" value="" />
							版次:<input type="text" id="version" name="version" value="" />
							课程名称:<input type="text" id="course_name" name="course_name" value="" />
							课程性质:
							<select name="course_type">
							<option value="班级课程" selected="selected">班级课程</option>
							<option value="公选课程">公选课程</option>
							</select>
							适用专业:<input type="text" id="major" name="major" value="" />
							适用年级:
							<select name="grade">
							<option value="one" selected="selected">大一</option>
							<option value="two">大二</option>
							<option value="three">大三</option>
							<option value="four">大四</option>
							</select>
							适用学期:
							<select name="term">
							<option value="one">第一学期</option>
							<option value="two">第二学期</option>
							</select>-->
							胶印:
							<select name="print">
							<option value="1">是</option>
							<option value="0" selected="selected">否</option>
							</select>
							<input type="submit" id="submit" value="确认"/> 
							<a href="<?php echo site_url('add_book'); ?>" class="next_step">下一步</a>
							<a href="#" class="prev">上一步</a>
						</ul>
					</div>
					</form>
				</div>
				<div class="step3">
					<span>步骤3：成功捐书</span>
					<div class="step_box">
						<p>您好，您已经成功捐出《xxx的那些事》</p>
						<a href="<?php echo site_url('home'); ?>" class="prev">返回首页</a>
						<a href="<?php echo site_url('add_book'); ?>" class="prev">继续捐书</a>
						<a href="my_book.html" class="bookshelf">前往我的书架</a>
					</div>		
				</div>

			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


