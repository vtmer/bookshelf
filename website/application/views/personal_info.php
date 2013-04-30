
<div class="main">
	<form action="<?php echo site_url('search'); ?>" method="POST"> 
	<div class="search_bar">
	<input type="text" name="keywords" value="请输入要查找的书目" />
	<a href="#"><input type='submit' value='' /></a>
	</div>
	</form>
	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo personal_config">
				<form action="<?php echo site_url('home/personal_config');?>" mehtod="POST">
				<div class="left">
					<label>用户名：<span><?php echo $user[0]['truename'];?></span></label>
					<label for="password">密码：<input type="password" name="pwd" id="password" /></label>
					<label for="password_once">确认密码：<input type="password" name="pwd2" id="password_once"/></label>
					<label for="college">学院：<input type="text" id="college" name="faculty" value="<?php echo $user[0]['faculty'];?>"/></label>
					<label for="major">专业：<input type="text" id="major" name="major" value="<?php echo $user[0]['major'];?>"/></label>
					<label for="grade">年级：<input type="text" id="grade" name="grade" value="<?php echo $user[0]['grade'];?>"/></label>
					<label for="phone">长号：<input type="text" id="phone" name="phone_number" value="<?php echo $user[0]['phone_number'];?>"/></label>
					<label for="mini_phone">短号：<input type="text" id="mini_phone" name="subphone_number" value="<?php echo $user[0]['subphone_number'];?>"/></label>
					<label>宿舍区：
						<div class="select_button">
							<label><input type="radio" value="西区" name="qu" checked="checked" class="qu"/>西区</label>

							<label><input type="radio" value="东区" name="qu" class="qu"/>东区</label>
						</div>
					</label> 
					<label for="mail">邮箱：<input type="text" id="mail" name="username" value="<?php echo $user[0]['username'];?>"/></label>
					<a href="#" class="back_up"><input type="submit" value="好了，修改完了，保存吧！"/>好了，修改完了，保存吧！</a>
				</div>
				</form>
				<div class="right">
					<ul>
						<li><?php echo $user[0]['truename'];?></li>
						<li class="gray"><?php echo $user[0]['faculty'];?></li>
						<li class="gray"><?php echo $user[0]['grade']."级 ".$user[0]['major'];?></li>
						<li>捐书：5本</li>
						<li>借入：n本</li>
						<li>借出：9本</li>
					</ul>
				</div>
				
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
