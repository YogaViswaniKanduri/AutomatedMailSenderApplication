<?php
/*=========================================
automation_pages.php

automation of created jobs
===========================================*/
require("database/database_auth.php");
include "Mail.php";
include "Mail\mime.php";

	//date_default_timezone_set('America/Los_Angeles');
	date_default_timezone_set('Asia/Kolkata');
	
	$sqlQuery = "SELECT * FROM ".$tb_automation_mail_history." WHERE automation_mailtime='".date('H')."' AND automation_jobstatus='0' AND (CURDATE()  BETWEEN automation_mailfromdate AND automation_mailtodate) AND automation_id not in (SELECT automation_id FROM ".$tb_automation_activity_log." WHERE date_format(log_createddatetime, '%Y-%m-%d')=CURDATE())";
	$result = mysql_query($sqlQuery);
	$row = mysql_fetch_array($result);
	//echo $sqlQuery;
	if($row)
	{
		do
		{
			$autoname = $row['automation_name'];
			$autodays = $row['automation_days'];
			$autoid = $row['automation_id'];
			$automailstate = $row['automation_mailstate'];
						
			if($autoname=='Appointment_Reminder')
			{
				$email_To = array(); // array to store email recipients list
				$mail_category = "APPR";
				$date = "";
				
				$sqlQuery1 = "SELECT * FROM ".$tb_students_futureappointments." WHERE datediff(appointment_date,CURDATE())<=".$autodays." AND datediff(appointment_date,CURDATE())>=0";
				$txt = "";
				if($automailstate=="daily once")
				{
					$txt = " AND student_email NOT IN (SELECT student_email FROM ".$tb_students_reminder_mail_history." WHERE mail_category='APPR' and mail_date=CURDATE())";
				}
				else if( $automailstate=="only once" )
				{
					$txt = " AND student_email NOT IN (SELECT student_email FROM ".$tb_students_reminder_mail_history." WHERE mail_category='APPR' and datediff(CURDATE(),mail_date)<".$autodays." )";
				}
				$sqlQuery1 = $sqlQuery1.$txt;
				
				$result1 = mysql_query($sqlQuery1);
				$row1 = mysql_fetch_array($result1);
				$student_id = array();
				$student_name = array();
				$mailerstatus = true;
				$notifymsg = "";
				
				if($row1)
				{
					do
					{
						$student_id[] = $row1['student_id'];
						$student_name[] = $row1['student_name'];
						$email_To[] = $row1['student_email'];
					}while($row1 = mysql_fetch_array($result1));
				}
				else
				{
					$mailerstatus = false;
					$notifymsg = "since No email ids were present to trigger mail";					
					$notify = true;					
				}
				//echo $sqlQuery1;
				$errstatus = false;
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
						$errstatus = true;
						$notifymsg = "since mail triggered was not working properly ".$mail->getMessage();						
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
								$result1 = @mysql_query($query);	
								if($result1)
									$stat=true;
								else
									$stat=false;				
						}	
						if($stat)
						{
							$errstatus = false;
						}
						else
						{
							$notifymsg = ", partially worked out. Mail was triggered successfully but insertion error in mail history";
							$errstatus = true;
						}
					}	
				}
				$msg = "";
				$stat = "";
				if(!$mailerstatus || $errstatus)
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was failed at ".date('Y-m-d H:i:s')." ".$notifymsg;
					$stat = "FAILED";
				}
				else
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was success at ".date('Y-m-d H:i:s');
					$stat = "SUCCESS";
				}
				$query = "INSERT INTO ".$tb_automation_activity_log." VALUES( NULL, '".$autoid."', '".$msg."', '".$stat."' ,CURRENT_TIMESTAMP)";
				$result2 = @mysql_query($query);	
			}
			else if($autoname=='Advance_Birthday_Wishes')
			{
				$email_To = array(); // array to store email recipients list
				$mail_category = "ADBW";
				$d=strtotime("+".$autodays." Days");
				$bddate = date("Ymd",$d);
				$todate = date("Ymd");
				$sqlQuery1 = "SELECT * FROM ".$tb_students_future_birthday." WHERE CONCAT('".date('Y')."',student_dob_month,student_dob_day)>=".$todate." AND CONCAT('".date('Y',$d)."',student_dob_month,student_dob_day)<=".$bddate;
				$txt = "";
				if($automailstate=="daily once")
				{
					$txt = " AND student_email NOT IN (SELECT distinct student_email FROM ".$tb_students_birthday_mail_history." WHERE mail_category='ADBW' and mail_date=CURDATE())";
				}
				else if( $automailstate=="only once" )
				{
					$txt = " AND student_email NOT IN (SELECT distinct student_email FROM ".$tb_students_birthday_mail_history." WHERE mail_category='ADBW' and datediff(CURDATE(),mail_date)<".$autodays." )";
				}
				$sqlQuery1 = $sqlQuery1.$txt;
				
				$result1 = mysql_query($sqlQuery1);
				$row1 = mysql_fetch_array($result1);
				$student_id = array();
				$student_name = array();
				$mailerstatus = true;
				$notifymsg = "";
				
				if($row1)
				{
					do
					{
						$student_id[] = $row1['student_id'];
						$student_name[] = $row1['student_name'];
						$email_To[] = $row1['student_email'];
					}while($row1 = mysql_fetch_array($result1));
				}
				else
				{
					$mailerstatus = false;
					$notifymsg = "since No email ids were present to trigger mail";					
					$notify = true;					
				}
				
				$errstatus = false;
				
				if($mailerstatus)
				{
					//Email Customization
					$subject = ""; //Email Subject
					$text = 'Wishes from University Health Centre';//email Text
					
					$subject = 'Advance Birthday Wishes : Enjoy on your birthday ...';					
					
					//email headers
					$headers = array( 
						'From' => $email_From, 
						'Subject' => $subject
						); 
					
					$crlf = "\r\n";
					$mime = new Mail_mime($crlf);//get mime mail object in order to set headers
					$cid = "";//content id for the images
					
					$mime->addHTMLImage("../img/templates/email/bdemail22.jpg", "image/jpg");
					//here's the butt-ugly bit where we grab the content id
					$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];
					
					
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
						$errstatus = true;
						$notifymsg = "since mail triggered was not working properly ".$mail->getMessage();						
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
								$result1 = @mysql_query($query);	
								if($result1)
									$stat=true;
								else
									$stat=false;				
						}	
						if($stat)
						{						
							$errstatus = false;
						}
						else
						{
							$notifymsg = ", partially worked out. Mail was triggered successfully but insertion error in mail history";
							$errstatus = true;
						}
					}	
				}
				$msg = "";
				$stat = "";
				if(!$mailerstatus || $errstatus)
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was failed at ".date('Y-m-d H:i:s')." ".$notifymsg;
					$stat = "FAILED";
				}
				else
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was success at ".date('Y-m-d H:i:s');
					$stat = "SUCCESS";
				}
				$query = "INSERT INTO ".$tb_automation_activity_log." VALUES( NULL, '".$autoid."', '".$msg."', '".$stat."' ,CURRENT_TIMESTAMP)";
				$result2 = @mysql_query($query);										
			}
			else if($autoname=='Birthday_Wishes')
			{
				$email_To = array(); // array to store email recipients list
				$mail_category = "BW";
				$d=strtotime("+".$autodays." Days");
				$bddate = date("Ymd",$d);
				$automailstate=="daily once";
				$todate = date("Ymd");
				$sqlQuery1 = "SELECT * FROM ".$tb_students_today_birthday." WHERE ";
				$txt = "";
				if($automailstate=="daily once")
				{
					$txt = " student_email NOT IN (SELECT distinct student_email FROM ".$tb_students_birthday_mail_history." WHERE mail_category='BW' and mail_date=CURDATE())";
				}
				else if( $automailstate=="only once" )
				{
					$txt = " student_email NOT IN (SELECT distinct student_email FROM ".$tb_students_birthday_mail_history." WHERE mail_category='BW' and datediff(CURDATE(),mail_date)<".$autodays." )";
				}
				$sqlQuery1 = $sqlQuery1.$txt;
				
				$result1 = mysql_query($sqlQuery1);
				$row1 = mysql_fetch_array($result1);
				$student_id = array();
				$student_name = array();
				$mailerstatus = true;
				$notifymsg = "";
				
				if($row1)
				{
					do
					{
						$student_id[] = $row1['student_id'];
						$student_name[] = $row1['student_name'];
						$email_To[] = $row1['student_email'];
					}while($row1 = mysql_fetch_array($result1));
				}
				else
				{
					$mailerstatus = false;
					$notifymsg = "since No email ids were present to trigger mail";					
					$notify = true;					
				}
				
				$errstatus = false;
				
				if($mailerstatus)
				{
					//Email Customization
					$subject = ""; //Email Subject
					$text = 'Wishes from University Health Centre';//email Text
					
					$subject = 'Birthday Wishes : Many more Happy Returns...';					
					
					//email headers
					$headers = array( 
						'From' => $email_From, 
						'Subject' => $subject
						); 
					
					$crlf = "\r\n";
					$mime = new Mail_mime($crlf);//get mime mail object in order to set headers
					$cid = "";//content id for the images
					
					$mime->addHTMLImage("../img/templates/email/bdemail12.jpg", "image/jpg");
					//here's the butt-ugly bit where we grab the content id
					$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];
					
					
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
						$errstatus = true;
						$notifymsg = "since mail triggered was not working properly ".$mail->getMessage();						
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
								$result1 = @mysql_query($query);	
								if($result1)
									$stat=true;
								else
									$stat=false;				
						}	
						if($stat)
						{						
							$errstatus = false;
						}
						else
						{
							$notifymsg = ", partially worked out. Mail was triggered successfully but insertion error in mail history";
							$errstatus = true;
						}
					}	
				}
				$msg = "";
				$stat = "";
				if(!$mailerstatus || $errstatus)
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was failed at ".date('Y-m-d H:i:s')." ".$notifymsg;
					$stat = "FAILED";
				}
				else
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was success at ".date('Y-m-d H:i:s');
					$stat = "SUCCESS";
				}
				$query = "INSERT INTO ".$tb_automation_activity_log." VALUES( NULL, '".$autoid."', '".$msg."', '".$stat."' ,CURRENT_TIMESTAMP)";
				$result2 = @mysql_query($query);										
			}
			else if($autoname=='Future_Announcement')
			{
				$qry = "SELECT * FROM automation_announcement_history WHERE automation_date='".$row['automation_mailfromdate']."' AND automation_time='".$row['automation_mailtime']."'";
				$res = mysql_query($qry);
				$row1 = mysql_fetch_array($res);
				$sqlQuery1 = "";
				if($row1)
				{
					$sqlQuery1 = $row1['description'];
				}
				
				$notifymsg = "";
				
				$result1 = mysql_query($sqlQuery1);
				$row1 = mysql_fetch_array($result1);
				$student_id = array();
				$student_name = array();
				$mailerstatus = true;
				$mail_category = "ANN";
				
				if($row1)
				{
					do
					{
						$student_id[] = $row1['student_id'];
						$student_name[] = $row1['student_name'];
						$email_To[] = $row1['student_email'];
					}while($row1 = mysql_fetch_array($result1));
				}
				else
				{
					$mailerstatus = false;					
					$notifymsg = "since No email ids were present to trigger mail";					
					$notify = true;					
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
						$errstatus = true;
						$notifymsg = "since mail triggered was not working properly ".$mail->getMessage();						
					}
					else {
						//echo "Shout Eureka!! Message Sent successfully !!!!";
						$notify = true;
						$query = "";
						$stat = false;
						$count = count($email_To);
						for($i=0;$i<$count;$i++)
						{
								$query2 = "INSERT INTO ".$tb_mail_history." VALUES(NULL, '".$student_id[$i]."', '".$student_name[$i]."', '".$email_To[$i]."', CURDATE(), '".$mail_category."', CURRENT_TIMESTAMP)";
								$result2 = @mysql_query($query);	
								if($result2)
									$stat=true;
								else
									$stat=false;				
						}	
						if($stat)
						{						
							$errstatus = false;
						}
						else
						{
							$notifymsg = ", partially worked out. Mail was triggered successfully but insertion error in mail history";
							$errstatus = true;
						}		
					}	
				}
				$msg = "";
				$stat = "";
				if(!$mailerstatus || $errstatus)
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was failed at ".date('Y-m-d H:i:s')." ".$notifymsg;
					$stat = "FAILED";
				}
				else
				{
					$msg = $autoname." for next ".$autodays." days with automation id#: ".$autoid." was success at ".date('Y-m-d H:i:s');
					$stat = "SUCCESS";
				}
				$query = "INSERT INTO ".$tb_automation_activity_log." VALUES( NULL, '".$autoid."', '".$msg."', '".$stat."' ,CURRENT_TIMESTAMP)";
				$result2 = @mysql_query($query);														
			}
		}while($row = mysql_fetch_array($result));
	}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta HTTP-EQUIV="REFRESH" CONTENT="180">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<title>University Health Centre</title>
