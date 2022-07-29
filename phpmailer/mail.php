<?php
include 'PHPMailerAutoload.php';
//require_once('/phpmailer/PHPMailerAutoload.php');
function smtpmailer($email,$Subject,$Message,$filename=''){
	date_default_timezone_set('Asia/Kolkata');
	$date = date("y-m-d H:i:s");
	$mail = new PHPMailer;
	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = env('EMAIL_HOST');  			// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = env('EMAIL_USERNAME');    					// SMTP username
	$mail->Password = env('EMAIL_PASSWORD');						// SMTP password
	$mail->SMTPSecure = env('EMAIL_SMTP');                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = env('EMAIL_PORT');                          // TCP port to connect to
	$mail->setFrom(env('EMAIL_SETFROM'));
	$mail->addAddress($email);     				// Add a recipient
	//$mail->AddCC('webteam@eadcosmos.com');
	if(!empty($filename))
	{
		$mail->AddAttachment($filename);
	}
	$mail->isHTML(true);               			// Set email format to HTML
	$mail->Subject = $Subject;
	$mail->Body = $Message;
	if($mail->send()){
		return true;
	}else{
		return $mail->ErrorInfo;
	}	
}
function smtpmailerStringAttachment($email,$Subject,$Message,$filepath,$filename){
	date_default_timezone_set('Asia/Kolkata');
	$date = date("y-m-d H:i:s");
	$mail = new PHPMailer;
	$mail->isSMTP();                            // Set mailer to use SMTP
	$mail->Host = env('EMAIL_HOST');  			// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                     // Enable SMTP authentication
	$mail->Username = env('EMAIL_USERNAME');    					// SMTP username
	$mail->Password = env('EMAIL_PASSWORD');						// SMTP password
	$mail->SMTPSecure = env('EMAIL_SMTP');                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = env('EMAIL_PORT');                          // TCP port to connect to
	$mail->setFrom(env('EMAIL_SETFROM'));
	$mail->addAddress($email);     				// Add a recipient
	//$mail->AddCC('webteam@eadcosmos.com');
	//$mail->AddAttachment($filename);
	$mail->addStringAttachment($filepath,$filename);
	$mail->isHTML(true);               			// Set email format to HTML
	$mail->Subject = $Subject;
	$mail->Body = $Message;
	if($mail->send()){
		return true;
	}else{
		return $mail->ErrorInfo;
	}	
}
?>