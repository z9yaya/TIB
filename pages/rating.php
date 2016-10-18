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
            }
			if(isset($_GET['delivery'])){
			$id = $_GET['delivery'];
				}
			?>
			
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
                        <span class="sign_title">Write Your Feedback Below!</span>

												
				<?php include '../functions/functions.php'; include "uploadfile.php";
				 $pdo = connect();
  $servername = "localhost";
  $username = "edit";
  $password = "editme";
  $dbname = "tib";

if (isset($_POST['submit']))
{
	$email = $_SESSION['email'];
	$review = $_POST['review'];
	$delivery_rating = $_POST['delivery_rating'];
	$package_rating = $_POST['package_rating'];
	$date = time();		

		$sql = "INSERT INTO `reviews` (`id`, `email`, `review`, `delivery_rating`, `package_rating`, `date`)	
						VALUES ('$id', '$email', '$review', '$delivery_rating', '$package_rating', '$date')";
        $rs= $pdo->prepare($sql);
		$rs->execute();
			echo "<script>alert('Thank you for your feedback!');</script>";
			
}
?>

<div id="fieldset_title">						
	<form action="rating.php?delivery=<?php echo $id;?>" id="ratingForm" method="POST" name="form" enctype="multipart/form-data">
			<textarea id="msg" name="review" class="reviewmsg input_text textarea text_long" placeholder="Please type your thoughts here......"></textarea><br><br> 

			<input type="file" name="fileToUpload" id="fileToUpload">
			<!--<input type="submit" value="Upload Image" name="submit">-->
			<br>		
			
			<h2><strong class="choice">Delivery Quality:</strong></h2>
		<fieldset id="rating" onchange="showSelectedRating('value')">
			<input type="radio" id="star5" value="5" name="delivery_rating" title="Amazing"/><label for="star5" title="Amazing">&#9733;</label>
			<input type="radio" id="star4" value="4" name="delivery_rating" title="Good"/><label for="star4" title="Good">&#9733;</label>
			<input type="radio" id="star3" value="3" name="delivery_rating" title="Average"/><label for="star3" title="Average">&#9733;</label>
			<input type="radio" id="star2" value="2" name="delivery_rating" title="Bad"/><label for="star2" title="Bad">&#9733;</label>
			<input type="radio" id="star1" value="1" name="delivery_rating" title="Terrible"/><label for="star1" title="Terrible">&#9733;</label>
		</fieldset>

		
		<h2><strong class="choice">Package Quality:</strong></h2>
		<fieldset id="rating_package" onchange="showSelectedRating('value')">
			<input type="radio" id="star5_1" value="5" name="package_rating" title="Amazing"/><label for="star5_1" title="Amazing">&#9733;</label>
			<input type="radio" id="star4_1" value="4" name="package_rating" title="Good"/><label for="star4_1" title="Good">&#9733;</label>
			<input type="radio" id="star3_1" value="3" name="package_rating" title="Average"/><label for="star3_1" title="Average">&#9733;</label>
			<input type="radio" id="star2_1" value="2" name="package_rating" title="Bad"/><label for="star2_1" title="Bad">&#9733;</label>
			<input type="radio" id="star1_1" value="1" name="package_rating" title="Terrible"/><label for="star1_1" title="Terrible">&#9733;</label>
		</fieldset><br><br><br>
			<input type="submit" name="submit"  id="submit" class="button" value="Submit">&nbsp; &nbsp;
			<input type="reset" name="reset"  id="reset" class="button" value="Reset"><br><br>
	</form>
</div>


		</div>
	  </div>
	</div>
	<?php AddChat();?>
	<footer id="footer">
        <p> Designed by Elias MG - 2016</p>
	</footer>
	</div>
</body>
</html> 
