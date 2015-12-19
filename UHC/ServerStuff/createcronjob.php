<?php
/*=========================================
createcronjob.php

makes an entry to database
===========================================*/
require("database/database_auth.php");

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the GET values
	$automationname = clean($_GET['automationname']);
	$automationdays = clean($_GET['automationdays']);
	$automationmailstate = clean($_GET['automationmailstate']);
	$automationmailtime = clean($_GET['automationmailtime']);
	$autofromday = clean($_GET['autofromday']);
	$autofrommonth = clean($_GET['autofrommonth']);
	$autofromyear = clean($_GET['autofromyear']);
	$autotoday = clean($_GET['autotoday']);
	$autotomonth = clean($_GET['autotomonth']);
	$autotoyear = clean($_GET['autotoyear']);
	
	if($automationname==0)
	{
		$automationname = "Appointment_Reminder";
	}
	else if($automationname==1)
	{
		$automationname = "Advance_Birthday_Wishes";
	}
	else if($automationname==2)
	{
		$automationname = "Birthday_Wishes";
	}
	
	if($automationmailstate==0)
	{
		$automationmailstate = "daily once";
	}
	else if($automationmailstate==1)
	{
		$automationmailstate = "only once";
	}	
	
	$automation_mailfromdate = $autofromyear."-".$autofrommonth."-".$autofromday;
	$automation_mailtodate = $autotoyear."-".$autotomonth."-".$autotoday;
	
	$sqlQuery = "INSERT INTO ".$tb_automation_mail_history." VALUES( NULL, '".$automationname."','".$automationdays."','".$automationmailstate."','".$automationmailtime."','".$automation_mailfromdate."','".$automation_mailtodate."', '0', CURRENT_TIMESTAMP)";
	$result = @mysql_query($sqlQuery);
		
	if($result)
	{
		echo '<font style="color:#090">Cron job created successfully.</font>';
	}
	else
	{
		echo '<font style="color:#900">Oops! Something went wrong. Please re-create job / create new job with different criteria.</font>';
	}
?>