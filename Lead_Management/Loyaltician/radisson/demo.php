<?php include('config.php');

$sql = mysqli_query($conn,"SELECT mem_id,Primary_nameOnTheCard,promotional_voucher_code FROM `Members` WHERE PromotionalCheck1=1");
while($sql_result = mysqli_fetch_assoc($sql)){
    
    $promotional_voucher_code = $sql_result['promotional_voucher_code'];
    $promotional_voucher_code = $promotional_voucher_code.'034';
    echo $s = "insert into BarcodeScan(Voucher_id) values($promotional_voucher_code)";
    mysqli_query($conn,$s);
}

return ; 
    $sql2="SELECT * from voucher_Type_promotional where status=0 order by V_type_id desc";
    
    $runsql2=mysqli_query($conn,$sql2);
    
    while($sql2fetch=mysqli_fetch_array($runsql2)){
        echo $remaining1= $sql2fetch['serialNumber'];
            $value= $remaining1 + 1;
    
    
    echo $value ; 
}

return ; 
$q="SELECT * from voucher_Type_promotional where status=0 order by V_type_id desc";
     $sql=mysqli_query($conn,$q);
     $_row=mysqli_fetch_array($sql);
     $_rowa = mysqli_num_rows($sql);
        if($_rowa > 0){
            $countR=$_row['serialNumber'];
            $readyToUse=$countR+1;
            $NoOfVoucher=$readyToUse;
            mysqli_query($conn,"insert into BarcodeScan(Voucher_id,Available) values('".$NoOfVoucher."','0')");
          }        
        






return ; 
ini_set('memory_limit','-1');

include('number_to_wordConvert.php');


$host = 'smtp.hostinger.com';
$hostusername = 'contactus@clubeliteplus.com';
$hostpassword = '8x%8AovpL3O8';
$port = '587';

// $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/LOYALTICIAN/mail.php';
$nodes = 'https://arpeeindustries.com/mail.php';
$leadsmail2=" contactus@clubeliteplus.com";
$leadsmail = $leadsmail2 ; 

$from = 'contactus@clubeliteplus.com';
$fromname = 'Radisson' ; 



$cc = ['contactus@clubeliteplus.com','pratik@loyaltician.com','farheen@loyaltician.com','hitesh@loyaltician.com'];
$bcc = ['khannakaran67@gmail.com'];

  
  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$Static_LeadID = '12';

$Primary_nameOnTheCard = 'Aniruddh Vishwakarma';
$member_id = '211';
$validity = '21-2-2021';
$MembershipDts_NetPayment = '21222';
$MembershipDts_GrossTotal = '21234';
$payment_mode = 'cash';

$attachment = "https://loyaltician.in/clubfourpoints/Leadpdf/memberpdf/76658.pdf";

include('Leadpdf/generatepdf/TCPDF-master/examples/tcpdf_include.php');
include('Leadpdf/generatepdf/TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {
    public function Header() {
    }

    public function Footer() {
    }                                                                                                                                               
}



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


$to =['vishwaaniruddh@gmail.com'];
$cc = ['vishwaaniruddh@gmail.com'];
$bcc = ['khannakaran67@gmail.com'];




        $EmailSubject2="Welcome to Radisson !";
        

$message2 ='
<table width="50%" align="center" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
  <img border="0" width="130" style="width:1.3541in" src="https://loyaltician.in/radisson/newassets/wlogo.png" alt="Elite Plus">
    <u></u><u></u></p>
</td>
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p align="right" style="text-align:right">

  <span style="text-decoration:none">
    <img border="0" width="130" style="width:1.3541in" src="https://loyaltician.in/radisson/assets/Image2.png" alt="Elite Plus">
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
lang=EN-IN>A warm welcome to Elite Plus!</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="color:black">We thank you for your decision to become a member at Radisson Mumbai Goregaon. Your membership has been issued and details are as follows:
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Details</u></b>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Membership Level - Platinum</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>Your Membership Card number is '.$member_id.'. </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The membership is valid till '.date('M Y', strtotime($validity)).' </span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN> </span></p>


