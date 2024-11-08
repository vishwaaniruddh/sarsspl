<?php session_start();?>
<html>
 <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
     <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
 </head>
<body>
<?php 
    include('config.php');
    $Membership_Level=$_POST['Membership_Level'];   
    $editor=$_POST['editor']; 
    $Subject=$_POST['Subject'];
     $Primary_bannerpath=$_POST['Primary_bannerpath'];
/*  // part 1. Primary_PhotoUpload
 $Primary_banner=$_FILES['Primary_PhotoUpload']['name']; 
 $Primary_expbanner=explode('.',$Primary_banner);
 $Primary_bannerexptype=$Primary_expbanner[1];
 date_default_timezone_set('Australia/Melbourne');
 $Primary_date = date('m/d/Yh:i:sa', time());
 $Primary_rand=rand(10000,99999);
 $Primary_encname=$Primary_date.$Primary_rand;
 $Primary_bannername=md5($Primary_encname).'.'.$Primary_bannerexptype;
 $Primary_bannerpath="upload/NewsLetter/".$Primary_bannername;
 move_uploaded_file($_FILES["Primary_PhotoUpload"]["tmp_name"],$Primary_bannerpath);*/
 /////////////////////////////////////////////////////////////////////////////////////////////  

require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';
      
      //////////////////////////// For Pincode \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
      
      if($Membership_Level=="Geographycal"){
           $GeoPincode=$_POST['GeoPincode']; 
           
             $qrys1=mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members where Primary_Pincode ='".$GeoPincode."'");
      while($fetchMem=mysqli_fetch_array($qrys1)){ 
 	          
 	          $qrys2=mysqli_query($conn,"select EmailId from Leads_table where Lead_id='".$fetchMem['Static_LeadID']."'");
              $fetchMem2=mysqli_fetch_array($qrys2);
 	         
 	         
 	          //===========for mail Welcome Latter First Orchid Member===============

          $EmailSubject2=$Subject;
          $message2='';
          
          $message2.='<html><head><meta charset="UTF-8"></head><body>';
          $message2.='<table width="600px" align="center">';
          $message2.='<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p><a target="_blank"><span style="text-decoration:none">
        <img border="0" width="" height="67" style="width:1.3541in;height:.6944in" src="http://loyaltician.in/application/assets/left_top.png" alt="The Orchid Gold">
        </span>
        </a>
        <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right"><a target="_blank" >
<span style="text-decoration:none"><img border="0" width="" height="67" style="width:1.3541in;height:.6944in"  src="http://loyaltician.in/application/assets/right_top.png" alt="The Orchid Platinum" class="CToWUd"></span></a><u></u><u></u></p>
</td>
</tr>';

$message2.='<tr><th style="text-align: left;"><b>Dear '. $fetchMem['Primary_nameOnTheCard'].',</b></th></tr></br></br></tr></table>';

   


$message2.= '<div align="center">
<table border="0" cellspacing="0" cellpadding="0" style="
    width: 600px;
">
<tbody>
<tr>
<td style="padding:30.0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="" style="">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center"><span style="font-size:15.0pt">
</span></p><p>
'.$editor.'
</p>

<p></p>
</td>
</tr>
</tbody>
</table>
</div>


</td>
</tr>
</tbody>
</table>
</div>';



$message2.= '<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:30.0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center"><span style="font-size:15.0pt">
    <a href="https://www.orchidhotel.com/the-orchid-boutique-ecotel-resort/">
    <img border="0" width="250" height="250" style="width:2.6041in;height:2.6041in"  src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/'.$Primary_bannerpath.'" alt="Magical Monsoon" >
    </a>
    </span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>


</td>
</tr>
</tbody>
</table>
</div>';
          
$message2.='<table width="600px" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid '.$level.' </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';




$message2.='<table width="600px" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="600px" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" style="width: 100%;" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" style="width: 100%;" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" style="width: 100%;" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" style="width: 100%;" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table></body></html>';
          
          
                    ?>
          <script>
                  $('p').each(function() {
    var $p = $(this),
        txt = $p.html();
    if (txt=='&nbsp;') {
        $p.remove();   
    }
});

          </script>
          <?
          $leadsmail2=" Orchidmembership@loyaltician.com";
          $mailheader2 = "From: ".$leadsmail2."\r\n"; 
          $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
    $mail2->addBCC('vishwaaniruddh@gmail.com'); 
    // $mail2->mailheader=$mailheader2;// Add a recipient
        $mail2->addAddress($fetchMem2['EmailId']); 
    //$mail2->addCC('orchidgoldpune@orchidhotel.com');
    //   $mail2->addBCC('kvaljani@gmail.com ');
    $mail2->addCC('hitesh.gunwani@outlook.com');
   // $mail2->addCC($fetchMem2['EmailId']);
    
        // $mail2->addAttachment($Primary_bannerpath);
        
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
//==============mail end===
 	         
 	         
 	             
 	         
          }
          
      }
      
    ////////////////// For Male and Female\\\\\\\\\\\\\\\\\\\\\\\\\\\\   
      if($Membership_Level=="Male" || $Membership_Level=="Female" ){
          
      }
      
      
