<?php
?>
<html>
<head>
<title>University Health Centre</title>
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<style>

body{
	font-family:sans-serif;
	line-height:30px;
	padding-left:20px;
	margin-top:50px;
	color:#333;
}
</style>
</head>
<body>
<form method="post" action="entrySurvey.php">
<h2>Please spare few minutes of your time to finish below survey</h2>
<br/>
<label>1. Services offered by University Health Centre</label>
<br/>&nbsp;&nbsp;&nbsp;
<input type="radio" name="service_rating" value="1" /> Unsatisfactory
&nbsp;&nbsp;&nbsp;
<input type="radio" name="service_rating" value="2" /> Little discomfort
&nbsp;&nbsp;&nbsp;
<input type="radio" name="service_rating" value="2" /> Satisfactory
&nbsp;&nbsp;&nbsp;
<input type="radio" name="service_rating" value="4" /> Good
&nbsp;&nbsp;&nbsp;
<input type="radio" name="service_rating" value="5" checked /> Best
<br/><br/>
<label>2. Facilities provided during your visit to University Health Centre</label>
<br/>&nbsp;&nbsp;&nbsp;
<input type="radio" name="facilities_rating" value="1" /> Unsatisfactory
&nbsp;&nbsp;&nbsp;
<input type="radio" name="facilities_rating" value="2" /> Little discomfort
&nbsp;&nbsp;&nbsp;
<input type="radio" name="facilities_rating" value="2" /> Satisfactory
&nbsp;&nbsp;&nbsp;
<input type="radio" name="facilities_rating" value="4" /> Good
&nbsp;&nbsp;&nbsp;
<input type="radio" name="facilities_rating" value="5" checked /> Best
<br/><br/>
<label>3. Medication provided during your course by University Health Centre</label>
<br/>&nbsp;&nbsp;&nbsp;
<input type="radio" name="medication_rating" value="1" /> Unsatisfactory
&nbsp;&nbsp;&nbsp;
<input type="radio" name="medication_rating" value="2" /> Little discomfort
&nbsp;&nbsp;&nbsp;
<input type="radio" name="medication_rating" value="2" /> Satisfactory
&nbsp;&nbsp;&nbsp;
<input type="radio" name="medication_rating" value="4" /> Good
&nbsp;&nbsp;&nbsp;
<input type="radio" name="medication_rating" value="5" checked /> Best
<br><br>
<input type="submit" value="FINISH SURVEY" />
</form>
</body>
</html>