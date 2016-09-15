<!DOCTYPE html>
<html>
    <head>
        <title>****TITLE**** - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    </head>
    <body>
        <div id="back_nav">
			<div id="wrapper">
				<header>
					<a id="login_blue" class="menu menu_blue" href="login.php"><?php 
                                                                        if (session_id() == '')
                                                                        {
                                                                            session_start();
                                                                        }
                                                                        if(isset($_SESSION['email']))
                                                                            echo 'SIGN OUT</a>';
                                                                        else 
                                                                            echo 'SIGN IN</a>';?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					<a id="new" class="menu menu_blue" href="request.php">REQUEST</a>	
				</header>
					<div id="content">
                        *****PUT YOUR CONTENT HERE*****
                        TEMPLATE INPUTS:<br/>
                        Text input example: <input id="text_input" type="text" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" autofocus placeholder="Text template"/><br>
                        
                        Date input example: <input id="date_input" type="date" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" autofocus placeholder="Date template"/><br>
                        
                        Password input example: <input id="password_input" type="password" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" placeholder="Password template"/><br>
                        
                        Mobile phone input example:  <input type="tel" name="DESCRIPTION OF INFORMATION (1 WORD)" size="12" maxlength="10" class="input_text" placeholder="Phone template"/><br>
                        
                        Number input example: <input type="number" name="DESCRIPTION OF INFORMATION (1 WORD)" size="12" maxlength="10" class="input_text" placeholder="Phone template"/><br>
                        
                        Email input example: <input type="email" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" placeholder="Email template" required/><br>
                        
                        Submit input example: <input id='signup_button' type="submit" value="SUBMIT" class="button">
					</div>
				</div>
                <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
			</div>
    </body>
</html>