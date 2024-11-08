<?php require 'vendor/autoload.php';
$email = new \SendGrid\Mail\Mail(); 
$attachment = new \SendGrid\Mail\Attachment();

use \SendGrid\Mail\Personalization;
use \SendGrid\Mail\Cc;
use \SendGrid\Mail\Bcc;
use \SendGrid\Mail\To;


// $sendgrid = new \SendGrid('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');
$sendgrid = new \SendGrid('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');


$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];

// $ccc = ['hitesh.gunwani@gmail.com', 'roopal@loyaltician.com', 'digambar@loyaltician.com', 'Bharati@theresortexperiences.com' ,'Experiences@theresortmumbai.com'];


// Fetch the attachment
$sourceAttachmentPath = '../Lead_Management/Loyaltician/elinaire/Leadpdf/memberpdf/'.$primary_name.'.pdf';
$attachmentContent = base64_encode(file_get_contents($sourceAttachmentPath));
$attachmentFileName = $primary_name.'.pdf';

// $pdfstructure = $_REQUEST['pdfstructure'];
$primary_name = $_REQUEST['primary_name'];

$ccc = ['karan@loyaltician.com','preetesh@loyaltician.com','Contactus@clubelinaire.com','Roopal@loyaltician.com','hitesh.gunwani@gmail.com'];

var_dump($_REQUEST); 

$email->setFrom("Contactus@clubelinaire.com","Club Elinaire");
$email->setSubject($subject);
// $email->addTo($to);

foreach ( $ccc as $email_address ) {

    $personalization = new Personalization();
    $personalization->addTo( new To( $to ) );
    $personalization->addCc( new Cc( $email_address ) );
    $email->addPersonalization( $personalization );
}

$email->addContent("text/html", $message);

if($attachmentContent){
$email->addAttachment(
    $attachmentContent,
    "application/pdf",
    $attachmentFileName,
    "attachment"
);
}
try {
    $response = $sendgrid->send($email);
    var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}