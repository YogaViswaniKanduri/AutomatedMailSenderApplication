<?php
	require_once('database/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
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
<body>
    <div class="metro appnavbar">
        <ul>
            <li>
                <a class="backbutton" href="breakout.php" onclick="ui.closeApp()">
                    <img src="../img/Metro-Back-48.png" />
                </a>
            </li>
            <li>
                <h1 class="start">
                    Appointment Reminder
                </h1>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">
        <div class="appReminder1">
			<b><i style="font-family:sans-serif;">Remind students about their appointments? Make your selection below and send reminders</i></b><br>
			<br/><br/>
			<form method="post" onsubmit="return uhcapp.appointmentRemind1()" action="appointmentRemind.php">
				<label for="remindertime1">Remind students whose appointments are :</label><br/>
				<select id="remindertime1" name="remindertime">
					<option value="0" selected="selected">-- Selected --</option>
					<option value="1"> Between specific dates</option>
					<option value="2"> Particular date</option>
				</select>
				<div style="display:none;" id="ar_advance_between_dates">
					<table style="width:550px;">
						<tr>
							<td style="width:300px;">
								<label> From : (YYYY-MM-DD)</label>
							</td>
							<td>
								<label> TO : (YYYY-MM-DD)</label>
							</td>
						</tr
						<tr>
							<td>
								<select id="arfromyear" style="width:70px;" name="arfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=10;$i++)						
											echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
									?>
								</select>
								<select id="arfrommonth" style="width:60px;left:-5px;position:relative;" name="arfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="arfromday" style="width:60px;left:-8px;position:relative;" name="arfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td>
								<select id="artoyear" style="width:70px;" name="artoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=10;$i++)						
											echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
									?>
								</select>
								<select id="artomonth" style="width:60px;left:-5px;position:relative;" name="artomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="artoday" style="width:60px;left:-8px;position:relative;" name="artoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
						</tr>
					</table>
					<br/>
				</div>
				<div style="display:none;" id="ar_particular_date">
					<label> Select date:</label>
					<select id="aryear" style="width:70px;" name="appryear">
						<?php						
							$j = date('Y');
							for($i=0;$i<=10;$i++)						
								echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
						?>
					</select>
					<select id="armonth" style="width:70px;left:-5px;position:relative;" name="apprmonth">
						<?php
							for($i=1;$i<=12;$i++)
							{
								echo "<option value='".$i."'>".$i."</option>";
							}
						?>
					</select>
					<select id="arday" style="width:70px;left:-8px;position:relative;" name="apprday">
						<?php
							for($i=1;$i<=31;$i++)
								echo "<option value='".$i."'>".$i."</option>";
						?>
					</select>
				</div>
				<br/>
				<input id="submit" type="submit" value="REQUEST FOR FEEDBACK" />
			</form>
		</div>		
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