<?php
	//Start session
	session_start();
	
	/*===========================================================
	*** variable APP_START is boolean.
	*** On setting APP_START = true, application will run 
	*** successfully. If the variable is unset then application
	*** will no longer opens.
	*** 
	*** In order to make application inactive then uncomment unset
	*** code and comment setting line and vice versa to make it
	***	active.
	=============================================================*/
	$_SESSION['APP_START'] = true;
	//unset($_SESSION['APP_START']);
?>