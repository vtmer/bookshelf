<div class="main">
	<div class="search_bar">
		<input type="text" class="search_input" placeholder="请输入要查找的书目" />
		<input type="submit" class="search_submit" value=""/>
	</div>

	<div class="index">
		<ul>
			<li><a href="<?php echo site_url('my_book');?>" class="part_1"><span></span><p>我的书架</p></a></li>
			<li><a href="<?php echo site_url('home');?>" class="part_2"><span></span><p>我要借书</p></a></li>
			<li><a href="<?php echo site_url('add_book');?>" class="part_3"><span></span><p>我要捐书</p></a></li>
			<li><a href="<?php echo site_url('qa');?>" class="part_4"><span></span><p>F&A</p></a></li>
		</ul>
	</div>
	<div class="shelf_bg"><a href="<?php echo site_url('about');?>"></a></div>
</div>
