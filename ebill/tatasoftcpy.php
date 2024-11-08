<?php
include("config.php");
 $cid=$_POST['cid'];
 $sql=$_POST['qr'];
$qry=mysqli_query($con,$sql);

	

$contents="SR NO \t Company	Customer \t Bank \t Invoice No \t Revised Invoice No. \t Date Of Reveived \t Date of Bill submitted \t TYPE OF SITE \t Site ID \t I ATM ID \t Location \t Service Provider \t Billing Unit (Only for SP-MSEDC) \t Meter No \t Consumer No \t Bill Period From \t Bill Period To \t Bill Date \t Due Date \t Opening Reading \t Closing Reading \t Unit \t Paid Date \t Paid Amount \t Extra  Charges \t Total Amt. \t Landlord Name \t Rermark \t 2nd Remark \t Final Remark \t Status \t Handover To \t Soft Copy \n";

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

$eb=mysqli_query($con,"select meter_no,landlord from ".$row[1]."_ebill where atmtrackid='".$detro[2]."'");
$ebr=mysqli_fetch_row($eb);

$fund=mysqli_query($con,"select opening_reading,closing_reading,unit,extrachrg  from ebillfundrequests where req_no='".$detro[20]."'");
$fundr=mysqli_fetch_row($fund);
$cnt=$cnt+1;
$contents.=$cnt."\t";
$contents.="CSS\t";
$contents.=$custro[0]."\t";
$contents.=$sitero[0]."\t";
//$contents.=$sitero[2]."\t";
$contents.=$row[5]."\t";
$contents.="- \t";
$contents.="- \t";
$contents.=date('d-m-y')."\t";
if($sitero[6]=='Y')
$contents.="Housekeeping";
elseif($sitero[6]=='N' && $sitero[7]=='Y')
$contents.="Caretaker";
else
$contents."NA";


//$contents.=$sitero[5]."\t";
//$contents.=$sitero[5]."\t";
$contents.="\t".$sitero[1]."\t";
$contents.=$sitero[2]."\t";
 $text = preg_replace('/\s+/', ' ', $sitero[4]);
                        $contents.=$text."\t";
//$contents.=$sitero[4]."\t";
$contents.=$detro[3]."\t";
$contents.="-\t";
$contents.=$ebr[0]."\t";
$contents.=$detro[5]."\t";
$contents.=$detro[9]."\t";
$contents.=$detro[10]."\t";
$contents.=$detro[6]."\t";
$contents.=$detro[7]."\t";
$contents.=$fundr[0]."\t";
$contents.=$fundr[1]."\t";
$contents.=$fundr[2]."\t";
$contents.=$detro[13]."\t";
$contents.=$detro[12]."\t";
$contents.=$fundr[3]." \t";
$contents.=$detro[12]."\t";
$contents.=$ebr[1]."\t";
$contents.="-\t";
$contents.="-\t";
$contents.="-\t";
$contents.="-\t";
$contents.="-\t";
$contents.="-\n";
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