<?php
include("config.php");
 $cid=$_POST['cid'];
 $sql=$_POST['qr'];
$qry=mysqli_query($con,$sql);

	$tot=0;

while($row=mysqli_fetch_array($qry))
{
$cnt=0;
$cust=mysqli_query($con,"select contact_first from contacts where short_name ='".$row[1]."'");
$custro=mysqli_fetch_row($cust);
$contents.="Invoice No :- \t".$row[5]." \t \t  \t  \t  \t  \t  \t \n";

$contents.="Bank :- \t".$row[2]."\n ";
$contents.="Date:-\t".date("d-M-y",strtotime($row[3]))."\n \n";
$contents.="Sr No. \t Atm Id \t Site Id \t Electricity Board \t Consumer No \t Consumer Name \t Bill Date \t Due Date \t Unit Consumed \t Month \tAmount \t Invoice No \t Paid Date \t Last Sub-meter Reading \t Rate of the Sub-meter Unit\n";	

$det=mysqli_query($con,"select * from send_bill_detail where send_id='".$row[0]."' and status=0");
while($detro=mysqli_fetch_array($det))
{
$site=mysqli_query($con,"select bank,site_id,atm_id1,location,atmsite_address,site_type,housekeeping,caretaker from ".$row[1]."_sites where trackerid='".$detro[2]."'");
$sitero=mysqli_fetch_row($site);

$eb=mysqli_query($con,"select meter_no,landlord,Distributor from ".$row[1]."_ebill where atmtrackid='".$detro[2]."'");
$ebr=mysqli_fetch_row($eb);

$fund=mysqli_query($con,"select opening_reading,closing_reading,unit,extrachrg  from ebillfundrequests where req_no='".$detro[20]."'");
$fundr=mysqli_fetch_row($fund);
$tot=$tot+$detro[12];
$cnt=$cnt+1;
$contents.=$cnt."\t";
$contents.=$sitero[2]."\t";
$contents.=$sitero[1]."\t";
$contents.=$ebr[2]."\t";
$contents.=$detro[5]."\t";
$contents.=$ebr[1]."\t";
$contents.=$detro[6]."\t";
$contents.=$detro[7]."\t";
$contents.=$detro[8]."\t";
$contents.=$detro[11]."\t";
$contents.=$detro[12]."\t";
$contents.=$row[5]."\t";
$contents.=$detro[13]."\t";
$contents.=$fundr[2]."\t";

$contents.="-\n";



}
//$contents.="\n";
}
$contents.="\t \t \t \t \t \t \t Total \t \t \t ";
$contents.=$tot."\t \t \n";
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=agsinvoiceannexure.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>