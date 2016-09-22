<!DOCTYPE html>
<html>
    <head>
        <title>Payments - drop.it</title>
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
					<a id="tracking" class="menu menu_blue" href="tracking.php">TRACKING</a>
					<a id="new" class="menu menu_blue" href="request.php">REQUEST</a>	
				</header>
					<div id="content">
					<h1>Payments</h1>
					<?php
						if (session_id() == ''){session_start();}
						
						require '../functions/functions.php';
						require '../functions/payment.php';
						require '../fpdf/fpdf.php';
						require '../functions/mail/PHPMailerAutoload.php';
						
						$user_position = '';
						
						$htmlData = '';
						
						if(isset($_SESSION['email'])){
							$data = GrabMoreData("SELECT position FROM users WHERE email= :email", array(array(':email', $_SESSION['email'])));
							$user_position = implode("", $data[0]);
						}
						
						if(!$user_position){
							//If they have not logged in
							echo "You must log in to use this feature";
							
						}elseif($user_position == 'customer'){
							//Customer Code Here
							echo "Please note, here are the packages you need to pay for. Until this has been sorted, we are unable to collect and send your package/s.<br/><br/>";
							
							$data = GrabMoreData("SELECT ID, cost FROM delivery WHERE status='Awaiting Pick Up' AND paid=0 AND user= :email", array(array(':email', $_SESSION['email'])));
							
							//generate form
							if(!$data){
								echo "Nothing to show.<br/><br/>";
							}else{
								$htmlData = generateForm($data);
								echo $htmlData;
								echo "<br/><br/>Please contact us at your ealiest convienience to organise payment.";
							}
							
							$deliveries = GrabMoreData("SELECT ID, cost, date_paid FROM delivery WHERE paid=1 AND user= :email", array(array(':email', $_SESSION['email'])));
							
							$userInfo = GrabData("users","name","email",$_SESSION['email'])[0];
							
							//Generate PDF
							
							$pdf = new FPDF();
							$pdf->AddPage();
							
							$pdf->SetFont("Arial","","20");
							
							$pdf->Cell(0,10,"TIB Package Delivery",0,1);
							
							$pdf->SetFont("Arial","","16");
							$pdf->Cell(0,10,"Payment History for ".implode("",$userInfo),0,1);
							
							$pdf->SetFont("Arial","","12");
							$pdf->Cell(0,10," ".date("F j, Y"),0,1);
							$pdf->Cell(15,10,"ID",1,0);
							$pdf->Cell(20,10,"Cost",1,0);
							$pdf->Cell(30,10,"Date Paid",1,1);
							foreach($deliveries as $arr){
								$pdf->Cell(15,10,$arr['ID'],1,0);
								$pdf->Cell(20,10,"$ ".$arr['cost'],1,0);
								$pdf->Cell(30,10,"".date("d-m-Y",$arr['date_paid']),1,1);
							}
							$pdf->Output($_SESSION['email']."_PaymentHistory".".pdf",'F');
							
							//Email the thing
							$pdfDir = $_SESSION['email']."_PaymentHistory".".pdf";
							
							$emailBody = htmlspecialchars("Good day. Here is your most up to date history of the delivery purchases you have made with us. Sincerely, Drop It Delivery");
							
							sendEmail($_SESSION['email'], "Purchase History", $emailBody, $pdfDir);
							
							//Delete unwanted copy
							//unlink($_SESSION['email']."_PaymentHistory".".pdf");
							
							echo "<br/><br/>An updated record of your purchase history has been emailed to you.";
							
						}else{
							//Manager Code Here
							
							//Form for customers that have paid, and need their items picked up
							echo "List of customer that have paid and require their packages to be picked up:<br/><br/>";
							
							$data = GrabMoreData("SELECT ID, origin, driver, pickup, fragile, special FROM delivery WHERE status='Awaiting Pick Up' AND paid=1", array(array(':email', $_SESSION['email'])));
							
							//generate form
							if(!$data){
								echo "Nothing to show.<br/><br/>";
							}else{
								$htmlData = generateForm($data);
								echo $htmlData;
							}
							
							echo "<br/><br/>";
							
							//Form for customers that have not yet paid
							echo "List of customer that have not paid for their package delivery:<br/><br/>";
							
							$data = GrabMoreData("SELECT delivery.ID, delivery.user, users.name, users.phone FROM delivery INNER JOIN users ON delivery.user=users.email WHERE delivery.paid=0", array(array(':email', $_SESSION['email'])));
							//print_r($data);
							//echo "<br/><br/>";
							
							//generate form
							if(!$data){
								echo "Nothing to show.<br/><br/>";
							}else{
								$htmlData = generateForm($data);
								echo $htmlData;
								
								echo '
								<form action="process_payment.php">
									<input type="submit" value="Process a Payment">
								</form>
								';
							}
							
							
							
						}
						
						
						
						
						?>
						
						
						
						
					</div>
				</div>
				<footer id="footer">
					<p> Designed by Yannick Mansuy - 2016</p>
				</footer>
			</div>
    </body>
</html>