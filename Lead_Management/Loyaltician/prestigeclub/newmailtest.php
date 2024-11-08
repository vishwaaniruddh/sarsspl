<?php
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
//$mail->IsSMTP();
//$mail->Mailer = "smtp";
//$mail->Host = "sarmicrosystems.in";
//$mail->Port = "587"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
//$mail->SMTPAuth = true;
//mail->SMTPSecure = 'tls';
//$mail->Username = "info@sarmicrosystems.in";
//$mail->Password = "SarSolutions@2022";

    $mail->isSMTP();   
    $mail->Mailer = "smtp";// Set mailer to use SMTP
    $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'd269780faccc53';                 // SMTP username
    $mail->Password = '8c68e45753c4a3';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 2525; 

$mail->From = "contactus@theresortexperiences.com";
$mail->FromName = "The Resort Mumbai";
$mail->AddAddress("prabir.d06@gmail.com", "Prabir");
$mail->AddReplyTo("contactus@theresortexperiences.com", "The Resort Mumbai");

$mail->isHTML(true); 
$mail->Subject = "Hi test!";
$mail->Body = "Hi! How are you?";
$mail->WordWrap = 50;

if(!$mail->Send()) {
echo 'Message was not sent.';
echo 'Mailer error: ' . $mail->ErrorInfo;
exit;
} else {
echo 'Message has been sent.';
}
?>