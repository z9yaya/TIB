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
					<a id="tracking" class="menu menu_blue selected" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
					<a id="driverform" class="menu menu_blue" href="driverform.php">DRIVER</a>
				</header>
				
				<div id="content">
				<h2>Driver Form</h2>
					  <div id="form">
					  <form>
					    <label for="full_name">Full Name:</label>
						<input id="text_input" type="text" name="full_name" class="input_text" size="15" maxlength="30" autofocus placeholder="Full Name"><br><br>
					    <label for="package_id">Package ID:</label>
						<input id="text_input" type="text" name="package_id" class="input_text" size="15" maxlength="30" autofocus placeholder="Package ID"><br><br>
						<label for="package_content">Package Content:</label>
						<input id="time_input" type="time" name="package_content" class="input_text" size="15" maxlength="30" autofocus placeholder="Package Content"><br><br>
						<label for="location">Location:</label>
						<input id="text_input" type="text" name="location" class="input_text" size="15" maxlength="30" autofocus placeholder="Location"><br><br>
						<label for="time">Time:</label>
						<input id="time_input" type="time" name="time" class="input_text" size="15" maxlength="30" autofocus placeholder="Time"><br><br>
						<input id='submit_button' type="submit" value="SUBMIT" class="button">&nbsp;&nbsp;&nbsp;
						<input id='reset_button' type="reset" value="RESET" class="button">
						</form>
                        <footer id="footer">
                        <p>Done by Elias Mehari - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>


