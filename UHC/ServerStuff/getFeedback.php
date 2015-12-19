<?php
/*=========================================
getFeedback.php

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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$feedbackOn = clean($_POST['feedbackVisitedOn']);
		
	$sqlQuery = ""; //sql Query in order to fetch email ids from database
	$email_To = array(); // array to store email recipients list
	$mail_category = "FBM";
	
	if($feedbackOn==1) 
	{
		$feedback_fromdate = clean($_POST['fbfromday']);
		$feedback_frommonth = clean($_POST['fbfrommonth']);		
		$feedback_fromyear = clean($_POST['fbfromyear']);	
		$feedback_toyear = clean($_POST['fbtoyear']);	
		$feedback_todate = clean($_POST['fbtoday']);
		$feedback_tomonth = clean($_POST['fbtomonth']);		
		if($feedback_fromdate<=9)
		{
			$feedback_fromdate = "0"+$feedback_fromdate;
		}
		if($feedback_todate<=9)
		{
			$feedback_todate = "0"+$feedback_todate;
		}
		if($feedback_frommonth<=9)
		{
			$feedback_frommonth = "0"+$feedback_frommonth;
		}
		if($feedback_tomonth<=9)
		{
			$feedback_tomonth = "0"+$feedback_tomonth;
		}
		$mail_from_date = "'".$feedback_fromyear.$feedback_frommonth.$feedback_fromdate."'";
		$mail_to_date = "'".$feedback_toyear.$feedback_tomonth.$feedback_todate."'";
		$sqlQuery = "SELECT * FROM ".$tb_students_finishedappointments." WHERE CONCAT('".$feedback_fromyear."',appointment_month,appointment_day)>=".$mail_from_date." AND CONCAT('".$feedback_toyear."',appointment_month,appointment_day)<=".$mail_to_date." AND student_email NOT IN (SELECT student_email from ".$tb_students_feedback_mail_history." WHERE dayspassed<0 AND mail_category='FBM')";
		
	}
	else if($feedbackOn==2) 
	{
		$feedback_date = clean($_POST['fbday']);
		$feedback_month = clean($_POST['fbmonth']);
		$feedback_year = clean($_POST['fbyear']);
		$mail_date = "".$feedback_year."-".$feedback_month."-".$feedback_date."";
		$sqlQuery = "SELECT * FROM ".$tb_students_finishedappointments." WHERE student_email NOT IN (SELECT student_email FROM ".$tb_students_feedback_mail_history." WHERE dayspassed<0 AND mail_category='FBM' ) AND appointment_month=month('".$mail_date."') AND appointment_day=dayofmonth('".$mail_date."')";		
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
		$notification_arr[] = 'Feedback Request failure. No Email ids are present for your selection.';
	}

	if($mailerstatus)
	{
		//Email Customization
		$subject = 'UHC : Feedback Form for service provided at University Health Centre';//Email Subject
		$text = 'Feedback form from University Health Centre';//email Text
		
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
			University Health Centre considers it a privilege to have provided health care services to you, 
			and we hope your experience with our staff and facilities was positive. If you have suggestions 
			to improve yours visit, please let us know. We use feedback from students to identify 
			and act upon areas for improvement in our programs. 
			 <br/><br/>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			We would greatly appreciate your responses to the questions on this survey. 
			Thank you for helping us to continually improve our services at University Health Centre. Click on below link to take survey.<br/><br/>
			<a href="http://localhost/UHC/Survey/takeSurvey.php" target="_blank">Take Survery</a>
			</font>
			</p>
			<p><font size="3">
			-<br>
			Regards<br>
			University Health Centre Community<br></font>
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
			$notification_arr[] = $mail->getMessage();
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
				$notification_arr[] = 'Feedback request Sent Successfully';
			}
			else
			{
				$_SESSION['err_status_flag'] = true;
				$notification_arr[] = 'Feedback request Sent Successfully. But insertion error in mail history';
			}
		}	
	}
	
	if($notify) {	
		$_SESSION['FEEDBACK'] = date('d');
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		header("location: breakout.php");
		exit();
	}
?>