//////////////////////////////////////// For All , Orchid First  ,Orchid Gold   ,Orchid Platinium///////////////////////       
      if($Membership_Level=="All" || $Membership_Level=="1" || $Membership_Level=="2" || $Membership_Level=="3" ){
          
          if($Membership_Level=="All"){
              $qrys1=mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members where MembershipDetails_Level IN (1,2,3)");
 	      }else{
                $qrys1=mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members where MembershipDetails_Level='".$Membership_Level."' ");
 	      }
 	      
             while($fetchMem=mysqli_fetch_array($qrys1)){ 
 	          
 	          $qrys2=mysqli_query($conn,"select EmailId from Leads_table where Lead_id='".$fetchMem['Static_LeadID']."'");
              $fetchMem2=mysqli_fetch_array($qrys2);
 	         
 	         
 	          //===========for mail Welcome Latter First Orchid Member===============

          $EmailSubject2=$Subject;
        $message2='';
          $message2.='<html><head><meta charset="UTF-8"></head><body>';
          $message2.='<table width="600px" align="center">';
          $message2.='<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p><a target="_blank"><span style="text-decoration:none">
        <img border="0" width="" height="67" style="width:1.3541in;height:.6944in" src="http://loyaltician.in/application/assets/left_top.png" alt="The Orchid Gold">
        </span>
        </a>
        <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right"><a target="_blank" >
<span style="text-decoration:none"><img border="0" width="" height="67" style="width:1.3541in;height:.6944in"  src="http://loyaltician.in/application/assets/right_top.png" alt="The Orchid Platinum" class="CToWUd"></span></a><u></u><u></u></p>
</td>
</tr><tr><td><br></td></tr>';

$message2.='<tr><th style="text-align: left;"><b>Dear '. $fetchMem['Primary_nameOnTheCard'].',</b></th></tr></br></br></tr></table>';

   


$message2.= '<div align="center">
<table border="0" cellspacing="0" cellpadding="0" style="
    width: 600px;
">
<tbody>
<tr>
<td style="padding:0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="" style="">
<tbody>
<tr>
<td style="padding:">
<p align="center" style="text-align:center"><span style="font-size:15.0pt">
</span></p><p>
'.$editor.'
</p>

<p></p>
</td>
</tr>
</tbody>
</table>
</div>


</td>
</tr>
</tbody>
</table>
</div>';



$message2.= '<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:15.0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center"><span style="font-size:15.0pt">
    <a href="https://www.orchidhotel.com/the-orchid-boutique-ecotel-resort/">
    <img border="0" width="250" height="250" style="width:2.6041in;height:2.6041in"  src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/'.$Primary_bannerpath.'" alt="Magical Monsoon" >
    </a>
    </span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>


</td>
</tr>
</tbody>
</table>
</div>';
          
$message2.='<table width="600px" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid '.$level.' </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';




$message2.='<table width="600px" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="600px" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" style="width: 100%;" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" style="width: 100%;" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" style="width: 100%;" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" style="width: 100%;" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table></body></html>';

                    ?>
          <script>
                  $('p').each(function() {
    var $p = $(this),
        txt = $p.html();
    if (txt=='&nbsp;') {
        $p.remove();   
    }
});

          </script>
          <?
          
          
          $leadsmail2=" Orchidmembership@loyaltician.com";
          $mailheader2 = "From: ".$leadsmail2."\r\n"; 
          $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
    $mail2->addBCC('vishwaaniruddh@gmail.com'); 
    $mail2->addAddress($fetchMem2['EmailId']); 
    // $mail2->mailheader=$mailheader2;// Add a recipient
    //$mail2->addCC('orchidgoldpune@orchidhotel.com');
    // $mail2->addBCC('kvaljani@gmail.com ');
    $mail2->addCC('hitesh.gunwani@outlook.com');
   // $mail2->addCC($fetchMem2['EmailId']);
        // $mail2->addAttachment($Primary_bannerpath);
    
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
//==============mail end===
 	         
 	         
 	             
 	         
          }
          
         
          
      }
      
      
      
      
      
