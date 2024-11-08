<?php
include('config.php');
// $id='70034';
$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid=$row[1];
$membership_number = $row[1];
// $level=$row[39];

    $host = 'mail.clubfourpoints.com';
    $hostusername = 'contactus@clubfourpoints.com';
    $hostpassword = 'QKAc&mn,[xY%';
    $port = '587';
    $nodes = 'https://arpeeindustries.com/mail.php';

$qgen1= mysqli_query($conn,"select * from Extension_history where member_id='".$id."' and extention_type='RVWR' order by id desc");
$row1=mysqli_fetch_row($qgen1);
$old_booklet = $row1[2];
// $old_booklet = '21000008';

$level  = array_map('intval', str_split($old_booklet));
$level = $level[1];



$exp = $row1[4];
$date = strtotime($exp); 
$exp1=date('M Y', $date); 
 
$ext = $row1[5];
$date = strtotime($ext); 


 $ext1=date('M Y', $date);
?>
<meta charset="utf-8">
<?
 $rev_EmailSubject2="Revalidation of Membership Certificates";

        $rev_msg.='<table width="70%" align="center">
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
</tbody></table>';


        $rev_msg.='<table width="70%" align="center">';

           $rev_msg.='<tr>';
           $rev_msg.='<th><img src="http://loyaltician.in/application/hotel.png" alt="hotel.png" width="100%" />  </th></tr><tr>';
        // $rev_msg.='<th><br>CERTIFICATE REVALIDATION</th>';
        $rev_msg.='</tr><tr>';
        $rev_msg.='<th  style="text-align: left;"><br><b>Dear '. $Primary_nameOnTheCard.' , </b><br></th></tr><tr><td>&nbsp;</td></tr><tr>';
         $rev_msg.='<td>As discussed, we are renewing the following certificates as per the details given below. Do note that all terms for use of the certificate remain unchanged. <br><br>
         <p><b>Name : </b>'.$Primary_nameOnTheCard.' </p>
         <p><b>Membership No : </b> '.$membership_number.' </p>

         <p><b>Original Validity</b> : '.$exp1.'</p><br><br>

         </td>';
       
       
        $rev_msg.='</tr></table>';
       

$rev_msg.='<table border="1" width="70%" align="center">';
        $rev_msg.='<tr>';
        $rev_msg.='<th>SN</th><th>Certificate Name</th><th>Certificate Number</th><th>New Validity</th>';  
       
       

$srno=1;

  $sql2="SELECT Voucher_id FROM `BarcodeScan` where Voucher_id like '".$old_booklet."%' and is_extended=1";

	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

  	     $remaining1=substr($sql2fetch['Voucher_id'],8);
  	     $sqlx="SELECT serviceName FROM `voucher_Type` where level_id='".$level."' and SN='".$remaining1."'";
  	     $runsqlx=mysqli_query($conn,$sqlx);
  	     $fetchx=mysqli_fetch_array($runsqlx);
  	        $value=$row[64];
            $voucher=$sql2fetch[0];

$rev_msg.='
<tr height="5px">
<td>'.$srno.'</td>
<td>'. $fetchx[0].'</td>
<td>'. $voucher.'</td>
<td>'.$ext1.'</td>
</tr>
';
    
    $srno++;
} 

$rev_msg.='</table><br><br>';

$rev_msg.='<table width="70%" align="center">';
$rev_msg.='<tr height="5px">
<td>Please take a printout of this email and present the certificate in original along with a copy of this email to use the benefit during the extended period. <br><br>

We look forward to welcoming you to our hotel soon.<br><br>
Yours sincerely<br><br><b>Team Orchid Gold / Platinum </b><br><br><br><b>+91 9169166789 </b><br><br>www.orchidhotel.com</td>

</tr>';
$rev_msg.='</table><br>';
        
        
$rev_msg.='<table width="70%" align="center">';
$rev_msg.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$rev_msg.='</table><br>';


$rev_msg.='<table width="70%" align="center">';
$rev_msg.='<tr ><td><img src="http://loyaltician.in/application/orchid1.png" width="150px" alt="gold_logo.png" /> </td>';
$rev_msg.='<td><img src="http://loyaltician.in/application/jadhav1.png" width="150px" alt="jadhav1.png" /> </td>';
$rev_msg.='<td><img src="http://loyaltician.in/application/mahodadhi1.png" width="150px" alt="mahodadhi1.png" /> </td>';
$rev_msg.='<td><img src="http://loyaltician.in/application/lotus1.png" width="150px" alt="lotus1.png" /> </td></tr>';



$rev_msg.='<tr ><td colspan="4"><br>The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited<br><br>
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com) and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.</td></tr>';

$rev_msg.='</table>';

//  echo $rev_msg;      
 
 
        $leadsrev_mail2=" Orchidmembership@loyaltician.com";
        $rev_mailheader2 = "From: ".$leadsrev_mail2."\r\n"; 
    $rev_mailheader2.= "Reply-To: ".$leadsrev_mail2."\r\n"; 
 
 



$leadsmail = $leadsrev_mail2 ; 

$from = 'orchidgoldpune@orchidhotel.com';
$fromname = 'The Orchid Hotel Pune' ; 
 
$subject = $rev_EmailSubject2;
$message = $rev_msg ; 
$to = ['orchidgoldpune@orchidhotel.com'];
$cc = ['khannakaran9317@gmail.com'];
$bcc = ['khannakaran9317@gmail.com','vishwaaniruddh@gmail.com','hellbinderkumar@gmail.com'];



        $data = array(
        'subject' => $subject,
        'message' => $message,
        'leadsmail' => $leadsmail,
        'host' => $host,
        'hostusername' => $hostusername,
        'hostpassword' => $hostpassword,
        'port'=> $port ,
        'from'=>$from,
        'fromname'=>$fromname,
        'to'=>$to,
        'cc'=>$cc,
        'bcc'=>$bcc,
        );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context  = stream_context_create($options);
    $result =  file_get_contents($nodes, false, $context); 
 

// require_once 'phpmail/src/Exception.php';
// require_once 'phpmail/src/PHPMailer.php';
// require_once 'phpmail/src/SMTP.php';

// $mail2 = new PHPMailer\PHPMailer\PHPMailer();
// $rev_mail2 = new PHPMailer\PHPMailer\PHPMailer();

//     //Server settings
//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $rev_mail2->isSMTP();                                      // Set mailer to use SMTP
//     $rev_mail2->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
//     $rev_mail2->SMTPAuth = true;                               // Enable SMTP authentication
//     $rev_mail2->Username = 'contactus@clubfourpoints.com';                 // SMTP username
//     $rev_mail2->Password = 'QKAc&mn,[xY%';                           // SMTP password
//     $rev_mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $rev_mail2->Port = 587;                                    // TCP port to connect to

//     //Recipients
//     $rev_mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
//     $rev_mail2->addAddress('orchidgoldpune@orchidhotel.com'); 
//     $rev_mail2->addBCC('vishwaaniruddh@gmail.com');
//     // $rev_mail2->addCC('satyendra1111@gmail.com');
//     // $rev_mail2->addCC('hitesh.gunwani@outlook.com');


//     $rev_mail2->isHTML(true);                                  // Set email format to HTML
//     $rev_mail2->Subject = $rev_EmailSubject2."\r\n";
//     $rev_mail2->Body    = $rev_msg;
//     $rev_mail2->send();
?>