<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Fee</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>The annual membership charge of Rs. '.$MembershipDts_NetPayment.' + 18% Goods & Services Tax amounting to 
Rs. '.$MembershipDts_GrossTotal.' /- ( '.convertNum($MembershipDts_GrossTotal).' ) has been received by '.$payment_mode.'.
A Tax Invoice cum Receipt is enclosed in this email. This receipt does not require a signature. 
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Usage</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
You can present your membership number and a copy of this email to start using your membership card benefits. 
To know more about these benefits please visit <a href="www.clubeliteplus.com ">www.clubeliteplus.com </a> 
</span></p>



<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Package</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Your personalised welcome package will reach you within 10 working days of this e-mail.
Do note that the membership gift certificates can be used only upon receipt of the membership package and have to be presented in original.
The certificates issued along with the membership are given at the bottom of this email.
Should there be a need to use any of these certificates urgently before they arrive, do reach out to our Member Help Desk for help.
</span></p>






<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><b><u>Membership Terms and Conditions</u></b>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Payment of the membership fee confirms that you have read and understood the membership terms and conditions and then made the payment to enrol.
Do take a moment to view all benefits and terms at <a href="www.clubeliteplus.com ">www.clubeliteplus.com </a>
or reach out to our Member Help Desk from Monday to Saturday, 9.30 AM to 6.30 PM 
for any clarifications.
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
We will look forward to welcoming you to our hotel and to a great Membership Year with us.
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>


<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Yours sincerely,
</span></p>
<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>&nbsp;</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN>
Team Elite Plus
</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN style="font-size:12.0pt;line-height:107%">+91 7678040999</span></p>

<p class=MsoNormal style="margin-bottom:0in;margin-bottom:0in;margin-top:0in"><span
lang=EN-IN><a href="http://www.clubeliteplus.com"><span style="font-size:12.0pt;
line-height:107%">www.clubeliteplus.com</span></a></span><span lang=EN-IN
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

$qry="select Leval_id,level_name from Level where Leval_id='2' ";
$did=3;
  $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."' and serviceName not like '%RENEWAL%' order by serialNumber ASC";
//echo $sql2;
	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

  	     $remaining1=substr($sql2fetch['serialNumber'],8);
  	         //$value= $sql5fetch['AssignBooklet']+1;
  	         //$AssignBooklet1=$value.$remaining1;


    if($isfirst==1){
            $value= $AssignBooklet+1;
    }else{
        $value= $AssignBooklet;        
    }

  	         $AssignBooklet1=$value.$remaining1;




