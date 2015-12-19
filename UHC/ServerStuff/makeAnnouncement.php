<?php
/*=========================================
makeAnnouncement.php

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
	$annList = clean($_POST['annToList']);
	$annSubject = clean($_POST['annSubject']);
	$annBody = clean($_POST['annBody']);
	$mail_category = "ANN";
	
	$sqlQuery = ""; //sql Query in order to fetch email ids from database
	$sqlQuery1 = ""; //sql Query in order to fetch email ids from database
	$email_To = array(); // array to store email recipients list
	$myOptions = array();
	
	if($annList==0) //Announcement for all students
	{
		$sqlQuery1 = "SELECT * FROM ".$tb_students_emailid." WHERE student_email NOT IN (SELECT student_email FROM ".$tb_mail_history." WHERE mail_category='ANN' and mail_date=CURDATE())";
	}
	else if($annList==1) //Announcement for students appointments for choosed options
	{
		$sqlQuery1 = "SELECT distinct appb.student_id,appb.student_name,appb.student_email, appb.student_dob, appb.appointment_d as appointment_date, COALESCE( lad.lastappointment_d,  '0000-00-00' ) as last_appointment_date FROM appscheduler_bookings appb
						LEFT JOIN 
						(select A.student_email, A.lastappointment_d
						FROM
						(select student_email, appointment_d as lastappointment_d, datediff(curdate(),appointment_d) as days_passed FROM appscheduler_bookings) A
						INNER JOIN
						(Select student_email,min(datediff(curdate(),appointment_d)) as days_passed FROM appscheduler_bookings
						WHERE datediff(curdate(),appointment_d) > 0 group by student_email) as B
						on A.student_email=B.student_email AND A.days_passed=B.days_passed) lad
						on appb.student_email=lad.student_email where";
		
		foreach($_POST['myOptions'] as $selected){		
			$myOptions[] = $selected;
		}		
		$j=0;
		$condition = "";
		foreach($myOptions as $option)
		{
			if($option==0)
			{
				$annappfromday = clean($_POST['annappfromday']);
				$annappfrommonth = clean($_POST['annappfrommonth']);
				$annappfromyear = clean($_POST['annappfromyear']);
				$annapptoday = clean($_POST['annapptoday']);
				$annapptomonth = clean($_POST['annapptomonth']);
				$annapptoyear = clean($_POST['annapptoyear']);
				if($annappfromday<=9)
				{
					$annappfromday = "0".$annappfromday;
				}
				if($annapptoday<=9)
				{
					$annapptoday = "0".$annapptoday;
				}
				if($annappfrommonth<=9)
				{
					$annappfrommonth = "0".$annappfrommonth;
				}
				if($annapptomonth<=9)
				{
					$annapptomonth = "0".$annapptomonth;
				}
				$mail_from_date = "'".$annappfromyear."-".$annappfrommonth."-".$annappfromday."'";
				$mail_to_date = "'".$annapptoyear."-".$annapptomonth."-".$annapptoday."'";
				$sqlQuery = $sqlQuery." ( appb.appointment_d>".$mail_from_date." AND appb.appointment_d<".$mail_to_date.") ";
				$j++;
			}
			else if($option==1)
			{
				$annappday = clean($_POST['annappday']);
				$annappmonth = clean($_POST['annappmonth']);
				$annappyear = clean($_POST['annappyear']);				
				if($annappday<=9)
				{
					$annappday = "0".$annappday;
				}
				if($annappmonth<=9)
				{
					$annappmonth = "0".$annappmonth;
				}				
				$mail_date = "'".$annappyear."-".$annappmonth."-".$annappday."'";				
				if($j>0)
				{
					$condition = clean($_POST['option1']);
					$sqlQuery = $sqlQuery.$condition." ( appb.appointment_d=".$mail_date." ) ";
				}
				else
					$sqlQuery = $sqlQuery." ( appb.appointment_d=".$mail_date." ) ";
				$j++;	
			}
			else if($option==2)
			{
				$annlappfromday = clean($_POST['annlappfromday']);
				$annlappfrommonth = clean($_POST['annlappfrommonth']);
				$annlappfromyear = clean($_POST['annlappfromyear']);
				$annlapptoday = clean($_POST['annlapptoday']);
				$annlapptomonth = clean($_POST['annlapptomonth']);
				$annlapptoyear = clean($_POST['annlapptoyear']);
				if($annlappfromday<=9)
				{
					$annlappfromday = "0".$annlappfromday;
				}
				if($annlapptoday<=9)
				{
					$annlapptoday = "0".$annlapptoday;
				}
				if($annlappfrommonth<=9)
				{
					$annlappfrommonth = "0".$annlappfrommonth;
				}
				if($annlapptomonth<=9)
				{
					$annlapptomonth = "0".$annlapptomonth;
				}
				$mail_from_date = "'".$annlappfromyear."-".$annlappfrommonth."-".$annlappfromday."'";
				$mail_to_date = "'".$annlapptoyear."-".$annlapptomonth."-".$annlapptoday."'";
				if($j>0)
				{
					$condition = clean($_POST['option2']);
					$sqlQuery = $sqlQuery.$condition." ( lad.lastappointment_d>".$mail_from_date." AND lad.lastappointment_d<".$mail_to_date.") ";
				}
				else
					$sqlQuery = $sqlQuery." ( lad.lastappointment_d>".$mail_from_date." AND lad.lastappointment_d<".$mail_to_date.") ";
				$j++;				
			}
			else if($option==3)
			{
				$annlappday = clean($_POST['annlappday']);
				$annlappmonth = clean($_POST['annlappmonth']);
				$annlappyear = clean($_POST['annlappyear']);				
				if($annlappday<=9)
				{
					$annlappday = "0".$annlappday;
				}
				if($annlappmonth<=9)
				{
					$annlappmonth = "0".$annlappmonth;
				}				
				$mail_date = "'".$annlappyear."-".$annlappmonth."-".$annlappday."'";				
				if($j>0)
				{
					$condition = clean($_POST['option3']);
					$sqlQuery = $sqlQuery.$condition." ( lad.lastappointment_d=".$mail_date." ) ";
				}
				else
					$sqlQuery = $sqlQuery." ( lad.lastappointment_d=".$mail_date." ) ";
				$j++;
			}
			else if($option==4)
			{
				$annbdfromday = clean($_POST['annbdfromday']);
				$annbdfrommonth = clean($_POST['annbdfrommonth']);
				$annbdfromyear = clean($_POST['annbdfromyear']);
				$annbdtoday = clean($_POST['annbdtoday']);
				$annbdtomonth = clean($_POST['annbdtomonth']);
				$annbdtoyear = clean($_POST['annbdtoyear']);
				if($annbdfromday<=9)
				{
					$annbdfromday = "0".$annbdfromday;
				}
				if($annbdtoday<=9)
				{
					$annbdtoday = "0".$annbdtoday;
				}
				if($annbdfrommonth<=9)
				{
					$annbdfrommonth = "0".$annbdfrommonth;
				}
				if($annbdtomonth<=9)
				{
					$annbdtomonth = "0".$annbdtomonth;
				}
				$mail_from_date = "'".$annbdfromyear.$annbdfrommonth.$annbdfromday."'";
				$mail_to_date = "'".$annbdtoyear.$annbdtomonth.$annbdtoday."'";
				if($j>0)
				{
					$condition = clean($_POST['option4']);
					$sqlQuery = $sqlQuery.$condition." ( CONCAT('".$annbdfromyear."',month(appb.student_dob),dayofmonth(appb.student_dob))>=".$mail_from_date." AND CONCAT('".annbdtoyear."',month(appb.student_dob),dayofmonth(appb.student_dob))<=".$mail_to_date.") ";
				}
				else
					$sqlQuery = $sqlQuery." ( CONCAT('".$annbdfromyear."',month(appb.student_dob),dayofmonth(appb.student_dob))>=".$mail_from_date." AND CONCAT('".annbdtoyear."',month(appb.student_dob),dayofmonth(appb.student_dob))<=".$mail_to_date.") ";
				$j++;		
			}
			else if($option==5)
			{
				$annbdday = clean($_POST['annbdday']);
				$annbdmonth = clean($_POST['annbdmonth']);
				$annbdyear = clean($_POST['annbdyear']);				
				if($annbdday<=9)
				{
					$annbdday = "0".$annbdday;
				}
				if($annbdmonth<=9)
				{
					$annbdmonth = "0".$annbdmonth;
				}				
				$mail_date = "'".$annbdyear.$annbdmonth.$annbdday."'";				
				if($j>0)
				{
					$condition = clean($_POST['option5']);
					$sqlQuery = $sqlQuery.$condition." ( CONCAT('".$annbdyear."',month(appb.student_dob),dayofmonth(appb.student_dob))=".$mail_date.") ";
				}
				else
					$sqlQuery = $sqlQuery." ( CONCAT('".$annbdyear."',month(appb.student_dob),dayofmonth(appb.student_dob))=".$mail_date.") ";
				$j++;
			}
		}
		$sqlQuery1 = $sqlQuery1." ( ".$sqlQuery." ) AND appb.student_email NOT IN (SELECT student_email FROM ".$tb_mail_history." WHERE mail_category='ANN' and mail_date=CURDATE())";
	}	
	$result = mysql_query($sqlQuery1);
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
		$notification_arr[] = 'Announcement failure. No Email ids are present for your selection.';
	}

	if($mailerstatus)
	{
		//Email Customization
		$subject = 'Mail Announcement : '. $annSubject;//Email Subject
		$text = 'Announcement from University Health Centre';//email Text
		
		//email headers
		$headers = array( 
			'From' => $email_From, 
			'Subject' => $subject
			); 
		
		$crlf = "\r\n";
		$mime = new Mail_mime($crlf);//get mime mail object in order to set headers		
		
		$html = '
			<html>
			<head><title>Announcement</title></head>
			<body>
			<div style="width:600px;height:auto;background:#8AB800;">
				<div style="width:parent;height:10px;background:#33ADFF;"></div>
				<div style="width:parent;height:3px;background:#FFF;"></div>
				<div style="width:parent;height:15px;background:#33ADFF;"></div>
				<div style="width:parent;height:auto;padding-top:20px;padding-left:30px;padding-right:20px;line-height:30px;font-family:Times New Roman;padding-bottom:30px;text-align:justify;color:#FFC;">
					<p><font size="3"> Dear Students, </font></p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="3">'.$annBody.'</font></p>
					<p><font size="3">
					-<br/>
					Regards<br/>
					University Health Centre Community<br/></font>
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
				$notification_arr[] = 'Announcement mail sent Successfully.';
			}
			else
			{
				$_SESSION['err_status_flag'] = true;
				$notification_arr[] = 'Announcement mail sent Successfully. But insertion error in mail history';
			}			
		}	
	}
	
	if($notify) {		
		$_SESSION['ANNOUNCEMENT'] = date('d');
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		//echo $sqlQuery1;
		header("location: breakout.php");
		exit();
	}
?>
