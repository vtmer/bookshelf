<div class="main">	
	<div class="mid_content">
		<div class="content_box">
			<div class="box_demo about">
				<h1>关于工大书架</h1>
				<div class="about_info">
					<p>【工大书架】，这是一个致力于让广工的同学们快捷放心地借到教材书的平台。</p>
	       			<p>在这里，你可以轻松查看自己下学期所需要的的教材和系统向您推送适合的书源人。当然，你还可以直接搜索教材名称，找到自己想要的教材，然后进行借阅。</p>
	        		<p>同时，您还可以将自己手头多余或者不需要的教材进行网上捐书。你所捐的书将为我们广工学子们共同所有，在一届一届中交接下去，你更可以在书籍中夹入自己的心语、对学习的建议，让更多的师弟师妹能够感受到我们广工师兄师姐的关怀和我们广工人之间的团结互助。</p>
	        		<p>如果你觉得 【工大书架】 的确可以帮助到学生解决问题，你可以分享给身边好友，让更多的人参与，我们借书的渠道和数量会更加宽广，同学们借书会更加轻松和保障。</p>
	        		<br/>
	       			<p>再次感谢您对本书架的支持！</p>					
				</div>
				<div id="border"><div></div></div>
				<div class="feed_back">	
					<p>我们诚意聆听您的声音</p>
					<form action="<?php echo site_url('about/submit');?>" method='post' class='ajaxForm'>
						<label for="mail">您的邮箱：<input type="text" id="mail" name='email' value="<?php echo $email;?>"/><span></span></label>
						<label for="fb_title">标题：<input type="text" id="fb_title" name='fb_title'/><span></span></label>
						<label for="fb_content">内容：<textarea name="fb_content" id="fb_content" cols="30" rows="10"></textarea><span></span></label>
						<input type="submit" id="submit" value="提 交"/>
					</form>
				</div>


			</div>
			<div class="bottom_shadow"></div>
		</div><!-- end of content_box 包裹整块质感效果的div -->
	</div>
</div><!--end of main--> 
