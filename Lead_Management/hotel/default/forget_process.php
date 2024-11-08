<?php
include('config.php');

$email=$_POST['forgetemail'];

$sql=mysqli_query($conn,"select * from HotelUsers where emailid='".$email."' or mobile='".$email."' ");
$row=mysqli_fetch_array($sql);
$num_row=mysqli_num_rows($sql);

       
if($num_row >0){
    
   // mail($row['emailid'], $EmailSubject,  $MESSAGE_BODY,$mailheader) or die ("Failure");
//===========for mail===============

$EmailSubject="Password Recovery ";

    $MESSAGE_BODY="";
    $MESSAGE_BODY.="your password is: ".$row["password"]."\r\n";
      
     $message="Dear ".$row['empname']." You have been successfully Recovery please login with following link"."\r\n";
            $message.="http://sarmicrosystems.in/Lead_Management/hotel/default/login.php";
        $leadsmail="leads@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
//require 'phpmail/src/Exception.php';
require '../../phpmail/src/PHPMailer.php';
require '../../phpmail/src/SMTP.php';

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
    $mail->setFrom('leads@loyaltician.com');
    $mail->addAddress($email); 
    $mail->mailheader=$mailheader;// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('ramshankargupta444@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
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
   
   
    echo "1";
}
 


?>