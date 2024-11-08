<?php include('config.php');
// $id='76730';
include('number_to_wordConvert.php');

$id = $Static_LeadID ;
$qgen= mysqli_query($conn,"select * from Members where Static_LeadId='".$id."'");
$row=mysqli_fetch_row($qgen);
$MembershipDetails_Fee = $row[40];

$Primary_nameOnTheCard = $row[13];
$MembershipDts_GrossTotal = $row[46];
$memid=$row[1];


$date = strtotime($row[73]); 
$expdate=date('M Y', $date);

$host = 'mail.clubfourpoints.com';
$hostusername = 'contactus@clubfourpoints.com';
$hostpassword = 'QKAc&mn,[xY%';
$port = '587';
// $nodes = 'https://arpeeindustries.com/mail.php';
 $nodes = 'https://sarmicrosystems.in/SarMailor_APIS/mail.php';

$paymode = $MembershipDts_PaymentMode ; 








$attachment = "https://loyaltician.in/clubfourpoints/Leadpdf/memberpdf/$Primary_nameOnTheCard.pdf";


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
         Membership Level - Platinum .<br>
         Your Membership Card number is '.$memid.'.<br>
         The membership is valid till '.$expdate.'<br><br>

        The annual membership charge of Rs.  '.$MembershipDetails_Fee.' + 18% Goods &amp; Services Tax amounting to Rs. '.$MembershipDts_GrossTotal.' /- (' .convertNum($MembershipDts_GrossTotal) .' only) has been received by '.$paymode.'. A receipt is enclosed in this email.
        
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
 $message2.='<th colspan="3">Gift Certificates issued</th>';
 $message2.='</tr><tr>';
 $message2.='<th>SN</th><th>Type</th><th>Certificate Number</th>';  
 
 
 $srno=1;
 $did=2;
 $sql2="SELECT serviceName,serialNumber FROM `voucher_Type_new` where level_id='".$did."' order by serialNumber asc";
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


































$receiptNO = $countRecipt ; 






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
$receipt_no =  $countRecipt ; 

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

$pdf->writeHTML($htmtab1 , true, false, false, false, '');
$pdf->Output('Leadpdf/memberpdf/'.$Primary_nameOnTheCard.'.pdf','F');



$leadsmail2=" Orchidmembership@loyaltician.com";
$mailheader2 = "From: ".$leadsmail2."\r\n"; 
$mailheader2.= "Reply-To: ".$leadsmail2."\r\n"; 

// $leadsmail2=" contactus@clubfourpoints.com";
$leadsmail = $leadsmail2 ; 
$subject = $EmailSubject2;
$message = $message2 ;

$to =['vishwaaniruddh@gmail.com'];
// $cc = [];
// $bcc= [];
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
?>