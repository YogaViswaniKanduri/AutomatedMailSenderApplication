<?php
/*=========================================
generateReports.php

Generates reports from database and email to admin or
file will be downloaded based upon user request.
===========================================*/
error_reporting(E_ALL ^ E_DEPRECATED);
require("database/database_auth.php");
include "Mail.php";
include "Mail\mime.php";
require_once 'Spreadsheet/Excel/Writer.php';



	//session start
	session_start();
	
	$_SESSION['REPORTS'] = date('d');//status of activity
	
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
	$reporttype = clean($_POST['reporttype']);
	
			
	$mail_category = "GCR";
	
	$sqlQuery = ""; //sql Query in order to fetch email ids from database
	$sqlQuery1 = ""; //sql Query in order to fetch email ids from database
	$myOptions = array();
	
	$workbook = ""; //workbook in order to enter stats
	$isDownload = false; //boolean variable in order to flag true if generated report to be downloaded
	$workbook_title = "";
	
	$sqlQuery1 = "SELECT distinct appb.student_id,appb.student_name,appb.student_email, appb.student_dob, appb.appointment_id, appb.appointment_d as appointment_date, COALESCE( lad.lastappointment_d,  '0000-00-00' ) as last_appointment_date, appb.appointment_time FROM appscheduler_bookings appb
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
			$grappfromday = clean($_POST['grappfromday']);
			$grappfrommonth = clean($_POST['grappfrommonth']);
			$grappfromyear = clean($_POST['grappfromyear']);
			$grapptoday = clean($_POST['grapptoday']);
			$grapptomonth = clean($_POST['grapptomonth']);
			$grapptoyear = clean($_POST['grapptoyear']);
			if($grappfromday<=9)
			{
				$grappfromday = "0".$grappfromday;
			}
			if($grapptoday<=9)
			{
				$grapptoday = "0".$grapptoday;
			}
			if($grappfrommonth<=9)
			{
				$grappfrommonth = "0".$grappfrommonth;
			}
			if($grapptomonth<=9)
			{
				$grapptomonth = "0".$grapptomonth;
			}
			$mail_from_date = "'".$grappfromyear."-".$grappfrommonth."-".$grappfromday."'";
			$mail_to_date = "'".$grapptoyear."-".$grapptomonth."-".$grapptoday."'";
			$sqlQuery = $sqlQuery." ( appb.appointment_d>".$mail_from_date." AND appb.appointment_d<".$mail_to_date.") ";
			$j++;
		}
		else if($option==1)
		{
			$grappday = clean($_POST['grappday']);
			$grappmonth = clean($_POST['grappmonth']);
			$grappyear = clean($_POST['grappyear']);				
			if($grappday<=9)
			{
				$grappday = "0".$grappday;
			}
			if($grappmonth<=9)
			{
				$grappmonth = "0".$grappmonth;
			}				
			$mail_date = "'".$grappyear."-".$grappmonth."-".$grappday."'";				
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
			$grlappfromday = clean($_POST['grlappfromday']);
			$grlappfrommonth = clean($_POST['grlappfrommonth']);
			$grlappfromyear = clean($_POST['grlappfromyear']);
			$grlapptoday = clean($_POST['grlapptoday']);
			$grlapptomonth = clean($_POST['grlapptomonth']);
			$grlapptoyear = clean($_POST['grlapptoyear']);
			if($grlappfromday<=9)
			{
				$grlappfromday = "0".$grlappfromday;
			}
			if($grlapptoday<=9)
			{
				$grlapptoday = "0".$grlapptoday;
			}
			if($grlappfrommonth<=9)
			{
				$grlappfrommonth = "0".$grlappfrommonth;
			}
			if($grlapptomonth<=9)
			{
				$grlapptomonth = "0".$grlapptomonth;
			}
			$mail_from_date = "'".$grlappfromyear."-".$grlappfrommonth."-".$grlappfromday."'";
			$mail_to_date = "'".$grlapptoyear."-".$grlapptomonth."-".$grlapptoday."'";
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
			$grlappday = clean($_POST['grlappday']);
			$grlappmonth = clean($_POST['grlappmonth']);
			$grlappyear = clean($_POST['grlappyear']);				
			if($grlappday<=9)
			{
				$grlappday = "0".$grlappday;
			}
			if($grlappmonth<=9)
			{
				$grlappmonth = "0".$grlappmonth;
			}				
			$mail_date = "'".$grlappyear."-".$grlappmonth."-".$grlappday."'";				
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
			$grbdfromday = clean($_POST['grbdfromday']);
			$grbdfrommonth = clean($_POST['grbdfrommonth']);
			$grbdfromyear = clean($_POST['grbdfromyear']);
			$grbdtoday = clean($_POST['grbdtoday']);
			$grbdtomonth = clean($_POST['grbdtomonth']);
			$grbdtoyear = clean($_POST['grbdtoyear']);
			if($grbdfromday<=9)
			{
				$grbdfromday = "0".$grbdfromday;
			}
			if($grbdtoday<=9)
			{
				$grbdtoday = "0".$grbdtoday;
			}
			if($grbdfrommonth<=9)
			{
				$grbdfrommonth = "0".$grbdfrommonth;
			}
			if($grbdtomonth<=9)
			{
				$grbdtomonth = "0".$grbdtomonth;
			}
			$mail_from_date = "'".$grbdfromyear.$grbdfrommonth.$grbdfromday."'";
			$mail_to_date = "'".$grbdtoyear.$grbdtomonth.$grbdtoday."'";
			if($j>0)
			{
				$condition = clean($_POST['option4']);
				$sqlQuery = $sqlQuery.$condition." ( CONCAT('".$grbdfromyear."',month(appb.student_dob),dayofmonth(appb.student_dob))>=".$mail_from_date." AND CONCAT('".grbdtoyear."',month(appb.student_dob),dayofmonth(appb.student_dob))<=".$mail_to_date.") ";
			}
			else
				$sqlQuery = $sqlQuery." ( CONCAT('".$grbdfromyear."',month(appb.student_dob),dayofmonth(appb.student_dob))>=".$mail_from_date." AND CONCAT('".grbdtoyear."',month(appb.student_dob),dayofmonth(appb.student_dob))<=".$mail_to_date.") ";
			$j++;		
		}
		else if($option==5)
		{
			$grbdday = clean($_POST['grbdday']);
			$grbdmonth = clean($_POST['grbdmonth']);
			$grbdyear = clean($_POST['grbdyear']);				
			if($grbdday<=9)
			{
				$grbdday = "0".$grbdday;
			}
			if($grbdmonth<=9)
			{
				$grbdmonth = "0".$grbdmonth;
			}				
			$mail_date = "'".$grbdyear.$grbdmonth.$grbdday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option5']);
				$sqlQuery = $sqlQuery.$condition." ( CONCAT('".$grbdyear."',month(appb.student_dob),dayofmonth(appb.student_dob))=".$mail_date.") ";
			}
			else
				$sqlQuery = $sqlQuery." ( CONCAT('".$grbdyear."',month(appb.student_dob),dayofmonth(appb.student_dob))=".$mail_date.") ";
			$j++;
		}
	}
	$sqlQuery1 = $sqlQuery1." ( ".$sqlQuery." ) ";
	
	
	
	$workbook_title = "StudentsReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
	$workbook_title = '../Reports/'.$workbook_title;
	
	if($reporttype==0)//Generated file needs to be download to system
	{
		$workbook = new Spreadsheet_Excel_Writer();
		$isDownload = true;
	}
	else if ($reporttype==1)// Generated file needs to be mailed to admin
	{
		$workbook = new Spreadsheet_Excel_Writer($workbook_title);
	}
		
	//workbook font and style format
	$format_title =& $workbook->addFormat();
	$format_title->setBold();
	$format_title->setColor('yellow');
	$format_title->setPattern(1);
	$format_title->setFgColor('black');
	$format_title->setBorder(1);
	
	$format_body =& $workbook->addFormat();
	$format_body->setBorder(1);
	
	// Workbook format Settings
	$worksheet0 =& $workbook->addWorksheet('Students_Reports');
	$worksheet0->setHeader( "University Health Centre" , 0.5 );
	$worksheet0->setFooter( "University Health Centre" , 0.5 );
	$worksheet0->write(0, 0, "Student Id", $format_title);
	$worksheet0->write(0, 1, "Student Name", $format_title);
	$worksheet0->write(0, 2, "Student EmailId", $format_title);
	$worksheet0->write(0, 3, "Student DOB", $format_title);
	$worksheet0->write(0, 4, "Appointment Id", $format_title);
	$worksheet0->write(0, 5, "Appointment Date", $format_title);
	$worksheet0->write(0, 6, "Last Appointment Date", $format_title);
	$worksheet0->write(0, 7, "Appointment Time", $format_title);
			
	$result = mysql_query($sqlQuery1);
	$row = mysql_fetch_array($result);
	
	if($row)
	{
		$i=1;		
		do
		{
			$worksheet0->write($i, 0, $row['student_id'], $format_body);
			$worksheet0->write($i, 1, $row['student_name'], $format_body);
			$worksheet0->write($i, 2, $row['student_email'], $format_body);			
			$worksheet0->write($i, 3, $row['student_dob'], $format_body);			
			$worksheet0->write($i, 4, $row['appointment_id'], $format_body);			
			$worksheet0->write($i, 5, $row['appointment_date'], $format_body);			
			$worksheet0->write($i, 6, $row['last_appointment_date'], $format_body);			
			$worksheet0->write($i, 7, $row['appointment_time'], $format_body);			
			$i++;
		}while($row = mysql_fetch_array($result));
	}
	
	$query = "";
	$stat = false;	
	$query = "INSERT INTO ".$tb_mail_history." VALUES(NULL, '0', 'ADMIN', '".$email_Admin."', CURDATE(), '".$mail_category."', CURRENT_TIMESTAMP)";
	$result = @mysql_query($query);	
	if($result)
		$stat=true;
	else
		$stat=false;		
	
	if($isDownload)
	{
		$workbook->send($workbook_title);		
	}
	$workbook->close();
			
	
	$mailerstatus = true;
	if($isDownload)
	{		
		$mailerstatus = false;		
	}	
		
	if($mailerstatus)
	{
		//Email Customization
		$subject = 'Generated Report for your selection : ';//Email Subject
		$text = 'Reports from University Health Centre';//email Text
		$file = "C:/wamp/www/UHC/". substr($workbook_title,3, strlen($workbook_title)) ."";//file path
		//email headers
		$headers = array( 
			'From' => $email_From, 
			'Subject' => $subject
			); 
		
		$crlf = "\r\n";
		$mime = new Mail_mime($crlf);//get mime mail object in order to set headers		
		
		$html = '
			<html>
			<head><title>Generate Reports</title></head>
			<body>
			<div style="width:600px;height:auto;background:#8AB800;">
				<div style="width:parent;height:10px;background:#33ADFF;"></div>
				<div style="width:parent;height:3px;background:#FFF;"></div>
				<div style="width:parent;height:15px;background:#33ADFF;"></div>
				<div style="width:parent;height:auto;padding-top:20px;padding-left:30px;padding-right:20px;line-height:30px;font-family:Times New Roman;padding-bottom:30px;text-align:justify;color:#FFC;">
					<p><font size="3"> Dear Admin, </font></p>
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="3">As per your selection, report has been generated. Please find attachment of generated file.</font></p>
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
		$mime->addAttachment($file, 'text/plain');

		$body = $mime->get();
		$headers = $mime->headers($headers);
		
		$smtp = Mail::factory('smtp',array ('host' => $host,'port' => $port,'auth' => true,'username' => $email_Username,'password' => $email_Password));
		$mail = $smtp->send($email_Admin, $headers, $body);
		
		if (PEAR::isError($mail)) {
			//echo( $mail->getMessage());
			$notify = true;
			$_SESSION['err_status_flag'] = true;
			$notification_arr[] = $mail->getMessage();
		}
		else {
			//echo "Shout Eureka!! Message Sent successfully !!!!";
			$notify = true;
			if($stat)
			{
				$_SESSION['err_status_flag'] = false;
				$notification_arr[] = 'Report generated and emailed to Admin sent Successfully.';
			}
			else
			{
				$_SESSION['err_status_flag'] = true;
				$notification_arr[] = 'Report generated and emailed to Admin sent Successfully. But insertion error in mail history';
			}	
		}	
	}
	
	if($mailerstatus && $notify)
	{	
		$_SESSION['NOTIFY'] = true;
		$_SESSION['NOTIFY_ARR'] = $notification_arr;
		session_write_close();
		header("location: breakout.php");
		exit();
	}	
	
?>