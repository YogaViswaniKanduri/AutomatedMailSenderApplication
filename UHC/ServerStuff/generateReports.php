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
	$reports = clean($_POST['reports']);
	$reporttype = clean($_POST['reporttype']);
	
			
	$sqlQuery = ""; //sql Query in order to fetch data from database in order to generate reports
	$workbook = ""; //workbook in order to enter stats
	$isDownload = false; //boolean variable in order to flag true if generated report to be downloaded
	$workbook_title = "";
		
	
	if($reports==0)// Report for student Appointments
	{
		$workbook_title = "StudentsAppointmentsReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/Appointments/'.$workbook_title;
		
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
		$worksheet0 =& $workbook->addWorksheet('Students_Appointments');
		$worksheet0->setHeader( "University Health Centre" , 0.5 );
		$worksheet0->setFooter( "University Health Centre" , 0.5 );
		$worksheet0->write(0, 0, "Student Id", $format_title);
		$worksheet0->write(0, 1, "Student Name", $format_title);
		$worksheet0->write(0, 2, "Student EmailId", $format_title);
		$worksheet0->write(0, 3, "Appointment Id", $format_title);
		$worksheet0->write(0, 4, "Appointment Date", $format_title);
		$worksheet0->write(0, 5, "Appointment Time", $format_title);
		$sqlQuery = "SELECT * FROM ".$tb_students_appointments." ORDER BY appointment_date desc";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet0->write($i, 0, $row['student_id'], $format_body);
				$worksheet0->write($i, 1, $row['student_name'], $format_body);
				$worksheet0->write($i, 2, $row['student_email'], $format_body);			
				$worksheet0->write($i, 3, $row['appointment_id'], $format_body);			
				$worksheet0->write($i, 4, $row['appointment_date'], $format_body);			
				$worksheet0->write($i, 5, $row['appointment_time'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}	
	else if($reports==6)// Report for student Email Ids
	{
		$workbook_title = "StudentsEmailReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/EmailIds/'.$workbook_title;
		
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
		$worksheet6 =& $workbook->addWorksheet('Students_EmailId');
		$worksheet6->setHeader( "University Health Centre" , 0.5 );
		$worksheet6->setFooter( "University Health Centre" , 0.5 );
		$worksheet6->write(0, 0, "Student Id", $format_title);
		$worksheet6->write(0, 1, "Student Name", $format_title);
		$worksheet6->write(0, 2, "Student EmailId", $format_title);
		$sqlQuery = "SELECT * FROM ".$tb_students_emailid."";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet6->write($i, 0, $row['student_id'], $format_body);
				$worksheet6->write($i, 1, $row['student_name'], $format_body);
				$worksheet6->write($i, 2, $row['student_email'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}		
	else if($reports==1)// Report for student Appointments for next 7 days
	{
		$workbook_title = "StudentsAppNext7daysReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/Appointments/'.$workbook_title;
		
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
		$worksheet1 =& $workbook->addWorksheet('Students_Appointments');
		$worksheet1->setHeader( "University Health Centre" , 0.5 );
		$worksheet1->setFooter( "University Health Centre" , 0.5 );
		$worksheet1->write(0, 0, "Student Id", $format_title);
		$worksheet1->write(0, 1, "Student Name", $format_title);
		$worksheet1->write(0, 2, "Student EmailId", $format_title);
		$worksheet1->write(0, 3, "Appointment date", $format_title);
		$sqlQuery = "SELECT A.*,B.student_name FROM ".$tb_students_appointments_next7days." as A
		INNER JOIN ".$tb_students_appointments." as B on A.student_id=B.student_id";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet1->write($i, 0, $row['student_id'], $format_body);
				$worksheet1->write($i, 1, $row['student_name'], $format_body);
				$worksheet1->write($i, 2, $row['student_email'], $format_body);			
				$worksheet1->write($i, 3, $row['appointment_date'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}		
	else if($reports==2)// Report for student Appointments for next 14 days
	{
		$workbook_title = "StudentsAppNext14daysReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/Appointments/'.$workbook_title;
		
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
		$worksheet2 =& $workbook->addWorksheet('Students_Appointments');
		$worksheet2->setHeader( "University Health Centre" , 0.5 );
		$worksheet2->setFooter( "University Health Centre" , 0.5 );
		$worksheet2->write(0, 0, "Student Id", $format_title);
		$worksheet2->write(0, 1, "Student Name", $format_title);
		$worksheet2->write(0, 2, "Student EmailId", $format_title);
		$worksheet2->write(0, 3, "Appointment date", $format_title);
		$sqlQuery = "SELECT A.*,B.student_name FROM ".$tb_students_appointments_next14days." as A
		INNER JOIN ".$tb_students_appointments." as B on A.student_id=B.student_id";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet2->write($i, 0, $row['student_id'], $format_body);
				$worksheet2->write($i, 1, $row['student_name'], $format_body);
				$worksheet2->write($i, 2, $row['student_email'], $format_body);			
				$worksheet2->write($i, 3, $row['appointment_date'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}			
	else if($reports==3)// Report for student Appointments for current month
	{
		$workbook_title = "StudentsApp".date('M').date('Y')."Reports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/Appointments/'.$workbook_title;
		
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
		$worksheet3 =& $workbook->addWorksheet('Students_Appointments');
		$worksheet3->setHeader( "University Health Centre" , 0.5 );
		$worksheet3->setFooter( "University Health Centre" , 0.5 );
		$worksheet3->write(0, 0, "Student Id", $format_title);
		$worksheet3->write(0, 1, "Student Name", $format_title);
		$worksheet3->write(0, 2, "Student EmailId", $format_title);
		$worksheet3->write(0, 3, "Appointment date", $format_title);
		$sqlQuery = "SELECT * FROM ".$tb_students_currentmonth_appointments."";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet3->write($i, 0, $row['student_id'], $format_body);
				$worksheet3->write($i, 1, $row['student_name'], $format_body);
				$worksheet3->write($i, 2, $row['student_email'], $format_body);			
				$worksheet3->write($i, 3, $row['appointment_date'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}			
	else if($reports==4)// Report for student Appointments for previous month
	{
		$workbook_title = "StudentsAppPreviousMonthReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/Appointments/'.$workbook_title;
		
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
		$worksheet4 =& $workbook->addWorksheet('Students_Appointments');
		$worksheet4->setHeader( "University Health Centre" , 0.5 );
		$worksheet4->setFooter( "University Health Centre" , 0.5 );
		$worksheet4->write(0, 0, "Student Id", $format_title);
		$worksheet4->write(0, 1, "Student Name", $format_title);
		$worksheet4->write(0, 2, "Student EmailId", $format_title);
		$worksheet4->write(0, 3, "Appointment Id", $format_title);
		$worksheet4->write(0, 4, "Appointment date", $format_title);
		$worksheet4->write(0, 5, "Appointment time", $format_title);
		$sqlQuery = "SELECT * FROM ".$tb_students_previousmonth_appointments."";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet4->write($i, 0, $row['student_id'], $format_body);
				$worksheet4->write($i, 1, $row['student_name'], $format_body);
				$worksheet4->write($i, 2, $row['student_email'], $format_body);			
				$worksheet4->write($i, 3, $row['appointment_id'], $format_body);			
				$worksheet4->write($i, 4, $row['appointment_date'], $format_body);			
				$worksheet4->write($i, 5, $row['appointment_time'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}		
	else if($reports==5)// Report for student Appointments for Current day
	{
		$workbook_title = "StudentsApp".date('d').date('M').date('Y')."Reports_".date('h').date('i').date('s').".xls";
		$workbook_title = '../Reports/Appointments/'.$workbook_title;
		
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
		$worksheet5 =& $workbook->addWorksheet('Students_Appointments');
		$worksheet5->setHeader( "University Health Centre" , 0.5 );
		$worksheet5->setFooter( "University Health Centre" , 0.5 );
		$worksheet5->write(0, 0, "Student Id", $format_title);
		$worksheet5->write(0, 1, "Student Name", $format_title);
		$worksheet5->write(0, 2, "Student EmailId", $format_title);
		$worksheet5->write(0, 3, "Appointment id", $format_title);
		$worksheet5->write(0, 4, "Appointment date", $format_title);
		$worksheet5->write(0, 5, "Appointment time", $format_title);
		$sqlQuery = "SELECT * FROM ".$tb_students_currentday_appointments."";
		
		$result = mysql_query($sqlQuery);
		$row = mysql_fetch_array($result);
		
		if($row)
		{
			$i=1;		
			do
			{
				$worksheet5->write($i, 0, $row['student_id'], $format_body);
				$worksheet5->write($i, 1, $row['student_name'], $format_body);
				$worksheet5->write($i, 2, $row['student_email'], $format_body);			
				$worksheet5->write($i, 3, $row['appointment_id'], $format_body);			
				$worksheet5->write($i, 4, $row['appointment_date'], $format_body);			
				$worksheet5->write($i, 5, $row['appointment_time'], $format_body);			
				$i++;
			}while($row = mysql_fetch_array($result));
		}
		if($isDownload)
		{
			$workbook->send($workbook_title);		
		}
		$workbook->close();
	}		
	
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
			$_SESSION['err_status_flag'] = false;
			$notification_arr[] = 'Report generated and emailed to Admin sent Successfully';
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