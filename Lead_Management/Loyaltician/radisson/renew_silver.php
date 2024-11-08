<?php include('config.php');
// $id='76730';
$id = $Static_LeadID ;
$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];
$memid=$row[1];


$date = strtotime($row[73]); 
$expdate=date('M Y', $date);

$host = 'mail.clubfourpoints.com';
$hostusername = 'contactus@clubfourpoints.com';
$hostpassword = 'QKAc&mn,[xY%';
$port = '587';
$nodes = 'https://arpeeindustries.com/mail.php';

?>
<meta charset="utf-8">
<?
 $EmailSubject2="Welcome to Club Four Points";
 
 
 
 
 $message2 ='
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" >
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Club Four Points"></span>
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
</table>';


 
 $message2.='<table width="50%" align="center">';
 $message2.='<tr>';

 $message2.='<th  style="text-align: left;"><br><b>Dear '. $Primary_nameOnTheCard.' , </b><br></th></tr><tr><td>&nbsp;</td></tr><tr>';
 $message2.='<td>Welcome to Club Four Points.<br><br>
             <h3>Your membership is renewed.</h3><br>
                    We thank you for your decision to renew your membership at Four Points by Sheraton Navi Mumbai, Vashi. Your
                    membership details are as follows:<br><br>
         Membership Level- .<br>
         Your Membership Card number is '.$memid.'.<br>
         The membership is valid till '.$expdate.'<br><br>

        The annual membership charge of Rs. 10000 + 18% Goods &amp; Services Tax amounting to Rs. 11800 /- (Rupees Eleven Thousand
         Eight Hundred only) has been received by &lt;&lt;PaymentMode&gt;&gt;. A receipt is enclosed in this email.
        
        <br><br>
        You can present your membership number and a copy of this email to start using your membership benefits.
        <br><br>
        
        The complete welcome package will reach you within 10 working days of this e-mail. Your membership gift
        certificates along with the membership are given at the bottom of this email.
        <br><br>
        
        Do take a moment to view all benefits and terms at <a href="www.clubfourpoints.com">www.clubfourpoints.com</a>
        <br><br>
         </td>';
       
       
 $message2.='</tr></table>';
 
 $message2.='</table>';
 $message2.='<table width="50%" align="center">';
 $message2.='<tr height="5px"><td><br>Yours sincerely<br><br>
            <b>Team Club Four Points </b><br>
            +91 22 6158 6677 <br>
            <a href="www.clubfourpoints.com">www.clubfourpoints.com</a></td></tr>';
 $message2.='</table><br>';
 $message2.='<table border="1" width="50%" align="center">';
 $message2.='<tr>';
 $message2.='<th colspan="3">Gift Certificates issued </th>';
 $message2.='</tr><tr>';
 $message2.='<th>SN</th><th>Type</th><th>Certificate Number</th>';  
 
 
 $srno=1;
 $did=1;
 $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."' order by serialNumber asc";
 $runsql2=mysqli_query($conn,$sql2);
 
 while($sql2fetch=mysqli_fetch_array($runsql2)){
    $remaining1=substr($sql2fetch['serialNumber'],8);
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


$message2.='<table width="50%" align="center">';
$message2.='<tr ><td colspan="4"><br><em>The membership program is operated by Loyaltician CRM India Private Limited for Chalet Hotels Limited.<br><br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
<a href="mailto:contactus@clubfourpoints.com">contactus@clubfourpoints.com</a> <br><br>
Disclaimer: This message has been sent as a part of discussion between ‘Club Four Points’ and the addressee
whose name is specified above. Should you receive this message by mistake, we would be most grateful if you
informed us that the message has been sent to you. In this case, we also ask that you delete this message from
your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and
understanding.</em></td></tr>';
$message2.='</table>';

// echo $message2 ; 





$leadsmail2=" Orchidmembership@loyaltician.com";
$mailheader2 = "From: ".$leadsmail2."\r\n"; 
$mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 

// $leadsmail2=" contactus@clubfourpoints.com";
$leadsmail = $leadsmail2 ; 
$subject = $EmailSubject2;
$message = $message2 ;

$to =['vishwaaniruddh@gmail.com'];
$cc = [];
$bcc= [];
$from = 'contactus@clubfourpoints.com';
$fromname = 'Club Four Points' ; 

// $cc = ['khannakaran9317@gmail.com','hitesh.gunwani@outlook.com'];
// $bcc = ['khannakaran9317@gmail.com','vishwaaniruddh@gmail.com'];

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
?>