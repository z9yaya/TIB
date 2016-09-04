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
				</header>
					<div id="content">
                 
<h1><?php echo '<center><b>Package Tracking</b></center>'; ?></h1> 

<?php 
echo "<center><table border=2 width=30%>";
{
		echo "<tr>";
		echo "<td>Packagge ID</td>";
		echo "<td>Package Content</td>";
	    echo "<td>Location</td>";
		echo "<td>Time</td>";
	    echo "</tr>";
		
		echo "<td>10</td>";
		echo "<td>Pizza</td>";
		echo "<td>Brisbane</td>";
		echo "<td>12pm</td>";
		echo "</tr>";
				
		echo "<td>20</td>";
		echo "<td>Computer</td>";
		echo "<td>Melbourne</td>";
		echo "<td>2pm</td>";
		echo "</tr>";
		
		echo "<td>10</td>";
		echo "<td>Pizza</td>";
		echo "<td>Brisbane</td>";
		echo "<td>12pm</td>";
		echo "</tr>";
}
echo "</table></center>";
?>
                        <footer id="footer">
                        <p> Designed by Yannick Mansuy - 2016</p>
					</footer>
					</div>
				</div>
			</div>
    </body>
</html>


