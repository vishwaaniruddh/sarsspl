<?php include('config.php');

error_reporting(0);

require_once 'phpmail/src/Exception.php';
require_once 'phpmail/src/PHPMailer.php';
require_once 'phpmail/src/SMTP.php';


include('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {
    public function Header() {
    }

    public function Footer() {
    }
}













$sql = mysqli_query($conn,"select * from Members where MembershipDetails_Level=1");
while($sql_result = mysqli_fetch_assoc($sql)){
    
    $mail2 ='';
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Satyendra Sharma');
$pdf->SetTitle($Primary_nameOnTheCard);
$pdf->SetSubject('DER Report');
$pdf->SetKeywords('E-FSR, PDF');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->SetFont('times', '', 12);
$pdf->AddPage();
$pdf->SetMargins(5, 0, 10, true);
$pdf->SetFillColor(255, 255, 127);


    
    
$Primary_nameOnTheCard = $sql_result['Primary_nameOnTheCard'];
$member_id = $sql_result['GenerateMember_Id'];
$validity = $sql_result['ExpiryDate'];
$booklet_Series = $sql_result['booklet_Series'];
$Static_LeadID = $sql_result['Static_LeadID'];

$EmailSubject2="Welcome to Club Four Points !";


$message2 ='
<table width="50%" align="center">
<td>
<img style="width:100%;" id="Picture 4" src="http://loyaltician.in/clubfourpoints/newassets/image001.jpg">

</td>
</table>





<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="216">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="110" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Club Four Points"></span>
    <u></u><u></u></p>
</td>


<td width="216"></td>


<td width="216">
<p align="right" style="text-align:right">

  <span style="text-decoration:none"><img border="0" width="130" src="http://loyaltician.in/clubfourpoints/newassets/image003.png" alt="The Club Four Points">
  </span>

<u></u><u></u></p>
</td>
</tr>
</tbody>
</table>








<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal><span lang=EN-IN>Dear '.$Primary_nameOnTheCard.'</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN></span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Welcome to Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a
member at Four Points by Sheraton Navi Mumbai, Vashi. Your membership details
are as follows:</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Gold</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is '.$member_id.'. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till '.date('M Y', strtotime($validity)).' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. 9000 + 18% Goods &amp; Services
Tax amounting to Rs. 10620 /- (Rupees Ten Thousand Six Hundred and Twenty only)
has been received by '.$payment_mode.'.  A receipt is enclosed in
this email. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>You can present your membership number and a copy of this email to
start using your membership benefits.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The complete welcome package will reach you within 10 working days
of this e-mail. Your membership gift certificates along with the membership are
given at the bottom of this email.</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Do take a moment to view all benefits and terms at </span><span
lang=EN-IN><a href="http://www.clubfourpoints.com">www.clubfourpoints.com</a></span><span
lang=EN-IN> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Yours sincerely,</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">Team Club Four Points</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 9808293333</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubfourpoints.com"><span style="font-size:12.0pt;
line-height:107%">www.clubfourpoints.com</span></a></span><span lang=EN-IN
style="font-size:12.0pt;line-height:107%"> </span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>

<p class=MsoNormal align=center style="text-align:center"><span lang=EN-IN
style="font-size:12.0pt;line-height:107%">Gift Certificates issued</span></p>





<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 
 <tr style="height:14.5pt">
 
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
 
  <td width=329 nowrap valign=top style="width:247.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Description</span></b></p>
  </td>
 
  <td width=168 nowrap valign=top style="width:125.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 
 </tr>';
 
 
 
 $srno=1;
$did=1;

 $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."' and serviceName not like '%RENEWAL%'";

$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){
    
    $remaining1=substr($sql2fetch['serialNumber'],8);
    
    // if($isfirst==1){
    //     $value= $AssignBooklet+1;
    // }else{
    //     $value= $AssignBooklet;        
    // }
    
    $AssignBooklet1=$booklet_Series.$remaining1;

  	         
  	         
$message2 .= '<tr style="height:14.5pt">
  <td width=51 nowrap valign=top style="width:38.0pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'.$srno.'</span></p>
  </td>
  
  <td width=329 valign=top style="width:247.0pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'. $sql2fetch['serviceName'].'</span></p>
  </td>
  
  
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'. $AssignBooklet1.'</span></p>
  </td>
 
 </tr>';
     $srno++;
} 

