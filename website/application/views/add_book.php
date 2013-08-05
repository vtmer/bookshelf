<div class="main">
	
	<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>捐献书籍：</h3>
		<div class="content_box">
			<div class="box_demo add_book">
				<div class="inpart">
					<div>
					<p class="">我要捐书</p>
					<form action="<?php echo site_url('add_book/add');?>" method='POST'>

						<div class="sub_search">
							<input id="isbncode" type="text" autocomplete="off" placeholder=" 请输入ISBN码或书名" />
							<div id="suggest_box">
								<!-- 这里是搜索框匹配的模板，每一本书对应一个li -->
								<ul>
									<!-- <li><a href="#" title="书名"><img src="../img/tip.jpg" alt="#"></a></li> -->
								</ul>
							</div>		
						</div>
					<ul class="sele_book">
						<!--这是选择书本之后，搜索框上面显示的模板，没一本书对应一个li -->
						<!-- <li>
							<div><img src="#" alt="#" /></div>
							<ul>
								<li>书 名：<span>阿三大姐夫上课了</span></li>
								<li>作 者：<span>第三款</span></li>
								<li>出版社：<span>释迦佛阿斯顿发</span></li>
								<li>版次：<span>d1123</span></li>
							</ul>
							<a href="#">[删除]</a>
						</li>	 -->
					</ul>
						<input type="submit" id="submit" value="提 交" />
					</form>
					</div>
				</div>

				<div class="tip_box">
					<h5>什么是ISBN码？</h5>
					<p class="tips">ISBN码可在书籍背面如下标志处找到！
						<span>若无ISBN码，也可直接输入书名。</span>
					</p>
					<img src="<?php echo base_url('img/tip.jpg'); ?>" alt="ISBN码位于书籍背面标价处" />
				</div>
			</div>

			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


