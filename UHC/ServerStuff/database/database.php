<?php
/*============================================
Database credentials. Any change in table/view 
name then modifications are required in below
variables
==============================================*/

/* MySql Credentials */
$db_server = 'localhost' ; //localhost server name
$db_login = 'root'; //username to connect to database server
$db_password = ''; //password to connect to database server

/* Email Credentials */
$host = "ssl://smtp.gmail.com";
$port = "465";
$email_From = "kandurikalyan@gmail.com";
$email_Username = "kandurikalyan@gmail.com"; // same as From email id
$email_Password = "viswani@32"; // password in order to connect to email server
$email_Admin = "kandurikalyan@gmail.com"; //admin email id useful during report generation


/* SMS Credentials */
$sms_AccountSid = "AC9cc1f71a34c7d9d3712b103be974be07"; //Twilio AccountSid. Taken from Twilio.com
$sms_AuthToken = "28549e67b0976829fc5ffecbf1b4d70e"; //Twilio AuthToken. Taken from Twilio.com
$sms_From = '+12085059772'; //Twilio Account Mobile Number

/* Database details */
$db_uhc = 'uhc'; //database name for UHC portal
$tb_students_today_birthday = 'students_today_birthday_list'; //table name for students having birthday on this day (taken from UHC database)
$tb_students_future_birthday = 'students_future_birthday_list'; //table name for students having birthday in future (taken from UHC database)
$tb_students_appointments = 'students_appointments'; //table name for students appointments
$tb_students_emailid = 'students_emailid'; //table name for all students email ids
$tb_students_currentday_appointments = 'students_currentday_appointments'; //table name for students having their appointment for today.
$tb_students_nextday_appointments = 'students_nextday_appointments'; //table name for students having their appointment for tomorrow.
$tb_students_appointments_next7days = 'students_appointments_next7days'; //table name for students having their appointment for next 7days.
$tb_students_appointments_next14days = 'students_appointments_next14days'; //table name for students having their appointment for next 14days.
$tb_students_currentmonth_appointments = 'students_currentmonth_appointments'; //table name for students having their appointment for current month.
$tb_students_previousmonth_appointments = 'students_previousmonth_appointments'; //table name for students having their appointment for previous month.
$tb_students_finishedappointments = 'students_finishedappointments'; //table name for students who completed their appointments
$tb_students_futureappointments = 'students_future_appointments'; //table name for students who has their appointments in future
$tb_students_overall_feedback = 'students_overall_feedback'; //table name for fetching feedback for the services provided
$tb_students_feedback = 'students_feedback'; //table name for feedback for the services provided
$tb_students_birthday_mail_history = 'students_birthday_mail_history' ;//table name for birthday mail history
$tb_mail_history = 'students_mail_history';//table name for mail history
$tb_students_feedback_mail_history = 'students_feedback_mail_history';//table name for feedback mail history
$tb_students_reminder_mail_history = 'students_reminder_mail_history';//table name for reminder mail history
$tb_automation_mail_history = 'automation_history';//table name for automation mail history
$tb_automation_activity_log = 'automation_activity_log'; //table name for automation activity log
?>