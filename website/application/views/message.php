<div class="main">
	
	<?php include "template/search_bar.php"; ?>

	<div class="mid_content">
		<h3>我的短消息：</h3>
		<div class="content_box">
			<div class="box_demo message">
				<h5><span>状态</span><span>标题</span><span>时间</span><span>操作</span></h5>

				<?php
				 foreach($messages as $row):?>
				<div class="message_box">
				<?php if($row['status']=='0') echo "<h5 class='unread'><span class='readed'>未读";else echo "<h5><span class='readed'>已读";?></span><span class="msg_title"><?php echo $row['title'];?></span><span><?php echo $row['create_time'];?></span>

					<a href="<?php echo site_url('message/del_msg')."/".$row['id'];?>" class="del_message">[删除]</a>

					</h5>
					<div class="message_content">
						<form action='<?php echo site_url('message/confirm');?>' method='post' class='ajaxForm'>
						<input type="hidden" name="message_id" value="<?php echo $row['id'];?>" />
						<?php echo $row['content'];?>
						<!-- <input type='submit' value='确认' class='ok_submit'/></form> -->
						<!-- <span class="hide"></span> -->
						<!--<input type="image" src="<?php echo base_url('img/cancle.png'); ?>"/>
						<input type="image" src="<?php echo base_url('img/confirm.png'); ?>" class="confirm"/>-->
						</form>
					</div>
				</div>
				<?php endforeach;?>

				<!-- 模板1 即欢迎信，在controller/register.php 已有 -->

				<!-- 模板2 即预约成功后，发给捐书人的信息-->
				<div class="message_box">
				<h5 class='unread'><span class='readed'>未读</span><span class="msg_title">something</span><span>2012/12/12</span>
					<a href="" class="del_message">[删除]</a>
				</h5>
					<div class="message_content">
						<form action='' method='post' class='ajaxForm'>
						<input type="hidden" name="message_id" value="" />
						<strong>xx同学：</strong>
						<p><strong>xx专业xx级xx同学</strong>已成功向您预约一下书籍：</p>
						<ul class="b_list">
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
						</ul>
						<p>若已于<strong>线下</strong>成功借出书籍，请点击<strong>"完成"</strong>按钮，完成借书流程。</p>
						<span class="hide"></span>
						<input type="button" value="完成" />
						</form>
					</div>
				</div>

				<!-- 模板3 预约成功 给借书人-->
				<div class="message_box">
				<h5 class='unread'><span class='readed'>未读</span><span class="msg_title">something</span><span>2012/12/12</span>
					<a href="" class="del_message">[删除]</a>
				</h5>
					<div class="message_content">
						<form action='' method='post' class='ajaxForm'>
						<input type="hidden" name="message_id" value="" />
						<strong>xx同学：</strong>
						<p>您已成功向<strong>xx专业xx级xx同学</strong>预约了一下书籍:</p>
						<ul class="b_list">
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
							<li>《somethingsomething》</li>
						</ul>
						<p>若您已于<strong>线下</strong>成功拿到书籍，请点击<strong>"完成"</strong>按钮，完成借书流程。</p>
						<span class="hide"></span>
						<input type="button" value="完成" />
						</form>
					</div>
				</div>

				<!-- 模板4 预约失败，给捐书人的 -->
				<div class="message_box">
				<h5 class='unread'><span class='readed'>未读</span><span class="msg_title">something</span><span>2012/12/12</span>
					<a href="" class="del_message">[删除]</a>
				</h5>
					<div class="message_content">
						<form action='' method='post' class='ajaxForm'>
						<input type="hidden" name="message_id" value="" />
						<strong>xx同学：</strong>
						<p>很遗憾，<strong>xx专业xx级xx同学</strong>无法成功借阅您的书籍，原因是？</p>
						<ul class="fail_reason">
							<li><label for=""><input type="radio" value="1" name='reason'/>没联系上我呢，我可以重新借书他/她</label></li>
							<li><label for=""><input type="radio" value="2" name='reason'/>还需要使用，不想借出</label></li>
							<li><label for=""><input type="radio" value="3" name='reason'/>书本遗失/已借给他人</label></li>
						</ul>
						<span class="hide"></span>
						<input type="submit" value="确认" />
						</form>
					</div>
				</div>


				<!-- <a href="<?php echo site_url('home');?>" class="home_page">返回</a> -->
				<!--<?php echo $this->pagination->create_links();?>--><!-- 输出分页模块 -->

			</div>

			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->


