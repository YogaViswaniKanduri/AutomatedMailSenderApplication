<?php
/*=========================================
entrySurvey.php

Enters survey feedback to database
===========================================*/
require("../ServerStuff/database/database_auth.php");

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$service_rating = clean($_POST['service_rating']);
	$facilities_rating = clean($_POST['facilities_rating']);
	$medication_rating = clean($_POST['medication_rating']);
	
	$sqlQuery = "INSERT INTO ".$tb_students_feedback." VALUES( NULL, '".$service_rating."','".$facilities_rating."','".$medication_rating."', CURRENT_TIMESTAMP)";
	$result = @mysql_query($sqlQuery);
		
	if($result)
	{
		echo 'Thank you for taking survey.';
	}
	else
	{
		echo 'Oops! Something went wrong. Please re-take survey';
	}
?>