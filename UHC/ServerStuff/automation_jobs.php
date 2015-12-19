<?php
	require("database/database_auth.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<title>University Health Centre</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Droptiles.css">
	<link rel="stylesheet" type="text/css" href="../css/user1.css" />
	
    <style type="text/css">
        .container {
            margin-left: 100px;
        }
    </style>  
</head>
<body style="background:url(../img/background.jpg)">
<div class="metro appnavbar">
        <ul>
            <li>
                <a class="backbutton" href="breakout.php" onclick="ui.closeApp()">
                    <img src="../img/Metro-Back-48.png" />
                </a>
            </li>
            <li>
                <h3 class="start">
                    Automation Job List
                </h3>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">   		
		<table class="automationjobs" cellpadding="10px;" style="background:#fff;top:10px;position:relative;font-size:12px;font-family:'TimesNewRoman';left:0px;border-radius:5px;box-shadow:0 0 10px;width:auto;height:auto;color:#333">
		<tr style="color:#fff;line-height:25px;background:#000;font-weight:700;">
			<td></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:3px;border-radius:5px;">ID</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Automation For</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Days</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Mail Type</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Mail Time</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Start from</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">End on</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Job Period</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Job Status</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Last Automation Status</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Last Executed Time</kbd></td>
			<td style="padding:5px;"><kbd style="background:#000;padding:2px;border-radius:5px;">Job Created On</kbd></td>			
		</tr>		
		<?php
			$sql = "SELECT automation_history.automation_id, automation_name, automation_days, automation_mailstate, automation_mailtime,
					automation_mailfromdate, automation_mailtodate,
					CASE
					WHEN (automation_mailfromdate <= CURDATE()) AND ( CURDATE() <= automation_mailtodate) THEN 'Active'
					WHEN (automation_mailfromdate > CURDATE()) THEN 'Future Schedule'
					ELSE 'Expired'
					end as Job_Period,
					CASE
					WHEN (automation_mailfromdate > CURDATE()) THEN 'Ready'
					WHEN (automation_mailtodate < CURDATE()) THEN 'Stopped'
					WHEN (automation_jobstatus=0) THEN 'Running'
					ELSE 'Paused'
					end as job_status,
					coalesce(automation_status,'NA') automation_status, 
					coalesce(lastexecuted, 'NA') as automation_lastexecution,
					automation_createddatetime as createdon
					  FROM automation_history
					LEFT JOIN 
					( SELECT A.automation_id, A.automation_status, B.lastexecuted
					FROM automation_activity_log as A
					INNER JOIN
					(SELECT automation_id,max(`log_createddatetime`) as lastexecuted FROM automation_activity_log
					group by automation_id) as B
					on A.automation_id=B.automation_id and A.log_createddatetime=B.lastexecuted) as automation_log
					on automation_history.automation_id = automation_log.automation_id";
			$res = mysql_query($sql);	
			$row = mysql_fetch_array($res);
			//echo $sqlQuery;
			if($row)
			{
				$j=0;
				do
				{
					if($j==0)
					{
						$style='"text-align:center;background:#e6e6e6;height:25px;color:#000000;font-wight:bold;"';
						$j++;
					}
					else
					{
						$style='"text-align:center;background:#FFFFF0;height:25px;color:#000000;font-wight:bold;"';
						$j--;
					}
					echo "
					<tr style=".$style.">
						<td><a href=\"\" onclick=\"uhcapp.deletecronjob(".$row['automation_id'].")\" ><img src=\"../img/delete.png\" alt=\"\" style=\"width:15px;height:15px;\"/></a></td>
						<td>".$row['automation_id']."</td>
						<td>".$row['automation_name']."</td>
						<td>".$row['automation_days']."</td>
						<td>".$row['automation_mailstate']."</td>";
					
					if($row['Job_Period']=="Active")
					{
						echo "<td><select id=\"job_mailtime\" name=\"job_mailtime\" style=\"width:50px;height:25px;font-size:10px;\">";
						for($i=1;$i<=24;$i++)
						{
							if($row['automation_mailtime']==$i)
								echo "<option value=".$i." selected>".$i."</option>";
							else
								echo "<option value=".$i." >".$i."</option>";						
						}
						echo "</select></td>";
					}
					else
					{
						echo "<td>".$row['automation_mailtime']."</td>";
					}					
					
					echo "<td>".$row['automation_mailfromdate']."</td>
						<td>".$row['automation_mailtodate']."</td>
						<td>".$row['Job_Period']."</td>";
					
					if($row['job_status']=="Running")
					{
						echo "<td>
						<select id=\"job_stats\" name=\"job_stats\" style=\"width:80px;height:25px;font-size:10px;\">
							<option value=\"0\" selected> Running </option>
							<option value=\"1\"> Paused </option>
						</select></td>";
					}
					else if($row['job_status']=="Paused")
					{
						echo "<td>
						<select id=\"job_stats\" name=\"job_stats\" style=\"width:80px;height:25px;font-size:10px;\">
							<option value=\"0\"> Running </option>
							<option value=\"1\" selected> Paused </option>
						</select></td>";
					}
					else
					{
						echo "<td>".$row['job_status']."</td>";
					}
					
					echo "						
						<td>".$row['automation_status']."</td>
						<td>".$row['automation_lastexecution']."</td>
						<td>".$row['createdon']."</td>							
					</tr>
					";
					
				}while($row = mysql_fetch_array($res));
			}
		?>		
		</table>		
	</div>
</body>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="../js/jQueryEnhancement.js"></script>
<script type="text/javascript" src="../js/jQuery.MouseWheel.js"></script>
<script type="text/javascript" src="../js/jquery.kinetic.js"></script>
<script type="text/javascript" src="../js/Knockout-2.1.0.js"></script>
<script type="text/javascript" src="../js/knockout.sortable.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/Underscore.js"></script>
<script type="text/javascript" src="../js/jQuery.hashchange.js"></script>
<script type="text/javascript" src="../js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>  
<script type="text/javascript" src="../js/User.js"></script>    
<script type="text/javascript" src="../js/jquery.w8n.js"></script>
<script type="text/javascript" src="../js/TheCore.js"></script>
<script type="text/javascript" src="../js/Dashboard.js"></script>
<script type="text/javascript" src="../js/uhcapp.dashboard.js"></script>
<script type="text/javascript">
    // Bootstrap initialization
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();        
    });
</script>
</html>