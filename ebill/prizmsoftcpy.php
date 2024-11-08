<?php
include("config.php");
 $cid=$_POST['cid'];
 $sql=$_POST['qr'];
$qry=mysqli_query($con,$sql);
//echo $sql;

	$contents="SR NO \t ATM ID \t Payment Mode \t Payee \t Payment Date \t Opening Reading \t Closed Reading \t Consumed Units \t Billing Type \t Deposit Amount \t Paid Amount \t Bill Amount  \t Extra Charges \t Reconnection Charges \t Disconnection Charges \t Security Deposit \t After Due Date Charges \t Penalty \t Total Paid Amount \t Bill Date \t Due Date \t Bill From \t Bill To \t Bill Duration \t Consumer No \t Service Provider \t Consumer Name \t Invoice No\n";
	//$contents="SR NO \t ATM ID \t Site ID \t Payment Mode \t Payee \t Payment Date \t Opening Reading \t Closed Reading \t Consumed Units \t Billing Type \t Deposit Amount \t Paid Amount \t Bill Amount \t Penalty \t Bill Date \t Due Date \t Bill From \t Bill To \t Consumption Unit \t Bill Duration \t Consumer No \t Service Provider \t Consumer Name \t Invoice No\n";

//$contents="SR NO \t I ATM ID \t Site ID \t Electricity Board \t Consumer No \t Consumer Name \t Bill Period To \t Bill Date \t Due Date \t Opening Reading \t Closing Reading \t Unit \t Paid Date \t Paid Amount \t Extra  Charges \t Total Amt. \t  \t Rermark \t 2nd Remark \t Final Remark \t Status \t Handover To \t Soft Copy \n";

while($row=mysqli_fetch_array($qry))
{
$cnt=0;
$cust=mysqli_query($con,"select contact_first from contacts where short_name ='".$row[1]."'");
$custro=mysqli_fetch_row($cust);
$det=mysqli_query($con,"select * from send_bill_detail where send_id='".$row[0]."' and status=0");
while($detro=mysqli_fetch_array($det))
{
$site=mysqli_query($con,"select bank,site_id,atm_id1,location,atmsite_address,site_type,housekeeping,caretaker from ".$row[1]."_sites where trackerid='".$detro[2]."'");
$sitero=mysqli_fetch_row($site);

$eb=mysqli_query($con,"select meter_no,landlord,Distributor,Consumer_No from ".$row[1]."_ebill where atmtrackid='".$detro[2]."'");
$ebr=mysqli_fetch_array($eb);

$fund=mysqli_query($con,"select opening_reading,closing_reading,unit,extrachrg,bill_amt,supervisor  from ebillfundrequests where req_no='".$detro[20]."'");
$fundr=mysqli_fetch_row($fund);

$sum_row=$detro['paid_amount']+$detro['extrachrg']+$detro['recon_chrg']+$detro['discon_chrg']+$detro['sd']+$detro['after_duedt_chrg'];
//$tot=$tot+$sum_row+$detro['paid_amount'];

$cnt=$cnt+1;
$contents.=$cnt."\t";
$contents.=$sitero[2]."\t";
//$contents.=$sitero[1]."\t";
$contents.="- \t";
$contents.="- \t";
$contents.=$detro[13]."\t";
$contents.=$fundr[0]."\t";
$contents.=$fundr[1]."\t";
$contents.=$fundr[2]."\t";
$contents.="- \t";
$contents.="- \t";
$contents.=$detro[12]."\t";
$contents.=$fundr[4]."\t";
$contents.=$detro['extrachrg']."\t";
$contents.=$detro['recon_chrg']."\t";
$contents.=$detro['discon_chrg']."\t";
$contents.=$detro['sd']."\t";
$contents.=$detro['after_duedt_chrg']."\t";
$contents.=$fundr[3]."\t";
$contents.=($fundr[4]+$detro['after_duedt_chrg'])."\t";
$contents.=$detro[6]."\t";
$contents.=$detro[7]."\t";
$contents.=$detro[9]."\t";

$contents.=$detro[10]."\t";
//$contents.=$detro[8]."\t";
$contents.="-\t";
$contents.=$ebr['Consumer_No']."\t";
$contents.=$ebr['Distributor']."\t";
$contents.=$ebr['landlord']."\t";
$contents.=$row[5]."\t";
$contents.=$fundr[5]."\n";


}
//$contents.="\n";
}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=prizminvoiceannexure.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>