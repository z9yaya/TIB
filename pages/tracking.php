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
				<?php include "../functions/header.php";?>
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
                <?php include "../functions/footer.php"?>
			</div>
    </body>
</html>


