<!DOCTYPE html>
<html>
    <head>
        <title>Tracking - drop.it</title>
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
                                                                            header("Location: login.php?error=tracking");
                                                                            echo 'SIGN IN</a>';
                                                                        }?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
                       
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                      echo '<a id="log" class="menu menu_blue" href="payment_page.php">PAY</a>
                                     <a id="tracking" class="menu menu_blue selected" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';		
                                }
                                else if ($_SESSION['position'] == 'driver')
                                {
                                     echo '<a id="log" class="menu menu_blue" href="driver.php">LOG</a>';
                                }
                            }
                            else
                                    {
                                         echo '<a id="tracking" class="menu menu_blue selected" href="pages/tracking.php">TRACKING</a>
                                        <a id="new" class="menu menu_blue" href="pages/request.php">REQUEST</a>';	
                                    }
                        ?>
				</header>
					<div id="content">
                        <div id="form">
                        <span class="sign_title">Delivery Tracking</span><br>
                        <div id="tracking_text">
                        
                        
                            <?php include "../functions/functions.php";
                                trackPackages();?>
                            
                            </div>
                        </div>
					</div>
				</div>
                <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
			</div>
    </body>
</html>


