<?php include '../functions/functions.php';
 require '../functions/mail/PHPMailerAutoload.php';
Emailer();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Report Issue - drop.it</title>
        <link rel="SHORTCUT ICON" href="../images/icon.ico" />
        <link rel="icon" href="../images/icon.ico" type="image/ico" />
        <script type="text/javascript" src="../js/script.js"></script>
        <meta charset="utf-8"/>
        <meta name=viewport content="width=device-width, initial-scale=1">
        <link async href="../css/styles.css" rel="stylesheet" type="text/css"/>
        <link async href="../css/rating.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    </head>
    <body>
        <div id="alert_background">															
            <div id="alert"><span>Please wait while we submit your complaint. Thank You!<br></span></div>
        </div>
        <div id="back_nav">
			<div id="wrapper">
				<?php include "../functions/header.php";?>
				<div id="content">
                    <div id="form">
	   <span class="sign_title">Submit a Complaint</span><br>
	<form method="POST" action="complaints.php" onsubmit="document.getElementById('alert_background').style.display='block';">
        <input type="hidden" name='ID' value="<?php WriteID();?>">
		<textarea rows="50" cols="40" class=" input_text textarea" placeholder="Enter your complaint" name="contents" id="complaint" required autofocus></textarea><br><br>
		<input id='submit_button' class="button" type="submit" value="SUBMIT"/>
	</form>
	
					</div>
				</div>
                    </div>
                <?php include "../functions/footer.php"?>
			</div>
    </body>
</html>