<?php
	//Start session
	session_start();
	
	$_SESSION['SESS_MEMBER_ID'] = '035038';
	
	if(isset($_SESSION['BIRTHDAY_WISHES']))
	{
		if(($_SESSION['BIRTHDAY_WISHES']!=date('d')))  
		{
			unset($_SESSION['BIRTHDAY_WISHES']);
		}
	}
	
	if(isset($_SESSION['APP_REMINDER']))
	{
		if($_SESSION['APP_REMINDER']!=date('d'))
		{
			unset($_SESSION['APP_REMINDER']);
		}
	}
	
	if(isset($_SESSION['ANNOUNCEMENT']))
	{
		if($_SESSION['ANNOUNCEMENT']!=date('d'))
		{
			unset($_SESSION['ANNOUNCEMENT']);
		}
	}
	
	if(isset($_SESSION['FEEDBACK']))
	{
		if($_SESSION['FEEDBACK']!=date('d'))
		{
			unset($_SESSION['FEEDBACK']);
		}
	}
	
	if(isset($_SESSION['REPORTS']))
	{
		if($_SESSION['REPORTS']!=date('d')) 
		{
			unset($_SESSION['REPORTS']);
		}
	}
	
	$_SESSION['AUTOMATION'] = false; //automation status
	$_SESSION['TIME'] = date('i'); // automation initial time
	
	if(isset($_SESSION['AUTOMATION']))
	{
		if(!$_SESSION['AUTOMATION'])
		{
			$log = array();
			$log[] = 'Automation activity is disabled at <script>document.write(Date()).';
			$_SESSION['LOG'] = $log;
			$_SESSION['err_status_flag'] = true;
		}		
	}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta HTTP-EQUIV="REFRESH" CONTENT="3;URL=index.php">
<title>University Health Centre</title>
<style>
/** LOADING BAR **/


body {
  background: url(img/background.jpg);
  font-family: "Roboto", sans-serif;
  color: white;
  text-align: center;
  margin: 0;
  padding: 0;
}

h1 {
  font-weight: 300 !important;
  margin-top: 30px;
}

h2 {
  font-weight: 100 !important;
  margin-top: -20px;
}

p { font-weight: 100; }

.loader {
  z-index: 99;
  position: fixed;
  top: 10px;
  width: 100%;
}

.loader > span {
  display: inline-block;
  background: #dbdbdb;
  width: 5px;
  height: 5px;
  border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  margin: 0px;
  position: fixed;
  top: 50%;
  left: -10%;
  transition: 1.4s all cubic-bezier(0.030, 0.615, 0.995, 0.415);
  -o-transition: 1.4s all cubic-bezier(0.030, 0.615, 0.995, 0.415);
  -ms-transition: 1.4s all cubic-bezier(0.030, 0.615, 0.995, 0.415);
  -moz-transition: 1.4s all cubic-bezier(0.030, 0.615, 0.995, 0.415);
  -webkit-transition: 1.4s all cubic-bezier(0.030, 0.615, 0.995, 0.415);
  z-index: 101;
}

.loader > span.jmp {
  transition: none !important;
  -o-transition: none !important;
  -ms-transition: none !important;
  -moz-transition: none !important;
  -webkit-transition: none !important;
}

.loader span.l-1 { background: #e74c3c; }

.loader span.l-2 { background: #e67e22; }

.loader span.l-3 { background: #f1c40f; }

.loader span.l-4 { background: #2ecc71; }

.loader span.l-5 { background: #3498db; }

.loader span.l-6 { background: #9b59b6; }
</style>
</head>

<body>
<div style="top:40%;position:absolute;left:30%;"><h2>Welcome University Health Centre Community</h2></div>
<div class="yourPage" style="top:20%;position:relative;">
  <div class="loader" > <span class="l-1"></span> <span class="l-2"></span> <span class="l-3"></span> <span class="l-4"></span> <span class="l-5"></span> <span class="l-6"></span> </div><h3>&nbsp;</h3><h3>&nbsp;</h3><h3>&nbsp;</h3>
 
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script>
jQuery("document").ready(function($){
	var _pageWidth = $("body").outerWidth();
	var _timing = _pageWidth + 3500;
  	$(".loader span").each(function (i) {
		    // store the item around for use in the 'timeout' function
		    var _item = $(this); 
		    // execute this function sometime later:
		    setTimeout(function($) { 
		      _item.removeClass("jmp");
		      _item.css({"left": '110%'});
		      /* console.log("loop"); */
		    }, 180*i); //move each dot one after the other, transition handled by CSS
		    setTimeout(function($) { 
		      _item.addClass("jmp");
		      _item.css({"left": '-10%'});
		      /* console.log("de-loop"); */
		    }, 3000 + 180*i); //move each dot one back to start in order, transition removed via <.jmp> class
		}); //RUN ONCE OUT OF LOOP, AVOID DELAY
  
	$("window").resize(function(){
		var _pageWidth = $("body").outerWidth();
		var _timing = _pageWidth + 3500;
	});
	  
	  
	var _pageLoader = setInterval(function(){
		$(".loader span").each(function (i) {
		    // store the item around for use in the 'timeout' function
		    var _item = $(this); 
		    // execute this function sometime later:
		    setTimeout(function($) { 
		      _item.removeClass("jmp");
		      _item.css({"left": '110%'});
		      /* console.log("loop"); */
		    }, 180*i); //move each dot one after the other, transition handled by CSS
		    setTimeout(function($) { 
		      _item.addClass("jmp");
		      _item.css({"left": '-10%'});
		      /* console.log("de-loop"); */
		    }, 3000 + 180*i); //move each dot one back to start in order, transition removed via <.jmp> class
		});				
	}, _timing);
});
</script>
<span style="display:none;">
<audio controls autoplay>
  <source src="img/startup.mp3" type="audio/mp3">
  Your browser does not support the audio element.
</audio>
</span>

</body>
</html>
