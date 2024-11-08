<?php session_start();?>
<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 </head>
<body>
<?php
include('config.php');

$CourierName=$_POST['CourierName'];
$DocketNumber=$_POST['DocketNumber'];
$dispatchDt=$_POST['dispatchDate'];
$MemberId=$_POST['HiddenId'];


$pagesource = "dispatch_Process";
$memid = $MemberId;
$msg = "";

$dispatchDate = date('Y-m-d', strtotime($dispatchDt));
$dispatchDtFormat = date('d-m-Y', strtotime($dispatchDt));

$Qry=mysqli_query($conn,"insert into dispatchDetails (Member_ID,CourierName,DocketNumber,dispatchDate)values('".$MemberId."','".$CourierName."','".$DocketNumber."','".$dispatchDate."')");
if($Qry>0){
  
$Qry=mysqli_query($conn,"Update Members set dispatched_status='1' where mem_id='".$MemberId."' ");


  
 	$sql1="	SELECT Primary_nameOnTheCard,GenerateMember_Id,MembershipDetails_Level,entryDate,ExpiryDate from Members where mem_id='".$MemberId."' ";
	$runsql1=mysqli_query($conn,$sql1);
	$sql1fetch=mysqli_fetch_array($runsql1);

 	$sql2="	SELECT VoucherBookletNumber from voucher_Details where MembershipNumber='".$sql1fetch['GenerateMember_Id']."' ";
	$runsql2=mysqli_query($conn,$sql2);
	$sql2fetch=mysqli_fetch_array($runsql2);

    

    $R = date('F, Y', strtotime($sql1fetch['ExpiryDate']));


if($sql1fetch['MembershipDetails_Level']==1){

  //===========for mail Welcome Latter First Orchid Member===============





$EmailSubject2="Orchid First Membership Package has been dispatched!";

   
 
     $message2="";
       
        $message2.='<table width="70%" align="center">';
          // $message2.='<tr><th>The Orchid First Member</th></tr>';
          $message2.='<tr>';
           $message2.='<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
           
        $message2.='<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/FIRST.png" alt="FIRST.png" />    </th>';
        $message2.='</tr><tr>';
        $message2.='<th style="text-align: left;"><b >Dear '. $sql1fetch['Primary_nameOnTheCard'].' ,</b></th></tr><tr><br>';
         $message2.='<td>Greetings from Orchid First! <br>

We have dispatched your Membership Package. The package contains the following:  <br>
•	Membership Card Number – '.$sql1fetch['GenerateMember_Id'].' <br>
•	Validity - '.$R.' <br>
•	Gift Certificate Booklet Number - '.$sql2fetch["VoucherBookletNumber"] .' <br>
Following are the dispatch details:<br>
•	Dispatch Date – '.$dispatchDtFormat.'<br>
•	Courier Company - '.$CourierName.'<br>
•	Tracking (Way Bill) Number - '.$DocketNumber.'<br>
You can track this package on www.shreenandancourier.com <br>

<br></br><br><br>

If you have not received your membership package, please reply back to us by replying to this email or contact us at Member Help Desk between 9.30 am to 6.30 pm, Monday to Saturday, excluding public holidays.<br>

We look forward to welcoming you to our hotel as an Orchid First member. Do remember to carry your Orchid First membership card and certificates to avail of the benefits.



         </td>';
       
       
        $message2.='</tr></table>';
       
         
$message2.='</table>';



$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid First </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';



$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table>';

       
        $leadsmail2=" Orchidmembership@loyaltician.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';


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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail2->addAddress('meanand.gupta21@gmail.com'); 
    $mail2->mailheader=$mailheader2;// Add a recipient
    $mail2->addCC('hitesh.gunwani@outlook.com');
    $mail2->addBCC('kvaljani@gmail.com ');
  
    
    
    $mail2->isHTML(true);                                  // Set email format to HTML
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
  
    
    //========================== for log details==================
    $EmailSubject9="Orchid First Membership Package has been dispatched by ".$_SESSION['user'] ;
    
    
    
        $message9.='<table width="70%" align="center">';
          $message9.='<tr>';
        $message9.='<th style="text-align: left;"><b >Dear '. $sql1fetch['Primary_nameOnTheCard'].' ,</b></th></tr><tr></br>';
         $message9.='<td>Greetings from Orchid First! <br>

We have dispatched your Membership Package. The package contains the following:  <br>
•	Membership Card Number – '.$sql1fetch['GenerateMember_Id'].' <br>
•	Validity - '.$R.' <br>
•	Gift Certificate Booklet Number - '.$sql2fetch["VoucherBookletNumber"] .' <br>
Following are the dispatch details:<br>
•	Dispatch Date – '.$dispatchDtFormat.'<br>
•	Courier Company - '.$CourierName.'<br>
•	Tracking (Way Bill) Number - '.$DocketNumber.'<br>


         </td>';
       
       
        $message9.='</tr></table>';
    
    $mail9 = new PHPMailer\PHPMailer\PHPMailer();
try{
    
    $mail9->isSMTP();                                      // Set mailer to use SMTP
    $mail9->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail9->SMTPAuth = true;                               // Enable SMTP authentication
    $mail9->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail9->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail9->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail9->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail9->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail9->addAddress('meanand.gupta21@gmail.com'); 
    $mail9->mailheader=$mailheader2;// Add a recipient
    $mail9->addCC('hitesh.gunwani@outlook.com');
    $mail9->addBCC('kvaljani@gmail.com ');
   
    
    
    $mail9->isHTML(true);                                  // Set email format to HTML
    $mail9->Subject = $EmailSubject9."\r\n";
    $mail9->Body    = $message9;
    $mail9->send();
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
   
//==============mail end===
}
else if($sql1fetch['MembershipDetails_Level']==2){
    
         //===========for mail Dispatched Latter Gold Orchid Member===============

        $EmailSubject2="Orchid Gold Membership Package has been dispatched!";

        $message2.='<table width="70%" align="center">';
        // $message2.='<tr><th>The Orchid First Member</th></tr>';
        $message2.='<tr>';
        $message2.='<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
           
        $message2.='<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/GOLD.png" alt="GOLD.png" />    </th>';
        $message2.='</tr><tr>';
        $message2.='<th style="text-align: left;"><b >Dear '. $sql1fetch['Primary_nameOnTheCard'].',</b></th></tr><tr></br>';
        $message2.='<td>Greetings from Orchid First! <br>

We have dispatched your Membership Package. The package contains the following:  <br>
•	Membership Card Number – '.$sql1fetch['GenerateMember_Id'].' <br>
•	Validity - '.$R.' <br>
•	Gift Certificate Booklet Number - '.$sql2fetch["VoucherBookletNumber"] .' <br>
Following are the dispatch details:<br>
•	Dispatch Date – '.$dispatchDtFormat.'<br>
•	Courier Company - '.$CourierName.'<br>
•	Tracking (Way Bill) Number - '.$DocketNumber.'<br>
You can track this package on www.shreenandancourier.com <br>

<br></br><br><br>

If you have not received your membership package, please reply back to us by replying to this email or contact us at Member Help Desk between 9.30 am to 6.30 pm, Monday to Saturday, excluding public holidays.<br>

We look forward to welcoming you to our hotel as an Orchid Gold member. Do remember to carry your Orchid Gold membership card and certificates to avail of the benefits.



         </td>';
       
       
        $message2.='</tr></table>';
       
         
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid Gold </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';




$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table>';

       
        $leadsmail2=" Orchidmembership@loyaltician.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail2->addAddress('meanand.gupta21@gmail.com'); 
    $mail2->mailheader=$mailheader2;// Add a recipient
    $mail2->addCC('hitesh.gunwani@outlook.com');
    $mail2->addBCC('kvaljani@gmail.com ');
    
    
    $mail2->isHTML(true);                                  // Set email format to HTML
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
   
    
    
    
    
    
    
    //========================== for log details==================
    $EmailSubject9="Orchid Gold Membership Package has been dispatched by ".$_SESSION['user'] ;
    
    
    
        $message9.='<table width="70%" align="center">';
          $message9.='<tr>';
        $message9.='<th style="text-align: left;"><b >Dear '. $sql1fetch['Primary_nameOnTheCard'].' ,</b></th></tr><tr></br>';
         $message9.='<td>Greetings from Orchid Gold! <br>

We have dispatched your Membership Package. The package contains the following:  <br>
•	Membership Card Number – '.$sql1fetch['GenerateMember_Id'].' <br>
•	Validity - '.$R.' <br>
•	Gift Certificate Booklet Number - '.$sql2fetch["VoucherBookletNumber"] .' <br>
Following are the dispatch details:<br>
•	Dispatch Date – '.$dispatchDtFormat.'<br>
•	Courier Company - '.$CourierName.'<br>
•	Tracking (Way Bill) Number - '.$DocketNumber.'<br>


         </td>';
        $message9.='</tr></table>';
    
     $mail9 = new PHPMailer\PHPMailer\PHPMailer();
try{
    $mail9->isSMTP();                                      // Set mailer to use SMTP
    $mail9->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail9->SMTPAuth = true;                               // Enable SMTP authentication
    $mail9->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail9->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail9->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail9->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail9->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail9->addAddress('meanand.gupta21@gmail.com'); 
    $mail9->mailheader=$mailheader2;// Add a recipient
    $mail9->addBCC('kvaljani@gmail.com ');
    $mail9->addCC('hitesh.gunwani@outlook.com');
    
    
    $mail9->isHTML(true);                                  // Set email format to HTML
    $mail9->Subject = $EmailSubject9."\r\n";
    $mail9->Body    = $message9;
    $mail9->send();
    
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
   
    
    
    
//==============mail end===
    
    
    
}
else if($sql1fetch['MembershipDetails_Level']==3){
    
     //===========for mail Dispatched Latter Platinum Orchid Member===============





$EmailSubject2="Orchid Platinum Membership Package has been dispatched!";

   
 
     
       
        $message2.='<table width="70%" align="center">';
          // $message2.='<tr><th>The Orchid First Member</th></tr>';
          $message2.='<tr>';
           $message2.='<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
           
        $message2.='<th><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/PLATINUM.png" alt="PLATINUM.png" />    </th>';
        $message2.='</tr><tr>';
        $message2.='<th style="text-align: left;"><b >Dear '. $sql1fetch['Primary_nameOnTheCard'].' ,</b></th></tr><tr></br>';
         $message2.='<td>Greetings from Orchid Platinum! <br>

We have dispatched your Membership Package. The package contains the following:  <br>
•	Membership Card Number – '.$sql1fetch['GenerateMember_Id'].' <br>
•	Validity - '.$R.' <br>
•	Gift Certificate Booklet Number - '.$sql2fetch["VoucherBookletNumber"] .' <br>
Following are the dispatch details:<br>
•	Dispatch Date – '.$dispatchDtFormat.'<br>
•	Courier Company - '.$CourierName.'<br>
•	Tracking (Way Bill) Number - '.$DocketNumber.'<br>
You can track this package on www.shreenandancourier.com <br>

<br></br><br><br>

If you have not received your membership package, please reply back to us by replying to this email or contact us at Member Help Desk between 9.30 am to 6.30 pm, Monday to Saturday, excluding public holidays.<br><br><br>

We look forward to welcoming you to our hotel as an Orchid Platinum member. Do remember to carry your Orchid Platinum membership card and certificates to avail of the benefits.



         </td>';
       
       
        $message2.='</tr></table>';
       
         
$message2.='</table>';

$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid Platinum </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';



$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table>';

       
        $leadsmail2=" Orchidmembership@loyaltician.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail2->addAddress('meanand.gupta21@gmail.com'); 
    $mail2->mailheader=$mailheader2;// Add a recipient
    $mail2->addCC('hitesh.gunwani@outlook.com');
    $mail2->addBCC('kvaljani@gmail.com ');
    
    
    $mail2->isHTML(true);                                  // Set email format to HTML
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
 
    
    
    
    
    
    
    //========================== for log details==================
    $EmailSubject9="Orchid Platinum Membership Package has been dispatched by ".$_SESSION['user'] ;
    
    
    
        $message9.='<table width="70%" align="center">';
          $message9.='<tr>';
        $message9.='<th style="text-align: left;"><b >Dear '. $sql1fetch['Primary_nameOnTheCard'].' ,</b></th></tr><tr></br>';
         $message9.='<td>Greetings from Orchid First! <br>

We have dispatched your Membership Package. The package contains the following:  <br>
•	Membership Card Number – '.$sql1fetch['GenerateMember_Id'].' <br>
•	Validity - '.$R.' <br>
•	Gift Certificate Booklet Number - '.$sql2fetch["VoucherBookletNumber"] .' <br>
Following are the dispatch details:<br>
•	Dispatch Date – '.$dispatchDtFormat.'<br>
•	Courier Company - '.$CourierName.'<br>
•	Tracking (Way Bill) Number - '.$DocketNumber.'<br>


         </td>';
        $message9.='</tr></table>';
    
     $mail9 = new PHPMailer\PHPMailer\PHPMailer();
try{
    $mail9->isSMTP();                                      // Set mailer to use SMTP
    $mail9->Host = 'mail.theresortexperiences.com';  // Specify main and backup SMTP servers
    $mail9->SMTPAuth = true;                               // Enable SMTP authentication
    $mail9->Username = 'contactus@theresortexperiences.com';                 // SMTP username
    $mail9->Password = '94Z6g.;d1CSq';                           // SMTP password
    $mail9->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail9->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail9->setFrom('orchidgoldpune@orchidhotel.com','orchidhotel');
    $mail9->addAddress('meanand.gupta21@gmail.com'); 
    $mail9->mailheader=$mailheader2;// Add a recipient
    //  $mail->addCC('leads@loyaltician.com');
    $mail9->addBCC('kvaljani@gmail.com ');
    $mail9->addCC('hitesh.gunwani@outlook.com');
    
    
    $mail9->isHTML(true);                                  // Set email format to HTML
    $mail9->Subject = $EmailSubject9."\r\n";
    $mail9->Body    = $message9;
    $mail9->send();
    
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
  
    
    
    
    
    
    
    
    
//==============mail end===
    
    
    
}


?>






   <script> 
 swal({
  title: "Success!",
  text: "Dispatch Email Send!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    // window.open("Members_view.php","_self");
    window.location.href = "Members_view.php";
    
  } 
});
     
</script>
 <?php   
}else{
   echo "<script>swal('Error !')</script>";
}

?>

</body>
</html>