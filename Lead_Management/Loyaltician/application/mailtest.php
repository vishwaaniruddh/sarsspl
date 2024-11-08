<?php

require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
    $mail->Password = 'Orchid#2022';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('leads@loyaltician.com', 'loyaltician');
    $mail->addAddress('work.rajeshb@gmail.com');
    $mail->mailheader = $mailheader;// Add a recipient

    $mail->addBCC('hellbinderkumar@gmail.com');



    $message = "test mail ";

    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject . "\r\n";
    $mail->Body = $message . "\r\n" . $MESSAGE_BODY;
    $mail->send();
} catch (Exception $e) {

    $msg = "Mail not send due to SMTP Host error!!!";

}


if ($msg != '') {
    // $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    echo '<script>alert("Mail not send due to SMTP Host error!!!");</script>';
} else {
    echo "success";
}


?>