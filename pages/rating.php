<!DOCTYPE html>
<html>
	<head>
        <title>****TITLE**** - drop.it</title>
		
		<link href="rating.css" rel="stylesheet" type="text/css"/>
		<link href="styles1.css" rel="stylesheet" type="text/css"/>
		<link href="styles.css" rel="stylesheet" type="text/css"/>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
		<?php if (session_id() == '')
            {
                session_start();
            }
            if(isset($_SESSION['position']) && $_SESSION['position'] == 'driver')
            {
                echo '<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
                        <meta http-equiv="Pragma" content="no-cache" />
                        <meta http-equiv="Expires" content="0" />
                        <script type="text/javascript" src="../functions/chat/scriptPages.js"></script>';
            }?>
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
                                                                        else{ 
																			header("Location: login.php?error=rating");
                                                                            echo 'SIGN IN</a>';
																		}?>
					<a id="header" class="intro intro_blue" href="../index.php">drop.it</a>
					<a id="deliveries" class="menu menu_blue" href="deliveries.php">DELIVERIES</a>

                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                     echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>
									<a id="ratingsystem" class="menu menu_blue selected" href="rating.php">RATING</a>';	
                                }
                                else if ($_SESSION['position'] == 'driver')
                                {
                                     echo '<a id="log" class="menu menu_blue" href="driver.php">LOG</a>';
                                }
                            }
                            else
                                    {
                                         echo '<a id="tracking" class="menu menu_blue" href="pages/tracking.php">TRACKING</a>
                                        <a id="new" class="menu menu_blue" href="pages/request.php">REQUEST</a>';	
                                    }
                        ?>
				</header>
<div id="content">  
<div id="form">
                        <span class="sign_title">Write Your Feedback Below!</span><br>
				<?php include '../functions/functions.php';
				 $pdo = connect();
  $servername = "localhost";
  $username = "edit";
  $password = "editme";
  $dbname = "tib";

if (isset($_POST['submit']))
{
	
	$email = $_SESSION['email'];
	$review = $_POST['review'];
	$rating = $_POST['rating'];
	$date = time();

		$sql = "INSERT INTO `reviews` (`email`, `review`, `rating`, `date`)	
		       VALUES ('$email', '$review', '$rating', '$date')";
        $rs= $pdo->prepare($sql);
		$rs->execute();
}
?>

<div id="fieldset_title">						
	<form action="rating.php" id="form" method="POST" name="form">
			<textarea id="msg" name="review" class="reviewmsg input_text textarea text_long" placeholder="Please type your thoughts here......"></textarea><br><br> 
			<h1><strong class="choice">Rate Us:</strong></h1>
		<fieldset id="rating" onchange="showSelectedRating('value')">
			<input type="radio" id="star5" value="5" name="rating" title="Amazing"/><label for="star5" title="Amazing">&#9733;</label>
			<input type="radio" id="star4" value="4" name="rating" title="Good"/><label for="star4" title="Good">&#9733;</label>
			<input type="radio" id="star3" value="3" name="rating" title="Average"/><label for="star3" title="Average">&#9733;</label>
			<input type="radio" id="star2" value="2" name="rating" title="Bad"/><label for="star2" title="Bad">&#9733;</label>
			<input type="radio" id="star1" value="1" name="rating" title="Terrible"/><label for="star1" title="Terrible">&#9733;</label>
		</fieldset><br><br><br>
			<input type="submit" name="submit"  id="submit" class="button" value="Submit"><br><br>
	</form>
</div>
		</div>
	  </div>
	</div>
	<?php AddChat();?>
	<footer id="footer">
        <p> Designed by Elias - 2016</p>
	</footer>
	</div>
</body>
</html> 
