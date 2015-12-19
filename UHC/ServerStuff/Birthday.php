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
                    Birthday Wishes
                </h1>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body" class="container">
        <div class="birthdayWishes1">
			<b><i style="font-family:sans-serif;">Choose type of birthday wishes you would like to send</i></b><br>
			<br>
			<form method="post" onSubmit="return uhcapp.validateBirthday1()" action="sendBirthdayWishes.php">
				<label for="bdwishtype1">Type of Wish :</label>
				<select id="bdwishtype1" name="bdwishtype">
					<option value="1" selected="selected">Wish Today</option>
					<option value="2">Wish Advance between dates</option>					
					<option value="3">Wish Advance Particular Date</option>					
				</select>
				<div style="display:none;" id="bd_advance_between_dates">
					<table style="width:550px;">
						<tr>
							<td style="width:300px;">
								<label> From : (YYYY-MM-DD)</label>
							</td>
							<td>
								<label> TO : (YYYY-MM-DD)</label>
							</td>
						</tr>
						<tr>
							<td>
								<select id="bdfromyear" style="width:70px;" name="bdfromyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=10;$i++)						
											echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
									?>
								</select>
								<select id="bdfrommonth" style="width:60px;left:-5px;position:relative;" name="bdfrommonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="bdfromday" style="width:60px;left:-8px;position:relative;" name="bdfromday">
									<?php
										for($i=1;$i<=31;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
							</td>
							<td>
								<select id="bdtoyear" style="width:70px;" name="bdtoyear">
									<?php						
										$j = date('Y');
										for($i=0;$i<=10;$i++)						
											echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
									?>
								</select>
								<select id="bdtomonth" style="width:60px;left:-5px;position:relative;" name="bdtomonth">
									<?php
										for($i=1;$i<=12;$i++)
											echo "<option value='".$i."'>".$i."</option>";
									?>
								</select>
								<select id="bdtoday" style="width:60px;left:-8px;position:relative;" name="bdtoday">
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
				<div style="display:none;" id="bd_particular_date">
					<label> Select date:</label>
					<select id="bdyear" style="width:70px;" name="bdyear">
						<?php						
							$j = date('Y');
							for($i=0;$i<=10;$i++)						
								echo "<option value='".($j+$i)."'>".($j+$i)."</option>";
						?>
					</select>
					<select id="bdmonth" style="width:70px;left:-5px;position:relative;" name="bdmonth">
						<?php
							for($i=1;$i<=12;$i++)
							{
								echo "<option value='".$i."'>".$i."</option>";
							}
						?>
					</select>
					<select id="bdday" style="width:70px;left:-8px;position:relative;" name="bdday">
						<?php
							for($i=1;$i<=31;$i++)
								echo "<option value='".$i."'>".$i."</option>";
						?>
					</select>
				</div>
				<label for="bdtemplate1">Birthday Template :</label>
				<select id="bdtemplate1" name="bdtemplate">
					<option value="0" selected="selected">- - Select Template - -</option>
					<option value="1"> Template 1</option>
					<option value="2"> Template 2</option>
				</select>
				<br/>
				<input id="submit" type="submit" value="SEND WISHES" />
			</form>
		</div>
		<!-- Email Template Viewer -->
		<div id="emailTemplateViewer1">
		<img src="" alt="" style="top:40px;position:relative;width:300px;height:300px;left:50px;"/>
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

    <script type="text/javascript">
        // Bootstrap initialization
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>

</html>