<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');


// print_r($_REQUEST); die;

$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$leadsmail = $_REQUEST['leadsmail'];

// $host = $_REQUEST['host'];
// $hostusername = $_REQUEST['hostusername'];
// $hostpassword = $_REQUEST['hostpassword'];
// $port = $_REQUEST['port'];



// $bcc = $_REQUEST['bcc'];    //array
$to = $_REQUEST['to'];      //array
$cc = $_REQUEST['cc'];      //array


$email->setFrom('enquiry@yosshitaneha.com','the resort mumbai');
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