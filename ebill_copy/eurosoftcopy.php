<?php
include("config.php");
 $cid=$_POST['cid'];
 $sql=$_POST['qr'];
 
 
$qry=mysqli_query($con,$sql);

	
//changed on 13-02-2015 mark with rahul
//============== rahul              $contents="SR NO \t Customer \t Bank \t Invoice No \t Revised Invoice No. \t Date Of Received \t Date of Bill submitted \t Age \t Site ID \t I ATM ID \t Location \t Service Provider \t Billing Unit (Only for SP-MSEDC) \t Meter No \t Consumer No \t Bill Period From \t Bill Period To \t Bill Date \t Due Date \t Opening Reading \t Closing Reading \t Unit \t Paid Date \t Paid Amount \t Extra  Charges \t Total Amt. \t Landlord Name \t Remark \t Month  \t Handover Date \t Soft Copy \n";
$contents="SR NO \t Name of Vendor \t Bank Name \t Invoice No  \t Invoice Date\t Type of Services\t Basic Amount \t CGST \t SGST\t IGST\t Total Bill Amount \t Vendor GST Number \t From State \t To State  \n";

    
while($row=mysqli_fetch_array($qry))
{
//=========== code by anand showing igst,cgst,sgst,service charge,total amount ===========================================================================
    $site1=mysqli_query($con,"select State from eps_gst where State='".$row['state']."' ");
$sitero1=mysqli_fetch_array($site1);
    
    $site2=mysqli_query($con,"select state,gst from gst_no_os where state='".$row['state']."'");
$sitero2=mysqli_fetch_array($site2);
    
    $site3=mysqli_query($con,"SELECT srvchrg FROM `send_bill_detail` WHERE `send_id` ='".$row['send_id']."' and status='0' ");
$sitero3=mysqli_fetch_array($site3);
$count3=mysqli_num_rows($site3);
 
  $divide_cgst1= $row['cgst']/$count3;
    $divide_cgst= round($divide_cgst1,2);

 $divide_sgst1= $row['sgst']/$count3;
    $divide_sgst= round($divide_sgst1,2);

$divide_igst1= $row['igst']/$count3;
    $divide_igst= round($divide_igst1,2);

$total=$sitero3['srvchrg']+$divide_cgst+$divide_sgst+$divide_igst;

$cnt=0;

$cust=mysqli_query($con,"select contact_first from contacts where short_name ='".$row[1]."'");
$custro=mysqli_fetch_row($cust);
$det=mysqli_query($con,"select * from send_bill_detail where send_id='".$row[0]."' and status=0");
while($detro=mysqli_fetch_array($det))
{
    
$site=mysqli_query($con,"select bank,site_id,atm_id1,location,atmsite_address,site_type,housekeeping,caretaker from ".$row[1]."_sites where trackerid='".$detro[2]."'");
$sitero=mysqli_fetch_row($site);

$eb=mysqli_query($con,"select meter_no,landlord from ".$row[1]."_ebill where atmtrackid='".$detro[2]."'");
$ebr=mysqli_fetch_row($eb);

$fund=mysqli_query($con,"select opening_reading,closing_reading,unit,extrachrg,supervisor,Diebold_TicketNo,trans_id from ebillfundrequests where req_no='".$detro[20]."'");
$fundr=mysqli_fetch_row($fund);


$sum_row=$detro['paid_amount']+$detro['extrachrg']+$detro['recon_chrg']+$detro['discon_chrg']+$detro['sd']+$detro['after_duedt_chrg'];
//$tot=$tot+$sum_row+$detro['paid_amount'];

$cnt=$cnt+1;
$contents.=$cnt."\t";
$contents.="CSS\t";
//$contents.=$custro[0]."\t";
$contents.=$sitero[0]."\t";
//$contents.=$sitero[2]."\t";
$contents.=$row[5]."\t";
//$contents.="- \t";
//$contents.="- \t";
$contents.=date('d-m-y')."\t";
/*if($sitero[6]=='Y')
$contents.="Housekeeping";
elseif($sitero[6]=='N' && $sitero[7]=='Y')
$contents.="Caretaker";
else*/
$contents."EB SERVICES";
$contents.=$detro['paid_amount']."\t";


if($row['state']==$sitero1['State'] && $row['state']==$sitero2['state'] && $fundr[4]=="ONLINE" && $sitero2['gst']!='na'){
$contents.=$sitero2[0]."\t";
$contents.=$sitero1[0]."\t";
$contents.=$sitero3['srvchrg']."\t";
$contents.=$divide_cgst."\t";
$contents.=$divide_sgst."\t";
$contents.=$divide_igst."\t";
$contents.=$total."\t";
}

else if($row['state']==$sitero1['State'] && $row['state']==$sitero2['state'] && $fundr[4]!="ONLINE" && $sitero2['gst']!='na'){
$contents.=$sitero2[0]."\t";
$contents.=$sitero1[0]."\t";
$contents.=$sitero3['srvchrg']."\t";
$contents.=$divide_cgst."\t";
$contents.=$divide_sgst."\t";
$contents.=$divide_igst."\t";
 $contents.=$total."\t";   
}
else if($sitero1['State']=="" ){
$contents.=$sitero2[0]."\t";
$contents.='Maharashtra'."\t";
$contents.=$sitero3['srvchrg']."\t";
$contents.=$divide_cgst."\t";
$contents.=$divide_sgst."\t";
$contents.=$divide_igst."\t";
$contents.=$total."\t";
}
else if($sitero2['state']=="" || $sitero2['gst']){
$contents.='Maharashtra'."\t";
$contents.=$sitero1['State']."\t";
$contents.=$sitero3['srvchrg']."\t";
$contents.=$divide_cgst."\t";
$contents.=$divide_sgst."\t";
$contents.=$divide_igst."\t";
$contents.=$total."\t";
}




$contents.="\n";
}
//$contents.="\n";
}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=epsinvoiceannexure.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>