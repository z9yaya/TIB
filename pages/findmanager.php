<?php include '../functions/findmanagerfunctions.php';
 require '../functions/mail/PHPMailerAutoload.php';
Emailer();
?>
<!-- This includes the functions for the web page to work -->
<!DOCTYPE html>
<html>
    <head>
        <title>Contact Us - drop.it</title><!-- Title of the web page in the header -->
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" /><!-- These are links to the relevant css and javascript files -->
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
		<link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
         <link async href="../css/findmanager.css" rel="stylesheet" type="text/css"/>
		 <link async href="../css/rating.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    </head>
    <body>
		<div id="alert_background">	<!-- This pops up when a valid enquiry has been submitted-->															
            <div id="alert"><span>Please wait while we submit your enquiry. Thank You!<br></span></div>
			</div>
        <div id="back_nav">
			<div id="wrapper">
				<?php include "../functions/header.php";?>
				<div id="content">
				<div id="form">
					<span class="sign_title">Contact us</span> <!-- The title on the webpage -->
					<div>Send us your thoughts, suggestions, or problems! <br> We'll try to get back to you as soon as we can. <br></div><br><!-- text for the contact us page -->
					
					<b>Phone Number:</b> 07 3157 7299
					<br>
					<b>Fax Number:</b> 07 6333 6519			
					<!-- This is the contact us form. It includes the name, email, enquiry type, message area and the submit button -->
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
				
                    </div><!-- this is the footer -->
					<?php include "../functions/footer.php"?>
			</div>
    </body>
</html>