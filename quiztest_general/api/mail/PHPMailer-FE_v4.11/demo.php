<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/mail/PHPMailer-FE_v4.11/_lib/class.phpmailer.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


//PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "aniruddh@sarmicrosystems.in";
$mail->FromName = "Aniruddh vishwakarma";

//To address and name
$mail->addAddress("aniruddhvishwa@gmail.com", "Aniruddh");
// $mail->addAddress("recepient1@example.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("aniruddhvishwa@gmail.com", "Reply");

//CC and BCC
$mail->addCC("aniruddhvishwa@gmail.com");
$mail->addBCC("aniruddhvishwa@gmail.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
?>



