<?php
include("config.php");
 $cid=$_POST['cid'];
 $sql=$_POST['qr'];
 //echo $sql;
$qry=mysqli_query($con,$sql);

	

$contents="SR NO \t Vendor \t Invoice Number \t Invoice Date \t ATM ID \t Address \t Location Name \t City Name \t State \t Consumer Name \t I Consumer No \t Bill Date \t From \t To \t Opening Unit \t Closing Unit \t Units Consumed \t Electricity charges(*) \t Extra Charges \t Reconnection Charges \t Disconnection Charges \t Security Deposit \t After Due Date Charges  \t Paid Date To \t Total Paid Amount \t Bank Name \t Req ID \t Supervisor \n";

while($row=mysqli_fetch_array($qry))
{
$cnt=0;
$cust=mysqli_query($con,"select contact_first from contacts where short_name ='".$row[1]."'");
$custro=mysqli_fetch_row($cust);
//echo "<br/>".$row[0]." ".$row['invoice_no']."<br/>";
$det=mysqli_query($con,"select * from send_bill_detail where send_id='".$row[0]."' and status=0");
while($detro=mysqli_fetch_array($det))
{
//echo $row['invoice_no']." ".$detro[0];
$site=mysqli_query($con,"select bank,site_id,atm_id1,location,atmsite_address,site_type,housekeeping,caretaker,city,state from ".$row[1]."_sites where trackerid='".$detro[2]."'");
$sitero=mysqli_fetch_array($site);


//echo "select meter_no,landlord,Consumer_No from ".$row[1]."_ebill where atmtrackid='".$detro[2]."'"."<br>";
$eb=mysqli_query($con,"select meter_no,landlord,Consumer_No from ".$row[1]."_ebill where atmtrackid='".$detro[2]."' AND Consumer_No!=''");
//echo mysqli_error();

$ebr=mysqli_fetch_array($eb);

$fund=mysqli_query($con,"select *  from ebillfundrequests where req_no='".$detro[20]."'");
$fundr=mysqli_fetch_array($fund);


$sum_row=$detro['paid_amount']+$detro['extrachrg']+$detro['recon_chrg']+$detro['discon_chrg']+$detro['sd']+$detro['after_duedt_chrg'];
//$tot=$tot+$sum_row+$detro['paid_amount'];

$cnt=$cnt+1;
$contents.=$cnt."\t";
$contents.="CSS\t";
$contents.=$row['invoice_no']."\t";
$contents.=$row['date']."\t";
$contents.=$sitero['atm_id1']."\t";
$text = preg_replace(array('/\s+/', '/\"+/'), ' ', $sitero['atmsite_address']);
//$text = addslashes($sitero['atmsite_address']);
$contents.=$text."\t";
//$contents.=$sitero['atmsite_address']."\t";
$contents.=$sitero['location']."\t";
$contents.=$sitero['city']."\t";
$contents.=$sitero['state']."\t";
$contents.=$ebr['landlord']."\t";
$contents.=$ebr['Consumer_No']."\t";
$contents.=$detro['bill_date']."\t";
$contents.=$detro['usdate']."\t";
$contents.=$detro['uedate']."\t";
$contents.=$fundr['opening_reading']." \t";
$contents.=$fundr['closing_reading']." \t";
$contents.=$fundr['unit']." \t";
$contents.=$detro['paid_amount']."\t";
$contents.=$fundr['extrachrg']."\t";
$contents.=$fundr['recon_chrg']."\t";
$contents.=$fundr['discon_chrg']."\t";
$contents.=$fundr['sd']."\t";
$contents.=$fundr['after_duedt_chrg']."\t";
$contents.=$detro['paid_date']."\t";
$contents.=$sum_row."\t";
$contents.=$sitero['bank']."\t";
$contents.=$fundr['req_no']."\t";
$contents.=$fundr[8]."\t";

$contents.="\n";
}
//$contents.="\n";
}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=tatainvoiceannexure.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>