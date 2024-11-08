<?php include('config.php');

return; 
require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';

$sql = mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members limit 200,300");

while($sql_result = mysqli_fetch_assoc($sql)){
    $lead_id = $sql_result['Static_LeadID'];
    $member_name = $sql_result['Primary_nameOnTheCard'];
    
    $lead_sql = mysqli_query($conn,"select EmailId from Leads_table where Lead_id = '".$lead_id."'");
    
    $lead_sql_result = mysqli_fetch_assoc($lead_sql);
        
    $emailid = $lead_sql_result['EmailId'];
    

 $EmailSubject2="What's new at Kamat Group of Hotels";

$message2 ='';
$message2 .= '<div>


<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    <a href="https://nam10.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.orchidhotel.com%2Forchid-membership%2Forchid-membership-programs.html&amp;data=02%7C01%7C%7C3ccc1932f7e8469aee6108d853e3cff1%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637351586902853964&amp;sdata=bbfos0J4cJ095waThe0ALiclkIljKcBwYpYJO1mN5bk%3D&amp;reserved=0" target="_blank">
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="https://www.tlcgroup.com/tlc/orchid/logo.png" alt="The Orchid Gold"></span></a>

    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">
<a href="https://nam10.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.orchidhotel.com%2Forchid-membership%2Forchid-membership-programs.html&amp;data=02%7C01%7C%7C3ccc1932f7e8469aee6108d853e3cff1%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637351586902863962&amp;sdata=f86QN6gt1EhlHocyOEcyPEpJA%2FLlf1o2Grez%2FgKGmdM%3D&amp;reserved=0" target="_blank">
  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="https://www.tlcgroup.com/tlc/orchid/logo_1.png" alt="The Orchid Platinum">
  </span>
</a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify">
<strong><span style="font-family:&quot;Arial&quot;,sans-serif">Dear '.$member_name.',</span></strong><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify">
<span style="font-family:&quot;Arial&quot;,sans-serif">Greetings from Orchid Gold!</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%"><span class="im">
<p style="text-align:justify"><span style="font-family:&quot;Arial&quot;,sans-serif">The Orchid Hotels welcomes you back with a commitment towards your safety and an array of exclusive benefits.<u></u><u></u></span></p>
</span><p style="text-align:justify"><span style="font-family:&quot;Arial&quot;,sans-serif;">We are pleased to announce a special discount of
<b>15%</b> for our members on all these packages.</span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:30.0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center">
<span style="font-size:15.0pt"><img border="0" width="250" style="width:2.6041in" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/img-1.jpg" alt="Magical Monsoon"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="350" style="width:262.5pt">
<tbody>
<tr>
<td width="350" style="width:262.5pt;padding:0cm 0cm 0cm 0cm">
<h2 align="center" style="text-align:center;max-width:100%"><span style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:#852c84">Magical Monsoon</span><u></u><u></u></h2>
<p style="margin-bottom:0cm;text-align:justify;line-height:18.75pt"><span style="font-family:&quot;Arial&quot;,sans-serif">Let this monsoon bring out the child in you. Stay at Fort JadhavGadh an enjoy comfortable accommodation and a range of fun-filled activities. Our
 staycation packages are inclusive of stay, meals, activities and taxes.</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="350" style="width:262.5pt;padding:15.0pt 0cm 6.0pt 0cm;max-width:100%">
<p align="center" style="text-align:center">
<a href="https://loyaltician.in/application/img/Fort_Monsoon%20Package.pdf" target="_blank" >
  <span style="text-decoration:none">
    <img border="0" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/know-more.jpg" alt="Know More"></span></a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:22.5pt 0cm 22.5pt 0cm">
<p align="right" style="text-align:right">
<span style="font-family:&quot;Arial&quot;,sans-serif"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/17-08-2020/line1.png" alt="Divider"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:0cm 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="3" cellpadding="0" width="350" style="width:262.5pt">
<tbody>
<tr>
<td width="350" style="width:262.5pt;padding:0cm 7.5pt 0cm 0cm">
<h2 align="center" style="text-align:center;max-width:100%"><span style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:#852c84">Escape in Paradise</span><u></u><u></u></h2>
<p style="margin-bottom:0cm;text-align:justify;line-height:18.75pt"><span style="font-family:&quot;Arial&quot;,sans-serif">Stay at Lotus Beach Resort Konark for the perfect way to explore Konark. Enjoy well-appointed rooms, morning breakfast with a spectacular view of
 the sunrise and more.</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="350" style="width:262.5pt;padding:15.0pt 0cm 6.0pt 0cm;max-width:100%">
<p align="center" style="text-align:center">
<a href="https://loyaltician.in/application/img/Escape_in_Paradise.pdf" target="_blank"><span style="text-decoration:none"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/know-more.jpg" alt="Know More"></span></a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center">
<span style="font-size:15.0pt"><img border="0" width="250" style="width:2.6041in" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/img-2.jpg" alt="Escape in Paradise"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:22.5pt 0cm 22.5pt 0cm">
<p align="right" style="text-align:right">
<span style="font-family:&quot;Arial&quot;,sans-serif"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/17-08-2020/line2.png" alt="Divider"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:0cm 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center">
<span style="font-size:15.0pt"><img border="0" width="250" style="width:2.6041in" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/img-3.jpg" alt="Break Free Package"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="3" cellpadding="0" width="350" style="width:262.5pt">
<tbody>
<tr>
<td width="350" style="width:262.5pt;padding:0cm 0cm 0cm 0cm">
<h2 align="center" style="text-align:center;max-width:100%"><span style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:#852c84">Break Free Package</span><u></u><u></u></h2>
<p style="margin-bottom:0cm;text-align:justify;line-height:18.75pt"><span style="font-family:&quot;Arial&quot;,sans-serif">Lotus Eco Beach Resort - Murud Dapoli is offering a beach holiday with a difference. A perfect celebration getaway for the entire family, including
 your pet. Come celebrate solitude with us!</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="350" style="width:262.5pt;padding:15.0pt 0cm 6.0pt 0cm;max-width:100%">
<p align="center" style="text-align:center">
<a href="https://loyaltician.in/application/img/Break_Free_Package.pdf" target="_blank"><span style="text-decoration:none"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/know-more.jpg" alt="Know More"></span></a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:22.5pt 0cm 22.5pt 0cm">
<p align="right" style="text-align:right">
<span style="font-family:&quot;Arial&quot;,sans-serif"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/17-08-2020/line1.png" alt="Divider"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:0cm 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="3" cellpadding="0" width="350" style="width:262.5pt">
<tbody>
<tr>
<td width="350" style="width:262.5pt;padding:0cm 7.5pt 0cm 0cm">
<h2 align="center" style="text-align:center;max-width:100%"><span style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:#852c84">Kalinga Mesmerizing</span><u></u><u></u></h2>
<p style="margin-bottom:0cm;text-align:justify;line-height:18.75pt"><span style="font-family:&quot;Arial&quot;,sans-serif">Check-in at Mahodadhi Palace - A Beach View Heritage Hotel and explore Puri. Enjoy accommodation in well appointed air-conditioned rooms, a heritage
 city tour and more at a special price.</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="350" style="width:262.5pt;padding:15.0pt 0cm 6.0pt 0cm;max-width:100%">
<p align="center" style="text-align:center">
<a href="https://loyaltician.in/application/img/Kalinga_Mesmerizing.pdf" target="_blank"><span style="text-decoration:none"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/know-more.jpg" alt="Know More"></span></a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center">
<span style="font-size:15.0pt"><img border="0" width="250" style="width:2.6041in" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/img-4.jpg" alt="Kalinga Mesmerizing"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:22.5pt 0cm 22.5pt 0cm">
<p align="right" style="text-align:right">
<span style="font-family:&quot;Arial&quot;,sans-serif"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/17-08-2020/line2.png" alt="Divider"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:0cm 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center">
<span style="font-size:15.0pt"><img border="0" width="250" style="width:2.6041in" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/img-5.jpg" alt="Honeymoon Package"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="3" cellpadding="0" width="350" style="width:262.5pt">
<tbody>
<tr>
<td width="350" style="width:262.5pt;padding:0cm 0cm 0cm 0cm">
<h2 align="center" style="text-align:center;max-width:100%"><span style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:#852c84">Honeymoon Package</span><u></u><u></u></h2>
<p style="margin-bottom:0cm;text-align:justify;line-height:18.75pt"><span style="font-family:&quot;Arial&quot;,sans-serif">Choose the honeymoon package at Fort JadhavGadh and toast to an everlasting journey with your partner. Enjoy an exciting stay inclusive of a welcome
 drink, all meals and fun-filled activities.</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="350" style="width:262.5pt;padding:15.0pt 0cm 6.0pt 0cm;max-width:100%">
<p align="center" style="text-align:center">
<a href="https://loyaltician.in/application/img/Honeymoon_Package.pdf" target="_blank"><span style="text-decoration:none"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/know-more.jpg" alt="Know More"></span></a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:22.5pt 0cm 22.5pt 0cm">
<p align="right" style="text-align:right">
<span style="font-family:&quot;Arial&quot;,sans-serif"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/17-08-2020/line1.png" alt="Divider"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:0cm 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="3" cellpadding="0" width="350" style="width:262.5pt">
<tbody>
<tr>
<td width="350" style="width:262.5pt;padding:0cm 7.5pt 0cm 0cm">
<h2 align="center" style="text-align:center;max-width:100%"><span style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:#852c84">Perfect Honeymoon</span><u></u><u></u></h2>
<p style="margin-bottom:0cm;text-align:justify;line-height:18.75pt"><span style="font-family:&quot;Arial&quot;,sans-serif">Begin the perfect marriage story with the perfect honeymoon in Goa. Enjoy a stay in an Executive Room, complimentary breakfast, a romantic candlelight
 dinner and more at Lotus Eco Beach Resort Benaulim Goa.</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="350" style="width:262.5pt;padding:15.0pt 0cm 6.0pt 0cm;max-width:100%">
<p align="center" style="text-align:center">
<a href="https://loyaltician.in/application/img/Perfect_Honeymoon.pdf" target="_blank"><span style="text-decoration:none"><img border="0" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/know-more.jpg" alt="Know More"></span></a><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">


<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center">
<span style="font-size:15.0pt"><img border="0" width="250" style="width:2.6041in" src="https://www.tlcgroup.com/tlc/orchid/31-08-2020/img-6.jpg" alt="Perfect Honeymoon"></span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</div>

<div align="center">






<table width="70%" align="center"><tbody><tr height="5px">
<td><br>Yours sincerely<br><br><b>Team <span class="il">Orchid</span> Gold / Platinum </b><br><br><br>+91 9169166789 <br><br><a href="https://www.orchidhotel.com" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.orchidhotel.com&amp;source=gmail&amp;ust=1599980354361000&amp;usg=AFQjCNHtqFPcvcpUNh5LZwMXRs4JiHg9yA">www.orchidhotel.com</a></td>

</tr></tbody></table>


<table width="70%" align="center"><tbody><tr><td><br>For any Escalations regarding your membership, please do write to us at <a href="mailto:orchidgoldpune@orchidhotel.com" target="_blank">orchidgoldpune@orchidhotel.com</a></td></tr></tbody></table>







<table width="70%" align="center"><tbody><tr><td><img src="https://loyaltician.in/application/orchid1.png" width="150px" alt="gold_logo.png"> </td><td><img src="https://loyaltician.in/application/jadhav1.png" width="150px" alt="jadhav1.png"> </td><td><img src="https://loyaltician.in/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" class="CToWUd"> </td><td><img src="https://loyaltician.in/application/lotus1.png" width="150px" alt="lotus1.png" class="CToWUd"> </td></tr><tr><td colspan="4"><br>The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br><br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at <a href="mailto:escalations@loyaltician.com" target="_blank">escalations@loyaltician.com</a> <br><br>
Disclaimer: This message has been sent as a part of discussion between (<a href="mailto:orchidgoldpune@orchidhotel.com" target="_blank">orchidgoldpune@orchidhotel.<wbr>com</a>) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr></tbody></table>
</div>
<p style="margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm">
<span style="font-size:10.0pt;font-family:Roboto">&nbsp;<u></u><u></u></span></p><div></div><div class="adL">
</div></div>';







echo $message2;



// return;





 //echo $message2;      
  
  
  
  $mail2 = new PHPMailer\PHPMailer\PHPMailer();


    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'contactus@clubfourpoints.com';                 // SMTP username
    $mail2->Password = 'QKAc&mn,[xY%';                           // SMTP password
    $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                    // TCP port to connect to
    
    
    
    
    
    $leadsmail2=" Orchidmembership@loyaltician.com";
    $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
    
    
    
    
    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
    
    
    
    

      $mail2->addAddress($emailid);
      
// $mail2->addAddress('satyendra1111@gmail.com');
// $mail2->addCC('satyendra1111@gmail.com');
// $mail2->addCC('vishwaaniruddh@gmail.com');
$mail2->addCC('hitesh.gunwani@outlook.com');



  //  $mail2->mailheader=$mailheader2;// Add a recipient
  //  $mail2->addCC('orchidgoldpune@orchidhotel.com');
 //   $mail2->addBCC('kvaljani@gmail.com ');
 //    $mail2->addCC('hitesh.gunwani@outlook.com');
 //    $mail2->addBCC('meanand.gupta21@gmai.com');

    // $mail2->addAttachment("img/Fort_Monsoon Package.pdf");


    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
    
}
?>