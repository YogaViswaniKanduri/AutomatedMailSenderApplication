<?php
	require_once('ServerStuff/database/auth.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>University Health Centre</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/droptiles.css?v=14">
<link rel="stylesheet" media="all" type="text/css" href="css/metroMenu.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/user.css" />
<link href="css/jquery.w8n.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/angular-1.3.2.min.js"></script>
<style>

meter {
  width: 160px;
  height: 38px;
  -webkit-appearance: none; /* Reset appearance */
  -moz-appearance: meterchunk;
  border: 1px solid #ccc;
  background-color:#C0C0C0;
  padding: 5px  5px 5px 5px;
  border-radius: 5px;
}
meter::-webkit-meter-bar {
  /* Let's animate this */
  animation: animate-stripes 5s linear infinite;
  background: url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter::-moz-meter-bar {
    /* Let's animate this */  
  background: url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter::-webkit-meter-optimum-value{
	background: #00CC00 url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter:-moz-meter-optimum::-moz-meter-bar{
	background: #00CC00 url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter::-webkit-meter-suboptimum-value{
	background: #FF944D url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter:-moz-meter-sub-optimum::-moz-meter-bar{
	background: #FF944D url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter::-webkit-meter-even-less-good-value{
	background: #CC3300 url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

meter:-moz-meter-sub-sub-optimum::-moz-meter-bar{
	background: #CC3300 url(img/stars.png) repeat-x;
  background-size: 30px 25px;
}

@keyframes animate-stripes {
  to { background-position: -50px 0; }
}

</style>
</head>
<body onload="notification()">
<!--Windows 8 metromenu-->
      <div id="body" class="unselectable">
		<!--Metreo Menu header starts here-->
        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">                    
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active">                                
                                <a class="brand" href="?"><img src="img/avatar474_2.gif" style="max-height: 20px; margin-top: -2px; margin-right:5px; vertical-align: middle" />University Health Centre</a>
                            </li>
                            <li><a class="active" href="?"><i class="icon-white icon-th-large"></i>Dashboard</a></li>
                            <li><a href="?"><i class="icon-white icon-shopping-cart"></i>University Home</a></li>                            
                            <li>
                                <form id="googleForm" class="navbar-search pull-left" action="http://www.google.com/search" target="_blank">
                                    <input id="googleSearchText" type="text" class="search-query span2" name="q" placeholder="Google">
                                </form>
                            </li>
                        </ul>
                        <ul class="nav pull-right">
                            
                            <li><a href="#" onclick="ui.switchTheme('theme-green')"><i class="icon-white icon-refresh"></i>Reset</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-white icon-tint"></i>Theme<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" onclick="ui.switchTheme('theme-green')">Green</a></li>
                                    <li><a href="#" onclick="ui.switchTheme('theme-white')">White</a></li>
                                    <li><a href="#" onclick="ui.switchTheme('theme-Bloom')">Bloom</a></li>                                    
									<li><a href="#" onclick="ui.switchTheme('theme-Purple')">Purple</a></li>                                    
									<li><a href="#" onclick="ui.switchTheme('theme-SkyBlue')">Sky Blue</a></li>                                    
									<li><a href="#" onclick="ui.switchTheme('theme-LightDark')">Light Dark</a></li>                                    
                                </ul>
                            </li>                            
                            <li data-bind="if: user().isAnonymous"><a href="ServerStuff/Logout.php"><i class="icon-white icon-user"></i>Logout</a></li>
                           <!-- <li data-bind="if: !user().isAnonymous"><a href="?"><i class="icon-white icon-user"></i>Logout</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		<!--Metro Menu Header ends here-->
		<!-- Body of the Windows Metro Menu-->
        <div id="content" style="visibility: hidden">
            <div id="start" data-bind="text: title"></div>
            <div id="user" data-bind="with: user" onclick="ui.settings()">
                <div id="name">
                    <div id="firstname" data-bind="text: firstName"><?php echo $_SESSION['Firstname']; ?></div>
                    <div id="lastname" data-bind="text: lastName"><?php echo $_SESSION['Lastname']; ?></div>
                </div>
                <div id="photo">
                    <img src="img/User No-Frame.png" data-bind="attr: {src: photo}" width="40" height="40" />
                </div>
            </div>
            <div id="browser_incompatible" class="alert">
                <button class="close" data-dismiss="alert">Ã—</button>
                <strong>Warning!</strong>
                Your browser is incompatible with Droptiles. Please use Internet Explorer 9+, Chrome, Firefox or Safari.
            </div>
            <div id="CombinedScriptAlert" class="alert">
                <button class="close" data-dismiss="alert">Ã—</button>
                <strong>Warning!</strong>
                Combined java script files are outdated.                 
                Otherwise it won't work when you will deploy on a server.
            </div>
			<!-- Windows 8 Apps theme -->
			<div class="metro-section">
				<div class="container1" onclick="">
					<div class="metroMenu1">
						<input class="metro" id="mm1" type="radio" name="metro" /> <!-- Todays Activities -->
						<input class="metro" id="mm2" type="radio" name="metro" /> <!-- Birthday wishes -->
						<input class="metro" id="mm3" type="radio" name="metro" /> <!-- Announcement -->
						<input class="metro" id="mm4" type="radio" name="metro" /> <!-- Follow Up-->
						<input class="metro" id="mm5" type="radio" name="metro" /> <!-- Appointment Reminder -->
						<input class="metro" id="mm6" type="radio" name="metro" /> <!-- Reports -->
						<input class="metro" id="mm7" type="radio" name="metro" /> <!-- Message -->
						<input class="metro" id="mm8" type="radio" name="metro" /> <!-- Automation -->
						<input class="metro" id="mmClose" type="radio" name="metro" checked="checked" />
						<ul class="options">
							<li class="s22"><label for="mm1" class="metro"><span>Todays Activities</span></label><label for="mmClose" class="close"></label></li>
							<li class="s11"><label for="mm2" class="metro"><span>Birthday Wishes</span></label><label for="mmClose" class="close"></label></li>
							<li class="s11"><label for="mm3" class="metro"><span>Announcement</span></label><label for="mmClose" class="close"></label></li>
							<li class="s11"><label for="mm4" class="metro"><span>FeedBack</span></label><label for="mmClose" class="close"></label></li>
							<li class="s21"><label for="mm5" class="metro"><span>Appointment Reminder</span></label><label for="mmClose" class="close"></label></li>
							<li class="s11"><label for="mm6" class="metro"><span>Reports</span></label><label for="mmClose" class="close"></label></li>
							<li class="s11"><label for="mm7" class="metro"><span>Message</span></label><label for="mmClose" class="close"></label></li>
							<li class="s11"><label for="mm8" class="metro"><span>Automation</span></label><label for="mmClose" class="close"></label></li>
						</ul>
						<div class="panels" style="color:#fff;">
								<div class="contentPane">
								<!--Content Pane for Student Info System-->
									<span style="text-align:center;top:-20px;position:relative;"><h3>STATUS OF ALL ACTIVITIES FOR TODAY</h3></span>
									<div class="activityPane">
										<table>
										<tr>
											<td width="400" height="45px">Is Birthday wishes sent for students?</td>
											<td>
											<?php
												if(!isset($_SESSION['BIRTHDAY_WISHES']))
												{
													echo "<img src='img/no.jpg' alt='NO' />";
												}
												else
												{
													echo "<img src='img/yes.jpg' alt='NO' />";
												}
											?>
											</td>
										</tr>
										<tr>
											<td width="400" height="45px">Is Appointment Reminder mail sent for students?</td>
											<td>
											<?php
												if(!isset($_SESSION['APP_REMINDER']))
												{
													echo "<img src='img/no.jpg' alt='NO' />";
												}
												else
												{
													echo "<img src='img/yes.jpg' alt='NO' />";
												}
											?>
											</td>
										</tr>
										<tr>
											<td width="400" height="45px">Any announcements made for today?</td>
											<td>
											<?php
												if(!isset($_SESSION['ANNOUNCEMENT']))
												{
													echo "<img src='img/no.jpg' alt='NO' />";
												}
												else
												{
													echo "<img src='img/yes.jpg' alt='NO' />";
												}
											?>
											</td>
										</tr>
										<tr>
											<td width="400" height="45px">Is Feedback mailer sent for students?</td>
											<td>
											<?php
												if(!isset($_SESSION['FEEDBACK']))
												{
													echo "<img src='img/no.jpg' alt='NO' />";
												}
												else
												{
													echo "<img src='img/yes.jpg' alt='NO' />";
												}
											?>
											</td>
										</tr>
										<tr>
											<td width="400" height="45px">Any reports were generated today?</td>
											<td>
											<?php
												if(!isset($_SESSION['REPORTS']))
												{
													echo "<img src='img/no.jpg' alt='NO' />";
												}
												else
												{
													echo "<img src='img/yes.jpg' alt='NO' />";
												}
											?>
											</td>
										</tr>
										</table>
									</div>
								</div>
								<div class="contentPane">
								<!-- Content Pane for Birthday Wishes -->
									<span style="text-align:center;top:-20px;position:relative;"><h3>BIRTHDAY WISHES</h3></span>
									<!-- Birthday wishes form -->
									<div class="birthdayWishes">
										<b><i style="font-family:sans-serif;">Choose type of birthday wishes you would like to send</i></b><br>
										<br>
										<form method="post" onSubmit="return uhcapp.validateBirthday()" action="ServerStuff/sendBirthdayWishes.php">
											<label for="bdwishtype">Type of Wish :</label>
											<select id="bdwishtype" name="bdwishtype">
												<option value="1" selected="selected">Wish Today</option>
												<option value="2">Wish Advance between dates</option>					
												<option value="3">Wish Advance Particular Date</option>	
											</select>
											<label for="bdtemplate">Birthday Template :</label>
											<select id="bdtemplate" name="bdtemplate">
												<option value="0" selected="selected">- - Select Template - -</option>
												<option value="1"> Template 1</option>
												<option value="2"> Template 2</option>
											</select>
											<input id="submit" type="submit" value="SEND WISHES" />
										</form>
									</div>
									<!-- Email Template Viewer -->
									<div id="emailTemplateViewer">
									<img src="" alt="" style="top:40px;position:relative;left:5px;"/>
									</div>
								</div>
								<div class="contentPane">
								<!-- Content Pane for Announcement -->
									<span style="text-align:center;top:-20px;position:relative;">
										<h3>PUBLIC ANNOUNCEMENT</h3>
										<img src="img/announce.png" alt="" style="width:70px;height:70px;border-radius:10px;position:relative;top:-70px;left:-120px;"/>
									</span>
									<span class="makeAnnouncement">
										<b><i style="font-family:sans-serif;">Are you wishing to make public Announcement? Quickly input your message below</i></b><br>
										<br>
										<form method="post" style="position:relative;margin-top:-20px;" onSubmit="return uhcapp.validateAnnoucement()" action="ServerStuff/makeAnnouncement.php">
											<label for="annToList" style="padding-left:20px;">Announcement For : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<select id="annToList" name="annToList">
													<option value="0" selected="selected"> ALL </option>
													<option value="1"> Choose My Recipients</option>													
												</select>
											</label>
											<label for="annSubject" style="top:-15px;position:relative;">
												<input type="text" id="annSubject" maxlength="50" name="annSubject" placeholder="Subject of the Announcement (atleast 10 characters)"/>											
											</label>			
											<label for="annBody" style="top:-30px;position:relative;">
												<textarea id="annBody" ng-model="annBody" name="annBody" placeholder="Announcement Message only (atleast 200 characters). Don't include signatures."></textarea>
											</label>										
											<input id="submit" style="top:-35px;position:relative;margin-left:375px" type="submit" value="MAKE ANNOUNCEMENT" />
										</form>
									</span>
								</div>
								<div class="contentPane">
								<!-- Content Pane for FeedBack -->
									<span style="text-align:center;top:-20px;position:relative;"><h3>FEEDBACK</h3></span>
									<!-- Feedback form -->
									<div class="feedback">
										<b><i style="font-family:sans-serif;">Need feedback from students then give your input below & request for feedback</i></b><br>
										<br/><br/>
										<form method="post" onsubmit="return uhcapp.feedback()" action="ServerStuff/getFeedback.php">
											<label for="feedbackVisitedOn">Feedback for students visited on :</label><br/>
											<select id="feedbackVisitedOn" name="feedbackVisitedOn">
												<option value="0" selected="selected">-- Selected --</option>
												<option value="1"> Between specific dates</option>
												<option value="2"> Particular date</option>
											</select>
											<br/>
											<input id="submit" type="submit" value="REQUEST FOR FEEDBACK" />
										</form>
									</div>
									<!-- Feedback Received till now -->
									<div id="feedbackViewer"><br/>
										<b><i style="font-family:sans-serif;">Feedback Rating Till today</i></b><br>
										<div id="feedbackstats" style="margin-top:10px;padding-left:35px;"></div>
									</div>
								</div>
								<div class="contentPane">
									<!-- Content Pane for Appointment Reminder -->
									<span style="text-align:center;top:-20px;position:relative;"><h3>APPOINTMENT REMINDER</h3></span>
									<!-- Appointment form -->
									<div class="appReminder">
										<b><i style="font-family:sans-serif;">Remind students about their appointments? Make your selection below and send reminders</i></b><br>
										<br/><br/>
										<form method="post" onsubmit="return uhcapp.appointmentRemind()" action="ServerStuff/appointmentRemind.php">
											<label for="remindertime">Remind students whose appointments are :</label><br/>
											<select id="remindertime" name="remindertime">
												<option value="0" selected="selected">-- Selected --</option>
												<option value="1"> Between specific dates</option>
												<option value="2"> Particular date</option>
											</select>
											<br/>
											<input id="submit" type="submit" value="SEND REMINDER" />
										</form>
									</div>
									<!-- Appointment Reminder Image Pane -->
									<div id="appReminderPane"><br/>
										<img src="img/reminder.jpg" alt="" style="top:30px;width:300px;height:200px;border-radius:20px;position:relative;left:-10px;"/>
									</div>
								</div>
								<div class="contentPane">
									<!-- Content Pane for Reports -->
									<span style="text-align:center;top:-20px;position:relative;">
										<h3>GENERATE REPORTS</h3>									
									</span>
									<span class="genReports">
										<b><i style="font-family:sans-serif;">Choose which report is required for you. </i></b><br>
										<br>
										<form method="post" style="position:relative;margin-top:-10px;" onSubmit="return uhcapp.validateReports()" action="ServerStuff/generateReports.php">
											<select id="reports" name="reports" multiple>
												<option value="0"> Students all appointments </option>
												<option value="6"> Students Email ids</option>
												<option value="5" selected> Students appointments for Current day</option>												
												<option value="1"> Students appointments for Next 7 days</option>
												<option value="2"> Students appointments for Next 14 days</option>
												<option value="3"> Students appointments for Current Month</option>
												<option value="4"> Students appointments for Previous Month</option>	
												<option value="7"> Customize Reports </option>
											</select>
											<br/><br/>	
											<label>Would you wish to download or email :</label>
											<span style="position:relative;top:-30px;margin-left:300px;">
												<input type="radio" name="reporttype" value="0" /> <sub><b>Download Report</b></sub> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="radio" name="reporttype" value="1" checked /> <sub><b>Email to Admin</b></sub>
											</span><br/>			
											<sub style="top:-20px;position:relative;"><b>PS: Please don't choose multiple values</b></sub><br/>
											<input id="submit" style="margin-left:15px;top:-20px;position:relative;" type="submit" value="GENERATE REPORTS" />
											<input id="submit" onclick="ui.sentmails()" style="margin-left:235px;top:-65px;position:relative;" type="button" value="GENERATE SENT MAIL REPORTS" />
										</form>
									</span>
								</div>
								<div class="contentPane">
								<!-- Content Pane for Message -->
									<span style="text-align:center;top:-20px;position:relative;"><h3>IMMEDIATE MESSAGE ANNOUNCEMENT</h3><img src="img/new.gif" alt="" style="width:30px;height:30px;border-radius:10px;position:relative;top:-45px;left:205px;"/></span>
									<!-- Message input form -->
									<div class="sendMessage">
										<b><i style="font-family:sans-serif;">Need to convey message? Quickly input your message below</i></b><br>
										<br>
										<form method="post" data-ng-app="" onSubmit="return uhcapp.validateMessage()" action="ServerStuff/sendMessage.php">
											<label for="msgNumber">Mobile Number :</label>
											<input type="text" id="msgNumber" maxlength="13" name="msgNumber" placeholder="+11234567890"/>											
											<label for="msgText">Text Message :</label>
											<textarea id="msgText" ng-model="msgText" name="msgText" maxlength="120" placeholder="Convey message. 120 Characters only" ></textarea>
											<span style="color:red;font-weight:bold;font-size:15px;margin-left:10px;top:30px;position:relative;">{{120-msgText.length}} left</span>
											<input id="submit" type="submit" value="SEND MESSAGE" />
										</form>
									</div>
									<!-- MSG Image Picture -->
									<div id="msgImage">
									<img src="img/sms.gif" alt="" style="top:40px;width:300px;border-radius:20px;position:relative;left:10px;"/>
									</div>
								</div>
								<div class="contentPane">
									<!-- Content Pane for Search -->
									<span style="text-align:center;top:-20px;position:relative;">
										<h3>AUTOMATION SETTINGS</h3>									
									</span>
									<div class="automation">
										<b><i style="font-family:sans-serif;">Create an Automation for your interest:</i></b><br><br>
										<select id="automationname" style="font-size:11px;" name="automationname">
											<option value="0" selected > Appointment Reminder </option>
											<option value="1"> Advance Birthday Wishes </option>
											<option value="2"> Birthday Wishes </option>
										</select>
										&nbsp;
										for next &nbsp;
										<select id="automationdays" name="automationdays">
											<?php
												for($i=1;$i<=30;$i++)
													echo "<option value='".$i."'>".$i."</option>";
											?>
										</select>
										&nbsp;
										day(s), send mails for students &nbsp;
										<select id="automationmailstate" style="font-size:11px;" name="automationmailstate">
											<option value="0" selected > daily once </option>
											<option value="1"> only once </option>											
										</select>
										<br/><br/>
										at &nbsp;
										<select id="automationmailtime" name="automationmailtime">
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
										&nbsp; hours between &nbsp;
										<select id="autofromyear" style="width:65px;font-size:10px;height:30px;" name="autofromyear">
											<?php						
												$j = date('Y');
												for($i=0;$i<=10;$i++)						
													echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
											?>
										</select>
										<select id="autofrommonth" style="width:50px;height:30px;left:-5px;font-size:10px;position:relative;" name="autofrommonth">
											<?php
												for($i=1;$i<=12;$i++)
													echo "<option value='".$i."'>".$i."</option>";
											?>
										</select>
										<select id="autofromday" style="width:50px;height:30px;left:-8px;font-size:10px;position:relative;" name="autofromday">
											<?php
												for($i=1;$i<=31;$i++)
													echo "<option value='".$i."'>".$i."</option>";
											?>
										</select>
										&nbsp; and &nbsp;
										<select id="autotoyear" style="width:65px;font-size:10px;height:30px;" name="autotoyear">
											<?php						
												$j = date('Y');
												for($i=0;$i<=10;$i++)						
													echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
											?>
										</select>
										<select id="autotomonth" style="width:50px;height:30px;left:-5px;font-size:10px;position:relative;" name="autotomonth">
											<?php
												for($i=1;$i<=12;$i++)
													echo "<option value='".$i."'>".$i."</option>";
											?>
										</select>
										<select id="autotoday" style="width:50px;height:30px;left:-8px;font-size:10px;position:relative;" name="autotoday">
											<?php
												for($i=1;$i<=31;$i++)
													echo "<option value='".$i."'>".$i."</option>";
											?>
										</select>
										<br/><br/>
										<span id="jobcreationstatus" style="font-size:12px;"></span>
										<br/><br/>
										<input id="submit" onclick="uhcapp.createCronJob()" style="left:-60px;position:relative;" type="button" value="CREATE A CRON JOB" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input id="submit" onclick="ui.viewCronJobs()" style="left:-165px;position:relative;" type="button" value="VIEW CRON JOBS" />
										<a href="ServerStuff/automation_pages.php" target="_blank" ><input id="submit" style="left:315px;top:-46px;position:relative;" type="button" value="VIEW AUTOMATION LOG" /></a>
										<!--<a href="automation.php" target="_blank"><input type="button" id="submit" value="View Automation Stats" /></a>-->
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
        </div>        
    </div>



</body>
 
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="js/jQueryEnhancement.js"></script>
<script type="text/javascript" src="js/jQuery.MouseWheel.js"></script>
<script type="text/javascript" src="js/jquery.kinetic.js"></script>
<script type="text/javascript" src="js/Knockout-2.1.0.js"></script>
<script type="text/javascript" src="js/knockout.sortable.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/Underscore.js"></script>
<script type="text/javascript" src="js/jQuery.hashchange.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>  
<script type="text/javascript" src="js/User.js"></script>    
<script type="text/javascript" src="js/jquery.w8n.js"></script>
<script type="text/javascript">
    // Bootstrap initialization
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();        
    });
</script>
<script type="text/javascript">
    window.currentUser = new User({
        firstName: "<?php echo $_SESSION['Firstname']; ?>",
        lastName: "<?php echo $_SESSION['Lastname']; ?>",
        photo: "img/User No-Frame.png",
        isAnonymous: true
    });
</script>    
   
<script type="text/javascript" src="js/TheCore.js"></script>
<script type="text/javascript" src="js/Dashboard.js"></script>
<script type="text/javascript" src="js/uhcapp.dashboard.js"></script>


<script type="text/javascript">
	window.profileData = null;
	
	function notification()
	{
		<?php
			$empty_arr = array();//empty initialization
			if( isset($_SESSION['NOTIFY_ARR']) && is_array($_SESSION['NOTIFY_ARR']) && count($_SESSION['NOTIFY_ARR']) >0 && $_SESSION['NOTIFY'] )
			{				
				foreach($_SESSION['NOTIFY_ARR'] as $msg) {
					if($_SESSION['err_status_flag'])
					{	
						echo "$.w8n('Failure Notification', '". substr($msg,0,120) ." ...', {timeout: 2000});";
						echo "$('.w8n-box').css('background-color','#F00');";
					}
					else
					{
						echo "$.w8n('Success Notification', '".$msg."', {timeout: 2000});";
						echo "$('.w8n-box').css('background-color','#A4C400');";
					}
				}
				$_SESSION['NOTIFY'] = false;
			}
		?>
		uhcapp.retrieveFeedback();
	}
	
	
</script>    
</html>