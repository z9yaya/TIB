<?php

/* Returns a table of given data for presentation
	Returns in HTML
	Will work with data collected from GrabMoreData
	NOT tested for data collected from GrabData
*/
function generateForm($data){
	// Beginning the div and table
	$htmlData = "<div id='table_holder'><table><tr>";
	
	// Generate the headings for each column
		// This was the best solution to collect the keys (array locations with specific names)
		// Has a bug where it wont display the key if the fist row of info in NULL
	$arrKey = $data[0];
    foreach ($arrKey as $key => $value)
    {
        $htmlData = $htmlData."<th>".ucfirst($key).'</th>';
    };
	
	// Generate each row of data
	foreach($data as $arr1){
		$htmlData = $htmlData."</tr><tr>";
		foreach($arr1 as &$arr){
			$htmlData=$htmlData."<td>";
			
			if($arr > 1000000000){		// If the number is bigger than this, it can be guaranteed to be a date 
				$htmlData=$htmlData.date("h:i A ", $arr)."<br/>".date("d-m-Y", $arr);
				
			}elseif($arr > 10000000){	// If smaller than above, but still bigger than this,m it's guaranteed to be a phone number 
				$htmlData=$htmlData."0".$arr; // Purely to add the leading zero
			}else{
				$htmlData=$htmlData.$arr; // other generic data
			}
			$htmlData=$htmlData."</td>"; // end of the rows
		}
	}
	$htmlData = $htmlData."</tr></table></div>"; // End of the table
	return $htmlData;
}

// Sends an email
	// Emphasis on being able to distinguish the recipient
	// Emphasis on attaching a document
function sendEmail($userEmail, $subject, $body, $pdf){
    
	if (session_id() == '')
    {
        session_start();
    }
    if (isset($_SESSION)){
		$account="dropitdeliveries@gmail.com";	//source email, DO NOT CHANGE
        $password="drop.itsupport";				//source password, DO NOT CHANGE
        $to=$userEmail;							//recipient
        $from_name= "TIB Package Delivery"; 	//From name
		
		
		// Generate the email
		$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth= true;
        $mail->Port = 465;
        $mail->Username= $account;
        $mail->Password= $password;
        $mail->SMTPSecure = 'ssl';
        $mail->FromName = $from_name;
        $mail->isHTML(true);
		$mail->addAttachment($pdf);
        $mail->Subject = $subject;
        $mail->Body = htmlspecialchars($body);
        $mail->addAddress($to);
		
		// Send the email
        if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}else{
			echo "E-Mail has been sent";
            //header("Location: deliveries.php");
		}
	}
}
?>