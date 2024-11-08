<?php
include('config.php');
// $id='1';

$host = 'mail.clubfourpoints.com';
$hostusername = 'contactus@clubfourpoints.com';
$hostpassword = 'QKAc&mn,[xY%';
$port = '587';
$nodes = 'https://arpeeindustries.com/mail.php';

// $leadsmail2=" contactus@clubfourpoints.com";
// $leadsmail = $leadsmail2 ; 

$from = 'contactus@clubfourpoints.com';
$fromname = 'Club Four Points' ; 


$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid=$row[1];
$level=$row[39];


$array  = array_map('intval', str_split($memid));
$member_type = $array[1];


if($member_type == 1){
    $member_plan = 'Orchid First';
}
else if($member_type == 2){
    $member_plan = 'Orchid Gold';
}
else if($member_type == 3){
    $member_plan = 'Orchid Platinum';
}


$qgenx= mysqli_query($conn,"select Title,FirstName,LastName from Leads_table where Lead_id='".$id."'");
$rowx=mysqli_fetch_row($qgenx);
$name=$rowx[0].' '.$rowx[2];

$qgen1= mysqli_query($conn,"select * from Extension_history where member_id='".$id."' and extention_type='EX' order by id desc");


$row1=mysqli_fetch_row($qgen1);

$mem_sql = mysqli_query($conn,"select * from Members where Static_LeadID='".$id."'");
$mem_sql_result = mysqli_fetch_assoc($mem_sql);

$expiry = $mem_sql_result['ExpiryDate']; 
$date = strtotime($expiry); 
$expdate=date('M Y', $date);



$old_booklet = $row1[2];
$exp = $row1[4]; //echo $exp;
$date = strtotime($exp); 
$exp1=date('M Y', $date); 
 
$ext = $row1[5];
$date = strtotime($ext); 
$ext1=date('M Y', $date);

 $EmailSubject2="Membership Extension";
        $message2.='<table width="70%" align="center">';
           $message2.='<tr>';
           $message2.='<th><img src="http://loyaltician.in/application/gold_logo.png" alt="gold_logo.png" width="100%" />  </th></tr><tr><td>&nbsp;</td></tr><tr>';
        $message2.='<th><br>MEMBERSHIP EXTENSION</th>';
        $message2.='</tr><tr>';
        $message2.='<th  style="text-align: left;"><br><b>'. $Primary_nameOnTheCard.'  </b><br><b>Membership Number &#8722; '.$memid.'</b><br><b>Membership Validity &#8722; '.$exp1.'</b><br></th></tr><tr><td>&nbsp;</td></tr><tr>';
        $message2.='<th  style="text-align: left;"><br><b>Dear '. $Primary_nameOnTheCard.' , </b><br></th></tr><tr><td>&nbsp;</td></tr><tr>';
         $message2.='<td><b>Thank you for choosing the Orchid Membership of Kamat Hotels.</b><br><br>
         As our collective battle continues towards fighting the Covid&#8722;19 pandemic and as we open our hotels back to welcome you, we realize the loss of membership time since you enrolled and that you may still be a few weeks/ months away from being able to use all of your membership benefits.<br><br>
         We thank you for being with us and as a small gesture from our side, we are extending your '.$member_plan.' membership by an <b>additional validity.  Your new membership validity will be '.$expdate.'.</b>
<br><br>At Kamat Hotels, we have a passion for service excellence, and we look forward to welcoming you to our hotels with our new safety and hygiene measures.
<br><br>
         </td>';
       
       
        $message2.='</tr></table>';
       
/*
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
  	     $sqlx="SELECT serviceName FROM `voucher_Type` where level_id='".$row[39]."' and SN='".$remaining1."'";
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

$message2.='</table><br><br>';*/

$message2.='<table width="70%" align="center">';
$message2.='<tr height="5px">
<td><br>
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
        $leadsmail2=" contactus@clubfourpoints.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
 $subject = $EmailSubject2;
$message = $message2 ; 
$to = [$Primary_Gmail_1];
$cc = ['khannakaran9317@gmail.com','hitesh.gunwani@outlook.com'];
$bcc = ['khannakaran9317@gmail.com','vishwaaniruddh@gmail.com'];



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

//     //Server settings
//     //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail2->isSMTP();                                      // Set mailer to use SMTP
//     $mail2->Host = 'mail.clubfourpoints.com';  // Specify main and backup SMTP servers
//     $mail2->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail2->Username = 'contactus@clubfourpoints.com';                 // SMTP username
//     $mail2->Password = 'QKAc&mn,[xY%';                           // SMTP password
//     $mail2->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//     $mail2->Port = 587;                                    // TCP port to connect to

//     //Recipients
//     $mail2->setFrom('contactus@clubfourpoints.com','The Club Four Ponits');
//   //  $mail2->addAddress($Primary_Gmail_1); 
// //   $mail2->addAddress('vishwaaniruddh@gmail.com'); 
   
//     //   $mail2->addAddress('contactus@clubfourpoints.com'); 
//     $mail2->addBCC('vishwaaniruddh@gmail.com');
//         $mail2->addBCC('khannakaran9317@gmail.com');
//     // $mail2->addCC('hitesh.gunwani@outlook.com');



//   // $mail2->addCC('meanand.gupta21@gmail.com'); 
   
   
//   //  $mail2->mailheader=$mailheader2;// Add a recipient
//   //  $mail2->addCC('orchidgoldpune@orchidhotel.com');
//  //   $mail2->addBCC('kvaljani@gmail.com ');
//  //    $mail2->addCC('hitesh.gunwani@outlook.com');
//  //    $mail2->addBCC('meanand.gupta21@gmai.com');
    
//     $mail2->isHTML(true);                                  // Set email format to HTML
//     $mail2->Subject = $EmailSubject2."\r\n";
//     $mail2->Body    = $message2;
//     $mail2->send();
?>