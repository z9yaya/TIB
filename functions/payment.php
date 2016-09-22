<?php
//Returns html in a string
//Will work with data collected from GrabMoreData
//NOT tested for data collected from GrabData
function generateForm($data){
	$htmlData = "<div id='table_holder'><table><tr>";
	
	$arrKey = $data[0];
	while (current($arrKey)) {
		$htmlData = $htmlData."<th>".ucfirst(key($arrKey)).'</th>';
		next($arrKey);
	}
	
	foreach($data as $arr1){
		$htmlData = $htmlData."</tr><tr>";
		foreach($arr1 as &$arr){
			$htmlData=$htmlData."<td>";
			if($arr > 1000000000){
				$htmlData=$htmlData.date("d-m-Y", $arr)."<br/>".date("h:i A", $arr);
			}elseif($arr > 10000000){
				$htmlData=$htmlData."0".$arr;
			}else{
				$htmlData=$htmlData.$arr;
			}
			$htmlData=$htmlData."</td>";
		}
	}
	$htmlData = $htmlData."</tr></table></div>";
	return $htmlData;
}

function sendEmail($userEmail, $subject, $body, $pdf){
    
	if (session_id() == '')
    {
        session_start();
    }
    if (isset($_SESSION)){
		$account="dropitdeliveries@gmail.com";//source email, DO NOT CHANGE
        $password="drop.itsupport";//source password, DO NOT CHANGE
        $to=$userEmail;//recipient
        $from_name= "TIB Package Delivery"; //From name
		
		$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth= true;
        $mail->Port = 465;
        $mail->Username= $account;
        $mail->Password= $password;
        $mail->SMTPSecure = 'ssl';
        //$mail->addReplyTo($email, $name);
        $mail->FromName = "TIB";
        $mail->isHTML(true);
		$mail->addAttachment($pdf);
        $mail->Subject = $subject;
        $mail->Body = htmlspecialchars($body);
        $mail->addAddress($to);
        if(!$mail->send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}else{
			echo "E-Mail has been sent";
            //header("Location: deliveries.php");
		}
	}
	
}

function UpdatePayments($id){
	
}

?>