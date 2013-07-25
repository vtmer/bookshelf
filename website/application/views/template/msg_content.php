
<?php if($type == 1): ?><!-- 模板3 预约成功 给捐书人-->
<strong><?php echo substr($to_user[0]['truename'],0,3);?>同学：</strong>
<p><strong><?php echo $from_user[0]['major'].'专业-'.$from_user[0]['grade'].'级-'.substr($from_user[0]['truename'],0,3);?>同学</strong>已成功向您预约了以下书籍：</p>
<ul class="b_list">
	<?php foreach ($book as $key => $value) :?>
		<li>《<?php echo $value['book_name'];?>》</li>
		<input type='hidden' name="<?php echo $value['book_id'];?>" value="<?php echo $value['cb_id'];?>"/>									
	<?php endforeach; ?>
</ul>

<?php elseif($type == 2): ?><!-- 模板3 预约成功 给借书人-->
<strong><?php echo substr($from_user[0]['truename'],0,3);?>同学：</strong>
<p>您已成功向<strong><?php echo $to_user[0]['major'].'专业-'.$to_user[0]['grade'].'级-'.substr($to_user[0]['truename'],0,3);?>同学</strong>预约了以下书籍:</p>
<ul class="b_list">
	<?php foreach ($book as $key => $value) :?>
	<li>《<?php echo $value['book_name'];?>》</li>
	<input type='hidden' name="<?php echo $value['book_id'];?>" value="<?php echo $value['cb_id'];?>"/>							
	<?php endforeach; ?>
</ul>

<?php elseif($type == 3): ?>
<!-- 模板4 预约失败，给捐书人的 -->
	<strong><?php echo substr($to_user[0]['truename'],0,3);?>同学：</strong>
	<p>很遗憾，<strong><?php echo $from_user[0]['major'].'专业-'.$from_user[0]['grade'].'级-'.substr($from_user[0]['truename'],0,3);?>同学</strong>无法成功借阅您的书籍，原因是？</p>
	<ul class="fail_reason">
		<li><label for=""><input type="radio" value="1" name='reason' checked/>没联系上我呢，我可以重新借书他/她</label></li>
		<li><label for=""><input type="radio" value="2" name='reason'/>还需要使用，不想借出</label></li>
		<li><label for=""><input type="radio" value="3" name='reason'/>书本遗失/已借给他人</label></li>
	</ul>			
<?php endif ;?>