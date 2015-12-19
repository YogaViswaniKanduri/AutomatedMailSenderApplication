<?php
/*=========================================
sendBirthdayWishes.php

Fetches email from database and trigger mails 
to the fetched list of records
===========================================*/
require("database/database.php");
require ("Services/Twilio.php");

	//session start
	session_start();
	
	//notification array
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
	
	//Sanitize the POST values
	$sms_To = clean($_POST['msgNumber']);
	$sms_Text = clean($_POST['msgText']);
	
	$sms_Text = $sms_Text.' From University Health Centre';
	
	try{
		// Instantiate a new Twilio Rest Client
		$client = new Services_Twilio($sms_AccountSid, $sms_AuthToken);
		
		// Send a new outgoing SMS 
		$client->account->sms_messages->create($sms_From, $sms_To, $sms_Text);
		
		$_SESSION['err_status_flag'] = false;
		$notify = true;
		$notification_arr[] = 'Message sent Successfully. Will reach '. $sms_To . ' shortly';
	}
	catch(Exception $e) {
	  $_SESSION['err_status_flag'] = true;
	  $notify = true;
	  $notification_arr[] = substr($e->getMessage(),0,120);
	}	
	
	if($notify) {		
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		header("location: ../index.php");
		exit();
	}
?>