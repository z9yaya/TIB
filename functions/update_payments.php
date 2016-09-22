<?php

	/* Update Payments
		This entire document does 3 things:
		1. Set a specific ID in the 'delivery' table to be 1 (ie. signifies that this customer has paid)
		2. Prepare a PDF receipt (and ultimately deletes it at the end to reduce unwanted clutter)
		3. Email the customer that has just been set to have paid for their delivery
	*/
	
	// Include other required functions
	require '../functions/functions.php';
	require '../functions/payment.php';
	require '../fpdf/fpdf.php';
	require '../functions/mail/PHPMailerAutoload.php';
	
	// Get ID
	$ID = $_POST["ID_Paid"];
	
	//Immeadiate date and time
	$date = time();
	
	// Connect to DB
	$pdo = connect();
	
	// Query to update the 'paid' boolean status and set the date/time of payment
	$query_update_pay= "UPDATE `delivery`   
		SET `paid` = 1,
		`date_paid` = :date
		WHERE `ID` = :ID;";
	$prepare = $pdo->prepare($query_update_pay);
    $prepare -> bindValue(':date', $date);
    $prepare -> bindValue(':ID', $ID);
    $prepare -> execute();
	
	// Collecting data to generate the receipt
	$data = GrabMoreData("SELECT user, cost, date_paid FROM delivery WHERE ID= :ID", array(array(':ID', $ID)));
	
	// Create PDF receipt
	$pdf = new FPDF();
	$pdf->AddPage();
	
	// Title
	$pdf->SetFont("Arial","","20");
	$pdf->Cell(0,10,"Drop.IT",0,1);
	
	// Subtitle
	$pdf->SetFont("Arial","","16");
	$pdf->Cell(0,10,"Receipt for ".$data[0]['user'],0,1);
	
	// Include the date
	$pdf->SetFont("Arial","","12");
	$pdf->Cell(0,10," ".date("F j, Y", $data[0]['date_paid']),0,1);
	
	// ID of the delivery - unique identifyer
	$pdf->Cell(15,10,"ID",1,0);
	// Cost - required for legal receipts
	$pdf->Cell(20,10,"Cost",1,1);
	// Actual data for the above
	$pdf->Cell(15,10,$ID,1,0);
	$pdf->Cell(20,10,"$ ".$data[0]['cost'],1,1);
	
	// Purely for ease of reading
	$pdfDir = $ID."_PaymentHistory".".pdf";
	
	// Make the PDF
	$pdf->Output($pdfDir,'F');
	
	// Email body
	$emailBody = htmlspecialchars("Good day. Here is your receipt for your purchase that you have made with us. Sincerely, Drop.IT Delivery");
	sendEmail($data[0]['user'], "Purchase History", $emailBody, $pdfDir);
	
	// Delete PDF to remove clutter
	unlink($pdfDir);
	
	// Return to an actual webpage
	header("Location: ../pages/payment_page.php");
	
?>