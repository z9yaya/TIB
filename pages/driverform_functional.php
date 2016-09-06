<?php include '../functions/functions.php';
include '../functions/driver.php';

if (!empty($_POST))
{
driverUpdate();
}
?>

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
				
				<div id="content" style="width:160px;">
                    <div id="form">
					  <form class="form" id="driver_form" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                        <span class="sign_title">Driver Form</span><br>
                        <input id="text_input" type="text" name="ID" class="input_text left" size="15" maxlength="10" autofocus placeholder="Delivery ID" required/>
                        <input id="text_input" type="text" name="location" class="input_text" size="15" maxlength="30" autofocus placeholder="Current location" required/>
                        <input id="text_input" type="text" name="time" min="09:00:00" max="17:00:00" class="input_text" size="15" maxlength="30" placeholder="Arrival time" onfocus="(this.type='time')" required/>
                        <input id="date_input" type="text" name="date" min=<?php echo date('Y-m-d');?> class="input_text" size="15" maxlength="30" placeholder="Current date" onfocus="(this.type='date')" required/>
                        <select name="status" class="input_text" style="width: 160px;"/>
                        <option value="In Transit">In transit</option>
                        <option value="Delivered">Delivered</option>
                        </select><br><br><br>
                          
						<input id='submit_button' type="submit" value="SUBMIT" class="button">
						</form>
                    </div>
                        <footer id="footer">
                        <p>Done by Elias Mehari - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>


