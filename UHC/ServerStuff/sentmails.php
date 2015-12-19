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
                <h3 class="start">
                    Generate Sent Mail Reports
                </h3>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">
        <div class="gensentmailReports">
			<b><i style="font-family:sans-serif;">Choose which report is required for you. Generate reports whose</i></b><br>
			<br>
			<form method="post" style="position:relative;margin-top:0px;" onSubmit="return uhcapp.validateSentMailReports()" action="grsentmails.php">
				<div id="options">
					<table style="width:1050px;height:380px;left:-15px;position:relative;border:0.1em #000 dotted;">
						<tr>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="0" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<sub><b>Reminder Mail From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grapprfromyear" style="width:65px;font-size:10px;height:30px;" name="grapprfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grapprfrommonth" style="width:50px;left:-5px;position:relative;" name="grapprfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grapprfromday" style="width:50px;left:-8px;position:relative;" name="grapprfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Reminder Mail To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grapprtoyear" style="width:65px;font-size:10px;height:30px;" name="grapprtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grapprtomonth" style="width:50px;left:-5px;position:relative;" name="grapprtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grapprtoday" style="width:50px;left:-8px;position:relative;" name="grapprtoday">
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
								<sub style="padding-left:26px;"><b>ADBW Mailer From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="gradbwfromyear" style="width:65px;font-size:10px;height:30px;" name="gradbwfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="gradbwfrommonth" style="width:50px;left:-5px;position:relative;" name="gradbwfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="gradbwfromday" style="width:50px;left:-8px;position:relative;" name="gradbwfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>ADBW Mailer To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="gradbwtoyear" style="width:65px;font-size:10px;height:30px;" name="gradbwtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="gradbwtomonth" style="width:50px;left:-5px;position:relative;" name="gradbwtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="gradbwtoday" style="width:50px;left:-8px;position:relative;" name="gradbwtoday">
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
								<sub style="padding-left:27px;"><b>BW Mail From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grbwfromyear" style="width:65px;font-size:10px;height:30px;" name="grbwfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grbwfrommonth" style="width:50px;left:-5px;position:relative;" name="grbwfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grbwfromday" style="width:50px;left:-8px;position:relative;" name="grbwfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>BW Mail To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grbwtoyear" style="width:65px;font-size:10px;height:30px;" name="grbwtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grbwtomonth" style="width:50px;left:-5px;position:relative;" name="grbwtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grbwtoday" style="width:50px;left:-8px;position:relative;" name="grbwtoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
						</tr>
						<tr style="border-bottom:0.1em #000 dotted;">
							<td style="padding-left:20px;border-right:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="padding-left:160px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option1" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option1" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Reminder Mail On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grappryear" style="width:65px;font-size:10px;height:30px;" name="grappryear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="grapprmonth" style="width:50px;left:-5px;position:relative;" name="grapprmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grapprday" style="width:50px;left:-8px;position:relative;" name="grapprday">
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
									<sub style="padding-left:40px;"><b>ADBW Mailer On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="gradbwyear" style="width:65px;font-size:10px;height:30px;" name="gradbwyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=6;$i++)						
												echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
										?>
									</select>
									<select id="gradbwmonth" style="width:50px;left:-5px;position:relative;" name="gradbwmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="gradbwday" style="width:50px;left:-8px;position:relative;" name="gradbwday">
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
									<sub style="padding-left:40px;"><b>BW Mail On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grbwyear" style="width:65px;font-size:10px;height:30px;" name="grbwyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="grbwmonth" style="width:50px;left:-5px;position:relative;" name="grbwmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grbwday" style="width:50px;left:-8px;position:relative;" name="grbwday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
						</tr>						
						<tr>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="6" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<span style="padding-left:170px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option6" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option4" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
								<sub style="padding-left:27px;"><b>Feedback Mail From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grfbmfromyear" style="width:65px;font-size:10px;height:30px;" name="grfbmfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grfbmfrommonth" style="width:50px;left:-5px;position:relative;" name="grfbmfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grfbmfromday" style="width:50px;left:-8px;position:relative;" name="grfbmfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Feedback Mail To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grfbmtoyear" style="width:65px;font-size:10px;height:30px;" name="grfbmtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grfbmtomonth" style="width:50px;left:-5px;position:relative;" name="grfbmtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grfbmtoday" style="width:50px;left:-8px;position:relative;" name="grfbmtoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="8" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;								
								<span style="padding-left:185px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option8" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option2" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
								<sub style="padding-left:26px;"><b>Announcement From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grannfromyear" style="width:65px;font-size:10px;height:30px;" name="grannfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="grannfrommonth" style="width:50px;left:-5px;position:relative;" name="grannfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grannfromday" style="width:50px;left:-8px;position:relative;" name="grannfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Announcement To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="granntoyear" style="width:65px;font-size:10px;height:30px;" name="granntoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="granntomonth" style="width:50px;left:-5px;position:relative;" name="granntomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="granntoday" style="width:50px;left:-8px;position:relative;" name="granntoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td style="padding-left:20px;width:290px;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="10" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<span style="padding-left:135px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option10" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option4" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
								<sub style="padding-left:27px;"><b>GCR Mail From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grgcrfromyear" style="width:65px;font-size:10px;height:30px;" name="grgcrfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grgcrfrommonth" style="width:50px;left:-5px;position:relative;" name="grgcrfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grgcrfromday" style="width:50px;left:-8px;position:relative;" name="grgcrfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>GCR Mail To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="grgcrtoyear" style="width:65px;font-size:10px;height:30px;" name="grgcrtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="grgcrtomonth" style="width:50px;left:-5px;position:relative;" name="grgcrtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="grgcrtoday" style="width:50px;left:-8px;position:relative;" name="grgcrtoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td style="padding-left:20px;border-right:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="7" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="padding-left:160px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option7" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option1" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Feedback Mail On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grfbmyear" style="width:65px;font-size:10px;height:30px;" name="grfbmyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="grfbmmonth" style="width:50px;left:-5px;position:relative;" name="grfbmmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grfbmday" style="width:50px;left:-8px;position:relative;" name="grfbmday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
							<td style="padding-left:20px;border-right:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="9" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="padding-left:175px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option9" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option3" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Announcement On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grannyear" style="width:65px;font-size:10px;height:30px;" name="grannyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=6;$i++)						
												echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
										?>
									</select>
									<select id="grannmonth" style="width:50px;left:-5px;position:relative;" name="grannmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grannday" style="width:50px;left:-8px;position:relative;" name="grannday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
							<td style="padding-left:20px;">
								<input type="checkbox" id="options" name="myOptions[]" value="11" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="padding-left:125px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option11" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option5" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>GCR Mail On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="grgcryear" style="width:65px;font-size:10px;height:30px;" name="grgcryear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="grgcrmonth" style="width:50px;left:-5px;position:relative;" name="grgcrmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="grgcrday" style="width:50px;left:-8px;position:relative;" name="grgcrday">
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
				<sub><b>PS: ADBW - Advanced Birthday Wishes</b></sub> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<sub><b>BW - Birthday Wishes</b></sub> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<sub><b>GCR - Generated Customized Report</b></sub> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br/><br/>
				<label>Would you wish to download or email :</label>
				<span style="position:relative;top:-30px;margin-left:300px;">
					<input type="radio" name="reporttype" value="0" /> <sub><b>Download Report</b></sub> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="reporttype" value="1" checked /> <sub><b>Email to Admin</b></sub>
				</span><br/>							
				<input id="submit" style="margin-left:215px;top:-20px;position:relative;" type="submit" value="GENERATE SENT MAIL REPORTS" />
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