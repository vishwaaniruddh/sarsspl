
<?php
include('config.php');

$memid = "200";

$pagesource = "mailtest.php";
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';
/*
$mailheader2 = 'From: The Orchid Hotel Pune  <contactus@theresortexperiences.com>' . "\n";
$mailheader2 .= 'MIME-Version: 1.0' . "\n";
$mailheader2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
*/

$newmail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    $newmail->SMTPDebug = 2;                                 // Enable verbose debug output
    $newmail->isSMTP();                                      // Set mailer to use SMTP
    $newmail->Mailer = "smtp";// Set mailer to use SMTP
    $newmail->Host = 'smtp.hostinger.com';  // Specify main and backup SMTP servers
    $newmail->SMTPAuth = true;                               // Enable SMTP authentication
    $newmail->Username = 'contactus@prestigeclub.co.ke';                 // SMTP username
    $newmail->Password = 'briST!piCrlc7o#tOSO+';                           // SMTP password
    $newmail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $newmail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $newmail->setFrom('contactus@prestigeclub.co.ke','The Boma Hotels');

    $newmail->addAddress('rajeshrungta719@gmail.com');
   $newmail->addBCC('hellbinderkumar@gmail.com');
  $newmail->addBCC('work.rajeshb@gmail.com');
    
    
    $newmail->isHTML(true);                                  // Set email format to HTML
    $newmail->Subject = "Email Test";
    $newmail->Body    = "Email Testing is Done!";
try{    
    $newmail->send();
    echo 'Message has been sent';
}
catch(Exception $e){

    $msg = "Mail not send due to SMTP Host error!!!";
  
}


if($msg!='')
{
    // $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    echo '<script>alert("Mail not send due to SMTP Host error!!!");</script>' ;
}
else{
    echo "";
}

?>
