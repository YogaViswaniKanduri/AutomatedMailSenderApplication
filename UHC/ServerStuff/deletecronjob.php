<?php
/*=========================================
createcronjob.php

makes an entry to database
===========================================*/
require("database/database_auth.php");
	
	//session start
	session_start();
	
	$notification_arr = array();
	$notify = false;

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the GET values
	$automationid = clean($_GET['automationid']);
	$sqlQuery = "DELETE FROM ".$tb_automation_activity_log." WHERE automation_id='".$automationid."' ";
	$result = @mysql_query($sqlQuery);
	
	if($result)
	{
		$sqlQuery = "DELETE FROM ".$tb_automation_mail_history." WHERE automation_id='".$automationid."' ";
		$result = @mysql_query($sqlQuery);
		if($result)
		{
			echo "SUCCESS";
		}
		else
		{
			echo "FAILURE";
		}
	}
	else
	{
		echo "FAILURE";
	}
	
?>