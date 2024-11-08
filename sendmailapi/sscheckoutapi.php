<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail();
$sendgrid = new \SendGrid('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');


$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];


$email->setFrom("enquiry@srishringarr.com","Srishringarr Fashion Studio");
// $email->setFrom("info@yosshitaneha.com","YosshitaNeha");
$email->setSubject($subject);
$email->addTo($to);
$email->addCc('rajanipodar@gmail.com');
$email->addBcc('yosshita.neha@gmail.com');
$email->addBcc('akrutimanjrekar96@gmail.com');
$email->addContent("text/html", $message);



try {
    $response = $sendgrid->send($email);
var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}