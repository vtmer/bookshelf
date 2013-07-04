<div class="main">
	
	<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>捐献书籍：</h3>
		<div class="content_box">
			<div class="box_demo add_book">
			<form action="<?php echo site_url('add_book/add'); ?>" method="post">
				<div class="step1 now_step">
					<p class="steps">步骤1：输入ISBN码或书名</p>
					<div class="step_box">
						<input type="text" autocomplete="off" placeholder="请输入书名或ISBN" id="isbncode" name="isbncode"  />
						<div class="suggestionsBox" id="suggestions" style="display: none;">
						<div class="suggestionList" id="autoSuggestionsList"></div>
						</div> 

						<a href="#" class="next_step" onclick="do_jsonp()">下一步</a>
						<img src="<?php echo base_url('img/tip.jpg'); ?>" alt="ISBN码位于书籍背面标价处"/>
						<p class="tips">ISBN码可在书籍背面左图标志处找到！<span>也可直接在输入框输入书名哦!</span></p>
					</div>
				</div>
				<div class="step2">
					<p class="steps">步骤2：确认信息</p>
					<div class="step_box">
						<label for="isbn">书名
							<input type="text" placeholder="书名不能为空哦！" id="booktitle" name="booktitle" />
							<span id="isbn" name="isbn" disabled ></span>
						</label>
						<label>胶印：
							<select name="print">
								<option value="0" selected="selected">否</option>
								<option value="1" >是</option>
							</select>
							<input type="submit" id="submit" value="确定" />
						</label>
						<p class="tips">若书籍是学校自己印的（胶印书）<span>请返回上一步直接在输入框输入书名即可！</span></p>
								<a href="#" class="prev">上一步</a>
					</div>
					</form>
				</div>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


