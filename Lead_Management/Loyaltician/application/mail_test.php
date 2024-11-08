<?php
$EmailSubject2 = "Welcome to Orchid Platinum!";

$message2 .= '<table width="70%" align="center">';

$message2 .= '<tr>';
$message2 .= '<th><img src="http://loyaltician.com/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';

$message2 .= '<th><img src="http://loyaltician.com/application/PLATINUM.png" alt="GOLD.png" />    </th>';
$message2 .= '</tr><tr>';
$message2 .= '<th  style="text-align: left;"><b>Dear ' . $Primary_nameOnTheCard . ' , </b></th></tr><tr></br>';
$message2 .= '<td>Welcome to Orchid Platinum and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         Your Membership Card number is ' . $fetchgen['GenerateMember_Id'] . '. The membership is valid till ' . $R . ' You may click here to view the Summary of Benefits of the membership.<br><br>
         The annual membership charge of Rs. 15,000 + 18% Goods & Services Tax amounting to Rs. 17,700/- (RupeesSeventeen Thousand Seven Hundred only) has been received by ' . $fetchgen['MembershipDts_PaymentMode'] . '<br><br>
        You can present your membership number or a copy of this email to start using your membership benefits.<br></br>
        The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift certificates along with the membership are given at the bottom of this email.<br><br>
         We look forward to welcoming you as our esteemed Orchid Platinum member.<br></br>
         </td>';
$message2 .= '</tr></table>';

$message2 .= '</table>';

$message2 .= '<table width="70%" align="center">';
$message2 .= '<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid Platinum </b><br>+91 9169166789 <br>www.orchidhotel.com</td>
</tr>';
$message2 .= '</table>';

$message2 .= '<table width="70%" align="center">';
$message2 .= '<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2 .= '</table>';


$message2 .= '<table width="70%" align="center">';
$message2 .= '<tr ><td><img src="http://loyaltician.com/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$message2 .= '<td><img src="http://loyaltician.com/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$message2 .= '<td><img src="http://loyaltician.com/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$message2 .= '<td><img src="http://loyaltician.com/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$message2 .= '<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

$message2 .= '</table>';


$leadsmail2 = " Orchidmembership@loyaltician.com";
$mailheader2 = "From: " . $leadsmail2 . "\r\n";
$mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";

require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';

$mail2 = new PHPMailer\PHPMailer\PHPMailer();

//Server settings
//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
$mail2->isSMTP();                                      // Set mailer to use SMTP
$mail2->Host = 'mail.khil.com';  // Specify main and backup SMTP servers
$mail2->SMTPAuth = true;                               // Enable SMTP authentication
$mail2->Username = 'orchidgoldpune@orchidhotel.com';                 // SMTP username
$mail2->Password = 'Orchid#2022';                           // SMTP password
$mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail2->Port = 587;                                    // TCP port to connect to

//Recipients
$mail2->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');
$mail2->addAddress('developer.ruchi@gmail.com');
//   $mail2->mailheader=$mailheader2;// Add a recipient
//    $mail2->addCC('orchidgoldpune@orchidhotel.com');
//$mail2->addBCC('rahulpurandare@sarmicrosystems.in');
//  $mail2->addCC('hitesh.gunwani@outlook.com');


$mail2->isHTML(true);                                  // Set email format to HTML
$mail2->Subject = $EmailSubject2 . "\r\n";
$mail2->Body = $message2;
$mail2->send();
//==============mail end==============

?>