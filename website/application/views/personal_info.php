
<div class="main">
	<form action="<?php echo site_url('search'); ?>" method="get"> 
	<div class="search_bar">
	<input type="text" name="keywords" value="请输入要查找的书目" />
	<a href="#"><input type='submit' value='' /></a>
	</div>
	</form>
	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo personal_config">
				<form action="<?php echo site_url('home/personal_config');?>" method="post">
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
							<?php if($user[0]['dormitory']=='西区'):?>
							<label><input type="radio" value="西区" name="dormitory" checked="checked" class="qu"/>西区</label>
							<label><input type="radio" value="东区" name="dormitory" class="qu"/>东区</label>
							<?php else: ?>
							<label><input type="radio" value="西区" name="dormitory" class="qu"/>西区</label>
							<label><input type="radio" value="东区" name="dormitory"  checked="checked" class="qu"/>东区</label>
							<?php endif;?>
						</div>
					</label> 
					<label for="mail">邮箱：<input type="text" id="mail" name="username" value="<?php echo $user[0]['username'];?>"/></label>
					<a href="#" class="back_up"></a><input type="submit" value="好了，修改完了，保存吧！"/>好了，修改完了，保存吧！
				</div>
				</form>
				<div class="right">
					<ul>
						<li><?php echo $user[0]['truename'];?></li>
						<li class="gray"><?php echo $user[0]['faculty'];?></li>
						<li class="gray"><?php echo $user[0]['grade']."级 ".$user[0]['major'];?></li>
						<li>捐书：<?php echo $book_num[0][0]->lend_book;?>本</li>
						<li>借入：<?php echo $book_num[1][0]->borrow_book;?>本</li>
						<li>借出：<?php echo $book_num[2][0]->lend_out;?>本</li>
					</ul>
				</div>
				
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
