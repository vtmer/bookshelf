
<div class="main">
	
	<?php include "template/search_bar.php"; ?>
<script language="javascript" src="<?php echo base_url('js/mailauto.js');?>"></script>
<script language="javascript" src="<?php echo base_url('js/sign_up.js');?>"></script>


	<div class="mid_content">
		<h3>个人信息设置：</h3>
		<div class="content_box">
			<div class="box_demo personal_config">
				<form action="<?php echo site_url('home/personal_config');?>" method="post" class="ajaxForm">
				<div class="left">
				<div><!--用于边框-->
					<label>用户名：<span class="user_name"><?php echo $user[0]['truename'];?></span></label>
		
<!-- 					<input type="button" class="config_submit" value="修改密码" id="config_pwd"/>
					<div id="div_pwd" class="div_pwd">
						<label for="pwd_old">旧密码：<input type="password" name="pwd_old" id="pwd_old"/><span></span></label>
					<label for="password">新密码：<input type="password" name="pwd" id="password" /><span></span></label>
					<label for="password_once">确认密码：<input type="password" name="pwd2" id="password_once"/><span></span></label>
					<input type="button" class="config_submit" value="取消" id="cancle_pwd"/>
					</div> -->
					<label for="college">学院：<span class="user_name" ><?php echo $user[0]['faculty'];?></span></label>
					<label for="major" id="major">专业：<span class="user_name"   ><?php echo $user[0]['major'];?></span></label>
					<label for="grade">年级：<span class="user_name"  ><?php echo $user[0]['grade'];?></span></label>
					<label for="mail">邮箱：<input type="text" id="mail" name="mail" autocomplete="off" value="<?php echo $user[0]['username'];?>"/><span></span></label>
					<label for="phone">长号：<input type="text" id="phone" name="phone_number" value="<?php echo $user[0]['phone_number'];?>"/><span></span></label>
					<label for="mini_phone">短号：<input type="text" id="mini_phone" name="subphone_number" value="<?php echo $user[0]['subphone_number'];?>"/><span></span></label>
					<label>宿舍区：
						<div class="select_button">
							<?php if($user[0]['dormitory']=='西区'):?>
							<label><input type="radio" value="西区" name="dormitory" checked="checked" class="qu"/>西区</label>
							<label><input type="radio" value="东区" name="dormitory" class="qu"/>东区</label>
							<?php elseif($user[0]['dormitory']=='东区'): ?>
							<label><input type="radio" value="西区" name="dormitory" class="qu"/>西区</label>
							<label><input type="radio" value="东区" name="dormitory"  checked="checked" class="qu"/>东区</label>
							<?php elseif($user[0]['dormitory']=='东风路'): ?>
                            <span class="user_name"><?php echo $user[0]['dormitory']; ?></span>
                            <?php elseif($user[0]['dormitory']=='龙洞'): ?>
                            <span class="user_name"><?php echo $user[0]['dormitory']; ?></span>
							<?php endif;?>
						</div>
					</label>

					<input type="submit" class="config_submit" value="保存" />
				</div>
				</div>
				</form>
				<div class="right">
					<ul>
						<li><h5>您的书架记录</h5></li>
						<!-- <li><?php echo $user[0]['truename'];?></li> -->
						<!-- <li class="gray"><?php echo $user[0]['faculty'];?></li> -->
						<!-- <li class="gray"><?php echo $user[0]['grade']."级 ".$user[0]['major'];?></li> -->
						<li>捐书：<?php echo $book_num[0][0];?>本</li>
						<li>借入：<?php echo $book_num[1][0];?>本</li>
						<li>借出：<?php echo $book_num[2][0];?>本</li>
						<li>积分：<?php echo $this->user_model->show_user_point($this->session->userdata('points')); ?></li>
						<li><a href="<?php echo site_url('QA');?>" title="Q&A">查看积分规则</a></li>
						<!-- <li>分享度：<?php echo $user['share'];?>%</li> -->
					</ul>
				</div>
				
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
