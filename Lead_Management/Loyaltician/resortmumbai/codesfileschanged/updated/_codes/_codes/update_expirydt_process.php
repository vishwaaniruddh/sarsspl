<?php session_Start();
include ('config.php');


var_dump($_POST); die;

    //   FirstName LastName offNum mob1 state City Company Designation Gmail
  
$ExpityDt=$_POST['ExpityDt'];
$leadid = $_POST['Leadid'];

date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');

if ($_POST['action']=="submit"){

   $sql="update members set ExpiryDate = '".$ExpityDt."' where Static_LeadId = '".$leadid."')";
 // echo $sql;
   $runsql=mysqli_query($conn,$sql);
    
}

//echo $sql
if($runsql){
     
  
    //===========for mail===============

$EmailSubject="Thank you, lead submitted successfully!";

   $MESSAGE_BODY="";
   $MESSAGE_BODY.="Sincerely,"."\r\n";
   $MESSAGE_BODY.="The Resort Mumbai,"."\r\n";
      
     $message="Dear ".$fullname."\r\n"."Thank you for your interest in our membership program at clubfourpoint. We are scheduled to launch the membership in the first week of April. One of our associates will call you to discuss the member benefits and enroll you as a patron member with us."."\r\n";
            
        $leadsmail=" contactus@theresortexperiences.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

$pagesource = "update_expirydt_process";
$memid = $leadid;
$msg = "";


$mail = new PHPMailer\PHPMailer\PHPMailer();
try{
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('contactus@theresortexperiences.com','The Resort Mumbai');
   
    $mail->addBCC('rajeshrungta719@gmail.com');
    $mail->addAddress('work.rajeshb@gmail.com');

    $mail->mailheader=$mailheader;// Add a recipient
    
    
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    // $mail->send();
//==============mail end===
}
catch(Exception $e){

    $msg = "Mail not send due to SMTP Host error!!!";
  
}


if($msg!='')
{
    $sqlr= mysqli_query($conn,"insert into testcatchdata (message,page_source,mem_id,status) values ('".$msg."','".$pagesource."','".$memid."',0) ");
    
}
else{
}

    echo '1'; 
    
   
}else{
    
    if($runsql1>0){
        echo '3';
    }else{
    echo '0';
    }
}
?>