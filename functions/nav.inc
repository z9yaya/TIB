<?php 
echo '<!DOCTYPE html>
<html>
    <head>';
if (basename($_SERVER['PHP_SELF']) == "index.php")
{
echo '<title>drop.it</title>
        <link rel="SHORTCUT ICON" href="images/icon.ico" />
        <link rel="icon" href="images/icon.ico" type="image/ico" />
        <script async type="text/javascript" src="js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
        <link async href="css/styles.css" rel="stylesheet" type="text/css"/>';
}
else
{
    echo '<title>****TITLE**** - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
         <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>';
}
echo'<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
	</head>
    <body>
        <div id="back_nav">
            <div id="wrapper">
				<header>';
if (basename($_SERVER['PHP_SELF']) == "index.php")
{
    echo '<a id="login" class="menu" href="pages/login.php">SIGN IN</a>
					<a id="header" class="intro" href="index.html">drop.it</a>
					<a id="deliveries" class="menu" href="pages/deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu" href="pages/tracking.php">TRACKING</a>
					<a id="new" class="menu" href="pages/new.php">NEW</a>	
				</header>';
}				
else
{
    echo '<a id="login_blue" class="menu menu_blue selected" href="pages/login.php">SIGN IN</a>
                    <a id="header" class="intro intro_blue" href="../index.html">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					<a id="new" class="menu menu_blue" href="new.php">NEW</a>
                </header>';
}
?>
