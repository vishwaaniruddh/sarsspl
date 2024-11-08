<?php
include('config.php');
$id='83';
$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid=$row[1];
$level=$row[39];

$qgen1= mysqli_query($conn,"select * from Extension_history where member_id='".$id."'");
$row1=mysqli_fetch_row($qgen1);
$old_booklet = $row1[2];
$exp = $row1[4];
$date = strtotime($exp); 
$exp1=date('M Y', $date); 
 
$ext = $row1[5];
$date = strtotime($ext); 
$ext1=date('M Y', $date);

 $EmailSubject2="Revalidation of Membership Certificates";
        $message2.='<table width="70%" align="center">';
           $message2.='<tr>';
           $message2.='<th><img src="http://loyaltician.in/application/hotel.png" alt="hotel.png" width="100%" />  </th></tr><tr>';
        $message2.='<th><br>RENEWAL – CERTIFICATE REVALIDATION</th>';
        $message2.='</tr><tr>';
        $message2.='<th  style="text-align: left;"><br><b>Dear '. $Primary_nameOnTheCard.' , </b><br></th></tr><tr><td>&nbsp;</td></tr><tr>';
         $message2.='<td>We have renewed your Orchid Membership and thank you for your continuous patronage to our hotels.<br><br>
         <u>Certificate Details</u><br><br>
         As agreed, we are delighted to extend the following certificates of your choice which were originally valid till '.$exp1.'
<br></br>
         </td>';
       
       
        $message2.='</tr></table>';
       

$message2.='<table border="1" width="70%" align="center">';
        $message2.='<tr>';
        //$message2.='<th colspan="3">Gift Certificates issued – Orchid First</th>';
        //$message2.='</tr><tr>';
        $message2.='<th>SN</th><th>Certificate Name</th><th>Certificate Number</th><th>New Validity</th>';  
       
       

$srno=1;

//$qry="select Leval_id,level_name from Level where Leval_id='3' ";
//$did=1;
//  $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."'";
  $sql2="SELECT Voucher_id FROM `BarcodeScan` where Voucher_id like '".$old_booklet."%' and is_extended=1";
//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

  	     $remaining1=substr($sql2fetch['Voucher_id'],8);
  	     $sqlx="SELECT serviceName FROM `voucher_Type` where level_id='".$row[39]."' and Program_ID='".$remaining1."'";
  	     
  	     $runsqlx=mysqli_query($conn,$sqlx);
  	     $fetchx=mysqli_fetch_array($runsqlx);
  	        // $value= $sql5fetch['AssignBooklet']+1;
  	        $value=$row[64];
  	       //  $AssignBooklet1=$value.$remaining1;
            $voucher=$sql2fetch[0];

$message2.='
<tr height="5px">
<td>'.$srno.'</td>
<td>'. $fetchx[0].'</td>
<td>'. $voucher.'</td>
<td>'.$ext1.'</td>
</tr>
';
    
    $srno++;
} 

$message2.='</table><br><br>';

$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td>This email is an official confirmation of the extension of the above certificates. These certificates cannot be revalidated further beyond the given new validity. <br><br>
<u>Important</u><br><br>
Please note that the Original Certificate from your booklet must be produced at the hotel at the time of use / at the time of check-in along with a copy of this email.  This email is a confirmation of revalidation but cannot be used independently to avail of the benefit.<br><br>
We look forward to welcoming you as our esteemed Orchid member at our hotels.<br><br>
Yours sincerely<br><br><b>Team Orchid Gold / Platinum </b><br><br><br><b>+91 9169166789 </b><br><br>www.orchidhotel.com</td>

</tr>';
$message2.='</table><br>';
        
        
$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table><br>';


$message2.='<table width="70%" align="center">';
$message2.='<tr ><td><img src="http://loyaltician.in/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://loyaltician.in/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://loyaltician.in/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://loyaltician.in/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4"><br>The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br><br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

$message2.='</table>';

 //echo $message2;      
        $leadsmail2=" Orchidmembership@loyaltician.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

$mail2 = new PHPMailer\PHPMailer\PHPMailer();

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
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
  //  $mail2->addAddress($Primary_Gmail_1); 
  $mail2->addAddress('orchidgoldpune@orchidhotel.com'); 
  $mail2->addAddress('vishwaaniruddh@gmail.com');
   // $mail2->addCC('meanand.gupta21@gmail.com'); 
  //  $mail2->mailheader=$mailheader2;// Add a recipient
  //  $mail2->addCC('orchidgoldpune@orchidhotel.com');
 //   $mail2->addBCC('kvaljani@gmail.com ');
 //    $mail2->addCC('hitesh.gunwani@outlook.com');
 //    $mail2->addBCC('meanand.gupta21@gmai.com');
    
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
?>