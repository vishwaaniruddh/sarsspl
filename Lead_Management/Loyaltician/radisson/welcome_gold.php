<?php
include('config.php');

require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';



$Static_LeadID ='76649';

$sql_custom= mysqli_query($conn,"select * from Members where Static_LeadId='".$Static_LeadID."'");
$custrow=mysqli_fetch_assoc($sql_custom);


$validity = $custrow['ExpiryDate'];
$level = $custrow['MembershipDetails_Level'];
$booklet_series = $custrow['booklet_Series'];
$payment_mode = $custrow['MembershipDts_PaymentMode'];

$member_id = $custrow['GenerateMember_Id'];





    	 $sql5="SELECT FromSerialNo,ToSerialNo,AssignBooklet,Level_id FROM `voucher_Booklet` where Program_ID='2' and Level_id='1'";
    	 
  	 //$sql5="SELECT FromSerialNo,ToSerialNo,AssignBooklet,Level_id FROM `voucher_Booklet` where Program_ID='2' and Level_id='2'";
	$runsql5=mysqli_query($conn,$sql5);
	$sql5fetch=mysqli_fetch_array($runsql5);




     
     $AssignBooklet =  $sql5fetch['AssignBooklet'];

if($AssignBooklet==0){
 $AssignBooklet = $sql5fetch['FromSerialNo'];   
 $isfirst =1; 
}





       $EmailSubject2="Welcome to Club Four Points !";


$message2 ='
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Orchid Gold"></span>
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image003.png" alt="The Orchid Platinum">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>








<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear '.$Primary_nameOnTheCard.'</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Welcome to Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a
member at Four Points by Sheraton Navi Mumbai, Vashi. Your membership details
are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Gold</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is '.$member_id.'. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till '.$validity.' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. 9000 + 18% Goods &amp; Services
Tax amounting to Rs. 10620 /- (Rupees Ten Thousand Six Hundred and Twenty only)
has been received by '.$payment_mode.'.  A receipt is enclosed in
this email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.clubfourpoints.com">www.clubfourpoints.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Team Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 9808293333</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubfourpoints.com"><span style="font-size:12.0pt;
line-height:107%">www.clubfourpoints.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>





<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 
 <tr style="height:14.5pt">
 
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
 
  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>
 
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 
 </tr>';
 
 
 $srno=1;

$qry="select Leval_id,level_name from Level where Leval_id='1' ";
$did=1;

echo   $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."' and serviceName not like '%RENEWAL%'";

  $message2 .='SELECT serviceName,serialNumber FROM voucher_Type where level_id=1 and serviceName not like "%RENEWAL%"' ;
	
	
	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

 
  	     $remaining1=substr($sql2fetch['serialNumber'],8);
  	         //$value= $sql5fetch['AssignBooklet']+1;
  	         //$AssignBooklet1=$value.$remaining1;

    if($isfirst==1){
            $value= $AssignBooklet;
    }else{
        $value= $AssignBooklet+1;        
    }

  	         $AssignBooklet1=$value.$remaining1;

  	         
  	         
$message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'.$srno.'</span></p>
  </td>
  
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'. $sql2fetch['serviceName'].'</span></p>
  </td>
  
  
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'. $AssignBooklet1.'</span></p>
  </td>
 
 </tr>';
     $srno++;
} 

$message2 .='</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for Chalet Hotels Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubfourpoints.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘Club Four Points’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
echo $message2;


       
    //   return ; 
        $leadsmail2=" contactus@clubfourpoints.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 


// require 'phpmail/src/PHPMailer.php';
// require 'phpmail/src/SMTP.php';
// require 'phpmail/src/Exception.php';


$mail2 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                       // Set mailer to use SMTP
    $mail2->Host = 'mail.clubfourpoints.com';                    // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                                // Enable SMTP authentication
    $mail2->Username = 'contactus@clubfourpoints.com';            // SMTP username
    $mail2->Password = 'QKAc&mn,[xY%';                          // SMTP password
    $mail2->SMTPSecure = 'tls';                             // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                     // TCP port to connect to

    //Recipients
    $mail2->setFrom('contactus@clubfourpoints.com','Club Four Points');
     

    $mail2->mailheader=$mailheader2;// Add a recipient
    // $mail2->addBCC('khannakaran9317@gmail.com');
    $mail2->addBCC('vishwaaniruddh@gmail.com ');
    
    
    // $mail2->addAddress($Primary_Gmail_1); 
    //  $mail2->addCC('hitesh.gunwani@outlook.com ');

    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    // $mail2->send();
//==============mail end===
	      
	  