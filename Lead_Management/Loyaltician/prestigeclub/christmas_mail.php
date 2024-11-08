<?php include('config.php');

// return; 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

$message2 ='';

$sql = mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members");

$count = 1 ; 
// while($sql_result = mysqli_fetch_assoc($sql)){
if($sql_result = mysqli_fetch_assoc($sql)){
    

    $lead_id = $sql_result['Static_LeadID'];
    $member_name = $sql_result['Primary_nameOnTheCard'];
    
    $lead_sql = mysqli_query($conn,"select EmailId from Leads_table where Lead_id = '".$lead_id."'");
    
    $lead_sql_result = mysqli_fetch_assoc($lead_sql);
        
    $emailid = $lead_sql_result['EmailId'];
    
    if($emailid){
        
    
    

 $EmailSubject2="The Orchid Boutique Ecotel Resort - Lonavala";

$message2 ='';
$message2 .= '<div>


<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<img style="width: auto; height: 700px;" src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/assets/christmas.jpeg">
</td>
</tr>
</tbody>
</table>
</div> ';







echo $message2;

// echo $count . '' . $emailid ;  


// return;





 //echo $message2;      
  
  $pagesource = "Member_Payment_Process";
$memid = $lead_id;
$msg = "";
  
  
  $mail2 = new PHPMailer\PHPMailer\PHPMailer();

try{
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail2->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                    // TCP port to connect to
    
    
    
    
    
    $leadsmail2=" Orchidmembership@loyaltician.com";
    $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
    
    
    
    
    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
    
    $emailid = 'vishwaaniruddh@gmail.com';
      $mail2->addAddress($emailid);
    
// $mail2->addCC('satyendra1111@gmail.com');
$mail2->addBCC('vishwaaniruddh@gmail.com');
// $mail2->addCC('hitesh.gunwani@outlook.com');



  //  $mail2->mailheader=$mailheader2;// Add a recipient
  //  $mail2->addCC('orchidgoldpune@orchidhotel.com');
 //   $mail2->addBCC('kvaljani@gmail.com ');
 //    $mail2->addCC('hitesh.gunwani@outlook.com');
 //    $mail2->addBCC('meanand.gupta21@gmai.com');

    // $mail2->addAttachment("img/Fort_Monsoon Package.pdf");


    $mail2->isHTML(true); // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
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
    
    //  $count++; 
    //  echo '<br>';
}
}
?>