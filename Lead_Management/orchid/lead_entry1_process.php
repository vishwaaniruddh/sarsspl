<?php 
session_Start();
include ('config.php');

    //   FirstName LastName offNum mob1 state City Company Designation Gmail
  
   
$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$fullname=$FirstName." ".$LastName;
$mcode1=$_POST['mcode1'];
$mob1=$_POST['mob1'];
$Contact1code=$_POST['Contact1code'];
$offNum=$_POST['offNum'];
$state=$_POST['state'];
$City=$_POST['City'];
$Company=$_POST['Company'];
$Designation=$_POST['Designation'];
$Gmail=$_POST['Gmail'];


date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');


$sql="insert into Leads_table(Title,FirstName,LastName,MobileCode,MobileNumber,contact1Code,ContactNo1,ContactNo2,ContactNo3,EmailId,FacebookId,Country,State,City,Nationality,Company,Designation,DelegationStatus,Creation,LeadSource,Status,leadEntryef) values('','".$FirstName."','".$LastName."','".$mcode1."','".$mob1."','".$Contact1code."','".$offNum."','','','".$Gmail."','','','".$state."','".$City."','','".$Company."','".$Designation."','','".$dates."','','0','".$_SESSION['id']."')";
$runsql=mysqli_query($conn,$sql);

//echo $sql;
if($runsql){
    
    //===========for mail===============

$EmailSubject="Thank you, lead submitted successfully!";

   $MESSAGE_BODY="";
   $MESSAGE_BODY.="Sincerely,"."\r\n";
   $MESSAGE_BODY.="Team The Orchid Pune,"."\r\n";
      
     $message="Dear ".$fullname."\r\n"."Thank you for your interest in our membership program at The Orchid Pune. We are scheduled to launch the membership in the first week of April. One of our associates will call you to discuss the member benefits and enroll you as a patron member with us."."\r\n";
            
        $leadsmail=" Orchidmembership@loyaltician.com";
        $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 
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
    $mail->setFrom('leads@loyaltician.com','loyaltician');
    $mail->addAddress($Gmail); 
    $mail->mailheader=$mailheader;// Add a recipient
    $mail->addCC('leads@loyaltician.com');
    $mail->addCC('satyendra1111@gmail.com');
   // $mail->addBCC('admin@loyaltician.com ');
     $mail->addBCC('kvaljani@gmail.com');
    
    
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    $mail->send();
//==============mail end===

    
    
    
    
    
    
    
    
    
    
   echo '1';
}else{
    echo '0';
}
?>