<?php if($type=='add_succ') :?>
<!-- 捐书成功 -->
<div class="main">
	<div class="mid_content juan_v">
		<h3>捐书结果</h3>
		<div class="content_box">
			<div class="box_demo">	
				<div>
					<p>恭喜您捐书成功</p>
					<?php if(!empty($points)) :?>		
					<span>您本次捐书获得积分：<?php echo $points;?></span>
					<?php endif;?>
				</div>

				<a href="<?php echo site_url('my_book');?>">到您的书架看看吧！</a>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->		
	</div><!--end of mid_content-->
</div><!--end of main-->

<?php elseif($type=='add_fail') :?>
<!-- 捐书失败 -->
<div class="main">
	<div class="mid_content juan_lose">
		<h3>捐书结果</h3>
		<div class="content_box">
			<div class="box_demo">	
				<p>抱歉！由于服务器问题，本次捐书失败。</p>		
				<a href="<?php echo site_url('add_book');?>">5秒后自动跳转...</a>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->		
	</div><!--end of mid_content-->
</div><!--end of main-->


<?php elseif($type=='borrow_succ') :?>
<!-- 预约成功 -->
<div class="main">
	<div class="mid_content yue_v">
		<h3>预约结果</h3>
		<div class="content_box">
			<div class="box_demo">	
				<div>
					<p>恭喜您预约成功</p>		
				</div>
					<strong>注意：请在收到书后回到工大书架确认借书成功</strong>

				<a href="<?php echo site_url('home');?>">5秒后自动跳转...</a>
				<script type='text/javascript'>setTimeout("window.location.href='/index.php/home'",5000);</script>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->		
	</div><!--end of mid_content-->
</div><!--end of main-->

<?php elseif($type=='borrow_fail') :?>
<!-- 预约失败 -->
<div class="main">
	<div class="mid_content yue_lose">
		<h3>预约结果</h3>
		<div class="content_box">
			<div class="box_demo">	
				<p>没预约到？没关系，再找找其他师兄师姐吧.</p>		
				<a href="<?php echo site_url('home');?>">5秒后自动跳转...</a>
				<script type='text/javascript'>setTimeout("window.location.href='/index.php/home'",5000);</script>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->		
	</div><!--end of mid_content-->
</div><!--end of main-->

<?php endif; ?>

