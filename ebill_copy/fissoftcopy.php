<?php
include("config.php");
 $cid=$_POST['cid'];
 $sql=$_POST['qr'];
$qry=mysqli_query($con,$sql);


function nb_mois($date1, $date2)
{
    $begin = new DateTime( $date1 );
    $end = new DateTime( $date2 );
    $end = $end->modify( '+1 month' );

    $interval = DateInterval::createFromDateString('1 month');

    $period = new DatePeriod($begin, $interval, $end);
    $counter = 0;
    foreach($period as $dt) {
        $counter++;
    }

    return $counter;
}

	
//changed on 13-02-2015 mark with rahul



$contents="SL NO \t Vendor Name \t BAU/MOF \t Bank Name \t SITE_ID \t ATM ID \t IIND ATM ID \t Location \t Consumer Name \t Consumer No.\t Energy Provider \t Mode of payment \t Bill Period From \t Bill Period To \t Number of Months \t Total Unit Consumed \t Rate per Unit (ONLY FOR SUBMETER) \t Bill Date \t Due Date \t Bill Amount \t Penalty / Surcharges/other charges \t Actual Paid (Amount) \t Paid Date \t Payment Receipt Number \t Document sent to FIS \t Invoice No \t Remark \t Supervisor \n";



while($row=mysqli_fetch_array($qry))
{
$cnt=0;
$cust=mysqli_query($con,"select contact_first from contacts where short_name ='".$row[1]."'");
$custro=mysqli_fetch_row($cust);
$det=mysqli_query($con,"select * from send_bill_detail where send_id='".$row[0]."' and status=0");
while($detro=mysqli_fetch_array($det))
{
$site=mysqli_query($con,"select bank,site_id,atm_id1,location,atmsite_address,site_type,housekeeping,caretaker,atm_id2,projectid from ".$row[1]."_sites where trackerid='".$detro[2]."'");
$sitero=mysqli_fetch_row($site);

$eb=mysqli_query($con,"select meter_no,landlord,Consumer_No,Distributor from ".$row[1]."_ebill where atmtrackid='".$detro[2]."'");
$ebr=mysqli_fetch_row($eb);

$fund=mysqli_query($con,"select opening_reading,closing_reading,unit,extrachrg ,bill_amt,afdt_amt,trans_id,paytype,after_duedt_chrg,supervisor from ebillfundrequests where req_no='".$detro[20]."'");
$fundr=mysqli_fetch_row($fund);
$cnt=$cnt+1;
$contents.=$cnt."\t";
$contents.="CSS"."\t";
$contents.=$sitero[9]."\t";
$contents.=$sitero[0]."\t";
$contents.=$sitero[1]."\t";
$contents.=$sitero[2]."\t";
$contents.=$sitero[8]."\t";
$text = preg_replace('/\s+/', ' ', $sitero[4]);
      $contents.=$text."\t";
 $contents.=$ebr[1]."\t"; 
 $strngc=$ebr[2];  
$contents.=$strngc."\t";
$contents.=$ebr[3]."\t";
$contents.=$fundr[7]."\t";
$contents.=$detro[9]."\t";
$contents.=$detro[10]."\t";

$contents.=nb_mois($detro[9],$detro[10])."\t";
$contents.=$fundr[2]."\t";
$contents.=round($detro[12]/$fundr[2],2)."\t";
$contents.=$detro[6]."\t";
$contents.=$detro[7]."\t";
$contents.=$fundr[4]."\t";
$contents.=$fundr[8]." \t";
$contents.=$detro[12]."\t";
$contents.=$detro[13]."\t";
$contents.=$fundr[6]."\t";
$contents.=$row[3]."\t";
$contents.=$row[5]."\t";
$contents.=$fundr[10]."\t";


$contents.="\n";
}
//$contents.="\n";
}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
 header("Content-Disposition: attachment; filename=epsinvoiceannexure.xls");
 header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>