<html>
<body>
<p>register</p>
<form action="<?=site_url('register/check'); ?>" method="post">
username:<input type="text" name="username" value="" /></br>
password:<input type="password" name="pwd1" value="" /></br>
password:<input type="password" name="pwd2" value="" /></br>
truename:<input type="truename" name="truename" value="" /></br>
student-id<input type="text" name="student_id" value="" /></br>
phone_num:<input type="text" name="phone_num" value="" /></br>
subphone_num:<input type="text" name="subphone_num" value="" /></br> 
phone:<input type="text" name="phone" /></br>

<select name="faculty">
	<option value="1" selected="selected">one</option>
	<option value="2">two</option>
	<option value="3">three</option>
</select></br>

<select name="major">
	<option value="1" selected="selected">xxx</option>
	<option value="2">ccc</option>
	<option value="3">vvvv</option>
	<option value="4">daf</option>
</select></br>

<select name="grade">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
</select></br>




<select name="dormitory">
	<option value="east">east</option>
	<option value="west">west</option>
</select></br>
<input type="submit" value="提交" />
</form>
</body>
</html>
