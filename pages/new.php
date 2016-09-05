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
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
					<a id="new" class="menu menu_blue selected" href="new.php">NEW</a>
					<a id="driverform" class="menu menu_blue" href="driverform.php">DRIVER</a>					
				</header>
					<div id="content">
                      <h3>New Deliveries Order</h3>
					<div id="left">
                        <input id="text_input" type="text" name="pickup_address" class="input_text" size="15" maxlength="30" autofocus placeholder="Pick up address"><br><br>
						<input id="time_input" type="time" name="pickup_time" class="input_text" size="15" maxlength="30" autofocus placeholder="Pick up time"><br><br>
                        <input id="date_input" type="date" name="pickup_date" class="input_text" size="15" maxlength="30" autofocus placeholder="Pick up date"><br><br>
                    </div>
						  
					<div id="right">
						<input id="text_input" type="text" name="dropoff_address" class="input_text" size="15" maxlength="30" autofocus placeholder="Destination address"><br><br>
						<input id="time_input" type="time" name="dropoff_time" class="input_text" size="15" maxlength="30" autofocus placeholder="Drop off time"><br><br>
                        <input id="date_input" type="date" name="dropoff_date" class="input_text" size="15" maxlength="30" autofocus placeholder="Drop off date"><br><br>
					</div>
						
                        <input type="number" name="package_content" size="12" maxlength="10" class="input_text" placeholder="Package Content"><br><br>
						<textarea>Special construction</textarea><br><br><br><br>
                        <input id='submit_button' type="submit" value="SUBMIT" class="button">
						<input id='reset_button' type="reset" value="RESET" class="button">
                        <footer id="footer"></center>
                        <p>Done by Elias Gebre</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>