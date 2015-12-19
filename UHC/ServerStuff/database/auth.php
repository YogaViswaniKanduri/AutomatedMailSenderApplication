<?php
	
	require('app_start.php');
		
	$_SESSION['Firstname'] = 'Kalyan';
	$_SESSION['Lastname'] = 'Kanduri';
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '') || !isset($_SESSION['APP_START'])) {
		header("location:ServerStuff/Logout.php");
		exit();
	}
?>