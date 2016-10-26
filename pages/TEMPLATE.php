<?php 
include '../functions/functions.php';
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
                    <a id="rating" class="menu menu_blue" href="rating.php">RATING</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                     echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';	
                                }
                                else 
                                {
                                     echo '<a id="log" class="menu menu_blue" href="driver.php">LOG</a>';
                                }
                            }
                            else
                            {
                                echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';	
                            }
                        ?>
				</header>
					<div id="content"><!--REQUIRED-->
                         <div id="form"><!--REQUIRED-->
                             <form class="form" id="request_form" method='POST' action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                                <div class="sign_title">*****TITLE*****</div>
                                
                                <input id="text_input" type="text" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" autofocus placeholder="Text template"/><br>

                                <input id="date_input" type="date" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" autofocus placeholder="Date template"/><br>

                                <input id="password_input" type="password" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" size="15" maxlength="30" placeholder="Password template"/><br>

                                <input type="tel" name="DESCRIPTION OF INFORMATION (1 WORD)" size="12" maxlength="10" class="input_text" placeholder="Phone template"/><br>

                                <input type="number" name="DESCRIPTION OF INFORMATION (1 WORD)" size="12" maxlength="10" class="input_text" placeholder="Phone template"/><br>

                                <input type="email" name="DESCRIPTION OF INFORMATION (1 WORD)" class="input_text" placeholder="Email template" required/><br>

                                <input id='signup_button' type="submit" value="SUBMIT" class="button">
                             </form>
                        </div><!--REQUIRED-->
					</div><!--REQUIRED-->
				</div><!--REQUIRED-->
                <?phpinclude "../functions/footer.php" AddChat();?>
                <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
			</div>
            <?php if (session_id() == '')
            {
                session_start();
            }
            if(isset($_SESSION['position']) && $_SESSION['position'] != 'customer')
            {
                echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                        <meta http-equiv="Pragma" content="no-cache" />
                        <meta http-equiv="Expires" content="0" />
                        <script type="text/javascript" src="../functions/chat/scriptPages.js"></script>';
            }?>
    </body>
</html>