/////////////////////////////////////// For  Individual /////////////////////////////////////      
      if($Membership_Level=="Individual"){
       
      $drop=$_POST['drop'];
$exp=explode(",",$drop);
for($kk=0;$kk<count($exp);$kk++){
 //   echo $exp[$i];


//$Voucher=$_POST['Voucher'];
$Member=$exp[$kk];
$getLevel= substr($Member, 1, 1);
   
   if($getLevel=='1'){$level="First";}else if($getLevel=='2'){$level="Gold";}else if($getLevel=='3'){$level="Platinum";}
  
 	$qrys1=mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members where GenerateMember_Id='".$Member."'");
 	$fetchMem=mysqli_fetch_array($qrys1);
 	
 	$qrys2=mysqli_query($conn,"select EmailId from Leads_table where Lead_id='".$fetchMem['Static_LeadID']."'");
 	$fetchMem2=mysqli_fetch_array($qrys2);

    //===========for mail Welcome Latter First Orchid Member===============

          $EmailSubject2=$Subject;
                    $message2='';
          $message2.='<html><head><meta charset="UTF-8"></head><body>';
          $message2.='<table width="600px" align="center">';
          $message2.='<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p><a target="_blank"><span style="text-decoration:none">
        <img border="0" width="" height="67" style="width:1.3541in;height:.6944in" src="http://loyaltician.in/application/assets/left_top.png" alt="The Orchid Gold">
        </span>
        </a>
        <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right"><a target="_blank" >
<span style="text-decoration:none"><img border="0" width="" height="67" style="width:1.3541in;height:.6944in"  src="http://loyaltician.in/application/assets/right_top.png" alt="The Orchid Platinum" class="CToWUd"></span></a><u></u><u></u></p>
</td>
</tr><tr><td><br></td></tr>';

$message2.='<tr><th style="text-align: left;"><b>Dear '. $fetchMem['Primary_nameOnTheCard'].',</b></th></tr></br></br></tr></table>';

   


$message2.= '<div align="center">
<table border="0" cellspacing="0" cellpadding="0" style="
    width: 600px;
">
<tbody>
<tr>
<td style="padding:0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="" style="">
<tbody>
<tr>
<td style="padding:">
<p align="center" style="text-align:center"><span style="font-size:15.0pt">
</span></p><p>
'.$editor.'
</p>

<p></p>
</td>
</tr>
</tbody>
</table>
</div>


</td>
</tr>
</tbody>
</table>
</div>';



$message2.= '<div align="center">
<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="padding:15.0pt 0cm 0cm 0cm">
<div align="center">
<table border="0" cellspacing="0" cellpadding="0" width="300" style="width:225.0pt">
<tbody>
<tr>
<td style="padding:7.5pt 7.5pt 7.5pt 7.5pt">
<p align="center" style="text-align:center"><span style="font-size:15.0pt">
    <a href="https://www.orchidhotel.com/the-orchid-boutique-ecotel-resort/">
    <img border="0" width="250" height="250" style="width:2.6041in;height:2.6041in"  src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/'.$Primary_bannerpath.'" alt="Magical Monsoon" >
    </a>
    </span><u></u><u></u></p>
</td>
</tr>
</tbody>
</table>
</div>


</td>
</tr>
</tbody>
</table>
</div>';
          
$message2.='<table width="600px" align="center">';
$message2.='<tr height="5px">
<td><br>Yours sincerely<br><b>Team Orchid '.$level.' </b><br>+91 9169166789 (IVRS)</td>

</tr>';
$message2.='</table>';




$message2.='<table width="600px" align="center">';
$message2.='<tr ><td><br>For any Escalations regarding your membership, please do write to us at orchidgoldpune@orchidhotel.com</td></tr>';
$message2.='</table>';


$message2.='<table width="600px" align="center">';
$message2.='<tr ><td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/orchid1.png" style="width: 100%;" alt="gold_logo.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/jadhav1.png" style="width: 100%;" alt="jadhav1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/mahodadhi1.png" style="width: 100%;" alt="mahodadhi1.png" /> </td>';
$message2.='<td><img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/lotus1.png" style="width: 100%;" alt="lotus1.png" /> </td></tr>';



$message2.='<tr ><td colspan="4">The membership program is operated by Loyaltician CRM India Private Limited for Kamat Hotels India Limited.<br>
This message is sent to you because your email address is on our subscribers list as a Member with an express
consent to communicate with you. We will ensure only high quality / relevant information is sent to you to
manage your membership. If you wish to change any communication preferences, please write to us at
escalations@loyaltician.com <br><br>
Disclaimer: This message has been sent as a part of discussion between (orchidgoldpune@orchidhotel.com)
and the addressee whose name is specified above. Should you receive this message by mistake, we would be
most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete
this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your
cooperation and understanding.</td></tr>';

$message2.='</table></body></html>';


// echo $message2 ; 

          ?>
          <script>
                  $('p').each(function() {
    var $p = $(this),
        txt = $p.html();
    if (txt=='&nbsp;') {
        $p.remove();   
    }
});

          </script>
          <?
          
          
          $leadsmail2=" Orchidmembership@loyaltician.com";
          $mailheader2 = "From: ".$leadsmail2."\r\n"; 
          $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 
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

    //Recipients
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Hotel Pune');
    $mail2->addAddress($fetchMem2['EmailId']); 
    // $mail2->mailheader=$mailheader2;// Add a recipient
    $mail2->addBCC('vishwaaniruddh@gmail.com');
    //   $mail2->addBCC('kvaljani@gmail.com ');
    $mail2->addCC('hitesh.gunwani@outlook.com');
   // $mail2->addCC($fetchMem2['EmailId']);
    // $mail2->addAttachment($Primary_bannerpath);
    
    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    $mail2->send();
//==============mail end===
} 
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////    


    ?>
    <script> 



 swal({
  title: "Success!",
  text: "Mail Send Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
});
      window.location.href = "Newsletter.php";
// .then((willDelete) => {
//   if (willDelete) {
//     // window.open("Newsletter.php","_self");
//       window.location.href = "Newsletter.php";
    
//   } 
// });
     
</script>
    