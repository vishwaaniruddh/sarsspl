<?php
include('config.php');
// $id='1';
$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid=$row[1];


$date = strtotime($row[73]); 
$expdate=date('M Y', $date);

?>
<meta charset="utf-8">
<?
 $EmailSubject2="Welcome to Orchid Gold";
        $message2.='<table width="70%" align="center">';
           $message2.='<tr>';
           $message2.='<th><img src="http://loyaltician.in/application/gold_logo.png" alt="gold_logo.png" />  </th></tr><tr>';
        $message2.='<th><img src="http://loyaltician.in/application/GOLD.png" alt="GOLD.png" />    </th>';
        $message2.='</tr><tr>';
        $message2.='<th  style="text-align: left;"><b>Dear '. $Primary_nameOnTheCard.' , </b><br></th></tr><tr><td>&nbsp;</td></tr><tr>';
         $message2.='<td>Welcome to Orchid Gold and to a host of benefits and privileges that are now yours to enjoy on dining and accommodation at The Orchid Hotel Pune, The Orchid Hotel Mumbai Vile Parle, Fort JadhavGADH Pune, Mahodadhi Palace Puri, Lotus Eco Resort Konark and Lotus Beach Resort Goa with more hotels being added soon.<br><br>
         We have renewed your membership and thank you for your continuous patronage.<br><br>
         Your Membership Card number is '.$memid.'. The membership is valid till '.$expdate.'<br><br>
         The annual membership charge of Rs. 10,000 + 18% Goods & Services Tax amounting to Rs. 11,800/&#8722; (Rupees Eleven Thousand Eight Hundred only) has been received by '.$row[48].'<br><br>
        You can present your membership number or a copy of this email to start using your membership benefits.<br></br><br>
        The complete welcome package will reach you within 10 working days of this e&#8722;mail. Your membership gift certificates along with the membership are given at the bottom of this email.<br><br>
         We look forward to welcoming you as our esteemed Orchid Gold member.<br></br>
         </td>';
       
       
        $message2.='</tr></table>';
       
         
$message2.='</table>';


$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><br><b>Team Orchid Gold / Platinum </b><br><br><br>+91 9169166789 <br><br>www.orchidhotel.com</td>

</tr>';
$message2.='</table><br>';
        
        $message2.='<table border="1" width="50%" align="center">';
        $message2.='<tr>';
        $message2.='<th colspan="3">Gift Certificates issued &#8722; Orchid Gold</th>';
        $message2.='</tr><tr>';
        $message2.='<th>SN</th><th>Type</th><th>Certificate Number</th>';  
       
       

$srno=1;

//$qry="select Leval_id,level_name from Level where Leval_id='3' ";
$did=2;
  $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."'";
//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

  	     $remaining1=substr($sql2fetch['serialNumber'],8);
  	        // $value= $sql5fetch['AssignBooklet']+1;
  	        $value=$row[64];
  	         $AssignBooklet1=$value.$remaining1;


$message2.='
<tr height="5px">
<td>'.$srno.'</td>
<td>'. $sql2fetch['serviceName'].'</td>
<td>'. $AssignBooklet1.'</td>
</tr>
';
    
    $srno++;
} 

$message2.='</table>';

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


$leadsmail2=" Orchidmembership@loyaltician.com";
$mailheader2 = "From: ".$leadsmail2."\r\n"; 
$mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 

// require 'phpmail/src/PHPMailer.php';
// require 'phpmail/src/SMTP.php';

// $mail2 = new PHPMailer\PHPMailer\PHPMailer();

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
//   $mail2->addAddress('vishwaaniruddh@gmail.com'); 
  
         $mail2->addAddress('orchidgoldpune@orchidhotel.com'); 
    $mail2->addCC('vishwaaniruddh@gmail.com');
    // $mail2->addCC('satyendra1111@gmail.com');
    // $mail2->addCC('hitesh.gunwani@outlook.com');


    // $mail2->addAddress('satyendra1111@gmail.com'); 
    // $mail2->addCC('vishwaaniruddh@gmail.com'); 
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