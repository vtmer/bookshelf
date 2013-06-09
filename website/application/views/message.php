<div class="main">
	
	<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo message">
				<h5><span>状态</span><span>标题</span><span>时间</span></h5>

				<?php foreach($messages as $row):?>
				<div class="message_box">
				<h5><span class="readed"><?php if($row['status']=='0') echo "未读";else echo "已读";?></span><span><?php echo $row['title'];?></span><span><?php echo $row['create_time'];?></span></h5>
					<div class="message_contant">
						<form action='<?php echo site_url('message/confirm');?>' method='post' class='ajaxForm'>
						<input type="hidden" name="message_id" value="<?php echo $row['id'];?>" />
						<p><?php echo $row['content'];?></p>
						<input type='submit' value='确认' class='ok_submit'/></form>
						<span class="hide"></span>
						<!--<input type="image" src="<?php echo base_url('img/cancle.png'); ?>"/>
						<input type="image" src="<?php echo base_url('img/confirm.png'); ?>" class="confirm"/>-->
					</div>
				</div>
				<?php endforeach;?>


				<a href="<?php echo site_url('home');?>" class="home_page">返回</a>
				<?php echo $this->pagination->create_links();?><!-- 输出分页模块 -->

			</div>

			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


