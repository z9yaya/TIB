<?php include '../functions/functions.php';
include '../functions/request_functions.php';

if (!empty($_POST))
{
registerRequest();
}?>

<!DOCTYPE html>
<html>
    <head>
        <title>Request - drop.it</title>
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
                                                                        {
                                                                            header("Location: login.php?error=request");
                                                                            echo 'SIGN IN</a>';
                                                                        }?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue selected" href="request.php">REQUEST</a>
				</header>
					<div id="content">
                            <div id="form">
                                <form class="form" id="request_form" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                    <span class="sign_title">Request delivery</span><br>
                                    <div id="delivery_text">  
                                    <div id="left_wide">
                                        <textarea id="pickUp"  name="pickUp" class="input_text left textarea text_long textarea_short" placeholder="Pick up location" required autofocus></textarea></br>

                                        <textarea id="dropOff" type="text" name="dropOff" class="input_text right textarea text_long textarea_short" placeholder="Drop off location"  required></textarea><br>

                                        <input id="pickTime" type="text" name="pickTime" min="09:00:00" max="17:00:00" class="input_text left" size="15" maxlength="30" placeholder="Pick up time" onfocus="(this.type='time')" required/><br>

                                         <input id="dropTime" type="text" name="dropTime" min="09:00:00" max="17:00:00" class="input_text right" size="15" maxlength="30" placeholder="Drop off time" onfocus="(this.type='time')" required/><br>

                                        <input id="pickDate" type="text" name="pickDate" min=<?php echo date('Y-m-d');?> class="input_text left" size="15" maxlength="30" placeholder="Pick up date" onfocus="(this.type='date')" value=<?php echo date('Y-m-d');?> required/><br>

                                        <input id="dropDate" type="text" name="dropDate" min=<?php echo date('Y-m-d', mktime(0, 0, 0,date('m'), date('d') + 1, date('Y')));?> class="input_text right" size="15" maxlength="30" placeholder="Drop off date" onfocus="(this.type='date')" required/><br>
                                    </div>

                                    <div id="right_wide">
                                        <textarea id="recipient" type="text" name="recipient" class="input_text textarea text_long textarea_short" size="15" maxlength="30" autofocus placeholder="Name of recipient"></textarea><br>

                                        <input type="checkbox" name="premium" value="first" id="check_premium" class="check_request">  
                                        <input type="checkbox" name="fragile" value="1" id="check_fragile" class="check_request">
                                        <label for="check_premium" class="button button_white">FIRST CLASS</label>
                                        <label for="check_fragile" class="button button_white">FRAGILE</label>
                                    </div>

                                    <div id="bottom_wide">
                                        <div id="packages_container">
                                        <div class="package">
                                        <span class="title" id="first_title">PACKAGE 1</span>
                                        <input type="number" step="0.01" id="weight" name="weight[]" size="12" maxlength="10" class="input_text" placeholder="Weight in kg" required/><br>

                                        <textarea rows="4" cols="50" name="contents[]" class="input_text textarea textarea_height" placeholder="Package contents" onkeyup="this.className=' input_text textarea textarea_height text_long'" required></textarea>
                                        </div>
                                        </div>
                                        <input type="button" id="button_new_package" class="button" onclick="AddPackage()" value="ADD A PACKAGE">

                                    </div>
                                    <div id="bottom">
                                        <textarea rows="4" cols="50" name="special" class="input_text textarea textarea_width left" placeholder="Special instructions" ></textarea>
                                        <input id='signup_button' type="submit" value="SUBMIT" class="button right_no_bottom">
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
			</div> 
            <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
        </div>
    </body>
</html>