<?php
/*=========================================
feedback.php

Fetches email from database and trigger mails 
to the fetched list of records
===========================================*/
require("database/database_auth.php");

	$sqlQuery = "SELECT * FROM ".$tb_students_overall_feedback."";
	$result = mysql_query($sqlQuery);
	$row = mysql_fetch_array($result);
	
	if($row)
	{
		echo '<meter max="1.0" low=".40" optimum=".90" high=".60" value="'.(($row['service_rating']*2)/10).'"></meter><br/>
				<label> Service Rating</label><br/>
				<meter max="1.0" low=".40" optimum=".90" high=".60" value="'.(($row['facilities_rating']*2)/10).'"></meter><br/>
				<label> Facilities Rating</label><br/>
				<meter max="1.0" low=".40" optimum=".90" high=".60" value="'.(($row['medication_rating']*2)/10).'"></meter><br/>
				<label> Medication Rating</label>		
		';
	}
	else
	{
		echo '<meter low=".20" optimum=".55" high=".50" value=".5"></meter><br/>
				<label> Service Rating</label><br/>
				<meter low=".20" optimum=".55" high=".50" value=".5"></meter><br/>
				<label> Facilities Rating</label><br/>
				<meter low=".20" optimum=".55" high=".50" value=".5"></meter><br/>
				<label> Medication Rating</label>		
		';
	}
?>