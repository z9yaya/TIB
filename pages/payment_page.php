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
				<?php include "../functions/header.php";?>
					<div id="content">
                        <div id="form">
                            <span class="sign_title">Payments</span>
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
                                    // If they have not logged in
                                    echo "<br/>You must log in to use this feature";

                                }elseif($user_position == 'customer'){
                                    // Customer Code Here
                                    echo "<br/>Please note, here are the packages you need to pay for. Until this has been sorted, we are unable to collect and deliver your packages.<br/><br/>";

                                    $data = GrabMoreData("SELECT ID, cost FROM delivery WHERE status='Awaiting Pick Up' AND paid=0 AND user= :email", array(array(':email', $_SESSION['email'])));

                                    // Generate form
                                    if(!$data){
                                        echo "Nothing to show.<br/><br/>";
                                    }else{
                                        $htmlData = generateForm($data);
                                        echo $htmlData;
                                        echo "<br/><br/>Please contact us at your ealiest convienience to organise payment.";
                                    }

                                    $deliveries = GrabMoreData("SELECT ID, cost, date_paid FROM delivery WHERE paid=1 AND user= :email", array(array(':email', $_SESSION['email'])));
                                    if ($deliveries != false)
                                    {
                                        $userInfo = GrabData("users","name","email",$_SESSION['email'])[0];

                                    //Generate PDF
                                        // See "update_payments.php" for more information
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
                                    $pdfDir = "../uploads/PaymentHistory_".$_SESSION['email'].".pdf";
                                    if (file_exists ($pdfDir))
                                        unlink($pdfDir);
                                    $pdf->Output($pdfDir,'F');

                                    // Email the PDF

                                    //$emailBody = htmlspecialchars("Good day. Here is your most up to date history of the delivery purchases you have made with us. Sincerely, Drop It Delivery");

                                    //sendEmail($_SESSION['email'], "Purchase History", $emailBody, $pdfDir);

                                    //Delete unwanted copy
                                    //unlink($pdfDir);
                                    echo '<br/><br/><a href="'.$pdfDir.'" class="button" download>DOWNLOAD HISTORY</a>';
                                    //echo "<br/><br/>An updated record of your purchase history has been emailed to you.";
                                    }

                                    

                                }else{
                                    // Manager Code Here

                                    // Form for customers that have paid, and need their items picked up
                                    echo "<br/>List of customer that have paid and require their packages to be picked up:<br/><br/>";

                                    $data = GrabMoreData("SELECT ID, origin, driver, pickup, fragile, special FROM delivery WHERE status='Awaiting Pick Up' AND paid=1 ORDER BY pickup", array(array(':email', $_SESSION['email'])));

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

                                    $data = GrabMoreData("SELECT delivery.ID, delivery.user, users.name, users.phone FROM delivery INNER JOIN users ON delivery.user=users.email WHERE delivery.paid=0 ORDER BY delivery.ID", array(array(':email', $_SESSION['email'])));

                                    //generate form
                                    if(!$data){
                                        echo "Nothing to show.<br/><br/>";
                                    }else{
                                        $htmlData = generateForm($data);
                                        echo $htmlData;

                                        // Links to "process_payment.php" to update if someone has recently paid for their delivery
                                        echo '<a id="login_blue" href="process_payment.php" class="menu menu_blue">
                                            PROCESS A PAYMENT</a>';
                                    }
                                }

                                ?>
                        </div>
					</div>
			</div>
			<?php include "../functions/footer.php"?>
		</div>
    </body>
</html>