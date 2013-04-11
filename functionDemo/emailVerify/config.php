<?php
error_reporting(E_ALL & ~E_NOTICE);
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';

header('content-type:text/html; charset=gbk');
mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);
mysql_query("SET NAMES GBk");
?>