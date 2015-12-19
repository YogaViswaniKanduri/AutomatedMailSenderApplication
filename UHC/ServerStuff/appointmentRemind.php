<?php
/*=========================================
appointmentRemind.php

Fetches email from database and trigger mails 
to the fetched list of records
===========================================*/
require("database/database_auth.php");
include "Mail.php";
include "Mail\mime.php";

	//session start
	session_start();
	
	//notification array
	$notification_arr = array();
	$notify = false;
	$status_msg ="";
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$remindertime = "";
	
	if(isset($_SESSION['AUTOMATION']))
	{
		if($_SESSION['AUTOMATION'])
		{
			$remindertime = 0;
		}
		else
		{
			$remindertime = clean($_POST['remindertime']);
		}
	}	
		
	$sqlQuery = ""; //sql Query in order to fetch email ids from database
	$email_To = array(); // array to store email recipients list
	$mail_category = "APPR";
	$date = "";
	$msg = $remindertime;
	
	if($remindertime==0) //appointment reminder for students whose visit is tomorrow
	{
		$date = date_create(date('Y').'-'.date('m').'-'.date('d'));
		date_add($date, date_interval_create_from_date_string('1 days')) ;
		$date = date_format( $date , 'Y-m-d');
		$sqlQuery = "SELECT distinct student_email FROM ".$tb_students_nextday_appointments." WHERE appointment_date='".$date."'";
	}
	else 
	if($remindertime==1) //appointment reminder for students whose visit is after 1week
	{
		$reminder_fromdate = clean($_POST['arfromday']);
		$reminder_frommonth = clean($_POST['arfrommonth']);		
		$reminder_fromyear = clean($_POST['arfromyear']);	
		$reminder_toyear = clean($_POST['artoyear']);	
		$reminder_todate = clean($_POST['artoday']);
		$reminder_tomonth = clean($_POST['artomonth']);		
		if($reminder_fromdate<=9)
		{
			$reminder_fromdate = "0".$reminder_fromdate;
		}
		if($reminder_todate<=9)
		{
			$reminder_todate = "0".$reminder_todate;
		}
		if($reminder_frommonth<=9)
		{
			$reminder_frommonth = "0".$reminder_frommonth;
		}
		if($reminder_tomonth<=9)
		{
			$reminder_tomonth = "0".$reminder_tomonth;
		}
		$mail_from_date = "'".$reminder_fromyear.$reminder_frommonth.$reminder_fromdate."'";
		$mail_to_date = "'".$reminder_toyear.$reminder_tomonth.$reminder_todate."'";
		$sqlQuery = "SELECT * FROM ".$tb_students_futureappointments." WHERE CONCAT('".$reminder_fromyear."',appointment_month,appointment_day)>=".$mail_from_date." AND CONCAT('".$reminder_toyear."',appointment_month,appointment_day)<=".$mail_to_date." AND student_email NOT IN (SELECT student_email from ".$tb_students_reminder_mail_history." WHERE mail_category='APPR' and mail_date=CURDATE())";
		
	}
	else if($remindertime==2) //appointment reminder for students whose visit is after 2weeks
	{
		$reminder_date = clean($_POST['apprday']);
		$reminder_month = clean($_POST['apprmonth']);
		$reminder_year = clean($_POST['appryear']);
		if($reminder_date<=9)
		{
			$reminder_date = "0".$reminder_date;
		}
		if($reminder_frommonth<=9)
		{
			$reminder_month = "0".$reminder_month;
		}
		$mail_date = "".$reminder_year."-".$reminder_month."-".$reminder_date."";
		$sqlQuery = "SELECT * FROM ".$tb_students_futureappointments." WHERE student_email NOT IN (SELECT student_email FROM ".$tb_students_reminder_mail_history." WHERE mail_date=CURDATE() AND mail_category='APPR' ) AND appointment_month=month('".$mail_date."') AND appointment_day=dayofmonth('".$mail_date."')";		
	}	
	
	$result = mysql_query($sqlQuery);
	$row = mysql_fetch_array($result);
	$student_id = array();
	$student_name = array();
	$mailerstatus = true;
	
	if($row)
	{
		do
		{
			$student_id[] = $row['student_id'];
			$student_name[] = $row['student_name'];
			$email_To[] = $row['student_email'];
		}while($row = mysql_fetch_array($result));
	}
	else
	{
		$mailerstatus = false;
		$notify = true;
		$_SESSION['err_status_flag'] = true;
		$notification_arr[] = 'Remind event failure. No appointments are present for your selection ';
		$status_msg = 'Remind event failure. No appointments are present for your selection ';
	}

	if($mailerstatus)
	{
		//Email Customization
		$subject = 'UHC : Friendly Appointment Reminder';//Email Subject
		$text = 'Appointment Reminder from University Health Centre';//email Text
		
		//email headers
		$headers = array( 
			'From' => $email_From, 
			'Subject' => $subject
			); 
		
		$crlf = "\r\n";
		$mime = new Mail_mime($crlf);//get mime mail object in order to set headers		
		
		$html = '
			<html>
			<head>
			<title>Feedback</title>
			</head>
			<body>
			<div style="width:700px;height:auto;background:#8AB800;">
			<div style="width:parent;height:10px;background:#33ADFF;"></div>
			<div style="width:parent;height:3px;background:#FFF;"></div>
			<div style="width:parent;height:15px;background:#33ADFF;"></div>
			<div style="width:parent;height:auto;padding-top:20px;padding-left:30px;padding-right:20px;line-height:30px;font-weight:15px;font-family:Times New Roman;padding-bottom:30px;text-align:justify;color:#FFC;">
			<p><font size="3"> Dear Student, </font></p>
			<p><font size="3">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			This is a friendly reminder of your upcoming appointment at the University Health Centre.
			 We hope to see you as scheduled. If however you cannot make it, please re-book your appointment once again.
			 Please note that we have a policy not to discuss any specific medical information over open email 
			 due to privacy concerns, and that our phone is answered during office hours.
			<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 Please also note that we do charge a modest fee for missed appointments, in order to recover our costs. If you have any 
			 further questions please call the University Health Centre.
			</font>
			</p>
			<p><font size="3">
			-<br>
			Regards<br>
			University Health Centre Community
			<br>
			<sub>PS: If you have received this message in error, please notify us immediately by email or by telephone</sub>
			</font>
			</p>
			</div>
			<div style="width:parent;height:30px;background:#33ADFF;padding-left:30px;color:#ffd;font-weight:15px;padding-top:10px;position:relative;">
			<b>UNIVERSITY HEALTH CENTRE </b>
			</div>
			<div style="width:parent;height:3px;background:#FFF;"></div>
			<div style="width:parent;height:10px;background:#33ADFF;"></div>
			</div>
			</body>
			</html>
		'; //html content in order to Email students	
	
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html); 

		$body = $mime->get();
		$headers = $mime->headers($headers);
		
		$smtp = Mail::factory('smtp',array ('host' => $host,'port' => $port,'auth' => true,'username' => $email_Username,'password' => $email_Password));
		$mail = $smtp->send($email_To, $headers, $body);
				
		if (PEAR::isError($mail)) {
			//echo( $mail->getMessage());
			$notify = true;
			$_SESSION['err_status_flag'] = true;
			$status_msg = $mail->getMessage();
			$notification_arr[] = $status_msg;
			
		}
		else {
			//echo "Shout Eureka!! Message Sent successfully !!!!";
			$notify = true;
			$query = "";
			$stat = false;
			$count = count($email_To);
			for($i=0;$i<$count;$i++)
			{
					$query = "INSERT INTO ".$tb_mail_history." VALUES(NULL, '".$student_id[$i]."', '".$student_name[$i]."', '".$email_To[$i]."', CURDATE(), '".$mail_category."', CURRENT_TIMESTAMP)";
					$result = @mysql_query($query);	
					if($result)
						$stat=true;
					else
						$stat=false;				
			}	
			if($stat)
			{
				$_SESSION['err_status_flag'] = false;
				$notification_arr[] = 'Reminder mails Sent Successfully';
			}
			else
			{
				$_SESSION['err_status_flag'] = true;
				$notification_arr[] = 'Reminder mails Sent Successfully. But insertion error in mail history';
			}
		}	
	}
	
	$log = array();
	if(isset($_SESSION['AUTOMATION']))
	{
		if($_SESSION['AUTOMATION'])
		{
			$notify = false;
			$time_msg = " at <script>document.write(Date())</script>";
			if(!isset($_SESSION['LOG']))
			{
				if($_SESSION['err_status_flag'])
				{
					$log[] = $status_msg;
				}
				else{
					$log[] = "Reminder mails sent successfully ".$time_msg;
				}
				$_SESSION['LOG'] = $log;
			}
			else
			{
				foreach($_SESSION['LOG'] as $msg)
				{
					$log[] = $msg;
				}
				if($_SESSION['err_status_flag'])
				{
					$log[] = $status_msg." ".$time_msg;
				}
				else{
					$log[] = "Reminder mails sent successfully ".$time_msg;
				}
				$_SESSION['LOG'] = $log;
			}
			
		}
	}
	
	
	if($notify) {		
		$_SESSION['APP_REMINDER'] = date('d');
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		header("location: breakout.php");
		exit();
	}
	else
	{
		echo 'Automation activity in progress. Reminder will be sent automatically';
			/*
		$_SESSION['APP_REMINDER'] = date('d');
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		header("location: ../index.php");
		exit();
		*/
	}
?>
