<?php
session_start();
include('../ecommerce_config.php');
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$id=$_GET['id'];
// call make pdf function
$ch = curl_init();
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://allmart.world/franchise/Product_recipts/invoice.php?user_id=".$id);
curl_setopt($ch, CURLOPT_HEADER, 0);
// grab URL and pass it to the browser
curl_exec($ch);
// close cURL resource, and free up system resources
curl_close($ch);

$checkorder="SELECT * FROM `franchise_received_products` WHERE id='$id'";
$orderresult=mysqli_query($con_web,$checkorder);
$orderresult = mysqli_fetch_assoc($orderresult);

$check="SELECT * FROM `new_member` WHERE id='".$orderresult['franchise_id']."'";
$sqlresult=mysqli_query($con_web,$check);
$userdetails= mysqli_fetch_assoc($sqlresult);
// $fetchemail="prabir.d06@gmail.com";
//$fetchemail="work.rjkashyap05@gmail.com";
$fetchemail=$userdetails['email'];

//===========for mail===============

if($fetchemail!=''){

$EmailSubject="You Purchase From AllMart Successfully, Your Order Ship Shortly";

$MESSAGE_BODY="";
     
     $message="Dear ".$userdetails["name"].", You Order Successfully, Your Order deliver Shortly";

        $leadsmail="ram@sarmicrosystems.in', 'Mailer";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/Exception.php';
require '../phpmail/src/PHPMailer.php';
require '../phpmail/src/SMTP.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sarmicrosystems.in';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram@sarmicrosystems.in';                 // SMTP username
    $mail->Password = 'ram1234*';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ram@sarmicrosystems.in', 'Temple login');
    $mail->addAddress($fetchemail); 
    $mail->mailheader=$mailheader;// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('ramshankargupta444@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    // $imgs=$orderresult['packaging_images'];
    // $imgs = explode(', ', $imgs);
    // for ($i=0; $i <count($imgs) ; $i++) { 
    //     $mail->addAttachment(__DIR__ . '/../admin/'.$imgs[$i]);
    // }
    
    $mail->addAttachment(__DIR__ . '/bill/Invoice-'.$id . '.pdf');         // Add attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->AltBody=$MESSAGE_BODY;
    $mail->send();
//==============mail end===

            if($mail)
            {
                echo "send";
            }
            else
            {
                echo "Not Send";
            }
}
  
?>