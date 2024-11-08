<?
include('config.php');
$Static_LeadID='76656';

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
<td width="325" style="width:243.75pt;padding:11.25pt 0cm 0cm 0cm">
<p>
    
      <span style="text-decoration:none">
      <img border="0" width="130" style="width:1.3541in" src="http://loyaltician.in/clubfourpoints/newassets/image002.png" alt="The Orchid Gold"></span>
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
lang=EN-IN style="color:black">Your Club Four Points Membership Vouchers have been revalidated as follows:</span></p> 


</td>
</tbody>
</table> ';


$message2 .= '<table width="50%" align="center" class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style="border-collapse:collapse;border:none">
 
 <tr style="height:14.5pt">
 
  <td nowrap valign=top style="border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">SN</span></b></p>
  </td>
 
  <td nowrap valign=top style="border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Certificate Number</span></b></p>
  </td>
 
 
   <td nowrap valign=top style="border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Type</span></b></p>
  </td>
  
  <td nowrap valign=top style="border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt;height:14.5pt">
  <p class=MsoNormal style="margin-bottom:0in;line-height:normal"><b><span
  lang=EN-IN style="font-size:10.5pt;
  border:none windowtext 1.0pt;padding:0in;background:white">Extended Validity</span></b></p>
  </td>
  
 </tr>';
 
 
 
 $srno=1;

$sql4fetch = ['Leval_id'=>2];

$qry="select Leval_id,level_name from Level where Leval_id='".$sql4fetch['Leval_id']."' ";
$did=$sql4fetch['Leval_id'];
  
  echo $sql2="SELECT serviceName,serialNumber FROM `voucher_Type` where level_id='".$did."' and serviceName not like '%RENEWAL%' order by serialNumber ASC";

	$runsql2=mysqli_query($conn,$sql2);
	
while($sql2fetch=mysqli_fetch_array($runsql2)){

var_dump($sql2fetch);

 
  	     $remaining1=substr($sql2fetch['serialNumber'],8);
  	         //$value= $sql5fetch['AssignBooklet']+1;
  	         //$AssignBooklet1=$value.$remaining1;

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
















$message2 .='</table>
<table width="50%" align="center">
<tbody>
<td>
<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white;font-style:normal">&nbsp;</span></em></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:10.5pt;line-height:
107%;border:none windowtext 1.0pt;
padding:0in;background:white">This email is an official confirmation of the extension of the above Club Four Points Membership vouchers. These vouchers cannot be revalidated further beyond the given new validity. </span></p>

<p><b><u>Important</u></b></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:10.5pt;line-height: 107%;border:none windowtext 1.0pt; padding:0in;background:white">
    Please note that the Original Certificates (as enclosed) from your booklet must be produced at the hotel at the time of use / at the time of check-in along with a copy of this email.  This email is a confirmation of revalidation but cannot be used independently to avail of the benefit. 
</span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:10.5pt;line-height: 107%;border:none windowtext 1.0pt; padding:0in;background:white">
        We look forward to your visit to our hotel.
</span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:10.5pt;line-height: 107%;border:none windowtext 1.0pt; padding:0in;background:white">
    Team Club Four Points
</span></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:10.5pt;line-height: 107%;border:none windowtext 1.0pt; padding:0in;background:white">
    +91 6758 7767
</span></p>

<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height: 107%;border:none windowtext 1.0pt; padding:0in;background:white">
    The membership program is operated by Loyaltician CRM India Private Limited for Chalet Hotels Limited. 
</span><em></p>



<p class=MsoNormal><em><span lang=EN-IN style="font-size:10.5pt;line-height: 107%;border:none windowtext 1.0pt;padding:0in;background:white">
    This message is sent to you because your email address is on our subscribers list as a Member with an express consent to communicate with you. We will ensure only high quality / relevant information is sent to you to manage your membership. If you wish to change any
    communication preferences, please write to us at
</span></em><span lang=EN-IN>
<a href="mailto:contactus@clubfourpoints.com"><span style="font-size:10.5pt; line-height:107%;border:none windowtext 1.0pt; padding:0in;background:white">
    contactus@clubfourpoints.com
</span></a></span>
<em><span lang=EN-IN style="font-size:10.5pt;line-height:107%; color:#444444;border:none windowtext 1.0pt;padding:0in;background:white"> </span></em></p>




<p class=MsoNormal style="line-height:normal;background:white;vertical-align:
baseline"><i><span lang=EN-IN style="font-size:10.5pt;
color:#444444;border:none windowtext 1.0pt;padding:0in">
Disclaimer: This message has been sent as a part of discussion between ‘Club Four Points’ and the addressee 
whose name is specified above. Should you receive this message by mistake, we would be most grateful if you informed us that the message has been sent to you. In this case, we also ask that you delete this message from your mailbox, and do not forward it or any part of it to anyone else. Thank you for your cooperation and understanding
</span></i></p>

<p class=MsoNormal><span lang=EN-IN style="font-size:12.0pt;line-height:107%">&nbsp;</span></p>



</td>
</tbody>
</table>';
echo $message2;






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
	




    
echo $htmtab1 ; 


	  
?>