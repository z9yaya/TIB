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
					<a id="new" class="menu menu_blue selected" href="new.php">NEW</a>
					<a id="rating" class="menu menu_blue selected" href="rating.php">RATING</a>
				</header>
<div id="content">  
				<?php include '../functions/functions.php';
  $servername = "localhost";
  $username = "edit";
  $password = "editme";
  $dbname = "tib";
?>		

<!-- Review Form -->
<div>
	<form action="" id="form" method="post" name="form">
	 <h2>Write Your Feedback Below!</h2>
	 <textarea id="msg" name="review" class="reviewmsg" placeholder="Please type your thoughts here......"></textarea><br><br> 
	 <h1><strong class="choice">Choose your rating:</strong></h1>
	 <h1><span class="rating" name="rating">
	   1:<input type="radio" name="rating" value="1"><i></i>
	   2:<input type="radio" name="rating" value="2"><i></i>
	   3:<input type="radio" name="rating" value="3"><i></i>
	   4:<input type="radio" name="rating" value="4"><i></i>
	   5:<input type="radio" name="rating" value="5"><i></i>
	 </span></h1><br>
	     <input type="submit" name="submit_review"  id="submit" class="reviewbutton" value="Submit Review"><br><br>
	</form>
</div> 
		</div>
	  </div>
	</div>
</body>
</html> 
<?php $pdo = null; ?> <!-- This closes the pdo connection -->