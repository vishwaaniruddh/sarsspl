<?
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function is_dir_empty($dir) {
  if (!is_readable($dir)) return null; 
  return (count(scandir($dir)) == 2);
}



$EmailSubject = 'mail chck test';
$message = 'check mail now';
$leadsmail = "rajeshrungta19@gmail.com";

$host = 'mail.avoservice.in';
$hostusername = 'avoups@avoservice.in';
$hostpassword = 'DeeBee@12345';
$port = '587';

$from = 'avoups@avoservice.in';
$fromname = 'avo' ; 

$member_email = 'hellbinderkumar@gmail.com';    
$to =[$member_email];
$cc = ['work.rajeshb@gmail.com','rajeshrungta719@gmail.com'];
$bcc = ['pratimbiswas657@gmail.com'];

// $attachment = '';

// $pdfstructure = '';
// $primary_name = $_REQUEST['primary_name'];


$mailheader = "From: ".$from."\r\n"; 
$mailheader .= "Reply-To: ".$from."\r\n"; 


var_dump($_REQUEST); echo "<br>";

require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';




$mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->SMTPDebug = 1;                                   // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host = $host;                                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = $hostusername;                        // SMTP username
    $mail->Password = $hostpassword;                        // SMTP password
    $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $port;                                    // TCP port to connect to
    $mail->addReplyTo($leadsmail);
    
    //Recipients
    $mail->setFrom($from,$fromname);
    $mail->From = trim($hostusername);
    $mail->FromName = $fromname;
    
    foreach($to as $key=>$val){
            $mail->addAddress($val);         
    }

    foreach($cc as $keycc=>$valcc){
        $mail->addCC($valcc);
    }
    
    foreach($bcc as $keybcc=>$valbcc){
        $mail->addCC($valbcc);
    }
    
    $mail->mailheader=$mailheader;// Add a recipient




    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message;
    
    if($mail->send()){
        echo 1;
    }else{
        echo 0;
    }
    
    // var_dump($mail);
    
?>