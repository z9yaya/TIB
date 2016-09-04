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
                                                                            echo 'SIGN IN</a>';?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue selected" href="request.php">REQUEST</a>
				</header>
					<div id="content">
                            <div id="form">
                                <form class="form" id="request_form" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                <span class="sign_title">Request delivery</span><br>
                                <div id="signup_text">
                                    
                                <div id="left_wide">
                                    <input id="text_input" type="text" name="pickUp" class="input_text left" size="15" maxlength="30" autofocus placeholder="Pick up location" required/><br>
                                    
                                    <input id="text_input" type="text" name="dropOff" class="input_text right" size="15" maxlength="30" placeholder="Drop off location"  required/><br>

                                    <input id="text_input" type="text" name="pickTime" min="09:00:00" max="17:00:00" class="input_text left" size="15" maxlength="30" placeholder="Pick up time" onfocus="(this.type='time')" required/><br>
                                    
                                     <input id="text_input" type="text" name="dropTime" min="09:00:00" max="17:00:00" class="input_text right" size="15" maxlength="30" placeholder="Drop off time" onfocus="(this.type='time')" required/><br>

                                    <input id="date_input" type="text" name="pickDate" min=<?php echo date('Y-m-d');?> class="input_text left" size="15" maxlength="30" placeholder="Pick up date" onfocus="(this.type='date')" required/><br>
                                    
                                    <input id="date_input" type="text" name="dropDate" min=<?php echo date('Y-m-d', mktime(0, 0, 0,date('m'), date('d') + 1, date('Y')));?> class="input_text right" size="15" maxlength="30" placeholder="Drop off date" onfocus="(this.type='date')" required/><br>
                                </div>
                                
                                <div id="right">
                                    <input id="text_input" type="text" name="recipient" class="input_text" size="15" maxlength="30" autofocus placeholder="Name of recipient"/><br>
                                    
                                    <input type="checkbox" name="premium" value="first"> Premium
                                    <input type="checkbox" name="fragile" value="1"> Fragile &emsp;&emsp;&emsp;&emsp;
                                    <label for="id">Number of packages</label> <select>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    </select><br><br>
                                    
                                    <input type="number" name="weight" size="12" maxlength="10" class="input_text" placeholder="Weight in Kg"/><br>

                                    <textarea rows="4" cols="50" name="contents" class="input_text textarea" placeholder="Package contents" onkeyup="this.className=' input_text textarea text_long'"></textarea>

                                    <textarea rows="4" cols="50" name="special" class="input_text textarea" placeholder="Special instructions" onkeyup="this.className='input_text textarea text_long'"></textarea>

                                <input id='signup_button' type="submit" value="SUBMIT" class="button">
                                    

                                   

                                    
                                    
                                </div>
                        </form>
                            
                        <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>