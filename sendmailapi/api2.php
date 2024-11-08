<?php
require 'vendor/autoload.php'; 

$email = new \SendGrid\Mail\Mail(); 
// $sendgrid = new \SendGrid('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');
$sendgrid = new \SendGrid('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');

$from = $_REQUEST['from'];
$fromname = $_REQUEST['fromname'];

$bcc = $_REQUEST['bcc'];    //array
$to = $_REQUEST['to'];      //array
$cc = $_REQUEST['cc'];      //array
$attachment = $_REQUEST['attachment'];


$EmailSubject = $_REQUEST['subject'];
$message = $_REQUEST['message'];
$leadsmail = $_REQUEST['leadsmail'];


$host = $_REQUEST['host'];
$hostusername = $_REQUEST['hostusername'];
$hostpassword = $_REQUEST['hostpassword'];
$port = $_REQUEST['port'];


foreach($to as $to_key=>$to_value){
    
    // $email->setFrom($from, $fromname);
    $email->setFrom("Contactus@clubelinaire.com","Club Elinaire");
    $email->setSubject($EmailSubject);
    $email->addTo($to_value, "Example User");
    
    $email->addContent("text/html", $message);
    
    
    try {
        $response = $sendgrid->send($email);
    
    
    echo 'Email Sent to '.$to_value . '<br />' ; 
    
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }    
}

