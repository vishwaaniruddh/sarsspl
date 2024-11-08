
<?php
include('config.php');

// $memid = "200";

$pagesource = "mailtest.php";
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try{
    //Server settings
    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = ' smtp.hostinger.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contactus@clubeliteplus.com';                 // SMTP username
    $mail->Password = '8x%8AovpL3O8';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('contactus@clubeliteplus.com','Radisson');

    $mail->addAddress('work.rajeshb@gmail.com');
    $mail->mailheader=$mailheader;// Add a recipient
    
   $mail->addBCC('hellbinderkumar@gmail.com');
    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Test"."\r\n";
    $mail->Body    = "Testing!!!!";
    $mail->send();
    echo 'Message has been sent';
}
catch(Exception $e){

    $msg = "Mail not send due to SMTP Host error!!!";
  
}


if($msg!='')
{
    // $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    echo '<script>alert("Mail not send due to SMTP Host error!!!ClubFourPoints!!");</script>' ;
}
else{
    echo "";
}

?>
