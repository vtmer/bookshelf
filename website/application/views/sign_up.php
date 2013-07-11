
<div class="main">
	<div class="mid_content">
		<!--<h3>个人信息设置：</h3>-->
		<div class="content_box">
			<div class="box_demo sign_info">
			<img src="<?php echo base_url('img/join_us.jpg'); ?>" alt="加入我们" class="join_us"/>
				<form action="<?php echo site_url('register/check'); ?>" method="post" class="">
					<label for="mail"><span>邮箱</span>
						<input type="text" id="mail" name="username"/>
						<span class="notice">填写常用邮箱以便验证</span>
					</label>
					<label for="password"><span>密码</span>
						<input type="password" id="password" name="pwd"/>
						<span></span>
					</label>
					<label for="password_confirm"><span>确认密码</span>
						<input type="password" id="password_confirm" name="pwd_confirm"/>
						<span></span>
					</label>
					<label for="name"><span>真实姓名</span>
						<input type="text" id="name" name="truename"/>
						<span></span>
					</label>
					<p class="notice">为了尊重并保障你和他人的利益，请填写真实姓名</p>
					<label for="stu_id"><span>学号</span>
						<input type="text" id="stu_id" name="student_id"/>
						<span></span>
					</label>
					<label><span>校区</span>
						<select id="campus" name="campus">
							<option data-base="0,9">大学城</option>
							<option data-base="10,12">龙洞</option>
							<option data-base="13,15">东风路</option>
						</select>
						<span></span>
					</label>
					<label><span>学院</span>
						<select id="college" name="college">
							<option data-base="-1">请选择学院</option>
						</select>
						<span></span>
					</label>
					<label><span>专业</span>
						<select id="major" name="major">
						</select>
						<span></span>
					</label>
					<label><span>年级</span>
						<select id="grade" name="grade">
						</select>
						<span></span>
					</label>
					<label for="phone"><span>长号</span>
						<input type="text" id="phone" name="phone_num"/>
						<span></span>
					</label>
					<label for="mini_phone"><span>短号</span>
						<input type="text" id="mini_phone" name="subphone_num"/>
						<span class="notice">若无短号，可不填写</span>
					</label>
					<label><span>生活区</span>
						<div class="select_button">
							<label><input type="radio" value="西区" checked="checked" class="qu" name="dormitory"/>西区</label>
							<label><input type="radio" value="东区" class="qu" name="dormitory"/>东区</label>
						</div>
					</label>
					<p class="notice">以上内容皆为必填项，为了保障良好的借书环境，请认真阅读填写.</p>
					<label for="captcha"><span>验证码</span>
						<input type="text" id="captcha" name="captcha"/>
						<span></span>
					</label>
					<label><img src="<?php echo site_url('captcha');?>" onclick="reloadCode();" id="checkCodeImg" alt="换一张"/><a href="javascript:reloadCode();">  换一张</a></label>
					<input type="submit" class="config_submit" value="注册" />
				</form>
				<?php if(isset($error)): ?>
				<div class="alert_mail_once">
 					<strong>抱歉！你所注册的邮箱已被使用，请你使用新的邮箱注册！</strong>
				</div>
				<?php endif;?>
			</div>
			<div class="bottom_shadow"></div><!-- 块级区域下方的底层阴影 -->
		</div><!-- 包裹整块质感效果的div -->
	</div>
</div><!--end of main-->
<script type="text/javascript">
/*
$(document).ready(function(){
	 $("#mail").focusout(function() {
	 	$.get(document.URL+"/ajax_check",{mail:this.value,t:Math.random()},function(data){
	 		var	jsonData =  eval('(' + data + ')');
			  $("input#mail + span").addClass("notice alert").text(jsonData.content);
			});
	});
 });
*/
</script>
