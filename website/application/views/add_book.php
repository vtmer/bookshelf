<div class="main">
	
	<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo add_book">
			<form action="<?php echo site_url('add_book/add'); ?>" method="post">
				<div class="step1 now_step">
					<p class="steps">步骤1：输入ISBN码</p>
					<div class="step_box">
						<input type="text" placeholder="请输入书籍的ISBN码" id="isbncode" name="isbncode"/>
						<a href="#" class="next_step" onclick="do_jsonp() ">下一步</a>
						<img src="<?php echo base_url('img/tip.jpg'); ?>" alt="ISBN码位于书籍背面标价处"/>
						<p class="tips">ISBN码可在书籍背面左图标志处找到！<span>若无ISBN码，可直接点击下一步进行捐书。</span></p>
					</div>
				</div>
				<div class="step2">
					<p class="steps">步骤2：确认信息</p>
					<div class="step_box">
						<label for="isbn">书名
							<input type="text" value="" placeholder="若为学校自印书籍，请直接输入书名" id="booktitle" name="booktitle" disabled/>
							<span id="isbn" value=""></span>
						</label>
						<label>胶印：
							<select name="print">
								<option value="0" selected="selected">否</option>
								<option value="1" >是</option>
							</select>
							<input type="submit" id="submit" value="确定" />
						</label>
								<a href="#" class="prev">上一步</a>
					</div>
					</form>
				</div>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


