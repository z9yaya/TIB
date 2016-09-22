<?php
	require '../functions/functions.php';
	require '../functions/payment.php';
	require '../fpdf/fpdf.php';
	require '../functions/mail/PHPMailerAutoload.php';
	
	//get ID
	$ID = $_POST["ID_Paid"];
	
	$date = time();
	//insert data
	$pdo = connect();
	
	$query_update_pay= "UPDATE `delivery`   
		SET `paid` = 1,
		`date_paid` = :date
		WHERE `ID` = :ID;";
	$prepare = $pdo->prepare($query_update_pay);
    $prepare -> bindValue(':date', $date);
    $prepare -> bindValue(':ID', $ID);
    $prepare -> execute();
	
	$data = GrabMoreData("SELECT user, cost, date_paid FROM delivery WHERE ID= :ID", array(array(':ID', $ID)));
	
	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont("Arial","","20");
	$pdf->Cell(0,10,"Drop.IT",0,1);
	$pdf->SetFont("Arial","","16");
	$pdf->Cell(0,10,"Receipt for ".$data[0]['user'],0,1);
	
	$pdf->SetFont("Arial","","12");
	$pdf->Cell(0,10," ".date("F j, Y", $data[0]['date_paid']),0,1);
	$pdf->Cell(15,10,"ID",1,0);
	$pdf->Cell(20,10,"Cost",1,1);
	$pdf->Cell(15,10,$ID,1,0);
	$pdf->Cell(20,10,"$ ".$data[0]['cost'],1,1);
	
	$pdf->Output($ID."_PaymentHistory".".pdf",'F');
	
	//Email the thing
	$pdfDir = $ID."_PaymentHistory".".pdf";
	
	$emailBody = htmlspecialchars("Good day. Here is your receipt for your purchase that you have made with us. Sincerely, Drop.IT Delivery");
	sendEmail($data[0]['user'], "Purchase History", $emailBody, $pdfDir);
	
	//unlink($pdfDir);
	
	header("Location: ../pages/payment_page.php");
	
?>