</head>
<body style="background:url(../img/background.jpg)">
<h2 style="color:#fff;left:50px;position:absolute;">Automation Active log for created jobs</h2>
<br><br>
<h5 style="color:#fff;left:50px;position:absolute;"><font color="#f00">WARNING!</font> Closing this window will shutdown your automation system. Please don't close this window.</h5>
<br>
<table style="background:#fff;top:30px;position:relative;left:50px;border-radius:5px;box-shadow:0 0 10px;width:800px;height:auto;color:#333">
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>/****************************************/</kbd></td></tr>
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>Log for Automation activity</kbd></td></tr>
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>/****************************************/</kbd></td></tr>
<?php
	$sql = "SELECT * FROM ".$tb_automation_activity_log." ORDER BY log_createddatetime DESC LIMIT 0,30";
	$res = mysql_query($sql);	
	$row = mysql_fetch_array($res);
	//echo $sqlQuery;
	if($row)
	{
		do
		{
			$msg = $row['automation_status'];
			if($msg=="FAILED")
			{
				echo "<tr><td width='50px'></td><td style='border-left:1px #000 solid;padding-left:10px;color:#f00;'><kbd>".$row['log_description']."</kbd></td></tr>";
			}
			else{
				echo "<tr><td width='50px'></td><td style='border-left:1px #000 solid;padding-left:10px;color:#090;'><kbd>".$row['log_description']."</kbd></td></tr>";
			}
		}while($row = mysql_fetch_array($res));
	}	
?>
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>...</kbd></td></tr>
</table>
</body>
</html>