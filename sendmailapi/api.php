<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');


$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];


$email->setFrom("rajeshbiswas@sarmicrosystems.in","Rajesh");
// $email->setFrom("info@yosshitaneha.com","YosshitaNeha");
$email->setSubject($subject);
$email->addTo($to);
$email->addContent("text/html", $message);



try {
    $response = $sendgrid->send($email);
var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}