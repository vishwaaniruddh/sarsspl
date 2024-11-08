<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');


$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];
// $cc = ['rajeshrungta719@gmail.com','work.rajeshb@gmail.com'];



$email->setFrom("enquiry@yosshitaneha.com","Yosshita Neha Fashion Studio");
// $email->setFrom("info@yosshitaneha.com","YosshitaNeha");
$email->setSubject($subject);
$email->addTo($to);
// $email->addCc($cc);
$email->addContent("text/html", $message);



try {
    $response = $sendgrid->send($email);
var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}