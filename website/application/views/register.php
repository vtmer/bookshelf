<html>
<body>
<p>register</p>
<form action="<?=site_url('register/check'); ?>" method="post">
username:<input type="text" id="username" value="username" /></br>
password:<input type="password" id="pwd1" value="" /></br>
password:<input type="password" id="pwd2" value="" /></br>
truename:<input type="truename" id="truename" value="" /></br>

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

phone_num:<input type="text" id="phone_num" value="phone_num" /></br>
subphone_num:<input type="text" id="subphone_num" value="subphone_num" /></br>

<select name="dormitory">
	<option value="east">east</option>
	<option value="west">west</option>
</select></br>
</form>
</body>
</html>
