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
                                                                        {
                                                                            header("Location: login.php?error=tracking");
                                                                            echo 'SIGN IN</a>';
                                                                        }?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue selected" href="tracking.php">TRACKING</a>
                    <a id="request" class="menu menu_blue" href="request.php">REQUEST</a>
				</header>
					<div id="content">
                        <div id="form">
                        <span class="sign_title">Delivery Tracking</span><br>
                        <div id="delivery_text">
                        <div id="table_holder">
                        
                            <?php include "../functions/functions.php";
                                trackPackages();?>
                            </div>
                            </div>
                        </div>
                        <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>


