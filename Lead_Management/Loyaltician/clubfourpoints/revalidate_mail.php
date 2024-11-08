<?php include('config.php');
// $id='103';
// $id='76732';
$id = $Static_LeadID ;

$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$Primary_nameOnTheCard = $row[13];

$memid=$row[1];
$entryDate = $row[65];
$entryDate = date('d M Y',strtotime($entryDate));

// $level=$row[39];


$qgen1= mysqli_query($conn,"select * from Extension_history where member_id='".$id."' and extention_type='RV' order by id desc");
$row1=mysqli_fetch_row($qgen1);
$old_booklet = $row1[2];

$level  = array_map('intval', str_split($old_booklet));

$level = $level[1];

if($level=='2'){
   $newlevel = 1; 
}elseif($level=='4'){
   $newlevel = 2; 
}elseif($level=='1'){
    $newlevel = 6;
}

$exp = $row1[4];
$date = strtotime($exp); 
$exp1=date('M Y', $date); 

$ext = $row1[5];
$date = strtotime($ext); 

$ext1=date('M Y', $date);


$host = 'mail.clubfourpoints.com';
$hostusername = 'contactus@clubfourpoints.com';
$hostpassword = 'QKAc&mn,[xY%';
$port = '587';
$nodes = 'https://arpeeindustries.com/mail.php';




?>
<meta charset="utf-8">
<?php $EmailSubject2="Revalidation of Membership Certificates";
        
        
    $message2 ='
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

        $message2.='<tr><td  style="text-align: left;">
        <br><br>
        <h3 style="text-align:center;">REVALIDATION OF MEMBERSHIP CERTIFICATES</h3>

        <br><b>Dear '. $Primary_nameOnTheCard.' , </b><br><br>
        
        <b>Membership Number: </b> '.$memid.'      <br>
        <b>Renewal Date:</b>    '.$entryDate.' <br><br><br>
            Welcome to Club Four Points!
        
        <br></td></tr><tr><td>&nbsp;</td></tr><tr>';
        
$message2.='<td>Thank you for renewing your membership. We are pleased to extend your old unused certificates as below.<br><br>
         </td>';
         
$message2.='</tr></table>';
        
$srno=1;
if($old_booklet){
$message2.='<table border="1" width="50%" align="center" style="text-align:center;">';
        $message2.='<tr>';
        $message2.='
        <th>SN</th>
        <th>Certificate Number</th>
        <th>Benefit Detail</th>
        <th>Extended Validity</th>';
        
$sql2="SELECT Voucher_id FROM `BarcodeScan` where Voucher_id like '".$old_booklet."%' and is_extended=1";
$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

  	     $remaining1=substr($sql2fetch['Voucher_id'],8);
  	     $sqlx="SELECT serviceName FROM `voucher_Type_old` where level_id='".$newlevel."' and SN='".$remaining1."'";
  	     $runsqlx=mysqli_query($conn,$sqlx);
  	     $fetchx=mysqli_fetch_array($runsqlx);
  	        $value=$row[64];
            $voucher=$sql2fetch[0];

$message2.='
<tr height="5px">
<td>'.$srno.'</td>
<td>'. $voucher.'</td>
<td>'. $fetchx[0].'</td>
<td>'.$ext1.'</td>
</tr>
';
    
    $srno++;
} 
$message2.='</table><br><br>';    
}



$message2.='<table width="50%" align="center">';
$message2.='<tr height="5px">
<td>A copy of each of the vouchers received, is also enclosed for a quick reference. <br><br>

This letter is an official confirmation of the extension of the above vouchers. These vouchers cannot be revalidated further beyond the given new validity. <br><br>

<u>Important</u><br><br>

Please note that the Original Certificates (as enclosed) from your old booklet must be produced at the hotel at the time of use / at the time of check-in along with a copy of this email/ letter.  This letter is a confirmation of revalidation but cannot be used independently to avail of the benefit.<br><br>
We look forward to your visit to our hotel. Do call us for any queries.<br><br>
Team Club Four Points <br><br><b>+91 6758 7767 </b><br><br></td>
</tr></table>';


$message2.='<table width="50%" align="center">';
$message2.='<tr >
<td colspan="4"><br><em>
The membership program is operated by Loyaltician CRM India Private Limited for Chalet Hotels Limited.<br><br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
<a href="mailto:contactus@clubfourpoints.com">contactus@clubfourpoints.com</a> <br><br>
</em></td></tr>';
$message2.='</table>';




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
?>