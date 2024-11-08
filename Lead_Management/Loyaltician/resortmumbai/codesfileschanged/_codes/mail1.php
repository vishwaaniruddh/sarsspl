<?php  session_start();
include('config.php');
$EmailSubject2="Namaskar from Vishal Kamat!";

$qrys1=mysqli_query($conn,"select Static_LeadID,Primary_nameOnTheCard from Members where MembershipDetails_Level IN (2,3)");
 
require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';

    

    exit;
    
    
    
    
while($fetchMem=mysqli_fetch_array($qrys1)){ 

    $qrys2=mysqli_query($conn,"select EmailId from Leads_table where Lead_id='".$fetchMem['Static_LeadID']."'");
    
    $fetchMem2=mysqli_fetch_array($qrys2);
    
    $to = $fetchMem2['EmailId'];
    
    //$message2.=$fetchMem2['EmailId'];

$message2='<table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                <img src="http://sarmicrosystems.in/Lead_Management/Loyaltician/application/Covid-19-Orchid.jpg" alt="gold_logo.png" width="700px" /> 
                            </td></tr></tbody></table>';
$message2.='<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer">
                                        <tbody><tr>
                                            <td valign="top" class="footerContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width:100%;">
    <tbody class="mcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding:9px" class="mcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width:100%;">
    <tbody><tr>
        <td align="center" style="padding-left:9px;padding-right:9px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnFollowContent">
                <tbody><tr>
                    <td align="center" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                                <td align="center" valign="top">
                                    <!--[if mso]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody>
                                                                        <tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="http://www.facebook.com/lotusresortmurud" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-facebook-48.png" alt="Like us on Facebook" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://twitter.com/lotusmurud" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-twitter-48.png" alt="Follow us on Twitter" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="http://www.instagram.com/lotusmurud" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-instagram-48.png" alt="Follow us on Instagram" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->
                                        
                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="">
                                                                        <tbody><tr>
                                                                            
                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent">
                                                                                    <a href="https://www.lotusresorthotels.com/lotus-beach-resort-murud-dapoli-ratnagiri/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-link-48.png" alt="Visit our Website" style="display:block;" height="24" width="24" class=""></a>
                                                                                </td>
                                                                            
                                                                            
                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                        
                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->
                                    
                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;">
    <tbody class="mcnImageBlockOuter">
            <tr>
                <td valign="top" style="padding:9px" class="mcnImageBlockInner">
                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;">
                        <tbody><tr>
                            <td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;">
                                <img align="center" alt="" src="https://gallery.mailchimp.com/de976798b8f6f381d8a2d349b/images/535bb296-7ee2-4875-8e1c-643aeb4e016a.jpg" width="564" style="max-width:877px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage">
                                
                            </td>
                        </tr>
                    </tbody></table>
                </td>
            </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;">
    <tbody class="mcnDividerBlockOuter">
        <tr>
            <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;">
                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #505050;">
                    <tbody><tr>
                        <td>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
<!--            
                <td class="mcnDividerBlockInner" style="padding: 18px;">
                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
-->
            </td>
        </tr>
    </tbody>
</table>';
    $leadsmail2=" Orchidmembership@loyaltician.com";
    $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n";
    
    $pagesource = "mail1";
$memid = $fetchMem['Static_LeadID'];
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
    $mail2->setFrom('orchidgoldpune@orchidhotel.com','The Orchid Memberships');
    
    $mail2->addAddress($to);
    
    //$mail2->mailheader=$mailheader2;// Add a recipient
    //$mail2->addCC('orchidgoldpune@orchidhotel.com');
    
    $mail2->addBCC('rahulpurandare@sarmicrosystems.in');
    
    //$mail2->addBCC('hitesh.gunwani@outlook.com');
    
    $mail2->isHTML(true);  
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    //$mail2->send();
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
}
?>