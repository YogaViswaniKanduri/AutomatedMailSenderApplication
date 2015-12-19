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
                    Announcement
                </h1>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">
        <div class="makeAnnouncement1">
			<b><i style="font-family:sans-serif;">Are you wishing to make public Announcement? Quickly input your message below</i></b><br>
			<br>
			<form method="post" style="position:relative;margin-top:0px;" onSubmit="return uhcapp.validateAnnouncement1()" action="makeAnnouncement.php">
				<label style="padding-left:20px;">Announcement For : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="annToList" name="annToList" value="0" />&nbsp;&nbsp;&nbsp;<b>ALL</b>&nbsp;&nbsp;&nbsp;
					<input type="radio" id="annToList" name="annToList" value="1" checked />&nbsp;&nbsp;&nbsp;<b>Choose my Options</b>&nbsp;&nbsp;&nbsp;
				</label>
				<div id="options">
					<table style="width:1050px;height:180px;left:-15px;position:relative;border:0.1em #000 dotted;">
						<tr>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="0" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<sub><b>Appointment From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="annappfromyear" style="width:65px;font-size:10px;height:30px;" name="annappfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="annappfrommonth" style="width:50px;left:-5px;position:relative;" name="annappfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="annappfromday" style="width:50px;left:-8px;position:relative;" name="annappfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Appointment To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="annapptoyear" style="width:65px;font-size:10px;height:30px;" name="annapptoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="annapptomonth" style="width:50px;left:-5px;position:relative;" name="annapptomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="annapptoday" style="width:50px;left:-8px;position:relative;" name="annapptoday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td style="padding-left:20px;width:300px;border-right:0.1em #000 dotted;border-bottom:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="2" style="top:15px;position:relative;" />&nbsp;&nbsp;&nbsp;
								<span style="padding-left:155px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option2" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option2" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
								<sub style="padding-left:26px;"><b>Last App. From:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="annlappfromyear" style="width:65px;font-size:10px;height:30px;" name="annlappfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="annlappfrommonth" style="width:50px;left:-5px;font-size:10px;position:relative;" name="annlappfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="annlappfromday" style="width:50px;left:-8px;font-size:10px;position:relative;" name="annlappfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Last App. To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="annlapptoyear" style="width:65px;font-size:10px;height:30px;" name="annlapptoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=6;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="annlapptomonth" style="width:50px;left:-5px;font-size:10px;position:relative;" name="annlapptomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="annlapptoday" style="width:50px;left:-8px;font-size:10px;position:relative;" name="annlapptoday">
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
								<select id="annbdfromyear" style="width:65px;font-size:10px;height:30px;" name="annbdfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="annbdfrommonth" style="width:50px;left:-5px;font-size:10px;position:relative;" name="annbdfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="annbdfromday" style="width:50px;left:-8px;font-size:10px;position:relative;" name="annbdfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<br/>
								<sub style="padding-left:40px;"><b>Birthday To:</b></sub>&nbsp;&nbsp;&nbsp;
								<select id="annbdtoyear" style="width:65px;font-size:10px;height:30px;" name="annbdtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=20;$i++)						
											echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
									?>
								</select>
								<select id="annbdtomonth" style="width:50px;left:-5px;font-size:10px;position:relative;" name="annbdtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="annbdtoday" style="width:50px;left:-8px;font-size:10px;position:relative;" name="annbdtoday">
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
									<select id="annappyear" style="width:65px;font-size:10px;height:30px;" name="annappyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="annappmonth" style="width:50px;font-size:10px;left:-5px;position:relative;" name="annappmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="annappday" style="width:50px;font-size:10px;left:-8px;position:relative;" name="annappday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
							<td style="padding-left:20px;border-right:0.1em #000 dotted;">
								<input type="checkbox" id="options" name="myOptions[]" value="3" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<span style="padding-left:145px;position:relative;padding-bottom:10px;top:-10px;">
									<input type="radio" name="option3" value="AND" checked />&nbsp;&nbsp; <sub><b>AND</b></sub> &nbsp;&nbsp; <input type="radio" name="option3" value="OR"/> &nbsp;&nbsp; <sub><b>OR</b></sub>
								</span>
								<br/>
									<sub style="padding-left:40px;"><b>Last App. On:</b></sub>&nbsp;&nbsp;&nbsp;
									<select id="annlappyear" style="width:65px;font-size:10px;height:30px;" name="annlappyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=6;$i++)						
												echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
										?>
									</select>
									<select id="annlappmonth" style="width:50px;font-size:10px;left:-5px;position:relative;" name="annlappmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="annlappday" style="width:50px;font-size:10px;left:-8px;position:relative;" name="annlappday">
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
									<select id="annbdyear" style="width:65px;font-size:10px;height:30px;" name="annbdyear">
										<?php						
											$j = date('Y');
											for($i=0;$i<=20;$i++)						
												echo "<option value='".($j+$i-6)."'>".($j+$i-6)."</option>";
										?>
									</select>
									<select id="annbdmonth" style="font-size:10px;width:50px;left:-5px;position:relative;" name="annbdmonth">
										<?php
											for($i=1;$i<=12;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
									<select id="annbdday" style="width:50px;font-size:10px;left:-8px;position:relative;" name="annbdday">
										<?php
											for($i=1;$i<=31;$i++)
												echo "<option value='".$i."'>".$i."</option>";
										?>
									</select>
							</td>
						</tr>
					</table>
				</div>
				<label for="annSubject" style="top:15px;position:relative;">
					<input type="text" id="annSubject" maxlength="50" name="annSubject" placeholder="Subject of the Announcement (atleast 10 characters)"/>											
				</label>			
				<label for="annBody" style="top:30px;position:relative;">
					<textarea id="annBody" ng-model="annBody" name="annBody" placeholder="Announcement Message only (atleast 200 characters). Don't include signatures."></textarea>
				</label>	<br><br>	
				<div id="annlater" style="display:none;">
					<kbd style="padding-left:26px;"><b>Make Announcement Later on: </b></kbd>&nbsp;&nbsp;&nbsp;
					<select id="annfannyear" style="width:65px;font-size:10px;height:30px;" name="annfannyear">
						<?php						
							$j = date('Y');
							for($i=0;$i<=10;$i++)						
								echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
						?>
					</select>
					<select id="annfannmonth" style="width:50px;left:-5px;font-size:10px;position:relative;" name="annfannmonth">
						<?php
							for($i=1;$i<=12;$i++)
								echo "<option value='".$i."'>".$i."</option>";
						?>
					</select>
					<select id="annfannday" style="width:50px;left:-8px;font-size:10px;position:relative;" name="annfannday">
						<?php
							for($i=1;$i<=31;$i++)
								echo "<option value='".$i."'>".$i."</option>";
						?>
					</select>
					&nbsp;&nbsp;&nbsp;
					<kbd><b>at</b></kbd>
					&nbsp;&nbsp;&nbsp;
					<select id="automationmailtime" style="width:50px;left:0px;font-size:10px;position:relative;" name="automationmailtime">
						<?php
							for($i=1;$i<=24;$i++)
							{
								if($i==9)
									echo "<option value='".$i."' selected >".$i."</option>";
								else
									echo "<option value='".$i."'>".$i."</option>";
							}
						?>
					</select>
					&nbsp;&nbsp;&nbsp;
					<kbd><b>hours.</b></kbd>
				</div>
				<div id="annTypeSelect">
					<input id="submit" style="top:0px;position:relative;margin-left:275px" type="submit" value="MAKE ANNOUNCEMENT" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="annType" name="annType" value="0" checked /> &nbsp;&nbsp;&nbsp;<sub><b><kbd> Announce Now</b></kbd></sub>&nbsp;&nbsp;&nbsp;
					<input type="radio" id="annType" name="annType" value="1" /> &nbsp;&nbsp;&nbsp;<sub><b><kbd> Announce Later</b></kbd></sub>
				</div>
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