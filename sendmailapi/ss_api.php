<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$sendgrid = new \SendGrid('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');

$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];


$setFrom = 'enquiry@srishringarr.com';
$email->setFrom($setFrom,"SriShringarr Fashion Studio");
$email->setSubject($subject);
$email->addTo($to);
$email->addCc('rajanipodar@gmail.com');
$email->addContent("text/html", $message);



try {
    $response = $sendgrid->send($email);
var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}