$message2.='<tr style="height:14.5pt">
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
  border:none windowtext 1.0pt;padding:0in;background:white">'.$sql2fetch['serviceName'].'</span></p>
  </td>
  <td width=168 nowrap valign=top style="width:125.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">'.$AssignBooklet1.'</span></p>
  </td>
 </tr>';
    
    $srno++;
}
$PromotionalCheck1='on';
if($PromotionalCheck1=='on'){
  $sql2="SELECT serviceName,serialNumber FROM `voucher_Type_promotional` where level_id='".$did."' and serviceName not like '%RENEWAL%' order by serialNumber ASC";

	$runsql2=mysqli_query($conn,$sql2);
while($sql2fetch=mysqli_fetch_array($runsql2)){

 
   $remaining1=substr($sql2fetch['serialNumber'],8);
    if($isfirst==1){
            $value= $AssignBooklet+1;
    }else{
        $value= $AssignBooklet;        
    }

  	$AssignBooklet1=$value.$remaining1;         
  	         
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
    
}





 
$message2.='</table>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">The membership program is operated by Loyaltician CRM India Private Limited for Radisson Mumbai Goregaon. </span></em></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">
This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any communication preferences, please write to us at
  </span></em><span lang=EN-IN><a
href="mailto:contactus@clubeliteplus.com"><span style="font-size:10.5pt;
line-height:107%;border:none windowtext 1.0pt;
padding:0in;background:white">contactus@clubeliteplus.com</span></a></span><em><span
lang=EN-IN style="font-size:10.5pt;line-height:107%;
color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>

<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">
Disclaimer: This message has been sent as a part of discussion between ‘Club Elite Plus’ and the addressee whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding.
</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>
</td>
</tbody>
</table>';
// echo $message2;



// //exit;






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


$Primary_nameOnTheCard = $pdfsql_result['Primary_nameOnTheCard'];
$receipt_no = $pdfsql_result['receipt_no'];
$entryDate = $pdfsql_result['entryDate'];
$entryDate =  date("d-m-Y", strtotime($entryDate));
$MembershipDetails_Level = $pdfsql_result['MembershipDetails_Level'];
if($MembershipDetails_Level==1){
    $level ='Gold';
}elseif($MembershipDetails_Level==2){
    $level ='Platinum';
}elseif($MembershipDetails_Level==6){
    $level ='Silver';
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
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="https://loyaltician.in/radisson/assets/Image1.png" style="margin-left:200px;height:60px;">
                                                </th>
                                            </tr>
                                            
                                            
                                            <tr>
                                            <th colspan="6" style="font-size:25px;font-weight:700;text-align:center;"> LCRM- A/C Radisson Membership </th>
                                            </tr>

                                            <tr>
                                            <th colspan="6" style="text-align:center;"> Representative for, Radisson Mumbai Goregaon,  contactus@clubeliteplus.com </th>
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
                                           <td colspan="3"><b>State :</b>'.ucwords($State).'</td>
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
                                            <td colspan="1">'.$MembershipDts_NetPayment.'</td>
                                            
                                        </tr>
                                       
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Payment Details:</b></td>
                                           <td colspan="2" style="background-color: #daeef3; color: black; "><b>Subtotal:</b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">'.$MembershipDts_NetPayment.'</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Received by : '.$MembershipDts_PaymentMode.'</td>';
                                            
                                             if($State=="MAHARASHTRA" || $State=="Maharashtra"){
                                            
                                                    $htmtab1 .='<td colspan="2" style="background-color: #daeef3; color: black; "><b>CGST @ 9% </b></td>
                                                    <td colspan="1" style="background-color: #daeef3; color: black; ">'.$CGST.'</td>';
                                            
                                            }else{
                                                $htmtab1 .='<td colspan="2"rowspan="2" style="background-color: #daeef3; color: black; "><b>IGST @ 18% </b></td>
                                                    <td colspan="1" rowspan="2" style="background-color: #daeef3; color: black; ">'.($CGST*2).'</td>';
                                            } 
                                            
                                            
                                        $htmtab1 .='</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; ">Instrument Number/ Approval Code</td>';
                                            
                                            if($State=="MAHARASHTRA" || $State=="Maharashtra"){
                                            $htmtab1 .='<td colspan="2" style="background-color: #daeef3; color: black; "><b>GGST @ 9% </b></td>
                                            <td colspan="1" style="background-color: #daeef3; color: black; ">'.$CGST.'</td>';
                                                                                         }else{
                                                                                             

                                                                                         }

                                            
                                        $htmtab1 .='</tr>
                                        
                                        <tr>
                                            <td class="" colspan="3" style="background-color: #dbe5f1; color: black; "><b>Cheque Favouring -  LCRM- A/C Radisson Membership</b></td>
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



$pdf->writeHTML($htmtab1 , true, false, false, false, '');
$pdf->Output('Leadpdf/memberpdf/'.$Primary_nameOnTheCard.'.pdf','F');



$pagesource = "CPF_MemberCreation_Process";
$memid = $Static_LeadID;
$msg = "";

$subject = $EmailSubject2;
$message = $message2 ; 
$to = ['vishwaaniruddh@gmail.com'];


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
        'pdfstructure'=>$htmtab1,
        'attachment'=>$attachment,
        'primary_name'=>$Primary_nameOnTheCard,
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
    
    
    var_dump($result);




  ?>