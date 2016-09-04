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
                    <a id="request" class="menu menu_blue selected" href="request.php">REQUEST</a>
				</header>
					<div id="content2">
                            <form class="form" id="request_form">
                                <br><br><br><span class="sign_title">Request delivery</span><br>
                                <div id="signup_text">
                                    
                                <div id="left2">
                                    <input id="text_input" type="text" name="pickUp" class="input_text" size="15" maxlength="30" autofocus placeholder="Pick-up location"/><br>

                                    <input id="text_input" type="time" name="picktime" class="input_text" size="15" maxlength="30" autofocus placeholder="Pick-up time"/><br>

                                    <input id="date_input" type="date" name="pickDate" class="input_text" size="15" maxlength="30" autofocus placeholder="Pick-up date"/><br>
                                </div>
                                
                                <div id="right2">

                                    <input id="text_input" type="text" name="dropOff" class="input_text" size="15" maxlength="30" autofocus placeholder="Drop off location"/><br>

                                    <input id="text_input" type="time" name="dropTime" class="input_text" size="15" maxlength="30" autofocus placeholder="Drop off time"/><br>

                                    <input id="date_input" type="date" name="dropDate" class="input_text" size="15" maxlength="30" autofocus placeholder="Drop off date"/><br>
                                    
                                </div>
                                    </div>
                                <div id="content3">
                                    
                                    <input id="text_input" type="text" name="recipient" class="input_text" size="15" maxlength="30" autofocus placeholder="Recipient"/><br>
                                    
                                    <input type="checkbox" name="premium" value="premium"> Premium
                                    <input type="checkbox" name="fragile" value="fragile"> Fragile &emsp;&emsp;&emsp;&emsp;
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
                                    </select><br><br><br>

                                    <textarea rows="4" cols="50">
                                    Package contents 
                                    </textarea><br><br><br>

                                    <textarea rows="4" cols="50">
                                    Special instructions 
                                    </textarea><br><br><br>

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