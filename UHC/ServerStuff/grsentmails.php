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
	
	$sqlQuery1 = "SELECT distinct mail_id, student_id, student_name, student_email, mail_date, mail_category, lastupdateddatetime FROM ".$tb_mail_history;
		
	foreach($_POST['myOptions'] as $selected){		
		$myOptions[] = $selected;
	}		
	$j=0;
	$condition = "";
	foreach($myOptions as $option)
	{
		if($option==0)
		{
			$grapprfromday = clean($_POST['grapprfromday']);
			$grapprfrommonth = clean($_POST['grapprfrommonth']);
			$grapprfromyear = clean($_POST['grapprfromyear']);
			$grapprtoday = clean($_POST['grapprtoday']);
			$grapprtomonth = clean($_POST['grapprtomonth']);
			$grapprtoyear = clean($_POST['grapprtoyear']);
			if($grapprfromday<=9)
			{
				$grapprfromday = "0".$grapprfromday;
			}
			if($grapprtoday<=9)
			{
				$grapprtoday = "0".$grapprtoday;
			}
			if($grapprfrommonth<=9)
			{
				$grapprfrommonth = "0".$grapprfrommonth;
			}
			if($grapprtomonth<=9)
			{
				$grapprtomonth = "0".$grapprtomonth;
			}
			$mail_from_date = "'".$grapprfromyear."-".$grapprfrommonth."-".$grapprfromday."'";
			$mail_to_date = "'".$grapprtoyear."-".$grapprtomonth."-".$grapprtoday."'";
			$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='APPR')) ";
			$j++;
		}
		else if($option==1)
		{
			$grapprday = clean($_POST['grapprday']);
			$grapprmonth = clean($_POST['grapprmonth']);
			$grappryear = clean($_POST['grappryear']);				
			if($grapprday<=9)
			{
				$grapprday = "0".$grapprday;
			}
			if($grapprmonth<=9)
			{
				$grapprmonth = "0".$grapprmonth;
			}				
			$mail_date = "'".$grappryear."-".$grapprmonth."-".$grapprday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option1']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='APPR' )) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='APPR' )) ";
			$j++;	
		}
		else if($option==2)
		{
			$gradbwfromday = clean($_POST['gradbwfromday']);
			$gradbwfrommonth = clean($_POST['gradbwfrommonth']);
			$gradbwfromyear = clean($_POST['gradbwfromyear']);
			$gradbwtoday = clean($_POST['gradbwtoday']);
			$gradbwtomonth = clean($_POST['gradbwtomonth']);
			$gradbwtoyear = clean($_POST['gradbwtoyear']);
			if($gradbwfromday<=9)
			{
				$gradbwfromday = "0".$gradbwfromday;
			}
			if($gradbwtoday<=9)
			{
				$gradbwtoday = "0".$gradbwtoday;
			}
			if($gradbwfrommonth<=9)
			{
				$gradbwfrommonth = "0".$gradbwfrommonth;
			}
			if($gradbwtomonth<=9)
			{
				$gradbwtomonth = "0".$gradbwtomonth;
			}
			$mail_from_date = "'".$gradbwfromyear."-".$gradbwfrommonth."-".$gradbwfromday."'";
			$mail_to_date = "'".$gradbwtoyear."-".$gradbwtomonth."-".$gradbwtoday."'";
			if($j>0)
			{
				$condition = clean($_POST['option2']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='ADBW')) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='ADBW')) ";
			$j++;				
		}
		else if($option==3)
		{
			$gradbwday = clean($_POST['gradbwday']);
			$gradbwmonth = clean($_POST['gradbwmonth']);
			$gradbwyear = clean($_POST['gradbwyear']);				
			if($gradbwday<=9)
			{
				$gradbwday = "0".$gradbwday;
			}
			if($gradbwmonth<=9)
			{
				$gradbwmonth = "0".$gradbwmonth;
			}				
			$mail_date = "'".$gradbwyear."-".$gradbwmonth."-".$gradbwday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option3']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='ADBW' )) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='ADBW' )) ";
			$j++;
		}
		else if($option==4)
		{
			$grbwfromday = clean($_POST['grbwfromday']);
			$grbwfrommonth = clean($_POST['grbwfrommonth']);
			$grbwfromyear = clean($_POST['grbwfromyear']);
			$grbwtoday = clean($_POST['grbwtoday']);
			$grbwtomonth = clean($_POST['grbwtomonth']);
			$grbwtoyear = clean($_POST['grbwtoyear']);
			if($grbwfromday<=9)
			{
				$grbwfromday = "0".$grbwfromday;
			}
			if($grbwtoday<=9)
			{
				$grbwtoday = "0".$grbwtoday;
			}
			if($grbwfrommonth<=9)
			{
				$grbwfrommonth = "0".$grbwfrommonth;
			}
			if($grbwtomonth<=9)
			{
				$grbwtomonth = "0".$grbwtomonth;
			}
			$mail_from_date = "'".$grbwfromyear."-".$grbwfrommonth."-".$grbwfromday."'";
			$mail_to_date = "'".$grbwtoyear."-".$grbwtomonth."-".$grbwtoday."'";
			if($j>0)
			{
				$condition = clean($_POST['option4']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='BW')) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='BW')) ";
			$j++;		
		}
		else if($option==5)
		{
			$grbwday = clean($_POST['grbwday']);
			$grbwmonth = clean($_POST['grbwmonth']);
			$grbwyear = clean($_POST['grbwyear']);				
			if($grbwday<=9)
			{
				$grbwday = "0".$grbwday;
			}
			if($grbwmonth<=9)
			{
				$grbwmonth = "0".$grbwmonth;
			}				
			$mail_date = "'".$grbwyear.$grbwmonth.$grbwday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option5']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='BW' )) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='BW' )) ";
			$j++;
		}
		else if($option==6)
		{
			$grfbmfromday = clean($_POST['grfbmfromday']);
			$grfbmfrommonth = clean($_POST['grfbmfrommonth']);
			$grfbmfromyear = clean($_POST['grfbmfromyear']);
			$grfbmtoday = clean($_POST['grfbmtoday']);
			$grfbmtomonth = clean($_POST['grfbmtomonth']);
			$grfbmtoyear = clean($_POST['grfbmtoyear']);
			if($grfbmfromday<=9)
			{
				$grfbmfromday = "0".$grfbmfromday;
			}
			if($grfbmtoday<=9)
			{
				$grfbmtoday = "0".$grfbmtoday;
			}
			if($grfbmfrommonth<=9)
			{
				$grfbmfrommonth = "0".$grfbmfrommonth;
			}
			if($grfbmtomonth<=9)
			{
				$grfbmtomonth = "0".$grfbmtomonth;
			}
			$mail_from_date = "'".$grfbmfromyear."-".$grfbmfrommonth."-".$grfbmfromday."'";
			$mail_to_date = "'".$grfbmtoyear."-".$grfbmtomonth."-".$grfbmtoday."'";
			if($j>0)
			{
				$condition = clean($_POST['option6']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='FBM')) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='FBM')) ";
			$j++;
		}
		else if($option==7)
		{
			$grfbmday = clean($_POST['grfbmday']);
			$grfbmmonth = clean($_POST['grfbmmonth']);
			$grfbmyear = clean($_POST['grfbmyear']);				
			if($grfbmday<=9)
			{
				$grfbmday = "0".$grfbmday;
			}
			if($grfbmmonth<=9)
			{
				$grfbmmonth = "0".$grfbmmonth;
			}				
			$mail_date = "'".$grfbmyear."-".$grfbmmonth."-".$grfbmday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option7']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='FBM' )) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='FBM' )) ";
			$j++;	
		}
		else if($option==8)
		{
			$grannfromday = clean($_POST['grannfromday']);
			$grannfrommonth = clean($_POST['grannfrommonth']);
			$grannfromyear = clean($_POST['grannfromyear']);
			$granntoday = clean($_POST['granntoday']);
			$granntomonth = clean($_POST['granntomonth']);
			$granntoyear = clean($_POST['granntoyear']);
			if($grannfromday<=9)
			{
				$grannfromday = "0".$grannfromday;
			}
			if($granntoday<=9)
			{
				$granntoday = "0".$granntoday;
			}
			if($grannfrommonth<=9)
			{
				$grannfrommonth = "0".$grannfrommonth;
			}
			if($granntomonth<=9)
			{
				$granntomonth = "0".$granntomonth;
			}
			$mail_from_date = "'".$grannfromyear."-".$grannfrommonth."-".$grannfromday."'";
			$mail_to_date = "'".$granntoyear."-".$granntomonth."-".$granntoday."'";
			if($j>0)
			{
				$condition = clean($_POST['option8']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='ANN')) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='ANN')) ";
			$j++;				
		}
		else if($option==9)
		{
			$grannday = clean($_POST['grannday']);
			$grannmonth = clean($_POST['grannmonth']);
			$grannyear = clean($_POST['grannyear']);				
			if($grannday<=9)
			{
				$grannday = "0".$grannday;
			}
			if($grannmonth<=9)
			{
				$grannmonth = "0".$grannmonth;
			}				
			$mail_date = "'".$grannyear."-".$grannmonth."-".$grannday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option9']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='ANN' )) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='ANN' )) ";
			$j++;
		}
		else if($option==10)
		{
			$grgcrfromday = clean($_POST['grgcrfromday']);
			$grgcrfrommonth = clean($_POST['grgcrfrommonth']);
			$grgcrfromyear = clean($_POST['grgcrfromyear']);
			$grgcrtoday = clean($_POST['grgcrtoday']);
			$grgcrtomonth = clean($_POST['grgcrtomonth']);
			$grgcrtoyear = clean($_POST['grgcrtoyear']);
			if($grgcrfromday<=9)
			{
				$grgcrfromday = "0".$grgcrfromday;
			}
			if($grgcrtoday<=9)
			{
				$grgcrtoday = "0".$grgcrtoday;
			}
			if($grgcrfrommonth<=9)
			{
				$grgcrfrommonth = "0".$grgcrfrommonth;
			}
			if($grgcrtomonth<=9)
			{
				$grgcrtomonth = "0".$grgcrtomonth;
			}
			$mail_from_date = "'".$grgcrfromyear."-".$grgcrfrommonth."-".$grgcrfromday."'";
			$mail_to_date = "'".$grgcrtoyear."-".$grgcrtomonth."-".$grgcrtoday."'";
			if($j>0)
			{
				$condition = clean($_POST['option10']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='GCR')) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE (mail_date>".$mail_from_date." AND mail_date<".$mail_to_date.") AND mail_category='GCR')) ";
			$j++;		
		}
		else if($option==11)
		{
			$grgcrday = clean($_POST['grgcrday']);
			$grgcrmonth = clean($_POST['grgcrmonth']);
			$grgcryear = clean($_POST['grgcryear']);				
			if($grgcrday<=9)
			{
				$grgcrday = "0".$grgcrday;
			}
			if($grgcrmonth<=9)
			{
				$grgcrmonth = "0".$grgcrmonth;
			}				
			$mail_date = "'".$grgcryear.$grgcrmonth.$grgcrday."'";				
			if($j>0)
			{
				$condition = clean($_POST['option11']);
				$sqlQuery = $sqlQuery.$condition." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='GCR' )) ";
			}
			else
				$sqlQuery = $sqlQuery." ( mail_id in (SELECT mail_id from students_mail_history WHERE mail_date=".$mail_date." AND mail_category='GCR' )) ";
			$j++;
		}
	}
	$sqlQuery1 = $sqlQuery1." WHERE ( ".$sqlQuery." ) ";
	
	
	
	$workbook_title = "SentMailReports_".date('Y').date('m').date('d').date('h').date('i').date('s').".xls";
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
	$worksheet0 =& $workbook->addWorksheet('SentMail_Reports');
	$worksheet0->setHeader( "University Health Centre" , 0.5 );
	$worksheet0->setFooter( "University Health Centre" , 0.5 );
	$worksheet0->write(0, 0, "Mail id", $format_title);
	$worksheet0->write(0, 1, "Student Id", $format_title);
	$worksheet0->write(0, 2, "Student Name", $format_title);
	$worksheet0->write(0, 3, "Student EmailId", $format_title);
	$worksheet0->write(0, 4, "Mail Date", $format_title);
	$worksheet0->write(0, 5, "Mail Category", $format_title);
	$worksheet0->write(0, 6, "Mail Sent Time", $format_title);
		
			
	$result = mysql_query($sqlQuery1);
	$row = mysql_fetch_array($result);
	
	if($row)
	{
		$i=1;		
		do
		{
			$worksheet0->write($i, 0, $row['mail_id'], $format_body);
			$worksheet0->write($i, 1, $row['student_id'], $format_body);
			$worksheet0->write($i, 2, $row['student_name'], $format_body);			
			$worksheet0->write($i, 3, $row['student_email'], $format_body);			
			$worksheet0->write($i, 4, $row['mail_date'], $format_body);			
			$worksheet0->write($i, 5, $row['mail_category'], $format_body);			
			$worksheet0->write($i, 6, $row['lastupdateddatetime'], $format_body);						
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