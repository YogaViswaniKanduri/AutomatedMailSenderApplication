<?php
require('database.php');

//connect to mysql database server
$con = mysql_connect($db_server, $db_login, $db_password);
if (!$con)
{
	die('Failed to connect to server: ' . mysql_error());
}

//connect to mysql database
$db = mysql_select_db($db_uhc, $con);
if(!$db)
{
	die("Unable to select database");
}
?>