$message2 .='</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician
CRM India Private Limited for Chalet Hotels Limited. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This message is sent to you because your email
address is on our subscribers list as a Member with an express consent to
communicate with you. We will ensure only high quality / relevant information
is sent to you to manage your membership. If you wish to change any
communication preferences, please write to us at </span></em><span lang=EN-IN><a
href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubfourpoints.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">Disclaimer: This
message has been sent as a part of discussion between ‘Club Four Points’ and
the addressee whose name is specified above. Should you receive this message by
mistake, we would be most grateful if you informed us that the message has been
sent to you. In this case, we also ask that you delete this message from your
mailbox, and do not forward it or any part of it to anyone else. Thank you for
your cooperation and understanding.</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
echo $message2;








    //   include('receiptgenerate.php');
       



$pdfsql = mysqli_query($conn,"select * from Members where Static_LeadID='".$Static_LeadID."'");
$pdfsql_result = mysqli_fetch_assoc($pdfsql);

$receiptNO = $pdfsql_result['receipt_no'];
$MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
$memGST = $pdfsql_result['GST_Number'];
if($memGST){

}else{
    // $memGST ='27AADCL8692D1Z8';
}









$pdfleads_sql = mysqli_query($conn,"select * from Leads_table where Lead_id='".$Static_LeadID."'");
$pdfleads_sql_result = mysqli_fetch_assoc($pdfleads_sql);


$Primary_Gmail_1 = $pdfleads_sql_result['EmailId'];

$Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
$receipt_no = $pdfsql_result['receipt_no'];
$entryDate = $pdfsql_result['entryDate'];
$entryDate =  date("d-m-Y", strtotime($entryDate));
$MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
if($MembershipDetails_Level==1){
    $level ='Gold';
}elseif($MembershipDetails_Level==2){
    $level ='Platinum';
}

$ExpiryDate = $pdfsql_result['ExpiryDate'];
$ExpiryDate =  date("d-m-Y", strtotime($ExpiryDate));
$MembershipDetails_Fee = $pdfsql_result['MembershipDetails_Fee'];
$MembershipDts_PaymentMode = $pdfsql_result['MembershipDts_PaymentMode'];

$CGST=$pdfsql_result['MembershipDts_GST']/2;
$MembershipDts_GrossTotal = $pdfsql_result['MembershipDts_GrossTotal'] ;

$MobileNumber = $pdfleads_sql_result['MobileNumber'];
$Company = $pdfleads_sql_result['Company'];
$EmailId = $pdfleads_sql_result['EmailId'];
$State = $pdfleads_sql_result['State'];
$City = $pdfleads_sql_result['City'];

$CGST=$pdfsql_result['MembershipDts_GST']/2;
	

