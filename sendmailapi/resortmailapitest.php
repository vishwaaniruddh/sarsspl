<?php require 'vendor/autoload.php';


$email = new \SendGrid\Mail\Mail(); 
$attachment = new \SendGrid\Mail\Attachment();
// $personalization = new \SendGrid\Mail\Personalization();
use \SendGrid\Mail\Personalization;
use \SendGrid\Mail\Cc;
use \SendGrid\Mail\Bcc;
use \SendGrid\Mail\To;

$sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');
// $sendgrid = new \SendGrid('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');



/* 

resort new api  key : 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
old api key :

new type billing

billing : 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

normal : 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 
        : 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
*/


echo "mail is here"."<br>";
$subject = $_REQUEST['subject'];
$to = $_REQUEST['to'];
$message = $_REQUEST['message'];

$bcc = $_REQUEST['bcc'];    //array
$cc = $_REQUEST['cc'];      //array
$attachm = $_REQUEST['attachment'];



// $pdfstructure = $_REQUEST['pdfstructure'];
$primary_name = $_REQUEST['primary_name'];


$ccc = ['rajeshrungta719@gmail.com','hellbinderkumar@gmail.com','work.rajesh.b@gmail.com'];
// $branch = explode(',', $bcc);
// $branch = json_encode($bcc);
//         $branch = str_replace(array('[', ']', '"'), '', $branch);
//         $branch = explode(',', $branch);
//         $bccc = "'" . implode("', '", $branch) . "'";

var_dump($_REQUEST); 


$filePath=$_REQUEST['filepath'];

// $email->setFrom("rajeshrungta719@gmail.com","rajesh mail");
$email->setFrom("smartscoreanalytic@gmail.com","The Resort Mumbai");
$email->setSubject($subject);


// $email->setReplyTo(new ReplyTo("rajeshrungta719@gmail.com"));
// $email->addTo($to);

    //  if(isset($ccc)){
    //     foreach($bcc as $keybcc=>$valbcc){
    //         $email->addCC($valbcc);
    //     }
     

foreach ( $ccc as $email_address ) {

    $personalization = new Personalization();
    $personalization->addTo( new To( $to ) );
    $personalization->addBcc( new Bcc( $email_address ) );
    $email->addPersonalization( $personalization );
}



// if($bcc){
//     foreach($bcc as $keycc=>$valcc){
//         $email->addCc($valcc);
//     }
   
// }

    //  if(isset($bcc)){
    //     foreach($bcc as $keybcc=>$valbcc){
    //         $email->addBccs($valbcc);
    //     }
    //  }

// var_dump($email);

// $msg = "content test";
$email->addContent("text/html", $message);

  $attach = "Leadpdf/memberpdf/Ms Carmelita Fernandes.pdf";


if($attachm){
    $file_encoded = base64_encode(file_get_contents('Leadpdf/memberpdf/'.$primary_name.'.pdf'));
    $email->addAttachment(
       $file_encoded,
       "application/pdf",
       $primary_name.".pdf",
       "attachment"
    );
}

try {
    $response = $sendgrid->send($email);
    var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}