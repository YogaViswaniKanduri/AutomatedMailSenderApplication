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
                    Generate Reports
                </h1>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">
        <div class="genReports1">
			<b><i style="font-family:sans-serif;">Choose which report is required for you. Generate reports whose</i></b><br>
			<br>
			<form method="post" style="position:relative;margin-top:0px;" onSubmit="return uhcapp.validateReports1()" action="genReports.php">
				<div id="options">
					<table style="width:1050px;height:180px;left:-15px;position:relative;border:0.1em #000 dotted;">
						<tr>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="0" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<sub><b>Appointment From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grappfromyear" style="width:65px;font-size:10px;height:30px;" name="grappfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grappfrommonth" style="width:50px;left:-5px;position:relative;" name="grappfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grappfromday" style="width:50px;left:-8px;position:relative;" name="grappfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Appointment To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grapptoyear" style="width:65px;font-size:10px;height:30px;" name="grapptoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grapptomonth" style="width:50px;left:-5px;position:relative;" name="grapptomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grapptoday" style="width:50px;left:-8px;position:relative;" name="grapptoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="2" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;								
								<span style="padding-left:185px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option2" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option2" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
								<sub style="padding-left:26px;"><b>Last Appointment From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grlappfromyear" style="width:65px;font-size:10px;height:30px;" name="grlappfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="grlappfrommonth" style="width:50px;left:-5px;position:relative;" name="grlappfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grlappfromday" style="width:50px;left:-8px;position:relative;" name="grlappfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Last Appointment To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grlapptoyear" style="width:65px;font-size:10px;height:30px;" name="grlapptoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="grlapptomonth" style="width:50px;left:-5px;position:relative;" name="grlapptomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grlapptoday" style="width:50px;left:-8px;position:relative;" name="grlapptoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td style="padding-left:20px;width:290px;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="4" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<span style="padding-left:135px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option4" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option4" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
								<sub style="padding-left:27px;"><b>Birthday From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grbdfromyear" style="width:65px;font-size:10px;height:30px;" name="grbdfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grbdfrommonth" style="width:50px;left:-5px;position:relative;" name="grbdfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grbdfromday" style="width:50px;left:-8px;position:relative;" name="grbdfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Birthday To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grbdtoyear" style="width:65px;font-size:10px;height:30px;" name="grbdtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grbdtomonth" style="width:50px;left:-5px;position:relative;" name="grbdtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grbdtoday" style="width:50px;left:-8px;position:relative;" name="grbdtoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td style="padding-left:20px;border-right:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="padding-left:160px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option1" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option1" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Appointment On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grappyear" style="width:65px;font-size:10px;height:30px;" name="grappyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="grappmonth" style="width:50px;left:-5px;position:relative;" name="grappmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grappday" style="width:50px;left:-8px;position:relative;" name="grappday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
							<td style="padding-left:20px;border-right:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="3" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="padding-left:175px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option3" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option3" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Last Appointment On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grlappyear" style="width:65px;font-size:10px;height:30px;" name="grlappyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=6;$i++)						
												echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
										?>
									</select>
									<select id="grlappmonth" style="width:50px;left:-5px;position:relative;" name="grlappmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grlappday" style="width:50px;left:-8px;position:relative;" name="grlappday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
							<td style="padding-left:20px;">
								<input type="checkbox" id="options" name="myOptions[]" value="5" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="padding-left:125px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option5" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option5" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Birthday On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grbdyear" style="width:65px;font-size:10px;height:30px;" name="grbdyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="grbdmonth" style="width:50px;left:-5px;position:relative;" name="grbdmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grbdday" style="width:50px;left:-8px;position:relative;" name="grbdday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
						</tr>
					</table>
				</div>
				<br/>	
				<label>Would you wish to download or email :</label>
				<span style="position:relative;top:-30px;margin-left:300px;">
					<input type="radio" name="reporttype" value="0" /> <sub><b>Download Report</b></sub> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="reporttype" value="1" checked /> <sub><b>Email to Admin</b></sub>
				</span><br/>							
				<input id="submit" style="margin-left:215px;top:-20px;position:relative;" type="submit" value="GENERATE REPORTS" />
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