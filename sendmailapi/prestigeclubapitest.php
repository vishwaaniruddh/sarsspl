<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$attachment = new \SendGrid\Mail\Attachment();

use \SendGrid\Mail\Personalization;
use \SendGrid\Mail\Cc;
use \SendGrid\Mail\Bcc;
use \SendGrid\Mail\To;


$sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');


$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];

// $ccc = ['hitesh.gunwani@gmail.com', 'roopal@loyaltician.com', 'digambar@loyaltician.com', 'Bharati@theresortexperiences.com' ,'Experiences@theresortmumbai.com'];
// $ccc = ['rajeshtester83@gmail.com','work.rajeshb@gmail.com','hellbinderkumar@gmail.com'];
$ccc = ['hitesh.gunwani@gmail.com', 'roopal@loyaltician.com','accounts@loyaltician.com'];
$attachm = $_REQUEST['attachment'];

// $pdfstructure = $_REQUEST['pdfstructure'];
$primary_name = $_REQUEST['primary_name'];

// $cc = ['rajeshrungta719@gmail.com','work.rajeshb@gmail.com'];

var_dump($_REQUEST); 

$email->setFrom("contactus@theresortexperiences.com","The Boma Hotels");
$email->setSubject($subject);
// $email->addTo($to);

foreach ( $ccc as $email_address ) {

    $personalization = new Personalization();
    $personalization->addTo( new To( $to ) );
    $personalization->addCc( new Cc( $email_address ) );
    $email->addPersonalization( $personalization );
}

$email->addContent("text/html", $message);



try {
    $response = $sendgrid->send($email);
    var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}