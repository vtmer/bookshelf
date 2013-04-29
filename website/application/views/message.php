<div class="main">
	<div class="search_bar">
		<input type="text" value="请输入要查找的书目" />
		<a href="search.html"></a>
	</div>
	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo message">
				<h5><span>状态</span><span>标题</span><span>时间</span></h5>

				<?php foreach($messages as $row):?>
				<div class="message_box">
				<h5><span class="readed"><?php if($row['status']=='0') echo "未读";else echo "已读";?></span><span><?php echo $row['title'];?></span><span><?php echo $row['create_time'];?></span></h5>
					<div class="message_contant">
					<p><?php echo $row['content'];?><p>
						<span class="hide"></span>
						<!--<input type="image" src="<?php echo base_url('img/cancle.png'); ?>"/>
						<input type="image" src="<?php echo base_url('img/confirm.png'); ?>" class="confirm"/>-->
					</div>
				</div>
				<?php endforeach;?>

			<!--	<div class="message_box">
					<h5><span class="readed">未读</span><span>xxx找你哇！</span><span>12.07.15</span></h5>
					<div class="message_contant">
						<p>你好，欢迎加入 工大书架 ，这是一个致力于让广工的同学们快捷放心的借到教材书的平台。</p>
						<p>在这里，你可以轻松查看自己下学期所需要的的教材，然后系统会主动向您推送适合的借书人。当然，你还可以直接搜索教材名称，找到自己想要的教材，然后进行借书。</p>
						<p>同时，为了让更多的同学可以借到想要的书，请您将自己手头多余或者不需要的教材进行网上捐书，你所捐的书将为我们广工学子们共同所有，在一届一届中交接下去，你更可以在书籍中夹入自己的心语、对学习的建议，让更多的师弟师妹能够感受到我们广工师兄师姐的关怀和我们广工人之间的团结互助。而且，如果你觉得 工大书架 的确可以帮助到学生解决问题，请将它进行推广，只有更多的人加入进来，我们借书的渠道和数量才会更加宽广，同学们借书才会更加轻松和保障。或者，如果你对我们有什么建议，请在网页下方点击留言，联系我们。</p>
						<p>感谢你对本书架的支持，希望你可以愉快地借到所需要的教材！</p>
						<span class="hide"></span>
						<input type="image" src="img/cancle.png"/>
						<input type="image" src="img/confirm.png" class="confirm"/>
					</div>
				</div>-->

				<ul class="pages">
					<li class="prev"><a href='<?php echo site_url('message/index')."/".($page['prevpage']);?>'></a></li>
					<?php for ($i=1; $i <= $page['num']; $i++) 
					{ 
						if($i==$page['currentpage'])
						{
							echo "<li class='page on_select'><a href='".site_url('message/index')."/$i'></a></li>";
						}
						else
						{
							echo "<li class='page'><a href='".site_url('message/index')."/$i'></a></li>";
						}
					}
					?>
					<li class="next"><a href="<?php echo site_url('message/index').'/'.($page['nextpage']);?>"></a></li>


			<!--	<ul class="pages">
					<li class="prev"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="page on_select"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="page"><a href=""></a></li>
					<li class="next"><a href=""></a></li>  -->
				</ul>
			</div>

			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


