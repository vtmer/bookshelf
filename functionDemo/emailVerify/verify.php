
<?php
require('config.php');

$queryString = $_SERVER['QUERY_STRING'];
$query = "SELECT * FROM users";
$result = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($result))
{	
	if ($queryString == $row["activationkey"])
	{		
		echo "Congratulations!" . $row["username"] . " is now the proud new owner of a chile.com account.";
		$sql="UPDATE users SET activationkey = '', status='activated' WHERE (id = $row[id])";
		if (!mysql_query($sql)) 
		{
			die('Error: ' . mysql_error());
		}
	// 到这里，用户已经完全激活了账号，可以将页面跳转到登陆后的界面了
	}
} // end of while
?>