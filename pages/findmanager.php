<?php include '../functions/findmanagerfunctions.php';
 require '../functions/mail/PHPMailerAutoload.php';
Emailer();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
		<link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
         <link async href="../css/findmanager.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/rating.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    </head>
    <body>
		<div id="alert_background">															
            <div id="alert"><span>Please wait while we submit your enquiry. Thank You!<br></span></div>
			</div>
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
										
                         <?php 
                            if(isset($_SESSION['position']))
                            {
                                if ($_SESSION['position'] != 'driver')
                                {
                                     echo '<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					                <a id="new" class="menu menu_blue" href="request.php">REQUEST</a>';	
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
					<span class="sign_title">Contact us</span>
					<div>Send us your thoughts, suggestions, or problems! <br> We'll try to get back to you as soon as we can. <br></div><br>
					
					<b>Phone Number:</b> 07 3157 7299
					<br>
					<b>Fax Number:</b> 07 6333 6519			
					
						<div id="contactform">					   
							<form method="POST" action="findmanager.php" onsubmit="document.getElementById('alert_background').style.display='block';">
								<!-- <?php print_r($_POST);?> -->
								<input type='email' class="input_text" placeholder="Your Contact Email" name="email" id="contactemail" required>
								<input type='text' class="input_text" placeholder="Name" name="name" id="contactname" required>								
								<select name="type" id="findmanagerdropmenu" class="input_text dropdown_number" required>
								  <option value="Account">Account Inquiries</option>
								  <option value="Billing">Billing</option>
								  <option value="Services">Services</option>
								  <option value="Other">Other</option>
								</select><br><br>
								<textarea class=" input_text textarea" placeholder="Your message" name="contents" id="complaint" required></textarea><br>
								<input id='submit_button' class="button" type="submit" value="SUBMIT"/>
							</form>
						</div>
					</div>
				</div>
				
                    </div>
					<?php include "../functions/footer.php"?>
			</div>
    </body>
</html>