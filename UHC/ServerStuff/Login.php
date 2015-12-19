<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>University Health Centre</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Droptiles.css">
    <style type="text/css">
        .container {
            margin-left: 100px;
        }
    </style>
    
    <script type="text/javascript">
        window.currentUser = new User({
            firstName: <?php echo $_SESSION['Firstname']; ?>,
            lastName: <?php echo $_SESSION['Lastname']; ?>,
            photo: "img/User No-Frame.png",
            isAnonymous: true
        });
    </script>
    <script type="text/javascript">
        // Bootstrap initialization
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
    
    
</head>
<body>
    <div class="metro appnavbar">
        <ul>
            <li>
                <a class="backbutton" href="?" data-bind="click: closeApp">
                    <img src="../img/Metro-Back-48.png" />
                </a>
            </li>
            <li>
                <h1 class="start">
                    Login
                </h1>
            </li>
            </ul>
    </div>

    <div class="appnavbar_space"></div>
        
   <div id="body">
        <div class="container metro">

            <p>
                Are you a new user and want to save your Dashboard?                
            </p>
            <p>
            <a href="?" class="metro-button">Yes, Sign me up.</a>
            </p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>No, I am an existing user. I want to login:</p>
            <form class="metro-form" id="LoginForm">
                <div class="metro-form-control" style="width: 300px">
                    <label>Email</label>
                    <div class="metro-text-box">
                        <input name="username" type="text" autofocus value="yourname@domain.com" />
                        <span class="helper"></span>
                    </div>
                </div>

                <div class="metro-form-control" style="width: 300px">
                    <label>Password</label>
                    <div class="metro-text-box">
                        <input name="password" type="password" value="" />
                        <span class="helper"></span>
                    </div>
                </div>

                <label class="metro-check">
                    <input type="checkbox" name="remember" checked>
                    <span>Remember Me</span>
                </label>
<!--
                <span ID="MessagePanel" runat="server" Visible="false">
                    <span class="label label-important">Error</span>
                    <span ID="Message"/>
                </span>
-->
                    
                <input ID="LoginButton" OnClick="LoginButton_Click" type="button" Class="metro-button" value="Login" />
            
            </form>    
        </div>
        
    </div>
</body>



</html>