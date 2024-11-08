<?php
$Primary_nameOnTheCard = 'Satyendra Sharma';

$EmailSubject2="Revalidation Letter for Renewals";

$message2.='<table width="50%" align="center">';
  
$message2.='<tr>';
$message2.='<th><br><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/img/orchid-first.png" alt="gold_logo.png" width="700"/>  </th></tr><tr>';
   
$message2.='<th>RENEWAL – CERTIFICATE REVALIDATION  </th>';
$message2.='</tr><tr>';
$message2.='<th  style="text-align: left;"><b>Dear '. $Primary_nameOnTheCard.' , </b></th></tr><tr>';
$message2.='<td><p>&nbsp;</p>

<p>We have renewed your Orchid Membership and thank you for your continuous patronage to our hotels.</p>

<p><u>Certificate Details</u></p>
As agreed, we are delighted to extend the following certificates of your choice which were originally valid till <<Expiry Date>> <br>
</td>';
$message2.='</tr></table>';
       
$message2.='</table>';

$message2.='<p>&nbsp;</p>
<table border="0" width="50%" align="center">
<tbody>
<tr>
<td>
<p><span style="font-weight: 400;">SN</span></p>
</td>
<td>
<p><span style="font-weight: 400;">Certificate Name</span></p>
</td>
<td>
<p><span style="font-weight: 400;">Certificate Number</span></p>
</td>
<td>
<p><span style="font-weight: 400;">New Validity</span></p>
</td>
</tr>
<tr>
<td> <p>&nbsp;</p></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>

<table  width="50%" align="center">
<tbody>
<tr>
<td>
<p ><span style="font-weight: 400;">This email is an official confirmation of the extension of the above certificates. These certificates cannot be revalidated further beyond the given new validity. </p>
</td>
</tr>
<tr><td><br/></td></tr>

<tr>
<td>
<p ><span style="font-weight: 400;"><u>Important</u> </p>
</td>
</tr>
<tr><td><br/></td></tr>
<tr>
<td>
<p ><span style="font-weight: 400;">Please note that the Original Certificate from your booklet must be produced at the hotel at the time of use / at the time of check-in along with a copy of this email.  This email is a confirmation of revalidation but cannot be used independently to avail of the benefit.
</p>
</td>
</tr>
<tr><td><br/></td></tr>

</tbody>
</table>

<table width="50%" align="center">
<tr><td><p ><span style="font-weight: 400;">
We look forward to welcoming you as our esteemed Orchid member at our hotels.&nbsp;</span></p></td></tr>

</table>';

$message2.='<table width="50%" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely,<br><b>
Team Orchid Gold / Platinum 
 </b><br>+91 9169166789 <br>www.orchidhotel.com</td><br>
</tr><tr><td><br/></td></tr>';
$message2.='<tr ><td colspan="4">
For any Escalations regarding your membership, please do write to us at <a href="mailto:orchidgoldpune@orchidhotel.com"><em><span style="font-weight: 400;">orchidgoldpune@orchidhotel.com</span></em></a>. <br></td></tr>';
$message2.='</table>';

$message2.='<table width="50%" align="center">
                <tr><td><img align="center" alt="" src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/img/renewal_footer.jpg" width="600" style="max-width:877px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" >
                </td>';

/*$message2.='<table width="50%" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';
*/
$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited. <br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at <a href="mailto:escalations@loyaltician.com"><em><span style="font-weight: 400;">escalations@loyaltician.com</span></em></a> 
<br><br>
Disclaimer: This message has been sent as a part of discussion between (<a href="mailto:orchidgoldpune@orchidhotel.com"><em><span style="font-weight: 400;">orchidgoldpune@orchidhotel.com</span></em></a>) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.
.</td></tr>';

$message2.='</table>';

echo $message2;
//exit;

$leadsmail2=" Orchidmembership@loyaltician.com";
$mailheader2 = "From: ".$leadsmail2."\r\n"; 
$mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

$pagesource = "revalidation";
$memid = "";
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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
    //$mail2->addAddress('satyendra1111@gmail.com'); 
 //   $mail2->mailheader=$mailheader2;// Add a recipient
    //$mail2->addCC('orchidgoldpune@orchidhotel.com');
    $mail2->addAddress('developer.ruchi@gmail.com'); 
    
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

//==============mail end==============

?>