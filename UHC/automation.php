<?php

	session_start();
?>	

<html>
<head>
<title>University Health Centre</title>
<meta HTTP-EQUIV="REFRESH" CONTENT="25">
<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body onload="triggerMail()" style="background:url(img/background.jpg)">
<h2 style="color:#fff;left:50px;position:absolute;">Automation Active for Appointment Reminder</h2>
<br><br>
<table style="background:#fff;top:30px;position:relative;left:50px;border-radius:5px;box-shadow:0 0 10px;width:800px;height:auto;color:#333">
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>/****************************************/</kbd></td></tr>
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>Log for Appointment reminder activity</kbd></td></tr>
<tr><td width="50px"></td><td style="border-left:1px #000 solid;padding-left:10px;"><kbd>/****************************************/</kbd></td></tr>
<?php
	$sqlQuery = "SELECT * FROM ".$$tb_automation_activity_log."";
	$result = mysql_query($sqlQuery);
	$row = mysql_fetch_array($result);
	//echo $sqlQuery;
	if($row)
	{
			if($_SESSION['err_status_flag'])
			{
				echo "<tr><td width='50px'></td><td style='border-left:1px #000 solid;padding-left:10px;color:#f00;'><kbd>".$msg."</kbd></td></tr>";
			}
			else{
				echo "<tr><td width='50px'></td><td style='border-left:1px #000 solid;padding-left:10px;color:#0f0;'><kbd>".$msg."</kbd></td></tr>";
			}
		}
	}	
?>
</table>
</body>
<script>
function triggerMail()
{
	<?php
		if(isset($_SESSION['AUTOMATION']))
		{
			if($_SESSION['AUTOMATION'])
			{
				if($_SESSION['TIME']==date('i'))
				{
					$time = date('i') + 10;
					if($time>60)
						$time = $time - 60;
					$_SESSION['TIME'] = $time;
					echo '
					myWindow = window.open("http://localhost:8080/UHC/ServerStuff/appointmentRemind.php");
					myVar = setTimeout(function(){myWindow.close()}, 15000);
					';
				}
			}
		}
	?>
}
</script>
</html>
