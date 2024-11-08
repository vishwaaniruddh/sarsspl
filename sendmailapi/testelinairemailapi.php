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
$pfstructure = $_REQUEST['pdfstructure'];
$attachm = $_REQUEST['attachment'];

var_dump($pfstructure);

// $ccc = ['hitesh.gunwani@gmail.com', 'roopal@loyaltician.com', 'digambar@loyaltician.com', 'Bharati@theresortexperiences.com' ,'Experiences@theresortmumbai.com'];
$attachm = $_REQUEST['attachment'];

// $pdfstructure = $_REQUEST['pdfstructure'];
$primary_name = $_REQUEST['primary_name'];

// $scourcepath = "Lead_Management/Loyaltician/elinaire/Leadpdf/memberpdf/'.$primary_name.'.pdf ";

$ccc = ['work.rajeshb@gmail.com'];

// $file_encod = base64_encode(file_get_contents('../Lead_Management/Loyaltician/elinaire/Leadpdf/memberpdf/'.$primary_name.'.pdf '));
// var_dump($file_encod);

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



/*
// Fetch the attachment
$sourceAttachmentPath = '../Lead_Management/Loyaltician/elinaire/Leadpdf/memberpdf/'.$primary_name.'.pdf';
$attachmentContent = base64_encode(file_get_contents($sourceAttachmentPath));

var_dump($attachmentContent);

// Move the attachment to a different folder
$destinationFolder = 'elinairepdf/';
$attachmentFileName = $primary_name.'.pdf';
$destinationAttachmentPath = $destinationFolder . $attachmentFileName;

var_dump($destinationAttachmentPath); echo "<br>";

if (!file_exists($destinationFolder)) {
    mkdir($destinationFolder, 0755, true);
}

if (copy($sourceAttachmentPath, $destinationAttachmentPath)) {
    echo "Attachment moved successfully!";
} else {
    echo "Failed to move attachment.";

}

$attachmentContent = base64_encode(file_get_contents($pdfstructure));

//Attach the moved attachment
if($attachmentContent){
$email->addAttachment(
    $attachmentContent,
    "application/pdf",
    $attachmentFileName,
    "attachment"
);
}
    // $file_encoded = base64_encode(file_get_contents($pfstructure));
    // $email->addAttachment(
    //   $file_encoded,
    //   "application/pdf",
    //   $primary_name.'.pdf',
    //   "attachment"
    // );
*/
if($attachm){




include('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {
    public function Header() {
    }

    public function Footer() {
    }
}



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle($primary_name);
$pdf->SetSubject('DER Report');
$pdf->SetKeywords('E-FSR, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}





$pdf->SetFont('times', '', 12);
$pdf->AddPage();
$pdf->SetMargins(5, 0, 10, true);
$pdf->SetFillColor(255, 255, 127);


if (is_dir_empty('Leadpdf/memberpdf')) {} else{
    $folder_path = "Leadpdf/memberpdf";
    $files = glob($folder_path.'/*'); 
    foreach($files as $file) {
        if(is_file($file)) 
            unlink($file); 
    }
}

$pdf->writeHTML($pdfstructure , true, false, false, false, '');
$pdf->Output('Leadpdf/memberpdf/'.$primary_name.'.pdf','F');
$email->addAttachment("Leadpdf/memberpdf/$primary_name.pdf");
}




try {
    $response = $sendgrid->send($email);
    var_dump($response);

} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}