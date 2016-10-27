<!DOCTYPE html>
<html>
    <head>
        <title>process_payment - drop.it</title>
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
                                <span class="sign_title">Payments</span>
                            <?php

                            require '../functions/functions.php';
                            require '../functions/payment.php';
                            require '../fpdf/fpdf.php';
                            require '../functions/mail/PHPMailerAutoload.php';

                            // Direct copy of he last table from "payment_page.php"
                                // Used to determine who owes money and to help reduce mistakes when identifying who has paid
                            $toProcess = GrabData("delivery","ID, user, cost","paid", "0");
                            echo generateForm($toProcess);

                            // Input for the delivery ID
                            echo '<br/>Enter ID:<br/><br/>
                                <form action="../functions/update_payments.php" method="POST">
                                <input type="text" name="ID_Paid" maxlength="10" class="input_text" placeholder="ID"/>
                                <br>';

                            // Submit button
                            echo '<input id="submit_payment" type="submit" value="SUBMIT PAYMENT" class="button"></form>';
                            ?>

                        </div>
					</div>
				</div>
                <?php include "../functions/footer.php"?>
			</div>
    </body>
</html>