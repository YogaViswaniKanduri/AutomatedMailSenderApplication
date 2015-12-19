<?php
/*=========================================
sendBirthdayWishes.php

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
	$birthdayWishType = clean($_POST['bdwishtype']);
	$birthdayEmailTemplate = clean($_POST['bdtemplate']);
	
	$sqlQuery = ""; //sql Query in order to fetch email ids from database
	$email_To = array(); // array to store email recipients list
	$mail_category = "";
	
	if($birthdayWishType==1) //Email Birthday wishes for today
	{
		$sqlQuery = "SELECT * FROM ".$tb_students_today_birthday." WHERE student_email NOT IN (SELECT student_email FROM ".$tb_students_birthday_mail_history." WHERE mail_date=date_format(now(),'%Y-%m-%d') and mail_category='BW')";
		$mail_category = 'BW';
	}
	else if($birthdayWishType==2)	
	{
		$birthday_fromdate = clean($_POST['bdfromday']);
		$birthday_frommonth = clean($_POST['bdfrommonth']);		
		$birthday_fromyear = clean($_POST['bdfromyear']);	
		$birthday_toyear = clean($_POST['bdtoyear']);	
		$birthday_todate = clean($_POST['bdtoday']);
		$birthday_tomonth = clean($_POST['bdtomonth']);		
		if($birthday_fromdate<=9)
		{
			$birthday_fromdate = "0".$birthday_fromdate;
		}
		if($birthday_todate<=9)
		{
			$birthday_todate = "0".$birthday_todate;
		}
		if($birthday_frommonth<=9)
		{
			$birthday_frommonth = "0".$birthday_frommonth;
		}
		if($birthday_tomonth<=9)
		{
			$birthday_tomonth = "0".$birthday_tomonth;
		}
		$mail_from_date = "'".$birthday_fromyear.$birthday_frommonth.$birthday_fromdate."'";
		$mail_to_date = "'".$birthday_toyear.$birthday_tomonth.$birthday_todate."'";
		$sqlQuery = "SELECT * FROM ".$tb_students_future_birthday." WHERE CONCAT('".$birthday_fromyear."',student_dob_month,student_dob_day)>=".$mail_from_date." AND CONCAT('".$birthday_toyear."',student_dob_month,student_dob_day)<=".$mail_to_date." AND student_email NOT IN (SELECT student_email from ".$tb_students_birthday_mail_history." WHERE mail_date=CURDATE() AND mail_category='ADBW')";
		$mail_category = 'ADBW';
	}
	else if($birthdayWishType==3)	
	{
		$birthday_date = clean($_POST['bdday']);
		$birthday_month = clean($_POST['bdmonth']);
		$birthday_year = clean($_POST['bdyear']);
		if($birthday_date<=9)
		{
			$birthday_date = "0".$birthday_date;
		}
		if($birthday_month<=9)
		{
			$birthday_month = "0".$birthday_month;
		}
		$mail_date = "'".$birthday_year."-".$birthday_month."-".$birthday_date."'";
		$sqlQuery = "SELECT * FROM ".$tb_students_future_birthday." WHERE student_email NOT IN (SELECT student_email FROM ".$tb_students_birthday_mail_history." WHERE mail_date=CURDATE() AND mail_category='ADBW' ) AND student_dob_month=month('".$mail_date."') AND student_dob_day=dayofmonth('".$mail_date."')";
		$mail_category = 'ADBW';		
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
		$notification_arr[] = 'No Birthdays are present.';
	}

	if($mailerstatus)
	{
		//Email Customization
		$subject = ""; //Email Subject
		$text = 'Wishes from University Health Centre';//email Text
		
		if($birthdayWishType==1) //Email Birthday wishes for today
		{
			$subject = 'Birthday Wishes : Many more Happy Returns...';
		}
		else if($birthdayWishType==2)
		{
			$subject = 'Advance Birthday Wishes : Enjoy on your birthday ...';
		}
		
		//email headers
		$headers = array( 
			'From' => $email_From, 
			'Subject' => $subject
			); 
		
		$crlf = "\r\n";
		$mime = new Mail_mime($crlf);//get mime mail object in order to set headers
		$cid = "";//content id for the images
		
		if( ($birthdayWishType==1) && ($birthdayEmailTemplate==1))
		{
				$mime->addHTMLImage("../img/templates/email/bdemail11.jpg", "image/jpg");
				//here's the butt-ugly bit where we grab the content id
				$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];
		}
		else if( ($birthdayWishType==1) && ($birthdayEmailTemplate==2))
		{
				$mime->addHTMLImage("../img/templates/email/bdemail12.jpg", "image/jpg");
				//here's the butt-ugly bit where we grab the content id
				$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];
		}
		else if( ($birthdayWishType==2) && ($birthdayEmailTemplate==1))
		{
				$mime->addHTMLImage("../img/templates/email/bdemail21.jpg", "image/jpg");
				//here's the butt-ugly bit where we grab the content id
				$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];
		}
		else if( ($birthdayWishType==2) && ($birthdayEmailTemplate==2))
		{
				$mime->addHTMLImage("../img/templates/email/bdemail22.jpg", "image/jpg");
				//here's the butt-ugly bit where we grab the content id
				$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];
		}
		
		$html = '
			<html>
			<head>
			<title>Birthday wishes </title>
			</head>
			<body>
			<img src="cid:'.$cid.'" />
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
				$notification_arr[] = 'Mail Sent Successfully';
			}
			else
			{
				$_SESSION['err_status_flag'] = true;
				$notification_arr[] = 'Mail Sent Successfully. But insertion error in mail history';
			}
		}	
	}
	
	if($notify) {		
		$_SESSION['BIRTHDAY_WISHES'] = date('d');
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		header("location: breakout.php");
		exit();
	}
?>
