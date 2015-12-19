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
                    Feedback
                </h1>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">
        <div class="feedback1">
			<b><i style="font-family:sans-serif;">Need feedback from students then give your input below & request for feedback</i></b><br>
			<br/><br/>
			<form method="post" onsubmit="return uhcapp.feedback1()" action="getFeedback.php">
				<label for="feedbackVisitedOn">Feedback for students visited on :</label>
				<select id="feedbackVisitedOn" name="feedbackVisitedOn">
					<option value="0" selected="selected">-- Selected --</option>
					<option value="1"> Between specific dates</option>
					<option value="2"> Particular date</option>
				</select>
				<div style="display:none;" id="fb_advance_between_dates">
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
								<select id="fbfromyear" style="width:70px;" name="fbfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=10;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="fbfrommonth" style="width:60px;left:-5px;position:relative;" name="fbfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="fbfromday" style="width:60px;left:-8px;position:relative;" name="fbfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td>
								<select id="fbtoyear" style="width:70px;" name="fbtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=10;$i++)						
											echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
									?>
								</select>
								<select id="fbtomonth" style="width:60px;left:-5px;position:relative;" name="fbtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="fbtoday" style="width:60px;left:-8px;position:relative;" name="fbtoday">
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
				<div style="display:none;" id="fb_particular_date">
					<label> Select date:</label>
					<select id="fbyear" style="width:70px;" name="fbyear">
						<?php						
							$j = date('Y');
							for($i=0;$i<=10;$i++)						
								echo "<option value='".($j-$i)."'>".($j-$i)."</option>";
						?>
					</select>
					<select id="fbmonth" style="width:70px;left:-5px;position:relative;" name="fbmonth">
						<?php
							for($i=1;$i<=12;$i++)
							{
								echo "<option value='".$i."'>".$i."</option>";
							}
						?>
					</select>
					<select id="fbday" style="width:70px;left:-8px;position:relative;" name="fbday">
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