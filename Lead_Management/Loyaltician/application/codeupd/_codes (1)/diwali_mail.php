<?php include ('config.php');

return;
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
require_once 'phpmail/src/Exception.php';

$message2 = '';

$sql = mysqli_query($conn, "select Static_LeadID,Primary_nameOnTheCard from Members");

$count = 1;
while ($sql_result = mysqli_fetch_assoc($sql)) {
  // if($sql_result = mysqli_fetch_assoc($sql)){


  $lead_id = $sql_result['Static_LeadID'];
  $member_name = $sql_result['Primary_nameOnTheCard'];

  $lead_sql = mysqli_query($conn, "select EmailId from Leads_table where Lead_id = '" . $lead_id . "'");

  $lead_sql_result = mysqli_fetch_assoc($lead_sql);

  $emailid = $lead_sql_result['EmailId'];

  if ($emailid) {




    $EmailSubject2 = "The Orchid Boutique Ecotel Resort - Lonavala";

    $message2 = '';
    $message2 .= '<div>


<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    <a href="https://nam10.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.orchidhotel.com%2Forchid-membership%2Forchid-membership-programs.html&amp;data=02%7C01%7C%7C3ccc1932f7e8469aee6108d853e3cff1%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637351586902853964&amp;sdata=bbfos0J4cJ095waThe0ALiclkIljKcBwYpYJO1mN5bk%3D&amp;reserved=0" target="_blank">
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/application/assets/left_top.png" alt="The Orchid Gold"></span></a>

    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">
<a href="https://nam10.safelinks.protection.outlook.com/?url=https%3A%2F%2Fwww.orchidhotel.com%2Forchid-membership%2Forchid-membership-programs.html&amp;data=02%7C01%7C%7C3ccc1932f7e8469aee6108d853e3cff1%7C84df9e7fe9f640afb435aaaaaaaaaaaa%7C1%7C0%7C637351586902863962&amp;sdata=f86QN6gt1EhlHocyOEcyPEpJA%2FLlf1o2Grez%2FgKGmdM%3D&amp;reserved=0" target="_blank">
  <span style="text-decoration:none"><img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/application/assets/right_top.png" alt="The Orchid Platinum">
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
<strong><span style="font-family:&quot;Arial&quot;,sans-serif">Dear ' . $member_name . ',</span></strong><u></u><u></u></p>
</td>
</tr>

<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify">
<span style="font-family:&quot;Arial&quot;,sans-serif">Season&rsquo;s Greetings and a Happy Diwali from Kamat Hotels India Limited.</span><u></u><u></u></p>
</td>
</tr>

<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify">
<span style="font-family:&quot;Arial&quot;,sans-serif">We are delighted to introduce you to the latest addition to our hotel group - The Orchid Boutique Ecotel Resort Lonavala.</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%"><span class="im">
<p style="text-align:justify"><span style="font-family:&quot;Arial&quot;,sans-serif">As an inaugural offer, our esteemed Members can avail of a 25% discount on the food and beverage bills by presenting the membership card or buy a room night at a special rate of Rs. 5000 + taxes*. We shall keep you informed about the applicability of the remainder benefits in due course.<u></u><u></u></span></p>

<p style="text-align:justify"><span style="font-family:&quot;Arial&quot;,sans-serif">*For reservations, call +91 9169166789. Offer applicable for the first 50 member requests only.<u></u><u></u></span></p>
</span>

</td>
</tr>

<tr>
<td width="650" style="width:487.5pt;padding:15.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify"><span style="font-family:&quot;Arial&quot;,sans-serif">

    <a href="https://www.orchidhotel.com/the-orchid-boutique-ecotel-resort/">
<img border="0" width="650" src="http://loyaltician.in/application/upload/NewsLetter/00346b395b65cc7e0dadbfba980b4b4d.jpg" alt="Asias pioneering Ecotel now comes to Lonavala" style="width:6.7708in"  tabindex="0">
</a>
<div class="a6S" dir="ltr" style="opacity: 0.01; left: 752px; top: 1693.67px;"><div id=":12t" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V" data-tooltip="Download"><div class="aSK J-J5-Ji aYr"></div></div></div></span></p>
</td>
</tr>
</tbody>
</table>
</div>









<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="650" style="width:487.5pt;padding:5.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify;margin:0;">
<span style="font-family:&quot;Arial&quot;,sans-serif">Yours sincerely</span><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="650" style="width:487.5pt;padding:5.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify;margin:0;">
<strong><span style="font-family:&quot;Arial&quot;,sans-serif">Team Orchid Gold / Platinum</span></strong><u></u><u></u></p>
</td>
</tr>
<tr>
<td width="650" style="width:487.5pt;padding:5.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify;margin:0;">
<span style="font-family:&quot;Arial&quot;,sans-serif">+91 9169166789</span><u></u><u></u></p>
</td>

</tr>
<tr>
<td width="650" style="width:487.5pt;padding:5.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify;margin:0;">
<span style="font-family:&quot;Arial&quot;,sans-serif"><a href="www.orchidhotel.com">www.orchidhotel.com</a></span><u></u><u></u></p>
</td>
</tr>
<tr>

<td width="650" style="width:487.5pt;padding:5.0pt 0cm 0cm 0cm;max-width:100%">
<p style="text-align:justify;margin:0;">
<span style="font-family:&quot;Arial&quot;,sans-serif">For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com </span><u></u><u></u></p>
</td>
</tr>


</tbody>
</table>
</div>





<div align="center">
<table border="0" cellspacing="" cellpadding="0" width= "650px"; style="width:650px;">
<tbody>
<tr>
<td style="padding:.75pt .75pt .75pt .75pt">
<p class="MsoNormal"><img border="0" width="92" height="63" style="width:.9583in;height:.6597in" id="m_-7794823260853482265_x0000_i1028" src="https://loyaltician.in/application/orchid1.png" class="CToWUd"><u></u><u></u></p>
</td>
<td style="padding:.75pt .75pt .75pt .75pt">
<p class="MsoNormal"><img border="0" width="88" height="64" style="width:.9166in;height:.6666in" id="m_-7794823260853482265_x0000_i1027" src="https://loyaltician.in/application/jadhav1.png" class="CToWUd"><u></u><u></u></p>
</td>
<td style="padding:.75pt .75pt .75pt .75pt">
<p class="MsoNormal"><img border="0" width="95" height="63" style="width:.993in;height:.6597in" id="m_-7794823260853482265_x0000_i1026" src="https://loyaltician.in/application/mahodadhi1.png" class="CToWUd"><u></u><u></u></p>
</td>
<td style="padding:.75pt .75pt .75pt .75pt">
<p class="MsoNormal"><img border="0" width="105" height="61" style="width:1.0972in;height:.6388in" id="m_-7794823260853482265_x0000_i1025" src="https://loyaltician.in/application/lotus1.png" class="CToWUd"><u></u><u></u></p>
</td>
</tr>
<tr>
<td colspan="4" style="padding:.75pt .75pt .75pt .75pt">
<p class="MsoNormal"><br>
The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br>
<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change
 any communication preferences, please write to us at <a href="mailto:escalations@loyaltician.com" target="_blank">
escalations@loyaltician.com</a> <br>
<br>
Disclaimer: This message has been sent as a part of discussion between (<a href="mailto:orchidgoldpune@orchidhotel.com" target="_blank">orchidgoldpune@orchidhotel.<wbr>com</a>) and the addressee whose name is specified above. Should you receive this message by mistake,
 we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div> ';







    echo $message2;

    // echo $count . '' . $emailid ;  


    // return;





    //echo $message2;      



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





    $leadsmail2 = " Orchidmembership@loyaltician.com";
    $mailheader2 = "From: " . $leadsmail2 . "\r\n";
    $mailheader2 .= "Reply-To: " . $leadsmail2 . "\r\n";




    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com', 'The Orchid Hotel Pune');

    $mail2->addAddress($emailid);

    // $mail2->addCC('satyendra1111@gmail.com');
    $mail2->addBCC('vishwaaniruddh@gmail.com');
    $mail2->addCC('hitesh.gunwani@outlook.com');



    //  $mail2->mailheader=$mailheader2;// Add a recipient
    //  $mail2->addCC('orchidgoldpune@orchidhotel.com');
    //   $mail2->addBCC('kvaljani@gmail.com ');
    //    $mail2->addCC('hitesh.gunwani@outlook.com');
    //    $mail2->addBCC('meanand.gupta21@gmai.com');

    // $mail2->addAttachment("img/Fort_Monsoon Package.pdf");


    $mail2->isHTML(true); // Set email format to HTML
    $mail2->Subject = $EmailSubject2 . "\r\n";
    $mail2->Body = $message2;
    $mail2->send();

    //  $count++; 
    //  echo '<br>';
  }
}
?>