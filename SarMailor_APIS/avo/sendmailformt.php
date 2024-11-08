
<?php
// include('../config.php');

// var_dump($_REQUEST); 

// $atmIP = $_REQUEST['atmIP'];

$siteid = $_REQUEST['siteid'];
$invoiceNo = $_REQUEST['invoiceNo'];
$problemReported = $_REQUEST['problemReported'];
$contactPerson = $_REQUEST['contactPerson'];
$contactNo = $_REQUEST['contactNo'];
$handset = $_REQUEST['Handset'];

$message = $_REQUEST['message'];
$message = quoted_printable_decode($message);
$message = str_replace('<br>', '', $message);

// $pagesource = "mailtest.php";
require_once '../phpmail/src/PHPMailer.php';
require_once '../phpmail/src/SMTP.php';
require_once '../phpmail/src/Exception.php';
/*
$mailheader2 = 'From: The Orchid Hotel Pune  <contactus@theresortexperiences.com>' . "\n";
$mailheader2 .= 'MIME-Version: 1.0' . "\n";
$mailheader2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
*/

$newmail = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    $newmail->SMTPDebug = 1;                                 // Enable verbose debug output
    $newmail->isSMTP();                                      // Set mailer to use SMTP
    $newmail->Mailer = "SMTP";// Set mailer to use SMTP
    $newmail->Host = 'mail.avoservice.in';  // Specify main and backup SMTP servers
    $newmail->SMTPAuth = true;                               // Enable SMTP authentication
    $newmail->Username = 'avoups@avoservice.in';                 // SMTP username
    $newmail->Password = 'DeeBee@12345';                           // SMTP password
    $newmail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $newmail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $newmail->setFrom('avoups@avoservice.in','test avo');

    // $newmail->addAddress('boopathy@avoups.com');
    $newmail->addAddress('rajeshrungta719@gmail.com');

  $newmail->addBCC('work.rajeshb@gmail.com');
//   $newmail->addCc('bhoopathy_vsp@yahoo.co.in');
    
    
    $newmail->isHTML(true);          // Set email format to HTML
    $newmail->Subject = "Email records";
    $newmail->Body    = $message;
try{    
  $ch = $newmail->send();
  echo $ch;
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