$htmtab1='<table border="1" cellpadding="5">



                                            <tbody>

                                            <tr>
                                            <th colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <img src="Leadpdf/logoai.jpg" style="margin-left:200px;height:60px;">
                                            </th>
                                            </tr>
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> Loyaltician CRM India Private Limited- A/C Club Four Points </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Four Points by Sheraton Navi Mumbai Vashi,  contactus@clubfourpoints.com </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> GSTN ID- 27AADCL8692D1Z8      State- Maharashtra     Code -27 </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="font-size:25px;text-align:center;"> Tax Invoice cum Receipt </th>
                                            </tr>							
							
                                            
                                            
                                        <tr>
                                            <th colspan="4" style="padding:10pt; background-color: #dbe5f1; color: black; "><b>Invoice to: (Customer Details)</b></th>                                            
                                            <th colspan="2" style="background-color: #dbe5f1; color: black; "><b>Invoice Details</b></th>
                                        </tr>
    

                                        <tr>
                                            <td colspan="4"><b>Company Name :</b> '.$Company.' </td>
                                            <td border="0" colspan="1"><b>Date :</b></td>
                                            <td border="0" colspan="1">'.$entryDate.'</td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="4"><b>Name :</b> '.$Primary_nameOnTheCard.' </td>
                                            <td colspan="1"><b>Invoice / Receipt: </b></td>
                                            <td colspan="1">'.$receipt_no.'</td>
                                        </tr>
                                        <tr>
                                        
                                            <td colspan="4"><b>Phone: </b>'.$MobileNumber.'</td>
                                            <td colspan="2"><b>Membership Details</b></td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="4"><b>Email :</b> '.$EmailId.' </td>
                                            <td colspan="1"><b>Level :</b></td>
                                            <td colspan="1">'.$level.'</td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td class="" colspan="4"><b>GSTN: </b>'.$memGST.' </td>
                                           <td colspan="1"><b>Validity :</b></td>
                                            <td colspan="1">'.date('M Y',strtotime($ExpiryDate)).'</td>
                                        </tr>


                                        <tr>
                                            <td class="" colspan="3"><b>City: </b>'.$City.' </td>
                                           <td colspan="3"><b>State :</b>'.$State.'</td>
                                        </tr>




                                        <tr style="background-color: #dbe5f1; color: black; ">
                                            <td class="" colspan="3"><b>Description</b></td>
                                           <td colspan="1"><b>Quantity :</b></td>
                                            <td colspan="1"><b>Unit Price</b></td>
                                            <td colspan="1"><b>Amount</b></td>
                                        </tr>



                                    <tr>
                                            <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">'.$level.' Membership: </td>
                                           <td colspan="1">1</td>
                                            <td colspan="1">'.$MembershipDetails_Fee.'</td>
                                            <td colspan="1">'.$MembershipDetails_Fee.'</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">'.$MembershipDetails_Fee.'</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Received by : '.$MembershipDts_PaymentMode.'</td>';
                                            
                                             if($State=="MAHARASHTRA"){
                                            
                                                    $htmtab1 .='<td colspan="2" style="background-color: #daeef3; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #daeef3; color: black; ">'.$CGST.'</td>';
                                            
                                            }else{
                                                $htmtab1 .='<td colspan="2"rowspan="2" style="background-color: #daeef3; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #daeef3; color: black; ">'.($CGST*2).'</td>';
                                            } 
                                            
                                            
                                        $htmtab1 .='</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Instrument Number/ Approval Code</td>';
                                            
                                            if($State=="MAHARASHTRA"){
                                            $htmtab1 .='<td colspan="2" style="background-color: #daeef3; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">'.$CGST.'</td>';
                                                                                         }else{
                                                                                             

                                                                                         }

                                            
                                        $htmtab1 .='</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  Loyaltician CRM India Private Limited- A/C Club Four Points</b></td>
                                           <td colspan="2" style="background-color: #dbe5f1; color: black; "><b>Total including Taxes </b></td>
                                            <td colspan="1" style="background-color: #dbe5f1; color: black; "><b>'.$MembershipDts_GrossTotal.'</b></td>
                                        </tr>
                                        
                                       <tr>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">Terms and Conditions<br>
1. To avail input credit (if available), GSTN number and State is mandatory.<br>
2. This is the final invoice regarding the purchase.<br>
3. No refunds are entertained beyond 15 days of purchase<br>
</td>
                                        <td class="" colspan="3" style="padding-top: 10px; padding-bottom: 60px; ">
                                        <br><br><br><br><br><br>
                                        <b>Signed</b><br>
                                        For Loyaltician CRM India Private Limited<br>
                                        (Computer Generated Receipt)
                                        </td>


                                    </tr>
                                </tbody>
                            </table>';



// echo $htmtab1 ; 
// return ; 

$pdf->writeHTML($htmtab1 . $htmtab1_body . $tbl_footer, true, false, false, false, '');
$pdf->Output('memberpdf/'.$Primary_nameOnTheCard.'.pdf','F');




    //   return ; 
        $leadsmail2=" contactus@clubfourpoints.com";
        $mailheader2 = "From: ".$leadsmail2."\r\n"; 
    $mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 
 


// require 'phpmail/src/PHPMailer.php';
// require 'phpmail/src/SMTP.php';
// require 'phpmail/src/Exception.php';


$mail2 = new PHPMailer\PHPMailer\PHPMailer();

    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail2->isSMTP();                                       // Set mailer to use SMTP
    $mail2->Host = 'mail.clubfourpoints.com';                    // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                                // Enable SMTP authentication
    $mail2->Username = 'contactus@clubfourpoints.com';            // SMTP username
    $mail2->Password = 'QKAc&mn,[xY%';                          // SMTP password
    $mail2->SMTPSecure = 'tls';                             // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 587;                                     // TCP port to connect to

    //Recipients
    $mail2->setFrom('contactus@clubfourpoints.com','Club Four Points');
     

    $mail2->mailheader=$mailheader2;// Add a recipient
    

    
    
$mail2->addAddress($Primary_Gmail_1); 
$mail2->addCC('hitesh.gunwani@outlook.com ');
$mail2->addBCC('khannakaran9317@gmail.com');
$mail2->addBCC('vishwaaniruddh@gmail.com');
$mail2->addAttachment("memberpdf/$Primary_nameOnTheCard.pdf");


    $mail2->isHTML(true);                                  // Set email format to HTML
    $mail2->Subject = $EmailSubject2."\r\n";
    $mail2->Body    = $message2;
    // $mail2->send();
    
//==============mail end===
}
?>