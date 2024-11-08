<?php
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail(); 
$sendgrid = new \SendGrid('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');

$email->setFrom("rajeshbiswas@sarmicrosystems.in", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("vishwaaniruddh@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");


try {
    $response = $sendgrid->send($email);

    var_dump($response->SendGridResponse);


} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}